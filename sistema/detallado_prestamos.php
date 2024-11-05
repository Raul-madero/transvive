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

  $fechaActual = date('Y-m-d h:i:s');
  $fechaSegundos = strtotime($fechaActual);
  $anio =  date("Y", $fechaSegundos);

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
            include('includes/navbar.php');
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
   <section class="content">
        <div class="container-fluid">
            <h2 class="text-center">Reporte Detallado Prestamos</h2>
            <form id="filtroReporte" method="POST" action="reporte_pago.php" target="_blank">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                          <div class="col-3">
                                <div class="form-group">
                                    <label for="empleado_inicio">No.Empleado - Inicio:</label>
            <input type="number" class="form-control" id="empleado_inicio" name="empleado_inicio" required>
                                </div>
                            </div>
                            <div class="col-3">
                                 <div class="form-group">
                                    <label for="empleado_fin">No. Empleado - Fin:</label>
            <input type="number" class="form-control" id="empleado_fin" name="empleado_fin" required>
                                </div>
                            </div>
                           
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Ejercicio:</label>
                                   <select class="form-control" style="width: 100%; text-align: left" id="year" name="year">
                                        <option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                        <option value="2036">2036</option>
                                        <option value="2037">2037</option>
                                        <option value="2038">2038</option>
                                        <option value="2039">2039</option>
                                        <option value="2040">2040</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3" hidden>
                                <div class="form-group">
                                    <label>Imprimir Empleados Total = 0:</label>
                                     <select class="form-control" style="width: 100%; text-align: left" id="importeCero" name="importeCero">
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                            <!--
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Order By:</label>
                                    <select class="select2" style="width: 100%;">
                                        <option selected>Title</option>
                                        <option>Date</option>
                                    </select>
                                </div>
                            </div>
                          -->

                          <div class="col-12">
                                <div class="form-group">
                                    
                                </div>
                            </div>
                        
                      <div class="col-3">
                      <button type="submit" class="btn btn-primary">Generar Reporte</button>
                      </div>
                    <div class="col-3">
                      <a href="#" onclick="window.location ='nominas.php';" >
                        <button type ="button" class="btn btn-secondary pull-left" href="#"><i class="fa fa-stop"></i> Cancelar</button>
                    </div>

                    </div>

                    </div>
                </div>
            </form>
        </div>
    </section>
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
             //*location.href = 'lista_ncplantasa.php';
             console.log("Alerta cerrada");
        } else {
            // Dijeron que no
            //*location.reload();
            location.href = 'clientes.php';
        }
    });

   

    });
    </script>

<script>
   $('#guardar_cliente').click(function(e){
        e.preventDefault();

       var namecte      = $('#inputName').val();
       var emailcte     = $('#inputEmail').val();
       var telefonocte  = $('#inputTelefono').val();
       var rfccte       = $('#inputRfc').val();
       var sitiocte     = $('#inputSitio').val();
       var namecontac   = $('#inputNameContacto').val();
       var titulocontac = $('#inputTitulo').val();
       var puestocontac = $('#inputPuesto').val();
       var emailcontac  = $('#inputEmailContacto').val();
       var movilcontac  = $('#inputMovil').val();
       var callecte     = $('#inputCalle').val();
       var estadocte    = $('#inputEstado').val();
       var ciudadcte    = $('#inputCiudad').val();
       var cpostalcte   = $('#inputCpostal').val();
       var paiscte      = $('#inputPais').val();

       var action       = 'AlmacenaCliente';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, namecte:namecte, emailcte:emailcte, telefonocte:telefonocte,
                          rfccte:rfccte, sitiocte:sitiocte, namecontac:namecontac, titulocontac:titulocontac,
                          puestocontac:puestocontac, emailcontac:emailcontac, movilcontac:movilcontac,
                          callecte:callecte, estadocte:estadocte, ciudadcte:ciudadcte, cpostalcte:cpostalcte,
                          paiscte:paiscte},

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
                          text: "Cliente ALMACENADO CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'clientes.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'clientes.php';
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
      $(document).ready(function(){
          
         var pedidos3 = $('#semana');
         var pedidos4 = $('#semana2');
        //Ejecutar accion al cambiar de opcion en el select de las bandas
        $('#inputTiponomina').change(function(){
          var banda_id3 = $(this).val(); //obtener el id seleccionado

          if(banda_id3 !== ''){ //verificar haber seleccionado una opcion valida

            /*Inicio de llamada ajax*/
            $.ajax({
              data: {banda_id3:banda_id3}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: 'data/get_enviossem.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

              pedidos3.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax  
              pedidos4.html(data);           
              pedidos3.prop('disabled', false); //habilitar el select
              pedidos4.prop('disabled', false); //habilitar el select
            });
            /*fin de llamada ajax*/

          }else{ //en caso de seleccionar una opcion no valida
            pedidos3.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
            pedidos4.val('');
            pedidos3.prop('disabled', true); //deshabilitar el select
            pedidos4.prop('disabled', true);
          }    
        });


        //mostrar una leyenda con el disco seleccionado
       

      });
    </script>

<script>
function myFunctionDate() {
    var x = document.getElementById("semana").value;
    var xn = Number(x.substr(-3));
    var y = document.getElementById("semana2").value;
    var yn = Number(y.substr(-3));

    if(y === '- Seleccione -'){
        document.getElementById('semana2').value = x;
    }else{
       //var num1 = new Number(x);
       //var num2 = new Number(y);
       if(xn > yn){
         document.getElementById('semana2').value = '';
         console.log("(-2): " + xn); // '(-3): hij'
         alert('mayor');
         alert(x);
         $('#semana2').val('120.00');
        
       }else{
         document.getElementById('semana').value = 'Semana 23'; 
         console.log("(-2): " + yn);
         alert('menor');
       }    
   }
}
</script> 
<script>
function myFunctionDateTwo() {
   var x = document.getElementById("semana").value;
   var xn = Number(x.substr(-3));
   var y = document.getElementById("semana2").value;
   var yn = Number(y.substr(-3));
   //var num1 = new Number(x);
   //var num2 = new Number(y);

    if(yn > xn){
       $('#semana2').val(document.getElementById("semana2").value);
       console.log("(-2): " + xn); // '(-3): hij'
    }else {
        $('#semana2').val(document.getElementById("semana").value);
       console.log("(-2): " + yn); // '(-3): hij' 
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
