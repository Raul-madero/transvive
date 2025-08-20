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

  $fechaActual = date('Y-m-d h:i:s');
  $fechaSegundos = strtotime($fechaActual);
  $anio =  date("Y", $fechaSegundos);

  $sql = 'SELECT noempleado, CONCAT_WS(" ", nombres, apellido_paterno, apellido_materno) AS nombre FROM empleados WHERE estatus = 1 ORDER BY noempleado ASC';
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query);

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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.full.min.js"></script>
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
   <section class="content">
        <div class="container-fluid">
            <h2 class="text-center">Recibos de Nomina</h2>
            <form action="enhanced-results.html">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <div class="row">
                          <div class="col-3">
                                <div class="form-group">
                                    <label>Tipo de Nomina:</label>
                                     <select class="form-control" style="width: 100%; text-align: left" id="inputTiponomina" name="inputTiponomina">
                                        <option value="">- Selecciona -</option>
                                        <option value="Semanal">Semanal</option>
                                        <option value="Quincenal">Quincenal</option>
                                        <option value="Especial">Especial</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                 <div class="form-group">
                                    <label>Periodo:</label>
                                   <select id="semana" name="semana" class="form-control select2bs4" disabled=""></select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Ejercicio:</label>
                                   <select class="form-control" style="width: 100%; text-align: left" id="inputEjercicio" name="inputEjercicio">
                                        <option value="<?php echo $anio; ?>"><?php echo $anio; ?></option>
                                        <option value="2023">2023</option>
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                        <option value="2029">2029</option>
                                        <option value="2030">2030</option>
                                        <option value="2031">2031</option>
                                        <option value="2032">2032</option>
                                        <option value="2033">2033</option>
                                        <option value="2034">2034</option>
                                        <option value="2035">2035</option>
                                        <option value="2036">2036</option>
                                        <option value="2037">2037</option>
                                        <option value="2038">2038</option>
                                        <option value="2039">2039</option>
                                        <option value="2040">2040</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
  <div class="col-6">
    <label for="empleadoSelect">Enviar solo a:</label>
    <select id="empleadoSelect" style="width:100%">
      <option value="">--Seleccione--</option>
      <?php foreach($filas as $empleado): ?>
        <option value="<?php echo $empleado['noempleado']; ?>">
          <?php echo $empleado['nombre']; ?>
        </option>
        <?php endforeach; ?>
    </select>
    <small class="text-muted">Déjalo vacío para “Todos”.</small>
  </div>
</div>
                            <!-- <div class="col-3" hidden>
                                <div class="form-group">
                                    <label>Imprimir Empleados Total = 0:</label>
                                     <select class="form-control" style="width: 100%; text-align: left" id="importeCero" name="importeCero">
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                            </div> -->
                            <!--
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Order By:</label>
                                    <select class="select2" style="width: 100%;">
                                        <option selected>Title</option>
                                        <option>Date</option>
                                    </select>
                                </div>
                            </div>
                          -->

                          <div class="col-12">
                                <div class="form-group">
                                    
                                </div>
                            </div>

                         
                      <div class="col-3">
                      <a href="#" onclick="
                        let empleado = document.getElementById('empleadoSelect').value;
                        let url = 'factura/recibo_nomina.php?id=' + document.getElementById('inputTiponomina').value +
                                  '&id2=' + document.getElementById('semana').value +
                                  '&id3=' + document.getElementById('inputEjercicio').value;
                        if (empleado) { // si seleccionó alguien, se añade
                          url += '&noempleado=' + empleado;
                        }
                        window.open(url);
                      ">
                        <button type="button" class="btn btn-success pull-left"><i class="fa fa-share"></i> Enviar</button>
                      </a>

                      <a href="#" onclick="window.open ('factura/recibo_nomina.php?id='+ document.getElementById('inputTiponomina').value + '&id2='+document.getElementById('semana').value + '&id3='+document.getElementById('inputEjercicio').value + '&mostrar=1' );" >  
                       
                          <button type ="button" class="btn btn-primary pull-left"><i class="fa fa-eye"></i> Mostrar</button>
                        </a>
                      </div>
                    <div class="col-3">
                      <a href="#" onclick="window.location ='nominas.php';" >
                        <button type ="button" class="btn btn-secondary pull-left" href="#"><i class="fa fa-stop"></i> Cancelar</button>
                    </div>

                    </div>

                    </div>
                </div>
            </form>
        </div>
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
            location.href = 'clientes.php';
        }
    });

   

    });
    </script>

<script>
   $('#guardar_cliente').click(function(e){
        e.preventDefault();

       var namecte      = $('#inputName').val();
       var emailcte     = $('#inputEmail').val();
       var telefonocte  = $('#inputTelefono').val();
       var rfccte       = $('#inputRfc').val();
       var sitiocte     = $('#inputSitio').val();
       var namecontac   = $('#inputNameContacto').val();
       var titulocontac = $('#inputTitulo').val();
       var puestocontac = $('#inputPuesto').val();
       var emailcontac  = $('#inputEmailContacto').val();
       var movilcontac  = $('#inputMovil').val();
       var callecte     = $('#inputCalle').val();
       var estadocte    = $('#inputEstado').val();
       var ciudadcte    = $('#inputCiudad').val();
       var cpostalcte   = $('#inputCpostal').val();
       var paiscte      = $('#inputPais').val();

       var action       = 'AlmacenaCliente';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, namecte:namecte, emailcte:emailcte, telefonocte:telefonocte,
                          rfccte:rfccte, sitiocte:sitiocte, namecontac:namecontac, titulocontac:titulocontac,
                          puestocontac:puestocontac, emailcontac:emailcontac, movilcontac:movilcontac,
                          callecte:callecte, estadocte:estadocte, ciudadcte:ciudadcte, cpostalcte:cpostalcte,
                          paiscte:paiscte},

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
                          text: "Cliente ALMACENADO CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'clientes.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'clientes.php';
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

  })
</script> 

<script type="text/javascript">
      $(document).ready(function(){
          
         var pedidos3 = $('#semana');
        //Ejecutar accion al cambiar de opcion en el select de las bandas
        $('#inputTiponomina').change(function(){
          var banda_id3 = $(this).val(); //obtener el id seleccionado

          if(banda_id3 !== ''){ //verificar haber seleccionado una opcion valida

            /*Inicio de llamada ajax*/
            $.ajax({
              data: {banda_id3:banda_id3}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: 'data/get_enviossem.php' //url que recibe las variables
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
