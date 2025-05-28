<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $iduser=$_SESSION['idUser'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  if (!isset($_SESSION['idUser'])) {
  header('Location: ../index.php');
}

  $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados ORDER BY nombres";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlunid   = "select no_unidad from unidades where estatus = 1";
  $queryunid = mysqli_query($conection, $sqlunid);
  $filasunid = mysqli_fetch_all($queryunid, MYSQLI_ASSOC); 

  $sqlgas   = "select nombre_corto from gasolineras where estatus = 1";
  $querygas = mysqli_query($conection, $sqlgas);
  $filasgas = mysqli_fetch_all($querygas, MYSQLI_ASSOC); 



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
  <!--
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE CRM"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
-->

    <?php
    /*
       if ($_SESSION['rol'] == 4) {
        include('includes/navbarsup.php');
      }else {
       if ($_SESSION['rol'] == 5) {
          include('includes/navbarrhuman.php');
         }else { 
           if ($_SESSION['rol'] == 7) {
              include('includes/navbarmantto.php');
            }else {
              if ($_SESSION['rol'] == 8) {
                 include('includes/navbarjefeoper.php');
               }else {
                if ($_SESSION['rol'] == 9) {
                   include('includes/navbargrcia.php');
                 }else {
                  if ($_SESSION['rol'] == 15) {
                    include('includes/navbarmonitorista.php');
                  }else {
                    include('includes/navbar.php');  
                  }
                 }  
               }
            }   
      } 
      }*/
       ?>
      <?php /* include('includes/nav.php')*/ ?>
 <!--
    </div>
  </nav>-->
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
              <li class="breadcrumb-item"><a href="#">Carga Combustible</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

       <?php
                    
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT MAX(id) as max_id FROM carga_combustible");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["max_id"]+1; 

          $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'CC'");
          

          mysqli_close($conection);
        ?>  
        <?php
         date_default_timezone_set('America/Mazatlan');
         $fcha = date("Y-m-d");
     ?>  
         <?php 

         include "../conexion.php";

         $sql= mysqli_query($conection,"SELECT semana FROM semanas40 WHERE dia_inicial <= '$fcha' AND dia_final >= '$fcha'");
         mysqli_close($conection);
         $result = mysqli_num_rows($sql);
         

         while ($data = mysqli_fetch_array($sql)){
         $nosemana  = $data['semana'];
     
      
      //$user   = $_SESSION['idUser'];
      
    }
  


         ?>

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Alta de Carga Combustible</h3>
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
              

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Folio</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo $nuevofolio; ?>" readonly>
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Estacion</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputEstacion" name="inputEstacion">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasgas as $opgs): //llenar las opciones del primer select ?>
                       <option value="<?= $opgs['nombre_corto'] ?>"><?= $opgs['nombre_corto'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fcha;?>">
                    </div>
                 

              
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Semana</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputSemana" name="inputSemana" value="<?php echo $nosemana;?>" disabled>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Unidad</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputNounidad" name="inputNounidad">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasunid as $opun): //llenar las opciones del primer select ?>
                       <option value="<?= $opun['no_unidad'] ?>"><?= $opun['no_unidad'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Placas</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputPlacas" name="inputPlacas">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Operador</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputOperador" name="inputOperador">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasoper as $oper): //llenar las opciones del primer select ?>
                       <option value="<?= $oper['operador'] ?>"><?= $oper['operador'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Km Anterior</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputKmanterior" name="inputKmanterior" >
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Km Actual al Cargar</label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="inputKmactual" name="inputKmactual" >
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Km Recorridos</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputKmrecorridos" name="inputKmrecorridos" readonly>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label"> Combustible</label>
                    <div class="col-sm-4">
                     <input type="text" class="form-control" id="inputTcombustible" name="inputTcombustible" > 
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo Combustible</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputColorgas" name="inputColorgas">
                       <option value="">- Seleccione -</option>
                       <option value="ROJA">ROJA</option>
                       <option value="VERDE">VERDE</option>
                       <option value="NA">NA</option>
                    </select>
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Litros</label>
                    <div class="col-sm-4">
                       <input type="number" step="any" class="form-control" id="inputLitros" name="inputLitros" />
                    </div>
                  

                    <label for="inputEmail3" class="col-sm-1 col-form-label">Precio</label>
                    <div class="col-sm-2">
                      <input type="number" step="any" class="form-control" id="inputPrecio" name="inputPrecio" />
                    </div>

                    <label for="inputEmail3" class="col-sm-1 col-form-label">Importe</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="inputImporte" name="inputImporte" readonly>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Rendimiento</label>
                    <div class="col-sm-4">
                       <input type="number" step="any" class="form-control" id="inputRendimiento" name="inputRendimiento" readonly />
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Rendimiento Estandar</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputRestandar" name="inputRestandar" readonly />
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Supervisor</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSupervisor" name="inputSupervisor" value="<?php echo  $_SESSION['nombre'];?>">
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

            var norecibo  = $('#inputFolio').val();
            var action = 'procesarSalirCargacomb';
                       
            $.ajax({
                url: 'includes/ajax.php',
                type: "POST",
                async : true,
                data: {action:action, norecibo:norecibo},

                success: function(response)
                {
                    
                    if(response != 'error')
                    {
                      var info = JSON.parse(response);
                      console.log(response);
                      location.href = 'carga_combustible23.php';
                       //*location.reload();


                        
                    }else{
                        console.log('no data');
                    }
                },
                error: function(error){                
                }
            });
        

    });
    </script>
