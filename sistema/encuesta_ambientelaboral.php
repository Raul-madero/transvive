<?php 


include "../conexion.php";

 

?>
<!DOCTYPE html>
<html lang="es">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="../bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="../bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <head>
        <title>ENCUESTA DE SATISFACCION</title>
        <?php 
            $ruta='./';
            require($ruta.'assets/include/links.php');
        ?>
        <link rel="stylesheet" href="./procesos/respuesta.css">
        <script src="./procesos/jPages.js"></script>
       
    </head>
    <body>
        <div id="my_tope">
            <div class="my_animacion">
	           <div>
	           </div>
            </div>
        </div>

       
        <!-- Modal OKI-->
            <div class="limiter">

        <div class="container-login100">
        

            <div class="wrap-login100">
                
                  <div class="login100-form-title" style="background-image: url(images/bg-01-22.jpg);">
          <div class="col-md-12">
                  <div class="form-group"> 
                  </div>
             </div>
          <span class="login100-form-title-1"><img src="images/logo_22.png" alt="" width="200px" height="80px"><br>
            <h5><b>ENCUESTA DE SATISFACCION</b></h5>
          </span>
        </div>
        <div class="col-md-12">
             <div class="form-group"> 
             </div>
         </div>
          <?php $fcha = date("Y-m-d");?>
          <div class="box box-default">
        <div class="box-header with-border ">
          <h3 class="box-title">Fecha</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">

                <input type="date" class="form-control" id="fechaenc" value="<?php echo $fcha;?>">
              </div>
            </div>
          </div>
        </div>
        </div>

        <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Nombre / Razón Social</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">

                <input type="text" class="form-control" id="empresa" >
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Nombre y área del responsable</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">

                <input type="text" class="form-control" id="nombreyarea" >
              </div>
            </div>
          </div>
        </div>
      </div>


                   <!-- SELECT2 EXAMPLE -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Mencione el medio del contacto por el cual nos conoció</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">

                <select class="form-control" style="width: 100%;" id="medio" name="medio" required>
                <option selected disabled value="">Selecciona...</option>
                <option value="Teléfono">Teléfono</option>
                <option value="Web">Web</option>
                <option value="Redes sociales">Redes sociales</option>
                <option value="Whatsapp">Whatsapp</option>
                <option value="Recomendacion">Recomendacion</option>
                <option value="Campo">Campo</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>

        <div class="box">
           <div class="box-header with-border">
          <h3 class="box-title"><b>Por favor, indiquenos la opción que mejor describa su opinión o que usted considere nos representa, de los suguientes aspectos (siendo 10 el de mayor satisfacción).</b></h3>
        </div>
        <div class="box-header with-border ">
          <h3 class="box-title">Atención en general</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rtiempoforma" id="rtiempoforma" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Tiempo de respuesta</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rtiemporesp" id="rtiemporesp" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Disponibilidad del servicio</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rdisponibilidad" id="rdisponibilidad" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Calidad de nuestros servicios</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rcalidad" id="rcalidad" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Asesoría técnica (tipo de unidades, modelos, capacidad de pasajeros)</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rasesoria" id="rasesoria" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Limpieza y condición de unidades</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rlimpieza" id="rlimpieza" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Atención, servicio, limpieza y presentación del operador</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="roperador" id="roperador" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">El operador conduce la unidad adecuadamente</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rconduce" id="rconduce" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Atención y servicio del área de calidad</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rservicio" id="rservicio" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Como considera el servicio de facturación</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rfactura" id="rfactura" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>

        <div class="box-header with-border ">
          <h3 class="box-title">Nuestros precios</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>10
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="10">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="9">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="8">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="7">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="6">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="5">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="4">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="3">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="2">
                </label>
                <label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1
                  <input type="radio" name="rprecios" id="rprecios" class="minimal" value="1">
                </label>
              </div>
            </div>
          </div>
        </div>



        <!--   -->
        </div>

        <div class="box">
        <div class="box-header with-border ">
          <h3 class="box-title">Sugerencias ó comentarios</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <textarea class="form-control" name="comentarios" id="comentarios" rows="2"></textarea>
              </div>
            </div>
          </div>
        </div>
        </div>


    

         <div class="box box-default">
        
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
          
            <!-- /.col -->
            <div class="col-md-12">
             
             
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <button type="button" id="guardar_encuesta" class="btn btn-primary">Enviar Encuesta</button>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/logo_22.png" width="120" height="45">


         
        </div>
      </div>
      <!-- /.box -->
        

            </div>
        </div>
    </div>

    <script type="text/javascript">
        function mostrar(id) {
        if (id == "OTROS") {
           $("#otroscuales").show();
        }else{
           $("#otroscuales").hide(); 
        }

        }
        </script>
    <script type="text/javascript">
        function mostrar_alter(id) {
        if (id == "OTROS") {
           $("#otroscuales_alter").show();
        }else{
           $("#otroscuales_alter").hide(); 
        }

        }
        </script>

        <script>
        $('#guardar_encuesta').click(function(e){
          e.preventDefault();

          var fecha          = $('#fechaenc').val();
          var nombre         = $('#empresa').val();
          var name_area      = $('#nombreyarea').val();
          var medio          = $('#medio').val();
          var comentarios    = $('#comentarios').val();

          var action       = 'AlmacenaEncuestaCliente';
          
          tiempo_forma = ($("input[type=radio][name=rtiempoforma]:checked").val());
          trespuesta   = ($("input[type=radio][name=rtiemporesp]:checked").val());
          disponibl = ($("input[type=radio][name=rdisponibilidad]:checked").val());
          calidad    = ($("input[type=radio][name=rcalidad]:checked").val());
          asesoria   = ($("input[type=radio][name=rasesoria]:checked").val());
          limpieza   = ($("input[type=radio][name=rlimpieza]:checked").val());
          operador   = ($("input[type=radio][name=roperador]:checked").val());
          cconduce   = ($("input[type=radio][name=rconduce]:checked").val());
          servicio   = ($("input[type=radio][name=rservicio]:checked").val());
          factura    = ($("input[type=radio][name=rfactura]:checked").val());
          precios    = ($("input[type=radio][name=rprecios]:checked").val());
          //alert($("input[type=radio][name=rtiempoforma]:checked").val());

        $.ajax({
            url: 'includes/ajax.php',
            type: "POST",
            async : true,
            data: {action:action, fecha:fecha, nombre:nombre, name_area:name_area, medio:medio, comentarios:comentarios, tiempo_forma:tiempo_forma, trespuesta:trespuesta, disponibl:disponibl, calidad:calidad, asesoria:asesoria, limpieza:limpieza, operador:operador, cconduce:cconduce, servicio:servicio, factura:factura, precios:precios},

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
                    //generarconvPDF(info.idcotizacion);
                      swal('Mensaje del Sistema', 'Su opinión marca la diferencia  \n \n  Gracias por contestar!!!','success').then(function(){ 
                     
                         window.location.href = "index.php";
                        }
                 );

                 }else {                          
                    swal('Mensaje del sistema', $mensaje, 'warning');
                            //location.reload();
                 }

                                                        
    
                }else{
                   swal("Por favor, captura los Datos Requeridos", {
                   icon: "warning",
                   });
                }
                        //viewProcesar();
                },
                  error: function(error) {
                }

               });

         });
        </script>

    
       
        <!-- Fin Modal OKI-->

        <script src="./procesos/respuesta.js"></script>
        <script>
        $(document).ready(function () {
            $(function () {
                $("div.holder").jPages({
                    containerID: "myFormEncuesta",
                    perPage: 1
                });
            });
        });
        </script>
    </body>
</html>