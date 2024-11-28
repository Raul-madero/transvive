<?php 
  error_reporting(1);

  const DB_HOST = 'dpg-csr5lf1u0jms73cis3s0-a.oregon-postgres.render.com';
  const DB_USER = 'rmadero';
  const DB_PASS = 'M6WeJ17g7uV3EsuLM1Ifjnt11HHf5i6y';
  const DB_NAME = 'transvive_piv3';

  $connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

  if(!$connection) {
    die("Database connection failed.");
  }
?>