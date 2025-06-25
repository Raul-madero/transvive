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
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRANSVIVE | ERP</title>
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

  <!-- AdminLTE CSS -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <!-- SweetAlert -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

  <style>
    /* .dataTables_length select {
      min-width: 50px;
      padding: 5px;
    } */
	.sueldo-adicional-input {
		width: 100%;
		min-width: 80px;
		box-sizing: border-box;
	}

	table.dataTable td,
	table.dataTable th {
		vertical-align: middle;
		word-break: break-word;
		white-space: normal;
	}

	table.dataTable td.child {
		white-space: normal !important;
	}

	table.dataTable td input.form-control {
		width: 100%;
		min-width: 80px;
		box-sizing: border-box;
	}
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <img src="../images/logo_easy.png" alt="TRANSVIVE ERP" class="img-fluid">
      </a>
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php include('includes/generalnavbar.php'); ?>
      <?php include('includes/nav.php'); ?>
    </div>
  </nav>

  <!-- Content Wrapper -->
  <div class="content-wrapper">
    <div class="content-header">
		<div class="container">
			<div class="row mb-2">
				<div class="col-md-12">
					<h4 class="m-0">Nómina Empleados <small>Semanal</small></h4>
				</div>
			</div>
          	<div class="row align-content-center justify-content-between">
              <div class="col-md-2 align-content-center justify-content-center">
                <label for="semana">Número de Semana</label>
              </div>
              <div class="col-md-3">
                <select class="form-control select2bs4 rounded-pill" name="semana" id="semana">
                  <option value="0">--Selecciona la Semana--</option>
                  <?php for($i = 1; $i <= 52; $i++): ?>
                    <option value="<?= $i ?>">Semana <?= $i ?></option>
                  <?php endfor; ?>
                </select>
              </div>
              <div class="col-md-2">
                <input type="number" name="anio" id="anio" value="2025" class="form-control rounded-pill" placeholder="Año"/>
              </div>
              <div class="col-md-2">
                <button id="seleccionaSemana" class="btn btn-primary w-100  rounded-pill">Seleccionar</button>
              </div>
              <div class="col-md-2">
                <button id="ejecutaNomina" class="btn btn-success w-100 rounded-pill">Ejecutar</button>
              </div>
			  <div class="col-md-1 text-center">
				<button class="btn btn-outline-success rounded-pill" id="pagarNomina">Pagar</button>
			  </div>
          	</div>
        <div class="row mt-3">
			<a href="factura/nomina_excel.php" class="text-success flex gap-2 btn btn-outline-success hover:text-dark">
				<i class="fa fa-file-excel"></i>
				Excel
			</a>
        </div>
      </div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="card">
          <div class="card-body">
			<div class="row mx-auto">
				<div id="total" class="mb-3 font-weight-bold col-5 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto"></div>
				<div id="total_vueltas" class="mb-3 font-weight-bold col-5 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto"></div>
			</div>
			<div class="row mx-auto">
				<div id="total_fiscal" class="mb-3 font-weight-bold col-3 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto"></div>
				<div id="total_caja_ahorro" class="mb-3 font-weight-bold col-3 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto"></div>
				<div id="total_adeudo" class="mb-3 font-weight-bold col-3 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto"></div>
			</div>
            <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
              <thead>
                <tr>
                  <th>Semana</th><th>Año</th><th>No.</th><th>Nombre</th><th>Cargo</th>
                  <th>IMSS</th><th>Sueldo Base</th><th>Total Vueltas</th><th>Sueldo Bruto</th><th>Sueldo Adicional</th>
                  <th>Descuento Adeudo</th><th>Nomina Fiscal</th><th>Bono Semanal</th><th>Bono Categoria</th>
                  <th>Bono Supervisor</th><th>Apoyo Mensual</th><th>Sueldo Total</th><th>Días Vacaciones</th>
                  <th>Pago Vacaciones</th><th>Prima Vacacional</th><th>Depósito</th><th>Efectivo</th>
                  <th>Deducción Fiscal</th><th>Caja Ahorro</th><th>Supervisor</th><th>Neto</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Footer -->
  <?php include('includes/footer.php'); ?>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables Initialization -->
	 <script>
		$(document).ready(function () {
			let formatoMoneda = (valor) => {
				if (valor === undefined || valor === null) return '';
				return valor.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
			};

			let renderMoneda = (data) => formatoMoneda(parseFloat(data) || 0);

			let load_data = (semana, anio, url) => {
				if (!semana || !anio) {
					let table = $('#example1').DataTable();
					table.clear().draw();
					$('#total').text("Total de la Nómina: $0.00");
					$('#total_vueltas').text("Total Vueltas: 0.00");
					$('#total_fiscal').text("Total Nomina Fiscal: $0.00");
					$('#total_caja_ahorro').text("Total Caja Ahorro: $0.00");
					$('#total_adeudo').text("Total Adeudo: $0.00");
					return;
				}

				let table = $('#example1').DataTable();
				table.destroy();

				table = $('#example1').DataTable({
					order: [[2, "asc"]],
					lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
					processing: true,
					serverSide: true,
					stateSave: true,
					responsive: true,
					autoWidth: false,
					columnDefs: [
						{ targets: '_all', className: 'text-center align-middle' },
						{ targets: [0, 1, 2, 3], responsivePriority: 1 },
						{ targets: [4, 5, 6, 7, 8], responsivePriority: 2 },
						{ targets: [9, 10, 11, 12], responsivePriority: 3 },
					],
					ajax: {
						url: url,
						type: "POST",
						data: { semana, anio },
						dataSrc: function (json) {
							return json.data;
						},
						error(xhr, error, thrown) {
							console.error(xhr, error, thrown);
							alert("Error al cargar los datos.");
						}
					},
					columns: [
						{ data: "semana" },
						{ data: "anio" },
						{ data: "noempleado" },
						{ data: "nombre" },
						{ data: "cargo" },
						{
							data: null,
							render: rowData => rowData.imss == 1
								? '<span class="badge badge-success">Asegurado</span>'
								: '<span class="badge badge-danger">No Asegurado</span>'
						},
						{ data: "sueldo_base", render: renderMoneda },
						{ data: "total_vueltas" },
						{
							data: "sueldo_bruto",
							render: renderMoneda,
							createdCell: function (td, cellData, rowData) {
								$(td).addClass('editable-sueldo_bruto').attr('data-id', rowData.id).text(renderMoneda(cellData));
							}
						},
						{
							data: "sueldo_adicional",
							render: renderMoneda,
							createdCell: function (td, cellData, rowData) {
								$(td).addClass('editable-sueldo_adicional').attr('data-id', rowData.id).text(renderMoneda(cellData));
							}
						},
						{
							data: "deducciones",
							render: renderMoneda,
							createdCell: function (td, cellData, rowData) {
								$(td).addClass('editable-deducciones').attr('data-id', rowData.id).text(renderMoneda(cellData));
							}
						},
						{ data: "nomina_fiscal", render: renderMoneda },
						{ data: "bono_semanal", render: renderMoneda },
						{ data: "bono_categoria", render: renderMoneda },
						{ data: "bono_supervisor", render: renderMoneda },
						{ data: "apoyo_mes", render: renderMoneda },
						{
							data: null,
							render: (data) => formatoMoneda(
								parseFloat(data.sueldo_bruto) +
								parseFloat(data.bono_semanal) +
								parseFloat(data.bono_supervisor) +
								parseFloat(data.bono_categoria) +
								(parseFloat(data.sueldo_adicional) || 0) +
								parseFloat(data.apoyo_mes)
							)
						},
						{ data: "dias_vacaciones" },
						{ data: "pago_vacaciones", render: renderMoneda },
						{ data: "prima_vacacional", render: renderMoneda },
						{ data: "deposito_fiscal", render: renderMoneda },
						{
							data: null,
							render: (data) => formatoMoneda(
								(parseFloat(data.sueldo_bruto || 0) - parseFloat(data.nomina_fiscal || 0)) +
								parseFloat(data.bono_semanal || 0) +
								parseFloat(data.bono_supervisor || 0) +
								parseFloat(data.bono_categoria || 0) +
								parseFloat(data.apoyo_mes || 0) +
								parseFloat(data.pago_vacaciones || 0) +
								parseFloat(data.sueldo_adicional || 0) +
								parseFloat(data.prima_vacacional || 0) -
								parseFloat(data.deducciones || 0) -
								parseFloat(data.caja_ahorro || 0)
							)
						},
						{ data: "deduccion_fiscal", render: renderMoneda },
						{ data: "caja_ahorro", render: renderMoneda },
						{ data: "supervisor" },
						{
							data: null,
							render: (data) => formatoMoneda(
								parseFloat(data.deposito_fiscal || 0) + ((parseFloat(data.sueldo_bruto || 0) - parseFloat(data.nomina_fiscal || 0)) +
								parseFloat(data.bono_semanal || 0) +
								parseFloat(data.bono_supervisor || 0) +
								parseFloat(data.bono_categoria || 0) +
								parseFloat(data.apoyo_mes || 0) +
								parseFloat(data.pago_vacaciones || 0) +
								parseFloat(data.sueldo_adicional || 0) +
								parseFloat(data.prima_vacacional || 0) -
								parseFloat(data.deducciones || 0) -
								parseFloat(data.caja_ahorro || 0))
							)
						}
					],
					drawCallback: function (settings) {
						let total = settings.json?.totales?.total_nomina || 0;
						$('#total').text("Total de la Nómina: " + formatoMoneda(parseFloat(total)));
						let total_vueltas = settings.json?.total_vueltas?.total_total_vueltas || 0;
						$('#total_vueltas').text("Total de Vueltas: " + total_vueltas);
						let total_adeudo = settings.json?.total_adeudo?.total_deducciones || 0;
						$('#total_adeudo').text("Total de Adeudo: " + formatoMoneda(parseFloat(total_adeudo)));
						let total_fiscal = settings.json?.total_fiscal?.total_fiscal || 0;
						$('#total_fiscal').text("Total de Nómina Fiscal: " + formatoMoneda(parseFloat(total_fiscal)));
						let total_caja_ahorro = settings.json?.total_caja_ahorro?.total_caja || 0;
						$('#total_caja_ahorro').text("Total de Caja de Ahorro: " + formatoMoneda(parseFloat(total_caja_ahorro)));
					}
				});
			};

			// === Eventos para edición directa en celdas visibles ===
			$(document).on('dblclick', 'td.editable-sueldo_bruto, td.editable-deducciones, td.editable-sueldo_adicional', function () {
				let td = $(this);
				let valorOriginal = td.text().replace(/[$,]/g, '').trim();
				let input = $(`<input type="number" class="form-control form-control-sm" style="width:100px;" value="${valorOriginal}">`);
				let campo = td.hasClass('editable-sueldo_bruto') ? 'sueldo_bruto' : td.hasClass('editable-deducciones')? 'deducciones' : 'sueldo_adicional';
				let id = td.data('id');

				td.html(input);
				input.focus();

				input.on('blur keydown', function (e) {
					if (e.type === 'blur' || e.key === 'Enter') {
						let nuevoValor = parseFloat($(this).val()) || 0;
						td.html(nuevoValor.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' }));

						$.ajax({
							url: 'data/actualizarCampoNomina.php',
							type: 'POST',
							data: { id, campo, valor: nuevoValor },
							success: res => $('#example1').DataTable().ajax.reload(null, false),
							error: () => alert("Error al actualizar.")
						});
					}
				});
			});

			// === Sueldo adicional editable desde el input directamente ===
			// $(document).on('blur', '.sueldo-adicional-input', function () {
			// 	let input = $(this);
			// 	let id = input.data('id');
			// 	let valor = parseFloat(input.val()) || 0;

			// 	$.ajax({
			// 		url: 'data/actualizarCampoNomina.php',
			// 		type: 'POST',
			// 		data: { id, campo: 'sueldo_adicional', valor },
			// 		success: () => $('#example1').DataTable().ajax.reload(null, false),
			// 		error: () => alert("Error al actualizar sueldo adicional.")
			// 	});
			// });

			// === Edición dentro de filas colapsadas (modo responsive) ===
			// const columnasEditablesResponsive = [
			// 	{ label: "Sueldo Bruto", campo: "sueldo_bruto" },
			// 	{ label: "Sueldo Adicional", campo: "sueldo_adicional" },
			// 	{ label: "Descuento Adeudo", campo: "deducciones" }
			// ];

			// $(document).on('dblclick', 'table.dtr-details td', function () {
			// 	const td = $(this);
			// 	const contenido = td.html();

			// 	// Detectar cuál campo editable es
			// 	const columnasEditablesResponsive = [
			// 		{ label: "Sueldo Bruto", campo: "sueldo_bruto" },
			// 		{ label: "Sueldo Adicional", campo: "sueldo_adicional" },
			// 		{ label: "Descuento Adeudo", campo: "deducciones" }
			// 	];

			// 	for (let item of columnasEditablesResponsive) {
			// 		if (contenido.includes(item.label)) {
			// 			// Extraer valor con Regex robusto
			// 			let matches = contenido.match(/<strong>.*?<\/strong>\s*\$?([\d.,-]+)/);
			// 			let valorActual = matches ? matches[1].replace(/,/g, '') : "0";

			// 			const input = $(`
			// 				<input type="number" 
			// 					class="form-control form-control-sm editable-responsive-input" 
			// 					style="width: 100px;"
			// 					value="${parseFloat(valorActual) || 0}">
			// 			`);

			// 			td.html(`<strong>${item.label}</strong><br>`).append(input);
			// 			input.focus();

			// 			// Obtener correctamente el ID desde la fila padre
			// 			const childRow = td.closest('tr');
			// 			const rowData = $('#example1').DataTable().row(childRow.prev()).data();
			// 			const id = rowData?.id;
			// 			const campo = item.campo;

			// 			input.on('blur keydown', function (e) {
			// 				if (e.type === 'blur' || e.key === 'Enter') {
			// 					const nuevoValor = parseFloat($(this).val()) || 0;

			// 					td.html(`<strong>${item.label}</strong><br>$${nuevoValor.toFixed(2)}`);

			// 					$.ajax({
			// 						url: 'data/actualizarCampoNomina.php',
			// 						type: 'POST',
			// 						data: { id, campo, valor: nuevoValor },
			// 						success: () => $('#example1').DataTable().ajax.reload(null, false),
			// 						error: () => alert(`Error al actualizar ${item.label}.`)
			// 					});
			// 				}
			// 			});

			// 			break;
			// 		}
			// 	}
			// });

			// === Botones ===
			$('#seleccionaSemana').click(function () {
				let semana = $('#semana').val();
				let anio = $('#anio').val();
				let url = 'data/historicoNomina.php';
				if (semana > 0 && anio >= 2024) load_data(semana, anio, url);
			});

			$('#ejecutaNomina').click(function () {
				let semana = $('#semana').val();
				let anio = $('#anio').val();
				let url = 'data/nominaEmpleados.php';
				if (semana > 0 && anio >= 2024) load_data(semana, anio, url);
			});

			// Carga inicial sin datos
			load_data();
		});
		</script>

	<script>
		// $(document).ready(function() {
		// 	let formatoMoneda = (valor) => {
		// 		if (valor === undefined || valor === null) return '';
		// 		return valor.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
		// 	};

		// 	let renderMoneda = (data) => formatoMoneda(parseFloat(data) || 0);

		// 	let load_data = (semana, anio, url) => {
		// 		let ajaxUrl = url;

		// 		if (!semana || !anio) {
		// 			let table = $('#example1').DataTable();
		// 			table.clear().draw();
		// 			$('#total').text("Total de la Nómina: $0.00");
		// 			$('#total_vueltas').text("Total Vueltas: 0.00");
		// 			$('#total_fiscal').text("Total Nomina Fiscal: $0.00");
		// 			$('#total_caja_ahorro').text("Total Caja Ahorro: $0.00");
		// 			$('#total_adeudo').text("Total Adeudo: $0.00");
		// 			return;
		// 		}

		// 		let table = $('#example1').DataTable();
		// 		table.destroy();

		// 		table = $('#example1').DataTable({
		// 			order: [[2, "asc"]],
		// 			lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
		// 			processing: true,
		// 			serverSide: true,
		// 			stateSave: true,
		// 			responsive: true,
		// 			autoWidth: false,
		// 			columnDefs: [
		// 				{ targets: '_all', className: 'text-center align-middle' }
		// 			],
		// 			ajax: {
		// 				url: ajaxUrl,
		// 				type: "POST",
		// 				data: { semana, anio },
		// 				dataSrc: function (json) {
		// 					return json.data;
		// 				},
		// 				error(xhr, error, thrown) {
		// 					console.error(xhr, error, thrown);
		// 					alert("Error al cargar los datos. Por favor intenta de nuevo.");
		// 				}
		// 			},
		// 			columns: [
		// 				{ data: "semana" },
		// 				{ data: "anio" },
		// 				{ data: "noempleado" },
		// 				{ data: "nombre" },
		// 				{ data: "cargo" },
		// 				{
		// 					data: null,
		// 					render: rowData => rowData.imss == 1
		// 						? '<span class="badge badge-success">Asegurado</span>'
		// 						: '<span class="badge badge-danger">No Asegurado</span>'
		// 				},
		// 				{ data: "sueldo_base", render: renderMoneda },
		// 				{ data: "total_vueltas" },
		// 				{
		// 					data: "sueldo_bruto",
		// 					render: renderMoneda,
		// 					createdCell: function(td, cellData, rowData) {
		// 						$(td).addClass('editable-sueldo_bruto').attr('data-id', rowData.id).text(renderMoneda(cellData));
		// 					}
		// 				},
		// 				{
		// 					data: 'sueldo_adicional',
		// 					render: (data, type, row) => {
		// 						return type === 'display'
		// 							? `<input type="number" class="form-control form-control-sm sueldo-adicional-input" 
		// 								style="min-width:80px;" data-id="${row.id}" value="${parseFloat(data) || 0}">`
		// 							: data;
		// 						}
		// 				},
		// 				{ data: "nomina_fiscal", render: renderMoneda },
		// 				{ 
		// 					data: "deducciones", 
		// 					render: renderMoneda,
		// 					createdCell: function(td, cellData, rowData) {
		// 						$(td).addClass('editable-deducciones').attr('data-id', rowData.id).text(renderMoneda(cellData));
		// 					}
		// 				},
		// 				{ data: "bono_semanal", render: renderMoneda },
		// 				{ data: "bono_categoria", render: renderMoneda },
		// 				{ data: "bono_supervisor", render: renderMoneda },
		// 				{ data: "apoyo_mes", render: renderMoneda },
		// 				{
		// 					data: null,
		// 					render: (data) => formatoMoneda(
		// 						parseFloat(data.sueldo_bruto) +
		// 						parseFloat(data.bono_semanal) +
		// 						parseFloat(data.bono_supervisor) +
		// 						parseFloat(data.bono_categoria) +
		// 						parseFloat(data.apoyo_mes)
		// 					)
		// 				},
		// 				{ data: "dias_vacaciones" },
		// 				{ data: "pago_vacaciones", render: renderMoneda },
		// 				{ data: "prima_vacacional", render: renderMoneda },
		// 				{ data: "deposito_fiscal", render: renderMoneda },
		// 				{
		// 					data: null,
		// 					render: (data) => formatoMoneda(
		// 						(parseFloat(data.sueldo_bruto || 0) - parseFloat(data.nomina_fiscal || 0)) +
		// 						parseFloat(data.bono_semanal || 0) +
		// 						parseFloat(data.bono_supervisor || 0) +
		// 						parseFloat(data.bono_categoria || 0) +
		// 						parseFloat(data.apoyo_mes || 0) +
		// 						parseFloat(data.pago_vacaciones || 0) +
		// 						parseFloat(data.prima_vacacional || 0) -
		// 						parseFloat(data.deducciones || 0) -
		// 						parseFloat(data.caja_ahorro || 0)
		// 					)
		// 				},
		// 				{ data: "deduccion_fiscal", render: renderMoneda },
		// 				{ data: "caja_ahorro", render: renderMoneda },
		// 				{ data: "supervisor" },
		// 				{
		// 					data: null,
		// 					render: (data) => formatoMoneda(
		// 						parseFloat(data.deposito_fiscal || 0) + parseFloat(data.efectivo || 0)
		// 					)
		// 				}
		// 			],
		// 			language: {
		// 				emptyTable: "No hay registros disponibles",
		// 				info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
		// 				loadingRecords: "Cargando...",
		// 				search: "Buscar:",
		// 				lengthMenu: "Mostrar _MENU_ registros",
		// 				paginate: {
		// 					first: "Primera",
		// 					previous: "Anterior",
		// 					next: "Siguiente",
		// 					last: "Última"
		// 				}
		// 			},
		// 			drawCallback: function(settings) {
		// 				console.log(settings.json)
		// 				let total = settings.json?.totales?.total_nomina || 0;
		// 				$('#total').text("Total de la Nómina: " + formatoMoneda(parseFloat(total)));
		// 				let total_vueltas = settings.json?.total_vueltas?.total_total_vueltas || 0;
		// 				$('#total_vueltas').text("Total de Vueltas: " + total_vueltas);
		// 				let total_adeudo = settings.json?.total_adeudo?.total_deducciones || 0;
		// 				$('#total_adeudo').text("Total de Adeudo: " + formatoMoneda(parseFloat(total_adeudo)));
		// 				let total_fiscal = settings.json?.total_fiscal?.total_fiscal || 0;
		// 				$('#total_fiscal').text("Total de Nómina Fiscal: " + formatoMoneda(parseFloat(total_fiscal)));
		// 				let total_caja_ahorro = settings.json?.total_caja_ahorro?.total_caja || 0;
		// 				$('#total_caja_ahorro').text("Total de Caja de Ahorro: " + formatoMoneda(parseFloat(total_caja_ahorro)));
		// 			}
		// 		});
		// 	};

		// 	$(document).on('blur', '.sueldo-adicional-input', function () {
		// 		let input = $(this);
		// 		let id = input.data('id');
		// 		let valor = parseFloat(input.val()) || 0;

		// 		// Enviar al servidor
		// 		$.ajax({
		// 			url: 'data/actualizarCampoNomina.php',
		// 			type: 'POST',
		// 			data: {
		// 				id: id,
		// 				campo: 'sueldo_adicional',
		// 				valor: valor
		// 			},
		// 			success: function (res) {
		// 				console.log("Sueldo adicional actualizado:", res);
		// 				// Recargar tabla para reflejar cálculos dependientes
		// 				$('#example1').DataTable().ajax.reload(null, false); // false para no perder la paginación
		// 			},
		// 			error: function () {
		// 				alert("Error al actualizar el sueldo adicional.");
		// 			}
		// 		});
		// 	});

		// 	$('#seleccionaSemana').click(function () {
		// 		let semana = $('#semana').val();
		// 		let anio = $('#anio').val();
		// 		let url = 'data/historicoNomina.php'
		// 		if (semana > 0 && anio >= 2024) load_data(semana, anio, url);
		// 	});

		// 	$('#ejecutaNomina').click(function () {
		// 		let semana = $('#semana').val();
		// 		let anio = $('#anio').val();
		// 		let url = 'data/nominaEmpleados.php'
		// 		if (semana > 0 && anio >= 2024) load_data(semana, anio, url);
		// 	});

		// 	load_data();
		// 	$(document).on('dblclick', 'td.editable-sueldo_bruto, td.editable-deducciones', function () {

		// 		let td = $(this);
		// 		let originalValue = td.text().replace(/[$,]/g, '');
		// 		let input = $('<input type="number" class="form-control form-control-sm" style="width:100px;">').val(originalValue);
		// 		td.html(input);
		// 		input.focus();

		// 		input.on('blur keydown', function (e) {
		// 			if (e.type === 'blur' || e.key === 'Enter') {
		// 				let nuevoValor = parseFloat($(this).val()) || 0;
		// 				let id = td.data('id');
		// 				let campo = "";
		// 				if(td.hasClass('editable-sueldo_bruto')) {
		// 					campo ='sueldo_bruto';
		// 				}else if(td.hasClass('editable-deducciones')) {
		// 					campo = 'deducciones';
        //                 } else if(td.hasClass('sueldo-adicional-input')) {
		// 					campo ='sueldo_adicional';
		// 				}

		// 				// Restaurar valor formateado
		// 				td.html(nuevoValor.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' }));

		// 				// Enviar actualización al servidor
		// 				$.ajax({
		// 					url: 'data/actualizarCampoNomina.php',
		// 					type: 'POST',
		// 					data: {
		// 						id: id,
		// 						campo: campo,
		// 						valor: nuevoValor
		// 					},
		// 					success: function (res) {
		// 						console.log(res);
		// 					},
		// 					error: function () {
		// 						alert("Error al actualizar.");
		// 					}
		// 				});
		// 			}
		// 		});
		// 	});
		// });
	</script>
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
    	document.addEventListener("DOMContentLoaded", function() {
      		// Invocamos cada 5 segundos ;)
      		let milisegundos = 5 * 1000;
      		setInterval(function() {
        		// No esperamos la respuesta de la petición porque no nos importa
        		fetch("./refrescar.php");
      		}, milisegundos);
    	});
  	</script>
</body>

</html>