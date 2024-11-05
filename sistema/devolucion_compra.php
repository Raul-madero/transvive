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
                include('includes/navbar.php'); 
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
          <h4 class="m-0"> Listado de Devolución Sobre Compras <small><i class="fas fa-truck-loading"></i></small></h4>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
          <ol class="breadcrumb float-sm-right">
            <?php
             if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 16) {

             ?> 
               <li class="breadcrumb-item"><a href="new_devcompra.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nueva</a></li>

             <?php }   ?>
            
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Navegacion</li>
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
          <div class="card card-success card-outline">
           
               
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
                        <input type='text' name='gender' id='gender' placeholder="Estatus (Activo/Cancelado)">
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
                <th style="text-align: center; font-size: 12px;">No. Devolucion</th>
                <th style="text-align: center; font-size: 12px;">Fecha</th>
                <th style="text-align: center; font-size: 12px;">Proveedor</th>
                <th style="text-align: center; font-size: 12px;">Importe</th>
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

<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->

<!-- SlimScroll -->

<!-- Bootstrap 3.3.7 -->


<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!--<script src="../dist/js/demo.js"></script>-->
<!-- page script -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>

 
    <script type="text/javascript">

      load_data(); // first load

      function load_data(initial_date, final_date, gender){
        var ajax_url = "data/datadetorders_podev.php";

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
            { "data" : "nocompra", "width": "10%", className: "text-right","orderable": false},
            { "data" : "fechaa", "width": "8%", "orderable": false},
            { "data" : "razonsoc", "width": "40%", "orderable":false },
            { "data" : "importetotal", "width": "10%",  render: $.fn.dataTable.render.number( ',', '.', 2 ), className: "text-right", "orderable":false  },
            { "data" : "estatusped", "width": "10%", "orderable":false },
              
          
            {
                    "render": function ( data, type, full, meta ) {
        return '<button data-toggle="dropdown" class="btn btn-primary btn-xs dropdown-toggle"> Acciones <span class="caret"></span></button><ul class="dropdown-menu"><li style = "font-size: 14px"><a href= \'edit_compra.php?id=' + full.nocompra +  '\'> &nbsp;<i class="far fa-edit"></i> Edicion</a></li> <li style = "font-size: 14px"><a href= \'factura/form_compra.php?id=' + full.nocompra + '\'  target="_blank">&nbsp; <i class="fa fa-print" ></i> Print</a> </li> <li style = "font-size: 14px"> <a data-toggle="modal" data-target="#modalSubefactura"  data-id=\'' + full.nocompra +  '\' data-name=\'' + full.razonsoc +  '\' data-docto=\'' + full.comprobante +  '\'  href="javascript:void(0)" > &nbsp;<i class="fas fa-file-upload" aria-hidden="true"></i> Carga Factura</a> </li> <li style = "font-size: 14px"><a href=\'visorpdf_comprobante.php?id= ' + full.nocompra + '\' target="_blank">&nbsp;<i class="fa fa-search" aria-hidden="true"></i> Ver Factura</a></li> <li style = "font-size: 14px"> <a data-toggle="modal" data-target="#modalSubePago"  data-id=\'' + full.nocompra +  '\' data-name=\'' + full.razonsoc +  '\' data-docto=\'' + full.compropago +  '\' href="javascript:void(0)" > &nbsp;<i class="fas fa-money-check-alt"></i> Carga Pago</a> </li> <li style = "font-size: 14px"><a href=\'visorpdf_comprobantepago.php?id= ' + full.nocompra + '\' target="_blank">&nbsp;<i class="fas fa-search-dollar"></i> Ver Pago</a></li> <li style = "font-size: 14px"> <a data-toggle="modal" data-target="#modalEditcliente"  data-id=\'' + full.pedidono +  '\' data-name=\'' + full.nocompra +  '\' href="javascript:void(0)">&nbsp;<i class="fa fa-ban"></i> Cancelar</a> </li></ul>'
         ;
    }                    
            
 } 


            
          ],
          "sDom": "B<'row'><'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-4'i>><'row'p>B",
    "buttons": [
        'copyHtml5',
        'excelHtml5',
        'csvHtml5',     
        {
            extend: 'colvis',
            postfixButtons: [ 'colvisRestore' ],
            columns: '0,1,2,3,4,5,6'
        }
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

      

            // Datapicker 
            $( ".datepicker" ).datepicker({
                language: 'es',
                "dateFormat": "yy-mm-dd",
                changeYear: true
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
  $(document).ready(function (e) {
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     var costoa = $(e.relatedTarget).data().costo;
     var fchaa  = $(e.relatedTarget).data().fchaa;
     var sdovta = $(e.relatedTarget).data().sueldo;
     var nunida = $(e.relatedTarget).data().unidades;
     var direc  = $(e.relatedTarget).data().direcc;
     var desti  = $(e.relatedTarget).data().destino;
     
    
      $(e.currentTarget).find('#form_pass_idc').val(idi);
      $(e.currentTarget).find('#inputCostov').val(costoa);
      $(e.currentTarget).find('#form_pass_dfinal').val(fchaa);
      $(e.currentTarget).find('#form_pass_sueldovta').val(sdovta);
      $(e.currentTarget).find('#form_pass_nounidades').val(nunida);
      $(e.currentTarget).find('#form_pass_origen').val(desti);
      $(e.currentTarget).find('#form_pass_destino').val(direc);
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Registrar Vuelta</h5>
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
            <input type="text" class="form-control" id="form_pass_idc" name="form_pass_idc" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Final:</label>
           <div class="col-sm-9">
              <input type="date" class="form-control" id="form_pass_dfinal" name="form_pass_dfinal">
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Hora de Regreso:</label>
           <div class="col-sm-9">
              <input type="time" class="form-control" id="form_pass_hregreso" name="form_pass_hregreso">
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Sueldo Operador:</label>
           <div class="col-sm-9">
              <input type="number" step="any" class="form-control" id="form_pass_sueldovta" name="form_pass_sueldovta">
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Origen:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_origen" name="form_pass_origen" >
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Destino:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_destino" name="form_pass_destino" >
           </div>
        </div> 

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Numero Unidades:</label>
           <div class="col-sm-9">
              <input type="number" class="form-control" id="form_pass_nounidades" name="form_pass_nounidades" >
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Costo:</label>
           <div class="col-sm-9">
              <input type="number" step="any" class="form-control" id="inputCostov" name="inputCostov" value="0">
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
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Registra Vuelta</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var idc       = $('#form_pass_idc').val();
        var datefin   = $('#form_pass_dfinal').val();
        var hregreso  = $('#form_pass_hregreso').val();
        var sueldovta = $('#form_pass_sueldovta').val(); 
        var origen    = $('#form_pass_origen').val();
        var destino   = $('#form_pass_destino').val();
        var unidades  = $('#form_pass_nounidades').val();
        var costo     = $('#inputCostov').val();


       var action       = 'AddEditVuelta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idc:idc, datefin:datefin, hregreso:hregreso, sueldovta:sueldovta, origen:origen, destino:destino, unidades:unidades, costo:costo},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            alert('Vuelta Registrada Correctamente');

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
function actualizarLaPagina(){
    window.location.reload();
} 
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalSubefactura').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     var mesel  = $(e.relatedTarget).data().name;
     var docto  = $(e.relatedTarget).data().docto;
  
     
    
      $(e.currentTarget).find('#form_pass_idc').val(idi);
      $(e.currentTarget).find('#form_pass_nombree').val(mesel);
      $(e.currentTarget).find('#form_pass_docto').val(docto);
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalSubefactura" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Carga Factura</h5>
      </div>
      <div class="modal-body">

        
        <form action="insertar_doctocompra.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
       
        <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Compra</label>
                     <div class="col-sm-10">
                     <input class="form-control" type="text" id="form_pass_idc" name="form_pass_idc"  readonly />
                </div>
             </div>

        <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Proveedor</label>
                     <div class="col-sm-10">
                     <input class="form-control" type="text" id="form_pass_nombree" name="form_pass_nombree"  readonly />
                </div>
             </div>

        <div class="form-group row" style="text-align:left;">

                    
                     <div class="col-sm-12">
                     <input class="form-control" type="text" id="form_pass_docto" name="form_pass_docto"  readonly />
                </div>
             </div>     

        <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Factura</label>
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
  $(document).ready(function (e) {
  $('#modalSubePago').on('show.bs.modal', function(e) { 

     var idp     = $(e.relatedTarget).data().id;
     var meselp  = $(e.relatedTarget).data().name;
     var doctop  = $(e.relatedTarget).data().docto;
  
     
    
      $(e.currentTarget).find('#form_pass_idp').val(idp);
      $(e.currentTarget).find('#form_pass_nombrep').val(meselp);
      $(e.currentTarget).find('#form_pass_doctop').val(doctop);
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalSubePago" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Carga Pago</h5>
      </div>
      <div class="modal-body">

        
        <form action="insertar_pagocompra.php" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
       
        <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Compra</label>
                     <div class="col-sm-10">
                     <input class="form-control" type="text" id="form_pass_idp" name="form_pass_idp"  readonly />
                </div>
             </div>

        <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Proveedor</label>
                     <div class="col-sm-10">
                     <input class="form-control" type="text" id="form_pass_nombrep" name="form_pass_nombrep"  readonly />
                </div>
             </div>

        <div class="form-group row" style="text-align:left;">

                    
                     <div class="col-sm-12">
                     <input class="form-control" type="text" id="form_pass_doctop" name="form_pass_doctop"  readonly />
                </div>
             </div>     

        <div class="form-group row" style="text-align:left;">

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pago</label>
                     <div class="col-sm-10">
                     <input class="form-control prevPhoto" type="file" name="archivop"  />
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
