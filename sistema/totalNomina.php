<?php
include "../conexion.php";
session_start();
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];
$sql = "select * from rol where idrol =$rol ";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query);
$namerol = $filas['rol'];
$semana = $_REQUEST['semana'];
$anio = $_REQUEST['anio'];

$sql = "SELECT * FROM nomina_temp_2025 WHERE semana = $semana AND anio = $anio";
$query = mysqli_query($conection, $sql);
$filas = mysqli_num_rows($query);
if($filas > 0) {
	$sql_totales = "SELECT SUM(total_vueltas) AS total_vueltas, SUM(sueldo_bruto) AS sueldo_bruto, SUM(nomina_fiscal) AS nomina_fiscal, SUM(deposito_fiscal) AS deposito_fiscal, SUM(efectivo) AS efectivo, SUM(deducciones) AS deducciones, SUM(caja_ahorro) AS caja_ahorro, SUM(deduccion_fiscal) AS deduccion_fiscal, SUM(bono_semanal) AS bono_semanal, SUM(bono_categoria) AS bono_categoria, SUM(bono_supervisor) AS bono_supervisor, SUM(apoyo_mes) AS apoyo_mensual, SUM(pago_vacaciones) AS pago_vacaciones, SUM(prima_vacacional) AS prima_vacacional, SUM(neto) AS neto FROM nomina_temp_2025 WHERE semana = $semana AND anio = $anio";
	$query_totales = mysqli_query($conection, $sql_totales);
	$filas_totales = mysqli_fetch_assoc($query_totales);
	
}else {
	$sql_totales = "SELECT SUM(total_vueltas) AS total_vueltas, SUM(sueldo_bruto) AS sueldo_bruto, SUM(nomina_fiscal) AS nomina_fiscal, SUM(deposito_fiscal) AS deposito_fiscal, SUM(efectivo) AS efectivo, SUM(deducciones) AS deducciones, SUM(caja_ahorro) AS caja_ahorro, SUM(deduccion_fiscal) AS deduccion_fiscal, SUM(bono_semanal) AS bono_semanal, SUM(bono_categoria) AS bono_categoria, SUM(bono_supervisor) AS bono_supervisor, SUM(apoyo_mes) AS apoyo_mensual, SUM(pago_vacaciones) AS pago_vacaciones, SUM(prima_vacacional) AS prima_vacacional, SUM(neto) AS neto FROM historico_nomina WHERE semana = $semana AND anio = $anio";
	$query_totales = mysqli_query($conection, $sql_totales);
	$filas_totales = mysqli_fetch_assoc($query_totales);
}

function formatearMoneda($cantidad, $simbolo = '$', $decimales = 2, $separadorMiles = ',', $separadorDecimales = '.') {
	return $simbolo . number_format($cantidad, $decimales, $separadorDecimales, $separadorMiles);
}
$calculaDeposito = $filas_totales['nomina_fiscal'] - $filas_totales['deduccion_fiscal'];
$calculaEfectivo = $filas_totales['efectivo'];

