<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqlopr   = "select nombre, rol, idusuario from usuario where rol = 8  ORDER BY nombre";
  $queryopr = mysqli_query($conection, $sqlopr);
  $filasopr = mysqli_fetch_all($queryopr, MYSQLI_ASSOC); 

  $sqlact= mysqli_query($conection,"SELECT no_cliente from clientes  order by no_cliente desc limit 1");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

 
    while ($data = mysqli_fetch_array($sqlact)){
      $folioom = $data['no_cliente'] + 1 ;
  
      
    }


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
            if ($_SESSION['rol'] == 9) {
              include('includes/navbargrcia.php');
            }else {
              if ($_SESSION['rol'] == 14) {
                include('includes/navbarcalidad.php');
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
              <li class="breadcrumb-item"><a href="clientes.php">Clientes</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>
    <div class="col-md-9" >
    <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Alta Cliente</h3>
              </div>
    
              <div class="card-body">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Generales</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Fiscales</a></li>
                  <!--<li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Direccion</a></li>-->
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                   
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                    <form class="form-horizontal">

                       <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label" style="text-align: left;">No. Cliente:</label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="inputNocliente" name="inputNocliente" value="<?php echo $folioom;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Nombre Comercial Cliente:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre Comecial del Cliente">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Calle y Numero:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputCallenum" name="inputCallenum" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Colonia:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputColonia" name="inputColonia">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Ciudad:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputCiudad" name="inputCiudad" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Municipio:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputMunicipio" name="inputMunicipio">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Estado:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="inputEstado" name="inputEstado">
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Codigo Postal:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="inputCpostal" name="inputCpostal">
                        </div>
                      </div>

                         <div class="form-group row" hidden>
                        <label for="inputName" class="col-sm-1 col-form-label" style="text-align: left;">País:</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="inputPais" name="inputPais">
                        </div>
                      </div>

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Numero de Teléfono (con Lada):</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Incluir clave lada">
                        </div>
                      </div>  

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Contacto RH/Compras:</label>
                        <div class="col-sm-9">
                          <input type="input" class="form-control" id="inputContactorh" name="inputContactorh" >
                        </div>
                      </div>  

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Correo Electrónico RH/Compras:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputCorreorh" name="inputCorreorh" >
                        </div>
                      </div> 

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Número de Teléfono de Contacto:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputTelcontacto" name="inputTelcontacto" >
                        </div>
                      </div> 

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Giro de la empresa:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputGiro" name="inputGiro" >
                        </div>
                      </div>  

                      <div class="form-group row" hidden>
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Tipo de Servicio:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputServicio" name="inputServicio" >
                        </div>
                      </div>  

                       <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sitio Web:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputSitioweb" name="inputSitioweb" >
                        </div>
                      </div> 

                       <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Tipo de Cliente:</label>
                        <div class="col-sm-9">
                          <select name="inputTipocontrato" id="inputTipocontrato" required class="form-control custom-select" >
                              <option value="">--  Seleccione --</option>
                              <option value="Contrato">Contrato</option>
                              <option value="Especial">Especial</option>
                           </select>
                        </div>
                      </div> 

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Inicio Contrato:</label>
                        <div class="col-sm-3">
                          <input type="date" class="form-control" id="inputDateini" name="inputDateini" >
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fin Contrato:</label>
                        <div class="col-sm-3">
                          <input type="date" class="form-control" id="inputDatefin" name="inputDatefin" >
                        </div>
                      </div>

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Jefe de Operaciones:</label>
                        <div class="col-sm-9">
                          <select class="form-control" style="width: 100%;" name="fsupervisor" id="fsupervisor">
                  <option value="Select">Select</option>
                  <?php foreach ($filasopr as $opr): //llenar las opciones del primer select ?>
                  <option value="<?= $opr['idusuario'] ?>"><?= $opr['nombre'] ?></option>  
                  <?php endforeach; ?>
                </select> 
                        </div>
                      </div>   

                    </form>
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                  
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="post clearfix">
                    <form class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Razón Social:</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="inputRazonsoc" name="inputRazonsoc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">R.F.C.:</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="inputRfc" name="inputRfc" placeholder="Registro Federal de Contibuyentes">
                        </div>
                    </div>  

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Forma de Pago:</label>
                        <div class="col-sm-9">
                          <select name="fformpa" id="fformpa" required class="form-control custom-select" >
                              <option value="">--  Seleccione --</option>
                              <option value="01 Efectivo">01 Efectivo</option>
                              <option value="02 Cheque nominativo">02 Cheque nominativo</option>
                              <option value="03 Transferencia electronica de fondos">03 Transferencia electronica de fondos</option>
                              <option value="04 Tarjeta de credito">04 Tarjeta de credito</option>
                              <option value="05 Monedero electronico">05 Monedero electronico</option>
                              <option value="06 Dinero electronico">06 Dinero electronico</option>
                              <option value="08 Vales de despensa">08 Vales de despensa</option>
                              <option value="28 Tarjeta de debito">28 Tarjeta de debito</option>
                              <option value="29 Tarjeta de servicio">29 Tarjeta de servicio</option>
                              <option value="99 Otros">99 Otros</option>
                           </select>
                        </div>
                    </div>   

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Método de Pago:</label>
                        <div class="col-sm-9">
                          <select name="fmetd" id="fmetd" required class="form-control custom-select" >
                            <option value="">--  Seleccione --</option>
                            <option value="PUE Pago de Una Sola Exhibicion">PUE - Pago de Una Sola Exhibición</option>
                            <option value="PPD Pago en Parcialidades o Diferidos">PPD - Pago en Parcialidades o Diferidos</option>
                          </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Uso de CFDI:</label>
                        <div class="col-sm-9">
                          <select name="fusocfdi" id="fusocfdi" required class="form-control custom-select" >
                            <option value="">-- Seleccione --</option>
                            <option value="G01 - Adquisición de mercancias">G01 - Adquisición de mercancías</option>
                            <option value="G02 - Devoluciones, descuentos o bonificaciones">G02 - Devoluciones, descuentos o bonificaciones</option>
                            <option value="G03 - Gastos en general">G03 - Gastos en general</option>
                            <option value="I01 - Construcciones">I01 - Construcciones</option>
                            <option value="I02 - Mobiliario y equipo de oficina por inversiones">I02 - Mobiliario y equipo de oficina por inversiones</option>
                            <option value="I03 - Equipo de transporte">I03 - Equipo de transporte</option>
                            <option value="I04 - Equipo de computo y accesorios">I04 - Equipo de computo y accesorios</option>
                            <option value="I08 - Otra maquinaria y equipo">I08 - Otra maquinaria y equipo</option>
                            <option value="D02 - Gastos médicos por incapacidad o discapacidad">D02 - Gastos médicos por incapacidad o discapacidad</option>
                            <option value="D04 - Donativos">D04 - Donativos</option>
                            <option value="D08 - Gastos de transportación escolar obligatoria">D08 - Gastos de transportación escolar obligatoria</option>
                            <option value="D10 - Pagos por servicios educativos (colegiaturas)">D10 - Pagos por servicios educativos (colegiaturas)</option>
                            <option value="S01 - Sin efectos fiscales">S01 - Sin efectos fiscales</option>
                            <option value="CP01 - Pagos">CP01 - Pagos</option>

                          </select>
                        </div>
                    </div> 

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Contacto Contabilidad:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputCcontabilidad" name="inputCcontabilidad" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Correo Electrónico Contabilidad:</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="inputMailc" name="inputMailc" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Credito:</label>
                        <div class="col-sm-3">
                          <select name="fCredito" id="fCredito" required class="form-control custom-select" >
                            <option value="">--  Seleccione --</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                          </select>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Condiciones de Credito:</label>
                        <div class="col-sm-3">
                          <select name="fConcredito" id="fConcredito" required class="form-control custom-select" >
                            <option value="">--  Seleccione --</option>
                            <option value="7 DIAS">7 DIAS</option>
                            <option value="15 DIAS">15 DIAS</option>
                            <option value="30 DIAS">30 DIAS</option>
                          </select>
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
                  </div>
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
            location.href = 'clientes.php';
        }
    });

   

    });
    </script>

