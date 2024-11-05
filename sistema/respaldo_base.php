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
       <form id="backupForm" method="post">
       
        <button type="submit" class="sap-fiori-btn" name="backup">Realizar Respaldo</button>
    </form>

    <!-- Barra de progreso -->
    <div id="progress">
        <div id="progress-bar">0%</div>
    </div>

    <!-- Mensaje de estado -->
    <div id="message"></div>
    </div>
  </center>
    </section>
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



<script src="js/sweetalert2.all.min.js"></script>   
<!-- Page specific script -->



    <script>
        document.getElementById('backupForm').addEventListener('submit', function(e) {
            e.preventDefault();

             // Mostrar la barra de progreso
    document.getElementById('progress').style.display = 'block';
    let progressBar = document.getElementById('progress-bar');
    progressBar.style.width = '0%';
    progressBar.innerText = '0%';

    // Simular la carga (aquí es donde se haría la llamada AJAX)
    let interval = setInterval(function() {
        let width = parseInt(progressBar.style.width);
        if (width < 100) {
            progressBar.style.width = (width + 10) + '%';
            progressBar.innerText = (width + 10) + '%';
        }
    }, 500); // Incrementa el progreso cada 0.5 segundos

    // Hacer la llamada AJAX para iniciar el respaldo

            fetch('backup.php', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => response.json())  // Procesar respuesta como JSON
            .then(data => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: 'Respaldo Completado',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = 'index.php'; // Redirigir al usuario
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: data.message,
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema con la solicitud.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
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
