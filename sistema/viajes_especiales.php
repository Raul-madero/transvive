<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  

  $sql01= mysqli_query($conection,"SELECT * FROM registro_viajes WHERE estatus= 1 and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' ");
  mysqli_close($conection);
  $result_sql01 = mysqli_num_rows($sql01);

    while ($data = mysqli_fetch_array($sql01)){
      $abiertos   = 0;
     
    }
     date_default_timezone_set('America/Mexico_City');

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

  if ($rol == 1) {
    include "../conexion.php";
    $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter'");
    mysqli_close($conection);
    $result_sql02 = mysqli_num_rows($sql02);

    while ($data = mysqli_fetch_array($sql02)){
      $tareahoy   = $data['viajeshoy'];
     
    }

    include "../conexion.php";
    $sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter'");
    mysqli_close($conection);
    $result_sql03 = mysqli_num_rows($sql03);
  
    while ($data = mysqli_fetch_array($sql03)){
    $tareasem   = $data['totalsem'];
       
    } 
  
  }else {  
    include "../conexion.php";
    $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' and usuario_id = $rol");
    mysqli_close($conection);
    $result_sql02 = mysqli_num_rows($sql02);

    while ($data = mysqli_fetch_array($sql02)){
      $tareahoy   = $data['viajeshoy'];
     
    }
   
    include "../conexion.php";
    $sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' and usuario_id = $rol");
    mysqli_close($conection);
    $result_sql03 = mysqli_num_rows($sql03);
  
    while ($data = mysqli_fetch_array($sql03)){
     $tareasem   = $data['totalsem'];
       
    } 
}
 
 include "../conexion.php";
  $sql04= mysqli_query($conection,"SELECT *  FROM registro_viajes WHERE estatus = 1 and fecha < '$fchaini' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter'");
  mysqli_close($conection);
  $result_sql04 = mysqli_num_rows($sql04);

    while ($data = mysqli_fetch_array($sql04)){
      $tarearetraso   = 0;
     
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
          <h4 class="m-0"> Registro de Servicios Especiales <small></small></h4>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
          <ol class="breadcrumb float-sm-right">
            <?php
             if ($_SESSION['rol'] == 1 ) {

             ?> 
               <li class="breadcrumb-item"><a href="new_viajespecial.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nuevo</a></li>

             <?php }   ?>
            
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
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
        <div class="col-md-1">
          <a href="#" class="btn btn-primary btn-block mb-3">Viajes</a>

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
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
                    Hoy
                    <span class="badge bg-warning float-right"><?php echo $tareahoy;?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                   Sem
                   <span class="badge bg-success float-right"><?php echo $tareasem;?></span>
                  </a>
                </li>
                <!--<li class="nav-item">
                  <a href="tareas_atrasadas.php" class="nav-link">
                    Atrasadas
                    <span class="badge bg-warning float-right">0</span>
                  </a>
                </li>-->
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
        <div class="col-md-11">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Viajes</h3>&nbsp;&nbsp;&nbsp;
              <?php
             if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 9 || $_SESSION['rol'] == 8 ) {

             ?> 
                <a href="new_viajespecial.php"><button class="btn btn-success btn-sm">Crea Nuevo <i class="icon-plus icon-white"></i></button></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <?php }   ?>   
                <a href="factura/viajespecial_excelsp.php"><button class="btn btn-secondary btn-sm">Excel &nbsp;<i class="fas fa-file-excel"></i></button></a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="factura/viajespecial_excelsptodos.php"><button class="btn btn-secondary btn-sm">Excel Todos&nbsp; <i class="fas fa-file-excel"></i></button></a>
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
                          <th>Cliente</th>
                          <th>Direccion</th>
                          <th>Hora Inicio</th>
                          <th>Hora Regreso</th>
                          <th>Tipo Unidad</th>
                          <th>Destino</th>
                          <th>Supervisor</th>
                          <th>Estatus</th>
                          <th>Estatus</th>
                          <th>Estatus</th>
                          <th>Estatus</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>

                       
                       
                      </tbody>
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
   if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 6  ){
?>


<script>
        $( document ).ready(function() {
var table = $('#example1').dataTable({
"order": [[ 0, "desc" ]],
"bProcessing": true,
"sAjaxSource": "data/data_viajesespeciales.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'id', "sWidth": "3%" } ,
{ mData: 'fecha', "sWidth": "5%" } ,
{ mData: 'cliente' ,"sWidth": "10%"},
{ mData: 'direccion' ,"sWidth": "18%"},
{ mData: 'Hinicio' ,"sWidth": "5%"},
{ mData: 'Hfin' ,"sWidth": "5%"},
{ mData: 'unidad' ,"sWidth": "10%"},
{ mData: 'destino' ,"sWidth": "15%"},
{ mData: 'supervisor' ,"sWidth": "10%"},
{ mData: 'costo_viaje' ,"sWidth": "15%"},
{ mData: 'sueldo_vuelta' ,"sWidth": "15%"},
{ mData: 'numero_unidades' ,"sWidth": "15%"},
{ mData: 'Status' ,"sWidth": "8%"},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" style="color:#007bff;" href= \'edit_viajespecial.php?id=' + full.id +  '\'><i class="far fa-edit"></i></a>&nbsp;|&nbsp;<a href="#" data-toggle="modal" data-target="#modalCopiaViaje" data-id=\''+ full.id + '\' href="#" class="link_delete" style="color:#1398A1" ><i class="fa fa-copy"></i></a>&nbsp;|&nbsp<a id="delete_viaje" data-id=\'' + full.id + '\' href="javascript:void(0)" class="link_delete" style="color:red" ><i class="fa fa-eraser"></i></a>&nbsp;|&nbsp<a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id=\''+ full.id + '\' href="#" class="link_delete" style="color:#94456E" ><i class="fa fa-close"></i></a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="#" data-toggle="modal" data-target="#modalEditcliente" data-id=\'' + full.id  + '\' data-costo=\'' + full.costo_viaje  + '\' data-fcha=\'' + full.fecha  + '\' data-sueldo=\'' + full.sueldo_vuelta  + '\' data-unidades=\'' + full.numero_unidades  + '\' data-direcc=\'' + full.direccion  + '\' data-destino=\'' + full.destino  + '\' href="#" class="link_delete" style="color:#1D8707" ><i class="fa fa-rotate-left"></a>';
    }
                    
            
 }


],
"columnDefs":[
    {
        "targets": [8,9,10,11],
        "visible": false,
    }            
     
],

        "oLanguage": {
        "sEmptyTable": "No hay registros disponibles",
        "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
        "sLoadingRecords": "Por favor espera - Cargando...",
        "sSearch": "Buscar:",
        "sLengthMenu": "Mostrar _MENU_",
        "oPaginate": {
        "sFirst": "Primera",
        "sPrevious": "Previa",
        "sNext": "Siguiente",
        "sLast": "Ultima",
      }
        }


       
});
});
        
