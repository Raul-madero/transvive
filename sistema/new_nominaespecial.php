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
              <li class="breadcrumb-item"><a href="nominas.php">Nominas</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
     <table>
                <tr> 
                    <td>
                      <label for="semana">Fecha de Calculo:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fcha;?>" >
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
                <h1 class="card-title">NOMINA ESPECIAL (AGUINALDO)</h1>
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
        var fechapago = $('#inputFecha').val();
      

        var action    = 'ActualizaNominaEspecial';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, fechapago:fechapago},

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
        var fcha_especial = $('#inputFecha').val();
      

       var action       = 'AutorizaNominaEspecial';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, fcha_especial:fcha_especial},

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
                          text: "NOMINA ESPECIAL ALMACENADA CORRECTAMENTE",
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
                         location.href = 'nominas_especiales.php';
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
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

     var semana    = $(e.relatedTarget).data().sem;
     var noempl    = $(e.relatedTarget).data().num;
     var namepl    = $(e.relatedTarget).data().name;
     var sdobase   = $(e.relatedTarget).data().sdb;
     var diasder   = $(e.relatedTarget).data().diader;
     var diasagui  = $(e.relatedTarget).data().diaagui;
     var imptoagui = $(e.relatedTarget).data().impagui;
     var imptofis  = $(e.relatedTarget).data().impfis;
     var deducfis  = $(e.relatedTarget).data().dedfis;
     var deposito  = $(e.relatedTarget).data().despos;
     var pagofis   = $(e.relatedTarget).data().pagfis;
     var pagoefe   = $(e.relatedTarget).data().pagefe;
    
    
      $(e.currentTarget).find('#form_pass_semana').val(semana);
      $(e.currentTarget).find('#form_pass_noempl').val(noempl);
      $(e.currentTarget).find('#form_pass_namepl').val(namepl);
      $(e.currentTarget).find('#form_pass_sdobase').val(sdobase);
      $(e.currentTarget).find('#form_pass_diasder').val(diasder);
      $(e.currentTarget).find('#form_pass_diasagui').val(diasagui);
      $(e.currentTarget).find('#form_pass_importeagui').val(imptoagui);
      $(e.currentTarget).find('#form_pass_importefis').val(imptofis);
      $(e.currentTarget).find('#form_pass_deduccionfis').val(deducfis);
      $(e.currentTarget).find('#form_pass_deposito').val(deposito);
      $(e.currentTarget).find('#form_pass_pagofis').val(pagofis);
      $(e.currentTarget).find('#form_pass_pagoefe').val(pagoefe);
      
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
        

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left;">Empleado:</label>
           <div class="col-sm-2">
            <input type="text" class="form-control" id="form_pass_noempl" name="form_pass_noempl" disabled>
           </div>
           <div class="col-sm-6">
            <input type="text" class="form-control" id="form_pass_namepl" name="form_pass_namepl" disabled>
           </div>
           <div class="col-sm-2">
            <input type="text" class="form-control" id="form_pass_sdobase" name="form_pass_sdobase">
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Fecha de Ingreso:</label>
           <div class="col-sm-4">
            <input type="text" class="form-control" id="form_pass_semana" name="form_pass_semana" disabled>
           </div>
        </div> 

        <div class="row">
        <div class="col-xs-3 ">Días Derecho</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_diasder" name="form_pass_diasder" style="text-align:right;"></div>
        <div class="col-xs-3 ">Impuesto Fiscal</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_deduccionfis" name="form_pass_deduccionfis" style="text-align:right;"></div>
      </div>  

        
        <div class="row">
        <div class="col-xs-3 ">Días Proporcionales</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_diasagui" name="form_pass_diasagui" style="text-align:right;"></div>
      </div> 
     
       <div class="row">
        <div class="col-xs-3 ">Importe Aguinaldo</div>
        <div class="col-xs-3 bg-secondary"><input type="text" class="form-control" id="form_pass_importeagui" name="form_pass_importeagui" style="text-align:right;"></div>
      </div> 


      <div class="row">
        <div class="col-xs-3 ">Importe Fiscal</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_importefis" name="form_pass_importefis" style="text-align:right;"></div>
      </div> 


      <div class="row">
        <div class="col-xs-3 ">Pago en Línea</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_deposito" name="form_pass_deposito" style="text-align:right;"></div>
        <div class="col-xs-3 ">Efectivo</div>
        <div class="col-xs-3 bg-success"><input type="text" class="form-control" id="form_pass_pagoefe" name="form_pass_pagoefe" style="text-align:right;"></div>
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
       
        var nosemana     = $('#form_pass_semana').val();
        var noempleado   = $('#form_pass_noempl').val();
        var nameempleado = $('#form_pass_namepl').val();
        var sueldo_base  = $('#form_pass_sdobase').val();
        var day_derecho  = $('#form_pass_diasder').val();
        var dedu_fiscal  = $('#form_pass_deduccionfis').val();
        var day_aguinald = $('#form_pass_diasagui').val();
        var importe_agui = $('#form_pass_importeagui').val();
        var importe_fisc = $('#form_pass_importefis').val();
        var deposito_fis = $('#form_pass_deposito').val();
        var pago_efec    = $('#form_pass_pagoefe').val();
        
        var action     = 'ActualizaNomEmpleadoEspecial';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, nosemana:nosemana, noempleado:noempleado, nameempleado:nameempleado, sueldo_base:sueldo_base, day_derecho:day_derecho, dedu_fiscal:dedu_fiscal, day_aguinald:day_aguinald, importe_agui:importe_agui, importe_fisc:importe_fisc, deposito_fis:deposito_fis, pago_efec:pago_efec},

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

    <!-- Modal - Update User details -->
