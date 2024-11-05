<?php
include "../../conexion.php"; //libreria de conexion a la base

//$banda_id = filter_input(INPUT_POST, 'banda_id'); //obtenemos el parametro que viene de ajax
$banda_id3 = $_POST['banda_id3'];

if ($banda_id3 == 'Semanal') {
   /*Obtenemos los discos de la banda seleccionada*/
  $sql = "select * FROM semanas ORDER BY id";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);

?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['semana'] ?>"><?= $op['semana'] ?></option>
<?php endforeach; ?>
<?php
} else {
  if ($banda_id3 == 'Quincenal') {
    $sql = "select * FROM quincenas ORDER BY id";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);

?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['quincena'] ?>"><?= $op['quincena'] ?></option>
<?php endforeach; ?>
<?php
  }else{
    if ($banda_id3 == 'Especial') {
  $sql = "select fecha_pago FROM detalle_temp_nomespecial group by fecha_pago";  
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_all($query, MYSQLI_ASSOC); 
  mysqli_close($conection);

?>

<option value="">- Seleccione -</option>
<?php foreach($filas as $op): //creamos las opciones a partir de los datos obtenidos ?>
<option value="<?= $op['fecha_pago'] ?>"><?php echo date('d/m/Y', strtotime($op['fecha_pago'])) ?></option>
<?php endforeach; ?>
<?php
    }else {
      if ($banda_id3 == 'Sprinter') {
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
      }
    }
  }
}

?>  
