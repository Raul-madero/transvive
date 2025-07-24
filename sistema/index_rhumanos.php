<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $idemp = $_SESSION['idUser'];
  $rol=$_SESSION['rol'];
  if($rol != 5) {
      $rolRedirects = [
        "Administrador" => "index.php",
        "Conductor" => "index_conductor.php",
        "Supervisor" => "index_supervisor.php",
        "Recursos Humanos" => "index_rhumanos.php",
        "Operaciones" => "index_operaciones.php",
        "Operador" => "index_operador.php",
        "Mantenimiento" => "index_mantto.php",
        "Jefe Operaciones" => "index_jefeoperaciones.php",
        "Gerencia" => "index_gerencia.php",
        "Almacen" => "index_almacen.php",
        "Calidad" => "index_calidad.php",
        "Monitorista" => "index_monitorista.php",
        "Compras" => "index_compras.php",
        "Ventas" => "index_ventas.php"
      ];
    
      if (isset($rolRedirects[$_SESSION['rol_name']])) {
        header('location: ' . $rolRedirects[$_SESSION['rol_name']]);
      } else {
        header('location: sistema/');
      }
    }
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  date_default_timezone_set('America/Mazatlan');
         $fcha = date("Y-m-d");

 $sql_delete1 = mysqli_query($conection, "TRUNCATE contratos_temp");

 $sql_insert1 = mysqli_query($conection, "INSERT INTO contratos_temp(noempleado,fecha_ini,fecha_fin) SELECT no_empleado, fecha_inicial, fecha_final FROM detalle_contratos WHERE id IN (SELECT MAX(id) FROM detalle_contratos GROUP BY no_empleado) ORDER BY id DESC");
 mysqli_close($conection);


include "../conexion.php";
 $sql20= mysqli_query($conection,"SELECT ct.noempleado, CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', apellido_materno) as empleado, ct.fecha_fin  FROM contratos_temp ct INNER JOIN empleados em ON ct.noempleado = em.noempleado where date_add(ct.fecha_fin, INTERVAL 10 DAY) <= '$fcha' and em.tipo_contrato = 'Eventual' and em.estatus = 1 ");
  mysqli_close($conection);
  $result_sql20 = mysqli_num_rows($sql20);


  // Verificación del resultado de la consulta
if ($result_sql20 > 0) {
    while ($fila = mysqli_fetch_assoc($sql20)) {
   
    $namecliente = $fila ['noempleado']. ' '. $fila['empleado'];  
    //$fcha = date("d-m-Y",  $fila['fecha_vencimiento'] );
    $newDate3 = date("d/m/Y", strtotime($fila['fecha_fin']));
       
  ?>  
   
     <script>

     // alert('\t Contratos Eventuales Vencidos y/o Prontos a Vencer. \t \n\t \u00A0 \n\t Empleado: <?php echo $namecliente; ?> \n\t Fecha de vencimiento: <?php echo $newDate3; ?> ')

    </script>
  
    <?php 
    }  

    }else {
     ?>  
  
 
     <script>

     //* alert('\t No Hay contratos por vencer o vencidos')

    </script>
<?php 
    }

    include "../conexion.php";
 $sql33= mysqli_query($conection,"SELECT em.noempleado, CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', apellido_materno) as empleado, em.fecha_vencimiento  FROM empleados em where date_add(em.fecha_vencimiento, INTERVAL 10 DAY) <= '$fcha' and em.estatus = 1 ");
  mysqli_close($conection);
  $result_sql33 = mysqli_num_rows($sql33);


  // Verificación del resultado de la consulta
if ($result_sql33 > 0) {
    while ($fila3 = mysqli_fetch_assoc($sql33)) {
   
    $namecliente =  $fila3['noempleado']. ' '. $fila3['empleado']; 
    //$fcha = date("d-m-Y",  $fila['fecha_vencimiento'] );
    $newDate30 = date("d/m/Y", strtotime($fila3['fecha_vencimiento']));
       
  ?>  
   
     <script>

     // alert('\t Licencias Vencidas y/o Prontas a Vencer. \t \n\t \u00A0 \n\t Empleado: <?php echo $namecliente; ?> \n\t Fecha de vencimiento: <?php echo $newDate30; ?> ')

    </script>
  
    <?php 
    }  
   }
    
     ?>  
  
 
    
