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
    header('Location: evalua_proveservicios.php');
    mysqli_close($conection);
  }
  $noeval = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT * FROM evaluaciones_servicios WHERE ideval = $noeval");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: evalua_proveservicios.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id             = $data['ideval'];
      $date_eval      = $data['fecha_eval'];
      $tipo_eval      = $data['tipo_evaluacion'];
      $cveprov        = $data['cveproveedor'];
      $producto       = $data['producto'];
      $consulta       = $data['consulta'];
      $tiempo_resp    = $data['tiempo_respuesta'];
      $documenta      = $data['documentacion'];
      $credito        = $data['credito'];
      $precios        = $data['precios_competitivos'];
      $calidads       = $data['calidad_servicio'];
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

     <?php include('includes/generalnavbar.php') ?>
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
                <h3 class="card-title">Edición de Evaluaciónde Proveedores (Servicios)</h3>
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
                      <input type="text" class="form-control" id="inputProducto" name="inputProducto" value="<?php echo $producto;?>">
                      
                    </div>
                  </div>


                  <div id="tableContainerOne" class="col-sm-12" <?php echo $verboton;?>>
                       

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
  <td>PRECIO</td>
  <td>1 - 30</td>
  <td><input type="number" id="input1" name="input1" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $precios;?>" <?php echo $activo;?>></td>
</tr>
<tr>
  <td>2. </td>
  <td>COMPRAS</td>
  <td>DOCUMENTACIÓN</td>
  <td>1 - 10</td>
  <td><input type="number" id="input2" name="input2" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $documenta;?>" <?php echo $activo;?>></td>
</tr>
<tr>
  <td>3. </td>
  <td>COMPRAS</td>
  <td>CRÉDITO</td>
  <td>1 - 10</td>
  <td><input type="number" id="input3" name="input3" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $credito;?>" <?php echo $activo;?>></td>
</tr>
<tr>
  <td>4. </td>
  <td>COMPRAS</td>
  <td>TIEMPO DE RESPUESTA</td>
  <td>1 - 50</td>
  <td><input type="number" id="input4" name="input4" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $tiempo_resp;?>" <?php echo $activo;?>></td>
</tr>
  
    </tbody>
 </table>
</div>
                     
</div>


<div id="tableContainerTwo"  class="col-sm-12" <?php echo $verboton2; ?> >
                       

<div class="row">      
<table class="table table-striped">
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
  <td>PRECIO</td>
  <td>1 - 20</td>
  <td><input type="number" id="input5" name="input5" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $precios;?>" <?php echo $activo;?>></td>
</tr>
<tr>
  <td>2. </td>
  <td>COMPRAS</td>
  <td>DOCUMENTACIÓN</td>
  <td>1 - 10</td>
  <td><input type="number" id="input6" name="input6" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $documenta;?>" <?php echo $activo;?>></td>
</tr>
<tr>
  <td>3. </td>
  <td>COMPRAS</td>
  <td>CRÉDITO</td>
  <td>1 - 10</td>
  <td><input type="number" id="input7" name="input7" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $credito;?>" <?php echo $activo;?>></td>
</tr>
<tr>
  <td>4. </td>
  <td>COMPRAS</td>
  <td>TIEMPO DE RESPUESTA</td>
  <td>1 - 30</td>
  <td><input type="number" id="input8" name="input8" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $tiempo_resp;?>" <?php echo $activo;?>></td>
</tr>

<tr>
  <td>5. </td>
  <td>COMPRAS</td>
  <td>CALIDAD DEL SERVICIO (EVIDENCIA)</td>
  <td>1 - 30</td>
  <td><input type="number" id="input9" name="input9" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="<?php echo $calidads;?>" <?php echo $activo;?>></td>
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
        <th scope="col" style="width: 30%">Criterios</th>
        <th scope="col" style="width: 10%">Parámetro</th>
        <th scope="col" style="width: 20%">Calificacion</th>
      </tr>
    </thead>
    <tbody>

<tr>
  <td>1. </td>
  <td>CALIDAD</td>
  <td>CONDICIONES DE EMPAQUE</td>
  <td>1 - 10</td>
  <td><input type="number" class="form-control" id="input11" name="input11" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="" <?php echo $activocal;?>></td>
</tr>
<tr>
  <td>2. </td>
  <td>CALIDAD</td>
  <td>RECHAZO</td>
  <td>1 - 40</td>
  <td><input type="number" class="form-control" id="input12" name="input12" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="" <?php echo $activocal;?>></td>
