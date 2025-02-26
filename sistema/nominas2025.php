<?php
include "../conexion.php";
session_start();
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];
$sql = "select * from rol where idrol =$rol ";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query);
$namerol = $filas['rol'];
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
	<style>
		.dataTables_length select {
			min-width: 150px;
			padding: 5px;
		}
	</style>
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
						<div class="col-3">
							<h4 class="m-0"> Nomina Empleados <small>Semanal</small></h4>
						</div><!-- /.col -->
						<div class="col-9">
							<div class="row">
								<div class="col-2 align-center">
									<label for="semana" class="text-center">Numero de Semana</label>
								</div>
								<div class="col-3">
									<select class="form-control select2bs4" style="text-align: left; margin-bottom: 12px" name="semana" id="semana" id="nosemana">
										<option value="0">--Selecciona la Semana--</option>
										<?php 
										for($i = 0; $i < 52; $i++) {
											$semana = $i + 1;
										echo '<option value="' . $semana . '">' ."Semana " . $semana . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-2">
									<input type="number" name="anio" id="anio" value="2025" placeholder="Selecciona el anio" class="form-control" style="text-align: left; margin-bottom: 12px"/>
								</div>
								<div class="col-2">
									<button id="seleccionaSemana" class="btn btn-primary" style="height: 35px">Seleccionar</button>
								</div>
								<div class="col-3">
									<button id="ejecutaNomina" class="btn btn-success ml-2" style="height: 35px">Ejecutar</button>
								</div>
							</div>
							<!-- /.row -->
						</div><!-- /.col -->
					</div><!-- /.row -->
					<div class="row">
						<div class="col-4"></div>
						<div class="col-4 text-center">
							<button class="btn btn-outline-success btn-lg" id="pagarNomina">Pagar</button>
						</div>
						<div class="col-4">
							<button class="btn btn-outline-primary btn-lg" id="totales">Totales</button>
						</div>	
					</div>
				</div><!-- /.container-fluid -->
			</div>
		<!-- /.content-header -->
		<!-- Main content -->
			<div class="card mw-100" >
			<!-- /.card-header -->
				<div class="card-body mw-100">
					<div id="total" class="text-left border-bottom mb-3 font-weight-bold font-size-lg"></div>
						<table id="example1" class="table table-striped table-bordered table-condensed mw-100" style="width:100%; overflow-x:hidden;" >
							<thead>
								<tr>
									<th>Semana</th>
									<th>Año</th>
										<th>No.</th>
									<th>Nombre</th>
									<!-- <th>Tipo unidad</th> -->
									<th>Cargo</th>
									<th>Imss</th>
									<th>Sueldo Base</th>
									<th>Total de Vueltas</th>
									<th>Sueldo Bruto</th>
									<th>Nomina Fiscal</th>
									<th>Descuento por Adeudo</th>
									<th>Bono Semanal</th>
									<th>Bono Categoria</th>
									<th>Bono Supervisor</th>
									<th>Apoyo Mensual</th>
									<th>Sueldo Total</th>
									<th>Dias Vacaciones</th>
									<th>Pago Vacaciones</th>
									<th>Prima Vacacional</th>
									<th>Deposito</th>
									<th>Efectivo</th>
									<th>Deduccion Fiscal</th>
									<th>Caja de Ahorro</th>
									<th>Supervisor</th>
									<th>Neto</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						<!--	<tfoot>
								<tr>
									<th>Semana/Año</th>
										<th>No.</th>
									<th>Nombre</th>
									<th>Tipo unidad</th> 
									<th>Cargo</th>
									<th>Imss</th>
									<th>Sueldo Base</th>
									<th>Total de Vueltas</th>
									<th>Sueldo Total</th>
									<th>Sueldo Bruto</th>
									<th>Nomina Fiscal</th>
									<th>Bono Semanal</th>
									<th>Bono Categoria</th>
									<th>Bono Supervisor</th>
									<th>Apoyo Mensual</th>
									<th>Dias Vacaciones</th>
									<th>Pago Vacaciones</th>
									<th>Prima Vacacional</th>
									<th>Deposito</th>
									<th>Efectivo</th>
									<th>Deducciones</th>
									<th>Deduccion Fiscal</th>
									<th>Caja de Ahorro</th>
									<th>Supervisor</th>
									<th>Neto</th>
								</tr>
							</tfoot> -->
						</table>
					</div>
					<!-- /.card-body -->
				</div>
				<!-- /.card -->
			</div>
			<!-- /.content -->
		</div>
			<!-- /.content-wrapper -->
			<!-- Control Sidebar -->
  		<aside class="control-sidebar control-sidebar-dark">
    		<!-- Control sidebar content goes here -->
  		</aside>
		<!-- /.control-sidebar -->
		<!-- Main Footer -->
  		<?php include('includes/footer.php') ?>
  	</div>
	<!-- ./wrapper -->
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
    <!-- DataTables Initialization -->
	<script>
		$(document).ready(function() {
		const formatoMoneda = (valor) => {
			if (valor === undefined || valor === null) {
				return '';
			}
			return valor.toLocaleString('es-MX', {
				style: 'currency',
				currency: 'MXN'
			});
		};
		const renderMoneda = (data) => formatoMoneda(parseFloat(data) || 0); // Función reutilizable para formato moneda

		const load_data = (semana, anio) => {
			const ajaxUrl = 'data/nominaEmpleados.php';
			 // Si no hay valores de semana y año, destruye la tabla y muestra vacía
			if (!semana || !anio) {
				const table = $('#example1').DataTable();
				table.clear().draw(); // Vaciar la tabla
				$('#total').text("Total de la Nómina: $0.00"); // Reiniciar total
				return;
			}
			const table = $('#example1').DataTable()
			table.destroy()
			table = $('#example1').DataTable({
				order: [[2, "asc"]],
				lengthMenu: [
					[10, 25, 50, 100, -1],
					[10, 25, 50, 100, "All"]
				],
				processing: true,
				serverSide: true,
				stateSave: true,
				responsive: true,
				scrollX: true,
				
				ajax: {
					url: ajaxUrl,
					type: "POST",
					data: { semana, anio },
					dataSrc: "data",
					error(xhr, error, thrown) {
						console.error(xhr, error, thrown);
						alert("Error al cargar los datos. Por favor intenta de nuevo.");
					}
				},
				columns: [
					{ data: "semana", "class": "text-center" },
					{ data: "anio", "class": "text-center"},
					{ data: "noempleado", "class": "text-center" },
					{ data: "nombre", "class": "text-center"},
					{ data: "cargo", "class": "text-center" },
					{ data: "imss", "class": "text-center"},
					{ data: "sueldo_base", "class": "text-center", render: renderMoneda },
					{ data: "total_vueltas", "class": "text-center" },
					{ 
						data: "sueldo_bruto", 
						render: renderMoneda,
						createdCell: function(td, cellData, rowData, row, col) {
							$(td).addClass('editable-sueldo_bruto').attr('data-id', rowData.id).text(renderMoneda(cellData));
						}
					},
					{ data: "nomina_fiscal", render: renderMoneda },
					{
						data: "deducciones",
						render: renderMoneda,
						createdCell: function(td, cellData, rowData, row, col) {
							$(td).addClass('editable-deducciones').attr('data-id', rowData.id).text(renderMoneda(cellData));
						}
					},
					{ data: "bono_semanal", render: renderMoneda },
					{ data: "bono_categoria", render: renderMoneda },
					{ data: "bono_supervisor", render: renderMoneda },
					{ data: "apoyo_mes", render: renderMoneda },
					{ 
						data: null, 
						render: (data) => formatoMoneda(parseFloat(data.sueldo_bruto) + parseFloat(data.bono_semanal) + parseFloat(data.bono_supervisor) + parseFloat(data.bono_categoria) + parseFloat(data.apoyo_mes)) 
					},
					{ data: "dias_vacaciones" },
					{ data: "pago_vacaciones", render: renderMoneda },
					{ data: "prima_vacacional", render: renderMoneda },
					{ data: "deposito_fiscal", render: renderMoneda },
					{
						data: null,
						render: (data) => formatoMoneda(( parseFloat(data.sueldo_bruto) > 0 ? (parseFloat(data.sueldo_bruto) - parseFloat(data.nomina_fiscal)) : 0 ) + parseFloat(data.bono_semanal) + parseFloat(data.bono_supervisor) + parseFloat(data.bono_categoria) + parseFloat(data.apoyo_mes) + parseFloat(data.pago_vacaciones) + parseFloat(data.prima_vacacional) - parseFloat(data.deducciones) - parseFloat(data.caja_ahorro))
					},
					{ data: "deduccion_fiscal", render: formatoMoneda },
					{ data: "caja_ahorro", render: formatoMoneda },
					{ data: "supervisor" },
					{
						data: null,
						 render: (data) => formatoMoneda((parseFloat(data.sueldo_bruto) > 0 ? (parseFloat(data.sueldo_bruto) - parseFloat(data.nomina_fiscal)) : 0) + parseFloat(data.deposito_fiscal) + parseFloat(data.bono_semanal) + parseFloat(data.bono_supervisor) + parseFloat(data.bono_categoria) + parseFloat(data.apoyo_mes) + parseFloat(data.pago_vacaciones) + parseFloat(data.prima_vacacional) - parseFloat(data.deducciones) - parseFloat(data.caja_ahorro))
					}
				],
				language: {
					emptyTable: "No hay registros disponibles",
					info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
					loadingRecords: "Cargando...",
					search: "Buscar:",
					lengthMenu: "Mostrar _MENU_ registros",
					paginate: {
						first: "Primera",
						previous: "Anterior",
						next: "Siguiente",
						last: "Última"
					}
				},
				drawCallback: function(settings) {
					const total = settings.json.totalNomina || 0;
					$('#total').text("Total de la Nomina: " + formatoMoneda(parseFloat(total)));
				}
			});
		};

		//Editar deducciones
		$('#example1').on('click', '.editable-deducciones', function() {
			const td = $(this);
			const id = td.data('id');
			const currentValue = parseFloat(td.text().replace(/[^0-9.-]+/g, '')) || 0;

			td.html(`<input type="text" class="form-control input-sm" value="${currentValue}">`);
			const input = td.find('input');

			// Función para guardar el nuevo valor
			const guardarCambios = () => {
				const newValue = parseFloat(input.val()) || 0;
				if (newValue !== currentValue) {
					$.ajax({
						url: 'data/updateDeducciones.php',
						type: 'POST',
						data: { id, deducciones: newValue },
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								alert(response.message);
								$('#example1').DataTable().ajax.reload(null, false); // Recargar tabla sin perder la paginación actual
							}
						},
						error: function(xhr, status, error) {
							alert('Error al actualizar la deducción.');
							console.error('Error:', error);
							console.error('Detalles:', xhr.responseText);
						},
						complete: function() {
							td.text(formatoMoneda(newValue)); // Mostrar el nuevo valor formateado
						}
					});
				} else {
					td.text(formatoMoneda(currentValue)); // Revertir el valor original si no hay cambios
				}
			};

			// Guardar al perder el enfoque
			input.focus().on('blur', guardarCambios);

			// Guardar al presionar Enter
			input.on('keydown', function(e) {
				if (e.key === 'Enter') {
					guardarCambios();
				}
			});
		});

		
		$('#example1').on('click', '.editable-sueldo_bruto', function() {
			const td = $(this);
			const id = td.data('id');
			const currentValue = parseFloat(td.text().replace(/[^0-9.-]+/g, '')) || 0;

			td.html(`<input type="text" class="form-control input-sm" value="${currentValue}">`);
			const input = td.find('input');

			// Función para guardar el nuevo sueldo
			const guardarCambios = () => {
				const newValue = parseFloat(input.val()) || 0;
				if (newValue !== currentValue) {
					$.ajax({
						url: 'data/updateSueldo.php',
						type: 'POST',
						data: { id, sueldo: newValue },
						dataType: 'json',
						success: function(response) {
							if (response.success) {
								alert(response.message);
								$('#example1').DataTable().ajax.reload(null, false); // Recargar tabla sin perder la paginación actual
							}
						},
						error: function(xhr, status, error) {
							alert('Error al actualizar el sueldo.');
							console.error('Error:', error);
							console.error('Detalles:', xhr.responseText);
						},
						complete: function() {
							td.text(formatoMoneda(newValue)); // Mostrar el nuevo valor formateado
						}
					});
				} else {
					td.text(formatoMoneda(currentValue)); // Revertir el valor original si no hay cambios
				}
			};

			// Guardar al perder el enfoque
			input.focus().on('blur', guardarCambios);

			// Guardar al presionar Enter
			input.on('keydown', function(e) {
				if (e.key === 'Enter') {
					guardarCambios();
				}
			});
		});

		// Validación de la semana y año
		const validarDatos = (semana, anio) => {
			if (semana <= 0 || semana > 52) {
				alert("Seleccione una semana válida.");
				return false;
			}
			if (anio < 2024) {
				alert("El año debe ser 2024 o superior.");
				return false;
			}
			return true;
		};

		$('#seleccionaSemana').on('click', function() {
			console.log('Click seleccionar');
			const semana = $('#semana').val();
			const anio = $('#anio').val();
			let selecciona = true;

			if (validarDatos(semana, anio)) {
				load_data(semana, anio, selecciona);
			}
		})

		$("#ejecutaNomina").on('click', function() {
			const semana = $("#semana").val();
			const anio = $("#anio").val();
			let selecciona = false;

			if (validarDatos(semana, anio, selecciona)) {
				load_data(semana, anio);
			}
		});
		load_data();  // Cargar datos por defecto
		});
	</script>
	<script src="js/sweetalert2.all.min.js"></script>
	<script>
		$('#pagarNomina').on('click', function() {
			console.log('click');
			$.ajax({
				url: 'data/pagarNomina.php',
				type: 'POST',
				success: function(response) {
					console.log('Respuesta del servidor:', response);
					
					// Parseamos la respuesta JSON
					var res = JSON.parse(response);
					
					// Verificamos el 'status' de la respuesta
					if (res.status === 'success') {
						Swal.fire({
							title: "Nomina guardada correctamente!",
							text: res.message,
							icon: "success"
						}).then(function() {
							location.reload(); // Recargar la página
						});
					} else {
						Swal.fire({
							title: "Error al guardar la nomina",
							text: res.message,
							icon: "error"
						});
					}
				},
				error: function(xhr, status, error) {
					console.error('Error en la solicitud AJAX:', status, error);
				}
			});
		});
	</script>
	<script>
		$('#totales').on('click', function() {
			console.log('click');
			let semana = $('#semana').val();
			let anio = $('#anio').val();
			window.location = `totalNomina.php?semana=${semana}&anio=${anio}`;
			})
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