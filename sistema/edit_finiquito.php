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
    header('Location: finiquitos.php');
    mysqli_close($conection);
  }
  $idfin = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM finiquitos WHERE id = $idfin");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: finiquitos.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id             = $data['id'];
      $noempleado     = $data['no_empleado'];
      $empleado       = $data['empleado'];
      $fcha           = $data['fecha'];
      $fcha_ingreso   = $data['fecha_ingreso'];
      $fcha_baja      = $data['fecha_baja'];
      $antiguedad     = $data['antiguedad'];
      $dias_trab      = $data['dias_trabajados'];
      $dias_semana    = $data['diasultima_semana'];
      $salario_sem    = $data['salario_semanal'];
      $salario_dia    = $data['salario_diario'];
      $vacaciones     = $data['vacaciones'];
      $prop_vacac     = $data['proproporcional_vacaciones'];
      $prima_vacac    = $data['prima_vacacional'];
      $dias_aguinaldo = $data['dias_aguinaldo'];
      $prop_aguinaldo = $data['proporcinal_aguinaldo'];
      $imp_semana     = $data['importe_ultimasemana'];
      $imp_aguinaldo  = $data['importe_agunaldo'];
      $imp_viajes     = $data['importe_viajes'];
      $imp_vacaciones = $data['importe_vacaciones'];
      $imp_prima      = $data['importe_primavac'];
      $ocompensacion  = $data['otras_compensaciones'];
      $imp_total      = $data['importe_total'];
      $imp_deudas     = $data['importe_deudas'];
      $neto           = $data['neto_pagar'];

      //$user   = $_SESSION['idUser'];
      
    }
  }
  include "../conexion.php";

  $sqlopr   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_empleado from empleados where estatus = 1 ORDER BY apellido_paterno";
  $queryopr = mysqli_query($conection, $sqlopr);
  $filasopr = mysqli_fetch_all($queryopr, MYSQLI_ASSOC); 

  $sqlemp   = "select noempleado from empleados ORDER BY noempleado";
  $queryemp = mysqli_query($conection, $sqlemp);
  $filasemp = mysqli_fetch_all($queryemp, MYSQLI_ASSOC); 

  /*$sqledo = "select estado from estados ORDER BY estado";
  $queryedo = mysqli_query($conection, $sqledo);
  $filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); 
  */
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
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="AdminLTE Logo"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php
       if ($_SESSION['rol'] == 1) {
        include('includes/navbar.php');
      }else {
        if ($_SESSION['rol'] == 6) {
          include('includes/navbaroperac.php');
        }else {
          if ($_SESSION['rol'] == 8) {
            include('includes/navbarjefeoper.php');
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="finiquitos.php">Finiquitos</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <?php
         date_default_timezone_set('America/Mazatlan');
         //$fcha = date("Y-m-d");
     ?>  
    <center>
    <div class="col-md-9" >
    <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edición de Finiquito</h3>
              </div>

             
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                   
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                    <form class="form-horizontal">

                    <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id;?>" >  

                        <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fcha;?>" >
                    </div>
                  </div>



               
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Empleado</label>
                    <div class="col-sm-2">
                      <select class="form-control" style="width: 100%;" name="inputNoempleado" id="inputNoempleado">
                        <option value="<?php echo $noempleado;?>"><?php echo $noempleado;?></option>
                        <?php foreach ($filasemp as $opem): //llenar las opciones del primer select ?>
                        <option value="<?= $opem['noempleado'] ?>"><?= $opem['noempleado'] ?></option>  
                        <?php endforeach; ?>
                    </select> 
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Empleado</label>
                    <div class="col-sm-6">
                    <select class="form-control select2bs4" style="width: 100%;" name="inputEmpleado" id="inputEmpleado">
                        <option value="<?php echo $empleado;?>"><?php echo $empleado;?></option>
                        <?php foreach ($filasopr as $opr): //llenar las opciones del primer select ?>
                        <option value="<?= $opr['name_empleado'] ?>"><?= $opr['name_empleado'] ?></option>  
                        <?php endforeach; ?>
                    </select>  
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Ingreso</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFechaingreso" name="inputFechaingreso" value="<?php echo $fcha_ingreso;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Baja</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFechabaja" name="inputFechabaja" value="<?php echo $fcha_baja;?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Antiguedad</label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="inputAntiguedad" name="inputAntiguedad" value="<?php echo $antiguedad;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Dias Trabajados</label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="inputDiastrab" name="inputDiastrab" value="<?php echo $dias_trab;?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Dias Trabajados (Ultima Semana)</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputDiasultima" name="inputDiasultima" value="<?php echo $dias_semana;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Salario Diario</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputSalariodia" name="inputSalariodia" value="<?php echo $salario_dia;?>">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Dias de Vacaciones</label>
                    <div class="col-sm-2">
                      <input type="number" step="any" class="form-control" id="inputDiasvacaciones" name="inputDiasvacaciones" value="<?php echo $vacaciones;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Proporcional</label>
                    <div class="col-sm-2">
                      <input type="number" step="any" class="form-control" id="inputProporvacacion" name="inputProporvacacion" value="<?php echo $prop_vacac;?>">
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Prima Vacacional (%)</label>
                    <div class="col-sm-2">
                      <input type="number" step="any" class="form-control" id="inputPorcprimavacacion" name="inputPorcprimavacacion" value="25">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Dias de Aguinaldo</label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="inputDiasaguinaldo" name="inputDiasaguinaldo" value="<?php echo $dias_aguinaldo;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Proporcional</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputPorporcionaguinaldo" name="inputPorporcionaguinaldo" value="<?php echo $prop_aguinaldo;?>">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:center; background-color: #9CB1B9;">
                    <label for="inputEmail3" class="col-sm-12 col-form-label">I M P O R T E S</label>
                    
                   </div> 

                    <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ultima Semana</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImporteusem" name="inputImporteusem" value="<?php echo $imp_semana;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Anguinaldo</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImporteaguinaldo" name="inputImporteaguinaldo" value="<?php echo $imp_aguinaldo;?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Viajes</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImporteviajes" name="inputImporteviajes" value="<?php echo $imp_viajes;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Vacaciones</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImporteVacaciones" name="inputImporteVacaciones" value="<?php echo $imp_vacaciones;?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Prima Vacacional</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImporteprimavac" name="inputImporteprimavac" value="<?php echo $imp_prima;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Otras Compensaciones</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImportecompensaciones" name="inputImportecompensaciones" value="<?php echo $ocompensacion;?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Total</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImportetotal" name="inputImportetotal" value="<?php echo $imp_total;?>">
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Adeudos</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImporteadeudos" name="inputImporteadeudos" value="<?php echo $imp_deudas;?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-6 col-form-label">&nbsp;</label>
                    
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Total a Pagar</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputImportetotalpagar" name="inputImportetotalpagar" value="<?php echo $neto;?>">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                          <button type="submit" class="btn btn-success" id="guardar_Cliente">Guardar</button>
                        </div>
                      </div>

                    </form>
                    </div>
                    <!-- /.post -->
                    </div>
                  </div>
                    <!-- Post -->
                  
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->

                  <!-- /.tab-pane -->
                  <!--
                  <div class="tab-pane" id="settings">
                  <div class="post clearfix">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Calle:</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputCalle" name="inputCalle" placeholder="Calle Empresa">
                        </div>
                      </div>
                      <div class="form-group row" style="text-align:left;">
                        <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Estado:</label>
                        <div class="col-sm-10">
                        <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputEstado" name="inputEstado">
                        <option value="">- Seleccione -</option>
                                <?php foreach ($filasedo as $op): ?>
                                <option value="<?= $op['estado'] ?>"><?= $op['estado'] ?></option>
                                <?php endforeach; ?>
                        </select>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Ciudad:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputCiudad" name="inputCiudad" placeholder="Ciudad">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Codigo Postal:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputCpostal" name="inputCpostal" placeholder="Codigo Postal">
                        </div>
                      </div>
                      <div class="form-group row" style="text-align:left;">
                        <label for="inputSkills" class="col-sm-2 col-form-label" style="text-align: left;">País:</label>
                        <div class="col-sm-10">
                        <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputPais" name="inputPais">
                          <option value="México" selected="selected">México</option>
                          <option value="USA">USA</option>
                          <option value="Canada">Canada</option>
                        </select>
                        </div>
                      </div>
                    
                      <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>
                          <button type="submit" class="btn btn-success" id="guardar_Cliente">Guardar</button>
                        </div>
                      </div>
                      </div>

                    </form>
                  
                 -->
             
                <!-- /.tab-content -->
            
           
            <!-- /.card -->
         
          <!-- /.col -->
  
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
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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
            location.href = 'finiquitos.php';
        }
    });

   

    });
    </script>