<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

        function esFechaValida(fechaUsuario) {
            // Convertir la fecha ingresada a un objeto Date
            // let fechaIngresada = new Date(fechaUsuario);
            // if (isNaN(fechaIngresada)) {
            //     return { valid: false, message: "Fecha inválida" };
            // }

            // // Obtener la fecha actual
            // let fechaActual = new Date();
            // fechaActual.setHours(0, 0, 0, 0); // Eliminar la hora para comparar solo fechas

            // // Calcular la fecha límite (hace 6 días)
            // let fechaLimite = new Date();
            // fechaLimite.setDate(fechaActual.getDate() - 8); // Restar 6 días

            // // Comparar la fecha ingresada con la fecha límite
            // if ((fechaIngresada >= fechaLimite && fechaIngresada <= fechaActual) || (<?php echo $iduser ?> == 32)) {
            //     return true;
            // } else {
            //     return false;
            // }
            return true;
        }

       var folio       = $('#inputFolio').val();
       var estacion    = $('#inputEstacion').val();
       var fecha       = esFechaValida($('#inputFecha').val());
       console.log(fecha);
       var nosemana    = $('#inputSemana').val();
       var nounidad    = $('#inputNounidad').val();
       var placas      = $('#inputPlacas').val();
       var operador    = $('#inputOperador').val();
       var kmanterior  = $('#inputKmanterior').val();
       var kmactual    = $('#inputKmactual').val();
       var kmrecorre   = $('#inputKmrecorridos').val();
       var combustible = $('#inputTcombustible').val();
       var colorgas    = $('#inputColorgas').val();
       var litros      = $('#inputLitros').val();
       var precio      = $('#inputPrecio').val();
       var importe     = $('#inputImporte').val();
       var rendimiento = $('#inputRendimiento').val();
       var rendstandar = $('#inputRestandar').val();
       var supervisor  = $('#inputSupervisor').val();


       if(fecha) {
        let fecha_carga = $('#inputFecha').val();
       
       var action       = 'AlmacenaCargaComb';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, estacion:estacion, fecha:fecha_carga, nosemana:nosemana, nounidad:nounidad, placas:placas, operador:operador, kmanterior:kmanterior, kmactual:kmactual, kmrecorre:kmrecorre, combustible:combustible, colorgas:colorgas, litros:litros, precio:precio, importe:importe, rendimiento:rendimiento, rendstandar:rendstandar, supervisor:supervisor},

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
                          text: "CARGA DE COMBUSTIBLE ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'carga_combustible23.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'carga_combustible23.php';
                        }
                        });


                         }else {  
                            
                            //swal('Mensaje del sistema', $mensaje, 'warning');
                            //location.reload();
                            Swal.fire({
                            icon: 'Error',
                            title: 'Folio',
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
              }else {
        Swal.fire({
            icon: 'info',
            title: 'Error',
            text: 'Fecha no valida',
            })
        return false;
       }
              
    });

    </script>  