</script>

<?php }else {
   if($_SESSION['rol'] == 4 || $_SESSION['rol'] == 8 ){
?>

<script>
        $( document ).ready(function() {
var table = $('#example1').dataTable({
"bProcessing": true,
"sAjaxSource": "data/data_viajesespeciales.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"fixedHeader": true,
"responsive": true,
"aoColumns": [
{ mData: 'id', "sWidth": "3%" },
{ mData: 'Fcha', "sWidth": "5%" } ,
{ mData: 'cliente' ,"sWidth": "20%"},
{ mData: 'direccion' ,"sWidth": "20%"},
{ mData: 'Hinicio' ,"sWidth": "5%"},
{ mData: 'Hfin' ,"sWidth": "5%"},
{ mData: 'unidad' ,"sWidth": "15%"},
{ mData: 'destino' ,"sWidth": "20%"},
{ mData: 'supervisor' ,"sWidth": "20%"},
{ mData: 'costo_viaje' ,"sWidth": "15%"},
{ mData: 'sueldo_vuelta' ,"sWidth": "15%"},
{ mData: 'numero_unidades' ,"sWidth": "15%"},
{ mData: 'Status' ,"sWidth": "20%"},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" style="color:#007bff;" href= \'editsup_viajespecial.php?id=' + full.id +  '\'><i class="far fa-edit"></i> Registrar</a>';
    }
                    
            
 } 

],

"columnDefs":[
    {
        "targets": [8,9,10,11],
        "visible": false,
    }            
     
],

        "oLanguage": {
        "sEmptyTable": "No hay registros disponibles",
        "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
        "sLoadingRecords": "Por favor espera - Cargando...",
        "sSearch": "Buscar:",
        "sLengthMenu": "Mostrar _MENU_",
        "oPaginate": {
        "sFirst": "Primera",
        "sPrevious": "Previa",
        "sNext": "Siguiente",
        "sLast": "Ultima",
      }
        }


       
});
});
        
