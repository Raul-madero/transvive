<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
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

      <?php include('includes/generalnavbar.php');  ?>
      <?php include('includes/nav.php') ?>
      
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
            <h4 class="m-0"> Listado de <small>Rutas</small></h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <?php if ($rol == 18) {?>
            <li class="breadcrumb-item"><a href="new_ruta.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nueva</a></li>
             <?php }?>
             <li class="breadcrumb-item"><a href="factura/rutas_excel.php"><i class="fas fa-file-excel"></i> Excel</a></li>
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Navegacion</li>
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
                          <th>Cliente</th>
                          <th>Ruta</th>
                          <th>No. Eco</th>
                          <th>Operador</th>
                          <th>Hor. 1</th>
                          <th>Hor. 2</th>
                          <th>Hor. 3</th>
                          <th>Mix. 1</th>
                          <th>Dias</th>
                          <th>Estatus</th>
                          <?php if($rol == 5 || $rol == 1): ?>
                            <th>Acciones</th>
                          <?php endif; ?>
                          <!-- <th>Acciones</th> -->
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
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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

<script>
        $( document ).ready(function() {
var table = $('#example1').dataTable({
"bProcessing": true,
"sAjaxSource": "data/data_rutas.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'id', "sWidth": "20px" } ,
{ mData: 'cliente' ,"sWidth": "100px"},
{ mData: 'ruta' ,"sWidth": "100px"},
{ mData: 'no_eco' ,"sWidth": "20px"},
{ mData: 'operador' ,"sWidth": "200px"},
{ mData: 'Hora1' ,"sWidth": "20px"},
{ mData: 'Hora2' ,"sWidth": "20px"},
{ mData: 'Hora3' ,"sWidth": "20px"},
{ mData: 'Hmixto1' ,"sWidth": "20px"},
{ mData: 'dias' ,"sWidth": "20px"},
{ mData: 'Status' ,"sWidth": "20px"}
<?php if($rol == 5 || $rol == 1): ?>,
  {
    "render": function ( data, type, full, meta ) {
                          <?php if($_SESSION['rol'] == 5 || $rol = 1): ?>
            return '<a class="link_edit" style="color:#007bff;" href= \'edit_ruta.php?id=' + full.id +  '\'><i class="far fa-edit"></i></a> | <a data-toggle="modal" data-target="#modalEditcliente"  data-id=\'' + full.id +  '\' data-name=\'' + full.cliente +  '\' data-ruta=\'' + full.ruta +  '\' href="javascript:void(0)" class="link_delete" style="color:red" ><i class="far fa-trash-alt"></i> Baja</a>';
                          <?php endif; ?>
    }
  }
<?php endif; ?>
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
        "sLast": "Ultima",
      }
        }


       
});
});
        
    


            </script>


<script>
        $( document ).ready(function() {
var table = $('#listaClientes').dataTable({
"bProcessing": true,
"sAjaxSource": "data/data_clientes.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"aoColumns": [
{ mData: 'Empid' } ,
{ mData: 'Name' },
{ mData: 'Salary' },
{ mData: 'Linea' },
{ mData: 'Lugar'},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" href= \'editar_cliente.php?id=' + full.Empid +  '\'><i class="far fa-edit"></i> Editar</a> | <a id="delete_cliente" data-id=\'' + full.Name +  '\' href="javascript:void(0)" class="link_delete" ><i class="far fa-trash-alt"></i> Baja</a>';
    }
                    
            
 }                   

],

        "oLanguage": {
        "sEmptyTable": "No hay registros disponibles",
        "sInfo": "Hay _TOTAL_ registros. Mostrando de (_START_ a _END_)",
        "sLoadingRecords": "Por favor espera - Cargando...",
        "sSearch": "Buscar:",
        "sLengthMenu": "Mostrar _MENU_",
        
        }

       
});
});
        
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var idr     = $(e.relatedTarget).data().id;
     var cliente = $(e.relatedTarget).data().name;
     var ruta    = $(e.relatedTarget).data().ruta;
     
    
      $(e.currentTarget).find('#form_pass_idr').val(idr);
      $(e.currentTarget).find('#form_pass_cliente').val(cliente);
      $(e.currentTarget).find('#form_pass_ruta').val(ruta);
      
  });
});
</script>
  
   <div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Baja de Ruta</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <input type="hidden" class="form-control" id="form_pass_idr" name="form_pass_idr">

        <div class="form-group row">
           <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Cliente:</label>
           <div class="col-sm-8">
              <input type="text" class="form-control" id="form_pass_cliente" name="form_pass_cliente">
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Ruta:</label>
           <div class="col-sm-8">
              <input type="text" class="form-control" id="form_pass_ruta" name="form_pass_ruta">
           </div>
        </div>  

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

        var idr          = $('#form_pass_idr').val();
        var cliente      = $('#form_pass_cliente').val();
        var ruta         = $('#form_pass_ruta').val();

       var action       = 'BajaRuta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idr:idr, cliente:cliente, ruta:ruta},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            swal('Baja','Baja de Ruta Registrada','success').then((value) => {

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            })
    
                        }else{
                            console.log('no data');
                            swal('Error','Ruta ya fue dada de Baja','warning').then((value) => {

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
