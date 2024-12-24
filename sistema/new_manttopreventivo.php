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

  $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados where estatus = 1 ORDER BY nombres";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlspv   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as supervisor from empleados where cargo = 'supervisor' ORDER BY nombres";
  $queryspv = mysqli_query($conection, $sqlspv);
  $filasspv = mysqli_fetch_all($queryspv, MYSQLI_ASSOC);

  $sqlunid   = "select no_unidad from unidades where estatus = 1";
  $queryunid = mysqli_query($conection, $sqlunid);
  $filasunid = mysqli_fetch_all($queryunid, MYSQLI_ASSOC); 

  $sqlrefc  = "select rf.codigo, rf.descripcion, if(iv.cantidad_disponible >0, if(iv.costo IS NULL, rf.costo, iv.costo), rf.costo) as Ucosto from refacciones rf LEFT JOIN inventario_peps iv ON rf.codigo = iv.codigo order by iv.fecha_entrada";
  $queryrefc = mysqli_query($conection, $sqlrefc);
  $filasrefc  = mysqli_fetch_all($queryrefc, MYSQLI_ASSOC); 

  mysqli_close($conection);
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
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
   <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <style>
    .right{
    float: left;
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
 
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
 
    <!-- /.content-header -->

    <!-- Main content -->
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Orden de Trabajo de Mantenimiento</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

       <?php
                    
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT * FROM folios where serie = 'SM'");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["folio"]+1; 

          $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'SM'");
          

          mysqli_close($conection);
        ?>  
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Alta de Orden de Trabajo de Mantenimiento</h3>
              </div>
              <div class="card-body">
              <div class="card-header p-2">
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal">
              <div class="form-group row">
                    <div class="col-sm-10">
                    </div>
                  </div>
              

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fcha;?>">
                    </div>
                    <!--
                    <label for="inputEmail3" class="col-sm-1 col-form-label">Hora</label>
                    <div class="col-sm-2">
                      <input type="time" class="form-control" id="inputHora" name="inputHora" >
                    </div>
                  -->
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Orden</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo $nuevofolio; ?>" readonly style="width: 100%; text-align: right;">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">No. Unidad</label>
                    <div class="col-sm-2">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputNounidad" name="inputNounidad">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasunid as $opun): //llenar las opciones del primer select ?>
                       <option value="<?= $opun['no_unidad'] ?>"><?= $opun['no_unidad'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align: left;">Tipo de Unidad</label>
                    <div class="col-sm-6">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputTipounidad" name="inputTipounidad">
                       <option value="">- Seleccione -</option>
                       <option value="AUTOMOVIL">AUTOMOVIL</option>
                       <option value="CAMIÓN">CAMIÓN</option>
                       <option value="CAMIONETA">CAMIONETA</option>
                       <option value="SPRINTER">SPRINTER</option>
                    </select>
                    </div>

                  </div>
                  <div class="form-group row" style="text-align:left;">
                  <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align: left;">Usuario</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputOperador" name="inputOperador">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasoper as $oper): //llenar las opciones del primer select ?>
                       <option value="<?= $oper['operador'] ?>"><?= $oper['operador'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>

                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Solicitado por</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputSolicita" name="inputSolicita">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasoper as $oper): //llenar las opciones del primer select ?>
                       <option value="<?= $oper['operador'] ?>"><?= $oper['operador'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                 
                    <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Trabajo Solicitado</label>
                    <div class="col-sm-5">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputWsolicitado" name="inputWsolicitado">
                       <option value="Servicio Preventivo">Servicio Preventivo</option>
                      </select>  
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Kilometraje</label>
                    <div class="col-sm-3">
                      <input type="number" class="form-control" id="inputKilometraje" name="inputKilometraje" value="0">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:center;">
                    <label for="inputEmail3" class="col-sm-12 col-form-label">CHECKLIST</label>
                  </div>

                  <section class="content">
                   <div class="row">
                     <div class="col-md-6">
                      <table width="100%" border="0">
                       <tr>
                         <td>Cambio de filtro de aceite</td>
                         <td align="left"><input name="Check1" type="checkbox" id="Check1"></td>
                       </tr>
                       <tr>
                         <td>Cambio de filtro de aire</td>
                         <td align="left"><input name="Check2" type="checkbox" id="Check2"></td>
                       </tr>
                       <tr>
                         <td>Cambio de filtro de combustible</td>
                         <td align="left"><input name="Check3" type="checkbox" id="Check3"></td>
                       </tr>
                       <tr>
                         <td>Cambio de aceite</td>
                         <td align="left"><input name="Check4" type="checkbox" id="Check4"></td>
                       </tr>
                       <tr>
                         <td id="endTimeLabel5">Cambio de bujias (anotar km)</td>
                         <td align="left"><input name="Check5" type="checkbox" id="Check5"></td>
                         <td align="left"><input name="kmbujias" type="text" id="kmbujias" placeholder="Kilometraje"></td>
                       </tr>
                       <tr>
                         <td>Revisión de balatas</td>
                         <td align="left"><input name="Check6" type="checkbox" id="Check6"></td>
                       </tr>
                       <tr>
                         <td id="endTimeLabel7">Engrasado</td>
                         <td align="left"><input name="Check7" type="checkbox" id="Check7"></td>
                       </tr>
                       <tr>
                         <td>Nivel de anti congelante</td>
                         <td align="left"><input name="Check8" type="checkbox" id="Check8"></td>
                       </tr>
                       <tr>
                         <td>Revisión de líquido de frenos</td>
                         <td align="left"><input name="Check9" type="checkbox" id="Check9"></td>
                       </tr>
                       <tr>
                         <td>Revisión de aceite hidraúlico</td>
                         <td align="left"><input name="Check10" type="checkbox" id="Check10"></td>
                       </tr>
                       <tr>
                         <td id="endTimeLabel11">Rotación de llantas</td>
                         <td align="left"><input name="Check11" type="checkbox" id="Check11"></td>
                       </tr>
                       <tr>
                         <td>Revisar  banda de accesorios</td>
                         <td align="left"><input name="Check12" type="checkbox" id="Check12"></td>
                       </tr>
                       <tr>
                         <td>Revisión de muelles</td>
                         <td align="left"><input name="Check13" type="checkbox" id="Check13"></td>
                       </tr>
                       <tr>
                         <td>Revisión de amortiguadores</td>
                         <td align="left"><input name="Check14" type="checkbox" id="Check14"></td>
                       </tr>
                       <tr>
                         <td>Revisión de luces</td>
                         <td align="left"><input name="Check15" type="checkbox" id="Check15"></td>
                       </tr>
                       <tr>
                         <td>Revisión de batería</td>
                         <td align="left"><input name="Check16" type="checkbox" id="Check16"></td>
                       </tr>
                       <tr>
                         <td id="endTimeLabel17">Limpieza de inyectores</td>
                         <td align="left"><input name="Check17" type="checkbox" id="Check17"></td>
                       </tr>
                       <tr>
                         <td>Revisión de masas delanteras</td>
                         <td align="left"><input name="Check18" type="checkbox" id="Check18"></td>
                       </tr>

                      </table>
                 
                  </div>
             
               

                   <div class="col-md-6">
                    <table>
                      <!--
                    <tr>
                         
                         <td align="left"><input name="frenteIzq" type="text" id="frenteIzq" placeholder="Fecha de Rotación"></td>
                        
                         <td align="left"><input name="frenteDer" type="text" id="frenteDer" placeholder="Fecha de Rotación"></td>
                       </tr>
                     -->
                     </table>
                     <img src="img/autollantas.jpg"  alt="" width="300" height="441" />
                     <table>
                      <!--
                    <tr>
                         
                         <td align="left"><input name="traseraIzq" type="text" id="traseraIzq" placeholder="Fecha de Rotación"></td>
                        
                         <td align="left"><input name="traseraDer" type="text" id="traseraDer" placeholder="Fecha de Rotación"></td>
                       </tr>
                     -->
                     </table>

                     </div>
                   </div>
                  </section>

                  <br>

                   <div class="form-group row" >
                    <label for="inputEmail3" class="col-sm-10 col-form-label" style="text-align:center; background-color: gainsboro;">Refacciones y Materiales</label>
                    <div class="col-sm-2">
                      <a href="#"  class="btn btn-success" data-toggle="modal" data-target="#modalEditcliente" style="color:white;" ><i class="fa fa-plus"></i></a> 
                    </div>
                  </div>

                   <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:15%; background-color:#e9ecef; text-align: center;" >Cantidad</th>
                               <th style="width:65%; background-color:#e9ecef; text-align: center;">Descripción</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Costo</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                          <tbody id="detalle_mantto">
                          </tbody>
                          </table>
                     
                      </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Fecha de Inicio del mantenimiento</label>
                    <div class="col-sm-3">
                      <input class="form-control" type="date" id="inputDateinicio" name="inputDateinicio" >
                    </div>
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Fecha de Culminación del mantenimiento</label>
                    <div class="col-sm-3">
                      <input class="form-control" type="date" id="inputDatefin" name="inputDatefin" >
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputNotasgen" name="inputNotasgen" rows="1"></textarea>
                    </div>
                  </div>

                 <!--
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Trabajo Ejecutado</label>
                    <div class="col-sm-10">
                      <textarea type="date" rows="1" class="form-control" id="inputTrabajoejecutado" name="inputTrabajoejecutado">
                      </textarea>  
                    </div>
                  </div>

                  <div class="form-group row" >
                    <label for="inputEmail3" class="col-sm-10 col-form-label" style="text-align:center; background-color: gainsboro;">Refacciones y Materiales</label>
                    <div class="col-sm-2">
                      <a href="#"  class="btn btn-success" data-toggle="modal" data-target="#modalEditcliente" style="color:white;" ><i class="fa fa-plus"></i></a> 
                    </div>
                  </div>

                   <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:15%; background-color:#e9ecef; text-align: center;" >Cantidad</th>
                               <th style="width:75%; background-color:#e9ecef; text-align: center;">Descripción</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                          <tbody id="detalle_mantto">
                          </tbody>
                          </table>
                     
                      </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Costos para Descontar al Operador</label>
                    <div class="col-sm-10">
                      <textarea type="date" rows="1" class="form-control" id="inputCostosdesc" name="inputCostosdesc">
                      </textarea>  
                    </div>
                  </div>  

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de Inicio</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFechaini" name="inputFechaini">
                    </div>
               
                  
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de Culminación</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFechafin" name="inputFechafin">
                    </div>
                  </div>  

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea type="date" rows="1" class="form-control" id="inputNotas" name="inputNotas">
                      </textarea>  
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Causas del Servicio</label>
                    <div class="col-sm-10">
                      <textarea type="date" rows="1" class="form-control" id="inputCausas" name="inputCausas" placeholder="Llenar">
                      </textarea>  
                    </div>
                  </div>

                 --> 


                <!-- /.card-body -->
                <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                          <button type="submit" class="btn btn-success" id="guardar_tipoactividad">Guardar</button>
                        </div>
                      </div>
                <!-- /.card-footer -->
              </form>
            </div>
     </div>
     </div>
     
</center>

  
  
    <!-- /.content -->

    

  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  
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
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->
 <script>
   $('#btn_salir').click(function(e){
        e.preventDefault();

            var norecibo  = $('#inputFolio').val();
            var action = 'procesarSalirManttoprev';
                       
            $.ajax({
                url: 'includes/ajax.php',
                type: "POST",
                async : true,
                data: {action:action, norecibo:norecibo},

                success: function(response)
                {
                    
                    if(response != 'error')
                    {
                      var info = JSON.parse(response);
                      console.log(response); 
                      location.href = 'mantenimiento_preventivo.php';
                       /* location.reload(); */

               
                        
                    }else{
                        console.log('no data');
                    }
                },
                error: function(error){                
                }
            });
        

    });
    </script>
<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var folio         = $('#inputFolio').val();
       var fecha         = $('#inputFecha').val();
       //var hora          = $('#inputHora').val();
       var nounidad      = $('#inputNounidad').val();
       var tipo_unidad   = $('#inputTipounidad').val();
       var operador      = $('#inputOperador').val();
       var solicita      = $('#inputSolicita').val();
       var trabajosolic  = $('#inputWsolicitado').val();
       var kilometraje   = $('#inputKilometraje').val();
       var kmtbujias     = $('#kmbujias').val(); 
       var dateinicio    = $('#inputDateinicio').val();
       var datefin       = $('#inputDatefin').val();
       var notasgen      = $('#inputNotasgen').val();
       //var delanteraizq  = $('#frenteIzq').val();
       //var delanterader  = $('#frenteDer').val(); 
       //var traseraizq    = $('#traseraIzq').val();
       //var traserader    = $('#traseraDer').val();
       
       if ($('#Check1').prop('checked') == true) {
              var filtro_aceite = "SI";    
        }else {
              var filtro_aceite = "NO";
        }

       if ($('#Check2').prop('checked') == true) {
              var filtro_aire = "SI";
        }else {
              var filtro_aire = "NO";
        }

        if ($('#Check3').prop('checked') == true) {
              var filtro_gas = "SI";
        }else {
              var filtro_gas = "NO";
        }

        if ($('#Check4').prop('checked') == true) {
              var cambio_aceite = "SI";
        }else {
              var cambio_aceite = "NO";
        }

        if ($('#Check5').prop('checked') == true) {
              var cambio_bujias = "SI";
        }else {
              var cambio_bujias = "NO";
        }

        if ($('#Check6').prop('checked') == true) {
              var rev_balatas = "SI";
        }else {
              var rev_balatas = "NO";
        }

        if ($('#Check7').prop('checked') == true) {
              var engrasado = "SI";
        }else {
              var engrasado = "NO";
        }

        if ($('#Check8').prop('checked') == true) {
              var anti_congela = "SI";
        }else {
              var anti_congela = "NO";
        }

        if ($('#Check9').prop('checked') == true) {
              var liquido_frenos = "SI";
        }else {
              var liquido_frenos = "NO";
        }

        if ($('#Check10').prop('checked') == true) {
              var aceite_hidraul = "SI";
        }else {
              var aceite_hidraul = "NO";
        }

        if ($('#Check11').prop('checked') == true) {
              var rota_llantas = "SI";
        }else {
              var rota_llantas = "NO";
        }

        if ($('#Check12').prop('checked') == true) {
              var banda_acessor = "SI";
        }else {
              var banda_acessor = "NO";
        }

        if ($('#Check13').prop('checked') == true) {
              var rev_muelles = "SI";
        }else {
              var rev_muelles = "NO";
        }

        if ($('#Check14').prop('checked') == true) {
              var amortiguadores = "SI";
        }else {
              var amortiguadores = "NO";
        }

        if ($('#Check15').prop('checked') == true) {
              var rev_luces = "SI";
        }else {
              var rev_luces = "NO";
        }

        if ($('#Check16').prop('checked') == true) {
              var rev_bateria = "SI";
        }else {
              var rev_bateria = "NO";
        }

        if ($('#Check17').prop('checked') == true) {
              var inyectores = "SI";
        }else {
              var inyectores = "NO";
        }

        if ($('#Check18').prop('checked') == true) {
              var masas_frente = "SI";
        }else {
              var masas_frente = "NO";
        }
         
       var action       = 'AlmacenaSolicitudmpreventivo';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, fecha:fecha, nounidad:nounidad, tipo_unidad:tipo_unidad, operador:operador, solicita:solicita, filtro_aceite:filtro_aceite, filtro_aire:filtro_aire, filtro_gas:filtro_gas, cambio_aceite:cambio_aceite, cambio_bujias:cambio_bujias, kmtbujias:kmtbujias, rev_balatas:rev_balatas, engrasado:engrasado, anti_congela:anti_congela, liquido_frenos:liquido_frenos, aceite_hidraul:aceite_hidraul, rota_llantas:rota_llantas, banda_acessor:banda_acessor, rev_muelles:rev_muelles, amortiguadores:amortiguadores, rev_luces:rev_luces, rev_bateria:rev_bateria, inyectores:inyectores, masas_frente:masas_frente, trabajosolic:trabajosolic, kilometraje:kilometraje, dateinicio:dateinicio, datefin:datefin, notasgen:notasgen},

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
                          text: "ORDEN DE MANTENIMIENTO PREVENTIVO ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //generarimpformulaPDF(info.folio);
                        location.href = 'mantenimiento_preventivo.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'mantenimiento_preventivo.php';
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
                            text: 'Capture los datos requeridos',
                            })
        
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script>  
<script src="js/sweetalert2.all.min.js"></script>   
<!-- Page specific script -->
<div class="modal fade" id="modalEditcliente"  role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Refacciones y Materiales</h5>
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
            <input type="text" class="form-control" id="inputfoliodet" name="inputfoliodet" value="<?php echo $nuevofolio; ?>" readonly>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Cantidad:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputCantidad" name="inputCantidad" value="0">
           </div>
        </div>

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Codigo:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputCodigorf" name="inputCodigorf" >
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Descripción:</label>
           <div class="col-sm-9">
            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputDescribe" name="inputDescribe">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasrefc as $oprf): //llenar las opciones del primer select ?>
                       <option value="<?= $oprf['descripcion'] ?>"><?= $oprf['descripcion'] ?></option>  
                       <?php endforeach; ?>
                    </select>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Costo:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputCosto" name="inputCosto" value="0">
           </div>
        </div> 
        

    
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualizaclientes"><i class="fa fa-save"></i>&nbsp;Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div> 