<script>
   $('#guardar_Cliente').click(function(e){
        e.preventDefault();

       var idf          = $('#inputId').val();
       var fecha        = $('#inputFecha').val();
       var noempleado   = $('#inputNoempleado').val();
       var empleado     = $('#inputEmpleado').val();
       var fechaingreso = $('#inputFechaingreso').val();
       var fechabaja    = $('#inputFechabaja').val();
       var antiguedad   = $('#inputAntiguedad').val();
       var dtrabajados  = $('#inputDiastrab').val();
       var dultimasem   = $('#inputDiasultima').val();
       var salariodia   = $('#inputSalariodia').val();
       var dvacaciones  = $('#inputDiasvacaciones').val();
       var dvacproporc  = $('#inputProporvacacion').val();
       var porcprima    = $('#inputPorcprimavacacion').val();
       var daguinaldo   = $('#inputDiasaguinaldo').val();
       var daguiproporc = $('#inputPorporcionaguinaldo').val();
       var impultimasem = $('#inputImporteusem').val();
       var impaguinaldo = $('#inputImporteaguinaldo').val();
       var impviajes    = $('#inputImporteviajes').val();
       var impvacacions = $('#inputImporteVacaciones').val();
       var impprimavac  = $('#inputImporteprimavac').val();
       var otrascompens = $('#inputImportecompensaciones').val();
       var imptotal     = $('#inputImportetotal').val();
       var impadeudos   = $('#inputImporteadeudos').val();
       var impneto      = $('#inputImportetotalpagar').val();
       

       var action       = 'AlmacenaEditFiniquito';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idf:idf, fecha:fecha, noempleado:noempleado, empleado:empleado, fechaingreso:fechaingreso, fechabaja:fechabaja, antiguedad:antiguedad, dtrabajados:dtrabajados, dultimasem:dultimasem, salariodia:salariodia, dvacaciones:dvacaciones, dvacproporc:dvacproporc, porcprima:porcprima, daguinaldo:daguinaldo, daguiproporc:daguiproporc, impultimasem:impultimasem, impaguinaldo:impaguinaldo, impviajes:impviajes, impvacacions:impvacacions, impprimavac:impprimavac, otrascompens:otrascompens, imptotal:imptotal, impadeudos:impadeudos, impneto:impneto},

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
                          text: "FINIQUITO ALMACENADO CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        generarimpfiniquitoPDF(info.folio);
                        location.href = 'finiquitos.php';

                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'finiquitos.php';
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
    $(document).ready(function () {
        $("#inputNoempleado").on('change', function () {            
            var op = $(this).val();
          
            //alert (op);
            var action = 'searchDatosfiniquito';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputFechaingreso').val('');
                    $('#inputSalariodia').val('0.00');
                    $('inputEmpleado').val('');
                  
                }else{
                    var data = $.parseJSON(response);
       
                    $('#inputFechaingreso').val(data.fecha_contrato); // Notify only Select2 of changes
                    $('#inputSalariodia').val(data.salarioxdia);
                    $('#inputEmpleado').val(data.empleado).change();
                   
                }
            },
            error: function(error) {

            }

        }); 
        });
    });
