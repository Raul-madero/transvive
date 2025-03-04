<?php
include "../conexion.php";
session_start();
$User = $_SESSION['user'];
if(!isset($_SESSION['user'])) {
	header('Location: /');
	exit;
}
$rol = $_SESSION['rol'];
$sql = "select * from rol where idrol =$rol ";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query);
$namerol = $filas['rol'];
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
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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
        <?php include('includes/generalnavbar.php')
       ?>
        <?php include 'includes/nav.php';  ?>
      </div>
    </nav>
    <!-- /.navbar -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4 class="m-0"> Listado de <small>Adeudos por Empleado</small></h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="new_adeudo.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;', 2); ?>Nuevo</a></li>
                <!-- <li class="breadcrumb-item"><a href="factura/adeudos_excel.php"><i class="fas fa-file-excel"></i> Excel</a></li>
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Layout</a></li>
                <li class="breadcrumb-item active">Navegacion</li> -->
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-striped table-bordered table-condensed" style="width:100%">
            <thead>
              <tr>
                <th>No.</th>
                <th>Nombre</th>
                <th>Adeudo Total</th>
                <th>Motivo de Adeudo</th>
                <th>Estado</th>
                <th>Fecha de inicio</th>
                <th>Fecha final</th>
                <th>Descuento</th>
                <th>Total de semanas</th>
                <th>Comentarios</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  <!-- Main Footer -->
  <?php include('includes/footer.php') ?>
  </div>
  <!-- ./wrapper -->
  <!-- REQUIRED SCRIPTS -->
 <!-- jQuery y Bootstrap -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<!-- DataTables y Plugins -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>

<!-- AdminLTE -->
<script src="../dist/js/adminlte.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#example1').dataTable({
            "bProcessing": true,
            "sAjaxSource": "data/data_adeudos.php",
            "bPaginate": true,
            "sPaginationType": "full_numbers",
            "iDisplayLength": 10,
            "responsive": true,
            "aoColumns": [
                {
                    mData: 'noempleado',
                    "sWidth": "50px",
                    "render": function(data) {
                        return '<p>' + data + '</p>';
                    }
                },
                {
                    mData: null,  // Usamos 'null' para procesar múltiples campos concatenados
                    "sWidth": "120px",
                    "render": function(data, type, full) {
                        return '<p>' + full.nombres + ' ' + full.apellido_paterno + ' ' + full.apellido_materno + '</p>';
                    }
                },
                {
                    mData: 'cantidad',
                    "sWidth": "100px",
                    "render": function(data) {
                        return '<p>' + data + '</p>';
                    }
                },
                {
                    mData: 'motivo_adeudo',
                    "sWidth": "100px",
                    "render": function(data) {
                        return '<p>' + data + '</p>';
                    }
                },
                {
                    mData: 'estado',
                    "sWidth": "130px",
                    "render": function(data) {
                        return '<p>' + (data === 1 ? 'Pagado' : 'Activo') + '</p>';
                    }
                },
                {
                    mData: 'fecha_inicial',
                    "sWidth": "50px",
                    "render": function(data) {
                        return '<p>' + data + '</p>';
                    }
                },
                {
                    mData: 'fecha_final', //Usamos "null" para procesar múltiples campos concatenados
                    "sWidth": "50px",
                    "render": function(data) {
                        return '<p>' + data + '</p>';
                    }
                },
                {
                    mData: 'descuento',
                    "sWidth": "50px",
                    "render": function(data) {
                        return '<p>' + data + '</p>';
                    }
                },
                {
                  mData: 'total_abonado',
                  "sWidth": "120px",
                  "render": function(data) {
                    return '<p>' + data + '</p>';
                  }
                },
                {
                    mData: 'semanas_totales',
                    "sWidth": "50px",
                    "render": function(data) {
                        return '<p>' + data + '</p>';
                    }
                },
                {
                  mData: null,
                  "sWidth": "120px",
                  "render": function(data, type, full, meta) {
                    let fechaActual = new Date();
                    let fechaFinal = new Date(full.fecha_final);
                    // Calcular semanas restantes hasta la fecha final
                    let semanasRestantes = Math.ceil((fechaFinal - fechaActual) / (7 * 24 * 60 * 60 * 1000));
                    
                    return `<p>${semanasRestantes > 0 ? semanasRestantes : 0}</p>`;
                  }
              },
              {
                    mData: 'comentarios',
                    "sWidth": "50px",
                    "render": function(data) {
                        return '<p>' + data + '</p>';
                    }
                },
                {
                  "render": function(data, type, full, meta) {
                    return '<a class="link_edit" style="color:#007bff;" href= \'edit_adeudo.php?id=' + full.noempleado + '\'><i class="far fa-edit"></i> Edit</a> | <a data-toggle="modal" data-target="#modalEditcliente"  data-id=\'' + full.noempleado + '\' data-name=\'' + full.nombres + ' ' + full.apellido_paterno + ' ' + full.apellido_materno + '\' href="javascript:void(0)" class="link_delete" style="color:red" ><i class="far fa-trash-alt"></i> Pagado </a> | <!-- <a data-toggle="modal" data-target="#modalAltacliente"  data-id=\'' + full.noempleado + '\' data-name=\'' + full.nombres + ' ' + full.apellido_paterno + ' ' + full.apellido_materno + '\' href="javascript:void(0)" class="link_delete" style="color:green" ><i class="fas fa-angle-double-up"></i> Reingreso</a> | <a class="link_edit" style="color:#007bff;" href= \'new_empleado23.php?id=' + full.noempleado + '\'><i class="fas fa-portrait"></i></a> | <a class="link_edit" style="color:gray;" href= \'factura/alta_empleado.php?id=' + full.noempleado + '\' target="_blank"><i class="fas fa-print"></i></a> -->';
                  }
                }
            ],
            "oLanguage": {
                "sEmptyTable": "No hay registros disponibles",
                "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
                "sLoadingRecords": "Por favor espera - Cargando...",
                "sSearch": "Buscar:",
                "sLengthMenu": "Mostrar _MENU_",
                "oPaginate": {
                    "sFirst": "Primera",
                    "sPrevious": "Previa",
                    "sNext": "Siguiente",
                    "sLast": "Última"
                }
            }
        });
    });
