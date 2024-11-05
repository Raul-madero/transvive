<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $fechaActual = date('Y-m-d h:i:s');
  $fechaSegundos = strtotime($fechaActual);
  $anio =  date("Y", $fechaSegundos);

  $sqlact= mysqli_query($conection,"SELECT YEAR(dia_inicial) as anioactual FROM semanas limit 1");
  mysqli_close($conection);
  $result_sqlact = mysqli_num_rows($sqlact);

    while ($data = mysqli_fetch_array($sqlact)){
      $yearact  = $data['anioactual'];
         
    }

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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    

       

        /* Estilo del botón al estilo SAP Fiori */
        .sap-fiori-btn {
            background-color: #0a6ed1; /* Azul Fiori */
            color: white;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .sap-fiori-btn:hover {
            background-color: #085a9c; /* Azul más oscuro al hacer hover */
            transform: scale(1.05); /* Pequeño zoom al hacer hover */
        }

        .sap-fiori-btn:active {
            background-color: #084a82; /* Azul aún más oscuro cuando se presiona */
            transform: scale(1.02); /* Pequeña reducción al hacer clic */
        }

        /* Opcional: Estilo del enlace para descargar el respaldo */
        a {
            color: #0a6ed1;
            text-decoration: none;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        #progress {
            display: none;
            width: 60%;
            background-color: #f3f3f3;
            border: 1px solid #ccc;
            margin-top: 20px;
        }
        #progress-bar {
            width: 0%;
            height: 30px;
            background-color: #4caf50;
            text-align: center;
            line-height: 30px;
            color: white;
        }
        #message {
            margin-top: 20px;
        }

        .btn-close {
        background-color: #dc3545; /* Color rojo (puedes cambiarlo) */
        color: white; /* Texto en blanco */
    }

    .btn-close:hover {
        background-color: #c82333; /* Color rojo oscuro al pasar el mouse */
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
            include('includes/navbar.php');
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
    <section class="content">
        <center>
            <div class="container-fluid">
                <h2 class="text-center">Respaldo de Base de Datos</h2>
                <form method="POST" action="backup_local.php" id="backupForm">
                    <button type="submit" class="sap-fiori-btn" name="backup">Respaldo</button>
                    <button type="button" class="sap-fiori-btn btn-close" onclick="location.href='index.php'" style="margin-left: 10px;">Cerrar</button>
                </form>

                <!-- Barra de progreso (oculta por defecto) -->
                <div id="progressContainer" style="display:none; margin-top: 20px;">
                    <h4>Generando Respaldo...</h4>
                    <div class="progress">
                        <div class="progress-bar" id="progressBar" style="width:0%">0%</div>
                    </div>
                </div>
            </div>
        </center>
    </section>
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



<script src="js/sweetalert2.all.min.js"></script>   
<!-- Page specific script -->



   <script>
    const form = document.getElementById('backupForm');
    const progressContainer = document.getElementById('progressContainer');
    const progressBar = document.getElementById('progressBar');

    form.addEventListener('submit', function(event) {
        // Mostrar la barra de progreso
        progressContainer.style.display = 'block';
        let progress = 0;

        // Simular progreso mientras se genera el respaldo (esto es una simulación)
        const interval = setInterval(function() {
            progress += 10;
            progressBar.style.width = progress + '%';
            progressBar.textContent = progress + '%';

            if (progress >= 100) {
                clearInterval(interval);
            }
        }, 500); // Aumenta el progreso cada 500ms
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