<?php
  
  include "../conexion.php";

  $sql10= mysqli_query($conection,"SELECT COUNT(*) as numero FROM empleados");
  mysqli_close($conection);
  $result_sql10 = mysqli_num_rows($sql10);

  if($result_sql10 == 0){
    $cantidad_pedidos = 0;
   
  }else{
    
    $data = mysqli_fetch_array($sql10);
   
  }
   $cantidad_pedidos = $data['numero'];

  include "../conexion.php";
  $sql11= mysqli_query($conection,"SELECT COUNT(*) as numeros FROM empleados where cargo = 'SUPERVISOR'");
  mysqli_close($conection);
  $result_sql11 = mysqli_num_rows($sql11);

  if($result_sql11 == 0){
    $cantidad_superv = 0;
   
  }else{
    
    $data = mysqli_fetch_array($sql11);
   
  }
   $cantidad_superv = $data['numeros']; 

  include "../conexion.php";
  $sql12= mysqli_query($conection,"SELECT COUNT(*) as numerosem FROM nomina");
  mysqli_close($conection);
  $result_sql12 = mysqli_num_rows($sql12);

  if($result_sql12 == 0){
    $cantidad_nomsem = 0;
   
  }else{
    
    $data = mysqli_fetch_array($sql12);
   
  }
   $cantidad_nomsem = $data['numerosem']; 

  include "../conexion.php";
  $sql13= mysqli_query($conection,"SELECT COUNT(*) as numeroqun FROM nomina_quincenal");
  mysqli_close($conection);
  $result_sql13 = mysqli_num_rows($sql13);

  if($result_sql13 == 0){
    $cantidad_nomqun = 0;
   
  }else{
    
    $data = mysqli_fetch_array($sql13);
   
  }
   $cantidad_nomqun = $data['numeroqun']; 


   include "../conexion.php";

  $sqlenc= mysqli_query($conection,"SELECT SUM(tiempo_forma)/COUNT(tiempo_forma) as Timeforma, SUM(tiempo_respuesta)/COUNT(tiempo_respuesta) as Timerespuesta, SUM(disponibilidad)/COUNT(disponibilidad) as Disponibilidad, SUM(calidad)/COUNT(calidad) as Calidad, SUM(asesoria_tecnica)/COUNT(asesoria_tecnica) as Asesoriatecnica, SUM(limpieza_condicion)/COUNT(limpieza_condicion) as Limpieza, SUM(servicio_operador)/COUNT(servicio_operador) as Servicio, SUM(conduce_adecuado)/COUNT(conduce_adecuado) as Conduce, SUM(atencion_calidad)/COUNT(atencion_calidad) as Atencion, SUM(servicio_facturacion)/COUNT(servicio_facturacion) as Facturacion, SUM(nuestros_precios)/COUNT(nuestros_precios) as Precios, count(*) as Numeroreg FROM encuesta_clientes");
  mysqli_close($conection);
  $result_sqlenc = mysqli_num_rows($sqlenc);

  if($result_sqlenc == 0){
    $resp1 = 0;
    $resp2 = 0;
    $resp3 = 0;
    $resp4 = 0;
    $resp5 = 0;
    $resp6 = 0;
    $resp7 = 0;
    $resp8 = 0;
    $resp9 = 0;
    $resp10 = 0;
    $resp11 = 0;
    $resp12 = 0;

   
  }else{
    
    $dataenc = mysqli_fetch_array($sqlenc);
    $resp1 = $dataenc['Timeforma']; 
    $resp2 = $dataenc['Timerespuesta']; 
    $resp3 = $dataenc['Disponibilidad']; 
    $resp4 = $dataenc['Calidad']; 
    $resp5 = $dataenc['Asesoriatecnica']; 
    $resp6 = $dataenc['Limpieza'];
    $resp7 = $dataenc['Servicio'];
    $resp8 = $dataenc['Conduce'];
    $resp9 = $dataenc['Atencion'];
    $resp10 = $dataenc['Facturacion'];
    $resp11 = $dataenc['Precios'];
    $resp12 = $dataenc['Numeroreg'];
     
  }

  include "../conexion.php";
  $sqledad= mysqli_query($conection,"UPDATE empleados SET edad =  TIMESTAMPDIFF(YEAR,date_nacimiento,CURDATE()) where edad >0");
  mysqli_close($conection);