</script>

  <script>
    $(document).ready(function(e) {
      $('#modalEditcliente').on('show.bs.modal', function(e) {
        var idi = $(e.relatedTarget).data().id;
        var mesel = $(e.relatedTarget).data().name;
        $(e.currentTarget).find('#form_pass_idc').val(idi);
        $(e.currentTarget).find('#form_pass_nombree').val(mesel);
      });
    });
  </script>

  <div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Baja de Empleado</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="col-md-12">
              <div class="form-group">
              </div>
            </div>
            <input type="hidden" class="form-control" id="form_pass_idc" name="form_pass_idc">
            <div class="form-group row">
              <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Empleado:</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="form_pass_nombree" name="form_pass_nombree" placeholder="Nombre del Empleado">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Fecha Baja:</label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="form_pass_datebaja" name="form_pass_datebaja">
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Motivo Baja:</label>
              <div class="col-sm-8">
                <textarea class="form-control" id="form_pass_motbaja" name="form_pass_motbaja" rows="2"></textarea>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;"> ¿Recontratable?:</label>
              <div class="col-sm-8">
                <select class="form-control select2bs4" id="inputRecontra" name="inputRecontra">
                  <option value="">- Seleccione -</option>
                  <option value="SI">SI</option>
                  <option value="NO">NO</option>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Motivo Recontratable:</label>
              <div class="col-sm-8">
                <textarea class="form-control" id="form_pass_motrecontra" name="form_pass_motrecontra" rows="2"></textarea>
              </div>
            </div>
            <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->
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
    $('#actualizaclientes').click(function(e) {
      e.preventDefault();
      var idc = $('#form_pass_idc').val();
      var empleado = $('#form_pass_nombree').val();
      var date_baja = $('#form_pass_datebaja').val();
      var mot_baja = $('#form_pass_motbaja').val();
      var recontrata = $('#inputRecontra').val();
      var mot_recontra = $('#form_pass_motrecontra').val();
      var action = 'BajaEmpleado';
      $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async: true,
        data: {
          action: action,
          idc: idc,
          empleado: empleado,
          date_baja: date_baja,
          mot_baja: mot_baja,
          recontrata: recontrata,
          mot_recontra: mot_recontra
        },
        success: function(response) {
          if (response != 'error') {
            //console.log(response);
            var info = JSON.parse(response);
            // console.log(info);
            //$('#modalFactura').modal('hide');
            //--$('#detalle_inspeccion').html(info.detalle);
            swal('Eliminado', 'Baja de Empleado Registrada', 'success').then((value) => {
              $('#modalEditcliente').modal('hide')
              location.reload(true);
            })
          } else {
            // console.log('no data');
            swal('Error', 'Empleado ya fue dado de Baja', 'warning').then((value) => {
              $('#modalEditcliente').modal('hide')
            })
          }
          //viewProcesar();
        },
        error: function(error) {}
      });
    });
  </script>

  <script>
    $(document).ready(function(e) {
      $('#modalAltacliente').on('show.bs.modal', function(e) {
        var idi = $(e.relatedTarget).data().id;
        var mesel = $(e.relatedTarget).data().name;
        $(e.currentTarget).find('#form_pass_idca').val(idi);
        $(e.currentTarget).find('#form_pass_nombrea').val(mesel);
      });
    });
  </script>

  <div class="modal fade" id="modalAltacliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Reingreso de Empleado</h5>
        </div>
        <div class="modal-body">
          <form>
            <div class="col-md-12">
              <div class="form-group">
              </div>
            </div>
            <input type="hidden" class="form-control" id="form_pass_idca" name="form_pass_idca">
            <div class="form-group row">
              <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Empleado:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="form_pass_nombrea" name="form_pass_nombrea" placeholder="Nombre del Empleado">
              </div>
            </div>

            <div class="form-group row">
              <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Fecha Reingreso:</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" id="form_pass_datereing" name="form_pass_datereing">
              </div>
            </div>
            <!--<div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Imagen:</label>
           <div class="col-sm-10">
              <input type="file" class="form-control" id="image" name="image" multiple>
           </div>
        </div>-->
            <div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-success pull-right" href="#" id="actualizaaltaclientes"><i class="fa fa-save"></i>&nbsp;Guardar</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
    $('#actualizaaltaclientes').click(function(e) {
      e.preventDefault()
      var idc = $('#form_pass_idca').val();
      var empleado = $('#form_pass_nombrea').val();
      var date_reing = $('#form_pass_datereing').val();
      var action = 'ReingresoEmpleado';
      $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async: true,
        data: {
          action: action,
          idc: idc,
          empleado: empleado,
          date_reing: date_reing
        },
        success: function(response) {
          if (response != 'error') {
            //console.log(response);
            var info = JSON.parse(response);
            // console.log(info);
            //$('#modalFactura').modal('hide');
            //--$('#detalle_inspeccion').html(info.detalle);
            swal('Editado', 'Reingreso de Empleado Registrado', 'success').then((value) => {
              $('#modalAltacliente').modal('hide')
              location.reload(true);
            })
          } else {
            // console.log('no data');
            swal('Error', 'Empleado ya fue dado de Baja', 'warning').then((value) => {
              $('#modalAltacliente').modal('hide')
            })
          }
          //viewProcesar();
        },
        error: function(error) {}
      });
    });
  </script>
  <script>
    $(document).ready(function(e) {
      $('#modalDeleteContacto').on('show.bs.modal', function(e) {
        var idi = $(e.relatedTarget).data().id;
        var mesel = $(e.relatedTarget).data().cmes;
        var indic1 = $(e.relatedTarget).data().cind1;
        $(e.currentTarget).find('#form_pass_idbc').val(idi);
        $(e.currentTarget).find('#form_pass_nombrebc').val(mesel);
        $(e.currentTarget).find('#form_pass_contactobc').val(indic1);
      });
    });
  </script>
  <!-- <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Invocamos cada 5 segundos ;)
      const milisegundos = 5 * 1000;
      setInterval(function() {
        // No esperamos la respuesta de la petición porque no nos importa
        fetch("./refrescar.php");
      }, milisegundos);
    }); -->
  </script> 
</body>

</html>