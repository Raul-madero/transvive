<?php
include "../../conexion.php"; //libreria de conexion a la base

//$banda_id = filter_input(INPUT_POST, 'banda_id'); //obtenemos el parametro que viene de ajax
$banda_id3 = $_POST['banda_id3'];

  
  /*Obtenemos los discos de la banda seleccionada*/
  $sql = "select * FROM rutas where cliente ='$banda_id3' ";  
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
<option value="<?= $op['ruta'] ?>"><?= $op['ruta'] ?></option>
<?php endforeach; ?>