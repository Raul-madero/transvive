<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];
   if (!isset($_SESSION['idUser'])) {
  header('Location: ../index.php');
}

//Mostrar Datos
  if(empty($_REQUEST['id']))
  {
    header('Location: propiedades_cp.php');
    mysqli_close($conection);
  }
  $idsol = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM propeidades WHERE id = $idsol /*and estatus = 1*/");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: propiedades_cp.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id            = $data['id'];
      $f_entrega     = $data['fecha_entrega'];
      $empresa       = $data['empresa'];
      $rep_empresa   = $data['representa_empresa'];
      $direccion     = $data['direccion'];
      $phone         = $data['telefonos'];
      $email         = $data['correo'];
      $bienentrega   = $data['bien_entregado'];
      $caracterisc   = $data['caracteristicas'];
      $utilizaseen   = $data['utilizarse_en'];
      $identifica    = $data['identificacion'];
      $verifica      = $data['verificacion'];
      $proteccion    = $data['proteccion'];
      $salvaguarda   = $data['salvaguardar'];
      $nombre1       = $data['nombre1'];
      $puesto1       = $data['puesto1'];
      $tel_correo1   = $data['telefono_correo1'];
      $nombre2       = $data['nombre2'];
      $puesto2       = $data['puesto2'];
      $tel_correo2   = $data['telefono_correo2'];
      $emp_recibe    = $data['empresa_recibe'];
      $emp_entrega   = $data['empresa_entrega'];
      $estatus       = $data['estatus'];
    }
  }

  if ($estatus == 1) {
    $name_estatus = "Activa";
  }else {
    $name_estatus = "Cancelada";
  }

  include "../conexion.php";
  

  $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados where cargo = 'operador' ORDER BY nombres";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlsem   = "select semana from semanas";
  $querysem = mysqli_query($conection, $sqlsem);
  $filassem = mysqli_fetch_all($querysem, MYSQLI_ASSOC);

  $sqlunid   = "select no_unidad from unidades where estatus = 1";
  $queryunid = mysqli_query($conection, $sqlunid);
  $filasunid = mysqli_fetch_all($queryunid, MYSQLI_ASSOC); 

  /*$sqledo = "select estado from estados ORDER BY estado";
  $queryedo = mysqli_query($conection, $sqledo);
  $filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); */

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
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE ERP"></span>
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
              <li class="breadcrumb-item"><a href="#">Propiedad Cliente Proveedor</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

       <?php
                    
          include "../conexion.php";
         

        ?>  
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edición de Propiedad del Cliente Proveedor</h3>
              </div>
              <div class="card-body">
              <div class="card-header p-2">
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
              <div class="form-group row">
                    <div class="col-sm-10">
                    </div>
                  </div>
                  <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id;?>">
                  <!--
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Folio</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo $nuevofolio; ?>" readonly>
                    </div>
                  </div>
                  -->
                    <div class="form-group row" style="text-align:left;">
                     <label for="inputEmail3" class="col-sm-7 col-form-label"></label>
                     <div>
                     </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de Entrega</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $f_entrega;?>">
                    </div>  
                  </div>

                    <div class="form-group row" style="text-align:left;">
                     <label for="inputEmail3" class="col-sm-5 col-form-label">Empresa que Resguarde</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="inputEmpresa" name="inputEmpresa" value="<?php echo $empresa; ?>">
                    </div>
                   
                  </div>

                   <div class="form-group row" style="text-align:left;">
                     <label for="inputEmail3" class="col-sm-5 col-form-label">Representante de la Empresa que recibe el bien</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="inputRepresentante" name="inputRepresentante" value="<?php echo $rep_empresa; ?>" >
                    </div>
                  </div>

                       <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Domicilio</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputDireccion" name="inputDireccion" value="<?php echo $direccion; ?>">
                    </div>
                  </div>


                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Telefonos:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputTelefonos" name="inputTelefonos" value="<?php echo $phone; ?>">
                    </div>
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Correo:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputCorreo" name="inputCorreo" value="<?php echo $email; ?>">
                    </div>
                  </div>

                 <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Bien de la Empresa Entregado:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputBien" name="inputBien" value="<?php echo $bienentrega; ?>">
                    </div>              
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Caracteristicas:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="inputCaracteristicas" name="inputCaracteristicas" rows="1"><?php echo $caracterisc; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Para utilizarse en:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="inputUtilizarse" name="inputUtilizarse" rows="1"><?php echo $utilizaseen; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Método de identificación del bien entregado:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="inputIdentificacion" name="inputIdentificacion" rows="1"><?php echo $identifica; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Método de verificación del bien entregado:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="inputVerificacion" name="inputVerificacion" rows="1"><?php echo $verifica; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Método de protección del bien entregado:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="inputProteccion" name="inputProteccion" rows="1"><?php echo $proteccion; ?></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Método de salvaguardar el bien entregado:</label>
                    <div class="col-sm-9">
                      <textarea class="form-control" id="inputSalvaguarda" name="inputSalvaguarda" rows="1"><?php echo $salvaguarda; ?></textarea>
                    </div>
                  </div>
                    
                  <p><b>Acciones de contingencias</b></p>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNombre1" name="inputNombre1" value="<?php echo $nombre1; ?>">
                    </div>
                   </div> 

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Puesto:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputPuesto1" name="inputPuesto1" value="<?php echo $puesto1; ?>">
                    </div>


                     <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono y Correo:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputTelcorreo1" name="inputTelcorreo1" value="<?php echo $tel_correo1; ?>">
                    </div>

                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Nombre:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputNombre2" name="inputNombre2" value="<?php echo $nombre2; ?>">
                    </div>
                   </div> 

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Puesto:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputPuesto2" name="inputPuesto2" value="<?php echo $puesto2; ?>">
                    </div>


                     <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono y Correo:</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputTelcorreo2" name="inputTelcorreo2" value="<?php echo $tel_correo2; ?>">
                    </div>

                  </div>

                      <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Empresa que recibe</label>
                    <div class="col-sm-4">
                      <input class="form-control" id="inputEmpresarecibe" name="inputEmpresarecibe" value="<?php echo $emp_recibe; ?>">
                    </div>
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Empresa que entrega:</label>
                    <div class="col-sm-4">
                      <input class="form-control" id="inputEmpresaentrega" name="inputEmpresaentrega" value="<?php echo $emp_entrega; ?>">
                    </div>
                  </div>

                <!-- /.card-body -->
                <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>
                          <button type="submit" class="btn btn-success" id="guardar_tipoactividad">Guardar</button>
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
             //*location.href = 'lista_ncplantasa.php';
             console.log("Alerta cerrada");
        } else {
            // Dijeron que no
            //*location.reload();

            location.href = 'propiedades_cp.php';
                       //*location.reload();  
         }
            
    });

   

    });
    </script>