</script>


<script>

  </script>

<?php }else {
   if($_SESSION['rol'] == 9 ){
?>

<script>
        $( document ).ready(function() {
var table = $('#example1').dataTable({
"bProcessing": true,
"sAjaxSource": "data/data_viajesespeciales.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"fixedHeader": true,
"responsive": true,
"aoColumns": [
{ mData: 'id', "sWidth": "3%" } ,
{ mData: 'fecha', "sWidth": "5%" } ,
{ mData: 'cliente' ,"sWidth": "10%"},
{ mData: 'direccion' ,"sWidth": "18%"},
{ mData: 'Hinicio' ,"sWidth": "5%"},
{ mData: 'Hfin' ,"sWidth": "5%"},
{ mData: 'unidad' ,"sWidth": "10%"},
{ mData: 'destino' ,"sWidth": "15%"},
{ mData: 'supervisor' ,"sWidth": "10%"},
{ mData: 'costo_viaje' ,"sWidth": "15%"},
{ mData: 'sueldo_vuelta' ,"sWidth": "15%"},
{ mData: 'numero_unidades' ,"sWidth": "15%"},
{ mData: 'Status' ,"sWidth": "8%"},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" style="color:#007bff;" href= \'editgcia_viajespecial.php?id=' + full.id +  '\'><i class="far fa-edit"></i> Registrar/Editar</a>';
    }
                    
            
 } 

],

"columnDefs":[
    {
        "targets": [8,9,10,11],
        "visible": false,
    }            
     
],

        "oLanguage": {
        "sEmptyTable": "No hay registros disponibles",
        "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
        "sLoadingRecords": "Por favor espera - Cargando...",
        "sSearch": "Buscar:",
        "sLengthMenu": "Mostrar _MENU_",
        "oPaginate": {
        "sFirst": "Primera",
        "sPrevious": "Previa",
        "sNext": "Siguiente",
        "sLast": "Ultima",
      }
        }


       
});
});
        
</script>

<?php }} }?>

<script>
        $( document ).ready(function() {
var table = $('#listaClientes').dataTable({
"bProcessing": true,
"sAjaxSource": "data/data_clientes.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"aoColumns": [
{ mData: 'Empid' } ,
{ mData: 'Name' },
{ mData: 'Salary' },
{ mData: 'Linea' },
{ mData: 'Lugar'},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" href= \'editar_cliente.php?id=' + full.Empid +  '\'><i class="far fa-edit"></i> Editar</a> | <a id="delete_cliente" data-id=\'' + full.Name +  '\' href="javascript:void(0)" class="link_delete" ><i class="far fa-trash-alt"></i> Borrar</a>';
    }
                    
            
 }                   

],

        "oLanguage": {
        "sEmptyTable": "No hay registros disponibles",
        "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
        "sLoadingRecords": "Por favor espera - Cargando...",
        "sSearch": "Buscar:",
        "sLengthMenu": "Mostrar _MENU_",
        
        }

       
});
});
        
            </script>

<script type="text/javascript">


/* it will load products when document loads */

$(document).on('click', '#delete_viaje', function(e){

e.preventDefault();
      var viajeId = $(this).data('id');
       var action = 'infoBorraViaje';
       swal({
 title: "Desea Borrar el Registro del Viaje ?",
 text: "No. ID: " + viajeId,
 icon: "warning",
 buttons: true,
 dangerMode: true,
})
.then((willDelete) => {
 if (willDelete) {
   $.ajax({
           url: 'includes/ajax.php',
           type: "POST",
           async : true,
           data: {action:action,viajeId:viajeId},
           success: function(response)
           {
               if(response != 0){
                   swal('Eliminado','Viaje Borrado Correctamente','success').then((value) => {
                   location.reload();
})
                 
               }else{
                   swal("Poof! Error!", {
     icon: "warning",
   });
               
                  
               }
           },
           error: function(error) {

           }

       });

  
 } else {
   swal("Accion Cancelada Tarea no Cerrada !");
 }
});
       
       

        }); 
   
