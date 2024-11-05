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

  $sql01= mysqli_query($conection,"SELECT * FROM registro_viajes WHERE estatus= 1 and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' ");
  mysqli_close($conection);
  $result_sql01 = mysqli_num_rows($sql01);

    while ($data = mysqli_fetch_array($sql01)){
      $abiertos   = 0;
     
    }
     date_default_timezone_set('America/Mexico_City');

    $fechaActual = date("Y-m-d");

  $fcha = date("Y-m-d"); 
  $diafcha = date("w");
  $diasrest = 6 - $diafcha;
  $fchaini = date("Y-m-d",strtotime($fcha."- $diafcha days")); 
  $fchafin = date("Y-m-d",strtotime($fcha."+ $diasrest days")); 
  include "../conexion.php";

  $sql= mysqli_query($conection,"SELECT semana, dia_inicial, dia_final FROM semanas40 WHERE dia_inicial <= '$fechaActual' AND dia_final >= '$fechaActual'");
         mysqli_close($conection);
         $result = mysqli_num_rows($sql);
         

         while ($data = mysqli_fetch_array($sql)){
         $diainicial  = $data['dia_inicial'];
         $diafinal    = $data['dia_final'];
     
      
      //$user   = $_SESSION['idUser'];
      
    }

  if ($rol == 1) {
    include "../conexion.php";
    $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter'");
    mysqli_close($conection);
    $result_sql02 = mysqli_num_rows($sql02);

    while ($data = mysqli_fetch_array($sql02)){
      $tareahoy   = $data['viajeshoy'];
     
    }

    include "../conexion.php";
    $sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter'");
    mysqli_close($conection);
    $result_sql03 = mysqli_num_rows($sql03);
  
    while ($data = mysqli_fetch_array($sql03)){
    $tareasem   = $data['totalsem'];
       
    } 
  
  }else {  
    include "../conexion.php";
    $sql02= mysqli_query($conection,"SELECT count(*) as viajeshoy FROM registro_viajes WHERE estatus= 1 and fecha = '$fechaActual' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' and usuario_id = $rol");
    mysqli_close($conection);
    $result_sql02 = mysqli_num_rows($sql02);

    while ($data = mysqli_fetch_array($sql02)){
      $tareahoy   = $data['viajeshoy'];
     
    }
   
    include "../conexion.php";
    $sql03= mysqli_query($conection,"SELECT count(*) as totalsem FROM registro_viajes WHERE estatus= 1 and fecha between '$diainicial' and '$diafinal' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter' and usuario_id = $rol");
    mysqli_close($conection);
    $result_sql03 = mysqli_num_rows($sql03);
  
    while ($data = mysqli_fetch_array($sql03)){
     $tareasem   = $data['totalsem'];
       
    } 
}
 
 include "../conexion.php";
  $sql04= mysqli_query($conection,"SELECT *  FROM registro_viajes WHERE estatus = 1 and fecha < '$fchaini' and tipo_viaje like '%Especial%' or tipo_viaje  = 'Splinter'");
  mysqli_close($conection);
  $result_sql04 = mysqli_num_rows($sql04);

    while ($data = mysqli_fetch_array($sql04)){
      $tarearetraso   = 0;
     
  } 


  //*include "../conexion.php";
  //*$sqledo = "select estado from estados ORDER BY estado";
  //*$queryedo = mysqli_query($conection, $sqledo);
  //*$filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); 

 
