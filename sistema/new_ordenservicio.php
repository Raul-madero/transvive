<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $idUser = $_SESSION['idUser'];

if (!isset($_SESSION['idUser'])) {
  header('Location: ../index.php');
}

  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqlcte = "select * from clientes where estatus = 1 ORDER BY no_cliente";
  $querycte = mysqli_query($conection, $sqlcte);
  $filascte = mysqli_fetch_all($querycte, MYSQLI_ASSOC);

  $sqlcten = "select * from clientes where estatus = 1 ORDER BY nombre_corto";
  $querycten = mysqli_query($conection, $sqlcten);
  $filascten = mysqli_fetch_all($querycten, MYSQLI_ASSOC);


  $sqlprod   = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY codigo";
  $queryprod = mysqli_query($conection, $sqlprod);
  $filasprod = mysqli_fetch_all($queryprod, MYSQLI_ASSOC);

  $sqlprodnm = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY descripcion";
  $queryprodnm = mysqli_query($conection, $sqlprodnm);
  $filasprodnm = mysqli_fetch_all($queryprodnm, MYSQLI_ASSOC);

  $sqlemp    = "select CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as empleado from empleados where estatus = 1";
  $queryemp  = mysqli_query($conection, $sqlemp);
  $filasemp  = mysqli_fetch_all($queryemp, MYSQLI_ASSOC); 



  /*$sqledo = "select estado from estados ORDER BY estado";
  $queryedo = mysqli_query($conection, $sqledo);
  $filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); */

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
              <li class="breadcrumb-item"><a href="#">Requisición</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

       <?php
                    
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT MAX(no_orden) + 1 AS siguiente_folio FROM mantenimiento_preventivo");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["folio"]+1; 

          $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'OS'");
          

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
                <h3 class="card-title">Alta de Orden de Servicio</h3>
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

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Folio</label>
                    <div class="col-sm-4">
                      <input style="text-align:right;" type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo $nuevofolio;?>" readonly>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Cliente</label>
                    <div class="col-sm-2">
                    <select class="form-control" style="width: 100%;" name="fnocliente" id="fnocliente">
                    <option value="Select">Select</option>
                    <?php foreach ($filascte as $opcte): //llenar las opciones del primer select ?>
                    <option value="<?= $opcte['no_cliente'] ?>"><?= $opcte['no_cliente'] ?></option>  
                    <?php endforeach; ?>
                    </select>
                  </div>

                     <label for="inputEmail3" class="col-sm-2 col-form-label">Cliente</label>
                    <div class="col-sm-6">
                    <select class="form-control select2bs4" style="width: 100%;" name="frazonsoc" id="frazonsoc">
                    <option value="Select">Select</option>
                    <?php foreach ($filascten as $opct): //llenar las opciones del primer select ?>
                    <option value="<?= $opct['nombre_corto'] ?>"><?= $opct['nombre_corto'] ?></option>  
                    <?php endforeach; ?>
                    </select>

                    
                  </div>
                </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Domicilio</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputDireccion" name="inputDireccion">
                    </div>

                    
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo de Servicio</label>
                    <div class="col-sm-4">
                    <select style=" font-size: 14px;" name="inputTiposerv" id="inputTiposerv" required class="form-control" >
                              <option value="">--  Seleccione --</option>
                              <option value="CONTRATO">CONTRATO</option>
                              <option value="ESPECIAL">ESPECIAL</option>
                              <option value="TURISMO">TURISMO</option>
                           </select>
                    </div>


                     <label for="inputEmail3" class="col-sm-3 col-form-label">Fecha de Inicio del Servicio</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputDateservicio" name="inputDateservicio" >
                    </div>

                  </div>
              
              
                  <!--
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Area Solicitante</label>
                          <div class="col-sm-9">
                          <select style=" font-size: 14px;" name="inputAsolicita" id="inputAsolicita" required class="form-control custom-select" >
                              <option value="">--  Seleccione --</option>
                              <option value="Mantenimiento">Mantenimiento</option>
                              <option value="Recursos Humanos">Recursos Humanos</option>
                              <option value="Compras">Compras</option>
                              <option value="Ventas">Ventas</option>
                              <option value="Servicios">Servicios</option>
                              <option value="Sistemas">Sistemas</option>
                              <option value="Almacen">Almacen</option>
                              <option value="Direccion">Direccion</option>
                           </select>
                           </div>
                  </div>

                  -->
                
                 <div class="form-group row" >
                    <label for="inputEmail3" class="col-sm-10 col-form-label" style="text-align:center; background-color: gainsboro;">Datos del Servicio</label>
                    <div class="col-sm-2">
                      <a href="#"  class="btn btn-success" data-toggle="modal" data-target="#modalEditcliente" style="color:white;" ><i class="fa fa-plus"></i></a> 
                    </div>
                  </div>

                   <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:20%; background-color:#e9ecef; text-align: center;" >Rutas</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Hora Llegada o Entrada</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Hora de Salida</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Turnos</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Tipo de Unidad</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Tipo de Vuelta</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Días a Trabajar</th>
                               <th style="width:15%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                           <tbody id="detalle_cotizacion">
                               <!---Contenido Ajax--->
                           </tbody>
                           <tfoot>
                            <!-- Contenido Ajax -->    
                           </tfoot>
                          </table>
                     
                      </div>

                  
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Contacto RH</label>
                    <div class="col-sm-10">
                      <input class="form-control" id="inputContacto" name="inputContacto">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-4">
                      <input class="form-control" id="inputCorreo" name="inputCorreo">
                    </div>
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono</label>
                    <div class="col-sm-4">
                      <input class="form-control" id="inputTelefono" name="inputTelefono">
                    </div>
                  </div>

                    <p style="text-align: left;"><b>CAMBIOS EN LA ESPECIFICACION TECNICA DEL SERVICIOS SOLICITADOS / OBSERVACIONES:</b></p>
                    <div class="col-sm-12">
                      <textarea class="form-control" id="inputNotas" name="inputNotas"></textarea>
                    </div>
                  
                    <p>&nbsp;&nbsp;&nbsp;</p>   
                  
                    <p style="text-align: left;"><b>Requisitos legales y reglamentarios aplicables:</b></p>
                     <div class="col-sm-12">
                      <textarea class="form-control" id="inputRequisitos" name="inputRequisitos"></textarea>
                    </div>
                    <p>&nbsp;&nbsp;&nbsp;</p>

                      <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-1 col-form-label">Genera</label>
                    <div class="col-sm-5">
                    <select class="form-control select2bs4" style="width: 100%;" name="inputGenera" id="inputGenera">
                    <option value="Itzuri Arriaga Paz">Itzuri Arriaga Paz</option>
                    <!--<?php foreach ($filasemp as $opemp): //llenar las opciones del primer select ?>
                    <option value="<?= $opemp['empleado'] ?>"><?= $opemp['empleado'] ?></option>  
                    <?php endforeach; ?>-->
                    </select>
                    </div>
                     <label for="inputEmail3" class="col-sm-1 col-form-label">Recibe</label>
                    <div class="col-sm-5">
                     <input class="form-control" name="inputRecibe" id="inputRecibe">
                    
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
           var norecibo  = $('#inputFolio').val();
            var action = 'procesarSalirOrdenservicio';
                       
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
                      location.href = 'ordenes_servicio.php';
                       //*location.reload();

               
                        
                    }else{
                        console.log('no data');
                    }
                },
                error: function(error){                
                }
            });
        }
    });

   

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var folio        = $('#inputFolio').val();
       var fecha        = $('#inputFecha').val();
       var nocliente    = $('#fnocliente').val();
       var cliente      = $('#frazonsoc').val();
       var direccion    = $('#inputDireccion').val();
       var tiposervicio = $('#inputTiposerv').val();
       var dateservicio = $('#inputDateservicio').val();
       var contacto     = $('#inputContacto').val();
       var correo       = $('#inputCorreo').val();
       var telefono     = $('#inputTelefono').val();
       var notas        = $('#inputNotas').val();
       var requisitos   = $('#inputRequisitos').val();
       var genera       = $('#inputGenera').val();
       var recibe       = $('#inputRecibe').val();
     
       var action       = 'AlmacenaOrdenservicio';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, fecha:fecha, nocliente:nocliente, cliente:cliente, direccion:direccion, tiposervicio:tiposervicio, dateservicio:dateservicio, contacto:contacto, correo:correo, telefono:telefono, notas:notas, requisitos:requisitos, genera:genera, recibe:recibe},

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
                          text: "ORDEN DE SERVICIO ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //generarimpformulaPDF(info.folio);
                        location.href = 'ordenes_servicio.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'ordenes_servicio.php';
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Servicios</h5>
      </div>
      <div class="modal-body">

        
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

         <div class="form-group row" hidden>
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">No. de Folio:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputfoliodet" name="inputfoliodet" value="<?php echo $nuevofolio; ?>" readonly>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Rutas:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" style="width: 100%; text-align: left" id="inputRuta" name="inputRuta">
              
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Hora de Llegada o Entrada:</label>
           <div class="col-sm-9">
             <input type="text" class="form-control" style="width: 100%; text-align: left" id="inputHoraini" name="inputHoraini">
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Hora de Salida:</label>
           <div class="col-sm-9">
             <input type="text" class="form-control" style="width: 100%; text-align: left" id="inputHorasalida" name="inputHorasalida">
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Turnos:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputTurnos" name="inputTurnos">
           </div>
        </div>

         <div class="form-group row">
            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Tipo de Unidad:</label>
           <div class="col-sm-9">
            <select class="form-control " style="width: 100%; text-align: left" id="inputUnidad" name="inputUnidad">
              <option value="">- Seleccione -</option>
              <option value="Automovil">Automovil</option>
              <option value="Camioneta">Camioneta</option>
              <option value="Camion">Camion</option>
              <option value="Sprinter">Sprinter</option>
            </select>
           </div>
         </div>

         <div class="form-group row">
            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Tipo de Vuelta:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="inputTipovuelta" name="inputTipovuelta">
              <option value="">- Seleccione -</option>
              <option value="Sencilla">Sencilla</option>
              <option value="Redonda">Redonda</option>
            </select>
           </div>
         </div>

         <div class="form-group row">
            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Días a Trabajar:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputDiastrab" name="inputDiastrab">
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

        var folio    = $('#inputfoliodet').val();
        var ruta     = $('#inputRuta').val();
        var horaini  = $('#inputHoraini').val();
        var horaslda = $('#inputHorasalida').val();
        var turno    = $('#inputTurnos').val();
        var unidad   = $('#inputUnidad').val();
        var tvuelta  = $('#inputTipovuelta').val();
        var diastrab = $('#inputDiastrab').val();

        var action       = 'AddDetalleordenservicio';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, ruta:ruta, horaini:horaini, horaslda:horaslda, turno:turno, unidad:unidad, tvuelta:tvuelta, diastrab:diastrab},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_cotizacion').html(info.detalle);
                            $('#detalle_totcotizacion').html(info.totales);
                            
                           
                            //alert('Cliente Agregado');

                            $('#modalEditcliente').modal('hide');
                            $('#inputRuta').val('');
                            $('#inputHoraini').val('');
                            $('#inputHorasalida').val('');
                            $('#inputTurnos').val('');
                            $('#inputUnidad').val(null).trigger('change');
                            $('#inputTipovuelta').val(null).trigger('change');
                            $('#inputDiastrab').val('');
                          
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
    var action = 'delDetordenservicio';
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
                            $('#detalle_cotizacion').html(info.detalle);

                        }else{
                           $('#detalle_cotizacion').html('');
                          
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
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputDescripcion').val(data.descripcion).change(); // Notify only Select2 of changes
                    $('#inputMarca').val(data.marca);
                    $('#inputPrecio').val(data.costo);
                    $('#inputImpuesto').val(data.impuesto);
                 
                   
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
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputCodigo').val(data.codigo); // Notify only Select2 of changes
                    $('#inputMarca').val(data.marca);
                    $('#inputPrecio').val(data.precioiva);
                 
                   
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
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#txt_codigo').val(data.codigo); // Notify only Select2 of changes
                    $('#txt_marca').val(data.marca);
                    $('#txt_precio').val(data.precioiva);
                 
                   
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
     var nofolio   = $(e.relatedTarget).data().nofol;
     var rutas     = $(e.relatedTarget).data().cantid;
     var hinicio   = $(e.relatedTarget).data().codig;
     var hsalida   = $(e.relatedTarget).data().hslida;
     var turnos    = $(e.relatedTarget).data().turnos;
     var tunidad   = $(e.relatedTarget).data().descrip;
     var tvuelta   = $(e.relatedTarget).data().tvelta;
     var diastrab  = $(e.relatedTarget).data().marca;
    
      $(e.currentTarget).find('#txt_id').val(noid);
      $(e.currentTarget).find('#txt_folioc').val(nofolio);
      $(e.currentTarget).find('#txt_rutas').val(rutas);
      $(e.currentTarget).find('#txt_horaini').val(hinicio);
      $(e.currentTarget).find('#txt_horasalida').val(hsalida);
      $(e.currentTarget).find('#txt_turno').val(turnos);
      $(e.currentTarget).find('#txt_tipounidad').val(tunidad);
      $(e.currentTarget).find('#txt_tipovuelta').val(tvuelta);
      $(e.currentTarget).find('#txt_diastrab').val(diastrab);
    
  });
});

    </script> 

    <!-- Modal - Update User details -->
