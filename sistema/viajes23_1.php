<?php

include "../conexion.php";
session_start();
$User=$_SESSION['user'];
$rol=$_SESSION['rol'];
$idUser = $_SESSION['idUser'];

//Verificamos que se haya iniciado sesion correctamente
if (!isset($_SESSION['idUser'])) {
	header('Location: ../index.php');
}

