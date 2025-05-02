<?php
include "../conexion.php";
session_start();

// Verifica sesión activa
if (!isset($_SESSION['idUser'])) {
    header('Location: ../index.php');
    exit;
}

// Variables de sesión
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];
$idUser = $_SESSION['idUser'];

// Obtener nombre del rol
$query = mysqli_query($conection, "SELECT rol FROM rol WHERE idrol = $rol");
$filas = mysqli_fetch_assoc($query);
$namerol = $filas['rol'] ?? '';

// Zona horaria y fechas
date_default_timezone_set('America/Mexico_City');
$fechaActual = date("Y-m-d");
$fcha1 = date("Y-m-d", strtotime('-1 day', strtotime($fechaActual)));
$newDate = date("d-m-Y", strtotime($fcha1));

$diafcha = date("w");
$diasrest = 6 - $diafcha;
$fchaini = date("Y-m-d", strtotime($fechaActual . "- $diafcha days"));
$fchafin = date("Y-m-d", strtotime($fechaActual . "+ $diasrest days"));

// Obtener semana actual
$sql = mysqli_query($conection, "SELECT semana, dia_inicial, dia_final FROM semanas40 WHERE dia_inicial <= '$fechaActual' AND dia_final >= '$fechaActual'");
$dataSemana = mysqli_fetch_assoc($sql);
$diainicial = $dataSemana['dia_inicial'];
$diafinal = $dataSemana['dia_final'];
mysqli_close($conection);

// Contadores
$tareahoy = 0;
$tareasem = 0;

// === Tareas de hoy ===
include "../conexion.php";
if ($rol == 1) {
    $query = "SELECT COUNT(*) as viajeshoy FROM registro_viajes WHERE estatus = 1 AND fecha = '$fechaActual' AND tipo_viaje NOT IN ('Especial', 'Especial Turistico')";
} else {
    $query = "SELECT COUNT(*) as viajeshoy FROM registro_viajes WHERE estatus = 1 AND fecha = '$fechaActual' AND tipo_viaje IN ('Especial', 'Especial Turistico') AND usuario_id = $idUser";
}
$result = mysqli_query($conection, $query);
$tareahoy = mysqli_fetch_assoc($result)['viajeshoy'] ?? 0;
mysqli_close($conection);

// === Tareas de la semana ===
include "../conexion.php";
if ($rol == 1) {
    $query = "SELECT COUNT(*) as totalsem FROM registro_viajes WHERE estatus = 1 AND fecha BETWEEN '$diainicial' AND '$diafinal' AND tipo_viaje IN ('Especial', 'Especial Turistico')";
} else {
    $query = "SELECT COUNT(*) as totalsem FROM registro_viajes WHERE estatus = 1 AND fecha BETWEEN '$diainicial' AND '$diafinal' AND tipo_viaje IN ('Especial', 'Especial Turistico') AND usuario_id = $idUser";
}
$result = mysqli_query($conection, $query);
$tareasem = mysqli_fetch_assoc($result)['totalsem'] ?? 0;
mysqli_close($conection);

// === Estadísticas adicionales ===
function fetch_value($sql) {
    include "../conexion.php";
    $result = mysqli_query($conection, $sql);
    $data = mysqli_fetch_assoc($result);
    mysqli_close($conection);
    return $data ? array_values($data)[0] : 0;
}

$normales = fetch_value("SELECT COUNT(tipo_viaje) FROM registro_viajes WHERE tipo_viaje NOT IN ('Especial', 'Especial Turistico') AND fecha = '$fcha1' AND planeado = 1");
$normalesreg = fetch_value("SELECT SUM(valor_vuelta) FROM registro_viajes WHERE tipo_viaje NOT IN ('Normal', 'Especial Turistico') AND fecha = '$fcha1' AND valor_vuelta > 0 AND planeado = 1");
$especiales = fetch_value("SELECT SUM(valor_vuelta) FROM registro_viajes WHERE tipo_viaje IN ('Especial', 'Especial Turistico') AND fecha = '$fcha1'");
$especialesreg = fetch_value("SELECT SUM(valor_vuelta) FROM registro_viajes WHERE tipo_viaje LIKE '%Especial%' AND fecha = '$fcha1' AND valor_vuelta > 0");
$planeados = fetch_value("SELECT SUM(valor_vuelta) FROM registro_viajes WHERE fecha = '$fcha1' AND tipo_viaje NOT IN ('Especial', 'Especial Turistico') AND planeado = 1");
$extras = fetch_value("SELECT SUM(valor_vuelta) FROM registro_viajes WHERE tipo_viaje NOT IN ('Especial', 'Especial Turistico') AND fecha = '$fcha1' AND planeado = 0 AND valor_vuelta > 0");
$cancelados = fetch_value("SELECT COUNT(valor_vuelta) FROM registro_viajes WHERE tipo_viaje NOT IN ('Especial', 'Especial Turistico') AND fecha = '$fcha1' AND estatus = 3");

