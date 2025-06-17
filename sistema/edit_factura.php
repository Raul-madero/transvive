<?php
include('../conexion.php');
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

$no_factura = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
if ($no_factura <= 0) {
    die("No se ha proporcionado un número de factura válido.");
}

$query = "SELECT * FROM facturas WHERE no_factura = $no_factura";
$result = mysqli_query($conection, $query);
mysqli_close($conection);

if (!$result || mysqli_num_rows($result) === 0) {
    die("No se ha encontrado una factura con el número $no_factura.");
}

$data = mysqli_fetch_assoc($result);
var_dump($data); // For debugging purposes
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
<scr class="wrapper">

 
 <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE ERP"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php include('includes/generalnavbar.php') ?>
      <?php include('includes/nav.php') ?> 

    </div>
  </nav>
  <div>
    <form id="form_factura">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBorraLabel">Ingresar Datos de Factura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- No. Requisición -->
                        <div class="form-group row">
                            <div class="col-7 row" >
                                <label id="label_factura" for="factura_norequi" class="col-sm-6 col-form-label text-left"></label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="factura_norequi" name="factura_norequi" readonly>
                                    <input type="text" class="form-control" id="factura_orden" name="factura_orden" readonly>
                                </div>
                            </div>
                            <div class="col-5 row" >
                                <label for="no_factura" class="col-sm-6 col-form-label text-left">No. Factura:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="no_factura" name="no_factura" >
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-7 row" >
                                <label for="fecha" class="col-sm-6 col-form-label text-left">Fecha Factura:</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="fecha" name="fecha">
                                </div>
                            </div>
                            <div class="col-5 row" >
                                <label for="fecha_pago" class="col-sm-6 col-form-label text-left">Fecha Pago:</label>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control" id="fecha_pago" name="fecha_pago" >
                                </div>
                            </div>
                        </div>

                        <!-- Proveedores -->
                        <div class="form-group row">
                            <label for="proveedor" class="col-sm-3 col-form-label text-left">Proveedor:</label>
                            <div class="col-sm-9">
                                <select class="form-control w-100" id="proveedor" name="proveedor">
                                    <!-- Se carga con AJAX -->
                                </select>
                            </div>
                        </div>

                        <table class="table mb-4">
                            <thead>
                                <tr>
                                    <th scope="col">Codigo</th>
                                    <th scope="col">Cant.</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Precio Unit.</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody id="cuerpoFactura">
                                <!-- Cuerpo de la tabla con productos -->
                            </tbody>
                        </table>

                        <!-- Totales -->
                        <div class="form-group row">
                            <div class="col-4 row">
                                <label for="subtotal" class="col-sm-3 col-form-label text-left">Subtotal:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="subtotal" name="subtotal">
                                </div>
                            </div>
                            <div class="col-4 row">
                                <label for="iva" class="col-sm-3 col-form-label text-left">IVA:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="iva" name="iva" readonly>
                                </div>
                            </div>
                            <div class="col-4 row">
                                <label for="proveedor" class="col-sm-3 col-form-label text-left">Total:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="total" name="total" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Resultado del impuesto adicional -->
                        <div class="form-group row align-items-center" id="resultadoImpuesto" style="display: none;">
                            <label class="col-sm-4 col-form-label text-left" id="etiquetaImpuestoAdicional"></label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="valorImpuestoAdicional" readonly>
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-sm btn-outline-danger" id="eliminarImpuestoAdicional">
                                    Quitar
                                </button>
                            </div>
                        </div>

                        <!-- Impuestos adicionales -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">¿Tiene Impuesto Adicional?</label>
                            <div class="col-sm-8">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="toggleImpuesto">
                                    <label class="custom-control-label" for="toggleImpuesto">Si</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row align-items-center" id="grupoImpuestoAdicional" style="display:none">
                            <div class="col-4 row align-items-center">
                                <label for="nombreImpuestoAdicional" class="col-sm-4 col-form-label text-left">Nombre Impuesto:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombreImpuestoAdicional" name="nombreImpuestoAdicional">
                                </div>
                            </div>
                            <div class="col-4 row">
                                <label for="porcentajeImpuestoAdicional" class="col-sm-5 col-form-label text-left">Porcentaje:</label>
                                <div class="col-sm-7">
                                    <input type="number" class="form-control" id="porcentajeImpuestoAdicional" name="porcentajeImpuestoAdicional">
                                </div>
                            </div>
                            <div class="col-4 row">
                                <button class="btn btn-outline-success rounded-full">Agregar Impuesto</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" id="guardarFactura">
                            <i class="fa fa-save mr-2"></i>&nbsp;Guardar
                        </button>
                    </div>
                </form>
  </div>
  </body>
  </html>