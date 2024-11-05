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
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
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

     <?php
       if ($_SESSION['rol'] == 4) {
        include('includes/navbarsup.php');
      }else {
       if ($_SESSION['rol'] == 5) {
          include('includes/navbarrhuman.php');
         }else { 
           if ($_SESSION['rol'] == 6) {
              include('includes/navbarsup.php');
            }else {
               if ($_SESSION['rol'] == 2) {
                  include('includes/navbaroperador.php');
                }else { 
              include('includes/navbar.php');
            }
            } 
      } 
      } ?>
      <?php include('includes/navc.php') ?>
      
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
            <h4 class="m-0"> Listado de <small>Viajes del Operador</small></h4>
          </div><!-- /.col -->
          <!--
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="new_empleado.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nuevo</a></li>
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Layout</a></li>
              <li class="breadcrumb-item active">Navegacion</li>
            </ol>
          </div>
          -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <?php
         date_default_timezone_set('America/Mazatlan');
         $fcha = date("Y-m-d");
         $time = time();
         $horact = date("H:i:s", $time);
     ?>  
    
    <!-- Main content -->
    <div class="card">      
              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped" width="100%">
                  <thead>
                  <tr>
                    
                          <th>No.</th>
                          <th>Fecha</th>
                          <th>Cliente</th>
                          <th>Ruta</th>
                          <th>Tipo de Viaje</th>
                          <th>Estatus</th>
                          <th>link</th>
                          <th>Acciones</th>
                          <th></th>

                        
                  </tr>
                  </thead>
                  <tbody>
                </tbody>
                  <tfoot>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

   
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

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<!-- DataTables  & Plugins -->
<script src="../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../plugins/jszip/jszip.min.js"></script>
<script src="../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- DataTables JS library -->

<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

