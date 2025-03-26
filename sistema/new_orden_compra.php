<?php
session_start();
$user = $_SESSION["user"];
$rol = $_SESSION['rol'];

var_dump($_SESSION);