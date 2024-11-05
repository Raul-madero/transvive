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
    header('Location: empleados.php');
    mysqli_close($conection);
  }
  $noempl = $_REQUEST['id'];

  $sqlact= mysqli_query($conection,"SELECT id, noempleado, if (tipo_contrato = 'indefinido', 'PLANTA', 'EVENTUAL') as tipoc, tipo, fecha_contrato, CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name, foto, date_nacimiento, ciudad_nacimiento, estado_nacimiento, sexo, estado_civil, calle, no_calle, colonia, cod_postal, municipio, estado, telefono, estudios, horario_work, curp, rfc, noclinica, no_infonavit, cargo, numeross, salarioxdia, salario_integrado, fecha_fincontrato, supervisor, motivo_baja, contacto_emergencia, nombre_emergencia, telefono_emergencia, parentesco, doc_solicitud, doc_ine, doc_licencia, doc_curp, doc_domicilio, doc_estudios, doc_actanace, doc_nss, doc_rfc, doc_infonavit, doc_recomendacion, doc_antidopaje, doc_penales, doc_medico, documentos FROM empleados WHERE noempleado = $noempl");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

  if($result_sqlact == 0){
    header('Location: empleados.php');
  }else{
    $option = '';
    while ($data = mysqli_fetch_array($sqlact)){
      $id           = $data['id'];
      $no_empl      = $data['noempleado'];
      $tipo         = $data['tipo'];
      $tipoc        = $data['tipoc'];
      $date_ingreso = $data['fecha_contrato'];
      $name_empl    = $data['name'];
      $foto         = $data['foto']; // Obtener el nombre del archivo de foto
      $date_nace    = $data['date_nacimiento'];
      $ciudad_nace  = $data['ciudad_nacimiento'];
      $estado_nace  = $data['estado_nacimiento'];
      $sexo         = $data['sexo'];
      $edo_civil    = $data['estado_civil'];
      $calle        = $data['calle'];
      $nocalle      = $data['no_calle'];
      $colonia      = $data['colonia'];
      $cpostal      = $data['cod_postal'];
      $mpio         = $data['municipio'];
      $estado       = $data['estado'];
      $phone        = $data['telefono'];
      $estudios     = $data['estudios'];
      $horario      = $data['horario_work'];
      $curp         = $data['curp'];
      $rfc          = $data['rfc'];
      $no_clinica   = $data['noclinica'];
      $no_infonavit = $data['no_infonavit'];
      $puesto       = $data['cargo'];
      $nss          = $data['numeross'];
      $sal_diario   = $data['salarioxdia'];
      $sal_integra  = $data['salario_integrado'];
      $date_ultimo  = $data['fecha_fincontrato'];
      $supervisor   = $data['supervisor'];
      $mot_baja     = $data['motivo_baja'];
      $contacto_sos = $data['nombre_emergencia'];
      $phone_sos    = $data['telefono_emergencia'];
      $parentesco   = $data['parentesco'];
      $doc_sempleo  = $data['doc_solicitud'];
      $doc_ine      = $data['doc_ine'];
      $doc_licencia = $data['doc_licencia'];
      $doc_curp     = $data['doc_curp'];
      $doc_hogar    = $data['doc_domicilio'];
      $doc_estudios = $data['doc_estudios'];
      $doc_actanace = $data['doc_actanace'];
      $doc_nss      = $data['doc_nss'];
      $doc_rfc      = $data['doc_rfc'];
      $doc_infonav  = $data['doc_infonavit'];
      $doc_recomen  = $data['doc_recomendacion'];
      $doc_drogas   = $data['doc_antidopaje'];
      $doc_penales  = $data['doc_penales'];
      $doc_medico   = $data['doc_medico'];
      $doctos       = $data['documentos']; // Obtener el nombre del archivo de Doctos
     }
  }   
  

  include "../conexion.php";



  $sqlsup = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name from supervisores ORDER BY apellido_paterno";
  $querysup = mysqli_query($conection, $sqlsup);
  $filasup = mysqli_fetch_all($querysup, MYSQLI_ASSOC); 

  $sqlnemp = "select noempleado from empleados ORDER BY noempleado";
  $querynemp = mysqli_query($conection, $sqlnemp);
  $filasnemp = mysqli_fetch_all($querynemp, MYSQLI_ASSOC); 

  $sqlname = "select CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name from empleados ORDER BY nombres";
  $queryname = mysqli_query($conection, $sqlname);
  $filasname = mysqli_fetch_all($queryname, MYSQLI_ASSOC); 


  $sqlcargo   = "select cargo from cargos ORDER BY cargo";
  $querycargo = mysqli_query($conection, $sqlcargo);
  $filascargo = mysqli_fetch_all($querycargo, MYSQLI_ASSOC); 
  
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
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
   <style>
        .card-header {
            background-color: #0072c6;
            color: white;
            border-bottom: 1px solid #00509e;
        }

        .nav-tabs .nav-link {
            border: 1px solid #0072c6;
            border-radius: 0;
            color: #0072c6;
            background-color: #e9f1f9;
        }

        .nav-tabs .nav-link.active {
            color: #fff;
            background-color: #0072c6;
            border-color: #0072c6;
        }

        .tab-content {
            padding: 15px;
            border: 1px solid #0072c6;
            border-top: none;
            border-radius: 0 0 4px 4px;
            background-color: #ffffff;
        }

        .photo-preview-container {
            position: relative;
            width: 150px;
            height: 150px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .photo-preview-container img {
            max-width: 100%;
            max-height: 100%;
        }

        .remove-photo-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: #dc3545;
            border: none;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .btn-custom {
            background-color: #0072c6;
            color: white;
            border: none;
        }

        .btn-custom:hover {
            background-color: #00509e;
        }
    </style>

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir:php" class="navbar-brand">
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
              if ($_SESSION['rol'] == 9) {
                include('includes/navbargrcia.php');
              } else {
               include('includes/navbar.php');
              }     
             }  
          }  
        } 
      } 

       if ($_SESSION['rol'] == 1 || $_SESSION['rol'] == 5 ) {
        $activo = "";
      } else { 
        $activo = "disabled";
      }
      ?>
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
          
        </div>
      </div>
    </section>
  
     <center>
     <div class="col-md-9">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0" style="text-align: left;">Alta de Empleado</h5>
        </div>
        <div class="card-body">
            <form id="employeeForm" action="process_employee.php" method="POST" enctype="multipart/form-data">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">Datos Generales</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="fiscal-tab" data-bs-toggle="tab" href="#fiscal" role="tab" aria-controls="fiscal" aria-selected="false">Datos Personales</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Datos de Nomina</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="other-tab" data-bs-toggle="tab" href="#other" role="tab" aria-controls="other" aria-selected="false">Documentación</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <!-- Datos Generales -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                        <div class="row mb-3">
                                <div class="col-md-2" style="text-align: left;">
                                    <label for="employeeNumber" class="form-label" style="font-weight: normal;">No. Empleado:</label>
                                    <input class="form-control" id="employeeNumber" name="employeeNumber" value="<?php echo $no_empl; ?>" readonly> 
                                </div>
                                <div class="col-md-4" style="text-align: left;">
                                   <label for="employeeEmpleado" class="form-label" style="font-weight: normal;">Empleado:</label>
                                   <select class="form-control" id="employeeEmpleado" name="employeeEmpleado" required>
                                     <option value="<?php echo $tipo; ?>"><?php echo $tipo; ?></option>
                                     <option value="NUEVO">NUEVO</option>
                                     <option value="REINGRESO">REINGRESO</option>
                                   </select> 
                                </div>
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeeTipo" class="form-label" style="font-weight: normal;">Tipo de Contrato:</label>
                                    <input class="form-control" id="employeeTipo" name="employeeTipo"  value="<?php echo $tipoc; ?>" readonly> 
                                </div>
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeeMaterno" class="form-label" style="font-weight: normal;">Fecha Ingreso:</label>
                                    <input type="date" class="form-control" id="employeeDateingreso" name="employeeDateingreso" value="<?php echo $date_ingreso; ?>" readonly>
                                </div>
                            </div>

                            <div class="row mb-3" style="text-align: left;">
                                <div class="col-md-12" >
                                    <label for="employeeName" class="form-label" style="font-weight: normal;">Nombre del Empleado:</label>
                                    <input class="form-control" id="employeeName" name="employeeName" value="<?php echo $name_empl; ?>" readonly>
                                </div>
                            </div>
                           
                            <!-- Carga y Vista Previa de la Foto del Empleado -->
                            <div class="row mb-4">
                                <div class="col-md-6" style="text-align: left;">
                                    <label for="employeePhoto" class="form-label" style="font-weight:normal">Foto del Empleado:</label>
                                    <input type="file" class="form-control" id="employeePhoto" name="employeePhoto" accept="image/*" onchange="previewPhoto(event)">
                                </div>
                                <div class="col-md-6 d-flex flex-column align-items-center">
                                    <div class="photo-preview-container" id="photoPreviewContainer">
                                        <img id="photoPreview" src="uploads/<?php echo $foto; ?>" alt="Foto del Empleado" >
                                        <button type="button" class="remove-photo-btn" onclick="removePhoto()" style="display: none;">&times;</button>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    <!-- Datos Fiscales -->
                    <div class="tab-pane fade" id="fiscal" role="tabpanel" aria-labelledby="fiscal-tab">
                       <div class="row mb-3">
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeeName" class="form-label" style="font-weight: normal;">Fecha de Nacimiento:</label>
                                    <input type="date" class="form-control" id="employeeDatenac" name="employeeDatenac" value="<?php echo $date_nace; ?>" readonly>
                                </div>
                                <div class="col-md-5" style="text-align: left;">
                                    <label for="employeeCiudad" class="form-label" style="font-weight: normal;">Ciudad:</label>
                                    <input type="text" class="form-control" id="employeeCiudad" name="employeeCiudad" value="<?php echo $ciudad_nace; ?>">
                                </div>
                                <div class="col-md-4" style="text-align: left;">
                                    <label for="employeeEdonace" class="form-label" style="font-weight: normal;">Estado de Nacimiento:</label>
                                    <input type="text" class="form-control" id="employeeEdonace" name="employeeEdonace" value="<?php echo $estado_nace; ?>">
                                </div>
                            </div>
                             <div class="row mb-3">
                                <div class="col-md-6" style="text-align: left;">
                                    <label for="employeeSexo" class="form-label" style="font-weight: normal;">Sexo:</label>
                                    <input class="form-control" id="employeeSexo" name="employeeSexo" value="<?php echo $sexo; ?>" readonly> 
                                </div>
                                <div class="col-md-6" style="text-align: left;">
                                    <label for="employeeEdocivil" class="form-label" style="font-weight: normal;">Estado Civil:</label>
                                    <input class="form-control" id="employeeEdocivil" name="employeeEdocivil" value="<?php echo $edo_civil; ?>" readonly>
                                      
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-6" style="text-align: left;">
                                    <label for="employeeCalle" class="form-label" style="font-weight: normal;">Domicilio Actual (calle):</label>
                                    <input type="text" class="form-control" id="employeeCalle" name="employeeCalle" value="<?php echo $calle; ?>">
                                </div>
                                <div class="col-md-2" style="text-align: left;">
                                    <label for="employeeCalleno" class="form-label" style="font-weight: normal;">No.:</label>
                                    <input type="text" class="form-control" id="employeeCalleno" name="employeeCalleno" value="<?php echo $nocalle; ?>">
                                </div>
                                <div class="col-md-4" style="text-align: left;">
                                    <label for="employeeColonia" class="form-label" style="font-weight: normal;">Colonia:</label>
                                    <input type="text" class="form-control" id="employeeColonia" name="employeeColonia" value="<?php echo $colonia; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-2" style="text-align: left;">
                                    <label for="employeeCpostal" class="form-label" style="font-weight: normal;">Codigo Postal:</label>
                                    <input type="text" class="form-control" id="employeeCpostal" name="employeeCpostal" value="<?php echo $cpostal; ?>">
                                </div>
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeeMpio" class="form-label" style="font-weight: normal;">Municipio:</label>
                                    <input type="text" class="form-control" id="employeeMpio" name="employeeMpio" value="<?php echo $mpio; ?>">
                                </div>
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeeEstado2" class="form-label" style="font-weight: normal;">Estado:</label>
                                    <input type="text" class="form-control" id="employeEstado2" name="employeEstado2" value="<?php echo $estado; ?>">
                                </div>
                                <div class="col-md-4" style="text-align: left;">
                                    <label for="employeePhone" class="form-label" style="font-weight: normal;">Teléfonos:</label>
                                    <input type="text" class="form-control" id="employePhone" name="employePhone" value="<?php echo $phone; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-12" style="text-align: left;">
                                    <label for="employeeNivele" class="form-label" style="font-weight: normal;">Nivel de Estudios:</label>
                                    <input type="text" class="form-control" id="employeeNivele" name="employeeNivele" value="<?php echo $estudios; ?>" readonly>
                                </div>
                            </div>
                    </div>
                    <!-- Contacto -->
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                         <div class="row mb-3">
                                <div class="col-md-4" style="text-align: left;">
                                    <label for="employeeHorario" class="form-label" style="font-weight: normal;">Horario de trabajo:</label>
                                    <input type="text" class="form-control" id="employeeHorario" name="employeeHorario" value="<?php echo $horario; ?>">
                                </div>
                                <div class="col-md-4" style="text-align: left;">
                                    <label for="employeeCurp" class="form-label" style="font-weight: normal;">CURP:</label>
                                    <input type="text" class="form-control" id="employeeCurp" name="employeeCurp" value="<?php echo $curp; ?>" readonly>
                                </div>
                                <div class="col-md-4" style="text-align: left;">
                                    <label for="employeeRfc" class="form-label" style="font-weight: normal;">RFC:</label>
                                    <input type="text" class="form-control" id="employeeRfc" name="employeeRfc" value="<?php echo $rfc; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeePuesto" class="form-label" style="font-weight: normal;">Puesto:</label>
                                    <input type="text" class="form-control" id="employeePuesto" name="employeePuesto" value="<?php echo $puesto; ?>" readonly>
                                </div>
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeeNss" class="form-label" style="font-weight: normal;">NSS:</label>
                                    <input type="text" class="form-control" id="employeeNss" name="employeeNss" value="<?php echo $nss; ?>" readonly>
                                </div>
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeeClinica" class="form-label" style="font-weight: normal;">No. Clinica:</label>
                                    <input type="text" class="form-control" id="employeeClinica" name="employeeClinica" value="<?php echo $no_clinica; ?>">
                                </div>
                                <div class="col-md-3" style="text-align: left;">
                                    <label for="employeeNoinfonavit" class="form-label" style="font-weight: normal;">No. Prestamo Infonavit:</label>
                                    <input type="text" class="form-control" id="employeeNoinfonavit" name="employeeNoinfonavit" value="<?php echo $no_infonavit; ?>">
                                </div>
                            </div>
                            <div class="row mb-3">
                            <div class="col-md-2" style="text-align: left;">
                                <label for="employeeSalariodia" class="form-label" style="font-weight: normal;">Salario Diario:</label>
                                <input type="text" class="form-control" id="employeeSalariodia" name="employeeSalariodia" value="<?php echo $sal_diario; ?>">
                            </div>
                            <div class="col-md-3" style="text-align: left;">
                                <label for="employeeSalarioint" class="form-label" style="font-weight: normal;">Salario Diario Integrado:</label>
                                <input type="text" class="form-control" id="employeeSalarioint" name="employeeSalarioint" value="<?php echo $sal_integra; ?>">
                            </div>
                            <div class="col-md-3" style="text-align: left;">
                                <label for="employeeUltimoc" class="form-label" style="font-weight: normal;">Fecha Último Contrado:</label>
                                <input type="date" class="form-control" id="employeeUltimoc" name="employeeUltimoc" value="<?php echo $date_ultimo; ?>">
                            </div>
                            <div class="col-md-4" style="text-align: left;">
                                <label for="employeeSupervisor" class="form-label" style="font-weight: normal;">Referencia Interna (Supervisor):</label>
                                <input type="text" class="form-control" id="employeeSupervisor" name="employeeSupervisor" value="<?php echo $supervisor; ?>" readonly>
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-md-12" style="text-align: left;">
                                <label for="employeeMotivo" class="form-label" style="font-weight: normal;">Motivo de Renuncia:</label>
                                <input type="text" class="form-control" id="employeeMotivo" name="employeeMotivo" value="<?php echo $mot_baja; ?>">
                            </div>
                          </div>
                          <div class="row mb-3">
                            <div class="col-md-12" style="text-align: center;">
                                <label for="employeeColonia" class="form-label" style="font-weight: normal;">Contacto de Emergencia:</label>
                               
                          </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4" style="text-align: left;">
                                <label for="employeeContacto" class="form-label" style="font-weight: normal;">Mombre:</label>
                                <input type="text" class="form-control" id="employeeContacto" name="employeeContacto" value="<?php echo $contacto_sos; ?>">
                            </div>
                            <div class="col-md-4" style="text-align: left;">
                                <label for="employeePhonect" class="form-label" style="font-weight: normal;">Teléfono:</label>
                                <input type="text" class="form-control" id="employeePhonect" name="employeePhonect" value="<?php echo $phone_sos; ?>">
                            </div>
                            <div class="col-md-4" style="text-align: left;">
                                <label for="employeePariente" class="form-label" style="font-weight: normal;">Parentesco:</label>
                                <input type="text" class="form-control" id="employeePariente" name="employeePariente" value="<?php echo $parentesco; ?>">
                            </div>
                          
                          </div>
                    </div>
                    <!-- Otros Datos -->
                    <div class="tab-pane fade" id="other" role="tabpanel" aria-labelledby="other-tab">
                        <div class="row mb-3">
                            <div class="col-md-3" style="text-align:left;">
                                <label for="docSolicitud" class="form-label" style="font-weight:normal;">Solicitud de Empleo / CV:</label>   
                            </div>
                            <div class="col-md-1">
                                <select class="form-control" id="docSolicitud" name="docSolicitud">
                                    <option value="<?php echo $doc_sempleo; ?>"><?php echo $doc_sempleo; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="text-align:left;">
                                <label for="docIne" class="form-label" style="font-weight:normal;">Copia INE / Pasaporte:</label>
                            </div>
                            <div class="col-md-1">
                                <select class="form-control" id="docIne" name="docIne">
                                    <option value="<?php echo $doc_ine; ?>"><?php echo $doc_ine; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="text-align:left;">
                                <label for="docLicencia" class="form-label" style="font-weight:normal;">Copia Licencia de Conducir:</label>
                            </div>
                            <div class="col-md-1">
                                <select class="form-control" id="docLicencia" name="docLicencia">
                                    <option value="<?php echo $doc_licencia; ?>"><?php echo $doc_licencia; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                </select>
                            </div>
                        </div>
                        
                         <div class="row mb-3">
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docCurp" class="form-label" style="font-weight:normal;">CURP:</label>   
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docCurp" name="docCurp">
                                    <option value="<?php echo $doc_curp; ?>"><?php echo $doc_curp; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docHogar" class="form-label" style="font-weight:normal;">Copia Comprobante Domicilio Reciente:</label>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docHogar" name="docHogar">
                                    <option value="<?php echo $doc_hogar; ?>"><?php echo $doc_hogar; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docEstudios" class="form-label" style="font-weight:normal;">Copia Comprobante de Estudios:</label>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docEstudios" name="docEstudios">
                                    <option value="<?php echo $doc_estudios; ?>"><?php echo $doc_estudios; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docActanace" class="form-label" style="font-weight:normal;">Copia Acta de Nacimiento:</label>   
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docActanace" name="docActanace">
                                    <option value="<?php echo $doc_actanace; ?>"><?php echo $doc_actanace; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docNss" class="form-label" style="font-weight:normal;">Número de Seguridad Social:</label>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docNss" name="docNss">
                                    <option value="<?php echo $doc_nss; ?>"><?php echo $doc_nss; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docRfc" class="form-label" style="font-weight:normal;">RFC:</label>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docRfc" name="docRfc">
                                    <option value="<?php echo $doc_rfc; ?>"><?php echo $doc_rfc; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docInfonavit" class="form-label" style="font-weight:normal;">Aviso de Retención de Infonavit:</label>   
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docInfonavit" name="docInfonavit">
                                    <option value="<?php echo $doc_infonav; ?>"><?php echo $doc_infonav; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docRecomenda" class="form-label" style="font-weight:normal;">Carta de Recomendación Laboral:</label>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docRecomenda" name="docRecomenda">
                                    <option value="<?php echo $doc_recomen; ?>"><?php echo $doc_recomen; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docAntidopaje" class="form-label" style="font-weight:normal;">Antidopaje:</label>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docAntidopaje" name="docAntidopaje">
                                    <option value="<?php echo $doc_drogas; ?>"><?php echo $doc_drogas; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docPenales" class="form-label" style="font-weight:normal;">Carta de Antecedendes No Penales:</label>   
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docPenales" name="docPenales">
                                    <option value="<?php echo $doc_penales; ?>"><?php echo $doc_penales; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="col-md-3" style="text-align:left;">
                                    <label for="docMedico" class="form-label" style="font-weight:normal;">Exámen Médico:</label>
                                </div>
                                <div class="col-md-1">
                                    <select class="form-control" id="docMedico" name="docMedico">
                                    <option value="<?php echo $doc_medico; ?>"><?php echo $doc_medico; ?></option>
                                    <option value="SI">SI</option>
                                    <option value="NO">NO</option>
                                    </select>
                                </div>
                               <div class="col-md-6">
    <label for="employeeDocument" class="form-label">Subir Documento en PDF:</label>
    <input type="file" class="form-control" id="employeeDocument" name="employeeDocument" accept="application/pdf" onchange="previewDocument(event)">
    
    <?php if (isset($doctos) && !empty($doctos)): ?>
        <!-- Mostrar enlace para descargar el PDF existente -->
        <p style="color:gray">Documento Actual:
        <br><?php echo $doctos; ?></p>
        <a href="<?php echo $doctos; ?>" target="_blank">Ver Documento PDF</a>
    <?php endif; ?>
