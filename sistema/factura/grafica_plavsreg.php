<?php
include "../../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];
  $idoentrada=$_REQUEST['id'];
//$nosemana=$_REQUEST['semana'];

  $fin = strrpos($idoentrada, "id2");
  $final = $fin - 1;
  $fecha_ini = substr($idoentrada, 0,  $fin);
  $fin2 = $fin + 4;
  $fecha_fin = substr($idoentrada, $fin2, 10);
  

  $sqlenc= mysqli_query($conection,"SELECT SUM(IF(planeado=1, planeado, 0)) AS planeados, SUM(valor_vuelta) AS registrados, if(estatus=0, count(*), 0) AS cancelados, SUM(valor_vuelta) - SUM(IF(planeado=1, valor_vuelta, 0)) as diferencia  FROM registro_viajes WHERE semana = '$fecha_ini' and yearreg = $fecha_fin");
  mysqli_close($conection);
  $result_sqlenc = mysqli_num_rows($sqlenc);

  if($result_sqlenc == 0){
    $resp1 = 0;
    $resp2 = 0;
    $resp3 = 0;
    $porcresp = 0;
   

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc);
    $resp1 = $dataenc['planeados']; 
    $resp2 = $dataenc['registrados']; 
    $resp3 = $dataenc['diferencia']; 
    $porcresp = ($resp3 / $resp2) * 100;
    $numreg = $result_sqlenc;
    
  }

  include "../../conexion.php";
  $sqlencan= mysqli_query($conection,"SELECT count(*) as viajes_cancelados from registro_viajes WHERE semana  = '$fecha_ini' and yearreg = $fecha_fin and estatus = 3 ");
  mysqli_close($conection);
  $result_sqlencan = mysqli_num_rows($sqlencan);

  if($result_sqlencan == 0){
    $respcan = 0;
   
  }else{
    
    $dataencan = mysqli_fetch_array($sqlencan);
    $respcan = $dataencan['viajes_cancelados']; 
    
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
  <title>TRANSVIVE | CRM</title>
  <link rel="icon" href="../../images/favicon.ico" type="image/x-icon"/>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../../plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="../local/apis.css">

  <script type="text/javascript" src="../local/jquery.min.js"></script>
  <!--<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>-->
  <script src="../local/highcharts.js"></script>
  <script src="../local/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js"></script>
  <link rel="stylesheet" href="../alertifyjs/css/alertify.min.css">
  <link rel="stylesheet" href="../alertifyjs/css/themes/default.min.css">
  <script src="../alertifyjs/alertify.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.7/dist/sweetalert2.all.min.js"></script>

  <script type="text/javascript">
    $(function () {

    var speedCanvas = document.getElementById("grafica2");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var speedData = {
  labels: ["Planeados", "Registrados", "Diferencia"],
  datasets: [{
    label: "Calificacion",
    data: [<?php echo $resp1; ?>, <?php echo $resp2; ?>, <?php echo $resp3; ?>],
    backgroundColor: 'rgba(39, 214, 129, 0.6)',
  borderColor: 'rgba(39, 214, 129, 1)',
 
  }]
};

var chartOptions = {
  legend: {
    display: true,
    position: 'top',
    labels: {
      boxWidth: 80,
      fontColor: 'black'
    }
  }
};

var lineChart = new Chart(speedCanvas, {
  type: 'line',
  data: speedData,
  options: chartOptions
});
  
    });
 


  
   </script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.0.2/Chart.min.js'></script>
 
</head>
<body class="hold-transition layout-top-nav">
  
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="#" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../../images/logo_easy.png" alt="TRANSVIVE CRM"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

     
      <?php include('../includes/nav.php') ?> 

    </div>
  </nav>
 
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
 
    <!-- /.content-header -->

    <!-- Main content -->
      <!-- Content Wrapper. Contains page content -->
   <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header border-0">
                
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"><?php echo $fecha_ini; ?></span>
                  </p>
                  <!--
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                    <span class="text-muted">Since last week</span>
                  </p>-->
                </div>
                <!-- /.d-flex -->

              <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Grafica de Viajes Planeados vs Registrados
                </h3>
               </div>
               <div> 
                
                  <i class="fa fa-bar-chart" aria-hidden="true"></i>
                  Porcentaje de Diferencia: <?php echo number_format($porcresp, 2); ?> % 
                
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="position-relative mb-12">
                  <canvas id="income" width="1000" height="280"></canvas>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!--/.direct-chat -->

    
            <!-- /.card -->
          </section>
                <!--
                <div class="d-flex flex-row justify-content-end">

                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                </div>-->
              </div>
            </div>
            <!-- /.card -->
            <!--
            <div class="card">
              <div class="card-header border-0">
                <h3 class="card-title">Products</h3>
                <div class="card-tools">
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-download"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm">
                    <i class="fas fa-bars"></i>
                  </a>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-striped table-valign-middle">
                  <thead>
                  <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Sales</th>
                    <th>More</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Some Product
                    </td>
                    <td>$13 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        12%
                      </small>
                      12,000 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Another Product
                    </td>
                    <td>$29 USD</td>
                    <td>
                      <small class="text-warning mr-1">
                        <i class="fas fa-arrow-down"></i>
                        0.5%
                      </small>
                      123,234 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Amazing Product
                    </td>
                    <td>$1,230 USD</td>
                    <td>
                      <small class="text-danger mr-1">
                        <i class="fas fa-arrow-down"></i>
                        3%
                      </small>
                      198 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                      Perfect Item
                      <span class="badge bg-danger">NEW</span>
                    </td>
                    <td>$199 USD</td>
                    <td>
                      <small class="text-success mr-1">
                        <i class="fas fa-arrow-up"></i>
                        63%
                      </small>
                      87 Sold
                    </td>
                    <td>
                      <a href="#" class="text-muted">
                        <i class="fas fa-search"></i>
                      </a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div> -->
            <!-- /.card -->
          </div>
          <!-- /.col-md-6 -->
    
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
  
    <!-- /.content -->

    

  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->

<!-- Page specific script -->

 
     <script>

      swal("Poof! Error!", {
     icon: "warning",
   });

    </script>

<script>
  // bar chart data
            var barData = {
                labels : ["Planeados","Registrados","Cancelados","Diferencia"],
                datasets : [
                    {
                        fillColor :  "rgba(75, 192, 192, 0.2)",
                        strokeColor : "#48A4D1",
                        data : [<?php echo $resp1; ?>, <?php echo $resp2; ?>, <?php echo $respcan; ?>, <?php echo $resp3; ?>]
                    }    
                ]
               
            }
            // get bar chart canvas
            var income = document.getElementById("income").getContext("2d");
            // draw bar chart
            new Chart(income).Bar(barData);
</script>


<script>
    document.addEventListener("DOMContentLoaded", function(){
      // Invocamos cada 5 segundos ;)
      const milisegundos = 5 *1000;
      setInterval(function(){
      // No esperamos la respuesta de la petición porque no nos importa
         fetch("../refrescar.php");
      },milisegundos);
    });
</script>
<script src="../js/sweetalert.min.js"></script>
</body>
</html>
