<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];
  if (!isset($_SESSION['idUser'])) {
  header('Location: ../index.php');
}

  $espacio = "--------";

  //Mostrar Datos
  if(empty($_REQUEST['id']))
  {
    header('Location: nominas_especiales.php');
    mysqli_close($conection);
  } 
        $idnom = $_REQUEST['id'];
  

  mysqli_close($conection);
?>
<html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRANSVIVE | ERP</title>
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://markcell.github.io/jquery-tabledit/assets/js/tabledit.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css"> 
  <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
            
        }

        table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #699497;
            color: white;
  
        }

        a {
           margin-right: 10px;
        }

        .table{
   zoom: 60%;
}



        .edit-field {
            border: none;
            background-color: transparent;
            width: 100%;
        }

        .editable {
            cursor: pointer;
            color: blue;
        }

        .editable:hover {
            text-decoration: underline;
        }

        .mi-tabla {
           font-size: 8px;
           font-family: Arial, sans-serif;
        }

  /* Add Animation - Zoom in the Modal */
.modal-content, #caption {
  animation-name: zoom;
  animation-duration: 0.6s;
}

@keyframes zoom {
  from {transform:scale(0)}
  to {transform:scale(1)}
}

    </style>
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
              include('includes/navbaroperac.php');
             }else { 
               if ($_SESSION['rol'] == 8) {
                  include('includes/navbarjefeoper.php');
                }else { 
                    if ($_SESSION['rol'] == 9) {
                        include('includes/navbargrcia.php');
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

  <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="nominas_especiales.php">Nominas Especiales</a></li>
              <li class="breadcrumb-item active">Edición</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    
   <br />
           <div class="card">
              <div class="card-header">
                <h1 class="card-title">EDICION DE NOMINA ESPECIAL&nbsp;&nbsp;&nbsp;</h1>
                <div>
                
              </div>
                 <div>
               <button type ="button" class="btn btn-warning pull-left" href="#" id="CerrarTablanomina"><i class="fa fa-undo"></i> Cerrar</button>
              </div>
              </div>
             
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No. Emp.</th>
                    <th>Empleado</th>
                    <th>Fecha Ingreso</th>
                    <th>Fecha Pago</th>
                    <th>Dias Aguinaldo</th>
                    <th>Dias Proporcionales</th>
                    <th>Salario Diario</th>
                    <th>Importe Aguinaldo</th>
                    <th>Importe Fiscal</th>
                    <th>Impuesto Fiscal</th>
                    <th>Deposito</th>
                    <th>Importe Efectivo</th>
                    <th>Actions</th>
                  </tr>
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
  </div>



  </div>
 

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="../plugins/toastr/toastr.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="js/sweetalert2.all.min.js"></script> 
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



<!--
<script type="text/javascript" language="javascript" src="script2.js"></script>
-->
 
       <script>
        $(document).ready(function() {
    // Escuchar cambios en los campos editables
    $('.edit-field').on('change', function() {
        var id = $(this).data('id');
        var field = $(this).data('field');
        var value = $(this).val();

        // Guardar cambios en la base de datos
        $.ajax({
            method: 'POST',
            url: 'guardar_cambios.php',
            data: {
                id: id,
                field: field,
                value: value
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
});
    </script>
    <script>
     function llenarTabla() {
    var semana = document.getElementById("semana").value;

   var action       = 'ActualizaNomina';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, semana:semana},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_nomina').html(info.detalle);
    
                        }else{
                           console.log('no data');
                           alert('faltan datos');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

}
    </script>

    <script>
   $('#llenarTablanomina').click(function(e){
        e.preventDefault();

        //var semana = document.getElementById("semana").value;
         var semana     = $('#nosemana').val();
      

       var action       = 'ActualizaNominaSemanal';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, semana:semana},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //$('#detalle_nomina').html(info.detalle);
                            location.reload();
    
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
     function CerrarTabla() {
    

   var semana     = $('#nosemana').val();

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, semana:semana},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                             location.href = 'nominas.php';

                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

}
    </script>

     <script>
   $('#CerrarTablanomina').click(function(e){
        e.preventDefault();
/*
        //var semana = document.getElementById("semana").value;
        var semana     = $('#nosemana').val();
      

       var action       = 'CerrarNominaEspecial';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, semana:semana},

                    success: function(response)
                    {
                       if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');*/
                             location.href = 'nominas_especiales.php';
/*
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });*/

    });

    </script>

    <script> 
    function del_detalle_nomsem(id){
    var action = 'delDetnomsem';
    var id_detalle = id;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, id_detalle:id_detalle},

        success: function(response)
        {
                      if(response != 'error')
                        {
                            console.log(response);
                            var info = JSON.parse(response);
                            $('#detalle_nomina').html(info.detalledelete);
                           

                        }else{
                           $('#detalle_nomina').html('');
                        }
                        //viewProcesar();
                 },
        error: function(error) {
        }
    });
}

    </script> 

    <script>
   $('#autorizarNomina').click(function(e){
        e.preventDefault();

        //var semana = document.getElementById("semana").value;
        var semana     = $('#nosemana').val();
      

       var action       = 'AutorizaNomina';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, semana:semana},

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
                            Swal
                         .fire({
                          title: "Exito!",
                          text: "NOMINA AUTORIZADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'nominas_especiales.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'nominas.php';
                        }
                        });


                         }else {  
                            
                            //swal('Mensaje del sistema', $mensaje, 'warning');
                            //location.reload();
                            Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: $mensaje,
                            })
                        }

                                                        
    
                        }else{
                          Swal.fire({
                            icon: 'info',
                            title: '',
                            text: 'NOMINA YA AUTORIZADA',
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
  $('#modalIndicador').on('show.bs.modal', function(e) {    
     var idem      = $(e.relatedTarget).data().id;
     var nosem     = $(e.relatedTarget).data().nosem;
     var noempl    = $(e.relatedTarget).data().noempl;
     var name      = $(e.relatedTarget).data().name;
     var dias      = $(e.relatedTarget).data().dias;
     var dedfiscal = $(e.relatedTarget).data().cargo;
     var vacacions = $(e.relatedTarget).data().imss;
     var primavac  = $(e.relatedTarget).data().vesp;
     var tot_nom   = $(e.relatedTarget).data().totnom;
     var tot_gral  = $(e.relatedTarget).data().totgral; 
   
    
      $(e.currentTarget).find('#txt_id').val(idem);
      $(e.currentTarget).find('#txt_nosemana').val(nosem);
      $(e.currentTarget).find('#txt_noempleado').val(noempl);
      $(e.currentTarget).find('#txt_nombre').val(name);
      $(e.currentTarget).find('#txt_dias').val(dias);
      $(e.currentTarget).find('#txt_deduccion').val(dedfiscal);
      $(e.currentTarget).find('#txt_vacaciones').val(vacacions);
      $(e.currentTarget).find('#txt_primavac').val(primavac);  
      $(e.currentTarget).find('#txt_nomfiscal').val(tot_nom);
      $(e.currentTarget).find('#txt_nomgral').val(tot_gral);  
  });
});

    </script> 

    <!-- Modal - Update User details -->
<div class="modal fade" id="modalIndicador" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Registro de Vacaciones</h5>
      </div>
      <div class="modal-body">
        <form>

        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

           <div class="col-md-12" hidden>
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> ID:</i></span>
                      <input name="txt_id" id="txt_id" type="text" class="form-control" disabled>
                    </div>
             </div>  

           <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> No. Semana:</i></span>
                      <input name="txt_nosemana" id="txt_nosemana" type="text" class="form-control" readonly>
                    </div>
             </div>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> No. Empleado:</i></span>
                      <input name="txt_noempleado" id="txt_noempleado" type="text" class="form-control" readonly>
                    </div>
             </div>

          <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Nombre:</i></span>
                      <input name="txt_nombre" id="txt_nombre" type="text" class="form-control" readonly>
                    </div>
             </div>

             <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 



        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Días Vaciones por Antiguedad:</i></span>
                      <input style="text-align:right;" name="txt_dias" id="txt_dias" type="text" class="form-control" readonly>
                    </div>
             </div>    

         <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Dias de Vacaciones:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_vacaciones" id="txt_vacaciones" type="number" class="form-control"  onkeyup="PasarValor();" value="0">
                    </div>
             </div>  

             <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>  

        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Prima Vacaciones (Fiscal):&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_primavac" id="txt_primavac" type="text" class="form-control" value="0">
                    </div>
             </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>      

           <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Importe Vacaciones (Fiscal):&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_vacafiscal" id="txt_vacafiscal" type="text" class="form-control" value="0">
                    </div>
             </div>

            

              <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Importe Vacaciones:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_vacanof" id="txt_vacanof" type="text" class="form-control" value="0">
                    </div>
             </div>
             <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 
        
         <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Total Nomina (Fiscal):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_nomfiscal" id="txt_nomfiscal" type="text" class="form-control" >
                    </div>
             </div>

           <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Impuesto (Fiscal):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_deduccion" id="txt_deduccion" type="text" class="form-control" >
                    </div>
             </div>   

             <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

         <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Total General:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_nomgral" id="txt_nomgral" type="text" class="form-control" >
                    </div>
        </div>     

    

     
        </form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualiza_partidafact"><i class="fa fa-save"></i>&nbsp;Aplicar</button>
      </div>
    </div>
  </div>
</div> 
<script>
function PasarValor()
{
document.getElementById("txt_primavac").value = document.getElementById("txt_vacaciones").value * .25;
}
</script>
<script>
   $('#actualiza_partidafact').click(function(e){
        e.preventDefault();

        var idempl       = $('#txt_id').val();
        var nosemana     = $('#txt_nosemana').val();
        var noempleado   = $('#txt_noempleado').val();
        var empleado     = $('#txt_nombre').val();
        var diasvac      = $('#txt_dias').val();
        var primavac     = $('#txt_primavac').val();
        var vacaciones   = $('#txt_vacaciones').val();
        var importevacfi = $('#txt_vacafiscal').val();
        var importevacgr = $('#txt_vacanof').val();
        var nominafis    = $('#txt_nomfiscal').val();
        var impuestofis  = $('#txt_deduccion').val();
        var nominagral   = $('#txt_nomgral').val();

        var action       = 'ActualizaPrimavacSem';
    
        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idempl:idempl, nosemana:nosemana, noempleado:noempleado, empleado:empleado, diasvac:diasvac, primavac:primavac, vacaciones:vacaciones, importevacfi:importevacfi, importevacgr:importevacgr, nominafis:nominafis, impuestofis:impuestofis, nominagral:nominagral},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                             alert('Importes Aplicados');
                            //*$('#modalIndicador').modal('hide');
                            $('#detalle_nomina').html(info.detalle);
                            //*$('#modalIndicador').modal('hide');
    
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
  $('#modalVacaciones').on('show.bs.modal', function(e) {    
     var idem      = $(e.relatedTarget).data().id;   
     var dias      = $(e.relatedTarget).data().dias;
     var noemple   = $(e.relatedTarget).data().noempl;
     var nameempl  = $(e.relatedTarget).data().name;
  
      $(e.currentTarget).find('#txt_id').val(idem);
      $(e.currentTarget).find('#txt_dias').val(dias);
      $(e.currentTarget).find('#txt_noempleado').val(noemple);
      $(e.currentTarget).find('#txt_nombre').val(nameempl);
        
  });
});

    </script> 

  <script> 
  $(document).ready(function (e) {
  $('#modalDeletecliente').on('show.bs.modal', function(e) { 

     var noempleado = $(e.relatedTarget).data().id;
     var nosemana   = $(e.relatedTarget).data().sem;
    
    
      $(e.currentTarget).find('#form_pass_noempleado').val(noempleado);
      $(e.currentTarget).find('#form_pass_nosem').val(nosemana);
      
  });
});
</script>
  
   <div class="modal fade" id="modalDeletecliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Quitar Empleado de Nomina</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

        <input type="hidden" class="form-control" id="form_pass_nosem" name="form_pass_nosem" disabled>
        <div class="form-group row">
           <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">No. de Empleado:</label>
           <div class="col-sm-8">
            <input type="text" class="form-control" id="form_pass_noempleado" name="form_pass_noempleado" disabled>
           </div>
        </div> 
        

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Quitar</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

 <script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        //var semana = document.getElementById("semana").value;
         var nsemana    = $('#form_pass_nosem').val();
         var noempleado = $('#form_pass_noempleado').val();
         var action     = 'DeleteEmpleadoNomEspcEdit';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, nsemana:nsemana, noempleado:noempleado},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            //$('#detalle_nomina').html(info.detalle);
                            location.reload();
    
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
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var noempl    = $(e.relatedTarget).data().num;
     var namepl    = $(e.relatedTarget).data().name;
     var dateing   = $(e.relatedTarget).data().fing;
     var datepag   = $(e.relatedTarget).data().fpag;
     var daysagu   = $(e.relatedTarget).data().diagu;
     var daydere   = $(e.relatedTarget).data().diade;
     var saldia    = $(e.relatedTarget).data().saldi;
     var impagui   = $(e.relatedTarget).data().impag;
     var impfisc   = $(e.relatedTarget).data().impfis;
     var dedfisc   = $(e.relatedTarget).data().dedfis;
     var deposito  = $(e.relatedTarget).data().depos;
     var efectivo  = $(e.relatedTarget).data().efect;
     var deduce    = $(e.relatedTarget).data().dedfis;
     var gtotal    = $(e.relatedTarget).data().total;


      $(e.currentTarget).find('#form_pass_noempl').val(noempl);
      $(e.currentTarget).find('#form_pass_namepl').val(namepl);
      $(e.currentTarget).find('#form_pass_dateing').val(dateing);
      $(e.currentTarget).find('#form_pass_datepag').val(datepag);
      $(e.currentTarget).find('#form_pass_dayaguinaldo').val(daysagu);
      $(e.currentTarget).find('#form_pass_dayderecho').val(daydere);
      $(e.currentTarget).find('#form_pass_salariodia').val(saldia);
      $(e.currentTarget).find('#form_pass_impaguinaldo').val(impagui);
      $(e.currentTarget).find('#form_pass_impfiscal').val(impfisc);
      $(e.currentTarget).find('#form_pass_deducionfisc').val(dedfisc);
      $(e.currentTarget).find('#form_pass_deposito').val(deposito);
      $(e.currentTarget).find('#form_pass_efectivo').val(efectivo);
      $(e.currentTarget).find('#form_pass_deduce').val(deduce);
      $(e.currentTarget).find('#form_pass_ptotal').val(gtotal);

      
  });
});
</script>
  
   <div class="modal fade bd-example-modal-lg" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Sobre Recibo</h5>
      </div>
      <div class="modal-body">

        
        <form>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Empleado:</label>
           <div class="col-sm-2">
            <input type="text" class="form-control" id="form_pass_noempl" name="form_pass_noempl" disabled>
           </div>
           <div class="col-sm-6">
            <input type="text" class="form-control" id="form_pass_namepl" name="form_pass_namepl" disabled>
           </div>
           <div class="col-sm-2">
            <input type="text" class="form-control" id="form_pass_salariodia" name="form_pass_salariodia" disabled>
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Ingreso:</label>
           <div class="col-sm-3">
            <input type="date" class="form-control" id="form_pass_dateing" name="form_pass_dateing" disabled>
           </div>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fecha Pago:</label>
           <div class="col-sm-3">
            <input type="date" class="form-control" id="form_pass_datepag" name="form_pass_datepag" disabled>
           </div>
          
        </div>

        <div class="row">
        <div class="col-xs-3 ">Días Aguinaldo</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_dayaguinaldo" name="form_pass_dayaguinaldo" style="text-align:right;"></div>
        <div class="col-xs-3 ">Deducción Fiscal</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_deducionfisc" name="form_pass_deducionfisc" style="text-align:right;"></div>
      </div>  

        
        <div class="row">
        <div class="col-xs-3 ">Días Proporcionales</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_dayderecho" name="form_pass_dayderecho" style="text-align:right;" ></div>
        </div> 

      
       <div class="row">
        <div class="col-xs-3 ">Importe Aguinaldo</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_impaguinaldo" name="form_pass_impaguinaldo" style="text-align:right;"></div>
      </div> 


      <div class="row">
        <div class="col-xs-3 ">Pago Fiscal</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_impfiscal" name="form_pass_impfiscal" style="text-align:right;"></div>
        <div class="col-xs-3 ">Impuesto Fiscal</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_deduce" name="form_pass_deduce" style="text-align:right;"></div>
      </div> 


      <div class="row">
        <div class="col-xs-3 ">Pago en Línea</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_deposito" name="form_pass_deposito" style="text-align:right;"></div>
        <div class="col-xs-3 ">Efectivo</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_efectivo" name="form_pass_efectivo" style="text-align:right;"></div>
      </div>

      <div class="row">
        <div class="col-xs-3 "></div>
        <div class="col-xs-3 "></div>
        <div class="col-xs-3 ">Total</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_ptotal" name="form_pass_ptotal" style="text-align:right;"></div>
      </div>

      
    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaNomempleado"><i class="fa fa-save"></i>&nbsp;Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

 <script>
   $('#actualizaNomempleado').click(function(e){
        e.preventDefault();

        //var semana = document.getElementById("semana").value;
       
        var noempleado   = $('#form_pass_noempl').val();
        var nameempleado = $('#form_pass_namepl').val();
        var date_ing     = $('#form_pass_dateing').val();
        var date_pago    = $('#form_pass_datepag').val();
        var dias_aginald = $('#form_pass_dayaguinaldo').val();
        var dias_derecho = $('#form_pass_dayderecho').val();
        var sal_diario   = $('#form_pass_salariodia').val();
        var imp_aginaldo = $('#form_pass_impaguinaldo').val();
        var imp_fiscal   = $('#form_pass_impfiscal').val();
        var ded_fiscal   = $('#form_pass_deducionfisc').val();
        var deposito     = $('#form_pass_deposito').val();
        var efectivo     = $('#form_pass_efectivo').val();
        var pago_total   = $('#form_pass_ptotal').val();
        
        var action     = 'ActualizaEditNomEmplespecial';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, noempleado:noempleado, nameempleado:nameempleado, date_ing:date_ing, date_pago:date_pago, dias_aginald:dias_aginald, dias_derecho:dias_derecho, sal_diario:sal_diario, imp_aginaldo:imp_aginaldo, imp_fiscal:imp_fiscal, ded_fiscal:ded_fiscal, deposito:deposito, efectivo:efectivo,pago_total:pago_total},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                             Swal.fire({
                             title: 'Datos del Empleado',
                             text: 'Editados Correctamente',
                            
    
  }).then(({value}) => {
    if (value != "hidrógeno") {
      
       $('#modalEditcliente').modal('hide');
         location.reload();
    } else {
      Swal.fire('Incorrect...', 'You failed!', 'error')
    }
  });
                          
                            //$('#detalle_nomina').html(info.detalle);
                          
    
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
        $( document ).ready(function() {
var Id= 'Semana 07';
console.log(Id);
var table = $('#example1').dataTable({
dom: 'Bfrtip',
     buttons: [
      "print", "excel",  "colvis"
    ], 
"order": [[ 0, "asc" ]],     
"bProcessing": true,
"sAjaxSource": "data/data_editnominaespecial.php?id=<?php echo $idnom; ?>",
"data": { Id: Id },
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'no_empleado', className: 'dt-right'} ,
{ mData: 'empleado' },
{ mData: 'fecha_ingreso', className: 'dt-left' },
{ mData: 'fecha_pago', className: 'dt-left' },
{ mData: 'dias_aguinaldo', className: 'hidden-xs' },
{ mData: 'dias_derecho', className: 'dt-right'},
{ mData: 'salario_diario', className: 'dt-right',render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'importe_aguinaldo', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'importe_fiscal', className: 'dt-right'},
{ mData: 'impuesto_fiscal', className: 'dt-right'},
{ mData: 'deposito', className: 'dt-right'},
{ mData: 'pago_efectivo', className: 'dt-right'},
{ mData: 'pago_total', className: 'dt-right'},
],
columnDefs: [
            {
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
        return '<a data-toggle="modal" data-target="#modalEditcliente"  data-num=\'' + full.no_empleado +  '\' data-name=\'' + full.empleado +  '\'  data-fing=\'' + full.fecha_ingreso +  '\' data-fpag=\'' + full.fecha_pago +  '\' data-diagu=\'' + full.dias_aguinaldo +  '\' data-diade=\'' + full.dias_derecho +  '\' data-saldi=\'' + full.salario_diario +  '\' data-impag=\'' + full.importe_aguinaldo +  '\' data-impfis=\'' + full.importe_fiscal +  '\' data-dedfis=\'' + full.impuesto_fiscal +  '\' data-depos=\'' + full.deposito +  '\' data-efect=\'' + full.pago_efectivo +  '\'  data-total=\'' + full.pago_total +  '\' href="javascript:void(0)" class="link_delete" style="color:#0562C1"><i class="far fa-edit"> Edita</i></a> | <a href="#" data-toggle="modal" data-target="#modalDeletecliente" data-id=\'' + full.no_empleado +  '\' data-sem=\'' + full.fecha_pago +  '\' href="#" class="link_delete" style="color:red" ><i class="fas fa-times-circle"> Borra</i></a>';
    },
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
function myFunctionDateTwo() {
   var x = document.getElementById("inputFechaini").value;
   var y = document.getElementById("inputFechafin").value;
   //var num1 = new Number(x);
   //var num2 = new Number(y);

    if(y > document.getElementById("inputFechaini").value){
       $('#inputFechafin').val(document.getElementById("inputFechafin").value);
    }else {
        $('#inputFechafin').val(document.getElementById("inputFechaini").value);
    }
}
</script>
<script>
$(document).ready(function(){
     $('#inputFechaini').change(function(){ 

     fecha1 = document.getElementById("inputFechaini").value; 
     fecha2 = document.getElementById("inputFechafin").value;
   
     var date1 = Date.parse(fecha1);
     var date2 = Date.parse(fecha2); 
     var diff = date2 - date1;
     var diasv = diff/(1000*60*60*24) ;
  
     // alert(diasv);
     document.getElementById("txt_diasvactomar").value = diasv;
    

    
         
     });
 });
</script>

<script>
$(document).ready(function(){
     $('#inputFechafin').change(function(){ 

     fecha1 = document.getElementById("inputFechaini").value; 
     fecha2 = document.getElementById("inputFechafin").value;
   
     var date1 = Date.parse(fecha1);
     var date2 = Date.parse(fecha2); 
     var diff = date2 - date1;
     var diasv = diff/(1000*60*60*24) ;
  
     // alert(diasv);
     document.getElementById("txt_diasvactomar").value = diasv;
    
         
     });
 });
</script>


<script>
     function CerrarTabla() {
    

   var semana     = $('#nosemana').val();

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, semana:semana},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                             location.href = 'nominas.php';

                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

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
 