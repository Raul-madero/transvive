<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqlopr   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as empleado from empleados where estatus = 1 ORDER BY apellido_paterno";
  $queryopr = mysqli_query($conection, $sqlopr);
  $filasopr = mysqli_fetch_all($queryopr, MYSQLI_ASSOC); 

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

      <?php include ('includes/generalnavbar.php') ?>
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
              <li class="breadcrumb-item"><a href="incidencias.php">Incidencias</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

     <!-- Horizontal Form -->

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Registro de Incidencia</h3>
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo de Incidencia:</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputIncidencia" name="inputIncidencia">
                       <option value="">- Seleccione -</option>
                       <option value="Falta Injustificada">Falta Injustificada</option>
                       <option value="Falta Justificada">Falta Justificada</option>
                       <option value="Vacaciones">Vacaciones</option>
                       <option value="Incapacidades">Incapacidades</option>
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Empleado:</label>
                    <div class="col-sm-10">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputEmpleado" name="inputEmpleado">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasopr as $opem): //llenar las opciones del primer select ?>
                       <option value="<?= $opem['empleado'] ?>"><?= $opem['empleado'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left; display: none;" id="diasvacaciones">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">D. por Antiguedad:</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="inputDiasderecho" name="inputDiasderecho" value="0" readonly >
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">D. Restantes:</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="inputDiastomar" name="inputDiastomar" value="0" readonly>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">D. Tomados:</label>
                    <div class="col-sm-2">
                      <input type="number" class="form-control" id="inputDiaspendientes" name="inputDiaspendientes" value="0" readonly>
                    </div>
                   
                  </div>





                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Inicial:</label>
                    <div class="col-sm-2">
                      <input type="date" class="form-control" id="inputFechaini" name="inputFechaini" onchange="myFunctionDate()">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Final:</label>
                    <div class="col-sm-2">
                      <input type="date" class="form-control" id="inputFechafin" name="inputFechafin" onchange="myFunctionDateTwo()">
                    </div>
                    <label for="txt_diasvac" class="col-sm-2 col-form-label">Dias:</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" id="txt_diasvac" name="txt_diasvac">  
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones:</label>
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
<!-- SweetAlert2 -->
 <script src="js/sweetalert2.all.min.js"></script> 

<script>
// =====================
// Utilidades de fechas
// =====================
function parseLocalDate(yyyy_mm_dd) {
  // Evita desfases por zona horaria
  return new Date(yyyy_mm_dd + 'T00:00:00');
}

function normalizeRange() {
  const $ini = $('#inputFechaini');
  const $fin = $('#inputFechafin');

  const vIni = $ini.val();
  const vFin = $fin.val();

  if (!vIni && !vFin) return;

  // Si no hay fin, igualarlo a inicio
  if (vIni && !vFin) {
    $fin.val(vIni);
    return;
  }

  // Si no hay inicio pero hay fin, igualarlo a fin (opcional)
  if (!vIni && vFin) {
    $('#inputFechaini').val(vFin);
    return;
  }

  // Si ambos existen, asegurar inicio <= fin
  const dIni = parseLocalDate(vIni);
  const dFin = parseLocalDate(vFin);

  if (dFin < dIni) {
    $fin.val(vIni);
  }
}

function recalcDays() {
  const out = $('#txt_diasvac');
  const vIni = $('#inputFechaini').val();
  const vFin = $('#inputFechafin').val();

  if (!vIni || !vFin) { out.val(''); return; }

  const dIni = parseLocalDate(vIni);
  const dFin = parseLocalDate(vFin);

  if (isNaN(dIni) || isNaN(dFin) || dFin < dIni) { out.val(''); return; }

  // Todos los días incluyendo ambos extremos (sin excluir fines de semana)
  const totalDias = Math.round((dFin - dIni) / (1000 * 60 * 60 * 24)) + 1;
  out.val(totalDias);
}
</script>

<script>
// =====================
// Eventos de fechas
// =====================
$(document).ready(function () {
  // Cada vez que cambie inicio/fin, normalizamos y recalculamos
  $('#inputFechaini, #inputFechafin').on('change', function () {
    normalizeRange();
    recalcDays();
  });

  // Si usabas llamadas inline a estas funciones, las dejamos como "wrappers"
  window.myFunctionDate = function () {
    normalizeRange();
    recalcDays();
  };
  window.myFunctionDateTwo = function () {
    normalizeRange();
    recalcDays();
  };
});
</script>

<script>
// =====================
// Botón salir (SweetAlert2)
// =====================
$(document).ready(function () {
  $('#btn_salir').on('click', function (e) {
    e.preventDefault();

    Swal.fire({
      title: 'DESEA SALIR!',
      text: '',
      icon: 'info',
      showCancelButton: true,
      confirmButtonText: 'Regresar',
      cancelButtonText: 'Salir'
    }).then((resultado) => {
      if (resultado.value) {
        console.log('Alerta cerrada');
      } else {
        location.href = 'incidencias.php';
      }
    });
  });
});
</script>

<script>
// =====================
// Guardar incidencia (AJAX)
// =====================
$(document).ready(function () {
  $('#guardar_tipoactividad').on('click', function (e) {
    e.preventDefault();

    const tincidencia  = $('#inputIncidencia').val();
    const empleado     = $('#inputEmpleado').val();
    const diasderecho  = $('#inputDiasderecho').val();
    const diastomar    = $('#inputDiastomar').val();
    const fechaini     = $('#inputFechaini').val();
    const fechafin     = $('#inputFechafin').val();
    const diasvac      = $('#txt_diasvac').val();
    const notas        = $('#inputNotas').val();
    const action       = 'AlmacenaIncidencia';

    // Validaciones mínimas en cliente
    if (!tincidencia || !empleado || !fechaini || !fechafin || !diasvac) {
      Swal.fire({ icon: 'info', title: '', text: 'Capture los datos requeridos' });
      return;
    }

    $.ajax({
      url: 'includes/ajax.php',
      type: 'POST',
      data: {
        action, tincidencia, empleado,
        diastomar, diasderecho, fechaini, fechafin, diasvac, notas
      },
      success: function (response) {
        if (response === 'error') {
          Swal.fire({ icon: 'info', title: '', text: 'Capture los datos requeridos' });
          return;
        }

        let info;
        try {
          info = JSON.parse(response);
        } catch (e) {
          // Si el backend devuelve algo que no es JSON, aún tratamos el caso como éxito
          info = {};
        }

        const mensaje = info?.mensaje;
        if (mensaje === undefined) {
          Swal.fire({
            title: 'Éxito!',
            text: 'INCIDENCIA ALMACENADA CORRECTAMENTE',
            icon: 'success'
          }).then((resultado) => {
            if (resultado.value) {
              location.href = 'incidencias.php';
            } else {
              location.reload();
            }
          });
        } else {
          Swal.fire({ icon: 'error', title: 'Oops...', text: mensaje });
        }
      },
      error: function () {
        Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo procesar la solicitud.' });
      }
    });
  });
});
</script>

<script>
// =====================
// Carga de datos por empleado
// =====================
$(document).ready(function () {
  $('#inputEmpleado').on('change', function () {
    const op = $(this).val();
    const tipoincidencia = $('#inputIncidencia').val();

    // Mostrar/ocultar bloque de vacaciones
    if (tipoincidencia === 'Vacaciones') {
      document.getElementById('diasvacaciones').style.display = '';
    } else {
      document.getElementById('diasvacaciones').style.display = 'none';
    }

    $.ajax({
      url: 'includes/ajax.php',
      type: 'POST',
      data: { action: 'searchDiasvacac', op, tipoincidencia },
      success: function (response) {
        if (response == 0) {
          $('#inputDiasderecho').val('0');
          $('#inputDiastomar').val('0');
          $('#inputDiaspendientes').val('0');
        } else {
          let data;
          try {
            data = $.parseJSON(response);
          } catch (e) {
            data = null;
          }
          if (data) {
            $('#inputDiasderecho').val(data.tomardias ?? '0');
            $('#inputDiastomar').val(data.diastomados ?? '0');
            $('#inputDiaspendientes').val(data.pendientes ?? '0');
          }
        }
      }
    });
  });
});
</script>

<script>
  // ==================
  // Inicializacion de select2
  // ==================
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })
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
