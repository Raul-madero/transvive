<?php
include "../conexion.php";
session_start();
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];
$sql = "select * from rol where idrol =$rol ";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query);

$namerol = $filas['rol'];


//Mostrar Datos
if (empty($_REQUEST['id'])) {
  header('Location: empleados.php');
  mysqli_close($conection);
}
$noempl = $_REQUEST['id'];

$sqlact = mysqli_query($conection, "SELECT * FROM empleados WHERE noempleado = $noempl");
mysqli_close($conection);
$result_sqlact = mysqli_num_rows($sqlact);

if ($result_sqlact == 0) {
  header('Location: empleados.php');
} else {
  $option = '';
  while ($data = mysqli_fetch_array($sqlact)) {
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
    } else {
      $verboton = 'style="display: none;"';
    }

    if ($data['fecha_baja'] == '0000-00-00') {
      $visible = "hidden";
    } else {
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
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
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
        } else {
          if ($_SESSION['rol'] == 5) {
            include('includes/navbarrhuman.php');
          } else {
            if ($_SESSION['rol'] == 6) {
              include('includes/navbaroperac.php');
            } else {
              if ($_SESSION['rol'] == 8) {
                include('includes/navbarjefeoper.php');
              } else {
                if ($_SESSION['rol'] == 9) {
                  include('includes/navbargrcia.php');
                } else {
                  include('includes/navbar.php');
                }
              }
            }
          }
        }

        if ($_SESSION['rol'] == 9) {
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
        <div class="col-md-9">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Edición de Empleado</h3>
            </div>

            <div class="card-body">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Generales</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Datos Operativos</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Datos Nomina</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settingss" data-toggle="tab">Datos Pago Nomina</a></li>
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
                        <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id; ?>">
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">No. Empleado:</label>
                          <div class="col-sm-10">
                            <input type="number" class="form-control" id="inputNoempleado" name="inputNoempleado" value="<?php echo $noempl; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Nombre(s):</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" name="inputName" value="<?php echo $nombres; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Apellido Paterno:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputPaterno" name="inputPaterno" placeholder="Apellido Paterno" value="<?php echo $paterno; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Apellido Materno:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputMaterno" name="inputMaterno" placeholder="Apellido Materno" value="<?php echo $materno; ?>">
                          </div>
                        </div>
                        <div class="form-group row" style="text-align: left;">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Sexo:</label>
                          <div class="col-sm-10">
                            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputSexo" name="inputSexo">
                              <option value="<?php echo $sexo; ?>"><?php echo $sexo; ?></option>
                              <option value="Masculino">Masculino</option>
                              <option value="Femenino">Femenino</option>
                              <option value="Binario">Binario</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Fecha de Nacimiento:</label>
                          <div class="col-sm-4">
                            <input type="date" class="form-control" id="inputNace" name="inputNace" value="<?php echo $fechanac; ?>">
                          </div>
                          <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Edad:</label>
                          <div class="col-sm-4">
                            <input type="number" class="form-control" id="inputEdad" name="inputEdad" value="<?php echo $edad; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Estado Civil:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEdocivil" name="inputEdocivil" value="<?php echo $edocivil; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Domicilio:</label>
                          <div class="col-sm-10">
                            <textarea class="form-control" rows="1" id="inputDireccion" name="inputDireccion"><?php echo $domicilio; ?></textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label" style="text-align: left;">Nivel de Estudios:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputEstudios" name="inputEstudios" value="<?php echo $nestudios; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Cargo:</label>
                          <div class="col-sm-10" style="text-align:left;">
                            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputCargo" name="inputCargo">
                              <option value="<?php echo $cargo; ?>"><?php echo $cargo; ?></option>
                              <?php foreach ($filascargo as $opcr): ?>
                                <option value="<?= $opcr['cargo'] ?>"><?= $opcr['cargo'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Telefono:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputTelefono" name="inputTelefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Contacto de Emergencia:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputCemergencia" name="inputCemergencia" value="<?php echo $cemergencia; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">R.F.C.:</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputRfc" name="inputRfc" placeholder="R.F.C. (opcional)" value="<?php echo $rfc; ?>">
                          </div>
                          <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">C.U.R.P.:</label>
                          <div class="col-sm-4">
                            <input type="text" class="form-control" id="inputCurp" name="inputCurp" value="<?php echo $curp; ?>">
                          </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn_salir">Regresar</button>
                        <button type="submit" class="btn btn-success guardar_cliente">Guardar</button>
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
                            <input type="text" class="form-control" id="inputUnidad" name="inputUnidad" placeholder="Ejemlo Camioneta" value="<?php echo $tipo_unidad; ?>">
                          </div>
                        </div>
                        <div class="form-group row" hidden>
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Unidad:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNounidad" name="inputNounidad" placeholder="Ejemplo T-23" value="<?php echo $unidad; ?>">
                          </div>
                        </div>
                        <div class="form-group row" style="text-align:left;">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Tipo de Licencia:</label>
                          <div class="col-sm-10">
                            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputTipolic" name="inputTipolic">
                              <option value="<?php echo $tipolic; ?>"><?php echo $tipolic; ?></option>
                              <option value="Tipo A">Tipo A</option>
                              <option value="Tipo B">Tipo B</option>
                              <option value="Tipo C">Tipo C</option>
                              <option value="Tipo C2">Tipo C2</option>
                              <option value="Tipo C4">Tipo C4</option>
                              <option value="Federal A">Federal A</option>
                              <option value="Federal B">Federal B</option>
                              <option value="Transporte Publico C2">Transporte Publico C2</option>
                              <option value="Transporte Publico C4">Transporte Publico C4</option>
                              <option value="Chofer">Chofer</option>
                              <option value="N/A">N/A</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">No. de Licencia:</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputNolicencia" name="inputNolicencia" value="<?php echo $nolic; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Fecha Vencimiento:</label>
                          <div class="col-sm-10">
                            <input type="date" class="form-control" id="inputVencelicencia" name="inputVencelicencia" value="<?php echo $fcha_vence; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label" style="text-align: left;">Supervisor:</label>
                          <div class="col-sm-10" style="text-align:left;">
                            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputSupervisor" name="inputSupervisor">
                              <option value="<?php echo $supervisor; ?>"><?php echo $supervisor; ?></option>
                              <?php foreach ($filasup as $ops): ?>
                                <option value="<?= $ops['name'] ?>"><?= $ops['name'] ?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn_salir">Regresar</button>
                        <button type="submit" class="btn btn-success guardar_cliente" >Guardar</button>
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
                              <option value="Eventual">Eventual</option>
                              <option value="Indefinido">Indefinido</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Inicio de Contrato:</label>
                          <div class="col-sm-9">
                            <input type="date" class="form-control" id="inputInicoc" name="inputInicoc" value="<?php echo $fcha_contrato; ?>">
                          </div>
                        </div>
                        <div class="form-group row" <?php echo $verboton; ?>>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Vencimiento de Contrato:</label>
                          <div class="col-sm-6">
                            <input type="date" class="form-control" id="inputVence" name="inputVence" value="<?php echo $fin_contrato; ?>">
                          </div>
                          <div class="col-sm-3">
                            <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modalEditPeriodo"> Agregar Periodo</a>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Alta IMSS:</label>
                          <div class="col-sm-3" style="text-align:left;">
                            <select class="form-control select2bs4" id="inputImss" name="inputImss">
                              <option value="<?php echo $imss; ?>"><?php echo $imss; ?></option>
                              <option value="ASEGURADO">ASEGURADO</option>
                              <option value="NO ASEGURADO">NO ASEGURADO</option>
                            </select>
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Alta IMSS:</label>
                          <div class="col-sm-3" style="text-align:left;">
                            <input type="date" class="form-control" id="inputDatealtaimss" name="inputDatealtaimss" value="<?php echo $fecha_altaimss; ?>">
                          </div>
                        </div>
                        <?php
                        if ($fecha_baja > '2000/01/01' or $estatus == 0) {
                        ?>
                          <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Baja:</label>
                            <div class="col-sm-3" style="text-align:left;">
                              <input type="date" class="form-control" id="inputDatebaja" name="inputDatebaja" value="<?php echo $fecha_baja; ?>">
                            </div>
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Reingreso:</label>
                            <div class="col-sm-3" style="text-align:left;">
                              <input type="date" class="form-control" id="inputDatereingreso" name="inputDatereingreso" value="<?php echo $fecha_reingreso; ?>">
                            </div>
                          </div>
                        <?php
                        } else {
                        ?>
                          <div class="form-group row" hidden>
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Baja:</label>
                            <div class="col-sm-3" style="text-align:left;">
                              <input type="date" class="form-control" id="inputDatebaja" name="inputDatebaja" value="<?php echo $fecha_baja; ?>">
                            </div>
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Reingreso:</label>
                            <div class="col-sm-3" style="text-align:left;">
                              <input type="date" class="form-control" id="inputDatereingreso" name="inputDatereingreso" value="<?php echo $fecha_reingreso; ?>">
                            </div>
                          </div>
                        <?php
                        }
                        ?>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-3 col-form-label" style="text-align: left;">N.S.S.:</label>
                          <div class="col-sm-3">
                            <input type="text" class="form-control" id="inputNss" name="inputNss" placeholder="No. IMSS" value="<?php echo $nss; ?>">
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Salario Diario:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSalariodia" name="inputSalariodia" step="0.01" value="<?php echo $salarioxdia; ?>" <?= $activo ?>>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Salario Promedio:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSalariodiario" name="inputSalariodiario" step="0.01" value="<?php echo $salariodiario; ?>" <?= $activo ?>>
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Base:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSueldobase" name="inputSueldobase" step="0.01" value="<?php echo $sueldobase; ?>" <?= $activo ?>>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Camion:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSueldo" name="inputSueldo" step="0.01" value="<?php echo $sueldo; ?>" <?= $activo ?>>
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Camioneta:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSueldob2" name="inputSueldob2" step="0.01" value="<?php echo $sueldob2; ?>" <?= $activo ?>>
                          </div>
                        </div>
                        <div class="form-group row" hidden>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Especial Camión:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputVdgmv" name="inputVdgmv" step="0.01" value="<?php echo $camion; ?>" <?= $activo ?>>
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Especial Camioneta:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputVdgao" name="inputVdgao" step="0.01" value="<?php echo $camioneta; ?>" <?= $activo ?>>
                          </div>
                        </div>
                        <div class="form-group row" hidden>
                          <label for="inputEmail" class="col-sm-3 col-form-label" style="text-align: left;">Semidomiciliadas:</label>
                          <div class="col-sm-9">
                            <input type="number" class="form-control" id="inputSemi" name="inputSemi" step="0.01" value="0" <?= $activo ?>>
                          </div>
                        </div>
                        <div class="form-group row" hidden>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Especial Sprinter:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSprinter" name="inputSprinter" step="0.01" value="<?php echo $ssprinter; ?>" <?= $activo ?>>
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Especial Automovil:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSauto" name="inputSauto" step="0.01" value="<?php echo $auto; ?>" <?= $activo ?>>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Automovil:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputsCoche" name="inputsCoche" step="0.01" value="<?php echo $sueldo_coche; ?>" <?= $activo ?>>
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Sprinter:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputsSprinter" name="inputsSprinter" step="0.01" value="<?php echo $sueldo_sprinter; ?>" <?= $activo ?>>
                          </div>
                        </div>
                        <div class="form-group row" <?php echo $visible; ?>>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Recontratable:</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputsEsrecontra" name="inputsEsrecontra" step="0.01" value="<?php echo $recontratable; ?>">
                          </div>
                        </div>
                        <div class="form-group row" <?php echo $visible; ?>>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">¿Por que?:</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="inputRecontrable" name="inputRecontrable" step="0.01" value="<?php echo $pqrecontrata; ?>">
                          </div>
                        </div>
                        <button type="button" class="btn btn-secondary btn_salir">Regresar</button>
                        <button type="submit" class="btn btn-success guardar_cliente">Guardar</button>
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
                            <input type="number" class="form-control" id="inputDeuda" name="inputDeuda" step="0.01" value="<?php echo $deuda; ?>" onkeyup="PasarValor();">
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Descuento:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputDescuento" name="inputDescuento" step="0.01" value="<?php echo $descuento; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Adeudo:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputAdeudo" name="inputAdeudo" step="0.01" value="<?php echo $adeudo; ?>" onkeyup="PasarValor();">
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Saldo Adeudo:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSaldoAdeudo" name="inputSaldoAdeudo" step="0.01" value="<?php echo $saldo_adeudo; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Clasificación Categoria:</label>
                          <div class="col-sm-3">
                            <select class="form-control" id="inputClasifcat" name="inputClasifcat">
                              <option value="<?php echo $clasif_cat; ?>"><?php echo $clasif_cat; ?></option>
                              <option value="A">A</option>
                              <option value="AA">AA</option>
                              <option value="AAA">AAA</option>
                            </select>
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Bono Categoria:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputBonosc2" name="inputBonosc2" step="0.01" value="<?php echo $bonosc2; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Bono Supervisor:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputBonos" name="inputBonos" step="0.01" value="<?php echo $bonos; ?>">
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Bono Semanal:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputBonosemanal" name="inputBonosemanal" step="0.01" value="<?php echo $bonosemanal; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Apoyo Mensual:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputApoyomes" name="inputApoyomes" step="0.01" value="<?php echo $vales; ?>">
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Adicional:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputSueldoadd" name="inputSueldoadd" step="0.01" value="<?php echo $apoyoadicional; ?>" <?= $activo ?>>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Caja de Ahorro:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputCajaAhorro" name="inputCajaAhorro" step="0.01" value="<?php echo $caja; ?>">
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Vacaciones Restantes:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputVacaciones" name="inputVacaciones" step="0.01" value="<?php echo $vacaciones; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Pago Fiscal:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputEfectivo" name="inputEfectivo" step="0.01" value="<?php echo $efectivo; ?>">
                          </div>
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Descuento Fiscal:</label>
                          <div class="col-sm-3">
                            <input type="number" class="form-control" id="inputDesfiscal" name="inputDesfiscal" step="0.01" value="<?php echo $descfiscal; ?>">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Tipo Nomina:</label>
                          <div class="col-sm-9" style="text-align:left;">
                            <select class="form-control select2bs4" id="inputTiponomina" name="inputTiponomina">
                              <option value="<?php echo $tiponomina; ?>"><?php echo $tiponomina; ?></option>
                              <option value="Semanal">Semanal</option>
                              <option value="Quincenal">Quincenal</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Observaciones:</label>
                          <div class="col-sm-9" style="text-align:left;">
                            <textarea class="form-control" rows="2" id="comentarios" name="comentarios"><?php echo $comenta; ?></textarea>
                          </div>
                        </div>
                        <div class="form-group row" style="text-align:right;">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="button" class="btn btn-secondary btn_salir">Regresar</button>
                            <button type="submit" class="btn btn-success guardar_cliente">Guardar</button>
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
      function PasarValor() {
        document.getElementById("inputSaldoAdeudo").value = parseFloat(document.getElementById("inputDeuda").value) + parseFloat(document.getElementById("inputAdeudo").value);
      }
    </script>


    <script>
      $('.btn_salir').click(function(e) {
        e.preventDefault();
        const params = new URLSearchParams(window.location.search);
        const foo = parseInt(params.get('id'));

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
              location.href = "<?php if ($estatus === '1') {
                                  echo 'empleados.php?id=' . $noempl  ?><?php } else  echo 'empleadosBajas.php?id=' . $noempl ?>";
            }
          });



      });
    </script>

	<script>
      	$('.guardar_cliente').click(function(e) {
			e.preventDefault();
			var Id = $('#inputId').val();
			var noempleado = $('#inputNoempleado').val();
			var name = $('#inputName').val();
			var paterno = $('#inputPaterno').val();
			var materno = $('#inputMaterno').val();
			var cargo = $('#inputCargo').val();
			var telefono = $('#inputTelefono').val();
			var rfccte = $('#inputRfc').val();
			var unidad = $('#inputUnidad').val();
			var nounidad = $('#inputNounidad').val();
			var tipo_lic = $('#inputTipolic').val();
			var nolicencia = $('#inputNolicencia').val();
			var fvencimiento = $('#inputVencelicencia').val();
			var supervisor = $('#inputSupervisor').val();
			var tipocontrato = $('#inputTipoContrato').val();
			var fcontrato = $('#inputInicoc').val();
			var vencontrato = $('#inputVence').val();
			var imss = $('#inputImss').val();
			var salariodia = $('#inputSalariodiario').val();
			var sueldobase = $('#inputSueldobase').val();
			var sueldo = $('#inputSueldo').val();
			var sueldob2 = $('#inputSueldob2').val();
			var vdgmv = $('#inputVdgmv').val();
			var vdgao = $('#inputVdgao').val();
			var sprinter = $('#inputSprinter').val();
			var sueldo_auto = $('#inputSauto').val();
			var ssemi = $('#inputSemi').val();
			var deuda = $('#inputDeuda').val();
			var descuento = $('#inputDescuento').val();
			var adeudo = $('#inputAdeudo').val();
			var saldo_adeudo = $('#inputSaldoAdeudo').val();
			var bonos = $('#inputBonos').val();
			var clasif_cat = $('#inputClasifcat').val();
			var bonosc2 = $('#inputBonosc2').val();
			var bonosemanal = $('#inputBonosemanal').val();
			var apoyomes = $('#inputApoyomes').val();
			var vales = $('#inputSueldoadd').val();
			var caja = $('#inputCajaAhorro').val();
			var vacaciones = $('#inputVacaciones').val();
			var efectivo = $('#inputEfectivo').val();
			var descefectivo = $('#inputDesfiscal').val();
			var tipo_nomina = $('#inputTiponomina').val();
			var sexo = $('#inputSexo').val();
			var fechanac = $('#inputNace').val();
			var edad = $('#inputEdad').val();
			var edocivil = $('#inputEdocivil').val();
			var domicilio = $('#inputDireccion').val();
			var estudios = $('#inputEstudios').val();
			var contactoe = $('#inputCemergencia').val();
			var elcurp = $('#inputCurp').val();
			var fchaaltaimss = $('#inputDatealtaimss').val();
			var noss = $('#inputNss').val();
			var salarioxdia = $('#inputSalariodia').val();
			var sueldoauto = $('#inputsCoche').val();
			var sdosprinter = $('#inputsSprinter').val();
			var es_recontrata = $('#inputsEsrecontra').val();
			var recontratable = $('#inputRecontrable').val();
			var comentarios = $('#comentarios').val();
			var datebaja = $('#inputDatebaja').val();
			var datereingreso = $('#inputDatereingreso').val();
			var action = 'AlmacenaEditEmpleado';

			$.ajax({
				url: 'includes/ajax.php',
				type: "POST",
				async: true,
				data: {
					action: action,
					Id: Id,
					noempleado: noempleado,
					name: name,
					paterno: paterno,
					materno: materno,
					cargo: cargo,
					telefono: telefono,
					rfccte: rfccte,
					unidad: unidad,
					nounidad: nounidad,
					tipo_lic: tipo_lic,
					nolicencia: nolicencia,
					fvencimiento: fvencimiento,
					supervisor: supervisor,
					tipocontrato: tipocontrato,
					fcontrato: fcontrato,
					vencontrato: vencontrato,
					imss: imss,
					salariodia: salariodia,
					sueldobase: sueldobase,
					sueldo: sueldo,
					sueldob2: sueldob2,
					vdgmv: vdgmv,
					vdgao: vdgao,
					sprinter: sprinter,
					sueldo_auto: sueldo_auto,
					ssemi: ssemi,
					deuda: deuda,
					descuento:descuento,
					adeudo: adeudo,
					saldo_adeudo: saldo_adeudo,
					bonos: bonos,
					clasif_cat: clasif_cat,
					bonosc2: bonosc2,
					bonosemanal: bonosemanal,
					apoyomes: apoyomes,
					vales: vales,
					caja: caja,
					vacaciones: vacaciones,
					efectivo: efectivo,
					descefectivo: descefectivo,
					tipo_nomina: tipo_nomina,
					sexo: sexo,
					fechanac: fechanac,
					edad: edad,
					edocivil: edocivil,
					domicilio: domicilio,
					estudios: estudios,
					contactoe: contactoe,
					elcurp: elcurp,
					fchaaltaimss: fchaaltaimss,
					noss: noss,
					salarioxdia: salarioxdia,
					sueldoauto: sueldoauto,
					sdosprinter: sdosprinter,
					es_recontrata: es_recontrata,
					recontratable: recontratable,
					comentarios: comentarios,
					datebaja: datebaja,
					datereingreso: datereingreso
				},
				success: function(response) {
					let info = JSON.parse(response)
					if (info.error) {
						Swal.fire({
						icon: 'error',
						title: 'Ooops...',
						text: info.error
						})
					}else {
						Swal.fire({
							title: "Exito!",
							text: "EMPLEADO EDITADO CORRECTAMENTE",
							icon: 'success',
							})
							.then(resultado => {
							if (resultado.value) {
								//* generarimpformulaPDF(info.folio);
								location.href = 'empleados.php';
							} else {
								// Dijeron que no
								location.reload();
								location.href = 'empleados.php';
							}
						});
					}
				},
				error: function(error) {
					console.error("Error en la consulta de AJAX: ", error)
					Swal.fire({
						icon: 'error',
						title: 'Ooops...',
						text: 'Error en la solicitud AJAX'
					})
				} 
			});
		});
    </script>

    <script src="js/sweetalert2.all.min.js"></script>
    <!-- Page specific script -->
    <script>
      $(function() {
        //Initialize Select2 Elements
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

        //Datemask dd/mm/yyyy
        $('#datemask').inputmask('dd/mm/yyyy', {
          'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy
        $('#datemask2').inputmask('mm/dd/yyyy', {
          'placeholder': 'mm/dd/yyyy'
        })
        //Money Euro
        $('[data-mask]').inputmask()

        //Date picker
        $('#reservationdate').datetimepicker({
          format: 'L'
        });

        //Date and time picker
        $('#reservationdatetime').datetimepicker({
          icons: {
            time: 'far fa-clock'
          }
        });

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
        $('#daterange-btn').daterangepicker({
            ranges: {
              'Today': [moment(), moment()],
              'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
              'Last 7 Days': [moment().subtract(6, 'days'), moment()],
              'Last 30 Days': [moment().subtract(29, 'days'), moment()],
              'This Month': [moment().startOf('month'), moment().endOf('month')],
              'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            startDate: moment().subtract(29, 'days'),
            endDate: moment()
          },
          function(start, end) {
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

        $("input[data-bootstrap-switch]").each(function() {
          $(this).bootstrapSwitch('state', $(this).prop('checked'));
        })

      })
      // BS-Stepper Init
      document.addEventListener('DOMContentLoaded', function() {
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
        file.previewElement.querySelector(".start").onclick = function() {
          myDropzone.enqueueFile(file)
        }
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
      $(document).ready(function(e) {
        $('#modalEditPeriodo').on('show.bs.modal', function(e) {

          var noemp = document.getElementById("inputNoempleado").value

          $(e.currentTarget).find('#form_pass_noempleado').val(noemp);


        });
      });
    </script>



    <div class="modal fade" id="modalEditPeriodo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">


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
                  <input type="date" class="form-control" id="form_pass_finicio" name="form_pass_finicio">
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
                      <th style="width:20%; background-color:#e9ecef; text-align: center;">No. Empleado</th>
                      <th style="width:35%; background-color:#e9ecef; text-align: center;">Inicia Contrato</th>
                      <th style="width:35%; background-color:#e9ecef; text-align: center;">Vence Contrato</th>
                      <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
                    </tr>
                  </thead>
                  <tbody id="detalle_periodo">
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
      $('#actualizaclientes').click(function(e) {
        e.preventDefault();

        var noempleado = $('#form_pass_noempleado').val();
        var dateinicio = $('#form_pass_finicio').val();
        var datefin = $('#form_pass_ffin').val();



        var action = 'AddPeridoContrato';

        $.ajax({
          url: 'includes/ajax.php',
          type: "POST",
          async: true,
          data: {
            action: action,
            noempleado: noempleado,
            dateinicio: dateinicio,
            datefin: datefin
          },

          success: function(response) {
            if (response != 'error') {
              //console.log(response);
              var info = JSON.parse(response);
              console.log(info);
              //$('#modalFactura').modal('hide');
              //--$('#detalle_inspeccion').html(info.detalle);


              alert('Periodo Almacenado Correctamente');
              $('#detalle_periodo').html(info.detalle);
              $('#modalEditPeriodo').modal('hide');
              // location.reload(true);


            } else {
              console.log('no data');
              alert('faltan datos');
            }
            //viewProcesar();
          },
          error: function(error) {}

        });

      });
    </script>


    <script type="text/javascript">
      $(document).ready(function() {
        var c_noemp = '<?php echo $noempl; ?>';
        searchForDetalleditPeriodo(c_noemp);
      });
    </script>

    <script>
      function searchForDetalleditPeriodo(c_noemp) {
        var action = 'searchForDetalleditPeriodo';
        var noempl = c_noemp;

        $.ajax({
          url: 'includes/ajax.php',
          type: "POST",
          async: true,
          data: {
            action: action,
            noempl: noempl
          },

          success: function(response) {


            var info = JSON.parse(response);
            $('#detalle_periodo').html(info.detalle);



            console.log(response);




            //viewProcesarCot();        
          },
          error: function(error) {}

        });
      }
    </script>

    <script>
      function remove_periodo(id, no_empleado) {
        var action = 'removePeriodo';
        var id_partida = id;
        var no_emp = no_empleado;
        //var costoadic  = $('#costoadicional').val();

        $.ajax({
          url: 'includes/ajax.php',
          type: "POST",
          async: true,
          data: {
            action: action,
            id_partida: id_partida,
            no_emp: no_emp
          },

          success: function(response) {
            if (response != 'error') {
              //console.log(response);
              var info = JSON.parse(response);
              $('#detalle_periodo').html(info.detalle);
              $('#modalEditPeriodo').modal('hide');

            } else {
              $('#detalle_periodo').html('');

            }
            //viewProcesar();
          },
          error: function(error) {}
        });
      }
    </script>

    <script>
      $(document).ready(function() {
        $('#form_pass_finicio').change(function() {


          var dat1 = document.getElementById('form_pass_finicio').value;
          var date = Date.parse(dat1);
          var oneDay = 720 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
          var diffDays = date + oneDay;

          var datetime = diffDays; // anything
          var date2 = new Date(datetime);
          var options = {
            year: 'numeric',
            month: '2-digit',
            day: '2-digit'
          };
          var result = date2.toLocaleDateString(date2.getTimezoneOffset(), options);
          var fecha_iso = result.replace(/\//g, '-').split('-').reverse().join('-');

          //alert(result);

          document.getElementById("form_pass_ffin").value = fecha_iso;



        });
      });
    </script>

    <script>
      $(function() {
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
      $(document).ready(function() {
        $("#inputClasifcat").on('change', function() {
          var op = $(this).val();
          if (op === "A") {
            document.getElementById("inputBonosc2").value = 0;
          } else {
            if (op === "AA") {
              document.getElementById("inputBonosc2").value = 350;
            } else {
              if (op === "AAA") {
                document.getElementById("inputBonosc2").value = 700;
              }
            }
          }


        });
      });
    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
        // Invocamos cada 5 segundos ;)
        const milisegundos = 5 * 1000;
        setInterval(function() {
          // No esperamos la respuesta de la petición porque no nos importa
          fetch("./refrescar.php");
        }, milisegundos);
      });
    </script>
</body>

</html>