<script>
   $('#guardar_Cliente').click(function(e) {
    e.preventDefault();

    // Obtener y validar los valores requeridos
    var nocte        = $('#inputNocliente').val().trim();
    var namecte      = $('#inputName').val().trim();

    if (nocte === '' || namecte === '') {
        Swal.fire({
            icon: 'warning',
            title: 'Campos requeridos',
            text: 'Por favor, ingresa el número de cliente y el nombre del cliente.',
        });
        return;
    }

    // Obtener el resto de los valores
    var callenum     = $('#inputCallenum').val();
    var colonia      = $('#inputColonia').val();
    var ciudad       = $('#inputCiudad').val();
    var municipio    = $('#inputMunicipio').val();
    var estado       = $('#inputEstado').val();
    var codpostal    = $('#inputCpostal').val();
    var pais         = $('#inputPais').val();
    var phone        = $('#inputPhone').val();
    var contactorh   = $('#inputContactorh').val();
    var correorh     = $('#inputCorreorh').val();
    var giro         = $('#inputGiro').val();
    var phonecontac  = $('#inputTelcontacto').val();
    var servicio     = $('#inputServicio').val();
    var sitioweb     = $('#inputSitioweb').val();
    var tipocontrato = $('#inputTipocontrato').val();
    var dateinic     = $('#inputDateini').val();
    var datefinc     = $('#inputDatefin').val();
    var razonsoc     = $('#inputRazonsoc').val();
    var rfccte       = $('#inputRfc').val();
    var formapago    = $('#fformpa').val();
    var metodopago   = $('#fmetd').val();
    var usocfdi      = $('#fusocfdi').val();
    var contactocont = $('#inputCcontabilidad').val();
    var emailconta   = $('#inputMailc').val();
    var credito      = $('#fCredito').val();
    var condicionesc = $('#fConcredito').val();
    var supervisor   = $('#fsupervisor').val();

    var action       = 'AlmacenaCliente';

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async: true,
        data: {
            action: action,
            nocte: nocte,
            namecte: namecte,
            callenum: callenum,
            colonia: colonia,
            ciudad: ciudad,
            municipio: municipio,
            estado: estado,
            codpostal: codpostal,
            pais: pais,
            phone: phone,
            contactorh: contactorh,
            correorh: correorh,
            giro: giro,
            phonecontac: phonecontac,
            servicio: servicio,
            sitioweb: sitioweb,
            tipocontrato: tipocontrato,
            dateinic: dateinic,
            datefinc: datefinc,
            razonsoc: razonsoc,
            rfccte: rfccte,
            formapago: formapago,
            metodopago: metodopago,
            usocfdi: usocfdi,
            contactocont: contactocont,
            emailconta: emailconta,
            credito: credito,
            condicionesc: condicionesc,
            supervisor: supervisor
        },
        success: function(response) {
            try {
                var info = JSON.parse(response);
                console.log(info);

                if (info.success === true) {
                    Swal.fire({
                        title: "¡Éxito!",
                        text: "CLIENTE ALMACENADO CORRECTAMENTE",
                        icon: 'success',
                    }).then((resultado) => {
                        if (resultado.value) {
                            location.href = 'clientes.php';
                        } else {
                            location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: info.message || 'No se pudo guardar el cliente.',
                    });
                }
            } catch (e) {
                console.error('Error al interpretar la respuesta del servidor:', response);
                Swal.fire({
                    icon: 'error',
                    title: 'Error inesperado',
                    text: 'La respuesta del servidor no es válida.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            Swal.fire({
                icon: 'error',
                title: 'Error de red',
                text: 'No se pudo comunicar con el servidor.',
            });
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
