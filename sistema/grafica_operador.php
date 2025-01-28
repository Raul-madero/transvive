<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];


 

include "../conexion.php";
  $sqltot= mysqli_query($conection,"SELECT count(*) as tot_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE())  ");
  mysqli_close($conection);

  while ($rowt = mysqli_fetch_array($sqltot)){
   //extract $drow;
     $totquejas = $rowt['tot_quejas'];
  }



  include "../conexion.php";
  $sqlnov= mysqli_query($conection,"SELECT operador, SUM(IF(MONTH(fecha) = 1,  cuenta, 0)) as Ene,  SUM(IF(MONTH(fecha) = 2,  cuenta, 0)) as Feb,  SUM(IF(MONTH(fecha) = 3,  cuenta, 0)) as Mar, SUM(IF(MONTH(fecha) = 4,  cuenta, 0)) as Abr,  SUM(IF(MONTH(fecha) = 5,  cuenta, 0)) as May,  SUM(IF(MONTH(fecha) = 6,  cuenta, 0)) as Jun,  SUM(IF(MONTH(fecha) = 7,  cuenta, 0)) as Jul,  SUM(IF(MONTH(fecha) = 8,  cuenta, 0)) as Ago,  SUM(IF(MONTH(fecha) = 9,  cuenta, 0)) as Sep,  SUM(IF(MONTH(fecha) = 10,  cuenta, 0)) as Oct,  SUM(IF(MONTH(fecha) = 11,  cuenta, 0)) as Nov,  SUM(IF(MONTH(fecha) = 12,  cuenta, 0)) as Dic FROM `no_conformidades` WHERE YEAR(fecha) = YEAR(CURDATE()) GROUP BY operador order by MONTH(fecha)");
  mysqli_close($conection);

  while ($drow11 = mysqli_fetch_array($sqlnov)){   
     
      $operador[] = $drow11['operador'];
      $no_enero[] = $drow11['Ene'];
      $no_febrero[] = $drow11['Feb'];
      $no_marzo[] = $drow11['Mar'];
      $no_abril[] = $drow11['Abr'];
      $no_mayo[] = $drow11['May'];
      $no_junio[] = $drow11['Jun'];
      $no_julio[] = $drow11['Jul'];
      $no_agosto[] = $drow11['Ago'];
      $no_septiembre[] = $drow11['Sep'];
      $no_octubre[] = $drow11['Oct'];
      $no_noviembre[] = $drow11['Nov'];
      $no_diciembre[] = $drow11['Dic'];

  }

 
 $aniocurso = date("Y");

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
    <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRANSVIVE | ERP</title>
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="./local/apis.css">

  <script type="text/javascript" src="./local/jquery.min.js"></script>
  <!--<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>-->
  <script src="./local/highcharts.js"></script>
  <script src="./local/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js"></script>

  <link rel="stylesheet" href="./alertifyjs/css/alertify.min.css">
  <link rel="stylesheet" href="./alertifyjs/css/themes/default.min.css">
  <script src="./alertifyjs/alertify.min.js"></script>

  <style>
    .highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 1000px;
    margin: 1em auto;
}

#container {
    height: 500px;
}

.highcharts-data-table table {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

.highcharts-data-table caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

.highcharts-data-table th {
    font-weight: 600;
    padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
    padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
    background: #f8f8f8;
}

.highcharts-data-table tr:hover {
    background: #f1f7ff;
}


  </style>


</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="AdminLTE Logo"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
       <?php include('includes/generalnavbar.php') ?>
    

    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
 
    <!-- /.content-header -->
  <br>
    <!-- Main content -->
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

      <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="position-relative mb-4">
                   <figure class="highcharts-figure">
                       <div id="container"></div>
                       <p class="highcharts-description">
                           
                       </p>
                   </figure>
                </div>
              
            </div>
           
          </div>
          <!-- /.col-md-6 -->
        
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>

   

</div>
  
    <!-- /.content -->

    

  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include('includes/footer.php') ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<!-- DataTables JS library -->
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- DataTables JBootstrap -->
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- <script src="../dist/js/pages/dashboard3.js"></script>-->
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

<script src="js/sweetalert2.all.min.js"></script>   
<!-- Page specific script -->

<script>
  // Data retrieved from https://gs.statcounter.com/browser-market-share#monthly-202201-202201-bar

// Create the chart


  Highcharts.chart('container', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'No conformidades por mes por Operador',
        align: 'left'
    },
    subtitle: {
        text:
            'Año en curso <?php echo ($aniocurso) ?>: No. de Quejas en el año <?php echo ($totquejas) ?> ',
        align: 'left'
    },
    xAxis: {
        categories: ['<?php echo join($operador, "','") ?>'],
        crosshair: true,
        accessibility: {
            description: 'Operador'
        }
    },
    yAxis: {
        min: 0,
        title: {
            text: 'No Quejas'
        }
    },
    tooltip: {
        valueSuffix: ' Queja(s)'
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Ene',
            data: [<?php echo join($no_enero, ',') ?>]
        },
        {
            name: 'Feb',
            data: [<?php echo join($no_febrero, ',') ?>]
        }, 
        {
            name: 'Mar',
            data: [<?php echo join($no_marzo, ',') ?>]
        }, 
        {
            name: 'Abr',
            data: [<?php echo join($no_abril, ',') ?>]
        }, 
        {
            name: 'May',
            data: [<?php echo join($no_mayo, ',') ?>]
        }, 
        {
            name: 'Jun',
            data: [<?php echo join($no_junio, ',') ?>]
        }, 
        {
            name: 'Jul',
            data: [<?php echo join($no_julio, ',') ?>]
        }, 
        {
            name: 'Ago',
            data: [<?php echo join($no_agosto, ',') ?>]
        }, 
        {
            name: 'Sep',
            data: [<?php echo join($no_septiembre, ',') ?>]
        }, 
        {
            name: 'Oct',
            data: [<?php echo join($no_octubre, ',') ?>]
        }, 
        {
            name: 'Nov',
            data: [<?php echo join($no_noviembre, ',') ?>]
        }, 
        {
            name: 'Dic',
            data: [<?php echo join($no_diciembre, ',') ?>]
        }
    ]
});


</script>


 

<script>
    document.addEventListener("DOMContentLoaded", function(){
      // Invocamos cada 5 segundos ;)
      const milisegundos = 5 *1000;
      setInterval(function(){
      // No esperamos la respuesta de la petición porque no nos importa
         fetch("./refrescar.php");
      },milisegundos);
    });
</script>
<script src="js/sweetalert.min.js"></script>
</body>
</html>
