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

$registros_por_pagina = 10;

//Verificar en que pagina estamos y setear por default pagina 1
$pagina_actual = isset($_GET['page']) ? intval($_GET['page']) : 1;
$pagina_actual < 1 ? $pagina_actual = 1 : $pagina_actual;

//Calculamos el offset
$offset = ($pagina_actual - 1) * $registros_por_pagina;

// Consulta total de registros (para calcular el total de páginas)
$sql_total = "SELECT COUNT(*) as total FROM solicitud_mantenimiento WHERE id > 0";
$resultado_total = mysqli_query($conection, $sql_total);
$total_registros = mysqli_fetch_assoc($resultado_total)['total'];

//Calcular el numero total de paginas
$paginas_totales = ceil($total_registros / $registros_por_pagina);

$sqlordenes = "SELECT * FROM solicitud_mantenimiento WHERE id > 0 LIMIT $registros_por_pagina OFFSET $offset";
$query_ordenes = mysqli_query($conection, $sqlordenes);

if (!$query_ordenes) {
  die("Error al ejecutar la consulta: " . mysqli_error($conection));
}


  
  //*include "../conexion.php";
  //*$sqledo = "select estado from estados ORDER BY estado";
  //*$queryedo = mysqli_query($conection, $sqledo);
  //*$filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); 

 
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

   
<!------ Include the above in your HEAD tag ---------->

    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap4.min.js"></script>
    
        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
    
    <script src="./js/require.min.js"></script>
    <script>
      requirejs.config({
          baseUrl: '.'
      });
    </script>

    <style type="text/css">
      th { font-size: 12px; font-weight:bold; }
      td { font-size: 13px; }
      .paginador a {
            margin: 0 5px;
            padding: 8px 12px;
            text-decoration: none;
            border: 1px solid #ddd;
            color: #007bff;
        }
        .paginador a.activo {
            font-weight: bold;
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .paginador a:hover {
            background-color: #ddd;
        }
  </style>
    <!-- Dashboard Core -->
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
      <?php
       if ($_SESSION['rol'] == 4) {
        include('includes/navbarsup.php');
      }else {
        if ($_SESSION['rol'] == 6) {
          include('includes/navbaroperac.php');
        }else {
          if ($_SESSION['rol'] == 8) {
            include('includes/navbarjefeoper.php');
          }else {
            if ($_SESSION['rol'] == 9) {
              include('includes/navbargrcia.php');
            }else {
              if ($_SESSION['rol'] == 15) {
                include('includes/navbarmonitorista.php');
              }else {
                if ($_SESSION['rol'] == 14) {
                  include('includes/navbarcalidad.php');
                }else {
                  if ($_SESSION['rol'] == 10) {
                    include('includes/navbaralmacen.php');
                  }else {
                    if ($_SESSION['rol'] == 7) {
                      include('includes/navbarmantto.php');
                    }else {
                      include('includes/navbar.php'); 
                    }  
                  }  
                } 

              }  
            }
          }  
        }
      } ?>
      <?php include('includes/nav.php') ?> 

    </div>
  </nav>
  <!-- Left side column. contains the logo and sidebar -->
   

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
                        <!--<input style="width: 220px" type='text' name='gender' id='gender' placeholder="Estatus (Activa/Cancelada/Cerrada)">-->
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
            <!-- id="fetch_generated_wills" -->
              <table  class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
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
            <tbody>
              <?php
                while ($data = mysqli_fetch_assoc($query_ordenes)) {
                  echo "<tr>";
                  echo "<td>" . htmlspecialchars($data['id']) . "</td>";
                  echo "<td>" . htmlspecialchars($data['no_orden']) . "</td>";
                  echo "<td>" . htmlspecialchars($data['fecha']) . "</td>";
                  echo "<td>" . htmlspecialchars($data["unidad"]) . "</td>";
                  echo "<td>" . htmlspecialchars($data["solicita"]) . "</td>";
                  echo "<td>" . htmlspecialchars($data["tipo_trabajo"]) . "</td>";
                  echo "<td>" . htmlspecialchars($data["tipo_mantenimiento"]) . "</td>";
                  echo "<td>" . htmlspecialchars($data["trabajo_solicitado"]) . "</td>";
                  echo "<td>" . htmlspecialchars($data["estatus"]) . "</td>";
                  echo '<td><a class="link_edit" style="color:#007bff;" href="edit_solicitudmantto.php?id=' . htmlspecialchars($data['id']) . '"><i class="far fa-edit"></i> Editar</a> |
                  <a href="factura/form_ordenmantto.php?id=' . htmlspecialchars($data['no_orden']) . '" target="_blank"><i class="fa fa-print" style="color:white; font-size: 1.3em"></i> Print</a> |
                  <a data-toggle="modal" data-target="#modalEditcliente" data-id="' . htmlspecialchars($data['id']) . '" data-name="' . htmlspecialchars($data['no_orden']) . '" href="javascript:void(0)" class="link_delete" style="color:red"><i class="fa fa-ban"></i> Cancelar</a>';
                  echo "<td>";
                }
              ?>
          </table>
          <div class="paginador">
                <?php
                if ($pagina_actual > 1) {
                    echo '<a href="?pagina=' . ($pagina_actual - 1) . '">Anterior</a>';
                }
                for ($i = 1; $i <= $total_paginas; $i++) {
                    $clase_activo = $pagina_actual == $i ? 'activo' : '';
                    echo '<a class="' . $clase_activo . '" href="?pagina=' . $i . '">' . $i . '</a>';
                }
                if ($pagina_actual < $total_paginas) {
                    echo '<a href="?pagina=' . ($pagina_actual + 1) . '">Siguiente</a>';
                }
                ?>
         </div>

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
  <!-- Control Sidebar -->
 
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->

<!-- ./wrapper -->

<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->

<!-- SlimScroll -->

<!-- Bootstrap 3.3.7 -->


<!-- AdminLTE App -->

<!-- AdminLTE for demo purposes -->
<!--<script src="../dist/js/demo.js"></script>-->
<!-- page script -->


    
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>



 
	<script type="text/javascript">

// Cargar datos iniciales
// load_data();

// function load_data(initial_date = "", final_date = "", gender = "") {
// 	const ajax_url = "data/datadetorders_mantto.php";

// 	// Configuración común de DataTable
// 	const tableConfig = {
// 		"order": [[0, "desc"]],
// 		dom: 'Bfrtip',
// 		lengthMenu: [
// 			[20, 25, 50, -1],
// 			['20 rows', '25 rows', '50 rows', 'Show all']
// 		],
// 		buttons: [
// 			'excelHtml5',
// 			'pageLength'
// 		],
// 		"processing": true,
// 		"serverSide": true,
// 		"stateSave": true,
// 		"responsive": true,
// 		"lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
// 		"ajax": {
// 			"url": ajax_url,
// 			"dataType": "json",
// 			"type": "POST",
// 			"data": {
// 				"action": "fetch_users",
// 				"initial_date": initial_date,
// 				"final_date": final_date,
// 				"gender": gender
// 			},
// 			"dataSrc": "records"
// 		},
// 		"columns": [
// 			{ "data": "pedidono", "width": "3%", className: "text-right" },
// 			{ "data": "noorden", "width": "5%" },
// 			{ "data": "fechaa", "width": "5%", className: "text-right", "orderable": false },
// 			{ "data": "unidad", "width": "5%", "orderable": false },
// 			{ "data": "solicita", "width": "18%", "orderable": false },
// 			{ "data": "tipojob", "width": "12%", "orderable": false },
// 			{ "data": "tipomantto", "width": "8%" },
// 			{ "data": "trabsolicitado", "width": "12%" },
// 			{ "data": "estatusped", "width": "8%", "orderable": false },
// 			{
// 				"render": function (data, type, full, meta) {
// 					return `<a class="link_edit" style="color:#007bff;" href='edit_solicitudmantto.php?id=${full.pedidono}'><i class="far fa-edit"></i> Editar</a> |
// 							<a href='factura/form_ordenmantto.php?id=${full.noorden}' target="_blank"><i class="fa fa-print" style="color:white; font-size: 1.3em"></i> Print</a> |
// 							<a data-toggle="modal" data-target="#modalEditcliente" data-id='${full.pedidono}' data-name='${full.noorden}' href="javascript:void(0)" class="link_delete" style="color:red"><i class="fa fa-ban"></i> Cancelar</a>`;
// 				}
// 			}
// 		]
// 	};

// 	$('#fetch_generated_wills').DataTable(tableConfig);
// }

// // Evento de filtro
// $("#filter").click(function () {
// 	const initial_date = $("#initial_date").val();
// 	const final_date = $("#final_date").val();
// 	const gender = $("#gender").val();

// 	// Validar fechas
// 	if (!initial_date && !final_date) {
// 		$('#fetch_generated_wills').DataTable().destroy();
// 		load_data("", "", gender);
// 	} else if (!initial_date || !final_date) {
// 		$("#error_log").html("<span class='text-warning'>Warning: You must select both (start and end) dates.</span>");
// 	} else {
// 		const date1 = new Date(initial_date);
// 		const date2 = new Date(final_date);

// 		if (date1 > date2) {
// 			$("#error_log").html("<span class='text-warning'>Warning: End date should be greater than start date.</span>");
// 		} else {
// 			$("#error_log").html(""); // Limpiar mensajes de error
// 			$('#fetch_generated_wills').DataTable().destroy();
// 			load_data(initial_date, final_date, gender);
// 		}
// 	}
// });

// // Configuración del Datepicker
// $(".datepicker").datepicker({
// 	language: 'es',
// 	dateFormat: "yy-mm-dd",
// 	changeYear: true
// });

</script>



    <script type="text/javascript">


 /* it will load products when document loads */

$(document).on('click', '#cancel_pedido', function(e){

 e.preventDefault();
       var pedidoId = $(this).data('id');
        var action = 'infoCancelpedido';
        swal({
  title: "Desea Cancelar el Registro ?",
  text: "Pedido No.: " + pedidoId,
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
    $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,pedidoId:pedidoId},
            success: function(response)
            {
                if(response != 0){
                    swal('Cancelado','Registro Cancelado Correctamente','success').then(function(){ 
                      $('#modalAlumno').modal('hide');
                    location.reload();
                } );
                  
                }else{
                    swal("Poof! Error!", {
      icon: "warning",
    });
                
                   
                }
            },
            error: function(error) {

            }

        });

   
  } else {
    swal("Accion Cancelada Registro no Cancelado !");
  }
});
        
        

         }); 
    
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalAlumno').on('show.bs.modal', function(e) {    
     //var idp = $(e.relatedTarget).data().id;
     // $(e.currentTarget).find('#bookId').val(idp);
      
  });
});
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalCancelViaje').on('show.bs.modal', function(e) { 

     var idc    = $(e.relatedTarget).data().id;
  
    
      $(e.currentTarget).find('#form_pass_idcc').val(idc);
 
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalCancelViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Cancelar Vuelta</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_idcc" name="form_pass_idcc" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Motivo de Cancelación:</label>
           <div class="col-sm-9">
             <textarea class="form-control" rows="1" id="comentarios" name="comentarios">Cancelado / Reprogramado por el Cliente</textarea>
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
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaVuelta"><i class="fa fa-save"></i>&nbsp;Cancelar Vuelta</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaVuelta').click(function(e){
        e.preventDefault();

        var idcc      = $('#form_pass_idcc').val();       
        var motivoc   = $('#comentarios').val();

       var action       = 'AddCancelaVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idcc:idcc, motivoc:motivoc},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            alert('Cancelación Registrada Correctamente');

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            
    
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
  $(document).ready(function (e) {
  $('#modalCopiaViaje').on('show.bs.modal', function(e) { 

     var idcp    = $(e.relatedTarget).data().id;
  
    
      $(e.currentTarget).find('#form_pass_idcp').val(idcp);
 
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalCopiaViaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Copia Vuelta</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_idcp" name="form_pass_idcp" disabled>
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
        <button type="button" class="btn btn-success pull-right" href="#" id="copiaVuelta"><i class="fa fa-save"></i>&nbsp;Copiar Vuelta</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#copiaVuelta').click(function(e){
        e.preventDefault();

        var idcp      = $('#form_pass_idcp').val();       
       

       var action       = 'AddCopiaVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idcp:idcp},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            
                           
                            alert('Vuelta Copiada  Correctamente');

                            $('#modalCopiaViaje').modal('hide')
                            location.reload(true);
                            
    
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

<script type="text/javascript">


/* it will load products when document loads */

$(document).on('click', '#delete_viaje', function(e){

e.preventDefault();
      var viajeId = $(this).data('id');
       var action = 'infoBorraViaje';
       swal({
 title: "Desea Borrar el Registro del Viaje ?",
 text: "No. ID: " + viajeId,
 icon: "warning",
 buttons: true,
 dangerMode: true,
})
.then((willDelete) => {
 if (willDelete) {
   $.ajax({
           url: 'includes/ajax.php',
           type: "POST",
           async : true,
           data: {action:action,viajeId:viajeId},
           success: function(response)
           {
               if(response != 0){
                   swal('Eliminado','Viaje Borrado Correctamente','success').then((value) => {
                   location.reload();
})
                 
               }else{
                   swal("Poof! Error!", {
     icon: "warning",
   });
               
                  
               }
           },
           error: function(error) {

           }

       });

  
 } else {
   swal("Accion Cancelada Tarea no Cerrada !");
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
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     var no_orden  = $(e.relatedTarget).data().name;
  
     
    
      $(e.currentTarget).find('#form_pass_idc').val(idi);
      $(e.currentTarget).find('#form_pass_noorden').val(no_orden);
     
      
  });
});
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
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var idc          = $('#form_pass_idc').val();
        var noorden      = $('#form_pass_noorden').val();

       var action       = 'BajaSolicitud';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idc:idc, noorden:noorden},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            swal('Cancelado','Registrado Cancelado','success').then((value) => {

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            })
    
                        }else{
                            console.log('no data');
                            swal('Error','Error al Cancelar Registro','warning').then((value) => {

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
<script src="js/sweetalert.min.js"></script>

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