$sueldoBruto = formatearMoneda($filas_totales['sueldo_bruto'] ?? 0);
$nominaFiscal = formatearMoneda($filas_totales['nomina_fiscal'] ?? 0);
$deducciones = formatearMoneda($filas_totales['deducciones'] ?? 0);
$bonoSemanal = formatearMoneda($filas_totales['bono_semanal'] ?? 0);
$bonoCategoria = formatearMoneda($filas_totales['bono_categoria'] ?? 0);
$bonoSupervisor = formatearMoneda($filas_totales['bono_supervisor'] ?? 0);
$apoyoMensual = formatearMoneda($filas_totales['apoyo_mes'] ?? 0);
$deposito = formatearMoneda($calculaDeposito);
$efectivo = formatearMoneda($calculaEfectivo);
$cajaAhorro = formatearMoneda($filas_totales['caja_ahorro'] ?? 0);
$totalNomina = formatearMoneda($calculaDeposito + $calculaEfectivo);
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

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">

    <!-- AdminLTE Theme -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <!-- SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<body class="hold-transition layout-top-nav mw-100">
  	<div class="wrapper mw-100">
    	<!-- Navbar -->
    	<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      		<div class="container">
        		<a href="salir.php" class="navbar-brand">
          			<span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE ERP" class="image-fluid"></span>
        		</a>
        		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          			<span class="navbar-toggler-icon"></span>
        		</button>
				<?php
					include ('includes/generalnavbar.php');
				?>
				<?php include 'includes/nav.php';  ?>
      		</div>
    	</nav>
			<!-- /.navbar -->
			<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper mw-100">
		<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container">
					<div class="row mb-2">
						<div class="col text-center">
							<h2 class="m-0"> Totales Nomina </h2>
						</div><!-- /.col -->
					</div><!-- /.row -->
					<div class="row mb-2">
						<div class="col text-center">
							<h4 class="m-0"> Semana <?php echo $semana; ?>, Año <?php echo $anio; ?></h4>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container -->
			</div><!-- content-header -->
			<div class="card mw-100" >
			<!-- /.card-header -->
				<div class="card-body mw-100">
					<form class="form-horizontal">
						<div class="row mb-3">
							<label for="totalVueltas" class="col-md-3 text-left">Total Vueltas:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="totalVueltas" name="totalVueltas" value="<?php echo $filas_totales['total_vueltas'] ?? 0; ?>" readonly>
							</div>
							<label for="totalSueldoBruto" class="col-md-3 text-left">Total Pagado por Vueltas:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="totalVueltas" name="totalSueldoBruto" value=" <?php echo $sueldoBruto ?? 0; ?>" readonly>
							</div>
						</div>
						<div class="row mb-3">
							<label for="nominaFiscal" class="col-md-3 text-left">Nomina Fiscal:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="nominaFiscal" name="nominaFiscal" value="<?php echo $nominaFiscal ?? 0; ?>" readonly>
							</div>
							<label for="totalDeducciones" class="col-md-3 text-left">Total Deducciones:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="totalDeducciones" name="totalDeducciones" value=" <?php echo $deducciones ?? 0; ?>" readonly>
							</div>
						</div>
						<div class="row mb-3">
							<label for="bonoSemanal" class="col-md-3 text-left">Bono Semanal:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="bonoSemanal" name="bonoSemanal" value="<?php echo $bonoSemanal ?? 0; ?>" readonly>
							</div>
							<label for="bonoCategoria" class="col-md-3 text-left">Bono Categoria:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="bonoCategoria" name="bonoCategoria" value=" <?php echo $bonoCategoria ?? 0; ?>" readonly>
							</div>
						</div>
						<div class="row mb-3">
							<label for="bonoSupervisor" class="col-md-3 text-left">Bono Supervisor:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="bonoSupervisor" name="bonoSupervisor" value="<?php echo $bonoSupervisor ?? 0; ?>" readonly>
							</div>
							<label for="apoyoMensual" class="col-md-3 text-left">Vales Despensa:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="apoyoMensual" name="apoyoMensual" value=" <?php echo $apoyoMensual ?? 0; ?>" readonly>
							</div>
						</div>
						<div class="row mb-3">
							<label for="deposito" class="col-md-3 text-left">Deposito Fiscal:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="deposito" name="deposito" value="<?php echo $deposito ?? 0; ?>" readonly>
							</div>
							<label for="efectivo" class="col-md-3 text-left">Total Efectivo:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="efectivo" name="efectivo" value=" <?php echo $efectivo ?? 0; ?>" readonly>
							</div>
						</div>
						<div class="row mb-3">
							<label for="cajaAhorro" class="col-md-3 text-left">Caja Ahorro:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="cajaAhorro" name="cajaAhorro" value="<?php echo $cajaAhorro ?? 0; ?>" readonly>
							</div>
							<label for="totalNomina" class="col-md-3 text-left">Total Nomina:</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="totalNomina" name="totalNomina" value=" <?php echo $totalNomina ?? 0; ?>" readonly>
							</div>
						</div>
					</form>
				</div><!-- card-body -->
			</div> <!-- card --> 
		</div> <!-- content --> 
		<?php include('includes/footer.php'); ?>
	</div> <!-- content-wrapper -->
    <!-- REQUIRED SCRIPTS -->
	<!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <!-- DataTables Plugins -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <!-- AdminLTE -->
    <script src="../dist/js/adminlte.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
	<!-- Sweet Alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
