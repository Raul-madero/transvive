<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];

  $sqlopr   = "select nombre, rol, idusuario from usuario where rol = 8  ORDER BY nombre";
  $queryopr = mysqli_query($conection, $sqlopr);
  $filasopr = mysqli_fetch_all($queryopr, MYSQLI_ASSOC); 


  /*$sqledo = "select estado from estados ORDER BY estado";
  $queryedo = mysqli_query($conection, $sqledo);
  $filasedo = mysqli_fetch_all($queryedo, MYSQLI_ASSOC); 
  */
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
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="AdminLTE Logo"></span>
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

     <?php         
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT no_prov FROM proveedores ORDER by id DESC LIMIT 1");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["no_prov"]+1; 
          

          mysqli_close($conection);
        ?>  

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
              <li class="breadcrumb-item"><a href="proveedores.php">Proveedores</a></li>
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
                <h3 class="card-title">Alta Proveedor</h3>
              </div>
    
              <div class="card-body">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Generales</a></li>
                  <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Fiscales</a></li>
                  <li class="nav-item"><a class="nav-link" href="#archivos" data-toggle="tab">Archivos</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                   
                    <!-- /.post -->

                    <!-- Post -->
                    <div class="post clearfix">
                    <form class="form-horizontal">

                       <div class="form-group row">
                        <label for="inputEmail" class="col-sm-3 col-form-label" style="text-align: left;">No. Proveedor: *</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputNocliente" name="inputNocliente" value="<?php echo $nuevofolio; ?>" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Nombre Comercial: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputName" name="inputName" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Calle y Numero:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputCallenum" name="inputCallenum" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Colonia:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputColonia" name="inputColonia">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Ciudad:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputCiudad" name="inputCiudad" >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Municipio:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputMunicipio" name="inputMunicipio">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Estado:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="inputEstado" name="inputEstado">
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Codigo Postal:</label>
                        <div class="col-sm-3">
                          <input type="text" class="form-control" id="inputCpostal" name="inputCpostal">
                        </div>
                      </div>

                         <div class="form-group row" hidden>
                        <label for="inputName" class="col-sm-1 col-form-label" style="text-align: left;">País:</label>
                        <div class="col-sm-5">
                          <input type="text" class="form-control" id="inputPais" name="inputPais">
                        </div>
                      </div>

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Numero de Teléfono (con Lada):</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Incluir clave lada">
                        </div>
                      </div>  

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Contacto:</label>
                        <div class="col-sm-9">
                          <input type="input" class="form-control" id="inputContactorh" name="inputContactorh" >
                        </div>
                      </div>  

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Correo Electrónico:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputCorreorh" name="inputCorreorh" >
                        </div>
                      </div> 

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Número de Teléfono de Contacto:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputTelcontacto" name="inputTelcontacto" >
                        </div>
                      </div> 

                      <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Giro de la empresa:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputGiro" name="inputGiro" >
                        </div>
                      </div>  

                      <div class="form-group row" hidden>
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Tipo de Servicio:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputServicio" name="inputServicio" >
                        </div>
                      </div>  

                       <div class="form-group row">
                      <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Sitio Web:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputSitioweb" name="inputSitioweb" >
                        </div>
                      </div>
					  <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary btn_salir" id="">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                          <button type="button" class="btn btn-success guardar_Cliente" id="">Guardar</button>
                        </div>
                      </div>
                    </form>
                    </div>
                    <!-- /.post -->

                    <!-- Post -->
                  
                    <!-- /.post -->
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="timeline">
                    <!-- The timeline -->
                    <div class="post clearfix">
                    <form class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Razón Social: *</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="inputRazonsoc" name="inputRazonsoc">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">R.F.C.:</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="inputRfc" name="inputRfc" placeholder="Registro Federal de Contibuyentes">
                        </div>
                    </div>  
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Contacto Contabilidad:</label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="inputCcontabilidad" name="inputCcontabilidad" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Correo Electrónico Contabilidad:</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="inputMailc" name="inputMailc" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Credito:</label>
                        <div class="col-sm-3">
                          <select name="fCredito" id="fCredito" required class="form-control custom-select" >
                            <option value="">--  Seleccione --</option>
                            <option value="SI">SI</option>
                            <option value="NO">NO</option>
                          </select>
                        </div>
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Condiciones de Credito:</label>
                        <div class="col-sm-3">
                          <select name="fConcredito" id="fConcredito" required class="form-control custom-select" >
                            <option value="">--  Seleccione --</option>
                            <option value="7 DIAS">7 DIAS</option>
                            <option value="15 DIAS">15 DIAS</option>
                            <option value="30 DIAS">30 DIAS</option>
                          </select>
                        </div>
                    </div>

                     <div class="form-group row">
                        <label for="inputName" class="col-sm-3 col-form-label" style="text-align: left;">Limite de Credito:</label>
                        <div class="col-sm-9">
                          <input type="number" step="any" class="form-control" id="inputLimite" name="inputLimite" value="0">
                        </div>
                    </div>

                   

                    <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary btn_salir" id="">Cancelar</button>&nbsp;&nbsp;&nbsp;&nbsp;
                          <button type="button" class="btn btn-success guardar_Cliente" id="">Guardar</button>
                        </div>
                      </div>

                    
                    </form>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane" id="archivos">
                  <div class="post clearfix">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputCsf" class="col-sm-2 col-form-label" style="text-align: left;">CSF:</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="inputCsf" name="inputCsf">
                        </div>
                      </div>
                      <div class="form-group row" style="text-align:left;">
                        <label for="inputClabe" class="col-sm-2 col-form-label" style="text-align: left;">Estado de Cuenta:</label>
                        <div class="col-sm-10">
                          <input type="file" class="form-control" id="inputClabe" name="inputClabe" placeholder="Calle Empresa">
                        </div>
                      </div>
                      
                    
                      <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary btn_salir" id="">Cancelar</button>
                          <button type="submit" class="btn btn-success guardar_Cliente" id="">Guardar</button>
                        </div>
                      </div>
                      </div>

                    </form>
             
                <!-- /.tab-content -->
            
           
            <!-- /.card -->
         
          <!-- /.col -->
  
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
            location.href = 'proveedores.php';
        }
    });

   

    });
    </script>

