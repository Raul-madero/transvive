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

  //Mostrar Datos
  if(empty($_REQUEST['id']))
  {
    header('Location: requisiciones23.php');
    mysqli_close($conection);
  }
  $idsol = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM requisicion_compra WHERE id=$idsol and estatus = 1");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: requisiciones23.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id            = $data['id'];
      $noreq         = $data['no_requisicion'];
      $fecha         = $data['fecha'];
      $fecha_req     = $data['fecha_requiere'];
      $tipo_req      = $data['tipo_requisicion'];
      $notas_req     = $data['observaciones'];
      $area_solicita = $data['area_solicitante'];
      $cantidad      = $data['cant_autorizada'];
      // $name_recibe   = $data['recibe'];
    }
  }

  
  include "../conexion.php";

  $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados where estatus = 1 ORDER BY nombres";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlrecb   = "select nombre from usuario where rol = 10 and estatus = 1 ORDER BY nombre";
  $queryrecb = mysqli_query($conection, $sqlrecb);
  $filasrecb = mysqli_fetch_all($queryrecb, MYSQLI_ASSOC); 

  $sqlprod   = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY codigo";
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

  //mysqli_close($conection);
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
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE ERP"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php include('includes/generalnavbar.php'); ?>
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
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Requisición</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

       <?php
           /*         
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT * FROM folios where serie = 'RQ'");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["folio"]+1; 

          $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'RQ'");
          

          mysqli_close($conection); */
        ?>  
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edicion de Riquisición</h3>
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
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Fecha</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fecha;?>">
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Folio</label>
                    <div class="col-sm-3">
                      <input style="text-align:right;" type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo 'REQ-' . $noreq;?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Fecha en la que se requiere</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFecharequiere" name="inputFecharequiere" value="<?php echo $fecha_req;?>">
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo</label>
                    <div class="col-sm-3">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputTipo" name="inputTipo">
                       <option value="<?php echo $tipo_req;?>"><?php echo $tipo_req;?></option>
                        <option value="Normal">Normal</option>
                        <option value="Urgente">Urgente</option>
                     </select>
                    </div>
                  </div>
              

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Area Solicitante</label>
                          <div class="col-sm-9">
							<input type="text" class="form-control" id="inputAsolicita" name="inputAsolicita" value="<?php echo $area_solicita;?>" readonly>
						   <!-- </div>
                          <select style=" font-size: 14px;" name="inputAsolicita" id="inputAsolicita" required class="form-control custom-select" >
                              <option value="<?php echo $area_solicita;?>"><?php echo $area_solicita;?></option>
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
                           </select> -->
                           </div>
                  </div>


                
                 <div class="form-group row" >
                    <label for="inputEmail3" class="col-sm-10 col-form-label" style="text-align:center; background-color: gainsboro;">Movimientos</label>
                    <div class="col-sm-2">
                      <a href="#"  class="btn btn-success" data-toggle="modal" data-target="#modalEditcliente" style="color:white;" ><i class="fa fa-plus"></i></a>
                      <!-- <a href="#"  class="btn btn-primary" data-toggle="modal" data-target="#modalAddprod" style="color:white;" ><i class="fa fa-plus"></i><i class="fa fa-wrench"></i></a>   -->
                    </div>
                  </div>

                   <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
							<th style="width:10%; background-color:#e9ecef; text-align: center;" >Cantidad</th>
								<th style="width:10%; background-color:#e9ecef; text-align: center;" >Codigo</th>
								<th style="width:35%; background-color:#e9ecef; text-align: center;">Descripción</th>
								<th style="width:15%; background-color:#e9ecef; text-align: center;" >Marca</th>
								<th style="width:5%; background-color:#e9ecef; text-align: center;" >E</th>
								<th style="width:5%; background-color:#e9ecef; text-align: center;" >OM</th>
								<th style="width:15%; background-color:#e9ecef; text-align: center;" >Precio Unitario</th>
								<th style="width:5%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                           <tbody id="detalle_cotizacion">
                               <!---Contenido Ajax--->
                           </tbody>
                           <tfoot id="detalle_totcotizacion">
                            <!-- Contenido Ajax -->    
                           </tfoot>
                          </table>
                     
                      </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Monto Aprox. Autorizado</label>
                    <div class="col-sm-9">
                      <input type="number" step="any" class="form-control" id="inputMontoaut" name="inputMontoaut" value="<?php echo $cantidad;?>">
                    </div>
                  </div>    

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputNotas" name="inputNotas" rows="1"><?php echo $notas_req;?></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;" hidden>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Recibe</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputRecibe" name="inputRecibe">
                       <?php foreach ($filasrecb as $oprc): //llenar las opciones del primer select ?>
                       <option value="<?= $oprc['nombre'] ?>"><?= $oprc['nombre'] ?></option>  
                       <?php endforeach; ?>
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

