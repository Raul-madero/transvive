<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  if(!isset($_SESSION['user'])) {
    header('Location: /');
    exit;
  }
  $rol=$_SESSION['rol'];
  $allowed = array(17, 1);
  if(in_array($rol, $allowed) === false) {
    header('Location: /');
    exit;
  }
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
  <!-- DataTables -->
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- Bootstrap 5 -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> -->

 
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

      <!-- <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

      <?php include('includes/generalnavbar.php'); ?>
      <?php include('includes/nav.php'); ?>
      
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
            <h4 class="m-0"> Listado de <small>Prospectos</small></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            	<li class="breadcrumb-item"><a href="new_prospecto.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nuevo</a></li>
               <!-- <li class="breadcrumb-item"><a href="factura/clientes_excel.php"><i class="fas fa-file-excel"></i> Excel</a></li>
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
              <table id="example1" class="table table-striped table-bordered table-condensed" style="width:100%" >
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Razon Social</th>
                          <th>Encargado</th>
                          <th>Correo</th>
                          <th>Telefono</th>
                          <th>Municipio</th>
                          <th>Fecha de Contacto</th>
                          <th>Comentarios</th>
                          <th>Seguimiento</th>
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<!-- DataTables JS library -->
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- DataTables JBootstrap -->
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->


<!-- Bootstrap 4 o 5 (elige el que usas) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- FontAwesome para los iconos -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

<script>
  // Define la variable table fuera del bloque para que sea accesible globalmente
let table;

