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
    header('Location: empleados.php');
    mysqli_close($conection);
  }
  $noempl = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM empleados WHERE noempleado = $noempl");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: empleados.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id             = $data['id'];
      $noempl         = $data['noempleado'];
      $nombres        = $data['nombres'];
      $paterno        = $data['apellido_paterno'];
      $materno        = $data['apellido_materno'];
      $cargo          = $data['cargo'];
      $tipocontrato   = $data['tipo_contrato'];
      $fcha_contrato  = $data['fecha_contrato'];
      $fin_contrato   = $data['fecha_fincontrato'];
      $imss           = $data['imss'];
      $fecha_altaimss = $data['fecha_altaimss'];
      $nss            = $data['numeross'];  
      $telefono       = $data['telefono'];
      $rfc            = $data['rfc'];
      $salarioxdia    = $data['salarioxdia'];
      $salariodiario  = $data['salario_diario'];
      $sueldobase     = $data['sueldo_base'];
      $sueldo         = $data['sueldo'];
      $sueldob2       = $data['sueldo_camioneta'];
      $camion         = $data['sueldo_especialcamion'];
      $camioneta      = $data['sueldo_especialcamioneta'];
      $ssprinter      = $data['sueldo_especialsprinter'];
      $auto           = $data['sueldo_especialauto'];
      $espsemi        = $data['sueldo_especialsemi'];
      $deuda          = $data['deuda_general'];
      $descuento      = $data['descuento'];
      $adeudo         = $data['adeudo'];
      $saldo_adeudo   = $data['saldo_adeudo'];
      $bonos          = $data['bono_supervisor'];
      $clasif_cat     = $data['clasifica_categoria'];
      $bonosc2        = $data['bono_categoria'];
      $bonosemanal    = $data['bono_semanal'];
      $vales          = $data['apoyo_mes'];
      $apoyoadicional = $data['sueldo_adicional'];
      $caja           = $data['caja_ahorro'];
      $vacaciones     = $data['vacaciones'];
      $tiponomina     = $data['tipo_nomina'];
      $efectivo       = $data['efectivo'];
      $descfiscal     = $data['descuento_fiscal'];
      $tipo_unidad    = $data['tipo_unidad'];
      $unidad         = $data['unidad'];
      $tipolic        = $data['tipo_licencia'];
      $nolic          = $data['no_licencia'];
      $fcha_vence     = $data['fecha_vencimiento'];
      $supervisor     = $data['supervisor'];
      $sexo           = $data['sexo'];
      $fechanac       = $data['date_nacimiento'];
      $edad           = $data['edad'];
      $edocivil       = $data['estado_civil'];
      $domicilio      = $data['domicilio'];
      $nestudios      = $data['estudios'];
      $cemergencia    = $data['contacto_emergencia'];
      $curp           = $data['curp'];
      $sueldo_coche   = $data['sueldo_coche'];
      $sueldo_sprinter = $data['sueldo_sprinter'];
      $comenta         = $data['comentarios'];
      $recontratable   = $data['recontratable'];
      $pqrecontrata    = $data['pqrecontrata'];
      $fecha_baja      = $data['fecha_baja'];
      $fecha_reingreso = $data['fecha_reingreso'];
      $estatus         = $data['estatus'];

      if ($data['tipo_contrato'] == 'Eventual') {
        $verboton = '';
      }else {
        $verboton = 'style="display: none;"';
      }

      if ($data['fecha_baja'] == '0000-00-00') {
        $visible = "hidden";
      }else {
        $visible = "";
      }

      //$user   = $_SESSION['idUser'];
      
    }
  }

  

  include "../conexion.php";


  $sqlsup = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name from supervisores ORDER BY apellido_paterno";
  $querysup = mysqli_query($conection, $sqlsup);
  $filasup = mysqli_fetch_all($querysup, MYSQLI_ASSOC); 

  $sqlcargo   = "select cargo from cargos ORDER BY cargo";
  $querycargo = mysqli_query($conection, $sqlcargo);
  $filascargo = mysqli_fetch_all($querycargo, MYSQLI_ASSOC); 
  
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
      }

       if ($_SESSION['rol'] == 9 ) {
        $activo = "disabled";
        
      } else { 
        $activo = "";
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
                <h3 class="card-title">Detalles de Empleado</h3>
              </div>
    
              <div class="card-body">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Generales</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Datos Operativos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Datos Nomina</a></li>
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
                    <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id; ?>" readonly>  
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">No. Empleado:</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control" id="inputNoempleado" name="inputNoempleado" value="<?php echo $noempl; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Nombre(s):</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $nombres; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Apellido Paterno:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputPaterno" name="inputPaterno" placeholder="Apellido Paterno" value="<?php echo $paterno; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Apellido Materno:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputMaterno" name="inputMaterno" placeholder="Apellido Materno" value="<?php echo $materno; ?>" readonly>
                        </div>
                      </div>

                      <div class="form-group row" style="text-align: left;">
                        <label for="inputEmail" class="col-sm-2 col-form-label" >Sexo:</label>
                        <div class="col-sm-10">
                          <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputSexo" name="inputSexo">
                          <option value="<?php echo $sexo; ?>" readonly><?php echo $sexo; ?></option>
                        </select>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Fecha de Nacimiento:</label>
                        <div class="col-sm-4">
                          <input type="date" class="form-control" id="inputNace" name="inputNace" value="<?php echo $fechanac; ?>" readonly>
                        </div>
                        <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Edad:</label>
                        <div class="col-sm-4">
                          <input type="number" class="form-control" id="inputEdad" name="inputEdad" value="<?php echo $edad; ?>" readonly>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Estado Civil:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputEdocivil" name="inputEdocivil" value="<?php echo $edocivil; ?>" readonly>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Domicilio:</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" rows="1" id="inputDireccion" name="inputDireccion" readonly><?php echo $domicilio; ?></textarea>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Nivel de Estudios:</label>
                        <div class="col-sm-10">
                         <input type="text" class="form-control" id="inputEstudios" name="inputEstudios" value="<?php echo $nestudios; ?>" readonly>
                        </div>
                      </div>

                      <div class="form-group row" >
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Cargo:</label>
                        <div class="col-sm-10" style="text-align:left;">
                          <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputCargo" name="inputCargo">
                          <option value="<?php echo $cargo; ?>"><?php echo $cargo; ?></option>
                        </select>
                        </div>
                    </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Telefono:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputTelefono" name="inputTelefono" placeholder="Telefono" value="<?php echo $telefono; ?>" readonly>
                        </div>
                      </div>
                      

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Contacto de Emergencia:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputCemergencia" name="inputCemergencia" value="<?php echo $cemergencia; ?>" readonly>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">R.F.C.:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputRfc" name="inputRfc" placeholder="R.F.C. (opcional)" value="<?php echo $rfc; ?>" readonly>
                        </div>
                        <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">C.U.R.P.:</label>
                        <div class="col-sm-4">
                          <input type="text" class="form-control" id="inputCurp" name="inputCurp" value="<?php echo $curp; ?>" readonly>
                        </div>
                      </div>
                      <div class="offset-sm-2 col-sm-10">
                        <a href=<?php echo 'empleados.php?id=' . $id ?> type="button" class="btn btn-secondary" id="btn_salir">Volver</a>
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
                    <div class="form-group row" hidden>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Tipo de Unidad:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputUnidad" name="inputUnidad" placeholder="Ejemlo Camioneta" value="<?php echo $tipo_unidad; ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group row" hidden>
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Unidad:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputNounidad" name="inputNounidad" placeholder="Ejemplo T-23" value="<?php echo $unidad; ?>" readonly>
                        </div>
                    </div>  
                    <div class="form-group row" style="text-align:left;">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Tipo de Licencia:</label>
                        <div class="col-sm-10">
                          <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputTipolic" name="inputTipolic">
                          <option value="<?php echo $tipolic; ?>"><?php echo $tipolic; ?></option>
                        </select>
                        </div>

                    </div> 
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">No. de Licencia:</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputNolicencia" name="inputNolicencia" value="<?php echo $nolic; ?>" readonly>
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Fecha Vencimiento:</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" id="inputVencelicencia" name="inputVencelicencia" value="<?php echo $fcha_vence; ?>" readonly>
                        </div>
                    </div> 
                    <div class="form-group row" >
                        <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Supervisor:</label>
                        <div class="col-sm-10" style="text-align:left;">
                          <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputSupervisor" name="inputSupervisor">
                          <option value="<?php echo $supervisor; ?>"><?php echo $supervisor; ?></option>
                        </select>
                        </div>
                    </div>
                    <div class="offset-sm-2 col-sm-10">
                      <a href=<?php echo 'empleados.php?id=' . $id ?> type="button" class="btn btn-secondary" id="btn_salir">Volver</a>
                    </div>
                    <br>
                    <p>&nbsp;</p>

                    
                    </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                  <div class="tab-pane" id="settings">
                  <div class="post clearfix">
                    <form class="form-horizontal">

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Tipo de Contrato:</label>
                        <div class="col-sm-9">
                          <select class="form-control" id="inputTipoContrato" name="inputTipoContrato">
                          <option value="<?php echo $tipocontrato; ?>"><?php echo $tipocontrato; ?></option>     
                        </select>
                        </div>
                    </div>

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Inicio de Contrato:</label>
                        <div class="col-sm-9">
                          <input type="date" class="form-control" id="inputInicoc" name="inputInicoc" value="<?php echo $fcha_contrato; ?>" readonly>
                        </div>

                       
                    </div>
                    <div class="form-group row" <?php echo $verboton; ?>>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Vencimiento de Contrato:</label>
                        <div class="col-sm-6">
                          <input type="date" class="form-control" id="inputVence" name="inputVence" value="<?php echo $fin_contrato; ?>" readonly>
                        </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Alta IMSS:</label>
                        <div class="col-sm-3" style="text-align:left;">
                            <select class="form-control select2bs4" id="inputImss" name="inputImss">
                                <option value="<?php echo $imss; ?>"><?php echo $imss; ?></option>
                            </select>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Alta IMSS:</label>
                        <div class="col-sm-3" style="text-align:left;">
                        <input type="date" class="form-control" id="inputDatealtaimss" name="inputDatealtaimss"  value="<?php echo $fecha_altaimss; ?>" readonly>
                        </div>
                      </div>

                      <?php
                        if ($fecha_baja > '2000/01/01' or $estatus == 0) {
                      ?>
                        <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Baja:</label>
                        <div class="col-sm-3" style="text-align:left;">
                        <input type="date" class="form-control" id="inputDatebaja" name="inputDatebaja"  value="<?php echo $fecha_baja; ?>" readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Reingreso:</label>
                        <div class="col-sm-3" style="text-align:left;">
                        <input type="date" class="form-control" id="inputDatereingreso" name="inputDatereingreso"  value="<?php echo $fecha_reingreso; ?>" readonly>
                        </div>
                      </div>

                      <?php     
                         }else { 
                      ?>
                      <div class="form-group row" hidden>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Baja:</label>
                        <div class="col-sm-3" style="text-align:left;">
                        <input type="date" class="form-control" id="inputDatebaja" name="inputDatebaja"  value="<?php echo $fecha_baja; ?>" readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Reingreso:</label>
                        <div class="col-sm-3" style="text-align:left;">
                        <input type="date" class="form-control" id="inputDatereingreso" name="inputDatereingreso"  value="<?php echo $fecha_reingreso; ?>" readonly>
                        </div>
                      </div>
                      <?php     
                         } 
                      ?>

                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label" style="text-align: left;">N.S.S.:</label>
                        <div class="col-sm-3">
                         <input type="text" class="form-control" id="inputNss" name="inputNss" placeholder="No. IMSS" value="<?php echo $nss; ?>" readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Salario Diario:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSalariodia" name="inputSalariodia" step="0.01" value="<?php echo $salarioxdia; ?>" <?= $activo ?> readonly>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Salario Promedio:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSalariodiario" name="inputSalariodiario" step="0.01" value="<?php echo $salariodiario; ?>" <?= $activo ?> readonly>
                        </div>
                    
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Base:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSueldobase" name="inputSueldobase" step="0.01" value="<?php echo $sueldobase; ?>" <?= $activo ?> readonly>
                        </div>
                    </div>
                       
                        <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Camion:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSueldo" name="inputSueldo" step="0.01" value="<?php echo $sueldo; ?>" <?= $activo ?> readonly>
                        </div>
                    
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Camioneta:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSueldob2" name="inputSueldob2" step="0.01" value="<?php echo $sueldob2; ?>" <?= $activo ?> readonly>
                        </div>
                    </div>

                      <div class="form-group row" hidden>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Especial Camión:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputVdgmv" name="inputVdgmv" step="0.01" value="<?php echo $camion; ?>" <?= $activo ?> readonly>
                        </div>
                    
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Especial Camioneta:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputVdgao" name="inputVdgao" step="0.01" value="<?php echo $camioneta; ?>" <?= $activo ?> readonly>
                        </div>
                    </div>

                    <div class="form-group row" hidden>
                        <label for="inputEmail" class="col-sm-3 col-form-label" style="text-align: left;">Semidomiciliadas:</label>
                        <div class="col-sm-9">
                         <input type="number" class="form-control" id="inputSemi" name="inputSemi" step="0.01" value="0" <?= $activo ?> readonly>
                        </div>
                      </div>
                      <div class="form-group row" hidden>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Especial Sprinter:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSprinter" name="inputSprinter" step="0.01" value="<?php echo $ssprinter; ?>" <?= $activo ?> readonly>
                        </div>
                    
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Especial Automovil:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSauto" name="inputSauto" step="0.01" value="<?php echo $auto; ?>" <?= $activo ?> readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Automovil:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputsCoche" name="inputsCoche" step="0.01" value="<?php echo $sueldo_coche; ?>" <?= $activo ?> readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Sprinter:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputsSprinter" name="inputsSprinter" step="0.01" value="<?php echo $sueldo_sprinter; ?>" <?= $activo ?> readonly>
                        </div>
                    </div>

                    <div class="form-group row" <?php echo $visible; ?>>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Recontratable:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputsEsrecontra" name="inputsEsrecontra" step="0.01" value="<?php echo $recontratable; ?>" readonly>
                        </div>
                      </div>
                      <div class="form-group row" <?php echo $visible; ?>>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">¿Por que?:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputRecontrable" name="inputRecontrable" step="0.01" value="<?php echo $pqrecontrata; ?>" readonly>
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
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Prestamo:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputDeuda" name="inputDeuda" step="0.01" value="<?php echo $deuda; ?>" onkeyup="PasarValor();" readonly>
                        </div>
                    
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Descuento:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputDescuento" name="inputDescuento" step="0.01" value="<?php echo $descuento; ?>" readonly>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Adeudo:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputAdeudo" name="inputAdeudo" step="0.01" value="<?php echo $adeudo; ?>" onkeyup="PasarValor();" readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Saldo Adeudo:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSaldoAdeudo" name="inputSaldoAdeudo" step="0.01" value="<?php echo $saldo_adeudo; ?>" readonly>
                        </div>
                    </div>    

                        <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Clasificación Categoria:</label>
                        <div class="col-sm-3">
                          <select class="form-control" id="inputClasifcat" name="inputClasifcat">
                            <option value="<?php echo $clasif_cat; ?>"><?php echo $clasif_cat; ?></option>
                          </select>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Bono Categoria:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputBonosc2" name="inputBonosc2" step="0.01" value="<?php echo $bonosc2; ?>" readonly>
                        </div>   
                    </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Bono Supervisor:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputBonos" name="inputBonos" step="0.01" value="<?php echo $bonos; ?>" readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Bono Semanal:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputBonosemanal" name="inputBonosemanal" step="0.01" value="<?php echo $bonosemanal; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Apoyo Mensual:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputApoyomes" name="inputApoyomes" step="0.01" value="<?php echo $vales; ?>" readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Adicional:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputSueldoadd" name="inputSueldoadd" step="0.01" value="<?php echo $apoyoadicional; ?>" <?= $activo ?> readonly>
                        </div>
                    </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Caja de Ahorro:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputCajaAhorro" name="inputCajaAhorro" step="0.01" value="<?php echo $caja; ?>" readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Vacaciones Restantes:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputVacaciones" name="inputVacaciones" step="0.01"value="<?php echo $vacaciones; ?>" readonly>
                        </div>
                       </div>

                        <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Pago Fiscal:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputEfectivo" name="inputEfectivo" step="0.01" value="<?php echo $efectivo; ?>" readonly>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Descuento Fiscal:</label>
                        <div class="col-sm-3">
                          <input type="number" class="form-control" id="inputDesfiscal" name="inputDesfiscal" step="0.01" value="<?php echo $descfiscal; ?>" readonly>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Tipo Nomina:</label>
                        <div class="col-sm-9" style="text-align:left;">
                          <select class="form-control select2bs4" id="inputTiponomina" name="inputTiponomina">
                          <option value="<?php echo $tiponomina; ?>"><?php echo $tiponomina; ?></option>
                        </select>
                        </div>
                      </div>

                       <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Observaciones:</label>
                        <div class="col-sm-9" style="text-align:left;">
                          <textarea class="form-control" rows="2" id="comentarios" name="comentarios" readonly><?php echo $comenta; ?></textarea>
                        </div>
                      </div>
                    
                    
                      <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <a href=<?php echo 'empleados.php?id=' . $id ?> type="button" class="btn btn-secondary" id="btn_salir">Volver</a>
                        </div>
                      </div>
                      </form>
                  </div>  
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

