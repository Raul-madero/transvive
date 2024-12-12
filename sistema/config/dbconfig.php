<?php 
$host = "localhost:3306";
// $port = "$_ENV['BD_PORT']";
$user = "rmadero";
$password = "8_86y2Myk";
$database = "transvive";

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
 die("Connection failed: " . mysqli_connect_error());
}
?>