<script>
$( document ).ready(function() {
var table = $('#example1').dataTable({
"order": [[ 0, "desc" ]],
"bProcessing": true,
"sAjaxSource": "includes/loaddata.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'id', "sWidth": "10px" }, 
{ mData: 'Datereg' ,"sWidth": "100px"},
{ mData: 'cliente' ,"sWidth": "150px"},
{ mData: 'ruta' ,"sWidth": "150px"},
{ mData: 'tipo_viaje' ,"sWidth": "80px"},
{ mData: 'Status' ,"sWidth": "80px"},
{ mData: 'linkruta' ,"sWidth": "100px"},
{ mData: 'linkruta' }


], columnDefs: [
                { targets: [0] },
                { targets: [1] },
                { targets: [2] },
                { targets: [3] },
                { targets: [4] },
                { targets: [5] },
                { "bVisible": false, "aTargets": [ 6 ] },
                {
                    targets: [7], render: (data, type, full, row) => {
        return ' <a href="#" data href="#" data-toggle="modal" data-target="#modalEditcliente" class="btn btn-primary btn-sm" data-id=\'' + full.id +  '\' href="#" class="link_delete" style="color:#f8fcf7" ><i class="fa fa-rotate-left">Inicia</a> &nbsp;&nbsp; <a href="#" data href="#" data-toggle="modal" data-target="#modalEditFinal" class="btn btn-success btn-sm" data-id=\'' + full.id +  '\' href="#" class="link_delete" style="color:#f8fcf7" ><i class="fa fa-rotate-left">Termina</a>&nbsp;&nbsp;<button type="button" class="btn btn-secondary btn-sm" id="button1" data-sample-id="gotcha!" onclick="myFunction(\'' + full.linkruta +  '\')"> Ruta </button>';
    }
                },
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
var table = $('#example3').dataTable({
"bProcessing": true,
"sAjaxSource": "data/data_empleados.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'noempleado', "sWidth": "50px" } ,
{ mData: 'nombres' ,"sWidth": "300px"},
{ mData: 'apellido_paterno' ,"sWidth": "200px"},
{ mData: 'apellido_materno' ,"sWidth": "200px"},
{ mData: 'Status' ,"sWidth": "10px"},
{
                    "render": function ( data, type, full, meta ) {
        return '<a class="link_edit" style="color:#007bff;" href= \'edit_empleado.php?id=' + full.noempleado +  '\'><i class="far fa-edit"></i> Editar</a> | <a data-toggle="modal" data-target="#modalEditcliente"  data-id=\'' + full.noempleado +  '\' data-name=\'' + full.nombres + ' ' + full.apellido_paterno + ' ' + full.apellido_materno +  '\' href="javascript:void(0)" class="link_delete" style="color:red" ><i class="far fa-trash-alt"></i> Baja</a>';
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
        "sLast": "Ultima",
      }
        }


       
});
});
        
            </script>




<script type="text/javascript">


 /* it will load products when document loads */

$(document).on('click', '#delete_cliente', function(e){

 e.preventDefault();
       var clienteId = $(this).data('id');
        var action = 'deleteEmpleado';
        swal({
  title: "Desea Eliminar Al Empleado ?",
  text: " " + clienteId,
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
                    swal('Eliminado','Empleado Borrado Correctamente','success').then((value) => {
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

<script> 
  $(document).ready(function (e) {
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     
  
     
    
      $(e.currentTarget).find('#form_pass_idc').val(idi);
   
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Inicio de Viaje</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Folio Viaje:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_idc" name="form_pass_idc" readonly>
           </div>
        </div>  

       

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Fecha Inicio Viaje:</label>
           <div class="col-sm-10">
              <input type="date" class="form-control" id="form_pass_dateinicio" name="form_pass_dateinicio" value="<?php echo $fcha;?>">
           </div>
        </div>  

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Hora Inicio:</label>
           <div class="col-sm-10">
              <input type="time" class="form-control" id="form_pass_horainicio" name="form_pass_horainicio" value="<?php echo $horact;?>">
           </div>
        </div> 

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Cordenadas:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="coords" name="coords" value="">
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
        <button type="button" class="btn btn-primary pull-right" href="#" id="actualizainicioviaje"><i class="fa fa-save"></i>&nbsp;Guardar Inicio de Viaje</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>

      function pos_ok (posicion) {
    console.log(posicion);
    var latitud  = posicion.coords.latitude;
    var longitud = posicion.coords.longitude;
    document.getElementById('coords').value = latitud + ',' + longitud;
    document.getElementById('coordsfin').value = latitud + ',' + longitud;
  }

  function pos_fallo () {
    console.log('Error al geolocalizar.');
  }

  if(!navigator.geolocation) {
    console.log('Geolocalización no disponible.');
  } else {
    console.log('Geolocalizando...');
    navigator.geolocation.getCurrentPosition(pos_ok, pos_fallo);
  }

    </script>  

<script>
   $('#actualizainicioviaje').click(function(e){
        e.preventDefault();

        var idc          = $('#form_pass_idc').val();
        var fecha_inicio = $('#form_pass_dateinicio').val();
        var hora_inicio  = $('#form_pass_horainicio').val();
        var ubicacion    = $('#coords').val();

       var action       = 'IniciodeViaje';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idc:idc, fecha_inicio:fecha_inicio, hora_inicio:hora_inicio, ubicacion:ubicacion},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            swal('Correcto','Inicio de Viaje Registrado','success').then((value) => {

                            $('#modalEditcliente').modal('hide')
                            location.reload(true);
                            })
    
                        }else{
                            console.log('no data');
                            swal('Error','No se guardo el registro','warning').then((value) => {

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
  $('#modalEditFinal').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     
  
     
    
      $(e.currentTarget).find('#form_pass_idf').val(idi);
   
     
      
  });
});
</script>
  
   <div class="modal fade" id="modalEditFinal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Viaje Terminado</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Folio Viaje:</label>
           <div class="col-sm-9">
              <input type="text" class="form-control" id="form_pass_idf" name="form_pass_idf" readonly>
           </div>
        </div>  

       

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Fecha Fin de Viaje:</label>
           <div class="col-sm-10">
              <input type="date" class="form-control" id="form_pass_datefin" name="form_pass_datefin" value="<?php echo $fcha;?>">
           </div>
        </div>  

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Hora Fin:</label>
           <div class="col-sm-10">
              <input type="time" class="form-control" id="form_pass_horafin" name="form_pass_horafin" value="<?php echo $horact;?>">
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. Personas:</label>
           <div class="col-sm-9">
              <input type="number" class="form-control" id="form_pass_personas" name="form_pass_personas">
           </div>
        </div>

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Cordenadas:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="coordsfin" name="coordsfin" value="">
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
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizafinviaje"><i class="fa fa-save"></i>&nbsp;Guardar Termino de Viaje</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>



<script>
   $('#actualizafinviaje').click(function(e){
        e.preventDefault();

        var idf          = $('#form_pass_idf').val();
        var fecha_fin    = $('#form_pass_datefin').val();
        var hora_fin     = $('#form_pass_horafin').val();
        var personas     = $('#form_pass_personas').val();
        var ubicacionfin = $('#coordsfin').val();

       var action       = 'FindeViaje';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idf:idf, fecha_fin:fecha_fin, hora_fin:hora_fin, personas:personas, ubicacionfin:ubicacionfin},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //--$('#detalle_inspeccion').html(info.detalle);
                            
                           
                            swal('Correcto','Fin de Viaje Registrado','success').then((value) => {

                            $('#modalEditFinal').modal('hide')
                            location.reload(true);
                            })
    
                        }else{
                            console.log('no data');
                            swal('Error','No se guardo el registro','warning').then((value) => {

                            $('#modalEditFinal').modal('hide')
                            
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
  $('#modalDeleteContacto').on('show.bs.modal', function(e) { 

     var idi    = $(e.relatedTarget).data().id;
     var mesel  = $(e.relatedTarget).data().cmes;
     var indic1 = $(e.relatedTarget).data().cind1;
    
     
    
      $(e.currentTarget).find('#form_pass_idbc').val(idi);
      $(e.currentTarget).find('#form_pass_nombrebc').val(mesel);
      $(e.currentTarget).find('#form_pass_contactobc').val(indic1);
     
      
  });
});

    </script> 

<script language=javascript>
function myFunction (url){
window.open(url)
}
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