</script>  

<script>
    $(document).ready(function () {
        $("#inputEmpleado").on('change', function () {            
            op = $(this).val();
          
            //alert (op);
            var action = 'searchDatosfiniquitoName';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputFechaingreso').val('');
                    $('#inputSalariodia').val('0.00');
                    $('inputNoempleado').val('');
                  
                }else{
                    var data = $.parseJSON(response);
       
                    $('#inputFechaingreso').val(data.fecha_contrato); // Notify only Select2 of changes
                    $('#inputSalariodia').val(data.salarioxdia);
                    $('#inputNoempleado').val(data.noempleado);
                   
                }
            },
            error: function(error) {

            }

        }); 
        });
    });
</script> 
<!-- 
<script>
    $(document).ready(function () {
        $("#inputFechabaja").on('change', function () {            
            var op = $(this).val();
            var fechaingreso  = $('#inputFechaingreso').val();
            var salariodiario = $('#inputSalariodia').val();
            var noempleado    = $('#inputNoempleado').val('');
          
            //alert (op);
            var action = 'searchDatosfiniquitofchabaja';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, op:op, fechaingreso:fechaingreso, salariodiario:salariodiario, noempleado:noempleado},
            success: function(response)
            {
                 console.log(response);

            },
            error: function(error) {

            }

        }); 
        });
    });