</script>
<script> 
  $(document).ready(function (e) {
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     var costoa = $(e.relatedTarget).data().costo;
     var fchaa  = $(e.relatedTarget).data().fcha;
     var sdovta = $(e.relatedTarget).data().sueldo;
     var nunida = $(e.relatedTarget).data().unidades;
     var direc  = $(e.relatedTarget).data().direcc;
     var desti  = $(e.relatedTarget).data().destino;
     
    
      $(e.currentTarget).find('#form_pass_idc').val(idi);
      $(e.currentTarget).find('#inputCostov').val(costoa);
      $(e.currentTarget).find('#form_pass_dfinal').val(fchaa);
      $(e.currentTarget).find('#form_pass_sueldovta').val(sdovta);
      $(e.currentTarget).find('#form_pass_nounidades').val(nunida);
      $(e.currentTarget).find('#form_pass_origen').val(desti);
      $(e.currentTarget).find('#form_pass_destino').val(direc);
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Registrar Vuelta</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_idc" name="form_pass_idc" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Final:</label>
           <div class="col-sm-9">
              <input type="date" class="form-control" id="form_pass_dfinal" name="form_pass_dfinal">
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Hora de Regreso:</label>
           <div class="col-sm-9">
              <input type="time" class="form-control" id="form_pass_hregreso" name="form_pass_hregreso">
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Operador:</label>
           <div class="col-sm-9">
              <input type="number" step="any" class="form-control" id="form_pass_sueldovta" name="form_pass_sueldovta">
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Origen:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_origen" name="form_pass_origen" >
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Destino:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_destino" name="form_pass_destino" >
           </div>
        </div> 

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Numero Unidades:</label>
           <div class="col-sm-9">
              <input type="number" class="form-control" id="form_pass_nounidades" name="form_pass_nounidades" >
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Costo:</label>
           <div class="col-sm-9">
              <input type="number" step="any" class="form-control" id="inputCostov" name="inputCostov" value="0">
           </div>
        </div> 
       
 

        <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Registra Vuelta</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var idc       = $('#form_pass_idc').val();
        var datefin   = $('#form_pass_dfinal').val();
        var hregreso  = $('#form_pass_hregreso').val();
        var sueldovta = $('#form_pass_sueldovta').val(); 
        var origen    = $('#form_pass_origen').val();
        var destino   = $('#form_pass_destino').val();
        var unidades  = $('#form_pass_nounidades').val();
        var costo     = $('#inputCostov').val();


       var action       = 'AddEditVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idc:idc, datefin:datefin, hregreso:hregreso, sueldovta:sueldovta, origen:origen, destino:destino, unidades:unidades, costo:costo},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            alert('Vuelta Registrada Correctamente');

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            
    
                        }else{
                           console.log('no data');
                           alert('faltan datos');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>  


<script> 
  $(document).ready(function (e) {
  $('#modalCancelViaje').on('show.bs.modal', function(e) { 

     var idc    = $(e.relatedTarget).data().id;
  
    
      $(e.currentTarget).find('#form_pass_idcc').val(idc);
 
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalCancelViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Cancelar Vuelta</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_idcc" name="form_pass_idcc" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Motivo de Cancelación:</label>
           <div class="col-sm-9">
             <textarea class="form-control" rows="1" id="comentarios" name="comentarios"></textarea>
           </div>
        </div>  

   
       
 

        <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaVuelta"><i class="fa fa-save"></i>&nbsp;Cancelar Vuelta</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaVuelta').click(function(e){
        e.preventDefault();

        var idcc      = $('#form_pass_idcc').val();       
        var motivoc   = $('#comentarios').val();

       var action       = 'AddCancelaVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idcc:idcc, motivoc:motivoc},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            alert('Cancelación Registrada Correctamente');

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            
    
                        }else{
                           console.log('no data');
                           alert('faltan datos');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>  

<script> 
  $(document).ready(function (e) {
  $('#modalCopiaViaje').on('show.bs.modal', function(e) { 

     var idcp    = $(e.relatedTarget).data().id;
  
    
      $(e.currentTarget).find('#form_pass_idcp').val(idcp);
 
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalCopiaViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Copia Vuelta</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_idcp" name="form_pass_idcp" disabled>
           </div>
        </div> 
        

        <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="copiaVuelta"><i class="fa fa-save"></i>&nbsp;Copiar Vuelta</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#copiaVuelta').click(function(e){
        e.preventDefault();

        var idcp      = $('#form_pass_idcp').val();       
       

       var action       = 'AddCopiaVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idcp:idcp},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            
                           
                            alert('Vuelta Copiada  Correctamente');

                            $('#modalCopiaViaje').modal('hide')
                            location.reload(true);
                            
    
                        }else{
                           console.log('no data');
                           alert('faltan datos');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>           
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
