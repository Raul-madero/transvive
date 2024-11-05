<?php
include "../conexion.php";
session_start();
  $User=$_SESSION['user'];
  $rol=$_SESSION['rol'];
  $sql = "select * from rol where idrol =$rol ";
  $query = mysqli_query($conection, $sql);
  $filas = mysqli_fetch_assoc($query); 

  $namerol = $filas['rol'];


  $sqlcte = "select * from clientes ORDER BY nombre_corto";
  $querycte = mysqli_query($conection, $sqlcte);
  $filascte = mysqli_fetch_all($querycte, MYSQLI_ASSOC); 

  $sqlruta = "select * from rutas ORDER BY ruta";
  $queryruta = mysqli_query($conection, $sqlruta);
  $filasruta = mysqli_fetch_all($queryruta, MYSQLI_ASSOC); 

  $sqloper   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as operador from empleados where cargo = 'operador' ORDER BY nombres";
  $queryoper = mysqli_query($conection, $sqloper);
  $filasoper = mysqli_fetch_all($queryoper, MYSQLI_ASSOC); 

  $sqlsupr   = "select concat(nombres, ' ', apellido_paterno, ' ', apellido_materno) as supervisor from supervisores ORDER BY nombres";
  $querysupr = mysqli_query($conection, $sqlsupr);
  $filasupr  = mysqli_fetch_all($querysupr, MYSQLI_ASSOC); 

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
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/
  select2-bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <!--
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="salir.php" class="navbar-brand">
        <span class="brand-text font-weight-light"><img src="../images/logo_easy.png" alt="TRANSVIVE CRM"></span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
       -->
      <?php
      /*
       if ($_SESSION['rol'] == 1) {
        include('includes/navbar.php');
      }else {
        if ($_SESSION['rol'] == 6) {
          include('includes/navbaroperac.php');
        }else {
          if ($_SESSION['rol'] == 8) {
            include('includes/navbarjefeoper.php');
          }else {
            if ($_SESSION['rol'] == 4) {
              include('includes/navbarsup.php');
            }else {
              if ($_SESSION['rol'] == 9) {
                include('includes/navbargrcia.php');
              }else {
                if ($_SESSION['rol'] == 14) {
                  include('includes/navbarcalidad.php');
                }else {
                  if ($_SESSION['rol'] == 15) {
                    include('includes/navbarmonitorista.php');
                  }else {
                    include('includes/navbar.php'); 
                  }  
                }  
              }  
            }  
          }  
        }
      } */ ?>
      <?php /* include('includes/nav.php')*/ ?> 
    <!--
    </div>
  </nav> -->
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
              <li class="breadcrumb-item"><a href="#">Routers</a></li>
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
                    
          include "../conexion.php";
          $query_folio = mysqli_query($conection,"SELECT * FROM folios where serie = 'RO'");
          $result_folio = mysqli_num_rows($query_folio);

          $folioe = mysqli_fetch_array($query_folio);
          $nuevofolio=$folioe["folio"]+1; 

            $query_upfolio = mysqli_query($conection,"UPDATE folios SET folio= folio + 1 where serie = 'RO'");
          

          mysqli_close($conection);
        ?>  

     <div class="col-md-9">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Alta de Router</h3>
              </div>
              <div class="card-body">
              <div class="card-header p-2">
              <!-- /.card-header -->
              <!-- form start -->
               <form name="form_new_cliente_venta" id="form_new_cliente_venta"  action="valida_router.php" method="post" enctype="multipart/form-data">

              <div class="form-group row">  
                   <div class="col-md-12" hidden>
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Folio:</i> *</span>
                      <input name="ffolio" id="ffolio" type="text" class="form-control" style="text-align:right;"/ value="<?php echo $nuevofolio; ?>" readonly>
                    </div>
             </div>
            </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Cliente</label>
                    <div class="col-sm-10">
                      <select class="form-control select2" style="width: 100%; text-align: left" id="inputCliente" name="inputCliente">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filascte as $opct): //llenar las opciones del primer select ?>
                       <option value="<?= $opct['nombre_corto'] ?>"><?= $opct['nombre_corto'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Ruta</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputRuta" name="inputRuta">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasruta as $oprt): //llenar las opciones del primer select ?>
                       <option value="<?= $oprt['ruta'] ?>"><?= $oprt['ruta'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hora Llegada Turno 1</label>
                    <div class="col-sm-2">
                      <input type="time" class="form-control" id="inputHorallegat1" name="inputHorallegat1" >
                    </div>
              

                 
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hora Llegada Turno 2</label>
                    <div class="col-sm-2">
                      <input type="time" class="form-control" id="inputHorallegat2" name="inputHorallegat2" >
                    </div>
        

              
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Hora Llegada Turno 3</label>
                    <div class="col-sm-2">
                      <input type="time" class="form-control" id="inputHorallegat3" name="inputHorallegat3" >
                    </div>
                  </div>
                  <br>

                   <div class="col-md-12">
      <table class="tbl_form" border="1">
      <thead>
        
     
        <tr>
          <th width="10%" style="text-align: center;">Horario Turno1</th>
          <th width="10%" style="text-align: center;">Horario Turno2</th> 
          <th width="10%" style="text-align: center;">Horario Turno3</th>
          <th width="25%" style="text-align: center;">Parada</th> 
          <th width="25%" style="text-align: center;">Referencia</th> 
          <th width="10%" style="text-align: center;">No. de Parada</th>
          <th style="text-align: center;" ><a style="text-align: center; color:#0562C1; font-size: 2.2em;" href="#" id="alumno" data-target="#modalAlumnoMuestra" data-toggle="modal">
                      <small> + </small>
                  </a></th>
        </tr>
      </thead>
      <tbody id="detalle_router">
        <!---Contenido Ajax--->

      </tbody>
    </table> 
  </div>   

  <br>
                  
                  <div class="col-md-12 col-sm-12">
          <div class="form-group">
            <div class="box box-primary">
            <div class="box-body box-profile">
              <div class="photo">
                 <label style="color:#5D6D7E;" for="foto">Foto</label>
                    <div class="prevPhoto">
                       <span class="delPhoto notBlock">X</span>
                       <label for="foto"></label>
                    </div>
                    <div class="upimg">
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
                </div> 

              <h3 class="profile-username text-center"></h3>
               <input type="hidden" class="form-control" id="CodigoUpdate" name="CodigoUpdate"  required="">

            
            </div>
            <!-- /.box-body -->
          </div>
            
          </div>
     </div>  

      <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Link Maps</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="text" style="width: 100%; text-align: left" id="inputLigamaps" name="inputLigamaps" placeholder="Pegue aqui la liga de google maps">
                    </div>
                  </div>



                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Operador</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputOperador" name="inputOperador">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasoper as $oper): //llenar las opciones del primer select ?>
                       <option value="<?= $oper['operador'] ?>"><?= $oper['operador'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>

                   <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Supervisor</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputSupervisor" name="inputSupervisor">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasupr as $opsr): //llenar las opciones del primer select ?>
                       <option value="<?= $opsr['supervisor'] ?>"><?= $opsr['supervisor'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                  </div>


                <!-- /.card-body -->
                <div class="form-group row" style="text-align:right;">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>
                          <button type="submit" class="btn btn-success">Guardar</button>
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

<div class="modal fade" id="modalAlumnoMuestra" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  
  
   <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Agregar Detalle Router</h5>
      </div>
      <div class="modal-body">
        <form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>  

           <div class="col-md-12">
                    <div class="input-group">
                      <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Folio:</i></span>
                      <input name="bookId" id="bookId" type="text" class="form-control" style="text-align:right;"/ value="<?php echo $nuevofolio; ?>" disabled>
                    </div>
             </div>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 


         <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Horario Turno 1:</i>&nbsp;&nbsp;</span>
                <input type="time"  class="form-control" name="fturno1" id="fturno1" >
              </div>
         </div>  

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div>  
         
       
          <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Horario Turno 2:</i>&nbsp;&nbsp;</span>
                <input type="time"  class="form-control" name="fturno2" id="fturno2" >
              </div>
         </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

         <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Horario Turno 3:</i>&nbsp;&nbsp;</span>
                <input type="time"  class="form-control" name="fturno3" id="fturno3" >
              </div>
         </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Parada: </i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="text" class="form-control" name="fparada" id="fparada" >
              </div>
         </div>

         <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 

        <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> Referencia: </i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                <input type="text" class="form-control" name="freferencia" id="freferencia" >
              </div>
         </div>

        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 
         

        <div class="col-md-12">
              <div class="input-group">
                <span class="input-group-addon form-required"><i class="fa" style="color:#737FA7;"> No. de Parada:</i>&nbsp;&nbsp;</span>
                <input type="number" class="form-control" name="fnparadas" id="fnparadas" value="0">
              </div>
         </div>

      

       
        </form>
        <div class="col-md-12">
          <div class="form-group"> 
          </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success pull-right" href="#" id="actualiza_partidamd"><i class="fa fa-save"></i>&nbsp;Agregar</button>
      </div>
    </div>
  </div>
</div> 

<script>
   $('#actualiza_partidamd').click(function(e){
        e.preventDefault();

        var folio       = $('#bookId').val();
        var hturno1     = $('#fturno1').val();
        var hturno2     = $('#fturno2').val();
        var hturno3     = $('#fturno3').val();
        var parada      = $('#fparada').val();
        var referencia  = $('#freferencia').val();
        var numparadas  = $('#fnparadas').val();
       
       var action       = 'ActualizaDetallerouter';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, folio:folio, hturno1:hturno1, hturno2:hturno2, hturno3:hturno3, parada:parada, referencia:referencia, numparadas:numparadas},

                    success: function(response)
                    {
                      if(response != 'error')
                        {
                            //console.log(response);
                            var info = JSON.parse(response);
                            console.log(info);
                            //$('#modalFactura').modal('hide');
                            $('#detalle_router').html(info.detalle);
                            
                            $('#fturno1').val('');
                            $('#fturno2').val('');
                            $('#fturno3').val('');
                            $('#fparada').val('');
                            $('#freferencia').val('');
                            $('#fnparadas').val('');
    
                        }else{
                           console.log('no data');
                           alert('faltan datos');
                        }
                        //viewProcesar();
                 },
                 error: function(error) {
                 }

               });

    });

    </script> 

<script type="text/javascript">
   $("#foto").on("change",function(){
        var uploadFoto = document.getElementById("foto").value;
        var foto       = document.getElementById("foto").files;
        var nav = window.URL || window.webkitURL;
        var contactAlert = document.getElementById('form_alert');
        
            if(uploadFoto !='')
            {
                var type = foto[0].type;
                var name = foto[0].name;
                if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png')
                {
                    contactAlert.innerHTML = '<p class="errorArchivo">El archivo no es válido.</p>';                        
                    $("#img").remove();
                    $(".delPhoto").addClass('notBlock');
                    $('#foto').val('');
                    return false;
                }else{  
                        contactAlert.innerHTML='';
                        $("#img").remove();
                        $(".delPhoto").removeClass('notBlock');
                        var objeto_url = nav.createObjectURL(this.files[0]);
                        $(".prevPhoto").append("<img id='img' src="+objeto_url+">");
                        $(".upimg label").remove();
                        
                    }
              }else{
                alert("No selecciono foto");
                $("#img").remove();
              }              
    });

    $('.delPhoto').click(function(){
        $('#foto').val('');
        $(".delPhoto").addClass('notBlock');
        $("#img").remove();

        if($("#foto_actual") && $("#foto_remove")){
            $("#foto_remove").val('user.png');
        }

    });

</script>  

<script> 
    function delete_detarouter(id, folio){
    var action = 'removeDetalleRouter';
    var id_partida = id;
    var folio = folio;


    $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        async : true,
        data: {action:action, id_partida:id_partida, folio:folio},

        success: function(response)
        {
            if(response != 'error')
              {
              //console.log(response);
              var info = JSON.parse(response);
              $('#detalle_router').html(info.detalle);


            }else{
              $('#detalle_router').html('');
                        
            }
                        //viewProcesar();
        },
        error: function(error) {
        }
    });
    }

    </script>     

    <script>
   $('#btn_salir').click(function(e){
        e.preventDefault();

            var norecibo  = $('#ffolio').val();
            var action = 'procesarSalirRouter';
                       
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
                      location.href = 'routers.php';
                       //*location.reload();


                        
                    }else{
                        console.log('no data');
                    }
                },
                error: function(error){                
                }
            });
        

    });
    </script>

