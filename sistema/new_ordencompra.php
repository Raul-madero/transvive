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

if(!isset($_REQUEST['req'])) {
 	header('Location: new_cotizacioncompra.php');
}
$requisicion = $_REQUEST['req'];

// $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados where estatus = 1 ORDER BY nombres";
// $queryoper = mysqli_query($conection, $sqloper);
// $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

// $sqlrecb   = "select nombre from usuario where rol = 10 and estatus = 1 ORDER BY nombre";
// $queryrecb = mysqli_query($conection, $sqlrecb);
// $filasrecb = mysqli_fetch_all($queryrecb, MYSQLI_ASSOC); 

$sqlprod   = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY codigo";
$queryprod = mysqli_query($conection, $sqlprod);
$filasprod = mysqli_fetch_all($queryprod, MYSQLI_ASSOC);

$sqlprodnm = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY descripcion";
$queryprodnm = mysqli_query($conection, $sqlprodnm);
$filasprodnm = mysqli_fetch_all($queryprodnm, MYSQLI_ASSOC);

$sqlprov   = "select id, no_prov, nombre from proveedores where estatus = 1";
$queryprov = mysqli_query($conection, $sqlprov);
$filasprov = mysqli_fetch_all($queryprov, MYSQLI_ASSOC); 

$sqlumed   = "select codigo, descripcion from unidades_medida ORDER BY codigo";
$queryumed = mysqli_query($conection, $sqlumed);
$filasumed = mysqli_fetch_all($queryumed, MYSQLI_ASSOC); 

