<?php
session_start();
include('../conexion.php');

// Verificar sesión
if (!isset($_SESSION["nombre"]) || !isset($_SESSION["rol"])) {
    die("Acceso no autorizado.");
}

$user = $_SESSION["nombre"];
$rol = $_SESSION['rol'];

// Validar parámetro de entrada
$requisicion = isset($_REQUEST['req']) ? intval($_REQUEST['req']) : 0;

// Zona horaria y fecha actual
date_default_timezone_set('America/Mexico_City');
$fcha = date("Y-m-d");

// Obtener el último folio de orden de compra
$query_folio = mysqli_query($conection, "SELECT MAX(no_orden) AS folio FROM orden_compra");

if (!$query_folio) {
    die("Error al obtener folio: " . mysqli_error($conection));
}

$folioe = mysqli_fetch_array($query_folio);
$nuevofolio = isset($folioe["folio"]) ? $folioe["folio"] + 1 : 1;

// Llenar selector de proveedores
$sqlprov = "
    SELECT 
        id, no_prov, nombre, contacto, telefono, correo, 
        forma_pago, uso_cfdi, metodo_pago 
    FROM proveedores 
    WHERE estatus = 1
";

$queryprov = mysqli_query($conection, $sqlprov);

if (!$queryprov) {
    die("Error al obtener proveedores: " . mysqli_error($conection));
}

$filasprov = mysqli_fetch_all($queryprov, MYSQLI_ASSOC);

// Llenar selector de quien recibe
$sqlrecb = "
    SELECT nombre, estatus 
    FROM usuario 
    WHERE estatus = 1
    ORDER BY nombre
