<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqltot= mysqli_query($conection,"SELECT count(*) as tot_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) ");
  mysqli_close($conection);

  while ($rowt = mysqli_fetch_array($sqltot)){
   //extract $drow;
     $totquejas = $rowt['tot_quejas'];
  }

  include "../conexion.php";
  $sqlenetot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTH(fecha) BETWEEN 1 and 3  ");
  mysqli_close($conection);

  while ($drowt = mysqli_fetch_array($sqlenetot)){
   //extract $drow; 
   $numquejas_ene = $drowt['promedio'];
   }

   if (isset($numquejas_ene)) {
      $numquejas = number_format($numquejas_ene,2);
   }else {
      $numquejas = number_format(0,2);
   }

  include "../conexion.php";
  $sqlene= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTH(fecha) BETWEEN 1 and 3  GROUP BY cliente");
  mysqli_close($conection);

  while ($drow = mysqli_fetch_array($sqlene)){
    if(is_null($drow["cliente"])){
       $ndato1 = array("cliente","c-1");
       $ndato1n = array(0,1);
       $dato1[]=$ndato1;
       $dato1n[]=$ndato1n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato1[] = $drow['cliente'];
      $dato1n[] = $drow['n_quejas'];
   }
   }

   include "../conexion.php";
  $sqlfebtot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTH(fecha) BETWEEN 4 and 6  ");
  mysqli_close($conection);

  while ($drowt2 = mysqli_fetch_array($sqlfebtot)){
   //extract $drow; 
   $numquejas2_feb = $drowt2['promedio'];
   }

   if (isset($numquejas2_feb)) {
      $numquejas2 = number_format($numquejas2_feb,2);
   }else {
      $numquejas2 = number_format(0,2);
   }

  include "../conexion.php";
  $sqlfeb= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTH(fecha) BETWEEN 4 and 6  GROUP BY cliente");
  mysqli_close($conection);

  while ($drow2 = mysqli_fetch_array($sqlfeb)){

    if(is_null($drow2["cliente"])){
       $ndato2 = array("cliente","c-1");
       $ndato2n = array(0,1);
       $dato2[]=$ndato2;
       $dato2n[]=$ndato2n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato2[] = $drow2['cliente'];
      $dato2n[] = $drow2['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlmartot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTH(fecha) BETWEEN 7 and 9  ");
  mysqli_close($conection);

  while ($drowt3 = mysqli_fetch_array($sqlmartot)){
   //extract $drow; 
   $numquejas3_mar = $drowt3['promedio'];
   }

   if (isset($numquejas3_mar)) {
      $numquejas3 = number_format($numquejas3_mar,2);
   }else {
      $numquejas3 = number_format(0,2);
   }

  include "../conexion.php";
  $sqlmar= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTH(fecha) BETWEEN 7 and 9 GROUP BY cliente");
  mysqli_close($conection);

  while ($drow3 = mysqli_fetch_array($sqlmar)){

    if(is_null($drow3["cliente"])){
       $ndato3 = array("cliente","c-1");
       $ndato3n = array(0,1);
       $dato3[]=$ndato3;
       $dato3n[]=$ndato3n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato3[] = $drow3['cliente'];
      $dato3n[] = $drow3['n_quejas'];
   }

  }

  include "../conexion.php";
  $sqlabrtot= mysqli_query($conection,"SELECT (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as promedio FROM newencuesta_clientes where YEAR(fecha)  = YEAR(CURDATE()) and MONTH(fecha) BETWEEN 10 and 12  ");
  mysqli_close($conection);

  while ($drowt4 = mysqli_fetch_array($sqlabrtot)){
   //extract $drow; 
   $numquejas4_abr = $drowt4['promedio'];
   }

   if (isset($numquejas4_abr)) {
      $numquejas4 = number_format($numquejas4_abr,2);
   }else {
      $numquejas4 = number_format(0,2);
   }

  include "../conexion.php";
  $sqlabr= mysqli_query($conection,"SELECT cliente, (SUM(tiempo_forma)/COUNT(tiempo_forma) + SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) + SUM(disponibilidad)/COUNT(disponibilidad) + SUM(calidad)/COUNT(calidad) + SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) + SUM(limpieza_condicion)/COUNT(limpieza_condicion) + SUM(servicio_operador)/COUNT(servicio_operador) + SUM(conduce_adecuado)/COUNT(conduce_adecuado) + SUM(atencion_calidad)/COUNT(atencion_calidad) + SUM(servicio_facturacion)/COUNT(servicio_facturacion) + SUM(nuestros_precios)/COUNT(nuestros_precios)) / ( (COUNT(tiempo_forma) + COUNT(tiempo_respuesta) + COUNT(disponibilidad) + COUNT(calidad) + COUNT(asesoria_tecnica) + COUNT(limpieza_condicion) + COUNT(servicio_operador) + COUNT(conduce_adecuado) + COUNT(atencion_calidad) + COUNT(servicio_facturacion) + COUNT(nuestros_precios)) /  count(*)) as n_quejas FROM newencuesta_clientes WHERE YEAR(fecha) = YEAR(CURDATE()) and MONTH(fecha) BETWEEN 10 and 12  GROUP BY cliente");
  mysqli_close($conection);

  while ($drow4 = mysqli_fetch_array($sqlabr)){

    if(is_null($drow4["cliente"])){
       $ndato4 = array("cliente","c-1");
       $ndato4n = array(0,1);
       $dato4[]=$ndato4;
       $dato4n[]=$ndato4n;

      //$dato2 = [];
      //$dato2n = [];
   
   }else {
      $dato4[] = $drow4['cliente'];
      $dato4n[] = $drow4['n_quejas'];
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
    height: 450px;
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
            <div class="card-header p-2">
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
        text: '% por Trimestre (Encuestas de Satisfacción al Cliente)'
    },
    subtitle: {
        align: 'left',
        text: 'Año en curso <?php echo ($aniocurso) ?> Total de Encuestas: <?php echo ($totquejas) ?>' 
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
            text: '% por Mes'
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
                format: '{point.y:.2f} %'
            }
        }
    },

   tooltip: {
        valueDecimals: 2,
        valuePrefix: '',
        valueSuffix: '%'
    },

    series: [
        {
            name: 'Meses',
            colorByPoint: true,
            data: [
                {
                    name: 'Ene - Mar',
                    y: <?php echo (number_format($numquejas,2)) ?>,
                    drilldown: 'Enero'
                },
                {
                    name: 'Abr - Jun',
                    y: <?php echo ($numquejas2) ?>,
                    drilldown: 'Febrero'
                },
                {
                    name: 'Jul - Sep',
                    y: <?php echo ($numquejas3) ?>,
                    drilldown: 'Marzo'
                },
                {
                    name: 'Oct - Dic',
                    y: <?php echo ($numquejas4) ?>,
                    drilldown: 'Abril'
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
                name: 'Enero',
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
                name: 'Febrero',
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
                name: 'Marzo',
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
                name: 'Abril',
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
