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

  $sql= mysqli_query($conection,"SELECT semana, dia_inicial, dia_final FROM semanas WHERE dia_inicial <= '$fechaActual' AND dia_final >= '$fechaActual'");
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
  $sql04= mysqli_query($conection,"SELECT *  FROM registro_viajes WHERE estatus = 1 and fecha < '$fchaini' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' or tipo_viaje = 'Semidomiciliadas'");
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
       if ($_SESSION['rol'] == 4) {
        include('includes/navbarsup.php');
      }else {
        if ($_SESSION['rol'] == 6) {
          include('includes/navbaroperac.php');
        }else {
      include('includes/navbar.php'); 
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
          <h4 class="m-0"> Ultimos Viajes <small>Cargados (Planeación) </small></h4>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="new_viaje.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nuevo</a></li>
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
   
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title"></h3>&nbsp;&nbsp;&nbsp;
                <a href="#" id="llenarTablanomina"><button class="btn btn-primary">Cargar a Viajes Planeados<i class="icon-plus icon-white"></i></button></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#"><button type="submit" class="btn btn-danger" id="delete_cliente">Borrar Viajes Cargados</button></a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="index.php"><button type="submit" class="btn btn-secondary" id="#">Cerrar</button></a>
              </div>

              <div class="col-md-12">
              <div class="card">      
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-striped table-bordered table-condensed" style="width:100%"> 
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Fecha</th>
                          <th>Semana</th>
                          <th>Cliente</th>
                          <th>Operador</th>
                          <th>Tipo Unidad</th>
                          <th>No. Eco.</th>
                          <th>Ruta</th>
                          <th>Supervisor</th>
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
   if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 6){
?>


<script>
        $( document ).ready(function() {
var table = $('#example1').dataTable({
"order": [[ 0, "asc" ]],
"bProcessing": true,
"sAjaxSource": "data/data_viajestemp.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'Id', "sWidth": "5px" } ,
{ mData: 'Datereg', "sWidth": "5px" } ,
{ mData: 'semana', "sWidth": "10px" } ,
{ mData: 'cliente' ,"sWidth": "150px"},
{ mData: 'operador' ,"sWidth": "200px"},
{ mData: 'unidad' ,"sWidth": "80px"},
{ mData: 'num_unidad' ,"sWidth": "50px"},
{ mData: 'ruta' ,"sWidth": "100px"},
{ mData: 'nombre' ,"sWidth": "100px"},


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
   if($_SESSION['rol'] == 4 ){
?>

<script>
        $( document ).ready(function() {
var table = $('#example1').dataTable({
"order": [[ 0, "desc" ]],
"bProcessing": true,
"sAjaxSource": "data/data_viajes.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'Id', "sWidth": "5%" } ,
{ mData: 'fecha', "sWidth": "5%" } ,
{ mData: 'cliente' ,"sWidth": "20%"},
{ mData: 'operador' ,"sWidth": "20%"},
{ mData: 'unidad' ,"sWidth": "10%"},
{ mData: 'num_unidad' ,"sWidth": "15%"},
{ mData: 'Status' ,"sWidth": "10%"},
{
                    "render": function ( data, type, full, meta ) {
        return ' ';
    }
                    
            
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

<?php }} ?>

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
        return '<a class="link_edit" href= \'edit_viaje.php?id=' + full.Empid +  '\'><i class="far fa-edit"></i> Editar</a> | <a id="delete_cliente" data-id=\'' + full.Name +  '\' href="javascript:void(0)" class="link_delete" ><i class="far fa-trash-alt"></i> Borrar</a>';
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

$(document).on('click', '#delete_cliente', function(e){

e.preventDefault();
      
       var action = 'infoBorraRegistros';
       swal({
 title: "Desea Borrar los Registros ?",
 text: "",
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
           data: {action:action},
           success: function(response)
           {
               if(response != 0){
                   swal('Eliminado','Registros Borrados Correctamente','success').then((value) => {
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
   swal("Accion Cancelada Registros no Borrados !");
 }
});
       
       

        }); 
   
</script>

 <script>
   $('#llenarTablanomina').click(function(e){
        e.preventDefault();

        //var semana = document.getElementById("semana").value;
  
       var action       = 'CargaRegistroViajes';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                           alert('VIAJES CARGADOS CORRECTAMENTE');
                            location.reload();
                            //$('#modalFactura').modal('hide');
                            //$('#detalle_nomina').html(info.detalle);
                             
                        }else{
                           console.log('no data');
                           alert('Error');
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
