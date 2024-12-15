<?php

include "../conexion.php";
session_start();
$User=$_SESSION['user'];
$rol=$_SESSION['rol'];
$idUser = $_SESSION['idUser'];
$sql = "select * from rol where idrol =$rol ";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query); 

$namerol = $filas['rol'];

if (!isset($_SESSION['idUser'])) {
	header('Location: ../index.php');
}

$sql01= mysqli_query($conection,"SELECT * FROM registro_viajes WHERE estatus= 1 ORDER BY fecha DESC");
mysqli_close($conection);
$result_sql01 = mysqli_num_rows($sql01);

  while ($data = mysqli_fetch_array($sql01)){
	$abiertos   = 0;
  }
date_default_timezone_set('America/Mexico_City');

$fechaActual = date("Y-m-d");
$fcha1 = date("Y-m-d",strtotime ( '-1 day' , strtotime ( $fechaActual ) ) );
$newDate = date("d-m-Y", strtotime($fcha1));  


$fcha = date("Y-m-d"); 
$diafcha = date("w");
$diasrest = 6 - $diafcha;
$fchaini = date("Y-m-d",strtotime($fcha."- $diafcha days")); 
$fchafin = date("Y-m-d",strtotime($fcha."+ $diasrest days")); 
include "../conexion.php";

$sql= mysqli_query($conection,"SELECT semana, dia_inicial, dia_final FROM semanas40 WHERE dia_inicial <= '$fechaActual' AND dia_final >= '$fechaActual'");
$result = mysqli_num_rows($sql);


while ($data = mysqli_fetch_array($sql)){
	$diainicial  = $data['dia_inicial'];
	$diafinal    = $data['dia_final'];
	//$user   = $_SESSION['idUser'];
}
mysqli_close($conection);

if ($rol == 1) {
	include "../conexion.php";
  $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual' and (tipo_viaje <> 'Especial' OR tipo_viaje <> 'Especial Turistico') ");
  $data = mysqli_fetch_array($sql02);
  $tareahoy   = $data['viajeshoy'];
  mysqli_close($conection);
}else {  
  include "../conexion.php";
  $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual' and (tipo_viaje = 'Especial' or tipo_viaje <> 'Especial Turistico') and usuario_id = $idUser");
  $data = mysqli_fetch_array($sql02);
  $tareahoy   = $data['viajeshoy'];
  mysqli_close($conection);
} 

if ($rol == 1) {  

    include "../conexion.php";
    $sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' and (tipo_viaje = 'Especial' or tipo_viaje <> 'Especial Turistico') ");
    $data = mysqli_fetch_array($sql03);
    $tareasem   = $data['totalsem'];
    mysqli_close($conection);
}else {
	Include "../conexion.php";
	$sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' and (tipo_viaje = 'Especial' or tipo_viaje <> 'Especial Turistico') and usuario_id = $rol ");
	$result_sql03 = mysqli_num_rows($sql03);
	$data = mysqli_fetch_array($sql03);
	$tareasem   = $data['totalsem'];
	mysqli_close($conection);
}
// include "../conexion.php";
// $sql04= mysqli_query($conection,"SELECT *  FROM registro_viajes WHERE estatus = 1 and fecha < '$fchaini' and (tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' or tipo_viaje = 'Semidomiciliadas')");
// $result_sql04 = mysqli_num_rows($sql04);
// while ($data = mysqli_fetch_array($sql04)){
// 	$tarearetraso   = 0;
// } 
// mysqli_close($conection);

include "../conexion.php";
$sqlviajes= mysqli_query($conection,"SELECT count(tipo_viaje) as normales from registro_viajes WHERE (tipo_viaje != 'Especial' or tipo_viaje != 'Especial Turistico')  and fecha = '$fcha1' and planeado = 1");
$result_sqlviajes = mysqli_num_rows($sqlviajes);
while ($datav = mysqli_fetch_array($sqlviajes)){
	$normales   = $datav['normales'];
	//$especiales   = 0;
} 
mysqli_close($conection);

include "../conexion.php";
$sqlviajesreg= mysqli_query($conection,"SELECT sum(valor_vuelta) as viajes_normales from registro_viajes WHERE (tipo_viaje != 'Normal' or tipo_viaje != 'Especial Turistico') and fecha = '$fcha1' and valor_vuelta >0 and planeado = 1");
$result_sqlviajesreg = mysqli_num_rows($sqlviajesreg);
while ($datareg = mysqli_fetch_array($sqlviajesreg)){
	$normalesreg   = $datareg['viajes_normales'];
	//$especiales   = $datav['viajes_especiales'];
} 
mysqli_close($conection);

