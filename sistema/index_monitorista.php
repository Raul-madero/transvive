<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $idemp = $_SESSION['idUser'];
  $rol=$_SESSION['rol'];
  if($rol != 15) {
      $rolRedirects = [
        "Administrador" => "index.php",
        "Conductor" => "index_conductor.php",
        "Supervisor" => "index_supervisor.php",
        "Recursos Humanos" => "index_rhumanos.php",
        "Operaciones" => "index_operaciones.php",
        "Operador" => "index_operador.php",
        "Mantenimiento" => "index_mantto.php",
        "Jefe Operaciones" => "index_jefeoperaciones.php",
        "Gerencia" => "index_gerencia.php",
        "Almacen" => "index_almacen.php",
        "Calidad" => "index_calidad.php",
        "Monitorista" => "index_monitorista.php",
        "Compras" => "index_compras.php",
        "Ventas" => "index_ventas.php"
      ];
    
      if (isset($rolRedirects[$_SESSION['rol_name']])) {
        header('location: ' . $rolRedirects[$_SESSION['rol_name']]);
      } else {
        header('location: sistema/');
      }
    }
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  date_default_timezone_set('America/Mazatlan');
         $fcha = date("Y-m-d");



 $sql33= mysqli_query($conection,"SELECT no_unidad, placas, descripcion, fin_poliza FROM unidades where date_add(fin_poliza, INTERVAL 10 DAY) <= '$fcha' and estatus = 1 ");
  mysqli_close($conection);
  $result_sql33 = mysqli_num_rows($sql33);


  // Verificación del resultado de la consulta
if ($result_sql33 > 0) {
    while ($fila3 = mysqli_fetch_assoc($sql33)) {
   
    $namecliente =  $fila3['no_unidad']. ' Placas: '. $fila3['placas']; 
    //$fcha = date("d-m-Y",  $fila['fecha_vencimiento'] );
    $newDate30 = date("d/m/Y", strtotime($fila3['fin_poliza']));
       
  ?>  
   <!--
     <script>

     alert('\t Polizas Vencidas y/o Prontas a Vencer. \t \n\t \u00A0 \n\t Unidad: <?php echo $namecliente; ?> \n\t Fecha de vencimiento: <?php echo $newDate30; ?> ')

    </script>
  -->
    <?php 
    }  
   }
    
?>  
  
 
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRANSVIVE | ERP</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/transvive.png" width="150" height="50" alt="Transvive Logo"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php include('includes/navbarmonitorista.php') ?>
      <?php include('includes/navc.php') ?>
     
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!--<section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h4></h4>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="new_miactividad.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nueva</a></li>
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Navegacion</li>
            </ol>
          </div>
        </div>
      </div>
    </section>-->
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">

    <div class="row">
          <!--
          <div class="col-lg-3 col-12">
           
            <div class="small-box bg-info">
              <div class="inner">
                <h3><i class="fa fa-clock"></i></h3>

                <p>Control del Día</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" id="registrarBtn" class="small-box-footer">Abrir Día&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
              <a href="#" id="miEnlace" class="small-box-footer">Cerrar Día&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
             
            </div>
          </div> -->

          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><i class="fas fa-car" aria-hidden="true"></i></h3>

                <p>Viajes</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="viajes23.php" class="small-box-footer">Ingresar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><i class="fas fa-tachometer-alt" aria-hidden="true"></i></h3>
                <p>Alertas</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="alertas.php" class="small-box-footer">Ingresar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><i class="fas fa-gas-pump" aria-hidden="true"></i></h3>
                <p>Carga Combustible</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="carga_combustible.php" class="small-box-footer">Ingresar <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      <div class="container">

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include('includes/footer.php') ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script>
$(document).ready(function() {
  $('#registrarBtn').click(function() {  
 if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
} else {
  alert('La geolocalización no está disponible en este navegador');
}

function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;

  // Enviar la ubicación al servidor mediante AJAX
  $.ajax({
    type: 'POST',
    url: 'registro.php',
    data: {lat: lat, lon: lon},
    success: function(data) {
      alert('Registro exitoso');
    },
    error: function() {
      alert('Error al registrar');
    }
  });
}
});
});
</script>

<script>
$(document).ready(function() {
  $('#registrarBtnSal').click(function() {  
 if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
} else {
  alert('La geolocalización no está disponible en este navegador');
}

function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;

  // Enviar la ubicación al servidor mediante AJAX
  $.ajax({
    type: 'POST',
    url: 'registrosal.php',
    data: {lat: lat, lon: lon},
    success: function(data) {
      alert('Registro exitoso');
    },
    error: function() {
      alert('Error al registrar');
    }
  });
}
});
});
</script>

<script>
  document.getElementById('miEnlace').onclick = function() {
  miFuncion(); // Llama a la función aquí
};
function miFuncion() {
 
        navigator.geolocation.getCurrentPosition(
    function(position) {
         alert("Lat: " + position.coords.latitude + "\nLon: " + position.coords.longitude);
    },
    function(error){
         alert(error.message);
    }, {
         enableHighAccuracy: true
              ,timeout : 5000
    });

  function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;

  // Enviar la ubicación al servidor mediante AJAX
  $.ajax({
    type: 'POST',
    url: 'registrosal.php',
    data: {lat: lat, lon: lon},
    success: function(data) {
      alert('Registro exitoso');
    },
    error: function() {
      alert('Error al registrar');
    }
  });
}
}
    


</script>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="../dist/js/demo.js"></script>-->
</body>
</html>