<div class="modal fade" id="modalEditCotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edita Datos del Servicio</h5>
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
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Folio:</i>&nbsp;&nbsp;</span>
                <input type="text"  class="form-control" name="txt_folioc" id="txt_folioc" readonly>
              </div>
         </div>  

           <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left; color:#737FA7;">Rutas:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" style="width: 100%; text-align: left" id="txt_rutas" name="txt_rutas">
           </div>
        </div> 


            <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left; color:#737FA7;">Hora Llegada o Entrada:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" style="width: 100%; text-align: left" id="txt_horaini" name="txt_horaini">
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left; color:#737FA7;">Hora Llegada o Entrada:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" style="width: 100%; text-align: left" id="txt_horasalida" name="txt_horasalida">
           </div>
        </div> 

         <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left; color:#737FA7;">Turnos:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" style="width: 100%; text-align: left" id="txt_turno" name="txt_turno">
           </div>
        </div> 

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>  
         
       
          <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left; color:#737FA7;">Tipo de Unidad:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_tipounidad" name="txt_tipounidad">
                <option value="Automovil">Automovil</option>
                <option value="Camioneta">Camioneta</option>
                <option value="Camion">Camion</option>
                <option value="Sprinter">Sprinter</option>
            </select>
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left; color:#737FA7;">Tipo de Vuelta:</label>
           <div class="col-sm-9">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_tipovuelta" name="txt_tipovuelta">
                <option value="Sencilla">Sencilla</option>
                <option value="Redonda">Redonda</option>
            </select>
           </div>
        </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

         <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left; color:#737FA7;">Días Trabajados:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="txt_diastrab" name="txt_diastrab">
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
        <button type="button" class="btn btn-success pull-right" href="#" id="actualiza_paradar"><i class="fa fa-save"></i>&nbsp;Guardar</button>
      </div>
    </div>
  </div>