<!-- Select2 JS -->
<script src="../plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap 4 CSS (opcional, si lo necesitas por separado) -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 Bootstrap 4 Theme -->
<link href="https://cdn.jsdelivr.net/npm/select2-bootstrap4-theme@1.0.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />

<!-- Inicialización de Select2 con Bootstrap 4 -->
<script>
  $(document).ready(function() {
    console.log("Verificando si el select existe:", $('.select2bs4').length);
    // Asegúrate de que Select2 se inicialice correctamente
    console.log("Iniciando Select2...");  // Esto es para verificar si el script se ejecuta
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    });
    console.log("Select2 inicializado correctamente.");
  });
</script>

<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->
 

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
        cancelButtonText: "Salir",
       

       
    })
     .then(resultado => {
        if (resultado.value) {
            // Hicieron click en "Sí"
             //*location.href = 'lista_ncplantasa.php';
            //  console.log("Alerta cerrada");
        } else {
            // Dijeron que no
            //*location.reload();
          /* var norecibo  = $('#inputFolio').val();
            var action = 'procesarSalirCortizacioncp';
                       
            $.ajax({
                url: 'includes/ajax.php',
                type: "POST",
                async : true,
                data: {action:action, norecibo:norecibo},

                success: function(response)
                {
                    
                    if(response != 'error')
                    {
                      var info = JSON.parse(response);
                      console.log(response); */
                      location.href = 'requisiciones23.php';
                       //*location.reload();

               /*
                        
                    }else{
                        console.log('no data');
                    }
                },
                error: function(error){                
                } 
            }); */
        }
    });

   

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e) {
    e.preventDefault();
    var folio         = $('#inputFolio').val();
    var fecha         = $('#inputFecha').val();
    var fecha_req     = $('#inputFecharequiere').val();
    var tipo          = $('#inputTipo').val();
    var areasolicita  = $('#inputAsolicita').val();
    var montoaut      = $('#inputMontoaut').val();
    var notas         = $('#inputNotas').val();
    var action        = 'AlmacenaEditRequerimiento';

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        dataType: "json", // Indica que esperas una respuesta JSON
        data: {
            action: action,
            folio: folio,
            fecha: fecha,
            fecha_req: fecha_req,
            tipo: tipo,
            areasolicita: areasolicita,
            montoaut: montoaut,
            notas: notas
        },
        success: function(response) {
            try {
                if (response.status === "success") {
                    Swal.fire({
                        title: "Éxito!",
                        text: response.message,
                        icon: 'success',
                    }).then(() => {
                        location.href = 'requisiciones23.php';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: response.message,
                    });
                }
            } catch (e) {
                console.error("Error al procesar la respuesta JSON", e);
                Swal.fire({
                    icon: 'error',
                    title: 'Error inesperado',
                    text: 'Ocurrió un problema al procesar la respuesta del servidor.',
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en la petición AJAX", error);
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor.',
            });
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
                                <input type="text" class="form-control" id="inputfoliodet" name="inputfoliodet" value="<?php echo $noreq; ?>" readonly>
                            </div>
                        </div> 

                        <div class="form-group row">
                          <label for="inputCodigoProd" class="col-sm-3 col-form-label" style="text-align: left;">Código:</label>
                          <div class="col-sm-9">
                            <select class="form-control" style="width: 100%; text-align: left" id="inputCodigoProd" name="inputCodigoProd">
                              <option value="">- Seleccione -</option>
                              <?php foreach ($filasprod as $prod): ?>
                                <option value="<?= $prod['codigo'] ?>"><?= $prod['codigo'] ?></option>  
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>



                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Descripción:</label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control" id="inputDescripcion" name="inputDescripcion" readonly>
                                <!-- <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputDescripcion" name="inputDescripcion">
                                    <option value="">- Seleccione -</option>
                                    <?php foreach ($filasprodnm as $opnm): //llenar las opciones del primer select ?>
                                    <option value="<?= $opnm['descripcion'] ?>"><?= $opnm['codigo_interno'] . ' - ' . $opnm['descripcion'] ?></option>  
                                    <?php endforeach; ?>
                                </select> -->
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

                        <div class="form-group row" >
                            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Precio:</label>
                            <div class="col-sm-9">
                            <input type="number" step="0.01" class="form-control" id="inputPrecio" name="inputPrecio" value="0" readonly>
                            </div>
                        </div>
        
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">IVA:</label>
                            <div class="col-sm-9">
                                <input type="number" step="any" class="form-control" id="inputImpuesto" name="inputImpuesto" value="0" readonly>
                            </div>
                        </div>

                        <div class="form-group row" hidden>
                            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">ISR:</label>
                            <div class="col-sm-9">
                                <input type="number" step="any" class="form-control" id="inputIsr" name="inputIsr" value="0">
                            </div>
                        </div>

                        <div class="form-group row" hidden>
                            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">IEPS:</label>
                            <div class="col-sm-9">
                                <input type="number" step="any" class="form-control" id="inputIeps" name="inputIeps" value="0">
                            </div>
                        </div>

                        <div class="form-group row" hidden>
                            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Importe:</label>
                            <div class="col-sm-9">
                                <input type="number" step="any" class="form-control" id="inputImporte" name="inputImporte" value="0">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">E:</label>
                        <div class="col-sm-9">
                            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputDatoe" name="inputDatoe">
                                <option value="">- Seleccione -</option>
                                <option value="SI">SI</option>
                                <option value="NO">NO</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">OM:</label>
                        <div class="col-sm-9">
                            <select id="inputDatoom" name="inputDatoom" class="tokenizationSelect2 form-control select2bs4" >
                                <option value="">- Seleccione -</option>
                                <?php foreach ($filasmant as $opmt): //llenar las opciones del primer select ?>
                                <option value="<?= $opmt['no_orden'] ?>"><?= $opmt['no_orden'] ?></option>  
                                <?php endforeach; ?>
                            </select>
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
    $('#actualizaclientes').click(function(e){
            e.preventDefault();
            let req = $('#inputfoliodet').val();
            console.log(req);
            var folio        = parseInt(req.replace('REQ-', ''), 10);
            console.log(folio);
            var codigo       = $('#inputCodigoProd').val();
            var descripcion  = $('#inputDescripcion').val();
            var marca        = $('#inputMarca').val();
            var cantidad     = $('#inputCantidad').val();
            var precio       = $('#inputPrecio').val();
            var impuesto     = $('#inputImpuesto').val();
            var impuestoisr  = $('#inputIsr').val();
            var impuestoieps = $('#inputIeps').val();
            var importe      = $('#inputImporte').val();
            var datoe        = $('#inputDatoe').val();
            var datoom       = $('#inputDatoom').val();        

            var action       = 'AddDetalleEditcotizacion';

            $.ajax({
                url: 'includes/ajax.php',
                type: "POST",
                async : true,
                data: {action:action, folio:folio, codigo:codigo, descripcion:descripcion, marca:marca, cantidad:cantidad, precio:precio, impuesto:impuesto, impuestoisr:impuestoisr, impuestoieps:impuestoieps, importe:importe, datoe:datoe, datoom:datoom},

                success: function(response)
                {
                    if(response != 'error')
                    {
                        var info = JSON.parse(response);
                        console.log(info);
                        $('#detalle_cotizacion').html(info.detalle);
                        $('#detalle_totcotizacion').html(info.totales);

                        $('#modalEditcliente').modal('hide');
                        $('#inputCodigoProd').val('');
                        $('#inputDescripcion').val(null).trigger('change');
                        $('#inputMarca').val('');
                        $('#inputCantidad').val('0');
                        $('#inputPrecio').val('0.00');
                        $('#inputImpuesto').val('0.00')
                        $('#inputImporte').val('0.00');
                        $(document).trigger('detalleActualizado');

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
		function recalcularTotales() {
    let subtotal = 0;

    // Recorremos todas las filas con inputs de cantidad y precio
    $('#detalle_cotizacion tr').each(function () {
        const row = $(this);
        const cantidad = parseFloat(row.find('input[data-field="cantidad"]').val()) || 0;
        const precio = parseFloat(row.find('input[data-field="precio"]').val()) || 0;

        subtotal += cantidad * precio;
    });

    const iva = subtotal * 0.16; // 16% de impuesto
    const total = subtotal + iva;

    const htmlTotales = `
        <tr>
            <td colspan="6" class="text-right"><strong>Subtotal:</strong></td>
            <td class="text-right" colspan="2">${subtotal.toFixed(2)}</td>
        </tr>
        <tr>
            <td colspan="6" class="text-right"><strong>Impuesto (IVA 16%):</strong></td>
            <td class="text-right" colspan="2">${iva.toFixed(2)}</td>
        </tr>
        <tr>
            <td colspan="6" class="text-right"><strong>Total:</strong></td>
            <td class="text-right" colspan="2">${total.toFixed(2)}</td>
        </tr>
    `;

    $('#detalle_totcotizacion').html(htmlTotales);
}

// Ejecutar cada vez que cambian los inputs de cantidad o precio
$(document).on('change', 'input[data-field="cantidad"], input[data-field="precio"]', function () {
    recalcularTotales();
});

// También recalcular cuando se carga una nueva tabla vía AJAX
$(document).on('detalleActualizado', function () {
    recalcularTotales();
});
	</script>

	<script>
		 $(document).ready(function () {
            $("#inputCodigoProd").on('change', function () {            
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
                            $('#inputCodigoProd').val('');
                            $('#inputMarca').val('');
                            $('#inputPrecio').val('0.00');
                        }else{
                            var data = $.parseJSON(response);
                            //$('#idcliente').val(data.idusuario);
                            //$('#frazonsoc').val(data.razonsocial).change();
                            $('#inputDescripcion').val(data.descripcion).change(); // Notify only Select2 of changes
                            $('#inputCodigoProd').val(data.codigo); // Notify only Select2 of changes
                            $('#inputMarca').val(data.marca);
                            $('#inputPrecio').val(data.costo);
                            $('#inputImpuesto').val(data.impuesto);
                            $('#inputIsr').val(data.impuesto_isr);
                            $('#inputIeps').val(data.impuesto_ieps);
                        }
                    },
                    error: function(error) {
                    }
                });
            });
        });
	</script>

     <script> 
    function del_detalle_cotizacion(id, folio){
    var action = 'delDetalleEditcotizacion';
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
                            // console.log(response);
                            var info = JSON.parse(response);
                            $('#detalle_cotizacion').html(info.detalle);

                        }else{
                           $('#detalle_cotizacion').html('');
                          
                        }
                        //viewProcesar();
                 },
        error: function(error) {
        }
    });
}

    </script> 
<script>
  // $(document).ready(function () {

  //   //Initialize Select2 Elements
  //   $('.select2bs4').select2({
  //     theme: 'bootstrap4'
  //   })
  // })
  //   //Datemask dd/mm/yyyy
  //   $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //   //Datemask2 mm/dd/yyyy
  //   $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //   //Money Euro
  //   $('[data-mask]').inputmask()

  //   //Date picker
  //   $('#reservationdate').datetimepicker({
  //       format: 'L'
  //   });

  //   //Date and time picker
  //   $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

  //   //Date range picker
  //   $('#reservation').daterangepicker()
  //   //Date range picker with time picker
  //   $('#reservationtime').daterangepicker({
  //     timePicker: true,
  //     timePickerIncrement: 30,
  //     locale: {
  //       format: 'MM/DD/YYYY hh:mm A'
  //     }
  //   })
  //   //Date range as a button
  //   $('#daterange-btn').daterangepicker(
  //     {
  //       ranges   : {
  //         'Today'       : [moment(), moment()],
  //         'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
  //         'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
  //         'Last 30 Days': [moment().subtract(29, 'days'), moment()],
  //         'This Month'  : [moment().startOf('month'), moment().endOf('month')],
  //         'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
  //       },
  //       startDate: moment().subtract(29, 'days'),
  //       endDate  : moment()
  //     },
  //     function (start, end) {
  //       $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
  //     }
  //   )

  //   //Timepicker
  //   $('#timepicker').datetimepicker({
  //     format: 'LT'
  //   })

  //   //Bootstrap Duallistbox
  //   $('.duallistbox').bootstrapDualListbox()

  //   //Colorpicker
  //   $('.my-colorpicker1').colorpicker()
  //   //color picker with addon
  //   $('.my-colorpicker2').colorpicker()

  //   $('.my-colorpicker2').on('colorpickerChange', function(event) {
  //     $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
  //   })

  //   $("input[data-bootstrap-switch]").each(function(){
  //     $(this).bootstrapSwitch('state', $(this).prop('checked'));
  //   })

  // })
  // // BS-Stepper Init
  // document.addEventListener('DOMContentLoaded', function () {
  //   window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  // })

  // // DropzoneJS Demo Code Start
  // Dropzone.autoDiscover = false

  // // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  // var previewNode = document.querySelector("#template")
  // previewNode.id = ""
  // var previewTemplate = previewNode.parentNode.innerHTML
  // previewNode.parentNode.removeChild(previewNode)

  // var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
  //   url: "/target-url", // Set the url
  //   thumbnailWidth: 80,
  //   thumbnailHeight: 80,
  //   parallelUploads: 20,
  //   previewTemplate: previewTemplate,
  //   autoQueue: false, // Make sure the files aren't queued until manually added
  //   previewsContainer: "#previews", // Define the container to display the previews
  //   clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  // })

  // myDropzone.on("addedfile", function(file) {
  //   // Hookup the start button
  //   file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  // })

  // // Update the total progress bar
  // myDropzone.on("totaluploadprogress", function(progress) {
  //   document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  // })

  // myDropzone.on("sending", function(file) {
  //   // Show the total progress bar when upload starts
  //   document.querySelector("#total-progress").style.opacity = "1"
  //   // And disable the start button
  //   file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  // })

  // // Hide the total progress bar when nothing's uploading anymore
  // myDropzone.on("queuecomplete", function(progress) {
  //   document.querySelector("#total-progress").style.opacity = "0"
  // })

  // // Setup the buttons for all transfers
  // // The "add files" button doesn't need to be setup because the config
  // // `clickable` has already been specified.
  // document.querySelector("#actions .start").onclick = function() {
  //   myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  // }
  // document.querySelector("#actions .cancel").onclick = function() {
  //   myDropzone.removeAllFiles(true)
  // }
  // // DropzoneJS Demo Code End
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
                    $('#inputPrecio').val('0.00')
                    $('#inputImpuesto').val('0.00')
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputDescripcion').val(data.descripcion).change(); // Notify only Select2 of changes
                    $('#inputMarca').val(data.marca);
                    $('#inputPrecio').val(data.costo);
                    $('#inputImpuesto').val(data.impuesto);
                 
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
    // // $(document).ready(function () {
    //     $("#inputDescripcion").on('change', function () {            
    //         var op = $(this).val();
    //          var action = 'searchRefaccionesmovname';

    //     $.ajax({
    //         url: 'includes/ajax.php',
    //         type: "POST",
    //         async : true,
    //         data: {action:action,op:op},
    //         success: function(response)
    //         {
    //             // console.log(response);
    //             if(response == 0){
    //                 //$('#idcliente').val('');
    //                 $('#inputCodigo').val('');
    //                 $('#inputMarca').val('');
    //                 $('#inputPrecio').val('0.00');
                  
    //             }else{
    //                 var data = $.parseJSON(response);
    //                 //$('#idcliente').val(data.idusuario);
    //                 //$('#frazonsoc').val(data.razonsocial).change();
    //                 $('#inputCodigo').val(data.codigo); // Notify only Select2 of changes
    //                 $('#inputMarca').val(data.marca);
    //                 $('#inputPrecio').val(data.costo);
    //                 $('#inputImpuesto').val(data.impuesto);
    //                 $('#inputImpuestoisr').val(data.impuesto_isr);
    //                 $('#inputImpuestoieps').val(data.impuesto_ieps);
                   
    //             }
    //         },
    //         error: function(error) {

    //         }

    //     });
    //     });
    // });
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
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#txt_codigo').val(data.codigo); // Notify only Select2 of changes
                    $('#txt_marca').val(data.marca);
                    $('#txt_precio').val(data.precioiva);
                 
                   
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
     var codigo  = $(e.relatedTarget).data().codig;
     var descripc  = $(e.relatedTarget).data().descrip;
     var marca     = $(e.relatedTarget).data().marca;
     var precio    = $(e.relatedTarget).data().precio;
     var importe  = $(e.relatedTarget).data().importe;
     var dato_e    = $(e.relatedTarget).data().datoe;
     var dato_om   = $(e.relatedTarget).data().datoom;
    
      $(e.currentTarget).find('#txt_id').val(noid);
      $(e.currentTarget).find('#txt_folioc').val(nofolio);
      $(e.currentTarget).find('#txt_cantidad').val(cantidad);
      $(e.currentTarget).find('#txt_codigo').val(codigo);
      $(e.currentTarget).find('#txt_descripcion').val(descripc);
      $(e.currentTarget).find('#txt_marca').val(marca);
      $(e.currentTarget).find('#txt_precio').val(precio);
      $(e.currentTarget).find('#txt_importe').val(importe);
      $(e.currentTarget).find('#txt_datoe').val(dato_e);
      $(e.currentTarget).find('#txt_datoom').val(dato_om);
    
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

        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

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

           <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Codigo:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_codigo" name="txt_codigo">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprod as $oppd): //llenar las opciones del primer select ?>
                <option value="<?= $oppd['codigo'] ?>"><?= $oppd['codigo'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div> 

         <div class="col-md-12">
          <div class="form-group"> 
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

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

         <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Marca:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_marca" name="txt_marca">
           </div>
        </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Cantidad:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_cantidad" name="txt_cantidad">
           </div>
        </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Precio:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_precio" name="txt_precio" >
           </div>
        </div>

        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

          <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Importe:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_importe" name="txt_importe" readonly>
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">E:</label>
           <div class="col-sm-10">
           <select class="form-control" style="width: 100%;" name="txt_datoe" id="txt_datoe">
              <option value="SI">SI</option>
              <option value="NO">NO</option>
           </select>
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">OM:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_datoom" name="txt_datoom">
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
        var detmarca     = $('#txt_marca').val();
        var detcantidad  = $('#txt_cantidad').val();
        var detprecio    = $('#txt_precio').val();
        var detimporte   = $('#txt_importe').val();
        var detdatoe     = $('#txt_datoe').val();
        var detdatoom    = $('#txt_datoom').val();

        var action       = 'ActualizaMovcotizacion';
    
        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, detfolio:detfolio, detid:detid, detcodigo:detcodigo, detdescripc:detdescripc, detmarca:detmarca, detcantidad:detcantidad, detprecio:detprecio, detimporte:detimporte, detdatoe:detdatoe, detdatoom:detdatoom},

                    success: function(response)
                    {
                     if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            // console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_cotizacion').html(info.detalle);
                            $('#detalle_totcotizacion').html(info.totales);
                            
                            $('#modalEditCotizacion').modal('hide');
    
                        }else{
                          //  console.log('no data');
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
$(document).ready(function(){
     $('#txt_cantidad').change(function(){ 
         
          m1 = document.getElementById("txt_cantidad").value;
          m2 = document.getElementById("txt_precio").value;
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

    $url = 'factura/requisicion.php?id='+ folio;
    window.open($url,"requisicion","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}
  </script> 

<script>
  $(document).ready(function(){
  $(".tokenizationSelect2").select2({
    placeholder: "Escribe o Busca Orden de Mantenimiento", //placeholder
    tags: true,
    tokenSeparators: ['/',',',';'," "] 
  });
})
 </script>   


 <script type="text/javascript">
    $(document).ready(function(){
        var c_noorden = '<?php echo $noreq; ?>';
        //alert(c_noorden);
        searchForDetalleditRequisicion(c_noorden);
     });
  </script>

 <script>
 function searchForDetalleditRequisicion(c_noorden){
    var action = 'searchForDetalleditRequisicion';
    var noorden = c_noorden;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, noorden:noorden},

        success: function(response)
        {
                
           
                var info = JSON.parse(response);
                $('#detalle_cotizacion').html(info.detalle);
                $('#detalle_totcotizacion').html(info.totales);

              //  console.log(response);                           
           
            //viewProcesarCot();        
        },
        error: function(error) {
        }

    });
}
 
</script>

<!-- Page specific script -->
<div class="modal fade" id="modalAddprod" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Refaccion/Articulo Nueva(o)</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

         
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Codigo:</label>
           <div class="col-sm-9">
            <input class="form-control" id="inputCodprodn" name="inputCodprodn">
           </div>
        </div>

         <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Codigo Interno:</label>
           <div class="col-sm-9">
            <input class="form-control" id="inputCodprodnint" name="inputCodprodnint">
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Descripción:</label>
           <div class="col-sm-9">
            <input class="form-control" id="inputDescriprod" name="inputDescriprod">
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Unidad Medida:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="inputUmedidaprod" name="inputUmedidaprod">
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
            <input type="text" class="form-control" id="inputMarcaprod" name="inputMarcaprod">
           </div>
        </div>

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="newproducto"><i class="fa fa-save"></i>&nbsp;Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#newproducto').click(function(e){
        e.preventDefault();

        var codprod     = $('#inputCodprodn').val();
        var codinterno  = $('#inputCodprodnint').val();
        var describprod = $('#inputDescriprod').val();
        var umedidprod  = $('#inputUmedidaprod').val();
        var marcaprod   = $('#inputMarcaprod').val();

       var action       = 'AddProdnuevo';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, codprod:codprod, codinterno:codinterno, describprod:describprod, umedidprod:umedidprod, marcaprod:marcaprod},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            // console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#inputDescripcion').html(info.detalle); 
                           // $('.inputDescripcion select').html(info.detalle);
                            $('#modalAddprod').modal('hide');
                           
                            
    
                        }else{
                          //  console.log('no data');
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
