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
        $estatus        = $data['estatus'];
        $salarioxdia    = $data['salarioxdia'];
        $salariodiario  = $data['salario_diario'];
        $sueldobase     = $data['sueldo_base'];
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
        //$user   = $_SESSION['idUser'];
    }
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
                        switch ($_SESSION['rol']) {
                            case 4:
                                include('includes/navbarsup.php');
                                break;
                            case 5:
                                include('includes/navbarrhuman.php');
                                break;
                            case 6:
                                include('includes/navbaroperac.php');
                                break;
                            case 8:
                                include('includes/navbarjefeoper.php');
                                break;
                            case 9:
                                include('includes/navbargrcia.php');
                                $activo = "disabled";
                                break;
                            default:
                                include('includes/navbar.php');
                                $activo = '';
                                break;
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
            <center>
                <div class="col-md-9">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Detalles Financieros de Empleado</h3>
                        </div>
                    </div>
                </div>
                <div class="post clearfix mx-auto w-75">
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
                        <div class="form-group row">
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
                    </form>
                </div>
                <div class="tab-pane mx-auto w-75" id="settingss">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Prestamo:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputDeuda" name="inputDeuda" step="0.01" value="<?php echo $deuda; ?>" onkeyup="PasarValor();" readonly>
                            </div>
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Descuento:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputDescuento" name="inputDescuento" step="0.01" value="<?php if ($saldo_adeudo < $descuento) {
                                    echo $saldo_adeudo;
                                } else {
                                    echo $descuento;
                                } ?>" readonly>
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
                                <input type="number" class="form-control" id="inputVacaciones" name="inputVacaciones" step="0.01" value="<?php echo $vacaciones; ?>" readonly>
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
                        <a href="<?php echo ($estatus === '1') ? 'empleados.php?id=' . $noempl : 'empleadosBajas.php?id=' . $noempl; ?>" type="button" class="btn btn-secondary" id="btn_salir">Volver</a>
                    </form>
                </div>
            </center>
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
    </body>
</html>