</div> 

<script>
   $('#actualiza_paradar').click(function(e){
        e.preventDefault();

        var detfolio     = $('#txt_folioc').val();
        var detid        = $('#txt_id').val();
        var detruta      = $('#txt_rutas').val();
        var dethoraini   = $('#txt_horaini').val();
        var dethoraslda  = $('#txt_horasalida').val();
        var detturnos    = $('#txt_turno').val();
        var detunidad    = $('#txt_tipounidad').val();
        var detvuelta    = $('#txt_tipovuelta').val();
        var detdiastrab  = $('#txt_diastrab').val();

        var action       = 'ActualizaDetordenserv';
    
        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, detfolio:detfolio, detid:detid, detruta:detruta, dethoraini:dethoraini, dethoraslda:dethoraslda, detturnos:detturnos, detunidad:detunidad, detvuelta:detvuelta, detdiastrab:detdiastrab},

                    success: function(response)
                    {
                     if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_cotizacion').html(info.detalle);
                            $('#detalle_totcotizacion').html(info.totales);
                            
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
    function generarimpformulaPDF(folio){
    //console.log(cliente);
    //console.log(norecibo);
    var ancho = 1000;
    var alto = 800;
    //calcular posicion x,y para centrar la ventana

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = 'factura/orden_servicio.php?id='+ folio;
    window.open($url,"Orden Servicio","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}
  </script> 


  <script>
    $(document).ready(function () {
        $("#fnocliente").on('change', function () {            
            var opcte = $(this).val();
             var action = 'searchClienteos';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,opcte:opcte},
            success: function(response)
            {
                 //console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#frazonsoc').val('');
                    $('#inputDireccion').val('');
                    $('#inputContacto').val('');
                    $('#inputCorreo').val('');
                    $('#inpitTelefono').val('');
                    $('#inputRecibe').val('');
                    
                    //Mostar boton agregar
                    //$('.btn_new_cliente').slideDown();
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    $('#frazonsoc').val(data.nombre_corto).change();
                    $('#inputDireccion').val(data.domicilio);
                    $('#inputContacto').val(data.contacto);
                    $('#inputCorreo').val(data.correo);
                    $('#inputTelefono').val(data.telefono);
                    $('#inputRecibe').val(data.nombre);
                   
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
        $("#frazonsoc").on('change', function () {            
            var opcte = $(this).val();
             var action = 'searchClientenameos';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,opcte:opcte},
            success: function(response)
            {
                 //console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#fnocliente').val('');
                    $('#inputDireccion').val('');
                    $('#inputContacto').val('');
                    $('#inputCorreo').val('');
                    $('#inpitTelefono').val('');
                    $('#inputRecibe').val('');
                    
                    //Mostar boton agregar
                    //$('.btn_new_cliente').slideDown();
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    $('#fnocliente').val(data.no_cliente);
                    $('#inputDireccion').val(data.domicilio);
                    $('#inputContacto').val(data.contacto);
                    $('#inputCorreo').val(data.correo);
                    $('#inputTelefono').val(data.telefono);
                    $('#inputRecibe').val(data.nombre);
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>

<script> 
  $(document).ready(function (e) {
  $('#modalCargaimagen').on('show.bs.modal', function(e) {    
     var noidimg      = $(e.relatedTarget).data().id;
    
    
      $(e.currentTarget).find('#txt_idimg').val(noidimg);
      
  });
});

    </script> 

    <!-- Modal - Update User details -->
<div class="modal fade" id="modalCargaimagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Carga Imagen Router</h5>
      </div>
      <div class="modal-body">
       

          <form id="uploadForm" action="subir-imagenoserv.php" method="post" enctype="multipart/form-data" target="uploadFrame">

        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

           <div class="col-md-12">
                    <div class="input-group" hidden>
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> ID:</i></span>
                      <input name="txt_idimg" id="txt_idimg" type="text" class="form-control" readonly>
                    </div>
             </div> 
             <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

             <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Imagen: </i></span>
                      <input name="txt_imagen" id="txt_imagen" type="file" class="form-control" >
                    </div>
             </div> 
          <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>   

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input type="submit"  class="btn btn-primary pull-right" value="Guardar" >
      
        </form>
       
     
      
    </div>
  </div>
</div> 
</div>
 
<!-- Hidden iframe -->
<iframe id="uploadFrame" name="uploadFrame" style="display:none;" onload="iframeLoaded()"></iframe>

<script>
  
  function openModal() {
        $('#modalCargaimagen').modal('show');
    }

    function closeModal() {
        $('#modalCargaimagen').modal('hide');
    }

    function iframeLoaded() {
        const iframe = document.getElementById('uploadFrame');
        const response = iframe.contentDocument.body.innerText;
        closeModal();

        if (response.includes('success:true')) {
            alert('Image uploaded successfully!');
        } 
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
