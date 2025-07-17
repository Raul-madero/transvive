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


  $sqlopr   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_operador from empleados  ORDER BY apellido_paterno";
  $queryopr = mysqli_query($conection, $sqlopr);
  $filasopr = mysqli_fetch_all($queryopr, MYSQLI_ASSOC);

  //$sqlresp   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_responsable from empleados where estatus = 1 and cargo = 'JEFE DE OPERACIONES' or cargo = 'JEFE DE MANTENIMIENTO' ORDER BY apellido_paterno";
  $sqlresp   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_responsable from empleados where estatus = 1 ORDER BY apellido_paterno";
  $queryresp = mysqli_query($conection, $sqlresp);
  $filasresp = mysqli_fetch_all($queryresp, MYSQLI_ASSOC);

  //$sqlrespac   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_responsableac from empleados  WHERE cargo = 'supervisor' or cargo = 'jefe de operaciones' or cargo LIKE '%RH%' or cargo = 'GERENTE DE OPERACIONES' or cargo = 'JEFE DE MANTENIMIENTO' and estatus = 1 ORDER BY apellido_paterno ";
  $sqlrespac   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_responsableac from empleados  WHERE estatus = 1 ORDER BY apellido_paterno ";
  $queryrespac = mysqli_query($conection, $sqlrespac);
  $filasrespac = mysqli_fetch_all($queryrespac, MYSQLI_ASSOC); 


  $sqlcte = "select * from clientes where estatus = 1 ORDER BY nombre_corto";
  $querycte = mysqli_query($conection, $sqlcte);
  $filascte = mysqli_fetch_all($querycte, MYSQLI_ASSOC);

  $sqlsupv = "select id, idacceso, concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_superv from supervisores where estatus = 1 ORDER BY nombres";
  $querysupv = mysqli_query($conection, $sqlsupv);
  $filassup = mysqli_fetch_all($querysupv, MYSQLI_ASSOC);

  //$sqlruta   = "SELECT CAST(SUBSTRING_INDEX(no_eco,'-',-1) as UNSIGNED)numero FROM rutas group by numero order by numero asc";
  //$queryruta = mysqli_query($conection, $sqlruta);
  //$filasruta = mysqli_fetch_all($queryruta, MYSQLI_ASSOC);

  $sqlruta   = "SELECT ruta FROM rutas group by ruta order by ruta";
  $queryruta = mysqli_query($conection, $sqlruta);
  $filasruta = mysqli_fetch_all($queryruta, MYSQLI_ASSOC);

  $sqlunidad   = "SELECT no_unidad FROM unidades order by no_unidad asc";
  $queryunidad = mysqli_query($conection, $sqlunidad);
  $filasunidad = mysqli_fetch_all($queryunidad, MYSQLI_ASSOC);

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

    inputsel{
        position: absolute;
        width: 100px;
        left: 8px;
        height: 15px;
        z-index: -1;
        border-right-color: transparent;
    }
    selectinput{
        width: 130px;
        height: 21px;
        z-index: 0;
    }


    hr {
        width: 100%;
        height: 2px;
        background-color: gray;
        margin: 20px auto;
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

     <?php include('includes/generalnavbar.php') ?>
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
              <li class="breadcrumb-item"><a href="no_conformidades.php">No conformidades</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

     <!-- Horizontal Form -->

     <?php
                    
          include "../conexion.php";
          //$query_folio = mysqli_query($conection,"SELECT * FROM folios where serie = 'NC'");
          //$result_folio = mysqli_num_rows($query_folio);

          //$folioe = mysqli_fetch_array($query_folio);
          //$nuevofolio=$folioe["folio"]+1; 
          //$serie=$folioe["serie"]; 


          $query_foliomov = mysqli_query($conection,"SELECT MAX(no_queja) AS noqueja FROM no_conformidades WHERE YEAR(fecha) = YEAR(CURDATE())");
          $result_foliomov = mysqli_num_rows($query_foliomov);

          $foliou = mysqli_fetch_array($query_foliomov);
          $ultimofolio = $foliou["noqueja"]+1; 
          //$serie=$folioe["serie"]; 

          $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= $ultimofolio where serie = 'NC'");
          

          mysqli_close($conection);
        ?>  
         <?php
         //date_default_timezone_set('America/Mexico_City');
         setlocale(LC_TIME, 'es_ES');
         $fcha = date("Y-m-d");
         $monthNum  = date('n');
      
         switch($monthNum)
         {   
            case 1:
            $monthNameSpanish = "ENERO";
            break;

            case 2:
            $monthNameSpanish = "FEBRERO";
            break;

            case 3:
            $monthNameSpanish = "MARZO";
            break;

            case 4:
            $monthNameSpanish = "ABRIL";
            break;
            
            case 5:
            $monthNameSpanish = "MAYO";
            break;

            case 6:
            $monthNameSpanish = "JUNIO";
            break;

            case 7:
            $monthNameSpanish = "JULIO";
            break;

            case 8:
            $monthNameSpanish = "AGOSTO";
            break;

            case 9:
            $monthNameSpanish = "SEPTIEMBRE";
            break;

            case 10:
            $monthNameSpanish = "OCTUBRE";
            break;

            case 11:
            $monthNameSpanish = "NOVIEMBRE";
            break;

            case 12:
            $monthNameSpanish = "DICIEMBRE";
            break;
   
          }

         
     ?>  

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Registro de Quejas | No conformidades</h3>
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
                    <label for="inputNoqueja" class="col-sm-2 col-form-label">No. Queja</label>
                    <div class="col-sm-2">
                      <input style="font-size: 11pt; text-align:right; color: red" type="text" class="form-control" id="inputNoqueja" name="inputNoqueja"  value="<?php echo $ultimofolio;?>" >
                    </div>
                    <label for="inputFecha" class="col-sm-1 col-form-label">Fecha</label>
                    <div class="col-sm-3">
                      <input style="font-size: 10pt" type="date" class="form-control" id="inputFecha" name="inputFecha" placeholder="Descripcion de la Tarea" value="<?php echo $fcha;?>" onchange="cambiarEndDate()">
                    </div>
                    <label for="inputMes" class="col-sm-1 col-form-label">Mes</label>
                    <div class="col-sm-3">
                      <input style="font-size: 10pt" type="text" class="form-control" id="inputMes" name="inputMes" value="<?php echo $monthNameSpanish;?>" >
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputCliente" class="col-sm-2 col-form-label">Cliente</label>
                    <div class="col-sm-6">
                    <select class="form-control select2bs4" style="width: 100%; font-size: 10pt" name="inputCliente" id="inputCliente">
                  <option value="Select">Select</option>
                  <?php foreach ($filascte as $opcte): //llenar las opciones del primer select ?>
                  <option value="<?= $opcte['nombre_corto'] ?>"><?= $opcte['nombre_corto'] ?></option>  
                  <?php endforeach; ?>
                </select>
                    </div>

                    <label for="inputFormato" class="col-sm-2 col-form-label"></label>
                      <div class="col-sm-2">
                     </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                      <label for="inputDescribe" class="col-sm-2 col-form-label">Descripción</label>
                      <div class="col-sm-10">
                      <textarea style="font-size: 10pt" rows="1" class="form-control" id="inputDescribe" name="inputDescribe"></textarea>

                     </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                      <label for="inputMotivo" class="col-sm-2 col-form-label">Motivo</label>
                      <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left; font-size: 10pt" id="inputMotivo" name="inputMotivo">
                       <option value="Select">- Seleccione -</option>
                       <option value="ACCIDENTE">ACCIDENTE</option>
                       <option value="ACTITUD DEL OPERADOR">ACTITUD DEL OPERADOR</option>
                       <option value="ASPECTO DE LA UNIDAD">ASPECTO DE LA UNIDAD</option>
                       <option value="CAMBIO DE UNIDAD">CAMBIO DE UNIDAD</option>
                       <option value="DESVIO DE RUTA">DESVIO DE RUTA</option>
                       <option value="DOCUMENTOS">DOCUMENTOS</option>
                       <option value="FALLA EN UNIDAD">FALLA EN UNIDAD</option>
                       <option value="FALTA DE PLANEACION">FALTA DE PLANEACION</option>
                       <option value="FALTA DE COMUNICACION">FALTA DE COMUNICACION</option>
                       <option value="ROTACION DE PERSONAL">ROTACION DE PERSONAL</option>
                       <option value="FALTA DE UNIDAD">FALTA DE UNIDAD</option>
                       <option value="FUMIGACION">FUMIGACION</option>
                       <option value="IMPRUDENCIA AL MANEJAR">IMPRUDENCIA AL MANEJAR</option>
                       <option value="IMPUNTUALIDAD DE RUTA">IMPUNTUALIDAD DE RUTA</option>
                       <option value="IRRESPONSABILIDAD DEL OPERADOR">IRRESPONSABILIDAD DEL OPERADOR</option>
                       <option value="MANTENIMIENTO DE UNIDAD">MANTENIMIENTO DE UNIDAD</option>
                       <option value="NO CUMPLE CON ROUTER">NO CUMPLE CON ROUTER</option>
                       <option value="NO SALE A RUTA">NO SALE A RUTA</option>
                       <option value="VANDALISMO">VANDALISMO</option>
                       <option value="UNIFICACION DE ROUTER">UNIFICACION DE ROUTER</option>
                       <option value="USUARIO">USUARIO</option>
                       <option value="OTRO">OTRO</option>
                    </select>
                    <input type="text" class="form-control mt-2" id="inputMotivoOtro" name="inputMotivoOtro" placeholder="Especifique otro motivo..." style="display: none;">


                     </div>
                  </div>

               <div class="form-group row" style="text-align:left;">
                    <label for="inputResponsable" class="col-sm-2 col-form-label">Responsable</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" style="width: 100%; font-size: 10pt" name="inputResponsable" id="inputResponsable">
                  <option value="Select">Select</option>
                  <?php foreach ($filasresp as $oprs): //llenar las opciones del primer select ?>
                  <option value="<?= $oprs['name_responsable'] ?>"><?= $oprs['name_responsable'] ?></option>  
                  <?php endforeach; ?>
                </select>  
                    </div>

                     <label for="inputSupervisor" class="col-sm-2 col-form-label">Supervisor</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" style="width: 100%; font-size: 10pt" name="inputSupervisor" id="inputSupervisor">
                  <option value="Select">Select</option>
                  <?php foreach ($filassup as $opsv): //llenar las opciones del primer select ?>
                  <option value="<?= $opsv['name_superv'] ?>"><?= $opsv['name_superv'] ?></option>  
                  <?php endforeach; ?>
                </select>  
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputOperador" class="col-sm-2 col-form-label">Operador</label>
                    <div class="col-sm-6">
                      <select class="form-control select2bs4" style="width: 100%; font-size: 10pt" name="inputOperador" id="inputOperador">
                  <option value="Select">Select</option>
                  <?php foreach ($filasopr as $opch): //llenar las opciones del primer select ?>
                  <option value="<?= $opch['name_operador'] ?>"><?= $opch['name_operador'] ?></option>  
                  <?php endforeach; ?>
                </select>  
                    </div>

                     <label for="inputUnidad" class="col-sm-2 col-form-label">Unidad</label>
                    <div class="col-sm-2">
                      <select class="form-control select2bs4" style="width: 100%; font-size: 10pt" name="inputUnidad" id="inputUnidad">
                  <option value="Select">Select</option>
                  <?php foreach ($filasunidad as $opud): //llenar las opciones del primer select ?>
                  <option value="<?= $opud['no_unidad'] ?>"><?= $opud['no_unidad'] ?></option>  
                  <?php endforeach; ?>
                </select>  
                    </div>
                  </div>   

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputRuta" class="col-sm-2 col-form-label">Ruta</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" style="width: 100%; font-size: 10pt" name="inputRuta" id="inputRuta">
                  <option value="Select">Select</option>
                  <?php foreach ($filasruta as $opru): //llenar las opciones del primer select ?>
                  <option value="<?= $opru['ruta'] ?>"><?= $opru['ruta'] ?></option>  
                  <?php endforeach; ?>
                </select>  
                    </div>

                     <label for="inputParada" class="col-sm-2 col-form-label">Parada</label>
                    <div class="col-sm-4">
                       <input style="font-size: 10pt" type="text" class="form-control" id="inputParada" name="inputParada"  >
                    </div>
                  </div>  


                  <div class="form-group row" style="text-align:left;">
                    <label for="inputFechainc" class="col-sm-2 col-form-label">Fecha de incidente</label>
                    <div class="col-sm-2">
                      <input style="font-size: 10pt" type="date" class="form-control" id="inputFechainc" name="inputFechainc"   >
                    </div>
                    <label for="inputTurno" class="col-sm-1 col-form-label">Turno</label>
                    <div class="col-sm-3">
                      <select class="form-control" style="width: 100%; text-align: left; font-size: 10pt" id="inputTurno" name="inputTurno">
                       <option value="Select">- Seleccione -</option>
                       <option value="MATUTINO">MATUTINO</option>
                       <option value="VESPERTINO">VESPERTINO</option>
                       <option value="NOCTURNO">NOCTURNO</option>
                       <option value="TODOS">TODOS</option>
                       <option value="N/A">N/A</option>
                    </select>
                    </div>
                    <label for="inputProcede" class="col-sm-2 col-form-label">¿Procede AC?</label>
                    <div class="col-sm-2">
                      <select class="form-control" style="width: 100%; text-align: left; font-size: 10pt" id="inputProcede" name="inputProcede">
                       <option value="Select">- Seleccione -</option>
                       <option value="SI">SI</option>
                       <option value="NO">NO</option>
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                      <label for="inputDescribe" class="col-sm-2 col-form-label">¿Por qué procede o no? (AC)</label>
                      <div class="col-sm-10">
                      <textarea style="font-size: 10pt" rows="1" class="form-control" id="inputPorquep" name="inputPorquep"></textarea>

                     </div>
                  </div>
                  
                  <hr> 

                  <div class="form-group row" style="text-align:left;">
                      <label for="inputAnalisis" class="col-sm-2 col-form-label">Análisis y conclusión</label>
                      <div class="col-sm-10">
                      <textarea style="font-size: 10pt" rows="1" class="form-control" id="inputAnalisis" name="inputAnalisis"></textarea>

                     </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                      <label for="inputAccion" class="col-sm-2 col-form-label">Acción</label>
                      <div class="col-sm-5">
                      <select class="form-control" style="width: 100%; text-align: left; font-size: 10pt" id="inputAccion" name="inputAccion">
                       <option value="Select">- Seleccione -</option>
                       <option value="ACTA ADMINISTRATIVA">ACTA ADMINISTRATIVA</option>
                       <option value="BAJA DE PERSONAL">BAJA DE PERSONAL</option>
                       <option value="CAMBIO DE OPERADOR">CAMBIO DE OPERADOR</option>
                       <option value="CAMBIO DE UNIDAD">CAMBIO DE UNIDAD</option>
                       <option value="CARTA COMPROMISO">CARTA COMPROMISO</option>
                       <option value="CONTRATACION DE PERSONAL">CONTARTACIOND E PERSONAL</option>
                       <option value="LLAMADA DE ATENCION VERBAL">LLAMADA DE ATENCION VERBAL</option>
                       <option value="VISITA A CLIENTE">VISITA A CLIENTE</option>
                       <option value="PAGO D EGASTOS">PAGO DE GASTOS</option>
                       <option value="PLAN DE TRABAJO">PLAN DE TRABAJO</option>
                       <option value="PLAN DE accion">PLAN DE ACCION</option>
                       <option value="PLATICA CON OPERADOR(ES)">PLATICA CON OPERADOR(ES)</option>
                       <option value="CAPACITACION">CAPOACITACION</option>
                       <option value="UNIDAD DE APOYO">UNIDAD DE APOYO</option>
                       <option value="ORDEN DE MANTENIMIENTO">ORDEN DE MANTENIMIENTO(REPARACION DE UNIDAD)</option>
                       <option value="N/A">N/A</option>
                    </select>
                     </div>
                     <label for="inputFechaccion" class="col-sm-2 col-form-label">Fecha de Acción</label>
                    <div class="col-sm-3">
                      <input style="font-size: 10pt" type="date" class="form-control" id="inputFechaccion" name="inputFechaccion"   >
                    </div>

                  </div>

                  <div class="form-group row" style="text-align:left;">
                      <label for="inputRespaccion" class="col-sm-2 col-form-label">Responsable Acción</label>
                      <div class="col-sm-10">
                      <select class="form-control select2bs4" multiple="true" style="width: 100%; font-size: 10pt" name="inputRespaccion" id="inputRespaccion">
                        <option value="N/A">N/A</option>
                        <?php foreach ($filasrespac as $opra): //llenar las opciones del primer select ?>
                        <option value="<?= $opra['name_responsableac'] ?>"><?= $opra['name_responsableac'] ?></option>  
                        <?php endforeach; ?>
                      </select>  
                     </div>
                  </div>

                  

                <div class="form-group row" style="text-align:left;">
                    <label for="inputObserva" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                       <textarea style="font-size: 10pt" rows="1" class="form-control" id="inputObserva" name="inputObserva"></textarea>
                    </div>
                </div>

                <div class="form-group row" style="text-align:left;">
                      <label for="inputTipoi" class="col-sm-2 col-form-label">Incidente ¿Interno o externo?</label>
                      <div class="col-sm-4">
                      <select class="form-control" style="width: 100%;" name="inputTipoi" id="inputTipoi">
                        <option value="Select">Select</option>
                        <option value="INTERNO">INTERNO</option>
                        <option value="EXTERNO">EXTERNO</option>
                      </select>  
                      </div>

                      <label for="inputEstatus" class="col-sm-2 col-form-label">Estatus</label>
                      <div class="col-sm-4">
                      <select class="form-control" style="width: 100%;" name="inputEstatus" id="inputEstatus">
                        <option value="Select">Select</option>
                        <option value="ABIERTO">ABIERTO</option>
                        <option value="CERRADO">CERRADO</option>
                      </select>  
                      </div>
                </div>


                <!-- 
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hora de Llegada a la Dirección</label>
                    <div class="col-sm-2">
                      <input type="time" class="form-control" id="inputHorainicio" name="inputHorainicio">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Dirección</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inputDireccion" name="inputDireccion">
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hora de Llegada al Destino</label>
                    <div class="col-sm-2">
                      <input type="time" class="form-control" id="inputHorafin" name="inputHorafin">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Destino</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="inputDestino" name="inputDestino">
                    </div>
                  </div>

                  -->
                   <div class="form-group row" style="text-align:left;">
                    <label for="inputCausa" class="col-sm-2 col-form-label">Causa</label>
                    <div class="col-sm-5">
                       <input style="font-size: 10pt" type="text" class="form-control" id="inputCausa" name="inputCausa"  >
                    </div>
                    <label for="inputAfecta" class="col-sm-2 col-form-label">Afecta al cliente</label>
                    <div class="col-sm-3">
                       <select class="form-control" style="width: 100%;" name="inputAfecta" id="inputAfecta">
                        <option value="Select">Select</option>
                        <option value="SI">SI</option>
                        <option value="NO">NO</option>
                      </select>
                    </div>
                  </div>


                  <div class="form-group row" style="text-align:left;">
                      <label for="inputArear" class="col-sm-2 col-form-label">Área responsable</label>
                      <div class="col-sm-4">
                      <select class="form-control" style="width: 100%;" name="inputArear" id="inputArear">
                        <option value="">--  Seleccione --</option>
                              <option value="Aseguramiento de Calidad">Aseguramiento de Calidad</option>
                              <option value="Administracion">Administracion</option>
                              <option value="Almacen">Almacen</option>
                              <option value="Compras">Compras</option>
                              <option value="Direccion">Direccion</option>
                              <option value="Externo">Externo</option>
                              <option value="Mantenimiento">Mantenimiento</option>
                              <option value="Recursos Humanos">Recursos Humanos</option>
                              <option value="Servicio">Servicio</option>
                              <option value="Sistemas">Sistemas</option>
                              <option value="Ventas">Ventas</option>      
                      </select>  
                      </div>

                      <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha de cierre</label>
                      <div class="col-sm-4">
                        <input style="font-size: 10pt" type="date" class="form-control" id="inputFechacierre" name="inputFechacierre">
                      </div>
                </div>

                <!-- /.card-body -->
                <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>
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


    <!-- Iniciamos el segmento de codigo javascript -->
   
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
  
           var norecibo = $('#inputNoqueja').val();
            var action = 'procesarSalirNC';
                       
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
                      location.href = 'no_conformidades.php';
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
    $('#inputMotivo').on('change', function() {
    if ($(this).val() === 'OTRO') {
        $('#inputMotivoOtro').show().focus();
    } else {
        $('#inputMotivoOtro').hide().val('');
    }
});

    </script>

<script type="text/javascript">
      $(document).ready(function(){
          
         var pedidos2 = $('#fpedido');
        //Ejecutar accion al cambiar de opcion en el select de las bandas
        $('#frazonsoc').change(function(){
          var banda_id2 = $(this).val(); //obtener el id seleccionado

          if(banda_id2 !== ''){ //verificar haber seleccionado una opcion valida

            /*Inicio de llamada ajax*/
            $.ajax({
              data: {banda_id2:banda_id2}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: 'data/get_envios2.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

              pedidos2.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
              pedidos2.prop('disabled', false); //habilitar el select
            });
            /*fin de llamada ajax*/

          }else{ //en caso de seleccionar una opcion no valida
            pedidos2.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
            pedidos2.prop('disabled', true); //deshabilitar el select
          }    
        });


        //mostrar una leyenda con el disco seleccionado
       

      });
    </script> 


    <script type="text/javascript">
      $(document).ready(function(){
          
         var horariosc = $('#fhorario');
        //Ejecutar accion al cambiar de opcion en el select de las bandas
        $('#fpedido').change(function(){
          var banda_id20 = $(this).val(); //obtener el id seleccionado

          if(banda_id20 !== ''){ //verificar haber seleccionado una opcion valida

            /*Inicio de llamada ajax*/
            $.ajax({
              data: {banda_id20:banda_id20}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: 'data/get_envios20.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

              horariosc.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
              horariosc.prop('disabled', false); //habilitar el select
            });
            /*fin de llamada ajax*/

          }else{ //en caso de seleccionar una opcion no valida
            horariosc.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
            horariosc.prop('disabled', true); //deshabilitar el select
          }    
        });


        //mostrar una leyenda con el disco seleccionado
       

      });
    </script>   


<script type="text/javascript">
      $(document).ready(function(){
          
         var pedidos3 = $('#inputNounidad');
        //Ejecutar accion al cambiar de opcion en el select de las bandas
        $('#inputTipo').change(function(){
          var banda_id3 = $(this).val(); //obtener el id seleccionado

          if(banda_id3 !== ''){ //verificar haber seleccionado una opcion valida

            /*Inicio de llamada ajax*/
            $.ajax({
              data: {banda_id3:banda_id3}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: 'data/get_envios3.php' //url que recibe las variables
            }).done(function(data){ //metodo que se ejecuta cuando ajax ha completado su ejecucion             

              pedidos3.html(data); //establecemos el contenido html de discos con la informacion que regresa ajax             
              pedidos3.prop('disabled', false); //habilitar el select
            });
            /*fin de llamada ajax*/

          }else{ //en caso de seleccionar una opcion no valida
            pedidos3.val(''); //seleccionar la opcion "- Seleccione -", osea como reiniciar la opcion del select
            pedidos3.prop('disabled', true); //deshabilitar el select
          }    
        });


        //mostrar una leyenda con el disco seleccionado
       

      });
    </script>         

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();
        function procesarRespuesta(info) {
            if (info.error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: info.error,
                });
            } else if (info.mensaje) {
                Swal.fire({
                    title: "Éxito!",
                    text: info.mensaje,
                    icon: 'success',
                }).then(() => {
                    location.href = 'no_conformidades.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'No se recibió un mensaje válido del servidor.',
                });
            }
        }

       var noqueja      = $('#inputNoqueja').val();
       var fecha        = $('#inputFecha').val();
       var mes          = $('#inputMes').val();
       var cliente      = $('#inputCliente').val();
       var formato      = $('#inputFormato').val();
       var descripcion  = $('#inputDescribe').val();
       var motivo       = $('#inputMotivo').val();
       var responsable  = $('#inputResponsable').val();
       var supervisor   = $('#inputSupervisor').val();
       var operador     = $('#inputOperador').val();
       var unidad       = $('#inputUnidad').val();
       var ruta         = $('#inputRuta').val();
       var parada       = $('#inputParada').val();
       var dateincident = $('#inputFechainc').val();
       var turno        = $('#inputTurno').val();
       var procede      = $('#inputProcede').val();
       var porkprocede  = $('#inputPorquep').val();
       var analisis     = $('#inputAnalisis').val(); 
       var accion       = $('#inputAccion').val(); 
       var dateaccion   = $('#inputFechaccion').val(); 
       var respaccion   = $('#inputRespaccion').val(); 
       var notas        = $('#inputObserva').val(); 
       var tipoinc      = $('#inputTipoi').val(); 
       var estatus      = $('#inputEstatus').val(); 
       var causa        = $('#inputCausa').val(); 
       var afectacte    = $('#inputAfecta').val(); 
       var arearespons  = $('#inputArear').val(); 
       var datecierre   = $('#inputFechacierre').val(); 

       var action       = 'AlmacenaNc';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, noqueja:noqueja, fecha:fecha, mes:mes, cliente:cliente, formato:formato, descripcion:descripcion, motivo:motivo, responsable:responsable, supervisor:supervisor, operador:operador, unidad:unidad, ruta:ruta, parada:parada, dateincident:dateincident, turno:turno, procede:procede, porkprocede:porkprocede, analisis:analisis, accion:accion, dateaccion:dateaccion, respaccion:respaccion, notas:notas, tipoinc:tipoinc, estatus:estatus, causa:causa, afectacte:afectacte, arearespons:arearespons, datecierre:datecierre},
                    success: function(response) {
                        console.log("Respuesta recibida:", response); // Muestra la respuesta exacta en la consola

                        // Si response ya es un objeto, no intentar parsearlo
                        if (typeof response === "object") {
                            console.log("La respuesta ya es un objeto:", response);
                            procesarRespuesta(response);
                            return;
                        }

                        try {
                            var info = JSON.parse(response);
                            console.log("Objeto parseado:", info);
                            procesarRespuesta(info);
                        } catch (error) {
                            console.error("Error al parsear JSON:", error, "Respuesta:", response);
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'La respuesta del servidor no es válida.',
                            });
                        }
                    },

                error: function(xhr, status, error) {
                  console.log("Error AJAX:", xhr.responseText);
                  Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: 'Hubo un problema con la solicitud.',
                  });
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
  $(document).ready(function(){
  $(".tokenizationSelect2").select2({
    placeholder: "Escribe si no se muestra al responsable", //placeholder
    tags: true,
    tokenSeparators: ['/',',',';'," "] 
  });
})
 </script> 


 <script>
  $(document).ready(function () {
        $("#foperador").on('change', function () {            
            var op = $(this).val();
            var action = 'searchSuperoperador';
  $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, op:op},
            success: function(response)
            {
                //*console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    var miMenu = document.getElementById("fsuperv");
                    miMenu.value= "Select";
                  
                }else{
                    var data = $.parseJSON(response);

                    var miMenu = document.getElementById("fsuperv");
                    //var resultid.val(data.idacceso);
                    //miMenu.value= "4";
                    miMenu.value = data['idacceso'];
                   // $('#inputSueldovta').val(data.svta); // Notify only Select2 of changes
                  
                   
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
        $("#inputTipoviaje").on('change', function () {            
            var op = $(this).val();
            var cliente     = $('#frazonsoc').val();
            var ruta        = $('#fpedido').val();
            var operador    = $('#foperador').val();
            var tipo_unidad = $('#inputTipo').val();
            var tipo_vuelta = $('#inputTipovta').val();
            //alert (op);
            var action = 'searchSueldoVuelta';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, op:op, cliente:cliente, ruta:ruta, operador:operador, tipo_unidad:tipo_unidad, tipo_vuelta:tipo_vuelta},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputSueldovta').val('0.00');
                  
                }else{
                    var data = $.parseJSON(response);
       
                    $('#inputSueldovta').val(data.svta); // Notify only Select2 of changes
                  
                   
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
        $("#inputTipovta").on('change', function () {            
            var op = $(this).val();
            var tipo_viaje  = $('#inputTipoviaje').val();
            var cliente     = $('#frazonsoc').val();
            var ruta        = $('#fpedido').val();
            var operador    = $('#foperador').val();
            var tipo_unidad = $('#inputTipo').val();

            //alert (op);
            var action = 'searchSueldoVueltavalor';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, op:op, tipo_viaje:tipo_viaje, cliente:cliente, ruta:ruta, operador:operador, tipo_unidad:tipo_unidad},
            success: function(response)
            {
                // console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputSueldovta').val('0.00');
                  
                }else{
                    var data = $.parseJSON(response);
       
                    $('#inputSueldovta').val(data.svta); // Notify only Select2 of changes
                  
                   
                }
            },
            error: function(error) {

            }

        }); 
        });
    });
</script> 

<script>
function cambiarEndDate() {
 let meses = ["ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE"];
  let date  = new Date(document.getElementById("inputFecha").value);
  let mes_name = date.getMonth();
  let name_mes = meses[mes_name];

  //alert("The input value has changed. The new value is:  "+  name_mes );
  document.getElementById("inputMes").value = name_mes;
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