include "../conexion.php";
$sqlviajespec= mysqli_query($conection,"SELECT sum(valor_vuelta) as especiales from registro_viajes WHERE (tipo_viaje = 'Especial' or tipo_viaje = 'Especial Turistico') and fecha = '$fcha1' ");
$result_sqlviajespec = mysqli_num_rows($sqlviajespec);
while ($datavs = mysqli_fetch_array($sqlviajespec)){
	$especiales   = $datavs['especiales'];
	//$especiales   = 0;
} 
mysqli_close($conection);

include "../conexion.php";
$sqlviajesregesp= mysqli_query($conection,"SELECT sum(valor_vuelta) as viajes_especiales from registro_viajes WHERE tipo_viaje LIKE '%Especial%' and fecha = '$fcha1' and valor_vuelta >0");
$result_sqlviajesregesp = mysqli_num_rows($sqlviajesregesp);
while ($dataregesp = mysqli_fetch_array($sqlviajesregesp)){
	$especialesreg   = $dataregesp['viajes_especiales'];
	//$especiales   = $datav['viajes_especiales'];  
} 
mysqli_close($conection);

 include "../conexion.php";
$sqlviajesplan= mysqli_query($conection,"SELECT sum(valor_vuelta) as viajes_planeados FROM registro_viajes WHERE fecha= '$fcha1' and (tipo_viaje !='Especial' or tipo_viaje != 'Especial Turistico') and planeado = 1 ");
$result_sqlviajesplan = mysqli_num_rows($sqlviajesplan);
while ($dataplan = mysqli_fetch_array($sqlviajesplan)){
	$planeados   = $dataplan['viajes_planeados'];
	//$especiales   = $datav['viajes_especiales'];
} 
mysqli_close($conection);

 include "../conexion.php";
$sqlviajesextra= mysqli_query($conection,"SELECT sum(valor_vuelta) as viajes_extras from registro_viajes WHERE (tipo_viaje != 'Especial' or tipo_viaje != 'Especial Turistico') and fecha = '$fcha1' and planeado = 0 and valor_vuelta > 0");
$result_sqlviajesextra = mysqli_num_rows($sqlviajesextra);
while ($dataextra = mysqli_fetch_array($sqlviajesextra)){
	$extras   = $dataextra['viajes_extras'];
	//$especiales   = $datav['viajes_especiales'];
} 
mysqli_close($conection);

 include "../conexion.php";
$sqlviajescanc= mysqli_query($conection,"SELECT count(valor_vuelta) as viajes_cancelados from registro_viajes WHERE (tipo_viaje != 'Especial' or tipo_viaje != 'Especial Turistico') and fecha = '$fcha1' and estatus = 3 ");
$result_sqlviajescanc = mysqli_num_rows($sqlviajescanc);
while ($datacanc = mysqli_fetch_array($sqlviajescanc)){
	$cancelados   = $datacanc['viajes_cancelados'];
	//$especiales   = $datav['viajes_especiales'];
} 
mysqli_close($conection);

