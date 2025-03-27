<?php
session_start();
include('../conexion.php');
$user = $_SESSION["nombre"];
$rol = $_SESSION['rol'];
$requisicion = $_REQUEST['req'];

//Obtener fecha actual
date_default_timezone_set('America/Mexico_City');
$fcha = date("Y-m-d");

//Obtener el ultimo folio para la orden de compra
$query_folio = mysqli_query($conection,"SELECT MAX(no_orden) AS folio  FROM orden_compra");
$result_folio = mysqli_num_rows($query_folio);
$folioe = mysqli_fetch_array($query_folio);
$nuevofolio=$folioe["folio"] + 1; 


//Llamada para llenar el selector de proveedores
$sqlprov   = "SELECT id, no_prov, nombre, contacto, telefono, correo, forma_pago, uso_cfdi, metodo_pago FROM proveedores WHERE estatus = 1";
$queryprov = mysqli_query($conection, $sqlprov);
$filasprov = mysqli_fetch_all($queryprov, MYSQLI_ASSOC);

//Llamada para llenar el selctor de quien recibe
$sqlrecb   = "select nombre from usuario where rol = 10 and estatus = 1 ORDER BY nombre";
$queryrecb = mysqli_query($conection, $sqlrecb);
$filasrecb = mysqli_fetch_all($queryrecb, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
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
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          
          </div>
          <div class="col-sm-6 d-none d-sm-block">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Orden de Compra</a></li>
              <li class="breadcrumb-item active">Nueva</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    <center>

         <?php
     ?>  

     <div class="col-md-10">
     <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Alta de Orden de Compra</h3>
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
                    <label  for="inputEmail3" class="col-sm-2 col-form-label">No. Requsicion</label>
                    <div class="col-sm-2">
						<input type="text" class="form-control" id="inputReq" name="inputReq" value="<?php echo "REQ-" . $requisicion; ?>" readonly>
					</div>
                     <!-- <select style=" font-size: 14px;"  class="form-control select2bs4" style="width: 100%; text-align: left" id="inputNoorden" name="inputNoorden">
                       <option value="">No. Requisicion</option>
                       <?php foreach ($filasoc as $opoc): //llenar las opciones del primer select ?>
                       <option value="<?= $opoc['no_requisicion'] ?>"><?= $opoc['no_requisicion'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div> -->
                  
                    <label for="inputEmail3" class="col-sm-2 col-form-label" style="text-align: right;">Fecha</label>
                    <div class="col-sm-2">
                      <input style=" font-size: 14px;" type="date" class="form-control" id="inputFecha" name="inputFecha" value="<?php echo $fcha;?>">
                    </div>
                    <label  for="inputEmail3" class="col-sm-2 col-form-label">No. Orden</label>
                    <div class="col-sm-2">
                      <input style="text-align: right; font-weight: bold; color: #F05B0E" class="form-control" id="inputFolio" name="inputFolio" value="<?php echo "OC-"  . $nuevofolio; ?>" readonly>
                    </div>
                  
                  </div>

                   <div class="form-group row" style="text-align:left;">
                     <label for="inputEmail3" class="col-sm-2 col-form-label">Proveedor</label>
                    <div class="col-sm-4">
                      <select class="form-control select2bs4" style="width: 100%; text-align: left; font-size: 14px;" id="inputProveedor" name="inputProveedor">
                       <option value="">- Seleccione -</option>
                       <?php foreach ($filasprov as $oppv): //llenar las opciones del primer select ?>
                       <option value="<?= $oppv['id'] ?>"><?= $oppv['nombre'] ?></option>  
                       <?php endforeach; ?>
                    </select>
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Contacto</label>
                    <div class="col-sm-4">
                      <input style=" font-size: 14px;" type="text" class="form-control" id="inputContacto" name="inputContacto">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Telefono</label>
                    <div class="col-sm-4">
                      <input style=" font-size: 14px;" type="text" class="form-control" id="inputTelefono" name="inputTelefono">
                    </div>
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Correo</label>
                    <div class="col-sm-4">
                      <input style=" font-size: 14px;" type="text" class="form-control" id="inputCorreo" name="inputCorreo">
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Forma de Pago</label>
                    <div class="col-sm-4">
                      <select style=" font-size: 14px;" name="inputFormapago" id="inputFormapago" required class="form-control custom-select" >
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
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Metodo de Pago</label>
                    <div class="col-sm-4">
                      <select style=" font-size: 14px;" name="inputMetodopago" id="inputMetodopago" required class="form-control custom-select" >
                            <option value="">--  Seleccione --</option>
                            <option value="PUE Pago de Una Sola Exhibicion">PUE - Pago de Una Sola Exhibición</option>
                            <option value="PPD Pago en Parcialidades o Diferidos">PPD - Pago en Parcialidades o Diferidos</option>
                          </select>
                    </div>
                  </div>


                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Uso de CFDI</label>
                    <div class="col-sm-4">
                      <select style=" font-size: 14px;" name="inputUsocfdi" id="inputUsocfdi" required class="form-control custom-select" >
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
                   <label for="inputEmail3" class="col-sm-2 col-form-label">Area Solicitante</label>
                          <div class="col-sm-4">
                          <select style=" font-size: 14px;" name="inputSolicita" id="inputSolicita" required class="form-control custom-select" >
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

                 
                 <div class="form-group row" >
                    <label for="inputEmail3" class="col-sm-10 col-form-label" style="text-align:center; background-color: gainsboro;">Movimientos</label>
                    <div class="col-sm-2">
                      <!-- <a href="#"  class="btn btn-success" data-toggle="modal" data-target="#modalEditcliente" style="color:white;" ><i class="fa fa-plus"></i></a> -->
                      
                    </div>
                  </div>

                   <div class="col-sm-12 mb-4">
                          <table id="requisicion" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Cantidad</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Codigo</th>
                               <th style="width:32%; background-color:#e9ecef; text-align: center;">Descripción</th>
                               <th style="width:8%; background-color:#e9ecef; text-align: center;">U. M.</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Marca</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Precio</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;" >Importe</th>
                               <th style="width:10%; background-color:#e9ecef; text-align: center;">Acciones</th>
                            </tr>
                          </thead>
                           <tbody id="detalle_ordencompra">
                               <!---Contenido Ajax--->
                           </tbody>
                           <tfoot>
  <tr>
    <th colspan="6" style="text-align:right">Subtotal:</th>
    <th id="subtotal" style="text-align:right"></th>
    <th></th>
  </tr>
  <tr>
    <th colspan="6" style="text-align:right">IVA (16%):</th>
    <th id="iva" style="text-align:right"></th>
    <th></th>
  </tr>

  <!-- Aquí irán impuestos dinámicos -->
  <tbody id="impuestos_adicionales_footer"></tbody>

  <tr>
    <th colspan="6" style="text-align:right">Total:</th>
    <th id="total" style="text-align:right; font-weight:bold;"></th>
    <th></th>
  </tr>
  <tr>
    <td colspan="8" style="text-align:right;">
      <button id="btnAgregarImpuesto" class="btn btn-sm btn-outline-primary">+ Agregar Impuesto</button>
    </td>
  </tr>
</tfoot>


                          </table>
                     
                      </div>

                  <div class="form-group row" style="text-align:left;">
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Observaciones</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" id="inputNotas" name="inputNotas" rows="1"></textarea>
                    </div>
                  </div>

                  <div class="form-group row" style="text-align:left;" >
                    <label for="inputEmail3" class="col-sm-2 col-form-label">Recibe</label>
                    <div class="col-sm-10">
                      <select class="form-control" style="width: 100%; text-align: left" id="inputRecibe" name="inputRecibe">
                       <!--<?php foreach ($filasrecb as $oprc): //llenar las opciones del primer select ?>-->
                       <option value="Almacén">Almacén</option>
                       <option value="Compras">Compras</option>
                       <!--
                       <option value="<?= $oprc['nombre'] ?>"><?= $oprc['nombre'] ?></option>  
                       <?php endforeach; ?>-->
                    </select>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables CSS y JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  const proveedoresData = <?= json_encode($filasprov, JSON_UNESCAPED_UNICODE); ?>;
</script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const proveedorSelect = document.getElementById("inputProveedor");

    proveedorSelect.addEventListener("change", function () {
      const selectedId = this.value;

      // Busca el proveedor por ID
      const proveedor = proveedoresData.find(p => p.id == selectedId);

      // Si lo encuentra, llena los campos
      if (proveedor) {
        document.getElementById("inputContacto").value = proveedor.contacto || "";
        document.getElementById("inputTelefono").value = proveedor.telefono || "";
        document.getElementById("inputCorreo").value = proveedor.correo || "";
        document.getElementById("inputFormapago").value = proveedor.forma_pago || "";
        document.getElementById("inputMetodopago").value = proveedor.metodo_pago || "";
        document.getElementById("inputUsocfdi").value = proveedor.uso_cfdi || "";
      } else {
        // Si no hay proveedor seleccionado, limpia los campos
        document.getElementById("inputContacto").value = "";
        document.getElementById("inputTelefono").value = "";
        document.getElementById("inputCorreo").value = "";
        document.getElementById("inputFormapago").value = "";
        document.getElementById("inputMetodopago").value = "";
        document.getElementById("inputUsocfdi").value = "";
      }
    });
  });