?>  
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
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
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="./local/apis.css">

  <script type="text/javascript" src="./local/jquery.min.js"></script>
  <!--<script type="text/javascript" src="./js/jquery-3.4.1.min.js"></script>-->
  <script src="./local/highcharts.js"></script>
  <script src="./local/Chart.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/6.0.0/bootbox.js"></script>
  <link rel="stylesheet" href="./alertifyjs/css/alertify.min.css">
  <link rel="stylesheet" href="./alertifyjs/css/themes/default.min.css">
  <script src="./alertifyjs/alertify.min.js"></script>

  


 
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
  <div class="container">
      <a href="./salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/transvive.png" width="150" height="50" alt="Transvive Logo"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <?php include('includes/navbarrhuman.php') ?>
      <?php include('includes/nav.php') ?>
     
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  
          <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $cantidad_pedidos; ?></h3>

                <p>Empleados</p>
              </div>
              <div class="icon">
                <i class="ion-person-stalker"></i>
              </div>
              <a href="empleados.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $cantidad_superv; ?><sup style="font-size: 20px"></sup></h3>

                <p>Supervisores</p>
              </div>
              <div class="icon">
                <i class="ion-person-stalker"></i>
              </div>
              <a href="supervisores.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $cantidad_nomsem; ?></h3>

                <p>Nomina Semanal</p>
              </div>
              <div class="icon">
                <i class="ion-calculator"></i>
              </div>
              <a href="nominas.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $cantidad_nomqun; ?></h3>

                <p>Nomina Quincenal</p>
              </div>
              <div class="icon">
                <i class="ion-calculator"></i>
              </div>
              <a href="#" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Ambiente Laboral
                </h3>
                
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="position-relative mb-4">
                  <canvas id="myChart" height="100"></canvas>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!--/.direct-chat -->

    
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
         
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include('includes/footer.php') ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<script>
$(document).ready(function() {
  $('#registrarBtn').click(function() {  
 if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
} else {
  alert('La geolocalización no está disponible en este navegador');
}

function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;

  // Enviar la ubicación al servidor mediante AJAX
  $.ajax({
    type: 'POST',
    url: 'registro.php',
    data: {lat: lat, lon: lon},
    success: function(data) {
      alert('Registro exitoso');
    },
    error: function() {
      alert('Error al registrar');
    }
  });
}
});
});
</script>

<script>
$(document).ready(function() {
  $('#registrarBtnSal').click(function() {  
 if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
} else {
  alert('La geolocalización no está disponible en este navegador');
}

function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;

  // Enviar la ubicación al servidor mediante AJAX
  $.ajax({
    type: 'POST',
    url: 'registrosal.php',
    data: {lat: lat, lon: lon},
    success: function(data) {
      alert('Registro exitoso');
    },
    error: function() {
      alert('Error al registrar');
    }
  });
}
});
});
</script>

<script>
  document.getElementById('miEnlace').onclick = function() {
  miFuncion(); // Llama a la función aquí
};
function miFuncion() {
 
        navigator.geolocation.getCurrentPosition(
    function(position) {
         alert("Lat: " + position.coords.latitude + "\nLon: " + position.coords.longitude);
    },
    function(error){
         alert(error.message);
    }, {
         enableHighAccuracy: true
              ,timeout : 5000
    });

  function showPosition(position) {
  var lat = position.coords.latitude;
  var lon = position.coords.longitude;

  // Enviar la ubicación al servidor mediante AJAX
  $.ajax({
    type: 'POST',
    url: 'registrosal.php',
    data: {lat: lat, lon: lon},
    success: function(data) {
      alert('Registro exitoso');
    },
    error: function() {
      alert('Error al registrar');
    }
  });
}
}
    


</script>

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>

<!-- DataTables JS library -->
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<!-- DataTables JBootstrap -->
<script type="text/javascript" src="//cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<script src="../plugins/chart.js/Chart.min.js"></script>
<!-- <script src="../dist/js/pages/dashboard3.js"></script>-->
<!-- AdminLTE App -->
<!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

<script src="js/sweetalert2.all.min.js"></script>  
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script>
    // setup 
    const data = {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
      datasets: [{
        label: 'Weekly Sales',
        data: [18, 12, 6, 9, 12, 3, 9],
        backgroundColor: [
          'rgba(255, 26, 104, 0.2)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)',
          'rgba(153, 102, 255, 0.2)',
          'rgba(255, 159, 64, 0.2)',
          'rgba(0, 0, 0, 0.2)'
        ],
        borderColor: [
          'rgba(255, 26, 104, 1)',
          'rgba(54, 162, 235, 1)',
          'rgba(255, 206, 86, 1)',
          'rgba(75, 192, 192, 1)',
          'rgba(153, 102, 255, 1)',
          'rgba(255, 159, 64, 1)',
          'rgba(0, 0, 0, 1)'
        ],
        borderWidth: 1
      }]
    };

    // config 
    const config = {
      type: 'bar',
      data,
      options: {
        indexAxis: 'y',
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    };

    // render init block
    const myChart = new Chart(
      document.getElementById('myChart'),
      config
    );

    // Instantly assign Chart.js version
    const chartVersion = document.getElementById('chartVersion');
    chartVersion.innerText = Chart.version;
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