// Las variables que puedes usar ahora:
// $tareahoy, $tareasem, $normales, $normalesreg, $especiales, $especialesreg, $planeados, $extras, $cancelados
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TRANSVIVE | ERP</title>

	<!-- Favicon -->
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />

	<!-- Google Fonts -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

	<!-- Bootstrap (datepicker) -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">


	<!-- Iconos: Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-x..." crossorigin="anonymous" referrerpolicy="no-referrer" />

	<!-- Estilos base: AdminLTE + Plugins -->
	<link rel="stylesheet" href="../dist/css/adminlte.min.css">
	<link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">

	<!-- Select2 (mejorar inputs) -->
	<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

	<!-- DataTables (tablas interactivas) -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

	<!-- jQuery y jQuery UI -->
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

	<!-- SweetAlert2 -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- RequireJS (si se usa) -->
	<!-- 
	<script src="./js/require.min.js"></script>
	<script>
		requirejs.config({ baseUrl: '.' });
	</script>
	-->
</head>

<body class="hold-transition layout-top-nav">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
        <div class="container">
            <a href="salir.php" class="navbar-brand">
                <span class="brand-text font-weight-light">
                    <img src="../images/logo_easy.png" alt="TRANSVIVE CRM">
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <?php include('includes/generalnavbar.php'); ?>
            <?php include('includes/nav.php'); ?>
        </div>
    </nav>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <!-- Encabezado -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="m-0">Registro de Viajes</h4>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contenido principal -->
        <section class="content">
            <div class="row">
                <!-- Sidebar -->
                <div class="col-md-2">
                    <a href="#" class="btn btn-primary btn-block mb-3">Viajes</a>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $newDate; ?></h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" id="refresh">
                                    <i class="fa fa-refresh" style="font-size:24px;"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <ul class="nav nav-pills flex-column">
                                <li class="nav-item"><a href="#" class="nav-link">Planeados <span class="badge bg-warning float-right"><?= $normales; ?></span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Registrados <span class="badge bg-secondary float-right"><?= $normalesreg; ?></span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link">No Planeados <span class="badge bg-success float-right"><?= $extras; ?></span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Cancelados <span class="badge bg-danger float-right"><?= $cancelados; ?></span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Especiales <span class="badge bg-warning float-right"><?= $especiales; ?></span></a></li>
                                <li class="nav-item"><a href="#" class="nav-link">Especiales Reg. <span class="badge bg-secondary float-right"><?= $especialesreg; ?></span></a></li>
                                <li class="nav-item text-center">
                                    <a href="#" class="btn btn-secondary btn-sm mt-2" data-toggle="modal" data-target="#modalEditPeriodo2">Detalle del Día</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contenido central -->
                <div class="col-md-10">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Viajes</h3>
                            <?php if (in_array($_SESSION['rol'], [1, 9, 8])): ?>
                                <a href="new_viaje.php" class="btn btn-success btn-sm ml-2">Crea Nuevo <i class="fas fa-plus"></i></a>
                            <?php endif; ?>
                            <a href="factura/viajes_excel.php" class="btn btn-secondary btn-sm ml-2">Excel <i class="fas fa-file-excel"></i></a>
                            <a href="factura/viajes_exceltodos.php" class="btn btn-secondary btn-sm ml-2">Excel Todos <i class="fas fa-file-excel"></i></a>
                        </div>

                        <div class="card-body">
                            <?php if (in_array($_SESSION['rol'], [1, 9, 5])): ?>
                                <!-- Filtros de fecha -->
                                <form id="filtro-form" class="form-inline mb-3">
                                    <input type="text" readonly name="initial_date" id="initial_date" class="form-control datepicker mr-2" placeholder="De Fecha">
                                    <input type="text" readonly name="final_date" id="final_date" class="form-control datepicker mr-2" placeholder="A Fecha">
                                    <button type="submit" class="btn btn-success mr-2" id="filter"><i class="fa fa-filter"></i> Filtro</button>
                                    <button type="button" class="btn btn-info" onClick="actualizarLaPagina()"><i class="fa fa-refresh"></i></button>
                                </form>

                                <!-- Tabla principal -->
                                <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th><th>Fecha</th><th>Hora Inicio</th><th>Hora Llegada</th><th>Semana</th>
                                            <th>Cliente</th><th>Ruta</th><th>Operador</th><th>Tipo Unidad</th><th>No. Eco.</th>
                                            <th>Supervisor</th><th>Jefe Operaciones</th><th>Estatus</th><th>Acción</th>
                                        </tr>
                                    </thead>
                                </table>

                            <?php elseif ($_SESSION['rol'] == 4): ?>
                                <!-- Vista para Supervisores -->
                                <table id="fetch_generated_wills" class="table table-bordered table-hover nowrap" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th><th>Fecha</th><th>Hora Inicio</th><th>Hora Llegada</th><th>Semana</th>
                                            <th>Cliente</th><th>Operador</th><th>Tipo Unidad</th><th>No. Eco.</th><th>Estatus</th><th>Acciones</th>
                                        </tr>
                                    </thead>
                                </table>

                            <?php elseif ($_SESSION['rol'] == 8): ?>
                                <!-- Vista para Jefe de Operaciones -->
                                <table id="fetch_generated_willss" class="table table-hover table-striped table-bordered" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th><th>Fecha</th><th>Hora Inicio</th><th>Hora Llegada</th><th>Semana</th>
                                            <th>Cliente</th><th>Ruta</th><th>Operador</th><th>Tipo Unidad</th><th>No. Eco.</th>
                                            <th>Supervisor</th><th>Jefe Operaciones</th><th>Estatus</th><th>Acción</th>
                                        </tr>
                                    </thead>
                                </table>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-10 -->
            </div>
            <!-- /.row -->
        </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <footer class="main-footer">
        <?php include "includes/footer.php"; ?>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab"></div>
        </div>
    </aside>

    <!-- Fondo de sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- /.wrapper -->
