<?php
include "../conexion.php";
session_start();

// Verificamos si se subió el archivo
if (isset($_FILES['name']) && $_FILES['name']['error'] == 0) {
    $nombreArchivo = $_FILES['name']['tmp_name'];

    // Abrimos el archivo CSV
    if (($handle = fopen($nombreArchivo, "r")) !== false) {
        $linea = 0;
        $actualizados = 0;
        $no_actualizados = 0;
        $actualizados2 = 0;
        $no_actualizados2 = 0;

        while (($data = fgetcsv($handle, 1000, ",", '"', "\\")) !== false) {
            $linea++;

            // Si tiene encabezado, lo saltamos
            if ($linea == 1 && !is_numeric($data[1])) {
                continue;
            }

            if (count($data) >= 2) {
                $no_unidad = trim($data[0]);
                $rendimiento = trim($data[1]);

                if (!empty($no_unidad) && is_numeric($rendimiento)) {
                    $stmt = $conection->prepare("UPDATE carga_combustible SET rendimiento_estandar = ? WHERE nounidad = ? AND MONTH(fecha) = MONTH(CURRENT_DATE()) AND YEAR(fecha) = YEAR(CURRENT_DATE())");
                    $stmt->bind_param("ds", $rendimiento, $no_unidad);

                    if ($stmt->execute() && $stmt->affected_rows > 0) {
                        $actualizados++;
                    } else {
                        $no_actualizados++;
                    }

                    $stmt->close();

                    $stmt2 = $conection->prepare("UPDATE unidades SET rendimiendo_estandar = ? WHERE no_unidad = ?");
                    $stmt2->bind_param("ds", $rendimiento, $no_unidad);

                    if ($stmt2->execute() && $stmt2->affected_rows > 0) {
                        // Actualización exitosa
                        $actualizados2++;
                    } else {
                        // No se pudo actualizar la tabla unidades
                        $no_actualizados2++;
                    }

                    $stmt2->close();
                }
            }
        }

        fclose($handle);

        echo "<script>
            alert('Proceso terminado. Registros actualizados en cargas: $actualizados. Sin cambios: $no_actualizados. Registros actualizados en unidades: $actualizados2. Sin cambios: $no_actualizados2.');
            window.location.href = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('No se pudo abrir el archivo.');
            window.location.href = 'index.php';
        </script>";
    }
} else {
    echo "<script>
        alert('No se recibió ningún archivo o hubo un error al cargarlo.');
        window.location.href = 'index.php';
    </script>";
}
?>
