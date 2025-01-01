<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $id_usuario=$_SESSION['idUser'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 
	echo "<pre>";
	print_r($id_usuario);
	echo "</pre>";
  $namerol = $filas['rol'];

  if (!isset($_SESSION['idUser'])) {
  header('Location: ../index.php');
}

    //Mostrar Datos
  if(empty($_REQUEST['id']))
  {
    header('Location: orden_trabajo23.php');
    mysqli_close($conection);
  }
  $idsol = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM solicitud_mantenimiento WHERE id=$idsol /*and estatus = 1*/");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: orden_trabajo23.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id          = $data['id'];
      $noorden     = $data['no_orden'];
      $fecha       = $data['fecha'];
      $usuario     = $data['usuario'];
      $solicita    = $data['solicita'];
      $unidad       = $data['unidad'];
      $tipo_unidad  = $data['tipo_unidad'];
      $tipo_trabajo = $data['tipo_trabajo'];
      $km_neumatico = $data['km_neumatico'];
      $tipo_mantto  = $data['tipo_mantenimiento'];
      $programado   = $data['programado'];
      $wosolicitado = $data['trabajo_solicitado'];
      $wohecho      = $data['trabajo_hecho'];
      $costo_desc   = $data['costo_descuento'];
      $dateinicial  = $data['fecha_inicial'];
      $datefinal    = $data['fecha_termino'];
      $notas        = $data['notas'];
      $causas_serv  = $data['causas_servicio'];
      $notasgenera  = $data['notas_genera'];

      
    }
  }

  if ($tipo_trabajo == "NEUMATICO") {
    $visible = "";
    //$ancho  = "col-sm-4";
  }else {
    $visible = "hidden";
    //$ancho = "col-sm-10";
  }
  include "../conexion.php";


  $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados where estatus = 1 ORDER BY nombres";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlspv   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as supervisor from empleados where cargo = 'supervisor' ORDER BY nombres";
  $queryspv = mysqli_query($conection, $sqlspv);
  $filasspv = mysqli_fetch_all($queryspv, MYSQLI_ASSOC);

  $sqlunid   = "select no_unidad from unidades where estatus = 1";
  $queryunid = mysqli_query($conection, $sqlunid);
  $filasunid = mysqli_fetch_all($queryunid, MYSQLI_ASSOC); 



  /*$sqledo = "select estado from estados ORDER BY estado";
  $queryedo = mysqli_query($conection, $sqledo);
  $filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); */

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
            if ($_SESSION['rol'] == 7) {
              include('includes/navbarmantto.php');
            }else {
              if ($_SESSION['rol'] == 8) {
                include('includes/navbarjefeoper.php');
              }else {
                if ($_SESSION['rol'] == 9) {
                  include('includes/navbargrcia.php');
                }else {
                  if ($_SESSION['rol'] == 14) {
                    include('includes/navbarcalidad.php');
                  }else {
                    if ($_SESSION['rol'] == 10) {
                      include('includes/navbaralmacen.php');
                    }else {
                      include('includes/navbar.php');
                    }  
                  }  
                }
              }  
            }  
         } 
      } ?>
      <?php include('includes/nav.php') ?>

    </div>
  </nav>
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
              <li class="breadcrumb-item"><a href="solicitud_mantto.php">Orden de Trabajo Mantenimiento</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>
                    
          
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edición de Orden de Trabajo de Mantenimiento</h3>
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Orden</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo $noorden; ?>" readonly>
                    </div>
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align: right;">Fecha</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fecha;?>">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">No. Unidad</label>
                    <div class="col-sm-2">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputNounidad" name="inputNounidad">
                       <option value="<?php echo $unidad;?>"><?php echo $unidad;?></option>
                       <?php foreach ($filasunid as $opun): //llenar las opciones del primer select ?>
                       <option value="<?= $opun['no_unidad'] ?>"><?= $opun['no_unidad'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align: left;">Tipo de Unidad</label>
                    <div class="col-sm-6">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputTipounidad" name="inputTipounidad">
                       <option value="<?php echo $tipo_unidad;?>" readonly selected><?php echo $tipo_unidad;?></option>
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
                       <option value="<?php echo $usuario;?>"><?php echo $usuario;?></option>
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
                       <option value="<?php echo $solicita;?>"><?php echo $solicita;?></option>
                       <?php foreach ($filasoper as $opsp): //llenar las opciones del primer select ?>
                       <option value="<?= $opsp['operador'] ?>"><?= $opsp['operador'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo de Trabajo</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputTipotrabajo" name="inputTipotrabajo">
                       <option value="<?php echo $tipo_trabajo;?>"><?php echo $tipo_trabajo;?></option>
                       <option value="ELECTRICO">ELECTRICO</option>
                       <option value="FUMIGACIONES">FUMIGACIONES</option>
                       <option value="HERRAMIENTAS Y ACCESORIOS">HERRAMIENTAS Y ACCESORIOS</option>
                       <option value="HIDRAULICO">HIDRAULICO</option>
                       <option value="LAMINADO">LAMINADO</option>
                       <option value="LIMPIEZA">LIMPIEZA</option>
                       <option value="MECANICO">MECANICO</option>
                       <option value="NEUMATICO">NEUMATICO</option>
                       
                       
                      </select>
                    </div>
                  </div>
                    <div id="divKmt" class="form-group row" style="text-align:left;" <?php echo $visible;?>>
                    <label for="inputEmail3" class="col-sm-2 col-form-label" id="labelKmt">Kilometraje</label>
                    <div class="col-sm-10" >
                      <input type= "text" class="form-control" id="inputKmt" name="inputKmt" value="<?php echo $km_neumatico;?>">
                    </div>
                  </div>
                  
                    <div class="form-group row" style="text-align:left;"> 
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo de Mantenimiento</label>
                    <div class="col-sm-4">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputTipomantto" name="inputTipomantto">
                       <option value="<?php echo $tipo_mantto;?>"><?php echo $tipo_mantto;?></option>
                       <option value="CORRECTIVO">CORRECTIVO</option>
                       <option value="PREVENTIVO">PREVENTIVO</option>
                       <option value="INCIDENTE">INCIDENTE</option>
                       <option value="NO APLICA">NO APLICA</option>
                      </select>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Programado</label>
                    <div class="col-sm-4">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputProgramado" name="inputProgramado">
                       <option value="<?php echo $programado;?>"><?php echo $programado;?></option>
                       <option value="SI">SI</option>
                       <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>

                    <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Trabajo Solicitado</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputTrabajosolicitado" name="inputTrabajosolicitado" value="<?php echo $wosolicitado;?>" readonly> 
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Concepto</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputNotasgen" name="inputNotasgen" rows="1"><?php echo $notasgenera;?></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Trabajo Ejecutado</label>
                    <div class="col-sm-10">
                      <textarea type="date" rows="1" class="form-control" id="inputTrabajoejecutado" name="inputTrabajoejecutado"><?php echo $wohecho;?>
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
                          <table id="example10" class="table table-bordered table-hover">
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
                      <textarea type="date" rows="1" class="form-control" id="inputCostosdesc" name="inputCostosdesc"><?php echo $costo_desc;?>
                      </textarea>  
                    </div>
                  </div>  

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de Inicio</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFechaini" name="inputFechaini" value="<?php echo $dateinicial;?>">
                    </div>
               
                  
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de Culminación</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFechafin" name="inputFechafin" value="<?php echo $datefinal;?>">
                    </div>
                  </div>  

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea type="date" rows="1" class="form-control" id="inputNotas" name="inputNotas"><?php echo $notas;?>
                      </textarea>  
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Causas del Servicio</label>
                    <div class="col-sm-10">
                      <textarea type="date" rows="1" class="form-control" id="inputCausas" name="inputCausas" placeholder="Llenar"><?php echo $causas_serv;?>
                      </textarea>  
                    </div>
                  </div>

                  


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

           /* var norecibo  = $('#inputFolio').val();
            var action = 'procesarSalirSolicitudmt';
                       
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
                      console.log(response); */
                      location.href = 'orden_trabajo23.php';
                       //*location.reload();
/*
                        
                    }else{
                        console.log('no data');
                    }
                },
                error: function(error){                
                }
            });*/
        

    });
    </script>
