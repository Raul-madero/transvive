<?php
include "../conexion.php";
session_start();
$User=$_SESSION['user'];
// var_dump($User);
$rol=$_SESSION['rol'];
$sql = "select * from rol where idrol =$rol ";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query); 

$namerol = $filas['rol'];
if (!isset($_SESSION['idUser'])) {
    header('Location: ../index.php');
}

//Seleccion de fecha
date_default_timezone_set('America/Mexico_City');
$fcha = date("Y-m-d");

//Busqueda de folio para creacion de nueva requisicion
$query_folio = mysqli_query($conection,"SELECT MAX(no_requisicion) AS folio FROM requisicion_compra");
$result_folio = mysqli_num_rows($query_folio);
$folioe = mysqli_fetch_array($query_folio);
$nuevofolio=$folioe["folio"]+1;

//Eliminar datos, si existen de detalle temp requisicion compra
$sql = "DELETE FROM detalle_temp_cotizacioncompra WHERE folio = $nuevofolio";
$query = mysqli_query($conection, $sql);
$result = mysqli_affected_rows($conection);

//Seleccionar quien recibe
$sqlrecb   = "select nombre from usuario where rol = 10 and estatus = 1 ORDER BY nombre";
$queryrecb = mysqli_query($conection, $sqlrecb);
$filasrecb = mysqli_fetch_all($queryrecb, MYSQLI_ASSOC); 

//Seleccion de productos para llenado de requisicion
$sqlprod   = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY codigo";
$queryprod = mysqli_query($conection, $sqlprod);
$filasprod = mysqli_fetch_all($queryprod, MYSQLI_ASSOC);

//Seleccion de productos por descripcion
$sqlprodnm = "select id, codigo, codigo_interno, descripcion, marca from refacciones where estatus = 1 ORDER BY descripcion";
$queryprodnm = mysqli_query($conection, $sqlprodnm);
$filasprodnm = mysqli_fetch_all($queryprodnm, MYSQLI_ASSOC);

//Seleccion de proveedores para llenado de requisicion
$sqlprov   = "select id, no_prov, nombre from proveedores where estatus = 1";
$queryprov = mysqli_query($conection, $sqlprov);
$filasprov = mysqli_fetch_all($queryprov, MYSQLI_ASSOC); 

//Seleccion de orden de Mantenimiento
$sqlsmant  = "select no_orden from solicitud_mantenimiento where estatus = 1";
$querysmant = mysqli_query($conection, $sqlsmant);
$filasmant = mysqli_fetch_all($querysmant, MYSQLI_ASSOC); 

//Seleccion de unidades de medida
$sqlumed = "select * from unidades_medida ORDER BY descripcion";
$queryumed = mysqli_query($conection, $sqlumed);
$filasumed = mysqli_fetch_all($queryumed, MYSQLI_ASSOC); 

//Seleccion de unidades
$sqlunidad = "SELECT * FROM unidades WHERE estatus = 1 ORDER BY no_unidad";
$queryunidad = mysqli_query($conection, $sqlunidad);
$filasunidad = mysqli_fetch_all($queryunidad, MYSQLI_ASSOC);

