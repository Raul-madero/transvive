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


  $sqlopr   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_operador from empleados where cargo = 'Supervisor' ORDER BY apellido_paterno ";
  $queryopr = mysqli_query($conection, $sqlopr);
  $filasopr = mysqli_fetch_all($queryopr, MYSQLI_ASSOC); 
  
  $sqlusr   = "select * from usuario where rol = 4 ORDER BY nombre ";
  $queryusr = mysqli_query($conection, $sqlusr);
  $filasusr = mysqli_fetch_all($queryusr, MYSQLI_ASSOC); 


  $sqlcte = "select * from clientes where estatus = 1 ORDER BY nombre_corto";
  $querycte = mysqli_query($conection, $sqlcte);
  $filascte = mysqli_fetch_all($querycte, MYSQLI_ASSOC);

  $sqlruta   = "SELECT SUBSTRING_INDEX(no_eco,'-',-1) as no_economico FROM rutas group by no_economico order by no_economico asc";
  $queryruta = mysqli_query($conection, $sqlruta);
  $filasruta = mysqli_fetch_all($queryruta, MYSQLI_ASSOC);

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
  <style type="text/css">
    .divg {
    background-color: white;
    display: inline-flex;
    border: 1px solid #ccc;
    color: #555;
  }
  
  .inputg {
    border: none;
    color: #555;
    text-align: center;
    width: 60px;
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
      include('includes/navbar.php'); 
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
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="viajes_especiales23.php">Servicio Especiales</a></li>
              <li class="breadcrumb-item active">Nuevo</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

     <!-- Horizontal Form -->

     <?php
         date_default_timezone_set('America/Mexico_City');
         $fcha = date("Y-m-d");
     ?>  
         <?php 

         include "../conexion.php";

         $sql= mysqli_query($conection,"SELECT semana FROM semanas40 WHERE dia_inicial <= '$fcha' AND dia_final >= '$fcha'");
         mysqli_close($conection);
         $result = mysqli_num_rows($sql);
         

         while ($data = mysqli_fetch_array($sql)){
         $nosemana  = $data['semana'];
     
      
      //$user   = $_SESSION['idUser'];
      
    }
  


         ?>

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Registro de Orden de Servicio Especial/Turístico</h3>
              </div>
              <div class="card-body">
              <div class="card-header p-2">
              <!-- /.card-header --> 
              <!-- form start5 -->
              <form class="form-horizontal">
              <div class="form-group row">
                    <div class="col-sm-10">
                    </div>
                  </div>
               
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Fecha Viaje *</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="inputFechaViaje" name="inputFechaViaje" value="<?php echo $fcha;?>" onchange="cambiarEndDate()">
                    </div>
                    <!--
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align:right;">Fecha Final</label>
                    <div class="col-sm-4">
                      <input type="date" class="form-control" id="inputFechaFinal" name="inputFechaFinal" value="<?php echo $fcha;?>" onchange="cambiarEndDate()">
                    </div>-->
                  </div>
                  <!--
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Semana</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputSemana" name="inputSemana" placeholder="Descripcion de la Tarea" value="<?php echo $nosemana;?>" disabled>
                    </div>
                  </div>
                  -->
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Cliente *</label>
                    <div class="col-sm-10">
                    <select class="form-control select2bs4" style="width: 100%;" name="frazonsoc" id="frazonsoc">
                  <option value="">Select</option>
                  <?php foreach ($filascte as $opcte): //llenar las opciones del primer select ?>
                  <option value="<?= $opcte['nombre_corto'] ?>"><?= $opcte['nombre_corto'] ?></option>  
                  <?php endforeach; ?>
                </select>
                    
                    </div>
                  </div>
                <!--
                  <div class="form-group row" style="text-align:left;">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Ruta</label>
                      <div class="col-sm-10">
                       <select id="fpedido" name="fpedido" class="form-control select2bs4" disabled=""></select>
                     </div>
                  </div>
                -->
               <!--
               <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Supervisor</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%;" name="fsupervisor" id="fsupervisor">
                  <option value="">Select</option>
                  <?php foreach ($filasusr as $opusr): //llenar las opciones del primer select ?>
                  <option value="<?= $opusr['idusuario'] ?>"><?= $opusr['nombre'] ?></option>  
                  <?php endforeach; ?>
                </select>  
                    </div>
                  </div>

                -->

                  <div class="form-group row" style="text-align:left;">
                    <!--
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo Unidad</label>
                    <div class="col-sm-4">
                    <select class="form-control" style="width: 100%; text-align: left" id="inputTipo" name="inputTipo">
                       <option value="">- Seleccione -</option>
                       <option value="Camion">Camion</option>
                       <option value="Camioneta">Camioneta</option>
                       <option value="Automovil">Automovil</option>
                       <option value="Sprinter">Sprinter</option>
                       
                    </select>
                    </div>
                  -->
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo Viaje</label>
                    <div class="col-sm-4">
                     <select class="form-control" style="width: 100%; text-align: left" id="inputTipoviaje" name="inputTipoviaje">
                       <option value="Especial">Especial</option>
                       <option value="Especial Turistico">Turistico</option>
                    </select>
                    </div>

                    <label for="inputEmail3" class="col-sm-2 col-form-label" >Tipo Unidad</label>
                    <div class="col-sm-4">
                    <select class="form-control" style="width: 100%; text-align: left" id="inputTipo" name="inputTipo">
                       <option value="">- Seleccione -</option>
                       <option value="Camion">Camion</option>
                       <option value="Camioneta">Camioneta</option>
                       <option value="Automovil">Automovil</option>
                       <option value="Sprinter">Sprinter</option>
                       <option value="JAC">JAC</option>
                       <option value="Unidad Externa">Unidad Externa</option>
                      
                       
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;" hidden>
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align:left;">No. de Unidades</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inputNounidades" name="inputNounidades" value="1">
                    </div>
                        
                  </div>
                  <!--
                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">No. Unidades.</label>
                    <div class="col-sm-4">
                       <input type="number" class="form-control" id="inputNounidades" name="inputNounidades"  value="0" > 
                    </div>
                      <label for="inputEmail3" class="col-sm-2 col-form-label">No. Personas</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="inputNopersonas" name="inputNopersonas" value="0">
                    </div>
                    
                  </div>
                -->
                  <!--
                    <div class="form-group row" style="text-align:left;">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Horario</label>
                      <div class="col-sm-10">
                       <select id="fhorario" name="fhorario" class="form-control select2" multiple="multiple"   disabled=""></select>
                     </div>
               </div>

                <div class="form-group row" style="text-align:left;">
                      <label for="inputEmail3" class="col-sm-2 col-form-label">Turno</label>
                      <div class="col-sm-4">
                       <select class="form-control select2bs4" style="width: 100%;" name="inputTurno" id="inputTurno">
                  <option selected="selected">Select</option>
                  <option value="Turno 1">Turno 1</option>
                  <option value="Turno 2">Turno 2</option>
                  <option value="Turno 3">Turno 3</option>
                </select>
                     </div>

                     <label for="inputEmail3" class="col-sm-2 col-form-label">Tipo de Vuelta</label>
                      <div class="col-sm-4">
                       <select class="form-control select2bs4" style="width: 100%;" name="inputTipovta" id="inputTipovta">
                  <option value="1">Completa</option>
                  <option value="0.5">Media Vuelta</option>
                </select>
                     </div>
               </div>
             -->

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hora de Salida</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" id="inputHorainicio" name="inputHorainicio">
                    </div>
                    
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Sueldo Operador</label>
                    <div class="col-sm-4">
                      <input type="number" step="any" class="form-control" id="inputSueldovta" name="inputSueldovta" value="0">
                    </div>
                    
                  </div>

                    <!--
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Hora de Regreso</label>
                    <div class="col-sm-4">
                      <input type="time" class="form-control" id="inputHorafin" name="inputHorafin">
                    </div>
                    -->
            

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align:left;">Origen *</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputDireccion" name="inputDireccion">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Destino *</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputDestino" name="inputDestino">
                    </div>     
                  </div>


                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea type="date" rows="1" class="form-control" id="inputNotas" name="inputNotas"></textarea>  
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Teléfono de Contacto</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="inputPhonect" name="inputPhonect">  
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Costo *</label>
                    <div class="col-sm-4">
                      <input type="number" class="form-control" id="inputCosto" name="inputCosto">  
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;" hidden >
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Supervisor</label>
                    <div class="col-sm-10">
                    <input type="text" class="form-control" id="fsupervisor" name="fsupervisor">
                    
                    </div>
                  </div>

                <!-- /.card-body -->
                <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-12 col-sm-12">
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
             //*location.href = 'motivo_perdida.php';
             console.log("Alerta cerrada");
        } else {
            // Dijeron que no
            //*location.reload();
            location.href = 'viajes_especiales23.php';
        }
    });

   

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

    <script>
    $(document).ready(function () {
        $("#frazonsoc").on('change', function () {            
            var opcte = $(this).val();
             var action = 'searchClientename';

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action,opcte:opcte},
            success: function(response)
            {
                 //console.log(response);
                if(response == 0){
                    //$('#idcliente').val('');
                    $('#inputPhonect').val('');
                    $('#fsupervisor').val('');
     
                    
                    //Mostar boton agregar
                    //$('.btn_new_cliente').slideDown();
                }else{
                    var data = $.parseJSON(response);
                    //$('#idcliente').val(data.idusuario);
                    $('#inputPhonect').val(data.telefono);
                    $('#fsupervisor').val(data.id_supervisor);

                    //$('#rfc_cliente').val(data.rfc);
                   
                }
            },
            error: function(error) {

            }

        });
        });
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

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var fechaviaje   = $('#inputFechaViaje').val();
       //var fechafinal   = $('#inputFechaFinal').val();
       //var semana       = $('#inputSemana').val();
       var cliente      = $('#frazonsoc').val();
       //*var ruta         = $('#fpedido').val();
       var supervisor   = $('#fsupervisor').val();
       var tipo         = $('#inputTipo').val();
       var tipoviaje    = $('#inputTipoviaje').val();
       //var noeco        = $('#inputNounidad').val();
       var numunidades  = $('#inputNounidades').val();
       //var nopersonas   = $('#inputNopersonas').val();
       //var horarios     = $('#fhorario').val();
       //var turno        = $('#inputTurno').val();
       //var tipovuelta   = $('#inputTipovta').val();
       var horainicio   = $('#inputHorainicio').val();
       var sueldovta    = $('#inputSueldovta').val();
       var direccion    = $('#inputDireccion').val();
       //var horafin      = $('#inputHorafin').val();
       var destino      = $('#inputDestino').val();
       var notas        = $('#inputNotas').val();
       var phone_contac = $('#inputPhonect').val();
       var costo        = $('#inputCosto').val(); 

       var action       = 'AlmacenaViajeSpecial';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, fechaviaje:fechaviaje, cliente:cliente, tipo:tipo, tipoviaje:tipoviaje, numunidades:numunidades, horainicio:horainicio, sueldovta:sueldovta, direccion:direccion, destino:destino, notas:notas, phone_contac:phone_contac, costo:costo, supervisor:supervisor},

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
                          text: "REGISTRO DE VIAJE ESPECIAL ALMACENADO CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'viajes_especiales23.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'viajes_especiales23.php';
                        }
                        });


                          }else {  
                            
                            //swal('Mensaje del sistema', $mensaje, 'warning');
                            //location.reload();
                            Swal.fire({
                            icon: 'Alerta',
                            title: 'Registro de Viaje Especial Almacenado Correctamente',
                            text: $mensaje,

                            })
                            .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'viajes_especiales23.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'viajes_especiales23.php';
                        }
                        });
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
<script>
var inputEle = document.getElementById('inputHorainicio');