<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var folio         = $('#inputFolio').val();
       var fecha         = $('#inputFecha').val();
       var nounidad      = $('#inputNounidad').val();
       var tipo_unidad   = $('#inputTipounidad').val();
       var operador      = $('#inputOperador').val();
       var solicita      = $('#inputSolicita').val();
       var tipotrabajo   = $('#inputTipotrabajo').val();
       var kmneumatico   = $('#inputKmt').val();
       var tipomantto    = $('#inputTipomantto').val();
       var programado    = $('#inputProgramado').val();
       var trabajosolic  = $('#inputTrabajosolicitado').val();
       var trabajohecho  = $('#inputTrabajoejecutado').val();
       var costosdesc    = $('#inputCostosdesc').val();
       var fechaini      = $('#inputFechaini').val();
       var fechafin      = $('#inputFechafin').val();
       var notas         = $('#inputNotas').val();
       var notas_genera  = $('#inputNotasgen').val();
       var causas        = $('#inputCausas').val();
       let idUsuario       = "<?php echo $id_usuario; ?>";

       var action       = 'AlmacenaEditSolicitudmantto';
        console.log(idUsuario)
        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, fecha:fecha, nounidad:nounidad, tipo_unidad:tipo_unidad, operador:operador, solicita:solicita, tipotrabajo:tipotrabajo, kmneumatico:kmneumatico, tipomantto:tipomantto, programado:programado, trabajosolic:trabajosolic, trabajohecho:trabajohecho, costosdesc:costosdesc, fechaini:fechaini, fechafin:fechafin, notas:notas, notas_genera:notas_genera, causas:causas, usuario:idUsuario},

                    success: function(response)
                    {
                        var info = JSON.parse(response);
                          if ($data === 'success')
                            {
                              Swal
                          .fire({
                            title: "Exito!",
                            text: "ORDEN DE MANTENIMIENTO ALMACENADA CORRECTAMENTE",
                            icon: 'success',

                            //showCancelButton: true,
                            //confirmButtonText: "Regresar",
                            //cancelButtonText: "Salir",
        
                        })
                          .then(resultado => {
                          if (response.value) {
                            //* generarimpformulaPDF(info.folio);
                            location.href = 'orden_trabajo23.php';
                          
                            } else {
                              // Dijeron que no
                              location.reload();
                            location.href = 'orden_trabajo23.php';
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

                                                        
    
                        },
                 error: function(error) {
                 }

               });

    });

    </script>  
