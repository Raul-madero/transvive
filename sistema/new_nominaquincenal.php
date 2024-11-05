<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  mysqli_close($conection);
?>
<html>
 <head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRANSVIVE | CRM</title>
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
  <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table td, table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #228f82;
            color: white;
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
           font-size: 14px;
           font-family: Arial, sans-serif;
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
               include('includes/navbar.php');
            }   
      } 
      } ?>
      <?php include('includes/nav.php') ?>

    </div>
  </nav>
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
                    <td>
                        <a href="#" onclick="window.open ('factura/quincenatemp_excel.php?id='+ document.getElementById('noquincena').value);" >
                       
                          <button type ="button" class="btn btn-secondary pull-left"><i class="fa fa-file-excel"></i> Excel</button>
                        </a>
                    </td>
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
   <div class="panel panel-primary">
    <div class="panel-heading">Registro de Nomina</div>
    <div class="panel-body">
     <div class="table-responsive">
        <table id="nomina" class="mi-tabla">
        <thead>
            <tr>
                <th>Quin.</th>
                <th>No. Empleado</th>
                <th>Nombre</th>
                <th>Puesto</th>
                <th>Sueldo Bruto</th>
                <th>Sueldo Diario</th>
                <th>Dias Laborados</th>
                <th>Sueldo Total</th>
                <th>Bono</th>
                <th>Bono Mensual</th>
                <th>Apoyo Alimenticio</th>
                <th>Subtotal</th>
                <th>Caja</th>
                <th>Prestamo/Deuda</th>
                <th>Vacaciones</th>
                <th>Prima Vac. Fiscal</th>
                <th>Prima Vac. NoFiscal</th>
                <th>Sueldo Quincenal</th>
                <th>Fiscal</th>
                <th>Impuestos</th>
                <th>Deposito</th>
                <th>Total Efectivo</th>
                <th>No. Empleado</th>
                <th>Acciones</th>
            </tr>
        </thead>
       <tbody id="detalle_nomina">
        <!---Contenido Ajax--->

      </tbody>
    </table>
    <!--
    <div class="botonera">
        <button id="guardar">Actualizar Cambios</button>  
    </div>
    -->
     </div>
    </div>
   </div>
  </div>


<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
 
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
        var quincena     = $('#noquincena').val();
      

       var action       = 'ActualizaNominaQuincena';

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

        //var semana = document.getElementById("semana").value;
        var quincena     = $('#noquincena').val();
      

       var action       = 'CerrarNominaQuincenal';

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
                             location.href = 'nominas_quincenales.php';

                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

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
                          text: "NOMINA ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'nominas.php';
                       
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
     var primav    = $(e.relatedTarget).data().primv;
     var primavfs  = $(e.relatedTarget).data().primvfs;
     var vacacion  = $(e.relatedTarget).data().vacac;
     var sdofiscal = $(e.relatedTarget).data().sdofis;
     var impfiscal = $(e.relatedTarget).data().impfis;
     var deposito  = $(e.relatedTarget).data().depos;
     var efectivo  = $(e.relatedTarget).data().totefe;
     
    
      $(e.currentTarget).find('#txt_id').val(idem);
      $(e.currentTarget).find('#txt_nosemana').val(nosem);
      $(e.currentTarget).find('#txt_noempleado').val(noempl);
      $(e.currentTarget).find('#txt_nombre').val(name);
      $(e.currentTarget).find('#txt_dias').val(dias);
      $(e.currentTarget).find('#txt_primav').val(primav);
      $(e.currentTarget).find('#txt_primavfiscal').val(primavfs);
      $(e.currentTarget).find('#txt_ivacaciones').val(vacacion);
      $(e.currentTarget).find('#txt_sdofiscal').val(sdofiscal);
      $(e.currentTarget).find('#txt_impfiscal').val(impfiscal);  
      $(e.currentTarget).find('#txt_deposito').val(deposito);
      $(e.currentTarget).find('#txt_efectivo').val(efectivo);
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
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Días por Tomar:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_dias" id="txt_dias" type="text" class="form-control" readonly>
                    </div>
             </div>    

         <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Dias de Vacaciones:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_vacaciones" id="txt_vacaciones" type="number" class="form-control"  onkeyup="PasarValor();">
                    </div>
             </div>   
        
         <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Prima Vacacional:</i></span>
                      <input style="text-align:right;" name="txt_primav" id="txt_primav" type="text" class="form-control" >
                    </div>
             </div>

        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Prima Vacacional Fiscal:</i></span>
                      <input style="text-align:right;" name="txt_primavfiscal" id="txt_primavfiscal" type="text" class="form-control">
                    </div>
             </div>     

        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Importe Vacaciones:</i></span>
                      <input style="text-align:right;" name="txt_ivacaciones" id="txt_ivacaciones" type="text" class="form-control">
                    </div>
             </div>

             <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>  

        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Sueldo Fiscal:</i></span>
                      <input style="text-align:right;" name="txt_sdofiscal" id="txt_sdofiscal" type="text" class="form-control">
                    </div>
             </div> 

        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Impuesto Fiscal:</i></span>
                      <input style="text-align:right;" name="txt_impfiscal" id="txt_impfiscal" type="text" class="form-control">
                    </div>
             </div>

          <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Deposito:</i></span>
                      <input style="text-align:right;" name="txt_deposito" id="txt_deposito" type="text" class="form-control">
                    </div>
             </div> 

         <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Total Efectivo:</i></span>
                      <input style="text-align:right;" name="txt_efectivo" id="txt_efectivo" type="text" class="form-control">
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
        var vacaciones   = $('#txt_vacaciones').val();
        var primavac     = $('#txt_primav').val();
        var primavacfis  = $('#txt_primavfiscal').val();
        var importevac   = $('#txt_ivacaciones').val();
        var sueldofiscal = $('#txt_sdofiscal').val();
        var impuestofis  = $('#txt_impfiscal').val();
        var deposito     = $('#txt_deposito').val();
        var totefectivo  = $('#txt_efectivo').val();

        var action       = 'ActualizaPrimavac';
    
        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, idempl:idempl, nosemana:nosemana, noempleado:noempleado, empleado:empleado, vacaciones:vacaciones, primavac:primavac, primavacfis:primavacfis, importevac:importevac, sueldofiscal:sueldofiscal, impuestofis:impuestofis, deposito:deposito, totefectivo:totefectivo},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                             alert('Prima Aplicada');
                            //*$('#modalIndicador').modal('hide');
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