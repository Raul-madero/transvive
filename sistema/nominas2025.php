<?php
include "../conexion.php";
session_start();
$User = $_SESSION['user'];
$rol = $_SESSION['rol'];
$sql = "select * from rol where idrol =$rol ";
$query = mysqli_query($conection, $sql);
$filas = mysqli_fetch_assoc($query);
$namerol = $filas['rol'];
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
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <!--<link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">-->
  <link href="cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
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
        switch ($_SESSION['rol']) {
            case 4:
                include 'includes/navbarsup.php';
                break;
            case 5:
                include 'includes/navbarrhuman.php';
                break;
            case 6:
                include 'includes/navbaroperac.php';
                break;
            case 8:
                include 'includes/navbarjefeoper.php';
                break;
            case 9:
                include 'includes/navbargrcia.php';
                break;
            default:
                include 'includes/navbar.php';
                break;
        }
       ?>
        <?php include 'includes/nav.php';  ?>
      </div>
    </nav>
    <!-- /.navbar -->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4 class="m-0"> Nomina Empleados <small>Semanal</small></h4>
            </div><!-- /.col -->
            <div class="col-sm-6 flex">
				<label for="semana">Numero de Semana</label>
              <select class="form-control select2bs4" style="text-align: left; margin-bottom: 12px" name="semana" id="semana" id="nosemana">
				<option value="0">--Selecciona la Semana--</option>
				<?php 
				 for($i = 0; $i < 52; $i++) {
          $nosemana = ($i + 1);
					echo '<option value="' . $nosemana . '">' ."Semana " . $nosemana . '</option>';
				 }
				 ?>
			  </select>
			  <input type="number" name="anio" id="anio" value="2025" placeholder="Selecciona el anio" class="form-control" style="text-align: left; margin-bottom: 12px">
			  <button id="seleccionaSemana" class="btn btn-success">Seleccionar</button>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Main content -->
      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <div id="total" class="text-left border-bottom mb-3 font-weight-bold font-size-lg"></div>
          <table id="example1" class="table table-striped table-bordered table-condensed" style="width:100%; overflow-x:auto;" >
            <thead>
              <tr>
                <th>Semana/Año</th>
			          <th>No.</th>
                <th>Nombre</th>
                <!-- <th>Tipo unidad</th> -->
                <th>Cargo</th>
                <th>Imss</th>
                <th>Sueldo Base</th>
                <th>Total de Vueltas</th>
                <th>Sueldo Bruto</th>
                <th>Nomina Fiscal</th>
                <th>Bonos</th>
                <th>Deposito</th>
                <th>Efectivo</th>
                <th>Deducciones</th>
                <th>Deduccion Fiscal</th>
                <th>Caja de Ahorro</th>
                <th>Supervisor</th>
                <th>Neto</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
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
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes
<script src="../dist/js/demo.js"></script> -->

<script>
    $(document).ready(function() {
      	const formatoMoneda = (valor) => `$ ${parseFloat(valor).toFixed(2)}`;
        const load_data = (semana, anio) => {
            let ajaxUrl = 'data/nominaEmpleados.php'
			let table = $('#example1').DataTable()
			table.destroy()
		 	table = $('#example1').DataTable({
            	"order": [[ 0, "asc" ]],
          		dom: 'Bfrtip',
				lengthMenu: [
				[20, 25, 50, -1],
				['20 rows', '25 rows', '50 rows', 'Show all']
				],
				"processing": true,
				"serverSide": true,
				"stateSave": true,
				"responsive": false,
				"scrollX": true,
				"autoWidth": true,
				"lengthMenu": [ [10, 25, 50, 100, -1], [10, 25, 50, 100, "All"] ],
				"ajax": {
					"url": ajaxUrl,
					"type": "POST",
						"data": {"semana": semana, "anio": anio},
					"dataSrc": "data",
					"error": function (xhr, error, thrown) {
					console.error(xhr, error, thrown);
					alert("Error al cargar los datos. Por favor intenta de nuevo.")
					}
         		},
          		"columns": [
					{"data": null, "render": function (data, type, row) {
						return row.semana + "/" + row.anio;
					}},
					{"data": "noempleado"},
					{"data": "nombre"},
					// {"data": "tipo_unidad", "width": "100px"},
					{"data": "cargo"},
					{"data": "imss", "render": function(data) {return data == 1 ? "Si" : "No";}},
          {"data": null, "render": (data) => formatoMoneda(data.sueldo_base)},
					{"data": "total_vueltas"},
					{"data": null, "render": (data) => formatoMoneda(data.sueldo_bruto)},
					{"data": null, "render": (data) => formatoMoneda(data.nomina_fiscal)},
					{"data": null, "render": (data) => formatoMoneda(data.bonos)},
					{"data": null, "render": (data) => formatoMoneda(data.neto)},
					{"data": null, // Calculado dinámicamente
						"render": (data) => formatoMoneda(parseFloat(data.sueldo_bruto) - parseFloat(data.nomina_fiscal) - parseFloat(data.caja_ahorro) - parseFloat(data.deducciones))},
					{"data": null, "render": (data) => formatoMoneda(parseFloat(data.deducciones) + parseFloat(data.caja_ahorro)),
					},
					{"data": null, "render": (data) => formatoMoneda(data.deduccion_fiscal)},
					{"data": null, "render": (data) => formatoMoneda(data.caja_ahorro)},
					{"data": "supervisor"},
					{"data": null,
						"render": (data) => formatoMoneda(parseFloat(data.sueldo_bruto) + parseFloat(data.bonos) - parseFloat(data.deducciones) - parseFloat(data.deduccion_fiscal) - parseFloat(data.caja_ahorro)),
					}
          		],
		  		"language": {
					"emptyTable": "No hay registros disponibles",
        			"info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
        			"loadingRecords": "Cargando...",
       				 "search": "Buscar:",
        			"lengthMenu": "Mostrar _MENU_ registros",
        			"paginate": {
						"first": "Primera",
						"previous": "Anterior",
						"next": "Siguiente",
						"last": "Última"
					}
				},
        "drawCallback": function(settings) {
          console.log(settings)
          let total = settings.json.totalNomina
          $('#total').text("Total de la Nomina: " + formatoMoneda(total))
          console.log("Draw callback ejecutado")
        }
              	});
		}
		$("#seleccionaSemana").on('click', function() {
			console.log("Click")
			var semana = $("#semana").val();
			let anio = $("#anio").val();
			if (semana < 0 || anio < 2024 || semana > 52) {
				alert("Seleccione una semana")
			} else {
				load_data(semana, anio)
			}
		})
		load_data()
    });
</script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // Invocamos cada 5 segundos ;)
      const milisegundos = 5 * 1000;
      setInterval(function() {
        // No esperamos la respuesta de la petición porque no nos importa
        fetch("./refrescar.php");
      }, milisegundos);
    });
  </script>
</body>

</html>