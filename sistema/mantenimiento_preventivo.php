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
        <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
        <link href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" rel="stylesheet" type="text/css">
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
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.1/i18n/jquery.ui.datepicker-es.min.js" crossorigin="anonymous"></script>
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
        <script src="./js/jquery.dataTables.min.js"></script>
        <script src="./js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
        <style type="text/css">
            th { font-size: 12px; font-weight:bold; }
            td { font-size: 13px; }
        </style>
    <!-- Dashboard Core -->
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
                                <h4 class="m-0"> Listado de O. de Trabajo Mantenimiento Preventivo <small><i class="fas fa-wrench"></i></small></h4>
                            </div>
                            <div class="col-sm-6 d-none d-sm-block">
                                <ol class="breadcrumb float-sm-right">
            
                                    <li class="breadcrumb-item"><a href="new_manttopreventivo.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nueva</a></li>
                                    <li class="breadcrumb-item"><a href="factura/orden_mpreventivoexcel.php"><i class="fas fa-file-excel"></i> Excel</a></li>
         
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
             
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Main content -->
                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
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
                                                <div class="row mx-auto">
                                                    <div class="mb-3 font-weight-bold col-2 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto">
                                                        <span id="activas" class="badge bg-primary"></span>
                                                    </div>
                                                    <div class="mb-3 font-weight-bold col-2 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto">
                                                        <span id="cerradas" class="badge bg-success"></span>
                                                    </div>
                                                    <div class="mb-3 font-weight-bold col-2 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto">
                                                        <span id="canceladas" class="badge bg-danger"></span>
                                                    </div>
                                                    <div class="mb-3 font-weight-bold col-2 text-center border border-3 border-primary bg-light rounded-pill p-2 text-dark mx-auto">
                                                        <span id="total" class="badge bg-secondary"></span>
                                                    </div>
                                                </div>
           
                                                <table id="fetch_generated_wills" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                                    <thead>
                                                        <tr>
                                                            <th style="text-align: center; font-size: 12px;">ID</th>
                                                            <th style="text-align: center; font-size: 12px;">No. Orden</th>
                                                            <th style="text-align: center; font-size: 12px;">Fecha</th>
                                                            <th style="text-align: center; font-size: 12px;">Hora</th>
                                                            <th style="text-align: center; font-size: 12px;">Unidad</th>
                                                            <th style="text-align: center; font-size: 12px;">Solicitado por</th>
                                                            <th style="text-align: center; font-size: 12px;">Tipo de Trabajo</th>
                                                            <th style="text-align: center; font-size: 12px;">Kilometraje</th>
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
                                <!-- /.row -->
                            </div>
                        </div>
                    </section>
                            <!-- /.content -->
                </div>
                    <!-- /.content-wrapper -->
                <footer class="main-footer">
                    <?php include "includes/footer.php"; ?>
                </footer>
            </div>
        </di>
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

        $(document).ready(function () {

            function load_data(initial_date = '', final_date = '', gender = '') {
                $('#fetch_generated_wills').DataTable({
                    destroy: true,
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    stateSave: true,
                    order: [[0, "desc"]],
                    dom: 'Bfrtip',
                    buttons: ['copyHtml5', 'excelHtml5', 'csvHtml5', 'pageLength'],
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Todos"]],
                    ajax: {
                        url: 'data/datadetorders_mpreventivo.php',
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            action: 'fetch_users',
                            initial_date: initial_date,
                            final_date: final_date,
                            gender: gender
                        },
                        dataSrc: function (json) {
                            // Actualizar los contadores
                            $('#activas').text("Activas: " + json.estatus_counts.activa);
                            $('#cerradas').text("Cerradas: " + json.estatus_counts.cerrada);
                            $('#canceladas').text("Canceladas: " + json.estatus_counts.cancelada);
                            $('#total').text("Totales: " + json.recordsTotal);
                            return json.records;
                        }
                    },
                    columns: [
                        { data: 'pedidono', className: 'text-right', width: "3%" },
                        { data: 'noorden', width: "5%" },
                        { data: 'fechaa', className: 'text-right', width: "5%" },
                        { data: 'horaa', className: 'text-right', width: "5%" },
                        { data: 'unidad', width: "5%" },
                        { data: 'solicita', width: "25%" },
                        { data: 'tipojob', width: "12%" },
                        { data: 'kilometraje', className: 'text-right', render: $.fn.dataTable.render.number(',', '.', 2), width: "8%" },
                        { data: 'estatusped', width: "8%" },
                        {
                            data: null,
                            orderable: false,
                            render: function (data, type, full) {
                                let html = `<a class="link_edit" href='edit_manttopreventivo.php?id=${full.pedidono}'><i class="far fa-edit"></i> Editar</a>`;
                                html += ` | <a href='factura/form_ordenmttopreventivo.php?id=${full.noorden}' target="_blank"><i class="fa fa-print"></i> Print</a>`;
                                <?php if ($rol == 10 || $User == 'MIRILG') { ?>
                                    html += ` | <a href="javascript:void(0)" class="link_delete text-danger" data-id='${full.pedidono}' data-name='${full.noorden}' data-toggle="modal" data-target="#modalEditcliente"><i class="fa fa-ban"></i> Cancelar</a>`;
                                <?php } ?>
                                return html;
                            }
                        }
                    ]
                });
            }

            load_data(); // Carga inicial sin filtros

            $('#filter').on('click', function () {
                let initial_date = $('#initial_date').val();
                let final_date = $('#final_date').val();
                let gender = $('#gender').val();

                if (!initial_date && !final_date) {
                    load_data('', '', gender);
                    $('#error_log').html('');
                } else if (!initial_date || !final_date) {
                    $('#error_log').html('Debes seleccionar fecha inicial y final.');
                } else if (new Date(initial_date) > new Date(final_date)) {
                    $('#error_log').html('La fecha final debe ser mayor o igual a la inicial.');
                } else {
                    $('#error_log').html('');
                    load_data(initial_date, final_date, gender);
                }
            });

            $('.datepicker').datepicker({
                language: 'es',
                dateFormat: 'yy-mm-dd',
                changeYear: true
            });

            $('#modalEditcliente').on('show.bs.modal', function (e) {
                let button = $(e.relatedTarget);
                $(this).find('#form_pass_idc').val(button.data('id'));
                $(this).find('#form_pass_noorden').val(button.data('name'));
            });

            $('#actualizaclientes').click(function (e) {
                e.preventDefault();
                $.ajax({
                    url: 'includes/ajax.php',
                    type: 'POST',
                    data: {
                        action: 'BajaSolicitudPreventivo',
                        idc: $('#form_pass_idc').val(),
                        noorden: $('#form_pass_noorden').val()
                    },
                    success: function (response) {
                        if (response === 'success') {
                            swal('Cancelado', 'Registrado Cancelado', 'success').then(() => location.reload());
                        } else {
                            swal('Error', 'Error al Cancelar Registro', 'warning').then(() => $('#modalEditcliente').modal('hide'));
                        }
                    }
                });
            });

            // Refresca cada 5 segundos
            setInterval(() => fetch('./refrescar.php'), 5000);
        });

        </script>
