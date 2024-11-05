<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  //*include "../conexion.php";
  $sqlcte = "select nombre from clientes ORDER BY nombre";
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
  <title>EASY | CRM</title>

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
      <a href="../index3.html" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="AdminLTE Logo"></span>
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
   <section class="content">
        <div class="container-fluid">
            <h2 class="text-center">Reporte de Servicios por Cliente</h2>
            <form action="enhanced-results.html">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>No. de Semana:</label>
                                   <select class="form-control select2bs4" style="width: 100%; text-align: left" id="semana" name="semana">
                                        <option value="Semana 01">Semana 01</option>
                      <option value="Semana 02">Semana 02</option>
                      <option value="Semana 03">Semana 03</option>
                      <option value="Semana 04">Semana 04</option>
                      <option value="Semana 05">Semana 05</option>
                      <option value="Semana 06">Semana 06</option>
                      <option value="Semana 07">Semana 07</option>
                      <option value="Semana 08">Semana 08</option>
                      <option value="Semana 09">Semana 09</option>
                      <option value="Semana 10">Semana 10</option>
                      <option value="Semana 11">Semana 11</option>
                      <option value="Semana 12">Semana 12</option>
                      <option value="Semana 13">Semana 13</option>
                      <option value="Semana 14">Semana 14</option>
                      <option value="Semana 15">Semana 15</option>
                      <option value="Semana 16">Semana 16</option>
                      <option value="Semana 17">Semana 17</option>
                      <option value="Semana 18">Semana 18</option>
                      <option value="Semana 19">Semana 19</option>
                      <option value="Semana 20">Semana 20</option>
                      <option value="Semana 21">Semana 21</option>
                      <option value="Semana 22">Semana 22</option>
                      <option value="Semana 23">Semana 23</option>
                      <option value="Semana 24">Semana 24</option>
                      <option value="Semana 25">Semana 25</option>
                      <option value="Semana 26">Semana 26</option>
                      <option value="Semana 27">Semana 27</option>
                      <option value="Semana 28">Semana 28</option>
                      <option value="Semana 29">Semana 29</option>
                      <option value="Semana 30">Semana 30</option>
                      <option value="Semana 31">Semana 31</option>
                      <option value="Semana 32">Semana 32</option>
                      <option value="Semana 33">Semana 33</option>
                      <option value="Semana 34">Semana 34</option>
                      <option value="Semana 35">Semana 35</option>
                      <option value="Semana 36">Semana 36</option>
                      <option value="Semana 37">Semana 37</option>
                      <option value="Semana 38">Semana 38</option>
                      <option value="Semana 39">Semana 39</option>
                      <option value="Semana 40">Semana 40</option>
                      <option value="Semana 41">Semana 41</option>
                      <option value="Semana 42">Semana 42</option>
                      <option value="Semana 43">Semana 43</option>
                      <option value="Semana 44">Semana 44</option>
                      <option value="Semana 45">Semana 45</option>
                      <option value="Semana 46">Semana 46</option>
                      <option value="Semana 47">Semana 47</option>
                      <option value="Semana 48">Semana 48</option>
                      <option value="Semana 49">Semana 49</option>
                      <option value="Semana 50">Semana 50</option>
                      <option value="Semana 51">Semana 51</option>
                      <option value="Semana 52">Semana 52</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Cliente:</label>
                                     <select class="form-control select2bs4" style="width: 100%;" name="frazonsoc" id="frazonsoc">
                  <option selected="selected">Select</option>
                  <?php foreach ($filascte as $opcte): //llenar las opciones del primer select ?>
                  <option value="<?= $opcte['nombre'] ?>"><?= $opcte['nombre'] ?></option>  
                  <?php endforeach; ?>
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
                      <a href="#" onclick="window.open ('factura/viajesespeciales_xcliente.php?id='+document.getElementById('frazonsoc').value + '*semana=' + document.getElementById('semana').value);" >

                    
                       
                          <button type ="button" class="btn btn-primary pull-left"><i class="fa fa-play"></i> Aceptar</button>
                        </a>
                      </div>
                    <div class="col-3">
                      <a href="#" onclick="window.location ='index.php';" >
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
</body>
</html>