$(document).ready(function () {
    // Inicializa la tabla y asigna el objeto DataTable a la variable global table
    table = $('#example1').DataTable({
        "bProcessing": true,
        "sAjaxSource": "data/prospectos.php",
        "bPaginate": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "responsive": true,
        "aoColumns": [
            { mData: 'id', "sWidth": "5%" },
            { mData: 'nombre_comercial', "sWidth": "15%" },
            { mData: 'encargado', "sWidth": "15%" },
            { mData: 'correo', "sWidth": "10%" },
            { mData: 'telefono', "sWidth": "10%" },
            { mData: 'municipio', "sWidth": "10%" },
            { mData: 'fecha_contacto', "sWidth": "10%" },
            { mData: 'comentarios', "sWidth": "10%" },
            { mData: 'fecha_seguimiento', "sWidth": "10%" },
            {
                "render": function (data, type, full, meta) {
                    return '<a class="link_edit" style="color:#007bff;" href= \'editar_prospecto.php?id=' + full.id + '\'><i class="far fa-edit"></i> Editar</a> | <a data-toggle="modal" data-target="#modalEditcliente" data-id=\'' + full.id + '\' data-name=\'' + full.nombre + '\' href="javascript:void(0)" class="link_delete" style="color:red"><i class="far fa-trash-alt"></i> Eliminar</a>';
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
                "sLast": "Última",
            }
        }
    });
});

// Escucha el evento de clic en las filas del tbody
$('#example1 tbody').on('click', 'tr', function () {
    console.log('Click en fila');
    const rowData = table.row(this).data(); // Obtén los datos de la fila seleccionada
    mostrarModal(rowData); // Llama a la función para mostrar el modal
});

// Función para mostrar el modal con los datos de la fila
function mostrarModal(datos) {
    // Rellena los datos en el modal
	console.log(datos);
    $('#modalTitulo').text(`Información del Prospecto: ${datos.razon_social}`);
    $('#modalNombreComercial').text(datos.nombre_comercial);
    $('#modalTitulo2').text(datos.nombre_comercial);
    $('#modalEncargado').text(datos.encargado);
    $('#modalCorreo').text(datos.correo);
    $('#modalTelefono').text(datos.telefono);
    $('#modalMunicipio').text(datos.municipio);
    $('#modalFechaContacto').text(datos.fecha_contacto);
    $('#modalComentarios').text(datos.comentarios);
    $('#modalFechaSeguimiento').text(datos.fecha_seguimiento);
    $('#modalTelEmpresa').text(datos.telefono_empresa);
    $('#modalDomicilio').text(datos.domicilio);
    $('#modalCP').text(datos.cp);
    $('#modalColonia').text(datos.colonia);
    $('#modalEstado').text(datos.estado);
	$('#modalGirocomercial').text(datos.giro_comercial);
	$('#modalNoEmpleados').text(datos.no_empleados);
	$('#modalTurnos').text(datos.turnos);
	$('#modalUnidad').text(datos.tipo_unidad);
	$('#modalSemaforo').text(datos.semaforo);

    // Muestra el modal
    $('#miModal').modal('show');
}


</script>
<div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item" id="btnGenerales"><a href="#generales">Datos Generales</a></li>
              <li class="breadcrumb-item active" aria-current="page" id="btnCaracteristicas">Caracteristicas</li>
            </ol>
          </nav>
            <!-- <div class="modal-header">
                <h5 class="modal-title" id="modalTitulo">Información del Prospecto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div> -->
            <div class="tab-pane" id="generales">
              	<div class="modal-body">
					<div class="container text-center">
						<div class="row">
							<div class="col-2"></div>
							<div class="col-8">
								<h1 id="modalNombreComercial"></h1>
							</div>
							<div class="col-2"></div>
						</div>
		
						<div class="row">
							<div class="col3">
							<p><strong>Nombre Contacto:</strong> <span id="modalEncargado"></span></p>
							</div>
							<div class="col-3">
							<p><strong>Correo:</strong> <span id="modalCorreo"></span></p>
							</div>
							<div class="col-3">
							<p><strong>Teléfono Contacto:</strong> <span id="modalTelefono"></span></p>
							</div>
							<div class="col-3">
							<p><strong>Teléfono de Empresa:</strong> <span id="modalTelEmpresa"></span></p>
							</div>
						</div>
		
						<div class="row">
							<div class="col">
							<p><strong>Calle y No.:</strong> <span id="modalDomicilio"></span></p>
							</div>
							<div class="col">
							<p><strong>Codigo Postal:</strong> <span id="modalCP"></span></p>
							</div>
							<div class="col">
							<p><strong>Colonia:</strong> <span id="modalColonia"></span></p>
							</div>
						</div>
		
						<div class="row">
							<div class="col">
							<p><strong>Estado:</strong> <span id="modalEstado"></span></p>
							</div>
							<div class="col">
							<p><strong>Municipio:</strong> <span id="modalMunicipio"></span></p>
							</div>
						</div>
		
						<div class="row">
							<div class="col">
							<p><strong>Fecha de Contacto:</strong> <span id="modalFechaContacto"></span></p>
							</div>
							<div class="col">
							<p><strong>Fecha de Seguimiento:</strong> <span id="modalFechaSeguimiento"></span></p>
							</div>
						</div>
		
						<div class="row">
							<p><strong>Comentarios:</strong> <span id="modalComentarios"></span></p>
						</div>
					</div>
				</div>
            </div>
        
			<div class="container text-center">
				<div class="tab-pane" id="caracteristicas" style="display: none;">
					  <div class="row">
						<div class="col-2"></div>
						<div class="col-8">
							<h1 id="modalTitulo2"></h1>
						</div>
						<div class="col-2"></div>
					</div>
	
					<div class="row">
						<div class="col">
							<p><strong>Giro Comercial:</strong> <span id="modalGirocomercial"></span></p>
						</div>
						<div class="col">
							<p><strong>No. de Empleados:</strong> <span id="modalNoEmpleados"></span></p>
						</div>
						<div class="col">
							<p><strong>Turnos:</strong> <span id="modalTurnos"></span></p>
						</div>
					</div>
	
					<div class="row">
						<div class="col">
							<p><strong>Tipo de Unidad:</strong> <span id="modalUnidad"></span></p>
						</div>
						<div class="col">
							<p><strong>Semaforo:</strong> <span id="modalSemaforo"></span></p>
						</div>
						</div>
				</div>
	
			</div>
			<div class="modal-footer">
			  <div class="row">
				<div class="col-4">
				  <!-- <a href="" class="btn btn-info">Caracteristicas</a> -->
				</div>
				<!-- <div class="col-4">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" data-bs-target="#miModal" id="cerrarModal">Cerrar</button>
				</div> -->
				<div class="col-4">
				</div>
			  </div>
			</div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("btnGenerales").addEventListener("click", function () {
        document.getElementById("generales").style.display = "block";
        document.getElementById("caracteristicas").style.display = "none";
    });

    document.getElementById("btnCaracteristicas").addEventListener("click", function () {
        document.getElementById("generales").style.display = "none";
        document.getElementById("caracteristicas").style.display = "block";
    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelector("#cerrarModal").addEventListener("click", function () {
        var modal = bootstrap.Modal.getInstance(document.getElementById("miModal"));
        modal.hide();
    });
});
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalSubecontrato').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     var mesel  = $(e.relatedTarget).data().name;
  
     
    
      $(e.currentTarget).find('#form_pass_idc').val(idi);
      $(e.currentTarget).find('#form_pass_nombree').val(mesel);
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalSubecontrato" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Carga Contrato del Cliente</h5>
      </div>
      <div class="modal-body">

        
        <form action="insertar_cliente.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <input type="hidden" class="form-control" id="form_pass_idc" name="form_pass_idc">

        <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Cliente</label>
                     <div class="col-sm-10">
                     <input class="form-control" type="text" id="form_pass_nombree" name="form_pass_nombree"  readonly />
                </div>
             </div>

        <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Contrato</label>
                     <div class="col-sm-10">
                     <input class="form-control prevPhoto" type="file" name="archivo"  />
                </div>
             </div>

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <input type="submit"  class="btn btn-success pull-right" value="Guardar" >
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var idc          = $('#form_pass_idc').val();
        var cliente      = $('#form_pass_nombree').val();

       var action       = 'BajaCliente';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idc:idc, cliente:cliente},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            swal('Baja','Baja de Cliente Registrada','success').then((value) => {

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            })
    
                        }else{
                            console.log('no data');
                            swal('Error','Cliente ya fue dado de Baja','warning').then((value) => {

                            $('#modalEditcliente').modal('hide')
                            
                            })
                          

                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>             


<script> 
  $(document).ready(function (e) {
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     var mesel  = $(e.relatedTarget).data().name;
  
     
    
      $(e.currentTarget).find('#form_pass_idb').val(idi);
      $(e.currentTarget).find('#form_pass_nombreb').val(mesel);
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Baja de Cliente</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <input type="hidden" class="form-control" id="form_pass_idb" name="form_pass_idc">

        <div class="form-group row">
           <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Cliente:</label>
           <div class="col-sm-8">
              <input type="text" class="form-control" id="form_pass_nombreb" name="form_pass_nombree" placeholder="Nombre del Empleado">
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
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var idc          = $('#form_pass_idb').val();
        var cliente      = $('#form_pass_nombreb').val();

       var action       = 'BajaCliente';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idc:idc, cliente:cliente},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            swal('Baja','Baja de Cliente Registrada','success').then((value) => {

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            })
    
                        }else{
                            console.log('no data');
                            swal('Error','Cliente ya fue dado de Baja','warning').then((value) => {

                            $('#modalEditcliente').modal('hide')
                            
                            })
                          

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