// $sqloc   = "select id, no_requisicion from requisicion_compra where estatus = 2";
// $queryoc = mysqli_query($conection, $sqloc);
// $filasoc = mysqli_fetch_all($queryoc, MYSQLI_ASSOC); 


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
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Orden de Compra</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

       <?php
                    
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT MAX(no_orden) AS folio  FROM orden_compra");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["folio"]+1; 

          // $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'CP'");
          

          mysqli_close($conection);
        ?>  
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  

     <!-- Horizontal Form -->

     <div class="col-md-10">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Alta de Orden de Compra</h3>
              </div>
              <div class="card-body">
              <div class="card-header p-2">
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
              <div class="form-group row">
                    <div class="col-sm-10">
                    </div>
                  </div>
              

                  <div class="form-group row" style="text-align:left;">
                    <label  for="inputEmail3" class="col-sm-2 col-form-label">No. Requsicion</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="inputReq" name="inputReq" value="<?php echo "REQ-" . $requisicion; ?>" readonly>
					</div>
                     <!-- <select style=" font-size: 14px;"  class="form-control select2bs4" style="width: 100%; text-align: left" id="inputNoorden" name="inputNoorden">
                       <option value="">No. Requisicion</option>
                       <?php foreach ($filasoc as $opoc): //llenar las opciones del primer select ?>
                       <option value="<?= $opoc['no_requisicion'] ?>"><?= $opoc['no_requisicion'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div> -->
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align: right;">Fecha</label>
                    <div class="col-sm-2">
                      <input style=" font-size: 14px;" type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fcha;?>">
                    </div>
                    <label  for="inputEmail3" class="col-sm-2 col-form-label">No. Orden</label>
                    <div class="col-sm-2">
                      <input style="text-align: right; font-weight: bold; color: #F05B0E" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo "OC-"  . $nuevofolio; ?>" readonly>
                    </div>
                  
                  </div>

                   <div class="form-group row" style="text-align:left;">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Proveedor</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left; font-size: 14px;" id="inputProveedor" name="inputProveedor">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasprov as $oppv): //llenar las opciones del primer select ?>
                       <option value="<?= $oppv['id'] ?>"><?= $oppv['nombre'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Contacto</label>
                    <div class="col-sm-4">
                      <input style=" font-size: 14px;" type="text" class="form-control" id="inputContacto" name="inputContacto">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono</label>
                    <div class="col-sm-4">
                      <input style=" font-size: 14px;" type="text" class="form-control" id="inputTelefono" name="inputTelefono">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-4">
                      <input style=" font-size: 14px;" type="text" class="form-control" id="inputCorreo" name="inputCorreo">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Forma de Pago</label>
                    <div class="col-sm-4">
                      <select style=" font-size: 14px;" name="inputFormapago" id="inputFormapago" required class="form-control custom-select" >
                              <option value="">--  Seleccione --</option>
                              <option value="01 Efectivo">01 Efectivo</option>
                              <option value="02 Cheque nominativo">02 Cheque nominativo</option>
                              <option value="03 Transferencia electronica de fondos">03 Transferencia electronica de fondos</option>
                              <option value="04 Tarjeta de credito">04 Tarjeta de credito</option>
                              <option value="05 Monedero electronico">05 Monedero electronico</option>
                              <option value="06 Dinero electronico">06 Dinero electronico</option>
                              <option value="08 Vales de despensa">08 Vales de despensa</option>
                              <option value="28 Tarjeta de debito">28 Tarjeta de debito</option>
                              <option value="29 Tarjeta de servicio">29 Tarjeta de servicio</option>
                              <option value="99 Otros">99 Otros</option>
                           </select>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Metodo de Pago</label>
                    <div class="col-sm-4">
                      <select style=" font-size: 14px;" name="inputMetodopago" id="inputMetodopago" required class="form-control custom-select" >
                            <option value="">--  Seleccione --</option>
                            <option value="PUE Pago de Una Sola Exhibicion">PUE - Pago de Una Sola Exhibición</option>
                            <option value="PPD Pago en Parcialidades o Diferidos">PPD - Pago en Parcialidades o Diferidos</option>
                          </select>
                    </div>
                  </div>


                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Uso de CFDI</label>
                    <div class="col-sm-4">
                      <select style=" font-size: 14px;" name="inputUsocfdi" id="inputUsocfdi" required class="form-control custom-select" >
                            <option value="">-- Seleccione --</option>
                            <option value="G01 - Adquisición de mercancias">G01 - Adquisición de mercancías</option>
                            <option value="G02 - Devoluciones, descuentos o bonificaciones">G02 - Devoluciones, descuentos o bonificaciones</option>
                            <option value="G03 - Gastos en general">G03 - Gastos en general</option>
                            <option value="I01 - Construcciones">I01 - Construcciones</option>
                            <option value="I02 - Mobiliario y equipo de oficina por inversiones">I02 - Mobiliario y equipo de oficina por inversiones</option>
                            <option value="I03 - Equipo de transporte">I03 - Equipo de transporte</option>
                            <option value="I04 - Equipo de computo y accesorios">I04 - Equipo de computo y accesorios</option>
                            <option value="I08 - Otra maquinaria y equipo">I08 - Otra maquinaria y equipo</option>
                            <option value="D02 - Gastos médicos por incapacidad o discapacidad">D02 - Gastos médicos por incapacidad o discapacidad</option>
                            <option value="D04 - Donativos">D04 - Donativos</option>
                            <option value="D08 - Gastos de transportación escolar obligatoria">D08 - Gastos de transportación escolar obligatoria</option>
                            <option value="D10 - Pagos por servicios educativos (colegiaturas)">D10 - Pagos por servicios educativos (colegiaturas)</option>
                            <option value="S01 - Sin efectos fiscales">S01 - Sin efectos fiscales</option>
                            <option value="CP01 - Pagos">CP01 - Pagos</option>

                          </select>
                    </div>
                   <label for="inputEmail3" class="col-sm-2 col-form-label">Area Solicitante</label>
                          <div class="col-sm-4">
                          <select style=" font-size: 14px;" name="inputSolicita" id="inputSolicita" required class="form-control custom-select" >
                              <option value="">--  Seleccione --</option>
                              <option value="Aseguramiento de Calidad">Aseguramiento de Calidad</option>
                              <option value="Administracion">Administracion</option>
                              <option value="Mantenimiento">Mantenimiento</option>
                              <option value="Recursos Humanos">Recursos Humanos</option>
                              <option value="Compras">Compras</option>
                              <option value="Ventas">Ventas</option>
                              <option value="Servicio">Servicio</option>
                              <option value="Sistemas">Sistemas</option>
                              <option value="Almacen">Almacen</option>
                              <option value="Direccion">Direccion</option>
                           </select>
                           </div>
                  </div>

                 
                 <div class="form-group row" >
                    <label for="inputEmail3" class="col-sm-10 col-form-label" style="text-align:center; background-color: gainsboro;">Movimientos</label>
                    <div class="col-sm-2">
                      <a href="#"  class="btn btn-success" data-toggle="modal" data-target="#modalEditcliente" style="color:white;" ><i class="fa fa-plus"></i></a>
                      
                    </div>
                  </div>

                   <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Cantidad</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Codigo</th>
                               <th style="width:32%; background-color:#e9ecef; text-align: center;">Descripción</th>
                               <th style="width:8%; background-color:#e9ecef; text-align: center;">U. M.</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Marca</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Precio</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Importe</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                           <tbody id="detalle_ordencompra">
                               <!---Contenido Ajax--->
                           </tbody>
                           <tfoot id="detalle_totordencompra">
                            <!-- Contenido Ajax -->    
                           </tfoot>
                          </table>
                     
                      </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputNotas" name="inputNotas" rows="1"></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;" >
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Recibe</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputRecibe" name="inputRecibe">
                       <!--<?php foreach ($filasrecb as $oprc): //llenar las opciones del primer select ?>-->
                       <option value="Almacén">Almacén</option>
                       <option value="Compras">Compras</option>
                       <!--
                       <option value="<?= $oprc['nombre'] ?>"><?= $oprc['nombre'] ?></option>  
                       <?php endforeach; ?>-->
                    </select>
                    </div>
                  </div>


                <!-- /.card-body -->
                <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                          <button type="submit" class="btn btn-success" id="guardar_tipoactividad">Guardar</button>
                        </div>
                      </div>
                <!-- /.card-footer -->
              </form>
            </div>
     </div>
     </div>
     
</center>
  
    <!-- /.content -->

    

  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->

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
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->
 
<script>

	$('#btn_salir').click(function(e) {
		e.preventDefault();
		
		Swal.fire({
			title: "DESEA SALIR!",
			text: "",
			icon: 'info',
			showCancelButton: true,
			confirmButtonText: "Regresar",
			cancelButtonText: "Salir",
		}).then(resultado => {
			if (resultado.value) {
				// Hicieron click en "Regresar"
				console.log("Alerta cerrada");
			} else {
				// Hicieron click en "Salir", redirigir sin AJAX
				location.href = 'ordenes_compra23.php';
			}
		});
	});
	</script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var folio       = $('#inputFolio').val();
       var noreq       = $('#inputNoorden').val();
       var fecha       = $('#inputFecha').val();
       var proveedor   = $('#inputProveedor').val();
       var contacto    = $('#inputContacto').val();
       var telefono    = $('#inputTelefono').val();
       var correo      = $('#inputCorreo').val();
       var forma_pago  = $('#inputFormapago').val();
       var metodo_pago = $('#inputMetodopago').val();
       var uso_cfdi    = $('#inputUsocfdi').val();
       var solicita    = $('#inputSolicita').val();
       var notas       = $('#inputNotas').val();
       var recibe      = $('#inputRecibe').val();
       var action      = 'AlmacenaOrdencompra';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, noreq:noreq, fecha:fecha, proveedor:proveedor, contacto:contacto, telefono:telefono, correo:correo, forma_pago:forma_pago, metodo_pago:metodo_pago, uso_cfdi:uso_cfdi, solicita:solicita, notas:notas, recibe:recibe},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                         console.log(response);
                        var info = JSON.parse(response);
                        console.log(info);
                        $mensaje=(info.mensaje);
                          if ($mensaje === undefined)
                          {
                            Swal
                         .fire({
                          title: "Exito!",
                          text: "ORDEN DE COMPRA ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        generarimpformulaPDF(info.folio);
                        location.href = 'ordenes_compra23.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'ordenes_compra23.php';
                        }
                        });


                         }else {  
                            
                            //swal('Mensaje del sistema', $mensaje, 'warning');
                            //location.reload();
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: $mensaje,
                            })
                        }

                                                        
    
                        }else{
                          Swal.fire({
                            icon: 'info',
                            title: '',
                            text: 'Capture los datos requeridos',
                            })
        
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>  
<script src="js/sweetalert2.all.min.js"></script>   
<!-- Page specific script -->
<div class="modal fade" id="modalEditcliente" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Movimiento</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

         <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputfoliodet" name="inputfoliodet" value="<?php echo $nuevofolio; ?>" readonly>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Codigo:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="inputCodigo" name="inputCodigo">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprod as $oppd): //llenar las opciones del primer select ?>
                <option value="<?= $oppd['codigo'] ?>"><?= $oppd['codigo'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Descripción:</label>
           <div class="col-sm-9">
            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputDescripcion" name="inputDescripcion">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprodnm as $opnm): //llenar las opciones del primer select ?>
                <option value="<?= $opnm['descripcion'] ?>"><?= $opnm['descripcion'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Unidad Medida:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="inputUmedida" name="inputUmedida">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasumed as $opuni): //llenar las opciones del primer select ?>
                <option value="<?= $opuni['descripcion'] ?>"><?= $opuni['descripcion'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Marca:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputMarca" name="inputMarca">
           </div>
        </div>

         <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Cantidad:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputCantidad" name="inputCantidad" value="1">
           </div>
        </div>


        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Precio:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputPrecio" name="inputPrecio" value="0">
           </div>
        </div>

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">IVA:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputImpuesto" name="inputImpuesto" value="0">
           </div>
        </div>

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">ISR:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputImpuestoisr" name="inputImpuestoisr" value="0">
           </div>
        </div>

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">IEPS:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputImpuestoieps" name="inputImpuestoieps" value="0">
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Importe:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputImporte" name="inputImporte" readonly>
           </div>
        </div>
        

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Seleccionar el input de Precio e Importe
    const inputPrecio = document.getElementById("inputPrecio");
    const inputImporte = document.getElementById("inputImporte");

    // Escuchar el evento de entrada en el campo Precio
    inputPrecio.addEventListener("input", function() {
        inputImporte.value = inputPrecio.value; // Copiar el valor del precio al importe
    });
});
</script>

<script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var folio       = $('#inputfoliodet').val();
        var codigo      = $('#inputCodigo').val();
        var descripcion = $('#inputDescripcion').val();
        var umedida     = $('#inputUmedida').val();
        var marca       = $('#inputMarca').val();
        var cantidad    = $('#inputCantidad').val();
        var precio      = $('#inputPrecio').val();
        var impuesto    = $('#inputImpuesto').val();
        var imp_isr     = $('#inputImpuestoisr').val();
        var imp_ieps    = $('#inputImpuestoieps').val();
        var importe     = $('#inputImporte').val();
        

       var action       = 'AddDetalleOrdencompra';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, codigo:codigo, descripcion:descripcion, umedida:umedida, marca:marca, cantidad:cantidad, precio:precio, impuesto:impuesto, imp_isr:imp_isr, imp_ieps:imp_ieps, importe:importe},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_ordencompra').html(info.detalle);
                            $('#detalle_totordencompra').html(info.totales);
                            
                           
                            //alert('Cliente Agregado');

                            $('#modalEditcliente').modal('hide');
                            $('#inputCodigo').val('');
                            //$('#inputDescripcion').val('');
                            $('#inputDescripcion').val(null).trigger('change');
                            $('#inputMarca').val('');
                            $('#inputCantidad').val('0');
                            $('#inputPrecio').val('0.00');
                            $('#inputImpuesto').val('0.00');
                            $('#inputImpuestoisr').val('0.00');
                            $('#inputImpuestoieps').val('0.00');
                            $('#inputImporte').val('0.00');
                            //location.reload(true);
                            
    
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
    function del_detalle_cotizacion(id, folio){
    var action = 'delDetordencompra';
    var id_det = id;
    var folio_det = folio;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, id_det:id_det, folio_det:folio_det},

        success: function(response)
        {
                      if(response != 'error')
                        {
                            console.log(response);
                            var info = JSON.parse(response);
                            $('#detalle_ordencompra').html(info.detalle);
                            $('#detalle_totordencompra').html(info.totales);
                           

                        }else{
                           $('#detalle_ordencompra').html('');
                           $('#detalle_totordencompra').html('');
                        }
                        //viewProcesar();
                 },
        error: function(error) {
        }
    });
}

    </script> 
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script> 

