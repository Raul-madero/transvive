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
    header('Location: requisicion_personals.php');
    mysqli_close($conection);
  }
  $idact = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM requisicion_personal WHERE id=$idact");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: requisicion_personalss.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id           = $data['id'];
      $date_elabora = $data['date_elabora'];
      $date_recibe  = $data['date_recibe'];
      $puesto       = $data['puesto'];
      $novacantes   = $data['no_vacantes'];
      $zona         = $data['zona'];
      $supervisor   = $data['supervisor'];
      $motivo       = $data['motivo'];
      $dato_motivo  = $data['dato_motivo'];
      $horario      = $data['horario'];
      $sdo_contrato = $data['sueldo_contrato'];
      $sdo_planta   = $data['sueldo_planta'];
      $edad         = $data['edad'];
      $escolaridad  = $data['escolaridad'];
      $experiencia  = $data['experiencia'];
      $edo_civil    = $data['edo_civil'];
      $conocer      = $data['conocimientos'];
      $se_cubrio    = $data['se_cubrio'];
      $autorizado   = $data['autorizado'];
      
    }
  }
  include "../conexion.php";
  $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados where estatus = 1 ORDER BY nombres";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlrecb   = "select nombre from usuario where rol = 10 and estatus = 1 ORDER BY nombre";
  $queryrecb = mysqli_query($conection, $sqlrecb);
  $filasrecb = mysqli_fetch_all($queryrecb, MYSQLI_ASSOC); 

  if ($motivo == 'EN SUSTIUCION DE' || $motivo =='OTROS') {
    echo '<style>
        .hidden {
            display: none;
        }
    </style>';
  }else {
    echo '<style>
        .hidden {
            display: block;
        }
    </style>';

  }
  //mysqli_close($conection);
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
       if ($_SESSION['rol'] == 5) {
          include('includes/navbarrhuman.php');
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
        } 
      } ?>
      <?php include('includes/nav.php') ?>

    </div>
  </nav>

  <!-- Navbar -->
 
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
          
        </div>
      </div>
    </section>
    <center>

       <?php
                    
          

          mysqli_close($conection);
        ?>  
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edición de Requisición de Personal</h3>
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

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputFecha" class="col-sm-2 col-form-label">Fecha de Elaboración</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $date_elabora;?>">
                    </div>

                    <label for="inputFecharec" class="col-sm-3 col-form-label">Fecha de Recibido por R. H.</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputFecharec" name="inputFecharec" value="<?php echo $date_recibe;?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputPuesto" class="col-sm-2 col-form-label">Puesto</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputPuesto" name="inputPuesto" value="<?php echo $puesto;?>">
                    </div>

                    <label for="inputNovacantes" class="col-sm-2 col-form-label">No. Vacantes</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputNovacantes" name="inputNovacantes" value="<?php echo $novacantes; ?>">
                    </div>
                  </div>
              

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputZona" class="col-sm-2 col-form-label">Zona</label>
                          <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputZona" name="inputZona" value="<?php echo $zona; ?>">
                    </div>
                     <label for="inputSupervisor" class="col-sm-2 col-form-label">Supervisor Asignado</label>
                          <div class="col-sm-4">
                          <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputSupervisor" name="inputSupervisor">
                            <option value="<?php echo $supervisor; ?>"><?php echo $supervisor; ?></option>
                       <?php foreach ($filasoper as $oprc): //llenar las opciones del primer select ?>
                      
                       <option value="<?= $oprc['operador'] ?>"><?= $oprc['operador'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputMotivo" class="col-sm-2 col-form-label">Motivo de la vacante</label>
                          <div class="col-sm-4">
                          <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputMotivo" name="inputMotivo" onchange="toggleInput()">
                          <option value="<?php echo $motivo; ?>"><?php echo $motivo; ?></option>
                          <option value="NUEVA CREACIÓN">NUEVA CREACIÓN</option>
                          <option value="AMPLIACIÓN DE PLANTILLA">AMPLIACIÓN DE PLANTILLA</option>
                          <option value="EVENTUAL">EVENTUAL</option>
                          <option value="EN SUSTITUCIÓN DE">EN SUSTITUCIÓN DE</option>
                          <option value="OTROS">OTROS</option>
                    </select>
                    </div>
                  
                     
                          <div id="datotros" class="col-sm-6 hidden" >
                          <input type="text" class="form-control" id="inputDatamotivo" name="inputDatamotivo" value="<?= $dato_motivo ?>">
                   
                  </div>
                  </div>
               


                
                 <div class="form-group row" >
                    <label for="inputTexto" class="col-sm-12 col-form-label" style="text-align:center; background-color: gainsboro;">DATOS GENERALES DEL PUESTO SOLICITADO</label>
                    
                  </div> 

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputHorario" class="col-sm-2 col-form-label">Horario</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputHorario" name="inputHorario" value="<?= $horario ?>">
                    </div>
                     <label for="inputSueldo" class="col-sm-3 col-form-label">Sueldo de contratación</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="inputSueldo" name="inputSueldo" value="<?= $sdo_contrato ?>">
                    </div>
                  </div>  

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputSueldoplanta" class="col-sm-2 col-form-label">Sueldo de planta</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputSueldoplanta" name="inputSueldoplanta" value="<?= $sdo_planta ?>">
                    </div>
                     <label for="inputEdad" class="col-sm-2 col-form-label">Edad</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputEdad" name="inputEdad" value="<?= $edad ?>">
                    </div>
                  </div>   

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEscolaridad" class="col-sm-2 col-form-label">Escolaridad</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="inputEscolaridad" name="inputEscolaridad" value="<?= $escolaridad ?>">
                    </div>
                     <label for="inputExperiencia" class="col-sm-2 col-form-label">Experiencia</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="inputExperiencia" name="inputExperiencia" value="<?= $experiencia ?>">
                    </div>
                    <label for="inputEstado" class="col-sm-2 col-form-label">Estado civil</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="inputEstado" name="inputEstado" value="<?= $edo_civil ?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputSaber" class="col-sm-2 col-form-label">Conocimientos</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="inputSaber" name="inputSaber" value="<?= $conocer ?>"></textarea>
                    </div>
                  </div>
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputCubrio" class="col-sm-2 col-form-label">Se cubrió con</label>
                    <div class="col-sm-6">
                      <input class="form-control" id="inputCubrio" name="inputCubrio" value="<?= $se_cubrio ?>">
                    </div>
                    <label for="inputCubrio" class="col-sm-2 col-form-label">Autorizado</label>
                    <div class="col-sm-2">
                      <select class="form-control" id="inputAutorizado" name="inputAutorizado">
                      <option value="<?= $autorizado ?>"><?= $autorizado ?></option>
                      <option value="SI">SI</option>
                      <option value="NO">NO</option>  
                      </select>
                    </div>
                  </div>

                <!-- /.card-body -->
                <div class="form-group row" style="text-align:right;">
                  <div class="offset-sm-2 col-sm-10">
                    <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
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
           /*var norecibo  = $('#inputFolio').val();
            var action = 'procesarSalirCortizacioncp';
                       
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
                      console.log(response); */
                      location.href = 'requisicion_personal.php';
                       //*location.reload();
                    /*
               
                        
                    }else{
                        console.log('no data');
                    }

                },
                error: function(error){                
                }
            });*/
        }
    });

   

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();
       
       var idrp          = $('#inputId').val();
       var daterp        = $('#inputFecha').val();
       var daterec       = $('#inputFecharec').val();
       var puesto        = $('#inputPuesto').val();
       var novacantes    = $('#inputNovacantes').val();
       var zona          = $('#inputZona').val();
       var supervisor    = $('#inputSupervisor').val();
       var motivo        = $('#inputMotivo').val();
       var datamotivo    = $('#inputDatamotivo').val();
       var horario       = $('#inputHorario').val();
       var sueldo        = $('#inputSueldo').val();
       var sueldoplanta  = $('#inputSueldoplanta').val();
       var edad          = $('#inputEdad').val();
       var escolaridad   = $('#inputEscolaridad').val();
       var experiencia   = $('#inputExperiencia').val();
       var estado        = $('#inputEstado').val();
       var conocimiento  = $('#inputSaber').val();
       var secubrio      = $('#inputCubrio').val();
       var autorizado    = $('#inputAutorizado').val();
     
       var action       = 'AlmacenaEditReqpersonal';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idrp:idrp, daterp:daterp, daterec:daterec, puesto:puesto, novacantes:novacantes, zona:zona, supervisor:supervisor, motivo:motivo, datamotivo:datamotivo, horario:horario, sueldo:sueldo, sueldoplanta:sueldoplanta, edad:edad, escolaridad:escolaridad, experiencia:experiencia, estado:estado, conocimiento:conocimiento, secubrio:secubrio, autorizado:autorizado},

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
                          text: "REQUISICION DE PERSONAL EDITADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //generarimpformulaPDF(info.folio);
                        location.href = 'requisicion_personal.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'requisicion_personal.php';
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
  

<script type="text/javascript">
    function generarimpformulaPDF(folio){
    //console.log(cliente);
    //console.log(norecibo);
    var ancho = 1000;
    var alto = 800;
    //calcular posicion x,y para centrar la ventana

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = 'factura/requisicion.php?id='+ folio;
    window.open($url,"requisicion","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}
  </script> 


  <script>
        function toggleInput() {
            // Obtener el valor seleccionado del select
            var selectValue = document.getElementById("inputMotivo").value;
            // Obtener el input que será mostrado o escondido
            var inputField = document.getElementById("datotros");
            
            // Mostrar u ocultar el input dependiendo del valor seleccionado
           
            if (selectValue === 'OTROS' || selectValue === 'EN SUSTITUCIÓN DE') {
               //alert(selectValue);
               inputField.classList.remove("hidden");
            } else {
              inputField.classList.add("hidden");
            } 
        }
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
