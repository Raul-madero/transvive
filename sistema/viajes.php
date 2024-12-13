<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $idUser = $_SESSION['idUser'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sql01= mysqli_query($conection,"SELECT * FROM registro_viajes WHERE estatus= 1");
  mysqli_close($conection);
  $result_sql01 = mysqli_num_rows($sql01);

    // while ($data = mysqli_fetch_array($sql01)){
    //   $abiertos   = 0;
     
    // }
     date_default_timezone_set('America/Mexico_City');

    $fechaActual = date("Y-m-d");
    $fcha1 = date("Y-m-d",strtotime ( '-1 day' , strtotime ( $fechaActual ) ) );
    $newDate = date("d-m-Y", strtotime($fcha1));  


  $fcha = date("Y-m-d"); 
  $diafcha = date("w");
  $diasrest = 6 - $diafcha;
//   $fchaini = date("Y-m-d",strtotime($fcha."- $diafcha days")); 
//   $fchafin = date("Y-m-d",strtotime($fcha."+ $diasrest days")); 
  include "../conexion.php";

  $sql= mysqli_query($conection,"SELECT semana, dia_inicial, dia_final FROM semanas40 WHERE dia_inicial <= '$fechaActual' AND dia_final >= '$fechaActual'");
         mysqli_close($conection);
         $result = mysqli_num_rows($sql);
         

         while ($data = mysqli_fetch_array($sql)){
         $diainicial  = $data['dia_inicial'];
         $diafinal    = $data['dia_final'];
     
      
      //$user   = $_SESSION['idUser'];
      
    }

  if ($rol == 1) {
      include "../conexion.php";
  $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual' and tipo_viaje <> 'Especial'");
  mysqli_close($conection);
  $result_sql02 = mysqli_num_rows($sql02);

    while ($data = mysqli_fetch_array($sql02)){
      $tareahoy   = $data['viajeshoy'];
        
  }
  
  }else {  
  include "../conexion.php";
  $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual' and tipo_viaje = 'Especial' and usuario_id = $idUser");
  mysqli_close($conection);
  $result_sql02 = mysqli_num_rows($sql02);

    while ($data = mysqli_fetch_array($sql02)){
      $tareahoy   = $data['viajeshoy'];
     
  }
  } 

if ($rol == 1) {  

include "../conexion.php";
$sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' and tipo_viaje = 'Especial' ");
mysqli_close($conection);
$result_sql03 = mysqli_num_rows($sql03);
  
 while ($data = mysqli_fetch_array($sql03)){
   $tareasem   = $data['totalsem'];
       
 } 
}else {

  Include "../conexion.php";
$sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' and tipo_viaje = 'Especial' and usuario_id = $rol ");
mysqli_close($conection);
$result_sql03 = mysqli_num_rows($sql03);
  
 while ($data = mysqli_fetch_array($sql03)){
   $tareasem   = $data['totalsem'];
       
 } 
}

 
 include "../conexion.php";
  $sql04= mysqli_query($conection,"SELECT *  FROM registro_viajes WHERE estatus = 1 and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' or tipo_viaje = 'Semidomiciliadas'");
  mysqli_close($conection);
  $result_sql04 = mysqli_num_rows($sql04);

    while ($data = mysqli_fetch_array($sql04)){
      $tarearetraso   = 0;
     
  } 

  include "../conexion.php";
  $sqlviajes= mysqli_query($conection,"SELECT count(tipo_viaje) as normales from registro_viajes WHERE tipo_viaje = 'Normal' and fecha = '$fcha1' and planeado = 1");
  mysqli_close($conection);
  $result_sqlviajes = mysqli_num_rows($sqlviajes);

    while ($datav = mysqli_fetch_array($sqlviajes)){
      $normales   = $datav['normales'];
      //$especiales   = 0;
     
  } 

  include "../conexion.php";
  $sqlviajesreg= mysqli_query($conection,"SELECT sum(valor_vuelta) as viajes_normales from registro_viajes WHERE tipo_viaje = 'Normal' and fecha = '$fcha1' and valor_vuelta >0 and planeado = 1");
  mysqli_close($conection);
  $result_sqlviajesreg = mysqli_num_rows($sqlviajesreg);

    while ($datareg = mysqli_fetch_array($sqlviajesreg)){
      $normalesreg   = $datareg['viajes_normales'];
      //$especiales   = $datav['viajes_especiales'];
     
  } 

  include "../conexion.php";
  $sqlviajespec= mysqli_query($conection,"SELECT sum(valor_vuelta) as especiales from registro_viajes WHERE tipo_viaje = 'Especial' and fecha = '$fcha1' ");
  mysqli_close($conection);
  $result_sqlviajespec = mysqli_num_rows($sqlviajespec);

    while ($datavs = mysqli_fetch_array($sqlviajespec)){
      $especiales   = $datavs['especiales'];
      //$especiales   = 0;
     
  } 

  include "../conexion.php";
  $sqlviajesregesp= mysqli_query($conection,"SELECT sum(valor_vuelta) as viajes_especiales from registro_viajes WHERE tipo_viaje = 'Especial' and fecha = '$fcha1' and valor_vuelta >0");
  mysqli_close($conection);
  $result_sqlviajesregesp = mysqli_num_rows($sqlviajesregesp);

    while ($dataregesp = mysqli_fetch_array($sqlviajesregesp)){
      $especialesreg   = $dataregesp['viajes_especiales'];
      //$especiales   = $datav['viajes_especiales'];  
  } 

   include "../conexion.php";
  $sqlviajesplan= mysqli_query($conection,"SELECT sum(valor_vuelta) as viajes_planeados FROM registro_viajes WHERE fecha= '$fcha1' and tipo_viaje='Normal' and planeado = 1 ");

  mysqli_close($conection);
  $result_sqlviajesplan = mysqli_num_rows($sqlviajesplan);

    while ($dataplan = mysqli_fetch_array($sqlviajesplan)){
      $planeados   = $dataplan['viajes_planeados'];
      //$especiales   = $datav['viajes_especiales'];
     
  } 

   include "../conexion.php";
  $sqlviajesextra= mysqli_query($conection,"SELECT sum(valor_vuelta) as viajes_extras from registro_viajes WHERE tipo_viaje = 'Normal' and fecha = '$fcha1' and planeado = 0 and valor_vuelta > 0");
  mysqli_close($conection);
  $result_sqlviajesextra = mysqli_num_rows($sqlviajesextra);

    while ($dataextra = mysqli_fetch_array($sqlviajesextra)){
      $extras   = $dataextra['viajes_extras'];
      //$especiales   = $datav['viajes_especiales'];
     
  } 

   include "../conexion.php";
  $sqlviajescanc= mysqli_query($conection,"SELECT count(valor_vuelta) as viajes_cancelados from registro_viajes WHERE tipo_viaje = 'Normal' and fecha = '$fcha1' and estatus = 3 ");
  mysqli_close($conection);
  $result_sqlviajescanc = mysqli_num_rows($sqlviajescanc);

    while ($datacanc = mysqli_fetch_array($sqlviajescanc)){
      $cancelados   = $datacanc['viajes_cancelados'];
      //$especiales   = $datav['viajes_especiales'];
     
  } 



  //*include "../conexion.php";
  //*$sqledo = "select estado from estados ORDER BY estado";
  //*$queryedo = mysqli_query($conection, $sqledo);
  //*$filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); 

 
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
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
       if ($_SESSION['rol'] == 4) {
        include('includes/navbarsup.php');
      }else {
        if ($_SESSION['rol'] == 6) {
          include('includes/navbaroperac.php');
        }else {
          if ($_SESSION['rol'] == 8) {
            include('includes/navbarjefeoper.php');
          }else {
            if ($_SESSION['rol'] == 9) {
              include('includes/navbargrcia.php');
            }else {
              include('includes/navbar.php'); 
            }
          }  
        }
      } ?>
      <?php include('includes/nav.php') ?> 

    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
 
    <!-- /.content-header -->

    <!-- Main content -->
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <h4 class="m-0"> Registro de Viajes <small></small></h4>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
          <ol class="breadcrumb float-sm-right">
            <?php
             if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 9 ) {

             ?> 
            <li class="breadcrumb-item"><a href="new_viaje.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nuevo</a></li>
            <?php }   ?>
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Navegacion</li>
            </ol>
          </div>
        </div>
      </div>
    </section>


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   

    <!-- Main content -->
    <section class="content">
      <div class="row">
            <div class="col-md-2">
          <a href="#" class="btn btn-primary btn-block mb-3">Viajes</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title"><?php echo $newDate;?></h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" id="refresh">
                  <i class="fa fa-refresh" style="font-size:24px;"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <!--<li class="nav-item active">
                  <a href="tareas.php" class="nav-link">
                    Tareas Abiertas
                    <span class="badge bg-primary float-right">0</span>
                  </a>
                </li>-->
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Planeados
                    <span class="badge bg-warning float-right"><?php echo $normales;?></span>
                  </a>
                  <a href="#" class="nav-link">
                    Registrados
                    <span class="badge bg-secondary float-right"><?php echo $normalesreg;?></span>
                  </a>
                  
                  <a href="#" class="nav-link">
                    No Planeados
                    <span class="badge bg-success float-right"><?php echo $extras;?></span>
                  </a>

                  <a href="#" class="nav-link">
                    Cancelados
                    <span class="badge bg-danger float-right"><?php echo $cancelados;?></span>
                  </a>

                  <a href="#" class="nav-link"></a>
                </li>
                
                <li class="nav-item">
                  <a href="#" class="nav-link">
                   Especiales
                   <span class="badge bg-warning float-right"><?php echo $especiales;?></span>
                  </a>
                  <a href="#" class="nav-link">
                    Especiales Reg.
                    <span class="badge bg-secondary float-right"><?php echo $especialesreg;?></span>
                  </a>
                  <a href="#" class="nav-link"></a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link"></a>
                  <center>
                      <a href="#"  class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalEditPeriodo2"> Detalle del Día</a>
                  </center>
                    <a href="#" class="nav-link"></a>
                </li>
                <!--<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-trash-alt"></i> Mas...
                  </a>
                </li>-->
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          
          <!-- /.card -->
        </div>
 
      
        <!-- /.col -->
        <div class="col-md-10">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Viajes</h3>&nbsp;&nbsp;&nbsp;
              <?php
             if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 9 ) {

             ?> 
                <a href="new_viaje.php"><button class="btn btn-success btn-sm">Crea Nuevo <i class="icon-plus icon-white"></i></button></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <?php }   ?>   
                <a href="factura/viajes_excel.php"><button class="btn btn-secondary btn-sm">Excel &nbsp;<i class="fas fa-file-excel"></i></button></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="factura/viajes_exceltodos.php"><button class="btn btn-secondary btn-sm">Excel Todos&nbsp; <i class="fas fa-file-excel"></i></button></a>
              </div>

               
              <div class="col-md-12">
              <div class="card">      
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="display table-bordered table-striped" style="width:100%">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Fecha</th>
                          <th>Hora Inicio</th>
                          <th>Hora Llegada</th>
                          <th>Semana</th>
                          <th>Cliente</th>
                          <th>Operador</th>
                          <th>Tipo Unidad</th>
                          <th>No. Eco.</th>
                          <th>Supervisor</th>
                          <th>Jefe Operaciones</th>
                          <th>Estatus</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>

                       
                       
                      </tbody>
                              </table>

               <table class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr>
                <th style="text-align: center">ID</th>
                <th style="text-align: center">Fecha</th>
                <th style="text-align: center">H.Inicio</th>
                <th style="text-align: center">H. Llegada</th>
                <th style="text-align: center">Semana</th>
                <th style="text-align: center">Cliente</th>
                <th style="text-align: center">Operador</th>
                <th style="text-align: center">T. Unidad</th>
                <th style="text-align: center">No. Eco.</th>
                
              </tr>
            </thead>
          </table>                
              </div>
              <!-- /.card-body -->
            </div>
              </div>
              <!-- /.card-tools -->
            
            <!-- /.card-header -->
            <div class="card-body p-0">
              
              <div class="table-responsive mailbox-messages">
              <table>
              </table> 
                <!-- /.table -->
              </div>
              <!-- /.mail-box-messages -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer p-0">
              
            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
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
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

<script src="js/sweetalert2.all.min.js"></script>   
<!-- Page specific script -->


<script src="js/sweetalert.min.js"></script>
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
</body>
</html>