//*include "../conexion.php";
//*$sqledo = "select estado from estados ORDER BY estado";
//*$queryedo = mysqli_query($conection, $sqledo);
//*$filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TRANSVIVE | ERP</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
	<link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="./css/buttons.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.1/i18n/jquery.ui.datepicker-es.min.js" crossorigin="anonymous"></script>
	<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<!------ Include the above in your HEAD tag ---------->
	<script src="./js/jquery.dataTables.min.js"></script>
	<script src="./js/dataTables.bootstrap4.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
	<script src="./js/require.min.js"></script>
	<script>
	requirejs.config({
		baseUrl: '.'
	});
	</script>
	<!-- Dashboard Core -->
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
				case 6:
					include('includes/navbaroperac.php');
					break;
				case 8:
					include('includes/navbarjefeoper.php');
					break;
				case 9:
					include('includes/navbargrcia.php');
					break;
				case 15:
					include('includes/navbarmonitorista.php');
					break;
				case 5:
					include('includes/navbarrhuman.php');
					break;
				default:
					include('includes/navbar.php');
					break;
			};
			?>
			
			<?php include('includes/nav.php') ?> 

			</div>
		</nav>
		<!-- Left side column. contains the logo and sidebar -->
	

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<section class="content-header">
		<div class="container-fluid">
			<div class="row">
			<div class="col-sm-6">
			<h4 class="m-0"> Registro de Viajes <small></small></h4>
			</div>
			<div class="col-sm-6 d-none d-sm-block">
			<ol class="breadcrumb float-sm-right">
				<?php
				//Si es administrador, Gerente o Jefe de operaciones
				if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 9 || $_SESSION['rol'] == 8) {

				?> 
				<li class="breadcrumb-item"><a href="new_viaje.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nuevo</a></li>
				<?php }   ?>
				<li class="breadcrumb-item"><a href="#">Home</a></li>
				<li class="breadcrumb-item"><a href="#">Layout</a></li>
				<li class="breadcrumb-item active">Navegacion</li>
				</ol>
			</div>
			</div>
		</div>
		</section>
		<!-- Main content -->
		<div class="content-wrapper">
		<!-- Content Header (Page header) -->
	

		<!-- Main content -->
		<section class="content">
		<div class="row">
				<div class="col-md-2">
			<a href="#" class="btn btn-primary btn-block mb-3">Viajes</a>

			<div class="card">
				<div class="card-header">
				<h3 class="card-title"><?php echo $newDate;?></h3>

				<div class="card-tools">
					<button type="button" class="btn btn-tool" id="refresh">
					<i class="fa fa-refresh" style="font-size:24px;"></i>
					</button>
				</div>
				</div>
				<div class="card-body p-0">
				<ul class="nav nav-pills flex-column">
					<!--<li class="nav-item active">
					<a href="tareas.php" class="nav-link">
						Tareas Abiertas
						<span class="badge bg-primary float-right">0</span>
					</a>
					</li>-->
					<li class="nav-item">
					<a href="#" class="nav-link">
						Planeados
						<span class="badge bg-warning float-right"><?php echo $normales;?></span>
					</a>
					<a href="#" class="nav-link">
						Registrados
						<span class="badge bg-secondary float-right"><?php echo $normalesreg;?></span>
					</a>
					
					<a href="#" class="nav-link">
						No Planeados
						<span class="badge bg-success float-right"><?php echo $extras;?></span>
					</a>

					<a href="#" class="nav-link">
						Cancelados
						<span class="badge bg-danger float-right"><?php echo $cancelados;?></span>
					</a>

					<a href="#" class="nav-link"></a>
					</li>
					
					<li class="nav-item">
					<a href="#" class="nav-link">
					Especiales
					<span class="badge bg-warning float-right"><?php echo $especiales;?></span>
					</a>
					<a href="#" class="nav-link">
						Especiales Reg.
						<span class="badge bg-secondary float-right"><?php echo $especialesreg;?></span>
					</a>
					<a href="#" class="nav-link"></a>
					</li>
					<li class="nav-item">
					<a href="#" class="nav-link"></a>
					<center>
						<a href="#"  class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalEditPeriodo2"> Detalle del Día</a>
					</center>
						<a href="#" class="nav-link"></a>
					</li>
					<!--<li class="nav-item">
					<a href="#" class="nav-link">
						<i class="far fa-trash-alt"></i> Mas...
					</a>
					</li>-->
				</ul>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
			
			<!-- /.card -->
			</div>
			<div class="col-md-10">
			<div class="card card-primary card-outline">
				<div class="card-header">
				<h3 class="card-title">Viajes</h3>&nbsp;&nbsp;&nbsp;
				<?php
				//Si es Administrador, Gerente o Jefe de Operaciones
				if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 9 || $_SESSION['rol'] == 8 ) {

				?> 
					<a href="new_viaje.php"><button class="btn btn-success btn-sm">Crea Nuevo <i class="icon-plus icon-white"></i></button></a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<?php }   ?>   
					<a href="factura/viajes_excel.php"><button class="btn btn-secondary btn-sm">Excel &nbsp;<i class="fas fa-file-excel"></i></button></a>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="factura/viajes_exceltodos.php"><button class="btn btn-secondary btn-sm">Excel Todos&nbsp; <i class="fas fa-file-excel"></i></button></a>
				</div>

				
				<div class="col-md-12">
				<div class="card">      
				<!-- /.card-header -->
				<div class="card-body">
				<?php 
				//Administrador, Gerencia y RR.HH
					if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 9 || $_SESSION['rol'] == 5){
				?>
				<table>
					<tr>
						<td>
							<input type='text' readonly name='initial_date' id='initial_date' class="datepicker" placeholder='De Fecha'>
						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>
							<input type='text' readonly name='final_date' id='final_date' class="datepicker" placeholder='A Fecha'>
						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>
							<input type='text' name='gender' id='gender' placeholder="ID a buscar">
						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>

						<td>
							<button class="btn btn-success btn-block" type="submit" name="filter" id="filter" >
					<i class="fa fa-filter"></i> Filtro
				</button>
						</td>
						<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
						<td>
							<button class="btn btn-info btn-block" onClick="actualizarLaPagina()" >
					<i class="fa fa-refresh"></i> 
				</button>
						</td>
					</tr>
				</table>   
			
				<br>
			
				<table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>ID</th>
					<th>Fecha</th>
					<th>Hora Inicio</th>
					<th>Hora Llegada</th>
					<th>Semana</th>
					<th>Cliente</th>
					<th>Ruta</th>
					<th>Operador</th>
					<th>Tipo Unidad</th>
					<th>No. Eco.</th>
					<th>Supervisor</th>
					<th>Jefe Operaciones</th>
					<th>Estatus</th>
					<th>Accion</th>
				</tr>
				</thead>
			</table>
			<?php }else {
				//Supervisor
				if($_SESSION['rol'] == 4  ){
			?>

		<table id="fetch_generated_wills" class="table table-bordered table-hover nowrap" style="width:100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>Fecha</th>
					<th>Hora Inicio</th>
					<th>Hora Llegada</th>
					<th>Semana</th>
					<th>Cliente</th>
					<th>Operador</th>
					<th>Tipo Unidad</th>
					<th>No. Eco.</th>
					<th>Estatus</th>
					<th>Acciones</th>
				</tr>
			</thead>
		</table>
	<?php }else {
	//Jefe de Operaciones
	if ($_SESSION['rol'] == 8) {
	?>
	
				<br>
			
				<table id="fetch_generated_willss" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>ID</th>
					<th>Fecha</th>
					<th>Hora Inicio</th>
					<th>Hora Llegada</th>
					<th>Semana</th>
					<th>Cliente</th>
					<th>Ruta</th>
					<th>Operador</th>
					<th>Tipo Unidad</th>
					<th>No. Eco.</th>
					<th>Supervisor</th>
					<th>Jefe Operaciones</th>
					<th>Estatus</th>
					<th>Accion</th>
				</tr>
				</thead>
			</table>
			<?php  
	}
	}} ?>
		</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<footer class="main-footer">
		<?php include "includes/footer.php"; ?>
	</footer>

	<!-- Control Sidebar -->
	<aside class="control-sidebar control-sidebar-dark">
		<!-- Create the tabs -->
		<ul class="nav nav-tabs nav-justified control-sidebar-tabs">
		
		
		</ul>
		<!-- Tab panes -->
		<div class="tab-content">
		<!-- Home tab content -->
		<div class="tab-pane" id="control-sidebar-home-tab">
			
		
			<!-- /.control-sidebar-menu -->

		</div>
		<!-- /.tab-pane -->
		<!-- Stats tab content -->
		
		<!-- /.tab-pane -->
		</div>
	</aside>
	<!-- /.control-sidebar -->
	<!-- Add the sidebar's background. This div must be placed
		immediately after the control sidebar -->
	<div class="control-sidebar-bg"></div>
	</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->

