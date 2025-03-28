<style>
  .search-bar {
    padding-top: 10px;
    display: flex;
    align-items: center;
    max-width: 180px;
    margin: auto;
  }

  .search-bar input {
    border-radius: 0.25rem;
    border: 1px solid #ced4da;
    box-shadow: none;
    height: 30px;
  }

  .search-bar button {
    border-radius: 0 0.25rem 0.25rem 0;
    height: 30px;
    border: 1px solid #ced4da;
    border-left: none;
    background-color: #0a6ed1;
    color: white;
    cursor: pointer;
  }

  .search-bar button:hover {
    background-color: #0056b3;
  }

  .search-bar .form-control:focus {
    box-shadow: none;
    border-color: #0a6ed1;
  }
</style>
<div class="collapse navbar-collapse order-3" id="navbarCollapse">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a href="index.php" class="nav-link">Home</a>
    </li>
    <li class="nav-item dropdown">
      <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Movimientos</a>
      <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        <li><a href="viajes23.php" class="dropdown-item">Registro de Viaje </a></li>
        <li><a href="viajesOperador.php" class="dropdown-item">Viajes por Operador </a></li>
        <li><a href="alertas.php" class="dropdown-item">Registro de Alertas </a></li>
        <li><a href="orden_trabajo23.php" class="dropdown-item">Orden de Trabajo de Mantenimiento</a></li>
        <li><a href="mantenimiento_preventivo.php" class="dropdown-item">O. de Trabajo de Mantenimiento Preventivo</a></li>
        <!--<li><a href="#" class="dropdown-item">Equipo</a></li>-->
        <!--<li><a href="#" class="dropdown-item">Solicitud de Servicio</a></li>-->
        <li><a href="carga_combustible23.php" class="dropdown-item">Carga de Combustible</a></li>
        <li class="dropdown-divider"></li>
        <li><a href="viajes_especiales23.php" class="dropdown-item">Orden de Servicio Especial/Turístico</a></li>
        <li class="dropdown-divider"></li>
        <li><a href="geo_viajes.php" class="dropdown-item">Geolocalizacion viajes</a></li>
        <!--<li><a href="compose.php" class="dropdown-item">Enviar Correo</a></li>
              <li class="dropdown-divider"></li>
              <li><a href="clientes.php" class="dropdown-item">Clientes</a></li>-->
        <li class="dropdown-divider"></li>

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Ventas</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="prospectos.php" class="dropdown-item">Prospectos</a></li>
            <li><a href="cotizaciones_venta.php" class="dropdown-item">Cotizacion al Cliente</a></li>
            <li><a href="ordenes_servicio.php" class="dropdown-item">Orden de Servicio por Contrato</a></li>
            <li><a href="solicitud_credito.php" class="dropdown-item">Solicitud de Credito</a></li>
            <li><a href="propiedades_cp.php" class="dropdown-item">Propiedades del Cliente o Proveedor</a></li>
            <li><a href="formato_noventa.php" class="dropdown-item">Formato No Venta</a></li>
          </ul>
        </li>

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Compras</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="requisiciones23.php" class="dropdown-item">Requisición</a></li>
            <li><a href="ordenes_compra23.php" class="dropdown-item">Orden de Compra</a></li>
            <li><a href="compras23.php" class="dropdown-item">Compra</a></li>
            <li class="dropdown-divider"></li>
            
          </ul>
        </li>
        <!--
                  <li><a href="pagos_proveedor.php" class="dropdown-item">Pago a Proveedor</a></li>
                  <li class="dropdown-divider"></li>
                  <li><a href="devolucion_compra.php" class="dropdown-item">Devolución sobre Compra</a></li>
                -->
            <!--<li class="dropdown-divider"></li>
                  <li><a href="evaluacion_proveedores.php" class="dropdown-item">Evaluación de Proveedores</a></li>-->
        <!--
               <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Proveedores</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  
                 <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Abonos</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">-->
        <!--
                  <li><a href="carga_planeacion.php" class="dropdown-item">Pago al Proveedor</a></li>-->
        <!--<li><a href="carga_alertas.php" class="dropdown-item">Nota de Credito del Proveedor</a></li>-->
        <!--  
                </ul>
              </li>-->
        <!--
              <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Cargo</a>
                <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                  
                  <li><a href="carga_planeacion.php" class="dropdown-item">Cargo del Proveedor</a></li>
                  <li><a href="carga_alertas.php" class="dropdown-item">Saldo Inicial del Proveedor</a></li>
                  
                </ul>
              </li>-->
        <!--
                </ul>
              </li> -->

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Inventarios</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="entrada_almacen.php" class="dropdown-item">Entrada</a></li>
            <li><a href="salida_almacen.php" class="dropdown-item">Salida</a></li>
            <!--<li><a href="#" class="dropdown-item">Transpaso</a></li>-->
          </ul>
        </li>


        <li class="dropdown-divider"></li>
        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Utilerias</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="carga_planeacion.php" class="dropdown-item">Carga de Planeación</a></li>
            <li class="dropdown-divider"></li>
            <li><a href="carga_alertas.php" class="dropdown-item">Carga de Alertas</a></li>
            <li><a href="subir_cargacombustible.php" class="dropdown-item">Carga de Registros Combustible</a></li>
            <li class="dropdown-divider"></li>
            <li><a href="cancelamultiple_especiales.php" class="dropdown-item">Cancela Multiples Servicios Especiales</a></li>

          </ul>
        </li>


        <!-- End Level two -->
      </ul>
    </li>

    <li class="nav-item dropdown">
      <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reportes</a>
      <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        <!--
              <li><a href="#" class="dropdown-item">Mantenimientos </a></li>
              <li><a href="rep_servicios.php" class="dropdown-item">Servicios</a></li>
              -->
        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Nominas</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="rep_consentradonom.php" class="dropdown-item">Concentrado</a></li>
            <li><a href="reprecibos_nomina.php" class="dropdown-item">Recibo de Nomina</a></li>
            <li><a href="rep_detalladonomina.php" class="dropdown-item">Detallado</a></li>
            <li class="dropdown-divider"></li>
            <li><a href="repcaja_ahorro.php" class="dropdown-item">Caja de Ahorro</a></li>
            <li><a href="detallado_cajaahorro.php" class="dropdown-item">detallado Caja de Ahorro</a></li>
            <li><a href="rep_adeudos.php" class="dropdown-item">Adeudos</a></li>
            <!--<li><a href="detallado_prestamos.php" class="dropdown-item">Detallado Adeudos</a></li>-->
            <li class="dropdown-divider"></li>
            <li><a href="contrato_individual.php" class="dropdown-item">Contrato Eventual</a></li>
            <li><a href="contrato_confidencial.php" class="dropdown-item">Contrato de Confidencialidad</a></li>
            <li class="dropdown-divider"></li>
            <li><a href="factura/rporte_bajas.php" class="dropdown-item" TARGET="_BLANK">Reporte de Bajas</a></li>
            <li><a href="factura/rporte_bajasexcel.php" class="dropdown-item" TARGET="_BLANK">Reporte de Bajas Excel</a></li>

          </ul>
        </li>

        <li class="dropdown-divider"></li>
        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Calidad</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">



            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Satisfaccion</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

                <li><a href="factura/detallado_encsatisfaccionew.php" target="_blank" class="dropdown-item">Detallado Encuesta Satisfacción</a></li>
                <li><a href="factura/encuesta_calidadexcel.php" target="_blank" class="dropdown-item">Encuesta Satisfacción Excel</a></li>
                <!--<li><a href="analisis_encuestasatisf.php" class="dropdown-item">Análisis Encuesta Satisfacción</a></li>-->

              </ul>
            </li>

            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Calidad</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

                <li><a href="factura/detallado_encsatisfaccion.php" target="_blank" class="dropdown-item">Detallado Encuesta Satisfacción (anterior)</a></li>

                <li><a href="factura/detallado_enccalidad.php" target="_blank" class="dropdown-item">Detallado Encuesta Calidad</a></li>

              </ul>
            </li>


          </ul>
        </li>
        <li><a href="#" class="dropdown-item" style="color:#F1F8F9;">_______________________________</a></li>

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Orden de Servicio Especial</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="viajes_especialesxfechas.php" class="dropdown-item">Ordenes de Servicio por Fecha</a></li>

            <li><a href="viajes_especialesxperiodos.php" class="dropdown-item">Ordenes de Servicio por Periodo</a></li>


          </ul>
        </li>

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Viajes</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="viajes_clientesxdia.php" class="dropdown-item"> Viajes Cliente x Día</a></li>
            <li><a href="viajes_clientesxsemana.php" class="dropdown-item"> Viajes Cliente x Semana</a></li>
            <li><a href="viajes_planeadosvsreg.php" class="dropdown-item"> Viajes Planeados vs Registrados</a></li>
            <li><a href="grafica_plaeadosvsregistrados.php" class="dropdown-item"> Grafica Planeados vs Registrados (Sem)</a></li>
            <li><a href="grafica_plavsregyear.php" class="dropdown-item"> Grafica Planeados vs Registrados (Anual)</a></li>
            <li><a href="viajes_normalesxperiodos.php" class="dropdown-item">Viajes por Periodo</a></li>
            <li><a href="viajes_todosxperiodos.php" class="dropdown-item">Viajes por Periodo (Todos)</a></li>
            <li><a href="viajes_porfecha.php" class="dropdown-item">Viajes por Fecha</a></li>

          </ul>
        </li>


        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Combustibles</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="combustible_fechas.php" class="dropdown-item">Consumo por Fechas</a></li>
            <li><a href="combustible_rendimiento.php" class="dropdown-item">Rendimiento x Unidad</a></li>


          </ul>
        </li>

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Ventas</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="noventa_fechas.php" class="dropdown-item">Formato de No Venta</a></li>
          </ul>
        </li>

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Compras</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <li><a href="reporte_saldoprov.php" class="dropdown-item">Estado de cuenta proveedor</a></li>
          </ul>
        </li>


        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Inventarios</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="resumen_existencia.php" class="dropdown-item">Resumen Existencias</a></li>
            <li><a href="inventario_actual.php" class="dropdown-item">Inventario Actual</a></li>


          </ul>
        </li>

        <!-- End Level two -->
      </ul>
    </li>

    <li class="nav-item dropdown">
      <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Recursos Humanos</a>
      <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        <li><a href="nominas.php" class="dropdown-item">Nomina Semanal</a></li>
        <li><a href="nominas2025.php" class="dropdown-item">Nomina</a></li>
        <li><a href="nominas_quincenales.php" class="dropdown-item">Nomina Quincenal</a></li>
        <!--<li><a href="nominas_especiales.php" class="dropdown-item">Nomina Especial</a></li>-->
        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Nomina Especial</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <!--<li><a href="actualiza_sueldos.php" class="dropdown-item">Actualiza Sueldos Vuetas</a></li>-->

            <li><a href="nominas_especiales.php" class="dropdown-item">Aguinaldo</a></li>
            <!--<li><a href="#" class="dropdown-item">Caja de Ahorro</a></li>-->

          </ul>
        </li>
        <!--<li><a href="prestamos.php" class="dropdown-item">Prestamos</a></li>-->

        <li><a href="adeudos.php" class="dropdown-item">Adeudos</a></li>
        <li><a href="incidencias.php" class="dropdown-item">Incidencias</a></li>
        <li><a href="finiquitos.php" class="dropdown-item">Finiquitos</a></li>
        <li class="dropdown-divider"></li>
        <li><a href="requisicion_personal.php" class="dropdown-item">Requisicion de Personal</a></li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Utilerias</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <!--<li><a href="actualiza_sueldos.php" class="dropdown-item">Actualiza Sueldos Vuetas</a></li>-->

            <li><a href="carga_importesfiscal.php" class="dropdown-item">Actualiza Importes Fiscales</a></li>
            <!--<li><a href="#" class="dropdown-item">Actualiza Importes Fiscales (Aguinaldo)</a></li> -->
            <li><a href="aumento_sueldo.php" class="dropdown-item">(%) Aumento Sueldos</a></li>



          </ul>
        </li>

        <!-- End Level two -->
      </ul>
    </li>


    <li class="nav-item dropdown">
      <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Calidad</a>


      <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">


        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Encuestas</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">


            <li><a href="encuesta_satisfaccion.php" class="dropdown-item">Satisfaccion de Clientes </a></li>
            <li><a href="../../transvive_eambientel/" target="_blank" class="dropdown-item">Encuesta Ambiente Laboral</a></li>
            <li class="dropdown-divider"></li>
            <li><a href="grafica_encuestamesprom.php" class="dropdown-item">Grafica Promedio Mensual</a></li>
            <li><a href="grafica_encuestames.php" class="dropdown-item">Grafica Concepto Mensual</a></li>
            <li class="dropdown-divider"></li>
            <li><a href="grafica_encuestatrimprom.php" class="dropdown-item">Grafica Promedio Trimestral</a></li>

          </ul>
        </li>

        <li><a href="no_conformidades.php" class="dropdown-item">Quejas - No Conformidades</a></li>

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Graficas</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Unidad</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="grafica_unidad.php" class="dropdown-item">Mensual </a></li>

                <li><a href="grafica_unidadmes.php" class="dropdown-item">Mensual por unidad</a></li>
              </ul>
            </li>

            <li class="dropdown-divider"></li>
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Motivos</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="grafica_motivos.php" class="dropdown-item">Motivos por Mes </a></li>

                <li><a href="grafica_motivosmes.php" class="dropdown-item">Mensual por motivo </a></li>
              </ul>
            </li>

            <li class="dropdown-divider"></li>
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Clientes</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="grafica_clientesmes.php" class="dropdown-item">Mensual </a></li>
                <li><a href="grafica_clientesmesint.php" class="dropdown-item">Mensual (Motivo Interno) </a></li>
                <li><a href="grafica_clientesmesext.php" class="dropdown-item">Mensual (Motivo Externo) </a></li>
              </ul>
            </li>

            <li class="dropdown-divider"></li>
            <li><a href="grafica_motivoie.php" class="dropdown-item">Grafica Mes(Motivo I/E) </a></li>

            <li class="dropdown-divider"></li>
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Responsable</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="grafica_responsable.php" class="dropdown-item">Mensual </a></li>
                <li><a href="grafica_responsableint.php" class="dropdown-item">Mensual (Interno) </a></li>
                <li><a href="grafica_responsableext.php" class="dropdown-item">Mensual (Externo) </a></li>
              </ul>
            </li>

            <li class="dropdown-divider"></li>
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Operador</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="grafica_operador.php" class="dropdown-item">Mensual </a></li>
                <li><a href="grafica_operadorint.php" class="dropdown-item">Mensual (Interno) </a></li>
                <li><a href="grafica_operadorext.php" class="dropdown-item">Mensual (Externo) </a></li>
              </ul>
            </li>

            <li class="dropdown-divider"></li>
            <li class="dropdown-submenu dropdown-hover">
              <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Supervisor</a>
              <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                <li><a href="grafica_supervisor.php" class="dropdown-item">Mensual </a></li>
                <li><a href="grafica_supervisorint.php" class="dropdown-item">Mensual (Interno) </a></li>
                <li><a href="grafica_supervisorext.php" class="dropdown-item">Mensual (Externo) </a></li>
              </ul>
            </li>


          </ul>
        </li>

        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">ISO 9000</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">


            <li><a href="evalua_proveproductos.php" class="dropdown-item">Evaluación Proveedores (Productos) </a></li>
            <li><a href="evalua_provemetrologia.php" class="dropdown-item">Evaluación Proveedores (Metrología)</a></li>
            <li><a href="evalua_proveservicios.php" class="dropdown-item">Evaluación de Proveedores (Servicios)</a></li>

            <li class="dropdown-divider"></li>

          </ul>
        </li>


        <!-- End Level two -->
      </ul>
    </li>

    <li class="nav-item dropdown">
      <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Configuracion</a>
      <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
        <!--<li><a href="#" class="dropdown-item">Ajustes </a></li>
              <li><a href="#" class="dropdown-item">Equipo de Ventas</a></li>-->
        <!--<li><a href="actividades.php" class="dropdown-item">Tipo de Actividades</a></li>-->
        <li><a href="usuarios.php" class="dropdown-item">Usuarios</a></li>
        <li><a href="perfil_empresa.php" class="dropdown-item">Perfil Empresa</a></li>

        <li class="dropdown-divider"></li>

        <!-- Level two dropdown-->
        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Catalogos</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="empleados.php" class="dropdown-item">Empleados Activos</a></li>
            <li><a href="empleadosBajas.php" class="dropdown-item">Empleados Bajas</a></li>
            <li><a href="cargos_puestos.php" class="dropdown-item">Cargos (Puestos)</a></li>
            <li><a href="supervisores.php" class="dropdown-item">Supervisores</a></li>
            <li><a href="clientes.php" class="dropdown-item">Clientes</a></li>
            <li><a href="proveedores.php" class="dropdown-item">Proveedores</a></li>
            <li><a href="unidades.php" class="dropdown-item">Unidades</a></li>
            <!--<li><a href="unidades_tcp.php" class="dropdown-item">Unidades TC Personales</a></li>-->
            <li><a href="gasolineras.php" class="dropdown-item">Gasolineras</a></li>
            <li><a href="rutas.php" class="dropdown-item">Rutas</a></li>
            <li><a href="routers.php" class="dropdown-item">Routers</a></li>
            <li class="dropdown-divider"></li>
            <li><a href="almacenes.php" class="dropdown-item">Almacenes</a></li>
            <li><a href="refacciones.php" class="dropdown-item">Refacciones/Articulos</a></li>
            <li><a href="unidades_medida.php" class="dropdown-item">Unidades de Medida</a></li>
          </ul>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Folios</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="folio_ordenmantto.php" class="dropdown-item">O. Trabajo de Mantenimiento</a></li>

            <li><a href="folio_cotizaventa.php" class="dropdown-item">Cotizacion de Venta</a></li>

            <li><a href="folio_ordenservicio.php" class="dropdown-item">Orden de Servicio</a></li>

            <li><a href="folio_cargacombustible.php" class="dropdown-item">Carga Combustible</a></li>

            <li><a href="folio_requisicion.php" class="dropdown-item">Requisición</a></li>

            <li><a href="folio_ordencompra.php" class="dropdown-item">Orden de Compra</a></li>

            <li><a href="folio_compra.php" class="dropdown-item">Compra</a></li>

            <!--<li><a href="unidades_tcp.php" class="dropdown-item">Unidades TC Personales</a></li>-->

          </ul>
        </li>
        <li class="dropdown-divider"></li>
        <li class="dropdown-submenu dropdown-hover">
          <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Procesos</a>
          <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

            <li><a href="borra_planeacion.php" class="dropdown-item">Borra Planeacion</a></li>
            <li><a href="borra_cargaalertas.php" class="dropdown-item">Borra Carga Alertas</a></li>
            <li><a href="borra_cargacombustible.php" class="dropdown-item">Borra Carga Combustible</a></li>
            <li class="dropdown-divider"></li>
            <li><a href="cierre_ejercicio.php" class="dropdown-item">Cierre de Ejercicio</a></li>
            <li><a href="respaldo_base.php" class="dropdown-item">Respaldo Base de Datos</a></li>
            <li><a href="respaldo_baselocal.php" class="dropdown-item">Respaldo Base de Datos (Local)</a></li>


            <!--<li><a href="unidades_tcp.php" class="dropdown-item">Unidades TC Personales</a></li>-->

          </ul>
        </li>


        <!-- End Level two -->
      </ul>
    </li>
  </ul>

  <!-- SEARCH FORM -->

  <div class="search-bar mb-4">
    <input class="form-control" type="text" id="searchInput" placeholder="Search" aria-label="Search">
    <button class="btn" type="button" id="searchBtn">
      <i class="fas fa-search"></i>
    </button>
  </div>

</div>