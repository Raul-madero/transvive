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
    header('Location: ordenes_servicio.php');
    mysqli_close($conection);
  }
  $idsol = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM solicitud_credito WHERE id = $idsol /*and estatus = 1*/");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: solicitud_credito.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id           = $data['id'];
      $fcha_recep   = $data['fecha_recepcion'];
      $cliente      = $data['cliente'];
      $regimen      = $data['regimen'];
      $monto_sol    = $data['monto_solicitado'];
      $plazo        = $data['plazo'];
      $razon_social = $data['razon_social'];
      $calle_fiscal = $data['calle_fiscal'];
      $entrecalles  = $data['entrecalles'];
      $colonia      = $data['colonia'];
      $ciudad       = $data['ciudad'];
      $municipio    = $data['municipio'];
      $sector       = $data['sector'];
      $estado       = $data['estado'];
      $cpfiscal     = $data['cpfiscal'];
      $giro         = $data['giro'];
      $telefono     = $data['telefono'];
      $fax          = $data['fax'];
      $correo       = $data['correo'];
      $antiguedad   = $data['antiguedad'];
      $nombre_rep   = $data['nombre_rep'];
      $rfc_rep      = $data['rfc_rep'];
      $calle_rep    = $data['calle_rep'];
      $entre_rep    = $data['entrecalles_rep'];
      $colonia_rep  = $data['colonia_rep'];
      $ciudad_rep   = $data['ciudad_rep'];
      $estado_rep   = $data['estado_rep'];
      $nac_rep      = $data['nacionalidad_rep'];
      $mail_rep     = $data['correo_rep'];
      $phone_rep    = $data['telefono_rep'];
      $banco1       = $data['banco1'];
      $sucursal1    = $data['sucursal1'];
      $nocuenta1    = $data['nocuenta1'];
      $phonebanco1  = $data['telefonobanco1'];
      $ejecutivo1   = $data['ejecutivo1'];
      $banco2       = $data['banco2'];
      $sucursal2    = $data['sucursal2'];
      $nocuenta2    = $data['nocuenta2'];
      $phonebanco2  = $data['telefonobanco2'];
      $ejecutivo2   = $data['ejecutivo2'];
      $banco3       = $data['banco3'];
      $sucursal3    = $data['sucursal3'];
      $nocuenta3    = $data['nocuenta3'];
      $phonebanco3  = $data['telefonobanco3'];
      $ejecutivo3   = $data['ejecutivo3'];
      $proveedor1   = $data['proveedor1'];
      $phoneprov1   = $data['telefono_prov1'];
      $contactopro1 = $data['contacto_prov1'];
      $proveedor2   = $data['proveedor2'];
      $phoneprov2   = $data['telefono_prov2'];
      $contactopro2 = $data['contacto_prov2'];
      $proveedor3   = $data['proveedor3'];
      $phoneprov3   = $data['telefono_prov3'];
      $contactopro3 = $data['contacto_prov3'];
      $proveedor4   = $data['proveedor4'];
      $phoneprov4   = $data['telefono_prov4'];
      $contactopro4 = $data['contacto_prov4'];
      $nombre_aval  = $data['nombre_aval'];
      $rfc_aval     = $data['rfc_aval'];
      $calle_aval   = $data['calle_aval'];
      $entre_aval   = $data['entrecalles_aval'];
      $colonia_aval = $data['colonia_aval'];
      $sector_aval  = $data['sector_aval'];
      $ciudad_aval  = $data['ciudad_aval'];
      $cpaval       = $data['cpaval'];
      $estado_aval  = $data['estado_aval'];
      $nacion_aval  = $data['nacionalidad_aval'];
      $edocivilaval = $data['edocivil_aval'];
      $phone_aval   = $data['telefono_aval'];
      $notas        = $data['observaciones'];
      $cedulafiscal = $data['cedulafiscal'];
      $dom_fiscal   = $data['domicilio_fiscal'];
      $auto_firma   = $data['autorizacion_firmada'];
      $ident_fiscal = $data['identificacion_fisica'];
      $poder_notar  = $data['poder_notarial'];
      $cedula_moral = $data['cedula_moral'];
      $ident_moral  = $data['identificacion_moral'];
      $dom_moral    = $data['domiciliofiscal_moral'];
      $auto_moral   = $data['autorizacion_moral'];
      $cliente_ref  = $data['cliente_referencia'];
      $tiempo_ref   = $data['tiempo_clienteref'];
      $diasc_ref    = $data['diascredito_referencia'];
      $monto_ref    = $data['monto_referencia'];
      $fpago_ref    = $data['formapago_referencia'];
      $banco_ref    = $data['banco_referencia'];
      $chsinfondos  = $data['cheques_sinfondos'];
      $chdevueltos  = $data['chdevueltos_referencia'];
      $montomes_ref = $data['montomensual_referencia'];
      $prod_ref     = $data['productos_referencia'];
      $spendiente   = $data['saldopendiente_referencia'];
      $cant_ref     = $data['cantidad_referencia'];
      $datraso_ref  = $data['diasatraso_referencia'];
      $dom_ref      = $data['domicilio_referencia'];
      $consid_ref   = $data['considera_ref'];
      $nproporciona = $data['nombre_proporciona'];
  
    }
  }

  include "../conexion.php";


  $sqlsup = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name from supervisores ORDER BY apellido_paterno";
  $querysup = mysqli_query($conection, $sqlsup);
  $filasup = mysqli_fetch_all($querysup, MYSQLI_ASSOC); 

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
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <style>
    .linea {
  border-top: 1px solid black;
  height: 1px;
  max-width: 800px;
  padding: 0;
  margin: 20px auto 0 auto;
}
  </style>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir:php" class="navbar-brand">
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
              } else {
               include('includes/navbar.php');
              }     
             }  
          }  
        } 
      } 

       if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 5 ) {
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
              <li class="breadcrumb-item"><a href="empleados.php">Empleados</a></li>
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
                <h3 class="card-title">Edición de Solicitud de Credito</h3>
              </div>
    
              <div class="card-body">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Generales</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Representante</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Bancarias/Comercial</a></li>
                  <li class="nav-item"><a class="nav-link" href="#aval" data-toggle="tab">Aval</a></li>
                  <li class="nav-item"><a class="nav-link" href="#doctos" data-toggle="tab">Documentos</a></li>
                   <li class="nav-item"><a class="nav-link" href="#settingss" data-toggle="tab">Referencias</a></li>
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
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Cliente:</label>
                        <div class="col-sm-5" style="text-align: left;">
                            <select class="form-control select2bs4" id="inputCliente" name="inputCliente">
                       <option value="<?php echo $cliente;?>"><?php echo $cliente;?></option>
                       <?php foreach ($filascte as $opct): //llenar las opciones del primer select ?>
                       <option value="<?= $opct['nombre_corto'] ?>"><?= $opct['nombre_corto'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                        </div>
                        
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Fecha Recepcion:</label>
                        <div class="col-sm-3">
                          <input type="date" class="form-control" id="inputDate" name="inputDate" value="<?php echo $fcha_recep;?>" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Monto Solicitado:</label>
                        <div class="col-sm-2">
                          <input type="number" step="any" class="form-control" id="inputMonto" name="inputMonto" value="<?php echo $monto_sol;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Plazo Solicitado:</label>
                        <div class="col-sm-2">
                          <input type="text" class="form-control" id="inputPlazo" name="inputPlazo" value="<?php echo $plazo;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Regimen:</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputRegimen" name="inputRegimen">
                          <option value="<?php echo $regimen;?>"><?php echo $regimen;?></option>
                          <option value="Persona Fisica">P. Fisica</option>
                          <option value="Persona Moral">P. Moral</option>       
                        </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Razón Social:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputRazonsoc" name="inputRazonsoc" placeholder="Nombre/Razón Social" value="<?php echo $razon_social;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Calle:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCalle" name="inputCalle" placeholder="Calle y Numero" value="<?php echo $calle_fiscal;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Entre las Calles:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputEntrecalle" name="inputEntrecalle" placeholder="Entre calle y calle" value="<?php echo $entrecalles;?>">
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Colonia:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputColonia" name="inputColonia" value="<?php echo $colonia;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Ciudad:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCiudad" name="inputCiudad" value="<?php echo $ciudad;?>">
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Municipio:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputMunicipio" name="inputMunicipio" value="<?php echo $municipio;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Sector:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputSector" name="inputSector" value="<?php echo $sector;?>">
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Estado:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputEstado" name="inputEstado" value="<?php echo $estado;?>" >
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">C. P.:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCpostal" name="inputCpostal" placeholder="Codigo Postal" value="<?php echo $cpfiscal;?>" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Telefono:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputTelefono" name="inputTelefono" value="<?php echo $telefono;?>" >
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">FAX:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputFax" name="inputFax" value="<?php echo $fax;?>">
                        </div>
                      </div>

                         <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Correo:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCorreo" name="inputCorreo" value="<?php echo $correo;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Giro:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputGiro" name="inputGiro" value="<?php echo $giro;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Antiguedad en el Ramo:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputAntiguedad" name="inputAntiguedad" value="<?php echo $antiguedad;?>">
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
                    <form class="form-horizontal">
                      <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id;?>">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Nombre:</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="inputNamerep" name="inputNamerep" value="<?php echo $nombre_rep;?>">
                        </div>
                        <label for="inputName" class="col-sm-1 col-form-label" style="text-align: left;">R.F.C.:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="inputRfcrep" name="inputRfcrep" placeholder="Registro Federal de Contribuyentes" value="<?php echo $rfc_rep;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Calle:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCallerep" name="inputCallerep" placeholder="Calle y Numero" value="<?php echo $calle_rep;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Entre las Calles:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputEntrecallerep" name="inputEntrecallerep" placeholder="Entre Calle y la Calle" value="<?php echo $entre_rep;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Colonia:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputColoniarep" name="inputColoniarep" value="<?php echo $colonia_rep;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Ciudad:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCiudadrep" name="inputCiudadrep" value="<?php echo $ciudad_rep;?>">
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Estado:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputEstadorep" name="inputEstadorep" value="<?php echo $estado_rep;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Nacionalidad:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputNacionalidadrep" name="inputNacionalidadrep" value="<?php echo $nac_rep;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Correo:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCorreorep" name="inputCorreorep" value="<?php echo $mail_rep;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhonerep" name="inputPhonerep" value="<?php echo $phone_rep;?>">
                        </div>
                    </div>
                   
           
                    </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                  <div class="post clearfix">
                    <form class="form-horizontal">

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;"><font color="#2371F4"> Banco:</font></label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputBanco1" name="inputBanco1" value="<?php echo $banco1;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Sucursal:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputSucursal1" name="inputSucursal1" value="<?php echo $sucursal1;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">No. de Cuenta:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputNocuenta1" name="inputNocuenta1" value="<?php echo $nocuenta1;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhonebanco1" name="inputPhonebanco1" value="<?php echo $phonebanco1;?>">
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Ejecutivo:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEjecutivo1" name="inputEjecutivo1" placeholder="Nombre del Ejecutivo" value="<?php echo $ejecutivo1;?>">
                        </div>
                    </div>
                   
                     <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;"><font color="#2371F4"> Banco:</font></label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputBanco2" name="inputBanco2" value="<?php echo $banco2;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Sucursal:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputSucursal2" name="inputSucursal2" value="<?php echo $sucursal2;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">No. de Cuenta:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputNocuenta2" name="inputNocuenta2" value="<?php echo $nocuenta2;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhonebanco2" name="inputPhonebanco2" value="<?php echo $phonebanco2;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Ejecutivo:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEjecutivo2" name="inputEjecutivo2" placeholder="Nombre del Ejecutivo" value="<?php echo $ejecutivo2;?>">
                        </div>
                    </div>

                    
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;"><font color="#2371F4"> Banco:</font></label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputBanco3" name="inputBanco3" value="<?php echo $banco3;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Sucursal:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputSucursal3" name="inputSucursal3" value="<?php echo $sucursal3;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">No. de Cuenta:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputNocuenta3" name="inputNocuenta3" value="<?php echo $nocuenta3;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhonebanco3" name="inputPhonebanco3" value="<?php echo $phonebanco3;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Ejecutivo:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEjecutivo3" name="inputEjecutivo3" placeholder="Nombre del Ejecutivo" value="<?php echo $ejecutivo3;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;"><font color="#19A367">Proveedor:</font></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputProveedor1" name="inputProveedor1" value="<?php echo $proveedor1;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhoneprov1" name="inputPhoneprov1" value="<?php echo $phoneprov1;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Contacto:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputContactoprov1" name="inputContactoprov1" value="<?php echo $contactopro1;?>">
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;"><font color="#19A367">Proveedor:</font></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputProveedor2" name="inputProveedor2" value="<?php echo $proveedor2;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhoneprov2" name="inputPhoneprov2" value="<?php echo $phoneprov2;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Contacto:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputContactoprov2" name="inputContactoprov2" value="<?php echo $contactopro2;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;"><font color="#19A367">Proveedor:</font></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputProveedor3" name="inputProveedor3" value="<?php echo $proveedor3;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhoneprov3" name="inputPhoneprov3" value="<?php echo $phoneprov3;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Contacto:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputContactoprov3" name="inputContactoprov3" value="<?php echo $contactopro3;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;"><font color="#19A367">Proveedor:</font></label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputProveedor4" name="inputProveedor4" value="<?php echo $proveedor4;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhoneprov4" name="inputPhoneprov4" value="<?php echo $phoneprov4;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Contacto:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputContactoprov4" name="inputContactoprov4" value="<?php echo $contactopro4;?>">
                        </div>
                    </div>

                      
                      </form>
                      </div>
                    
                  </div>  

                   <div class="tab-pane" id="aval">
                  <div class="post clearfix">
                    <form class="form-horizontal">

                       
                   <div class="form-group row">
                      <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Nombre:</label>
                        <div class="col-sm-6">
                          <input type="text" class="form-control" id="inputNameaval" name="inputNameaval" placeholder="Nombre del Aval" value="<?php echo $nombre_aval;?>">
                        </div>
                      <label for="inputName" class="col-sm-1 col-form-label" style="text-align: left;">R.F.C.:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="inputRfcaval" name="inputRfcaval" placeholder="Registro Federal de Contribuyentes" value="<?php echo $rfc_aval;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Calle:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCalleaval" name="inputCalleaval" placeholder="Calle y Numero" value="<?php echo $calle_aval;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Entre las Calles:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputEntrecalleaval" name="inputEntrecalleaval" placeholder="Entre Calle y la Calle" value="<?php echo $entre_aval;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Colonia:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputColoniaaval" name="inputColoniaaval" value="<?php echo $colonia_aval;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Ciudad:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCiudadaval" name="inputCiudadaval" value="<?php echo $ciudad_aval;?>">
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Estado:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputEstadoaval" name="inputEstadoaval" value="<?php echo $estado_aval;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Sector:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputSectoraval" name="inputSectoraval" value="<?php echo $sector_aval;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Codipo Postal:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCpaval" name="inputCpaval" value="<?php echo $cpaval;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Nacionalidad:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputNacionalidadaval" name="inputNacionalidadaval" value="<?php echo $nacion_aval;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Estado Civil:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputEdocivilaval" name="inputEdocivilaval" value="<?php echo $edocivilaval;?>">
                        </div>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Teléfonos:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputPhoneaval" name="inputPhoneaval" value="<?php echo $phone_aval;?>">
                        </div>
                    </div>
                   
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Observaciones:</label>
                        <div class="col-sm-10" style="text-align:left;">
                          <textarea class="form-control" rows="1" id="comentarios" name="comentarios"><?php echo $notas;?></textarea>
                        </div>
                      </div>
                      
                      </form>
                      </div>
                    
                  </div>  


                    <div class="tab-pane" id="doctos">
                  <div class="post clearfix">
                    <form class="form-horizontal">

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label" style="text-align: center;">ADJUNTAR DOCUMENTOS PARA PERSONA FISICA</label>
                        <label for="inputName" class="col-sm-6 col-form-label" style="text-align: center;">ADJUNTAR DOCUMENTOS PARA PERSONA MORAL</label>
                        
                    </div>
                       
                       <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Copia de la cédula de contribuyentes de la SHCP:</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputCedulafisica" name="inputCedulafisica">
                          <option value="<?php echo $cedulafiscal;?>"><?php echo $cedulafiscal;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>

                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Copia del poder notarial del Representante Legal:</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputPodermoral" name="inputPodermoral">
                          <option value="<?php echo $poder_notarder;?>"><?php echo $poder_notar;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Copia de comprobante de domicilio fiscal:</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputDomiciliofiscal" name="inputDomiciliofiscal">
                          <option value="<?php echo $dom_fiscal;?>"><?php echo $dom_fiscal;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>

                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Copia de la cédula de contribuyentes de la SHCP:</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputCedulamoral" name="inputCedulamoral">
                          <option value="<?php echo $cedula_moral;?>"><?php echo $cedula_moral;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Autorización firmada para solicitar reporte de crédito (Buró de crédito):</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputAutorizafisica" name="inputAutorizafisica">
                          <option value="<?php echo $auto_firma;?>"><?php echo $auto_firma;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>

                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Copia de la identificación del Representante Legal:</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputIdentificamoral" name="inputIdentificamoral">
                          <option value="<?php echo $ident_moral;?>"><?php echo $ident_moral;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Copia de identificación del dueño:</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputIdentificafisica" name="inputIdentificafisica">
                          <option value="<?php echo $ident_fiscal;?>"><?php echo $ident_fiscal;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>

                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Copia de comprobante de domicilio fiscal:</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputDomiciliomoral" name="inputDomiciliomoral">
                          <option value="<?php echo $dom_moral;?>"><?php echo $dom_moral;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label" style="text-align: left;"></label>
                       

                        <label for="inputName" class="col-sm-4 col-form-label" style="text-align: left;">Autorización firmada para solicitar reporte de crédito (Buró de crédito):</label>
                        <div class="col-sm-2">
                          <select class="form-control" id="inputAutorizamoral" name="inputAutorizamoral">
                          <option value="<?php echo $auto_moral;?>"><?php echo $auto_moral;?></option>
                          <option value="SI">SI</option>
                          <option value="NO">NO</option>       
                        </select>
                        </div>
                    </div>

                      
                      </form>
                      </div>
                    
                  </div>  
 
                  <!-- /.tab-pane -->
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settingss">
                  <div class="post clearfix">
                    <form class="form-horizontal">
                      
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">1. ¿Nombre de su Cliente?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputClienreref" name="inputClienreref" value="<?php echo $cliente_ref;?>">
                        </div>
                      </div>
                   
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">1. ¿Desde Cuando es su Cliente?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputTiempocliente" name="inputTiempocliente" value="<?php echo $tiempo_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">2. ¿Días de Crédito:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputDiascredito" name="inputDiascredito" value="<?php echo $diasc_ref;?>">
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">3. Monto de su Crédito:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputMontocredito" name="inputMontocredito" value="<?php echo $monto_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">4. ¿Forma de Pago?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputFormapago" name="inputFormapago" value="<?php echo $fpago_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">5. ¿Por medio de cual Banco?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputCualbanco" name="inputCualbanco" value="<?php echo $banco_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">6. ¿Ha tenido Cheques Devueltos por falta de fondos?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputChequefondos" name="inputChequefondos" value="<?php echo $chsinfondos;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">7. ¿Ha tenido Cheques Devueltos por cualquier otra situación Financiera?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputChequedevueltos" name="inputChequedevueltos" value="<?php echo $chdevueltos;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">8. Monto de Compras Mensuales:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputComprasmes" name="inputComprasmes" value="<?php echo $montomes_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">9. ¿Que Productos o Servicios le proporciona?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputProductos" name="inputProductos" value="<?php echo $prod_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">10. ¿En este momento tiene algún saldo pendiente con ustedes?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputSaldopendiente" name="inputSaldopendiente" value="<?php echo $spendiente;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">11. ¿Porque Cantidad?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputCantidadsaldo" name="inputCantidadsaldo" value="<?php echo $cant_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">12. Días de Atraso en Pagos:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputDiasatraso" name="inputDiasatraso" value="<?php echo $datraso_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">13. Domicilio del cliente:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputDomicilioref" name="inputDomicilioref" value="<?php echo $dom_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">14. En términos Generales ¿Cómo considera a su cliente?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputTerminos" name="inputTerminos" value="<?php echo $consid_ref;?>">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-5 col-form-label" style="text-align: left;">15. Nombre y Puesto de quien Proporciona los Datos?:</label>
                        <div class="col-sm-7" style="text-align:left;">
                          <input class="form-control" id="inputProporciona" name="inputProporciona" value="<?php echo $nproporciona;?>">
                        </div>
                      </div>


                      <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;
                          <button type="submit" class="btn btn-success" id="guardar_cliente">Guardar</button>
                        </div>
                      </div>
                  
                    </form>
                  </div>  
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

                  <!-- /.tab-pane -->
                
                <!-- /.tab-content -->
              <!-- /.card-body -->
            
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
function PasarValor()
{
document.getElementById("inputSaldoAdeudo").value = parseFloat(document.getElementById("inputDeuda").value) + parseFloat(document.getElementById("inputAdeudo").value);
}
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
             //*location.href = 'lista_ncplantasa.php';
             console.log("Alerta cerrada");
        } else {
            // Dijeron que no
            //*location.reload();
            location.href = 'solicitud_credito.php';
        }
    });

   

    });
    </script>

