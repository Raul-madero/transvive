<?php
include "../conexion.php";
session_start();

// Verificar sesión y rol
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];

// Obtener el nombre del rol
$sql = "SELECT * FROM rol WHERE idrol = $rol";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query);
$namerol = $filas['rol'];

// Validar parámetro 'id'
if (empty($_REQUEST['id'])) {
    header('Location: empleados.php');
    exit;
}
$noempl = (int)$_REQUEST['id']; // Convertir a entero para evitar inyecciones

// Obtener información del empleado
$sqlact = mysqli_query($conection, "SELECT * FROM empleados WHERE noempleado = $noempl");
if (!$sqlact) {
    die("Error en la consulta de empleados: " . mysqli_error($conection));
}
$result_sqlact = mysqli_num_rows($sqlact);
if ($result_sqlact == 0) {
    header('Location: empleados.php');
    exit;
}

$data = mysqli_fetch_assoc($sqlact); // Obtener los datos del empleado
$id             = $data['id'];
$noempleado = $data['noempleado'];
$nombres        = $data['nombres'];
$paterno        = $data['apellido_paterno'];
$materno        = $data['apellido_materno'];
$cargo          = $data['cargo'];
$estatus        = $data['estatus'];
$salarioxdia    = $data['salarioxdia'];
$sueldobase     = $data['sueldo_base'];
$adeudo         = $data['adeudo'];
$saldo_adeudo   = $data['saldo_adeudo'];
$bonosemanal    = $data['bono_semanal'];
$bono_supervisor        = $data['bono_supervisor'];
$bono_cat = $data['bono_categoria'];
$vales          =  $data['apoyo_mes'];
$caja           = $data['caja_ahorro'];

// Verificar conexión antes de realizar más consultas
if (!$conection) {
    die("Error al conectar con la base de datos: " . mysqli_error($conection));
}

// Obtener los adeudos del empleado
$sqladeudo = mysqli_query($conection, "SELECT * FROM adeudos WHERE noempleado = $noempleado");
if (!$sqladeudo) {
    die("Error en la consulta de adeudos: " . mysqli_error($conection));
}

// Variables para almacenar resultados
$cantidad = 0; // Suma total de la columna 'cantidad'
$descuento = 0; // Total de descuento * semanas transcurridas
$fechaConsulta = new DateTime(); // Fecha actual (fecha de consulta)

// Procesar los resultados de adeudos
while ($row = mysqli_fetch_assoc($sqladeudo)) {
    $cantidad = (float)$row['cantidad'];
    $total_abonado = $row['total_abonado'];
    $saldo_adeudo = $cantidad - $total_abonado;
    $fecha_inicial = $row['fecha_inicial'];
    $comentarios = $row['comentarios'];

    // Suponiendo que $fecha_inicial viene en formato DD/MM/YYYY o YYYY/MM/DD
    if (!empty($fecha_inicial)) {
        $fecha_inicial = date("Y-m-d", strtotime($fecha_inicial));
    }
    $descuento = (float)$row['descuento'];
    $semanas_restantes = ceil($cantidad / $descuento);
}

// Cerrar conexión
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
                    <?php include('includes/generalnavbar.php'); ?>
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
                                <input type="number" class="form-control" id="inputSalariodia" name="inputSalariodia" step="0.01" value="<?php echo $salarioxdia; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Base:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputSueldobase" name="inputSueldobase" step="0.01" value="<?php echo $sueldobase; ?>" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane mx-auto w-75" id="settingss">
                    <form class="form-horizontal">
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Adeudo:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputAdeudo" name="inputAdeudo" step="0.01" value="<?php echo $cantidad; ?>" readonly>
                            </div>
                            
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Descuento:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputDescuento" name="inputDescuento" step="0.01" value="<?php echo $descuento; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Saldo Adeudo:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputSaldoAdeudo" name="inputSaldoAdeudo" step="0.01" value="<?php echo $saldo_adeudo; ?>" readonly>
                            </div>
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Total Abonado:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputSaldoAdeudo" name="inputSaldoAdeudo" step="0.01" value="<?php echo $total_abonado; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Inicial:</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="inputfechaInicial" name="inputFechaInicial" value="<?php echo $fecha_inicial; ?>" readonly>
                            </div>
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Semanas Restantes:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputSaldoAdeudo" name="inputSaldoAdeudo" step="0.01" value="<?php echo $semanas_restantes; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Comentarios:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="inputComentarios" name="inputComentarios"  value="<?php echo $comentarios; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Bono Categoria:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputBonosc2" name="inputBonosc2" step="0.01" value="<?php echo $bono_cat; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Bono Supervisor:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputBonos" name="inputBonos" step="0.01" value="<?php echo $bono_supervisor; ?>" readonly>
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
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Caja de Ahorro:</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="inputCajaAhorro" name="inputCajaAhorro" step="0.01" value="<?php echo $caja; ?>" readonly>
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