<div class="modal fade" id="modalVacaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
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
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> No. Empleado:</i></span>
                      <input name="txt_noempleado" id="txt_noempleado" type="text" class="form-control" readonly>
                    </div>
             </div>

          <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Nombre:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
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
              <div class="form-group"> 
              </div>
           </div>     

        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Fecha Inicio:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="inputFechaini" id="inputFechaini" type="date" class="form-control" onchange="myFunctionDate()">
                    </div>
             </div>  

        <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Fecha Termino:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="inputFechafin" id="inputFechafin" type="date" class="form-control" onchange="myFunctionDateTwo()">
                    </div>
             </div>               

         <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Dias de Vacaciones:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</i></span>
                      <input style="text-align:right;" name="txt_diasvactomar" id="txt_diasvactomar" type="number" class="form-control">
                    </div>
             </div>  

             <div class="col-md-12">
          <div class="form-group"> 
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
        $( document ).ready(function() {
var table = $('#example1').dataTable({
dom: 'Bfrtip',
     buttons: [
      "print", "excel",  "colvis"
    ], 
"bProcessing": true,
"sAjaxSource": "data/data_nominaespecial.php",
"bPaginate":true,
"sPaginationType":"full_numbers",
"iDisplayLength": 10,
"responsive": true,

"aoColumns": [
{ mData: 'no_empleado', className: 'dt-right'} ,
{ mData: 'empleado' },
{ mData: 'FechaIngreso', className: 'dt-center' },
{ mData: 'FechaPago', className: 'dt-center' },
{ mData: 'dias_aguinaldo', className: 'dt-right' },
{ mData: 'dias_derecho', className: 'dt-right'},
{ mData: 'salario_diario', className: 'dt-right' },
{ mData: 'importe_aguinaldo', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'importe_fiscal', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'impuesto_fiscal', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'deposito', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'pago_efectivo', className: 'dt-right', render: $.fn.dataTable.render.number( ',', '.', 2 ), },
{ mData: 'pago_efectivo' },
],
columnDefs: [
            {
                targets: -1,
                title: 'Actions',
                orderable: false,
                 render: function(data, type, full, meta) {
        return '<a data-toggle="modal" data-target="#modalEditcliente"  data-sem=\'' + full.FechaIngreso +  '\' data-num=\'' + full.no_empleado +  '\' data-name=\'' + full.empleado +  '\'  data-sdb=\'' + full.salario_diario +  '\' data-diaagui=\'' + full.dias_aguinaldo +  '\' data-diader=\'' + full.dias_derecho +  '\' data-impagui=\'' + full.importe_aguinaldo +  '\' data-impfis=\'' + full.importe_fiscal +  '\' data-dedfis=\'' + full.impuesto_fiscal +  '\' data-despos=\'' + full.deposito +  '\'  data-pagfis=\'' + full.pago_fiscal +  '\' data-pagefe=\'' + full.pago_efectivo +  '\' href="javascript:void(0)" class="link_delete" style="color:#0562C1"><i class="far fa-edit"> Edita</i></a> | <a href="#" data-toggle="modal" data-target="#modalDeletecliente" data-id=\'' + full.no_empleado +  '\' data-name=\'' + full.empleado +  '\' href="#" class="link_delete" style="color:red" ><i class="fas fa-times-circle"> Borra</i></a>';
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
         var action     = 'DeleteEmpleadoEspecial';

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
 