</div>

<!-- Opcional: Vista previa del documento PDF cargado -->
<div id="documentPreview" class="col-md-6" style="margin-top: 15px;">
    <!-- Aquí se insertará la vista previa del PDF -->
</div>
                                
                            </div>

                        <!-- Botones al final del último tab -->
                        <div class="row mb-3">
                            <div class="col-md-12" style="text-align: right;">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                               <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
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
</body>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>


<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->
<script>
function PasarValor()
{
document.getElementById("inputSaldoAdeudo").value = parseFloat(document.getElementById("inputDeuda").value) + parseFloat(document.getElementById("inputAdeudo").value);
}
</script>

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
            location.href = 'empleados.php';
        }
    });

   

    });
    </script>

<script>
    $(document).ready(function () {
        $("#employeeNumber").on('change', function () {            
            var op = $(this).val();
             var action = 'searchDatosEmpleado';

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
                    $('#employeeName').val('');
                    $('#employeeTipo').val('');
                    //$('#fcondicion').val('');
                    //$('#txt_acabado').val('-');
                    //$('#txt_orilla').val('NO');
                    //$('#txt_engomado').val('NO');
                    //$('#rfc_cliente').val('');
                    
                    //Mostar boton agregar
                    //$('.btn_new_cliente').slideDown();
                }else{
                    var data = $.parseJSON(response);
                    $('#employeeName').val(data.name_empleado).change(); // Notify only Select2 of changes
                    $('#employeeTipo').val(data.tipocontrato);
                    //$('#fcondicion').val(data.termino);
                    //$('#rfc_cliente').val(data.rfc);
                   
                }
            },
            error: function(error) {

            }

        });
        });
    });
