<?php
include ("../conexion.php");
session_start();
$user = $_SESSION['user'];
if(!$user) {
    header('Location: ../index.php');
    die();
}

$rol = $_SESSION['rol'];
$allowed = array(1, 4);
if(!in_array($rol, $allowed)) {
    header('Location: ../index.php');
    die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TRANSVIVE | ERP</title>
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon"/>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap4.min.css">

    <!-- AdminLTE Theme -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">

    <!-- SweetAlert -->
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
                <?php include('includes/generalnavbar.php'); ?>
                <?php include('includes/nav.php'); ?>
            </div>
        </nav>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <h4 class="m-0">Uso por <small>Unidad</small></h4>
                        </div>
                        <div class="col-md-6">
							<div class="row">
								<div class="col-3 align-center">
									<label for="semana" class="text-center">Numero de Semana</label>
								</div>
								<div class="col-4">
									<select class="form-control select2bs4" style="text-align: left; margin-bottom: 12px" name="semana" id="semanaSelec" id="nosemana">
										<option value="0">--Selecciona la Semana--</option>
										<?php 
										for($i = 0; $i < 52; $i++) {
											$semanaSelec = $i + 1;
										    echo '<option value="' . $semanaSelec . '">' ."Semana " . $semanaSelec . '</option>';
										}
										?>
									</select>
								</div>
								<div class="col-3">
									<input type="number" name="anio" id="anio" value="2025" placeholder="Selecciona el anio" class="form-control" style="text-align: left; margin-bottom: 12px"/>
								</div>
								<div class="col-2">
									<button id="seleccionaSemana" class="btn btn-success" style="height: 35px">Seleccionar</button>
								</div>
							</div>
							<!-- /.row -->
						</div><!-- /.col -->
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="supervisor" name="supervisor" value="<?php echo $supervisor; ?>">
                    <table id="tableUnidad" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                        <thead>
                            <tr>
                                <th class="text-center">No. Unidad</th>
                                <th class="text-center">Tipo</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>

        <?php include('includes/footer.php'); ?>
    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>

    <!-- DataTables Core -->
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <!-- DataTables Plugins -->
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

    <!-- AdminLTE -->
    <script src="../dist/js/adminlte.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- FontAwesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
	<!-- Sweet Alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- DataTables Initialization -->
    <script>
        // $(document).ready(function() {
        //     const load_data = (semana, anio) => {
        //         const supervisor = $('#supervisor').val();
        //         const ajaxUrl = 'data/usoPorUnidad.php';
        //         //Si no hay datos de semana o anio destruye la tabla y muestra vacia
        //         if(!semana || !anio) {
        //             const table = $('#tableOperador').DataTable();
        //             table.clear().draw(); //Vaciar la tabla
        //             return;
        //         }

        //         let table = $('#tableOperador').DataTable();
        //         table.destroy();
        //         table = $('#tableOperador').DataTable({
        //             responsive: true,
        //             autoWidth: false,
        //             dom: 'Bftrip',
        //             buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
        //             ajax: {
        //                 url: ajaxUrl,
        //                 type: 'POST',
        //                 data: {
        //                     supervisor_id: supervisor,
        //                     semana: semana,
        //                     anio: anio
        //                 },
        //                 dataSrc: function(json) {
        //                     return json.data;
        //                 }
        //             },
        //             columns: [
        //                 {data: 'nounidad'},
        //                 {data: null, render: function(data, type, row) {
        //                     return row.nombres + ' ' + row.apellido_paterno + ' ' + row.apellido_materno;
        //                 }}
        //             ],
        //             language: {
        //                 processing: "Procesando...",
        //                 search: "Buscar:",
        //                 lengthMenu: "Mostrar _MENU_ registros",
        //                 info: "Mostrando de _START_ a _END_ de _TOTAL_ registros",
        //                 infoEmpty: "Mostrando 0 a 0 de 0 registros",
        //                 infoFiltered: "(filtrado de _MAX_ registros totales)",
        //                 loadingRecords: "Cargando...",
        //                 zeroRecords: "No se encontraron resultados",
        //                 emptyTable: "No hay datos disponibles",
        //                 paginate: {
        //                     first: "Primero",
        //                     previous: "Anterior",
        //                     next: "Siguiente",
        //                     last: "Último"
        //                 },
        //                 aria: {
        //                     sortAscending: ": activar para ordenar ascendente",
        //                     sortDescending: ": activar para ordenar descendente"
        //                 }
        //             }
        //         });

        //         c

        //         //Funcion para mostrar el modal de viajes
        //         function mostrarModal(datos) {
        //             console.log(datos);

        //             // Vaciar el contenido del modal sin afectar los encabezados
        //             $('#miModalLabel').text('Asignación Semanal de Viajes');
        //             $('#miModalOperador').text('');
        //             $('#unidad').text('');
        //             // $('#modalSupervisor').text('');
        //             $('#semana').text('');
        //             $('#fecha').text('');
        //             $('.modal-body .contenido-modal').empty(); // Limpiar solo el contenido dinámico

        //             if (!datos.viajes || datos.viajes.length === 0) return;

        //             $('#miModalOperador').text(`Operador: ${datos.viajes[0].operador}`);
        //             $('#unidad').text(`No. Unidad: ${datos.viajes[0].num_unidad}`);
        //             // $('#modalSupervisor').text(`Supervisor: ${datos.supervisor}`);
        //             $('#semana').text(`${datos.viajes[0].semana}`);

        //             let diasSemana = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];

        //             function obtenerRangoSemana(año, semana) {
        //                 // Obtener el primer día del año
        //                 let primerDiaAño = new Date(año, 0, 1); // 1 de enero

        //                 // Obtener el primer lunes del año
        //                 let primerLunes = new Date(primerDiaAño);
        //                 let diaSemana = primerDiaAño.getDay(); // 0 = Domingo, 1 = Lunes, ..., 6 = Sábado
                        
        //                 if (diaSemana !== 1) { // Si no es lunes, ajustar al primer lunes
        //                     let ajuste = diaSemana === 0 ? 1 : 8 - diaSemana;
        //                     primerLunes.setDate(primerDiaAño.getDate() + ajuste);
        //                 }

        //                 // Calcular el lunes de la semana deseada
        //                 let lunesSemana = new Date(primerLunes);
        //                 lunesSemana.setDate(primerLunes.getDate() + (semana - 1) * 7);
        //                 console.log(lunesSemana);

        //                 // Calcular el domingo de la misma semana (sumando 6 días)
        //                 let domingoSemana = new Date(lunesSemana);
        //                 domingoSemana.setDate(lunesSemana.getDate() + 6);

        //                 // Formatear fechas (YYYY-MM-DD)
        //                 let formatoFecha = (fecha) => fecha.toISOString().split('T')[0];
        //                 console.log(formatoFecha(lunesSemana))

        //                 return {
        //                     lunes: formatoFecha(lunesSemana),
        //                     domingo: formatoFecha(domingoSemana)
        //                 };
        //             }

        //             let textoSemana = datos.viajes[0].semana;
        //             let numeroSemana = textoSemana.match(/\d+/)[0]; // Extrae solo el número
        //             console.log(numeroSemana); // "07"

        //             // Si quieres convertirlo en número entero:
        //             let semanaEntero = parseInt(numeroSemana, 10);
        //             let semanaCalculo = semanaEntero - 1;
        //             console.log(semanaCalculo); // 6

        //             let fecha = new Date(datos.viajes[0].fecha); // Ejemplo de fecha
        //             let anioSemana = fecha.getFullYear();
        //             console.log(anioSemana);


        //             let dias = obtenerRangoSemana(anioSemana, semanaCalculo)
        //             console.log(dias)

        //             $('#fecha').text(`DEL ${dias.lunes} AL ${dias.domingo}`);

        //             // Agrupar viajes por cliente, ruta y horario
        //             let viajesAgrupados = {};

        //             datos.viajes.forEach(viaje => {
        //                 let key = `${viaje.cliente}_${viaje.hora_inicio}_${viaje.hora_fin}`;
        //                 if (!viajesAgrupados[key]) {
        //                     viajesAgrupados[key] = {
        //                         cliente: viaje.cliente,
        //                         ruta: viaje.ruta,
        //                         hora_inicio: viaje.hora_inicio,
        //                         hora_fin: viaje.hora_fin,
        //                         dias: {
        //                             Lunes: 'red', Martes: 'red', Miércoles: 'red', Jueves: 'red',
        //                             Viernes: 'red', Sábado: 'red', Domingo: 'red'
        //                         }
        //                     };
        //                 }
        //                 let fechaViaje = new Date(viaje.fecha);
        //                 let dia = diasSemana[fechaViaje.getDay()]; // Obtener el nombre del día
        //                 console.log(dia)
        //                 if (dia) viajesAgrupados[key].dias[dia] = 'green';
        //             });

        //             // Convertir el objeto en un array y ordenar por `hora_fin`
        //             let viajesOrdenados = Object.values(viajesAgrupados).sort((a, b) => {
        //                 return a.hora_inicio.localeCompare(b.hora_inicio); // Ordenar por hora_fin
        //             });

        //             // Construir la tabla de horarios con colores
        //             let tablaHTML = '';
        //             viajesOrdenados.forEach(viaje => {
        //                 tablaHTML += `<div class='row text-center p-2'>
        //                     <div class='col-1 border'>${viaje.cliente}</div>
        //                     <div class='col-1 border'>${viaje.ruta}</div>
        //                     <div class='col-1 border'>${viaje.hora_inicio}</div>
        //                     <div class='col-1 border'>${viaje.hora_fin}</div>
        //                     ${diasSemana.map(dia => `<div class='col-1 border' style='background-color: ${viaje.dias[dia]};'></div>`).join('')}
        //                 </div>`;
        //             });

        //             $('.modal-body .contenido-modal').append(tablaHTML);
        //             $('#miModal').modal('show');
        //         }
        //     }
        //     load_data();
            
        //     $('#seleccionaSemana').on('click', function() {
        //         console.log('Click');
        //         const semana = $('#semanaSelec').val();
        //         const anio = $('#anio').val();
        //         if(validarDatos(semana, anio)) {
        //             load_data(semana, anio)
        //         }
        //     })

        //     $('#miModal').on('hidden.bs.modal', function () {
        //         console.log('Modal cerrado, reseteando selección.');
        //         $('#semanaSelec').val('0'); // Restablece la selección
        //         $('#anio').val('2025'); // Restablece el año por defecto
        //     });

        //     const validarDatos = (semana, anio) => {
        //         if(semana <= 0 || semana > 52) {
        //             alert('Seleccione una semana valida');
        //             return false;
        //         }
        //         if(anio < 2000) {
        //             alert('Seleccione una fecha correcta')
        //             return false;
        //         }
        //         return true;
        //     }
            
        // })
    </script>

    <script>
        $(document).ready(function() {
            load_data("", ""); // Llama a la función con valores vacíos por defecto

            function load_data(semana = "", anio = "") {
                let ajax_url = 'data/usoPorUnidad.php';
                console.log(semana, anio); // ✅ Verifica los valores recibidos

                $('#tableUnidad').DataTable({
                    destroy: true,  // ✅ Agrega esto para evitar duplicados en DataTable
                    responsive: true,
                    autoWidth: false,
                    dom: 'Bftrip',
                    buttons: ['copy', 'excel', 'csv', 'pdf', 'print'],
                    ajax: {
                        url: ajax_url,
                        type: 'POST',
                        data: {
                            semana: semana,
                            anio: anio
                        },
                        dataSrc: function(json) {
                            console.log("Respuesta JSON recibida:", json); // ✅ Verifica la respuesta en consola
                            if (json.error) {
                                alert(json.error); // Muestra un mensaje si hay error
                                return [];
                            }
                            return json.data;
                        }
                    },
                    columns: [
                        { data: 'no_unidad', class: "text-center" },
                        { data: 'tipo', class: "text-center" }
                    ],
                    language: {
                        processing: "Procesando...",
                        search: "Buscar:",
                        lengthMenu: "Mostrar _MENU_ registros",
                        info: "Mostrando de _START_ a _END_ de _TOTAL_ registros",
                        infoEmpty: "Mostrando 0 a 0 de 0 registros",
                        infoFiltered: "(filtrado de _MAX_ registros totales)",
                        loadingRecords: "Cargando...",
                        zeroRecords: "No se encontraron resultados",
                        emptyTable: "No hay datos disponibles",
                        paginate: {
                            first: "Primero",
                            previous: "Anterior",
                            next: "Siguiente",
                            last: "Último"
                        },
                        aria: {
                            sortAscending: ": activar para ordenar ascendente",
                            sortDescending: ": activar para ordenar descendente"
                        }
                    }
                });

                $(document).on('click', '#tableUnidad tbody tr', function(e) {
                    const table = $('#tableUnidad').DataTable();
                    const rowData = table.row(this).data();

                    let fechaActual = new Date();
                    let semanaActual = obtenerSemana(fechaActual);

                    //Llamar Ajax para obtener datos de unidad y semana
                    cargardatosUnidad(rowData.no_unidad, semanaActual);
                })

                function obtenerSemana(fecha) {
                    let primerDiaAnio = new Date(fecha.getFullYear(), 0, 1);
                    let diferencia = fecha - primerDiaAnio;
                    let dias = Math.floor(diferencia / (1000 * 60 * 60 * 24));
                    return Math.ceil((dias + primerDiaAnio.getDay() + 1) / 7);
                }

                function cargardatosUnidad(noUnidad, semana) {
                    $.ajax({
                        url: 'data/usoPorUnidadDetalle.php',
                        type: 'POST',
                        data: {no_unidad: noUnidad, semana: semana },
                        dataType: 'json',
                        success: function(response) {
                            $('#miModalLabel').text(`Uso por unidad semana: ${semana}`);
                            $('#numUnidad').text(`No. Unidad: ${response.no_unidad}`);
                            $('#unidad').text(`Tipo: ${response.tipo}`);
                            $('#semana').text(`Semana: ${response.semana}`);
                            $('#fecha').text(`Del ${response.fecha_inicio} al ${response.fecha_fin}`);

                            let dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];
                            $('.modal-content .row.text-center.p-2:not(:first)').each(function(index) {
                                $(this).find('.col.text-center:nth-child(2)').text(response.datos[dias[index]].vueltas);
                                $(this).find('.col.text-center:nth-child(3').text(response.datos[dias[index]].uso + '%');
                            });

                            $('#miModal').modal('show');
                        }
                    })
                }
                
                $('#seleccionaSemana').on('click', function() {
                    console.log('Click');
                    const semana = $('#semanaSelec').val();
                    const anio = $('#anio').val();
                    if(validarDatos(semana, anio)) {
                        load_data(semana, anio)
                    }
                })
                
                const validarDatos = (semana, anio) => {
                    if(semana <= 0 || semana > 52) {
                        alert('Seleccione una semana valida');
                        return false;
                    }
                    if(anio < 2000) {
                        alert('Seleccione una fecha correcta')
                        return false;
                    }
                    return true;
                }

                // Funcion para cambiar de semana
                $(document).on('click', '#semanaAnterior, #semanasiguiente', function() {
                    let semana = parseInt($('#semana').text().replace('Semana: ', ''));
                    semana += $(this).attr('id') === 'semanaAnterior' ? -1 : 1;

                    let nounidad = $('#numUnidad').text(replace('No. Unidad: ', ''));
                    cargardatosUnidad(nounidad, semana);
                })

                function mostrarModal(rowData) {
                    console.log(rowData);
                    $('#miModalLabel').text('Uso por unidad semanal');
                    $('#numUnidad').text(`No. Unidad: ${rowData.no_unidad}`);
                    $('#unidad').text(`Tipo: ${rowData.tipo}`);
                    $('#miModal').modal('show');
                }
            }
        });
    </script>

    <div class="modal fade" id="miModal" tabindex="-1" role="dialog" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center d-block" id="miModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row text-center mt-3">
                    <div class="col">
                        <button class="btn-primary" id="semanaAnterior">Semana Anterior</button>
                        <button class="btn-primary" id="semanaSiguiente">Semana Siguiente</button>
                    </div>
                </div>
                <div class="row text-center">
                    <div class="col-8 text-left pl-4" id="numUnidad"></div>
                    <div class="col-4" id="unidad"></div>
                </div>
                <div class="row text-center">
                    <div class="col-5 text-left pl-4" id="unidad"></div>
                    <div class="col-3" id="semana"></div>
                    <div class="col-3" id="fecha"></div>
                </div>
                <!-- Encabezado de la tabla -->
                <div class="row text-center p-2">
                    <div class="col text-center fw-bold">Dia</div>
                    <div class="col text-center fw-bold">Num. de vueltas</div>
                    <div class="col text-center fw-bold">% Uso Diario</div>
                </div>
                <div class="row text-center p-2">
                    <div class="col text-center">Lunes</div>
                    <div class="col text-center">0</div>
                    <div class="col text-center">0%</div>
                </div>
                <div class="row text-center p-2">
                    <div class="col text-center">Martes</div>
                    <div class="col text-center">0</div>
                    <div class="col text-center">0%</div>
                </div>
                <div class="row text-center p-2">
                    <div class="col text-center">Miercoles</div>
                    <div class="col text-center">0</div>
                    <div class="col text-center">0%</div>
                </div>
                <div class="row text-center p-2">
                    <div class="col text-center">Jueves</div>
                    <div class="col text-center">0</div>
                    <div class="col text-center">0%</div>
                </div>
                <div class="row text-center p-2">
                    <div class="col text-center">Viernes</div>
                    <div class="col text-center">0</div>
                    <div class="col text-center">0%</div>
                </div>
                <div class="row text-center p-2">
                    <div class="col text-center">Sabado</div>
                    <div class="col text-center">0</div>
                    <div class="col text-center">0%</div>
                </div>
                <div class="row text-center p-2">
                    <div class="col text-center">Domingo</div>
                    <div class="col text-center">0</div>
                    <div class="col text-center">0%</div>
                </div>
            </div>
        </div>
    </div>

	<script>
		$(document).ready(function () {
			$('#btnGenerales').on('click', function () {
				$('#generales').show();
				$('#caracteristicas').hide();
				$(this).addClass('active');
				$('#btnCaracteristicas').removeClass('active');
			});
	
			$('#btnCaracteristicas').on('click', function () {
				$('#generales').hide();
				$('#caracteristicas').show();
				$(this).addClass('active');
				$('#btnGenerales').removeClass('active');
			});
		});
	</script>

	</body>
</html>				