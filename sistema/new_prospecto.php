<?php
session_start();
include('../conexion.php');
$User = $_SESSION['user'];
if(!isset($_SESSION['user'])) {
header('Location: /');
exit;
}
$rol = $_SESSION['rol'];
$sql_id_prospectos = "SELECT MAX(id) FROM prospectos";
$query_prospectos = mysqli_query($conection, $sql_id_prospectos);
$folio_prospectos = mysqli_fetch_array($query_prospectos);
$folioom = $folio_prospectos['MAX(id)'] +1;
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
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="AdminLTE Logo"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php include('includes/generalnavbar.php') ?>
      <?php include('includes/nav.php') ?> 

    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
 
    <!-- /.content-header -->

    <!-- Main content -->
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          
          </div>
          <!-- <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item float-center"><a href="prospectos.php">Prospectos</a></li> -->
              <!-- <li class="breadcrumb-item active">Nuevo</li> -->
            <!-- </ol>
          </div> -->
        </div>
      </div>
    </section>
    <center>
    <div class="col-md-9" >
    <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Nuevo Prospecto</h3>
              </div>
    
              <div class="card-body">
              <div class="card-header p-2">
                <nav aria-label="breadcrumb" >
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item" id="btnGenerales"><a href="#generales">Datos Generales</a></li>
                    <li class="breadcrumb-item active" aria-current="page" id="btnCaracteristicas">Caracteristicas</li>
                  </ol>
                </nav>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    
					<div class="post clearfix">
						<form class="form-horizontal">
							<div class="active tab-pane" id="generales"> 
								<div class="form-group row">
									<label for="inputEmail" class="col-sm-3 col-form-label" style="text-align: left;">No. Prospecto:</label>
									<div class="col-sm-9">
										<input type="number" class="form-control" id="inputNocliente" name="inputNocliente" value="<?php echo $folioom;?>" readonly>
									</div>
								</div>

								<div class="form-group row">
									<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Nombre Comercial Cliente:</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputName" name="inputName" placeholder="Nombre Comecial del Cliente">
									</div>
								</div>

								<div class="form-group row">
									<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Razon Social:</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="inputRazonSocial" name="inputName" placeholder="Razon Social">
									</div>
								</div>

								<div class="form-group row">
									<div class="col-4 d-flex">
										<label for="inputDomicilio" class="col-4 col-form-label" style="text-align: left;">Calle y No.:</label>
										<div class="col-8">
											<input type="text" class="form-control" id="inputDomicilio" name="inputName" placeholder="Direccion">
										</div>
									</div>
									<div class="col-3 d-flex">
										<label for="inputColonia" class="col-4 col-form-label" style="text-align: left;">Colonia:</label>
										<div class="col-6">
											<input type="text" class="form-control" id="inputColonia" name="inputName" placeholder="Colonia">
										</div>
									</div>
									<div class="col-3 d-flex">
										<label for="inputTelefonoEmpresa" class="col-6 col-form-label" style="text-align: left;">Telefono Empresa:</label>
										<div class="col-6">
											<input type="text" class="form-control" id="inputTelefonoEmpresa" name="inputTelefonoEmpresa" placeholder="Telefono">
										</div>
									</div>
								</div>

								<div class="form-group row">
									<div class="col-2 d-flex">
										<label for="inputCP" class="col-4 col-form-label" style="text-align: left;">CP:</label>
										<div class="col-7">
											<input type="text" class="form-control" id="inputCP" name="inputName" placeholder="CP">
										</div>
									</div>
									<div class="col-3 d-flex">
										<label for="inputEstado" class="col-6 col-form-label">Estado:</label>
										<div class="col-6">
											<input type="text" class="form-control" id="inputEstado" name="inputEstado" placeholder="Estado">
										</div>
									</div>
									<div class="col-3 d-flex">
										<label for="inputMunicipio" class="col-6 col-form-label" style="text-align: left">Municipio: </label>
										<div class="col-6" >
											<input type="text" class="form-control" id="inputMunicipio" name="inputMunicipio" placeholder="Municipio">
										</div>
									</div>
									<div class="col-4"></div>
								</div>

								<div class="form-group row">
									<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Contacto RH/Compras:</label>
									<div class="col-sm-9">
										<input type="input" class="form-control" id="inputContactorh" name="inputContactorh" >
									</div>
								</div>  

								<div class="form-group row">
									<div class="col-4 row">
										<label for="inputName" class="col-4 col-form-label" style="text-align: left;">Telefono RH/Compras:</label>
										<div class="col-8">
											<input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Incluir clave lada">
										</div>
									</div>
									<div class="col-8 d-flex">
										<label for="inputName" class="col-3 col-form-label" style="text-align: left;">Correo Electrónico RH/Compras:</label>
										<div class="col-9">
											<input type="text" class="form-control" id="inputCorreorh" name="inputCorreorh" >
										</div>
									</div>
								</div>  


                      			<div class="form-group row">
                      			</div>   

								<div class="form-group row">
									<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Primer Contacto:</label>
									<div class="col-sm-3">
										<input type="date" class="form-control" id="inputDateContacto" name="inputDateini" >
									</div>
									<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Seguimiento:</label>
									<div class="col-sm-3">
										<input type="date" class="form-control" id="inputDateSeguimiento" name="inputDatefin" >
									</div>
								</div> 

								<div class="form-group row">
									<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Comentarios:</label>
										<textarea name="inputComentarios" class="form-control" rows="3" id="inputComentarios" placeholder="Comentarios..."></textarea>
								</div>

								<div class="form-group row" style="text-align:right;">
									<div class="offset-sm-2 col-sm-10">
										<button type="button" class="btn btn-secondary btn_salir">Cancelar</button>
										<button type="submit" class="btn btn-success guardar_prospecto">Guardar</button>
									</div>
								</div>
							</div>

							

				  		<div class="tab-pane" id="caracteristicas" style="display: none;">
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Giro Comercial:</label>
								<div class="col-8">
									<input type="text" class="form-control" id="inputGiro" name="inputGiro" placeholder="Giro Comercial">
								</div>
							</div>
							<div class="form-group row">
								<div class="row">
									<div class="col-6 d-flex">
										<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Cantidad de Empleados:</label>
										<div class="col-8">
											<input type="number" class="form-control" id="inputEmpleados" name="inputEmpleados" placeholder="Cantidad de Empleados">
										</div>
									</div>
									<div class="col-6 d-flex">
										<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Cuenta con Transporte:</label>
										<div class="col-8">
											<select name="inputTransporte" id="inputTransporte" class="form-control select2bs4">
												<option value="">--Seleccione una opcion--</option>
												<option value="1">Si</option>
												<option value="2">No</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group row">
								<div class="row">
									<div class="col-6 d-flex">
										<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Turnos:</label>
										<div class="col-8">
											<input type="number" class="form-control" id="inputTurnos" name="inputTurnos" placeholder="Turnos">
										</div>
									</div>
									<div class="col-6 d-flex">
										<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Tipo de Unidad:</label>
										<div class="col-8">
											<select name="inputUnidad" id="inputUnidad" class="form-control select2bs4">
												<option value="">--Seleccione--</option>
											</select>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Origen:</label>
									<div class="col-8">
										<select name="inputOrigen" id="inputOrigen" class="form-control select2bs4">
											<option value="">--Seleccione--</option>
										</select>
									</div>
							</div>
							<div class="form-group row" style="text-align:right;">
								<div class="offset-sm-2 col-sm-10">
									<button type="button" class="btn btn-secondary btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
									<button type="submit" class="btn btn-success guardar_prospecto">Guardar</button>
								</div>
							</div>
						</div>

                    </form>
                    </div>
  