function onTimeChange() {
  var timeSplit = inputEle.value.split(':'),
    hours,
    minutes,
    meridian;
  hours = timeSplit[0];
  minutes = timeSplit[1];
  if (hours > 12) {
    meridian = 'PM';
    hours -= 12;
  } else if (hours < 12) {
    meridian = 'AM';
    if (hours == 0) {
      hours = 12;
    }
  } else {
    meridian = 'PM';
  }
 
}
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


   
  }
  // DropzoneJS Demo Code End
</script> 

<script>
    $(document).ready(function () {
        $("#inputTipo").on('change', function () {            
            var optipo = $(this).val();
            
            //alert(optipo);

             if (optipo == 'Camion')
             {
              $('#inputSueldovta').val('180.00');
             }else {
               if (optipo == 'Camioneta') 
               {
                  $('#inputSueldovta').val('120.00');
               }else {
                 if (optipo == 'Automovil') {
                   $('#inputSueldovta').val('100.00');
                 }else {
                   if (optipo == 'Sprinter') {
                    $('#inputSueldovta').val('160.00');
                   }else {
                      if (optipo == 'Unidad Externa') {
                         $('#inputSueldovta').val('0.00');
                      }else {
                         if (optipo == 'JAC') {
                         $('#inputSueldovta').val('120.00');
                      }else {       
                          $('#inputSueldovta').val('0.00');
                      }
                   }
                 }
               }
             }

             

        });
    });
</script> 

<!--
<script>
        window.onload = function(){killerSession();}
         
        function killerSession(){
        setTimeout("window.open('salir.php','_top');",990000);
        }
</script>
-->
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
