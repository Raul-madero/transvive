<?php
include "../../conexion.php"; //libreria de conexion a la base

//$banda_id = filter_input(INPUT_POST, 'banda_id'); //obtenemos el parametro que viene de ajax
$banda_id20 = $_POST['banda_id20'];

  
  /*Obtenemos los discos de la banda seleccionada*/
  $sql = "SELECT DISTINCT horario
     FROM
     ( SELECT horario1 horario, ruta FROM rutas
      UNION
      SELECT horario2 horario, ruta FROM rutas
      UNION
       SELECT horario3 horario, ruta FROM rutas
      UNION
       SELECT hmixto1 horario, ruta FROM rutas
      UNION
       SELECT hmixto2 horario, ruta FROM rutas
    )  T WHERE ruta = '$banda_id20'  AND horario > '00:00:00' ";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);


/**
 * Como notaras vamos a generar código `html`, esto es lo que sera retornado a `ajax` para llenar 
 * el combo dependiente
 */
?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['horario'] ?>"><?= $op['horario'] ?></option>
<?php endforeach; ?>