</script>
<script src="js/sweetalert2.all.min.js"></script>   
<!-- Page specific script -->


<script>
$(document).ready(function(){
     $('#inputInicoc').blur(function(){ 

     m1 = document.getElementById("inputTipoContrato").value; 
     
    

    if (m1 == "Eventual") {
      
      

      
      var dat1 = document.getElementById('inputInicoc').value;
      var date = Date.parse(dat1);
      var oneDay = 720*60*60*1000;   // hours*minutes*seconds*milliseconds
      var menosDay = 24*60*60*1000;
      var diffDays = date + oneDay;

      var datetime = diffDays; // anything
      var date2 = new Date(datetime);
      var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      var result = date2.toLocaleDateString( date2.getTimezoneOffset(), options );
      var fecha_iso = result.replace(/\//g, '-').split('-').reverse().join('-');

      //alert(result);
    
      document.getElementById("inputVence").value = fecha_iso;
       

    }
         
     });
 });
</script>
<!--
<script>
$(document).ready(function(){
     $('#inputTipoContrato').change(function(){ 

     m1 = document.getElementById("inputTipoContrato").value; 

    if (m1 == "Eventual") {
      //alert('Eventual');

      document.getElementById('modalPeriodo').style.visibility = 'visible';
       

      /*
      var dat1 = document.getElementById('inputInicoc').value;
      var date = Date.parse(dat1);
      var oneDay = 720*60*60*1000;   // hours*minutes*seconds*milliseconds
      var menosDay = 24*60*60*1000;
      var diffDays = date + oneDay;

      var datetime = diffDays; // anything
      var date2 = new Date(datetime);
      var options = { year: 'numeric', month: '2-digit', day: '2-digit' };
      var result = date2.toLocaleDateString( date2.getTimezoneOffset(), options );
      var fecha_iso = result.replace(/\//g, '-').split('-').reverse().join('-');

      //alert(result);
    
      document.getElementById("inputVence").value = fecha_iso;
      */  
    }else {
      document.getElementById('modalPeriodo').style.visibility = 'hidden';
     
    }
         
     });
 });
</script>
-->

<script> 
  $(document).ready(function (e) {
  $('#modalEditcliente').on('show.bs.modal', function(e) { 

    var noemp = document.getElementById("inputNoempleado").value
    var valor = document.getElementById("inputInicoc").value
    
      $(e.currentTarget).find('#form_pass_noempleado').val(noemp);
      $(e.currentTarget).find('#form_pass_finicio').val(valor);
     
      
  });
});
</script>


  

<script>
   
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
})
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