<!-- Bootstrap (Bundle incluye Popper) -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- AdminLTE -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- DataTables Core + Bootstrap4 integration -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- DataTables Buttons (exportaciones) -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- Bootstrap Datepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.es.min.js"></script>


<?php
// ROL: Admin, Operaciones, Calidad, Gerencia, RRHH
if (in_array($_SESSION['rol'], [1, 5, 6, 9, 14])): ?>
<script>
$(document).ready(function () {
	$('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'es',
        autoclose: true,
        todayHighlight: true,
        orientation: 'bottom auto'
    });

	const table = initDataTable();

	$("#filter").on("click", function (e) {
		e.preventDefault();
		const initial_date = $("#initial_date").val();
		const final_date = $("#final_date").val();

		if (!validateFilter(initial_date, final_date)) return;

		table.ajax.reload(null, false); // mantiene el paginador
	});
});

function initDataTable() {
	return $('#fetch_generated_wills').DataTable({
		order: [[1, "desc"]],
		// dom: 'Bfrtip',
		processing: true,
		serverSide: true,
		stateSave: true,
		responsive: true,
		deferRender: true,
		lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
		ajax: {
			url: "data/datadetorders2.php",
			type: "POST",
			data: function (d) {
				d.action = "fetch_users";
				d.initial_date = $("#initial_date").val();
				d.final_date = $("#final_date").val();
			},
			dataSrc: function (json) {
				if (!json || !json.records) {
					console.error("Respuesta inválida:", json);
					return [];
				}
				return json.records;
			},
			error: function (xhr) {
				console.error("Error AJAX:", xhr.responseText);
				alert("Ocurrió un error al procesar la solicitud.");
			}
		},
		columns: [
			{ data: "pedidono", className: "text-right", width: "10px" },
			{ data: "fecha", width: "60px" },
			{ data: "horainicio", className: "text-center", width: "50px" },
			{ data: "horafin", className: "text-center", width: "50px" },
			{ data: "nosemana", width: "80px" },
			{ data: "razonsocial", width: "100px" },
			{ data: "rutacte", width: "40px" },
			{ data: "conductor", width: "100px" },
			{ data: "tipounidad", width: "80px" },
			{ data: "nounidad", width: "30px" },
			{ data: "supervisor", width: "50px" },
			{ data: "jefeopera", width: "50px" },
			{ data: "estatusped", width: "30px" },
			{
				data: null,
				orderable: false,
				render: (data, type, full) => `
					<center>
						<a href="edit_viaje.php?id=${full.pedidono}" class="btn btn-primary btn-xs">
							<i class="fa fa-edit text-white" style="font-size: 1.2em"></i>
						</a> | 
						<a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id="${full.pedidono}" class="btn btn-danger btn-xs">
							<i class="fas fa-times-circle"></i>
						</a>
					</center>`
			}
		]
	});
}

