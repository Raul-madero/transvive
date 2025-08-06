<?php
include "../conexion.php";
session_start();
	$User=$_SESSION['user'];
	$rol=$_SESSION['rol'];
	$sql = "select * from rol where idrol =$rol ";
	$query = mysqli_query($conection, $sql);
	$filas = mysqli_fetch_assoc($query); 

	$namerol = $filas['rol'];
	if (!isset($_SESSION['idUser'])) {
		header('Location: ../index.php');
	}

	$sqloper   = "select no_prov, nombre from proveedores where estatus = 1 ORDER BY nombre";
	$queryoper = mysqli_query($conection, $sqloper);
	$filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

	$sqlrecb   = "select nombre from usuario where rol = 10 and estatus = 1 ORDER BY nombre";
	$queryrecb = mysqli_query($conection, $sqlrecb);
	$filasrecb = mysqli_fetch_all($queryrecb, MYSQLI_ASSOC); 

	$sqlprod   = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY descripcion";
	$queryprod = mysqli_query($conection, $sqlprod);
	$filasprod = mysqli_fetch_all($queryprod, MYSQLI_ASSOC);

	$sqlprodnm = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY descripcion";
	$queryprodnm = mysqli_query($conection, $sqlprodnm);
	$filasprodnm = mysqli_fetch_all($queryprodnm, MYSQLI_ASSOC);

	$sqlprov   = "select id, no_prov, nombre from proveedores where estatus = 1";
	$queryprov = mysqli_query($conection, $sqlprov);
	$filasprov = mysqli_fetch_all($queryprov, MYSQLI_ASSOC); 

	$sqlsmant  = "select no_orden from solicitud_mantenimiento where estatus = 1";
	$querysmant = mysqli_query($conection, $sqlsmant);
	$filasmant = mysqli_fetch_all($querysmant, MYSQLI_ASSOC); 

	$sqlumed = "select * from unidades_medida ORDER BY descripcion";
	$queryumed = mysqli_query($conection, $sqlumed);
	$filasumed = mysqli_fetch_all($queryumed, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
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
	<!-- Theme style -->
	<link rel="stylesheet" href="../dist/css/adminlte.min.css">
	<!-- Ekko Lightbox -->
	<link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<style>
		.hidden {
			display: none;
		}

		input[type="number"] {
			-moz-appearance: textfield; /* Firefox */
			appearance: textfield; /* Chrome, Safari, Edge */
		}
		input[type="number"]::-webkit-inner-spin-button,
		input[type="number"]::-webkit-outer-spin-button {
			-webkit-appearance: none;
			margin: 0;
		}

		.table-responsive {
			overflow-x: auto;
		}
		.table-responsive td {
			max-width: 100%;
			white-space: nowrap;
			text-overflow: ellipsis;
		}
  	</style>
</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">
   		<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    		<div class="container">
				<a href="salir.php" class="navbar-brand">
					<span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE CRM"></span>
				</a>
      			<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        			<span class="navbar-toggler-icon"></span>
      			</button>
     			<?php include('includes/generalnavbar.php') ?>
      			<?php include('includes/nav.php') ?>
    		</div>
  		</nav>
      	<!-- Content Wrapper. Contains page content -->
  		<div class="content-wrapper">
    		<section class="content-header">
      			<div class="container-fluid">
        			<div class="row">
          				<div class="col-sm-6">
          				</div>
        			</div>
      			</div>
    		</section> <!-- / .content-header -->
    		<center>
         		<?php
					date_default_timezone_set('America/Mexico_City');
					$fcha = date("Y-m-d");
     			?>  
     			<!-- Horizontal Form -->

     			<div class="col-md-9">
     				<div class="card card-secondary">
              			<div class="card-header">
                			<h3 class="card-title">Evaluaciónde Proveedores (Servicios)</h3>
              			</div>
						<!-- /.card-header -->
              			<div class="card-body">
							<form class="form-horizontal">
								<div class="form-group row">
									<div class="col-sm-10">
									</div>
								</div>
								<div class="form-group row" style="text-align:left;">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Tipo de valoración</label>
									<div class="col-sm-4">
										<select class="form-control" style="width: 100%; text-align: left" id="inputTipo" name="inputTipo"  onchange="toggleTableVisibility()">
											<option value="">- Seleccione -</option>
											<option value="SELECCION">SELECCIÓN</option>
											<option value="EVALUACION">EVALUACIÓN</option>
											<option value="RE-EVALUACION">RE-EVALUACION</option>
										</select>
									</div>
									<label for="inputEmail3" class="col-sm-2 col-form-label">Fecha</label>
									<div class="col-sm-3">
										<input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fcha;?>">
									</div>
								</div>

								<div class="form-group row" style="text-align:left;">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Nombre del Proveedor</label>
									<div class="col-sm-9">
										<select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputProveedor" name="inputProveedor">
											<option value="">- Seleccione -</option>
											<?php foreach ($filasoper as $oppv): //llenar las opciones del primer select ?>
												<option value="<?= $oppv['no_prov'] ?>"><?= $oppv['nombre'] ?></option>  
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group row" style="text-align:left;">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Producto y/o Servicio</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputProducto" name="inputProducto">
									</div>
								</div>

								<div id="tableContainerOne" class="hidden" class="col-sm-12">
									<div class="row">    
										<table class="table table-striped" >
											<thead class="thead-dark">
												<tr>
													<th scope="col" style="width: 5%;">No.</th>
													<th scope="col" style="width: 10%">Área</th>
													<th scope="col" style="width: 30%">Criterios</th>
													<th scope="col" style="width: 10%">Parámetro</th>
													<th scope="col" style="width: 20%">Calificacion</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1. </td>
													<td>COMPRAS</td>
													<td>PRECIO</td>
													<td>1 - 30</td>
													<td><input type="number" id="input1" name="input1" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>
												<tr>
													<td>2. </td>
													<td>COMPRAS</td>
													<td>DOCUMENTACIÓN</td>
													<td>1 - 10</td>
													<td><input type="number" id="input2" name="input2" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>
												<tr>
													<td>3. </td>
													<td>COMPRAS</td>
													<td>CRÉDITO</td>
													<td>1 - 10</td>
													<td><input type="number" id="input3" name="input3" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>
												<tr>
													<td>4. </td>
													<td>COMPRAS</td>
													<td>TIEMPO DE RESPUESTA</td>
													<td>1 - 50</td>
													<td><input type="number" id="input4" name="input4" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>

											</tbody>
										</table>
									</div>
								</div>
								<!-- / #tableContainerOne -->

								<div id="tableContainerTwo" class="hidden" class="col-sm-12">
									<div class="row">      
										<table class="table table-striped">
											<thead class="thead-dark">
												<tr>
													<th scope="col" style="width: 5%;">No.</th>
													<th scope="col" style="width: 10%">Área</th>
													<th scope="col" style="width: 30%">Criterios</th>
													<th scope="col" style="width: 10%">Parámetro</th>
													<th scope="col" style="width: 20%">Calificacion</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1. </td>
													<td>COMPRAS</td>
													<td>PRECIO</td>
													<td>1 - 20</td>
													<td><input type="number" id="input5" name="input5" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>
												<tr>
													<td>2. </td>
													<td>COMPRAS</td>
													<td>DOCUMENTACIÓN</td>
													<td>1 - 10</td>
													<td><input type="number" id="input6" name="input6" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>
												<tr>
													<td>3. </td>
													<td>COMPRAS</td>
													<td>CRÉDITO</td>
													<td>1 - 10</td>
													<td><input type="number" id="input7" name="input7" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>
												<tr>
													<td>4. </td>
													<td>COMPRAS</td>
													<td>TIEMPO DE RESPUESTA</td>
													<td>1 - 30</td>
													<td><input type="number" id="input8" name="input8" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>
												<tr>
													<td>5. </td>
													<td>COMPRAS</td>
													<td>CALIDAD DEL SERVICIO (EVIDENCIA)</td>
													<td>1 - 30</td>
													<td><input type="number" id="input9" name="input9" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="0"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<!-- / #tableContainerTwo -->
								
								<div id="tableContainerThree" class="hidden" class="col-sm-12">
									<div class="row">      
										<table class="table table-striped">
											<thead class="thead-dark">
												<tr>
													<th scope="col" style="width: 5%;">No.</th>
													<th scope="col" style="width: 10%">Área</th>
													<th scope="col" style="width: 30%">Criterios</th>
													<th scope="col" style="width: 10%">Parámetro</th>
													<th scope="col" style="width: 20%">Calificacion</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>1. </td>
													<td>CALIDAD</td>
													<td>CONDICIONES DE EMPAQUE</td>
													<td>1 - 10</td>
													<td><input type="number" id="input11" name="input11" min="0" step="1" oninput="validateInput(this)" value="0"></td>
												</tr>
												<tr>
													<td>2. </td>
													<td>CALIDAD</td>
													<td>RECHAZO</td>
													<td>1 - 50</td>
													<td><input type="number" id="input12" name="input12" min="0" step="1" oninput="validateInput(this)"  value="0"></td>
												</tr>
												<tr>
													<td>3. </td>
													<td>CALIDAD</td>
													<td>IDENTIFICACIÓN (nombre de producto, marca y proveedor)</td>
													<td>1 - 5</td>
													<td><input type="number" id="input13" name="input13" min="0" step="1" oninput="validateInput(this)"  value="0"></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<!-- / #tableContainerThree -->
								<div class="form-group row" style="text-align:left;">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Para consultas dudas con:</label>
									<div class="col-sm-9">
										<select class="form-control" style="width: 100%; text-align: left" id="inputConsulta" name="inputConsulta">
											<option value="compras@transvivegdl.com">compras@transvivegdl.com</option>  
					
										</select>
									</div>
								</div>
								<!-- / .form-group.consulta -->
								<div id="tableContainerFive" class="hidden" class="col-12">
									<div class="form-group row" style="text-align:center;">
										<label for="inputEmail3" class="col-sm-12 col-form-label">Historial de desempeño:</label>
										</div>
									<div class="form-group row" style="text-align:left;">
										<label for="inputEmail3" class="col-sm-3 col-form-label">Historial de desempeño:</label>
										<div class="col-sm-3">
											<input type="date" class="form-control" id="inputFechah1" name="inputFechah1">
										</div>
										<div class="col-sm-2">
												<input type="number" class="form-control" id="historial1" name="historial1" min="0" step="1" oninput="validateInput(this)" value="0">
										</div>
									</div>
									<!-- / row historial1 -->
									<div class="form-group row" style="text-align:left;">
										<label for="inputEmail3" class="col-sm-3 col-form-label">Historial de desempeño:</label>
										<div class="col-sm-3">
											<input type="date" class="form-control" id="inputFechah2" name="inputFechah2">
										</div>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="historial2" name="historial2" min="0" step="1" oninput="validateInput(this)"  value="0">
										</div>
									</div>
									<!-- / row historial2 -->
									<div class="form-group row" style="text-align:left;">
										<label for="inputEmail3" class="col-sm-3 col-form-label">Historial de desempeño:</label>
										<div class="col-sm-3">
											<input type="date" class="form-control" id="inputFechah3" name="inputFechah3">
										</div>
										<div class="col-sm-2">
											<input type="number" class="form-control" id="historial3" name="historial3" min="0" step="1" oninput="validateInput(this)"  value="0">
										</div>
									</div>
									<!-- / row historial3 -->
								</div>
								<!-- / #tableContainerFive -->

								<div id="tableContainerFour" class="col-sm-12">
									<div class="row">      
										<table class="table-responsive table  " >
											<thead class="thead-dark">
												<tr>
													<th scope="col" style="width: 10%;">Compras</th>
													<th scope="col" style="width: 10%">Calidad</th>
													<th scope="col" style="width: 10%">Total</th>
													<th scope="col" style="width: 20%">Minima aprobatoria</th>
													<th scope="col" style="width: 10%">Estatus</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td style="text-align: center;"><input type="number" step="1" name="califcompras" id="califcompras" value="0" readonly></td>
													<td style="text-align: center;"><input type="number" step="1" name="califcalidad" id="califcalidad" value="0" readonly></td>
													<td style="text-align: center;"><input type="number" step="1" name="califtotal" id="califtotal" value="0" readonly></td>
													<td style="text-align: center;">80</td>
													<td style="text-align: center;"><input type="text" name="estatusc" id="estatusc" readonly></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								<!-- / #tableContainerFour -->
								<div class="form-group row" style="text-align:left;">
									<label for="inputEmail3" class="col-sm-3 col-form-label">Acciones a seguir:</label>
									<div class="col-sm-9">
										<textarea class="form-control" id="inputAcciones" name="inputAcciones" rows="1"></textarea>
									</div>
								</div>
								<div class="form-group row" style="text-align:right;">
									<div class="offset-sm-2 col-sm-10">
										<button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
										<button type="submit" class="btn btn-success" id="guardar_tipoactividad">Guardar</button>
									</div>
								</div>
							</form>
						</div>
						<!-- /.card-body -->
     				</div>
					<!-- /.card -->
     			</div>
			</center>
		</div>
    	<!-- /.content-wrapper -->
  		<?php include('includes/footer.php') ?>
	</div>
	<!-- ./wrapper -->
	
	<!-- REQUIRED SCRIPTS -->
	
	<!-- jQuery -->
	<script src="../plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="../dist/js/adminlte.min.js"></script>
	<!-- Select2 -->
	<script src="../plugins/select2/js/select2.full.min.js"></script>
	<!-- Sweetalert -->
	<script src="js/sweetalert2.all.min.js"></script>
	
	<!-- Script para llenar las fechas de evaluaciones previas (si aplica) -->
	<script>
  		$(document).ready(function() {
    		$('#inputProveedor').on('change', function() {
      			var selectedValue = $(this).val();
      			let tipoEval = $('#inputTipo').val();

      			if( tipoEval === 'RE-EVALUACION') {
        			$.ajax({
          				url: 'data/historial_eval_servicio.php',
          				type: 'POST',
          				data: { proveedor: selectedValue },
          				success: function(response) {
            				console.log(response.ultima_evaluacion);
            				let evaluacion = response.ultima_evaluacion
							$('#inputFechah1').val(evaluacion.fecha_eval)
							$('#inputFechah2').val(evaluacion.fecha_hist1)
							$('#inputFechah3').val(evaluacion.fecha_hist2)
							$('#historial1').val(evaluacion.calificacion_total)
							$('#historial2').val(evaluacion.historia1)
							$('#historial3').val(evaluacion.historia2)
          				}
       				})
      			}
      // Aquí puedes hacer algo con el valor seleccionado, como mostrarlo en la consola
    		});
  		});
	</script>

	<!-- Manejo del boton cancelar -->
 	<script>
		$('#btn_salir').click(function(e){
        	e.preventDefault();
        	Swal
    		.fire({
        		title: "DESEA SALIR!",
        		text: "",
        		icon: 'info',
        		showCancelButton: true,
        		confirmButtonText: "Regresar",
        		cancelButtonText: "Salir"
    		})
     		.then(resultado => {
        		if (resultado.value) {
              		console.log("Alerta cerrada");
        		} else {
              		location.href = 'evalua_proveservicios.php';
        		}
    		});
    	});
    </script>

	<!-- Manejo del boton de guardar -->
	<script>
   		$('#guardar_tipoactividad').click(function(e){
       	 	e.preventDefault();

			var tipo_eval     = $('#inputTipo').val();
			var fecha         = $('#inputFecha').val();
			var proveedor     = $('#inputProveedor').val();
			var producto      = $('#inputProducto').val();
			var consulta      = $('#inputConsulta').val();
			var fecha_h1      = $('#inputFechah1').val() ? $('#inputFechah1').val() : new Date().toISOString().slice(0, 10);
			var historial_h1  = $('#historial1').val();
			var fecha_h2      = $('#inputFechah2').val() ? $('#inputFechah2').val() : new Date().toISOString().slice(0, 10);
			var historial_h2  = $('#historial2').val();
			var fecha_h3      = $('#inputFechah3').val() ? $('#inputFechah3').val() : new Date().toISOString().slice(0, 10);
			var historial_h3  = $('#historial3').val();
			var tot_compras   = $('#califcompras').val();
			var tot_calidad   = $('#califcalidad').val();
			var calif_total   = $('#califtotal').val();
			var estatusc      = $('#estatusc').val();
			var acciones      = $('#inputAcciones').val();

			if (tipo_eval == 'SELECCION') {
				var precio     = $('#input1').val();;
				var documenta  = $('#input2').val();
				var credito    = $('#input3').val();
				var tiempo_res = $('#input4').val();
				var calidad_se = 0;
       		}else {
				var precio = $('#input5').val();
				var documenta  = $('#input6').val();
				var credito    = $('#input7').val();
				var tiempo_res = $('#input8').val();
				var calidad_se = $('#input9').val();
       		}
       		var action       = 'AlmacenaEvaluaservicio';

        	$.ajax({
				url: 'includes/ajax.php',
				type: "POST",
				async : true,
				dataType: 'json',
				data: {action:action, tipo_eval, fecha:fecha, proveedor:proveedor, producto:producto, consulta:consulta, fecha_h1:fecha_h1, historial_h1:historial_h1, fecha_h2:fecha_h2, historial_h2:historial_h2, fecha_h3:fecha_h3, historial_h3:historial_h3, tot_compras:tot_compras, tot_calidad:tot_calidad, calif_total:calif_total, estatusc:estatusc, acciones:acciones, precio:precio, documenta:documenta, credito:credito, tiempo_res:tiempo_res, calidad_se:calidad_se },

				success: function(response)
                {
					console.log(response)
                	if(response.status === "success") {
                            Swal
                         	.fire({
                          		title: "Exito!",
                          		text: response.message,
                          		icon: 'success'
                       		})
                        	.then(resultado => {
                      			 if (resultado.value) {
                        			//generarimpformulaPDF(info.folio);
                        			location.href = 'evalua_proveservicios.php';
                        		} else {
                          			// Dijeron que no
                          			location.reload();
                         			location.href = 'evalua_proveservicios.php';
                        		}
                        	});
						}else {  
							console.log(response)
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                            })
                        }
				},
				error: function(error) {
					console.log(error)
				}
            });
    	});
    </script>

	<!-- Ocultar cierto contenido dependiendo de las selecciones -->
	<script>
    	function toggleTableVisibility() {
      		var container = document.getElementById('tableContainerOne');
      		var containertwo = document.getElementById('tableContainerTwo');
      		var containerFive = document.getElementById('tableContainerFive')
      		var select = document.getElementById('inputTipo');
      		var selectedValue = select.value;

      		if (selectedValue === 'SELECCION') {
        		container.classList.remove('hidden');
        		containertwo.classList.add('hidden');
        		containerFive.classList.add('hidden');
      		} else if(selectedValue === 'EVALUACION'){
        		container.classList.add('hidden');
        		containertwo.classList.remove('hidden');
        		containerFive.classList.add('hidden');
      		}else if(selectedValue === 'RE-EVALUACION'){
        		container.classList.add('hidden');
        		containertwo.classList.remove('hidden');
        		containerFive.classList.remove('hidden');
      		}
    	}
  	</script> 

	<!-- Calcular la suma de los inputs -->
  	<script>
     	function validateInput(input) {
      		// Reemplazar todo lo que no sea dígito
      		input.value = input.value.replace(/[^0-9]/g, '');
    	} 

    	function updateSum() {
     		// alert('Function called'); // Verifica si esta alerta aparece
      		// Obtener los valores de los inputs
      		var input1  = document.getElementById('input1').value;
			var input2  = document.getElementById('input2').value;
			var input3  = document.getElementById('input3').value;
			var input4  = document.getElementById('input4').value;
			var input5  = document.getElementById('input5').value;
			var input6  = document.getElementById('input6').value;
			var input7  = document.getElementById('input7').value;
			var input8  = document.getElementById('input8').value;
			var input9  = document.getElementById('input9').value;
			var num1  = parseFloat(input1) || 0;
			var num2  = parseFloat(input2) || 0;
			var num3  = parseFloat(input3) || 0;
			var num4  = parseFloat(input4) || 0;
			var num5  = parseFloat(input5) || 0;
			var num6  = parseFloat(input6) || 0;
			var num7  = parseFloat(input7) || 0;
			var num8  = parseFloat(input8) || 0;
			var num9  = parseFloat(input9) || 0;
      		var sum = num1 + num2 + num3 + num4 + num5 + num6 + num7 + num8 + num9 ;
      		var sumtotal = sum ;

      		if (sumtotal >= 80 ) {
        		var resultado = 'APROBADO';
      		}else {
        		var resultado = 'NO APROBADO';
      		}

			// Mostrar el resultado en el input 'result'
			document.getElementById('califcompras').value = sum;
			document.getElementById('califtotal').value = sumtotal;
			document.getElementById('estatusc').value = resultado;
    	}
  	</script>
  
  	<!-- Refrescar la página cada 5 segundos -->
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