<!-- SlimScroll -->

<!-- Bootstrap 3.3.7 -->


<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="../dist/js/demo.js"></script>-->
<!-- page script -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

    <?php
    //Administrador, Operaciones, Calidad, Gerencia, RR.HH
      if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 6 || $_SESSION['rol'] == 14 || $_SESSION['rol'] == 9 || $_SESSION['rol'] == 5){
    ?>
<script>
$(document).ready(function () {
    // Inicializa la tabla
    let table = initializeDataTable();
    // Listener para el botón de filtro
    $("#filter").on("click", function () {
    let initial_date = $("#initial_date").val();
    let final_date = $("#final_date").val();
    let gender = $("#gender").val();

    if (validateFilter(initial_date, final_date)) {
        // Actualiza el URL del DataTable con nuevos parámetros
        table.ajax.url("data/datadetorders2.php").load(null, false); // Omitimos parámetros aquí

        // Actualiza la configuración Ajax del DataTable
        table.settings()[0].ajax.data = {
            action: "fetch_users",
            initial_date: initial_date,
            final_date: final_date,
            gender: gender
        };

        // Recarga la tabla
		table.state.clear(); //Limpia el estado de almacenado
        table.ajax.reload(null, false); // No reinicia la paginación
    }
});


    // Configura el DatePicker
    $(".datepicker").datepicker({
        language: 'es',
        dateFormat: "yy-mm-dd",
        changeYear: true
    });
});

// Función para inicializar el DataTable
function initializeDataTable() {
    return $('#fetch_generated_wills').DataTable({
        order: [[1, "desc"]],
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        stateSave: true,
        responsive: true,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        deferRender: true,
        ajax: {
            url: "data/datadetorders2.php",

            type: "POST",
            dataType: "json",
            data: function (d) {
                // Datos enviados por el cliente
                d.action = "fetch_users";
                d.initial_date = $("#initial_date").val() || "";
                d.final_date = $("#final_date").val() || "";
                d.gender = $("#gender").val() || "";
				console.log(d); //DEpuracion
            },
            dataSrc: function (json) {
                // Validar que el JSON sea correcto
                if (!json || !json.records) {
                    console.error("Invalid JSON:", json);
                    return [];
                }
                return json.records;
            },
            error: function (xhr, error, code) {
                console.error("Error en AJAX:", xhr.responseText);
                alert("Ocurrió un error al procesar la solicitud.");
            }
        },
        columns: [
            { data: "pedidono", width: "10px", className: "text-right" },
            { data: "fecha", width: "60px" },
            { data: "horainicio", width: "50px", className: "text-center", orderable: false },
            { data: "horafin", width: "50px", className: "text-center", orderable: false },
            { data: "nosemana", width: "80px", orderable: false },
            { data: "razonsocial", width: "100px", orderable: false },
            { data: "rutacte", width: "40px", orderable: false },
            { data: "conductor", width: "100px", orderable: false },
            { data: "tipounidad", width: "80px", orderable: false },
            { data: "nounidad", width: "30px", orderable: false },
            { data: "supervisor", width: "50px", orderable: false },
            { data: "jefeopera", width: "50px", orderable: false },
            { data: "estatusped", width: "30px", orderable: false },
            {
                render: function (data, type, full) {
                    return `<center>
                        <a href="edit_viaje.php?id=${full.pedidono}" class="btn btn-primary btn-xs">
                            <i class="fa fa-edit" style="color:white; font-size: 1.2em"></i>
                        </a> | 
                        <a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id="${full.pedidono}" class="btn btn-danger btn-xs">
                            <i class="fas fa-times-circle"></i>
                        </a>
                    </center>`;
                }
            }
        ],
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            {
                extend: 'colvis',
                postfixButtons: ['colvisRestore'],
                columns: '0,1,2,3,4,5,6'
            }
        ]
    });
}

