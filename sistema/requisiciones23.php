<?php

include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
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
<!-- Font Awesome 5 Free -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.1/i18n/jquery.ui.datepicker-es.min.js"></script>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>

<!-- Bootbox (para modales) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>

<!-- RequireJS -->
<!-- <script src="./js/require.min.js"></script>
<script>
  requirejs.config({ baseUrl: '.' });
</script> -->

<!-- Estilos personalizados -->
<style>
  th { font-size: 12px; font-weight: bold; }
  td { font-size: 13px; }
  .dt-folio { text-transform: uppercase !important; }
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
                                <!-- <li class="breadcrumb-item">
                                    <a href="factura/requisiciones_excel.php"><i class="fas fa-file-excel"></i> Excel</a>
                                </li>
                                <li class="breadcrumb-item"><a href="#">Home</a></li> -->
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

                            <!-- Tabla -->
                            <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Id</th>
                                        <th class="text-center">No. Requisición</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Fecha Requiere Material</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">Área Solicitante</th>
                                        <th class="text-center">Monto</th>
                                        <th class="text-center">Observaciones</th>
                                        <th class="text-center">Estatus</th>
                                        <th class="text-center">Acción</th>
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

    <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Aquí podrías colocar tabs si los necesitas -->
                <div class="tab-content">
                    <div class="tab-pane" id="control-sidebar-home-tab"></div>
                </div>
        </aside>
    
        <div class="control-sidebar-bg"></div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js"></script>

