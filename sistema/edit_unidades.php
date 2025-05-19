<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  //Mostrar Datos
  if(empty($_REQUEST['id']))
  {
    header('Location: unidades.php');
    mysqli_close($conection);
  }
  $idunidad = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM unidades WHERE id = $idunidad");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: unidades.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id           = $data['id'];
      $nounidad     = $data['no_unidad'];
      $socio        = $data['socio'];
      $describe     = $data['descripcion'];
      $placas       = $data['placas'];
      $noserie      = $data['no_serie'];
      $year         = $data['year'];
      $tipogas      = $data['tipo_combustible'];
      $nopoliza     = $data['no_poliza'];
      $aseguradora  = $data['aseguradora'];
      $iniciapol    = $data['inicio_poliza'];
      $terminapol   = $data['fin_poliza'];
      $tarjetacir   = $data['tarjeta_circulacion'];
      $vencetarjeta = $data['vence_tcirculacion'];
      $fechaentrega = $data['fecha_entregadoc'];
      $notas        = $data['notas'];
      $parametro    = $data['rendimiendo_estandar'];
      $archivo      = $data['archivo'];
      
      //$user   = $_SESSION['idUser'];

      $archivoact = $data['archivo'];
      $archivotar = $data['archivo_tarjetac'];
      $archivoper = $data['archivo_permiso'];
      
    }
  }

  if ($rol == 7 || $rol == 10 || $rol == 1 || $rol == 18) {
    $visible = "";
  }else {
    $visible = "readonly";
  }


  /*$sqledo = "select estado from estados ORDER BY estado";
  $queryedo = mysqli_query($conection, $sqledo);
  $filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); */
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

      <?php include('includes/generalnavbar.php'); ?>
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
          
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="unidades.php">Unidades</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edición de Unidad</h3>
              </div>
              <div class="card-body">
              <div class="card-header p-2">
              <!-- /.card-header -->
              <!-- form start -->
                <form action="update_unidades.php" method="post" enctype="multipart/form-data">
              <div class="form-group row">
                    <div class="col-sm-10">
                    </div>
                  </div>
              
<input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id; ?>">
<input type="hidden" name="foto01" id="foto01" value="<?php echo $foto; ?>">
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Unidad</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNounidad" name="inputNounidad" placeholder="Ejemplo T-01" value="<?php echo $nounidad; ?>">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Socio</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSocio" name="inputSocio" value="<?php echo $socio; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Descripcion</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputDescribe" name="inputDescribe" value="<?php echo $describe; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Placas</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputPlacas" name="inputPlacas" value="<?php echo $placas; ?>">
                    </div>
                 
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Numero de Serie</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputNserie" name="inputNserie" value="<?php echo $noserie; ?>">
                    </div>
                  </div>



                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Año</label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="inputYear" name="inputYear" value="<?php echo $year; ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo Combustible</label>
                    <div class="col-sm-4">
                      <select class="form-control" id="inputTipogas" name="inputTipogas">
                          <option value="<?php echo $tipogas; ?>"><?php echo $tipogas; ?></option>
                          <option value="GASOLINA">GASOLINA</option>
                          <option value="DIESEL">DIESEL</option>
                        </select>
                    </div>
                  </div>


                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Numero de Poliza</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNopoliza" name="inputNopoliza" value="<?php echo $nopoliza; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Aseguradora</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputAseguradora" name="inputAseguradora" value="<?php echo $aseguradora; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Inicio Poliza</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputIniciopol" name="inputIniciopol" value="<?php echo $iniciapol; ?>">
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fin Poliza</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFinpol" name="inputFinpol" value="<?php echo $terminapol; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tarjeta Circulación</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputTarjetac" name="inputTarjetac" value="<?php echo $tarjetacir; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Fecha Vence Tarjeta Circulación</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" id="inputVencetar" name="inputVencetar" value="<?php echo $vencetarjeta; ?>">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-4 col-form-label">Fecha Entrega Documentos</label>
                    <div class="col-sm-8">
                      <input type="date" class="form-control" id="inputEntregadoc" name="inputEntregadoc" value="<?php echo $fechaentrega; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Parametro</label>
                    <div class="col-sm-10">
                      <input type="number" step="any" class="form-control" id="inputRestandar" name="inputRestandar" value="<?php echo $parametro; ?>" <?php echo $visible; ?>>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNotas" name="inputNotas" value="<?php echo $notas; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Poliza</label>
                     <div class="col-sm-10">
                     <input class="form-control prevPhoto" type="file" name="archivo" value="<?php echo $archivoact; ?>"/>
                </div>
             </div>

               <p><?php echo $archivoact; ?></p>
               <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tarjeta de circulación</label>
                     <div class="col-sm-10">
                     <input class="form-control prevPhoto" type="file" name="archivo_tarjetac" value="<?php echo $archivotar; ?>"/>
                </div>
             </div>
                <p><?php echo $archivotar; ?></p>

                <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Permisos</label>
                     <div class="col-sm-10">
                     <input class="form-control prevPhoto" type="file" name="archivo_permisos" value="<?php echo $archivoper; ?>"/>
                </div>
             </div>
                <p><?php echo $archivoper; ?></p>


                <!-- /.card-body -->
                <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10" style="text-align:right;">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;  
                          <input type="submit"  class="btn btn-success pull-right" value="Guardar" >
                        </div>
                      </div>
                <!-- /.card-footer -->
              </form>
            </div>
     </div>
     </div>
     
</center>

   
  
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
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->
<script>

$('#btn_salir').click(function(e){
        e.preventDefault();

            
        Swal
    .fire({
        title: "DESEA SALIR!",
        text: "",
        icon: 'info',

        showCancelButton: true,
        confirmButtonText: "Regresar",
        cancelButtonText: "Salir",
       

       
    })
     .then(resultado => {
        if (resultado.value) {
            // Hicieron click en "Sí"
             //*location.href = 'motivo_perdida.php';
             console.log("Alerta cerrada");
        } else {
            // Dijeron que no
            //*location.reload();
            location.href = 'unidades.php';
        }
    });

   

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var idu          = $('#inputId').val();
       var nounidad     = $('#inputNounidad').val();
       var socio        = $('#inputSocio').val();
       var descripcion  = $('#inputDescribe').val();
       var nplacas      = $('#inputPlacas').val();
       var nserie       = $('#inputNserie').val();
       var year         = $('#inputYear').val();
       var tipogas      = $('#inputTipogas').val();
       var nopoliza     = $('#inputNopoliza').val();
       var aseguradora  = $('#inputAseguradora').val();
       var iniciapol    = $('#inputIniciopol').val();
       var terminapol   = $('#inputFinpol').val();
       var notarjeta    = $('#inputTarjetac').val();  
       var vencetarjeta = $('#inputVencetar').val();
       var entregadoc   = $('#inputEntregadoc').val();
       var restandar    = $('#inputRestandar').val();
       var notas        = $('#inputNotas').val();

       var action       = 'AlmacenaEditUnidad';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idu:idu, nounidad:nounidad, socio:socio, descripcion:descripcion, nplacas:nplacas, nserie:nserie, year:year, tipogas:tipogas, nopoliza:nopoliza, aseguradora:aseguradora, iniciapol:iniciapol, terminapol:terminapol, notarjeta:notarjeta, vencetarjeta:vencetarjeta, entregadoc:entregadoc, restandar:restandar, notas:notas},

                    success: function(response)
                    {
               console.log(response);
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>  
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