</script>
-->
<script>
    $('#inputFechabaja').change(function(e){
        e.preventDefault();

          op = $(this).val();
            var fechaingreso  = $('#inputFechaingreso').val();
            var salariodiario = $('#inputSalariodia').val();
            var noempleado    = $('#inputNoempleado').val();

          
          
            //alert (op);
            var action = 'searchDatosfiniquitofchabaja';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, op:op, fechaingreso:fechaingreso, salariodiario:salariodiario, noempleado:noempleado},
            success: function(response)
                  {
                if(response != 'error')
                    {
                      console.log(response);
                      var data = $.parseJSON(response);
                      //console.log(data);
                      $('#inputAntiguedad').val(data.dias_antiguedad);
                      $('#inputDiastrab').val(data.dias_transcursoyear);
                      $('#inputDiasultima').val(data.dias_transcursosem);
                      $('#inputDiasvacaciones').val(data.dias_tomar);
                      $('#inputProporvacacion').val(data.dias_vacacionesprop);
                      $('#inputDiasaguinaldo').val(data.dias_aguinaldo);
                      $('#inputPorporcionaguinaldo').val(data.dias_aguinaldoprop);
                      $('#inputImporteusem').val(data.importe_semana);
                      $('#inputImporteaguinaldo').val(data.importe_aguinaldo);
                      $('#inputImporteviajes').val(data.importe_viajes);
                      $('#inputImporteVacaciones').val(data.importe_vacaciones);
                      $('#inputImporteprimavac').val(data.importe_primavac);
                      $('#inputImportetotal').val(data.importe_total);
                      $('#inputImporteadeudos').val(data.importe_adeudo);
                      $('#inputImportetotalpagar').val(data.importe_neto);
                   

                           
                  }else{
                      console.log('no data');
                  }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>

    <script>
    $('#inputImportecompensaciones').change(function(e){
        e.preventDefault();

          op = $(this).val();
            var importe_total  = $('#inputImportetotal').val();
            var importe_neto   = $('#inputImportetotalpagar').val();
            var importe_adeudo = $('#inputImporteadeudos').val();

            var newimporte_total = parseFloat($('#inputImportetotal').val()) + parseFloat($(this).val());
            var newimporte_neto  = parseFloat( $('#inputImportetotalpagar').val()) + parseFloat($(this).val()) - parseFloat($('#inputImporteadeudos').val());

           
            
            $('#inputImportetotal').val(newimporte_total);
            $('#inputImportetotalpagar').val(newimporte_neto);
            //$('#inputDiasultima').val(data.dias_transcursosem);    
            
    });

    </script>

<!-- Impresion de Pedido -->
     <script type="text/javascript">
    function generarimpfiniquitoPDF(folio){
    //console.log(cliente);
    //console.log(norecibo);
    var ancho = 1000;
    var alto = 800;
    //calcular posicion x,y para centrar la ventana

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = 'factura/finiquito.php?id='+folio;
    window.open($url,"Finiquito","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

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
