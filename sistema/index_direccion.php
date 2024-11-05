<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sql01= mysqli_query($conection,"SELECT * FROM registro_viajes WHERE estatus= 1");
  mysqli_close($conection);
  $result_sql01 = mysqli_num_rows($sql01);

    while ($data = mysqli_fetch_array($sql01)){
      $abiertos   = 0;
     
    }
     date_default_timezone_set('America/Mazatlan');

    $fechaActual = date("Y-m-d");

  $fcha = date("Y-m-d"); 
  $diafcha = date("w");
  $diasrest = 6 - $diafcha;
  $fchaini = date("Y-m-d",strtotime($fcha."- $diafcha days")); 
  $fchafin = date("Y-m-d",strtotime($fcha."+ $diasrest days")); 
  include "../conexion.php";

  $sql= mysqli_query($conection,"SELECT semana, dia_inicial, dia_final FROM semanas40 WHERE dia_inicial <= '$fechaActual' AND dia_final >= '$fechaActual'");
         mysqli_close($conection);
         $result = mysqli_num_rows($sql);
         

         while ($data = mysqli_fetch_array($sql)){
         $diainicial  = $data['dia_inicial'];
         $diafinal    = $data['dia_final'];
     
      
      //$user   = $_SESSION['idUser'];
      
    }
  include "../conexion.php";
  $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual'");
  mysqli_close($conection);
  $result_sql02 = mysqli_num_rows($sql02);

    while ($data = mysqli_fetch_array($sql02)){
      $tareahoy   = $data['viajeshoy'];
     
  }
   

