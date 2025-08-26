<?php

include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
//   var_dump($_SESSION);
  $idUser = $_SESSION['idUser'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];
  if (!isset($_SESSION['idUser'])) {
  header('Location: ../index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Meta -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRANSVIVE | ERP</title>
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <!-- jQuery UI (solo CSS) -->
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">

  <!-- AdminLTE -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">

  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- DataTables + Buttons -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">

  <!-- Bootstrap Datepicker CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

  <!-- Bootstrap (AdminLTE usa Bootstrap 4) -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- DataTables + Buttons (JS) -->
  <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

  <!-- Bootstrap Datepicker: primero la librería, luego el idioma -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.es.min.js"></script>

  <!-- Bootbox -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>

  <style>
    #fetch_generated_wills { width: 100% !important; table-layout: fixed; }
    .column-actions { white-space: nowrap; text-align: center; min-width: 160px; }
  </style>
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
    <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="salir.php" class="navbar-brand">
                    <span class="brand-text font-weight-light">
                        <img src="../images/logo_easy.png" alt="TRANSVIVE ERP">
                    </span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <?php include('includes/generalnavbar.php'); ?>
                <?php include('includes/nav.php'); ?>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <!-- Content Header -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="m-0">Listado de Requisiciones de Compra <small><i class="fas fa-file"></i></small></h4>
                        </div>
                        <div class="col-sm-6 d-none d-sm-block">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="new_cotizacioncompra.php"><i class="fas fa-plus text-success"></i>&nbsp;&nbsp;Nueva</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="card card-success card-outline">
                        <div class="card-body">

                            <!-- Filtros -->
                            <form class="form-inline mb-3">
                                <div class="form-group mr-3">
                                    <input type="text" readonly name="initial_date" id="initial_date" class="form-control datepicker" placeholder="De Fecha">
                                </div>
                                <div class="form-group mr-3">
                                    <input type="text" readonly name="final_date" id="final_date" class="form-control datepicker" placeholder="A Fecha">
                                </div>
                                <div class="form-group mr-3">
                                    <button type="submit" name="filter" id="filter" class="btn btn-success">
                                        <i class="fa fa-filter"></i> Filtro
                                    </button>
                                </div>
                                <div class="form-group">
                                    <button type="button" onclick="actualizarLaPagina()" class="btn btn-info">
                                        <i class="fa fa-refresh"></i>
                                    </button>
                                </div>
                            </form>
                            <?php if($_SESSION['rol'] == 1 || $_SESSION['idUser'] == 19 || $_SESSION['idUser'] == 23 || $_SESSION['idUser'] == 39 || $_SESSION['idUser'] == 32): ?>
                            <!-- Tabla -->
                            <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">Id</th> -->
                                        <th class="text-center">No. Requisición</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Fecha Requiere Material</th>
                                        <?php if($_SESSION['idUser'] != 32): ?>
                                            <th class="text-center">No. OC</th>
                                            <th class="text-center">Fecha OC</th>
                                            <th class="text-center">Fecha Recepcion</th>
                                            <th class="text-center">No. Factura</th>
                                            <th class="text-center">Fecha Factura</th>
                                            <th class="text-center">Fecha Pago</th>
                                            <th class="text-center">Tipo</th>
                                            <th class="text-center">Monto</th>
                                        <?php endif; ?>
                                        <th class="text-center">Área Solicitante</th>
                                        <th class="text-center">Observaciones</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Acciónes</th>
                                    </tr>
                                </thead>
                            </table>
                            <?php else:?>
                                <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">Id</th> -->
                                        <th class="text-center">No. Requisición</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Fecha Requiere Material</th>
                                        <th class="text-center">Área Solicitante</th>
                                        <th class="text-center">Observaciones</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Acciónes</th>
                                    </tr>
                                </thead>
                            </table>
                            <?php endif;?>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <?php include "includes/footer.php"; ?>
        </footer>

    <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Aquí podrías colocar tabs si los necesitas -->
                <div class="tab-content">
                    <div class="tab-pane" id="control-sidebar-home-tab"></div>
                </div>
        </aside>
    
        <div class="control-sidebar-bg"></div>
    </div>

<!-- Bootstrap Datepicker: primero la librería, luego el idioma -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.es.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
$IS_EXTENDED = ($_SESSION['rol'] == 1
    || $_SESSION['idUser'] == 19
    || $_SESSION['idUser'] == 23
    || $_SESSION['idUser'] == 39
    || $_SESSION['idUser'] == 32);
?>
<script type="text/javascript">
$(function () {
  // ====== Config global segura ======
  $.fn.dataTable.ext.errMode = 'none'; // Evita alerts nativos de DT

  const IS_EXTENDED = <?php echo json_encode($IS_EXTENDED); ?>;
  const ajax_url = "data/datadetorders_req.php";

  // Log de errores visibles
  const logError = (msg) => $("#error_log").html(msg || "");

  // ====== Datepicker (bootstrap-datepicker) ======
  // Si usas bootstrap-datepicker, la opción correcta es "format" (no dateFormat)
  // Cambia a "dateFormat" si usas jQuery UI Datepicker.
  $(".datepicker").datepicker?.({
    language: 'es',
    format: "dd-mm-yyyy",
    todayHighlight: true,
    autoclose: true,
    clearBtn: true
  });

  // ====== Helpers ======
  const get = (o, path) => {
    if (!o) return undefined;
    return path.split('.').reduce((acc, k) => (acc && acc[k] !== undefined ? acc[k] : undefined), o);
  };
  const nz = (v, d='') => (v === null || v === undefined ? d : v);          // null -> default
  const str = (v, d='') => (v === null || v === undefined ? d : String(v));  // a string
  const num = (v, d=0) => (isFinite(v) ? Number(v) : d);                      // a número

  // Normaliza una fila del backend para que SIEMPRE tenga Folio/no_orden/no_factura
  function sanitizeRow(row) {
    // Acepta varios esquemas del backend
    const Folio      = nz(row?.Folio, nz(get(row,'Foliofull.Folio'), ''));
    const no_orden   = nz(row?.no_orden, nz(get(row,'Foliofull.no_orden'), 'N/A'));
    const no_factura = nz(row?.no_factura, 'N/A');
    const Foliofull  = { Folio, no_orden };
    return {
      ...row,
      Folio,
      no_orden,
      no_factura,
      Foliofull
    };
  }

  const formatNoOrden = (row)   => (str(row?.no_orden || get(row,'Foliofull.no_orden') || 'N/A') === 'N/A' ? 'N/A' : `OC-${row.no_orden}`);
  const formatNoFact  = (row)   => (str(row?.no_factura || 'N/A') === 'N/A' ? 'N/A' : `FA-${row.no_factura}`);
  const money         = (v)     => new Intl.NumberFormat('es-MX', {minimumFractionDigits:2, maximumFractionDigits:2}).format(num(v));

  // ====== Acciones (usa SIEMPRE datos normalizados) ======
  function renderActions(full) {
    const r = sanitizeRow(full);
    const Folio    = r.Folio;
    const no_orden = r.no_orden;

    let actions = "";

    // Copié tu lógica, sólo aseguré Folio/no_orden y href seguros (javascript:void(0))
    if (r.estatus == 1) {
      <?php if ($_SESSION['idUser'] == 39) { ?>
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Ver Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a> |
        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAutorizaRequisicion"
           data-id="${Folio}" data-date="${nz(r.fecha_req,'')}" data-name="${nz(r.tipor,'')}" class="text-success" title="Autorizar">
          <i class="fa fa-thumbs-up" style="font-size:.8rem;"></i>
        </a>`;
      <?php } else if ($_SESSION['rol'] == 16 || $_SESSION['rol'] == 1 || $_SESSION['rol'] == 7 || $_SESSION['idUser'] == 19) { ?>
      actions = `
        <a class="link_edit text-primary" href="edit_cotizacioncompra.php?id=${nz(r.pedidono,'')}" title="Editar Requisición">
          <i class="far fa-edit" style="font-size:.8rem;"></i>
        </a> |
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a> |
        <a data-toggle="modal" data-target="#modalCancela" data-id="${Folio}" data-date="${nz(r.fecha_req,'')}" data-name="${nz(r.arear,'')}" href="javascript:void(0)" class="text-warning" title="Cancelar Requisición">
          <i class="fa fa-ban" style="font-size:.8rem;"></i>
        </a> |
        <a data-toggle="modal" data-target="#modalBorra" data-id="${Folio}" data-name="${nz(r.arear,'')}" href="javascript:void(0)" class="link_delete text-danger" title="Borrar Requisición">
          <i class="fa fa-trash" style="font-size:.8rem;"></i>
        </a>`;
      <?php } else { ?>
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a>`;
      <?php } ?>
    } else if (r.estatus == 9) {
      <?php if ($_SESSION['idUser'] == 17 || $_SESSION['idUser'] == 3 ) { ?>
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Ver Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a> |
        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAutorizaRequisicion"
           data-id="${Folio}" data-date="${nz(r.fecha_req,'')}" data-name="${nz(r.tipor,'')}" class="text-success" title="Autorizar">
          <i class="fa fa-thumbs-up" style="font-size:.8rem;"></i>
        </a>`;
      <?php } else if ($_SESSION['rol'] == 16 || $_SESSION['rol'] == 1 || $_SESSION['rol'] == 7 || $_SESSION['idUser'] == 19) { ?>
      actions = `
        <a class="link_edit text-primary" href="edit_cotizacioncompra.php?id=${nz(r.pedidono,'')}" title="Editar Requisición">
          <i class="far fa-edit" style="font-size:.8rem;"></i>
        </a> |
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a> |
        <a data-toggle="modal" data-target="#modalCancela" data-id="${Folio}" data-date="${nz(r.fecha_req,'')}" data-name="${nz(r.arear,'')}" href="javascript:void(0)" class="text-warning" title="Cancelar Requisición">
          <i class="fa fa-ban" style="font-size:.8rem;"></i>
        </a> |
        <a data-toggle="modal" data-target="#modalBorra" data-id="${Folio}" data-name="${nz(r.arear,'')}" href="javascript:void(0)" class="link_delete text-danger" title="Borrar Requisición">
          <i class="fa fa-trash" style="font-size:.8rem;"></i>
        </a>`;
      <?php } else { ?>
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a>`;
      <?php } ?>
    } else if (r.estatus == 2) {
      <?php if ($_SESSION['rol'] == 16 || $_SESSION['rol'] == 1 || $_SESSION['rol'] == 7 || $_SESSION['idUser'] == 19) { ?>
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a> |
        <a href="new_orden_compra.php?req=${Folio}" class="text-success" title="Generar Orden de Compra">
          <i class="fa fa-clipboard" style="font-size:.8rem;"></i>
        </a> |
        <a data-toggle="modal" data-target="#modalCancela" data-id="${Folio}" data-date="${nz(r.fecha_req,'')}" data-name="${nz(r.arear,'')}" href="javascript:void(0)" class="text-warning" title="Cancelar Requisición">
          <i class="fa fa-ban" style="font-size:.8rem;"></i>
        </a> |
        <a data-toggle="modal" data-target="#modalFactura" data-id="${Folio}" href="javascript:void(0)" class="text-primary" title="Ingresar datos de factura">
          <i class="fa fa-file" style="font-size:.8rem;"></i>
        </a>`;
      <?php } else { ?>
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a>`;
      <?php } ?>
    } else if (r.estatus == 4) {
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;"></i>
        </a> |
        <a data-toggle="modal" data-target="#subirFactura" data-id="${Folio}" href="javascript:void(0)" class="text-primary" title="Subir Factura">
          <i class="fa fa-upload" style="font-size:.8rem;"></i>
        </a>`;
    } else if (r.estatus == 5) {
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" style="display:inline-block;text-align:center;" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">R</span>
        </a> |
        <a href="verfactura.php?id=${Folio}" target="_blank" class="text-orange" style="display:inline-block;text-align:center;" title="Ver Factura">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">F</span>
        </a>`;
      if (str(no_orden) !== "N/A") {
        actions += `
          |
          <a href="factura/orden_compra.php?id=${no_orden}" target="_blank" class="text-warning mx-1" style="display:inline-block;text-align:center;" title="Imprimir Orden de Compra">
            <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">OC</span>
          </a> |
          <a href="data/verpago.php?orden=${no_orden}" target="_blank" class="text-success" style="display:inline-block;text-align:center;" title="Ver Pago">
            <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">P</span>
          </a>`;
      } else {
        actions += `
          |
          <a href="data/verpago.php?id=${Folio}" target="_blank" class="text-success" style="display:inline-block;text-align:center;" title="Ver Pago">
            <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">P</span>
          </a>`;
      }
    } else if (r.estatus == 3) {
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" class="mx-1" style="display:inline-block;text-align:center;" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">R</span>
        </a>
        <a href="factura/orden_compra.php?id=${no_orden}" target="_blank" class="text-orange mx-1" style="display:inline-block;text-align:center;" title="Imprimir Orden de Compra">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">OC</span>
        </a>`;
      <?php if($_SESSION['rol'] != 7): ?>
      actions += `
        <a class="link_edit text-primary" href="edit_ordencompra.php?id=${no_orden}" title="Editar Orden de Compra">
          <i class="far fa-edit" style="font-size:.8rem;"></i>
        </a>
        <a data-toggle="modal" data-target="#modalIngreso" data-orden="${no_orden}" data-req="${Folio}" href="javascript:void(0)" class="text-warning" title="Ingresar Productos">
          <i class="fa-solid fa-right-to-bracket" style="font-size:.8rem;"></i>
        </a>`;
      <?php endif; ?>
    } else if (r.estatus == 7) {
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" class="mx-1" style="display:inline-block;text-align:center;" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">R</span>
        </a>
        <a href="factura/orden_compra.php?id=${no_orden}" target="_blank" class="text-orange mx-1" style="display:inline-block;text-align:center;" title="Imprimir Orden de Compra">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">OC</span>
        </a>`;
      <?php if($_SESSION['rol'] != 7): ?>
      actions += `
        <a data-toggle="modal" data-target="#subirFactura" data-id="${Folio}" data-orden="${no_orden}" href="javascript:void(0)" class="text-primary mx-1" title="Subir Factura">
          <i class="fa fa-upload" style="font-size:.8rem;"></i>
        </a>`;
      <?php endif; ?>
    } else if (r.estatus == 6) {
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" class="mx-1" style="display:inline-block;text-align:center;" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">R</span>
        </a>
        <a href="factura/orden_compra.php?id=${no_orden}" target="_blank" class="text-orange mx-1" style="display:inline-block;text-align:center;" title="Imprimir Orden de Compra">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">OC</span>
        </a>`;
      <?php if($_SESSION['rol'] != 7): ?>
      actions += `
        <a data-toggle="modal" data-target="#modalFactura" data-orden="${no_orden}" href="javascript:void(0)" class="text-primary mx-1" title="Cargar datos de factura">
          <i class="fa fa-file" style="font-size:.8rem;"></i>
        </a>`;
      <?php endif; ?>
    } else if (r.estatus == 8) {
      actions = `
        <a href="factura/requisicion.php?id=${Folio}" target="_blank" style="display:inline-block;text-align:center;" title="Imprimir Requisición">
          <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">R</span>
        </a>`;
      if (str(no_orden) === 'N/A') {
        actions += `
          <a href="verfactura.php?id=${Folio}" target="_blank" class="text-orange" style="display:inline-block;text-align:center;" title="Ver Factura">
            <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">F</span>
          </a>
          <a data-toggle="modal" data-target="#pagar" data-id="${Folio}" data-orden="${no_orden}" href="javascript:void(0)" class="text-primary mx-1" title="Subir Pago">
            <i class="fa fa-upload" style="font-size:.8rem;"></i>
          </a>`;
      } else {
        actions += `
          <a href="factura/orden_compra.php?id=${no_orden}" target="_blank" class="text-warning mx-1" style="display:inline-block;text-align:center;" title="Imprimir Orden de Compra">
            <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">OC</span>
          </a>
          <a href="verfactura.php?id=${Folio}" target="_blank" class="text-orange" style="display:inline-block;text-align:center;" title="Ver Factura">
            <i class="fa fa-print" style="font-size:.8rem;display:block;"></i><span style="font-size:.8rem;">F</span>
          </a>
          <a data-toggle="modal" data-target="#pagar" data-id="${Folio}" data-orden="${no_orden}" href="javascript:void(0)" class="text-primary mx-1" title="Subir Pago">
            <i class="fa fa-upload" style="font-size:.8rem;"></i>
          </a>`;
      }
      actions += `
        <a class="link_edit text-primary" href="edit_factura.php?id=${nz(r.no_factura,'')}" title="Editar Factura">
          <i class="far fa-edit" style="font-size:.8rem;"></i>
        </a>`;
    }

    return actions;
  }

  // ====== Columnas ======
  const columnsCommon = [
    { data: "Folio", width: "2%", className: "text-center align-middle",
      render: (data) => `REQ-${str(data)}` },
    { data: "fechaa",     width: "3%", className: "text-center align-middle",
      render: (d)=> str(d,'') },
    { data: "fecha_req",  width: "5%", className: "text-center align-middle", orderable: false,
      render: (d)=> str(d,'') },
  ];

  const columnsExtended = IS_EXTENDED ? [
    { data: null, width: "5%", className: "text-center align-middle",
      render: (d,t,row) => formatNoOrden(sanitizeRow(row)) },
    { data: "fecha_orden",   width: "5%", className: "text-center align-middle", render:(d)=>str(d,'') },
    { data: "fecha_entrega", width: "5%", className: "text-center align-middle", render:(d)=>str(d,'') },
    { data: null, width: "5%", className: "text-center align-middle",
      render: (d,t,row) => formatNoFact(sanitizeRow(row)) },
    { data: "fecha_factura", width: "5%", className: "text-center align-middle", orderable:false, render:(d)=>str(d,'') },
    { data: "fecha_pago",    width: "5%", className: "text-center align-middle", orderable:false, render:(d)=>str(d,'') },
    { data: "tipor",         width: "5%", className: "text-center align-middle", orderable:false, render:(d)=>str(d,'') },
    { data: "monto",         width: "6%", className: "text-center align-middle", orderable:false,
      render: (d)=> money(d) },
  ] : [];

  const tailColumns = [
    { data: "arear",  width: "15%", className: "text-center align-middle", orderable: false, render:(d)=>str(d,'') },
    { data: "notas",  width: "30%", className: IS_EXTENDED ? "text-center align-middle" : "text-left align-middle",
      orderable: false, render:(d)=>str(d,'') },
    { data: "estatusped", width: "4%", className: "text-center align-middle", orderable: false, render:(d)=>str(d,'') },
    { data: null, orderable: false, width: "20%",
      className: "text-center column-actions align-middle" + (IS_EXTENDED ? " noVis" : ""),
      render: (d,t,full) => renderActions(full)
    }
  ];

  // ====== Inicializar / Recargar ======
  function initTable(initial_date = '', final_date = '', gender = '') {
    const $tbl = $('#fetch_generated_wills');

    // Limpia handlers de errores antiguos
    $tbl.off('error.dt').on('error.dt', function(e, settings, techNote, message) {
      logError("⚠️ Error en DataTables: " + message);
    });

    // Instancia
    $tbl.DataTable({
      destroy: true,
      processing: true,
      serverSide: true,
      stateSave: true,
      responsive: true,
      autoWidth: false,
      order: [[0, "desc"]],
      lengthMenu: [[10, 25, 50, 100, -1],[10, 25, 50, 100, "Todos"]],
      dom: 'Bfrtip',
      buttons: (() => {
        const base = [
          'copyHtml5',
          { text: 'Excel', action: () => window.open('factura/requis_excel.php', '_blank') },
          'csvHtml5'
        ];
        if (IS_EXTENDED) base.push({ extend:'colvis', postfixButtons:['colvisRestore'], columns: ':not(.noVis)' });
        base.push('pageLength');
        return base;
      })(),
      ajax: {
        url: ajax_url,
        type: "POST",
        dataType: "json",
        data: { action:"fetch_users", initial_date, final_date, gender },
        // Robustez ante formatos distintos
        dataSrc: function (json) {
          try {
            if (!json) { logError("⚠️ Respuesta vacía del servidor."); return []; }
            if (json.error) { logError("⚠️ " + json.error); }
            const arr = Array.isArray(json.records) ? json.records
                      : Array.isArray(json.data)    ? json.data
                      : (Array.isArray(json) ? json : []);
            const norm = arr.map(sanitizeRow);
            if (!norm.length) { logError("Sin resultados para el filtro seleccionado."); }
            return norm;
          } catch (e) {
            logError("⚠️ Error procesando datos: " + (e?.message || e));
            return [];
          }
        },
        error: function (xhr) {
          const msg = xhr?.responseJSON?.error || xhr?.statusText || 'Error desconocido';
          logError("⚠️ Error en la petición: " + msg);
        }
      },
      columns: [...columnsCommon, ...columnsExtended, ...tailColumns],
      language: {
        url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
        emptyTable: "No hay datos disponibles",
        zeroRecords: "No se encontraron coincidencias"
      },
      // Evita que stateSave rompa si cambia la estructura de columnas
      stateSaveParams: function (settings, data) {
        // Limpia selecciones de colvis al guardar estado si no es extended
        if (!IS_EXTENDED && data?.columns) {
          data.columns.forEach(c => { c.visible = true; });
        }
      }
    });
  }

  // ====== Filtro por fecha/estatus ======
  $("#filter").on("click", function (e) {
    e.preventDefault();
    const initial_date = $("#initial_date").val();
    const final_date   = $("#final_date").val();
    const gender       = $("#gender").val();

    if (!initial_date || !final_date) {
      logError("⚠️ Debes seleccionar ambas fechas.");
      return;
    }
    const d1 = new Date(initial_date.split('-').reverse().join('-')); // dd-mm-yyyy -> yyyy-mm-dd
    const d2 = new Date(final_date.split('-').reverse().join('-'));
    if (d1 > d2) {
      logError("⚠️ La fecha final debe ser posterior a la inicial.");
      return;
    }
    logError("");
    initTable(initial_date, final_date, gender);
  });

  // ====== Carga inicial ======
  initTable();
});
</script>

    <script>
        function actualizarLaPagina(){
            window.location.reload();
        } 
    </script>

    <script>
        $(document).ready(function() {
            //Evento para mostrar el modal para subir comprobante de Pago
            $('#pagar').on('show.bs.modal', function (e) {
                const button = $(e.relatedTarget); // Boton que disparo el Evento
                const id = button.data().id;
                const orden = button.data().orden;
                const modal = $(this);

                if(orden === 'N/A') {
                    modal.find('#label_pagar').text('Requisicion:');
                    modal.find('#pagar_noreq').val('REQ-' + id);
                    modal.find('#pagar_orden').prop('hidden', true);
                    modal.find('#pagar_noreq').prop('hidden', false);
                }else {
                    modal.find('#label_pagar').text('Orden de Compra:');
                    modal.find('#pagar_orden').val('OC-' + orden);
                    modal.find('#pagar_noreq').val(id);
                    modal.find('#pagar_noreq').prop('hidden', true);
                    modal.find('#pagar_orden').prop('hidden', false);
                }
            });
        })
    </script>

    <div class="modal fade" id="pagar" tabindex="-1" role="dialog" aria-labelledby="pagarLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pagarLabel">Subir Pago</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label id="label_pagar" class="col-sm-4 col-form-label text-left"></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="pagar_noreq" name="pagar_noreq" disabled>
                                <input type="text" class="form-control" id="pagar_orden" name="pagar_orden" disabled>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Fecha de Pago:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" id="fecha_pagar" name="fecha_pagar">
                            </div>
                            <input type="hidden" id="id_pagar" value="<?php echo $_SESSION['idUser'] ?>">
                        </div>
                        <!-- Subir archivo pdf -->
                         <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Archivo:</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control-file" id="pagar_file" name="pagar_file">
                            </div>
                        </div>
                        <!-- Botones de modal -->
                         <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button id="form_pagar" class="btn btn-primary">Subir</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#form_pagar').click(function(e) {
                e.preventDefault();
                const formData = new FormData();
                formData.append('pagar_noreq', $('#pagar_noreq').val().replace(/\D/g, ''));
                formData.append('pagar_orden', $('#pagar_orden').val().replace(/\D/g, ''));
                formData.append('fecha_pago', $('#fecha_pagar').val());
                formData.append('user', $('#id_pagar').val());

                const archivo = $('#pagar_file')[0].files[0];
                console.log(archivo);
                if (!archivo) {
                    alert('Debes seleccionar un archivo.');
                    return;
                }
                formData.append('pagar_file', archivo);

                $.ajax({
                    url: 'data/upload_comprobante_pago.php',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        if (response.success) {
                            alert('Comprobante de pago subido correctamente.');
                            $('#pagar').modal('hide');
                            actualizarLaPagina();
                        } else {
                            alert('Error al subir el comprobante de pago.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                        alert('Error al subir el comprobante de pago.');
                    }
                })
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            //Evento para mostrar el modal para recibir productos
            $('#modalIngreso').on('show.bs.modal', function (e) {
                const button = $(e.relatedTarget); //Boton que disparo el Evento
                const orden = button.data().orden;
                const req = button.data().req;
                const modal = $(this);

                modal.find('#orden').val(`OC-${orden}`);
                modal.find('#noreq_recibir').val(req);

                const tbody = modal.find('#tablaProductosRecibidos');
                tbody.empty();

                $.ajax({
                    url: 'data/get_recibidos_oc.php',
                    type: 'GET',
                    data: {
                        orden: orden
                    },
                    dataType: 'json',
                    success: function(data) {
                        console.log(data);
                        data.forEach(function(item){
                            const fila = `<tr>
                                    <td>${item.codigo}</td>
                                    <td>
                                        <input type="number" class="form-control" name="cant_recibidos" id="cant_recibidos" value="${item.cantidad}"/>
                                    </td>
                                    <td>${item.descripcion}</td>
                                    <td>
                                        $ ${item.precio}
                                    </td>
                                </tr>`;
                            tbody.append(fila);
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar productos:', error);
                        tbody.append('<tr><td colspan="4" class="text-center text-danger">Error al cargar datos</td></tr>');
                    }
                })
            })
        })
    </script>

    <!-- Modal para Ingresar un producto al almacen -->
     <div class="modal fade" id="modalIngreso" tabindex="-1" role="dialog" aria-labelledby="modalIngresoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalIngresoLabel">Recibir Productos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="orden">Orden de Compra:</label>
                            <input type="text" class="form-control" id="orden" readonly>
                            <input type="text" class="form-control" id="noreq_recibir" hidden>
                        </div>
                        <div class="form-group">
                            <label for="fecha_entrada">Fecha de Entrada:</label>
                            <input type="date" class="form-control" id="fecha_entrada">
                        </div>
                        <div class="form-group">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Cantidad</th>
                                        <th>Descripcion</th>
                                        <th>Precio Unitario</th>
                                    </tr>
                                </thead>
                                <tbody id="tablaProductosRecibidos"></tbody>
                            </table>
                        </div>
                        <div class="form-group">
                            <label for="almacen">Almacen Recibe:</label>
                            <select class="form-control" id="almacen">
                                <option value="0">Seleccione almacen</option>
                                <?php 
                                    $query = "SELECT * FROM almacenes WHERE estatus = 1";
                                    $result = mysqli_query($conection, $query);
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['id']}'>{$row['descripcion']}</option>";
                                    }
                               ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button class="btn btn-primary" id="boton_recibir">Recibir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Accion del boton del modal para recibir productos -->
    <script>
        $(document).ready(function() {
            $('#boton_recibir').click(function(e) {
                e.preventDefault();
                const orden = $('#orden').val();
                const fecha_entrada = $('#fecha_entrada').val();
                const almacen_recibe = $('#almacen').val();
                const req = $('#noreq_recibir').val();
                const productos = [];
                $('#tablaProductosRecibidos tr').each(function() {
                    const codigo = $(this).find('td:nth-child(1)').text();
                    const cantidad = $(this).find('td:nth-child(2) input').val();
                    const precio = $(this).find('td:nth-child(4)').text().replace('$ ', '');
                    productos.push({
                        codigo: codigo,
                        cantidad: cantidad,
                        precio: parseFloat(precio)
                    });
                });

                $.ajax({
                    url: 'data/recibir_oc.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        orden: orden,
                        fecha_entrada: fecha_entrada,
                        almacen_recibe: almacen_recibe,
                        req: req,
                        productos: JSON.stringify(productos)
                    },
                    success: function(response) {
                        console.log("Tipo de respuesta:", typeof response); // debería ser 'object'
                        console.log("Contenido:", response);
                        if (response.success) {
                            $('#modalIngreso').modal('hide');
                            Swal.fire({
                                title: 'Recibido!',
                                text: 'Los productos fueron recibidos correctamente.',
                                icon:'success',
                                confirmButtonText: 'Aceptar'
                            }).then((result) => {
                                actualizarLaPagina();
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Hubo un problema al recibir los productos.',
                                icon: 'error',
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al recibir productos:', error);
                        alert('Error al recibir productos. Intente nuevamente.');
                    }
                });
            })
        })
    </script>

    <script> 
        $(document).ready(function () {
            // Evento para mostrar el modal para autorizar una requisición
            $('#modalAutorizaRequisicion').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget); // Botón que disparó el modal
                console.log(button[0], button.data('id'))
                const noreq   = button.data('id');
                const datereq = button.data('date');
                const tiporeq = button.data('name');
                const modal = $(this);
                //Insertar los valores en el modal
                modal.find('#form_pass_noreq').val(noreq);
                modal.find('#form_pass_datereq').val(datereq);
                modal.find('#form_pass_tiporeq').val(tiporeq);
            });
        });
    </script>

    <!-- Modal para subir una factura -->
    <div class="modal fade" id="subirFactura" tabindex="-1" role="dialog" aria-labelledby="subirFacturaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title" id="subirFacturaLabel">Subir Factura</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label id="label_subir_factura" class="col-sm-4 col-form-label text-left"></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="fact_noreq" name="form_pass_noreq" disabled>
                                <input type="text" class="form-control" id="factOrden" name="form_pass_noreq" disabled>
                            </div>
                        </div>
                        <!-- Subir archivo pdf -->
                         <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Archivo:</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control-file" id="form_archivo" name="form_archivo">
                            </div>
                        </div>
                        <!-- Botones de modal -->
                         <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button id="form_subir_factura" class="btn btn-primary">Subir</button>
                        </div>
                    </div>
                    <input type="hidden" id="fact_date_req" name="form_pass_datereq">
                </form>
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function () {
            //Evento para mostrar el modal de subir factura
            $('#subirFactura').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget) // Button that triggered the modal
                const noreq = button.data('id') || ""
                const orden = button.data('orden') || ""
                const modal = $(this);
                console.log(noreq, orden)
                //Insertar valores en el modal Subir Factura
                if (orden > 0) {
                     modal.find('#factOrden').val("OC-" + orden)
                     modal.find('#fact_noreq').val('REQ-' + noreq)
                    modal.find('#fact_noreq').prop('hidden', true)
                    modal.find('#factOrden').prop('hidden', false)
                    modal.find('#label_subir_factura').text("No. Orden Compra:")
                }else {
                    modal.find('#fact_noreq').val("REQ-" + noreq)
                    modal.find('#factOrden').prop('hidden', true)
                    modal.find('#fact_noreq').prop('hidden', false)
                    modal.find('#label_subir_factura').text("No. Requisicion:")
                }
            })
        })
    </script>

    <script>
        $(document).ready(function () {
            $('#form_subir_factura').on('click', function (event) {
                event.preventDefault();

                const formData = new FormData();
                formData.append('form_pass_noreq', $('#fact_noreq').val().replace(/\D/g, ''));
                formData.append('form_pass_orden', $('#factOrden').val().replace(/\D/g, ''));

                // Verificamos que haya archivo seleccionado
                const archivo = $('#form_archivo')[0].files[0];
                if (!archivo) {
                    alert('Por favor selecciona un archivo.');
                    return;
                }
                formData.append('archivo', archivo);

                $.ajax({
                    url: 'carga_facturas.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,  // Importante para FormData
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        if (response.trim() === 'OK') {
                            Swal.fire({
                                title: 'Factura subida correctamente!',
                                icon:'success',
                                confirmButtonText: 'Aceptar'
                            });
                            $('#subirFactura').modal('hide');
                            actualizarLaPagina(); // Si tienes esta función definida
                        } else {
                            Swal.fire({
                                title: 'Error al subir la factura!',
                                icon: 'error',
                                text: response,
                                confirmButtonText: 'Aceptar'
                            });
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.responseText);
                        console.log(textStatus);
                        console.log(errorThrown);
                    }
                });
            });
        });
    </script>

    <!-- Modal de Autorizacion -->
    <div class="modal fade" id="modalAutorizaRequisicion" tabindex="-1" role="dialog" aria-labelledby="modalAutorizaRequisicionLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <form id="form_autoriza_req">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAutorizaRequisicionLabel">Autorizar Requisición</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- Requisición -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">No. Requisición:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_noreq" name="form_pass_noreq" disabled>
                            </div>
                        </div>

                        <!-- Fecha requerida -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Fecha en que se requiere:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_datereq" name="form_pass_datereq" disabled>
                            </div>
                        </div>

                        <!-- Tipo de requisición -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Tipo de Requisición:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_tiporeq" name="form_pass_tiporeq" disabled>
                            </div>
                        </div>

                        <!-- Firma / Autorización -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Autorización:</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="form_pass_firma" name="form_pass_firma" autocomplete="new-password">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-success" id="autorizar">
                            <i class="fa fa-save"></i>&nbsp;Autorizar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <script>
        //Evento del boton de Autorizar
        $('#autorizar').click(function (e) {
            e.preventDefault();

            const noreq = $('#form_pass_noreq').val();
            const datereq = $('#form_pass_datereq').val();
            const tiporeq = $('#form_pass_tiporeq').val();
            const firmareq = $('#form_pass_firma').val();
            const action = 'AddFirmaAreq';
            console.log(noreq, datereq, tiporeq, firmareq);
            // Validación simple del campo de firma
            if (!firmareq || firmareq.trim() === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Debes ingresar tu firma/autorización para continuar.',
                });
                return;
            }

            $.ajax({
                url: 'includes/ajax.php',
                type: "POST",
                data: {
                    action,
                    noreq,
                    datereq,
                    tiporeq,
                    firmareq
                },
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        $('#modalAutorizaRequisicion').modal('hide');
                        $('#form_pass_firma').val('');

                        Swal.fire({
                            icon: 'success',
                            title: 'Autorizado',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error AJAX:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo enviar la solicitud al servidor.'
                    });
                }
            })
        })
    </script>  

    <script> 
        // Evento para mostrar el modal para borrar una requisición
        $(document).ready(function () {
            $('#modalBorra').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget); // Elemento que disparó el modal

                const noreqi = button.data('id') || '';
                const areareqi = button.data('name') || '';

                const modal = $(this);
                modal.find('#form_pass_noreqi').val(noreqi);
                modal.find('#form_pass_areareqi').val(areareqi);
            });
        });
    </script>
    <!-- Modal para borrar requisicion -->
    <div class="modal fade" id="modalBorra" tabindex="-1" role="dialog" aria-labelledby="modalBorraLabel" aria-hidden="true">
        <div div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <form id="form_borrar_requi">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBorraLabel">Borrar Requisición</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <!-- No. Requisición -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">No. Requisición:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_noreqi" name="form_pass_noreqi" disabled>
                            </div>
                        </div>

                        <!-- Departamento -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Departamento que requiere:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_areareqi" name="form_pass_areareqi" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger" id="borrarequisicion">
                            <i class="fa fa-trash" id="borrarequisicion"></i>&nbsp;Borrar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        //Evento del boton borrar requisicion
        $(document).ready(function () {
            $('#borrarequisicion').click(function (e) {
                e.preventDefault();

                const noreqi = $('#form_pass_noreqi').val();
                const areareqi = $('#form_pass_areareqi').val();
                const action = 'Borrarequisicion';

                if (!noreqi) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Datos incompletos',
                        text: 'No se encontró el número de requisición.',
                    });
                    return;
                }

                Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Deseas borrar la requisición No. ${noreqi}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, borrar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'includes/ajax.php',
                            type: 'POST',
                            data: { action, noreqi, areareqi },
                            success: function (response) {
                                let info;
                                try {
                                    info = JSON.parse(response);
                                } catch (err) {
                                    console.error('Error al procesar JSON:', err, response);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error inesperado',
                                        text: 'La respuesta del servidor no se pudo interpretar.',
                                    });
                                    return;
                                }

                                if (info.status === 'success') {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Requisición eliminada',
                                        text: 'La requisición fue borrada correctamente.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        $('#modalBorra').modal('hide');
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: info.message || 'No se pudo eliminar la requisición.'
                                    });
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('Error AJAX:', error);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error de red',
                                    text: 'No se pudo comunicar con el servidor.'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script> 

    <script> 
        //Evento que muestra el modal para cancelar una requisicion
        $(document).ready(function () {
            $('#modalCancela').on('show.bs.modal', function (event) {
                const button = $(event.relatedTarget); // Elemento que disparó el modal

                const noreqc = button.data('id') || '';
                const datereqc = button.data('date') || '';
                const namepc = button.data('name') || '';

                const modal = $(this);
                modal.find('#form_pass_noreqic').val(noreqc);
                modal.find('#form_pass_daterc').val(datereqc);
                modal.find('#form_pass_provec').val(namepc);
            });
        });
    </script>
    <!-- Modal para cancelar una requisicion -->
    <div class="modal fade" id="modalCancela" tabindex="-1" role="dialog" aria-labelledby="modalCancelaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">

                <form id="form_cancelar_req">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalCancelaLabel">Cancelar Requisición</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                    <!-- No. Requisición -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">No. Requisición:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_noreqic" name="form_pass_noreqi" disabled>
                            </div>
                        </div>

                        <!-- Fecha -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Fecha:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_daterc" name="form_pass_daterc" disabled>
                            </div>
                        </div>

                        <!-- Área -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Área que solicita:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_provec" name="form_pass_provec" disabled>
                            </div>
                        </div>

                        <!-- Motivo de cancelación -->
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label text-left">Motivo Cancelación:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_motivoc" name="form_pass_motivoc">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                        <button type="button" class="btn btn-danger" id="cancelarequisicion">
                            <i class="fa fa-ban"></i>&nbsp;Cancelar
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        //Evento del boton que cancela la requisicion
        $('#cancelarequisicion').click(function (e) {
            e.preventDefault();

            const noreqc   = $('#form_pass_noreqic').val();
            const daterc   = $('#form_pass_daterc').val();
            const areasc   = $('#form_pass_provec').val();
            const motivoc  = $('#form_pass_motivoc').val();
            const action   = 'Cancelarequisicion';

            // Validar motivo
            if (!motivoc.trim()) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo requerido',
                    text: 'Debes ingresar el motivo de cancelación.'
                });
                return;
            }

            // Confirmación
            Swal.fire({
                title: '¿Confirmar cancelación?',
                text: `¿Deseas cancelar la requisición No. ${noreqc}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, cancelar',
                cancelButtonText: 'No, volver',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'includes/ajax.php',
                        type: 'POST',
                        data: {
                            action,
                            noreqc,
                            daterc,
                            areasc,
                            motivoc
                        },
                        success: function (response) {
                            try {
                                const info = JSON.parse(response);
                                if (!info.mensaje) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Requisición cancelada',
                                        text: 'La requisición fue cancelada correctamente.',
                                        timer: 2000,
                                        showConfirmButton: false
                                    }).then(() => {
                                        $('#modalCancela').modal('hide');
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error al cancelar',
                                        text: info.mensaje
                                    });
                                }
                            } catch (err) {
                                console.error('Error al procesar JSON:', err, response);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error inesperado',
                                    text: 'No se pudo procesar la respuesta del servidor.'
                                });
                            }
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error de red',
                                text: 'No se pudo conectar con el servidor.'
                            });
                        }
                    });
                }
            });
        });
    </script>  

    <script>
        function recalcularTotalesDesdeTabla() {
            let subtotal = 0;

            $('#cuerpoFactura tr').each(function () {
                const cantidad = parseFloat($(this).find('input.cantidad').val()) || 0;
                const precio = parseFloat($(this).find('input.precio').val()) || 0;
                const total = cantidad * precio;

                subtotal += total;
                $(this).find('.total').text(total.toFixed(2));
            });

            $('#subtotal').val(subtotal.toFixed(2)).trigger('input'); // también recalcula IVA e impuesto adicional
        }

        $(document).ready(function() {
            //Variables del modal factura
            $('#modalFactura').on('show.bs.modal', function (event) {
                const data = $(event.relatedTarget);
                const noreq = `REQ-${data.data().id}`;
                const orden = `OC-${data.data().orden}`;
                
                const modal = $(this);

                modal.find('#factura_norequi').val(noreq);
                modal.find('#factura_orden').val(orden);
                if (data.data().id > 0) {
                    modal.find('#factura_orden').prop('hidden', true);
                    modal.find('#factura_norequi').prop('hidden', false);
                    modal.find('#label_factura').text('No. Requisición');
                }else {
                    modal.find('#factura_norequi').prop('hidden', true);
                    modal.find('#factura_orden').prop('hidden', false);
                    modal.find('#label_factura').text('No. Orden de Compra');
                }

                function recalcularTotalesDesdeTabla() {
                    let subtotal = 0;

                    $('#cuerpoFactura tr').each(function () {
                        const cantidad = parseFloat($(this).find('input.cantidad').val()) || 0;
                        const precio = parseFloat($(this).find('input.precio').val()) || 0;
                        const total = cantidad * precio;

                        subtotal += total;
                        $(this).find('.total').text(total.toFixed(2));
                    });

                    $('#subtotal').val(subtotal.toFixed(2)).trigger('input'); // también recalcula IVA e impuesto adicional
                }
                //Obtener los proveedores para el selecta de la factura
                $.ajax({
                    url: 'data/getProveedores.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        const select = modal.find('#proveedor');
                        select.empty();
                        select.append('<option value="">Seleccione un proveedor</option>');
                        response.forEach(function(proveedor) {
                            select.append(`<option value="${proveedor.id}">${proveedor.nombre}</option>`);
                        })

                    },
                    error: function(xhr, status, errorThrown) {
                        console.error('Error:', errorThrown);
                    }
                })

                //Obtener los productos de la requisicion para la factura
                const fol = $('#factura_norequi').val();
                const folio = fol.replace(/\D+/g, '');
                const ord = $('#factura_orden').val();
                const orden_prod = ord.replace(/\D+/g, '');
                $.ajax({
                    url: 'data/getProductosFactura.php',
                    type: 'GET',
                    dataType: 'json',
                    data: { folio: folio, orden_prod: orden_prod },
                    success: function(productos) {
                        const tbody = modal.find('#cuerpoFactura');
                        tbody.empty();

                        let subtotal = 0;

                        productos.forEach(function(p) {
                            const total = p.cantidad * p.precio;
                            subtotal += total;

                            const fila = `
                                <tr>
                                    <td>${p.codigo}</td>
                                    <td><input type="number" class="form-control form-control-sm cantidad" value="${p.cantidad}" min="0"></td>
                                    <td>${p.descripcion}</td>
                                    <td><input type="number" class="form-control form-control-sm precio" value="${parseFloat(p.precio).toFixed(2)}" min="0" step="0.01"></td>
                                    <td class="total">${total.toFixed(2)}</td>
                                </tr>`;
                            tbody.append(fila);
                            // Escuchar cambios en cantidad o precio
                            tbody.find('input.cantidad, input.precio').on('input', function () {
                                const fila = $(this).closest('tr');
                                const cantidad = parseFloat(fila.find('input.cantidad').val()) || 0;
                                const precio = parseFloat(fila.find('input.precio').val()) || 0;
                                const total = cantidad * precio;

                                // Actualizar total por fila
                                fila.find('.total').text(total.toFixed(2));

                                // Recalcular subtotal y total
                                recalcularTotalesDesdeTabla();
                            });

                        });

                        $('#subtotal').val(subtotal.toFixed(2)).trigger('input');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error al cargar productos:', error);
                    }
                });
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#aplicaIva').change(function() {
                if ($(this).is(':checked')) {
                    $('#campoIva').show();
                } else {
                    $('#campoIva').hide();
                    $('#iva').val('0.00');
                    $('#total').val($('#subtotal').val());
                }
                recalcularTotal();
            });
        })
    </script>

    <!-- Modal para agregar datos de factura -->
    <div class="modal fade" id="modalFactura" tabindex="-1" role="dialog" aria-labelledby="modalBorraLabel" aria-hidden="true">
        <div div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

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
                            <div class="col-3 row">
                                <label for="subtotal" class="col-sm-3 col-form-label text-left">Subtotal:</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" id="subtotal" name="subtotal">
                                </div>
                            </div>
                            <div class="col-2 align-items-center justify-content-center d-flex flex-column">
                                <label for="aplicaIva">¿Aplica IVA?</label>
                                <input type="checkbox" id="aplicaIva" name="aplicaIva" checked>
                            </div>
                            <div id="campoIva" class="col-4 row">
                                <!-- <div class="col-4 row"> -->
                                    <label for="iva" class="col-sm-3 col-form-label text-left">IVA:</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="iva" name="iva" readonly>
                                    </div>
                                <!-- </div> -->
                            </div>
                            <div class="col-3 row">
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
        </div>
    </div>

    <script>
         //Recalcular totales despues de haber modificado campos
            function recalcularTotal() {
                const subtotal = parseFloat($('#subtotal').val()) || 0;
                const iva = subtotal * 0.16; // puedes ajustar si el IVA es diferente
                $('#iva').val(iva.toFixed(2));

                const impuestoAdicional = parseFloat($('#valorImpuestoAdicional').val()) || 0;
                const total = subtotal + iva + impuestoAdicional;

                $('#total').val(total.toFixed(2));
            }

        $(document).ready(function() {
            //Si esta activado el checkbox para mostrar el grupo de impuestos adicionales
           $('#toggleImpuesto').change(function () {
                if ($(this).is(':checked')) {
                    $('#grupoImpuestoAdicional').slideDown();
                } else {
                    $('#grupoImpuestoAdicional').slideUp();
                    $('#resultadoImpuesto').slideUp();
                    $('#nombreImpuestoAdicional').val('');
                    $('#porcentajeImpuestoAdicional').val('');
                    recalcularTotal(); // limpia impacto del impuesto
                }
            });

             // Evento del botón Agregar Impuesto
            $('#grupoImpuestoAdicional button').click(function (e) {
                e.preventDefault();

                const nombre = $('#nombreImpuestoAdicional').val().trim();
                const porcentaje = parseFloat($('#porcentajeImpuestoAdicional').val());
                const subtotal = parseFloat($('#subtotal').val()) || 0;

                if (!nombre || isNaN(porcentaje)) {
                    alert('Completa nombre y porcentaje del impuesto.');
                    return;
                }

                const valorImpuesto = subtotal * (porcentaje / 100);
                const total = subtotal + valorImpuesto;

                $('#etiquetaImpuestoAdicional').text(`${nombre} (${porcentaje}%)`);
                $('#valorImpuestoAdicional').val(valorImpuesto.toFixed(2));
                $('#resultadoImpuesto').slideDown();

                recalcularTotal(); // recalcula total final
            });

            // Recalcular total con o sin impuesto
            $('#subtotal').on('input', function () {
                recalcularTotal();
            });
            //Eliminar el impuesto adicional de la tabla
            $('#eliminarImpuestoAdicional').click(function () {
                $('#resultadoImpuesto').slideUp();
                $('#valorImpuestoAdicional').val('');
                $('#etiquetaImpuestoAdicional').text('');
                $('#nombreImpuestoAdicional').val('');
                $('#porcentajeImpuestoAdicional').val('');
                $('#toggleImpuesto').prop('checked', false);
                $('#grupoImpuestoAdicional').slideUp();
                recalcularTotal();
            });

            //Al dar click en el boton guardar, valida los datos del formulario y envía los datos al servidor
            $('#guardarFactura').click(function (e) {
                e.preventDefault();
                //Recorre las filas de la tabla de productos para agregarlos al array de datos
                const productos = [];

                $('#cuerpoFactura tr').each(function () {
                    const fila = $(this);
                    const codigo = fila.find('td').eq(0).text().trim();
                    const cantidad = parseFloat(fila.find('input.cantidad').val()) || 0;
                    const descripcion = fila.find('td').eq(2).text().trim();
                    const precio = parseFloat(fila.find('input.precio').val()) || 0;
                    const total = cantidad * precio;

                    productos.push({
                        codigo,
                        descripcion,
                        cantidad,
                        precio,
                        total
                    });
                });
                // Valida los datos del formulario
                const no_requisicion = $('#factura_norequi').val();
                const no_orden = $('#factura_orden').val();
                const folio = no_requisicion.replace(/\D+/g, '');
                const orden = no_orden.replace(/\D+/g, '');
                const no_factura = $('#no_factura').val();
                const fecha_factura = $('#fecha').val();
                const fecha_pago = $('#fecha_pago').val();
                const proveedor = $('#proveedor').val();
                const subtotal = parseFloat($('#subtotal').val()) || 0;
                const iva = parseFloat($('#iva').val()) || 0;
                const total = parseFloat($('#total').val()) || 0;
                const impuestoAdicional = $('#nombreImpuestoAdicional').val();
                const valorImpuestoAdicional = parseFloat($('#porcentajeImpuestoAdicional').val()) || 0;
                const url = 'data/guardarFactura.php';
                //Llamada ajax para insertar en la base d edatos
                $.ajax({
                    url,
                    method: 'POST',
                    data: {
                        no_requisicion,
                        folio,
                        no_orden,
                        orden,
                        no_factura,
                        fecha_factura,
                        fecha_pago,
                        proveedor,
                        subtotal,
                        iva,
                        total,
                        impuestoAdicional,
                        valorImpuestoAdicional,
                        productos: JSON.stringify(productos) //convierte el array de productos a JSON
                    },
                    success: function (response) {
                        // Procesa la respuesta del servidor y muestra el resultado al usuario
                        try {
                            const res = typeof response === 'string' ? JSON.parse(response) : response;

                            if (res.status === "success") {
                                Swal.fire({
                                    title: 'Factura Guardada!',
                                    text: res.message,
                                    icon:'success',
                                    confirmButtonText: 'Aceptar'
                                })
                                $('#modalFactura').modal('hide');
                                window.location.reload();
                            } else {
                                Swal.fire({
                                    title: 'Error',
                                    text: res.message,
                                    icon: 'error',
                                    confirmButtonText: 'Aceptar'
                                })
                            }
                        } catch (err) {
                            console.error('Error al parsear respuesta:', err);
                            Swal.fire('Error', 'Respuesta inesperada del servidor.', 'error');
                        }
                    },
                    error: function (xhr, status, error) {

                        console.error('Error al guardar la factura:', xhr.responseText);
                        Swal.fire({
                            title: 'Error al guardar la factura',
                            text: 'Hubo un error al guardar la factura. Intente nuevamente.',
                            icon: 'error',
                            confirmButtonText: 'Aceptar'
                        })
                    }
                })
            })
        });
    </script>

    <script>
        //Refrescar la sesion
        document.addEventListener("DOMContentLoaded", () => {
            const intervalo = 5000; // 5 segundos

            setInterval(() => {
                fetch('./refrescar.php', { cache: 'no-store' }) // evita usar caché
                .catch((err) => {
                    console.warn('⚠️ Error al hacer la petición de refresco:', err);
                });
            }, intervalo);
        });
    </script>
</body>
</html>