// Función para validar el filtro
function validateFilter(initial_date, final_date) {
    if (initial_date === '' && final_date === '') {
        $("#error_log").html("Warning: You must select both (start and end) date.");
        return false;
    }

    if (initial_date !== '' && final_date !== '') {
        let date1 = new Date(initial_date);
        let date2 = new Date(final_date);

        if (date1 > date2) {
            $("#error_log").html("Warning: End date should be greater than start date.");
            return false;
        }
    }

    $("#error_log").html("");
    return true;
}


</script>

 <?php }else {
  //Supervisor
   if($_SESSION['rol'] == 4  ){
?>

<script type="text/javascript">
    load_data(); // first load

    function load_data(initial_date, final_date){
        var ajax_url = "data/datadetorders3.php";

        $('#fetch_generated_wills').DataTable({
            "order": [[ 1, "desc" ], [0, "desc"]],
            "dom": 'Bfrtip',
            "lengthMenu": [
                [20, 25, 50, -1],
                ['20 rows', '25 rows', '50 rows', 'Show all']
            ],
            "buttons": [
                'excelHtml5',
                'pageLength'
            ],
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
            "ajax" : {
                "url" : ajax_url,
                "dataType": "json",
                "type": "POST",
                "data" : { 
                    "action" : "fetch_users", 
                    "initial_date" : initial_date, 
                    "final_date" : final_date 
                },
                "dataSrc": "records"
            },
            "columns": [
                { "data" : "pedidono", "width": "10px", "className": "text-right" },
                { "data" : "fecha", "width": "60px", "orderable": false},
                { "data" : "horainicio", "width": "50px", "className": "text-center", "orderable": false },
                { "data" : "horafin", "width": "50px", "className": "text-center", "orderable": false },
                { "data" : "nosemana", "width": "80px", "orderable": false },
                { "data" : "razonsocial", "width": "100px", "orderable":false },
                { "data" : "conductor", "width": "100px", "orderable":false },
                { "data" : "tipounidad", "width": "80px", "orderable":false },
                { "data" : "nounidad", "width": "30px", "orderable":false },
                { "data" : "estatusped", "width": "30px", "orderable":false },
                {
                    "render": function ( data, type, full, meta ) {
                        return '<center><a href="edit_viaje.php?id=' + full.pedidono + '" class="btn btn-primary btn-xs"><i class="fa fa-edit" style="color:white; font-size: 1.2em"></i></a> | <a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id="' + full.pedidono + '" class="btn btn-danger btn-xs"><i class="fas fa-times-circle"></i></a></center>';
                    }
                }
            ],
            "sDom": "B<'row'<'col-md-6'l><'col-md-6'f>>t<'row'<'col-md-4'i><'col-md-4'p>>",
            "buttons": [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                {
                    extend: 'colvis',
                    postfixButtons: [ 'colvisRestore' ],
                    columns: '0,1,2,3,4,5,6'
                }
            ],
        }); 
    }  

    $("#filter").click(function(){
        var initial_date = $("#initial_date").val();
        var final_date = $("#final_date").val();

        if(initial_date == '' && final_date == ''){
            $('#fetch_generated_wills').DataTable().destroy();
            load_data("", ""); // Carga sin filtros
        } else {
            var date1 = new Date(initial_date);
            var date2 = new Date(final_date);
            var diffTime = Math.abs(date2 - date1);
            var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

            if(initial_date == '' || final_date == ''){
                $("#error_log").html("Warning: You must select both (start and end) dates.");
            } else {
                if(date1 > date2){
                    $("#error_log").html("Warning: End date should be greater than start date.");
                } else {
                    $("#error_log").html(""); 
                    $('#fetch_generated_wills').DataTable().destroy();
                    load_data(initial_date, final_date);
                }
            }
        }
    });

    // Datepicker 
    $( ".datepicker" ).datepicker({
        language: 'es',
        dateFormat: "yy-mm-dd",
        changeYear: true
    });
</script>


    <?php } else {
      //Jefe de Operaciones
      if ($_SESSION['rol'] == 8) {
        ?>
        <script type="text/javascript">

      load_data(); // first load

      function load_data(inicio_date, fin_date, buscaid){
        var ajax_url = "data/datadetorders2_jo.php";


        $('#fetch_generated_willss').DataTable({
          "order": [[ 1, "desc" ]],
          dom: 'Bfrtip',
lengthMenu: [
[20, 25, 50, -1],
['20 rows', '25 rows', '50 rows', 'Show all']
],
buttons: [
'excelHtml5',
'pageLength'
],
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "responsive": true,
          "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
          "ajax" : {
            "url" : ajax_url,
            "dataType": "json",
            "type": "POST",
            "data" : { 
              "action" : "fetch_userss", 
              "inicio_date" : inicio_date, 
              "fin_date" : fin_date,
              "buscaid" : buscaid 
              
            },
            "dataSrc": "records"
          },
          "columns": [
            { "data" : "pedidono", "width": "10px", className: "text-right" },
            { "data" : "fecha", "width": "60px"},
            { "data" : "horainicio", "width": "50px", className: "text-center", "orderable": false },
            { "data" : "horafin", "width": "50px", className: "text-center", "orderable": false },
            { "data" : "nosemana", "width": "80px", "orderable": false },
            { "data" : "razonsocial", "width": "100px", "orderable":false },
            { "data" : "rutacte", "width": "40px", "orderable":false },
            { "data" : "conductor", "width": "100px", "orderable":false },
            { "data" : "tipounidad", "width": "80px", "orderable":false },
            { "data" : "nounidad", "width": "30px", "orderable":false },
            { "data" : "supervisor", "width": "50px", "orderable":false },
            { "data" : "jefeopera", "width": "50px", "orderable":false },
            { "data" : "estatusped", "width": "30px", "orderable":false },
            {
                    "render": function ( data, type, full, meta ) {
        return '<center><a href=\'edit_viaje.php?id=' + full.pedidono +  '\' class="btn btn-primary btn-xs"><i class="fa fa-edit" style="color:white;  font-size: 1.2em"></i></a> | <a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id=\'' + full.pedidono +  '\' href="#" class="btn btn-danger btn-xs" ><i class="fas fa-times-circle"></i></a></center>';
    }
                    
            
 }   
            
          ],
          "sDom": "B<'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-4'i>><'row'p>B",
    "buttons": [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',     
        {
            extend: 'colvis',
            postfixButtons: [ 'colvisRestore' ],
            columns: '0,1,2,3,4,5,6'
        }
    ],
         
        }); 
      }  

      $("#filtra").click(function(){
        var inicio_date = $("#inicio_date").val();
        var fin_date = $("#fin_date2").val();
        var buscaid = $("#buscaid").val();
        if(inicio_date == '' && fin_date == ''){
          $('#fetch_generated_willss').DataTable().destroy();
          load_data("", "", buscaid); // filter immortalize only
        }else{
          var date1 = new Date(inicio_date);
          var date2 = new Date(fin_date);
          var diffTime = Math.abs(date2 - date1);
          var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

          if(inicio_date == '' || fin_date == ''){
              $("#error_log").html("Warning: You must select both (start and end) date.</span>");
          }else{
            if(date1 > date2){
                $("#error_log").html("Warning: End date should be greater then start date.");
            }else{
               $("#error_log").html(""); 
               $('#fetch_generated_willss').DataTable().destroy();
               load_data(inicio_date, fin_date, buscaid);
            }
          }
        }
      });

      

            // Datapicker 
            $( ".datepicker" ).datepicker({
                language: 'es',
                "dateFormat": "yy-mm-dd",
                changeYear: true
            });


    </script>
    <?php  
      }
    }} ?>

    <script type="text/javascript">


 /* it will load products when document loads */