mysqli_close($conection);
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
    </head>
    <body class="hold-transition layout-top-nav">
        <div class="wrapper">        
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
                <!-- Horizontal Form -->
                <div class="col-md-9">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Alta de Requisición</h3>
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
                                    <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fcha;?>">
                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">Folio</label>
                                <div class="col-sm-3">
                                    <input style="text-align:right; font-weight: bold; color: #F05B0E" type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo "REQ-" . $nuevofolio;?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row" style="text-align:left;">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Fecha en la que se requiere</label>
                                <div class="col-sm-4">
                                    <input type="date" class="form-control" id="inputFecharequiere" name="inputFecharequiere">
                                </div>

                                <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo</label>
                                <div class="col-sm-3">
                                    <select class="form-control" style="width: 100%; text-align: left" id="inputTipo" name="inputTipo">
                                        <option value="">- Seleccione -</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Urgente">Urgente</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row" style="text-align:left;">
                                <label for="inputSolicita" class="col-sm-3 col-form-label">Area Solicitante</label>
                                <div class="col-sm-9">
                                    <?php
                                        if($User === "Elena") {
                                            $solicita = "Administracion";
                                        }else if($User === "Lu"){
                                            $solicita = "SGC";
                                        }else {
                                            switch (intval($rol)) {
                                                case 1:
                                                    $solicita = "Administracion";
                                                    break;
                                                case 5:
                                                    $solicita = "Recursos Humanos";
                                                    break;
                                                case 6:
                                                    $solicita = "Operaciones";
                                                    break;
                                                case 7:
                                                    $solicita = "Mantenimiento";
                                                    break;
                                                case 10:
                                                    $solicita = "Almacen";
                                                    break;
                                                case 14:
                                                    $solicita = "Calidad";
                                                    break;
                                                default:
                                                    $solicita = "Compras";
                                                    break;
                                            }
                                        }
                                        ?>
                                    <input type="text" class="form-control" id="inputSolicita" name="inputSolicita" value="<?php echo $solicita; ?>" readonly/>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="unidad" class="col-md-4 col-form-label">No. Unidad</label>
                                <div class="col-md-8">
                                    <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputNounidad" name="inputNounidad">
                                        <option value="">- Seleccione -</option>
                                        <?php foreach ($filasunidad as $unidad): ?>
                                            <option 
                                                value="<?= $unidad['no_unidad'] ?>"
                                                data-descripcion="<?= htmlspecialchars($unidad['descripcion']) ?>">
                                                <?= $unidad['no_unidad'] ?>
                                            </option>  
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="tipoUnidad" class="col-md-4 col-form-label">Tipo unidad</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inputTipoUnidad" name="inputTipoUnidad" value="" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="descripcionUnidad" class="col-md-4 col-form-label">Descripción</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="inputDescripcionUnidad" name="inputDescripcionUnidad" value="" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputProveedor" class="col-md-4 col-form-label">
                                    Proveedor:
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputProveedor" name="inputProveedor">
                                        <option value="">- Seleccione -</option>
                                        <?php foreach ($filasprov as $op): //llenar las opciones del primer select ?>
                                            <option value="<?= $op['no_prov'] ?>"><?= $op['nombre'] ?></option>  
                                        <?php endforeach; ?>
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
                                            <th style="width:5%; background-color:#e9ecef; text-align: center;" >Cantidad</th>
                                            <th style="width:10%; background-color:#e9ecef; text-align: center;" >Codigo</th>
                                            <th style="width:30%; background-color:#e9ecef; text-align: center;">Descripción</th>
                                            <th style="width:15%; background-color:#e9ecef; text-align: center;" >Marca</th>
                                            <th style="width:5%; background-color:#e9ecef; text-align: center;" >E</th>
                                            <th style="width:5%; background-color:#e9ecef; text-align: center;" >OM</th>
                                            <th style="width:25%; background-color:#e9ecef; text-align: center;" >Precio Unitario</th>
                                            <th style="width:5%; background-color:#e9ecef; text-align: center;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="detalle_cotizacion">
                                    <!---Contenido Ajax--->
                                    </tbody>
                                    <tfoot>
                                    <!-- Contenido Ajax -->    
                                    </tfoot>
                                </table>
                            </div>

                            <div class="form-group row" style="text-align:left;">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Monto Aprox. Autorizado</label>
                                <div class="col-sm-9">
                                    <input type="number" step="any" class="form-control" id="inputMontoaut" name="inputMontoaut" value="0.00">
                                </div>
                            </div>    

                            <div class="form-group row" style="text-align:left;">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputNotas" name="inputNotas" rows="1"></textarea>
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
    <!-- Select2 -->
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <!-- Sweet Alert -->
    <script src="js/sweetalert2.all.min.js"></script>   
    <script>
        $('#btn_salir').click(function(e){
            e.preventDefault();
            Swal.fire({
                title: "DESEA SALIR!",
                text: "",
                icon: 'info',

                showCancelButton: true,
                confirmButtonText: "Regresar",
                cancelButtonText: "Salir",
            })
            .then(resultado => {
                if (resultado.value) {
                    console.log("Alerta cerrada");
                } else {
                    // Dijeron que no
                    location.href = 'requisiciones23.php';
                }
            });
        });
    </script>

