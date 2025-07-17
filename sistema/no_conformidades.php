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
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE ERP"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php include('includes/generalnavbar.php') ?>
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
          <h4 class="m-0"> Listado de Quejas | No Conformidades <small><i class="fas fa-bell"></i></small></h4>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
          <ol class="breadcrumb float-sm-right">
              <?php
               if ($_SESSION['rol'] != 8) {
                
               ?>
               <li class="breadcrumb-item"><a href="new_noconformidad.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nueva</a></li>
                  <?php  
                }
             ?>
                <li class="breadcrumb-item"><a href="factura/no_confomidadesexl.php"><i class="fas fa-file-excel"></i> Excel</a></li>
         
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
                        <input style="width: 220px" type='text' name='gender' id='gender' placeholder="Estatus (Activa/Cancelada/Cerrada)">
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
           
              <table id="fetch_generated_wills" class="table-bordered table-striped  table-bordered" cellspacing="0" >
            <thead>
              <tr>
                <th style="text-align: center; font-size: 12px;">No.</th>
                <th style="text-align: center; font-size: 12px;">Mes</th>
                <th style="text-align: center; font-size: 12px;">Fecha</th>
                <th style="text-align: center; font-size: 12px;">Cliente</th>
                <!-- <th style="text-align: center; font-size: 12px;">8D</th> -->
                <th style="text-align: center; font-size: 12px;">Descripcion</th>
                <th style="text-align: center; font-size: 12px;">Motivo</th>
                <th style="text-align: center; font-size: 12px;">Responsable</th>
                <th style="text-align: center; font-size: 12px;">Supervisor</th>
                <th style="text-align: center; font-size: 12px;">Operador</th>
                <th style="text-align: center; font-size: 12px;">Unidad</th>
                <th style="text-align: center; font-size: 12px;">Ruta</th>
                <th style="text-align: center; font-size: 12px;">Parada</th>
                <th style="text-align: center; font-size: 12px;">Fecha Incidente</th>
                <th style="text-align: center; font-size: 12px;">Turno</th>
                <th style="text-align: center; font-size: 12px;">Procede AC</th>
                <th style="text-align: center; font-size: 12px;">¿Por que procede o no AC?</th>
                <th style="text-align: center; font-size: 12px;">Análisis y conclision AC</th>
                <th style="text-align: center; font-size: 12px;">Acción</th>
                <th style="text-align: center; font-size: 12px;">Fecha acción</th>
                <th style="text-align: center; font-size: 12px;">Responsable acción</th>
                <th style="text-align: center; font-size: 12px;">Fecha cierre</th>
                <th style="text-align: center; font-size: 12px;">Observaciones</th>
                <th style="text-align: center; font-size: 12px;">Incidente ¿interno o externo?</th>
                <th style="text-align: center; font-size: 12px;">Estatus</th>
                <!--<th style="text-align: center; font-size: 12px;">Cuenta</th>-->
                <th style="text-align: center; font-size: 12px;">Causa</th>
                <th style="text-align: center; font-size: 12px;">¿Afecta al cliente?</th>
                <th style="text-align: center; font-size: 12px;">Área reponsable</th>
                <th style="text-align: center; font-size: 12px;">Acciones</th>
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
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
     <?php include "includes/footer.php"; ?>
  </footer>

  <!-- Control Sidebar -->
 <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      
      
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        
       
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
     
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
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
        
        <script>
          $(document).ready(function() {
            load_data();

            function load_data(initial_date = '', final_date = '', gender = '') {
                const ajax_url = "data/datadetorders_nc.php";

                // Destruir si ya existe
                if ($.fn.DataTable.isDataTable('#fetch_generated_wills')) {
                    $('#fetch_generated_wills').DataTable().destroy();
                }

                $('#fetch_generated_wills').DataTable({
                    order: [[0, "desc"]],
                    columnDefs: [
                        { width: 20, targets: 0, className: 'dt-right dt-head-center' },
                        { width: 80, targets: 1, className: 'dt-left dt-head-center' },
                        { width: 50, targets: 2, className: 'dt-center dt-head-center' },
                        { width: 100, targets: 3, className: 'dt-left dt-head-center' },
                        { width: 150, targets: 4, className: 'dt-left dt-head-center' },
                        { width: 150, targets: 5, className: 'dt-left dt-head-center' },
                        { width: 100, targets: 6, className: 'dt-left dt-head-center' },
                        { width: 100, targets: 7, className: 'dt-left dt-head-center' },
                        { width: 100, targets: 8, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 9, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 10, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 11, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 12, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 13, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 14, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 15, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 16, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 17, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 18, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 19, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 20, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 21, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 22, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 23, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 24, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 25, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 26, className: 'dt-left dt-head-center' },
                        { width: 80, targets: 27 }
                    ],
                    fixedColumns: true,
                    paging: true,
                    scrollX: true,
                    scrollY: 300,
                    scrollCollapse: true,
                    dom: 'Bfrtip',
                    buttons: ['excelHtml5', 'pageLength'],
                    processing: true,
                    serverSide: true,
                    stateSave: true,
                    lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
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
                        dataSrc: "records"
                    },
                    columns: [
                        { data: "num_queja" },
                        { data: "name_mes" },
                        { data: "date" },
                        { data: "name_cliente" },
                        { data: "describe", orderable: false },
                        { data: "motivonc", orderable: false },
                        { data: "respnc" },
                        { data: "supervnc" },
                        { data: "operador" },
                        { data: "noeco" },
                        { data: "rutanc", orderable: false },
                        { data: "estacion", orderable: false },
                        { data: "date_incidente" },
                        { data: "turnoi" },
                        { data: "procedenc" },
                        { data: "porquenc", orderable: false },
                        { data: "analisisnc", orderable: false },
                        { data: "accionnc", orderable: false },
                        { data: "date_accion" },
                        { data: "respaccion", orderable: false },
                        { data: "date_cierre" },
                        { data: "notas", orderable: false },
                        { data: "tipo" },
                        { data: "estatusped" },
                        { data: "causanc", orderable: false },
                        { data: "afectacte" },
                        { data: "deptoresp", orderable: false },
                        {
                            render: function(data, type, full) {
                                return full.links_buttons; // Esto lo generas en tu PHP
                            }
                        }
                    ]
                });
            }

            $("#filter").on('click', function() {
                const initial_date = $("#initial_date").val();
                const final_date = $("#final_date").val();
                const gender = $("#gender").val();
                let error = '';

                if (!initial_date || !final_date) {
                    error = "Debes seleccionar ambas fechas.";
                } else if (new Date(initial_date) > new Date(final_date)) {
                    error = "La fecha final debe ser mayor a la inicial.";
                }

                if (error) {
                    $("#error_log").html(error);
                } else {
                    $("#error_log").html('');
                    load_data(initial_date, final_date, gender);
                }
            });

            $(".datepicker").datepicker({
                language: 'es',
                dateFormat: "yy-mm-dd",
                changeYear: true
            });
        });
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Borrar No Conformidad / Queja</h5>
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
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaVuelta"><i class="fa fa-save"></i>&nbsp;Borrar</button>
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
        //var motivoc   = $('#comentarios').val();

       var action       = 'AddCancelaNoconforme';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idcc:idcc},

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
        <h5 class="modal-title" id="exampleModalCenterTitle">Borrar No Condormidad / Queja</h5>
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

       var action       = 'BorraNoconforme';

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
