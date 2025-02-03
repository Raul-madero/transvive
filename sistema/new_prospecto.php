<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
}
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];

include('../conexion.php');
$stmt = $conection->prepare("SELECT MAX(id) as max_id FROM prospectos");
$stmt->execute();
$result = $stmt->get_result();
$folio_prospectos = $result->fetch_assoc();
$folioom = $folio_prospectos['max_id'] + 1;

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
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
		<!-- Theme style -->
		<link rel="stylesheet" href="../dist/css/adminlte.min.css">
		<!-- Ekko Lightbox -->
		<link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
		<!-- overlayScrollbars -->
		<link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
		<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
		<!-- Dependencia de animaciones -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />

		<style>
			.breadcrumb-item {
				cursor: pointer;               /* Mostrar la "manita" al pasar el mouse */
				transition: background-color 0.3s, color 0.3s; /* Transición suave */
			}

			.breadcrumb-item:hover {
				background-color: #f0f0f0;     /* Fondo más claro al hacer hover */
				border-radius: 5px;
			}

			.breadcrumb-item.active {
				font-weight: bold;             /* Texto en negrita para el breadcrumb activo */
				color: #007bff !important;     /* Color azul para el activo */
				text-decoration: underline;    /* Subrayado para el activo */
			}
			.tab-pane {
				transition: opacity 0.3s ease;
				opacity: 0;
			}

			.tab-pane[aria-hidden="false"] {
				opacity: 1;
			}


		</style>
	</head>
	<body class="hold-transition layout-top-nav">
		<div class="wrapper">
			<!-- Navbar -->
			<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
				<div class="container">
					<a href="salir.php" class="navbar-brand">
						<span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="AdminLTE Logo"></span>
					</a>
					<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<?php include('includes/generalnavbar.php') ?>
					<?php include('includes/nav.php') ?> 
				</div> <!-- navbar container -->
			</nav> <!-- main-header navbar -->

			<!-- Main content -->
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<div class="container-fluid">
					<div class="row">
					<div class="col-md-6">
					
					</div>
					<!-- <div class="col-md-6 d-none d-sm-block">
						<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item float-center"><a href="prospectos.php">Prospectos</a></li> -->
						<!-- <li class="breadcrumb-item active">Nuevo</li> -->
						<!-- </ol>
					</div> -->
					</div>
				</div>
				</section>
				<div class="container d-flex justify-content-center">
					<div class="col-md-9" >
						<div class="card card-secondary">
							<div class="card-header">
								<h3 class="card-title">Nuevo Prospecto</h3>
							</div> <!-- card-header -->
				
							<div class="card-body">
								<nav aria-label="breadcrumb" >
									<ol class="breadcrumb">
										<li class="breadcrumb-item active" id="btnGenerales"><a href="#generales">Datos Generales</a></li>
										<li class="breadcrumb-item" id="btnCaracteristicas"><a href="#caracteristicas">Características</a></li>
									</ol>
								</nav> <!-- nav breadcrumb -->
								<form class="form-horizontal">
									<div class="tab-content">
										<div class="active tab-pane" id="generales"> 
											<div class="form-group row">
												<label for="inputNocliente" class="col-md-3 col-form-label text-left">No. Prospecto:</label>
												<div class="col-md-9">
													<input type="number" class="form-control text-danger" id="inputNocliente" name="inputNocliente" value="<?php echo $folioom;?>" readonly>
												</div> <!-- col -->
											</div> <!-- form-group -->

											<div class="form-group row">
												<label for="inputName" class="col-md-3 col-form-label text-left">Nombre Comercial Cliente:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre Comecial del Cliente" required>
												</div> <!-- col -->
											</div> <!-- form-group -->

											<div class="form-group row">
												<label for="inputRazonSocial" class="col-md-3 col-form-label text-left">Razon Social:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="inputRazonSocial" name="inputRazonSocial" placeholder="Razon Social">
												</div> <!-- col -->
											</div> <!-- form-group -->

											<div class="form-group row">
												<label for="inputDomicilio" class="col-md-3 col-form-label text-left">Calle y No.:</label>
												<div class="col-md-5">
													<input type="text" class="form-control" id="inputDomicilio" name="inputDomicilio" placeholder="Direccion" required>
												</div>

												<label for="inputTelefonoEmpresa" class="col-md-2 col-form-label text-left">Telefono Empresa:</label>
												<div class="col-md-2">
													<input type="text" class="form-control" id="inputTelefonoEmpresa" name="inputTelefonoEmpresa" placeholder="Telefono">
												</div>
											</div> <!-- form-group -->
											
											<div class="form-group row">
												<label for="inputCP" class="col-md-1 col-form-label text-left">CP:</label>
												<div class="col-md-1">
													<input type="text" class="form-control" id="inputCP" name="inputCP" placeholder="CP">
												</div>

												<label for="inputColonia" class="col-md-1 col-form-label text-left">Colonia:</label>
												<div class="col-md-2">
													<input type="text" class="form-control" id="inputColonia" name="inputColonia" placeholder="Colonia">
												</div>

												<label for="inputEstado" class="col-md-1 col-form-label text-left">Estado:</label>
												<div class="col-md-2">
													<input type="text" class="form-control" id="inputEstado" name="inputEstado" placeholder="Estado" required>
												</div>
												
												<label for="inputMunicipio" class="col-md-2 col-form-label text-left">Municipio: </label>
												<div class="col-md-2" >
													<input type="text" class="form-control w-full" id="inputMunicipio" name="inputMunicipio" placeholder="Municipio" required>
												</div>
											</div> <!-- form-group -->

											<div class="form-group row">
												<label for="inputContactorh" class="col-md-3 col-form-label text-left">Contacto RH/Compras:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="inputContactorh" name="inputContactorh" placeholder="Nombre de contacto" required>
												</div> <!-- col -->
											</div> <!-- form-group -->

											<div class="form-group row">
												<label for="inputPhone" class="col-md-2 col-form-label text-left">Telefono RH/Compras:</label>
												<div class="col-md-4">
													<input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Incluir clave lada" required>
												</div>
												
												<label for="inputCorreorh" class="col-md-2 col-form-label text-left">Correo Electrónico RH/Compras:</label>
												<div class="col-md-4">
													<input type="email" class="form-control" id="inputCorreorh" name="inputCorreorh" placeholder="ejemplo@correo.com" aria-label="Correo electronico de RR.HH. o Compras" required >
												</div>
											</div> <!-- form-group -->


											<div class="form-group row">
											</div>   <!-- form-group -->

											<div class="form-group row">
												<label for="inputDateContacto" class="col-md-3 col-form-label text-left">Primer Contacto:</label>
												<div class="col-md-3">
													<input type="text" class="form-control datepicker" id="inputDateContacto" name="inputDateContacto" required autocomplete="off">
												</div> <!-- col -->

												<label for="inputDateSeguimiento" class="col-md-3 col-form-label text-left">Fecha Seguimiento:</label>
												<div class="col-md-3">
													<input type="text" class="form-control datepicker" id="inputDateSeguimiento" name="inputDateSeguimiento" required autocomplete="off">
												</div> <!-- col -->
											</div> <!-- form-group -->

											<div class="form-group row">
												<label for="inputComentarios" class="col-md-3 col-form-label" style="text-align: left;">Comentarios:</label>
												<textarea name="inputComentarios" class="form-control" rows="3" id="inputComentarios" placeholder="Comentarios..."></textarea>
											</div> <!-- form-group -->

											<div class="form-group row justify-content-end">
												<div class="col-md-12">
													<button type="reset" class="btn btn-secondary btn_salir">Cancelar</button>
													<button type="submit" class="btn btn-success ms-2 guardar_prospecto">Guardar</button>
												</div> <!-- col -->
											</div> <!-- form-group -->
										</div> <!-- tab-pane generales -->
		
										<div class="tab-pane" id="caracteristicas" style="display: none;">
											<div class="form-group row">
												<label for="inputGiro" class="col-md-3 col-form-label text-left">Giro Comercial:</label>
												<div class="col-md-9">
													<input type="text" class="form-control" id="inputGiro" name="inputGiro" placeholder="Giro Comercial">
												</div> <!-- col -->
											</div> <!-- form-group row -->

											<div class="form-group row">
												<label for="inputEmpleados" class="col-md-2 col-form-label text-left">Cantidad de Empleados:</label>
												<div class="col-md-1">
													<input type="number" class="form-control" id="inputEmpleados" name="inputEmpleados">
												</div>
												<label for="inputTransporte" class="col-md-2 col-form-label text-left">Cuenta con Transporte:</label>
												<div class="col-md-7">
													<select name="inputTransporte" id="inputTransporte" class="form-control select2bs4">
														<option value="">--Seleccione una opcion--</option>
														<option value="1">Si</option>
														<option value="2">No</option>
													</select>
												</div>
											</div> <!-- form-group -->

											<div class="form-group row">
												<label for="inputTurnos" class="col-md-2 col-form-label text-left">Turnos:</label>
												<div class="col-md-1">
													<input type="number" class="form-control" id="inputTurnos" name="inputTurnos">
												</div>

												<label for="inputUnidad" class="col-md-2 col-form-label text-left">Tipo de Unidad:</label>
												<div class="col-md-7">
													<select name="inputUnidad" id="inputUnidad" class="form-control select2bs4">
														<option value="">--Seleccione--</option>
													</select>
												</div>
											</div><!-- form-group row -->

											<div class="form-group row">
												<label for="inputOrigen" class="col-md-3 col-form-label text-left">Origen:</label>
													<div class="col-md-9">
														<select name="inputOrigen" id="inputOrigen" class="form-control select2bs4">
															<option value="">--Seleccione--</option>
														</select>
													</div> <!-- col -->
											</div> <!-- form-group row -->

											<div class="form-group row justify-content-end">
												<div class="col-md-12">
													<button type="reset" class="btn btn-secondary btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
													<button type="submit" class="btn btn-success ms-2 guardar_prospecto">Guardar</button>
												</div> <!-- col -->
											</div> <!-- form-group row -->
										</div> <!-- tab-pane caracteristicas -->
									</div> <!-- tab-content -->
								</form> <!-- form-horizontal -->
							</div> <!-- card-body -->
						</div> <!-- card -->
					</div> <!-- col-md-9 -->
				</div> <!-- container -->
			</div> <!-- content-wrapper -->
			<!-- Main Footer -->
			<?php include('includes/footer.php') ?>
		</div> <!-- wrapper -->
		<!-- REQUIRED SCRIPTS -->
		<!-- jQuery -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

		<!-- jQuery UI -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

		<!-- Localización en español -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/i18n/jquery-ui-i18n.min.js"></script>

		<!-- Bootstrap 4 -->
		<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- AdminLTE App -->
		<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
		<script src="../dist/js/adminlte.min.js"></script>
		<!-- Select2 -->
		<script src="../plugins/select2/js/select2.full.min.js"></script>
		<!-- AdminLTE for demo purposes
		<script src="../dist/js/demo.js"></script> -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
		
		<!-- Scripts de accion -->
		<script>
			$(document).ready(function () {
				$('.btn_salir').click(function (e) {
					e.preventDefault();  // Previene comportamiento por defecto si es necesario

					Swal.fire({
						title: "¿Está seguro de que desea salir?",
						text: "Si sale, se perderán los cambios no guardados.",
						icon: 'warning',
						showCancelButton: true,
						confirmButtonText: "Permanecer aquí",
						cancelButtonText: "Salir",
						reverseButtons: true,  // Invertir botones para mejor UX
						focusCancel: true,     // Foco en el botón de cancelar
						showClass: {
							popup: 'animate__animated animate__fadeInDown'
						},
						hideClass: {
							popup: 'animate__animated animate__fadeOutUp'
						}
					}).then((result) => {
						if (result.isConfirmed) {
							console.log("El usuario decidió permanecer en la página.");
						} else if (result.dismiss === Swal.DismissReason.cancel) {
							console.log("Redirigiendo a prospectos.php...");
							window.location.href = 'prospectos.php';  // Redirección
						}
					});
				});
			});
		</script>

		<script>
			$(document).ready(function () {
				// Configuración del Datepicker en español
				$.datepicker.regional['es'] = {
					closeText: 'Cerrar',
					prevText: '< Ant',
					nextText: 'Sig >',
					currentText: 'Hoy',
					monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
						'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
					monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
						'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
					dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
					dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
					dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
					weekHeader: 'Sm',
					dateFormat: 'dd-mm-yy',
					firstDay: 1,
					isRTL: false,
					showMonthAfterYear: false,
					yearSuffix: ''
				};

				$.datepicker.setDefaults($.datepicker.regional['es']); // Aplicar la configuración en español
				// Inicializar Datepicker
				$(".datepicker").datepicker({
					dateFormat: "dd-mm-yy",        // Formato de fecha
					changeMonth: true,
					changeYear: true,
					showButtonPanel: true
				});
			});

		</script>

		<script>
			document.addEventListener("DOMContentLoaded", function () {
				const breadcrumbItems = document.querySelectorAll(".breadcrumb-item");
				const sections = document.querySelectorAll(".tab-pane");

				// Función para activar la sección correspondiente
				function activarSeccion(botonActivo) {
					const targetId = botonActivo.querySelector("a").getAttribute("href").substring(1); // Obtiene el ID de la sección
					
					// Ocultar todas las secciones
					sections.forEach(seccion => {
						seccion.style.display = "none";
						seccion.setAttribute("aria-hidden", "true");
					});

					// Remover clase activa de todos los breadcrumbs
					breadcrumbItems.forEach(item => item.classList.remove("active"));

					// Mostrar la sección activa
					const seccionActiva = document.getElementById(targetId);
					if (seccionActiva) {
						seccionActiva.style.display = "block";
						seccionActiva.setAttribute("aria-hidden", "false");
					}

					// Agregar clase activa al breadcrumb
					botonActivo.classList.add("active");
				}

				// Evento para todos los breadcrumbs
				breadcrumbItems.forEach(boton => {
					boton.addEventListener("click", function (e) {
						e.preventDefault(); // Evita el salto de ancla
						activarSeccion(boton);
					});
				});

				// Mostrar la primera sección al cargar la página
				activarSeccion(breadcrumbItems[0]);
			});

		</script>

		<script>
			$(document).ready(function () {
				$('.guardar_prospecto').click(function (e) {
					e.preventDefault();
					const $btn = $(this);
					$btn.prop('disabled', true).text('Guardando...');

					// Obtener los valores del formulario
					const datosProspecto = {
						nocte: $('#inputNocliente').val(),
						namecte: $('#inputName').val().trim(),
						razonSocial: $('#inputRazonSocial').val().trim(),
						domicilio: $('#inputDomicilio').val().trim(),
						colonia: $('#inputColonia').val().trim(),
						telefono_empresa: $('#inputTelefonoEmpresa').val().trim(),
						cp: $('#inputCP').val().trim(),
						estado: $('#inputEstado').val().trim(),
						municipio: $('#inputMunicipio').val().trim(),
						contactorh: $('#inputContactorh').val().trim(),
						phone: $('#inputPhone').val().trim(),
						correorh: $('#inputCorreorh').val().trim(),
						datecontact: $('#inputDateContacto').val(),
						dateSeguimiento: $('#inputDateSeguimiento').val(),
						comentarios: $('#inputComentarios').val().trim(),
						giro: $('#inputGiro').val().trim(),
						empleados: $('#inputEmpleados').val(),
						transporte: $('#inputTransporte').val(),
						turnos: $('#inputTurnos').val(),
						unidad: $('#inputUnidad').val(),
						origen: $('#inputOrigen').val()
					};

					// Validación de campos obligatorios
					const camposObligatorios = ['namecte', 'razonSocial', 'estado', 'municipio', 'contactorh', 'phone', 'correorh', 'datecontact'];
					for (const campo of camposObligatorios) {
						if (!datosProspecto[campo]) {
							Swal.fire({
								icon: 'warning',
								title: 'Campos obligatorios',
								text: 'Por favor, completa todos los campos requeridos.'
							});
							$btn.prop('disabled', false).text('Guardar');
							return;
						}
					}

					// Validación de email
					const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
					if (datosProspecto.correorh && !emailRegex.test(datosProspecto.correorh)) {
						Swal.fire({
							icon: 'error',
							title: 'Correo inválido',
							text: 'Por favor, ingresa un correo electrónico válido.'
						});
						$btn.prop('disabled', false).text('Guardar');
						return;
					}

					// Validación de teléfono
					const phoneRegex = /^\d{10}$/; // Número de 10 dígitos
					if (datosProspecto.phone && !phoneRegex.test(datosProspecto.phone)) {
						Swal.fire({
							icon: 'error',
							title: 'Teléfono inválido',
							text: 'El número de teléfono debe tener 10 dígitos.'
						});
						$btn.prop('disabled', false).text('Guardar');
						return;
					}

					// Enviar datos al servidor
					$.ajax({
						url: 'data/guardarProspecto.php',
						type: "POST",
						data: datosProspecto,
						dataType: "json",
						success: function (response) {
							if (response.success) {
								Swal.fire({
									title: "¡Éxito!",
									text: "Prospecto almacenado correctamente.",
									icon: 'success',
									confirmButtonText: "Aceptar"
								}).then(() => {
									window.location.href = 'prospectos.php';
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Error al guardar',
									text: response.message || 'Ocurrió un error al guardar. Intenta de nuevo.'
								});
								$btn.prop('disabled', false).text('Guardar');
							}
						},
						error: function (xhr, status, error) {
							console.error('Error en AJAX:', error);
							Swal.fire({
								icon: 'error',
								title: 'Error de red',
								text: 'Ocurrió un problema en la conexión. Intenta de nuevo.'
							});
							$btn.prop('disabled', false).text('Guardar');
						}
					});
				});
			});

		</script>
	</body>
</html>