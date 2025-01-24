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
    <ul class="navbar-nav">
        <li class="nav-item">
            <a href="index_ventas.php" class="nav-link">Home</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Movimientos</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="viajes_especiales23.php" class="dropdown-item">Orden de Servicio Especial/Turístico</a></li>
                <li class="dropdown-submenu dropdown-hover">
                <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Ventas</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">

                        <li><a href="cotizaciones_venta.php" class="dropdown-item">Cotizacion al Cliente</a></li>
                        <li><a href="ordenes_servicio.php" class="dropdown-item">Orden de Servicio por Contrato</a></li>
                        <li><a href="solicitud_credito.php" class="dropdown-item">Solicitud de Credito</a></li>
                        <li><a href="propiedades_cp.php" class="dropdown-item">Propiedades del Cliente o Proveedor</a></li>
                        <li><a href="formato_noventa.php" class="dropdown-item">Formato No Venta</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Reportes</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
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
                <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Ventas</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li><a href="noventa_fechas.php" class="dropdown-item">Formato de No Venta</a></li>
                    </ul>
                </li>
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

        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Configuracion</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow"
                <li><a href="perfil_empresa.php" class="dropdown-item">Perfil Empresa</a></li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Catalogos</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li><a href="clientes.php" class="dropdown-item">Clientes</a></li>
                        <li><a href="unidades.php" class="dropdown-item">Unidades</a></li>
                        <li><a href="rutas.php" class="dropdown-item">Rutas</a></li>
                        <li><a href="routers.php" class="dropdown-item">Routers</a></li>
                    </ul>
                </li>
                <li class="dropdown-divider"></li>
                <li class="dropdown-submenu dropdown-hover">
                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Folios</a>
                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                        <li><a href="folio_cotizaventa.php" class="dropdown-item">Cotizacion de Venta</a></li>
                        <li><a href="folio_ordenservicio.php" class="dropdown-item">Orden de Servicio</a></li>
                    </ul>
                </li>
            </ul>   
        </li>
    </ul>


  <div class="search-bar mb-4">
    <input class="form-control" type="text" id="searchInput" placeholder="Search" aria-label="Search">
    <button class="btn" type="button" id="searchBtn">
      <i class="fas fa-search"></i>
    </button>
  </div>

</div>