<!-- Sweet alert 2 (para alertas) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">

        $(document).ready(function () {
        // Carga inicial
            load_data();

            function load_data(initial_date = '', final_date = '', gender = '') {
                const ajax_url = "data/datadetorders_req.php";

                $('#fetch_generated_wills').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    responsive: true,
                    order: [[0, "desc"]],
                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, "Todos"]
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        'copyHtml5',
                        {
                            text: 'Excel',
                            action: function () {

                                // Redirige a un PHP que genera el Excel completo
                                const url = `factura/requis_excel.php`;
                                window.open(url, '_blank');
                            }
                        },
                        'csvHtml5',
                        {
                        extend: 'colvis',
                        postfixButtons: ['colvisRestore'],
                        columns: '0,1,2,3,4,5,6'
                        },
                        'pageLength'
                    ],
                    ajax: {
                        url: ajax_url,
                        type: "POST",
                        dataType: "json",
                        data: {
                            action: "fetch_users",
                            initial_date,
                            final_date,
                            gender
                        },
                        dataSrc: function (json) {
                            console.log("📦 Respuesta recibida:", json);
                            return json.records || [];
                        }
                    },
                    columns: [
                        { data: "pedidono", width: "3%", className: "text-right" },
                        {
                            data: "Folio",
                            width: "3%",
                            className: "text-right",
                            render: data => 'req-' + data
                        },
                        { data: "fechaa", width: "8%", className: "text-center" },
                        { data: "fecha_req", width: "10%", className: "text-center", orderable: false },
                        { data: "tipor", width: "5%", orderable: false },
                        { data: "arear", width: "10%", orderable: false },
                        {
                            data: "monto",
                            width: "6%",
                            className: "text-right",
                            orderable: false,
                            render: $.fn.dataTable.render.number(',', '.', 2)
                        },
                        { data: "notas", width: "27%", orderable: false },
                        { data: "estatusped", width: "8%", orderable: false },
                        {
                            orderable: false,
                            render: function (data, type, full) {
                                let actions = ""
                                //Si el estado de la requisicion es activa
                                if (full.estatus == 1) {
                                    //Si el usuario es Raul o Itzu
                                     <?php
                                        if ($idUser == 17 || $idUser == 3) {
                                    ?>
                                    actions =
                                        `
                                        <a href='factura/requisicion.php?id=${full.Folio}' target='_blank'>
                                            <i class='fa fa-print" style="font-size: 1.3em;'></i> Imprimir
                                        </a>
                                        
                                        |
                                        <a href="javascript:void(0)" data-toggle="modal" data-target="#modalAutorizaRequisicion" 
                                            data-id="${full.Folio}" data-date="${full.fecha_req}" data-name="${full.tipor}">
                                            <i class="fa fa-thumbs-up" style="font-size:1.3em;"></i> Autorizar
                                        </a> 
                                        `
                                        //Si el rol de usuario es compras o administrador
                                    <?php
                                        }else if($rol == 16 || $rol == 1 || $rol == 7 || $idUser == 19) {
                                    ?>
                                        actions = 
                                            `<a class="link_edit text-primary" href="edit_cotizacioncompra.php?id=${full.pedidono}">
                                                <i class="far fa-edit" style="font-size:1.3em;"></i>
                                            </a> |
                                            <a href="factura/requisicion.php?id=${full.Folio}" target="_blank">
                                                <i class="fa fa-print" style="font-size:1.3em;"></i>
                                            </a> |
                                            <a data-toggle="modal" data-target="#modalCancela" data-id="${full.Folio}" data-date="${full.fecha_req}" data-name="${full.arear}" href="javascript:void(0)" class="text-warning">
                                                <i class="fa fa-ban" style="font-size:1.3em;"></i>
                                            </a> |
                                            <a data-toggle="modal" data-target="#modalBorra" data-id="${full.Folio}" data-name="${full.arear}" href="javascript:void(0)" class="link_delete text-danger">
                                                <i class="fa fa-trash" style="font-size:1.3em;"></i>
                                            </a>
                                            `;
                                            //El resto de los usuarios
                                        <?php
                                            }else {
                                        ?>
                                        actions = 
                                            `
                                                <a href="factura/requisicion.php?id=${full.Folio}" target="_blank">
                                                    <i class="fa fa-print" style="font-size: 1.3em;"></i>
                                                </a>
                                            `;
                                <?php
                                    }
                                ?>
                                //Si la requisicion esta autorizada
                                }else if (full.estatus == 2) {
                                    //Si el rol de usuario es compras o administrador
                                    <?php
                                        if ($rol == 16 || $rol == 1 || $rol == 7 || $idUser == 19) {
                                    ?>
                                    actions = `
                                        <a href="factura/requisicion.php?id=${full.Folio}" target="_blank">
                                            <i class="fa fa-print" style="font-size:1.3em;"></i>
                                        </a> |
                                        <a href="new_orden_compra.php?req=${full.Folio}" class="text-success">
                                            <i class="fa fa-clipboard" style="font-size:1.3em;"></i>
                                        </a> |
                                        <a data-toggle="modal" data-target="#modalCancela" data-id="${full.Folio}" data-date="${full.fecha_req}" data-name="${full.arear}" href="javascript:void(0)" class="text-warning">
                                            <i class="fa fa-ban" style="font-size:1.3em;"></i>
                                        </a>  | 
                                         <a data-toggle="modal" data-target="#modalFactura" data-id="${full.Folio}" href="javascript:void(0)" class="text-primary">
                                            <i class="fa fa-file" style="font-size:1.3em;"></i>
                                        </a> 
                                    `;
                                    //El resto de los usuarios
                                <?php
                                    } else {
                                ?>
                                   actions = `
                                        <a href="factura/requisicion.php?id=${full.Folio}" target="_blank">
                                            <i class="fa fa-print" style="font-size:1.3em;"></i>
                                        </a>
                                        `;
                                    <?php
                                        }
                                    ?>
                                    //Facturado
                                } else if (full.estatus == 4) {
                                    actions = `
                                        <a href="factura/requisicion.php?id=${full.Folio}" target="_blank">
                                            <i class="fa fa-print" style="font-size:1.3em;"></i>
                                        </a>
                                        |
                                        <a href="" data-toggle="modal" data-target="#subirFactura" data-id="${full.Folio}" href="javascript:void(0)" class="text-primary">
                                            <i class="fa fa-upload" style="font-size:1.3em;"></i> 
                                        </a>
                                    `
                                }else if(full.estatus == 5) {
                                    actions = `
                                        <a href="factura/requisicion.php?id=${full.Folio}" target="_blank">
                                            <i class="fa fa-print" style="font-size:1.3em;">R</i>
                                        </a>
                                        |
                                        <a href="verfactura.php?id=${full.Folio}" target="_blank" class="text-orange">
                                            <i class="fa fa-print" style="font-size:1.3em;">F</i>
                                        </a> 
                                        `;
                                    
                                }
                                return actions;
                            }
                        }
                    ],
                    language: {
                        url: "https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json",
                        emptyTable: "No hay datos disponibles"
                    }
                });
            }

            // Filtro por fecha y estatus
            $("#filter").on("click", function () {
                const initial_date = $("#initial_date").val();
                const final_date = $("#final_date").val();
                const gender = $("#gender").val();

                if (!initial_date || !final_date) {
                    $("#error_log").html("⚠️ Debes seleccionar ambas fechas.");
                    return;
                }

                const date1 = new Date(initial_date);
                const date2 = new Date(final_date);

                if (date1 > date2) {
                    $("#error_log").html("⚠️ La fecha final debe ser posterior a la inicial.");
                    return;
                }

                $("#error_log").html("");
                load_data(initial_date, final_date, gender);
            });

            // Inicialización del datepicker
            $(".datepicker").datepicker({
                language: 'es',
                dateFormat: "yy-mm-dd",
                changeYear: true
            });
        });
    </script>
    
    <script>
        function actualizarLaPagina(){
            window.location.reload();
        } 
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
                            <label class="col-sm-4 col-form-label text-left">No. Requisición:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="fact_noreq" name="form_pass_noreq" disabled>
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
                const noreq = button.data('id')
                const modal = $(this);
                //Insertar valores en el modal Subir Factura
                modal.find('#fact_noreq').val(noreq)
            })
        })
    </script>

    <script>
        $(document).ready(function () {
            $('#form_subir_factura').on('click', function (event) {
                event.preventDefault();

                const formData = new FormData();
                formData.append('form_pass_noreq', $('#fact_noreq').val());
                formData.append('form_pass_datereq', $('#fact_date_req').val());

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
                            // actualizarLaPagina(); // Si tienes esta función definida
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
                success: function (response) {
                    try {
                        if (response && response !== 'error') {
                            const info = JSON.parse(response);
                            if (info.success) {
                                $('#modalAutorizaRequisicion').modal('hide');
                                $('#form_pass_firma').val('');

                                Swal.fire({
                                    icon: 'success',
                                    title: 'Autorizado',
                                    text: info.mensaje,
                                    timer: 2000,
                                    showConfirmButton: false
                                }).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: info.mensaje
                                });
                            }
                        } else {
                            // Error genérico
                            Swal.fire({
                                icon: 'info',
                                title: 'Faltan datos',
                                text: 'Verifica los campos y vuelve a intentar.'
                            });
                        }
                    } catch (err) {
                        console.error('Error al parsear respuesta:', err, response);
                        Swal.fire({
                            icon: 'error',
                            title: 'Respuesta inesperada',
                            text: 'No se pudo procesar la respuesta del servidor.'
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
            });
        });
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
        $(document).ready(function() {
            //Variables del modal factura
            $('#modalFactura').on('show.bs.modal', function (event) {
                const data = $(event.relatedTarget);
                const noreq = `REQ-${data.data().id}`;
                
                const modal = $(this);

                modal.find('#factura_norequi').val(noreq);
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
                console.log('Folio:', folio);
                $.ajax({
                    url: 'data/getProductosFactura.php',
                    type: 'GET',
                    dataType: 'json',
                    data: { folio: folio },
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
                                <label for="factura_norequi" class="col-sm-6 col-form-label text-left">No. Requisición:</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control" id="factura_norequi" name="factura_norequi" readonly>
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
        </div>
    </div>

    <script>
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

            //Recalcular totales despues de haber modificado campos
            function recalcularTotal() {
                const subtotal = parseFloat($('#subtotal').val()) || 0;
                const iva = subtotal * 0.16; // puedes ajustar si el IVA es diferente
                $('#iva').val(iva.toFixed(2));

                const impuestoAdicional = parseFloat($('#valorImpuestoAdicional').val()) || 0;
                const total = subtotal + iva + impuestoAdicional;

                $('#total').val(total.toFixed(2));
            }

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
                const folio = no_requisicion.replace(/\D+/g, '');
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
