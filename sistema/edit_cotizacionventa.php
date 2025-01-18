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

  //Mostrar Datos
  if(empty($_REQUEST['id']))
  {
    header('Location: cotizaciones_venta.php');
    mysqli_close($conection);
  }
  $idsol = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM cotizaciones WHERE no_cotizacion=$idsol /*and estatus = 1*/");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: cotizaciones_venta.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id            = $data['id'];
      $nocotizacion  = $data['no_cotizacion'];
      $fecha         = $data['fecha'];
      $atencion      = $data['atencionde'];
      $tipo_cte      = $data['tipo_cliente'];
      $empresa       = $data['empresa'];
      $direccion     = $data['direccion'];
      $dias_credito  = $data['dias_credito'];
      $fecha_inicio  = $data['fecha_inicio'];
      $fecha_fin     = $data['fecha_fin'];
      $inicio_serv   = $data['comienza_servicio'];
      $notas         = $data['observaciones'];
      $estatus       = $data['estatus'];
    }
  }

  if ($estatus == 1) {
    $name_estatus = "Activa";
  }else {
    $name_estatus = "Cancelada";
  }

  include "../conexion.php";
  $sqlbs= mysqli_query($conection,"SELECT nombre_corto FROM clientes WHERE nombre = '$empresa'");
  mysqli_close($conection);
  $result_sqlbs = mysqli_num_rows($sqlbs);

   if ($tipo_cte == "Cliente") {
       
    while ($data2 = mysqli_fetch_array($sqlbs)){
      $name_empresa    = $data2['nombre_corto'];
    }
  }else {
      $name_empresa    = $empresa;
  }

   if ($tipo_cte == "Cliente") {
     $visible = "";

   }else {
    $visible = "hidden";
   }


   if ($tipo_cte == "Prospecto") {
     $visible2 = "";
   }else {
    $visible2 = "hidden";
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

  $sqlcte = "select * from clientes ORDER BY nombre_corto";
  $querycte = mysqli_query($conection, $sqlcte);
  $filascte = mysqli_fetch_all($querycte, MYSQLI_ASSOC);


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
   <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE ERP"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <?php include('includes/generalnavbar.php'); ?>
      <?php include('includes/nav.php'); ?> 

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
              <li class="breadcrumb-item"><a href="#">Requisición</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

       <?php
          /*           
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT * FROM folios where serie = 'CV'");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["folio"]+1; 

          $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'CV'");
          

          mysqli_close($conection); */
        ?>  
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edicion de Cotización Venta</h3>
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

                   <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id;?>">

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fecha;?>">
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label">Folio</label>
                    <div class="col-sm-4">
                      <input style="text-align:right;" type="text" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo $nocotizacion;?>" readonly>
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">En Atencion de:</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputAtencion" name="inputAtencion" value="<?php echo $atencion;?>">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Cliente/Prospecto</label>
                    <div class="col-sm-10">
                     
                      <select class="form-control" id="inputTipocliente" name="inputTipocliente">
                       <option value="<?php echo $tipo_cte;?>"><?php echo $tipo_cte;?></option>
                       <option value="Cliente">Cliente</option>
                       <option value="Prospecto">Prospecto</option>
                    </select>
                    </div>
                  </div>

                  <div id="esprospecto" class="form-group row" style="text-align:left;" <?php echo $visible2;?>>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Empresa</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmpresa" name="inputEmpresa" value="<?php echo $name_empresa;?>">
                    </div>
                  </div>

                  <div id="escliente" class="form-group row" style="text-align:left;" <?php echo $visible;?>>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Empresa</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputEmpresac" name="inputEmpresac">
                       <option value="<?php echo $empresa;?>"><?php echo $name_empresa;?></option>
                       <?php foreach ($filascte as $opct): //llenar las opciones del primer select ?>
                       <option value="<?= $opct['nombre'] ?>"><?= $opct['nombre_corto'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Direccion</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputDireccion" name="inputDireccion" value="<?php echo $direccion;?>">
                    </div>

                    
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Pago</label>
                    <div class="col-sm-3">
                      <input type="text" class="form-control" id="inputDiascredito" name="inputDiascredito" value="<?php echo $dias_credito;?>">
                    </div>


                     <label for="inputEmail3" class="col-sm-3 col-form-label">Comienzo del servicio</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputDiascomienzo" name="inputDiascomienzo" value="<?php echo $inicio_serv;?>">
                    </div>

                  </div>


                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Vigencia del</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputFechaini" name="inputFechaini" value="<?php echo $fecha_inicio;?>">
                    </div>


                     <label for="inputEmail3" class="col-sm-2 col-form-label">Hasta</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputFechafin" name="inputFechafin" value="<?php echo $fecha_fin;?>">
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
                    <label for="inputEmail3" class="col-sm-10 col-form-label" style="text-align:center; background-color: gainsboro;">Servicios a cotizar</label>
                    <div class="col-sm-2">
                      <a href="#"  class="btn btn-success" data-toggle="modal" data-target="#modalEditcliente" style="color:white;" ><i class="fa fa-plus"></i></a> 
                    </div>
                  </div>

                   <div class="col-sm-12">
                          <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:20%; background-color:#e9ecef; text-align: center;" >Ruta</th>
                               <th style="width:12%; background-color:#e9ecef; text-align: center;">Unidad</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Capacidad</th>
                               <th style="width:18%; background-color:#e9ecef; text-align: center;" >Dias/Hrs.</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Precio x Servicio</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputNotas" name="inputNotas" rows="1"><?php echo $notas;?></textarea>
                    </div>
                  </div>

             
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Estatus</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputEstatus" name="inputEstatus">
                       <option value="<?php echo $estatus;?>"><?php echo $name_estatus;?></option>
                       <?php 
                         if ($estatus == 1) {
                       ?>   
                           <option value="0">Cancelada</option>
                        <?php    
                         } else {
                       ?>   
                       <option value="1">Activa</option>  
                       <?php } ?>
                    </select>
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
          /* var norecibo  = $('#inputFolio').val();
            var action = 'procesarSalirCotventa';
                       
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
                      location.href = 'cotizaciones_venta.php';
                       //*location.reload();

               /*
                        
                    }else{
                        console.log('no data');
                    }
                },
                error: function(error){                
                }
            }); */
        }
    });

   

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var folio        = $('#inputFolio').val();
       var fecha        = $('#inputFecha').val();
       var atencion     = $('#inputAtencion').val();
       var tcliente     = $('#inputTipocliente').val();
       var empresa      = $('#inputEmpresa').val();
       var empresac     = $('#inputEmpresac').val();
       var direccion    = $('#inputDireccion').val();
       var diascredito  = $('#inputDiascredito').val();
       var diascomienzo = $('#inputDiascomienzo').val();
       var dateinicio   = $('#inputFechaini').val();
       var datefin      = $('#inputFechafin').val();
       var notas        = $('#inputNotas').val();
       var status       = $('#inputEstatus').val();

       if (tcliente === "Cliente") {
          var name_empresa = empresac;
       }else {
          var name_empresa = empresa;
       }
   
     
       var action       = 'AlmacenaEdicionCotizacionvta';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, fecha:fecha, atencion:atencion, tcliente:tcliente, name_empresa:name_empresa, direccion:direccion, diascredito:diascredito, diascomienzo:diascomienzo, dateinicio:dateinicio, datefin:datefin, notas:notas, status:status},

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
                          text: "COTIZACION ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                      //  generarimpformulaPDF(info.folio);
                        location.href = 'cotizaciones_venta.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'cotizaciones_venta.php';
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
            <input type="text" class="form-control" id="inputfoliodet" name="inputfoliodet" value="<?php echo $nocotizacion; ?>" readonly>
           </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Ruta:</label>
           <div class="col-sm-9">
            <input class="form-control" style="width: 100%; text-align: left" id="inputRuta" name="inputRuta">
              
           </div>
        </div>

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Unidad:</label>
           <div class="col-sm-9">
            <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputUnidad" name="inputUnidad">
                <option value="">- Seleccione -</option>
                <option value="Automovil">Automovil</option>
                <option value="Camioneta">Camioneta</option>
                <option value="Camion">Camion</option>
                <option value="Sprinter">Sprinter</option>
                
            </select>
           </div>
        </div>  

        <div class="form-group row">
           <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Capacidad:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputCapacidad" name="inputCapacidad">
           </div>
        </div>

         <div class="form-group row">
            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Dias/Hrs.:</label>
           <div class="col-sm-9">
            <input type="text" class="form-control" id="inputDiashoras" name="inputDiashoras" >
           </div>
         </div>

         <div class="form-group row">
            <label for="inputName2" class="col-sm-3 col-form-label" style="text-align: left;">Precio x Servicio:</label>
           <div class="col-sm-9">
            <input type="number" step="0.01" class="form-control" id="inputPrecio" name="inputPrecio" value="0">
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

        var folio     = $('#inputfoliodet').val();
        var ruta      = $('#inputRuta').val();
        var unidad    = $('#inputUnidad').val();
        var capacidad = $('#inputCapacidad').val();
        var diashoras = $('#inputDiashoras').val();
        var precio    = $('#inputPrecio').val();

        var action       = 'AddDetalleEditcotizacionventa';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, ruta:ruta, unidad:unidad, capacidad:capacidad, diashoras:diashoras, precio:precio},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                             //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_cotizacion').html(info.detalle);
                            //$('#detalle_totcotizacion').html(info.totales);
                            
                           
                            //alert('Cliente Agregado');

                            $('#modalEditcliente').modal('hide');
                            $('#inputRuta').val('');
                            $('#inputUnidad').val(null).trigger('change');
                            //$('#inputDescripcion').val('');
                            $('#inputCapacidad').val('');
                            $('#inputDiashoras').val('0');
                            $('#inputPrecio').val('0.00');
                           
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
    var action = 'delDetalleCotventa';
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
     var ruta      = $(e.relatedTarget).data().cantid;
     var unidad    = $(e.relatedTarget).data().codig;
     var capacidad = $(e.relatedTarget).data().descrip;
     var diashoras = $(e.relatedTarget).data().marca;
     var precio    = $(e.relatedTarget).data().precio;
    
      $(e.currentTarget).find('#txt_id').val(noid);
      $(e.currentTarget).find('#txt_folioc').val(nofolio);
      $(e.currentTarget).find('#txt_ruta').val(ruta);
      $(e.currentTarget).find('#txt_unidad').val(unidad);
      $(e.currentTarget).find('#txt_capacidad').val(capacidad);
      $(e.currentTarget).find('#txt_diashoras').val(diashoras);
      $(e.currentTarget).find('#txt_precio').val(precio);
    
  });
});

    </script> 

    <!-- Modal - Update User details -->