<script>
$(document).ready(function () {
    const selectUnidad = document.getElementById('inputNounidad');
    const inputTipoUnidad = document.getElementById('inputTipoUnidad');
    const inputDescripcion = document.getElementById('inputDescripcionUnidad');

    const tipoUnidadMap = {
        'T': 'Camioneta',
        'C': 'Camión',
        'A': 'Automóvil',
        'S': 'Sprinter'
    };

    $('#inputNounidad').on('change', function () {
        console.log("Unidad seleccionada");
        const selectedOption = this.options[this.selectedIndex];
        const textoUnidad = selectedOption.text.trim();
        const letra = textoUnidad.charAt(0).toUpperCase();

        inputTipoUnidad.value = tipoUnidadMap[letra] || '';
        inputDescripcion.value = selectedOption.getAttribute('data-descripcion') || '';
    });
});
</script>


    <script>
        $('#guardar_tipoactividad').click(function(e){
            $(this).prop('disabled', true)
            e.preventDefault();

            var folioVal         = $('#inputFolio').val();
            let folio           = folioVal.replace(/\D+/g, '');
            var fecha         = $('#inputFecha').val();
            var fecha_req     = $('#inputFecharequiere').val();
            var tipo          = $('#inputTipo').val();
            var areasolicita  = $('#inputSolicita').val();
            var montoaut      = $('#inputMontoaut').val();
            var notas         = $('#inputNotas').val();
            var action       = 'AlmacenaRequerimiento';

            $.ajax({
                url: 'includes/ajax.php',
                type: "POST",
                async : true,
                data: {action:action, folio:folio, fecha:fecha, fecha_req:fecha_req, tipo:tipo, areasolicita:areasolicita, montoaut:montoaut, notas:notas},

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
                            Swal.fire({
                                title: "Exito!",
                                text: "REQUISICION ALMACENADA CORRECTAMENTE",
                                icon: 'success'
                            })
                            .then(resultado => {
                                if (resultado.value) {
                                    //generarimpformulaPDF(info.folio);
                                    location.href = 'requisiciones23.php';
                                } else {
                                    // Dijeron que no
                                    location.reload();
                                    location.href = 'requisiciones23.php';
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
                },
                error: function(error) {
                }
            });
        });
    </script>
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

                        <div class="form-group row" >
                            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Codigo:</label>
                            <div class="col-sm-9">
                                <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputCodigoProd" name="inputCodigoProd">
                                    <option value="">- Seleccione -</option>
                                    <?php foreach ($filasprod as $prod): //llenar las opciones del primer select ?>
                                    <option value="<?= $prod['codigo'] ?>"><?= $prod['codigo'] ?></option>  
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
                                    <option value="<?= $opnm['descripcion'] ?>"><?= $opnm['codigo_interno'] . ' - ' . $opnm['descripcion'] ?></option>  
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

    <script>
        $('#actualizaclientes').click(function(e){
            e.preventDefault();

            var folio        = $('#inputfoliodet').val();
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

            var action       = 'AddDetallecotizacion';

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
$(document).on('change', '.input-cot', function () {
    const input = $(this);
    const id = input.data('id');
    const campo = input.data('field');
    const valor = input.val();

    $.ajax({
        url: 'includes/ajax.php', // Asegúrate de apuntar al archivo correcto
        type: 'POST',
        data: {
            action: 'ActualizarCampoCotizacion',
            id: id,
            campo: campo,
            valor: valor
        },
        success: function (response) {
            if (response.trim() === 'ok') {
                console.log('Actualización exitosa');
            } else {
                alert('Error al guardar el cambio');
            }
        },
        error: function () {
            alert('Error de conexión con el servidor');
        }
    });
});
</script>


    <script> 
        function del_detalle_cotizacion(id, folio){
            var action = 'delDeattecotizacion';
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
                        $('#detalle_cotizacion').html(info.detalle);
                    }else{
                        $('#detalle_cotizacion').html('');       
                    }
                },
                error: function(error) {
                }
            });
        }
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
                    console.log(response);
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

    <script type="text/javascript">
        function generarimpformulaPDF(folio){
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
                placeholder: "Escribe o Busca la Orden de Mantenimiento", //placeholder
                tags: true,
                tokenSeparators: ['/',',',';'," "] 
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