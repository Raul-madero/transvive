<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $idemp = $_SESSION['idUser'];
  $rol=$_SESSION['rol'];
  if($rol != 8) {
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

  $sql10= mysqli_query($conection,"SELECT COUNT(*) as numero FROM empleados");
  mysqli_close($conection);
  $result_sql10 = mysqli_num_rows($sql10);

  if($result_sql10 == 0){
    $cantidad_pedidos = 0;
   
  }else{
    
    $data = mysqli_fetch_array($sql10);
   
  }
   $cantidad_pedidos = $data['numero'];

  include "../conexion.php";
  $sql11= mysqli_query($conection,"SELECT COUNT(*) as numeros FROM empleados where cargo = 'SUPERVISOR'");
  mysqli_close($conection);
  $result_sql11 = mysqli_num_rows($sql11);

  if($result_sql11 == 0){
    $cantidad_superv = 0;
   
  }else{
    
    $data = mysqli_fetch_array($sql11);
   
  }
   $cantidad_superv = $data['numeros']; 

  include "../conexion.php";
  $sql12= mysqli_query($conection,"SELECT COUNT(*) as numerosem FROM nomina");
  mysqli_close($conection);
  $result_sql12 = mysqli_num_rows($sql12);

  if($result_sql12 == 0){
    $cantidad_nomsem = 0;
   
  }else{
    
    $data = mysqli_fetch_array($sql12);
   
  }
   $cantidad_nomsem = $data['numerosem']; 

  include "../conexion.php";
  $sql13= mysqli_query($conection,"SELECT COUNT(*) as numeroqun FROM nomina_quincenal");
  mysqli_close($conection);
  $result_sql13 = mysqli_num_rows($sql13);

  if($result_sql13 == 0){
    $cantidad_nomqun = 0;
   
  }else{
    
    $data = mysqli_fetch_array($sql13);
   
  }
   $cantidad_nomqun = $data['numeroqun']; 

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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
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

      <?php include('includes/navbarjefeoper.php') ?>
      <?php include('includes/navc.php') ?>
     
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
          <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $cantidad_pedidos; ?></h3>

                <p>Empleados</p>
              </div>
              <div class="icon">
                <i class="ion-person-stalker"></i>
              </div>
              <a href="empleados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $cantidad_superv; ?><sup style="font-size: 20px"></sup></h3>

                <p>Supervisores</p>
              </div>
              <div class="icon">
                <i class="ion-person-stalker"></i>
              </div>
              <a href="supervisores.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $cantidad_nomsem; ?></h3>

                <p>Nomina Semanal</p>
              </div>
              <div class="icon">
                <i class="ion-calculator"></i>
              </div>
              <a href="nominas.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $cantidad_nomqun; ?></h3>

                <p>Nomina Quincenal</p>
              </div>
              <div class="icon">
                <i class="ion-calculator"></i>
              </div>
              <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Ambiente Laboral
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!--/.direct-chat -->

    
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
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

!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../plugins/moment/moment.min.js"></script>
<script src="../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
</body>
</html>