<script>
    $(document).ready(function () {
        $("#inputNounidad").on('change', function () {            
            var op = $(this).val();
             var action = 'searchNounidad';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputPlacas').val('');
                   
                }else{
                    var data = $.parseJSON(response);
                    
                    $('#inputPlacas').val(data.placas);
                   
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#inputProveedor").on('change', function () {            
            var op = $(this).val();
             var action = 'searchDatosProveedor';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputContacto').val('');
                    $('#inputTelefono').val('');
                    $('#inputCorreo').val('')
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputContacto').val(data.contacto); // Notify only Select2 of changes
                    $('#inputTelefono').val(data.telefono);
                    $('#inputCorreo').val(data.correo);
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#inputCodigo").on('change', function () {            
            var op = $(this).val();
             var action = 'searchRefaccionesmov';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputDescripcion').val('');
                    $('#inputMarca').val('');
                    $('#inputUmedida').val('');
                    $('#inputPrecio').val('0.00')
                    $('#inputImpuesto').val('0.00')
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputDescripcion').val(data.descripcion).change(); // Notify only Select2 of changes
                    $('#inputMarca').val(data.marca);
                    $('#inputUmedida').val(data.umedida);
                    $('#inputPrecio').val(data.costo);
                    $('#inputImpuesto').val(data.impuesto);
                    $('#inputImpuestoisr').val(data.impuesto_isr);
                    $('#inputImpuestoieps').val(data.impuesto_ieps);
                 
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#inputDescripcion").on('change', function () {            
            var op = $(this).val();
             var action = 'searchRefaccionesmovname';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputCodigo').val('');
                    $('#inputUmedida').val('');
                    $('#inputMarca').val('');
                    $('#inputPrecio').val('0.00');
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputCodigo').val(data.codigo); // Notify only Select2 of changes
                    $('#inputMarca').val(data.marca);
                    $('#inputUmedida').val(data.umedida);
                    $('#inputPrecio').val(data.costo);
                    $('#inputImpuesto').val(data.impuesto);
                    $('#inputImpuestoisr').val(data.impuesto_isr);
                    $('#inputImpuestoieps').val(data.impuesto_ieps);        
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
$(document).ready(function(){
     $('#inputCantidad').change(function(){ 
         
          m1 = document.getElementById("inputCantidad").value;
          m2 = document.getElementById("inputPrecio").value;
          r =  parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         document.getElementById("inputImporte").value = result;
     });
 });
</script>

<script>
$(document).ready(function(){
     $('#inputPrecio').change(function(){ 
         
          m1 = document.getElementById("inputPrecio").value;
          m2 = document.getElementById("inputCantidad").value;
          r =  parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         document.getElementById("inputImporte").value = result;
     });
 });
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalEditCotizacion').on('show.bs.modal', function(e) {    
     var noid      = $(e.relatedTarget).data().id;
     var nofolio   = $(e.relatedTarget).data().nofol;
     var cantidad  = $(e.relatedTarget).data().cantid;
     var codigo    = $(e.relatedTarget).data().codig;
     var descripc  = $(e.relatedTarget).data().descrip;
     var umedida   = $(e.relatedTarget).data().umed;
     var marca     = $(e.relatedTarget).data().marca;
     var precio    = $(e.relatedTarget).data().precio;
     var impuesto  = $(e.relatedTarget).data().impto;
     var impisr    = $(e.relatedTarget).data().impisr;
     var impieps   = $(e.relatedTarget).data().impieps;
     var importe   = $(e.relatedTarget).data().importe;
    
      $(e.currentTarget).find('#txt_id').val(noid);
      $(e.currentTarget).find('#txt_folioc').val(nofolio);
      $(e.currentTarget).find('#txt_cantidad').val(cantidad);
      $(e.currentTarget).find('#txt_codigo').val(codigo);
      $(e.currentTarget).find('#txt_descripcion').val(descripc);
      $(e.currentTarget).find('#txt_umedida').val(umedida);
      $(e.currentTarget).find('#txt_marca').val(marca);
      $(e.currentTarget).find('#txt_precio').val(precio);
      $(e.currentTarget).find('#txt_impuesto').val(impuesto);
      $(e.currentTarget).find('#txt_impuestoisr').val(impisr);
      $(e.currentTarget).find('#txt_impuestoieps').val(impieps);
      $(e.currentTarget).find('#txt_importe').val(importe);
    
  });
});

    </script> 

    <!-- Modal - Update User details -->