</div>

<script>
   $('#actualizaclientes').click(function(e){
        e.preventDefault();

        var folio       = $('#inputfoliodet').val();
        var cantidad    = $('#inputCantidad').val();
        var codigorf    = $('#inputCodigorf').val();
        var descripcion = $('#inputDescribe').val();
        var costorf     = $('#inputCosto').val();
        

       var action       = 'AddDetallemprevententivo';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, cantidad:cantidad, codigorf:codigorf, descripcion:descripcion, costorf:costorf},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_mantto').html(info.detalle);
                            
                           
                            //alert('Cliente Agregado');

                            $('#modalEditcliente').modal('hide')
                            $('#inputCantidad').val('0');
                            $('#inputDescribe').val('');
                            $('#inputCodigorf').val('');
                            $('#inputCosto').val('0.00');

                            //location.reload(true);
                            
    
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
    function del_detalle_mantto(id,folio){
    var action = 'delDeattemanttopreventivo';
    var id_detalle = id;
    var nofolio = folio;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, id_detalle:id_detalle, nofolio:nofolio},

        success: function(response)
        {
                      if(response != 'error')
                        {
                            console.log(response);
                            var info = JSON.parse(response);
                            $('#detalle_mantto').html(info.detalledelete);
                           

                        }else{
                           $('#detalle_mantto').html('');
                        }
                        //viewProcesar();
                 },
        error: function(error) {
        }
    });
}

    </script> 
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End
</script> 


