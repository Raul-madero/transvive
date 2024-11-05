<?php
  include "../conexion.php";

   $sql = "SELECT * FROM empleados";
   $result = $conection->query($sql);

   $empleados = array();
   if ($result->num_rows > 0) {
       while ($row = $result->fetch_assoc()) {
           $empleados[] = $row;
       }
   }

   echo json_encode($empleados);
   ?>