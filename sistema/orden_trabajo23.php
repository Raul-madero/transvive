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
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TRANSVIVE | ERP</title>
        <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
        <!-- Google Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=swap">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <!-- AdminLTE -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
        <!-- Select2 -->
        <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
        <!-- Ekko Lightbox -->
        <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- jQuery UI -->
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <!-- DataTables Bootstrap 4 -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- jQuery UI -->
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.1/i18n/jquery.ui.datepicker-es.min.js" crossorigin="anonymous"></script>
        <!-- Bootstrap -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables Core + Bootstrap 4 -->
        <script src="./js/jquery.dataTables.min.js"></script>
        <script src="./js/dataTables.bootstrap4.min.js"></script>
        <!-- RequireJS (si realmente lo usas) -->
        <!-- <script src="./js/require.min.js"></script> -->
        <script>
            // requirejs.config({
            // baseUrl: '.'
            // });
        </script>

        <style>
            th { font-size: 12px; font-weight: bold; }
            td { font-size: 13px; }
        </style>
    </head>

    <body class="hold-transition layout-top-nav">
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
                <div class="container">
                    <a href="salir.php" class="navbar-brand">
                        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE CRM"></span>
                    </a>

                    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <?php include('includes/generalnavbar.php')?>
                    <?php include('includes/nav.php') ?> 
                </div> <!-- Container -->
            </nav> <!-- Navbar -->
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4 class="m-0"> Listado de Orden de Trabajo Mantenimiento <small><i class="fas fa-wrench"></i></small></h4>
                            </div>
                            <div class="col-sm-6 d-none d-sm-block">
                                <ol class="breadcrumb float-sm-right">
                    
                                    <li class="breadcrumb-item"><a href="new_solicitudmantto.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nueva</a></li>
                                    <li class="breadcrumb-item"><a href="factura/orden_trabajoexcel.php"><i class="fas fa-file-excel"></i> Excel</a></li>
                
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-primary card-outline">
                                <div class="col-md-12">
                                    <div class="card">      
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <input type='text' readonly name='initial_date' id='initial_date' class="datepicker" placeholder='De Fecha'>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <input type='text' readonly name='final_date' id='final_date' class="datepicker" placeholder='A Fecha'>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <select class="form-control" name='gender' id='gender'>
                                                            <option value="">Estatus</option>
                                                            <option value="Activa">Activa</option>
                                                            <option value="Cerrada">Cerrada</option>
                                                            <option value="Cancelada">Cancelada</option>
                                                        </select>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <button class="btn btn-success btn-block" type="submit" name="filter" id="filter" >
                                                            <i class="fa fa-filter"></i> Filtro
                                                        </button>
                                                    </td>
                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                                    <td>
                                                        <button class="btn btn-info btn-block" onClick="actualizarLaPagina()" >
                                                            <i class="fa fa-refresh"></i> 
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>   
                
                                            <br>
                
                                            <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th style="text-align: center; font-size: 12px;">ID</th>
                                                        <th style="text-align: center; font-size: 12px;">No. Orden</th>
                                                        <th style="text-align: center; font-size: 12px;">Fecha</th>
                                                        <th style="text-align: center; font-size: 12px;">Unidad</th>
                                                        <th style="text-align: center; font-size: 12px;">Solicitado por</th>
                                                        <th style="text-align: center; font-size: 12px;">Tipo de Trabajo</th>
                                                        <th style="text-align: center; font-size: 12px;">Tipo Mantenimiento</th>
                                                        <th style="text-align: center; font-size: 12px;">Trabajo Solicitado</th>
                                                        <th style="text-align: center; font-size: 12px;">Estatus</th>
                                                        <th style="text-align: center; font-size: 12px;">Accion</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                    <!-- /.box -->
                                </div>
                                <!-- /.col -->
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <?php include "includes/footer.php"; ?>
            </footer>
        </div>
        <!-- page script -->
        <!-- DataTables Buttons + Export -->
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
        <!-- Bootstrap Datepicker (opcional si usas datepickers visuales) -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
        <!-- Select2 -->
        <script src="../plugins/select2/js/select2.full.min.js"></script>
        <!-- AdminLTE & overlayScrollbars -->
        <script src="../dist/js/adminlte.min.js"></script>
        <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>

 
        <script type="text/javascript">

            load_data(); // first load

            function load_data(initial_date, final_date, gender){
                var ajax_url = "data/datadetorders_mantto.php";
                $('#fetch_generated_wills').DataTable({
                    "order": [[ 0, "desc" ]],
                    dom: 'Bfrtip',
                    lengthMenu: [
                        [20, 25, 50, -1],
                        ['20 rows', '25 rows', '50 rows', 'Show all']
                    ],
                    buttons: [
                        'excelHtml5',
                        'pageLength'
                    ],
                    "processing": true,
                    "serverSide": true,
                    "stateSave": true,
                    "responsive": true,
                    "lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
                    "ajax" : {
                        "url" : ajax_url,
                        "dataType": "json",
                        "type": "POST",
                        "data" : { 
                            "action" : "fetch_users", 
                            "initial_date" : initial_date, 
                            "final_date" : final_date,
                            "gender" : gender 
                        },
                        "dataSrc": "records"
                    },
                    "columns": [
                        { "data" : "pedidono", "width": "3%", className: "text-right" },
                        { "data" : "noorden", "width": "5%" },
                        { "data" : "fechaa", "width": "5%", className: "text-right", "orderable": false},
                        { "data" : "unidad", "width": "5%", "orderable": false},
                        { "data" : "solicita", "width": "18%", "orderable":false },
                        { "data" : "tipojob", "width": "12%", "orderable":false },
                        { "data" : "tipomantto", "width": "8%" },
                        { "data" : "trabsolicitado", "width": "12%" },
                        { "data" : "estatusped", "width": "8%", "orderable":false }
                    
                        <?php 
                            if ($_SESSION['idUser'] == 19 || $_SESSION['idUser'] == 32 ) { ?>
                                ,{
                                    "render": function ( data, type, full, meta ) {
                                         return '<a class="link_edit" style="color:#007bff;" href= \'edit_solicitudmantto.php?id=' + full.pedidono +  '\' title="Editar Orden d eMantenimiento"><i class="far fa-edit"></i> Editar</a> | <a href= \'factura/form_ordenmantto.php?id=' + full.noorden + '\'  target="_blank"><i class="fa fa-print" style="color:#white; font-size: 1.3em" title="Imprimir Orden de Mantenimiento"></i> Print</a> | <a data-toggle="modal" data-target="#modalCancelaOrden"  data-id=\'' + full.pedidono +  '\' data-name=\'' + full.noorden +  '\' href="javascript:void(0)" class="link_delete" style="color:red" title="Cancelar Orden de Mantenimiento"><i class="fa fa-ban"></i> Cancelar</a> | <a href="#" id="iniciar_orden" data-id="' + full.pedidono + '" class="text-success " title="Iniciar Orden de Mantenimiento"> <i class="fa-solid fa-wrench"></i> Iniciar</a>';
                                    }       
                                } 

                            <?php } else if($_SESSION['idUser'] == 19 || $_SESSION['idUser'] == 32 || $_SESSION['idUser'] == 12) { ?>
                                ,{
                                    "render": function ( data, type, full, meta ) {
                                        return '<a class="link_edit" style="color:#007bff;" href= \'edit_solicitudmantto.php?id=' + full.pedidono +  '\' title="Editar Orden de Mantenimiento"><i class="far fa-edit"></i> Editar</a> | <a href= \'factura/form_ordenmantto.php?id=' + full.noorden + '\'  target="_blank" title="Imprimir Orden de Mantenimiento"><i class="fa fa-print" style="color:#white; font-size: 1.3em"></i> Print</a> | <a href="#" id="iniciar_orden" data-id="' + full.pedidono + '" class="text-success" title="Iniciar Orden de Mantenimiento"> <i class="fa-solid fa-wrench"></i>Inicio</a>'
                                    }
                                }
                            <?php } else { ?>
                                ,{
                                    "render": function ( data, type, full, meta ) {
                                         return '<a class="link_edit" style="color:#007bff;" href= \'edit_solicitudmantto.php?id=' + full.pedidono +  '\' title="Editar Orden de Mantenimiento"><i class="far fa-edit"></i> Editar</a> | <a href= \'factura/form_ordenmantto.php?id=' + full.noorden + '\'  target="_blank" title="Imprimir Orden de Mantenimiento"><i class="fa fa-print" style="color:#white; font-size: 1.3em"></i> Print</a>'
                                    }
                                }
                        <?php }?>       
                    ],
                    "sDom": "B<'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-4'i>><'row'p>B",
                    "buttons": [
                        'copyHtml5',
                        'excelHtml5',
                        'csvHtml5'
                    ],
                }); 
            }  

            $("#filter").click(function(){
                var initial_date = $("#initial_date").val();
                var final_date = $("#final_date").val();
                var gender = $("#gender").val();

                if(initial_date == '' && final_date == ''){
                    $('#fetch_generated_wills').DataTable().destroy();
                    load_data("", "", gender); // filter immortalize only
                }else{
                    var date1 = new Date(initial_date);
                    var date2 = new Date(final_date);
                    var diffTime = Math.abs(date2 - date1);
                    var diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 

                    if(initial_date == '' || final_date == ''){
                        $("#error_log").html("Warning: You must select both (start and end) date.</span>");
                    }else{
                        if(date1 > date2){
                            $("#error_log").html("Warning: End date should be greater then start date.");
                        }else{
                            $("#error_log").html(""); 
                            $('#fetch_generated_wills').DataTable().destroy();
                            load_data(initial_date, final_date, gender);
                        }
                    }
                }
            });
        </script>

        <script>
            $(document).on('click', '#iniciar_orden', function(e) {
                e.preventDefault();
                const ordenId = $(this).data('id');

                Swal.fire({
                    title: '¿Iniciar orden?',
                    text: '¿Deseas marcar esta orden como EN PROCESO?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, iniciar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: 'data/iniciarorden.php',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                action: 'iniciarOrden',
                                id: ordenId
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire('Orden iniciada', response.message, 'success');
                                    // Actualizar tabla o vista
                                    actualizarLaPagina(); // o recargar tabla
                                } else {
                                    Swal.fire('Error', response.message || 'No se pudo iniciar la orden.', 'error');
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                                Swal.fire('Error', 'Error de conexión con el servidor.', 'error');
                            }
                        });
                    }
                });
            });
        </script>

        <script>
            function actualizarLaPagina(){
                window.location.reload();
            } 
        </script>

        <script> 
            $(document).ready(function (e) {
                $('#modalCancelaOrden').on('show.bs.modal', function(e) { 

                    var idi    = $(e.relatedTarget).data().id;
                    var no_orden  = $(e.relatedTarget).data().name;
                    console.log(idi);
                    console.log
                    $(e.currentTarget).find('#form_pass_idc').val(idi);
                    $(e.currentTarget).find('#form_pass_noorden').val(no_orden);
                });
            });
        </script>
  
        <div class="modal fade" id="modalCancelaOrden"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Cancelar Solicitud</h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="col-md-12">
                                <div class="form-group"> 
                                    <input type="hidden" class="form-control" id="form_pass_idc" name="form_pass_idc">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">No. Orden:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="form_pass_noorden" name="form_pass_noorden" >
                                </div>
                            </div>  
    
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                <button type="button" class="btn btn-success pull-right" href="#" id="cancelaOrden"><i class="fa fa-save"></i>&nbsp;Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 
        </div>

        <script>
            $('#cancelaOrden').click(function(e) {
                e.preventDefault();
                var idc     = $('#form_pass_idc').val();
                var noorden = $('#form_pass_noorden').val();
                var action  = 'BajaSolicitud';

                $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async: true,
                    data: { action: action, idc: idc, noorden: noorden },
                    success: function(response) {
                    try {
                        var info = JSON.parse(response);
                        if (info.success === true) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Cancelado',
                            text: 'Registro cancelado exitosamente',
                            confirmButtonColor: '#3085d6'
                        }).then(() => {
                            $('#modalCancelaOrden').modal('hide');
                            location.reload(true);
                        });
                        } else {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Error',
                            text: info.message || 'Error al cancelar el registro',
                            confirmButtonColor: '#d33'
                        }).then(() => {
                            $('#modalCancelaOrden').modal('hide');
                        });
                        }
                    } catch (err) {
                        console.error('Error parseando JSON:', err, response);
                        Swal.fire({
                        icon: 'error',
                        title: 'Error inesperado',
                        text: 'No se pudo interpretar la respuesta del servidor'
                        });
                    }
                    },
                    error: function(xhr, status, error) {
                    console.error('Error Ajax:', status, error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de red',
                        text: 'Hubo un problema al comunicar con el servidor'
                    });
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
