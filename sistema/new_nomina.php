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
            background-color: #4CAF50;
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
                      <label for="semana">Semana:&nbsp;&nbsp;&nbsp;&nbsp;</label>
                      
                      <select name="nosemana" id="nosemana">
                      <option value="Semana 01">Semana 01</option>
                      <option value="Semana 02">Semana 02</option>
                      <option value="Semana 03">Semana 03</option>
                      <option value="Semana 04">Semana 04</option>
                      <option value="Semana 05">Semana 05</option>
                      <option value="Semana 06">Semana 06</option>
                      <option value="Semana 07">Semana 07</option>
                      <option value="Semana 08">Semana 08</option>
                      <option value="Semana 09">Semana 09</option>
                      <option value="Semana 10">Semana 10</option>
                      <option value="Semana 11">Semana 11</option>
                      <option value="Semana 12">Semana 12</option>
                      <option value="Semana 13">Semana 13</option>
                      <option value="Semana 14">Semana 14</option>
                      <option value="Semana 15">Semana 15</option>
                      <option value="Semana 16">Semana 16</option>
                      <option value="Semana 17">Semana 17</option>
                      <option value="Semana 18">Semana 18</option>
                      <option value="Semana 19">Semana 19</option>
                      <option value="Semana 20">Semana 20</option>
                      <option value="Semana 21">Semana 21</option>
                      <option value="Semana 22">Semana 22</option>
                      <option value="Semana 23">Semana 23</option>
                      <option value="Semana 24">Semana 24</option>
                      <option value="Semana 25">Semana 25</option>
                      <option value="Semana 26">Semana 26</option>
                      <option value="Semana 27">Semana 27</option>
                      <option value="Semana 28">Semana 28</option>
                      <option value="Semana 29">Semana 29</option>
                      <option value="Semana 30">Semana 30</option>
                      <option value="Semana 31">Semana 31</option>
                      <option value="Semana 32">Semana 32</option>
                      <option value="Semana 33">Semana 33</option>
                      <option value="Semana 34">Semana 34</option>
                      <option value="Semana 35">Semana 35</option>
                      <option value="Semana 36">Semana 36</option>
                      <option value="Semana 37">Semana 37</option>
                      <option value="Semana 38">Semana 38</option>
                      <option value="Semana 39">Semana 39</option>
                      <option value="Semana 40">Semana 40</option>
                      <option value="Semana 41">Semana 41</option>
                      <option value="Semana 42">Semana 42</option>
                      <option value="Semana 43">Semana 43</option>
                      <option value="Semana 44">Semana 44</option>
                      <option value="Semana 45">Semana 45</option>
                      <option value="Semana 46">Semana 46</option>
                      <option value="Semana 47">Semana 47</option>
                      <option value="Semana 48">Semana 48</option>
                      <option value="Semana 49">Semana 49</option>
                      <option value="Semana 50">Semana 50</option>
                      <option value="Semana 51">Semana 51</option>
                      <option value="Semana 52">Semana 52</option>
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
                 
                        <a href="#"  onclick="window.open ('factura/semanatemp_excel.php?id='+ document.getElementById('nosemana').value);" >
                       
                          <button type ="button" class="btn btn-secondary pull-left"><i class="fa fa-file-excel"></i> Excel</button>
                        </a> 
                    </td>
                    <td> 
                        <a href="#" onclick="window.open ('factura/semanatemp_detallexcel.php?id='+ document.getElementById('nosemana').value);" >
                       
                          <button type ="button" class="btn btn-secondary pull-left"><i class="fa fa-file-excel"></i> Detallado Excel</button>
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
        <table id="nomina" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th style="font-size: 12px;">Acciones</th>
                <th style="font-size: 12px;">Sem.</th>
                <th style="font-size: 12px;">No.</th>
                <th style="font-size: 12px;">Nombre</th>
                <th style="font-size: 12px;">Cargo</th>
                <th style="font-size: 12px;">IMSS</th>
                <th style="font-size: 12px;">Estatus</th>
                <th style="font-size: 12px;">Sueldo Base</th>
                <th style="font-size: 12px;">V. Especiales</th>
                <th style="font-size: 12px;">V. Totales</th>
                <th style="font-size: 12px;">Bono Categoria</th>
                <th style="font-size: 12px;">Bono Supervisor</th>
                <th style="font-size: 12px;">Bono Semanal</th>
                <th style="font-size: 12px;">Apoyo Mensual</th>
                <th style="font-size: 12px;">Total Especiales</th>
                <th style="font-size: 12px;">Sueldo Adicional</th>
                <th style="font-size: 12px;">Prima Vacacional</th>
                <th style="font-size: 12px;">Total Vueltas</th>
                <th style="font-size: 12px;">Sueldo Bruto</th>
                <th style="font-size: 12px;">Pago Fiscal</th>
                <th style="font-size: 12px;">Impuesto Fiscal</th>
                <th style="font-size: 12px;">Deducciones Grales</th>
                <th style="font-size: 12px;">Caja</th>
                <th style="font-size: 12px;">Total Nomina</th>
                <th style="font-size: 12px;">Total General</th>
                <th style="font-size: 12px;">No. Empleado</th>
                <th style="font-size: 12px;">Acciones</th>
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
        var semana     = $('#nosemana').val();
      

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
        var semana     = $('#nosemana').val();
      

       var action       = 'CerrarNomina';

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
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
function myFunctionDate() {
    var x = document.getElementById("inputFechaini").value;
    var y = document.getElementById("inputFechafin").value;

    if(y === ''){
        document.getElementById('inputFechafin').value = x;
    }else{
       //var num1 = new Number(x);
       //var num2 = new Number(y);
       if(x > document.getElementById("inputFechafin").value){
         document.getElementById('inputFechafin').value = x;
       }else{
         document.getElementById('inputFechaini').value = x; 
       }    
   }
}
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
 