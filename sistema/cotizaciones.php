<?php 
include("../conexion.php");
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../index.php");
    exit();
}
// var_dump($_SESSION);

$user = $_SESSION["user"];
$rol = $_SESSION["rol"];
$id_user = $_SESSION["idUser"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRANSVIVE | ERP</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>

<!-- Google Fonts -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Font Awesome -->
<!-- Font Awesome 5 Free -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />


<!-- jQuery UI -->
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

<!-- DataTables + Buttons (actualizado a 2025) -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap4.min.css">


<!-- Bootstrap Datepicker (actualizado) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css">

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/i18n/jquery-ui-i18n.min.js"></script>
<script>
  $.datepicker.setDefaults($.datepicker.regional['es']);
</script> -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- DataTables + Buttons (JS actualizados) -->
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

<!-- Bootstrap Datepicker -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/locales/bootstrap-datepicker.es.min.js"></script>


<!-- Bootbox (para modales) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>

</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">
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
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <h4 class="m-0">Listado de Solicitud de Cotizaciones <small><i class="fas fa-file"></i></small></h4>
                        </div>
                        <div class="col-sm-6 d-none d-sm-block">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item">
                                    <a href="new_solicitud_cotizacion.php"><i class="fas fa-plus text-success"></i>&nbsp;&nbsp;Nueva</a>
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
                            <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <!-- <th class="text-center">Id</th> -->
                                        <th class="text-center">No. Solicitud</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">No. Requisicion</th>
                                        <th class="text-center">Fecha Requisicion</th>
                                        <th class="text-center">Área Solicitante</th>
                                        <th class="text-center">Observaciones</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Acciónes</th>
                                    </tr>
                                </thead>
                            </table>                            
                        </div>
                    </div>
                </div>
            </section>
        </div>
        
        <!-- Footer -->
        <footer class="main-footer">
            <?php include "includes/footer.php"; ?>
        </footer>
    </div>
    <!-- DataTables Buttons -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>

<!-- JSZip (para exportar a Excel) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- pdfmake (para exportar a PDF) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

<!-- Botones HTML5 y Print -->
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

<!-- DataTables Bootstrap 4 (si usas Bootstrap 4) -->
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>

<!-- Bootstrap Datepicker -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script> -->

<!-- Sweet alert 2 (para alertas) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