<div class="modal fade" id="modalEditCotizacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Edita Servicio</h5>
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
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Ruta:</label>
           <div class="col-sm-10">
            <input class="form-control" style="width: 100%; text-align: left" id="txt_ruta" name="txt_ruta">
           </div>
        </div> 

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>  
         
       
          <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Unidad:</label>
           <div class="col-sm-10">
            <select class="form-control" style="width: 100%; text-align: left" id="txt_unidad" name="txt_unidad">
                <option value="Automovil">Automovil</option>
                <option value="Camioneta">Camioneta</option>
                <option value="Camion">Camion</option>
                <option value="Sprinter">Sprinter</option>
            </select>
           </div>
        </div>  

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

         <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Capacidad:</label>
           <div class="col-sm-10">
            <input type="text" class="form-control" id="txt_capacidad" name="txt_capacidad">
           </div>
        </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Dias/Horas:</label>
           <div class="col-sm-10">
            <input type="text" step="any" class="form-control" id="txt_diashoras" name="txt_diashora">
           </div>
        </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="form-group row">
           <label for="inputName2" class="col-sm-2 col-form-label" style="text-align: left; color:#737FA7;">Precio:</label>
           <div class="col-sm-10">
            <input type="number" step="any" class="form-control" id="txt_precio" name="txt_precio" >
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
        var detruta      = $('#txt_ruta').val();
        var detunidad    = $('#txt_unidad').val();
        var detcapacidad = $('#txt_capacidad').val();
        var detdiashoras = $('#txt_diashoras').val();
        var detprecio    = $('#txt_precio').val();

        var action       = 'ActualizaEditMovcotizacionventa';
    
        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, detfolio:detfolio, detid:detid, detruta:detruta, detunidad:detunidad, detcapacidad:detcapacidad, detdiashoras:detdiashoras, detprecio:detprecio},

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

    $url = 'factura/cotizacion_venta.php?id='+ folio;
    window.open($url,"Cotizacion","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");

}
  </script> 


  <script>
    $(document).ready(function () {
        $("#inputTipocliente").on('change', function () {            
            var op = $(this).val();
           
              if (op === 'Cliente') {

                
                $("#escliente").removeAttr('hidden');
                document.getElementById('esprospecto').hidden = true;
              
              }else {

                $("#esprospecto").removeAttr('hidden');
                document.getElementById('escliente').hidden = true;
                //$("#divKmt").setAttribute('hidden');
                //*document.getElementById('divKmt').hidden = true;
              }
        });
    });
