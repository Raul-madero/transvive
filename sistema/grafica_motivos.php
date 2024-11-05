<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqltot= mysqli_query($conection,"SELECT count(*) as tot_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) ");
  mysqli_close($conection);

  while ($rowt = mysqli_fetch_array($sqltot)){
   //extract $drow;
     $totquejas = $rowt['tot_quejas'];
  }

  include "../conexion.php";
  $sqlenetot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Impuntualidad de ruta'  ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlenetot)){
   //extract $drow; 
   $numquejas = $drowt['num_quejas'];
   }

  include "../conexion.php";
  $sqlene= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Impuntualidad de ruta' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha) ");
  mysqli_close($conection);

  while ($drow = mysqli_fetch_array($sqlene)){
    if(is_null($drow["name_mes"])){
       $ndato1 = array("Enero","c-1");
       $ndato1n = array(0,1);
       $dato1[]=$ndato1;
       $dato1n[]=$ndato1n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato1[] = $drow['name_mes'];
      $dato1n[] = $drow['n_quejas'];
   }
   }

   include "../conexion.php";
  $sqlfebtot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Aspecto del operador' ");
  mysqli_close($conection);

  while ($drowt2 = mysqli_fetch_array($sqlfebtot)){
   //extract $drow; 
   $numquejas2 = $drowt2['num_quejas'];
   }

  include "../conexion.php";
  $sqlfeb= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Aspecto del operador' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha)");
  mysqli_close($conection);

  while ($drow2 = mysqli_fetch_array($sqlfeb)){

    if(is_null($drow2["name_mes"])){
       $ndato2 = array("Enero","c-1");
       $ndato2n = array(0,1);
       $dato2[]=$ndato2;
       $dato2n[]=$ndato2n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato2[] = $drow2['name_mes'];
      $dato2n[] = $drow2['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlmartot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Actitud del Operador'  ");
  mysqli_close($conection);

  while ($drowt3 = mysqli_fetch_array($sqlmartot)){
   //extract $drow; 
   $numquejas3 = $drowt3['num_quejas'];
   }

  include "../conexion.php";
  $sqlmar= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Actitud del Operador' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha)");
  mysqli_close($conection);

  while ($drow3 = mysqli_fetch_array($sqlmar)){

    if(is_null($drow3["name_mes"])){
       $ndato3 = array("Enero","c-1");
       $ndato3n = array(0,1);
       $dato3[]=$ndato3;
       $dato3n[]=$ndato3n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato3[] = $drow3['name_mes'];
      $dato3n[] = $drow3['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlabrtot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Imprudencia al manejar'  ");
  mysqli_close($conection);

  while ($drowt4 = mysqli_fetch_array($sqlabrtot)){
   //extract $drow; 
   $numquejas4 = $drowt4['num_quejas'];
   }

  include "../conexion.php";
  $sqlabr= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Imprudencia al manejar' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha)");
  mysqli_close($conection);

  while ($drow4 = mysqli_fetch_array($sqlabr)){

    if(is_null($drow4["name_mes"])){
       $ndato4 = array("Enero","c-1");
       $ndato4n = array(0,1);
       $dato4[]=$ndato4;
       $dato4n[]=$ndato4n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato4[] = $drow4['name_mes'];
      $dato4n[] = $drow4['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlmaytot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Desvio de ruta'  ");
  mysqli_close($conection);

  while ($drowt5 = mysqli_fetch_array($sqlmaytot)){
   //extract $drow; 
   $numquejas5 = $drowt5['num_quejas'];
   }

  include "../conexion.php";
  $sqlmay= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Desvio de ruta' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha)");
  mysqli_close($conection);

  while ($drow5 = mysqli_fetch_array($sqlmay)){

    if(is_null($drow5["name_mes"])){
       $ndato5 = array("Enero","c-1");
       $ndato5n = array(0,1);
       $dato5[]=$ndato5;
       $dato5n[]=$ndato5n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato5[] = $drow5['name_mes'];
      $dato5n[] = $drow5['n_quejas'];
   }

  }

include "../conexion.php";
  $sqljuntot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'No cumple con router' ");
  mysqli_close($conection);

  while ($drowt6 = mysqli_fetch_array($sqljuntot)){
   //extract $drow; 
   $numquejas6 = $drowt6['num_quejas'];
   }

  include "../conexion.php";
  $sqljun= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'No cumple con router' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha)");
  mysqli_close($conection);

  while ($drow6 = mysqli_fetch_array($sqljun)){

    if(is_null($drow6["name_mes"])){
       $ndato6 = array("Enero","c-1");
       $ndato6n = array(0,1);
       $dato6[]=$ndato6;
       $dato6n[]=$ndato6n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato6[] = $drow6['name_mes'];
      $dato6n[] = $drow6['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqljultot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Falla en unidad' ");
  mysqli_close($conection);

  while ($drowt7 = mysqli_fetch_array($sqljultot)){
   //extract $drow; 
   $numquejas7 = $drowt7['num_quejas'];
   }

  include "../conexion.php";
  $sqljul= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Falla en unidad' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha)");
  mysqli_close($conection);

  while ($drow7 = mysqli_fetch_array($sqljul)){

    if(is_null($drow7["name_mes"])){
       $ndato7 = array("Enero","c-1");
       $ndato7n = array(0,1);
       $dato7[]=$ndato7;
       $dato7n[]=$ndato7n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato7[] = $drow7['name_mes'];
      $dato7n[] = $drow7['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlagotot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Aspecto de la unidad' ");
  mysqli_close($conection);

  while ($drowt8 = mysqli_fetch_array($sqlagotot)){
   //extract $drow; 
   $numquejas8 = $drowt8['num_quejas'];
   }

  include "../conexion.php";
  $sqlago= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Aspecto de la unidad' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha)");
  mysqli_close($conection);

  while ($drow8 = mysqli_fetch_array($sqlago)){

    if(is_null($drow8["name_mes"])){
       $ndato8 = array("Enero","c-1");
       $ndato8n = array(0,1);
       $dato8[]=$ndato8;
       $dato8n[]=$ndato8n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato8[] = $drow8['name_mes'];
      $dato8n[] = $drow8['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlseptot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Otros' ");
  mysqli_close($conection);

  while ($drowt9 = mysqli_fetch_array($sqlseptot)){
   //extract $drow; 
   $numquejas9 = $drowt9['num_quejas'];
   }

  include "../conexion.php";
  $sqlsep= mysqli_query($conection,"SELECT MONTHNAME(fecha) as name_mes, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and motivo = 'Otros' GROUP BY MONTHNAME(fecha) ORDER BY MONTH(fecha)");
  mysqli_close($conection);

  while ($drow9 = mysqli_fetch_array($sqlsep)){

    if(is_null($drow9["name_mes"])){
       $ndato9 = array("Enero","c-1");
       $ndato9n = array(0,1);
       $dato9[]=$ndato9;
       $dato9n[]=$ndato9n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato9[] = $drow9['name_mes'];
      $dato9n[] = $drow9['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlocttot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'October' ");
  mysqli_close($conection);

  while ($drowt10 = mysqli_fetch_array($sqlocttot)){
   //extract $drow; 
   $numquejas10 = $drowt10['num_quejas'];
   }

  include "../conexion.php";
  $sqloct= mysqli_query($conection,"SELECT unidad, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'October' GROUP BY unidad");
  mysqli_close($conection);

  while ($drow10 = mysqli_fetch_array($sqloct)){

    if(is_null($drow10["unidad"])){
       $ndato10 = array("unidad","c-1");
       $ndato10n = array(0,1);
       $dato10[]=$ndato10;
       $dato10n[]=$ndato10n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato10[] = $drow10['unidad'];
      $dato10n[] = $drow10['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlnovtot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'November' ");
  mysqli_close($conection);

  while ($drowt11 = mysqli_fetch_array($sqlnovtot)){
   //extract $drow; 
   $numquejas11 = $drowt11['num_quejas'];
   }

  include "../conexion.php";
  $sqlnov= mysqli_query($conection,"SELECT unidad, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'November' GROUP BY unidad");
  mysqli_close($conection);

  while ($drow11 = mysqli_fetch_array($sqlnov)){

    if(is_null($drow11["unidad"])){
       $ndato11 = array("unidad","c-1");
       $ndato11n = array(0,1);
       $dato11[]=$ndato11;
       $dato11n[]=$ndato11n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato11[] = $drow11['unidad'];
      $dato11n[] = $drow11['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqldictot= mysqli_query($conection,"SELECT count(*) as num_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'December' ");
  mysqli_close($conection);

  while ($drowt12 = mysqli_fetch_array($sqldictot)){
   //extract $drow; 
   $numquejas12 = $drowt12['num_quejas'];
   }

  include "../conexion.php";
  $sqldic= mysqli_query($conection,"SELECT unidad, count(*) as n_quejas FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTHNAME(fecha) = 'December' GROUP BY unidad");
  mysqli_close($conection);

  while ($drow12 = mysqli_fetch_array($sqldic)){

    if(is_null($drow12["unidad"])){
       $ndato12 = array("unidad","c-1");
       $ndato12n = array(0,1);
       $dato12[]=$ndato12;
       $dato12n[]=$ndato12n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato12[] = $drow12['unidad'];
      $dato12n[] = $drow12['n_quejas'];
   }

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
    height: 400px;
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

      <?php
      
              if ($_SESSION['rol'] == 14) {
                include('includes/navbarcalidad.php');
                include('includes/navc.php');
              }else {
                if ($_SESSION['rol'] == 9) {
                   include('includes/navbargrcia.php');
                   include('includes/nav.php');
                }else {
                   include('includes/navbar.php');
                   include('includes/nav.php'); 
                }   
              }  
           
    
     ?>

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
        align: 'left',
        text: 'No Conformidades por Mes (Motivos)'
    },
    subtitle: {
        align: 'left',
        text: 'Año en curso <?php echo ($aniocurso) ?> No. de Quejas en el año <?php echo ($totquejas) ?>' 
    },
    accessibility: {
        announceNewData: {
            enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
            text: 'Total por Motivo'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
            borderWidth: 0,
            dataLabels: {
                enabled: true,
                format: '{point.y:.0f}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: ' +
            '<b></b> <br/>'
    },

    series: [
        {
            name: 'Motivos',
            colorByPoint: true,
            data: [
                {
                    name: 'Impuntualidad ruta',
                    y: <?php echo ($numquejas) ?>,
                    drilldown: 'Enero'
                },
                {
                    name: 'Aspecto operador',
                    y: <?php echo ($numquejas2) ?>,
                    drilldown: 'Febrero'
                },
                {
                    name: 'Actitud Operador',
                    y: <?php echo ($numquejas3) ?>,
                    drilldown: 'Marzo'
                },
                {
                    name: 'Imprudencia al manejar',
                    y: <?php echo ($numquejas4) ?>,
                    drilldown: 'Abril'
                },
                {
                    name: 'Desvío ruta',
                    y: <?php echo ($numquejas5) ?>,
                    drilldown: 'Mayo'
                },
                {
                    name: 'No cumple router',
                    y: <?php echo ($numquejas6) ?>,
                    drilldown: 'Junio'
                },
                {
                    name: 'Falla unidad',
                    y: <?php echo ($numquejas7) ?>,
                    drilldown: 'Julio'
                },
                {
                    name: 'Aspecto unidad',
                    y: <?php echo ($numquejas8) ?>,
                    drilldown: 'Agosto'
                },
                {
                    name: 'Otros',
                    y: <?php echo ($numquejas9) ?>,
                    drilldown: 'Septiembre'
                }
            ]
        }
    ],
    drilldown: {
        breadcrumbs: {
            position: {
                align: 'right'
            }
        },
        series: [
            {
                name: 'Impuntualidad de ruta',
                id: 'Enero',
                
                data: [
                       
                     <?php
                      if (!empty($dato1)) {
                     $ind = 0;
                      foreach ($dato1 as $val) {
                         
                      ?>
                      [
                        '<?php echo $val ?>',
                        <?php echo $dato1n[$ind] ?>
                   
                 
                ],
                <?php
                $ind = $ind +1;
                } }  else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>

               ]
                      
            },
            {
                name: 'Aspecto del operador',
                id: 'Febrero',
                data: [
                    <?php
                     if (!empty($dato2)) {
                     $ind2 = 0;
                      foreach ($dato2 as $valf) {
                         
                      ?>
                      [
                        '<?php echo $valf ?>',
                        <?php echo $dato2n[$ind2] ?>
                   
                 
                ],
                <?php
                $ind2 = $ind2 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Actitud del Operador',
                id: 'Marzo',
                data: [
                    <?php
                     if (!empty($dato3)) {
                     $ind3 = 0;
                      foreach ($dato3 as $valf3) {
                         
                      ?>
                      [
                        '<?php echo $valf3 ?>',
                        <?php echo $dato3n[$ind3] ?>
                   
                 
                ],
                <?php
                $ind3 = $ind3 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Imprudencia al manejar',
                id: 'Abril',
                data: [
                    <?php
                     if (!empty($dato4)) {
                     $ind4 = 0;
                      foreach ($dato4 as $valf4) {
                         
                      ?>
                      [
                        '<?php echo $valf4 ?>',
                        <?php echo $dato4n[$ind4] ?>
                   
                 
                ],
                <?php
                $ind4 = $ind4 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Desvío de ruta',
                id: 'Mayo',
                data: [
                    <?php
                     if (!empty($dato5)) {
                     $ind5 = 0;
                      foreach ($dato5 as $valf5) {
                         
                      ?>
                      [
                        '<?php echo $valf5 ?>',
                        <?php echo $dato5n[$ind5] ?>
                   
                 
                ],
                <?php
                $ind5 = $ind5 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'No cumple con router',
                id: 'Junio',
                data: [
                    <?php
                     if (!empty($dato6)) {
                     $ind6 = 0;
                      foreach ($dato6 as $valf6) {
                         
                      ?>
                      [
                        '<?php echo $valf6 ?>',
                        <?php echo $dato6n[$ind6] ?>
                   
                 
                ],
                <?php
                $ind6 = $ind6 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Falla en unidad',
                id: 'Julio',
                data: [
                    <?php
                     if (!empty($dato7)) {
                     $ind7 = 0;
                      foreach ($dato7 as $valf7) {
                         
                      ?>
                      [
                        '<?php echo $valf7 ?>',
                        <?php echo $dato7n[$ind7] ?>
                   
                 
                ],
                <?php
                $ind7 = $ind7 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Aspecto de la unidad',
                id: 'Agosto',
                data: [
                    <?php
                     if (!empty($dato8)) {
                     $ind8 = 0;
                      foreach ($dato8 as $valf8) {
                         
                      ?>
                      [
                        '<?php echo $valf8 ?>',
                        <?php echo $dato8n[$ind8] ?>
                   
                 
                ],
                <?php
                $ind8 = $ind8 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Otros',
                id: 'Septiembre',
                data: [
                    <?php
                     if (!empty($dato9)) {
                     $ind9 = 0;
                      foreach ($dato9 as $valf9) {
                         
                      ?>
                      [
                        '<?php echo $valf9 ?>',
                        <?php echo $dato9n[$ind9] ?>
                   
                 
                ],
                <?php
                $ind9 = $ind9 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Octubre',
                id: 'Octubre',
                data: [
                    <?php
                     if (!empty($dato10)) {
                     $ind10 = 0;
                      foreach ($dato10 as $valf10) {
                         
                      ?>
                      [
                        '<?php echo $valf10 ?>',
                        <?php echo $dato10n[$ind10] ?>
                   
                 
                ],
                <?php
                $ind10 = $ind10 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            },
            {
                name: 'Noviembre',
                id: 'Noviembre',
                data: [
                    <?php
                     if (!empty($dato11)) {
                     $ind11 = 0;
                      foreach ($dato11 as $valf11) {
                         
                      ?>
                      [
                        '<?php echo $valf11 ?>',
                        <?php echo $dato11n[$ind11] ?>
                   
                 
                ],
                <?php
                $ind11 = $ind11 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            }, 
            {
                name: 'Diciembre',
                id: 'Diciembre',
                data: [
                    <?php
                     if (!empty($dato12)) {
                     $ind12 = 0;
                      foreach ($dato12 as $valf12) {
                         
                      ?>
                      [
                        '<?php echo $valf12 ?>',
                        <?php echo $dato12n[$ind12] ?>
                   
                 
                ],
                <?php
                $ind12 = $ind12 +1;
                } } else { ?>
                 [
                        'N/A',
                        0
                    ],  
               <?php } ?>
                ]
            }
        ]
    }
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
