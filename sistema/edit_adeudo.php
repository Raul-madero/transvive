<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  if (empty($_REQUEST['id'])) {
    header('Location: empleados.php');
    mysqli_close($conection);
  }

  $noempleado = $_REQUEST['id'];

  $sqlemp = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name, noempleado, id from empleados ORDER BY noempleado";
  $queryemp = mysqli_query($conection, $sqlemp);
  $filasemp = mysqli_fetch_all($queryemp, MYSQLI_ASSOC); 

  $sqlmot   = "select * from motivo_adeudo ORDER BY motivo_adeudo";
  $querymot = mysqli_query($conection, $sqlmot);
  $filasmot = mysqli_fetch_all($querymot, MYSQLI_ASSOC);

  $sqladeudo = "SELECT * FROM adeudos WHERE noempleado = $noempleado";
  $queryadeudo = mysqli_query($conection, $sqladeudo);
  $filadeudo = mysqli_num_rows($queryadeudo);

  if ($filadeudo > 0) {
    while($data = mysqli_fetch_assoc($queryadeudo)) {
        $id = $data['id'];
        $noempleado = $data['noempleado'];
        $cantidad = $data['cantidad'];
        $motivo_adeudo = $data['motivo_adeudo'];
        $estado = $data['estado'];
        $fecha_inicial = $data['fecha_inicial'];
        $fecha_final = $data['fecha_final'];
        $total_abonado = $data['total_abonado'];
        $descuento = $data['descuento'];
        $comentarios = $data['comentarios'];
    };
  } else {
    $filadeudo = null;
  }

  
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
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
              <li class="breadcrumb-item"><a href="adeudos.php">Adeudos</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
        <center>
    <div class="col-md-9" >
    <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Nuevo Adeudo</h3>
              </div>
    
              <div class="card-body">
              <div class="card-header p-2">
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                   
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                    <form class="form-horizontal">
                                <!-- <input type="hidden" class="form-control" id="inputId" name="inputId" value="<?php echo $id; ?>">  -->
                                <div class="form-group row">
                                    <label for="inputCantidad" class="col-sm-2 col-form-label" style="text-align: left;">Cantidad de adeudo:</label>
                                    <div class="col-sm-10">
                                    <input type="number" class="form-control" id="inputCantidad" name="inputCantidad" value="<?php echo $cantidad ?>" step="0.01">
                                    </div>
                                </div>

                                <div class="form-group row" >
                                    <label for="inptEmpleado" class="col-sm-2 col-form-label" style="text-align: left;">Empleado:</label>
                                    <div class="col-sm-10" style="text-align:left;">
                                        <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputEmpleado" name="inputEmpleado">
                                            <option value="">-Selecciona-</option>
                                            <?php foreach ($filasemp as $ops): ?>
                                            <option value="<?php echo $ops['noempleado']; ?>" <?php echo ($ops['noempleado'] === $noempleado) ? 'selected' : ''; ?> readonly> <?php echo $ops['noempleado'] . ' ' . $ops['name']; ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    
                                <label for="inputMotivo" class="col-sm-2 col-form-label" style="text-align: left;">Motivo:</label>
                                    <div class="col-sm-10" style="text-align:left;">
                                        <select class="form-control select2bs4" style="width: 100%; text-align: left" id="inputMotivo" name="inputMotivo">
                                            <option value="">-Seleciona-</option>
                                            <?php foreach ($filasmot as $ops): ?>
                                            <option value="<?php echo $ops['id'] ?>" <?php echo ($ops['id'] === $motivo_adeudo) ? 'selected' : ''; ?> readonly> <?=  $ops['motivo_adeudo'] ?> </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputDescuento" class="col-sm-3 col-form-label" style="text-align: left;">Descuento Semanal:</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="inputDescuento" name="inputDescuento" step="0.01" value="<?php echo $descuento; ?>">
                                    </div>
                                    <label for="inputTotalAbonado" class="col-sm-3 col-form-label" style="text-align: left;">Total Abonado:</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" id="inputTotalAbonado" name="inputTotalAbonado" step="0.01" value="<?php echo $total_abonado; ?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="inputComentarios" class="col-sm-3 col-form-label" style="text-align: left;">Comentarios:</label>
                                    <div class="col-sm-3">
                                        <textarea class="form-control w-100" id="inputComentarios" name="inputComentarios"><?php echo $comentarios; ?></textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group row" style="text-align:right;">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>
                                        <button type="submit" class="btn btn-success" id="edit_adeudo">Guardar</button>
                                    </div>
                                </div>
                            </form>
                  </div>  
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
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
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
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
            location.href = 'adeudos.php';
        }
    });

   

    });
    </script>

