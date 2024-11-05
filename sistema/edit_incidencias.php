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
    header('Location: incidencias.php');
    mysqli_close($conection);
  }
  $idact = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM incidencias WHERE id=$idact");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: incidencias.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id           = $data['id'];
      $tincidencia  = $data['tipo_incidencia'];
      $empleado     = $data['empleado'];
      $dias_derecho = $data['dias_derecho'];
      $dias_tomados = $data['dias_tomados'];
      $fcha_inicial = $data['fecha_inicial'];
      $fcha_final   = $data['fecha_final'];
      $nosemana     = $data['nodesemana'];
      $valor        = $data['valor'];
      $notas        = $data['observaciones'];

      if ($tincidencia = 'Vacaciones')  {
        $visual = '';
      }else {
        $visual = 'none';
      }

      $diaspendientes = $dias_derecho - $dias_tomados;
      
      //$user   = $_SESSION['idUser'];
      
    }
  }
  include "../conexion.php";
  $sqlopr   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as empleado from empleados ORDER BY apellido_paterno";
  $queryopr = mysqli_query($conection, $sqlopr);
  $filasopr = mysqli_fetch_all($queryopr, MYSQLI_ASSOC); 


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
              <li class="breadcrumb-item"><a href="incidencias.php">Incidencias</a></li>
              <li class="breadcrumb-item active">Nueva</li>
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
                <h3 class="card-title">Edicion de Incidencia</h3>
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
                  <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id; ?>" readonly>
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo de Incidencia:</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputIncidencia" name="inputIncidencia">
                       <option value="<?php echo $tincidencia; ?>"><?php echo $tincidencia; ?></option>
                       <option value="Falta Injustificada">Falta Injustificada</option>
                       <option value="Falta Justificada">Falta Justificada</option>
                       <option value="Vacaciones">Vacaciones</option>
                       <option value="Incapacidades">Incapacidades</option>
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Empleado:</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputEmpleado" name="inputEmpleado">
                       <option value="<?php echo $empleado; ?>"><?php echo $empleado; ?></option>
                       <?php foreach ($filasopr as $opem): //llenar las opciones del primer select ?>
                       <option value="<?= $opem['empleado'] ?>"><?= $opem['empleado'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left; display:<?php echo $visual; ?>;" id="diasvacaciones">
                   <label for="inputEmail3" class="col-sm-2 col-form-label">D. por Antiguedad:</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="inputDiasderecho" name="inputDiasderecho" value="<?php echo $dias_derecho; ?>" readonly>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">D. Restantes:</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="inputDiastomar" name="inputDiastomar" value="<?php echo $dias_tomados; ?>" readonly>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">D. Tomados:</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="inputDiaspendientes" name="inputDiaspendientes" value="<?php echo $diaspendientes; ?>" readonly>
                    </div>
                   
                  </div>



                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Inicial:</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputFechaini" name="inputFechaini" value="<?php echo $fcha_inicial; ?>" onchange="myFunctionDate()">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Final:</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputFechafin" name="inputFechafin" value="<?php echo $fcha_final; ?>" onchange="myFunctionDateTwo()">
                    </div>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="txt_diasvac" name="txt_diasvac" value="<?php echo $valor; ?>" >  
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones:</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputNotas" name="inputNotas" rows="1"><?php echo $notas; ?></textarea>
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

<script>
function myFunctionDate() {
    var x = document.getElementById("inputFechaini").value;
    var y = document.getElementById("inputFechafin").value;

    if(y === ''){
        document.getElementById('inputFechafin').value = x;
    }else{
       //var num1 = new Number(x);
       //var num2 = new Number(y);
       if(x > document.getElementById("inputFechafin").value){
         document.getElementById('inputFechafin').value = x;
       }else{
         document.getElementById('inputFechaini').value = x; 
       }    
   }
}
</script>

<script>
function myFunctionDateTwo() {
   var x = document.getElementById("inputFechaini").value;
   var y = document.getElementById("inputFechafin").value;
   //var num1 = new Number(x);
   //var num2 = new Number(y);

    if(y > document.getElementById("inputFechaini").value){
       $('#inputFechafin').val(document.getElementById("inputFechafin").value);
    }else {
        $('#inputFechafin').val(document.getElementById("inputFechaini").value);
    }
}
</script>

<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->
<script>
$(document).ready(function(){
     $('#inputFechaini').change(function(){ 

     fecha1 = document.getElementById("inputFechaini").value; 
     fecha2 = document.getElementById("inputFechafin").value;
   
     var date1 = Date.parse(fecha1);
     var date2 = Date.parse(fecha2); 
     var diff = date2 - date1;
     var masDay = 1;
     var diasv = (diff/(1000*60*60*24)) ;
     var ndiasv = diasv + masDay;
  
     inicio = new Date(fecha1); //Fecha inicial
    fin = new Date(fecha2); //Fecha final
    timeDiff = Math.abs(fin.getTime() - inicio.getTime());
    diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); //Días entre las dos fechas
    var cuentaFinde = 0; //Número de Sábados y Domingos
    var array = new Array(diffDays);
    diffDays2 = diffDays + 1;

    for (var i=0; i < diffDays2; i++) 
    {
        //0 => Domingo - 6 => Sábado
        if (inicio.getDay() == 0  ) {
            cuentaFinde++;
        }
        inicio.setDate(inicio.getDate() + 1);
        //alert(cuentaFinde);
    }

    if (cuentaFinde > 0) {
      alert("Dias Domingos " + cuentaFinde);
     }
  
     //alert(cuentaFinde);
     document.getElementById("txt_diasvac").value = ndiasv - cuentaFinde;    
    

    
         
     });
 });
