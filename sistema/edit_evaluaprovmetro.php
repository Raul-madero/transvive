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
    header('Location: evalua_provemetrologia.php');
    mysqli_close($conection);
  }
  $noeval = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM evaluaciones_metrologia WHERE ideval = $noeval");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: evalua_provemetrologia.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id             = $data['ideval'];
      $date_eval      = $data['fecha_eval'];
      $tipo_eval      = $data['tipo_evaluacion'];
      $cveprov        = $data['cveproveedor'];
      $producto       = $data['producto'];
      $consulta       = $data['consulta'];
      $precios        = $data['precios_competitivos'];
      $documenta      = $data['documentacion'];
      $credito        = $data['credito'];
      $codigoepo      = $data['codigo_equipo'];
      $date_prox      = $data['fecha_proxima'];
      $name_tecnico   = $data['nombre_tecnico'];  
      $proteccion     = $data['proteccion'];
      $entinforme     = $data['entrega_informe'];
      $date_hist1     = $data['fecha_hist1'];
      $historia_1     = $data['historia1'];
      $date_hist2     = $data['fecha_hist2'];
      $historia_2     = $data['historia2'];
      $date_hist3     = $data['fecha_hist3'];
      $historia_3     = $data['historia3'];
      $calif_calidad  = $data['calificacion_calidad'];
      $calif_compras  = $data['calificacion_compras'];
      $calif_total    = $data['calificacion_total'];
      $resultado_ap   = $data['resultado'];
      $acciones       = $data['acciones'];
      

      if ($data['tipo_evaluacion'] == "SELECCIÓN") {
        $verboton = '';
        $verboton2 = 'hidden';
      }else {
        $verboton = 'hidden';
        $verboton2 = '';
      }

    }
  }

   include "../conexion.php";
  $sqlnp= mysqli_query($conection,"SELECT nombre FROM proveedores WHERE no_prov = $cveprov");
  mysqli_close($conection);
  $result_sqlnp = mysqli_num_rows($sqlnp);

  
    while ($data1 = mysqli_fetch_array($sqlnp)){
      $name_prov    = $data1['nombre'];
      
      //$user   = $_SESSION['idUser'];
      
    }

    include "../conexion.php";
  $sqlnpr= mysqli_query($conection,"SELECT descripcion FROM refacciones WHERE codigo = '$producto'");
  mysqli_close($conection);
  $result_sqlnpr = mysqli_num_rows($sqlnpr);

  
    while ($data2 = mysqli_fetch_array($sqlnpr)){
      $name_producto = $data2['descripcion'];
      
      //$user   = $_SESSION['idUser'];
      
    }


  

  include "../conexion.php";

  $sqloper   = "select no_prov, nombre from proveedores where estatus = 1 ORDER BY nombre";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlrecb   = "select nombre from usuario where rol = 10 and estatus = 1 ORDER BY nombre";
  $queryrecb = mysqli_query($conection, $sqlrecb);
  $filasrecb = mysqli_fetch_all($queryrecb, MYSQLI_ASSOC); 

  $sqlprod   = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY descripcion";
  $queryprod = mysqli_query($conection, $sqlprod);
  $filasprod = mysqli_fetch_all($queryprod, MYSQLI_ASSOC);

  $sqlprodnm = "select id, codigo, descripcion, marca from refacciones where estatus = 1 ORDER BY descripcion";
  $queryprodnm = mysqli_query($conection, $sqlprodnm);
  $filasprodnm = mysqli_fetch_all($queryprodnm, MYSQLI_ASSOC);

  $sqlprov   = "select id, no_prov, nombre from proveedores where estatus = 1";
  $queryprov = mysqli_query($conection, $sqlprov);
  $filasprov = mysqli_fetch_all($queryprov, MYSQLI_ASSOC); 




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
  <style>
    .hidden {
      display: none;
    }

     input[type="number"] {
      -moz-appearance: textfield; /* Firefox */
      appearance: textfield; /* Chrome, Safari, Edge */
    }
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    .table-responsive {
  overflow-x: auto;
}
.table-responsive td {
  max-width: 100%;
  white-space: nowrap;
  text-overflow: ellipsis;
}
  </style>
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">
   <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">

    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE CRM"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

     <?php
       if ($_SESSION['rol'] == 14) {
        include('includes/navbarcalidad.php');
      }else {
      include('includes/navbar.php'); 
      } ?>
      <?php include('includes/nav.php') ?>

    </div>
  </nav>

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
         
        </div>
      </div>
    </section>
    <center>
         
       <?php
         /*           
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT * FROM folios where serie = 'RQ'");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["folio"]+1; 

          $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'RQ'");
          

          mysqli_close($conection);*/
        ?>  
         <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");

         if ($_SESSION['rol'] == 14) {
           $verboton3 = '';
           $activo = 'readonly';
           $activosel = 'disabled';
           $activocal = '';
         }else {
           $verboton3 = 'hidden';
           $activo = '';
           $activosel = '';
           $activocal = 'disabled';
         }

     ?>  

     

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Edición de Evaluaciónde Proveedores (Productos)</h3>
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
                    

                    <label for="inputEmail3" class="col-sm-3 col-form-label">Tipo de valoración</label>
                    <div class="col-sm-4">
                       <select class="form-control" style="width: 100%; text-align: left" id="inputTipo" name="inputTipo" <?php echo $activosel;?>>
                       <option value="<?php echo $tipo_eval;?>"><?php echo $tipo_eval;?></option>
                        <option value="SELECCIÓN">SELECCIÓN</option>
                        <option value="EVALUACIÓN">EVALUACIÓN</option>
                        <option value="RE-EVALUACIÓN">RE-EVALUACIÓN</option>
                     </select>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha</label>
                    <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $date_eval;?>" <?php echo $activo;?>>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Nombre del Proveedor</label>
                    <div class="col-sm-9">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputProveedor" name="inputProveedor" <?php echo $activosel;?> >
                      <option value="<?php echo $cveprov;?>"><?php echo $name_prov;?></option>
                       <?php foreach ($filasoper as $oppv): //llenar las opciones del primer select ?>
                       <option value="<?= $oppv['no_prov'] ?>"><?= $oppv['nombre'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>
                    <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Producto y/o Servicio</label>
                    <div class="col-sm-9">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputProducto" name="inputProducto" <?php echo $activosel;?> >
                      <option value="<?php echo $producto;?>"><?php echo $name_producto;?></option>
                       <?php foreach ($filasprod as $opps): //llenar las opciones del primer select ?>
                       <option value="<?= $opps['codigo'] ?>"><?= $opps['descripcion'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>


                  <div id="tableContainerOne" class="col-sm-12" >
                       

<div class="row">    
<table class="table table-striped" >
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width: 5%;">No.</th>
        <th scope="col" style="width: 10%">Área</th>
        <th scope="col" style="width: 30%">Criterios</th>
        <th scope="col" style="width: 10%">Parámetro</th>
        <th scope="col" style="width: 20%">Calificacion</th>
      </tr>
    </thead>
    <tbody>

<tr>
  <td>1. </td>
  <td>COMPRAS</td>
  <td>PPRECIO</td>
  <td>1 - 70</td>
  <td><input type="number" id="input1" name="input1" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $precios;?>" <?php echo $activo;?>></td>
</tr>
<tr>
  <td>2. </td>
  <td>COMPRAS</td>
  <td>DOCUMENTACIÓN (CARTA TRAZABILIDAD, CERTIFICADO LABORATORIO APROBADO)</td>
  <td>1 - 20</td>
  <td><input type="number" id="input2" name="input2" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $documenta;?>" <?php echo $activo;?>></td>
</tr>
<tr>
  <td>3. </td>
  <td>COMPRAS</td>
  <td>CRÉDITO</td>
  <td>1 - 10</td>
  <td><input type="number" id="input3" name="input3" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $credito;?>" <?php echo $activo;?>></td>
</tr>

  
    </tbody>
 </table>
</div>
                     
</div>




<div id="tableContainerTree"  class="col-sm-12" <?php echo $verboton3;?>>
                       
<div class="row">      
<table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width: 5%;">No.</th>
        <th scope="col" style="width: 10%">Área</th>
        <th colspan="2" scope="col" style="width: 30%">Criterios</th>
        <th scope="col" style="width: 10%">Parámetro</th>
        <th scope="col" style="width: 20%">Calificacion</th>
      </tr>
    </thead>
    <tbody>

<tr>
  <td>1. </td>
  <td>CALIDAD</td>
  <td>IDENTIFICACION</td>
  <td>CÓDIGO EQUIPO</td>
  <td>1 - 10</td>
  <td><input type="number" class="form-control" id="input4" name="input4" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $codigoepo;?>" <?php echo $activocal;?>></td>
</tr>
<tr>
  <td>2. </td>
  <td>CALIDAD</td>
  <td>IDENTIFICACION</td>
  <td>FECHA DE PRÓXIMA CALIBRACIÓN</td>
  <td>1 - 20</td>
  <td><input type="number" class="form-control" id="input5" name="input5" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $date_prox;?>" <?php echo $activocal;?>></td>
</tr>
<tr>
  <td>3. </td>
  <td>CALIDAD</td>
  <td>IDENTIFICACIÓN</td>
  <td>NOMBRE DEL TÉCNICO</td>
  <td>1 - 10</td>
  <td><input type="number" class="form-control" id="input6" name="input6" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $name_tecnico;?>" <?php echo $activocal;?>></td>
</tr>
<tr>
  <td>4. </td>
  <td>CALIDAD</td>
  <td>IDENTIFICACIÓN</td>
  <td>PROTECCIÓN CONTRA DESAJUSTES</td>
  <td>1 - 30</td>
  <td><input type="number" class="form-control" id="input7" name="input7" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $proteccion;?>" <?php echo $activocal;?>></td>
</tr>
<tr>
  <td>5. </td>
  <td>CALIDAD</td>
  <td>INFORME DE CALIBRACIÓN</td>
  <td>ENTREGA DE INFORME DE CALIBRACION CON EQUIPO</td>
  <td>1 - 30</td>
  <td><input type="number" class="form-control" id="input8" name="input8" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $entinforme;?>" <?php echo $activocal;?>></td>
</tr>

    </tbody>
 </table>
</div>
</div>                      
               

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Para consultas dudas con:</label>
                    <div class="col-sm-9">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputConsulta" name="inputConsulta" <?php echo $activo;?>>
                       <option value="<?php echo $consulta;?>"><?php echo $consulta;?></option>
                       <option value="compras@transvivegdl.com">compras@transvivegdl.com</option>  
                      
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:center;">
                    <label for="inputEmail3" class="col-sm-12 col-form-label">Historial de desempeño:</label>   
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Historial de desempeño:</label>
                   <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputFechah1" name="inputFechah1" value="<?php echo $date_hist1;?>" <?php echo $activo;?>>
                    </div>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="historial1" name="historial1" min="0" step="1" oninput="validateInput(this)" value="<?php echo $historia_1;?>" <?php echo $activo;?>>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Historial de desempeño:</label>
                   <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputFechah2" name="inputFechah2" value="<?php echo $date_hist2;?>" <?php echo $activo;?>>
                    </div>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="historial2" name="historial2" min="0" step="1" oninput="validateInput(this)" value="<?php echo $historia_2;?>" <?php echo $activo;?>>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Historial de desempeño:</label>
                   <div class="col-sm-3">
                      <input type="date" class="form-control" id="inputFechah3" name="inputFechah3" value="<?php echo $date_hist3;?>" <?php echo $activo;?>>
                    </div>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="historial3" name="historial3" min="0" step="1" oninput="validateInput(this)" value="<?php echo $historia_3;?>" <?php echo $activo;?>>
                    </div>
                  </div>

 <div id="tableContainerFour" class="col-sm-12">
                       
<div class="row">      
<table class="table-responsive table  " >
    <thead class="thead-dark">
      <tr>
        <th scope="col" style="width: 10%;">Compras</th>
        <th scope="col" style="width: 10%">Calidad</th>
        <th scope="col" style="width: 10%">Total</th>
        <th scope="col" style="width: 20%">Minima aprobatoria</th>
        <th scope="col" style="width: 10%">Estatus</th>
      </tr>
    </thead>
    <tbody>

<tr>
  <td style="text-align: center;"><input type="number" step="1" name="califcompras" id="califcompras" value="<?php echo $calif_compras;?>" readonly></td>
  <td style="text-align: center;"><input type="number" step="1" name="califcalidad" id="califcalidad" value="<?php echo $calif_calidad;?>" readonly></td>
  <td style="text-align: center;"><input type="number" step="1" name="califtotal" id="califtotal" value="<?php echo $calif_total;?>" readonly></td>
  <td style="text-align: center;">80</td>
  <td style="text-align: center;"><input type="text" name="estatusc" id="estatusc" value="<?php echo $resultado_ap;?>" readonly></td>
</tr>



    </tbody>
 </table>
</div>
</div>             


 <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Acciones a seguir:</label>
                    <div class="col-sm-9">
                     <textarea class="form-control" id="inputAcciones" name="inputAcciones" rows="1"><?php echo $acciones;?></textarea>
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
            var action = 'procesarSalirCortizacioncp';
                       
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
                      location.href = 'evalua_provemetrologia.php';
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

       var id_eval       = $('#inputId').val();
       var tipo_eval     = $('#inputTipo').val();
       var fecha         = $('#inputFecha').val();
       var proveedor     = $('#inputProveedor').val();
       var producto      = $('#inputProducto').val();
       var consulta      = $('#inputConsulta').val();
       var fecha_h1      = $('#inputFechah1').val();
       var historial_h1  = $('#historial1').val();
       var fecha_h2      = $('#inputFechah2').val();
       var historial_h2  = $('#historial2').val();
       var fecha_h3      = $('#inputFechah3').val();
       var historial_h3  = $('#historial3').val();
       var tot_compras   = $('#califcompras').val();
       var tot_calidad   = $('#califcalidad').val();
       var calif_total   = $('#califtotal').val();
       var estatusc      = $('#estatusc').val();
       var acciones      = $('#inputAcciones').val();
       var precios       = $('#input1').val();
       var documenta     = $('#input2').val();
       var credito       = $('#input3').val();
       var codigo_equipo = $('#input4').val();
       var date_prox     = $('#input5').val();
       var name_tec      = $('#input6').val();
       var proteccion    = $('#input7').val();
       var entrega       = $('#input8').val();

       
   
     
       var action       = 'AlmacenaEditEvaluametro';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, id_eval:id_eval, tipo_eval, fecha:fecha, proveedor:proveedor, producto:producto, consulta:consulta, fecha_h1:fecha_h1, historial_h1:historial_h1, fecha_h2:fecha_h2, historial_h2:historial_h2, fecha_h3:fecha_h3, historial_h3:historial_h3, tot_compras:tot_compras, tot_calidad:tot_calidad, calif_total:calif_total, estatusc:estatusc, acciones:acciones, precios:precios, documenta:documenta, credito:credito, codigo_equipo:codigo_equipo, date_prox:date_prox, name_tec:name_tec, proteccion:proteccion, entrega:entrega },

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
                          text: "EVALUACION DE METROLOGIA EDITADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //generarimpformulaPDF(info.folio);
                        location.href = 'evalua_provemetrologia.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'evalua_provemetrologia.php';
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
   document.querySelector('.main-header').classList.add('disabled-nav');
</script>   
<!--
<script>
    function toggleTableVisibility() {
      var container = document.getElementById('tableContainerOne');
      var containertwo = document.getElementById('tableContainerTwo');
      var select = document.getElementById('inputTipo');
      var selectedValue = select.value;

      if (selectedValue === 'SELECCIÓN') {
        container.classList.remove('hidden');
        containertwo.classList.add('hidden');

      } else {
        container.classList.add('hidden');
        containertwo.classList.remove('hidden');
      }
    }
  </script> 

  <script>
    $(document).ready(function () {
        $("#inputTipo").on('change', function () {            
            var op = $(this).val();
           
              if (op === 'SELECCIÓN') {

                
                $("#tableContainerOne").removeAttr('hidden');
                document.getElementById('tableContainerTwo').hidden = true;
              
              }else {
                //$("#divKmt").setAttribute('hidden');
                document.getElementById('tableContainerOne').hidden = true;
                $("#tableContainerTwo").removeAttr('hidden');
              }
        });
    });
</script>
-->
  <script>
     function validateInput(input) {
      // Reemplazar todo lo que no sea dígito
      input.value = input.value.replace(/[^0-9]/g, '');
    } 

    function updateSum() {
     var sum = 0;
     // alert('Function called'); // Verifica si esta alerta aparece
      // Obtener los valores de los inputs
      var input1  = parseFloat($('#input1').val());
      var input2  = parseFloat($('#input2').val());
      var input3  = parseFloat($('#input3').val());
      var input4  = parseFloat($('#input4').val());
      var input5  = parseFloat($('#input5').val());
      var input6  = parseFloat($('#input6').val());
      var input7  = parseFloat($('#input7').val());
      var input8  = parseFloat($('#input8').val());
      
      
      //alert(input1);
      // Convertir los valores a números (en caso de que sean vacíos o no numéricos, se usan 0)
     
      var sum =  input1 + input2 + input3  ;
  


    var sumcal =  input4 + input5 + input6 + input7 + input8 ;
      var sumtotal = (sum + sumcal) /2;

      if (sumtotal >= 80 ) {
        var resultado = 'APROBADO';
      }else {
        var resultado = 'NO APROBADO';
      }

      // Mostrar el resultado en el input 'result'
      document.getElementById('califcompras').value = sum;
      document.getElementById('califcalidad').value = sumcal;
      document.getElementById('califtotal').value = sumtotal;
      document.getElementById('estatusc').value = resultado;

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
<style>
.disabled-nav {
  pointer-events: none; /* Deshabilita clics y otros eventos */
  opacity: 0.5; /* Efecto visual de estar deshabilitado */
}
</style>

</body>
</html>