<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var idp          = $('#inputId').val();
       var fecha        = $('#inputFecha').val();
       var empresa      = $('#inputEmpresa').val();
       var representa   = $('#inputRepresentante').val();
       var direccion    = $('#inputDireccion').val();
       var telefono     = $('#inputTelefonos').val();
       var correo       = $('#inputCorreo').val();
       var bienresgdo   = $('#inputBien').val();
       var caracterist  = $('#inputCaracteristicas').val();
       var utilizarse   = $('#inputUtilizarse').val();
       var identifica   = $('#inputIdentificacion').val();
       var verifica     = $('#inputVerificacion').val();
       var proteccion   = $('#inputProteccion').val();
       var salvaguarda  = $('#inputSalvaguarda').val();
       var nombre1      = $('#inputNombre1').val();
       var puesto1      = $('#inputPuesto1').val();
       var telcorreo1   = $('#inputTelcorreo1').val();
       var nombre2      = $('#inputNombre2').val();
       var puesto2      = $('#inputPuesto2').val();
       var telcorreo2   = $('#inputTelcorreo2').val();
       var emprecibe    = $('#inputEmpresarecibe').val();
       var empentrega   = $('#inputEmpresaentrega').val();
     
       var action       = 'AlmacenaEditPropiedadcp';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idp:idp, fecha:fecha, empresa:empresa, representa:representa, direccion:direccion, telefono:telefono, correo:correo, bienresgdo:bienresgdo, caracterist:caracterist, utilizarse:utilizarse, identifica:identifica, verifica:verifica, proteccion:proteccion, salvaguarda:salvaguarda, nombre1:nombre1, puesto1:puesto1, telcorreo1:telcorreo1, nombre2:nombre2, puesto2:puesto2, telcorreo2:telcorreo2, emprecibe:emprecibe, empentrega:empentrega},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                         console.log(response);
                        var info = JSON.parse(response);
                        console.log(info);
                        $mensaje=(info.mensaje);
                          if ($mensaje === undefined)
                          {
                            Swal
                         .fire({
                          title: "Exito!",
                          text: "PROPIEDAD DEL CLIENTE O PROVEEDOR EDITADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //generarimpformulaPDF(info.folio);
                        location.href = 'propiedades_cp.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'propiedades_cp.php';
                        }
                        });


                         }else {  
                            
                            //swal('Mensaje del sistema', $mensaje, 'warning');
                            //location.reload();
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: $mensaje,
                            })
                        }

                                                        
    
                        }else{
                          Swal.fire({
                            icon: 'info',
                            title: '',
                            text: 'Capture los datos requeridos',
                            })
        
                        }
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
