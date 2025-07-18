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
    header('Location: rutas.php');
    mysqli_close($conection);
  }
  $idrt = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT id, cliente, ruta, no_eco, operador, horario1, horario2, horario3, hmixto1, hmixto2, dias, sueldo_camion, sueldo_camioneta, sueldo_semid, sueldo_sprinter FROM rutas WHERE id=$idrt");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: rutas.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id            = $data['id'];
      $cliente       = $data['cliente'];
      $ruta          = $data['ruta'];
      $no_eco        = $data['no_eco'];
      $operador      = $data['operador'];
      $horario1      = $data['horario1'];
      $horario2      = $data['horario2'];
      $horario3      = $data['horario3'];
      $hmixto1       = $data['hmixto1'];
      $hmixto2       = $data['hmixto2'];
      $dias          = $data['dias']; 
      $sdo_camion    = $data['sueldo_camion'];
      $sdo_camioneta = $data['sueldo_camioneta'];
      $sdo_semid     = $data['sueldo_semid'];
      $sdo_sprinter  = $data['sueldo_sprinter'] ?? 0;
      
      //$user   = $_SESSION['idUser'];
      
    }
  }

  include "../conexion.php";
  $sqlopr   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_operador from empleados ORDER BY apellido_paterno";
  $queryopr = mysqli_query($conection, $sqlopr);
  $filasopr = mysqli_fetch_all($queryopr, MYSQLI_ASSOC); 

  $sqlcte = "select * from clientes ORDER BY nombre_corto";
  $querycte = mysqli_query($conection, $sqlcte);
  $filascte = mysqli_fetch_all($querycte, MYSQLI_ASSOC);

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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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

      <?php include('includes/generalnavbar.php'); 
      
      if ($_SESSION['rol'] == 1) {
        $activo = "";
      } else { 
        $activo = "disabled";
      }
       ?>
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
              <li class="breadcrumb-item"><a href="rutas.php">Rutas</a></li>
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
                <h3 class="card-title">Edición de Ruta</h3>
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
                  <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id; ?>">
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Cliente</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="fcliente" id="fcliente">
                  <option value="<?php echo $cliente; ?>"><?php echo $cliente; ?></option>
                  <?php foreach ($filascte as $opct): //llenar las opciones del primer select ?>
                  <option value="<?= $opct['nombre_corto'] ?>"><?= $opct['nombre_corto'] ?></option>  
                  <?php endforeach; ?>
                </select> 
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruta</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="fruta" name="fruta" placeholder="Ruta" value="<?php echo $ruta; ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Economico</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="fNoeco" name="fNoeco" value="<?php echo $no_eco; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Operador</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%;" name="foperador" id="foperador">
                  <option value="<?php echo $operador; ?>"><?php echo $operador; ?></option>
                  <?php foreach ($filasopr as $opr): //llenar las opciones del primer select ?>
                  <option value="<?= $opr['name_operador'] ?>"><?= $opr['name_operador'] ?></option>  
                  <?php endforeach; ?>
                </select> 
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Horario 1</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" id="fhorario1" name="fhorario1" value="<?php echo $horario1; ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Horario 2</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" id="fhorario2" name="fhorario2" value="<?php echo $horario2; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Horario 3</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" id="fhorario3" name="fhorario3" value="<?php echo $horario3; ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Horario Mixto 1</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" id="fhmixto1" name="fhmixto1" value="<?php echo $hmixto1; ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Horario Mixto 2</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" id="fhmixto2" name="fhmixto2" value="<?php echo $hmixto2; ?>">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Días Viajes</label>
                    <div class="col-sm-4">
                      <select class="form-control" style="width: 100%;" name="fdiasv" id="fdiasv">
                  <option value="<?php echo $dias; ?>"><?php echo $dias; ?></option>
                  <option value="L-V">Lunes - Viernes</option>
                  <option value="L-S">Lunes - Sabado</option>
                  <option value="L-D">Lunes - Domingo</option>
                  <option value="S-D">Sabado - Domingo</option>
                </select> 
                    </div>
                  </div>


                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sueldo Camión</label>
                    <div class="col-sm-2">
                      <input type="number" step="any" class="form-control" id="fsueldovta" name="fsueldovta" value="<?php echo $sdo_camion; ?>" <?= $activo ?>>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sueldo Camioneta</label>
                    <div class="col-sm-2">
                      <input type="number" step="any" class="form-control" id="fsueldovtaneta" name="fsueldovtaneta" value="<?php echo $sdo_camioneta; ?>" <?= $activo ?>>
                    </div>
                    <label for="fsdovtasprinter" class="col-sm-2 col-form-label">Sueldo Sprinter</label>
                    <div class="col-sm-2">
                      <input type="number" step="any" class="form-control" id="fsdovtasprinter" name="fsdovtasprinter" value="<?php echo $sdo_sprinter; ?>" <?= $activo ?>>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Sueldo Semidomiciliada</label>
                    <div class="col-sm-10">
                      <input type="number" step="any" class="form-control" id="fsueldosemid" name="fsueldosemid" value="<?php echo $sdo_semid; ?>" <?= $activo ?>>
                    </div>
                  </div>


                <!-- /.card-body -->
                <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                          <button type="submit" class="btn btn-success" id="guardar_tipoactividad">Guardar</button>
                        </div>
                      </div>
                <!-- /.card-footer -->
              </form>
            </div>
     </div>
     </div>
      </div> 
     
</center>

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
            location.href = 'rutas.php';
        }
    });

   

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var Id           = $('#inputId').val();
       var cliente      = $('#fcliente').val();
       var ruta         = $('#fruta').val();
       var noeconomico  = $('#fNoeco').val();
       var operador     = $('#foperador').val();
       var horario1     = $('#fhorario1').val();
       var horario2     = $('#fhorario2').val();
       var horario3     = $('#fhorario3').val();
       var hmixto1      = $('#fhmixto1').val();
       var hmixto2      = $('#fhmixto2').val();
       var diasviajes   = $('#fdiasv').val();
       var sueldo_vta     = $('#fsueldovta').val();
       var sueldo_vtaneta = $('#fsueldovtaneta').val();
       var sueldo_semid   = $('#fsueldosemid').val();

       var action       = 'AlmacenaEditRuta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, Id:Id, cliente:cliente, ruta:ruta, noeconomico:noeconomico, operador:operador, horario1:horario1, horario2:horario2, horario3:horario3, hmixto1:hmixto1, hmixto2:hmixto2, diasviajes:diasviajes, sueldo_vta:sueldo_vta, sueldo_vtaneta:sueldo_vtaneta, sueldo_semid:sueldo_semid},

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
                          text: "RUTA ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'rutas.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'rutas.php';
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