</script>

<script>
$(document).ready(function(){
     $('#inputFechafin').change(function(){ 

     fecha1 = document.getElementById("inputFechaini").value; 
     fecha2 = document.getElementById("inputFechafin").value;
   
     var date1 = Date.parse(fecha1);
     var date2 = Date.parse(fecha2); 
     var diff = date2 - date1;
     var masDay = 1;
     var diasv = (diff/(1000*60*60*24));
     var ndiasv = diasv + masDay;
  
     inicio = new Date(fecha1); //Fecha inicial
    fin = new Date(fecha2); //Fecha final
    timeDiff = Math.abs(fin.getTime() - inicio.getTime());
    diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); //Días entre las dos fechas
    var cuentaFinde = 0; //Número de Sábados y Domingos
    var array = new Array(diffDays);
    diffDays2 = diffDays + 1;

    for (var i=0; i < diffDays2; i++) 
    {
        //0 => Domingo - 6 => Sábado
        if (inicio.getDay() == 0  ) {
            cuentaFinde++;
        }
        inicio.setDate(inicio.getDate() + 1);
        //alert(cuentaFinde);
    }
     if (cuentaFinde > 0) {
      alert("Dias Domingos " + cuentaFinde);
     }
     //alert(cuentaFinde);
     document.getElementById("txt_diasvac").value = ndiasv - cuentaFinde;
    
         
     });
 });
</script>


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
            location.href = 'incidencias.php';
        }
    });

   

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var inputid      = $('#inputId').val();
       var tincidencia  = $('#inputIncidencia').val();
       var empleado     = $('#inputEmpleado').val();
       var diasderecho  = $('#inputDiasderecho').val();
       var diastomar    = $('#inputDiastomar').val();
       var fechaini     = $('#inputFechaini').val();
       var fechafin     = $('#inputFechafin').val();
       var diasvac      = $('#txt_diasvac').val();
       var notas        = $('#inputNotas').val();

       var action       = 'AlmacenaEditIncidencia';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, inputid:inputid, tincidencia:tincidencia, empleado:empleado, diasderecho:diasderecho, diastomar:diastomar, fechaini:fechaini, fechafin:fechafin, diasvac:diasvac, notas:notas},

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
                          text: "INCIDENCIA ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'incidencias.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'incidencias.php';
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
$(document).ready(function(){
     $('#inputEmpleado').change(function(){ 
      var op = $(this).val();
      var tipoincidencia  = $('#inputIncidencia').val();

      if (tipoincidencia == "Vacaciones") {
        document.getElementById("diasvacaciones").style.display = "";
      }else {
        document.getElementById("diasvacaciones").style.display = "none";
      }
    var action = 'searchDiasvacac';
    $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, op:op, tipoincidencia:tipoincidencia},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputDiasderecho').val('');
                    $('#inputDiastomar').val('');
                  
                  
                }else{
                    var data = $.parseJSON(response);
                   
                    $('#inputDiasderecho').val(data.tomardias);
                    $('#inputDiastomar').val(data.diastomados);
                    //$('#rfc_cliente').val(data.rfc);
                   
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