</script>

<script>
	let impuestosAdicionales = [];

function formatMoney(val) {
  return '$' + val.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

function renderImpuestosAdicionales() {
  const contenedor = $('#impuestos_adicionales_footer');
  contenedor.empty();

  impuestosAdicionales.forEach((imp, idx) => {
    contenedor.append(`
      <tr>
        <th colspan="6" style="text-align:right">${imp.tipo} (${imp.porcentaje}%)</th>
        <th class="impuesto-monto" data-idx="${idx}" style="text-align:right">-</th>
        <th><button class="btn btn-danger btn-sm quitar-imp" data-idx="${idx}">X</button></th>
      </tr>
    `);
  });
}

function recalcularTotales() {
  const api = $('#requisicion').DataTable();
  let subtotal = api.column(6, { page: 'current' }).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0);
  let iva = subtotal * 0.16;
  let total = subtotal + iva;

  impuestosAdicionales.forEach((imp, idx) => {
    const monto = subtotal * (imp.porcentaje / 100);
    total += monto;
    $(`.impuesto-monto[data-idx="${idx}"]`).html(formatMoney(monto));
  });

  $('#subtotal').html(formatMoney(subtotal));
  $('#iva').html(formatMoney(iva));
  $('#total').html(formatMoney(total));
}

$(document).ready(function () {

  // Selector proveedor autocompletado
  $('#inputProveedor').on('change', function () {
    const selectedId = $(this).val();
    const proveedor = proveedoresData.find(p => p.id == selectedId);

    if (proveedor) {
      $('#inputContacto').val(proveedor.contacto || "");
      $('#inputTelefono').val(proveedor.telefono || "");
      $('#inputCorreo').val(proveedor.correo || "");
      $('#inputFormapago').val(proveedor.forma_pago || "");
      $('#inputMetodopago').val(proveedor.metodo_pago || "");
      $('#inputUsocfdi').val(proveedor.uso_cfdi || "");
    } else {
      $('#inputContacto, #inputTelefono, #inputCorreo, #inputFormapago, #inputMetodopago, #inputUsocfdi').val('');
    }
  });

  // Inicializa DataTable
  const table = $('#requisicion').DataTable({
    ajax: {
      url: "data/detalles_requisicion.php",
      type: "POST",
      data: { folio: <?php echo $requisicion; ?> },
      dataSrc: "data"
    },
    columns: [
      { data: "cantidad" },
      { data: "codigo" },
      {
        data: "descripcion",
        render: (data, type, row, meta) => `<input type="text" class="form-control form-control-sm descripcion" data-index="${meta.row}" value="${data}">`
      },
      { data: "unidad_medida" },
      {
        data: "marca",
        render: (data, type, row, meta) => `<input type="text" class="form-control form-control-sm marca" data-index="${meta.row}" value="${data}">`
      },
      {
        data: "precio",
        render: (data, type, row, meta) => `<input type="number" step="0.01" class="form-control form-control-sm precio" data-index="${meta.row}" value="${data}">`
      },
      {
        data: "importe",
        render: $.fn.dataTable.render.number(',', '.', 2, '$')
      },
      {
        data: null,
        orderable: false,
        render: row => `<button class="btn btn-danger btn-sm eliminar" data-id="${row.id}">Eliminar</button>`
      }
    ],
    paging: false,
    info: false,
    searching: false,
    lengthChange: false,
    language: {
      emptyTable: "No hay datos disponibles en la tabla."
    },
    drawCallback: function () {
      recalcularTotales();
    }
  });

  // Escucha cambios en precio para actualizar importe
  $('#requisicion tbody').on('input', '.precio', function () {
    const rowIdx = $(this).data('index');
    const precio = parseFloat($(this).val()) || 0;
    const rowData = table.row(rowIdx).data();

    rowData.precio = precio;
    rowData.importe = rowData.cantidad * precio;
    table.row(rowIdx).data(rowData).invalidate();
    table.draw(false);
  });

  // Agregar impuestos dinámicos
  $('#btnAgregarImpuesto').on('click', function () {
    const tipo = prompt("Nombre del impuesto (Ej. ISR, IEPS, Hospedaje):");
    if (!tipo) return;

    const porcentajeStr = prompt(`¿Qué porcentaje (%) aplica para ${tipo}?`, "0");
    const porcentaje = parseFloat(porcentajeStr);

    if (isNaN(porcentaje) || porcentaje <= 0) {
      alert("Porcentaje no válido.");
      return;
    }

    impuestosAdicionales.push({ tipo, porcentaje });
    renderImpuestosAdicionales();
    recalcularTotales();
  });

  // Eliminar impuesto adicional
  $('#requisicion').on('click', '.quitar-imp', function () {
    const idx = $(this).data('idx');
    impuestosAdicionales.splice(idx, 1);
    renderImpuestosAdicionales();
    recalcularTotales();
  });

  // Enviar datos al guardar
  $('#guardar_tipoactividad').on('click', function (e) {
    e.preventDefault();

    const subtotal = parseFloat($('#subtotal').text().replace(/[$,]/g, '')) || 0;
    const iva = parseFloat($('#iva').text().replace(/[$,]/g, '')) || 0;
    const total = parseFloat($('#total').text().replace(/[$,]/g, '')) || 0;

    const detalle = [];
    table.rows().every(function (rowIdx) {
      const row = this.node();
      detalle.push({
        id: this.data().id,
        cantidad: this.data().cantidad,
        codigo: this.data().codigo,
        descripcion: $(row).find('.descripcion').val(),
        marca: $(row).find('.marca').val(),
        precio: parseFloat($(row).find('.precio').val()) || 0,
        importe: this.data().cantidad * (parseFloat($(row).find('.precio').val()) || 0),
		    unidad_medida: this.data().unidad_medida
      });
    });
    let requisicion = $('#inputReq').val();
    let odc = $('#inputFolio').val();
    let noreq = requisicion.split("-")[1];
    let folio = odc.split("-")[1];
    
    $.ajax({
      url: 'includes/ajax.php',
      type: "POST",
      data: {
        action: 'AlmacenaOrdencompra',
        folio: folio,
        noreq: noreq,
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
      title: "Éxito!",
      text: "ORDEN DE COMPRA ALMACENADA CORRECTAMENTE",
      icon: 'success'
    }).then(() => {
        generarimpformulaPDF(info.folio);
        window.location.href = 'ordenes_compra23.php';
      
    });
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: info.message || 'Ocurrió un error al guardar la orden.'
    });
  }
}

    });
  });
});

</script>
</body>
</html>