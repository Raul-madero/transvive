<?php
include "../../conexion.php"; //libreria de conexion a la base

//$banda_id = filter_input(INPUT_POST, 'banda_id'); //obtenemos el parametro que viene de ajax
$banda_id3 = $_POST['banda_id3'];

if ($banda_id3 == 'Camion') {
   /*Obtenemos los discos de la banda seleccionada*/
  $sql = "select * FROM unidades where no_unidad like '%C-%' ORDER BY id";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);

?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['no_unidad'] ?>"><?= $op['no_unidad'] ?></option>
<?php endforeach; ?>
<?php
} else {
  if ($banda_id3 == 'Camioneta') {
    $sql = "select * FROM unidades where no_unidad like '%T-%' ORDER BY id";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);

?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['no_unidad'] ?>"><?= $op['no_unidad'] ?></option>
<?php endforeach; ?>
<?php
  }else{
    if ($banda_id3 == 'Automovil') {
  $sql = "select * FROM unidades where no_unidad like '%A-%' ORDER BY id";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);

?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['no_unidad'] ?>"><?= $op['no_unidad'] ?></option>
<?php endforeach; ?>
<?php
    }else {
      if ($banda_id3 == 'Sprinter') {
        $sql = "select * FROM unidades where no_unidad like '%S-%' ORDER BY id";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);

?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['no_unidad'] ?>"><?= $op['no_unidad'] ?></option>
<?php endforeach; ?>
<?php
      }else {
        if ($banda_id3 == 'Unidad Externa') {
        $sql = "select * FROM unidades where no_unidad like '%Externa%' ORDER BY id";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);

?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['no_unidad'] ?>"><?= $op['no_unidad'] ?></option>
<?php endforeach; ?>
<?php
}
      }
    }
  }
}

?>  