<script>
   $('#guardar_cliente').click(function(e){
        e.preventDefault();

       var idsc         = $('#inputId').val();
       var cliente      = $('#inputCliente').val();
       var daterec      = $('#inputDate').val();
       var monto        = $('#inputMonto').val();
       var plazo        = $('#inputPlazo').val();
       var regimen      = $('#inputRegimen').val();
       var razonsoc     = $('#inputRazonsoc').val();
       var calle        = $('#inputCalle').val();
       var entrecalle   = $('#inputEntrecalle').val();
       var colonia      = $('#inputColonia').val();
       var ciudad       = $('#inputCiudad').val();
       var municipio    = $('#inputMunicipio').val();
       var sector       = $('#inputSector').val();
       var estado       = $('#inputEstado').val();
       var codpostal    = $('#inputCpostal').val();
       var phone        = $('#inputTelefono').val();
       var fax          = $('#inputFax').val();
       var email        = $('#inputCorreo').val();
       var giro         = $('#inputGiro').val();
       var antiguedad   = $('#inputAntiguedad').val();
       var namerep      = $('#inputNamerep').val();
       var rfcrep        = $('#inputRfcrep').val();
       var callerep      = $('#inputCallerep').val();
       var entrecallerep = $('#inputEntrecallerep').val();
       var coloniarep    = $('#inputColoniarep').val();
       var ciudadrep     = $('#inputCiudadrep').val();
       var estadorep     = $('#inputEstadorep').val();
       var nacionalrep   = $('#inputNacionalidadrep').val();
       var emailrep      = $('#inputCorreorep').val();
       var phonerep      = $('#inputPhonerep').val();
       var banco1        = $('#inputBanco1').val();
       var sucursal1     = $('#inputSucursal1').val();
       var nocuenta1     = $('#inputNocuenta1').val();
       var phonebco1     = $('#inputPhonebanco1').val();
       var ejecutivo1    = $('#inputEjecutivo1').val();
       var banco2        = $('#inputBanco2').val();
       var sucursal2     = $('#inputSucursal2').val();
       var nocuenta2     = $('#inputNocuenta2').val();
       var phonebco2     = $('#inputPhonebanco2').val();
       var ejecutivo2    = $('#inputEjecutivo2').val();
       var banco3        = $('#inputBanco3').val();
       var sucursal3     = $('#inputSucursal3').val();
       var nocuenta3     = $('#inputNocuenta3').val();
       var phonebco3     = $('#inputPhonebanco3').val();
       var ejecutivo3    = $('#inputEjecutivo3').val();
       var proveedor1    = $('#inputProveedor1').val();
       var phoneprov1    = $('#inputPhoneprov1').val();
       var contactopv1   = $('#inputContactoprov1').val();
       var proveedor2    = $('#inputProveedor2').val();
       var phoneprov2    = $('#inputPhoneprov2').val();
       var contactopv2   = $('#inputContactoprov2').val();
       var proveedor3    = $('#inputProveedor3').val();
       var phoneprov3    = $('#inputPhoneprov3').val();
       var contactopv3   = $('#inputContactoprov3').val();
       var proveedor4    = $('#inputProveedor4').val();
       var phoneprov4    = $('#inputPhoneprov4').val();
       var contactopv4   = $('#inputContactoprov4').val();
       var nameaval      = $('#inputNameaval').val();
       var rfcaval       = $('#inputRfcaval').val();
       var calleaval     = $('#inputCalleaval').val();
       var entrecalleav  = $('#inputEntrecalleaval').val();
       var coloniaaval   = $('#inputColoniaaval').val();
       var ciudadaval    = $('#inputCiudadaval').val();
       var estadoaval    = $('#inputEstadoaval').val();
       var sectoraval    = $('#inputSectoraval').val();
       var cpostalaval   = $('#inputCpaval').val();
       var nacionaval    = $('#inputNacionalidadaval').val();
       var edocivilaval  = $('#inputEdocivilaval').val();
       var phoneaval     = $('#inputPhoneaval').val();
       var comentarios   = $('#comentarios').val();
       var cedulafisica  = $('#inputCedulafisica').val();
       var podermoral    = $('#inputPodermoral').val();
       var domiciliofis  = $('#inputDomiciliofiscal').val();
       var cedulamoral   = $('#inputCedulamoral').val();
       var autorizafis   = $('#inputAutorizafisica').val();
       var identifmoral  = $('#inputIdentificamoral').val();
       var identiffisica = $('#inputIdentificafisica').val();
       var domiciliomor  = $('#inputDomiciliomoral').val();
       var autorizamoral = $('#inputAutorizamoral').val();
       var cliente_ref   = $('#inputClienreref').val();
       var timecliente   = $('#inputTiempocliente').val();
       var diascred      = $('#inputDiascredito').val();
       var montocred     = $('#inputMontocredito').val();
       var formapago     = $('#inputFormapago').val();
       var bancoref      = $('#inputCualbanco').val();
       var chequesinfon  = $('#inputChequefondos').val();
       var chequesdev    = $('#inputChequedevueltos').val();
       var comprames     = $('#inputComprasmes').val();
       var productos     = $('#inputProductos').val();
       var saldopend     = $('#inputSaldopendiente').val();
       var cantsaldo     = $('#inputCantidadsaldo').val();
       var diasatraso    = $('#inputDiasatraso').val();
       var domreferecia  = $('#inputDomicilioref').val();
       var terminosref   = $('#inputTerminos').val();
       var kproporciona  = $('#inputProporciona').val();


       var action       = 'AlmacenaEditSolicitudcredito';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idsc:idsc, cliente:cliente, daterec:daterec, monto:monto, plazo:plazo, regimen:regimen, razonsoc:razonsoc, calle:calle, entrecalle:entrecalle, colonia:colonia, ciudad:ciudad, municipio:municipio, sector:sector, estado:estado, codpostal:codpostal, phone:phone, fax:fax, email:email, giro:giro, antiguedad:antiguedad, namerep:namerep, rfcrep:rfcrep, callerep:callerep, entrecallerep:entrecallerep, coloniarep:coloniarep, ciudadrep:ciudadrep, estadorep:estadorep, nacionalrep:nacionalrep, emailrep:emailrep, phonerep:phonerep, banco1:banco1, sucursal1:sucursal1, nocuenta1:nocuenta1, phonebco1:phonebco1, ejecutivo1:ejecutivo1, banco2:banco2, sucursal2:sucursal2, nocuenta2:nocuenta2, phonebco2:phonebco2, ejecutivo2:ejecutivo2, banco3:banco3, sucursal3:sucursal3, nocuenta3:nocuenta3, phonebco3:phonebco3, ejecutivo3:ejecutivo3, proveedor1:proveedor1, phoneprov1:phoneprov1, contactopv1:contactopv1, proveedor2:proveedor2, phoneprov2:phoneprov2, contactopv2:contactopv2, proveedor3:proveedor3, phoneprov3:phoneprov3, contactopv3:contactopv3, proveedor4:proveedor4, phoneprov4:phoneprov4, contactopv4:contactopv4, nameaval:nameaval, rfcaval:rfcaval, calleaval:calleaval, entrecalleav:entrecalleav, coloniaaval:coloniaaval, ciudadaval:ciudadaval, estadoaval:estadoaval, sectoraval:sectoraval, cpostalaval:cpostalaval, nacionaval:nacionaval, edocivilaval:edocivilaval, phoneaval:phoneaval, comentarios:comentarios, cedulafisica:cedulafisica, podermoral:podermoral, domiciliofis:domiciliofis, cedulamoral:cedulamoral, autorizafis:autorizafis, identifmoral:identifmoral, identiffisica:identiffisica, domiciliomor:domiciliomor, autorizamoral:autorizamoral, cliente_ref:cliente_ref, timecliente:timecliente, diascred:diascred, montocred:montocred, formapago:formapago, bancoref:bancoref, chequesinfon:chequesinfon, chequesdev:chequesdev, comprames:comprames, productos:productos, saldopend:saldopend, cantsaldo:cantsaldo, diasatraso:diasatraso, domreferecia:domreferecia, terminosref:terminosref, kproporciona:kproporciona},

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
                          text: "SOLICITUD CREDITO EDITADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'solicitud_credito.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'solicitud_credito.php';
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
     $('#inputInicoc').blur(function(){ 

     m1 = document.getElementById("inputTipoContrato").value; 
     
    

    if (m1 == "Eventual") {
      
      

      
      var dat1 = document.getElementById('inputInicoc').value;
      var date = Date.parse(dat1);
      var oneDay = 720*60*60*1000;   // hours*minutes*seconds*milliseconds
      var menosDay = 24*60*60*1000;
      var diffDays = date + oneDay;

      var datetime = diffDays; // anything
      var date2 = new Date(datetime);
      var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      var result = date2.toLocaleDateString( date2.getTimezoneOffset(), options );
      var fecha_iso = result.replace(/\//g, '-').split('-').reverse().join('-');

      //alert(result);
    
      document.getElementById("inputVence").value = fecha_iso;
       

    }
         
     });
 });
