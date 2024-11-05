<?php
include "../conexion.php";
session_start();
$idemp = $_SESSION['idUser'];
// Función para obtener la dirección IP del usuario
function get_client_ip() {
  $ipaddress = '';
  if (isset($_SERVER['HTTP_CLIENT_IP']))
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_X_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  else if(isset($_SERVER['HTTP_FORWARDED']))
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
  else if(isset($_SERVER['REMOTE_ADDR']))
      $ipaddress = $_SERVER['REMOTE_ADDR'];
  else
      $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

// Obtener la dirección IP del usuario
$ip = get_client_ip();

// Obtener la ubicación del usuario
if (isset($_POST['lat']) && isset($_POST['lon'])) {
  $lat = $_POST['lat'];
  $lon = $_POST['lon'];
}
  $sqledo = "insert INTO asistencia (idempleado, ip, latitud, longitud, tipo) values ($idemp, '$ip', '$lat', '$lon', 'Salida' )";
  $queryedo = mysqli_query($conection, $sqledo);

  // Guardar la dirección IP y la ubicación en una base de datos o archivo
  // ...


?>