<script src="js/sweetalert2.all.min.js"></script>   

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
</script>
<!-- Page specific script -->
<script>
  // $(function () {
  //   //Initialize Select2 Elements
  //   $('.select2').select2()

  //   //Initialize Select2 Elements
  //   $('.select2bs4').select2({
  //     theme: 'bootstrap4'
  //   })

  //   //Datemask dd/mm/yyyy
  //   $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //   //Datemask2 mm/dd/yyyy
  //   $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //   //Money Euro
  //   $('[data-mask]').inputmask()

  //   //Date picker
  //   $('#reservationdate').datetimepicker({
  //       format: 'L'
  //   });

  //   //Date and time picker
  //   $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

  //   //Date range picker
  //   $('#reservation').daterangepicker()
  //   //Date range picker with time picker
  //   $('#reservationtime').daterangepicker({
  //     timePicker: true,
  //     timePickerIncrement: 30,
  //     locale: {
  //       format: 'MM/DD/YYYY hh:mm A'
  //     }
  //   })
  //   //Date range as a button
  //   $('#daterange-btn').daterangepicker(
  //     {
  //       ranges   : {
  //         'Today'       : [moment(), moment()],
  //         'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  //         'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
  //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
  //         'This Month'  : [moment().startOf('month'), moment().endOf('month')],
  //         'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  //       },
  //       startDate: moment().subtract(29, 'days'),
  //       endDate  : moment()
  //     },
  //     function (start, end) {
  //       $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  //     }
  //   )

  //   //Timepicker
  //   $('#timepicker').datetimepicker({
  //     format: 'LT'
  //   })

  //   //Bootstrap Duallistbox
  //   $('.duallistbox').bootstrapDualListbox()

  //   //Colorpicker
  //   $('.my-colorpicker1').colorpicker()
  //   //color picker with addon
  //   $('.my-colorpicker2').colorpicker()

  //   $('.my-colorpicker2').on('colorpickerChange', function(event) {
  //     $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
  //   })

  //   $("input[data-bootstrap-switch]").each(function(){
  //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
  //   })

  // })
  // // BS-Stepper Init
  // document.addEventListener('DOMContentLoaded', function () {
  //   window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  // })

  // // DropzoneJS Demo Code Start
  // Dropzone.autoDiscover = false

  // // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  // var previewNode = document.querySelector("#template")
  // previewNode.id = ""
  // var previewTemplate = previewNode.parentNode.innerHTML
  // previewNode.parentNode.removeChild(previewNode)

  // var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  //   url: "/target-url", // Set the url
  //   thumbnailWidth: 80,
  //   thumbnailHeight: 80,
  //   parallelUploads: 20,
  //   previewTemplate: previewTemplate,
  //   autoQueue: false, // Make sure the files aren't queued until manually added
  //   previewsContainer: "#previews", // Define the container to display the previews
  //   clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  // })

  // myDropzone.on("addedfile", function(file) {
  //   // Hookup the start button
  //   file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  // })

  // // Update the total progress bar
  // myDropzone.on("totaluploadprogress", function(progress) {
  //   document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  // })

  // myDropzone.on("sending", function(file) {
  //   // Show the total progress bar when upload starts
  //   document.querySelector("#total-progress").style.opacity = "1"
  //   // And disable the start button
  //   file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  // })

  // // Hide the total progress bar when nothing's uploading anymore
  // myDropzone.on("queuecomplete", function(progress) {
  //   document.querySelector("#total-progress").style.opacity = "0"
  // })

  // // Setup the buttons for all transfers
  // // The "add files" button doesn't need to be setup because the config
  // // `clickable` has already been specified.
  // document.querySelector("#actions .start").onclick = function() {
  //   myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  // }
  // document.querySelector("#actions .cancel").onclick = function() {
  //   myDropzone.removeAllFiles(true)
  // }
  // // DropzoneJS Demo Code End
</script> 

<script>
    $(document).ready(function () {
        $("#inputNounidad").on('change', function () {            
            var op = $(this).val();
             var action = 'searchNounidad';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputPlacas').val('');
                   
                }else{
                    var data = $.parseJSON(response);
                    
                    $('#inputPlacas').val(data.placas);
                    $('#inputTcombustible').val(data.tipo_combustible);
                    $('#inputKmanterior').val(data.kmactual_cargar);
                    $('#inputRestandar').val(data.rendimiendo_estandar);
                   
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
$(document).ready(function(){
     $('#inputLitros').blur(function(){ 
         
          m1 = document.getElementById("inputLitros").value;
          m2 = document.getElementById("inputPrecio").value;
          kr = document.getElementById("inputKmrecorridos").value;

          r = parseFloat(m1*m2);
          r2 = parseFloat(kr/m1);
          result = Number(r.toFixed(2));
          result2 = Number(r2.toFixed(2));
         document.getElementById("inputImporte").value = result;
         document.getElementById("inputRendimiento").value = result2;
     });
 });
</script>

<script>
$(document).ready(function(){
     $('#inputPrecio').blur(function(){ 
         
          m1 = document.getElementById("inputLitros").value;
          m2 = document.getElementById("inputPrecio").value;

          r = parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         
         document.getElementById("inputImporte").value = result;
     });
 });
</script>



<script>
$(document).ready(function(){
     $('#inputKmactual').blur(function(){ 
         
          m1 = document.getElementById("inputKmactual").value;
          m2 = document.getElementById("inputKmanterior").value;
          r =  parseFloat(m1-m2);
          result = Number(r.toFixed(2));
         document.getElementById("inputKmrecorridos").value = result;
     });
 });
</script>

<script>
$(document).ready(function(){
     $('#inputKmanterior').blur(function(){ 
         
          m1 = document.getElementById("inputKmactual").value;
          m2 = document.getElementById("inputKmanterior").value;
          r =  parseFloat(m1-m2);
          result = Number(r.toFixed(2));
         document.getElementById("inputKmrecorridos").value = result;
     });
 });
</script>

<script>
    $(document).ready(function () {
        $("#inputFecha").on('change', function () {            
            var op = $(this).val();
             var action = 'searchNosemana';
         
        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputSemana').val('');
                   
                }else{
                    var data = $.parseJSON(response);
                    
                    $('#inputSemana').val(data.semana);
                    
                   
                   
                }
            },
            error: function(error) {

            }

        });
        });
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


</body>
</html>