</script>

<script>
    $(document).ready(function () {
        $("#inputEmpresac").on('change', function () {            
            var op       = $(this).val();
            var tcliente = $('#inputTipocliente').val();
           
              if (tcliente === 'Cliente') {

                var action = 'searchDatosCliente';

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
                    $('#inputDireccion').val('');
                   
                  
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    //$('#frazonsoc').val(data.razonsocial).change();
                    $('#inputDireccion').val(data.direccion); // Notify only Select2 of changes
                
                   
                }
            },
            error: function(error) {

            }

        });
              
              }else {

                //$("#esprospecto").removeAttr('hidden');
                //document.getElementById('escliente').hidden = true;
                //$("#divKmt").setAttribute('hidden');
                //*document.getElementById('divKmt').hidden = true;
              }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        var c_noorden = '<?php echo $nocotizacion; ?>';
        //alert(c_noorden);
        searchForDetalleditCotventa(c_noorden);
     });
  </script>

 <script>
 function searchForDetalleditCotventa(c_noorden){
    var action = 'searchForDetalleditCotventa';
    var noorden = c_noorden;

    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, noorden:noorden},

        success: function(response)
        {
                
           
                var info = JSON.parse(response);
                $('#detalle_cotizacion').html(info.detalle);


               console.log(response);                           
           
            //viewProcesarCot();        
        },
        error: function(error) {
        }

    });
}
 
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Carga Imagen</h5>
      </div>
      <div class="modal-body">
       

          <form id="uploadForm" action="subir-updateimagencot.php" method="post" enctype="multipart/form-data" target="uploadFrame">

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