</tr>
<tr>
  <td>3. </td>
  <td>CALIDAD</td>
  <td>IDENTIFICACIÓN (nombre de producto, marca y proveedor)</td>
  <td>1 - 50</td>
  <td><input type="number" class="form-control" id="input13" name="input13" min="0" step="1" oninput="validateInput(this)" onblur="updateSum()" value="" <?php echo $activocal;?>></td>
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
        <th scope="col" style="width: 10%">Total</th>
        <th scope="col" style="width: 25%">Minima aprobatoria</th>
        <th scope="col" style="width: 15%">Estatus</th>
      </tr>
    </thead>
    <tbody>

<tr>
  <td style="text-align: center;"><input type="number" step="1" name="califcompras" id="califcompras" value="<?php echo $calif_compras;?>" readonly></td>
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
                      location.href = 'evalua_proveservicios.php';
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
       var fecha_h1      = $('#inputFechah1').val() ? $('#inputFecha1').val() : null;
       var historial_h1  = $('#historial1').val();
       var fecha_h2      = $('#inputFechah2').val() ? $('#inputFecha2').val() : null;
       var historial_h2  = $('#historial2').val();
       var fecha_h3      = $('#inputFechah3').val() ? $('#inputFecha3').val() : null;
       var historial_h3  = $('#historial3').val();
       var tot_compras   = $('#califcompras').val();
       var calif_total   = $('#califtotal').val();
       var estatusc      = $('#estatusc').val();
       var acciones      = $('#inputAcciones').val();
     

       if (tipo_eval == 'SELECCIÓN') {
        var precios    = $('#input1').val();
        var documenta  = $('#input2').val();
        var credito    = $('#input3').val();
        var tiempo_res = $('#input4').val();
        var calidads   = 0;
       }else {
        var precios    = $('#input5').val();
        var documenta  = $('#input6').val();
        var credito    = $('#input7').val();
        var tiempo_res = $('#input8').val();
        var calidads   = $('#input9').val();
       }
   
       var action       = 'AlmacenaEditEvaluaservicio';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, id_eval:id_eval, tipo_eval, fecha:fecha, proveedor:proveedor, producto:producto, consulta:consulta, fecha_h1:fecha_h1, historial_h1:historial_h1, fecha_h2:fecha_h2, historial_h2:historial_h2, fecha_h3:fecha_h3, historial_h3:historial_h3, tot_compras:tot_compras, calif_total:calif_total, estatusc:estatusc, acciones:acciones, precios:precios,documenta:documenta, credito:credito, tiempo_res:tiempo_res, calidads:calidads },

                    success: function(response) {
                      console.log("Respuesta bruta:", response);

                      try {
                          var info = JSON.parse(response);
                          console.log("JSON decodificado:", info);

                          if (info.mensaje === 'actualizado') {
                              Swal.fire({
                                  title: "¡Éxito!",
                                  text: "EVALUACIÓN DE SERVICIO EDITADA CORRECTAMENTE",
                                  icon: 'success',
                                  confirmButtonText: "Aceptar"
                              }).then(() => {
                                  location.href = 'evalua_proveservicios.php';
                              });
                          } else {
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Error del sistema',
                                  text: info.mensaje || 'Ocurrió un error desconocido al guardar.'
                              });
                          }

                      } catch (e) {
                          console.error("Error al parsear JSON:", e);
                          Swal.fire({
                              icon: 'error',
                              title: 'Error inesperado',
                              text: 'No se pudo procesar la respuesta del servidor.'
                          });
                      }
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
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
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
-->
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
      var input9  = parseFloat($('#input9').val());


      var tipo_eval  = $("#inputTipo").val();
      
      //alert(input1);
      // Convertir los valores a números (en caso de que sean vacíos o no numéricos, se usan 0)
      if (tipo_eval == 'SELECCIÓN') {
     
    /*
      var num5 = parseFloat(input5) || 0;
      var num6 = parseFloat(input6) || 0;
    */
      // Calcular la suma
      var sum =  input1 + input2 + input3 + input4 ;

    }else {
      var sum =  input5 + input6 + input7 + input8 + input9  ;
    }


   
      var sumtotal = sum ;

      if (sumtotal >= 80 ) {
        var resultado = 'APROBADO';
      }else {
        var resultado = 'NO APROBADO';
      }

      // Mostrar el resultado en el input 'result'
      document.getElementById('califcompras').value = sum;

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