<script>

   
        // Función para mostrar vista previa de la foto del empleado
        function previewPhoto(event) {
            const reader = new FileReader();
            const photoPreview = document.getElementById('photoPreview');
            const removeBtn = document.querySelector('.remove-photo-btn');

            reader.onload = function () {
                photoPreview.src = reader.result;
                photoPreview.style.display = 'block';  // Mostrar la imagen
                removeBtn.style.display = 'block';  // Mostrar el botón de remover
            };

            reader.readAsDataURL(event.target.files[0]);
        }

        // Función para remover la foto seleccionada
        function removePhoto() {
            const photoPreview = document.getElementById('photoPreview');
            const removeBtn = document.querySelector('.remove-photo-btn');
            const inputFile = document.getElementById('employeePhoto');

            photoPreview.src = '#';
            photoPreview.style.display = 'none';  // Ocultar la imagen
            removeBtn.style.display = 'none';  // Ocultar el botón de remover
            inputFile.value = '';  // Limpiar el valor del input de archivo
        }
    </script> 

<script>
    function previewDocument(event) {
        var output = document.getElementById('documentPreview');
        var file = event.target.files[0];
        if (file && file.type === 'application/pdf') {
            var fileURL = URL.createObjectURL(file);
            output.innerHTML = '<embed src="' + fileURL + '" width="100%" height="400px" type="application/pdf">';
        } else {
            output.innerHTML = 'No se puede mostrar la vista previa. Asegúrate de seleccionar un archivo PDF.';
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