<script>
$(document).ready(function(){
     $('#inputLitros').blur(function(){ 
         
          m1 = document.getElementById("inputLitros").value;
          m2 = document.getElementById("inputPrecio").value;
          r = parseFloat(m1*m2);
         document.getElementById("inputImporte").value = r;
     });
 });
</script>

<script>
  $(document).ready(function () {
        $("#inputNounidad").on('change', function () {            
            var op = $(this).val();

            var newop = op.substr(0,1);
            if (newop == 'C') {
              $("#Check5").hide();
              $("#Check11").hide();
              $("#Check17").hide();
              $("#kmbujias").hide();
              document.getElementById("endTimeLabel5").style.display = "none";
              document.getElementById("endTimeLabel11").style.display = "none";
              document.getElementById("endTimeLabel17").style.display = "none";

              $("#Check7").show();
               document.getElementById("endTimeLabel7").style.display = "block";
            }else {
               $("#Check7").hide();
               document.getElementById("endTimeLabel7").style.display = "none";
               $("#Check5").show();
               $("#Check11").show();
               $("#Check17").show();
               $("#kmbujias").show();
               document.getElementById("endTimeLabel5").style.display = "block";
               document.getElementById("endTimeLabel11").style.display = "block";
               document.getElementById("endTimeLabel17").style.display = "block";
            }

            //alert (newop);

        });
    });
   
 </script>

 <script>
    $(document).ready(function () {
        $("#inputDescribe").on('change', function () {            
            var op = $(this).val();
             var action = 'searchCostoRefacciones';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,op:op},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputDescribe').val('');
                    $('#inputCosto').val('0.00');
                    $('#inputCodigorf').val('');
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                   
                    $('#inputCosto').val(data.Ucosto);
                    $('#inputCodigorf').val(data.codigo);
                    
                 
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

 <script type="text/javascript">
    function generarimpformulaPDF(folio){
    //console.log(cliente);
    //console.log(norecibo);
    var ancho = 1000;
    var alto = 800;
    //calcular posicion x,y para centrar la ventana

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = 'factura/form_ordenmttopreventivo.php?id='+ folio;
    window.open($url,"Mantenimiento Preventivo","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

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