function validateFilter(initial, final) {
	const $log = $("#error_log");
	if (!initial || !final) {
		$log.html("⚠️ Debes seleccionar una fecha inicial y final.");
		return false;
	}
	if (new Date(initial) > new Date(final)) {
		$log.html("⚠️ La fecha final no puede ser menor que la inicial.");
		return false;
	}
	$log.html("");
	return true;
}
</script>


<?php elseif ($_SESSION['rol'] == 4): ?>
<!-- ROL: Supervisor -->
<script>
$(function () {
	let initial_date = $("#initial_date").val();
	let final_date = $("#final_date").val();

	const table = loadTable(initial_date, final_date); // Carga inicial

	$("#filter").on("submit", function (e) {
		e.preventDefault();

		initial_date = $("#initial_date").val();
		final_date = $("#final_date").val();

		if (!validateFilter(initial_date, final_date)) return;

		table.ajax.reload(null, false); // Reload con filtros sin perder paginación
	});
});

// Función para cargar la tabla
function loadTable(initial_date = "", final_date = "") {
	return $('#fetch_generated_wills').DataTable({
		order: [[1, "desc"]],
		// dom: 'Bfrtip',
		processing: true,
		serverSide: true,
		stateSave: true,
		responsive: true,
		ajax: {
			url: "data/datadetorders3.php",
			type: "POST",
			data: function (d) {
				d.action = "fetch_users";
				d.initial_date = $("#initial_date").val(); // Siempre tomar del input
				d.final_date = $("#final_date").val();
			},
			dataSrc: "records"
		},
		columns: [
			{ data: "pedidono", width: "10px", className: "text-right" },
			{ data: "fecha", width: "60px" },
			{ data: "horainicio", width: "50px", className: "text-center" },
			{ data: "horafin", width: "50px", className: "text-center" },
			{ data: "nosemana", width: "80px" },
			{ data: "razonsocial", width: "100px" },
			{ data: "conductor", width: "100px" },
			{ data: "tipounidad", width: "80px" },
			{ data: "nounidad", width: "30px" },
			{ data: "estatusped", width: "30px" },
			{
				render: (data, type, full) => `
					<center>
						<a href="edit_viaje.php?id=${full.pedidono}" class="btn btn-primary btn-xs">
							<i class="fa fa-edit" style="color:white; font-size: 1.2em"></i>
						</a> | 
						<a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id="${full.pedidono}" class="btn btn-danger btn-xs">
							<i class="fas fa-times-circle"></i>
						</a>
					</center>`
			}
		]
	});
}

// Validación de fechas
function validateFilter(initial, final) {
	if (!initial || !final) {
		alert("Debes seleccionar ambas fechas.");
		return false;
	}
	if (new Date(initial) > new Date(final)) {
		alert("La fecha final no puede ser menor que la inicial.");
		return false;
	}
	return true;
}
</script>

<?php elseif ($_SESSION['rol'] == 8): ?>
<!-- ROL: Jefe de Operaciones -->
<script>
$(function () {
	// Inicializa la tabla con valores actuales
	const table = loadJO();

	$("#filtro").click(function () {
		const inicio = $("#inicio_date").val();
		const fin = $("#fin_date2").val();

		if (!inicio || !fin) {
			$("#error_log").html("Debes seleccionar ambas fechas.");
			return;
		}
		if (new Date(inicio) > new Date(fin)) {
			$("#error_log").html("La fecha final no puede ser menor.");
			return;
		}

		$("#error_log").html("");
		table.ajax.reload(null, false); // Recarga sin reiniciar paginador
	});
});

function loadJO() {
	return $('#fetch_generated_willss').DataTable({
		order: [[1, "desc"]],
		// dom: 'Bfrtip',
		processing: true,
		serverSide: true,
		stateSave: true,
		responsive: true,
		ajax: {
			url: "data/datadetorders2_jo.php",
			type: "POST",
			data: function (d) {
				d.action = "fetch_userss";
				d.inicio_date = $("#inicio_date").val();
				d.fin_date = $("#fin_date2").val();
				d.buscaid = $("#buscaid").val();
			},
			dataSrc: "records"
		},
		columns: [
			{ data: "pedidono", width: "10px", className: "text-right" },
			{ data: "fecha", width: "60px" },
			{ data: "horainicio", width: "50px", className: "text-center" },
			{ data: "horafin", width: "50px", className: "text-center" },
			{ data: "nosemana", width: "80px" },
			{ data: "razonsocial", width: "100px" },
			{ data: "rutacte", width: "40px" },
			{ data: "conductor", width: "100px" },
			{ data: "tipounidad", width: "80px" },
			{ data: "nounidad", width: "30px" },
			{ data: "supervisor", width: "50px" },
			{ data: "jefeopera", width: "50px" },
			{ data: "estatusped", width: "30px" },
			{
				render: (data, type, full) => `
					<center>
						<a href="edit_viaje.php?id=${full.pedidono}" class="btn btn-primary btn-xs">
							<i class="fa fa-edit text-white" style="font-size: 1.2em"></i>
						</a> | 
						<a href="#" data-toggle="modal" data-target="#modalCancelViaje" data-id="${full.pedidono}" class="btn btn-danger btn-xs">
							<i class="fas fa-times-circle"></i>
						</a>
					</center>`
			}
		]
	});
}
</script>