</script>
<!--
<script>
$(document).ready(function(){
     $('#inputTipoContrato').change(function(){ 

     m1 = document.getElementById("inputTipoContrato").value; 

    if (m1 == "Eventual") {
      //alert('Eventual');

      document.getElementById('modalPeriodo').style.visibility = 'visible';
       

      /*
      var dat1 = document.getElementById('inputInicoc').value;
      var date = Date.parse(dat1);
      var oneDay = 720*60*60*1000;   // hours*minutes*seconds*milliseconds
      var menosDay = 24*60*60*1000;
      var diffDays = date + oneDay;

      var datetime = diffDays; // anything
      var date2 = new Date(datetime);
      var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      var result = date2.toLocaleDateString( date2.getTimezoneOffset(), options );
      var fecha_iso = result.replace(/\//g, '-').split('-').reverse().join('-');

      //alert(result);
    
      document.getElementById("inputVence").value = fecha_iso;
      */  
    }else {
      document.getElementById('modalPeriodo').style.visibility = 'hidden';
     
    }
         
     });
 });
</script>
-->

<script> 
  $(document).ready(function (e) {
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

    var noemp = document.getElementById("inputNoempleado").value
    var valor = document.getElementById("inputInicoc").value
    
      $(e.currentTarget).find('#form_pass_noempleado').val(noemp);
      $(e.currentTarget).find('#form_pass_finicio').val(valor);
     
      
  });
});
</script>


  
   <div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Registrar Periodo</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Empleado:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_noempleado" name="form_pass_noempleado" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Inicio de Contrato:</label>
           <div class="col-sm-9">
              <input type="date" class="form-control" id="form_pass_finicio" name="form_pass_finicio" readonly>
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fin de Contrato:</label>
           <div class="col-sm-9">
              <input type="Date" class="form-control" id="form_pass_ffin" name="form_pass_ffin">
           </div>
        </div> 

       <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:20%; background-color:#e9ecef; text-align: center;" >No. Empleado</th>
                               <th style="width:35%; background-color:#e9ecef; text-align: center;">Inicia Contrato</th>
                               <th style="width:35%; background-color:#e9ecef; text-align: center;">Vence Contrato</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                          <tbody id="detalle_mantto">
                          </tbody>
                          </table>
                     
                      </div>

        <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Registra Periodo</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var idc       = $('#form_pass_idc').val();
        var datefin   = $('#form_pass_dfinal').val();
        var hregreso  = $('#form_pass_hregreso').val();
        var sueldovta = $('#form_pass_sueldovta').val(); 
        var origen    = $('#form_pass_origen').val();
        var destino   = $('#form_pass_destino').val();
        var unidades  = $('#form_pass_nounidades').val();
        var costo     = $('#inputCostov').val();


       var action       = 'AddEditVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idc:idc, datefin:datefin, hregreso:hregreso, sueldovta:sueldovta, origen:origen, destino:destino, unidades:unidades, costo:costo},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            alert('Vuelta Registrada Correctamente');

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            
    
                        }else{
                           console.log('no data');
                           alert('faltan datos');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>  

   <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-coreui-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-coreui-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
   $(function(){ 
      $('#inputNace').on('change', calcularEdad);
   });
   
   function calcularEdad() {
    fecha = $(this).val();
            var hoy = new Date();
            var cumpleanos = new Date(fecha);
            var edad = hoy.getFullYear() - cumpleanos.getFullYear();
            var m = hoy.getMonth() - cumpleanos.getMonth();

            if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                edad--;
            
            }
    $('#inputEdad').val(edad);
    }        