<div class="modal fade" id="modalEditCotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edita Movimiento</h5>
      </div>
      <div class="modal-body">
        <form>

           <div class="col-md-12" hidden>
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> ID:</i></span>
                      <input name="txt_id" id="txt_id" type="text" class="form-control" disabled>
                    </div>
             </div>  

             <div class="col-md-12">
              <div class="input-group" hidden>
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Folio:</i>&nbsp;&nbsp;</span>
                <input type="text"  class="form-control" name="txt_folioc" id="txt_folioc" readonly>
              </div>
         </div>  

           <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Codigo:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%;" id="txt_codigo" name="txt_codigo">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprod as $oppd): //llenar las opciones del primer select ?>
                <option value="<?= $oppd['codigo'] ?>"><?= $oppd['codigo'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div> 
       
          <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Descripción:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_descripcion" name="txt_descripcion">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprodnm as $opnm): //llenar las opciones del primer select ?>
                <option value="<?= $opnm['descripcion'] ?>"><?= $opnm['descripcion'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Unidad de Medida:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_umedida" name="txt_umedida">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasumed as $opunm): //llenar las opciones del primer select ?>
                <option value="<?= $opunm['descripcion'] ?>"><?= $opunm['descripcion'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div>  

         <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Marca:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_marca" name="txt_marca">
           </div>
        </div>


        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Cantidad:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_cantidad" name="txt_cantidad">
           </div>
        </div>


        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Impuesto:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_impuesto" name="txt_impuesto">
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">ISR:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_impuestoisr" name="txt_impuestoisr">
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">IEPS:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_impuestoieps" name="txt_impuestoieps">
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Precio:</label>
           <div class="col-sm-4">
            <input type="number" step="any" class="form-control" id="txt_precio" name="txt_precio" >
           </div>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Importe:</label>
           <div class="col-sm-4">
            <input type="text" class="form-control" id="txt_importe" name="txt_importe" readonly>
           </div>
        </div>
     
        </form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualiza_paradar"><i class="fa fa-save"></i>&nbsp;Guardar</button>
      </div>
    </div>
  </div>
</div> 

<script>
   $('#actualiza_paradar').click(function(e){
        e.preventDefault();

        var detfolio     = $('#txt_folioc').val();
        var detid        = $('#txt_id').val();
        var detcodigo    = $('#txt_codigo').val();
        var detdescripc  = $('#txt_descripcion').val();
        var unidadmedida = $('#txt_umedida').val();
        var detmarca     = $('#txt_marca').val();
        var detcantidad  = $('#txt_cantidad').val();
        var detprecio    = $('#txt_precio').val();
        var detimpuesto  = $('#txt_impuesto').val();
        var detimpisr    = $('#txt_impuestoisr').val();
        var detimpieps   = $('#txt_impuestoieps').val();
        var detimporte   = $('#txt_importe').val();
       

        var action       = 'ActualizaMovordencompra';
    
        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, detfolio:detfolio, detid:detid, detcodigo:detcodigo, detdescripc:detdescripc, unidadmedida:unidadmedida, detmarca:detmarca, detcantidad:detcantidad, detprecio:detprecio, detimpuesto:detimpuesto, detimpisr:detimpisr, detimpieps:detimpieps, detimporte:detimporte},

                    success: function(response)
                    {
                     if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_ordencompra').html(info.detalle);
                            $('#detalle_totordencompra').html(info.totales);
                            
                            $('#modalEditCotizacion').modal('hide');
    
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
    $(document).ready(function () {
        $("#txt_codigo").on('change', function () {            
            var op = $(this).val();
             var action = 'searchRefaccionesmov';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#txt_descripcion').val('');
                    $('#txt_marca').val('');
                    $('#txt_precio').val('0.00')
                    $('#txt_impuesto').val('0.00')
                    $('#txt_umedida').val('');
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#txt_descripcion').val(data.descripcion).change(); // Notify only Select2 of changes
                    $('#txt_marca').val(data.marca);
                    $('#txt_precio').val(data.costo);
                    $('#txt_impuesto').val(data.impuesto);
                    $('#txt_umedida').val(data.umedida);
                    $('#txt_cantidad').val('0');
                    $('#txt_importe').val('0.00');
                 
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#txt_descripcion").on('change', function () {            
            var op = $(this).val();
             var action = 'searchRefaccionesmovname';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#txt_codigo').val('');
                    $('#txt_marca').val('');
                    $('#txt_precio').val('0.00');
                    $('#txt_impuesto').val('0.00');
                    $('#txt_umedida').val('');
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#txt_codigo').val(data.codigo); // Notify only Select2 of changes
                    $('#txt_marca').val(data.marca);
                    $('#txt_precio').val(data.costo);
                    $('#txt_impuesto').val(data.impuesto);
                    $('#txt_umedida').val(data.umedida);
                    $('#txt_cantidad').val('0');
                    $('#txt_importe').val('0.00');
                 
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>     

<script>
$(document).ready(function(){
     $('#txt_cantidad').change(function(){ 
         
          m1 = document.getElementById("txt_cantidad").value;
          m2 = document.getElementById("txt_precio").value;
          m3i = document.getElementById("txt_impuesto").value;
          r =  parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         document.getElementById("txt_importe").value = result;
     });
 });
</script>

<script>
$(document).ready(function(){
     $('#txt_precio').change(function(){ 
         
          m1 = document.getElementById("txt_precio").value;
          m2 = document.getElementById("txt_cantidad").value;
          r =  parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         document.getElementById("txt_importe").value = result;
     });
 });
</script>  

<script type="text/javascript">
    function generarimpformulaPDF(folio){
    //console.log(cliente);
    //console.log(norecibo);
    var ancho = 1000;
    var alto = 800;
    //calcular posicion x,y para centrar la ventana

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = 'factura/orden_compra.php?id='+ folio;
    window.open($url,"Orden de Compra","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}
  </script>   

<script>
    $('#inputNoorden').change(function(){
          //$('#disco_sel').html($(this).val() + ' - ' + $('#discos option:selected').text());
           var ordenno  = $(this).val();
           var afolio = $('#inputFolio').val();
           var action   = 'addDetalleRequisicion';

                $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, ordenno:ordenno, afolio:afolio},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);

                            $('#detalle_ordencompra').html(info.detalle);
                            $('#detalle_totordencompra').html(info.totales);
                        
                            $("#inputSolicita").val(info.solicitante);

                            //*$('#fpedido').disabled = true;
                            inputNoorden.disabled = true;
                                                       
    
                        }else{
                           console.log('no data');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });


        });

</script>  

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