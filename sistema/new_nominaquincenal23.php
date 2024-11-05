<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];
  $espacio = "--------";

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
                  include('includes/navbar.php');
                }  
             } 
        } 
      } ?>
      <?php include('includes/nav.php') ?>

    </div>
  </nav>

  <?php
         date_default_timezone_set('America/Mazatlan');
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
              <li class="breadcrumb-item"><a href="nominas_quincenales.php">Nominas Quincenales</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
     <table>
                <tr> 
                    <td>
                      <label for="semana">Quincena:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      
                      <select name="noquincena" id="noquincena">
                      <option value="Quincena 01">Quincena 01</option>
                      <option value="Quincena 02">Quincena 02</option>
                      <option value="Quincena 03">Quincena 03</option>
                      <option value="Quincena 04">Quincena 04</option>
                      <option value="Quincena 05">Quincena 05</option>
                      <option value="Quincena 06">Quincena 06</option>
                      <option value="Quincena 07">Quincena 07</option>
                      <option value="Quincena 08">Quincena 08</option>
                      <option value="Quincena 09">Quincena 09</option>
                      <option value="Quincena 10">Quincena 10</option>
                      <option value="Quincena 11">Quincena 11</option>
                      <option value="Quincena 12">Quincena 12</option>
                      <option value="Quincena 13">Quincena 13</option>
                      <option value="Quincena 14">Quincena 14</option>
                      <option value="Quincena 15">Quincena 15</option>
                      <option value="Quincena 16">Quincena 16</option>
                      <option value="Quincena 17">Quincena 17</option>
                      <option value="Quincena 18">Quincena 18</option>
                      <option value="Quincena 19">Quincena 19</option>
                      <option value="Quincena 20">Quincena 20</option>
                      <option value="Quincena 21">Quincena 21</option>
                      <option value="Quincena 22">Quincena 22</option>
                      <option value="Quincena 23">Quincena 23</option>
                      <option value="Quincena 24">Quincena 24</option>
                      </select>
                    </td>
                    
                    <!--<td>
                        <button onclick="llenarTabla()" class="btn btn-success btn-block" type="submit" name="filter" id="filter" >
                <i class="fa fa-play"></i> Ejecutar
              </button>
                    </td>-->

                    <td>
                        <button type ="button" class="btn btn-success pull-left" href="#" id="llenarTablanomina"><i class="fa fa-play"></i> Ejecutar</button>
                    </td>
                    <!--
                    <td> 
                        <a href="#" onclick="window.open ('factura/quincenatemp_detallexcel.php?id='+ document.getElementById('nosemana').value);" >
                       
                          <button type ="button" class="btn btn-secondary pull-left"><i class="fa fa-file-excel"></i> Detallado Excel</button>
                        </a>
                     
                    </td>
                    -->
                    
                    <td>
                        <button type ="button" class="btn btn-primary pull-left" href="#" id="autorizarNomina"><i class="fa fa-save"></i> Autorizar</button>
                    </td>

                    <td>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    </td>  
                    <!--
                    <td>
                        <button onclick="CerrarTabla()" class="btn btn-warning btn-block" type="submit" name="filter" id="filter" >
                <i class="fa fa-save"></i> Cerrar
              </button>
                    </td>
                    -->
                    <td>
                        <button type ="button" class="btn btn-warning pull-left" href="#" id="CerrarTablanomina"><i class="fa fa-undo"></i> Cerrar</button>
                    </td>
                </tr>
            </table>   
   <br />
           <div class="card">
              <div class="card-header">
                <h1 class="card-title">NOMINA QUINCENAL</h1>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Quin.</th>
                    <th>No.</th>
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Sueldo Diario</th>
                    <th>Días Laborados</th>
                    <th>Sueldo Total</th>
                    <th>Viajes Especiales</th>
                    <th>Viajes Contrato</th>
                    <th>Total Especiales</th>
                    <th>Total Contrato</th>
                    <th>Bono Categoria</th>
                    <th>Bono Supervisor</th>
                    <th>Apoyo Mensual</th>
                    <th>Caja</th>
                    <th>Prestamo/Adeudo</th>
                    <th>Vacaciones</th>
                    <th>Prima Vacacional</th>
                    <th>Sueldo Quincenal</th>
                    <th>Pago Fiscal</th>
                    <th>Impuesto Fiscal</th>
                    <th>Deposito</th>
                    <th>Total Efectivo</th>
                    <th>Action</th>
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
       var quincena = $('#noquincena').val();

       var action       = 'ActualizaNominaQuincenal';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, quincena:quincena},

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
                             location.href = 'nominas_quincenales.php';
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
        var quincena    = $('#noquincena').val();
      

       var action       = 'AutorizaNominaQuincenal';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, quincena:quincena},

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
                          text: "QUINCENA ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'nominas_quincenales.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'nominas_quincenales.php';
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

     var noempleado    = $(e.relatedTarget).data().id;
     var nameempleado  = $(e.relatedTarget).data().name;
    
    
      $(e.currentTarget).find('#form_pass_noempleado').val(noempleado);
      $(e.currentTarget).find('#form_pass_nameempleado').val(nameempleado);
      
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
        <div class="form-group row">
           <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">No. de Empleado:</label>
           <div class="col-sm-8">
            <input type="text" class="form-control" id="form_pass_noempleado" name="form_pass_noempleado" disabled>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Empleado:</label>
           <div class="col-sm-8">
            <input type="text" class="form-control" id="form_pass_nameempleado" name="form_pass_nameempleado" disabled>
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
         var noempleado = $('#form_pass_noempleado').val();
         var action     = 'DeleteEmpleadoNomQuincena';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, noempleado:noempleado},

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

     var semana    = $(e.relatedTarget).data().sem;
     var noempl    = $(e.relatedTarget).data().num;
     var namepl    = $(e.relatedTarget).data().name;
     var sdobase   = $(e.relatedTarget).data().sdb;
     var vespcs    = $(e.relatedTarget).data().vjs;
     var vcontro   = $(e.relatedTarget).data().vjc;
     var adeudo    = $(e.relatedTarget).data().adeu;
     var cajah     = $(e.relatedTarget).data().caja;
     var boncat    = $(e.relatedTarget).data().bocat;
     var bonsup    = $(e.relatedTarget).data().bosup;
     var apoymes   = $(e.relatedTarget).data().apoym;
     var viajesp   = $(e.relatedTarget).data().vespc;
     var viajnmal  = $(e.relatedTarget).data().vnormal;
     var totvesp   = $(e.relatedTarget).data().totvesp;
     var totvnorml = $(e.relatedTarget).data().totnorml;
     var primavac  = $(e.relatedTarget).data().primvc;
     var vacacion  = $(e.relatedTarget).data().vacaci;
     var sdbruto   = $(e.relatedTarget).data().bruto;
     var pagfiscal = $(e.relatedTarget).data().pfiscl;
     var dedfiscal = $(e.relatedTarget).data().dfiscl;
     var totnomina = $(e.relatedTarget).data().totnom;
     var totgenral = $(e.relatedTarget).data().totgral;
     var grantotal = $(e.relatedTarget).data().totspc;
    

    
      $(e.currentTarget).find('#form_pass_semana').val(semana);
      $(e.currentTarget).find('#form_pass_noempl').val(noempl);
      $(e.currentTarget).find('#form_pass_namepl').val(namepl);
      $(e.currentTarget).find('#form_pass_sdobase').val(sdobase);
      $(e.currentTarget).find('#form_pass_viajspc').val(vespcs);
      $(e.currentTarget).find('#form_pass_viajcto').val(vcontro);
      $(e.currentTarget).find('#form_pass_adeudo').val(adeudo);
      $(e.currentTarget).find('#form_pass_caja').val(cajah);
      $(e.currentTarget).find('#form_pass_bonocat').val(boncat);
      $(e.currentTarget).find('#form_pass_bonosup').val(bonsup);
      $(e.currentTarget).find('#form_pass_apoymes').val(apoymes);
      $(e.currentTarget).find('#form_pass_vespecial').val(viajesp);
      $(e.currentTarget).find('#form_pass_vnormal').val(viajnmal);
      $(e.currentTarget).find('#form_pass_totvespcial').val(totvesp);
      $(e.currentTarget).find('#form_pass_totvnormal').val(totvnorml);
      $(e.currentTarget).find('#form_pass_primavac').val(primavac);
      $(e.currentTarget).find('#form_pass_vacaciones').val(vacacion);
      $(e.currentTarget).find('#form_pass_sueldobruto').val(sdbruto);
      $(e.currentTarget).find('#form_pass_pagofiscal').val(pagfiscal);
      $(e.currentTarget).find('#form_pass_impuestofiscal').val(dedfiscal);
      $(e.currentTarget).find('#form_pass_totalnomina').val(totnomina);
      $(e.currentTarget).find('#form_pass_totalgeneral').val(totgenral);
      $(e.currentTarget).find('#form_pass_totalspc').val(grantotal);

      
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
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>
        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-4 col-form-label" style="text-align: left;">Semana:</label>
           <div class="col-sm-8">
            <input type="text" class="form-control" id="form_pass_semana" name="form_pass_semana" disabled>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Empleado:</label>
           <div class="col-sm-2">
            <input type="text" class="form-control" id="form_pass_noempl" name="form_pass_noempl" disabled>
           </div>
           <div class="col-sm-6">
            <input type="text" class="form-control" id="form_pass_namepl" name="form_pass_namepl" disabled>
           </div>
           <div class="col-sm-2">
            <input type="text" class="form-control" id="form_pass_sdobase" name="form_pass_sdobase" disabled>
           </div>
        </div>

        <div class="row">
        <div class="col-xs-3 ">Días Laborados</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_viajspc" name="form_pass_viajspc" style="text-align:right;"></div>
        <div class="col-xs-3 ">Prestamo/Adeudo</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_adeudo" name="form_pass_adeudo" style="text-align:right;"></div>
      </div>  

        
        <div class="row">
        <div class="col-xs-3 ">Sueldo Total</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_viajcto" name="form_pass_viajcto" style="text-align:right;" readonly></div>
        <div class="col-xs-3 ">Caja</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_caja" name="form_pass_caja" style="text-align:right;"></div>
      </div> 

       <div class="row">
        <div class="col-xs-3 ">Viajes Especiales</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_vespecial" name="form_pass_vespecial" style="text-align:right;"></div>
      </div> 

      <div class="row">
        <div class="col-xs-3 ">Viajes Contrato</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_vnormal" name="form_pass_vnormal" style="text-align:right;"></div>
      </div>

      <div class="row">
        <div class="col-xs-3 ">Total Especiales</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_totvespcial" name="form_pass_totvespcial" style="text-align:right;"></div>
      </div> 

      <div class="row">
        <div class="col-xs-3 ">Total Contrato</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_totvnormal" name="form_pass_totvnormal" style="text-align:right;"></div>
      </div> 

        <div class="row">
        <div class="col-xs-3 ">Bono Categoria</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_bonocat" name="form_pass_bonocat" style="text-align:right;"></div>
      </div> 

      
       <div class="row">
        <div class="col-xs-3 ">Bono Supervisor</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_bonosup" name="form_pass_bonosup" style="text-align:right;"></div>
      </div> 

      <div class="row">
        <div class="col-xs-3 ">Apoyo Mensual</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_apoymes" name="form_pass_apoymes" style="text-align:right;"></div>
      </div>

       
    <div class="row">
        <div class="col-xs-3 ">Vacaciones</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_vacaciones" name="form_pass_vacaciones" style="text-align:right;"></div>
      </div> 

       <div class="row">
        <div class="col-xs-3 ">Prima Vacacional</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_primavac" name="form_pass_primavac" style="text-align:right;"></div>
      </div>

       <div class="row">
        <div class="col-xs-3 ">Sueldo Quincenal</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_sueldobruto" name="form_pass_sueldobruto" style="text-align:right;"></div>
      </div>



      <div class="row">
        <div class="col-xs-3 ">Pago Fiscal</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_pagofiscal" name="form_pass_pagofiscal" style="text-align:right;"></div>
        <div class="col-xs-3 ">Impuesto Fiscal</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_impuestofiscal" name="form_pass_impuestofiscal" style="text-align:right;"></div>
      </div> 


      <div class="row">
        <div class="col-xs-3 ">Pago en Línea</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_totalnomina" name="form_pass_totalnomina" style="text-align:right;"></div>
        <div class="col-xs-3 ">Efectivo</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_totalgeneral" name="form_pass_totalgeneral" style="text-align:right;"></div>
      </div>

      <div class="row">
        <div class="col-xs-3 "></div>
        <div class="col-xs-3 "></div>
        <div class="col-xs-3 ">Total</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_totalspc" name="form_pass_totalspc" style="text-align:right;"></div>
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
       
        var nosemana       = $('#form_pass_semana').val();
        var noempleado     = $('#form_pass_noempl').val();
        var nameempleado   = $('#form_pass_namepl').val();
        var sueldo_base    = $('#form_pass_sdobase').val();
        var dias_laborados = $('#form_pass_viajspc').val();
        var adeudo         = $('#form_pass_adeudo').val();
        var sueldo_total   = $('#form_pass_viajcto').val();
        var viajes_specils = $('#form_pass_vespecial').val();
        var viajes_normals = $('#form_pass_vnormal').val();
        var total_specils  = $('#form_pass_totvespcial').val();
        var total_normals  = $('#form_pass_totvnormal').val();
        var caja           = $('#form_pass_caja').val();
        var bono_categ     = $('#form_pass_bonocat').val();
        var bono_superv    = $('#form_pass_bonosup').val();
        //var bono_semanal = $('#form_pass_bonosem').val();
        var apoyo_mes      = $('#form_pass_apoymes').val();
        //var sueldo_add   = $('#form_pass_sueldoad').val();
        var total_espc     = $('#form_pass_totalspc').val();
        //var total_cto    = $('#form_pass_totalcontra').val();
        var vacaciones     = $('#form_pass_vacaciones').val();
        var prima_vacac    = $('#form_pass_primavac').val();
        var sueldo_quinc   = $('#form_pass_sueldobruto').val();
        var pago_fiscal    = $('#form_pass_pagofiscal').val();
        var impuesto_fis   = $('#form_pass_impuestofiscal').val();
        var total_nomina   = $('#form_pass_totalnomina').val();
        var total_gral     = $('#form_pass_totalgeneral').val();
        var total_total    = $('#form_pass_totalspc').val();
        
        var action     = 'ActualizaNomEmpleadoQuincena';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, nosemana:nosemana, noempleado:noempleado, nameempleado:nameempleado, sueldo_base:sueldo_base, dias_laborados:dias_laborados, viajes_specils:viajes_specils, viajes_normals:viajes_normals, total_specils:total_specils, total_normals:total_normals, adeudo:adeudo, sueldo_total:sueldo_total, caja:caja, bono_categ:bono_categ, bono_superv:bono_superv, apoyo_mes:apoyo_mes, vacaciones:vacaciones,  prima_vacac:prima_vacac, sueldo_quinc:sueldo_quinc, pago_fiscal:pago_fiscal, impuesto_fis:impuesto_fis, total_nomina:total_nomina, total_gral:total_gral, total_total:total_total},

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
var table = $('#example1').dataTable({
dom: 'Bfrtip',
     buttons: [
      "print", "excel",  "colvis"
    ], 
"order": [[ 1, "asc" ]],     
"bProcessing": true,
"sAjaxSource": "data/data_nominaquincenal.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,
"aoColumns": [
{ mData: 'no_quincena', className: 'dt-left'} ,
{ mData: 'no_empleado', className: 'dt-right'} ,
{ mData: 'nombre' },
{ mData: 'puesto', className: 'dt-left' },
{ mData: 'sueldo_diario', className: 'dt-right',render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'dias_laborados', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'sueldo_bruto', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ),},
{ mData: 'viajes_especiales', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ),},
{ mData: 'viajes_normales', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ),},
{ mData: 'total_especiales', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ),},
{ mData: 'total_normales', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ),},
{ mData: 'bono_mensual', className: 'dt-right'},
{ mData: 'bono', className: 'dt-right'},
{ mData: 'apoyo_alimenticio', className: 'dt-right'},
{ mData: 'caja_ahorro', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'prestamo_deuda', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'vacaciones', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'prima_vacacional', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'sueldo_quincenal', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'sueldo_fiscal', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'impuesto_fiscal', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'deposito', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'total_efectivo', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'total_efectivo', },
],
columnDefs: [
            {
                targets: -1,
                title: 'Actions',
                orderable: false,
                render: function(data, type, full, meta) {
        return '<a data-toggle="modal" data-target="#modalEditcliente"  data-sem=\'' + full.no_quincena +  '\' data-num=\'' + full.no_empleado +  '\' data-name=\'' + full.nombre +  '\'  data-sdb=\'' + full.sueldo_diario +  '\' data-vjs=\'' + full.dias_laborados +  '\' data-vespc=\'' + full.viajes_especiales +  '\' data-vnormal=\'' + full.viajes_normales +  '\' data-totvesp=\'' + full.total_especiales +  '\' data-totnorml=\'' + full.total_normales +  '\'  data-vjc=\'' + full.sueldo_bruto +  '\' data-adeu=\'' + full.prestamo_deuda +  '\' data-caja=\'' + full.caja_ahorro +  '\' data-bocat=\'' + full.bono_mensual +  '\' data-bosup=\'' + full.bono +  '\' data-bosem=\'' + full.bono_semanal +  '\' data-apoym=\'' + full.apoyo_alimenticio +  '\' data-totspc=\'' + full.total_total +  '\' data-primvc=\'' + full.prima_vacacional +  '\'  data-vacaci=\'' + full.vacaciones +  '\' data-bruto=\'' + full.sueldo_quincenal +  '\' data-pfiscl=\'' + full.sueldo_fiscal +  '\' data-dfiscl=\'' + full.impuesto_fiscal +  '\' data-totnom=\'' + full.deposito +  '\' data-totgral=\'' + full.total_efectivo +  '\' href="javascript:void(0)" class="link_delete" style="color:#0562C1"><i class="far fa-edit"> Edita</i></a> | <a href="#" data-toggle="modal" data-target="#modalDeletecliente" data-id=\'' + full.no_empleado +  '\' data-name=\'' + full.nombre +  '\' href="#" class="link_delete" style="color:red" ><i class="fas fa-times-circle"> Borra</i></a>';
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
 