";
$queryrecb = mysqli_query($conection, $sqlrecb);
if (!$queryrecb) {
    die("Error al obtener receptores: " . mysqli_error($conection));
}
$filasrecb = mysqli_fetch_all($queryrecb, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="theme-color" content="#343a40"> <!-- color de la barra superior en móviles -->

  <title>TRANSVIVE | ERP</title>
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>

  <!-- Google Fonts: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" rel="stylesheet">

  <!-- Font Awesome (Iconos) -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

  <!-- AdminLTE (Tema principal) -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">

  <!-- Plugins -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="../plugins/ekko-lightbox/ekko-lightbox.css">
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- Personal Styles (opcional, si tienes uno) -->
  <!-- <link rel="stylesheet" href="../css/custom.css"> -->
</head>

<body class="hold-transition layout-top-nav">
  <div class="wrapper">
    <div class="content-wrapper">
      
      <!-- Encabezado -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6 d-none d-sm-block">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Orden de Compra</a></li>
                <li class="breadcrumb-item active">Nueva</li>
              </ol>
            </div>
          </div>
        </div>
      </section>

      <!-- Contenido principal -->
      <section class="content">
        <div class="container-fluid d-flex justify-content-center">

          <div class="col-md-10">
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Alta de Orden de Compra</h3>
              </div>

              <div class="card-body">
                <form class="form-horizontal">

                  <!-- Datos principales -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">No. Requisición</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control" name="inputReq" id="inputReq" value="<?php echo 'REQ-' . $requisicion; ?>" readonly>
                    </div>

                    <label class="col-sm-2 col-form-label text-right">Fecha</label>
                    <div class="col-sm-2">
                      <input type="date" class="form-control" name="inputFecha" id="inputFecha" value="<?php echo $fcha; ?>">
                    </div>

                    <label class="col-sm-2 col-form-label">No. Orden</label>
                    <div class="col-sm-2">
                      <input class="form-control" name="inputFolio" id="inputFolio" value="<?php echo 'OC-' . $nuevofolio; ?>" readonly style="text-align: right; font-weight: bold; color: #F05B0E">
                    </div>
                  </div>

                  <!-- Proveedor y Contacto -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Proveedor</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" name="inputProveedor" id="inputProveedor" required>
                        <option value="">- Seleccione -</option>
                        <?php foreach ($filasprov as $oppv): ?>
                          <option value="<?= $oppv['id'] ?>"><?= $oppv['nombre'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>

                    <label class="col-sm-2 col-form-label">Contacto</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="inputContacto" id="inputContacto" readonly>
                    </div>
                  </div>

                  <!-- Teléfono y Correo -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Teléfono</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="inputTelefono" id="inputTelefono" readonly>
                    </div>

                    <label class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" name="inputCorreo" id="inputCorreo" readonly>
                    </div>
                  </div>

                  <!-- Forma y Método de Pago -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Forma de Pago</label>
                    <div class="col-sm-4">
                      <select class="form-control custom-select" name="inputFormapago" id="inputFormapago" required>
					  		<option value="">--  Seleccione --</option>
							<option value="01 Efectivo">01 Efectivo</option>
							<option value="02 Cheque nominativo">02 Cheque nominativo</option>
							<option value="03 Transferencia electronica de fondos">03 Transferencia electronica de fondos</option>
							<option value="04 Tarjeta de credito">04 Tarjeta de credito</option>
							<option value="05 Monedero electronico">05 Monedero electronico</option>
							<option value="06 Dinero electronico">06 Dinero electronico</option>
							<option value="08 Vales de despensa">08 Vales de despensa</option>
							<option value="28 Tarjeta de debito">28 Tarjeta de debito</option>
							<option value="29 Tarjeta de servicio">29 Tarjeta de servicio</option>
							<option value="99 Otros">99 Otros</option>
                      </select>
                    </div>

                    <label class="col-sm-2 col-form-label">Método de Pago</label>
                    <div class="col-sm-4">
                      <select class="form-control custom-select" name="inputMetodopago" id="inputMetodopago" required>
					  	<option value="">--  Seleccione --</option>
						<option value="PUE Pago de Una Sola Exhibicion">PUE - Pago de Una Sola Exhibición</option>
						<option value="PPD Pago en Parcialidades o Diferidos">PPD - Pago en Parcialidades o Diferidos</option>
                      </select>
                    </div>
                  </div>

                  <!-- CFDI y Área Solicitante -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Uso de CFDI</label>
                    <div class="col-sm-4">
                      <select class="form-control custom-select" name="inputUsocfdi" id="inputUsocfdi" required>
					  	<option value="">-- Seleccione --</option>
						<option value="G01 - Adquisición de mercancias">G01 - Adquisición de mercancías</option>
						<option value="G02 - Devoluciones, descuentos o bonificaciones">G02 - Devoluciones, descuentos o bonificaciones</option>
						<option value="G03 - Gastos en general">G03 - Gastos en general</option>
						<option value="I01 - Construcciones">I01 - Construcciones</option>
						<option value="I02 - Mobiliario y equipo de oficina por inversiones">I02 - Mobiliario y equipo de oficina por inversiones</option>
						<option value="I03 - Equipo de transporte">I03 - Equipo de transporte</option>
						<option value="I04 - Equipo de computo y accesorios">I04 - Equipo de computo y accesorios</option>
						<option value="I08 - Otra maquinaria y equipo">I08 - Otra maquinaria y equipo</option>
						<option value="D02 - Gastos médicos por incapacidad o discapacidad">D02 - Gastos médicos por incapacidad o discapacidad</option>
						<option value="D04 - Donativos">D04 - Donativos</option>
						<option value="D08 - Gastos de transportación escolar obligatoria">D08 - Gastos de transportación escolar obligatoria</option>
						<option value="D10 - Pagos por servicios educativos (colegiaturas)">D10 - Pagos por servicios educativos (colegiaturas)</option>
						<option value="S01 - Sin efectos fiscales">S01 - Sin efectos fiscales</option>
						<option value="CP01 - Pagos">CP01 - Pagos</option>
                      </select>
                    </div>

                    <label class="col-sm-2 col-form-label">Área Solicitante</label>
                    <div class="col-sm-4">
                      <select class="form-control custom-select" name="inputSolicita" id="inputSolicita" required>
					  		<option value="">--  Seleccione --</option>
							<option value="Aseguramiento de Calidad">Aseguramiento de Calidad</option>
							<option value="Administracion">Administracion</option>
							<option value="Mantenimiento">Mantenimiento</option>
							<option value="Recursos Humanos">Recursos Humanos</option>
							<option value="Compras">Compras</option>
							<option value="Ventas">Ventas</option>
							<option value="Servicio">Servicio</option>
							<option value="Sistemas">Sistemas</option>
							<option value="Almacen">Almacen</option>
							<option value="Direccion">Direccion</option>
                      </select>
                    </div>
                  </div>

                  <!-- Tabla de productos -->
                  <div class="form-group row">
                    <label class="col-sm-12 col-form-label text-center" style="background-color: gainsboro;">Movimientos</label>
                  </div>

                  <div class="col-sm-12 mb-4">
                    <table id="requisicion" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th style="width:10%; text-align:center;">Cantidad</th>
                          <th style="width:10%; text-align:center;">Código</th>
                          <th style="width:32%; text-align:center;">Descripción</th>
                          <th style="width:8%; text-align:center;">U.M.</th>
                          <th style="width:10%; text-align:center;">Marca</th>
                          <th style="width:10%; text-align:center;">Precio</th>
                          <th style="width:10%; text-align:center;">Importe</th>
                          <th style="width:10%; text-align:center;">Acciones</th>
                        </tr>
                      </thead>
                      <tbody id="detalle_ordencompra">
                        <!-- Contenido dinámico (Ajax) -->
                      </tbody>
                      <tfoot>
                        <tr>
                          <th colspan="6" class="text-right">Subtotal:</th>
                          <th id="subtotal" class="text-right"></th>
                          <th></th>
                        </tr>
                        <tr>
                          <th colspan="6" class="text-right">IVA (16%):</th>
                          <th id="iva" class="text-right"></th>
                          <th></th>
                        </tr>
                        <!-- marcador-impuestos -->
                        <tr>
                          <th colspan="6" class="text-right">Total:</th>
                          <th id="total" class="text-right font-weight-bold"></th>
                          <th></th>
                        </tr>
                        <tr>
                          <td colspan="8" class="text-right">
                            <button type="button" id="btnAgregarImpuesto" class="btn btn-sm btn-outline-primary">+ Agregar Impuesto</button>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>

                  <!-- Observaciones -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="inputNotas" id="inputNotas" rows="1"></textarea>
                    </div>
                  </div>

                  <!-- Recibe -->
                  <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Recibe</label>
                    <div class="col-sm-10">
                      <select class="form-control" name="inputRecibe" id="inputRecibe" required>
                        <?php foreach ($filasrecb as $oprc): ?>
                          <option value="<?= $oprc['nombre'] ?>"><?= strtoupper($oprc['nombre']) ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>

                  <!-- Botones -->
                  <div class="form-group row">
                    <div class="offset-sm-2 col-sm-10 text-right">
                      <button type="button" class="btn btn-secondary" id="btn_salir">Cancelar</button>
                      &nbsp;&nbsp;&nbsp;
                      <button type="submit" class="btn btn-success" id="guardar_tipoactividad">Guardar</button>
                    </div>
                  </div>

                </form>
              </div> <!-- /.card-body -->
            </div> <!-- /.card -->
          </div> <!-- /.col-md-10 -->

        </div> <!-- /.container-fluid -->
      </section>
    </div> <!-- /.content-wrapper -->
  </div> <!-- /.wrapper -->
  <!-- Main Footer -->
  <?php include('includes/footer.php') ?>
</div>
<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap 4 + AdminLTE -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>

<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  const proveedoresData = <?= json_encode($filasprov, JSON_UNESCAPED_UNICODE); ?>;
  let impuestosAdicionales = [];

  const formatMoney = val => '$' + val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
  
  function renderImpuestosAdicionales() {
    $('.fila-impuesto-adicional').remove();
    impuestosAdicionales.forEach((imp, idx) => {
      const fila = `
        <tr class="fila-impuesto-adicional">
          <th colspan="6" class="text-right">${imp.tipo} (${imp.porcentaje}%)</th>
          <th class="impuesto-monto text-right" data-idx="${idx}">-</th>
          <th><button class="btn btn-danger btn-sm quitar-imp" data-idx="${idx}">X</button></th>
        </tr>`;
      $('#total').closest('tr').before(fila);
    });
  }

  function recalcularTotales() {
    const api = $('#requisicion').DataTable();
    let subtotal = api.column(6, { page: 'current' }).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
    let iva = subtotal * 0.16;
    let total = subtotal + iva;

    impuestosAdicionales.forEach((imp, idx) => {
      const monto = subtotal * (imp.porcentaje / 100);
      if(
        imp.tipo.trim().toLowerCase() == 'isr' ||
        imp.tipo.trim().toLowerCase() == 'retencion de iva'
      ) {
        total -= monto; // ISR se resta del total
      }else {
        total += monto; // Otros impuestos se suman al total
      }

      $(`.impuesto-monto[data-idx="${idx}"]`).html(formatMoney(monto));
    });

    $('#subtotal').html(formatMoney(subtotal));
    $('#iva').html(formatMoney(iva));
    $('#total').html(formatMoney(total));
  }

  $(document).ready(function () {
    // Salir con confirmación
    $('#btn_salir').click(function (e) {
      e.preventDefault();
      Swal.fire({
        title: "¿DESEA SALIR?",
        icon: 'info',
        showCancelButton: true,
        confirmButtonText: "Regresar",
        cancelButtonText: "Salir"
      }).then(resultado => {
        if (!resultado.value) location.href = 'requisiciones23.php';
      });
    });

    // Llenar datos del proveedor
    $('#inputProveedor').on('change', function () {
		const proveedorId = this.value;
		const proveedor = proveedoresData.find(p => p.id == proveedorId); // Busca el proveedor por ID

		console.log(proveedor); // Asegúrate de que `proveedor` no sea `undefined`

		// Asegúrate de que proveedor exista antes de intentar acceder a sus propiedades
		if (proveedor) {
			const campos = ['Contacto', 'Telefono', 'Correo']; // Asegúrate de incluir todos los campos
			campos.forEach(campo => {
			// Asigna los valores correspondientes a los campos
			$(`#input${campo}`).val(proveedor[campo.toLowerCase()]); // Usa el valor del proveedor si existe, o vacío si no
			});
		} else {
			// Si no se encuentra el proveedor, limpia los campos
			const campos = ['Contacto', 'Telefono', 'Correo'];
			campos.forEach(campo => {
			$(`#input${campo}`).val('');
			});
		}
	});


    // Inicializar tabla requisición
    const table = $('#requisicion').DataTable({
      ajax: {
        url: "data/detalles_requisicion.php",
        type: "POST",
        data: { folio: <?= $requisicion ?> },
        dataSrc: "data"
      },
      columns: [
        { data: "cantidad" },
        { data: "codigo" },
        {
          data: "descripcion",
          render: (data, _, __, meta) =>
            `<input type="text" class="form-control form-control-sm descripcion" data-index="${meta.row}" value="${data}">`
        },
        { data: "unidad_medida" },
        {
          data: "marca",
          render: (data, _, __, meta) =>
            `<input type="text" class="form-control form-control-sm marca" data-index="${meta.row}" value="${data}">`
        },
		{
			data: "precio",
			render: function (data, type, row, meta) {
				if (type === 'display') {
				return `<input type="number" step="0.01" class="form-control form-control-sm precio" value="${data}" />`;
				}
				return data;
			}
		},
        {
          data: "importe",
          render: $.fn.dataTable.render.number(',', '.', 2, '$')
        },
        {
          data: null,
          orderable: false,
          render: () => `<button type="button" class="btn btn-danger btn-sm eliminar-producto">Eliminar</button>`
        }
      ],
      paging: false,
      info: false,
      searching: false,
      lengthChange: false,
      language: { emptyTable: "No hay datos disponibles en la tabla." },
      drawCallback: recalcularTotales
    });

    // Cambios en precios
    $('#requisicion tbody').on('input', '.precio', function () {
		const tr = $(this).closest('tr');
		const row = table.row(tr);
		const rowData = row.data();
		const nuevoPrecio = parseFloat(this.value) || 0;

		rowData.precio = nuevoPrecio;
		rowData.importe = rowData.cantidad * nuevoPrecio;

		// Actualizamos el DOM directamente para evitar re-render innecesario
		$(tr).find('td').eq(6).html(formatMoney(rowData.importe));

		// Importante: guardar los nuevos datos en el row
		recalcularTotales();
	});

    // Eliminar producto
    $('#requisicion').on('click', '.eliminar-producto', function () {
      const fila = $(this).closest('tr');
      Swal.fire({
        title: "¿Eliminar producto?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar"
      }).then(result => {
        if (result.isConfirmed) {
          table.row(fila).remove().draw();
        }
      });
    });

    // Agregar impuesto
    $('#btnAgregarImpuesto').on('click', function (e) {
      e.preventDefault();
      const tipo = prompt("Nombre del impuesto (Ej. ISR, IEPS):");
      if (!tipo) return;

      const porcentaje = parseFloat(prompt(`¿Porcentaje para ${tipo}?`, "0"));
      if (isNaN(porcentaje) || porcentaje <= 0) {
        alert("Porcentaje no válido.");
        return;
      }

      impuestosAdicionales.push({ tipo, porcentaje });
      renderImpuestosAdicionales();
      recalcularTotales();
    });

    // Quitar impuesto
    $('#requisicion').on('click', '.quitar-imp', function () {
      const idx = $(this).data('idx');
      impuestosAdicionales.splice(idx, 1);
      renderImpuestosAdicionales();
      recalcularTotales();
    });

    // Guardar orden
    $('#guardar_tipoactividad').on('click', function (e) {
      e.preventDefault();

      const subtotal = parseFloat($('#subtotal').text().replace(/[$,]/g, '')) || 0;
      const iva = parseFloat($('#iva').text().replace(/[$,]/g, '')) || 0;
      const total = parseFloat($('#total').text().replace(/[$,]/g, '')) || 0;

      const detalle = [];
      table.rows().every(function () {
        const row = this.node();
        const data = this.data();
        detalle.push({
          id: data.id,
          cantidad: data.cantidad,
          codigo: data.codigo,
          descripcion: $(row).find('.descripcion').val(),
          marca: $(row).find('.marca').val(),
          precio: parseFloat($(row).find('.precio').val()) || 0,
          importe: data.cantidad * (parseFloat($(row).find('.precio').val()) || 0),
          unidad_medida: data.unidad_medida
        });
      });

      const requisicion = $('#inputReq').val();
      const odc = $('#inputFolio').val();
      const noreq = requisicion.split("-")[1];
      const folio = odc.split("-")[1];

      $.ajax({
        url: 'includes/ajax.php',
        type: "POST",
        data: {
          action: 'AlmacenaOrdencompra',
          folio,
          noreq,
          fecha: $('#inputFecha').val(),
          proveedor: $('#inputProveedor').val(),
          contacto: $('#inputContacto').val(),
          telefono: $('#inputTelefono').val(),
          correo: $('#inputCorreo').val(),
          forma_pago: $('#inputFormapago').val(),
          metodo_pago: $('#inputMetodopago').val(),
          uso_cfdi: $('#inputUsocfdi').val(),
          solicita: $('#inputSolicita').val(),
          notas: $('#inputNotas').val(),
          recibe: $('#inputRecibe').val(),
          detalle: JSON.stringify(detalle),
          subtotal,
          iva,
          total,
          impuestos: JSON.stringify(impuestosAdicionales)
        },
        success: function (response) {
          let info;
          try {
            info = JSON.parse(response);
          } catch (e) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Respuesta inválida del servidor.' });
            return;
          }

          if (info.status === 'success') {
            Swal.fire({
              title: "¡Éxito!",
              text: "ORDEN DE COMPRA ALMACENADA CORRECTAMENTE",
              icon: 'success'
            }).then(() => {
              window.location.href = 'ordenes_compra23.php';
            });
          } else {
            Swal.fire({ icon: 'error', title: 'Oops...', text: info.message || 'Error al guardar.' });
          }
        }
      });
    });
  });
</script>
</body>
</html>