include "../conexion.php";
$sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' ");
mysqli_close($conection);
$result_sql03 = mysqli_num_rows($sql03);
  
 while ($data = mysqli_fetch_array($sql03)){
   $tareasem   = $data['totalsem'];
       
 } 
 
 include "../conexion.php";

  $sqlenc= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes");
  mysqli_close($conection);
  $result_sqlenc = mysqli_num_rows($sqlenc);

  if($result_sqlenc == 0){
    $resp1 = 0;
    $resp2 = 0;
    $resp3 = 0;
    $resp4 = 0;
    $resp5 = 0;
    $resp6 = 0;
    $resp7 = 0;
    $resp8 = 0;
    $resp9 = 0;
    $resp10 = 0;
    $resp11 = 0;
    $resp12 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc);
    $resp1 = $dataenc['Timeforma']; 
    $resp2 = $dataenc['Timerespuesta']; 
    $resp3 = $dataenc['Disponibilidad']; 
    $resp4 = $dataenc['Calidad']; 
    $resp5 = $dataenc['Asesoriatecnica']; 
    $resp6 = $dataenc['Limpieza'];
    $resp7 = $dataenc['Servicio'];
    $resp8 = $dataenc['Conduce'];
    $resp9 = $dataenc['Atencion'];
    $resp10 = $dataenc['Facturacion'];
    $resp11 = $dataenc['Precios'];
    $resp12 = $dataenc['Numeroreg'];
     
  }
  
    
  include "../conexion.php";

  $sqlenc2= mysqli_query($conection,"SELECT SUM(servicio_ventas)/COUNT(servicio_ventas) as ServicioVentas, SUM(servicio_transporte)/COUNT(servicio_transporte) as ServicioTransporte, SUM(servicio_operador)/COUNT(servicio_operador) as ServicioOperador, SUM(servicio_supervisor)/COUNT(servicio_supervisor) as ServicioSupervisor, SUM(servicio_operaciones)/COUNT(servicio_operaciones) as ServicioOperaciones, SUM(atencion_resolucion)/COUNT(atencion_resolucion) as AtencionResolucion, count(*) as Numeroregistros FROM encuesta_clientescalidad");
  mysqli_close($conection);
  $result_sqlenc2 = mysqli_num_rows($sqlenc2);

  if($result_sqlenc2 == 0){
    $resp_1 = 0;
    $resp_2 = 0;
    $resp_3 = 0;
    $resp_4 = 0;
    $resp_5 = 0;
    $resp_6 = 0;
    $resp_7 = 0;
    $resp_8 = 0;
    $resp_9 = 0;
    $resp_10 = 0;
    $resp_11 = 0;
    $resp_12 = 0;
    $numreg  = 0;

   
  }else{
    
    $dataenc2 = mysqli_fetch_array($sqlenc2);
    $resp_1 = $dataenc2['ServicioVentas']; 
    $resp_2 = $dataenc2['ServicioTransporte']; 
    $resp_3 = $dataenc2['ServicioOperador']; 
    $resp_4 = $dataenc2['ServicioSupervisor']; 
    $resp_5 = $dataenc2['ServicioOperaciones']; 
    $resp_6 = $dataenc2['AtencionResolucion'];
    $numreg = $dataenc2['Numeroregistros'];
  }
  
  include "../conexion.php";
  $sqledad= mysqli_query($conection,"UPDATE empleados SET edad =  TIMESTAMPDIFF(YEAR,date_nacimiento,CURDATE()) where edad >0");
  mysqli_close($conection);

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

  <script type="text/javascript">
    $(function () {

    var speedCanvas = document.getElementById("grafica2");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var speedData = {
  labels: ["Tiempo Forma", "Tiempo Respuesta", "Disponibiliad", "Calidad", "Asesoria Tec", "Limpieza", "Servicio", "Conduce Adecuado","Atencion", "Facturacion", "Precio"],
  datasets: [{
    label: "Calificacion",
    data: [<?php echo $resp1; ?>, <?php echo $resp2; ?>, <?php echo $resp3; ?>, <?php echo $resp4; ?>, <?php echo $resp5; ?>, <?php echo $resp6; ?>, <?php echo $resp7; ?>, <?php echo $resp8; ?>, <?php echo $resp9; ?>, <?php echo $resp10; ?>, <?php echo $resp11; ?>],
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


 
</head>
<body class="hold-transition layout-top-nav">
  
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE CRM"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

     
      <?php
       if ($_SESSION['rol'] == 1) {
        include('includes/navbar.php');
      }else {
        if ($_SESSION['rol'] == 6) {
          include('includes/navbaroperac.php');
        }else {
          if ($_SESSION['rol'] == 8) {
            include('includes/navbarjefeoper.php');
          }else {
            include('includes/navbar.php'); 
          }  
        }
      } ?>
      <?php include('includes/nav.php') ?> 

    </div>
  </nav>

  <?php
  include "../conexion.php";
  $query2 = mysqli_query($conection,"SELECT rv.cliente, rv.ruta, SUM(IF(rv.planeado=1, rv.valor_vuelta, 0)) AS viajes_planeados, SUM( rv.valor_vuelta) AS viajes_extras, ur.nombres as nombresup, us.nombre, substr(rv.cliente, 1, 1) FROM registro_viajes rv left join supervisores ur ON rv.id_supervisor = ur.idacceso left join clientes ct ON rv.cliente = ct.nombre_corto left join usuario us ON ct.id_supervisor = us.idusuario WHERE rv.semana = 'Semana 01' and rv.estatus = 2 and substr(rv.cliente, 1, 1) BETWEEN 'A' and 'M' group by rv.cliente, rv.ruta order by rv.cliente");
$result2 = mysqli_num_rows($query2);
//$pedido01 = mysqli_fetch_assoc($query2);
$articulo = mysqli_query($conection,"SELECT cliente from registro_viajes where semana = 'Semana 01' and substr(cliente, 1, 1) BETWEEN 'A' and 'M' group by cliente order by cliente ");
$result_articulo = mysqli_num_rows($articulo);
$total_planeados = 0;
$total_registrados = 0;
$total_diferencia = 0;
  
  ?>
 
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
 
    <!-- /.content-header -->

    <!-- Main content -->
      <!-- Content Wrapper. Contains page content -->
   <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-6">
            <div class="card">
            </div>
          </div>    
        </div>
         <div class="row">
          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Viajes por Cliente</h3>
              </div>
              <!-- ./card-header -->
              <div class="card-body p-0">
                <table class="table table-hover">
                  <tbody>
                    
                    <tr >
                      <td>
                        
                        219
                      </td>
                    </tr>
                    <tr class="expandable-body">
                      <td>
                        <div class="p-0">
                         <?php
                         $x = 0;
                         $y = 2;
                         while ($row = mysqli_fetch_assoc($query2)){
                        $grupoant=$articulo;
                        $articulo=$row['cliente'];
                         $diferencia = $row['viajes_extras'] - $row['viajes_planeados'];
                        ?>

                          <table class="table table-hover">
                            <tbody>
                              <?php 
                              if($grupoant != $articulo){

                              ?>
                              <tr data-widget="expandable-table" aria-expanded="false">
                                <th colspan="4">
                                  <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                  <?php echo $row['cliente']; ?>
                                </th>
                           

                              </tr>

                                      <tr class="expandable-body">
                                <td>
                                  <div class="p-0">
                                    <table class="table table-hover">
                                      <tbody>
                                        <tr>
                                          <th>Ruta</th>
                                          <th>Planeados</th>
                                          <th>Registrados</th>
                                          <th>Diferencia</th>
                                        </tr>

                            
                                        <tr>
                                          <td>219-1-2</td>
                                          <td>219-1-3</td>
                                          <td>219-1-4</td>
                                          <td>219-1-4</td>
                                        </tr>


                                        
                                      </tbody>
                                    </table>
                                  </div>
                                </td>
                                
                              </tr>

                               <?php
                            
                            }
                            ?>
                              <tr class="expandable-body">
                                <td>
                                  <div class="p-0">
                                    <table class="table table-hover">
                                   

                                      </tbody>
                                    </table>
                                  </div>
                                </td>
                                
                              </tr>
                             <?php
                        
                           }
                          ?>
                             
                              <tr>
                                <td>Totales</td>
                              </tr>
                            </tbody>
                          </table>
                          
                        </div>
                      </td>
                    </tr>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Resultado de Encuesta de Satisfacción</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"><?php echo $resp12; ?></span>
                    <span>Numero de Respuestas</span>
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

                <div class="position-relative mb-4">
                  <canvas id="grafica2" height="200"></canvas>
                </div>
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
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                  <h3 class="card-title">Resultado de Encuesta de Calidad</h3>
                  <a href="javascript:void(0);">View Report</a>
                </div>
              </div>
              <div class="card-body">
                <div class="d-flex">
                  <p class="d-flex flex-column">
                    <span class="text-bold text-lg"><?php echo $numreg; ?></span>
                    <span>Numero de Respuestas</span>
                  </p>
                  <!--
                  <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 33.1%
                    </span>
                    <span class="text-muted">Since last month</span>
                  </p>-->
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                  <canvas id="densityChart" height="200"></canvas>
                </div>
                <!--
                <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This year
                  </span>

                  <span>
                    <i class="fas fa-square text-gray"></i> Last year
                  </span>
                </div> -->
              </div>
            </div>
            <!-- /.card -->

            <div class="card">
              
              
            </div>
          </div>
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script> 


 <?php

  include "../conexion.php";  
 /*    
// Consulta para obtener la fecha de vencimiento
$sqldate = "SELECT nombre as cliente, fecha_iniciacontrato, fecha_fincontrato FROM clientes WHERE DATE(fecha_fincontrato) < DATE_SUB(NOW(),INTERVAL 30 DAY) and fecha_fincontrato > '2020-01-01'";
$resultado = mysqli_query($conection, $sqldate);

// Verificación del resultado de la consulta
if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
   
    $namecliente = $fila ['cliente'];  
    //$fcha = date("d-m-Y",  $fila['fecha_vencimiento'] );
    $newDate3 = date("d/m/Y", strtotime($fila['fecha_fincontrato']));
       
  ?>  
 
     <script>

     alert('\t Contratos vencidos y/o prontos a vencer. \t \n\t \u00A0 \n\t Cliente: <?php echo $namecliente; ?> \n\t Fecha de vencimiento: <?php echo $newDate3; ?> ')

    </script>
  
    <?php 
    }  

    }else {
     ?>  
  
 
     <script>

     //* alert('\t No Hay contratos por vencer o vencidos')

    </script>
<?php 
    }
*/
?>



<script>
  
 var densityCanvas = document.getElementById("densityChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;

var densityData = {
  label: 'Calificación',
  data: [<?php echo $resp_1; ?>, <?php echo $resp_2; ?>, <?php echo $resp_3; ?>, <?php echo $resp_4; ?>, <?php echo $resp_5; ?>, <?php echo $resp_6; ?>],
   backgroundColor: 'rgba(253, 197, 100, 0.6)',
  borderColor: 'rgba(253, 197, 100, 1)',
};

var barChart = new Chart(densityCanvas, {
  type: 'bar',
  data: {
    labels: ["Servicio Ventas", "Servicio Transporte", "Servicio Operador", "Servicio Supervisor", "Servicio Operaciones", "Atención y Resolución"],
    datasets: [densityData]
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