$(document).on('click', '#cancel_pedido', function(e){

 e.preventDefault();
       var pedidoId = $(this).data('id');
        var action = 'infoCancelpedido';
        swal({
  title: "Desea Cancelar el Registro ?",
  text: "Pedido No.: " + pedidoId,
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,pedidoId:pedidoId},
            success: function(response)
            {
                if(response != 0){
                    swal('Cancelado','Registro Cancelado Correctamente','success').then(function(){ 
                      $('#modalAlumno').modal('hide');
                    location.reload();
                } );
                  
                }else{
                    swal("Poof! Error!", {
      icon: "warning",
    });
                
                   
                }
            },
            error: function(error) {

            }

        });

   
  } else {
    swal("Accion Cancelada Registro no Cancelado !");
  }
});
        
        

         }); 
    
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalAlumno').on('show.bs.modal', function(e) {    
     //var idp = $(e.relatedTarget).data().id;
     // $(e.currentTarget).find('#bookId').val(idp);
      
  });
});
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalCancelViaje').on('show.bs.modal', function(e) { 

     var idc    = $(e.relatedTarget).data().id;
  
    
      $(e.currentTarget).find('#form_pass_idcc').val(idc);
 
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalCancelViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Cancelar Viaje</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_idcc" name="form_pass_idcc" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Motivo de Cancelación:</label>
           <div class="col-sm-9">
             <textarea class="form-control" rows="1" id="comentarios" name="comentarios">Cancelado / Reprogramado por el Cliente</textarea>
           </div>
        </div>  

   
       
 

        <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaVuelta"><i class="fa fa-save"></i>&nbsp;Cancelar Viaje</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaVuelta').click(function(e){
        e.preventDefault();

        var idcc      = $('#form_pass_idcc').val();       
        var motivoc   = $('#comentarios').val();

       var action       = 'AddCancelaVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idcc:idcc, motivoc:motivoc},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            alert('Cancelación Registrada Correctamente');

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

<script>
function actualizarLaPagina(){
    window.location.reload();
} 
</script>



<script src="js/sweetalert.min.js"></script>

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