</script>

<script>
    $(document).ready(function () {
        $("#inputClasifcat").on('change', function () {            
            var op = $(this).val();
            if ( op === "A") {
              document.getElementById("inputBonosc2").value = 0; 
            }else {
              if (op === "AA") {
               document.getElementById("inputBonosc2").value = 350; 
              }else {
                if (op === "AAA") {
                  document.getElementById("inputBonosc2").value = 700;
                }
              }
            }  
           
       
        });
    });
</script>  

<script>
    $(document).ready(function () {
        $("#inputCliente").on('change', function () {            
            var op       = $(this).val();
          
                var action = 'searchDatosClienteDir';

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
                    $('#inputCalle').val('');
                    $('#inputColonia').val('');
                    $('#inputCiudad').val('');
                    $('#inputMunicipio').val('');
                    $('#inputEstado').val('');
                    $('#inputCpostal').val('');
                    $('#inputRazonsoc').val('');
                    $('#inputTelefono').val('');
                    $('#inputCorreo').val();
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputCalle').val(data.calle); // Notify only Select2 of changes
                    $('#inputColonia').val(data.colonia);
                    $('#inputCiudad').val(data.ciudad);
                    $('#inputMunicipio').val(data.municipio);
                    $('#inputEstado').val(data.estado);
                    $('#inputCpostal').val(data.cod_postal);
                    $('#inputRazonsoc').val(data.nombre);
                    $('#inputTelefono').val(data.telefono);
                    $('#inputCorreo').val(data.correo);
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