?>
<!doctype html>
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

    <link href="DataTables/datatables.min.css" rel="stylesheet" type="text/css">
    <script src="DataTables/datatables.min.js"></script>
    
        
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
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <h4 class="m-0"> Registro de Servicios Especiales <small></small></h4>
          </div>
          <div class="col-sm-6 d-none d-sm-block">
          <ol class="breadcrumb float-sm-right">
            <?php
             if ($_SESSION['rol'] == 1 ) {

             ?> 
               <li class="breadcrumb-item"><a href="new_viajespecial.php"><i class="fas fa-plus" style="color: green;"></i><?php echo str_repeat('&nbsp;',2);?>Nuevo</a></li>

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
            <div class="col-md-1">
          <a href="#" class="btn btn-primary btn-block mb-3">Viajes</a>

         <div class="card">
            <div class="card-header">
              <h3 class="card-title">Folders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-0">
              <ul class="nav nav-pills flex-column">
                <!--<li class="nav-item active">
                  <a href="tareas.php" class="nav-link">
                    Tareas Abiertas
                    <span class="badge bg-primary float-right">0</span>
                  </a>
                </li>-->
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Hoy
                    <span class="badge bg-warning float-right"><?php echo $tareahoy;?></span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                   Sem
                   <span class="badge bg-success float-right"><?php echo $tareasem;?></span>
                  </a>
                </li>
                <!--<li class="nav-item">
                  <a href="tareas_atrasadas.php" class="nav-link">
                    Atrasadas
                    <span class="badge bg-warning float-right">0</span>
                  </a>
                </li>-->
                <!--<li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-trash-alt"></i> Mas...
                  </a>
                </li>-->
              </ul>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
          </div>
         <div class="col-md-11">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Viajes</h3>&nbsp;&nbsp;&nbsp;

               
              </div>
            
            <!-- Table -->
            <table id="empTable" class="display dataTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Direccion</th>
                    <th>Hora Inicio</th>
                    <th>Hora Regreso</th>
                    <th>Tipo Unidad</th>
                    <th>Destino</th>
                    <th>Estatus</th>
                    <th style="width:40px !important">
                       <div class="input-group"> <span class="input-group-addon"> 
                       <input type="checkbox" aria-label="Checkbox" class="checkall" id="checkall"> </span> &nbsp;
                       <button type="button" id="delete_record" class="btn btn-danger btn-xs">&nbsp;X&nbsp;</button> </div>
                    </th>
                    
                </tr>
                </thead>
                
            </table>
        </div>
  </div>  
 </div> 
</div>
        <!-- Script -->
        <script>
        var dataTable;
        $(document).ready(function(){

            // Initialize datatable
            dataTable = $('#empTable').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'ajax': {
                    'url':'data/ajaxfile.php',
                    'data': function(data){
                        // Read values
                        data.request = 1;
                    }
                },
                'columns': [
                    { data: 'id' },
                    { data: 'fecha' },
                    { data: 'cliente' },
                    { data: 'direccion' },
                    { data: 'hora_inicio' },
                    { data: 'hora_fin' },
                    { data: 'unidad' },
                    { data: 'destino' },
                    { data: 'estatus' },
                    { data: 'action' },

                 
          
                ],
                'columnDefs': [ {
                    'targets': [9], // column index (start from 0)
                    'orderable': false,  // set orderable false for selected columns
                }],

            });

            // Check all 
            $('#checkall').click(function(){
                if($(this).is(':checked')){
                    $('.delete_check').prop('checked', true);
                }else{
                    $('.delete_check').prop('checked', false);
                }
            });

            // Delete record
            $('#delete_record').click(function(){

                var deleteids_arr = [];
                // Read all checked checkboxes
                $("input:checkbox[class=delete_check]:checked").each(function () {
                    deleteids_arr.push($(this).val());
                });
                
                // Check checkbox checked or not
                if(deleteids_arr.length > 0){

                    // Confirm alert
                    var confirmdelete = confirm("Realmente quieres eliminar registros?");
                    if (confirmdelete == true) {
                        $.ajax({
                            url: 'data/ajaxfile.php',
                            type: 'post',
                            data: {request: 2,deleteids_arr: deleteids_arr},
                            success: function(response){
                                dataTable.ajax.reload();
                            }
                        });
                    } 
                }
            });

        });

        // Checkbox checked
        function checkcheckbox(){

            // Total checkboxes
            var length = $('.delete_check').length;

            // Total checked checkboxes
            var totalchecked = 0;
            $('.delete_check').each(function(){
                if($(this).is(':checked')){
                    totalchecked+=1;
                }
            }); 

            // Checked unchecked checkbox
            if(totalchecked == length){
                $("#checkall").prop('checked', true);
            }else{
                $('#checkall').prop('checked', false);
            }
        }

        </script>
    </body>
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
  
   <div class="modal fade" id="modalEditcliente"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
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


</html>
