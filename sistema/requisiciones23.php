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


<!------ Include the above in your HEAD tag ---------->

    <script src="./js/jquery.dataTables.min.js"></script>
    <script src="./js/dataTables.bootstrap4.min.js"></script>
    
        
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,300i,400,400i,500,500i,600,600i,700,700i&amp;subset=latin-ext">
     <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
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
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE ERP"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php include('includes/generalnavbar.php'); ?>
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
          <h4 class="m-0"> Listado de Requisiciones de Compra <small><i class="fas fa-file"></i></small></h4>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
          <ol class="breadcrumb float-sm-right">
            
             <li class="breadcrumb-item"><a href="new_cotizacioncompra.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nueva</a></li>
             <!-- <li class="breadcrumb-item"><a href="#"><i class="fas fa-file-excel"></i> Excel</a></li>-->
             <li class="breadcrumb-item"><a href="factura/requisiciones_excel.php"><i class="fas fa-file-excel"></i> Excel</a></li>
         
              <li class="breadcrumb-item"><a href="#">Home</a></li>
             
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
                        <select class="form-control" name='gender' id='gender'>
                          <option value="">Estatus</option>
                          <option value="Activa">Activa</option>
                          <option value="Autorizada">Autorizada</option>
                          <option value="Procesada">Procesada</option>
                          <option value="Cancelada">Cancelada</option>
                        </select>
                        <!-- <input type='text' name='gender' id='gender' placeholder="Folio">-->
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
                <th style="text-align: center; font-size: 12px;">Id</th>
                <th style="text-align: center; font-size: 12px;">No. Requisicion</th>
                <th style="text-align: center; font-size: 12px;">Fecha</th>
                <th style="text-align: center; font-size: 12px;">Fecha Requiere Material</th>
                <th style="text-align: center; font-size: 12px;">Tipo</th>
                <th style="text-align: center; font-size: 12px;">Area Solicitante</th>
                <th style="text-align: center; font-size: 12px;">Monto</th>
                <th style="text-align: center; font-size: 12px;">Observaciones</th>
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

   
   <?php
      if ($_SESSION['idUser'] == 17 || $_SESSION['idUser'] == 3) {
         
       
   ?>
 
    <script type="text/javascript">

      load_data(); // first load

      function load_data(initial_date, final_date, gender){
        var ajax_url = "data/datadetorders_req.php";

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
            { 
              "data": "Folio", 
              "width": "3%", 
              "className": "text-right", 
              "render": function(data, type, full, meta) {
                return 'req-' + data; // Sin etiquetas HTML
              }
            },
            { "data" : "fechaa", "width": "8%", className: "text-center" },            
            { "data" : "fecha_req", "width": "10%", "orderable": false},
            { "data" : "tipor", "width": "5%", "orderable":false },
            { "data" : "arear", "width": "10%", "orderable":false },
            { "data" : "monto", "width": "6%", render: $.fn.dataTable.render.number( ',', '.', 2 ), className: "text-right", "orderable":false },
            { "data" : "notas", "width": "27%", "orderable":false },
            { "data" : "estatusped", "width": "8%", "orderable":false },
              
          
            {

                    "render": function ( data, type, full, meta ) {
        return '<!--<a class="link_edit" style="color:#007bff;" href= \'edit_cotizacioncompra.php?id=' + full.pedidono +  '\'><i class="far fa-edit"></i> Edit</a> | --><a href= \'factura/requisicion.php?id=' + full.Folio + '\'  target="_blank"><i class="fa fa-print" style="color:#white; font-size: 1.3em"></i> Print</a> | <a data-toggle="modal" data-target="#modalEditcliente"  data-id=\'' + full.Folio +  '\' data-date=\'' + full.fecha_req +  '\' data-name=\'' + full.tipor +  '\' href="javascript:void(0)">&nbsp;<i class="fa fa-thumbs-up"></i> Authorize</a> <!--| <a data-toggle="modal" data-target="#modalBorra"  data-id=\'' + full.Folio +  '\' data-name=\'' + full.arear +  '\' href="javascript:void(0)" class="link_delete" style="color:red" ><i class="fa fa-trash"></i> Delete</a>--> ';
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

  <?php
  } else {
   
  ?>
   <script type="text/javascript">

      load_data(); // first load

      function load_data(initial_date, final_date, gender){
        var ajax_url = "data/datadetorders_req.php";

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
            { 
              "data": "Folio", 
              "width": "3%", 
              "className": "text-right", 
              "render": function(data, type, full, meta) {
                return 'req-' + data; // Sin etiquetas HTML
              }
            },
            { "data" : "fechaa", "width": "8%", className: "text-center" },            
            { "data" : "fecha_req", "width": "10%", className:"text-center", "orderable": false},
            { "data" : "tipor", "width": "5%", "orderable":false },
            { "data" : "arear", "width": "10%", "orderable":false },
            { "data" : "monto", "width": "6%", render: $.fn.dataTable.render.number( ',', '.', 2 ), className: "text-right", "orderable":false },
            { "data" : "notas", "width": "27%", "orderable":false },
            { "data" : "estatusped", "width": "8%", "orderable":false },
              
          
            {

                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" style="color:#007bff;" href= \'edit_cotizacioncompra.php?id=' + full.pedidono +  '\'><i class="far fa-edit"></i> </a> | <a href= \'factura/requisicion.php?id=' + full.Folio + '\'  target="_blank"><i class="fa fa-print" style="color:#white; font-size: 1.3em"></i> </a> | <a data-toggle="modal" data-target="#modalCancela"  data-id=\'' + full.Folio +  '\' data-date=\'' + full.fecha_req +  '\' data-name=\'' + full.arear +  '\' href="javascript:void(0)">&nbsp;<i class="fa fa-ban"></i></a> | <a data-toggle="modal" data-target="#modalBorra"  data-id=\'' + full.Folio +  '\' data-name=\'' + full.arear +  '\' href="javascript:void(0)" class="link_delete" style="color:red" ><i class="fa fa-trash"></i> </a> ';
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
<?php

}
?>


<script type="text/javascript">


 /* it will load products when document loads */

$(document).on('click', '#delete_cliente', function(e){

 e.preventDefault();
       var clienteId = $(this).data('id');
        var action = 'deleteCargac';
        swal({
  title: "Desea Eliminar El Folio ?",
  text: "Carga de Combustible No." + clienteId,
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
            data: {action:action, clienteId:clienteId},
            success: function(response)
            {
                if(response != 0){
                    swal('Eliminado','Carga de Combustible Borrada Correctamente','success').then((value) => {
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
    swal("Accion Cancelada Registro no Borrado !");
  }
});
        
        

         }); 
    
</script>
    
<script src="js/sweetalert2.all.min.js"></script>   
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 

<script>
function actualizarLaPagina(){
    window.location.reload();
} 
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var noreq    = $(e.relatedTarget).data().id;
     var datereq  = $(e.relatedTarget).data().date;
     var tiporeq  = $(e.relatedTarget).data().name;
    
    
      $(e.currentTarget).find('#form_pass_noreq').val(noreq);
      $(e.currentTarget).find('#form_pass_datereq').val(datereq);
      $(e.currentTarget).find('#form_pass_tiporeq').val(tiporeq);

      
  });
});
</script>
  
   <div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Autorizar Requisicion</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. Requisición:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_noreq" name="form_pass_noreq" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fecha en que se requiere:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_datereq" name="form_pass_datereq" disabled>
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Tipo de Requisición:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_tiporeq" name="form_pass_tiporeq" disabled>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Autorizacion:</label>
           <div class="col-sm-9">
              <input type="password" autocomplete="new-password" class="form-control" id="form_pass_firma" name="form_pass_firma">
           </div>
        </div> 


    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Autorizar</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var noreq     = $('#form_pass_noreq').val();
        var datereq   = $('#form_pass_datereq').val();
        var tiporeq   = $('#form_pass_tiporeq').val();
        var firmareq  = $('#form_pass_firma').val(); 


        var action       = 'AddFirmaAreq';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, noreq:noreq, datereq:datereq, tiporeq:tiporeq, firmareq:firmareq},

                    success: function(response)
                    {
                       if(response != 'error')
                        {
                         console.log(response);
                        var info = JSON.parse(response);
                        console.log(info);
                        $mensaje=(info.mensaje);
                          if ($mensaje === undefined)
                          {

                            bootbox.alert({
                                message: 'REQUISICION AUTORIZADA!',
                                callback: function () {
                                $('#modalEditcliente').modal('hide')
                                $('#form_pass_firma').val('');
                                location.reload(true);
                                }
                                });
                           

                         }else {  
                           //$('#modalEditcliente').modal('hide')
                          $('#form_pass_firma').val('');
                            bootbox.alert('ERROR! ' + $mensaje);
                            
                            
                        }

                                                        
    
                        }else{
                          Swal.fire({
                            icon: 'info',
                            title: '',
                            text: 'Capture los datos requeridos',
                            })
        
                        }
                 },
                 error: function(error) {
                 }

               });

    });

    </script>  

    <script> 
  $(document).ready(function (e) {
  $('#modalBorra').on('show.bs.modal', function(e) { 

     var noreqi    = $(e.relatedTarget).data().id;
     var areareqi  = $(e.relatedTarget).data().name;
    
    
      $(e.currentTarget).find('#form_pass_noreqi').val(noreqi);
      $(e.currentTarget).find('#form_pass_areareqi').val(areareqi);

      
  });
});
</script>
  
   <div class="modal fade" id="modalBorra" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Borrar Requisicion</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. Requisición:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_noreqi" name="form_pass_noreqi" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Departamento que requiere:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_areareqi" name="form_pass_areareqi">
           </div>
        </div>  

   
           
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="borrarequisicion"><i class="fa fa-trash"></i>&nbsp;Borrar</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#borrarequisicion').click(function(e){
        e.preventDefault();

        var noreqi     = $('#form_pass_noreqi').val();
        var areareqi   = $('#form_pass_areareqi').val();

        var action       = 'Borrarequisicion';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, noreqi:noreqi, areareqi:areareqi},

                    success: function(response)
                    {
                       if(response != 'error')
                        {
                         console.log(response);
                        var info = JSON.parse(response);
                        console.log(info);
                        $mensaje=(info.mensaje);
                          if ($mensaje === undefined)
                          {

                            bootbox.alert({
                                message: 'REQUISICION BORRADA!',
                                callback: function () {
                                $('#modalBorra').modal('hide')
                                location.reload(true);
                                }
                                });
                           

                         }else {  
                           //$('#modalEditcliente').modal('hide')
                          
                            bootbox.alert('ERROR! ' + $mensaje);
                            
                            
                        }

                                                        
    
                        }else{
                          Swal.fire({
                            icon: 'info',
                            title: '',
                            text: 'Capture los datos requeridos',
                            })
        
                        }
                 },
                 error: function(error) {
                 }

               });

    });

    </script>  


    <script> 
  $(document).ready(function (e) {
  $('#modalCancela').on('show.bs.modal', function(e) { 

     var noreqc    = $(e.relatedTarget).data().id;
     var datereqc  = $(e.relatedTarget).data().date;
     var namepc    = $(e.relatedTarget).data().name;
    
    
      $(e.currentTarget).find('#form_pass_noreqic').val(noreqc);
      $(e.currentTarget).find('#form_pass_daterc').val(datereqc);
      $(e.currentTarget).find('#form_pass_provec').val(namepc);

      
  });
});
</script>
  
   <div class="modal fade" id="modalCancela" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Cancela Requisicion</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. Requisición:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_noreqic" name="form_pass_noreqi" disabled>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fecha:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="form_pass_daterc" name="form_pass_daterc" disabled>
           </div>
        </div> 
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Area que Solicita:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_provec" name="form_pass_provec">
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Motivo Cancelación:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_motivoc" name="form_pass_motivoc">
           </div>
        </div>    

   
           
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="cancelarequisicion"><i class="fa fa-ban"></i>&nbsp;Cancelar</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#cancelarequisicion').click(function(e){
        e.preventDefault();

        var noreqc     = $('#form_pass_noreqic').val();
        var daterc     = $('#form_pass_daterc').val();
        var areasc     = $('#form_pass_provec').val();
        var motivoc    = $('#form_pass_motivoc').val();

        var action       = 'Cancelarequisicion';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, noreqc:noreqc, daterc:daterc, areasc:areasc, motivoc:motivoc},

                    success: function(response)
                    {
                       if(response != 'error')
                        {
                         console.log(response);
                        var info = JSON.parse(response);
                        console.log(info);
                        $mensaje=(info.mensaje);
                          if ($mensaje === undefined)
                          {

                            bootbox.alert({
                                message: 'REQUISICION CANCELADA!',
                                callback: function () {
                                $('#modalCancela').modal('hide')
                                location.reload(true);
                                }
                                });
                           

                         }else {  
                           //$('#modalEditcliente').modal('hide')
                          
                            bootbox.alert('ERROR! ' + $mensaje);
                            
                            
                        }

                                                        
    
                        }else{
                          Swal.fire({
                            icon: 'info',
                            title: '',
                            text: 'Capture los datos requeridos',
                            })
        
                        }
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