<script> 
//   $(document).ready(function (e) {
//   $('#modalEditcliente').on('show.bs.modal', function(e) { 

//      var idi    = $(e.relatedTarget).data().id;
//      var no_orden  = $(e.relatedTarget).data().name;
  
     
    
//       $(e.currentTarget).find('#form_pass_idc').val(idi);
//       $(e.currentTarget).find('#form_pass_noorden').val(no_orden);
     
      
//   });
// });
</script>
  
    <div class="modal fade" id="modalEditcliente"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Cancelar Solicitud</h5>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="col-md-12">
                            <div class="form-group"> 
                            </div>
                        </div>
                        <input type="hidden" class="form-control" id="form_pass_idc" name="form_pass_idc">

                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">No. Orden:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="form_pass_noorden" name="form_pass_noorden" >
                            </div>
                        </div>  
    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div> 
    </div>

<script>
  //  $('#actualizaclientes').click(function(e){
  //       e.preventDefault();

  //       var idc          = $('#form_pass_idc').val();
  //       var noorden      = $('#form_pass_noorden').val();

  //      var action       = 'BajaSolicitudPreventivo';

  //       $.ajax({
  //                   url: 'includes/ajax.php',
  //                   type: "POST",
  //                   async : true,
  //                   data: {action:action, idc:idc, noorden:noorden},

  //                   success: function(response)
  //                   {
  //                     if(response === 'success')
  //                       {
  //                            //console.log(response);
  //                           // var info = JSON.parse(response);
  //                           // console.log(info);
  //                           //$('#modalFactura').modal('hide');
  //                           //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
  //                           swal('Cancelado','Registrado Cancelado','success').then((value) => {

  //                           $('#modalEditcliente').modal('hide')
  //                           location.reload(true);
  //                           })
    
  //                       }else{
  //                           console.log('no data');
  //                           swal('Error','Error al Cancelar Registro','warning').then((value) => {

  //                           $('#modalEditcliente').modal('hide')
                            
  //                           })
                          

  //                       }
  //                },
  //                error: function(error) {
  //                }
  //              });

  //   });

    </script>    

 <script>
    // document.addEventListener("DOMContentLoaded", function(){
    //   // Invocamos cada 5 segundos ;)
    //   const milisegundos = 5 *1000;
    //   setInterval(function(){
    //   // No esperamos la respuesta de la petición porque no nos importa
    //      fetch("./refrescar.php");
    //   },milisegundos);
    // });
</script>
</body>
</html>