<script>
   $('.guardar_Cliente').click(function(e) {
    e.preventDefault();

    let formData = new FormData();

    formData.append('action', 'AlmacenaProveedor');
    formData.append('noprov', $('#inputNocliente').val());
    formData.append('nameprov', $('#inputName').val());
    formData.append('callenum', $('#inputCallenum').val());
    formData.append('colonia', $('#inputColonia').val());
    formData.append('ciudad', $('#inputCiudad').val());
    formData.append('municipio', $('#inputMunicipio').val());
    formData.append('estado', $('#inputEstado').val());
    formData.append('codpostal', $('#inputCpostal').val());
    formData.append('pais', $('#inputPais').val());
    formData.append('phone', $('#inputPhone').val());
    formData.append('contacto', $('#inputContactorh').val());
    formData.append('correo', $('#inputCorreorh').val());
    formData.append('giro', $('#inputGiro').val());
    formData.append('phonecontac', $('#inputTelcontacto').val());
    formData.append('servicio', $('#inputServicio').val());
    formData.append('sitioweb', $('#inputSitioweb').val());
    formData.append('razonsoc', $('#inputRazonsoc').val());
    formData.append('rfccte', $('#inputRfc').val());
    formData.append('contactocont', $('#inputCcontabilidad').val());
    formData.append('emailconta', $('#inputMailc').val());
    formData.append('credito', $('#fCredito').val());
    formData.append('condicionesc', $('#fConcredito').val());
    formData.append('limite', $('#inputLimite').val());

    // Archivos
    const csf = $('#inputCsf')[0].files[0];
    const clabe = $('#inputClabe')[0].files[0];
    if (csf) formData.append('archivo_csf', csf);
    if (clabe) formData.append('archivo_clabe', clabe);

    $.ajax({
        url: 'includes/ajax.php',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                Swal.fire({
                    title: "¡Éxito!",
                    text: response.message,
                    icon: 'success'
                }).then(() => window.location.href = 'proveedores.php');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function(xhr, status, error) {
            console.error("Error en AJAX:", error);
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: "No se pudo completar la solicitud."
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
