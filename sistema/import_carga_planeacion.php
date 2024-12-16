<?php
include "../conexion.php";
include "class.upload.php";
session_start();

$usuario = $_SESSION['idUser'];
$sql = "TRUNCATE tempregistro_viajes";
$conection->query($sql);

$tipo_viaje = 'Normal';
$valor_vuelta = 'Completa';

date_default_timezone_set('America/Mexico_City');
$fechac = date("Y-m-d");

if (isset($_FILES['name'])) {
    $up = new Upload($_FILES['name']);
    if ($up->uploaded) {
        $up->Process("./");
        if($up->processed) {
            if ($file = fopen("./" . $up->file_dst_name, "r")) {
                $ok = 0;
                $error = O;
                $products_array = array();
                while($x = fgets($file, 4096)) {
                    $data = explode(",", $x);
                    if (count($data) >= 6) {
                        $ok++;
                        $fcha = $data[9];
                        $nombre = utf8_encode($data[10]);
                        $fecha = str_replace('/', '-', $fcha);
                        $sql = "INSERT INTO tempregistro_viajes (fecha, cliente, ruta, operador, unidad, tipo_viaje, num_unidad, valor_vuelta, hora_inicio, hora_fin, id_supervisor, jefe_operaciones, usuario_id, usuario_reg, fecha_carga) value (\"$fecha\", \"$data[3]\", \"$data[8]\", \"$nombre\", \"$data[6]\", \"$tipo_viaje\", \"$data[7]\", \"$valor_vuelta\", \"$data[1]\", \"$data[2]\", \"$data[11]\", \"$data[5]\", \"$data[11]\", \"$usuario\", \"$fechac\")";
                        $resultado = $conection->query($sql);
                        if(!$resultado) {echo "<script> alert('Error sql') </script>";}
                        $sql2 = "UPDATE tempregistro_viajes SET semana = (SELECT semanas40.semana FROM semanas40 WHERE tempregistro_viajes.fecha BETWEEN semanas40.dia_inicial AND semanas40.dia_final)";
                        $resultado2 = $conection->$query($sql2);
                        if(!$resultado2) {echo "<script> alert('Error sql2') </script>";}
                        $sql3 = "UPDATE tempregistro_viajes op INNER JOIN ( SELECT cliente, ruta, sueldo_camion as sumu FROM rutas WHERE sueldo_camion >0) i ON op.cliente = i.cliente SET op.sueldo_vuelta = i.sumu WHERE op.ruta = i.ruta AND op.unidad = 'Camion'";
                        $resultado3 = $conection->query($sql3);
                        if(!$resultado3) {echo "<script> alert('Error sql3') </script>";}
                        $sql4 = "UPDATE tempregistro_viajes op INNER JOIN ( SELECT cliente, ruta, sueldo-camioneta as sumu FROM rutas WHERE sueldo_camioneta > 0) i ON op.cliente = i.cliente SET op.sueldo_vuelta = i.sumu WHERE op.ruta = i.ruta AND op.unidad = 'Camioneta'";
                        $resultado4 = $conection->query($sql4);
                        if(!$resultado4) {echo "<script> alert('Error sql4') </script>";}
                        $sql5 = "UPDATE tempregistro_viajes op INNER JOIN (SELECT nombres, apellido_paterno, apellido_materno, sueldo as sumu FROM empleados) i ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno) SET op.sueldo_vuelta = i.sumu WHERE op.unidad = 'Camion' AND op.sueldo_vuelta = 0";
                        $resultado5 = $conection->query($sql5);
                        if(!$resultado5) {echo "<script> alert('Error sql5') </script>";}
                        $sql6 = "UPDATE tempregistro_viajes op INNER JOIN (SELECT nombres, apellido_paterno, apellido_materno, sueldo_camioneta as sumu FROM empleados) i ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno) SET op.sueldo_vuelta = i.sumu WHERE op.unidad = 'Camioneta AND op.sueldo_vuelta = 0";
                        $resultado6 = $conection->query($sql6);
                        if(!$resultado6) {echo "<script> alert('Error sql6') </script>";}
                        $sql17 = "UPDATE tempregistro_viajes op INNER JOIN (SELECT nombres, apellido_paterno, apellido_materno, sueldo_sprinter as sumu FROM empleados) i ON op.operador = CONCAT(i.nombres, ' ', i.apellido_paterno, ' ', i.apellido_materno) SET op.sueldo_vuelta = i.sumu WHERE op.unidad = 'Sprinter' AND op.sueldo_vuelta = 0";
                        $resultado17 = $conection->query($sql17);
                        if(!$resultado17) {echo "<script> alert('Error sql17') </script>";}
                        fclose($file);
                        unlink("./" . $up->file_dst_name);
            
                        echo "<script>
                        alert('Correcto $ok, Error $error !!!');
                        window.location = './viajes_cargados.php';
                        </script>";
                    }else {
                        $error++;
                    }
                }
            }
        }
    }
}

?>