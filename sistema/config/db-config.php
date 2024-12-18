<?php 
  error_reporting(1);

  const DB_HOST = 'localhost:3306';
  const DB_USER = 'rmadero';
  const DB_PASS = '8_86y2Myk';
  const DB_NAME = 'transvive';


  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if(!$connection) {
    die("Database connection failed.");
  }
?>