<script>
  $('#edit_adeudo').click(function(e) {
    e.preventDefault(); // Previene el comportamiento por defecto del botón (submit)
    function sumarSemanas(fecha, semanas) {
    // Convertir las semanas en días (1 semana = 7 días)
    const dias = semanas * 7;
    // Crear una nueva instancia de fecha
    let nuevaFecha = new Date(fecha);
    // Sumar los días a la fecha
    nuevaFecha.setDate(nuevaFecha.getDate() + dias);
    return nuevaFecha;
}

    // Captura los valores de los inputs
    let cantidad = $('#inputCantidad').val();
    let noempleado = parseInt($('#inputEmpleado').val());
    let motivo_adeudo = $('#inputMotivo').val();
    let descuento = $('#inputDescuento').val();
    let comentarios = $('#inputComentarios').val();
    let totalAbonado = $('#inputTotalAbonado').val();
    let estado = 1; // Valor por defecto del estado

    // Generar la fecha actual en formato YYYY-MM-DD
    let fechaActual = new Date();
    let anio = fechaActual.getFullYear();
    let mes = String(fechaActual.getMonth() + 1).padStart(2, '0'); // Mes con 2 dígitos
    let dia = String(fechaActual.getDate()).padStart(2, '0'); // Día con 2 dígitos
    let fecha_inicial = `${anio}-${mes}-${dia}`;
    let semanasRestantes = Math.ceil((cantidad - totalAbonado) / descuento);
    let semanas_totales = Math.ceil(cantidad / descuento)
    let nuevaFecha = sumarSemanas(fecha_inicial, semanas_totales)
    let anioFinal = nuevaFecha.getFullYear();
    let mesFinal = String(nuevaFecha.getMonth() + 1).padStart(2, '0'); // Mes con 2 dígitos
    let diaFinal = String(nuevaFecha.getDate()).padStart(2, '0'); // Día con 2 dígitos
    let fecha_final = `${anioFinal}-${mesFinal}-${diaFinal}`;

    var action = 'EditarAdeudo';

    // Validar que los campos obligatorios no estén vacíos
    if (!cantidad || !noempleado || !motivo_adeudo) {
        Swal.fire({
            icon: 'info',
            title: 'Datos incompletos',
            text: 'Por favor, capture los datos requeridos (cantidad, empleado y motivo).'
        });
        return; // Detiene la ejecución si hay datos faltantes
    }

    // Enviar datos con AJAX
    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async: true,
        data: {
            action: action,
            noempleado: noempleado,
            motivo_adeudo: motivo_adeudo,
            estado: estado,
            fecha_inicial: fecha_inicial,
            descuento: descuento,
            comentarios: comentarios,
            cantidad: cantidad,
            semanas_totales:semanas_totales,
            fecha_final:fecha_final,
            total_abonado: totalAbonado
        },
        success: function(response) {
            console.log(response);
            if (response != 'error') {
                var info = JSON.parse(response);
                var mensaje = info.mensaje;

                // Mostrar mensaje de éxito o error según lo que retorne el servidor
                if (mensaje === "Adeudo almacenado correctamente.") {
                    Swal.fire({
                        title: "¡Éxito!",
                        text: "ADEUDO ALMACENADO CORRECTAMENTE",
                        icon: 'success'
                    }).then(resultado => {
                        if (resultado.value) {
                            location.href = 'adeudos.php'; // Redirige a la página de adeudos
                        } else {
                            location.reload();
                        }
                    });
                } else {
                    // Si el mensaje contiene un error
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: mensaje
                    });
                }
            } else {
                Swal.fire({
                    icon: 'info',
                    title: '',
                    text: 'Capture los datos requeridos',
                });
            }
        },
        error: function(error) {
            console.error('Error en la petición AJAX:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un problema al procesar la solicitud. Intente nuevamente.'
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
    });
  })
</script> 
<!-- <script>
  $(document).ready(function() {
    $('.select2bs4').select2({
        // Opciones de configuración (opcional)
        placeholder: "- Selecciona -",
        allowClear: true, 
        language: "es" // Para usar el idioma español
    });
});
</script> -->

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
