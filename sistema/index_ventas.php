<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  if(!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
  }
  $rol=$_SESSION['rol'];
  $allowed = array(17, 1);
  if(in_array($rol, $allowed) === false) {
    header('Location: /');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="es">
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

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="salir.php" class="navbar-brand">
                    <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE CRM"></span>
                </a>
                <?php include('includes/generalnavbar.php'); ?>
                <?php include('includes/nav.php'); ?>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h4 class="m-0">Prospectos de <small>Seguimiento</small></h4>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="new_prospecto.php"><i class="fas fa-plus" style="color: green;"></i>&nbsp;&nbsp;Nuevo</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <table id="tableProspectos" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Razon Social</th>
                                <th>Encargado</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Municipio</th>
                                <th>Fecha de Contacto</th>
                                <th>Comentarios</th>
                                <th>Seguimiento</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php include('includes/footer.php'); ?>
    </div>

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
           	const table = $('#tableProspectos').DataTable({
                responsive: true,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                ajax: "data/ventasSeguimiento.php",  // Asegúrate que esta URL sea correcta
                columns: [
                    { data: 'id' },
                    { data: 'razon_social' },
                    { data: 'encargado' },
                    { data: 'correo' },
                    { data: 'telefono' },
                    { data: 'municipio' },
                    { data: 'fecha_contacto' },
                    { data: 'comentarios' },
                    { data: 'fecha_seguimiento' },
                    { 
                        data: null,
                        render: function (data, type, row) {
                            return `<a href="editarProspecto.php?id=${row.id}" class="btn btn-sm btn-primary">Editar</a> 
                                    <button class="btn btn-sm btn-danger" onclick="eliminarProspecto(${row.id})">Eliminar</button>`;
                        }
                    }
                ],
				language: {
					processing: "Procesando...",
					search: "Buscar:",
					lengthMenu: "Mostrar _MENU_ registros",
					info: "Mostrando de _START_ a _END_ de _TOTAL_ registros",
					infoEmpty: "Mostrando 0 a 0 de 0 registros",
					infoFiltered: "(filtrado de _MAX_ registros totales)",
					loadingRecords: "Cargando...",
					zeroRecords: "No se encontraron resultados",
					emptyTable: "No hay datos disponibles",
					paginate: {
						first: "Primero",
						previous: "Anterior",
						next: "Siguiente",
						last: "Último"
					},
					aria: {
						sortAscending: ": activar para ordenar ascendente",
						sortDescending: ": activar para ordenar descendente"
					}
				}
            });

			$('#tableProspectos tbody').on('click', 'tr', function (e) {
				const lastColumnIndex = table.columns().count() - 1;
				const firstColumnIndex = 0;
				const clickedColumnIndex = $(e.target).closest('td').index();

				if (clickedColumnIndex !== lastColumnIndex && clickedColumnIndex !== firstColumnIndex) {
					const rowData = table.row(this).data();
					mostrarModal(rowData);
				}
			});

			// Función para mostrar el modal con los datos del prospecto
			function mostrarModal(datos) {
				console.log(datos);  // Para depuración
				
				$('#modalTitulo').text(`Información del Prospecto: ${datos.razon_social}`);
				$('#modalNombreComercial').text(datos.nombre_comercial);
				$('#modalTitulo2').text(datos.nombre_comercial);
				$('#modalEncargado').text(datos.encargado);
				$('#modalCorreo').text(datos.correo);
				$('#modalTelefono').text(datos.telefono);
				$('#modalMunicipio').text(datos.municipio);
				$('#modalFechaContacto').text(datos.fecha_contacto);
				$('#modalComentarios').text(datos.comentarios);
				$('#modalFechaSeguimiento').text(datos.fecha_seguimiento);
				$('#modalTelEmpresa').text(datos.telefono_empresa);
				$('#modalDomicilio').text(datos.domicilio);
				$('#modalCP').text(datos.cp);
				$('#modalColonia').text(datos.colonia);
				$('#modalEstado').text(datos.estado);
				$('#modalGirocomercial').text(datos.giro_comercial);
				$('#modalNoEmpleados').text(datos.no_empleados);
				$('#modalTurnos').text(datos.turnos);
				$('#modalUnidad').text(datos.tipo_unidad);
				$('#modalSemaforo').text(datos.semaforo);

				// Mostrar el modal
				$('#miModal').modal('show');
			}
        });

        function eliminarProspecto(id) {
			Swal.fire({
				title: '¿Estás seguro?',
				text: "¡No podrás revertir esto!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Sí, eliminarlo',
				cancelButtonText: 'Cancelar'
			}).then((result) => {
				if (result.isConfirmed) {
					// Llamada AJAX para eliminar el prospecto
					$.ajax({
						url: 'data/eliminaProspecto.php', // Ruta del archivo PHP
						type: 'POST', // Método HTTP
						data: { id: id }, // Enviamos el ID del prospecto
						dataType: 'json', // Esperamos una respuesta JSON
						success: function (response) {
							if (response.success) {
								Swal.fire('¡Eliminado!', 'El prospecto ha sido eliminado.', 'success');

								// Opcional: Actualizar la tabla sin recargar toda la página
								if (typeof table !== 'undefined') {
									table.ajax.reload();
								} else {
									location.reload(); // Si no hay DataTable, recargar la página
								}
							} else {
								Swal.fire('Error', response.error || 'No se pudo eliminar el prospecto.', 'error');
							}
						},
						error: function (xhr, status, error) {
							console.error('Error en la solicitud AJAX:', error);
							Swal.fire('Error', 'Ocurrió un problema al intentar eliminar el prospecto.', 'error');
						}
					});
				}
			});
		}	
	</script>

	<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">

			<div class="modal-header">
				<h5 class="modal-title" id="miModalLabel">Detalles del Prospecto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
				
				<!-- Breadcrumb para la navegación entre secciones -->
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active" id="btnGenerales"><a href="#generales">Datos Generales</a></li>
						<li class="breadcrumb-item" id="btnCaracteristicas"><a href="#caracteristicas">Características</a></li>
					</ol>
				</nav>

				<!-- Sección de Datos Generales -->
				<div class="tab-pane active" id="generales">
					<div class="modal-body">
						<div class="container">
							<div class="text-center mb-4">
								<h2 id="modalNombreComercial" class="fw-bold"></h2>
							</div>

							<div class="row mb-3">
								<div class="col-md-3"><strong>Nombre Contacto:</strong> <span id="modalEncargado"></span></div>
								<div class="col-md-3"><strong>Correo:</strong> <span id="modalCorreo"></span></div>
								<div class="col-md-3"><strong>Teléfono Contacto:</strong> <span id="modalTelefono"></span></div>
								<div class="col-md-3"><strong>Teléfono Empresa:</strong> <span id="modalTelEmpresa"></span></div>
							</div>

							<div class="row mb-3">
								<div class="col-md-4"><strong>Calle y No.:</strong> <span id="modalDomicilio"></span></div>
								<div class="col-md-4"><strong>Código Postal:</strong> <span id="modalCP"></span></div>
								<div class="col-md-4"><strong>Colonia:</strong> <span id="modalColonia"></span></div>
							</div>

							<div class="row mb-3">
								<div class="col-md-6"><strong>Estado:</strong> <span id="modalEstado"></span></div>
								<div class="col-md-6"><strong>Municipio:</strong> <span id="modalMunicipio"></span></div>
							</div>

							<div class="row mb-3">
								<div class="col-md-6"><strong>Fecha de Contacto:</strong> <span id="modalFechaContacto"></span></div>
								<div class="col-md-6"><strong>Fecha de Seguimiento:</strong> <span id="modalFechaSeguimiento"></span></div>
							</div>

							<div class="row mb-3">
								<div class="col-12"><strong>Comentarios:</strong> <span id="modalComentarios"></span></div>
							</div>
						</div>
					</div>
				</div>

				<!-- Sección de Características -->
				<div class="tab-pane" id="caracteristicas" style="display: none;">
					<div class="modal-body">
						<div class="text-center mb-4">
							<h2 id="modalTitulo2" class="fw-bold"></h2>
						</div>

						<div class="row mb-3">
							<div class="col-md-4"><strong>Giro Comercial:</strong> <span id="modalGirocomercial"></span></div>
							<div class="col-md-4"><strong>No. de Empleados:</strong> <span id="modalNoEmpleados"></span></div>
							<div class="col-md-4"><strong>Turnos:</strong> <span id="modalTurnos"></span></div>
						</div>

						<div class="row mb-3">
							<div class="col-md-6"><strong>Tipo de Unidad:</strong> <span id="modalUnidad"></span></div>
							<div class="col-md-6"><strong>Semáforo:</strong> <span id="modalSemaforo"></span></div>
						</div>
					</div>
				</div>

				<!-- Footer del Modal -->
				<div class="modal-footer justify-content-center">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function () {
			$('#btnGenerales').on('click', function () {
				$('#generales').show();
				$('#caracteristicas').hide();
				$(this).addClass('active');
				$('#btnCaracteristicas').removeClass('active');
			});
	
			$('#btnCaracteristicas').on('click', function () {
				$('#generales').hide();
				$('#caracteristicas').show();
				$(this).addClass('active');
				$('#btnGenerales').removeClass('active');
			});
		});
	</script>

	</body>
</html>				
		
			