<script>
   $('#guardar_tipoactividad').click(function(e){
        e.preventDefault();

       var tipo         = $('#inputTipo').val();
       var nounidad     = $('#inputNounidad').val();
       var marca        = $('#inputMarca').val();
       var year         = $('#inputYear').val();
       var modelo       = $('#inputModelo').val();

       var action       = 'AlmacenaUnidad';

        $.ajax({
                    url: 'includes/ajax.php',
                    type: "POST",
                    async : true,
                    data: {action:action, tipo:tipo, nounidad:nounidad, marca:marca, year:year, modelo:modelo},

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
                          text: "UNIDAD ALMACENADA CORRECTAMENTE",
                          icon: 'success',

                          //showCancelButton: true,
                          //confirmButtonText: "Regresar",
                          //cancelButtonText: "Salir",
       
                       })
                        .then(resultado => {
                       if (resultado.value) {
                        //* generarimpformulaPDF(info.folio);
                        location.href = 'unidades.php';
                       
                        } else {
                          // Dijeron que no
                          location.reload();
                         location.href = 'unidades.php';
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

<script type="text/javascript">
      $(document).ready(function(){
          
         var pedidos3 = $('#inputRuta');
        //Ejecutar accion al cambiar de opcion en el select de las bandas
        $('#inputCliente').change(function(){
          var banda_id3 = $(this).val(); //obtener el id seleccionado

          if(banda_id3 !== ''){ //verificar haber seleccionado una opcion valida

            /*Inicio de llamada ajax*/
            $.ajax({
              data: {banda_id3:banda_id3}, //variables o parametros a enviar, formato => nombre_de_variable:contenido
              dataType: 'html', //tipo de datos que esperamos de regreso
              type: 'POST', //mandar variables como post o get
              url: 'data/get_rutas.php' //url que recibe las variables
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