<?php endif; ?>

<script type="text/javascript">
$(document).on('click', '#cancel_pedido', function(e) {
    e.preventDefault();

    const pedidoId = $(this).data('id');
    const action = 'infoCancelpedido';

    Swal.fire({
        title: '¿Desea cancelar el registro?',
        text: 'Pedido No.: ' + pedidoId,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'includes/ajax.php',
                type: 'POST',
                data: { action, pedidoId },
                success: function(response) {
                    if (response != 0) {
                        Swal.fire({
                            title: 'Cancelado',
                            text: 'Registro cancelado correctamente',
                            icon: 'success',
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            $('#modalAlumno').modal('hide');
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo cancelar el registro',
                            icon: 'error'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    Swal.fire('Error', 'Ocurrió un error en la solicitud', 'error');
                }
            });
        } else {
            Swal.fire('Acción cancelada', 'El registro no fue cancelado', 'info');
        }
    });
});
</script>

<!-- Script para cargar ID al abrir modal -->
<script>
$(document).ready(function () {
  $('#modalCancelViaje').on('show.bs.modal', function (e) {
    const idc = $(e.relatedTarget).data('id');
    if (idc) {
      $('#form_pass_idcc').val(idc);
    }
  });
});
</script>

<!-- Modal Cancelar Viaje -->
<div class="modal fade" id="modalCancelViaje" tabindex="-1" role="dialog" aria-labelledby="modalCancelViajeTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="modalCancelViajeTitle">Cancelar Viaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="cancelForm">
          <div class="form-group row">
            <label for="form_pass_idcc" class="col-sm-4 col-form-label">No. de Folio:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="form_pass_idcc" name="form_pass_idcc" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label for="comentarios" class="col-sm-4 col-form-label">Motivo:</label>
            <div class="col-sm-8">
              <textarea class="form-control" id="comentarios" name="comentarios" rows="2">Cancelado / Reprogramado por el Cliente</textarea>
            </div>
          </div>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" id="actualizaVuelta">
          <i class="fa fa-save"></i> Cancelar Viaje
        </button>
      </div>

    </div>
  </div>
</div>

<script>
$('#actualizaVuelta').click(function (e) {
    e.preventDefault();

    const idcc = $('#form_pass_idcc').val();
    const motivoc = $('#comentarios').val().trim();
    const action = 'AddCancelaVuelta';

    if (!idcc || motivoc === '') {
        Swal.fire('Campos incompletos', 'Debe ingresar un motivo de cancelación.', 'warning');
        return;
    }

    Swal.fire({
        title: '¿Confirmar cancelación?',
        text: `¿Está seguro de cancelar el viaje No. ${idcc}?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'includes/ajax.php',
                type: 'POST',
                data: { action, idcc, motivoc },
                success: function (response) {
                    try {
                        const info = JSON.parse(response);

                        if (info.status === 'success') {
                            Swal.fire('Cancelado', info.message, 'success').then(() => {
                                $('#modalCancelViaje').modal('hide');
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error', info.message || 'No se pudo cancelar el viaje.', 'error');
                        }
                    } catch (err) {
                        console.error('Error al parsear JSON:', response);
                        Swal.fire('Error', 'Respuesta inesperada del servidor.', 'error');
                    }
                },
                error: function (xhr, status, error) {
                    console.error('AJAX error:', error);
                    Swal.fire('Error', 'Ocurrió un problema al enviar la solicitud.', 'error');
                }
            });
        }
    });
});
</script>

<!-- SweetAlert (si estás usando sweetalert clásico y no SweetAlert2) -->
<script src="js/sweetalert.min.js"></script>

<!-- Recarga completa de la página -->
<script>
function actualizarLaPagina() {
    location.reload(true);
}
</script>

<!-- Auto-refresh silencioso cada 5 segundos -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const milisegundos = 5000;
    setInterval(() => {
        fetch("./refrescar.php"); // No importa la respuesta
    }, milisegundos);
});
</script>

</body>
</html>