<script src="js/sweetalert2.all.min.js"></script>   
<!-- Page specific script -->
<div class="modal fade" id="modalEditcliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
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
            <input type="text" class="form-control" id="inputfoliodet" name="inputfoliodet" value="<?php echo $noorden; ?>" readonly>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Cantidad:</label>
           <div class="col-sm-9">
            <input type="number" class="form-control" id="inputCantidad" name="inputCantidad" value="0">
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Descripción:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputDescribe" name="inputDescribe">
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
        var descripcion = $('#inputDescribe').val();
        

       var action       = 'AddDetallemantto';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, cantidad:cantidad, descripcion:descripcion},

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
    function del_detalle_mantto(id, folio){
    var action = 'delDeattemantto';
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
    $(document).ready(function () {
        $("#inputNounidad").on('change', function () {            
            var op = $(this).val();
             var action = 'searchNounidad';

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
                    $('#inputPlacas').val('');
                   
                }else{
                    var data = $.parseJSON(response);
                    
                    $('#inputPlacas').val(data.placas);
                   
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
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
$(document).ready(function(){
     $('#inputPrecio').blur(function(){ 
         
          m1 = document.getElementById("inputLitros").value;
          m2 = document.getElementById("inputPrecio").value;
          r = parseFloat(m1*m2);
         document.getElementById("inputImporte").value = r;
     });
 });
</script>

 <script type="text/javascript">
    $(document).ready(function(){
        var c_noorden = '<?php echo $noorden; ?>';
        //alert(c_noorden);
        searchForDetalleditSolmantto(c_noorden);
     });
  </script>

 <script>
 function searchForDetalleditSolmantto(c_noorden){
    var action = 'searchForDetalleditSolmantto';
    var noorden = c_noorden;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, noorden:noorden},

        success: function(response)
        {
                
           
                var info = JSON.parse(response);
                $('#detalle_mantto').html(info.detalle);


               console.log(response);                           
           
            //viewProcesarCot();        
        },
        error: function(error) {
        }

    });
}
 
</script>

<script>
    $(document).ready(function () {
        $("#inputTipotrabajo").on('change', function () {            
            var op = $(this).val();
           
              if (op === 'NEUMATICO') {

                
                $("#divKmt").removeAttr('hidden');
              
              }else {
                //$("#divKmt").setAttribute('hidden');
                document.getElementById('divKmt').hidden = true;
              }
        });
    });
</script>

<script>
 // $("#inputTipounidad").prop("selectedIndex", -1);
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