</center>

  <!-- Main Footer -->
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
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->
<script src="js/sweetalert2.all.min.js"></script>  

<script>

$('.btn_salir').click(function(e){
        e.preventDefault();

            
        Swal
    .fire({
        title: "DESEA SALIR!",
        text: "",
        icon: 'info',

        showCancelButton: true,
        confirmButtonText: "Regresar",
        cancelButtonText: "Salir",
       

       
    })
     .then(resultado => {
        if (resultado.value) {
            // Hicieron click en "Sí"
             //*location.href = 'lista_ncplantasa.php';
             console.log("Alerta cerrada");
        } else {
            // Dijeron que no
            //*location.reload();
            location.href = 'prospectos.php';
        }
    });

   

    });
    </script>

<script>
		document.addEventListener("DOMContentLoaded", function () {
		document.getElementById("btnGenerales").addEventListener("click", function () {
        document.getElementById("generales").style.display = "block";
        document.getElementById("caracteristicas").style.display = "none";
    });

    document.getElementById("btnCaracteristicas").addEventListener("click", function () {
        document.getElementById("generales").style.display = "none";
        document.getElementById("caracteristicas").style.display = "block";
    });
});
</script>

<script>
   $('.guardar_prospecto').click(function(e){
	console.log('Click en guardar prospecto');
        e.preventDefault();
		let nocte = $('#inputNocliente').val();
		let nombreComercial = $('#inputName').val();
		let razonSocial = $('#inputRazonSocial').val();
		let domicilio = $('#inputDomicilio').val();
		let colonia = $('#inputColonia').val();
		let telefono_empresa = $('#inputTelefonoEmpresa').val();
		let cp = $('#inputCP').val();
		let estado = $('#inputEstado').val();
		let municipio = $('#inputMunicipio').val();
		let contactorh = $('#inputContactorh').val();
		let phone = $('#inputPhone').val();
		let correorh = $('#inputCorreorh').val();
    	let datecontac = $('#inputDateContacto').val();
		let dateSeguimiento = $('#inputDateSeguimiento').val();
		let comentarios = $('#inputComentarios').val();
		let giro = $('#inputGiro').val();
		let empleados = $('#inputEmpleados').val();
		let transporte = $('#inputTransporte').val();
		let turnos = $('#inputTurnos').val();
		let unidad = $('#inputUnidad').val();
		let origen = $('#inputOrigen').val();


        $.ajax({
                    url: 'data/guardarProspecto.php',
                    type: "POST",
                    async : true,
                    data: {nocte:nocte, namecte:nombreComercial, razonSocial:razonSocial, phone:phone, contactorh:contactorh, correorh:correorh, datecontact:datecontac, dateSeguimiento:dateSeguimiento, comentarios:comentarios, domicilio:domicilio, colonia:colonia, telefono_empresa:telefono_empresa, cp:cp, estado:estado, municipio:municipio, giro:giro, empleados:empleados, transporte:transporte, turnos:turnos, unidad:unidad, origen:origen}, 

                    success: function(response)
                    {
                       if(response.success)
                        {
                            Swal
                         .fire({
                          title: "Exito!",
                          text: "PROSPECTO ALMACENADO CORRECTAMENTE",
                          icon: 'success',
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        // location.href = 'prospectos.php';
                       
                        } else {
                          // Dijeron que no
                        //  location.href = 'prospectos.php';
                        }
                        });  
                    }else {                          
                            //swal('Mensaje del sistema', $mensaje, 'warning');
                            //location.reload();
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Ocurrio un error al guardar. Por favor intenta de nuevo.'
                            })
                        }                           
                        },
                 error: function(error) {
					console.error('Error en AJAX:', error);
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Ocurrió un error en la conexión. Inténtalo de nuevo.'
					});
                 }

               });

    });

    </script>  