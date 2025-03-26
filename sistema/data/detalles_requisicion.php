<?php
session_start();
include ("../../conexion.php");

if ($conection->connect_error) {
    die("Error de conexión a la base de datos: " . $conection->connect_error);
}

$folio_requisicion = isset($_POST['folio']) ? $_POST['folio'] : die("Error al obtener el folio de la requisición");

$sql = "
SELECT 
  d.id,
  d.cantidad,
  d.codigo,
  d.descripcion,
  r.umedida AS unidad_medida,
  d.marca,
  d.precio,
  (d.cantidad * d.precio) AS importe
FROM detalle_requisicioncompra d
LEFT JOIN refacciones r ON d.codigo = r.codigo
WHERE d.folio = ?";

$stmt = $conection->prepare($sql);
if (!$stmt) {
    die("Error en prepare(): " . $conection->error);
}

$stmt->bind_param("i", $folio_requisicion);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(["data" => $data], JSON_UNESCAPED_UNICODE);

$stmt->close();
$conection->close();
