<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

   //Mostrar Datos
  if(empty($_REQUEST['id']))
  {
    header('Location: entrada_almacen.php');
    mysqli_close($conection);
  }
  $folio = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM entrada_almacen WHERE folio = $folio");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: entrada_almacen.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id            = $data['id'];
      $fecha         = $data['fecha'];
      $serie         = $data['serie'];
      $folio         = $data['folio'];
      $cantidad      = $data['cantidad_total'];
      $importe       = $data['importe_total'];
      $observaciones = $data['observaciones'];
      $estatus       = $data['estatus'];
      
    }
  }

  include "../conexion.php";

  $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados where estatus = 1 ORDER BY nombres";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlprod   = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY codigo";
  $queryprod = mysqli_query($conection, $sqlprod);
  $filasprod = mysqli_fetch_all($queryprod, MYSQLI_ASSOC);

  $sqlprodnm = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY descripcion";
  $queryprodnm = mysqli_query($conection, $sqlprodnm);
  $filasprodnm = mysqli_fetch_all($queryprodnm, MYSQLI_ASSOC);

  $sqlprov   = "select id, no_prov, nombre from proveedores where estatus = 1";
  $queryprov = mysqli_query($conection, $sqlprov);
  $filasprov = mysqli_fetch_all($queryprov, MYSQLI_ASSOC); 

  $sqlalm   = "select id, codigo, descripcion from almacenes where estatus = 1";
  $queryalm = mysqli_query($conection, $sqlalm);
  $filasalm = mysqli_fetch_all($queryalm, MYSQLI_ASSOC); 

  $sqlumed   = "select codigo, descripcion from unidades_medida ORDER BY codigo";
  $queryumed = mysqli_query($conection, $sqlumed);
  $filasumed = mysqli_fetch_all($queryumed, MYSQLI_ASSOC); 

  $sql01= mysqli_query($conection,"SELECT * FROM datos_empresa ");
  mysqli_close($conection);
  $result_sql01 = mysqli_num_rows($sql01);

    while ($data = mysqli_fetch_array($sql01)){
      $aalmacen   = $data['alm_predeterminado'];
     
    }

  //mysqli_close($conection);
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
            if ($_SESSION['rol'] == 6) {
                include('includes/navbaroperac.php');
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
                            if ($_SESSION['rol'] == 16) {
                              include('includes/navbarcompras.php');
                            }else {
                              include('includes/navbar.php');
                            }  
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
              <li class="breadcrumb-item"><a href="#">Entrada de Almacen</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

       <?php
                    
          /*include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT * FROM folios where serie = 'EN'");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["folio"]+1; 
          $serie=$folioe["serie"]; 

          $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'EN'");
          

          mysqli_close($conection);*/
        ?>  
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Alta de Entrada de Almacén</h3>
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

                     <label for="inputEmail3" class="col-sm-1 col-form-label">Serie</label>
                    <div class="col-sm-2">
                      <input style="text-align:left;" type="text" class="form-control" id="inputSerie" name="inputSerie" value="<?php echo $serie;?>" readonly>
                    </div>

                    <label for="inputEmail3" class="col-sm-1 col-form-label">Folio</label>
                    <div class="col-sm-2">
                      <input style="text-align:right; color: #FE3911; font-weight: bold" type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo $folio;?>" readonly>
                    </div>
                  </div>


                
                 <div class="form-group row" >
                    <label for="inputEmail3" class="col-sm-10 col-form-label" style="text-align:center; background-color: gainsboro;">Movimientos</label>
                    <div class="col-sm-2">
                      <a href="#"  class="btn btn-success" data-toggle="modal" data-target="#modalEditcliente" style="color:white;" ><i class="fa fa-plus"></i></a> 
                    </div>
                  </div>

                   <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Codigo</th>
                               <th style="width:20%; background-color:#e9ecef; text-align: center;">Descripción</th>
                               <th style="width:5%; background-color:#e9ecef; text-align: center;">Alm</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Marca</th>
                               <th style="width:8%; background-color:#e9ecef; text-align: center;" >Cant.</th>
                               <th style="width:8%; background-color:#e9ecef; text-align: center;" >U.M.</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Costo</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Importe</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                           <tbody id="detalle_entradaalm">
                               <!---Contenido Ajax--->
                           </tbody>
                           
                            <tfoot id="detalle_totentradaalm">
                            <!-- Contenido Ajax -->    
                           </tfoot>
                          </table>
                     
                      </div>


                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputNotas" name="inputNotas" rows="1"></textarea>
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

  </div>   
  
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

            
        Swal
    .fire({
        title: "DESEA SALIR!",
        text: "",
        icon: 'info',

        showCancelButton: true,
        confirmButtonText: "Regresar",
        cancelButtonText: "Salir",
       

       
    })
     .then(resultado => {
        if (resultado.value) {
            // Hicieron click en "Sí"
             //*location.href = 'lista_ncplantasa.php';
             console.log("Alerta cerrada");
        } else {
            // Dijeron que no
            //*location.reload();
          /* var serie    = $('#inputSerie').val();
           var norecibo = $('#inputFolio').val();
            var action = 'procesarSalirEntrada';
                       
            $.ajax({
                url: 'includes/ajax.php',
                type: "POST",
                async : true,
                data: {action:action, serie:serie, norecibo:norecibo},

                success: function(response)
                {
                    
                    if(response != 'error')
                    {
                      var info = JSON.parse(response);
                      console.log(response); */
                      location.href = 'entrada_almacen.php';
                       //*location.reload();

               /*
                        
                    }else{
                        console.log('no data');
                    }
                },
                error: function(error){                
                }
            });*/
        }
    });

   

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var fecha         = $('#inputFecha').val();
       var serie         = $('#inputSerie').val();
       var folio         = $('#inputFolio').val();
       var notas         = $('#inputNotas').val();
   
     
       var action       = 'AlmacenaEditEntradaAlm';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, fecha:fecha, serie:serie, folio:folio, notas:notas},

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
                          text: "ENTRADA DE ALMACEN EDITADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //generarimpformulaPDF(info.id);
                        location.href = 'entrada_almacen.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'entrada_almacen.php';
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
<div class="modal fade" id="modalEditcliente" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Movimiento</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Serie:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputSeriedet" name="inputSeriedet" value="<?php echo $serie; ?>" readonly>
           </div>
        </div>

         <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputfoliodet" name="inputfoliodet" value="<?php echo $nuevofolio; ?>" readonly>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Codigo:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="inputCodigo" name="inputCodigo">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprod as $oppd): //llenar las opciones del primer select ?>
                <option value="<?= $oppd['codigo'] ?>"><?= $oppd['codigo'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Descripción:</label>
           <div class="col-sm-9">
            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputDescripcion" name="inputDescripcion">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprodnm as $opnm): //llenar las opciones del primer select ?>
                <option value="<?= $opnm['descripcion'] ?>"><?= $opnm['descripcion'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Almacen:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="inputAlmacen" name="inputAlmacen">
                <option value="<?= $aalmacen ?>"><?= $aalmacen ?></option>
                <?php foreach ($filasalm as $opamc): //llenar las opciones del primer select ?>
                <option value="<?= $opamc['codigo'] ?>"><?= $opamc['codigo'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Marca:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputMarca" name="inputMarca">
           </div>
        </div>

         <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Cantidad:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputCantidad" name="inputCantidad" value="0">
           </div>
        </div>

         <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Unidad Medida:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="inputUmedida" name="inputUmedida">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasumed as $opuni): //llenar las opciones del primer select ?>
                <option value="<?= $opuni['descripcion'] ?>"><?= $opuni['descripcion'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div> 


        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Costo C/IVA:</label>
           <div class="col-sm-9">
            <input type="number" step="0.01" class="form-control" id="inputPrecio" name="inputPrecio" value="0">
           </div>
        </div>

        <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">IVA:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputImpuesto" name="inputImpuesto" value="0">
           </div>
        </div>

        <div class="form-group row" >
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Importe:</label>
           <div class="col-sm-9">
            <input type="number" step="any" class="form-control" id="inputImporte" name="inputImporte" value="0" readonly>
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

        var serie       = $('#inputSeriedet').val();
        var folio       = $('#inputfoliodet').val();
        var codigo      = $('#inputCodigo').val();
        var descripcion = $('#inputDescripcion').val();
        var almacen     = $('#inputAlmacen').val();
        var marca       = $('#inputMarca').val();
        var unidmedida  = $('#inputUmedida').val();
        var cantidad    = $('#inputCantidad').val();
        var precio      = $('#inputPrecio').val();
        var impuesto    = $('#inputImpuesto').val();
        var importe     = $('#inputImporte').val();
        

       var action       = 'AddDetalleEntradaalm';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, serie:serie, folio:folio, codigo:codigo, descripcion:descripcion, almacen:almacen, marca:marca, unidmedida:unidmedida, cantidad:cantidad, precio:precio, impuesto:impuesto, importe:importe},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_entradaalm').html(info.detalle);
                            $('#detalle_totentradaalm').html(info.totales);
                            
                           
                            //alert('Cliente Agregado');

                            $('#modalEditcliente').modal('hide');
                            $('#inputCodigo').val('');
                            $('#inputDescripcion').val(null).trigger('change');
                            //$('#inputDescripcion').val('');
                            $('#inputMarca').val('');
                            $('#inputCantidad').val('0');
                            $('#inputPrecio').val('0.00');
                            $('#inputImpuesto').val('0.00')
                            $('#inputImporte').val('0.00');
                            //$('#inputAlmacen').val('');
                            $('#inputUmedida').val('');
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
    function del_detalle_cotizacion(id, folio){
    var action = 'delDetEditEntradaalm';
    var id_det = id;
    var folio_det = folio;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, id_det:id_det, folio_det:folio_det},

        success: function(response)
        {
                      if(response != 'error')
                        {
                            console.log(response);
                            var info = JSON.parse(response);
                            $('#detalle_entradaalm').html(info.detalle);
                            $('#detalle_totentradaalm').html(info.totales);

                        }else{
                           $('#detalle_entradaalm').html('');
                           $('#detalle_totentradaalm').html('');
                          
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
    $(document).ready(function () {
        $("#inputCodigo").on('change', function () {            
            var op = $(this).val();
             var action = 'searchRefaccionesmov';

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
                    $('#inputDescripcion').val('');
                    $('#inputMarca').val('');
                    $('#inputPrecio').val('0.00')
                    $('#inputImpuesto').val('0.00')
                    $('#inputalmacen').val('');
                    $('#inputUmedida').val('');
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputDescripcion').val(data.descripcion).change(); // Notify only Select2 of changes
                    $('#inputMarca').val(data.marca);
                    $('#inputPrecio').val(data.precioiva);
                    $('#inputImpuesto').val(data.impuesto);
                    $('#inputUmedida').val(data.umedida);
                 
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#inputDescripcion").on('change', function () {            
            var op = $(this).val();
             var action = 'searchRefaccionesmovname';

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
                    $('#inputCodigo').val('');
                    $('#inputMarca').val('');
                    $('#inputPrecio').val('0.00');
                    $('#inputalmacen').val('');
                    $('#inputUmedida').val('');
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputCodigo').val(data.codigo); // Notify only Select2 of changes
                    $('#inputMarca').val(data.marca);
                    $('#inputPrecio').val(data.precioiva);
                    $('#inputImpuesto').val(data.impuesto);
                    $('#inputUmedida').val(data.umedida);
                 
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#txt_codigo").on('change', function () {            
            var op = $(this).val();
             var action = 'searchRefaccionesmov';

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
                    $('#txt_descripcion').val('');
                    $('#txt_marca').val('');
                    $('#txt_precio').val('0.00')
                    $('#txt_impuesto').val('0.00')
                    $('#txt_unidadmedida').val('');
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#txt_descripcion').val(data.descripcion).change(); // Notify only Select2 of changes
                    $('#txt_marca').val(data.marca);
                    $('#txt_precio').val(data.costo);
                    $('#txt_impuesto').val(data.impuesto);
                    $('#txt_unidadmedida').val(data.umedida);
                    $('#txt_cantidad').val(0);
                    $('#txt_importe').val(0);
                 
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#txt_descripcion").on('change', function () {            
            var op = $(this).val();
             var action = 'searchRefaccionesmovname';

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
                    $('#txt_codigo').val('');
                    $('#txt_marca').val('');
                    $('#txt_precio').val('0.00');
                    $('#txt_impuesto').val('0.00');
                    $('#txt_unidadmedida').val('');
                    $('#txt_importe').val('0.00');
                  
                }else{
                    var data = $.parseJSON(response);
                    $('#txt_codigo').val(data.codigo); // Notify only Select2 of changes
                    $('#txt_marca').val(data.marca);
                    $('#txt_precio').val(data.costo);
                    $('#txt_impuesto').val(data.impuesto);
                    $('#txt_unidadmedida').val(data.umedida);
                    $('#txt_cantidad').val(0);
                    $('#txt_importe').val(0);
                 
                   
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
     $('#inputCantidad').change(function(){ 
         
          m1 = document.getElementById("inputCantidad").value;
          m2 = document.getElementById("inputPrecio").value;
          r =  parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         document.getElementById("inputImporte").value = result;
     });
 });
</script>

<script>
$(document).ready(function(){
     $('#inputPrecio').change(function(){ 
         
          m1 = document.getElementById("inputPrecio").value;
          m2 = document.getElementById("inputCantidad").value;
          r =  parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         document.getElementById("inputImporte").value = result;
     });
 });
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalEditCotizacion').on('show.bs.modal', function(e) {    
     var noid      = $(e.relatedTarget).data().id;
     var serie     = $(e.relatedTarget).data().serie;
     var nofolio   = $(e.relatedTarget).data().nofol;
     var codigo    = $(e.relatedTarget).data().codig;
     var descripc  = $(e.relatedTarget).data().descrip;
     var almacen   = $(e.relatedTarget).data().almc;
     var marca     = $(e.relatedTarget).data().marca;
     var unidadm   = $(e.relatedTarget).data().umed;
     var cantidad  = $(e.relatedTarget).data().cantid;
     var precio    = $(e.relatedTarget).data().precio;
     var importe   = $(e.relatedTarget).data().importe;
    
      $(e.currentTarget).find('#txt_id').val(noid);
      $(e.currentTarget).find('#txt_serie').val(serie);
      $(e.currentTarget).find('#txt_folioc').val(nofolio);
      $(e.currentTarget).find('#txt_codigo').val(codigo);
      $(e.currentTarget).find('#txt_descripcion').val(descripc);
      $(e.currentTarget).find('#txt_almacen').val(almacen);
      $(e.currentTarget).find('#txt_marca').val(marca);
      $(e.currentTarget).find('#txt_unidadmedida').val(unidadm);
      $(e.currentTarget).find('#txt_cantidad').val(cantidad);
      $(e.currentTarget).find('#txt_precio').val(precio);
      $(e.currentTarget).find('#txt_importe').val(importe);
    
  });
});

    </script> 

    <!-- Modal - Update User details -->
<div class="modal fade" id="modalEditCotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edita Movimiento</h5>
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
              <div class="input-group" hidden>
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Serie:</i>&nbsp;&nbsp;</span>
                <input type="text"  class="form-control" name="txt_serie" id="txt_serie" readonly>
              </div>
              </div>  

             <div class="col-md-12">
              <div class="input-group" hidden>
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Folio:</i>&nbsp;&nbsp;</span>
                <input type="text"  class="form-control" name="txt_folioc" id="txt_folioc" readonly>
              </div>
         </div>  

           <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Codigo:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_codigo" name="txt_codigo">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprod as $oppd): //llenar las opciones del primer select ?>
                <option value="<?= $oppd['codigo'] ?>"><?= $oppd['codigo'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div> 

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>  
         
       
          <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Descripción:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_descripcion" name="txt_descripcion">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasprodnm as $opnm): //llenar las opciones del primer select ?>
                <option value="<?= $opnm['descripcion'] ?>"><?= $opnm['descripcion'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div>  

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

         <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Almacen:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_almacen" name="txt_almacen">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasalm as $opalm): //llenar las opciones del primer select ?>
                       <option value="<?= $opalm['codigo'] ?>"><?= $opalm['codigo'] ?></option>  
                       <?php endforeach; ?>
                    </select>
           </div>
        </div>

        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

         <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Marca:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_marca" name="txt_marca">
           </div>
        </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Unidad de Medida:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_unidadmedida" name="txt_unidadmedida">
                <option value="">- Seleccione -</option>
                <?php foreach ($filasumed as $opunm): //llenar las opciones del primer select ?>
                <option value="<?= $opunm['descripcion'] ?>"><?= $opunm['descripcion'] ?></option>  
                <?php endforeach; ?>
            </select>
           </div>
        </div>  

        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Cantidad:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_cantidad" name="txt_cantidad">
           </div>
        </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Costo:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_precio" name="txt_precio" >
           </div>
        </div>

        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

          <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Importe:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_importe" name="txt_importe" readonly>
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
        <button type="button" class="btn btn-success pull-right" href="#" id="actualiza_paradar"><i class="fa fa-save"></i>&nbsp;Guardar</button>
      </div>
    </div>
  </div>
</div> 

<script>
   $('#actualiza_paradar').click(function(e){
        e.preventDefault();

        var detid        = $('#txt_id').val();
        var detserie     = $('#txt_serie').val();
        var detfolio     = $('#txt_folioc').val();
        var detcodigo    = $('#txt_codigo').val();
        var detdescripc  = $('#txt_descripcion').val();
        var detalmacen   = $('#txt_almacen').val();
        var detmarca     = $('#txt_marca').val();
        var detumedida   = $('#txt_unidadmedida').val();
        var detcantidad  = $('#txt_cantidad').val();
        var detprecio    = $('#txt_precio').val();
        var detimporte   = $('#txt_importe').val();

        var action       = 'ActualizaMovEditentradaalm';
    
        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, detid:detid, detserie:detserie, detfolio:detfolio, detcodigo:detcodigo, detdescripc:detdescripc, detalmacen:detalmacen, detmarca:detmarca, detumedida:detumedida, detcantidad:detcantidad, detprecio:detprecio, detimporte:detimporte},

                    success: function(response)
                    {
                     if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_entradaalm').html(info.detalle);
                            $('#detalle_totentradaalm').html(info.totales);
                            
                            $('#modalEditCotizacion').modal('hide');
    
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
$(document).ready(function(){
     $('#txt_cantidad').change(function(){ 
         
          m1 = document.getElementById("txt_cantidad").value;
          m2 = document.getElementById("txt_precio").value;
          r =  parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         document.getElementById("txt_importe").value = result;
     });
 });
</script>

<script>
$(document).ready(function(){
     $('#txt_precio').change(function(){ 
         
          m1 = document.getElementById("txt_precio").value;
          m2 = document.getElementById("txt_cantidad").value;
          r =  parseFloat(m1*m2);
          result = Number(r.toFixed(2));
         document.getElementById("txt_importe").value = result;
     });
 });
</script>   

<script type="text/javascript">
    function generarimpformulaPDF(id){
    //console.log(cliente);
    //console.log(norecibo);
    var ancho = 1000;
    var alto = 800;
    //calcular posicion x,y para centrar la ventana

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = 'factura/entradaalmacen.php?id='+ id;
    window.open($url,"Entrada Almacen","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}
  </script> 


  <script type="text/javascript">
    $(document).ready(function(){
        var c_folio = '<?php echo $folio; ?>';
        //alert(c_noorden);
        searchForDetalleditEntrada(c_folio);
     });
  </script>

 <script>
 function searchForDetalleditEntrada(c_folio){
    var action  = 'searchForDetalleditEntrada';
    var nofolio = c_folio;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, nofolio:nofolio},

        success: function(response)
        {
                
           
                var info = JSON.parse(response);
                $('#detalle_entradaalm').html(info.detalle);
                $('#detalle_totentradaalm').html(info.totales);

               console.log(response);                           
           
            //viewProcesarCot();        
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
