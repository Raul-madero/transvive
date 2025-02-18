<?php

include "../../conexion.php";
session_start();

//*Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaCliente')
{
    if(!empty($_POST['nocte']) || !empty($_POST['namecte']) )
    {     
        $nocte        = $_POST['nocte'];
        $namecte      = $_POST['namecte'];
        $callenum     = $_POST['callenum'];
        $colonia      = $_POST['colonia'];
        $ciudad       = $_POST['ciudad'];
        $municipio    = $_POST['municipio'];
        $estado       = $_POST['estado'];
        $codpostal    = $_POST['codpostal'];
        $pais         = $_POST['pais'];
        $phone        = $_POST['phone'];
        $cont_rh      = $_POST['contactorh'];
        $email_rh     = $_POST['correorh'];
        $giro         = $_POST['giro'];
        $phonecontac  = $_POST['phonecontac']; 
        $servicio     = $_POST['servicio'];
        $sitioweb     = $_POST['sitioweb'];
        $tipocontrato = $_POST['tipocontrato'];
        $fechaini     = $_POST['dateinic'];
        $fechafin     = $_POST['datefinc'];
        $razonsoc     = $_POST['razonsoc'];
        $rfccte       = $_POST['rfccte'];
        $formapago    = $_POST['formapago'];
        $metodopago   = $_POST['metodopago'];
        $usocfdi      = $_POST['usocfdi'];
        $cont_conta   = $_POST['contactocont'];
        $email_conta  = $_POST['emailconta'];
        $credito      = $_POST['credito'];
        $condicionesc = $_POST['condicionesc'];
        $supervisor   = $_POST['supervisor'];

        if ($supervisor > 0) {
            $idsuperv = $supervisor;
        }else {
            $idsuperv = 0;
        }

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_cliente($nocte, '$namecte', '$callenum', '$colonia', '$ciudad', '$municipio', '$estado', '$codpostal', '$pais', '$phone', '$cont_rh', '$email_rh', '$giro', '$phonecontac', '$servicio', '$sitioweb', '$tipocontrato', '$fechaini', '$fechafin', '$razonsoc', '$rfccte', '$formapago', '$metodopago', '$usocfdi', '$cont_conta', '$email_conta', '$credito', '$condicionesc', $idsuperv, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
    
    }else{
        echo 'error';
    }
    exit;
}



//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaMotivo')
{
    if(!empty($_POST['motivo']) )
    {
        $motivo      = $_POST['motivo'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_motivo('$motivo', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaTipoActividad')
{
    if(!empty($_POST['tipo_actividad']) || !empty($_POST['planificacion']) || !empty($_POST['time_planificacion']))
    {
        $tipo_actividad      = $_POST['tipo_actividad'];
        $planificacion       = $_POST['planificacion'];
        $time_planificacion  = $_POST['time_planificacion'];
        $plantilla           = $_POST['plantilla'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_tipoactividad('$tipo_actividad', $planificacion, '$time_planificacion', '$plantilla', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaCategoria')
{
    if(!empty($_POST['categoria']) )
    {
        $categoria   = $_POST['categoria'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_categoria('$categoria', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaTarea')
{
    if(!empty($_POST['titulo']) || !empty($_POST['tipo']) || !empty($_POST['prioridad'])
    || !empty($_POST['fechaven']) )
    {

        $titulo      = $_POST['titulo'];
        $tipo        = $_POST['tipo'];
        $cliente     = $_POST['cliente'];
        $prioridad   = $_POST['prioridad'];
        $fcha_venc   = $_POST['fechaven'];
        $notas       = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_tarea('$titulo', '$tipo', '$cliente',
        '$prioridad', '$fcha_venc', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
 
}

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditTarea')
{
    if(!empty($_POST['titulo']) || !empty($_POST['tipo']) || !empty($_POST['prioridad'])
    || !empty($_POST['fechaven']) )
    {

        $Idtarea     = $_POST['Idtarea'];
        $titulo      = $_POST['titulo'];
        $tipo        = $_POST['tipo'];
        $cliente     = $_POST['cliente'];
        $prioridad   = $_POST['prioridad'];
        $fcha_venc   = $_POST['fechaven'];
        $notas       = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_edittarea($Idtarea, '$titulo', '$tipo', '$cliente',
        '$prioridad', '$fcha_venc', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
 
}



//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaMiActividad')
{
    if(!empty($_POST['titulo']) || !empty($_POST['etapa']) )
    {
        
        $titulo       = $_POST['titulo'];
        $ingreso      = $_POST['ingreso'];
        $probabilidad = $_POST['probabilidad'];
        $cliente      = $_POST['cliente'];
        $cierre       = $_POST['cierre'];
        $categoria    = $_POST['categoria'];
        $etapa        = $_POST['etapa'];
        $notas       = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_miactividad('$titulo', '$ingreso', '$probabilidad',
        $cliente, '$cierre', '$categoria', '$etapa', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
 
}

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditMiActividad')
{
    if(!empty($_POST['titulo']) || !empty($_POST['etapa']) )
    {
        
        $idact        = $_POST['id_act'];
        $titulo       = $_POST['titulo'];
        $ingreso      = $_POST['ingreso'];
        $probabilidad = $_POST['probabilidad'];
        $cliente      = $_POST['cliente'];
        $cierre       = $_POST['cierre'];
        $categoria    = $_POST['categoria'];
        $etapa        = $_POST['etapa'];
        $notas       = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editmiactividad($idact, '$titulo', '$ingreso', '$probabilidad',
        $cliente, '$cierre', '$categoria', '$etapa', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
 
}


// borrar MiActividad
if($_POST['action'] == 'infoBorraMiActividad')
		{
			$noid = $_POST['Id'];

			$query_prov = mysqli_query($conection,"UPDATE actividades SET status = 0 WHERE id = $noid");
			mysqli_close($conection);
			$result_prov = mysqli_num_rows($query_prov);
			if($result_prov > 0){
				$data_prov = mysqli_fetch_assoc($query_prov);
				echo json_encode($data_prov,JSON_UNESCAPED_UNICODE);
				exit;
			}
			echo 'error';
			exit;
		}
        
// borrar Tarea
        if($_POST['action'] == 'infoBorraTarea')
                {
                    $noid = $_POST['empleadoId'];
        
                    $query_prov = mysqli_query($conection,"UPDATE tareas SET estado = 0 WHERE id = $noid");
                    mysqli_close($conection);
                    $result_prov = mysqli_num_rows($query_prov);
                    if($result_prov > 0){
                        $data_prov = mysqli_fetch_assoc($query_prov);
                        echo json_encode($data_prov,JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                    echo 'error';
                    exit;
                }  
                
    //Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaUsuario')
{
    if(!empty($_POST['name']) || !empty($_POST['usuario']) || !empty($_POST['passw']) || !empty($_POST['rol']) )
    {
        
        $name    = $_POST['name'];
        $mail    = $_POST['mail'];
        $user    = $_POST['usuario'];
        $passw   = md5($_POST['passw']);
        $rol     = $_POST['rol'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_usuario('$name', '$mail', '$user', '$passw', $rol, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
 
}   

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditUsuario')
{
    if(!empty($_POST['name']) || !empty($_POST['usuario']) || !empty($_POST['passw']) || !empty($_POST['rol']) )
    {
        
        $Id    = $_POST['Id'];
        $name    = $_POST['name'];
        $mail    = $_POST['mail'];
        $user    = $_POST['usuario'];
        $passw   = md5($_POST['passw']);
        $rol     = $_POST['rol'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

       $query_procesar = mysqli_query($conection,"CALL procesar_editusuario($Id, '$name', '$mail', '$user', '$passw', $rol, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
 
}  

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditTipoActividad')
{
    if(!empty($_POST['tipo_actividad']) || !empty($_POST['planificacion']) || !empty($_POST['time_planificacion']))
    {
        $Id                  = $_POST['Id'];
        $tipo_actividad      = $_POST['tipo_actividad'];
        $planificacion       = $_POST['planificacion'];
        $time_planificacion  = $_POST['time_planificacion'];
        $plantilla           = $_POST['plantilla'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_edittipoactividad($Id, '$tipo_actividad', $planificacion, '$time_planificacion', '$plantilla', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditCategoria')
{
    if(!empty($_POST['categoria']) )
    {
        $Id          = $_POST['Id'];
        $categoria   = $_POST['categoria'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editcategoria($Id, '$categoria', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditMotivo')
{
    if(!empty($_POST['motivo']) )
    {
        $Id      = $_POST['Id'];
        $motivo      = $_POST['motivo'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editmotivo($Id, '$motivo', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Agregar Productos a Entrada
if($_POST['action'] == 'RegistraPerdida')
{
   
        $Id      = $_POST['Id'];
        $motivo      = $_POST['motivo'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_motivoperdida($Id, '$motivo', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  
}

/* Almacena Supervisor */

//
if($_POST['action'] == 'AlmacenaSupervisor')
{
    if(!empty($_POST['nombres']) || !empty($_POST['paterno']) || !empty($_POST['materno']))
    {
        $nombres    = $_POST['nombres'];
        $paterno    = $_POST['paterno'];
        $materno    = $_POST['materno'];
        $phone      = $_POST['phone'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_supervisor('$nombres', '$paterno', '$materno', '$phone', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Almacenar nuevo adeudo
if ($_POST['action'] == 'AlmacenaAdeudo') {
    if (
        isset($_POST['noempleado']) && is_numeric($_POST['noempleado']) &&
        isset($_POST['cantidad']) && is_numeric($_POST['cantidad']) &&
        !empty($_POST['motivo_adeudo'])
    ) {

        // Sanitización de datos
        $cantidad = floatval($_POST['cantidad']);
        $noempleado = intval($_POST['noempleado']);
        $motivo_adeudo = mysqli_real_escape_string($conection, $_POST['motivo_adeudo']);
        $estado = isset($_POST['estado']) ? intval($_POST['estado']) : 0;
        $fecha_inicial = mysqli_real_escape_string($conection, $_POST['fecha_inicial']);
        $descuento = isset($_POST['descuento']) ? floatval($_POST['descuento']) : 0.0;
        $comentarios = mysqli_real_escape_string($conection, $_POST['comentarios']);
        $semanas_totales = intval($_POST['semanas_totales']);
        $fecha_final = mysqli_real_escape_string($conection, $_POST['fecha_final']);

        // Iniciar Transacción
        mysqli_begin_transaction($conection);

        try {
            // Verificar si el empleado ya tiene un adeudo
            $query_buscar_adeudo = "SELECT cantidad FROM adeudos WHERE noempleado = ?";
            $stmt = mysqli_prepare($conection, $query_buscar_adeudo);
            mysqli_stmt_bind_param($stmt, "i", $noempleado);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            if ($row) {
                // Si ya existe un adeudo, actualizar cantidad
                $query_actualizar_adeudo = "UPDATE adeudos SET cantidad = cantidad + ?, descuento = ? WHERE noempleado = ?";
                $stmt = mysqli_prepare($conection, $query_actualizar_adeudo);
                mysqli_stmt_bind_param($stmt, "dii", $cantidad, $descuento, $noempleado);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            } else {
                // Si no existe, insertar un nuevo adeudo
                $query_insertar_adeudo = "INSERT INTO adeudos (cantidad, comentarios, descuento, estado, fecha_inicial, motivo_adeudo, noempleado, semanas_totales, fecha_final) 
                                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conection, $query_insertar_adeudo);
                mysqli_stmt_bind_param($stmt, "dssisssis", $cantidad, $comentarios, $descuento, $estado, $fecha_inicial, $motivo_adeudo, $noempleado, $semanas_totales, $fecha_final);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            }

            // Insertar el detalle del adeudo
            $query_insertar_detalle = "INSERT INTO detalle_adeudos (cantidad, comentarios, descuento, estado, fecha_inicial, motivo_adeudo, noempleado, semanas_totales, fecha_final) 
                                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conection, $query_insertar_detalle);
            mysqli_stmt_bind_param($stmt, "dssisssis", $cantidad, $comentarios, $descuento, $estado, $fecha_inicial, $motivo_adeudo, $noempleado, $semanas_totales, $fecha_final);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            // Si todo salió bien, confirmar la transacción
            mysqli_commit($conection);
            echo json_encode(["mensaje" => "Adeudo almacenado correctamente."], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            // Si hubo un error, revertir los cambios
            mysqli_rollback($conection);
            echo json_encode(["mensaje" => "Error al almacenar el adeudo: " . $e->getMessage()], JSON_UNESCAPED_UNICODE);
        }

        // Cerrar conexión
        mysqli_close($conection);
        exit;
    } else {
        echo json_encode(["mensaje" => "Datos inválidos o incompletos recibidos."], JSON_UNESCAPED_UNICODE);
    }
}

//Agregar Productos a Entrada
if ($_POST['action'] == 'AlmacenaEmpleado') {
    if (!empty($_POST['name']) && !empty($_POST['paterno']) && !empty($_POST['materno'])) {
        // include "../conexion.php";

        // Validación y limpieza de datos
        $noempleado   = (int) $_POST['noempleado'];
        $name         = mysqli_real_escape_string($conection, $_POST['name']);
        $paterno      = mysqli_real_escape_string($conection, $_POST['paterno']);
        $materno      = mysqli_real_escape_string($conection, $_POST['materno']);
        $cargo        = mysqli_real_escape_string($conection, $_POST['cargo']);
        $telefono     = !empty($_POST['telefono']) ? "'" . mysqli_real_escape_string($conection, $_POST['telefono']) . "'" : "NULL";
        $rfc          = mysqli_real_escape_string($conection, $_POST['rfccte']);
        $unidad       = mysqli_real_escape_string($conection, $_POST['unidad']);
        $nounidad     = mysqli_real_escape_string($conection, $_POST['nounidad']);
        $tipo_lic     = mysqli_real_escape_string($conection, $_POST['tipo_lic']);
        $nolicencia   = mysqli_real_escape_string($conection, $_POST['nolicencia']);
        $fecha_vence  = !empty($_POST['fvencimiento']) ? "'" . $_POST['fvencimiento'] . "'" : "NULL";
        $supervisor   = mysqli_real_escape_string($conection, $_POST['supervisor']);
        $tipocontrato = mysqli_real_escape_string($conection, $_POST['tipocontrato']);
        $contrato     = !empty($_POST['fcontrato']) ? "'" . $_POST['fcontrato'] . "'" : "NULL";
        $fincontrato  = !empty($_POST['vencontrato']) ? "'" . $_POST['vencontrato'] . "'" : "NULL";

        // Números decimales y enteros (convertir explícitamente)
        $imss         = (float) $_POST['imss'];
        $salariodia   = (float) $_POST['salariodia'];
        $sueldobase   = (float) $_POST['sueldobase'];
        $sueldo       = (float) $_POST['sueldo'];
        $sueldob2     = (float) $_POST['sueldob2'];
        $vdgmv        = (float) $_POST['vdgmv'];
        $vdgao        = (float) $_POST['vdgao'];
        $sprinter     = (float) $_POST['sprinter'];
        $sauto        = (float) $_POST['sueldo_auto'];
        $ssemi        = (float) $_POST['ssemi'];
        $deuda        = (float) $_POST['deuda'];
        $descuento    = (float) $_POST['descuento'];
        $adeudo       = (float) $_POST['adeudo'];
        $saldo_adeudo = (float) $_POST['saldo_adeudo'];
        $bono         = (float) $_POST['bonos'];
        $bonoc2       = (float) $_POST['bonosc2'];
        $bonosemana   = (float) $_POST['bonosemanal'];
        $apoyomes     = (float) $_POST['apoyomes'];
        $vales        = (float) $_POST['vales'];
        $caja         = (float) $_POST['caja'];
        $vacaciones   = (float) $_POST['vacaciones'];
        $efectivo     = (float) $_POST['efectivo'];
        $desc_fiscal  = (float) $_POST['descfiscal'];
        $salxdia      = (float) $_POST['salxdia'];
        $sueldoauto   = (float) $_POST['sueldoauto'];
        $sdosprinter  = (float) $_POST['sdosprinter'];

        // Cadenas opcionales
        $clasificacat = mysqli_real_escape_string($conection, $_POST['clasificacat']);
        $sexo         = mysqli_real_escape_string($conection, $_POST['sexo']);
        $fechanac     = !empty($_POST['fechanac']) ? "'" . $_POST['fechanac'] . "'" : "NULL";
        $edad         = (int) $_POST['edad'];
        $edocivil     = mysqli_real_escape_string($conection, $_POST['edocivil']);
        $domicilio    = mysqli_real_escape_string($conection, $_POST['domicilio']);
        $estudios     = mysqli_real_escape_string($conection, $_POST['estudios']);
        $contactoe    = mysqli_real_escape_string($conection, $_POST['contactoe']);
        $elcurp       = mysqli_real_escape_string($conection, $_POST['elcurp']);
        $fchaaltaimss = !empty($_POST['fchaaltaimss']) ? "'" . $_POST['fchaaltaimss'] . "'" : "NULL";
        $noss         = mysqli_real_escape_string($conection, $_POST['noss']);
        $comentarios  = mysqli_real_escape_string($conection, $_POST['comentarios']);
        $tipo_nomina  = mysqli_real_escape_string($conection, $_POST['tipo_nomina']);

        // Datos de sesión
        $usuario = $_SESSION['idUser'];

        // Llamada al procedimiento almacenado
        $query_procesar = mysqli_query($conection, "CALL procesar_empleado(
            $noempleado, '$name', '$paterno', '$materno', '$cargo', $telefono, '$rfc', '$unidad', '$nounidad',
            '$tipo_lic', '$nolicencia', $fecha_vence, '$supervisor', '$tipocontrato', $contrato, $fincontrato,
            $imss, $salariodia, $sueldobase, $sueldo, $sueldob2, $vdgmv, $vdgao, $sprinter, $sauto, $ssemi,
            $deuda, $descuento, $adeudo, $saldo_adeudo, $bono, '$clasificacat', $bonoc2, $bonosemana, $apoyomes,
            $vales, $caja, $vacaciones, $efectivo, '$tipo_nomina', $desc_fiscal, '$sexo', $fechanac, $edad,
            '$edocivil', '$domicilio', '$estudios', '$contactoe', '$elcurp', $fchaaltaimss, '$noss', $salxdia,
            $sueldoauto, $sdosprinter, '$comentarios', $usuario
        )");

        // Verificar errores en la consulta
        if (!$query_procesar) {
            die("Error en el procedimiento almacenado: " . mysqli_error($conection));
        }

        // Procesar resultados del procedimiento almacenado
        $result_detalle = mysqli_num_rows($query_procesar);
        if ($result_detalle > 0) {
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data, JSON_UNESCAPED_UNICODE);
        } else {
            echo "error";
        }

        mysqli_close($conection);
    } else {
        echo 'error: campos obligatorios vacíos.';
    }
    exit;
}


//Almacena Unidad Nueva
if($_POST['action'] == 'AlmacenaUnidad')
{
    if(!empty($_POST['nounidad']) || !empty($_POST['nplacas']) || !empty($_POST['tipogas']) )
    {
        $nounidad  = $_POST['nounidad'];
        $socio     = $_POST['socio'];
        $describe  = $_POST['descripcion'];
        $nplacas   = $_POST['nplacas'];
        $nserie    = $_POST['nserie'];
        $year      = $_POST['year'];
        $tipogas   = $_POST['tipogas'];
        $nopoliza   = $_POST['nopoliza'];
        $asegurador = $_POST['aseguradora'];
        $iniciapol  = $_POST['iniciapol'];
        $terminapol = $_POST['terminapol'];
        $notarjeta  = $_POST['notarjeta'];
        $vencetar   = $_POST['vencetarjeta'];
        $entregad   = $_POST['entregadoc'];
        $parametro  = $_POST['parametro'];
        $notas      = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
        
      
        $query_procesar = mysqli_query($conection,"CALL procesar_unidad('$nounidad', '$socio', '$describe', '$nplacas', '$nserie', $year, '$tipogas', '$nopoliza', '$asegurador', '$iniciapol', '$terminapol', '$notarjeta', '$vencetar', '$entregad', $parametro, '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


//Agregar Productos a Entrada.
if($_POST['action'] == 'AlmacenaViaje')

{
    if(!empty($_POST['fecha']) || !empty($_POST['semana']) || !empty($_POST['cliente'])
    || !empty($_POST['ruta']) || !empty($_POST['tipo']) || !empty($_POST['horarios']) )
    {
        if ($_POST['cliente'] == "Select" ) {
           echo "error";
        }else {
            if ($_POST['operador'] == "Select") {
                echo "error";
            }else {
                if ($_POST['ruta'] == "") {
                    echo "error";
                }else {
                    if ($_POST['tipo'] == "Select") {
                        echo "error";
                    }else {
                        if ($_POST['noeco'] == "Select") {
                            echo "error";
                        }else {
                            if ($_POST['horarios'] == "") {
                               echo "error";
                            }else {
                                if ($_POST['sueldo_vta'] == 0) {
                                     echo "error";
                                }else {

        $fecha        = $_POST['fecha'];
        $semana       = $_POST['semana'];
        $cliente      = $_POST['cliente'];
        $ruta         = $_POST['ruta'];
        $operador     = $_POST['operador'];
        $tipo         = $_POST['tipo'];
        $tipo_viaje   = $_POST['tipoviaje'];
        $nounidad     = $_POST['noeco'];
        $nopersonas   = $_POST['nopersonas'];
        $horarios     = implode(', ', $_POST['horarios']);
        $turno        = $_POST['turno'];
        $tipovuelta   = $_POST['tipovuelta'];
        $sueldovuelta = $_POST['sueldo_vta'];
        $supervisor   = $_POST['supervisor'];
        //$horafin     = $_POST['horafin'];
        //$destino     = $_POST['destino'];
        $notas       = $_POST['notas']; 

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL procesar_viaje('$fecha', '$semana', '$cliente', '$ruta', '$operador', '$tipo', '$tipo_viaje', '$nounidad', $nopersonas, '$horarios', '$turno', $tipovuelta, $sueldovuelta, $supervisor, '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
     }
     }
     }
     }
     }
     } 
     }
    }else{
        echo 'error';
    }
    exit;
 
}

// ***** Agrega participantes minutas //
    
    if($_POST['action'] == 'ActualizaNomina'){

            if(empty($_POST['semana']) )
            {
                echo "error";
            }else { 
                $semana     = $_POST['semana'];
            
                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL procesa_semprueba('$semana')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $arrayData = array();
                $fila = 0;

                if($result > 0){


                while ($data = mysqli_fetch_assoc($query_control)){
                       // $fila = $fila + 1;
                       // $tot_especiales = $data['viajes_especiales'] * $data['sueldo_especial'];
                       // $tot_contrato = $data['viajes_contrato'] * $data['sueldo_contrato'];
                       // $tot_deducciones = $data['deducciones'] + $data['otras_deducciones'] + $data['caja_ahorro'];   
                        
                        $detalleTabla .= '<tr>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_nomsem('.$data['id'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                            <td style="text-align:right; font-size: 12px;" >'.$data['no_semana'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['no_empleado'].'</td>
                                            
                                            <td style="font-size: 12px;">'.$data['nombre'].'</td>
                                            <td style="font-size: 12px;">'.$data['cargo'].'</td>
                                            <td style="font-size: 12px;">'.$data['imss'].'</td>
                                            <td style="font-size: 12px;">'.$data['estatus'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['sueldo_base'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['viajes_especiales'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['viajes_contrato'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['bono_categoria'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['bono_supervisor'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['bono_semanal'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['apoyo_mensual'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['total_especiales'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['sueldo_adicional'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['prima_vacacional'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['total_vueltas'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['sueldo_bruto'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['pago_fiscal'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['deduccion_fiscal'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['descuento_adeudo'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['caja'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['total_nomina'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['total_general'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['no_empleado'].'</td>

                                            <td align="center"><a id="alumno" 
                                                data-target="#modalIndicador" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nosem="'.$data['no_semana'].'" 
                                                data-noempl="'.$data['no_empleado'].'"
                                                data-name="'.$data['nombre'].'"
                                                data-dias="'.$data['dias_vacaciones'].'"
                                                data-cargo="'.$data['deduccion_fiscal'].'"
                                                data-imss="'.$data['vacaciones'].'"
                                                data-vesp="'.$data['prima_vacacional'].'"
                                                data-totnom="'.$data['total_nomina'].'"
                                                data-totgral="'.$data['total_general'].'"
                                                
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                $arrayData['detalle'] = $detalleTabla;
                
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }
            exit;   
            }
        }


// Cerrar Nomina
        if($_POST['action'] == 'CerrarNomina')
                {
                    $semana = $_POST['semana'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL cerrar_nomina('$semana', '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                } 


// Autoriza Nomina
        if($_POST['action'] == 'AutorizaNomina')
                {
                    $semana = $_POST['semana'];

                    $token  = md5($_SESSION['idUser']);
        
                    $query_busca = mysqli_query($conection,"SELECT count(*) as numeroreg from semanas where semana = '$semana' and autorizada = 1 ");
                    $result_busca = mysqli_num_rows($query_busca);
                     while ($data = mysqli_fetch_assoc($query_busca)){
                     $revisa = $data['numeroreg'];
                     }   
                
                if($revisa == 0){

        
                    $query_procesarcf = mysqli_query($conection,"CALL autoizar_nomina('$semana', '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                } else { 
                    echo "error";
                }    
                }                

// Envio Encueta

//Envio encuesta Satisfaccion de Cliente
        if($_POST['action'] == 'enviarEncuesta'){

        if(empty($_POST['fecha']) )
            {
                echo 'error';
            }else{

                $fecha    = $_POST['fecha'];
                $asunto   = utf8_decode($_POST['asunto']);
                $mensaje  = utf8_decode($_POST['mensaje']);
                $token    = md5($_SESSION['idUser']);

            
                $query_envios = mysqli_query($conection,"SELECT id, codigo, razon_social, correo FROM clientes_encuestatemp where token = '$token'");
                $result = mysqli_num_rows($query_envios);

                if($result > 0) {               
                $totalcorreos  = 0;
                $arrayData  = array();

                require '../PHPMailer/PHPMailerAutoload.php';

                while ($data = mysqli_fetch_assoc($query_envios)){ 
                    $enviomail  = $data['correo'];
                    $nombremail = $data['razon_social'];
                    $totalcorreos = $totalcorreos + 1;

                $msjdelbody=utf8_decode($mensaje)."\r\n". 'De antemano, Gracias'."\r\n"."\r\n".'liga:'.' '.'https://dasha-web.com/transvive_crm/'."\r\n"."\r\n".'Transvive.'."\r\n".'Tel: (33) 3016220'."\r\n".'Hidalgo #30, C.P. 45640 Col. Los Gavilanes'."\r\n". 'Tlajomulco de Zuñiga, Jal.'."\r\n".'Departamento de ventas';
                

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                //*$mail->Host = 'smtp.office365.com';
                //**$mail->Host = 'smtp.gmail.com';
                //**$mail->Port = 587;
                $mail->Host = 'smtp.hostinger.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'informes@dasha-web.com';
                $mail->Password = 'CHE_ito73';
                $mail->setFrom('informes@dasha-web.com', 'Software Transvive ERP');
                //$mail->SMTPAuth = true;
                //$mail->Username = 'rog_diaz@hotmail.com';
                //$mail->Password = 'CHE_ito73';
                //*$mail->setFrom('sistemasqualy@hotmail.com', 'Software TEXTILERP QUALY ');
                //*$mail->Username = 'textilerp.software@gmail.com';
                //*$mail->Password = 'yscxrwfshwcttrkd';
                //*$mail->setFrom('textilerp.software@gmail.com', 'CRM Transvive ');
                $mail->addReplyTo('calidad@transvivegdl.com.mx', 'Encuesta Enviada');
                $mail->addAddress($enviomail,utf8_decode($nombremail));
                //$mail->addAddress('rogelio73diaz@gmail.com','Rogelio Diaz');
                $mail->addCC('calidad@transvivegdl.com.mx');
                $mail->addCC('ejecutivo@transvivegdl.com.mx');
                $mail->addCC('rogelio73diaz@gmail.com');

                $mail->Subject = $asunto;
                $mail->Body = utf8_decode($msjdelbody);
                $mail->addAttachment('test.txt');
                $mail->send();

                }
                $query_procesarencuesta = mysqli_query($conection,"CALL procesar_encuesta('$fecha', 'enviada', '$totalcorreos')");
                $result_procesarencuesta = mysqli_num_rows($query_procesarencuesta);
                
                if($result_procesarencuesta > 0){
                  $data = mysqli_fetch_assoc($query_procesarencuesta);
                  echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else {
                  echo "error 1"; 
                }  
                
                }else{
                    echo "error 2";
                }
            
            }

        }

//Envio encuesta de Calidad
        if($_POST['action'] == 'enviarEncuestaCalidad'){

        if(empty($_POST['fecha']) || empty($_POST['asunto']) )
            {
                echo 'error';
            }else{

                $fecha    = $_POST['fecha'];
                $asunto   = utf8_decode($_POST['asunto']);
                $mensaje  = utf8_decode($_POST['mensaje']);
                

                $query_envios = mysqli_query($conection,"SELECT * FROM clientes_encuestatemp");
                $result = mysqli_num_rows($query_envios);

                if($result > 0) {               
                $totalcorreos  = 0;
                $arrayData  = array();

                require '../PHPMailer/PHPMailerAutoload.php';

                while ($data = mysqli_fetch_assoc($query_envios)){ 
                    $enviomail  = $data['correo'];
                    $nombremail = $data['razon_social'];
                    $totalcorreos = $totalcorreos + 1;

                $msjdelbody=$mensaje."\r\n"."\r\n".'liga:'.' '.'https://dasha-web.com/transvive_crm/calidad.php'."\r\n"."\r\n".'Transvive.'."\r\n".'Tel: (33) 3016220'."\r\n".'Hidalgo #100, C.P. 45640 Col. Los Gavilanes'."\r\n". 'Tlajomulco de Zuñiga, Jal.'."\r\n".'Departamento de Aseguramiento de Calidad';
                

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                //*$mail->Host = 'smtp.office365.com';
                //**$mail->Host = 'smtp.gmail.com';
                //**$mail->Port = 587;
                $mail->Host = 'smtp.office365.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'rog_diaz@hotmail.com';
                $mail->Password = 'CHE_ito73';
                $mail->setFrom('rog_diaz@hotmail.com', 'Software Transvive ERP');
                //$mail->SMTPAuth = true;
                //$mail->Username = 'rog_diaz@hotmail.com';
                //$mail->Password = 'CHE_ito73';
                //*$mail->setFrom('sistemasqualy@hotmail.com', 'Software TEXTILERP QUALY ');
                //*$mail->Username = 'textilerp.software@gmail.com';
                //*$mail->Password = 'yscxrwfshwcttrkd';
                //*$mail->setFrom('textilerp.software@gmail.com', 'CRM Transvive ');
                //$mail->addReplyTo('rogelio73diaz@gmail.com', 'prueba');
                $mail->addAddress($enviomail,$nombremail);
                //$mail->addAddress('rogelio73diaz@gmail.com','Rogelio Diaz');
                //$mail->addCC('mesacontrol@cqualy.com');
                //$mail->addCC('calidad.qualy@cqualy.com');
                //$mail->addCC('rogelio73diaz@gmail.com');

                $mail->Subject = $asunto;
                $mail->Body = $msjdelbody;
                $mail->addAttachment('test.txt');
                $mail->send();

                }
                $query_procesarencuesta = mysqli_query($conection,"CALL procesar_encuesta('$fecha', 'enviada', '$totalcorreos')");
                $result_procesarencuesta = mysqli_num_rows($query_procesarencuesta);
                
                if($result_procesarencuesta > 0){
                  $data = mysqli_fetch_assoc($query_procesarencuesta);
                  echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else {
                  echo "error 2"; 
                }  
                
                }else{
                    echo "error 3";
                }
            
            }

        }        

    //Agregar Productos a Entrada
    if($_POST['action'] == 'AlmacenaEditEmpleado')
    {
        if(!empty($_POST['name']) || !empty($_POST['paterno']) || !empty($_POST['materno']) )
        {
            $id           = $_POST['Id'];
            $noempleado   = $_POST['noempleado'];
            $name         = $_POST['name'];
            $paterno      = $_POST['paterno'];
            $materno      = $_POST['materno'];
            $cargo        = $_POST['cargo'];
            $telefono     = $_POST['telefono'];
            $rfc          = $_POST['rfccte'];
            $unidad       = $_POST['unidad'];
            $nounidad     = $_POST['nounidad'];
            $tipo_lic     = $_POST['tipo_lic'];
            $nolicencia   = $_POST['nolicencia'];
            $supervisor   = $_POST['supervisor'];
            $tipocontrato = $_POST['tipocontrato'];
            $imss         = $_POST['imss'];
            $salariodia   = $_POST['salariodia'];
            $sueldobase   = $_POST['sueldobase'];
            $sueldo       = $_POST['sueldo'];
            $sueldob2     = $_POST['sueldob2'];
            $vdgmv        = $_POST['vdgmv'];
            $vdgao        = $_POST['vdgao'];
            $sprinter     = $_POST['sprinter'];
            $sauto        = $_POST['sueldo_auto'];
            $ssemi        = $_POST['ssemi'];
            $deuda        = $_POST['deuda'];
            $descuento    = $_POST['descuento'];
            $adeudo       = $_POST['adeudo'];
            $saldo_adeudo = $_POST['saldo_adeudo'];
            $bono         = $_POST['bonos'];
            $clasif_cat   = $_POST['clasif_cat'];
            $bonoc2       = $_POST['bonosc2'];
            $bonosemanal  = $_POST['bonosemanal'];
            $apoyomes     = $_POST['apoyomes'];
            $vales        = $_POST['vales'];
            $caja         = $_POST['caja'];
            $vacaciones   = $_POST['vacaciones'];
            $efectivo     = $_POST['efectivo'];
            $descfiscal   = $_POST['descefectivo'];
            $tipo_nomina  = $_POST['tipo_nomina'];
            $sexo         = $_POST['sexo'];
            $fechanac     = $_POST['fechanac'];
            $edad         = $_POST['edad'];
            $edocivil     = $_POST['edocivil']; 
            $domicilio    = $_POST['domicilio'];
            $estudios     = $_POST['estudios'];
            $contactoe    = $_POST['contactoe'];
            $elcurp       = $_POST['elcurp'];
            $noss         = $_POST['noss'];
            $salarioxdia  = $_POST['salarioxdia'];
            $sueldoauto   = $_POST['sueldoauto'];
            $sdosprinter  = $_POST['sdosprinter'];
            $es_recontrata = $_POST['es_recontrata'];
            $recontratable = $_POST['recontratable'];
            $comentarios   = $_POST['comentarios'];

            $datebaja      = !empty($_POST['datebaja']) ? $_POST['datebaja'] : '0000-00-00';
            $datereingreso = !empty($_POST['datereingreso']) ? $_POST['datereingreso'] : '0000-00-00';
            $fecha_vence  = !empty($_POST['fvencimiento']) ? $_POST['fvencimiento'] : '0000-00-00';
            $contrato     = !empty($_POST['fcontrato']) ? $_POST['fcontrato'] : '0000-00-00';
            $fincontrato  = !empty($_POST['vencontrato']) ? $_POST['vencontrato'] : '0000-00-00';
            $fchaaltaimss = !empty($_POST['fchaaltaimss']) ? $_POST['fchaaltaimss'] : '0000-00-00';
            
            
            $token       = md5($_SESSION['idUser']);
            $usuario     = $_SESSION['idUser'];
            // var_dump($_POST);

            $sql_editar_empleado = "CALL procesar_editempleado($id, $noempleado, '$name', '$paterno', '$materno', '$cargo', '$telefono', '$rfc', '$unidad', '$nounidad', '$tipo_lic', '$nolicencia', '$fecha_vence', '$supervisor', '$tipocontrato', '$contrato', '$fincontrato', '$imss', $salariodia, $sueldobase, $sueldo, $sueldob2, $vdgmv, $vdgao, $sprinter, $sauto, $ssemi, $deuda, $descuento, $adeudo, $saldo_adeudo, $bono, '$clasif_cat', $bonoc2, $bonosemanal, $apoyomes, $vales, $caja, $vacaciones, $efectivo, $descfiscal, '$tipo_nomina', '$sexo', '$fechanac', $edad, '$edocivil', '$domicilio', '$estudios', '$contactoe', '$elcurp', '$fchaaltaimss', '$noss', $salarioxdia, $sueldoauto, $sdosprinter, '$es_recontrata', '$recontratable', '$comentarios', '$datebaja', '$datereingreso', $usuario)";

            // echo "Consulta: " . $sql_editar_empleado . "\n";

            $query_editar_empleado = mysqli_query($conection, $sql_editar_empleado);

            if (!$query_editar_empleado) {
                echo "Error en la consulta: " . mysqli_error($conection);
                exit;
            }

            $result_detalle = mysqli_affected_rows($conection);
            
            if($result_detalle > 0){
                    $data = mysqli_fetch_assoc($query_editar_empleado);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                echo json_encode(array('error' => 'Error en la consulta'));
            }
        
        mysqli_close($conection);
    
        }else{
            echo json_encode(array('error' => 'Por favor complete todos los campos'));
        }
        exit;
    } 


// ***** Agrega participantes minutas //
    
    if($_POST['action'] == 'ActualizaDetallerouter'){

            if(empty($_POST['folio'])  )
            {
                echo "error";
            }else { 
                $folio       = $_POST['folio'];
                $hturno1     = $_POST['hturno1'];
                $hturno2     = $_POST['hturno2'];
                $hturno3     = $_POST['hturno3'];
                $parada      = $_POST['parada'];
                $referencia  = $_POST['referencia'];
                $nuparadas   = $_POST['numparadas'];
            
                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL add_detallerouter($folio, '$hturno1', '$hturno2', '$hturno3', '$parada', '$referencia', $nuparadas, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $arrayData = array();
                $fila = 0;

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                        $fila = $fila + 1;
                        
                        $detalleTabla .= '<tr>
                                            <td>'.$data['horario_t1'].'</td>
                                            <td>'.$data['horario_t2'].'</td>
                                            <td>'.$data['horario_t3'].'</td>
                                            <td>'.$data['parada'].'</td>
                                            <td>'.$data['referencia'].'</td>
                                            <td>'.$data['no_paradas'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); delete_detarouter('.$data['id'].','.$data['folio'].');"><i class="fas fa-ban"></i></a>
                                            </td>
                                        </tr>';
                    }

                $arrayData['detalle'] = $detalleTabla;
                
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }
            exit;   
            }
        }
    
    
    //***** // 

    //****************************//
        //Canclar control
        if($_POST['action'] == 'procesarSalirRouter'){

                          
                $norecibo  = $_POST['norecibo'];
                $token       = md5($_SESSION['idUser']);
                $usuario     = $_SESSION['idUser'];

                $query_procesarcf = mysqli_query($conection,"CALL salir_router($norecibo, '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
            
            } 

    //***** //
    if($_POST['action'] == 'removeDetalleEditRouter'){

            if(empty($_POST['id_partida']))
            {
                echo 'error';
            }else{
                $idaccion = $_POST['id_partida'];
                $folio    = $_POST['folio'];
                $token      = md5($_SESSION['idUser']);


                $query_borraccion = mysqli_query($conection,"CALL borra_detalleeditrouter($idaccion, $folio, '$token')");
                $result = mysqli_num_rows($query_borraccion);

                $fila = 0;
                $detalleTablaDel = '';
                
                $arrayData = array();
                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_borraccion)){
                        $fila = $fila + 1;
                        $detalleTablaDel .= '<tr>
                                            <td>'.$data['horario_t1'].'</td>
                                            <td>'.$data['horario_t2'].'</td>
                                            <td>'.$data['horario_t3'].'</td>
                                            <td>'.$data['parada'].'</td>
                                            <td>'.$data['referencia'].'</td>
                                            <td>'.$data['no_paradas'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); delete_detarouter('.$data['id'].','.$data['folio'].');"><i class="fas fa-ban"></i></a>
                                            </td>
                                        </tr>';
                    }

                $arrayData['detalle'] = $detalleTablaDel;
                
                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   

            }else{
                echo 'error';
            }   
                
            }
        
            exit;
        }            

     //****************************//
        //Canclar control
        if($_POST['action'] == 'procesarSalirAlerta'){

                          
                $norecibo  = $_POST['norecibo'];
                $token       = md5($_SESSION['idUser']);
                $usuario     = $_SESSION['idUser'];

                $query_procesarcf = mysqli_query($conection,"CALL salir_alerta($norecibo, '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
            
            } 

    //***** //


   //Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaAlerta')
{
    if(!empty($_POST['semana']) || !empty($_POST['unidad']) || !empty($_POST['operador']) || !empty($_POST['velocidad']) || !empty($_POST['limite']) )
    {
        $semana     = $_POST['semana'];
        $unidad     = $_POST['unidad'];
        $operador   = $_POST['operador'];
        $alertas    = $_POST['alertas'];
        $velocidad  = $_POST['velocidad'];
        $limite     = $_POST['limite'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_alerta('$semana', '$unidad', '$operador', $alertas, '$velocidad', '$limite', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

 //Almacena Edicion de Alerta
if($_POST['action'] == 'AlmacenaEditAlerta')
{
    if(!empty($_POST['semana']) || !empty($_POST['unidad']) || !empty($_POST['operador']) || !empty($_POST['velocidad']) || !empty($_POST['limite']) )
    {
        $ida        = $_POST['Ida'];
        $semana     = $_POST['semana'];
        $unidad     = $_POST['unidad'];
        $operador   = $_POST['operador'];
        $alertas    = $_POST['alertas'];
        $velocidad  = $_POST['velocidad'];
        $limite     = $_POST['limite'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editalerta($ida, '$semana', '$unidad', '$operador', $alertas, '$velocidad', '$limite', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


// ***** Agrega participantes minutas //
    
    if($_POST['action'] == 'ActualizaPrimavac'){

            if(empty($_POST['nosemana']) )
            {
                echo "error";
            }else { 

                $idempl      = $_POST['idempl'];
                $semana      = $_POST['nosemana'];
                $noempl      = $_POST['noempleado'];
                $empleado    = $_POST['empleado'];
                $vacaciones  = $_POST['vacaciones'];
                $primavac    = $_POST['primavac'];
                $primavacfis = $_POST['primavacfis'];
                $impvacacion = $_POST['importevac'];
                $sueldofisc  = $_POST['sueldofiscal'];
                $impuestofis = $_POST['impuestofis'];
                $deposito    = $_POST['deposito'];
                $totalefect  = $_POST['totefectivo'];
            
                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL procesa_primavac1('$semana', $noempl, $vacaciones, $primavac, $primavacfis, $impvacacion, $sueldofisc, $impuestofis, $deposito, $totalefect, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $arrayData = array();
                $fila = 0;
    
                if($result > 0){

                    while ($data = mysqli_fetch_assoc($query_control)){
                      
                        $detalleTabla .= '<tr>
                                            <td style="text-align:right;">'.$data['no_quincena'].'</td>
                                            <td style="text-align:right;">'.$data['no_empleado'].'</td>
                                            <td>'.$data['nombre'].'</td>
                                            <td>'.$data['puesto'].'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_bruto'],0).'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_diario'],2).'</td>
                                            <td style="text-align:right;">'.$data['dias_laborados'].'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_total'],2).'</td>
                                            <td style="text-align:right;">'.$data['bono'].'</td>
                                            <td style="text-align:right;">'.$data['bono_mensual'].'</td>
                                            <td style="text-align:right;">'.$data['apoyo_alimenticio'].'</td>
                                            <td style="text-align:right;">'.number_format($data['subtotal'],2).'</td>
                                            <td style="text-align:right;">'.$data['caja_ahorro'].'</td>
                                            <td style="text-align:right;">'.$data['prestamo_deuda'].'</td>
                                            <td style="text-align:right;">'.$data['vacaciones'].'</td>
                                            <td style="text-align:right;">'.$data['prima_vacacionalfiscal'].'</td>
                                            <td style="text-align:right;">'.$data['prima_vacacional'].'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_quincenal'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_fiscal'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['impuesto_fiscal'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['deposito'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['total_efectivo'],2).'</td>
                                            <td style="text-align:right;">'.$data['no_empleado'].'</td>
                                            
                                            <td align="center"><a id="alumno" 
                                                data-target="#modalIndicador" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nosem="'.$data['no_quincena'].'" 
                                                data-noempl="'.$data['no_empleado'].'"
                                                data-name="'.$data['nombre'].'"
                                                data-dias="'.$data['dias_vacaciones'].'"
                                                data-primv="'.$data['prima_vacacional'].'"
                                                data-primvfs="'.$data['prima_vacacionalfiscal'].'"
                                                data-vacac="'.$data['vacaciones'].'"
                                                data-sdofis="'.$data['sueldo_fiscal'].'"
                                                data-impfis="'.$data['impuesto_fiscal'].'"
                                                data-depos="'.$data['deposito'].'"
                                                data-totefe="'.$data['total_efectivo'].'"
                                                
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }


                
                $arrayData['detalle'] = $detalleTabla;
                
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }
              
            }

        }

// Buscar Cliente para Pedido
        if($_POST['action'] == 'searchNounidad')
        {
            if(!empty($_POST['op'])){
                $nounidad = $_POST['op'];

                $query = mysqli_query($conection,"SELECT un.placas, un.tipo_combustible, cb.kmactual_cargar, un.rendimiendo_estandar FROM unidades un LEFT JOIN carga_combustible cb ON un.placas = cb.placas  WHERE un.no_unidad = '$nounidad' AND un.estatus = 1 ORDER by cb.fecha DESC LIMIT 1");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }

 //****************************//
        //Canclar control
        if($_POST['action'] == 'procesarSalirCargacomb'){

                          
                $norecibo  = $_POST['norecibo'];
                $token       = md5($_SESSION['idUser']);
                $usuario     = $_SESSION['idUser'];

                $query_procesarcf = mysqli_query($conection,"CALL salir_cargacamb($norecibo, '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
            
            } 

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaCargaComb')
{
    if(empty($_POST['estacion']) || empty($_POST['nounidad']) || empty($_POST['operador']) || empty($_POST['kmactual']) || empty($_POST['combustible']) || empty($_POST['litros']) || empty($_POST['precio']) || empty($_POST['supervisor']) )
    {
         echo 'error';
     }else {

        $folio       = $_POST['folio'];
        $estacion    = $_POST['estacion'];
        $fecha       = $_POST['fecha'];
        $semana      = $_POST['nosemana'];
        $nounidad    = $_POST['nounidad'];
        $placas      = $_POST['placas'];
        $operador    = $_POST['operador'];
        $kmanterior  = $_POST['kmanterior'];
        $kmactual    = $_POST['kmactual'];
        $kmrecorre   = $_POST['kmrecorre'];
        $combustible = $_POST['combustible'];
        $colorgas    = $_POST['colorgas'];
        $litros      = $_POST['litros'];
        $precio      = $_POST['precio'];
        $importe     = $_POST['importe'];
        $rendimiento = $_POST['rendimiento'];
        $rendstandar = $_POST['rendstandar'];
        $supervisor  = $_POST['supervisor'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_cargacomb($folio, '$estacion', '$fecha', '$semana', '$nounidad', '$placas', '$operador', $kmanterior, $kmactual, $kmrecorre, '$combustible', '$colorgas', $litros, $precio, $importe, $rendimiento, $rendstandar, '$supervisor', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

   
    }
    exit;
}  

//Agregar Productos a Entrada
if($_POST['action'] == 'EditCargaComb')
{
    if(!empty($_POST['estacion']) || !empty($_POST['nounidad']) || !empty($_POST['operador']) || !empty($_POST['kmactual']) || !empty($_POST['combustible']) || !empty($_POST['litros']) || !empty($_POST['precio']) || !empty($_POST['supervisor']) )
    {
        $idmov       = $_POST['idmov'];
        $folio       = $_POST['folio'];
        $estacion    = $_POST['estacion'];
        $fecha       = $_POST['fecha'];
        $semana      = $_POST['nosemana'];
        $nounidad    = $_POST['nounidad'];
        $placas      = $_POST['placas'];
        $operador    = $_POST['operador'];
        $kmanterior  = $_POST['kmanterior'];
        $kmactual    = $_POST['kmactual'];
        $kmrecorre   = $_POST['kmrecorre'];
        $combustible = $_POST['combustible'];
        $colorgas    = $_POST['colorgas'];
        $litros      = $_POST['litros'];
        $precio      = $_POST['precio'];
        $importe     = $_POST['importe'];
        $rendimiento = $_POST['rendimiento'];
        $rendimest   = $_POST['reestandar'];
        $supervisor  = $_POST['supervisor'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL edita_cargacomb($idmov, $folio, '$estacion', '$fecha', '$semana', '$nounidad', '$placas', '$operador', $kmanterior, $kmactual, $kmrecorre, '$combustible', '$colorgas', $litros, $precio, $importe, $rendimiento, $rendimest, '$supervisor', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
} 


//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaViajeSpecial')
{
    if(empty($_POST['fechaviaje'])  || empty($_POST['cliente']) || empty($_POST['costo']) || empty($_POST['direccion']) || empty($_POST['destino']) || empty($_POST['phone_contac']) )
    {
        echo "error"; 
    }else {
        
        $fechaviaje  = $_POST['fechaviaje'];
        //$fechafinal  = $_POST['fechafinal'];
        $cliente     = $_POST['cliente'];
        //$ruta        = $_POST['ruta'];
        $supervisor  = $_POST['supervisor'];
        $tipo        = $_POST['tipo'];
        $tipo_viaje  = $_POST['tipoviaje'];
        $numunidades = $_POST['numunidades'];
        //$nopersonas  = $_POST['nopersonas'];
        //$horarios    = implode(', ', $_POST['horarios']);
        //$turno       = $_POST['turno'];
        //$tipovuelta  = $_POST['tipovuelta'];
        $horaini     = $_POST['horainicio'];
        $sueldovuelta = $_POST['sueldovta'];
        $direccion   = $_POST['direccion'];
        //$horafin     = $_POST['horafin'];
        $destino     = $_POST['destino'];
        $notas       = $_POST['notas']; 
        $phonect     = $_POST['phone_contac'];
        $costo       = $_POST['costo'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_busca = mysqli_query($conection,"SELECT semana from semanas WHERE dia_inicial <= '$fechaviaje' AND dia_final >= '$fechaviaje' ");
                    $result_busca = mysqli_num_rows($query_busca);
                     while ($data = mysqli_fetch_assoc($query_busca)){
                     $semana = $data['semana'];
                     }   
    
        $query_procesar = mysqli_query($conection,"CALL procesar_viajespecial('$fechaviaje', '$semana', '$cliente', '$tipo', '$tipo_viaje', $numunidades, '$horaini', $sueldovuelta, '$direccion', '$destino', '$notas', '$phonect', $costo, $supervisor, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        } 
    }
} 

//Agregar Productos a Entrada
if($_POST['action'] == 'EditaViajeSpecial')
{
    if(!empty($_POST['fechaviaje'])  || !empty($_POST['cliente']) || !empty($_POST['costo']) )
    {

        $Idmov       = $_POST['Idmov'];
        $fechaviaje  = $_POST['fechaviaje'];
        // $fechafinal  = $_POST['fechafinal'];
        // $semana      = $_POST['semana'];
        $cliente     = $_POST['cliente'];
        // $ruta        = $_POST['ruta'];
        // $supervisor  = $_POST['supervisor'];
        $unidad      = $_POST['unidad'];
        $tipo_viaje  = $_POST['tipoviaje'];
        $numunidades = $_POST['numunidades'];
        // $nopersonas  = $_POST['nopersonas'];
        // $horarios    = implode(', ', $_POST['horarios']);
        // $turno       = $_POST['turno'];
        // $tipovuelta  = $_POST['tipovuelta'];
        $horaini     = $_POST['horainicio'];
        $direccion   = $_POST['direccion'];
        $horafin     = $_POST['horafin'];
        $destino     = $_POST['destino'];
        $notas       = $_POST['notas']; 
        $phone_cont  = $_POST['phonect']; 
        $costo       = $_POST['costo'];
        $supervisor  = $_POST['supervisor'];
        $sueldo_vta  = $_POST['sdovuelta'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL editar_viajespecial($Idmov, '$fechaviaje', '$cliente', '$tipo_viaje', $numunidades, '$unidad', '$horaini', '$direccion', '$horafin', '$destino', '$notas', '$phone_cont', $costo, $supervisor, $sueldo_vta, $usuario)");
        
        $result_detalle = mysqli_affected_rows($conection);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo json_encode(array('error' => 'Error al actualizar el viaje.'));
        }
    
    mysqli_close($conection);

    }else{
        echo json_encode(array('error' => 'Por favor, complete todos los campos requeridos.')); 
    }
    exit;
 
}  

//Agregar Productos a Entrada
if($_POST['action'] == 'CancelaViajeSpecial')
{
   

        $Idmov       = $_POST['Idmov'];
      

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL cancelar_viajespecial($Idmov, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    
    exit;
 
}  


//Agregar Productos a Entrada
if($_POST['action'] == 'RegistraViajeSpecial')
{
    if(!empty($_POST['operador']) || !empty($_POST['tipo_vuelta']) || !empty($_POST['sueldovta']) )
    {

        if (empty($_POST['tipovuelta'])) {
            echo "error";
        }else {
            if($_POST['tipovuelta'] == 0) {
             echo 'error';   
            }else {
     

        $Idmov       = $_POST['Idmov'];
        $fecha       = $_POST['fecha'];
        $semana      = $_POST['semana'];
        $operador    = $_POST['operador'];    
        $tipo        = $_POST['tipo'];
        $unidad_ejec = $_POST['unidad_ejec'];
        $tipo_viaje  = $_POST['tipoviaje'];
        $noeco       = $_POST['noeco'];
        $nopersonas  = $_POST['nopersonas'];
        //$horarios    = implode(', ', $_POST['horarios']);
        //$turno       = $_POST['turno'];
        $tipovuelta  = $_POST['tipovuelta'];
        $sueldovta   = $_POST['sueldovta'];
        $hora_finreal   = $_POST['hora_finreal'];
        $hora_real   = $_POST['hora_real'];
        
        $notasoperador = $_POST['notasoperador']; 
        $supervisor = $_POST['supervisor']; 

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL registrar_viajespecial($Idmov, '$fecha', '$semana', '$operador', '$tipo', '$unidad_ejec', '$tipo_viaje', '$noeco', $nopersonas, $tipovuelta, $sueldovta, '$hora_finreal', '$hora_real', '$notasoperador', $supervisor, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
     }}
    }else{
        echo 'error';
    }
    exit;
 
}  


// Registrar Viaje Especial Gerencia
if($_POST['action'] == 'RegistraViajeSpecialgcia')
{
    
        $Idmov       = $_POST['Idmov'];
        $fecha       = $_POST['fecha'];
        $semana      = $_POST['semana'];
        $operador    = $_POST['operador'];    
        $tipo        = $_POST['tipo'];
        $unidad_ejec = $_POST['unidad_ejec'];
        $tipo_viaje  = $_POST['tipoviaje'];
        $noeco       = $_POST['noeco'];
        $nopersonas  = $_POST['nopersonas'];
        //$horarios    = implode(', ', $_POST['horarios']);
        //$turno       = $_POST['turno'];
        $tipovuelta  = $_POST['tipovuelta'];
        $sueldovta   = $_POST['sueldovta'];
        $hora_real   = $_POST['hora_real'];
        $hora_finreal  = $_POST['hora_finreal'];
        $notasoperador = $_POST['notasoperador']; 
        $supervisor = $_POST['supervisor']; 

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL registrar_viajespecialgcia($Idmov, '$fecha', '$semana', '$operador', '$tipo', '$unidad_ejec', '$tipo_viaje', '$noeco', $nopersonas, $tipovuelta, $sueldovta, '$hora_real', '$hora_finreal', '$notasoperador', $supervisor, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    
    exit;
 
}  


//Almacena Solicitud de combustible
if($_POST['action'] == 'AlmacenaSolicitudmantto')

{
    if(empty($_POST['fecha']) || empty($_POST['nounidad']) || empty($_POST['operador']) || empty($_POST['solicita']) || empty($_POST['trabajosolic']) )
    {
       echo 'error';
    }else{
        
        $folio        = $_POST['folio'];
        $fecha        = $_POST['fecha'];
        $nounidad     = $_POST['nounidad'];
        $tipo_unidad  = $_POST['tipo_unidad'];
        $operador      = $_POST['operador'];
        $solicita     = $_POST['solicita'];
        //$tipo_trab    = $_POST['tipotrabajo'];
        //$tipo_mantto  = $_POST['tipomantto'];
        //$programado   = $_POST['programado'];
        $trabajo_sol  = $_POST['trabajosolic'];
        $notasgen     = $_POST['notasgen'];
        //$trabajohecho = $_POST['trabajohecho'];
        //$costos_desc  = $_POST['costosdesc'];
        //$fechaini     = $_POST['fechaini'];
        //$fechafin     = $_POST['fechafin'];
        //$notas        = $_POST['notas'];
        //$causas       = $_POST['causas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_solicitudmantto($folio, '$fecha', '$nounidad', '$tipo_unidad', '$operador', '$solicita', '$trabajo_sol', '$notasgen', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}  

//****************************//
        //Canclar control
   if($_POST['action'] == 'procesarSalirSolicitudmt'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_solicitudmt($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    }   

// borrar Cliente

if($_POST['action'] == 'deleteEmpleado')
{
    $cliente_num = $_POST['clienteId'];

    $query_delone = mysqli_query($conection,"UPDATE empleados SET estatus = 0 WHERE concat(noempleado, ' ', nombres, ' ', apellido_paterno, ' ', apellido_materno)  = '$cliente_num'");
    //*$query_del = mysqli_query($conection,"DELETE FROM contactos_cliente WHERE nombre = '$cliente_num'");
        
            mysqli_close($conection);
            if($query_delone){
                echo 'ok';
            }else{
                echo 'error';
            }
            exit;
}


//*Agregar Productos a Entrada
if($_POST['action'] == 'EditaCliente')
{
    if(!empty($_POST['namecte']) || !empty($_POST['telefonocte']) )
    {
        $Id           = $_POST['Id'];
        $namecte      = $_POST['namecte'];
        $emailcte     = $_POST['emailcte'];
        $telefonocte  = $_POST['telefonocte'];
        $rfccte       = $_POST['rfccte'];
        $sitioweb     = $_POST['sitiocte'];
        $dateinicio   = $_POST['dateinicio'];
        $datefin      = $_POST['datefin'];
        $namecontac   = $_POST['namecontac'];
        $titulocontac = $_POST['titulocontac'];
        $puestocontac = $_POST['puestocontac'];
        $emailcontac  = $_POST['emailcontac'];
        $movilcontac  = $_POST['movilcontac'];
        $callecte     = $_POST['callecte'];
        $estadocte    = $_POST['estadocte'];
        $ciudadcte    = $_POST['ciudadcte'];
        $cpostalcte   = $_POST['cpostalcte'];
        $paiscte      = $_POST['paiscte'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL editar_cliente($Id, '$namecte', '$emailcte', '$telefonocte', '$rfccte', '$sitioweb', '$dateinicio', '$datefin', '$namecontac', '$titulocontac', '$puestocontac', '$emailcontac', '$movilcontac', '$callecte', '$estadocte', '$ciudadcte', '$cpostalcte', '$paiscte', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Baja Empleado
if($_POST['action'] == 'BajaEmpleado')
{
        if(empty($_POST['date_baja']) )
    {
      echo 'error';
    }else {

        $idc          = $_POST['idc'];
        $empleado     = $_POST['empleado'];
        $date_baja    = $_POST['date_baja'];
        $mot_baja     = $_POST['mot_baja'];
        $recontrata   = $_POST['recontrata'];
        $mot_recontra = $_POST['mot_recontra'];


        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

   
       $query_insert = mysqli_query($conection,"SELECT count(*) as numreg FROM empleados where  noempleado = $idc and estatus = 0");
       while ($data = mysqli_fetch_assoc($query_insert)){
            $noreg = $data['numreg'];
        } 

       if ($noreg == 0) {
            $query_procesar = mysqli_query($conection,"CALL baja_empleado($idc, '$empleado', '$date_baja', '$mot_baja', '$recontrata', '$mot_recontra', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
            if($result_detalle > 0){
                $data = mysqli_fetch_assoc($query_procesar);
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }else{
                echo "error";
            }
        }else {
            echo "error";
            exit;
        }
        exit;
    } 
}

if($_POST['action'] == 'ReingresoEmpleado')
{

        $idc          = $_POST['idc'];
        $empleado     = $_POST['empleado'];
        $date_reing    = $_POST['date_reing'];
      

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

      
        $query_procesar = mysqli_query($conection,"CALL reingreso_empleado($idc, '$empleado', '$date_reing', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }    
}


//Agregar Productos a Entrada
if($_POST['action'] == 'EditaAlmacenaViaje')
{
    if(empty($_POST['fecha']) || empty($_POST['semana']) || empty($_POST['cliente'])
    || empty($_POST['ruta']) || empty($_POST['operador']) || empty($_POST['tipovuelta']) )
    {
      echo 'error';
    }else {

        if ($_POST['tipovuelta'] == 0) {
          echo 'error';  
        }else {

          if ($_POST['sueldovuelta'] == 0) {
                  echo "error";
              }else {    

        $Id          = $_POST['Id'];
        $fecha       = $_POST['fecha'];
        $semana      = $_POST['semana'];
        $cliente     = $_POST['cliente'];
        $ruta        = $_POST['ruta'];
        $operador    = $_POST['operador'];
        $tipo        = $_POST['tipo'];
        $unidad_ejec = $_POST['unidad_ejec'];
        $tipo_viaje  = $_POST['tipoviaje'];
        $nounidad    = $_POST['noeco'];
        $nopersonas  = $_POST['nopersonas'];
        $horarios    = $_POST['horarios'];
        $hora_real   = $_POST['hora_real'];
        $turno       = $_POST['turno'];
        $tipovuelta  = $_POST['tipovuelta'];
        $sueldovta   = $_POST['sueldovuelta'];
        $idsuperv    = $_POST['elsuperv'];
        //$horafin     = $_POST['horafin'];
        //$destino     = $_POST['destino'];
        $notas       = $_POST['notas']; 

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL editar_viaje($Id, '$fecha', '$semana', '$cliente', '$ruta', '$operador', '$tipo', '$unidad_ejec', '$tipo_viaje', '$nounidad', $nopersonas, '$horarios', '$hora_real', '$turno', $tipovuelta, $sueldovta, $idsuperv, '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
    }
    }
    }
    exit;
 
} 


// ***** Agrega participantes minutas //
    
    if($_POST['action'] == 'ActualizaNominaQuincena'){

            if(empty($_POST['quincena']) )
            {
                echo "error";
            }else { 
                $quincena     = $_POST['quincena'];
            
                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL procesa_nominaquintemp('$quincena', '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $arrayData = array();
                $fila = 0;

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                 /* */      
                        
                        $detalleTabla .= '<tr>
                                            <td style="text-align:right;">'.$data['no_quincena'].'</td>
                                            <td style="text-align:right;">'.$data['no_empleado'].'</td>
                                            <td>'.$data['nombre'].'</td>
                                            <td>'.$data['puesto'].'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_bruto'],0).'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_diario'],2).'</td>
                                            <td style="text-align:right;">'.$data['dias_laborados'].'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_total'],2).'</td>
                                            <td style="text-align:right;">'.$data['bono'].'</td>
                                            <td style="text-align:right;">'.$data['bono_mensual'].'</td>
                                            <td style="text-align:right;">'.$data['apoyo_alimenticio'].'</td>
                                            <td style="text-align:right;">'.number_format($data['subtotal'],2).'</td>
                                            <td style="text-align:right;">'.$data['caja_ahorro'].'</td>
                                            <td style="text-align:right;">'.$data['prestamo_deuda'].'</td>
                                            <td style="text-align:right;">'.$data['vacaciones'].'</td>
                                            <td style="text-align:right;">'.$data['prima_vacacionalfiscal'].'</td>
                                            <td style="text-align:right;">'.$data['prima_vacacional'].'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_quincenal'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_fiscal'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['impuesto_fiscal'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['deposito'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['total_efectivo'],2).'</td>
                                            <td style="text-align:right;">'.$data['no_empleado'].'</td>
                                            
                                            <td align="center"><a id="alumno" 
                                                data-target="#modalIndicador" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nosem="'.$data['no_quincena'].'" 
                                                data-noempl="'.$data['no_empleado'].'"
                                                data-name="'.$data['nombre'].'"
                                                data-dias="'.$data['dias_vacaciones'].'"
                                                data-primv="'.$data['prima_vacacional'].'"
                                                data-primvfs="'.$data['prima_vacacionalfiscal'].'"
                                                data-vacac="'.$data['vacaciones'].'"
                                                data-sdofis="'.$data['sueldo_fiscal'].'"
                                                data-impfis="'.$data['impuesto_fiscal'].'"
                                                data-depos="'.$data['deposito'].'"
                                                data-totefe="'.$data['total_efectivo'].'"
                                                
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                $arrayData['detalle'] = $detalleTabla;
                
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }
            exit;   
            }
        }

    // Cerrar Nomina
        if($_POST['action'] == 'CerrarNominaQuincenal')
                {
                    $quincena = $_POST['quincena'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL cerrar_nominaquincena('$quincena', '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }    

    // Buscar Cliente por nombre
        if($_POST['action'] == 'searchClientename')
        {
            if(!empty($_POST['opcte'])){
                $namecte = $_POST['opcte'];

                $query = mysqli_query($conection,"SELECT telefono, id_supervisor FROM clientes WHERE nombre_corto = '$namecte'");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }  

    // Generar Vuelta
    if($_POST['action'] == 'AddEditVuelta') {
        if(!empty($_POST['idc'])) {
            $idc       = $_POST['idc'];
            $datefin   = $_POST['datefin'];
            $hregreso  = $_POST['hregreso'];
            $sueldovta = $_POST['sueldovta'];
            $origen    = $_POST['origen'];
            $destino   = $_POST['destino'];
            $unidades  = $_POST['unidades'];
            $costo     = $_POST['costo'];
    
            $token  = md5($_SESSION['idUser']);
            $usuario = $_SESSION['idUser'];
    
            $query_busca = mysqli_query($conection,"SELECT semana from semanas WHERE dia_inicial <= '$datefin' AND dia_final >= '$datefin'");
            if (!$query_busca) {
                die("Error en la consulta de semana: " . mysqli_error($conection)); 
            }
            $result_busca = mysqli_num_rows($query_busca);
            $semana = null; // Inicializar $semana
            if ($result_busca > 0) {
                while ($data = mysqli_fetch_assoc($query_busca)){
                    $semana = $data['semana'];
                }
            } else {
                // Manejar el caso donde no se encuentra la semana
                echo json_encode([
                    "error" => true,
                    "message" => "No se encontró la semana para la fecha especificada."
                ], JSON_UNESCAPED_UNICODE);
                exit; // Salir del script si no se encuentra la semana
            }
    
            // Sentencia preparada
            $stmt = $conection->prepare("INSERT INTO registro_viajes (fecha, semana, cliente, unidad, tipo_viaje, direccion, hora_fin, destino, numero_unidades, sueldo_vuelta, notas, telefono_contacto, costo_viaje, id_supervisor, usuario_id) 
            SELECT ?, ?, cliente, unidad, tipo_viaje, ?, ?, ?, ?, ?, notas, telefono_contacto, ?, id_supervisor, ?
            FROM registro_viajes WHERE id = ?");
            
            $stmt->bind_param("sssssiddii", $datefin, $semana, $origen, $hregreso, $destino, $unidades, $sueldovta, $costo, $usuario, $idc);
    
            if ($stmt->execute()) {
                $affected_rows = mysqli_affected_rows($conection);
                echo json_encode([
                    "error" => false,
                    "message" => "Registro agregado correctamente.",
                    "affected_rows" => $affected_rows 
                ], JSON_UNESCAPED_UNICODE);
            } else {
                echo json_encode([
                    "error" => true,
                    "message" => "Error al ejecutar la consulta: " . $stmt->error
                ], JSON_UNESCAPED_UNICODE);
            }
    
            $stmt->close();
            mysqli_close($conection); 
    
        } else {
            echo json_encode([
                "error" => true,
                "message" => "Falta el ID del registro (idc)."
            ], JSON_UNESCAPED_UNICODE);
        }
    }

//Inicio de Viaje
               
if($_POST['action'] == 'IniciodeViaje')
{

        $idc         = $_POST['idc'];
        $fecha_ini   = $_POST['fecha_inicio'];
        $hora_ini    = $_POST['hora_inicio'];
        $ubicacion   = $_POST['ubicacion'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];


            $query_procesar = mysqli_query($conection,"CALL reg_inicioviaje($idc, '$fecha_ini', '$hora_ini', '$ubicacion', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       
} 

//Finde Viaje
               
if($_POST['action'] == 'FindeViaje')
{

        $idf          = $_POST['idf'];
        $fecha_fin    = $_POST['fecha_fin'];
        $hora_fin     = $_POST['hora_fin'];
        $personas     = $_POST['personas'];
        $ubicacionfin = $_POST['ubicacionfin'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

            $query_procesar = mysqli_query($conection,"CALL reg_finviaje($idf, '$fecha_fin', '$hora_fin', $personas, '$ubicacionfin', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       
   
} 

// borrar Viajes Cargados
        if($_POST['action'] == 'infoBorraRegistros')
                {
                    
        
                    $query_prov = mysqli_query($conection,"TRUNCATE tempregistro_viajes");
                    mysqli_close($conection);
                    $result_prov = mysqli_num_rows($query_prov);
                    if($result_prov > 0){
                        $data_prov = mysqli_fetch_assoc($query_prov);
                        echo json_encode($data_prov,JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                    echo 'error';
                    exit;
                }  

// ***** Agrega participantes minutas //
    
    if($_POST['action'] == 'CargaRegistroViajes'){
            
        $token         = md5($_SESSION['idUser']);

        $query_control = mysqli_query($conection,"CALL procesa_cargaviajes('$token')");
        mysqli_close($conection); 
        $result = mysqli_num_rows($query_control);   
        $data = mysqli_fetch_assoc($query_control);
        echo json_encode($data,JSON_UNESCAPED_UNICODE);
       
    }
          

//Almacena Ruta
if($_POST['action'] == 'AlmacenaRuta')
{
    if(!empty($_POST['cliente']) || !empty($_POST['ruta']) || !empty($_POST['operador']))
    {
        $cliente    = $_POST['cliente'];
        $ruta       = $_POST['ruta'];
        $noeco      = $_POST['noeconomico'];
        $operador   = $_POST['operador'];
        $horario1   = $_POST['horario1'];
        $horario2   = $_POST['horario2'];
        $horario3   = $_POST['horario3'];
        $hmixto1    = $_POST['hmixto1'];
        $hmixto2    = $_POST['hmixto2'];
        $diasviajes = $_POST['diasviajes'];
        $sueldo_vta = $_POST['sueldo_vta'];
        $sueldo_vtaneta = $_POST['sueldo_vtaneta'];
        $sueldo_semid   = $_POST['sueldo_semid'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_ruta('$cliente', '$ruta', '$noeco', '$operador', '$horario1', '$horario2', '$horario3', '$hmixto1', '$hmixto2', '$diasviajes', $sueldo_vta, $sueldo_vtaneta, $sueldo_semid, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


// Agregar Cliente al correo
        if($_POST['action'] == 'AddClienteCorreo'){
            if(empty($_POST['razon_social']) )
            {
                echo 'error';
            }else{
                $cliente     = $_POST['razon_social'];
               
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_correo = mysqli_query($conection,"CALL add_temp_correo('$cliente','$token')");
                $result = mysqli_num_rows($query_detalle_correo);

                $detalleTablaPe = '';
                        
                $arrayData = array();

                if($result > 0){
                    

                while ($data = mysqli_fetch_assoc($query_detalle_correo)){


                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['razon_social'].'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_cliente_correo('.$data['id'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }

                  
                $arrayData['detalle'] = $detalleTablaPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        }  

// Elimina productos del detalle Temporal Pedido

        if($_POST['action'] == 'delCorreocte'){

            if(empty($_POST['id_detalle']))
            {
                echo 'error';
            }else{
                $id_detalle = $_POST['id_detalle'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_correo($id_detalle,'$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaDetPe = '';

                $arrayData = array();

                if($result > 0){

                    while ($data = mysqli_fetch_assoc($query_detalle_temppe)){

                        $detalleTablaDetPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['razon_social'].'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_cliente_correo('.$data['id'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }


                $arrayData['detalledelete'] = $detalleTablaDetPe;


                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

            }else{
                echo 'error';
            }   
                mysqli_close($conection);   
            }
        
            exit;
        }

//****************************//
        //Canclar control
        if($_POST['action'] == 'procesarSalirCorreo'){

                          
                $token       = md5($_SESSION['idUser']);
                $usuario     = $_SESSION['idUser'];

                $query_procesarcf = mysqli_query($conection,"CALL salir_correo('$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
            
            } 

// Agregar Detalle al mantenimiento
        if($_POST['action'] == 'AddDetallemantto'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio     = $_POST['folio'];
                $cantidad    = $_POST['cantidad'];
                $descripcion = $_POST['descripcion'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detallemantto($nofolio, $cantidad, '$descripcion', '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){

                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }

                  
                $arrayData['detalle'] = $detalleTablaPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        } 

// Elimina refacciones del detalle Temporal Mannto

        if($_POST['action'] == 'delDeattemantto'){

            if(empty($_POST['id_detalle']))
            {
                echo 'error';
            }else{
                $id_detalle = $_POST['id_detalle'];
                $folio      = $_POST['nofolio'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempmantto($id_detalle, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaDetPe = '';

                $arrayData = array();

                if($result > 0){

                    while ($data = mysqli_fetch_assoc($query_detalle_temppe)){

                        $detalleTablaDetPe .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }


                $arrayData['detalledelete'] = $detalleTablaDetPe;


                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

            }else{
                echo 'error';
            }   
                mysqli_close($conection);   
            }
        
            exit;
        } 

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaIncidencia')
{
    if(empty($_POST['tincidencia']) || empty($_POST['empleado']) || empty($_POST['diasvac']))
    {
        echo 'error';
    }else {    
        $incidencia  = $_POST['tincidencia'];
        $empleado    = $_POST['empleado'];
        $diastomar   = $_POST['diastomar'];
        $diasderecho = $_POST['diasderecho'];
        $fecha_ini   = $_POST['fechaini'];
        $fecha_fin   = $_POST['fechafin'];
        $dias_vac    = $_POST['diasvac'];
        $notas       = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
 
        $query_procesar = mysqli_query($conection,"CALL procesar_incidencia('$incidencia', '$empleado', $diasderecho, $diastomar, '$fecha_ini', '$fecha_fin', $dias_vac, '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }
    exit;
}

// borrar Carga de combustible

if($_POST['action'] == 'deleteCargac')
{
    $folio = $_POST['clienteId'];

    $query_delone = mysqli_query($conection,"UPDATE carga_combustible SET estatus = 0 WHERE id  = $folio");
    //*$query_del = mysqli_query($conection,"DELETE FROM contactos_cliente WHERE nombre = '$cliente_num'");
        
            mysqli_close($conection);
            if($query_delone){
                echo 'ok';
            }else{
                echo 'error';
            }
            exit;
}


// ***** Agrega participantes minutas //
    
    if($_POST['action'] == 'ActualizaPrimavacSem'){

            if(empty($_POST['nosemana']) )
            {
                echo "error";
            }else { 

                $idempl      = $_POST['idempl'];
                $semana      = $_POST['nosemana'];
                $noempl      = $_POST['noempleado'];
                $empleado    = $_POST['empleado'];
                $diasvac     = $_POST['diasvac'];
                $primavac    = $_POST['primavac'];
                $vacaciones  = $_POST['vacaciones'];
                
                //$primavacfis = $_POST['primavacfis'];
                $impvacfisc  = $_POST['importevacfi'];
                $impvacacion = $_POST['importevacgr'];
                $sueldofisc  = $_POST['nominafis'];
                $impuestofis = $_POST['impuestofis'];
                //$deposito    = $_POST['nominagral'];
                $totalefect  = $_POST['nominagral'];

            
                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL procesa_primavac1sem('$semana', $noempl, $diasvac, $primavac, $vacaciones, $impvacfisc, $impvacacion, $sueldofisc, $impuestofis, $totalefect, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $arrayData = array();
                $fila = 0;
    
                if($result > 0){

                    while ($data = mysqli_fetch_assoc($query_control)){
                      
                        $detalleTabla .= '<tr>
                                            <td style="text-align:right;">'.$data['no_semana'].'</td>
                                            <td style="text-align:right;">'.$data['no_empleado'].'</td>
                                            <td>'.$data['unidad'].'</td>
                                            <td>'.$data['nounidad'].'</td>
                                            <td>'.$data['nombre'].'</td>
                                            <td>'.$data['cargo'].'</td>
                                            <td>'.$data['imss'].'</td>
                                            <td>'.$data['estatus'].'</td>
                                            <td style="text-align:right;">'.$data['sueldo_base'].'</td>
                                            <td style="text-align:right;">'.$data['viajes_especiales'].'</td>
                                            <td style="text-align:right;">'.$data['viajes_contrato'].'</td>
                                            <td style="text-align:right;">'.$data['bono_categoria'].'</td>
                                            <td style="text-align:right;">'.$data['bono_supervisor'].'</td>
                                            <td style="text-align:right;">'.$data['bono_semanal'].'</td>
                                            <td style="text-align:right;">'.$data['apoyo_mensual'].'</td>
                                            <td style="text-align:right;">'.$data['total_especiales'].'</td>
                                            <td style="text-align:right;">'.$data['sueldo_adicional'].'</td>
                                            <td style="text-align:right;">'.$data['prima_vacacional'].'</td>
                                            <td style="text-align:right;">'.number_format($data['total_vueltas'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['sueldo_bruto'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['pago_fiscal'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['deduccion_fiscal'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['descuento_adeudo'],2).'</td>
                                            <td style="text-align:right;">'.$data['caja'].'</td>
                                            <td style="text-align:right;">'.number_format($data['total_nomina'],2).'</td>
                                            <td style="text-align:right;">'.number_format($data['total_general'],2).'</td>
                                            <td style="text-align:right;">'.$data['no_empleado'].'</td>
                                            <td align="center"><a id="alumno" 
                                                data-target="#modalIndicador" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nosem="'.$data['no_semana'].'" 
                                                data-noempl="'.$data['no_empleado'].'"
                                                data-name="'.$data['nombre'].'"
                                                data-dias="'.$data['dias_vacaciones'].'"
                                                data-cargo="'.$data['deduccion_fiscal'].'"
                                                data-imss="'.$data['vacaciones'].'"
                                                data-vesp="'.$data['prima_vacacional'].'"
                                                data-totnom="'.$data['total_nomina'].'"
                                                data-totgral="'.$data['total_general'].'"
                                                
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }


                
                $arrayData['detalle'] = $detalleTabla;
                
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }
              
            }

        }

//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalleditSolmantto'){
                
                $c_noorden = $_POST['noorden'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_mantto WHERE folio = $c_noorden ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }

                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }       

//*
        //Almacena Edicion Solicitud Mantenimiento
if($_POST['action'] == 'AlmacenaEditSolicitudmantto')
{
    // var_dump($_POST);
    if(empty($_POST['fecha']) || empty($_POST['nounidad']) || empty($_POST['operador']) || empty($_POST['solicita']) || empty($_POST['tipotrabajo']) || empty($_POST['programado']) || empty($_POST['trabajosolic']) || empty($_POST['trabajohecho']) || empty($_POST['causas']) )
    {
       echo 'error';
    }else{
        
        $folio        = (isset($_POST['folio']) && !empty($_POST['folio'])) ? $_POST['folio'] : null;
        $fecha        = (isset($_POST['fecha']) && !empty($_POST['fecha'])) ? $_POST['fecha'] : '0000-00-00';
        $nounidad     = (isset($_POST['nounidad']) && !empty($_POST['nounidad'])) ? $_POST['nounidad'] : null;
        $tipo_unidad  = (isset($_POST['tipo_unidad']) && !empty($_POST['tipo_unidad'])) ? $_POST['tipo_unidad'] : null;
        $operador     = (isset($_POST['operador']) && !empty($_POST['operador'])) ? $_POST['operador'] : null;
        $solicita     = (isset($_POST['solicita']) && !empty($_POST['solicita'])) ? $_POST['solicita'] : null;
        $tipo_trab    = (isset($_POST['tipotrabajo']) && !empty($_POST['tipotrabajo'])) ? $_POST['tipotrabajo'] : null;
        $kmneumatico  = (isset($_POST['kmneumatico']) && !empty($_POST['kmneumatico'])) ? $_POST['kmneumatico'] : null;
        $tipo_mantto  = (isset($_POST['tipomantto']) && !empty($_POST['tipomantto'])) ? $_POST['tipomantto'] : null;
        $programado   = (isset($_POST['programado']) && !empty($_POST['programado'])) ? $_POST['programado'] : null;
        $trabajo_sol  = (isset($_POST['trabajosolic']) && !empty($_POST['trabajosolic'])) ? $_POST['trabajosolic'] : null;
        $trabajohecho = (isset($_POST['trabajohecho']) && !empty($_POST['trabajohecho'])) ? $_POST['trabajohecho'] : null;
        $costos_desc  = (isset($_POST['costosdesc']) && !empty($_POST['costodesc'])) ? $_POST['costodesc'] : null;
        $fechaini     = (isset($_POST['fechaini']) && !empty($_POST['fechaini'])) ? $_POST['fechaini'] : '0000-00-00';
        $fechafin     = (isset($_POST['fechafin']) && !empty($_POST['fechafin'])) ? $_POST['fechafin'] : '0000-00-00';
        $notas        = (isset($_POST['notas']) && !empty($_POST['notas'])) ? $_POST['notas'] : null;
        $notas_genera = (isset($_POST['notas_genera']) && !empty($_POST['notas_genera'])) ? $_POST['notas_genera'] : null;
        $causas       = (isset($_POST['causas']) && !empty($_POST['causas'])) ? $_POST['causas'] : null;
        // echo "Valor de usuario: " . $_POST['usuario'];
        $usuario     = (isset($_POST['usuario']) && !empty($_POST['usuario'])) ? intval($_POST['usuario']) : null;

        $sql_editar_orden = "CALL procesar_editsolicitudmantto($folio, '$fecha', '$nounidad', '$tipo_unidad', '$operador', '$solicita', '$tipo_trab', '$kmneumatico', '$tipo_mantto', '$programado', '$trabajo_sol', '$trabajohecho', '$costos_desc', '$fechaini', '$fechafin', '$notas', '$notas_genera', '$causas', $usuario)";
        // echo $sql_editar_orden;

        $query_procesar = mysqli_query($conection, $sql_editar_orden);
        if(!$query_procesar) {
            die("Error en la consulta: " . mysqli_error($conection));
        }

        $result_detalle = mysqli_affected_rows($conection);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            $response = array(
                'status' => 'success',
                'data' => $data
            );
            echo json_encode($response,JSON_UNESCAPED_UNICODE);
        }else{
            $response = array(
                'status' => 'error',
                'message' => 'Error al procesar la solicitud'
            );
            echo json_encode($response, JSON_UNESCAPED_UNICODE);
        }
    
    mysqli_close($conection);
  }
   
    exit;
}  

// borrar Viaje
        if($_POST['action'] == 'infoBorraViaje')
                {
                    $idviaje = $_POST['viajeId'];
        
                    $query_prov = mysqli_query($conection,"DELETE FROM registro_viajes where id = $idviaje");
                    mysqli_close($conection);
                    $result_prov = mysqli_num_rows($query_prov);
                    if($result_prov > 0){
                        $data_prov = mysqli_fetch_assoc($query_prov);
                        echo json_encode($data_prov,JSON_UNESCAPED_UNICODE);
                        exit;
                    }
                    echo 'error';
                    exit;
                } 


 // Cancela Vuelta Especial
 if ($_POST['action'] == 'AddCancelaVuelta') {
    if (!empty($_POST['idcc'])) {
        $idc = $_POST['idcc'];
        $motivoc = $_POST['motivoc'];

        $usuario = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection, "CALL cancela_vueltasp($idc, '$motivoc', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);

        mysqli_close($conection); // Mover esto antes de salir del script

        if ($result_detalle > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Cancelación registrada correctamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al cancelar el viaje']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Faltan datos']);
    }
}

//Almacenar nuevo adeudo
if ($_POST['action'] == 'EditarAdeudo') {
    if (
        isset($_POST['noempleado']) && is_numeric($_POST['noempleado']) &&
        isset($_POST['cantidad']) && is_numeric($_POST['cantidad']) &&
        !empty($_POST['motivo_adeudo'])
    ) {
        // Sanitización de datos
        $cantidad = floatval($_POST['cantidad']);
        $noempleado = intval($_POST['noempleado']);
        $motivo_adeudo = mysqli_real_escape_string($conection, $_POST['motivo_adeudo']);
        $estado = isset($_POST['estado']) ? intval($_POST['estado']) : 0;
        $fecha_inicial = mysqli_real_escape_string($conection, $_POST['fecha_inicial']);
        $descuento = isset($_POST['descuento']) ? floatval($_POST['descuento']) : 0.0;
        $comentarios = mysqli_real_escape_string($conection, $_POST['comentarios']);
        $semanas_totales = intval($_POST['semanas_totales']);
        $fecha_final = mysqli_real_escape_string($conection, $_POST['fecha_final']);
        $total_abonado = intval($_POST['total_abonado']);

        // Ejecutar la consulta
        $query_insertar = mysqli_query(
            $conection,
            "UPDATE adeudos SET cantidad = '$cantidad', comentarios = '$comentarios', descuento = '$descuento', estado = '$estado', total_abonado = $total_abonado WHERE noempleado = $noempleado"
        );

        // Verificar si la consulta fue exitosa
        if ($query_insertar) {
            // Comprobar si se insertaron filas
            if (mysqli_affected_rows($conection) > 0) {
                // Si se insertó correctamente, retornamos un mensaje de éxito
                echo json_encode(["mensaje" => "Adeudo almacenado correctamente."], JSON_UNESCAPED_UNICODE);
            } else {
                // Si no se insertaron filas, algo salió mal
                echo json_encode(["mensaje" => "No se pudo almacenar el adeudo. Intente nuevamente."], JSON_UNESCAPED_UNICODE);
            }
        } else {
            // En caso de error en la consulta
            echo json_encode(["mensaje" => "Error al ejecutar la consulta: " . mysqli_error($conection)], JSON_UNESCAPED_UNICODE);
        }

        mysqli_close($conection);
    } else {
        echo json_encode(["mensaje" => "Datos inválidos o incompletos recibidos."], JSON_UNESCAPED_UNICODE);
    }
    exit;
}

// Generar Vuelta
    if($_POST['action'] == 'AddPeridoContrato')
    {
      if(empty($_POST['noempleado']) )
      {
        echo 'error';
      }else {  
        $noempleado = $_POST['noempleado'];
        $fchainicio = $_POST['dateinicio'];
        $fchafin    = $_POST['datefin'];
        
        $token    = md5($_SESSION['idUser']);
        $usuario  = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL add_periodoc($noempleado, '$fchainicio', '$fchafin', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        $detalleTablaDetFor = '';
        $arrayData = array(); 
        
        if($result_detalle > 0){
            while ($data = mysqli_fetch_assoc($query_procesar)){
                       
                        

                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['no_empleado'].'</td>
                                            <td>'.$data['fecha_inicial'].'</td>
                                            <td>'.$data['fecha_final'].'</td>
                                            <td>
                                             <a class="link_delete" href="#" onclick="event.preventDefault(); remove_periodo('.$data['id'].','.$data['no_empleado'].');"><i class="fas fa-minus-square"></i></a>
                                            </td>
                                            </tr>';
                    }

                   

                  

                $arrayData['detalle'] = $detalleTablaDetFor;


                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 

       
        }
       
     }
    }

//Extrae datos del detalle_Periodos contratos
        if($_POST['action'] == 'searchForDetalleditPeriodo'){
                
                $c_noempleado = $_POST['noempl'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_contratos WHERE no_empleado = $c_noempleado ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $arrayData = array();


                    while ($data = mysqli_fetch_assoc($query_editf)){
                       
                        

                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['no_empleado'].'</td>
                                            <td>'.$data['fecha_inicial'].'</td>
                                            <td>'.$data['fecha_final'].'</td>
                                            <td>
                                             <a class="link_delete" href="#" onclick="event.preventDefault(); remove_periodo('.$data['id'].','.$data['no_empleado'].');"><i class="fas fa-minus-square"></i></a>
                                            </td>
                                            </tr>';
                    }

                   

                  

                $arrayData['detalle'] = $detalleTablaDetFor;


                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
               
        }


        //Remueve partida Remision
        if($_POST['action'] == 'removePeriodo')
        {
            
                $partida     = $_POST['id_partida'];
                $noempleado  = $_POST['no_emp'];
                
                $usuario     = $_SESSION['idUser'];
                $token       = md5($_SESSION['idUser']);

                $query_detalle_delftc = mysqli_query($conection,"CALL remover_periodo($partida, $noempleado, $usuario, '$token')");
                $result = mysqli_num_rows($query_detalle_delftc);

                $detalleTablaRe = '';
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_detalle_delftc)){
                       

                        $detalleTablaRe .= '<tr>
                                            <td>'.$data['no_empleado'].'</td>
                                            <td>'.$data['fecha_inicial'].'</td>
                                            <td>'.$data['fecha_final'].'</td>
                                            <td>
                                             <a class="link_delete" href="#" onclick="event.preventDefault(); remove_periodo('.$data['id'].','.$data['no_empleado'].');"><i class="fas fa-minus-square"></i></a>
                                            </td>
                                            </tr>';
                    }

                 

                $arrayData['detalle'] = $detalleTablaRe;
                
                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                }else{
                echo 'error';
            }       
                mysqli_close($conection);   
                exit;
            }
       


// Calculo de Sueldo Vuelta
        if($_POST['action'] == 'searchSueldoVuelta')
        {
            if(!empty($_POST['op'])){
                $tipo_viaje = $_POST['op'];
                $cliente    = $_POST['cliente'];
                $ruta       = $_POST['ruta'];
                $operador   = $_POST['operador'];
                $unidad     = $_POST['tipo_unidad'];
                $tipo_vta   = $_POST['tipo_vuelta'];

               $query_procesarubi = mysqli_query($conection,"CALL calcula_sueldo('$tipo_viaje', '$cliente', '$ruta', '$operador', '$unidad', $tipo_vta)");
                $result_procesarubi = mysqli_num_rows($query_procesarubi);
                
                if($result_procesarubi > 0){
                    $data = mysqli_fetch_assoc($query_procesarubi);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }

            }
        }

// Calculo de Sueldo Vuelta 2
        if($_POST['action'] == 'searchSueldoVueltavalor')
        {
            if(!empty($_POST['op'])){
                $tipo_vta   = $_POST['op'];
                $tipo_viaje = $_POST['tipo_viaje'];
                $cliente    = $_POST['cliente'];
                $ruta       = $_POST['ruta'];
                $operador   = $_POST['operador'];
                $unidad     = $_POST['tipo_unidad'];


               $query_procesarubi = mysqli_query($conection,"CALL calcula_sueldovta('$tipo_viaje', '$cliente', '$ruta', '$operador', '$unidad', $tipo_vta)");
                $result_procesarubi = mysqli_num_rows($query_procesarubi);
                
                if($result_procesarubi > 0){
                    $data = mysqli_fetch_assoc($query_procesarubi);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }

            }
        }



//*Alamacena Edicion del cliente
if($_POST['action'] == 'AlmacenaEditCliente')
{
    if(!empty($_POST['nocte']) || !empty($_POST['namecte']) )
    {
        $idcte        = $_POST['Id'];
        $nocte        = $_POST['nocte'];
        $namecte      = $_POST['namecte'];
        $callenum     = $_POST['callenum'];
        $colonia      = $_POST['colonia'];
        $ciudad       = $_POST['ciudad'];
        $municipio    = $_POST['municipio'];
        $estado       = $_POST['estado'];
        $codpostal    = $_POST['codpostal'];
        $pais         = $_POST['pais'];
        $phone        = $_POST['phone'];
        $cont_rh      = $_POST['contactorh'];
        $email_rh     = $_POST['correorh'];
        $giro         = $_POST['giro'];
        $phonecontac  = $_POST['phonecontac'];
        $servicio     = $_POST['servicio'];
        $sitioweb     = $_POST['sitioweb'];
        $tipocontrato = $_POST['tipocontrato'];
        $dateinic     = $_POST['dateinic'];
        $datefinc     = $_POST['datefinc'];
        $razonsoc     = $_POST['razonsoc'];
        $rfccte       = $_POST['rfccte'];
        $formapago    = $_POST['formapago'];
        $metodopago   = $_POST['metodopago'];
        $usocfdi      = $_POST['usocfdi'];
        $cont_conta   = $_POST['contactocont'];
        $email_conta  = $_POST['emailconta'];
        $credito      = $_POST['credito'];
        $condicionesc = $_POST['condicionesc'];
        $supervisor   = $_POST['supervisor'];
        $newestatus   = $_POST['newestatus'];

        if ($supervisor > 0) {
            $idsuperv = $supervisor;
        }else {
            $idsuperv = 0;
        }

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editcliente($idcte, $nocte, '$namecte', '$callenum', '$colonia', '$ciudad', '$municipio', '$estado', '$codpostal', '$pais', '$phone', '$cont_rh', '$email_rh', '$giro', '$phonecontac', '$servicio', '$sitioweb', '$tipocontrato', '$dateinic', '$datefinc', '$razonsoc', '$rfccte', '$formapago', '$metodopago', '$usocfdi', '$cont_conta', '$email_conta', '$credito', '$condicionesc', $idsuperv, $newestatus, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


// Buscar Datos finiquito
        if($_POST['action'] == 'searchDatosfiniquito')
        {
            if(!empty($_POST['op'])){
                $noempleado = $_POST['op'];

                $query = mysqli_query($conection,"SELECT fecha_contrato, salarioxdia, CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as empleado FROM empleados WHERE noempleado = $noempleado ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }

// Buscar Datos finiquito Nombre
        if($_POST['action'] == 'searchDatosfiniquitoName')
        {
            if(!empty($_POST['op'])){
                $nameempleado = $_POST['op'];

                $query = mysqli_query($conection,"SELECT fecha_contrato, salarioxdia, noempleado FROM empleados WHERE CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) = '$nameempleado' ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }


// Elimina empleado de nomina semanal

        if($_POST['action'] == 'delDetnomsem'){

            if(empty($_POST['id_detalle']))
            {
                echo 'error';
            }else{
                $id_detalle = $_POST['id_detalle'];
                
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_nomsem($id_detalle, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaDetPe = '';

                $arrayData = array();

                if($result > 0){

                    while ($data = mysqli_fetch_assoc($query_detalle_temppe)){

                        $detalleTablaDetPe .= '<tr>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_nomsem('.$data['id'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                            <td style="text-align:right; font-size: 12px;" >'.$data['no_semana'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['no_empleado'].'</td>
                                            
                                            <td style="font-size: 12px;">'.$data['nombre'].'</td>
                                            <td style="font-size: 12px;">'.$data['cargo'].'</td>
                                            <td style="font-size: 12px;">'.$data['imss'].'</td>
                                            <td style="font-size: 12px;">'.$data['estatus'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['sueldo_base'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['viajes_especiales'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['viajes_contrato'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['bono_categoria'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['bono_supervisor'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['bono_semanal'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['apoyo_mensual'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['total_especiales'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['sueldo_adicional'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['prima_vacacional'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['total_vueltas'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['sueldo_bruto'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['pago_fiscal'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['deduccion_fiscal'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['descuento_adeudo'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['caja'].'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['total_nomina'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.number_format($data['total_general'],2).'</td>
                                            <td style="text-align:right; font-size: 12px;">'.$data['no_empleado'].'</td>

                                            <td align="center"><a id="alumno" 
                                                data-target="#modalIndicador" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nosem="'.$data['no_semana'].'" 
                                                data-noempl="'.$data['no_empleado'].'"
                                                data-name="'.$data['nombre'].'"
                                                data-dias="'.$data['dias_vacaciones'].'"
                                                data-cargo="'.$data['deduccion_fiscal'].'"
                                                data-imss="'.$data['vacaciones'].'"
                                                data-vesp="'.$data['prima_vacacional'].'"
                                                data-totnom="'.$data['total_nomina'].'"
                                                data-totgral="'.$data['total_general'].'"
                                                
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }


                $arrayData['detalledelete'] = $detalleTablaDetPe;


                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

            }else{
                echo 'error';
            }   
                mysqli_close($conection);   
            }
        
            exit;
        } 



 //****************************//
        //Buscar dias de vacaciones por empleado
        if($_POST['action'] == 'searchDiasvacac'){

                $empleado    = $_POST['op'];
                $tipo_incidencia  = $_POST['tipoincidencia'];

                $token       = md5($_SESSION['idUser']);
                $usuario     = $_SESSION['idUser'];

                $query_procesarcf = mysqli_query($conection,"CALL buscar_diasvacaciones('$empleado', '$tipo_incidencia', '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
            
            }       


// Buscar fecha finiquito con fecha baja
       if($_POST['action'] == 'searchDatosfiniquitofchabaja'){

                $query_borra = mysqli_query($conection,"TRUNCATE datos_finiquito");

                $fchabaja      = $_POST['op'];
                $fchaingreso   = $_POST['fechaingreso'];
                $salariodiario = $_POST['salariodiario'];
                $noempleado    = $_POST['noempleado'];

                $token       = md5($_SESSION['idUser']);
                $usuario     = $_SESSION['idUser'];

                $query_procesarcf = mysqli_query($conection,"CALL buscar_diasfiniquito($noempleado, '$fchabaja', '$fchaingreso', $salariodiario , '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
            
            }  

//*Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaFiniquito')
{
    if(empty($_POST['fecha']) || empty($_POST['noempleado']) )
    {
         echo 'error';
    }else {     

        $fecha           = $_POST['fecha'];
        $noempleado      = $_POST['noempleado'];
        $empleado        = $_POST['empleado'];
        $fcha_ingreso    = $_POST['fechaingreso'];
        $fcha_baja       = $_POST['fechabaja'];
        $antiguedad      = $_POST['antiguedad'];
        $dias_trabajados = $_POST['dtrabajados'];
        $dias_ultsemana  = $_POST['dultimasem'];
        $salario_diario  = $_POST['salariodia'];
        $dias_vacacions  = $_POST['dvacaciones'];
        $dias_vacpropor  = $_POST['dvacproporc'];
        $porc_primavac   = $_POST['porcprima'];
        $dias_aguinaldo  = $_POST['daguinaldo'];
        $dias_agipropor  = $_POST['daguiproporc']; 
        $importe_ultsem  = $_POST['impultimasem'];
        $importe_aguindo = $_POST['impaguinaldo'];
        $importe_viajes  = $_POST['impviajes'];
        $importe_vacans  = $_POST['impvacacions'];
        $importe_primavc = $_POST['impprimavac'];
        $otras_compensac = $_POST['otrascompens'];
        $importe_total   = $_POST['imptotal'];
        $importe_adeudos = $_POST['impadeudos'];
        $importe_neto    = $_POST['impneto'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_finiquito('$fecha', $noempleado, '$empleado', '$fcha_ingreso', '$fcha_baja', $antiguedad, $dias_trabajados, $dias_ultsemana, $salario_diario, $dias_vacacions, $dias_vacpropor, $porc_primavac, $dias_aguinaldo, $dias_agipropor, $importe_ultsem, $importe_aguindo, $importe_viajes, $importe_vacans, $importe_primavc, $otras_compensac, $importe_total, $importe_adeudos, $importe_neto, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

   
    }
    exit;
}


// Nomina Especial
        if($_POST['action'] == 'ActualizaNominaEspecial')
                {
                    $fechapago = $_POST['fechapago'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL procesa_nomespecial('$fechapago', '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }

// Copia Vuelta Especial
    if($_POST['action'] == 'AddCopiaVuelta')
    {
      if(!empty($_POST['idcp']) )
      {
        $idcp      = $_POST['idcp'];
        
        $token    = md5($_SESSION['idUser']);
        $usuario  = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL copia_vueltasp($idcp, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    } 


// Nomina Semanal
        if($_POST['action'] == 'ActualizaNominaSemanal')
                {
                    $semana = $_POST['semana'];
                    $token  = md5($_SESSION['idUser']);
                    
                    $query_delete = mysqli_query($conection,"TRUNCATE dias_alertas ");
                    $query_insert = mysqli_query($conection,"INSERT INTO dias_alertas (name_empleado, noalertas) SELECT operador, noalertas from alertas where semana = '$semana' and YEAR(fecha) = YEAR(CURDATE()) group by operador, noalertas ");

                    $query_procesarcf = mysqli_query($conection,"CALL procesar_nomina('$semana')");
                    var_dump($query_procesarcf);
                    $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){

                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }

// Borra Empleado en Nomina Semanal
        if($_POST['action'] == 'DeleteEmpleadoNomSem')
                {
                    $noempleado = $_POST['noempleado'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL borra_empleadonomsem($noempleado)");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }

// Buscar Cliente para Pedido
        if($_POST['action'] == 'searchNoempleado')
        {
            if(!empty($_POST['op'])){
                $noempleado = $_POST['op'];

                $query = mysqli_query($conection,"SELECT CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) as name_empleado from empleados WHERE noempleado = $noempleado");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }

// Buscar Cliente para Pedido
        if($_POST['action'] == 'searchNameempleado')
        {
            if(!empty($_POST['op'])){
                $nombreempleado = $_POST['op'];

                $query = mysqli_query($conection,"SELECT noempleado as num_empleado from empleados WHERE CONCAT(nombres, ' ', apellido_paterno, ' ', apellido_materno) = '$nombreempleado'");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }        

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditIncidencia')
{
    if(empty($_POST['tincidencia']) || empty($_POST['empleado']) || empty($_POST['diasvac']))
    {
        echo 'error';
    }else {    
        $id  = $_POST['inputid'];
        $incidencia  = $_POST['tincidencia'];
        $empleado    = $_POST['empleado'];
        $diastomar   = $_POST['diastomar'];
        $diasderecho = $_POST['diasderecho'];
        $fecha_ini   = $_POST['fechaini'];
        $fecha_fin   = $_POST['fechafin'];
        $dias_vac    = $_POST['diasvac'];
        $notas       = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
 
        $query_procesar = mysqli_query($conection,"CALL procesar_editincidencia($id, '$incidencia', '$empleado', $diasderecho, $diastomar, '$fecha_ini', '$fecha_fin', $dias_vac, '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }
    exit;
}

//*Edita Finiquito
if($_POST['action'] == 'AlmacenaEditFiniquito')
{
    if(empty($_POST['fecha']) || empty($_POST['noempleado']) )
    {
         echo 'error';
    }else {     

        $idf             = $_POST['idf'];
        $fecha           = $_POST['fecha'];
        $noempleado      = $_POST['noempleado'];
        $empleado        = $_POST['empleado'];
        $fcha_ingreso    = $_POST['fechaingreso'];
        $fcha_baja       = $_POST['fechabaja'];
        $antiguedad      = $_POST['antiguedad'];
        $dias_trabajados = $_POST['dtrabajados'];
        $dias_ultsemana  = $_POST['dultimasem'];
        $salario_diario  = $_POST['salariodia'];
        $dias_vacacions  = $_POST['dvacaciones'];
        $dias_vacpropor  = $_POST['dvacproporc'];
        $porc_primavac   = $_POST['porcprima'];
        $dias_aguinaldo  = $_POST['daguinaldo'];
        $dias_agipropor  = $_POST['daguiproporc']; 
        $importe_ultsem  = $_POST['impultimasem'];
        $importe_aguindo = $_POST['impaguinaldo'];
        $importe_viajes  = $_POST['impviajes'];
        $importe_vacans  = $_POST['impvacacions'];
        $importe_primavc = $_POST['impprimavac'];
        $otras_compensac = $_POST['otrascompens'];
        $importe_total   = $_POST['imptotal'];
        $importe_adeudos = $_POST['impadeudos'];
        $importe_neto    = $_POST['impneto'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editfiniquito($idf, '$fecha', $noempleado, '$empleado', '$fcha_ingreso', '$fcha_baja', $antiguedad, $dias_trabajados, $dias_ultsemana, $salario_diario, $dias_vacacions, $dias_vacpropor, $porc_primavac, $dias_aguinaldo, $dias_agipropor, $importe_ultsem, $importe_aguindo, $importe_viajes, $importe_vacans, $importe_primavc, $otras_compensac, $importe_total, $importe_adeudos, $importe_neto, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

   
    }
    exit;
}

//* Elimina Finiquito **//
if($_POST['action'] == 'BorraFiniquito')
{

        $idf          = $_POST['idf'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

   
       $query_del = mysqli_query($conection,"DELETE FROM finiquitos WHERE id = '$idf' ");
            mysqli_close($conection);
            if($query_del){
                echo 'ok';
            }else{
                echo 'error';
            }
            exit;
      
      
} 


//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaGasolinera')
{
    if(!empty($_POST['razon_social']) || !empty($_POST['name_corto']))
    {
        $razon_social = $_POST['razon_social'];
        $name_corto   = $_POST['name_corto'];
        $direccion    = $_POST['direccion'];
        $phone        = $_POST['phone'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_gasolinera('$razon_social', '$name_corto', '$direccion', '$phone', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditGasolinera')
{
    if(!empty($_POST['razon_social']) || !empty($_POST['name_corto']))
    {
        $idf          = $_POST['idf'];
        $razon_social = $_POST['razon_social'];
        $name_corto   = $_POST['name_corto'];
        $direccion    = $_POST['direccion'];
        $phone        = $_POST['phone'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editgasolinera($idf, '$razon_social', '$name_corto', '$direccion', '$phone', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


//* Elimina Gasolinera **//
if($_POST['action'] == 'BajaGas')
{

        $idf          = $_POST['idf'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

   
       $query_del = mysqli_query($conection,"UPDATE gasolineras SET estatus = 0 WHERE id = $idf ");
            mysqli_close($conection);
            if($query_del){
                echo 'ok';
            }else{
                echo 'error';
            }
            exit;
      
      
}

// Cancela Solicitud de Mantenimiento 

if($_POST['action'] == 'BajaSolicitud')
{

        $idc          = $_POST['idc'];
        $noorden      = $_POST['noorden'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

            $query_procesar = mysqli_query($conection,"CALL baja_solicitud($idc, $noorden, $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
    exit;
} 

//Baja Cliente
if($_POST['action'] == 'BajaCliente')
{

        $idc          = $_POST['idc'];
        $cliente      = $_POST['cliente'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

   
       $query_insert = mysqli_query($conection,"SELECT count(*) as numreg FROM clientes where  id = $idc and estatus = 0");
       while ($data = mysqli_fetch_assoc($query_insert)){
        $noreg = $data['numreg'];
       } 

       if ($noreg == 0) {
            $query_procesar = mysqli_query($conection,"CALL baja_clientes($idc, '$cliente', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       }else {
         echo "error";
         exit;
       }
    exit;
} 


//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditSupervisor')
{
    if(!empty($_POST['nombres']) || !empty($_POST['paterno']) || !empty($_POST['materno']))
    {
        $ids        = $_POST['Id'];
        $nombres    = $_POST['nombres'];
        $paterno    = $_POST['paterno'];
        $materno    = $_POST['materno'];
        $phone      = $_POST['phone'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editsupervisor($ids, '$nombres', '$paterno', '$materno', '$phone', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


//Baja Supervisor
if($_POST['action'] == 'BajaSupervisor')
{

        $ids          = $_POST['ids'];
        $supervisor   = $_POST['supervisor'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

   
       $query_insert = mysqli_query($conection,"SELECT count(*) as numreg FROM supervisores where  id = $ids and estatus = 0");
       while ($data = mysqli_fetch_assoc($query_insert)){
        $noreg = $data['numreg'];
       } 

       if ($noreg == 0) {
            $query_procesar = mysqli_query($conection,"CALL baja_supervisor($ids, '$supervisor', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       }else {
         echo "error";
         exit;
       }
    exit;
} 


//Baja Unidad
if($_POST['action'] == 'BajaUnidad')
{

        $idu         = $_POST['idu'];
        $no_unidad   = $_POST['nounidad'];
        $descripcion = $_POST['descripcion']; 

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

       $query_insert = mysqli_query($conection,"SELECT count(*) as numreg FROM unidades where  id = $idu and estatus = 0");
       while ($data = mysqli_fetch_assoc($query_insert)){
        $noreg = $data['numreg'];
       } 

       if ($noreg == 0) {
            $query_procesar = mysqli_query($conection,"CALL baja_unidad($idu, '$no_unidad', '$descripcion', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       }else {
         echo "error";
         exit;
       }
    exit;
} 

//Almacena Edición Ruta
if($_POST['action'] == 'AlmacenaEditRuta')
{
    if(!empty($_POST['cliente']) || !empty($_POST['ruta']) || !empty($_POST['operador']))
    {
        $idrt       = $_POST['Id'];
        $cliente    = $_POST['cliente'];
        $ruta       = $_POST['ruta'];
        $noeco      = $_POST['noeconomico'];
        $operador   = $_POST['operador'];
        $horario1   = $_POST['horario1'];
        $horario2   = $_POST['horario2'];
        $horario3   = $_POST['horario3'];
        $hmixto1    = $_POST['hmixto1'];
        $hmixto2    = $_POST['hmixto2'];
        $diasviajes = $_POST['diasviajes'];
        $sueldo_vta = $_POST['sueldo_vta'];
        $sueldo_vtaneta = $_POST['sueldo_vtaneta'];
        $sueldo_semid   = $_POST['sueldo_semid'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editruta($idrt, '$cliente', '$ruta', '$noeco', '$operador', '$horario1', '$horario2', '$horario3', '$hmixto1', '$hmixto2', '$diasviajes', $sueldo_vta, $sueldo_vtaneta, $sueldo_semid, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Baja Unidad
if($_POST['action'] == 'BajaRuta')
{

        $idr     = $_POST['idr'];
        $cliente = $_POST['cliente'];
        $ruta    = $_POST['ruta']; 

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

       $query_insert = mysqli_query($conection,"SELECT count(*) as numreg FROM rutas where  id = $idr and estatus = 0");
       while ($data = mysqli_fetch_assoc($query_insert)){
        $noreg = $data['numreg'];
       } 

       if ($noreg == 0) {
            $query_procesar = mysqli_query($conection,"CALL baja_ruta($idr, '$cliente', '$ruta', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       }else {
         echo "error";
         exit;
       }
    exit;
} 

//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalleditRouter'){
                
                $c_folio = $_POST['nofolio'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_routers WHERE folio = $c_folio ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['horario_t1'].'</td>
                                            <td>'.$data['horario_t2'].'</td>
                                            <td>'.$data['horario_t3'].'</td>
                                            <td>'.$data['parada'].'</td>
                                            <td>'.$data['referencia'].'</td>
                                            <td>'.$data['no_paradas'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); delete_detarouter('.$data['id'].','.$data['folio'].');"><i class="fas fa-ban"></i></a>
                                            </td>
                                            <td align="center"><a id="router" 
                                                data-target="#modalIndicadorouter" 
                                                data-toggle="modal" 
                                                data-folio="'.$data['folio'].'"
                                                data-id="'.$data['id'].'"
                                                data-ht1="'.$data['horario_t1'].'" 
                                                data-ht2="'.$data['horario_t2'].'"
                                                data-ht3="'.$data['horario_t3'].'"
                                                data-pard="'.$data['parada'].'"
                                                data-refcia="'.$data['referencia'].'"
                                                data-nopard="'.$data['no_paradas'].'"

                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }   

// ***** Agrega Edicion de Router //
    
    if($_POST['action'] == 'ActualizaDetalleEditrouter'){

            if(empty($_POST['folio']) )
            {
                echo "error";
            }else { 
                $folio       = $_POST['folio'];
                $hturno1     = $_POST['hturno1'];
                $hturno2     = $_POST['hturno2'];
                $hturno3     = $_POST['hturno3'];
                $parada      = $_POST['parada'];
                $referencia  = $_POST['referencia'];
                $nuparadas   = $_POST['numparadas'];
            
                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL add_detalleeditrouter($folio, '$hturno1', '$hturno2', '$hturno3', '$parada', '$referencia', $nuparadas, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $arrayData = array();
                $fila = 0;

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                        $fila = $fila + 1;
                        
                        $detalleTabla .= '<tr>
                                            <td>'.$data['horario_t1'].'</td>
                                            <td>'.$data['horario_t2'].'</td>
                                            <td>'.$data['horario_t3'].'</td>
                                            <td>'.$data['parada'].'</td>
                                            <td>'.$data['referencia'].'</td>
                                            <td>'.$data['no_paradas'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); delete_detarouter('.$data['id'].','.$data['folio'].');"><i class="fas fa-ban"></i></a>
                                            </td>
                                            <td align="center"><a id="router" 
                                                data-target="#modalIndicadorouter" 
                                                data-toggle="modal" 
                                                data-folio="'.$data['folio'].'"
                                                data-id="'.$data['id'].'"
                                                data-ht1="'.$data['horario_t1'].'" 
                                                data-ht2="'.$data['horario_t2'].'"
                                                data-ht3="'.$data['horario_t3'].'"
                                                data-pard="'.$data['parada'].'"
                                                data-refcia="'.$data['referencia'].'"
                                                data-nopard="'.$data['no_paradas'].'"

                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                $arrayData['detalle'] = $detalleTabla;
                
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }
            exit;   
            }
        }

//Baja Unidad
if($_POST['action'] == 'BajaRouter')
{

        $idr     = $_POST['idr'];
        $cliente = $_POST['cliente'];
        $ruta    = $_POST['ruta']; 

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

       $query_insert = mysqli_query($conection,"SELECT count(*) as numreg FROM routers where  folio = $idr and estatus = 0");
       while ($data = mysqli_fetch_assoc($query_insert)){
        $noreg = $data['numreg'];
       } 

       if ($noreg == 0) {
            $query_procesar = mysqli_query($conection,"CALL baja_router($idr, '$cliente', '$ruta', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       }else {
         echo "error";
         exit;
       }
    exit;
} 

// Nomina Semanal
        if($_POST['action'] == 'ActualizaNominaQuincenal')
                {
                    $quincena = $_POST['quincena'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL procesa_nomquincenal23('$quincena', '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }

// Buscar No Semana segun Fecha
        if($_POST['action'] == 'searchNosemana')
        {
            if(!empty($_POST['op'])){
                $fecha = $_POST['op'];

                $query = mysqli_query($conection,"SELECT semana FROM semanas40 WHERE dia_inicial <= '$fecha' AND dia_final >= '$fecha'");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }


//Agregar Productos a Entrada.
if($_POST['action'] == 'ActualizaEjercicio')
{
    

        $ejercicioactual = $_POST['ejercicio_actual'];
        $ejercicionuevo  = $_POST['ejercicio_nuevo'];
    
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL procesar_cierreejercicio($ejercicioactual, $ejercicionuevo, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
     }

// borrar Carga de combustible

if($_POST['action'] == 'deleteAlerta')
{
    $folio = $_POST['clienteId'];

    $query_delone = mysqli_query($conection,"DELETE from alertas WHERE id  = $folio");
    //*$query_del = mysqli_query($conection,"DELETE FROM contactos_cliente WHERE nombre = '$cliente_num'");
        
            mysqli_close($conection);
            if($query_delone){
                echo 'ok';
            }else{
                echo 'error';
            }
            exit;
}     

 // borrar Incidencia
if($_POST['action'] == 'deleteIncidencia')
{
    $folio = $_POST['clienteId'];
    $diasv = $_POST['valord'];
    $nombreempleado = $_POST['nameempleado'];

    $query_delone = mysqli_query($conection,"DELETE FROM incidencias WHERE id  = $folio");
    $query_del = mysqli_query($conection,"UPDATE empleados SET vacaciones = vacaciones + $diasv WHERE CONCAT (nombres, ' ', apellido_paterno, ' ', apellido_materno) = '$nombreempleado'");
        
            mysqli_close($conection);
            if($query_delone){
                echo 'ok';
            }else{
                echo 'error';
            }
            exit;
}

// borrar Usuario
if($_POST['action'] == 'deleteUsuario')
{
    $folio = $_POST['clienteId'];

    $query_delone = mysqli_query($conection,"UPDATE usuario SET estatus = 0 WHERE idusuario  = $folio");
    //*$query_del = mysqli_query($conection,"DELETE FROM contactos_cliente WHERE nombre = '$cliente_num'");
        
            mysqli_close($conection);
            if($query_delone){
                echo 'ok';
            }else{
                echo 'error';
            }
            exit;
}



// Nomina Semanal
        if($_POST['action'] == 'cambiaFolioom')
                {
                    $folio = $_POST['folio_om'];
                    $serie = $_POST['serie_om'];

                    $query_procesarcf = mysqli_query($conection,"CALL actualiza_folioom('$serie', $folio)");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }


//Extra datos de nomina semanal
        if($_POST['action'] == 'searchForDetalleditNominasem'){
                
                $c_nonomina = $_POST['nonomina'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_nomina WHERE no_semana = $c_nonomina ORDER BY no_empleado ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['no_semana'].'</td>
                                            <td>'.$data['no_empleado'].'</td>
                                            <td>'.$data['nombre'].'</td>
                                            <td>'.$data['cargo'].'</td>
                                            <td>'.$data['imss'].'</td>
                                            <td>'.$data['estatus'].'</td>
                                            <td>'.$data['sueldo_base'].'</td>
                                            <td>'.$data['viajes_especiales'].'</td>
                                            <td>'.$data['viajes_contrato'].'</td>
                                            <td>'.$data['bono_categoria'].'</td>
                                            <td>'.$data['bono_supervisor'].'</td>
                                            <td>'.$data['bono_semanal'].'</td>
                                            <td>'.$data['apoyo_mensual'].'</td>
                                            <td>'.$data['total_especiales'].'</td>
                                            <td>'.$data['sueldo_adicional'].'</td>
                                            <td>'.$data['prima_vacacional'].'</td>
                                            <td>'.$data['vacaciones'].'</td>
                                            <td>'.$data['total_vueltas'].'</td>
                                            <td>'.$data['sueldo_bruto'].'</td>
                                            <td>'.$data['pago_fiscal'].'</td>
                                            <td>'.$data['deduccion_fiscal'].'</td>
                                            <td>'.$data['descuento_adeudo'].'</td>
                                            <td>'.$data['caja'].'</td>
                                            <td>'.$data['total_nomina'].'</td>
                                            <td>'.$data['total_general'].'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }

                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }       

      
//*Cambia  Nomina de Empleado
if($_POST['action'] == 'ActualizaNomEmpleado')
{
    if(!empty($_POST['nosemana']) || !empty($_POST['noempleado']) )
    {
        
        $no_semana     = $_POST['nosemana'];
        $no_empleado   = $_POST['noempleado'];
        $name_empleado = $_POST['nameempleado'];
        $sueldo_base   = $_POST['sueldo_base'];
        $viajes_espc   = $_POST['viajes_espc'];
        $viajes_ctrato = $_POST['viajes_cto'];
        $adeudo        = $_POST['adeudo'];
        $caja          = $_POST['caja'];
        $bono_categ    = $_POST['bono_categ'];
        $bono_superv   = $_POST['bono_superv'];
        $bono_semanal  = $_POST['bono_semanal'];
        $apoyo_mes     = $_POST['apoyo_mes'];
        $sueldo_add    = $_POST['sueldo_add'];
        $sueldo_espc   = $_POST['total_espc'];
        $total_ctrato  = $_POST['total_cto'];
        $prima_vacac   = $_POST['prima_vacac'];
        $vacaciones    = $_POST['vacaciones'];
        $sueldo_bruto  = $_POST['sueldo_bruto'];
        $pago_fiscal   = $_POST['pago_fiscal'];
        $impuesto_fisc = $_POST['impuesto_fis'];
        $total_nomina  = $_POST['total_nomina'];
        $total_gral    = $_POST['total_gral'];
        $total_total   = $_POST['total_total'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_nomimaempleado('$no_semana', $no_empleado, '$name_empleado', $sueldo_base, $viajes_espc, $viajes_ctrato, $adeudo, $caja, $bono_categ, $bono_superv, $bono_semanal, $apoyo_mes, $sueldo_add, $sueldo_espc, $total_ctrato, $prima_vacac, $vacaciones, $sueldo_bruto, $pago_fiscal, $impuesto_fisc, $total_nomina, $total_gral, $total_total, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//*
if($_POST['action'] == 'ActualizaParadarouter'){

            
                $folio_p     = $_POST['folio_p'];
                $idpard      = $_POST['idpard'];
                $hturno1     = $_POST['horario1pd'];
                $hturno2     = $_POST['horario2pd'];
                $hturno3     = $_POST['horario1pd'];
                $parada      = $_POST['paradart'];
                $referencia  = $_POST['referenciapd'];
                $nuparadas   = $_POST['noparadaspd'];
            
                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_iddetallerouter($folio_p, $idpard, '$hturno1', '$hturno2', '$hturno3', '$parada', '$referencia', $nuparadas, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $arrayData = array();
                $fila = 0;

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                        $fila = $fila + 1;
                        
                        $detalleTabla .= '<tr>
                                            <td>'.$data['horario_t1'].'</td>
                                            <td>'.$data['horario_t2'].'</td>
                                            <td>'.$data['horario_t3'].'</td>
                                            <td>'.$data['parada'].'</td>
                                            <td>'.$data['referencia'].'</td>
                                            <td>'.$data['no_paradas'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); delete_detarouter('.$data['id'].','.$data['folio'].');"><i class="fas fa-ban"></i></a>
                                            </td>
                                            <td align="center"><a id="router" 
                                                data-target="#modalIndicadorouter" 
                                                data-toggle="modal" 
                                                data-folio="'.$data['folio'].'"
                                                data-id="'.$data['id'].'"
                                                data-ht1="'.$data['horario_t1'].'" 
                                                data-ht2="'.$data['horario_t2'].'"
                                                data-ht3="'.$data['horario_t3'].'"
                                                data-pard="'.$data['parada'].'"
                                                data-refcia="'.$data['referencia'].'"
                                                data-nopard="'.$data['no_paradas'].'"

                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                $arrayData['detalle'] = $detalleTabla;
                
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }
            exit;   
            
        }

// Buscar supervisor Extras
        if($_POST['action'] == 'searchSuperoperador')
        {
            if(!empty($_POST['op'])){
                $nombreempleado = $_POST['op'];

                $query = mysqli_query($conection,"SELECT em.supervisor, sv.idacceso from empleados em INNER JOIN supervisores sv ON em.supervisor = CONCAT(sv.nombres, ' ', sv.apellido_paterno, ' ', sv.apellido_materno) WHERE CONCAT(em.nombres, ' ', em.apellido_paterno, ' ', em.apellido_materno) = '$nombreempleado'");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }                

//Almacena Refaccion
if($_POST['action'] == 'AlmacenaRefaccion')
{
    if(!empty($_POST['codigo']) || !empty($_POST['descripcion']))
    {
        $codigo      = $_POST['codigo'];
        $codigo_intr = $_POST['codigo_int'];
        $descripcion = $_POST['descripcion'];
        $unidadmedid = $_POST['unidadmed'];
        $marca       = $_POST['marca'];
        $rotacion    = $_POST['rotacion'];
        $categoria   = $_POST['categoria'];
        $modelo      = $_POST['modelo'];
        $costo       = $_POST['costo'];
        $impuesto    = $_POST['impuesto'];
        $impisr      = $_POST['imp_isr'];
        $impieps     = $_POST['imp_ieps'];
        $stock_max   = $_POST['stockmax'];
        $stock_min   = $_POST['stockmin'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL procesar_refaccion('$codigo', '$codigo_intr', '$descripcion', '$unidadmedid', '$marca', '$rotacion', '$categoria', '$modelo', $costo, $impuesto, $impisr, $impieps, $stock_max, $stock_min, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


//Almacena Edicion Refaccion
if($_POST['action'] == 'AlmacenaEditRefaccion')
{
    if(!empty($_POST['codigo']) || !empty($_POST['descripcion']))
    {
        $idr      = $_POST['idr'];
        $codigo      = $_POST['codigo'];
        $codinterno  = $_POST['codigointer'];
        $descripcion = $_POST['descripcion'];
        $unidadmedid = $_POST['unidadmedid'];
        $marca       = $_POST['marca'];
        $rotacion    = $_POST['rotacion'];
        $categoria   = $_POST['categoria'];
        $modelo      = $_POST['modelo'];
        $costo       = $_POST['costo'];
        $impuesto    = $_POST['impuesto'];
        $impisr      = $_POST['imp_isr'];
        $impieps     = $_POST['imp_ieps'];
        $stock_max   = $_POST['stockmax'];
        $stock_min   = $_POST['stockmin'];
        $estatus     = $_POST['status'];


        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL procesar_editrefaccion($idr, '$codigo', '$codinterno', '$descripcion', '$unidadmedid', '$marca', '$rotacion', '$categoria', '$modelo', $costo, $impuesto, $impisr, $impieps, $stock_max, $stock_min, $estatus, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


//Baja Refaccion
if($_POST['action'] == 'BajaRefaccion')
{

        $idr     = $_POST['idr'];
        $codigo = $_POST['codigo'];
        $name    = $_POST['name']; 

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

       $query_insert = mysqli_query($conection,"SELECT count(*) as numreg FROM refacciones where  id = $idr and estatus = 0");
       while ($data = mysqli_fetch_assoc($query_insert)){
        $noreg = $data['numreg'];
       } 

       if ($noreg == 0) {
            $query_procesar = mysqli_query($conection,"CALL baja_refaccion($idr, '$codigo', '$name', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       }else {
         echo "error";
         exit;
       }
    exit;
} 


//*Almacena Proveedor
if($_POST['action'] == 'AlmacenaProveedor')
{
    if(empty($_POST['noprov']) || empty($_POST['nameprov']) || empty($_POST['razonsoc']) )
    {
         echo 'error';
    }else {     

        $noprov       = $_POST['noprov'];
        $nameprov     = $_POST['nameprov'] ?? "";
        $callenum     = $_POST['callenum'] ?? "";
        $colonia      = $_POST['colonia'] ?? "";
        $ciudad       = $_POST['ciudad'] ?? "";
        $municipio    = $_POST['municipio'] ?? "";
        $estado       = $_POST['estado'] ?? "";
        $codpostal    = $_POST['codpostal'] ?? "";
        $pais         = $_POST['pais'] ?? "";
        $phone        = $_POST['phone'] ?? "";
        $contacto     = $_POST['contacto'] ?? "";
        $email        = $_POST['correo'] ?? "";
        $giro         = $_POST['giro'] ?? "";
        $phonecontac  = $_POST['phonecontac'] ?? ""; 
        $servicio     = $_POST['servicio'] ?? "";
        $sitioweb     = $_POST['sitioweb'] ?? "";
        $razonsoc     = $_POST['razonsoc'] ?? "";
        $rfccte       = $_POST['rfccte'] ?? "";
        $cont_conta   = $_POST['contactocont'] ?? "";
        $email_conta  = $_POST['emailconta'] ?? "";
        $credito      = $_POST['credito'] ?? "";
        $condicionesc = $_POST['condicionesc'] ?? "";
        $limite       = $_POST['limite'] ?? "";

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $sql_insert_proveedor = "INSERT INTO proveedores (no_prov, nombre_corto, calle, colonia, ciudad, municipio, estado, cod_postal, pais, telefono, contacto, correo, giro, movil, servicio, sitio, nombre, rfc, contacto_conta, email_conta, credito, condiciones_credito, limite_credito, usuario_id) VALUES ('$noprov', '$nameprov', '$callenum', '$colonia', '$ciudad', '$municipio', '$estado', '$codpostal', '$pais', '$phone', '$contacto', '$email', '$giro', '$phonecontac', '$servicio', '$sitioweb', '$razonsoc', '$rfccte', '$cont_conta', '$email_conta', '$credito', '$condicionesc', $limite, $usuario)";
        echo $sql_insert_proveedor;
        $query_procesar = mysqli_query($conection, $sql_insert_proveedor);
        $result_detalle = mysqli_affected_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }
    exit;
}


//*Almacena Edicion Proveedor
if($_POST['action'] == 'AlmacenaEditProveedor')
{
    if(empty($_POST['noprov']) || empty($_POST['nameprov']) || empty($_POST['razonsoc']) )
    {
         echo 'error';
    }else {     

        $idp          = $_POST['idprov'];
        $noprov       = $_POST['noprov'];
        $nameprov     = $_POST['nameprov'];
        $callenum     = $_POST['callenum'];
        $colonia      = $_POST['colonia'];
        $ciudad       = $_POST['ciudad'];
        $municipio    = $_POST['municipio'];
        $estado       = $_POST['estado'];
        $codpostal    = $_POST['codpostal'];
        $pais         = $_POST['pais'];
        $phone        = $_POST['phone'];
        $contacto     = $_POST['contacto'];
        $email        = $_POST['correo'];
        $giro         = $_POST['giro'];
        $phonecontac  = $_POST['phonecontac']; 
        $servicio     = $_POST['servicio'];
        $sitioweb     = $_POST['sitioweb'];
        $razonsoc     = $_POST['razonsoc'];
        $rfccte       = $_POST['rfccte'];
        $cont_conta   = $_POST['contactocont'];
        $email_conta  = $_POST['emailconta'];
        $credito      = $_POST['credito'];
        $condicionesc = $_POST['condicionesc'];
        $limite       = $_POST['limitec'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editproveedor($idp, '$noprov', '$nameprov', '$callenum', '$colonia', '$ciudad', '$municipio', '$estado', '$codpostal', '$pais', '$phone', '$contacto', '$email', '$giro', '$phonecontac', '$servicio', '$sitioweb', '$razonsoc', '$rfccte', '$cont_conta', '$email_conta', '$credito', '$condicionesc', $limite, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }
    exit;
}


//****************************//
        //Cancelar Requisicion
   if($_POST['action'] == 'procesarSalirCortizacioncp'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_cotizacioncompra($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    }   

// Buscar Cliente para Pedido
        if($_POST['action'] == 'searchRefaccionesmov')
        {
            if(!empty($_POST['op'])){
                $codprov = $_POST['op'];

                $query = mysqli_query($conection,"SELECT id, codigo, descripcion, marca, costo, impuesto, impuesto_isr, impuesto_ieps, TRUNCATE(costo + (costo * (impuesto/100)),2) as precioiva, umedida FROM refacciones WHERE codigo = '$codprov' ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);
                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }   
        

// Buscar Cliente para Pedido
        if($_POST['action'] == 'searchRefaccionesmovname')
        {
            if(!empty($_POST['op'])){
                $nameprov = $_POST['op'];

                $query = mysqli_query($conection,"SELECT id, codigo, descripcion, marca, costo, impuesto, impuesto_isr, impuesto_ieps, TRUNCATE(costo + (costo * (impuesto/100)),2) as precioiva, umedida FROM refacciones WHERE descripcion = '$nameprov' ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }  

// Agregar Detalle a la Requisicion
        if($_POST['action'] == 'AddDetallecotizacion'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio      = $_POST['folio'];
                $codigo       = $_POST['codigo'];
                $descripcion  = $_POST['descripcion'];
                $marca        = $_POST['marca'];
                $cantidad     = $_POST['cantidad'];
                $precio       = $_POST['precio'];
                $impuesto     = $_POST['impuesto'];
                $impuestoisr  = $_POST['impuestoisr'];
                $impuestoieps = $_POST['impuestoieps'];
                $importe      = $_POST['importe'];
                $datoe        = $_POST['datoe'];
                $datoom       = $_POST['datoom'];
                
                $token        = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detallecotizacion($nofolio, '$codigo', '$descripcion', '$marca', $cantidad, $precio, $impuesto, $impuestoisr, $impuestoieps, $importe, '$datoe', '$datoom', '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    $totsubtotal = $totsubtotal + $subtotal;
                    //$totiva = $totiva + $iva;
                    


                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td>'.$data['dato_e'].'</td>
                                            <td>'.$data['dato_om'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                data-datoe="'.$data['dato_e'].'"
                                                data-datoom="'.$data['dato_om'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        } 


// Elimina refacciones del detalle Temporal Mannto

        if($_POST['action'] == 'delDeattecotizacion'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempcotiza($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = (($data['cantidad'] * $data['precio']) * $data['impuesto'])/100;
                    $totsubtotal = $totsubtotal + $subtotal;
                    //$totiva = $totiva + $iva;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td>'.($data['dato_e']).'</td>
                                            <td>'.($data['dato_om']).'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                data-datoe="'.$data['dato_e'].'"
                                                data-datoom="'.$data['dato_om'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
                  
                $arrayData['detalle'] = $detalleTablaPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }  


// Edita Movimiento Cotizacion Compra

if($_POST['action'] == 'ActualizaMovcotizacion'){

            
                $id_c       = $_POST['detid'];
                $folio_c    = $_POST['detfolio'];
                $codigo_c   = $_POST['detcodigo'];
                $descrip_c  = $_POST['detdescripc'];
                $marca_c    = $_POST['detmarca'];
                $cantidad_c = $_POST['detcantidad'];
                $precio_c   = $_POST['detprecio'];
                $impuesto_c = $_POST['detimpuesto'];
                $impisr_c   = $_POST['detimpisr'];
                $impieps_c  = $_POST['detimpieps'];
                $importe_c  = $_POST['detimporte'];
                $dato_e     = $_POST['detdatoe'];
                $dato_om    = $_POST['detdatoom'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detallecotizacion($id_c, $folio_c, '$codigo_c', '$descrip_c', '$marca_c', $cantidad_c, $precio_c, $impuesto_c, $impisr_c, $impieps_c, $importe_c, '$dato_e', '$dato_om', '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $detalleTotales = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = (($data['cantidad'] * $data['precio']) * $data['impuesto'])/100;
                    $totsubtotal = $totsubtotal + $subtotal;
                    //$totiva = $totiva + $iva;
                        
                        $detalleTabla .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td>'.$data['dato_e'].'</td>
                                            <td>'.$data['dato_om'].'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                data-datoe="'.$data['dato_e'].'"
                                                data-datoom="'.$data['dato_om'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    
                    
                $arrayData['detalle'] = $detalleTabla;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        } 


//Almacena Requisicion de compra
if($_POST['action'] == 'AlmacenaRequerimiento')
{
    if(empty($_POST['fecha']) || empty($_POST['tipo']) || empty($_POST['areasolicita']) )
    {
       echo 'error';
    }else{
        
        $folio        = $_POST['folio'];
        $fecha        = $_POST['fecha'];
        $fecha_req    = $_POST['fecha_req'];
        $tipo         = $_POST['tipo'];
        $areasolicita = $_POST['areasolicita'];
        $monto_aut    = $_POST['montoaut'];
        $notas        = $_POST['notas'];
        $mensaje      = $folio;
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_requisicion($folio, '$fecha', '$fecha_req', '$tipo', '$areasolicita', $monto_aut, '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            require '../PHPMailer/PHPMailerAutoload.php';

               

                $msjdelbody="\r\n". 'Se genero una nueva Requisición: '. $mensaje."\r\n"."\r\n".'Favor de revisar.'."\r\n"."\r\n".'Gracias';

                $enviomail  = "direccion@transvivegdl.com.mx";
                $nombremail = "Raúl Gutiérrez";
                $asunto = "Hay una nueva Requisición"; 
                

                $mail = new PHPMailer;
                $mail->isSMTP();
                $mail->SMTPDebug = 0;
                //*$mail->Host = 'smtp.office365.com';
                //**$mail->Host = 'smtp.gmail.com';
                //**$mail->Port = 587;
                $mail->Host = 'smtp.hostinger.com';
                $mail->Port = 587;
                $mail->SMTPAuth = true;
                $mail->Username = 'informes@dasha-web.com';
                $mail->Password = 'CHE_ito73';
                $mail->setFrom('informes@dasha-web.com', 'Software Transvive ERP');
                //$mail->SMTPAuth = true;
                //$mail->Username = 'rog_diaz@hotmail.com';
                //$mail->Password = 'CHE_ito73';
                //*$mail->setFrom('sistemasqualy@hotmail.com', 'Software TEXTILERP QUALY ');
                //*$mail->Username = 'textilerp.software@gmail.com';
                //*$mail->Password = 'yscxrwfshwcttrkd';
                //*$mail->setFrom('textilerp.software@gmail.com', 'CRM Transvive ');
                //$mail->addReplyTo('rogelio73diaz@gmail.com', 'prueba');
                $mail->addAddress($enviomail,utf8_decode($nombremail));
                //$mail->addAddress('rogelio73diaz@gmail.com','Rogelio Diaz');
                //$mail->addCC('mesacontrol@cqualy.com');
                //$mail->addCC('calidad.qualy@cqualy.com');
                $mail->addCC('rogelio73diaz@gmail.com');

                $mail->Subject = utf8_decode($asunto);
                $mail->Body = utf8_decode($msjdelbody);
                $mail->addAttachment('');
                $mail->send();

            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//****************************//
        //Cancelar orden de compra
   if($_POST['action'] == 'procesarSalirOrdencompra'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_ordencompra($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    }  

// Agregar Detalle a la Orden de Compra
        if($_POST['action'] == 'AddDetalleOrdencompra'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio     = $_POST['folio'];
                $codigo      = $_POST['codigo'];
                $descripcion = $_POST['descripcion'];
                $umedida     = $_POST['umedida'];
                $marca       = $_POST['marca'];
                $cantidad    = $_POST['cantidad'];
                $precio      = $_POST['precio'];
                $impuesto    = $_POST['impuesto'];
                $imp_isr     = $_POST['imp_isr'];
                $imp_ieps    = $_POST['imp_ieps'];
                $importe     = $_POST['importe'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_detalleditocomra($nofolio, '$codigo', '$descripcion', '$umedida', '$marca', $cantidad, $precio, $impuesto, $imp_isr, $imp_ieps, $importe, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                        $iva = $data['impuesto'] /100;
                        $isr = $data['impuesto_isr'] /100;
                        $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                        $totsubtotal = $totsubtotal + $subtotal;
                        $imprteIva  = $subtotal * $iva;
                        $imprteIsr  = $subtotal * $isr;
                        $totiva     = $totiva + $imprteIva;
                        $totisr     = $totisr + $imprteIsr;
                        $totieps    = $totieps + $ieps;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['umedida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($subtotal,2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-umed="'.$data['umedida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        }                             

//Almacena Almacen
if($_POST['action'] == 'AlmacenaAlmacen')
{
    if(!empty($_POST['codigo']) || !empty($_POST['namealmacen']))
    {
        $codigo      = $_POST['codigo'];
        $namealmacen = $_POST['namealmacen'];
      
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_almacen('$codigo', '$namealmacen', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Almacena Edicion de Almacen
if($_POST['action'] == 'AlmacenaEditAlmacen')
{
    if(!empty($_POST['codigo']) || !empty($_POST['namealmacen']))
    {
        $idalm       = $_POST['idalm'];
        $codigo      = $_POST['codigo'];
        $namealmacen = $_POST['namealmacen'];
        $estatusalm  = $_POST['estatusalm'];
      
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editalmacen($idalm, '$codigo', '$namealmacen', $estatusalm, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


// Edita Movimiento Cotizacion Compra

if($_POST['action'] == 'ActualizaMovordencompra'){

            
                $id_c       = $_POST['detid'];
                $folio_c    = $_POST['detfolio'];
                $codigo_c   = $_POST['detcodigo'];
                $descrip_c  = $_POST['detdescripc'];
                $unidadm_c  = $_POST['unidadmedida'];
                $marca_c    = $_POST['detmarca'];
                $cantidad_c = $_POST['detcantidad'];
                $precio_c   = $_POST['detprecio'];
                $impuesto_c = $_POST['detimpuesto'];
                $impisr_c   = $_POST['detimpisr'];
                $impieps_c  = $_POST['detimpieps'];
                $importe_c  = $_POST['detimporte'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detalleordencompra($id_c, $folio_c, '$codigo_c', '$descrip_c', '$unidadm_c', '$marca_c', $cantidad_c, $precio_c, $impuesto_c, $impisr_c, $impieps_c, $importe_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                        $iva = $data['impuesto'] /100;
                        $isr = $data['impuesto_isr'] /100;
                        $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                        $totsubtotal = $totsubtotal + $subtotal;
                        $imprteIva  = $subtotal * $iva;
                        $imprteIsr  = $subtotal * $isr;
                        $totiva     = $totiva + $imprteIva;
                        $totisr     = $totisr + $imprteIsr;
                        $totieps    = $totieps + $ieps;
                        //$solicita   = $data['area_solicitante'];
                        
                         $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['umedida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-umed="'.$data['umedida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        } 


// Elimina refacciones del detalle Orden de Compra

        if($_POST['action'] == 'delDetordencompra'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempordencompra($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    //$solicita   = $data['area_solicitante'];
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['umedida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-umed="'.$data['umedida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }  


// Buscar Datos del Proveedor
        if($_POST['action'] == 'searchDatosProveedor')
        {
            if(!empty($_POST['op'])){
                $idprov = $_POST['op'];

                $query = mysqli_query($conection,"SELECT id, no_prov, nombre, nombre_corto, correo, telefono, contacto FROM proveedores WHERE id = $idprov ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }  

//Almacena Orden de compra
if($_POST['action'] == 'AlmacenaOrdencompra')
{
    if(empty($_POST['fecha']) || empty($_POST['proveedor']))
    {
       echo 'error';
    }else{
        
        $folio        = $_POST['folio'];
        $noreq        = $_POST['noreq'];
        $fecha        = $_POST['fecha'];
        $proveedor    = $_POST['proveedor'];
        $contacto     = $_POST['contacto'];
        $telefono     = $_POST['telefono'];
        $correo       = $_POST['correo'];
        $formapago    = $_POST['forma_pago'];
        $metodopago   = $_POST['metodo_pago'];
        $usocfdi      = $_POST['uso_cfdi'];
        $solicita     = $_POST['solicita'];
        $notas        = $_POST['notas'];
        $recibe       = $_POST['recibe'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_ordencompra($folio, $noreq, '$fecha', $proveedor, '$contacto', '$telefono', '$correo', '$formapago', '$metodopago', '$usocfdi', '$solicita', '$notas', '$recibe', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//****************************//
        //Cancelar orden de compra
   if($_POST['action'] == 'procesarSalircompra'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_compra($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    } 

// Agregar producto al detalle temporal compra
        if($_POST['action'] == 'addDetalleOcompra'){
            
                $noorden = $_POST['ordenno'];
                $folio   = $_POST['afolio'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_ocom= mysqli_query($conection,"CALL add_temp_compra($noorden, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_ocom);

                $detalleTablaRe = '';
                $detalleTotalesRe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_detalle_ocom)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    $solicita   = $data['area_solicitante'];
                    $prov       = $data['proveedor'];
                    $nameprov   = $data['nombre'];
                    $contact    = $data['contacto'];
                    $phone      = $data['telefono'];
                    $mail       = $data['correo'];
                    $formapago  = $data['forma_pago'];
                    $metodopago = $data['metodo_pago'];
                    $usocfdi    = $data['uso_cfdi'];

                    $detalleTablaRe .= '<tr>
                                    <td align="right">'.number_format($data['cantidad'],2).'</td>
                                    <td>'.$data['codigo'].'</td>
                                    <td>'.$data['almacen'].'</td>
                                    <td>'.$data['descripcion'].'</td>
                                    <td>'.$data['unidad_medida'].'</td>
                                    <td>'.$data['marca'].'</td>
                                    <td align="right">'.number_format($data['precio'],2).'</td>
                                    <td align="right">'.number_format($data['importe'],2).'</td>
                                    <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a id="alumno" 
                                        data-target="#modalEditCotizacion" 
                                        data-toggle="modal" 
                                        data-id="'.$data['id'].'"
                                        data-nofol="'.$data['folio'].'" 
                                        data-cantid="'.$data['cantidad'].'"
                                        data-codig="'.$data['codigo'].'"
                                        data-almc="'.$data['almacen'].'"
                                        data-descrip="'.$data['descripcion'].'"
                                        data-unmed="'.$data['unidad_medida'].'"
                                        data-marca="'.$data['marca'].'"
                                        data-precio="'.$data['precio'].'"
                                        data-impto="'.$data['impuesto'].'"
                                        data-impisr="'.$data['impuesto_isr'].'"
                                        data-impieps="'.$data['impuesto_ieps'].'"
                                        data-importe="'.$data['importe'].'"
                                        href="#" 
                                        class="sepV_a" 
                                        title="Cambiar Cantidad"><i class="fas fa-edit"></i>
                                    </a>
                                    </td>
                                    </tr>';
                    }

                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaRe;
                $arrayData['totales'] = $detalleTotalesRe;

                $arrayData['solicita'] = $solicita;
                $arrayData['proveedor'] = $prov;
                $arrayData['nameprov'] = $nameprov;
                $arrayData['contacto'] = $contact;
                $arrayData['phone'] = $phone;
                $arrayData['mail'] = $mail;
                $arrayData['formapago'] = $formapago;
                $arrayData['metodopago'] = $metodopago;
                $arrayData['usocfdi'] = $usocfdi;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   

            }else{
                echo 'error';
            }       
                
                exit;
        }   

// Edita Movimiento Cotizacion Compra

if($_POST['action'] == 'ActualizaMovcompra'){

            
                $id_c       = $_POST['detid'];
                $folio_c    = $_POST['detfolio'];
                $codigo_c   = $_POST['detcodigo'];
                $almacen_c  = $_POST['detalmacen'];
                $descrip_c  = $_POST['detdescripc'];
                $umedida_c  = $_POST['detumedida'];
                $marca_c    = $_POST['detmarca'];
                $cantidad_c = $_POST['detcantidad'];
                $precio_c   = $_POST['detprecio'];
                $impuesto_c = $_POST['detimpuesto'];
                $impisr_c   = $_POST['detimpisr'];
                $impieps_c  = $_POST['detimpieps'];
                $importe_c  = $_POST['detimporte'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detallecompra($id_c, $folio_c, '$codigo_c', '$almacen_c', '$descrip_c', '$umedida_c', '$marca_c', $cantidad_c, $precio_c, $impuesto_c, $impisr_c, $impieps_c, $importe_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                        
                         $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-unmed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        } 

// Elimina refacciones del detalle de Compra

        if($_POST['action'] == 'delDetcompra'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempcompra($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-descrip="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }          


// Agregar Detalle a la Compra
        if($_POST['action'] == 'AddDetalleCompra'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio     = $_POST['folio'];
                $codigo      = $_POST['codigo'];
                $almacen     = $_POST['almacen'];
                $descripcion = $_POST['descripcion'];
                $umedida     = $_POST['umedida'];
                $marca       = $_POST['marca'];
                $cantidad    = $_POST['cantidad'];
                $precio      = $_POST['precio'];
                $impuesto    = $_POST['impuesto'];
                $impisr      = $_POST['impisr'];
                $impieps     = $_POST['impieps'];
                $importe     = $_POST['importe'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detallecompra($nofolio, '$codigo', '$almacen', '$descripcion', '$umedida', '$marca', $cantidad, $precio, $impuesto, $impisr, $impieps, $importe, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-unmed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        }                             


//Almacena Compra
if($_POST['action'] == 'AlmacenaCompra')
{
    if(empty($_POST['fecha']) || empty($_POST['proveedor']))
    {
       echo 'error';
    }else{
        
        $folio        = $_POST['folio'];
        $noorden      = $_POST['noorden'];
        $noreq        = $_POST['noreq'];
        $fecha        = $_POST['fecha'];
        $proveedor    = $_POST['proveedor'];
        $contacto     = $_POST['contacto'];
        $telefono     = $_POST['telefono'];
        $correo       = $_POST['correo'];
        $formapago    = $_POST['forma_pago'];
        $metodopago   = $_POST['metodo_pago'];
        $usocfdi      = $_POST['uso_cfdi'];
        $solicita     = $_POST['solicita'];
        $nofactura    = $_POST['nofactura'];
        $notas        = $_POST['notas'];
        $lote         = date('Ymd-His');

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        if (empty($noorden)) {
            $no_orden = 0;
        }else {
            $no_orden = $noorden;
        }

        if (empty($noreq)) {
            $no_req = 0;
        }else {
            $no_req = $noreq;
        }

        $query_procesar = mysqli_query($conection,"CALL procesar_compra($folio, $no_orden, $no_req, '$fecha', $proveedor, '$contacto', '$telefono', '$correo', '$formapago', '$metodopago', '$usocfdi', '$solicita', '$nofactura', '$notas', '$lote', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditUnidad')
{
    if(!empty($_POST['nounidad']) || !empty($_POST['nplacas']) || !empty($_POST['tipogas']) )
    {
      print_r($_POST);

    }else{
        echo 'error';
    }
    exit;
}


//Almacena Unidad de Medida
if($_POST['action'] == 'AlmacenaUnidadmedida')
{
    if(!empty($_POST['codigo']) || !empty($_POST['nameumedida']))
    {
        $codigo      = $_POST['codigo'];
        $nameumedida = $_POST['nameumedida'];
      
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_unidadmedida('$codigo', '$nameumedida', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Almacena Edicion de Unidad de Medida
if($_POST['action'] == 'AlmacenaEditUmedida')
{
    if(!empty($_POST['codigo']) || !empty($_POST['namealmacen']))
    {
        $idum        = $_POST['idalm'];
        $codigo      = $_POST['codigo'];
        $nameumedida = $_POST['nameunidad'];
        $estatusum   = $_POST['estatusum'];
      
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editumedida($idum, '$codigo', '$nameumedida', $estatusum, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//****************************//
        //Cancelar Entrada Almacen
   if($_POST['action'] == 'procesarSalirEntrada'){

                          
        $serie     = $_POST['serie'];
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_entradaalmacen('$serie', $norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    }   


// Agregar Detalle a la Entrada Almacen
        if($_POST['action'] == 'AddDetalleEntradaalm'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $serie       = $_POST['serie'];
                $nofolio     = $_POST['folio'];
                $codigo      = $_POST['codigo'];
                $descripcion = $_POST['descripcion'];
                $almacen     = $_POST['almacen'];
                $marca       = $_POST['marca'];
                $unidadmed   = $_POST['unidmedida'];
                $cantidad    = $_POST['cantidad'];
                $precio      = $_POST['precio'];
                $impuesto    = $_POST['impuesto'];
                $importe     = $_POST['importe'];
                $lote        = date('Ymd-His');
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detalleentradaalm('$serie', $nofolio, '$codigo', '$descripcion', '$almacen', '$marca', '$unidadmed', $cantidad, $precio, $impuesto, $importe, '$lote', '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    $totsubtotal = $totsubtotal + $subtotal;
                    $totalcant  = $totalcant + $data['cantidad'];
                    //$totiva = $totiva + $iva;
                    


                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
                   
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        } 


// Edita Movimiento Entrada Almacén

if($_POST['action'] == 'ActualizaMoventradaalm'){

            
                $id_c       = $_POST['detid'];
                $serie_c    = $_POST['detserie'];
                $folio_c    = $_POST['detfolio'];
                $codigo_c   = $_POST['detcodigo'];
                $descrip_c  = $_POST['detdescripc'];
                $almacen_c  = $_POST['detalmacen'];
                $marca_c    = $_POST['detmarca'];
                $unidadm_c  = $_POST['detumedida'];
                $cantidad_c = $_POST['detcantidad'];
                $precio_c   = $_POST['detprecio'];
                $importe_c  = $_POST['detimporte'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detalleentrada($id_c, '$serie_c', $folio_c, '$codigo_c', '$descrip_c', '$almacen_c', '$marca_c', '$unidadm_c', $cantidad_c, $precio_c, $importe_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    $totsubtotal = $totsubtotal + $subtotal;
                    $totalcant  = $totalcant + $data['cantidad'];
                    //$totiva = $totiva + $iva;
                        
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        }  

 // Elimina refacciones del detalle Temporal Mannto

        if($_POST['action'] == 'delDetEntradaalm'){

            
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);

                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempentrada($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    $totsubtotal = $totsubtotal + $subtotal;
                    $totalcant  = $totalcant + $data['cantidad'];
                    //$totiva = $totiva + $iva;
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
               $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
           
        
            exit;
        }  

//Almacena entrada de Almacen
if($_POST['action'] == 'AlmacenaEntradaAlm')
{
    if(empty($_POST['fecha']) || empty($_POST['serie']) || empty($_POST['folio']) )
    {
       echo 'error';
    }else{
        
        $fecha        = $_POST['fecha'];
        $serie        = $_POST['serie'];
        $folio        = $_POST['folio'];
        $notas        = $_POST['notas'];
        $lote         = date('Ymd-His');

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_entradaalm('$serie', $folio, '$fecha', '$notas', '$lote', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//****************************//
        //Cancelar Salida Almacen
   if($_POST['action'] == 'procesarSalirSalida'){

                          
        $serie     = $_POST['serie'];
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_salidaalmacen('$serie', $norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    }  

//Almacena entrada de Almacen
if($_POST['action'] == 'AlmacenaSalidaAlm')
{
    if(empty($_POST['fecha']) || empty($_POST['serie']) || empty($_POST['folio']) )
    {
       echo 'error';
    }else{
        
        $fecha        = $_POST['fecha'];
        $serie        = $_POST['serie'];
        $folio        = $_POST['folio'];
        $notas        = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_salidaalm('$serie', $folio, '$fecha', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


// Agregar Detalle a la Salida Almacen
        if($_POST['action'] == 'AddDetalleSalidaalm'){
            if(empty($_POST['folio']) || empty($_POST['serie']) )
            {
                echo 'error';
            }else{
                $serie       = $_POST['serie'];
                $nofolio     = $_POST['folio'];
                $codigo      = $_POST['codigo'];
                $descripcion = $_POST['descripcion'];
                $almacen     = $_POST['almacen'];
                $marca       = $_POST['marca'];
                $unidadmed   = $_POST['unidmedida'];
                $cantidad    = $_POST['cantidad'];
                $precio      = $_POST['precio'];
                $impuesto    = $_POST['impuesto'];
                $importe     = $_POST['importe'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL registrar_salida_fifo('$codigo', $cantidad, '$serie', $nofolio,  '$descripcion', '$almacen', '$marca', '$unidadmed', $precio, $impuesto, $importe, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva      = $iva + $data['impuesto'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $total = $total + $data['importe'];
                    $totalcant  = $totalcant + $data['cantidad'];
                    //$totiva = $totiva + $iva;
                    


                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a><!--&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>-->
                                            </td>
                                        </tr>';
                    }
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            
                                                <td align="right"> IVA: </td>
                                                <td align="right">'.number_format($iva,2).'</td>
                                            
                                                <td align="right"> Total: </td>
                                                <td align="right">'.number_format($total,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
                   
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error 1";
            }   
        }
            exit;   
        } 


// Elimina refacciones del detalle Temporal Salida Almacen

        if($_POST['action'] == 'delDetSalidaalm'){

            
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);

                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempsalida($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva      = $iva + $data['impuesto'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $total = $total + $data['importe'];
                    $totalcant  = $totalcant + $data['cantidad'];
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a><!--&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>-->
                                            </td>
                                        </tr>';
                    }
                  
               $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            
                                                <td align="right"> IVA: </td>
                                                <td align="right">'.number_format($iva,2).'</td>
                                            
                                                <td align="right"> Total: </td>
                                                <td align="right">'.number_format($total,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
           
        
            exit;
        } 

// Edita Movimiento Cotizacion Compra

if($_POST['action'] == 'ActualizaMovsalidaalm'){

            
                $id_c       = $_POST['detid'];
                $serie_c    = $_POST['detserie'];
                $folio_c    = $_POST['detfolio'];
                $codigo_c   = $_POST['detcodigo'];
                $descrip_c  = $_POST['detdescripc'];
                $almacen_c  = $_POST['detalmacen'];
                $marca_c    = $_POST['detmarca'];
                $unidadm_c  = $_POST['detumedida'];
                $cantidad_c = $_POST['detcantidad'];
                $precio_c   = $_POST['detprecio'];
                $importe_c  = $_POST['detimporte'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detallesalida($id_c, '$serie_c', $folio_c, '$codigo_c', '$descrip_c', '$almacen_c', '$marca_c', '$unidadm_c', $cantidad_c, $precio_c, $importe_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva      = $iva + $data['impuesto'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $total = $total + $data['importe'];
                    $totalcant  = $totalcant + $data['cantidad'];
                        
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
               $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            
                                                <td align="right"> IVA: </td>
                                                <td align="right">'.number_format($iva,2).'</td>
                                            
                                                <td align="right"> Total: </td>
                                                <td align="right">'.number_format($total,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        } 


/* Almacena Perfil Empresa */

//
if($_POST['action'] == 'AlmacenaPerfilempresa')
{
    if(!empty($_POST['nombre']) || !empty($_POST['regfc']) )
    {
        $idemp     = $_POST['idemp'];
        $nombre    = $_POST['nombre'];
        $rfc       = $_POST['regfc'];
        $mail      = $_POST['mail'];
        $phone     = $_POST['phone'];
        $callenum  = $_POST['callenum'];
        $codpostal = $_POST['codpostal'];
        $colonia   = $_POST['colonia'];
        $ciudad    = $_POST['city'];
        $estado    = $_POST['estado'];
     
        $token     = md5($_SESSION['idUser']);
        $usuario   = $_SESSION['idUser'];
  

        $query_procesar = mysqli_query($conection,"CALL procesar_empresa($idemp, '$nombre', '$rfc', '$mail', '$phone', '$callenum', $codpostal, '$colonia', '$ciudad', '$estado', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}  


// Agregar producto al detalle temporal Orden de Compra
        if($_POST['action'] == 'addDetalleRequisicion'){
            
                $noorden = $_POST['ordenno'];
                $folio   = $_POST['afolio'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_ocom= mysqli_query($conection,"CALL add_temp_reqocompra($noorden, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_ocom);

                $detalleTablaRe = '';
                $detalleTotalesRe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_detalle_ocom)){
                        $subtotal = $data['cantidad'] * $data['precio'];
                        $iva = $data['impuesto'] /100;
                        $isr = $data['impuesto_isr'] /100;
                        $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                        $totsubtotal = $totsubtotal + $subtotal;
                        $imprteIva  = $subtotal * $iva;
                        $imprteIsr  = $subtotal * $isr;
                        $totiva     = $totiva + $imprteIva;
                        $totisr     = $totisr + $imprteIsr;
                        $totieps    = $totieps + $ieps;
                        $solicita   = $data['area_solicitante'];

                        $detalleTablaRe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['umedida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($subtotal,2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-umed="'.$data['umedida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesRe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                   
                  
                $arrayData['detalle'] = $detalleTablaRe;
                $arrayData['totales'] = $detalleTotalesRe;

                $arrayData['solicitante'] = $solicita;
               

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   

            }else{
                echo 'error';
            }       
                
                exit;
        }  

 //Borra Planeacion
if($_POST['action'] == 'Borraplaneacion')
{
    if(empty($_POST['fecha_carga']) )
    {
       echo 'error';
    }else{
        
        $fecha_carga        = $_POST['fecha_carga'];       

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL borra_planeacion('$fecha_carga', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}          


 //Borra Planeacion
if($_POST['action'] == 'BorraAlertas')
{
    if(empty($_POST['semana']) )
    {
       echo 'error';
    }else{
        
        $nosemana = $_POST['semana'];  
        $anio     = $_POST['ejerciciofiscal'];     

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL borra_cargaalertas('$nosemana', $anio, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}  


//****************************//
        //Cancelar Requisicion
   if($_POST['action'] == 'procesarSalirCotventa'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_cotizacionventa($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    }   


// Agregar Detalle a la Requisicion
        if($_POST['action'] == 'AddDetallecotizacionventa'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio   = $_POST['folio'];
                $ruta      = $_POST['ruta'];
                $unidad    = $_POST['unidad'];
                $capacidad = $_POST['capacidad'];
                $diashoras = $_POST['diashoras'];
                $precio    = $_POST['precio'];
               
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detcotventa($nofolio, '$ruta', '$unidad', '$capacidad', '$diashoras', $precio, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                   
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['ruta'].'</td>
                                            <td>'.$data['unidad'].'</td>
                                            <td>'.$data['capacidad'].'</td>
                                            <td>'.$data['dias_horas'].'</td>
                                            <td align="right">'.number_format($data['precio_servicio'],2).'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['ruta'].'"
                                                data-codig="'.$data['unidad'].'"
                                                data-descrip="'.$data['capacidad'].'"
                                                data-marca="'.$data['dias_horas'].'"
                                                data-precio="'.$data['precio_servicio'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                                </a>
                                            </td>
                                        </tr>';
                    }
                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        }

// Elimina Servicio del detalle Temporal Cotizacion venta

        if($_POST['action'] == 'delDeattecotizacionventa'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempcotizaventa($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
              

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                   
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['ruta'].'</td>
                                            <td>'.$data['unidad'].'</td>
                                            <td>'.$data['capacidad'].'</td>
                                            <td>'.$data['dias_horas'].'</td>
                                            <td align="right">'.number_format($data['precio_servicio'],2).'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['ruta'].'"
                                                data-codig="'.$data['unidad'].'"
                                                data-descrip="'.$data['capacidad'].'"
                                                data-marca="'.$data['dias_horas'].'"
                                                data-precio="'.$data['precio_servicio'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
                  
                $arrayData['detalle'] = $detalleTablaPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }  


// Edita Sercicio Cotizacion venta

if($_POST['action'] == 'ActualizaMovcotizacionventa'){

            
                $id_c        = $_POST['detid'];
                $folio_c     = $_POST['detfolio'];
                $ruta_c      = $_POST['detruta'];
                $unidad_c    = $_POST['detunidad'];
                $capacidad_c = $_POST['detcapacidad'];
                $diashoras_c = $_POST['detdiashoras'];
                $precio_c    = $_POST['detprecio'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detallecotizacionventa($id_c, $folio_c, '$ruta_c', '$unidad_c', '$capacidad_c', '$diashoras_c', $precio_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $detalleTotales = '';
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                   
                   
                        $detalleTabla .= '<tr>
                                            <td>'.$data['ruta'].'</td>
                                            <td>'.$data['unidad'].'</td>
                                            <td>'.$data['capacidad'].'</td>
                                            <td>'.$data['dias_horas'].'</td>
                                            <td align="right">'.number_format($data['precio_servicio'],2).'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['ruta'].'"
                                                data-codig="'.$data['unidad'].'"
                                                data-descrip="'.$data['capacidad'].'"
                                                data-marca="'.$data['dias_horas'].'"
                                                data-precio="'.$data['precio_servicio'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    
                    
                $arrayData['detalle'] = $detalleTabla;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        } 

//Almacena Cotizacion Venta
if($_POST['action'] == 'AlmacenaCotizacionvta')
{
    if(empty($_POST['fecha']) || empty($_POST['name_empresa']) )
    {
       echo 'error';
    }else{
        
        $folio        = $_POST['folio'];
        $fecha        = $_POST['fecha'];
        $atencion     = $_POST['atencion'];
        $tcliente     = $_POST['tcliente'];
        $empresa      = $_POST['name_empresa'];
        $direccion    = $_POST['direccion'];
        $diascredito  = $_POST['diascredito'];
        $diascomienzo = $_POST['diascomienzo'];
        $dateinicio   = $_POST['dateinicio'];
        $datefin      = $_POST['datefin'];
        $notas        = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_cotizacionvta($folio, '$fecha', '$atencion', '$tcliente', '$empresa', '$direccion', '$diascredito', '$diascomienzo', '$dateinicio', '$datefin', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//****************************//
        //Cancelar Orden Sercvicio
   if($_POST['action'] == 'procesarSalirOrdenservicio'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_ordenservicio($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    } 


 // Buscar Cliente por codigo
        if($_POST['action'] == 'searchClienteos')
        {
            if(!empty($_POST['opcte'])){
                $codcte = $_POST['opcte'];

                $query = mysqli_query($conection,"SELECT ct.nombre_corto, CONCAT(ct.calle, ', ', ct.colonia, ', ', ct.estado, ', ', ct.municipio, ', C.P.: ', ct.cod_postal, ', ', ct.ciudad, ', ', ct.pais) as domicilio, ct.contacto, ct.correo, ct.telefono, us.nombre FROM clientes ct INNER JOIN usuario us ON ct.id_supervisor = us.idusuario WHERE ct.no_cliente = $codcte");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }   

 // Buscar Cliente por nombre
        if($_POST['action'] == 'searchClientenameos')
        {
            if(!empty($_POST['opcte'])){
                $namecte = $_POST['opcte'];

                $query = mysqli_query($conection,"SELECT ct.no_cliente, CONCAT(ct.calle, ', ', ct.colonia, ', ', ct.estado, ', ', ct.municipio, ', C.P.: ', ct.cod_postal, ', ', ct.ciudad, ', ', ct.pais) as domicilio, ct.contacto, ct.correo, ct.telefono, us.nombre FROM clientes ct INNER JOIN usuario us ON ct.id_supervisor = us.idusuario WHERE ct.nombre_corto = '$namecte'");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }             


// Agregar Detalle a la Requisicion
        if($_POST['action'] == 'AddDetalleordenservicio'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio    = $_POST['folio'];
                $ruta       = $_POST['ruta'];
                $horaini    = $_POST['horaini'];
                $horasalida = $_POST['horaslda']; 
                $turno      = $_POST['turno'];
                $unidad     = $_POST['unidad'];
                $tipovuelta = $_POST['tvuelta'];
                $diastrab   = $_POST['diastrab'];
               
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detordenserv($nofolio, '$ruta', '$horaini', '$horasalida', '$turno', '$unidad', '$tipovuelta', '$diastrab', '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                   
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['rutas'].'</td>
                                            <td>'.$data['hora_inicio'].'</td>
                                            <td>'.$data['hora_salida'].'</td>
                                            <td>'.$data['turnos'].'</td>
                                            <td>'.$data['tipo_unidad'].'</td>
                                            <td>'.$data['tipo_vuelta'].'</td>
                                            <td>'.$data['dias_trabajar'].'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['rutas'].'"
                                                data-codig="'.$data['hora_inicio'].'"
                                                data-hslida="'.$data['hora_salida'].'"
                                                data-turnos="'.$data['turnos'].'"
                                                data-descrip="'.$data['tipo_unidad'].'"
                                                data-tvelta="'.$data['tipo_vuelta'].'"
                                                data-marca="'.$data['dias_trabajar'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Datos"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        }


// Elimina Servicio del detalle Temporal Cotizacion venta

        if($_POST['action'] == 'delDetordenservicio'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempordenserv($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
              

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                   
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['rutas'].'</td>
                                            <td>'.$data['hora_inicio'].'</td>
                                            <td>'.$data['hora_salida'].'</td>
                                            <td>'.$data['turnos'].'</td>
                                            <td>'.$data['tipo_unidad'].'</td>
                                            <td>'.$data['tipo_vuelta'].'</td>
                                            <td>'.$data['dias_trabajar'].'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['rutas'].'"
                                                data-codig="'.$data['hora_inicio'].'"
                                                data-hslida="'.$data['hora_salida'].'"
                                                data-turnos="'.$data['turnos'].'"
                                                data-descrip="'.$data['tipo_unidad'].'"
                                                data-tvelta="'.$data['tipo_vuelta'].'"
                                                data-marca="'.$data['dias_trabajar'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Datos"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
                  
                $arrayData['detalle'] = $detalleTablaPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }  


// Edita Servicio Orden de Servicio

if($_POST['action'] == 'ActualizaDetordenserv'){

            
                $id_c        = $_POST['detid'];
                $folio_c     = $_POST['detfolio'];
                $ruta_c      = $_POST['detruta'];
                $horaini_c   = $_POST['dethoraini'];
                $horasal_c   = $_POST['dethoraslda'];
                $turnos_c    = $_POST['detturnos'];
                $unidad_c    = $_POST['detunidad'];
                $vuelta_c    = $_POST['detvuelta'];
                $diastrab_c  = $_POST['detdiastrab'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detalleordenserv($id_c, $folio_c, '$ruta_c', '$horaini_c', '$horasal_c', '$turnos_c', '$unidad_c', '$vuelta_c', '$diastrab_c', '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $detalleTotales = '';
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                   
                   
                        $detalleTabla .= '<tr>
                                            <td>'.$data['rutas'].'</td>
                                            <td>'.$data['hora_inicio'].'</td>
                                            <td>'.$data['hora_salida'].'</td>
                                            <td>'.$data['turnos'].'</td>
                                            <td>'.$data['tipo_unidad'].'</td>
                                            <td>'.$data['tipo_vuelta'].'</td>
                                            <td>'.$data['dias_trabajar'].'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['rutas'].'"
                                                data-codig="'.$data['hora_inicio'].'"
                                                data-hslida="'.$data['hora_salida'].'"
                                                data-turnos="'.$data['turnos'].'"
                                                data-descrip="'.$data['tipo_unidad'].'"
                                                data-tvelta="'.$data['tipo_vuelta'].'"
                                                data-marca="'.$data['dias_trabajar'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Datos"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    
                    
                $arrayData['detalle'] = $detalleTabla;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        }      


//Almacena Orden de Servicio
if($_POST['action'] == 'AlmacenaOrdenservicio')
{
    if(empty($_POST['fecha']) || empty($_POST['nocliente']) || empty($_POST['cliente']))
    {
       echo 'error';
    }else{
        
        $folio        = $_POST['folio'];
        $fecha        = $_POST['fecha'];
        $nocliente    = $_POST['nocliente'];
        $cliente      = $_POST['cliente'];
        $direccion    = $_POST['direccion'];
        $tiposervicio = $_POST['tiposervicio'];
        $dateservicio = $_POST['dateservicio'];
        $contacto     = $_POST['contacto'];
        $correo       = $_POST['correo'];
        $telefono     = $_POST['telefono'];
        $notas        = $_POST['notas'];
        $requisitos   = $_POST['requisitos'];
        $genera       = $_POST['genera'];
        $recibe       = $_POST['recibe'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_ordenservicio($folio, '$fecha', $nocliente, '$cliente', '$direccion', '$tiposervicio', '$dateservicio', '$contacto', '$correo', '$telefono', '$notas', '$requisitos', '$genera', '$recibe', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

//Almacena Orden de Servicio
if($_POST['action'] == 'AlmacenaPropiedadcp')
{
    if(empty($_POST['fecha']) || empty($_POST['empresa']) || empty($_POST['bienresgdo']))
    {
       echo 'error';
    }else{
        
        $fecha         = $_POST['fecha'];
        $empresa       = $_POST['empresa'];
        $representa    = $_POST['representa'];
        $direccion     = $_POST['direccion'];
        $telefono      = $_POST['telefono'];
        $correo        = $_POST['correo'];
        $bienresguardo = $_POST['bienresgdo'];
        $caracteristic = $_POST['caracterist'];
        $utilizarse    = $_POST['utilizarse'];
        $identifica    = $_POST['identifica'];
        $verifica      = $_POST['verifica'];
        $proteccion    = $_POST['proteccion'];
        $salvaguarda   = $_POST['salvaguarda'];
        $nombre1       = $_POST['nombre1'];
        $puesto1       = $_POST['puesto1'];
        $telcorreo1    = $_POST['telcorreo1'];
        $nombre2       = $_POST['nombre2'];
        $puesto2       = $_POST['puesto2'];
        $telcorreo2    = $_POST['telcorreo2'];
        $empresarecibe = $_POST['emprecibe'];
        $empresaentreg = $_POST['empentrega'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_propiedadescp('$fecha', '$empresa', '$representa', '$direccion', '$telefono', '$correo', '$bienresguardo', '$caracteristic', '$utilizarse', '$identifica', '$verifica', '$proteccion', '$salvaguarda', '$nombre1', '$puesto1', '$telcorreo1', '$nombre2', '$puesto2', '$telcorreo2', '$empresarecibe', '$empresaentreg', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaSolicitudcredito')
{
    if(!empty($_POST['cliente']) || !empty($_POST['daterec']) || !empty($_POST['monto']) || !empty($_POST['plazo']))
    {
        $cliente      = $_POST['cliente'];
        $daterec      = $_POST['daterec'];
        $monto        = $_POST['monto'];
        $plazo        = $_POST['plazo'];
        $regimen      = $_POST['regimen'];
        $razonsoc     = $_POST['razonsoc'];
        $calle        = $_POST['calle'];
        $entrecalle   = $_POST['entrecalle'];
        $colonia      = $_POST['colonia'];
        $ciudad       = $_POST['ciudad'];
        $municipio    = $_POST['municipio'];
        $sector       = $_POST['sector'];
        $estado       = $_POST['estado'];
        $codpostal    = $_POST['codpostal'];
        $phone        = $_POST['phone'];
        $fax          = $_POST['fax'];
        $email        = $_POST['email'];
        $giro         = $_POST['giro'];
        $antiguedad   = $_POST['antiguedad'];
        $namerep      = $_POST['namerep'];
        $rfcrep       = $_POST['rfcrep'];
        $callerep     = $_POST['callerep'];
        $entrecallerep = $_POST['entrecallerep'];
        $coloniarep    = $_POST['coloniarep'];
        $ciudadrep     = $_POST['ciudadrep'];
        $estadorep     = $_POST['estadorep'];
        $nacionalrep   = $_POST['nacionalrep'];
        $emailrep      = $_POST['emailrep'];
        $phonerep      = $_POST['phonerep'];
        $banco1        = $_POST['banco1'];
        $sucursal1     = $_POST['sucursal1'];
        $nocuenta1     = $_POST['nocuenta1'];
        $phonebanco1   = $_POST['phonebco1'];
        $ejecutivo1    = $_POST['ejecutivo1'];
        $banco2        = $_POST['banco2'];
        $sucursal2     = $_POST['sucursal2'];
        $nocuenta2     = $_POST['nocuenta2'];
        $phonebanco2   = $_POST['phonebco2'];
        $ejecutivo2    = $_POST['ejecutivo2'];
        $banco3        = $_POST['banco3'];
        $sucursal3     = $_POST['sucursal3'];
        $nocuenta3     = $_POST['nocuenta3'];
        $phonebanco3   = $_POST['phonebco3'];
        $ejecutivo3    = $_POST['ejecutivo3'];
        $proveedor1    = $_POST['proveedor1'];
        $phoneprov1    = $_POST['phoneprov1'];
        $contactopv1   = $_POST['contactopv1'];
        $proveedor2    = $_POST['proveedor2'];
        $phoneprov2    = $_POST['phoneprov2'];
        $contactopv2   = $_POST['contactopv2'];
        $proveedor3    = $_POST['proveedor3'];
        $phoneprov3    = $_POST['phoneprov3'];
        $contactopv3   = $_POST['contactopv3'];
        $proveedor4    = $_POST['proveedor4'];
        $phoneprov4    = $_POST['phoneprov4'];
        $contactopv4   = $_POST['contactopv4'];
        $nameaval      = $_POST['nameaval'];
        $rfcaval       = $_POST['rfcaval'];
        $calleaval     = $_POST['calleaval'];
        $entrecalleav  = $_POST['entrecalleav'];
        $coloniaaval   = $_POST['coloniaaval'];
        $ciudadaval    = $_POST['ciudadaval'];
        $estadoaval    = $_POST['estadoaval'];
        $sectoraval    = $_POST['sectoraval'];
        $cpostalaval   = $_POST['cpostalaval'];
        $nacionalaval  = $_POST['nacionaval'];
        $edocivilaval  = $_POST['edocivilaval'];
        $phoneaval     = $_POST['phoneaval'];
        $comentarios   = $_POST['comentarios'];
        $cedulafiscal  = $_POST['cedulafisica'];
        $podermoral    = $_POST['podermoral'];
        $domiciliofis  = $_POST['domiciliofis'];
        $cedulamoral   = $_POST['cedulamoral'];
        $autorizafis   = $_POST['autorizafis'];
        $identifmoral  = $_POST['identifmoral'];
        $identiffisica = $_POST['identiffisica'];
        $domiciliomral = $_POST['domiciliomor'];
        $autorizamoral = $_POST['autorizamoral'];
        $cliente_ref   = $_POST['cliente_ref'];
        $timecliente   = $_POST['timecliente'];
        $diascred      = $_POST['diascred'];
        $montocredito  = $_POST['montocred'];
        $formapago     = $_POST['formapago'];
        $bancoreferen  = $_POST['bancoref'];
        $chsinfondos   = $_POST['chequesinfon'];
        $chdevueltos   = $_POST['chequesdev'];
        $compramensual = $_POST['comprames'];
        $productosref  = $_POST['productos'];
        $saldopendte   = $_POST['saldopend'];
        $cantidadsaldo = $_POST['cantsaldo'];
        $diasatraso    = $_POST['diasatraso'];
        $domicilioref  = $_POST['domreferecia'];
        $terminosref   = $_POST['terminosref'];
        $proporcionadt = $_POST['kproporciona'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_solicitudcredito('$cliente', '$daterec', $monto, '$plazo', '$regimen', '$razonsoc', '$calle', '$entrecalle', '$colonia', '$ciudad', '$municipio', '$sector', '$estado', $codpostal, '$phone', '$fax', '$email', '$giro', '$antiguedad', '$namerep', '$rfcrep', '$callerep', '$entrecallerep', '$coloniarep', '$ciudadrep', '$estadorep', '$nacionalrep', '$emailrep', '$phonerep', '$banco1', '$sucursal1', '$nocuenta1', '$phonebanco1', '$ejecutivo1', '$banco2', '$sucursal2', '$nocuenta2', '$phonebanco2', '$ejecutivo2', '$banco3', '$sucursal3', '$nocuenta3', '$phonebanco3', '$ejecutivo3', '$proveedor1', '$phoneprov1', '$contactopv1', '$proveedor2', '$phoneprov2', '$contactopv2', '$proveedor3', '$phoneprov3', '$contactopv3', '$proveedor4', '$phoneprov4', '$contactopv4', '$nameaval', '$rfcaval', '$calleaval', '$entrecalleav', '$coloniaaval', '$ciudadaval', '$estadoaval', '$sectoraval', $cpostalaval, '$nacionalaval', '$edocivilaval', '$phoneaval', '$comentarios', '$cedulafiscal', '$podermoral', '$domiciliofis', '$cedulamoral', '$autorizafis', '$identifmoral', '$identiffisica', '$domiciliomral', '$autorizamoral', '$cliente_ref', '$timecliente', '$diascred', '$montocredito', '$formapago', '$bancoreferen', '$chsinfondos', '$chdevueltos', '$compramensual', '$productosref', '$saldopendte', '$cantidadsaldo', '$diasatraso', '$domicilioref', '$terminosref', '$proporcionadt', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

/* Almacena No venta */

//
if($_POST['action'] == 'AlmacenaNoventa')
{
    if(!empty($_POST['servicio']) || !empty($_POST['dateserv']) || !empty($_POST['clienteserv']))
    {
        $servicio     = $_POST['servicio'];
        $date_serv    = $_POST['dateserv'];
        $describ_serv = $_POST['describeserv'];
        $cliente_serv = $_POST['clienteserv'];
        $importe_serv = $_POST['importeserv'];
        $notas_serv   = $_POST['notasserv'];
        $elabora_serv = $_POST['elaboroserv'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_noventa('$servicio', '$date_serv', '$describ_serv', '$cliente_serv', $importe_serv, '$notas_serv', '$elabora_serv', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

// Buscar Cliente para Pedido
        if($_POST['action'] == 'searchRefaccionessal')
        {
            if(!empty($_POST['op'])){
                $codprov = $_POST['op'];

                $query = mysqli_query($conection,"SELECT iv.id, iv.codigo, iv.cantidad, iv.almacen, iv.marca, iv.umedida, iv.costo, rf.descripcion FROM inventario_peps iv INNER JOIN refacciones rf ON iv.codigo = rf.codigo WHERE iv.codigo = '$codprov' order by iv.fecha_entrada ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);
                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }  

//****************************//
        //Canclar control
   if($_POST['action'] == 'procesarSalirManttoprev'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_mpreventivo($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    }   

// Agregar Detalle al mantenimiento Preventivo
        if($_POST['action'] == 'AddDetallemprevententivo'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio     = $_POST['folio'];
                $cantidad    = $_POST['cantidad'];
                $codigo      = $_POST['codigorf'];
                $descripcion = $_POST['descripcion'];
                $costo       = $_POST['costorf'];

                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detallempreventivo($nofolio, $cantidad, '$codigo', '$descripcion', $costo, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){

                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['costo'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }

                  
                $arrayData['detalle'] = $detalleTablaPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        } 

// Elimina refacciones del detalle Temporal Mannto

        if($_POST['action'] == 'delDeattemanttopreventivo'){

            if(empty($_POST['id_detalle']))
            {
                echo 'error';
            }else{
                $id_detalle = $_POST['id_detalle'];
                $folio      = $_POST['nofolio'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempmpreventivo($id_detalle, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaDetPe = '';

                $arrayData = array();

                if($result > 0){

                    while ($data = mysqli_fetch_assoc($query_detalle_temppe)){

                        $detalleTablaDetPe .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['costo'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }


                $arrayData['detalledelete'] = $detalleTablaDetPe;


                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

            }else{
                echo 'error';
            }   
                mysqli_close($conection);   
            }
        
            exit;
        } 

//Almacena Solicitud de mantenimiento Preventivo
if($_POST['action'] == 'AlmacenaSolicitudmpreventivo')
{
    if(empty($_POST['fecha']) || empty($_POST['nounidad']) || empty($_POST['operador']) || empty($_POST['solicita']) || empty($_POST['trabajosolic']) )
    {
       echo 'error';
    }else{
        
        $folio          = $_POST['folio'];
        $fecha          = $_POST['fecha'];
        //$hora           = $_POST['hora'];
        $nounidad       = $_POST['nounidad'];
        $tipo_unidad    = $_POST['tipo_unidad'];
        $operador       = $_POST['operador'];
        $solicita       = $_POST['solicita'];
        $filtro_aceite  = $_POST['filtro_aceite'];
        $filtro_aire    = $_POST['filtro_aire'];
        $filtro_gas     = $_POST['filtro_gas'];
        $cambio_aceite  = $_POST['cambio_aceite'];
        $cambio_bujias  = $_POST['cambio_bujias'];
        $km_bujias      = $_POST['kmtbujias'];
        $rev_balatas    = $_POST['rev_balatas'];
        $engrasado      = $_POST['engrasado'];
        $anti_congela   = $_POST['anti_congela'];
        $liquido_frenos = $_POST['liquido_frenos'];
        $aceite_hidraul = $_POST['aceite_hidraul'];
        $rota_llantas   = $_POST['rota_llantas'];
        $banda_acessor  = $_POST['banda_acessor'];
        $rev_muelles    = $_POST['rev_muelles'];
        $amortiguadores = $_POST['amortiguadores'];
        $rev_luces      = $_POST['rev_luces'];
        $rev_bateria    = $_POST['rev_bateria'];
        $inyectores     = $_POST['inyectores'];
        $masas_frente   = $_POST['masas_frente'];
        $trabajo_sol    = $_POST['trabajosolic'];
        $kilometraje    = $_POST['kilometraje'];
        $fecha_inicio   = $_POST['dateinicio'];
        $fecha_fin      = $_POST['datefin'] || "0000-00-00";
        $notasgen       = $_POST['notasgen'];
        //$delanteraizq   = $_POST['delanteraizq'];
        //$delanterader   = $_POST['delanterader'];
        //$traseraizq     = $_POST['traseraizq'];
        //$traserader     = $_POST['traserader'];


       
        $fecha_fin_formateada = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_fin)));
        $fecha_inicio_formateada = date('Y-m-d', strtotime(str_replace('/', '-', $fecha_inicio)));
        $fecha_formateada = date('Y-m-d', strtotime(str_replace('/', '-', $fecha)));
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
        $query_insertar_mantto_preventivo = "";

// 1. Verificar si el folio existe en mantenimiento_preventivo
// $query_busqueda_folio = "SELECT COUNT(*) FROM mantenimiento_preventivo WHERE no_orden = ?"; 
// $stmt = mysqli_prepare($conection, $query_busqueda_folio);
// mysqli_stmt_bind_param($stmt, "i", $folio); // "i" indica que $folio es un entero
// mysqli_stmt_execute($stmt);
// mysqli_stmt_bind_result($stmt, $count);
// mysqli_stmt_fetch($stmt);
// mysqli_stmt_close($stmt);

// if ($count === 0) {
//     // 2. Si no existe en mantenimiento_preventivo, verificar en solicitud_mantenimiento
//     $query_busqueda_folio = "SELECT COUNT(*) FROM solicitud_mantenimiento WHERE no_orden = ?";
//     $stmt = mysqli_prepare($conection, $query_busqueda_folio);
//     mysqli_stmt_bind_param($stmt, "i", $folio);
//     mysqli_stmt_execute($stmt);
//     mysqli_stmt_bind_result($stmt, $count);
//     mysqli_stmt_fetch($stmt);
//     mysqli_stmt_close($stmt);

//     if ($count === 0) {
        // 3. Si no existe en ninguna tabla, insertar en mantenimiento_preventivo
        $query_insertar_mantto_preventivo = "
            INSERT INTO mantenimiento_preventivo (no_orden, fecha, usuario, solicitada, unidad, tipo_unidad, tipo_trabajo, kilometraje, filtro_aceite, filtro_aire, filtro_combustible, cambio_aceite, cambio_bujias, km_bujias, revision_balatas, engrasado, anticongelante, liquido_freno, aceite_hidraulico, rotacion_llantas, banda_accesorios, muelles, amortiguadores, luces, baterias, inyectores, masas_delanteras, fecha_inicio, fecha_culminacion, observaciones, usuario_id) 
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conection, $query_insertar_mantto_preventivo);
        mysqli_stmt_bind_param($stmt, "issssssissssssssssssssssssssssi", $folio, $fecha_formateada, $operador, $solicita, $nounidad, $tipo_unidad, $trabajo_sol, $kilometraje, $filtro_aceite, $filtro_aire, $filtro_gas, $cambio_aceite, $cambio_bujias, $km_bujias, $rev_balatas, $engrasado, $anti_congela, $liquido_frenos, $aceite_hidraul, $rota_llantas, $banda_acessor, $rev_muelles, $amortiguadores, $rev_luces, $rev_bateria, $inyectores, $masas_frente, $fecha_inicio_formateada, $fecha_fin_formateada, $notasgen, $usuario);

        if (mysqli_stmt_execute($stmt)) {
            // 4. Insertar en detalle_manttoprev
            $query_insertar_detalle = "
                INSERT INTO detalle_manttoprev (folio, codigo, cantidad, descripcion, costo) 
                SELECT folio, codigo, cantidad, descripcion, costo 
                FROM detalle_temp_manttoprev WHERE folio = ?";

            $stmt_detalle = mysqli_prepare($conection, $query_insertar_detalle);
            mysqli_stmt_bind_param($stmt_detalle, "i", $folio); 

            if (mysqli_stmt_execute($stmt_detalle)) {
                echo json_encode(['success' => 'Solicitud de mantenimiento preventivo almacenada correctamente'], JSON_UNESCAPED_UNICODE);
            } else {
                echo "error al insertar en detalle_manttoprev: " . mysqli_error($conection);
            }
            mysqli_stmt_close($stmt_detalle); 
//         } else {
//             echo "error al insertar en mantenimiento_preventivo: " . mysqli_error($conection);
//         }
//         mysqli_stmt_close($stmt);
//     } else {
//         echo "error: El folio ya existe en solicitud_mantenimiento";
//     }
// } else {
//     echo "error: El folio ya existe en mantenimiento_preventivo";
// }
                           

        // $query_procesar = mysqli_query($conection,"CALL procesar_solicitudmpreventivo($folio, '$fecha', '$nounidad', '$tipo_unidad', '$operador', '$solicita', '$filtro_aceite', '$filtro_aire', '$filtro_gas', '$cambio_aceite', '$cambio_bujias', '$km_bujias', '$rev_balatas', '$engrasado', '$anti_congela', '$liquido_frenos', '$aceite_hidraul', '$rota_llantas', '$banda_acessor', '$rev_muelles', '$amortiguadores', '$rev_luces', '$rev_bateria', '$inyectores', '$masas_frente', '$trabajo_sol', $kilometraje, '$fecha_inicio', '$fecha_fin', '$notasgen', $usuario)");
        // echo $query_insertar_mantto_preventivo;
        // echo $query_insertar_mantto_preventivo;
        // $result_mtto_preventivo = mysqli_query($conection, $query_insertar_mantto_preventivo);
        // $filas_afectadas = mysqli_affected_rows($conection);
        
        // if($filas_afectadas > 0){
        //     echo json_encode(['mensaje' => 'success'], JSON_UNESCAPED_UNICODE);
        // }else{
        //     echo json_encode(['error' => mysqli_error($conection)], JSON_UNESCAPED_UNICODE);
        // }
    
    mysqli_close($conection);
  }
   
    exit;
} 
}
// Buscar Cliente para Pedido
        if($_POST['action'] == 'searchCostoRefacciones')
        {
            if(!empty($_POST['op'])){
                $nameprov = $_POST['op'];

                $query = mysqli_query($conection,"select rf.codigo, rf.descripcion, if(iv.cantidad_disponible >0, if(iv.costo IS NULL, rf.costo, iv.costo), rf.costo) as Ucosto from refacciones rf LEFT JOIN inventario_peps iv ON rf.codigo = iv.codigo WHERE rf.descripcion = '$nameprov' order by iv.fecha_entrada  ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);
                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }  

//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalleditManttoprev'){
                
                $c_noorden = $_POST['noorden'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_manttoprev WHERE folio = $c_noorden ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td align="right">'.number_format($data['costo'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }

                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        } 

// Agregar Detalle al mantenimiento Preventivo
        if($_POST['action'] == 'EditDetallemprevententivo'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio     = $_POST['folio'];
                $cantidad    = $_POST['cantidad'];
                $codigo      = $_POST['codigorf'];
                $descripcion = $_POST['descripcion'];
                $costo       = $_POST['costorf'];

                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detalleeditmprev($nofolio, $cantidad, '$codigo', '$descripcion', $costo, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){

                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.number_format($data['costo'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }

                  
                $arrayData['detalle'] = $detalleTablaPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        } 


// Elimina refacciones del detalle Temporal Mannto

        if($_POST['action'] == 'delEditDeattemanttopreventivo'){

            if(empty($_POST['id_detalle']))
            {
                echo 'error';
            }else{
                $id_detalle = $_POST['id_detalle'];
                $folio      = $_POST['nofolio'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_tempeditmprev($id_detalle, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaDetPe = '';

                $arrayData = array();

                if($result > 0){

                    while ($data = mysqli_fetch_assoc($query_detalle_temppe)){

                        $detalleTablaDetPe .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.number_format($data['costo'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_mantto('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }


                $arrayData['detalledelete'] = $detalleTablaDetPe;


                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

            }else{
                echo 'error';
            }   
                mysqli_close($conection);   
            }
        
            exit;
        }                       


//Almacena Solicitud de mantenimiento Preventivo
if($_POST['action'] == 'AlmacenaEditSolicitudmpreventivo')
{
    if(empty($_POST['fecha']) || empty($_POST['nounidad']) || empty($_POST['operador']) || empty($_POST['solicita']) || empty($_POST['trabajosolic']) )
    {
       echo 'error';
    }else{
        
        $folio          = $_POST['folio'];
        $fecha          = $_POST['fecha'];
        //$hora           = $_POST['hora'];
        $nounidad       = $_POST['nounidad'];
        $tipo_unidad    = $_POST['tipo_unidad'];
        $operador       = $_POST['operador'];
        $solicita       = $_POST['solicita'];
        $filtro_aceite  = $_POST['filtro_aceite'];
        $filtro_aire    = $_POST['filtro_aire'];
        $filtro_gas     = $_POST['filtro_gas'];
        $cambio_aceite  = $_POST['cambio_aceite'];
        $cambio_bujias  = $_POST['cambio_bujias'];
        $km_bujias      = $_POST['kmtbujias'];
        $rev_balatas    = $_POST['rev_balatas'];
        $engrasado      = $_POST['engrasado'];
        $anti_congela   = $_POST['anti_congela'];
        $liquido_frenos = $_POST['liquido_frenos'];
        $aceite_hidraul = $_POST['aceite_hidraul'];
        $rota_llantas   = $_POST['rota_llantas'];
        $banda_acessor  = $_POST['banda_acessor'];
        $rev_muelles    = $_POST['rev_muelles'];
        $amortiguadores = $_POST['amortiguadores'];
        $rev_luces      = $_POST['rev_luces'];
        $rev_bateria    = $_POST['rev_bateria'];
        $inyectores     = $_POST['inyectores'];
        $masas_frente   = $_POST['masas_frente'];
        $trabajo_sol    = $_POST['trabajosolic'];
        $kilometraje    = $_POST['kilometraje'];
        $fecha_inicio   = $_POST['dateinicio'];
        $fecha_fin      = $_POST['datefin'];
        $notasgen       = $_POST['notasgen'];
        //$delanteraizq   = $_POST['delanteraizq'];
        //$delanterader   = $_POST['delanterader'];
        //$traseraizq     = $_POST['traseraizq'];
        //$traserader     = $_POST['traserader'];
        $statusnew      = $_POST['statusnew'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editsolicitudmprev($folio, '$fecha', '$nounidad', '$tipo_unidad', '$operador', '$solicita', '$filtro_aceite', '$filtro_aire', '$filtro_gas', '$cambio_aceite', '$cambio_bujias', '$km_bujias', '$rev_balatas', '$engrasado', '$anti_congela', '$liquido_frenos', '$aceite_hidraul', '$rota_llantas', '$banda_acessor', '$rev_muelles', '$amortiguadores', '$rev_luces', '$rev_bateria', '$inyectores', '$masas_frente', '$trabajo_sol', $kilometraje, '$fecha_inicio', '$fecha_fin', '$notasgen', $statusnew, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
} 

//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalleditRequisicion'){
                
                $c_noorden = $_POST['noorden'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_requisicioncompra WHERE folio = $c_noorden ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td>'.$data['dato_e'].'</td>
                                            <td>'.$data['dato_om'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>';
                    }

                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }

// Agregar Detalle a la Requisicion
        if($_POST['action'] == 'AddDetalleEditcotizacion'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio      = $_POST['folio'];
                $codigo       = $_POST['codigo'];
                $descripcion  = $_POST['descripcion'];
                $marca        = $_POST['marca'];
                $cantidad     = $_POST['cantidad'];
                $precio       = $_POST['precio'];
                $impuesto     = $_POST['impuesto'];
                $impuestoisr  = $_POST['impuestoisr'];
                $impuestoieps = $_POST['impuestoieps'];
                $importe      = $_POST['importe'];
                $datoe        = $_POST['datoe'];
                $datoom       = $_POST['datoom'];
                
                $token        = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_detalleEditcotizacion($nofolio, '$codigo', '$descripcion', '$marca', $cantidad, $precio, $impuesto, $impuestoisr, $impuestoieps, $importe, '$datoe', '$datoom', '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    $totsubtotal = $totsubtotal + $subtotal;
                    //$totiva = $totiva + $iva;
                    


                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td>'.$data['dato_e'].'</td>
                                            <td>'.$data['dato_om'].'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                data-datoe="'.$data['dato_e'].'"
                                                data-datoom="'.$data['dato_om'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        } 

// Elimina refacciones del detalle Temporal Mannto

        if($_POST['action'] == 'delDetalleEditcotizacion'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_editreq($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = (($data['cantidad'] * $data['precio']) * $data['impuesto'])/100;
                    $totsubtotal = $totsubtotal + $subtotal;
                    //$totiva = $totiva + $iva;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td>'.($data['dato_e']).'</td>
                                            <td>'.($data['dato_om']).'</td>
                                            
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                data-datoe="'.$data['dato_e'].'"
                                                data-datoom="'.$data['dato_om'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
                  
                $arrayData['detalle'] = $detalleTablaPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }  

//Almacena Requisicion de compra
if($_POST['action'] == 'AlmacenaEditRequerimiento')
{
    if(empty($_POST['fecha']) || empty($_POST['tipo']) || empty($_POST['areasolicita']) )
    {
       echo 'error';
    }else{
        
        $folio        = $_POST['folio'];
        $fecha        = $_POST['fecha'];
        $fecha_req    = $_POST['fecha_req'];
        $tipo         = $_POST['tipo'];
        $areasolicita = $_POST['areasolicita'];
        $monto_aut    = $_POST['montoaut'];
        $notas        = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editrequisicion($folio, '$fecha', '$fecha_req', '$tipo', '$areasolicita', $monto_aut, '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalleditOrdencompra'){
                
                $c_noorden = $_POST['noorden'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_ordencompra WHERE folio = $c_noorden ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                        
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                        $subtotal = $data['cantidad'] * $data['precio'];
                        $iva = $data['impuesto'] /100;
                        $isr = $data['impuesto_isr'] /100;
                        $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                        $totsubtotal = $totsubtotal + $subtotal;
                        $imprteIva  = $subtotal * $iva;
                        $imprteIsr  = $subtotal * $isr;
                        $totiva     = $totiva + $imprteIva;
                        $totisr     = $totisr + $imprteIsr;
                        $totieps    = $totieps + $ieps;
                
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                  if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }

                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }


// Edita Movimiento Cotizacion Compra

if($_POST['action'] == 'ActualizaEditMovordencompra'){

            
                $id_c       = $_POST['detid'];
                $folio_c    = $_POST['detfolio'];
                $codigo_c   = $_POST['detcodigo'];
                $descrip_c  = $_POST['detdescripc'];
                $unidadm_c  = $_POST['unidadmedida'];
                $marca_c    = $_POST['detmarca'];
                $cantidad_c = $_POST['detcantidad'];
                $precio_c   = $_POST['detprecio'];
                $impuesto_c = $_POST['detimpuesto'];
                $impisr_c   = $_POST['detimpisr'];
                $impieps_c  = $_POST['detimpieps'];
                $importe_c  = $_POST['detimporte'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_editdetalleordencompra($id_c, $folio_c, '$codigo_c', '$descrip_c', '$unidadm_c', '$marca_c', $cantidad_c, $precio_c, $impuesto_c, $impisr_c, $impieps_c, $importe_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                        
                         $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-imptieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }

                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        } 

// Elimina refacciones del detalle Orden de Compra

        if($_POST['action'] == 'delEditDetordencompra'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_editordencompra($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }  


//Almacena Orden de compra
if($_POST['action'] == 'AlmacenaEditOrdencompra')
{
    if(empty($_POST['fecha']) || empty($_POST['proveedor']))
    {
       echo 'error';
    }else{
        
        $idoc         = $_POST['idoc'];
        $folio        = $_POST['folio'];
        $noreq        = $_POST['noreq'];
        $fecha        = $_POST['fecha'];
        $proveedor    = $_POST['proveedor'];
        $contacto     = $_POST['contacto'];
        $telefono     = $_POST['telefono'];
        $correo       = $_POST['correo'];
        $formapago    = $_POST['forma_pago'];
        $metodopago   = $_POST['metodo_pago'];
        $usocfdi      = $_POST['uso_cfdi'];
        $solicita     = $_POST['solicita'];
        $notas        = $_POST['notas'];
        $recibe       = $_POST['recibe'];
        $estatus      = $_POST['status'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editordencompra($idoc, $folio, $noreq, '$fecha', $proveedor, '$contacto', '$telefono', '$correo', '$formapago', '$metodopago', '$usocfdi', '$solicita', '$notas', '$recibe', $estatus, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

//*Cambia  Nomina de Empleado
if($_POST['action'] == 'ActualizaNomEmpleadoQuincena')
{
    if(!empty($_POST['nosemana']) || !empty($_POST['noempleado']) )
    {
        
        $no_semana         = $_POST['nosemana'];
        $no_empleado       = $_POST['noempleado'];
        $name_empleado     = $_POST['nameempleado'];
        $sueldo_base       = $_POST['sueldo_base'];
        $dias_laborados    = $_POST['dias_laborados'];
        $viajes_especiales = $_POST['viajes_specils'];
        $viajes_normales   = $_POST['viajes_normals'];
        $total_especiales  = $_POST['total_specils'];
        $total_normales    = $_POST['total_normals'];
        $adeudos           = $_POST['adeudo'];
        $sueldo_total      = $_POST['sueldo_total'];
        $caja              = $_POST['caja'];
        $bono_categ        = $_POST['bono_categ'];
        $bono_superv       = $_POST['bono_superv'];
        $apoyo_mes         = $_POST['apoyo_mes'];
        $vacaciones        = $_POST['vacaciones'];
        $prima_vacac       = $_POST['prima_vacac'];
        $sueldo_quincen    = $_POST['sueldo_quinc'];
        $pago_fiscal       = $_POST['pago_fiscal'];
        $impuesto_fisc     = $_POST['impuesto_fis'];
        $total_nomina      = $_POST['total_nomina'];
        $total_gral        = $_POST['total_gral'];
        $total_total       = $_POST['total_total'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_nomempleadoquin('$no_semana', $no_empleado, '$name_empleado', $sueldo_base, $dias_laborados, $viajes_especiales, $viajes_normales, $total_especiales, $total_normales, $adeudos, $sueldo_total, $caja, $bono_categ, $bono_superv, $apoyo_mes, $vacaciones, $prima_vacac, $sueldo_quincen, $pago_fiscal, $impuesto_fisc, $total_nomina, $total_gral, $total_total, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalleditCompra'){
                
                $c_noorden = $_POST['noorden'];
                $token      = md5($_SESSION['idUser']);

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_compra WHERE folio = $c_noorden ORDER BY id ");
                $query_insert = mysqli_query($conection,"INSERT INTO detalle_tempcompra (folio, no_oc, cantidad, almacen, codigo, descripcion, unidad_medida, marca, precio, impuesto, importe, token) SELECT folio, no_oc, cantidad, almacen, codigo, descripcion, unidad_medida, marca, precio, impuesto, importe, '$token' from detalle_compra WHERE folio = $c_noorden ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                        
                $arrayData = array();

                if($result_editf > 0){     
                while ($data = mysqli_fetch_assoc($query_editf)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($subtotal,2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-unmed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }

// Elimina refacciones del detalle de Compra

        if($_POST['action'] == 'delDetEditcompra'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_editcompra($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-descrip="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }  

// Agregar Detalle a la Compra
        if($_POST['action'] == 'AddDetalleEditCompra'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio     = $_POST['folio'];
                $codigo      = $_POST['codigo'];
                $almacen     = $_POST['almacen'];
                $descripcion = $_POST['descripcion'];
                $umedida     = $_POST['umedida'];
                $marca       = $_POST['marca'];
                $cantidad    = $_POST['cantidad'];
                $precio      = $_POST['precio'];
                $impuesto    = $_POST['impuesto'];
                $impisr      = $_POST['impisr'];
                $impieps     = $_POST['impieps'];
                $importe     = $_POST['importe'];
                $lote        = date('Ymd-His');
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_edit_detallecompra($nofolio, '$codigo', '$almacen', '$descripcion', '$umedida', '$marca', $cantidad, $precio, $impuesto, $impisr, $impieps, $importe, '$lote', '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-unmed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        } 

// Edita Movimiento Cotizacion Compra

if($_POST['action'] == 'ActualizaMovEditcompra'){

            
                $id_c       = $_POST['detid'];
                $folio_c    = $_POST['detfolio'];
                $codigo_c   = $_POST['detcodigo'];
                $almacen_c  = $_POST['detalmacen'];
                $descrip_c  = $_POST['detdescripc'];
                $umedida_c  = $_POST['detumedida'];
                $marca_c    = $_POST['detmarca'];
                $cantidad_c = $_POST['detcantidad'];
                $precio_c   = $_POST['detprecio'];
                $impuesto_c = $_POST['detimpuesto'];
                $impisr_c   = $_POST['detimpisr'];
                $impieps_c  = $_POST['detimpieps'];
                $importe_c  = $_POST['detimporte'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detalleeditcompra($id_c, $folio_c, '$codigo_c', '$almacen_c', '$descrip_c', '$umedida_c', '$marca_c', $cantidad_c, $precio_c, $impuesto_c, $impisr_c, $impieps_c, $importe_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                        
                         $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-unmed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }

                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        }                                     

//Almacena Compra
if($_POST['action'] == 'AlmacenaEditCompra')
{
    if(empty($_POST['fecha']) || empty($_POST['proveedor']))
    {
       echo 'error';
    }else{
        
        $idco         = $_POST['idco'];
        $folio        = $_POST['folio'];
        $noorden      = $_POST['noorden'];
        $noreq        = $_POST['noreq'];
        $fecha        = $_POST['fecha'];
        $proveedor    = $_POST['proveedor'];
        $contacto     = $_POST['contacto'];
        $telefono     = $_POST['telefono'];
        $correo       = $_POST['correo'];
        $formapago    = $_POST['forma_pago'];
        $metodopago   = $_POST['metodo_pago'];
        $usocfdi      = $_POST['uso_cfdi'];
        $solicita     = $_POST['solicita'];
        $nofactura    = $_POST['nofactura'];
        $notas        = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editcompra($idco, $folio, $noorden, $noreq, '$fecha', $proveedor, '$contacto', '$telefono', '$correo', '$formapago', '$metodopago', '$usocfdi', '$solicita', '$nofactura', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

//****************************//
        //Cancelar orden de compra
   if($_POST['action'] == 'procesarSalirEditcompra'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_editcompra($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    } 

//****************************//
        //Cancelar devolucion de compra
   if($_POST['action'] == 'procesarSalirdevcompra'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_devcompra($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    } 

//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalledevCompra'){
                
                $idprov = $_POST['idprov'];
                $importedev = $_POST['importedev'];
                $token  = md5($_SESSION['idUser']);

                $query_editf = mysqli_query($conection,"SELECT * FROM compras WHERE proveedor = $idprov and metodo_pago != 'PUE Pago de Una Sola Exhibicion' and saldo_compra > 0 ORDER BY no_compra ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaPe = '';
                $pago    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                        
                $arrayData = array();

                if($result_editf > 0){     
                while ($data = mysqli_fetch_assoc($query_editf)){
                    $pago = $data['total'] - $data['saldo_compra'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    //$iva = (($data['cantidad'] * $data['precio']) * $data['impuesto'])/100;
                    //$totsubtotal = $totsubtotal + $subtotal;
                    //$totiva = $totiva + $iva;
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['fecha'].'</td>
                                            <td>'.$data['no_compra'].'</td>
                                            <td align="right">'.number_format($data['total'],2).'</td>
                                            <td align="right">'.number_format($data['saldo_compra'],2).'</td>
                                            <td>'.number_format($pago,2).'</td>
                                            <td>                                      
                                          
                                            <a id="alumno" 
                                                data-target="#modalPago" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-fcha="'.$data['fecha'].'" 
                                                data-folio="'.$data['no_compra'].'"
                                                data-total="'.$data['total'].'"
                                                data-saldo="'.$data['saldo_compra'].'"
                                               
                                                href="#" 
                                                class="sepV_a" 
                                                title="Aplicar Pago"><i class="fas fa-check"></i></a>
                                            </td>
                                        </tr>';
                    }
                    
                  
                $arrayData['detalle'] = $detalleTablaPe;
                //$arrayData['totales'] = $detalleTotalesPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }

// Agregar Detalle a la Compra
        if($_POST['action'] == 'AddDetalleDevCompra'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio     = $_POST['folio'];
                $codigo      = $_POST['codigo'];
                $almacen     = $_POST['almacen'];
                $descripcion = $_POST['descripcion'];
                $umedida     = $_POST['umedida'];
                $marca       = $_POST['marca'];
                $cantidad    = $_POST['cantidad'];
                $precio      = $_POST['precio'];
                $impuesto    = $_POST['impuesto'];
                $importe     = $_POST['importe'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_temp_detalledevcompra($nofolio, '$codigo', '$almacen', '$descripcion', '$umedida', '$marca', $cantidad, $precio, $impuesto, $importe, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    $iva = (($data['cantidad'] * $data['precio']) * $data['impuesto'])/100;
                    $totsubtotal = $totsubtotal + $subtotal;
                    $totiva = $totiva + $iva;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-unmed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    $totalgral = $totsubtotal + $totiva;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
                $arrayData['totaldev'] = number_format($totalgral,2);
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        }  

    // Buscar Datos del Cliente
        if($_POST['action'] == 'searchDatosCliente')
        {
            if(!empty($_POST['op'])){
                $namecte = $_POST['op'];
        
                $query = mysqli_query($conection,"SELECT id, nombre, nombre_corto, calle, colonia, estado, ciudad, municipio, pais, cod_postal, CONCAT(calle, ', COL. ', colonia, ', ', municipio, ', ', ciudad, ', ', estado, ', ', 'C.P.: ', cod_postal) as direccion FROM clientes WHERE nombre = '$namecte' ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }  
                               
//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalleditCotventa'){
                
                $c_noorden = $_POST['noorden'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_cotizacionventa WHERE folio = $c_noorden ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['ruta'].'</td>
                                            <td>'.$data['unidad'].'</td>
                                            <td>'.$data['capacidad'].'</td>
                                            <td>'.$data['dias_horas'].'</td>
                                            <td align="right">'.number_format($data['precio_servicio'],2).'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['ruta'].'"
                                                data-codig="'.$data['unidad'].'"
                                                data-descrip="'.$data['capacidad'].'"
                                                data-marca="'.$data['dias_horas'].'"
                                                data-precio="'.$data['precio_servicio'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        } 


// Agregar Detalle a la Requisicion
        if($_POST['action'] == 'AddDetalleEditcotizacionventa'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio   = $_POST['folio'];
                $ruta      = $_POST['ruta'];
                $unidad    = $_POST['unidad'];
                $capacidad = $_POST['capacidad'];
                $diashoras = $_POST['diashoras'];
                $precio    = $_POST['precio'];
               
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_detcotventa($nofolio, '$ruta', '$unidad', '$capacidad', '$diashoras', $precio, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                   
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['ruta'].'</td>
                                            <td>'.$data['unidad'].'</td>
                                            <td>'.$data['capacidad'].'</td>
                                            <td>'.$data['dias_horas'].'</td>
                                            <td align="right">'.number_format($data['precio_servicio'],2).'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['ruta'].'"
                                                data-codig="'.$data['unidad'].'"
                                                data-descrip="'.$data['capacidad'].'"
                                                data-marca="'.$data['dias_horas'].'"
                                                data-precio="'.$data['precio_servicio'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        }


 // Edita Sercicio Cotizacion venta

if($_POST['action'] == 'ActualizaEditMovcotizacionventa'){

            
                $id_c        = $_POST['detid'];
                $folio_c     = $_POST['detfolio'];
                $ruta_c      = $_POST['detruta'];
                $unidad_c    = $_POST['detunidad'];
                $capacidad_c = $_POST['detcapacidad'];
                $diashoras_c = $_POST['detdiashoras'];
                $precio_c    = $_POST['detprecio'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_editdetallecotventa($id_c, $folio_c, '$ruta_c', '$unidad_c', '$capacidad_c', '$diashoras_c', $precio_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $detalleTotales = '';
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                   
                   
                        $detalleTabla .= '<tr>
                                            <td>'.$data['ruta'].'</td>
                                            <td>'.$data['unidad'].'</td>
                                            <td>'.$data['capacidad'].'</td>
                                            <td>'.$data['dias_horas'].'</td>
                                            <td align="right">'.number_format($data['precio_servicio'],2).'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['ruta'].'"
                                                data-codig="'.$data['unidad'].'"
                                                data-descrip="'.$data['capacidad'].'"
                                                data-marca="'.$data['dias_horas'].'"
                                                data-precio="'.$data['precio_servicio'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    
                    
                $arrayData['detalle'] = $detalleTabla;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        } 

 // Elimina Servicio del detalle Temporal Cotizacion venta

        if($_POST['action'] == 'delDetalleCotventa'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_cotizaventa($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
              

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                   
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['ruta'].'</td>
                                            <td>'.$data['unidad'].'</td>
                                            <td>'.$data['capacidad'].'</td>
                                            <td>'.$data['dias_horas'].'</td>
                                            <td align="right">'.number_format($data['precio_servicio'],2).'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['ruta'].'"
                                                data-codig="'.$data['unidad'].'"
                                                data-descrip="'.$data['capacidad'].'"
                                                data-marca="'.$data['dias_horas'].'"
                                                data-precio="'.$data['precio_servicio'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
                  
                $arrayData['detalle'] = $detalleTablaPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }  

//Almacena Cotizacion Venta
if($_POST['action'] == 'AlmacenaEdicionCotizacionvta')
{
    if(empty($_POST['fecha']) || empty($_POST['name_empresa']) )
    {
       echo 'error';
    }else{
        
        $folio        = $_POST['folio'];
        $fecha        = $_POST['fecha'];
        $atencion     = $_POST['atencion'];
        $tcliente     = $_POST['tcliente'];
        $empresa      = $_POST['name_empresa'];
        $direccion    = $_POST['direccion'];
        $diascredito  = $_POST['diascredito'];
        $diascomienzo = $_POST['diascomienzo'];
        $dateinicio   = $_POST['dateinicio'];
        $datefin      = $_POST['datefin'];
        $notas        = $_POST['notas'];
        $estatus      = $_POST['status'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editcotizacionvta($folio, '$fecha', '$atencion', '$tcliente', '$empresa', '$direccion', '$diascredito', '$diascomienzo', '$dateinicio', '$datefin', '$notas', $estatus, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


// Elimina cotizacion de Ventas

if($_POST['action'] == 'EliminaCotizacionVenta')
{

        $nfolio   = $_POST['nfolio'];
        $nempresa = $_POST['nempresa'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

            $query_procesar = mysqli_query($conection,"CALL baja_cotizacionvta($nfolio, '$nempresa', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
    exit;
} 

// Copia Cotizacion

    if($_POST['action'] == 'AddCopiaCotizacion')
    {
      if(!empty($_POST['idcp']) )
      {
        $folio      = $_POST['idcp'];
        
        $token    = md5($_SESSION['idUser']);
        $usuario  = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL copia_cotizacion($folio, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    } 

//*Cambia  Nomina de Empleado
if($_POST['action'] == 'ActualizaEditNomEmpleado')
{
    if(!empty($_POST['nosemana']) || !empty($_POST['noempleado']) )
    {
        
        $no_semana     = $_POST['nosemana'];
        $no_empleado   = $_POST['noempleado'];
        $name_empleado = $_POST['nameempleado'];
        $sueldo_base   = $_POST['sueldo_base'];
        $viajes_espc   = $_POST['viajes_espc'];
        $viajes_ctrato = $_POST['viajes_cto'];
        $adeudo        = $_POST['adeudo'];
        $caja          = $_POST['caja'];
        $bono_categ    = $_POST['bono_categ'];
        $bono_superv   = $_POST['bono_superv'];
        $bono_semanal  = $_POST['bono_semanal'];
        $apoyo_mes     = $_POST['apoyo_mes'];
        $sueldo_add    = $_POST['sueldo_add'];
        $sueldo_espc   = $_POST['total_espc'];
        $total_ctrato  = $_POST['total_cto'];
        $prima_vacac   = $_POST['prima_vacac'];
        $vacaciones    = $_POST['vacaciones'];
        $sueldo_bruto  = $_POST['sueldo_bruto'];
        $pago_fiscal   = $_POST['pago_fiscal'];
        $impuesto_fisc = $_POST['impuesto_fis'];
        $total_nomina  = $_POST['total_nomina'];
        $total_gral    = $_POST['total_gral'];
        $total_total   = $_POST['total_total'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editnomimaempleado('$no_semana', $no_empleado, '$name_empleado', $sueldo_base, $viajes_espc, $viajes_ctrato, $adeudo, $caja, $bono_categ, $bono_superv, $bono_semanal, $apoyo_mes, $sueldo_add, $sueldo_espc, $total_ctrato, $prima_vacac, $vacaciones, $sueldo_bruto, $pago_fiscal, $impuesto_fisc, $total_nomina, $total_gral, $total_total, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Borra Empleado de  Edicion de Nomina Semanal
        if($_POST['action'] == 'DeleteEmpleadoNomSemEdit')
                {
                    $nsemana    = $_POST['nsemana'];
                    $noempleado = $_POST['noempleado'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL borra_editempleadonomsem('$nsemana', $noempleado)");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }
  

//Extrae datos del detalle_Formula Edicion
        if($_POST['action'] == 'searchForDetalleditOservicio'){
                
                $c_noorden = $_POST['noorden'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_ordenservicio WHERE folio = $c_noorden ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['rutas'].'</td>
                                            <td>'.$data['hora_inicio'].'</td>
                                            <td>'.$data['hora_salida'].'</td>
                                            <td>'.$data['turnos'].'</td>
                                            <td>'.$data['tipo_unidad'].'</td>
                                            <td>'.$data['tipo_vuelta'].'</td>
                                            <td>'.$data['dias_trabajar'].'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['rutas'].'"
                                                data-codig="'.$data['hora_inicio'].'"
                                                data-hslida="'.$data['hora_salida'].'"
                                                data-turnos="'.$data['turnos'].'"
                                                data-descrip="'.$data['tipo_unidad'].'"
                                                data-tvelta="'.$data['tipo_vuelta'].'"
                                                data-marca="'.$data['dias_trabajar'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Datos"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        } 

// Agregar Detalle a la Requisicion
        if($_POST['action'] == 'AddDetalleEditordenservicio'){
            if(empty($_POST['folio']) )
            {
                echo 'error';
            }else{
                $nofolio    = $_POST['folio'];
                $ruta       = $_POST['ruta'];
                $horaini    = $_POST['horaini'];
                $horasalida = $_POST['horaslda']; 
                $turno      = $_POST['turno'];
                $unidad     = $_POST['unidad'];
                $tipovuelta = $_POST['tvuelta'];
                $diastrab   = $_POST['diastrab'];
               
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL add_detordenserv($nofolio, '$ruta', '$horaini', '$horasalida', '$turno', '$unidad', '$tipovuelta', '$diastrab', '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                   
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['rutas'].'</td>
                                            <td>'.$data['hora_inicio'].'</td>
                                            <td>'.$data['hora_salida'].'</td>
                                            <td>'.$data['turnos'].'</td>
                                            <td>'.$data['tipo_unidad'].'</td>
                                            <td>'.$data['tipo_vuelta'].'</td>
                                            <td>'.$data['dias_trabajar'].'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['rutas'].'"
                                                data-codig="'.$data['hora_inicio'].'"
                                                data-hslida="'.$data['hora_salida'].'"
                                                data-turnos="'.$data['turnos'].'"
                                                data-descrip="'.$data['tipo_unidad'].'"
                                                data-tvelta="'.$data['tipo_vuelta'].'"
                                                data-marca="'.$data['dias_trabajar'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Datos"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error";
            }   
        }
            exit;   
        } 

// Edita Servicio Orden de Servicio

if($_POST['action'] == 'ActualizaEditDetordenserv'){

            
                $id_c        = $_POST['detid'];
                $folio_c     = $_POST['detfolio'];
                $ruta_c      = $_POST['detruta'];
                $horaini_c   = $_POST['dethoraini'];
                $horasal_c   = $_POST['dethoraslda'];
                $turnos_c    = $_POST['detturnos'];
                $unidad_c    = $_POST['detunidad'];
                $vuelta_c    = $_POST['detvuelta'];
                $diastrab_c  = $_POST['detdiastrab'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_detalleordenservedit($id_c, $folio_c, '$ruta_c', '$horaini_c', '$horasal_c', '$turnos_c', '$unidad_c', '$vuelta_c', '$diastrab_c', '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTabla = '';
                $detalleTotales = '';
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                   
                   
                        $detalleTabla .= '<tr>
                                            <td>'.$data['rutas'].'</td>
                                            <td>'.$data['hora_inicio'].'</td>
                                            <td>'.$data['hora_salida'].'</td>
                                            <td>'.$data['turnos'].'</td>
                                            <td>'.$data['tipo_unidad'].'</td>
                                            <td>'.$data['tipo_vuelta'].'</td>
                                            <td>'.$data['dias_trabajar'].'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['rutas'].'"
                                                data-codig="'.$data['hora_inicio'].'"
                                                data-hslida="'.$data['hora_salida'].'"
                                                data-turnos="'.$data['turnos'].'"
                                                data-descrip="'.$data['tipo_unidad'].'"
                                                data-tvelta="'.$data['tipo_vuelta'].'"
                                                data-marca="'.$data['dias_trabajar'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Datos"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    
                    
                $arrayData['detalle'] = $detalleTabla;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        }  

// Elimina Servicio del detalle Temporal Cotizacion venta

        if($_POST['action'] == 'delDetEditordenservicio'){

            if(empty($_POST['id_det']))
            {
                echo 'error';
            }else{
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);


                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_ordenserv($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
              

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                   
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['rutas'].'</td>
                                            <td>'.$data['hora_inicio'].'</td>
                                            <td>'.$data['hora_salida'].'</td>
                                            <td>'.$data['turnos'].'</td>
                                            <td>'.$data['tipo_unidad'].'</td>
                                            <td>'.$data['tipo_vuelta'].'</td>
                                            <td>'.$data['dias_trabajar'].'</td>
                                            <td align="center"><a id="cimagen" 
                                                data-target="#modalCargaimagen" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Carga imagen"><i class="far fa-images"></i></a>&nbsp;&nbsp;&nbsp;<a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['rutas'].'"
                                                data-codig="'.$data['hora_inicio'].'"
                                                data-hslida="'.$data['hora_salida'].'"
                                                data-turnos="'.$data['turnos'].'"
                                                data-descrip="'.$data['tipo_unidad'].'"
                                                data-tvelta="'.$data['tipo_vuelta'].'"
                                                data-marca="'.$data['dias_trabajar'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Datos"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
                  
                $arrayData['detalle'] = $detalleTablaPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
            }
        
            exit;
        }

//Almacena Orden de Servicio
if($_POST['action'] == 'AlmacenaEditOrdenservicio')
{
    if(empty($_POST['fecha']) || empty($_POST['nocliente']) || empty($_POST['cliente']))
    {
       echo 'error';
    }else{
        
        $idos         = $_POST['id'];
        $folio        = $_POST['folio'];
        $fecha        = $_POST['fecha'];
        $nocliente    = $_POST['nocliente'];
        $cliente      = $_POST['cliente'];
        $direccion    = $_POST['direccion'];
        $tiposervicio = $_POST['tiposervicio'];
        $dateservicio = $_POST['dateservicio'];
        $contacto     = $_POST['contacto'];
        $correo       = $_POST['correo'];
        $telefono     = $_POST['telefono'];
        $notas        = $_POST['notas'];
        $requisitos   = $_POST['requisitos'];
        $genera       = $_POST['genera'];
        $recibe       = $_POST['recibe'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editordenservicio($idos, $folio, '$fecha', $nocliente, '$cliente', '$direccion', '$tiposervicio', '$dateservicio', '$contacto', '$correo', '$telefono', '$notas', '$requisitos', '$genera', '$recibe', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}  

// Buscar Datos del Cliente
        if($_POST['action'] == 'searchDatosClienteDir')
        {
            if(!empty($_POST['op'])){
                $namecte = $_POST['op'];
        
                $query = mysqli_query($conection,"SELECT id, nombre, nombre_corto, calle, colonia, estado, ciudad, municipio, pais, cod_postal, telefono, correo  FROM clientes WHERE nombre_corto = '$namecte' ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }  



//Agregar Productos a Entrada
if($_POST['action'] == 'AlmacenaEditSolicitudcredito')
{
    if(!empty($_POST['cliente']) || !empty($_POST['daterec']) || !empty($_POST['monto']) || !empty($_POST['plazo']))
    {
        $idsc         = $_POST['idsc'];
        $cliente      = $_POST['cliente'];
        $daterec      = $_POST['daterec'];
        $monto        = $_POST['monto'];
        $plazo        = $_POST['plazo'];
        $regimen      = $_POST['regimen'];
        $razonsoc     = $_POST['razonsoc'];
        $calle        = $_POST['calle'];
        $entrecalle   = $_POST['entrecalle'];
        $colonia      = $_POST['colonia'];
        $ciudad       = $_POST['ciudad'];
        $municipio    = $_POST['municipio'];
        $sector       = $_POST['sector'];
        $estado       = $_POST['estado'];
        $codpostal    = $_POST['codpostal'];
        $phone        = $_POST['phone'];
        $fax          = $_POST['fax'];
        $email        = $_POST['email'];
        $giro         = $_POST['giro'];
        $antiguedad   = $_POST['antiguedad'];
        $namerep      = $_POST['namerep'];
        $rfcrep       = $_POST['rfcrep'];
        $callerep     = $_POST['callerep'];
        $entrecallerep = $_POST['entrecallerep'];
        $coloniarep    = $_POST['coloniarep'];
        $ciudadrep     = $_POST['ciudadrep'];
        $estadorep     = $_POST['estadorep'];
        $nacionalrep   = $_POST['nacionalrep'];
        $emailrep      = $_POST['emailrep'];
        $phonerep      = $_POST['phonerep'];
        $banco1        = $_POST['banco1'];
        $sucursal1     = $_POST['sucursal1'];
        $nocuenta1     = $_POST['nocuenta1'];
        $phonebanco1   = $_POST['phonebco1'];
        $ejecutivo1    = $_POST['ejecutivo1'];
        $banco2        = $_POST['banco2'];
        $sucursal2     = $_POST['sucursal2'];
        $nocuenta2     = $_POST['nocuenta2'];
        $phonebanco2   = $_POST['phonebco2'];
        $ejecutivo2    = $_POST['ejecutivo2'];
        $banco3        = $_POST['banco3'];
        $sucursal3     = $_POST['sucursal3'];
        $nocuenta3     = $_POST['nocuenta3'];
        $phonebanco3   = $_POST['phonebco3'];
        $ejecutivo3    = $_POST['ejecutivo3'];
        $proveedor1    = $_POST['proveedor1'];
        $phoneprov1    = $_POST['phoneprov1'];
        $contactopv1   = $_POST['contactopv1'];
        $proveedor2    = $_POST['proveedor2'];
        $phoneprov2    = $_POST['phoneprov2'];
        $contactopv2   = $_POST['contactopv2'];
        $proveedor3    = $_POST['proveedor3'];
        $phoneprov3    = $_POST['phoneprov3'];
        $contactopv3   = $_POST['contactopv3'];
        $proveedor4    = $_POST['proveedor4'];
        $phoneprov4    = $_POST['phoneprov4'];
        $contactopv4   = $_POST['contactopv4'];
        $nameaval      = $_POST['nameaval'];
        $rfcaval       = $_POST['rfcaval'];
        $calleaval     = $_POST['calleaval'];
        $entrecalleav  = $_POST['entrecalleav'];
        $coloniaaval   = $_POST['coloniaaval'];
        $ciudadaval    = $_POST['ciudadaval'];
        $estadoaval    = $_POST['estadoaval'];
        $sectoraval    = $_POST['sectoraval'];
        $cpostalaval   = $_POST['cpostalaval'];
        $nacionalaval  = $_POST['nacionaval'];
        $edocivilaval  = $_POST['edocivilaval'];
        $phoneaval     = $_POST['phoneaval'];
        $comentarios   = $_POST['comentarios'];
        $cedulafiscal  = $_POST['cedulafisica'];
        $podermoral    = $_POST['podermoral'];
        $domiciliofis  = $_POST['domiciliofis'];
        $cedulamoral   = $_POST['cedulamoral'];
        $autorizafis   = $_POST['autorizafis'];
        $identifmoral  = $_POST['identifmoral'];
        $identiffisica = $_POST['identiffisica'];
        $domiciliomral = $_POST['domiciliomor'];
        $autorizamoral = $_POST['autorizamoral'];
        $cliente_ref   = $_POST['cliente_ref'];
        $timecliente   = $_POST['timecliente'];
        $diascred      = $_POST['diascred'];
        $montocredito  = $_POST['montocred'];
        $formapago     = $_POST['formapago'];
        $bancoreferen  = $_POST['bancoref'];
        $chsinfondos   = $_POST['chequesinfon'];
        $chdevueltos   = $_POST['chequesdev'];
        $compramensual = $_POST['comprames'];
        $productosref  = $_POST['productos'];
        $saldopendte   = $_POST['saldopend'];
        $cantidadsaldo = $_POST['cantsaldo'];
        $diasatraso    = $_POST['diasatraso'];
        $domicilioref  = $_POST['domreferecia'];
        $terminosref   = $_POST['terminosref'];
        $proporcionadt = $_POST['kproporciona'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editsolicitudcredito($idsc, '$cliente', '$daterec', $monto, '$plazo', '$regimen', '$razonsoc', '$calle', '$entrecalle', '$colonia', '$ciudad', '$municipio', '$sector', '$estado', $codpostal, '$phone', '$fax', '$email', '$giro', '$antiguedad', '$namerep', '$rfcrep', '$callerep', '$entrecallerep', '$coloniarep', '$ciudadrep', '$estadorep', '$nacionalrep', '$emailrep', '$phonerep', '$banco1', '$sucursal1', '$nocuenta1', '$phonebanco1', '$ejecutivo1', '$banco2', '$sucursal2', '$nocuenta2', '$phonebanco2', '$ejecutivo2', '$banco3', '$sucursal3', '$nocuenta3', '$phonebanco3', '$ejecutivo3', '$proveedor1', '$phoneprov1', '$contactopv1', '$proveedor2', '$phoneprov2', '$contactopv2', '$proveedor3', '$phoneprov3', '$contactopv3', '$proveedor4', '$phoneprov4', '$contactopv4', '$nameaval', '$rfcaval', '$calleaval', '$entrecalleav', '$coloniaaval', '$ciudadaval', '$estadoaval', '$sectoraval', $cpostalaval, '$nacionalaval', '$edocivilaval', '$phoneaval', '$comentarios', '$cedulafiscal', '$podermoral', '$domiciliofis', '$cedulamoral', '$autorizafis', '$identifmoral', '$identiffisica', '$domiciliomral', '$autorizamoral', '$cliente_ref', '$timecliente', '$diascred', '$montocredito', '$formapago', '$bancoreferen', '$chsinfondos', '$chdevueltos', '$compramensual', '$productosref', '$saldopendte', '$cantidadsaldo', '$diasatraso', '$domicilioref', '$terminosref', '$proporcionadt', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Almacena Orden de Servicio
if($_POST['action'] == 'AlmacenaEditPropiedadcp')
{
    if(empty($_POST['fecha']) || empty($_POST['empresa']) || empty($_POST['bienresgdo']))
    {
       echo 'error';
    }else{
        
        $idp           = $_POST['idp'];
        $fecha         = $_POST['fecha'];
        $empresa       = $_POST['empresa'];
        $representa    = $_POST['representa'];
        $direccion     = $_POST['direccion'];
        $telefono      = $_POST['telefono'];
        $correo        = $_POST['correo'];
        $bienresguardo = $_POST['bienresgdo'];
        $caracteristic = $_POST['caracterist'];
        $utilizarse    = $_POST['utilizarse'];
        $identifica    = $_POST['identifica'];
        $verifica      = $_POST['verifica'];
        $proteccion    = $_POST['proteccion'];
        $salvaguarda   = $_POST['salvaguarda'];
        $nombre1       = $_POST['nombre1'];
        $puesto1       = $_POST['puesto1'];
        $telcorreo1    = $_POST['telcorreo1'];
        $nombre2       = $_POST['nombre2'];
        $puesto2       = $_POST['puesto2'];
        $telcorreo2    = $_POST['telcorreo2'];
        $empresarecibe = $_POST['emprecibe'];
        $empresaentreg = $_POST['empentrega'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_edipropiedadescp($idp, '$fecha', '$empresa', '$representa', '$direccion', '$telefono', '$correo', '$bienresguardo', '$caracteristic', '$utilizarse', '$identifica', '$verifica', '$proteccion', '$salvaguarda', '$nombre1', '$puesto1', '$telcorreo1', '$nombre2', '$puesto2', '$telcorreo2', '$empresarecibe', '$empresaentreg', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

/* Almacena No venta */

//
if($_POST['action'] == 'AlmacenaEditNoventa')
{
    if(!empty($_POST['servicio']) || !empty($_POST['dateserv']) || !empty($_POST['clienteserv']))
    {
        $idnv         = $_POST['idnv'];
        $servicio     = $_POST['servicio'];
        $date_serv    = $_POST['dateserv'];
        $describ_serv = $_POST['describeserv'];
        $cliente_serv = $_POST['clienteserv'];
        $importe_serv = $_POST['importeserv'];
        $notas_serv   = $_POST['notasserv'];
        $elabora_serv = $_POST['elaboroserv'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editnoventa($idnv, '$servicio', '$date_serv', '$describ_serv', '$cliente_serv', $importe_serv, '$notas_serv', '$elabora_serv', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


/* Almacena Producto nuevo Requisicion */

if($_POST['action'] == 'AddProdnuevo')
{
    if(!empty($_POST['codinterno']) )
    {
        $codprod     = $_POST['codprod'];
        $codinterno  = $_POST['codinterno'];
        $describprod = $_POST['describprod'];
        $umedidprod  = $_POST['umedidprod'];
        $marcaprod   = $_POST['marcaprod'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL add_newproducto('$codprod', '$codinterno', '$describprod', '$umedidprod', '$marcaprod', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        $detalleTablaPe = '';
              
        $arrayData = array();
        $optionb = "<option value=''>-- Seleccione --</option>";

         if($result_detalle > 0){     
                while ($data = mysqli_fetch_assoc($query_procesar)){

                    $detalleTablaPe .= '<option value="'.$data["descripcion"].'">'.$data["descripcion"].'</option>"';
                    }
                  
                  
                $arrayData['detalle'] = $optionb . $detalleTablaPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection); 
        
            
        }else{
            echo "error";
        }
    
   

    }else{
        echo 'error';
    }
    exit;
}

// Generar Vuelta
    if($_POST['action'] == 'AddFirmaAreq')
    {
      if(!empty($_POST['firmareq']) )
      {
        $noreq     = $_POST['noreq'];
        $datereq   = $_POST['datereq'];
        $tiporeq   = $_POST['tiporeq'];
        $firmareq  = $_POST['firmareq'];

        $query_procesar = mysqli_query($conection,"CALL add_firmareq($noreq, '$datereq', '$tiporeq', '$firmareq' )");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }


    // Cambia Firma
        if($_POST['action'] == 'cambiaFirma')
                {
                    $firmanew = $_POST['firmanew'];

                    $query_procesarcf = mysqli_query($conection,"CALL actualiza_firma('$firmanew')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }


    // BORRA REQUISICION
    if($_POST['action'] == 'Borrarequisicion')
    {
      if(!empty($_POST['noreqi']) )
      {
        $noreqi     = $_POST['noreqi'];
        $areareqi   = $_POST['areareqi'];

        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL borra_requisicion($noreqi, '$areareqi', $usuario )");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }


    // CANCELA REQUISICION
    if($_POST['action'] == 'Cancelarequisicion')
    {
      if(!empty($_POST['noreqc']) )
      {
        $noreqc     = $_POST['noreqc'];
        $daterec    = $_POST['daterc'];
        $areasc     = $_POST['areasc'];
        $motivoc    = $_POST['motivoc'];

        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL cancela_requisicion($noreqc, '$motivoc', $usuario )");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }



    // BORRA ORDEN DE COMPRA
    if($_POST['action'] == 'BorrarOcompra')
    {
      if(!empty($_POST['nooc']) )
      {
        $nooc     = $_POST['nooc'];
        $provoc   = $_POST['provoc'];

        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL borra_ordencompra($nooc, '$provoc', $usuario )");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }

// CANCELA ORDEN DE COMPRA REQUISICION
    if($_POST['action'] == 'CancelarOcompra')
    {
      if(!empty($_POST['noocc']) )
      {
        $noocc     = $_POST['noocc'];
        $provocc   = $_POST['provocc'];
        $motivoc   = $_POST['motivoc'];

        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL cancelar_ordencompra($noocc, '$provocc', '$motivoc', $usuario )");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }

// Cancelacion de compra
    if($_POST['action'] == 'CancelaCompra')
    {
      if(!empty($_POST['nocomprac']) )

      {
        $date_compra = $_POST['datecompra'];
        $no_compra   = $_POST['nocomprac'];
        $cod_prov    = $_POST['codigoprov'];
        $prov_compra = $_POST['provcomprac'];

        $token    = md5($_SESSION['idUser']);
        $usuario  = $_SESSION['idUser'];


        $query_procesar = mysqli_query($conection,"CALL cancela_compra('$date_compra', $no_compra, $cod_prov, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }


// Cancelacion de compra
    if($_POST['action'] == 'BorraCompra')
    {
      if(!empty($_POST['nocomprac']) )

      {
        $date_compra = $_POST['datecompra'];
        $no_compra   = $_POST['nocomprac'];
        $cod_prov    = $_POST['codigoprov'];
        $prov_compra = $_POST['provcomprac'];

        $token    = md5($_SESSION['idUser']);
        $usuario  = $_SESSION['idUser'];


        $query_procesar = mysqli_query($conection,"CALL borrar_compra('$date_compra', $no_compra, $cod_prov, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }


/* Almacena Puesto */

//
if($_POST['action'] == 'AlmacenaPuesto')
{
    if(!empty($_POST['puesto']) )
    {
        $puesto    = $_POST['puesto'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_puesto('$puesto', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}        

/* Almacena Puesto */

//
if($_POST['action'] == 'AlmacenaEditPuesto')
{
    if(!empty($_POST['puesto']) || !empty($_POST['eestatus'])  )
    {
        $idcargo   = $_POST['idcr'];
        $puesto    = $_POST['puesto'];
        $eestatus  = $_POST['eestatus'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editpuesto($idcargo, '$puesto', $eestatus, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}  

//****************************//
        //Salir de No conformidad
   if($_POST['action'] == 'procesarSalirNC'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_noconformidad($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    }  

//Almacena No conformidad
    
if ($_POST['action'] == 'AlmacenaNc') {
    if (empty($_POST['noqueja']) || empty($_POST['fecha']) || empty($_POST['mes'])) {
        echo "error";
    } else {
        $no_queja    = $_POST['noqueja'] ?? "";
        $date_nc     = !empty($_POST['fecha']) ? "'".$_POST['fecha']."'" : "NULL";
        $mes_nc      = $_POST['mes'] ?? "";
        $cliente_nc  = $_POST['cliente'] ?? "";
        $formato     = $_POST['formato'] ?? "";
        $desc_nc     = $_POST['descripcion'] ?? "";
        $motivo_nc   = $_POST['motivo'] ?? "";
        $resp_nc     = $_POST['responsable'] ?? "";
        $superv_nc   = $_POST['supervisor'] ?? "";
        $operador_nc = $_POST['operador'] ?? "";
        $unidad_nc   = $_POST['unidad'] ?? "";
        $ruta_nc     = $_POST['ruta'] ?? "";
        $parada_nc   = $_POST['parada'] ?? "";
        $date_incid  = !empty($_POST['dateincident']) ? "'".$_POST['dateincident']."'" : "NULL";
        $turno_nc    = $_POST['turno'] ?? "";
        $procede_nc  = $_POST['procede'] ?? "";
        $porkprocede = $_POST['porkprocede'] ?? "";
        $analisis_nc = $_POST['analisis'] ?? "";
        $accion_nc   = $_POST['accion'] ?? "";
        $date_accion = !empty($_POST['dateaccion']) ? "'".$_POST['dateaccion']."'" : "NULL";
        $resp_accion = isset($_POST['respaccion']) ? implode(', ', $_POST['respaccion']) :  "";
        $observa_nc  = $_POST['notas'] ?? "";
        $tipo_incid  = $_POST['tipoinc'] ?? "";
        $estatus_nc  = $_POST['estatus'] ?? "";
        $causa_nc    = $_POST['causa'] ?? "";
        $afecta_cte = isset($_POST['afectacte']) ? substr($_POST['afectacte'], 0, 2) : "";
        $area_resp   = $_POST['arearespons'] ?? "";
        $date_cierre = !empty($_POST['datecierre']) ? "'".$_POST['datecierre']."'" : "NULL";

        $usuario     = $_SESSION['idUser'] ?? 0;

        $sql_noconform = "CALL procesar_noconformidad($no_queja, $date_nc, '$mes_nc', '$cliente_nc', '$formato', '$desc_nc', 
            '$motivo_nc', '$resp_nc', '$superv_nc', '$operador_nc', '$unidad_nc', '$ruta_nc', '$parada_nc', $date_incid, 
            '$turno_nc', '$procede_nc', '$porkprocede', '$analisis_nc', '$accion_nc', $date_accion, '$resp_accion', 
            '$observa_nc', '$tipo_incid', '$estatus_nc', '$causa_nc', '$afecta_cte', '$area_resp', $date_cierre, $usuario)";

            header('Content-Type: application/json'); // Asegura que la respuesta sea JSON
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); // Forzar MySQL a mostrar errores detallados

            try {
                $query_procesar = mysqli_query($conection, $sql_noconform);

                if ($query_procesar) {
                    echo json_encode(["mensaje" => "Registro insertado correctamente"], JSON_UNESCAPED_UNICODE);
                } else {
                    throw new Exception("Error en la consulta SQL: " . mysqli_error($conection));
                }
            } catch (Exception $e) {
                echo json_encode(["error" => $e->getMessage()], JSON_UNESCAPED_UNICODE);
            }

            exit();  
    }
}


//Almacena Edicion No conformidad
    
if($_POST['action'] == 'AlmacenaEditNc')
{
    if(empty($_POST['noqueja'])  || empty($_POST['fecha']) || empty($_POST['mes']) )
    {
        echo "error"; 
    }else {
        
        $id_nc       = $_POST['idnq'];
        $no_queja    = $_POST['noqueja'];
        $date_nc     = $_POST['fecha'];
        $mes_nc      = $_POST['mes'];
        $cliente_nc  = $_POST['cliente'];
        $formato     = $_POST['formato'];
        $desc_nc     = $_POST['descripcion'];
        $motivo_nc   = $_POST['motivo'];
        $resp_nc     = $_POST['responsable'];
        $superv_nc   = $_POST['supervisor'];
        $operador_nc = $_POST['operador'];
        $unidad_nc   = $_POST['unidad'];
        $ruta_nc     = $_POST['ruta'];
        $parada_nc   = $_POST['parada'];
        $date_incid  = $_POST['dateincident'];
        $turno_nc    = $_POST['turno'];
        $procede_nc  = $_POST['procede'];
        $porkprocede = $_POST['porkprocede'];
        $analisis_nc = $_POST['analisis'];
        $accion_nc   = $_POST['accion'];
        $date_accion = $_POST['dateaccion'];
        
        $observa_nc  = $_POST['notas'];
        $tipo_incid  = $_POST['tipoinc'];
        $estatus_nc  = $_POST['estatus'];
        $causa_nc    = $_POST['causa'];
        $afecta_cte  = $_POST['afectacte'];
        $area_resp   = $_POST['arearespons'];
        $date_cierre = $_POST['datecierre'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        if (!empty($_POST['respaccion']) && is_array($_POST['respaccion'])) {
    $resp_accion = implode(', ', $_POST['respaccion']);
} else {
    $resp_accion = ''; // O manejar el caso donde esté vacío
}
    
        $query_procesar = mysqli_query($conection,"CALL procesar_editnc($id_nc, $no_queja, '$date_nc', '$mes_nc', '$cliente_nc', '$formato', '$desc_nc', '$motivo_nc', '$resp_nc', '$superv_nc', '$operador_nc', '$unidad_nc', '$ruta_nc', '$parada_nc', '$date_incid', '$turno_nc', '$procede_nc', '$porkprocede', '$analisis_nc', '$accion_nc', '$date_accion', '$resp_accion', '$observa_nc', '$tipo_incid', '$estatus_nc', '$causa_nc', '$afecta_cte', '$area_resp', '$date_cierre', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        } 
    }
}

// Agregar Detalle a la Orden de Compra
        if($_POST['action'] == 'AddDetalleEditOrdencompra'){
            if(empty($_POST['folio']) )
            {
                echo 'error 1';
            }else{
                $nofolio     = $_POST['folio'];
                $codigo      = $_POST['codigo'];
                $descripcion = $_POST['descripcion'];
                $umedida     = $_POST['umedida'];
                $marca       = $_POST['marca'];
                $cantidad    = $_POST['cantidad'];
                $precio      = $_POST['precio'];
                $impuesto    = $_POST['impuesto'];
                $imp_isr     = $_POST['impisr'];
                $imp_ieps    = $_POST['impieps'];
                $importe     = $_POST['importe'];
                
                $token       = md5($_SESSION['idUser']);


                $query_detalle_mantto = mysqli_query($conection,"CALL add_detalleEditocompra($nofolio, '$codigo', '$descripcion', '$umedida', '$marca', $cantidad, $precio, $impuesto, $imp_isr, $imp_ieps, $importe, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    
                        $detalleTablaPe .= '<tr>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($subtotal,2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-cantid="'.$data['cantidad'].'"
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-impto="'.$data['impuesto'].'"
                                                data-impisr="'.$data['impuesto_isr'].'"
                                                data-impieps="'.$data['impuesto_ieps'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="6" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="6" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error2";
            }   
        }
            exit;   
        }           


// Agregar Requisición al detalle temporal compra
        if($_POST['action'] == 'addDetalleReqCompra'){
            
                $noorden = $_POST['ordenrq'];
                $folio   = $_POST['afolio'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_ocom= mysqli_query($conection,"CALL add_temp_reqcompra($noorden, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_ocom);

                $detalleTablaRe = '';
                $detalleTotalesRe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_detalle_ocom)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;
                    $solicita   = $data['area_solicitante'];
                   

                    $detalleTablaRe .= '<tr>
                                    <td align="right">'.number_format($data['cantidad'],2).'</td>
                                    <td>'.$data['codigo'].'</td>
                                    <td>'.$data['almacen'].'</td>
                                    <td>'.$data['descripcion'].'</td>
                                    <td>'.$data['unidad_medida'].'</td>
                                    <td>'.$data['marca'].'</td>
                                    <td align="right">'.number_format($data['precio'],2).'</td>
                                    <td align="right">'.number_format($data['importe'],2).'</td>
                                    <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a id="alumno" 
                                        data-target="#modalEditCotizacion" 
                                        data-toggle="modal" 
                                        data-id="'.$data['id'].'"
                                        data-nofol="'.$data['folio'].'" 
                                        data-cantid="'.$data['cantidad'].'"
                                        data-codig="'.$data['codigo'].'"
                                        data-almc="'.$data['almacen'].'"
                                        data-descrip="'.$data['descripcion'].'"
                                        data-unmed="'.$data['unidad_medida'].'"
                                        data-marca="'.$data['marca'].'"
                                        data-precio="'.$data['precio'].'"
                                        data-impto="'.$data['impuesto'].'"
                                        data-impisr="'.$data['impuesto_isr'].'"
                                        data-impieps="'.$data['impuesto_ieps'].'"
                                        data-importe="'.$data['importe'].'"
                                        href="#" 
                                        class="sepV_a" 
                                        title="Cambiar Cantidad"><i class="fas fa-edit"></i>
                                    </a>
                                    </td>
                                    </tr>';
                    }

                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }

                  
                $arrayData['detalle'] = $detalleTablaRe;
                $arrayData['totales'] = $detalleTotalesRe;

                $arrayData['solicita'] = $solicita;
                
                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   

            }else{
                echo 'error';
            }       
                
                exit;
        }  


 // Agregar producto al detalle compra
        if($_POST['action'] == 'addDetalleEditOcompra'){
            
                $noorden = $_POST['ordenno'];
                $folio   = $_POST['afolio'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_ocom= mysqli_query($conection,"CALL add_det_compra($noorden, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_ocom);

                $detalleTablaRe = '';
                $detalleTotalesRe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_detalle_ocom)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;

                    $detalleTablaRe .= '<tr>
                                    <td align="right">'.number_format($data['cantidad'],2).'</td>
                                    <td>'.$data['codigo'].'</td>
                                    <td>'.$data['almacen'].'</td>
                                    <td>'.$data['descripcion'].'</td>
                                    <td>'.$data['unidad_medida'].'</td>
                                    <td>'.$data['marca'].'</td>
                                    <td align="right">'.number_format($data['precio'],2).'</td>
                                    <td align="right">'.number_format($data['importe'],2).'</td>
                                    <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a id="alumno" 
                                        data-target="#modalEditCotizacion" 
                                        data-toggle="modal" 
                                        data-id="'.$data['id'].'"
                                        data-nofol="'.$data['folio'].'" 
                                        data-cantid="'.$data['cantidad'].'"
                                        data-codig="'.$data['codigo'].'"
                                        data-almc="'.$data['almacen'].'"
                                        data-descrip="'.$data['descripcion'].'"
                                        data-unmed="'.$data['unidad_medida'].'"
                                        data-marca="'.$data['marca'].'"
                                        data-precio="'.$data['precio'].'"
                                        data-impto="'.$data['impuesto'].'"
                                        data-impisr="'.$data['impuesto_isr'].'"
                                        data-impieps="'.$data['impuesto_ieps'].'"
                                        data-importe="'.$data['importe'].'"
                                        href="#" 
                                        class="sepV_a" 
                                        title="Cambiar Cantidad"><i class="fas fa-edit"></i>
                                    </a>
                                    </td>
                                    </tr>';
                    }

                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaRe;
                $arrayData['totales'] = $detalleTotalesRe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   

            }else{
                echo 'error';
            }       
                
                exit;
        }  


// Agregar producto al detalle compra
        if($_POST['action'] == 'addDetalleEditReq'){
            
                $noorden = $_POST['reqno'];
                $folio   = $_POST['afolio'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_ocom= mysqli_query($conection,"CALL add_detreq_compra($noorden, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_ocom);

                $detalleTablaRe = '';
                $detalleTotalesRe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $iva         = 0;
                $isr         = 0;
                $ieps        = 0;
                $imprteIva   = 0;
                $imprteIsr   = 0;
                $imprteIeps  = 0;
                $totiva      = 0;
                $totisr      = 0;
                $totieps     = 0;
                $total       = 0;
                $precioTotal = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_detalle_ocom)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva = $data['impuesto'] /100;
                    $isr = $data['impuesto_isr'] /100;
                    $ieps = $data['cantidad'] * $data['impuesto_ieps'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $imprteIva  = $subtotal * $iva;
                    $imprteIsr  = $subtotal * $isr;
                    $totiva     = $totiva + $imprteIva;
                    $totisr     = $totisr + $imprteIsr;
                    $totieps    = $totieps + $ieps;

                    $detalleTablaRe .= '<tr>
                                    <td align="right">'.number_format($data['cantidad'],2).'</td>
                                    <td>'.$data['codigo'].'</td>
                                    <td>'.$data['almacen'].'</td>
                                    <td>'.$data['descripcion'].'</td>
                                    <td>'.$data['unidad_medida'].'</td>
                                    <td>'.$data['marca'].'</td>
                                    <td align="right">'.number_format($data['precio'],2).'</td>
                                    <td align="right">'.number_format($data['importe'],2).'</td>
                                    <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                    <a id="alumno" 
                                        data-target="#modalEditCotizacion" 
                                        data-toggle="modal" 
                                        data-id="'.$data['id'].'"
                                        data-nofol="'.$data['folio'].'" 
                                        data-cantid="'.$data['cantidad'].'"
                                        data-codig="'.$data['codigo'].'"
                                        data-almc="'.$data['almacen'].'"
                                        data-descrip="'.$data['descripcion'].'"
                                        data-unmed="'.$data['unidad_medida'].'"
                                        data-marca="'.$data['marca'].'"
                                        data-precio="'.$data['precio'].'"
                                        data-impto="'.$data['impuesto'].'"
                                        data-impisr="'.$data['impuesto_isr'].'"
                                        data-impieps="'.$data['impuesto_ieps'].'"
                                        data-importe="'.$data['importe'].'"
                                        href="#" 
                                        class="sepV_a" 
                                        title="Cambiar Cantidad"><i class="fas fa-edit"></i>
                                    </a>
                                    </td>
                                    </tr>';
                    }

                    if ($totisr > 0) {
                        $totalgral = ($totsubtotal + $totiva) - $totisr ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (-) ISR: </td>
                                                <td align="right">'.number_format($totisr,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                    }else {
                        if ($totieps > 0) {
                             $totalgral = $totsubtotal + $totiva + $totieps ;
                             $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IEPS: </td>
                                                <td align="right">'.number_format($totieps,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> (+) IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';
                        }else {
                        
                    $totalgral = $totsubtotal + $totiva - $totisr + $totieps ;
                    $detalleTotalesRe .= '<tr>
                                                <td colspan="7" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                           
                                            <tr>
                                                <td colspan="7" align="right"> IVA: </td>
                                                <td align="right">'.number_format($totiva,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totalgral,2).'</td>
                                            </tr>';

                 }
             }
                  
                $arrayData['detalle'] = $detalleTablaRe;
                $arrayData['totales'] = $detalleTotalesRe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   

            }else{
                echo 'error';
            }       
                
                exit;
        }            
        

//****************************//
        //Cancelar Pago proveedor
   if($_POST['action'] == 'procesarSalirpagoprov'){

                          
        $norecibo  = $_POST['norecibo'];
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesarcf = mysqli_query($conection,"CALL salir_pagoprov($norecibo, '$token')");
        $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
        if($result_procesarcf > 0){
            $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
                    echo "error";
        }
            
    } 

 //Borra Carga Combustible
if($_POST['action'] == 'BorraCargacomb')
{
    if(empty($_POST['fecha_carga']) )
    {
       echo 'error';
    }else{
        
        $fecha_carga        = $_POST['fecha_carga'];       

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL borra_cargacomb('$fecha_carga', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
} 

    // Agregar producto al detalle temporal Factura
        if($_POST['action'] == 'SearchAdeudos'){
            
            if(empty($_POST['proveedor']) || empty($_POST['montopago']) || empty($_POST['folio']) )
            {
                echo 'error';
            }else{
            
                $codprov      = $_POST['proveedor'];
                $monto_pago   = $_POST['montopago'];
                
                
                $token       = md5($_SESSION['idUser']);

                $query_delete_doctos = mysqli_query($conection,"DELETE FROM documentos_saldo");
                $query_insert_facturas = mysqli_query($conection,"INSERT INTO documentos_saldo (proveedor, vencimiento, concepto, no_docto, total, saldo) SELECT proveedor, fecha, 'Compra', no_compra, total, saldo_compra FROM compras WHERE proveedor = $codprov AND metodo_pago <> 'PUE Pago de Una Sola Exhibicion' ");
                

                $query_select_docsaldos = mysqli_query($conection,"SELECT * FROM documentos_saldo WHERE proveedor = $codprov  ");

                $result = mysqli_num_rows($query_select_docsaldos);

                $detalleTablaPag = '';
                $detalleTotalesPag = '';
                $aplicado     = 0;
                $restaaplicar = 0;
                
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_select_docsaldos)){
                        $aplicado     = $aplicado + $data['monto_pago'];
                        $restaaplicar = $monto_pago - $aplicado;
                        

                        $detalleTablaPag .= '<tr id='.$data['id'].'>
                                            <td style="display:none;">'.$data['id'].'</td>
                                            <td>'.$data['vencimiento'].'</td>
                                            <td>'.$data['concepto'].'</td>
                                            <td>'.$data['no_docto'].'</td>
                                            <td align="right">'.number_format($data['total'],2).'</td>
                                            <td align="right">'.number_format($data['saldo'],2).'</td>
                                            <td align="right">'.number_format($data['monto_pago'],2).'</td>
                                            <td align="center"><a id="alumno" 
                                                data-target="#modalAlumno" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'" 
                                                data-ckilos="'.$data['no_docto'].'"
                                                data-cmetros="'.number_format($data['saldo'],2).'"
                                                data-cmonto="'.$monto_pago.'"
                                                data-crollos="'.$restaaplicar.'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Aplicar Pago"><img src = "./font6/svgs/solid/check-to-slot.svg" alt="" width="20px" height="20px"></a>
                                            </td>

                                            
                                            </tr>';
                    }

                    
                    //$total    = round($tl_sniva, 2);

                    $detalleTotalesPag = '<tr>
                                                
                                                <td colspan="5" align="right"> aplicado: </td>
                                                <td align="right">'.number_format($aplicado,2).'</td>
                                            </tr>
                                            <tr>
                                                
                                                <td colspan="5" align="right"> Resta Aplicar: </td>
                                                <td align="right">'.number_format($restaaplicar,2).'</td>
                                            </tr>

                                            ';

                $arrayData['detalle'] = $detalleTablaPag;
                $arrayData['totales'] = $detalleTotalesPag;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }   
        
            exit;   
          }
        }         


//Actualizar Monto Pago

          if($_POST['action'] == 'ActualizaMontoPago'){

                $id_pago      = $_POST['idpago'];
                $nodocto      = $_POST['documento'];
                $newsaldo     = intval($_POST['nsaldo']);
                $montopago    = intval($_POST['monto']);
                $pago         = intval($_POST['pago']);

                
                $token       = md5($_SESSION['idUser']);
                $usuario     = $_SESSION['idUser'];

                if($pago <= $montopago){

                $query_updatePago = mysqli_query($conection,"CALL aplicar_pagoprov($id_pago, '$nodocto', $newsaldo, $montopago, $pago, '$token')");
                $result = mysqli_num_rows($query_updatePago);

                $detalleTablaPag = '';
                $detalleTotalesPag = '';
                $aplicado     = 0;
                $restaaplicar = 0;
                
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_updatePago)){
                        $aplicado     = $aplicado + $data['monto_pago'];
                        $restaaplicar = $montopago - $aplicado;
                        

                        $detalleTablaPag .= '<tr id='.$data['id'].'>
                                            <td style="display:none;">'.$data['id'].'</td>
                                            <td>'.$data['vencimiento'].'</td>
                                            <td>'.$data['concepto'].'</td>
                                            <td>'.$data['no_docto'].'</td>
                                            <td align="right">'.number_format($data['total'],2).'</td>
                                            <td align="right">'.number_format($data['saldo'],2).'</td>
                                            <td align="right">'.number_format($data['monto_pago'],2).'</td>
                                            <td align="center"><a id="alumno" 
                                                data-target="#modalAlumno" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'" 
                                                data-ckilos="'.$data['no_docto'].'"
                                                data-cmetros="'.number_format($data['saldo'],2).'"
                                                data-cmonto="'.$montopago.'"
                                                data-crollos="'.$restaaplicar.'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Aplicar Pago"><img src = "./font6/svgs/solid/check-to-slot.svg" alt="" width="20px" height="20px"></a>
                                            </td>

                                            
                                            </tr>';
                    }

                    
                    //$total    = round($tl_sniva, 2);

                    $detalleTotalesPag = '<tr>
                                                
                                                <td colspan="5" align="right"> aplicado: </td>
                                                <td align="right">'.number_format($aplicado,2).'</td>
                                            </tr>
                                            <tr>
                                                
                                                <td colspan="5" align="right"> Resta Aplicar: </td>
                                                <td align="right">'.number_format($restaaplicar,2).'</td>
                                            </tr>

                                            ';

                $arrayData['detalle'] = $detalleTablaPag;
                $arrayData['totales'] = $detalleTotalesPag;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                
            }   
                mysqli_close($conection);   
                exit;
            }else{
              echo 'error';
              exit;
            }

            }

//Baja Cliente
if($_POST['action'] == 'BajaProveedor')
{

        $idc          = $_POST['idc'];
        $proveedor      = $_POST['cliente'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

   
       $query_insert = mysqli_query($conection,"SELECT count(*) as numreg FROM proveedores where  id = $idc and estatus = 0");
       while ($data = mysqli_fetch_assoc($query_insert)){
        $noreg = $data['numreg'];
       } 

       if ($noreg == 0) {
            $query_procesar = mysqli_query($conection,"CALL baja_proveedor($idc, '$proveedor', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
       }else {
         echo "error";
         exit;
       }
    exit;
} 


//****************************//
        //Procesar Pedido
        if($_POST['action'] == 'procesarPago'){

            if(empty($_POST['proveedor']) || empty($_POST['importePago']))
            {
                echo 'error';
            }else{

                $nfolio      = $_POST['folio'];
                $nfecha      = $_POST['fecha'];
                $nproveedor  = $_POST['proveedor'];
                $npago       = $_POST['importePago'];
                $nnotas      = $_POST['notas'];
                //$ntotal      = $_POST['ptotal']; 

                $token       = md5($_SESSION['idUser']);
                $usuario     = $_SESSION['idUser'];

                $query_procesapago = mysqli_query($conection,"CALL procesar_pago('PAG', $nfolio, '$nfecha', $nproveedor, $ntotal, '$nnotas', $usuario, '$token')");
                $result_procesapago = mysqli_num_rows($query_procesapago);
                
                if($result_procesapago > 0){
                    $data = mysqli_fetch_assoc($query_procesapago);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
            
            }

        }            
 

//Almacena Evaluacion de Producto
if($_POST['action'] == 'AlmacenaEvaluaproducto')
{
    if(empty($_POST['fecha']) || empty($_POST['tipo_eval']) || empty($_POST['proveedor'] || ['producto']) )
    {
       echo 'error';
    }else{

        $tipo_eval   = $_POST['tipo_eval'];
        $fecha       = $_POST['fecha'];
        $proveedor   = $_POST['proveedor'];
        $producto    = $_POST['producto'];
        $consulta    = $_POST['consulta'];
        $fecha_h1    = $_POST['fecha_h1'];
        $historial1  = $_POST['historial_h1'];
        $fecha_h2    = $_POST['fecha_h2'];
        $historial2  = $_POST['historial_h2'];
        $fecha_h3    = $_POST['fecha_h3'];
        $historial3  = $_POST['historial_h3'];
        $tot_compras = $_POST['tot_compras'];
        $tot_calidad = $_POST['tot_calidad'];
        $calif_total = $_POST['calif_total'];
        $estatusc    = $_POST['estatusc'];
        $acciones    = $_POST['acciones'];
        $tiempo_res  = $_POST['tiempo_res'];
        $documenta   = $_POST['documenta'];
        $credito     = $_POST['credito'];
        $precios     = $_POST['precios'];
        $emergencia  = $_POST['emergencia'];
        $servicios   = $_POST['servicios'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_evaluaproducto('$tipo_eval', '$fecha', $proveedor, '$producto', '$consulta', '$fecha_h1', $historial1, '$fecha_h2', $historial2, '$fecha_h3', $historial3, $tot_compras, $tot_calidad, $calif_total, '$estatusc', '$acciones', $tiempo_res, $documenta, $credito, $precios, $emergencia, $servicios, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

//Almacena Edicion Evaluacion Producto
if($_POST['action'] == 'AlmacenaEditEvaluaproducto')
{
    if(empty($_POST['fecha']) || empty($_POST['tipo_eval']) || empty($_POST['proveedor'] || ['producto']) )
    {
       echo 'error';
    }else{

        $ideval      = $_POST['id_eval'];
        $tipo_eval   = $_POST['tipo_eval'];
        $fecha       = $_POST['fecha'];
        $proveedor   = $_POST['proveedor'];
        $producto    = $_POST['producto'];
        $consulta    = $_POST['consulta'];
        $fecha_h1    = $_POST['fecha_h1'];
        $historial1  = $_POST['historial_h1'];
        $fecha_h2    = $_POST['fecha_h2'];
        $historial2  = $_POST['historial_h2'];
        $fecha_h3    = $_POST['fecha_h3'];
        $historial3  = $_POST['historial_h3'];
        $tot_compras = $_POST['tot_compras'];
        $tot_calidad = $_POST['tot_calidad'];
        $calif_total = $_POST['calif_total'];
        $estatusc    = $_POST['estatusc'];
        $acciones    = $_POST['acciones'];
        $tiempo_res  = $_POST['tiempo_res'];
        $documenta   = $_POST['documenta'];
        $credito     = $_POST['credito'];
        $precios     = $_POST['precios'];
        $emergencia  = $_POST['emergencia'];
        $servicios   = $_POST['servicios'];
        $empaque     = $_POST['empaque'];
        $rechazo     = $_POST['rechazo'];
        $identifica  = $_POST['identifica'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editevalprodto($ideval, '$tipo_eval', '$fecha', $proveedor, '$producto', '$consulta', '$fecha_h1', $historial1, '$fecha_h2', $historial2, '$fecha_h3', $historial3, $tot_compras, $tot_calidad, $calif_total, '$estatusc', '$acciones', $tiempo_res, $documenta, $credito, $precios, $emergencia, $servicios, $empaque, $rechazo, $identifica, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

// Elimina Evaluacion Productos

if($_POST['action'] == 'EliminaEvaluaproducto')
{

        $nfolio   = $_POST['nfolio'];
        $nempresa = $_POST['nempresa'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

            $query_procesar = mysqli_query($conection,"CALL baja_evaluaproducto($nfolio, '$nempresa', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
    exit;
} 

//Almacena Evaluacion de Producto
if($_POST['action'] == 'AlmacenaEvaluametro')
{
    if(empty($_POST['fecha']) || empty($_POST['tipo_eval']) || empty($_POST['proveedor'] || ['producto']) )
    {
       echo 'error';
    }else{

        $tipo_eval   = $_POST['tipo_eval'];
        $fecha       = $_POST['fecha'];
        $proveedor   = $_POST['proveedor'];
        $producto    = $_POST['producto'];
        $consulta    = $_POST['consulta'];
        $fecha_h1    = $_POST['fecha_h1'];
        $historial1  = $_POST['historial_h1'];
        $fecha_h2    = $_POST['fecha_h2'];
        $historial2  = $_POST['historial_h2'];
        $fecha_h3    = $_POST['fecha_h3'];
        $historial3  = $_POST['historial_h3'];
        $tot_compras = $_POST['tot_compras'];
        $tot_calidad = $_POST['tot_calidad'];
        $calif_total = $_POST['calif_total'];
        $estatusc    = $_POST['estatusc'];
        $acciones    = $_POST['acciones'];
        $precios     = $_POST['precios'];
        $documenta   = $_POST['documenta'];
        $credito     = $_POST['credito'];
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_evaluametro('$tipo_eval', '$fecha', $proveedor, '$producto', '$consulta', '$fecha_h1', $historial1, '$fecha_h2', $historial2, '$fecha_h3', $historial3, $tot_compras, $tot_calidad, $calif_total, '$estatusc', '$acciones', $precios, $documenta, $credito, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

//Almacena Edicion Evaluacion Metrologia
if($_POST['action'] == 'AlmacenaEditEvaluametro')
{
    if(empty($_POST['fecha']) || empty($_POST['tipo_eval']) || empty($_POST['proveedor'] || ['producto']) )
    {
       echo 'error';
    }else{

        $ideval      = $_POST['id_eval'];
        $tipo_eval   = $_POST['tipo_eval'];
        $fecha       = $_POST['fecha'];
        $proveedor   = $_POST['proveedor'];
        $producto    = $_POST['producto'];
        $consulta    = $_POST['consulta'];
        $fecha_h1    = $_POST['fecha_h1'];
        $historial1  = $_POST['historial_h1'];
        $fecha_h2    = $_POST['fecha_h2'];
        $historial2  = $_POST['historial_h2'];
        $fecha_h3    = $_POST['fecha_h3'];
        $historial3  = $_POST['historial_h3'];
        $tot_compras = $_POST['tot_compras'];
        $tot_calidad = $_POST['tot_calidad'];
        $calif_total = $_POST['calif_total'];
        $estatusc    = $_POST['estatusc'];
        $acciones    = $_POST['acciones'];
        $precios     = $_POST['precios'];
        $documenta   = $_POST['documenta'];
        $credito     = $_POST['credito'];
        $codequipo   = $_POST['codigo_equipo'];
        $date_prox   = $_POST['date_prox'];
        $name_tec    = $_POST['name_tec'];
        $protecc     = $_POST['proteccion'];
        $entrega     = $_POST['entrega'];
        
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editevalprometro($ideval, '$tipo_eval', '$fecha', $proveedor, '$producto', '$consulta', '$fecha_h1', $historial1, '$fecha_h2', $historial2, '$fecha_h3', $historial3, $tot_compras, $tot_calidad, $calif_total, '$estatusc', '$acciones', $precios, $documenta, $credito, $codequipo, $date_prox, $name_tec, $protecc, $entrega, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

// Elimina Evaluacion Metrologia

if($_POST['action'] == 'EliminaEvaluaproducto')
{

        $nfolio   = $_POST['nfolio'];
        $nempresa = $_POST['nempresa'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

            $query_procesar = mysqli_query($conection,"CALL baja_evaluametro($nfolio, '$nempresa', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
    exit;
} 

//Almacena Evaluacion de Producto
if($_POST['action'] == 'AlmacenaEvaluaservicio')
{
    if(empty($_POST['fecha']) || empty($_POST['tipo_eval']) || empty($_POST['proveedor'] || ['producto']) )
    {
       echo 'error';
    }else{

        $tipo_eval   = $_POST['tipo_eval'];
        $fecha       = $_POST['fecha'];
        $proveedor   = $_POST['proveedor'];
        $producto    = $_POST['producto'];
        $consulta    = $_POST['consulta'];
        $fecha_h1    = $_POST['fecha_h1'];
        $historial1  = $_POST['historial_h1'];
        $fecha_h2    = $_POST['fecha_h2'];
        $historial2  = $_POST['historial_h2'];
        $fecha_h3    = $_POST['fecha_h3'];
        $historial3  = $_POST['historial_h3'];
        $tot_compras = $_POST['tot_compras'];
        $tot_calidad = $_POST['tot_calidad'];
        $calif_total = $_POST['calif_total'];
        $estatusc    = $_POST['estatusc'];
        $acciones    = $_POST['acciones'];
        $precios     = $_POST['precio'];
        $documenta   = $_POST['documenta'];
        $credito     = $_POST['credito'];
        $tiempo_res  = $_POST['tiempo_res'];        
        $calidads    = $_POST['calidad_se'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_evaluaservicio('$tipo_eval', '$fecha', $proveedor, '$producto', '$consulta', '$fecha_h1', $historial1, '$fecha_h2', $historial2, '$fecha_h3', $historial3, $tot_compras, $tot_calidad, $calif_total, '$estatusc', '$acciones', $precios, $documenta, $credito, $tiempo_res, $calidads, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//Almacena Edicion Evaluacion Servicios
if($_POST['action'] == 'AlmacenaEditEvaluaservicio')
{
    if(empty($_POST['fecha']) || empty($_POST['tipo_eval']) || empty($_POST['proveedor'] || ['producto']) )
    {
       echo 'error';
    }else{

        $ideval      = $_POST['id_eval'];
        $tipo_eval   = $_POST['tipo_eval'];
        $fecha       = $_POST['fecha'];
        $proveedor   = $_POST['proveedor'];
        $producto    = $_POST['producto'];
        $consulta    = $_POST['consulta'];
        $fecha_h1    = $_POST['fecha_h1'];
        $historial1  = $_POST['historial_h1'];
        $fecha_h2    = $_POST['fecha_h2'];
        $historial2  = $_POST['historial_h2'];
        $fecha_h3    = $_POST['fecha_h3'];
        $historial3  = $_POST['historial_h3'];
        $tot_compras = $_POST['tot_compras'];
        $calif_total = $_POST['calif_total'];
        $estatusc    = $_POST['estatusc'];
        $acciones    = $_POST['acciones'];
        $precios     = $_POST['precios'];
        $documenta   = $_POST['documenta'];
        $credito     = $_POST['credito'];
        $tiempo_res  = $_POST['tiempo_res'];
        $calidads    = $_POST['calidads'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editevalservicio($ideval, '$tipo_eval', '$fecha', $proveedor, '$producto', '$consulta', '$fecha_h1', $historial1, '$fecha_h2', $historial2, '$fecha_h3', $historial3, $tot_compras, 0, $calif_total, '$estatusc', '$acciones', $precios, $documenta, $credito, $tiempo_res, $calidads, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

// Elimina Evaluacion Productos

if($_POST['action'] == 'EliminaEvaluaservicio')
{

        $nfolio   = $_POST['nfolio'];
        $nempresa = $_POST['nempresa'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

            $query_procesar = mysqli_query($conection,"CALL baja_evaluaservicio($nfolio, '$nempresa', $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
    exit;
} 


// CBorra no conformidad
    if($_POST['action'] == 'BorraNoconforme')
    {
      if(!empty($_POST['noorden']) )
      {
        $idc      = $_POST['idcc'];
        $noorden  = $_POST['noorden'];
        //$motivoc  = $_POST['motivoc'];
        
        $token    = md5($_SESSION['idUser']);
        $usuario  = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL cancela_noconforme($noorden, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    } 

//Almacena Requisicion de Personal
if($_POST['action'] == 'AlmacenaReqpersonal')
{
    if(empty($_POST['daterp']) || empty($_POST['daterec']) || empty($_POST['puesto']) )
    {
       echo 'error';
    }else{
        
        $daterp       = $_POST['daterp'];
        $daterec      = $_POST['daterec'];
        $puesto       = $_POST['puesto'];
        $novacantes   = $_POST['novacantes'];
        $zona         = $_POST['zona'];
        $supervisor   = $_POST['supervisor'];
        $motivo       = $_POST['motivo'];
        $datamotivo   = $_POST['datamotivo'];
        $horario      = $_POST['horario'];
        $sueldo       = $_POST['sueldo'];
        $sueldoplanta = $_POST['sueldoplanta'];
        $edad         = $_POST['edad'];
        $escolaridad  = $_POST['escolaridad'];
        $experiencia  = $_POST['experiencia'];
        $estado       = $_POST['estado'];
        $conocimiento = $_POST['conocimiento'];
        $secubrio     = $_POST['secubrio'];
        $autorizado   = $_POST['autorizado'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_reqpersonal('$daterp', '$daterec', '$puesto', '$novacantes', '$zona', '$supervisor', '$motivo', '$datamotivo', '$horario', '$sueldo', '$sueldoplanta', '$edad', '$escolaridad', '$experiencia', '$estado', '$conocimiento', '$secubrio', '$autorizado', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
       
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}


//Almacena Edición Requisicion de Personal
if($_POST['action'] == 'AlmacenaEditReqpersonal')
{
    if(empty($_POST['daterp']) || empty($_POST['daterec']) || empty($_POST['puesto']) )
    {
       echo 'error';
    }else{
        
        $idrp         = $_POST['idrp'];
        $daterp       = $_POST['daterp'];
        $daterec      = $_POST['daterec'];
        $puesto       = $_POST['puesto'];
        $novacantes   = $_POST['novacantes'];
        $zona         = $_POST['zona'];
        $supervisor   = $_POST['supervisor'];
        $motivo       = $_POST['motivo'];
        $datamotivo   = $_POST['datamotivo'];
        $horario      = $_POST['horario'];
        $sueldo       = $_POST['sueldo'];
        $sueldoplanta = $_POST['sueldoplanta'];
        $edad         = $_POST['edad'];
        $escolaridad  = $_POST['escolaridad'];
        $experiencia  = $_POST['experiencia'];
        $estado       = $_POST['estado'];
        $conocimiento = $_POST['conocimiento'];
        $secubrio     = $_POST['secubrio'];
        $autorizado   = $_POST['autorizado'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_editreqpersonal($idrp, '$daterp', '$daterec', '$puesto', '$novacantes', '$zona', '$supervisor', '$motivo', '$datamotivo', '$horario', '$sueldo', '$sueldoplanta', '$edad', '$escolaridad', '$experiencia', '$estado', '$conocimiento', '$secubrio', '$autorizado', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
       
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}

// CANCELA REQUISICION DE PERSONAL
    if($_POST['action'] == 'CancelarequisicionPersonal')
    {
      if(!empty($_POST['noreqc']) )
      {
        $noreqc     = $_POST['noreqc'];
        $daterec    = $_POST['daterc'];
        $puestosc   = $_POST['puestosc'];
        $motivoc    = $_POST['motivoc'];

        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL cancela_reqpersonal($noreqc, '$puestosc', '$motivoc', $usuario )");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }

// BORRA REQUISICION
    if($_POST['action'] == 'Borrareqpersonal')
    {
      if(!empty($_POST['noreqi']) )
      {
        $noreqi     = $_POST['noreqi'];
        $areareqi   = $_POST['areareqi'];

        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL borra_reqpersonal($noreqi, '$areareqi', $usuario )");
        $result_detalle = mysqli_num_rows($query_procesar);

        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
             mysqli_close($conection);
        }else{
            echo "error";
        }
       
     }else{
        echo 'error';
     }
    }

// Buscar Cliente para Pedido
        if($_POST['action'] == 'searchDatosEmpleado')
        {
            if(!empty($_POST['op'])){
                $codcte = $_POST['op'];

                $query = mysqli_query($conection,"SELECT CONCAT(nombres,' ',apellido_paterno, ' ', apellido_materno) as name_empleado, if(tipo_contrato = 'Indefinido', 'PLANTA', 'EVENTUAL') as tipocontrato FROM empleados  WHERE noempleado = $codcte ");
                mysqli_close($conection);
                $result = mysqli_num_rows($query);

                $data = '';
                if($result > 0){
                    $data = mysqli_fetch_assoc($query);
                }else{
                    $data = 0;
                }
                echo json_encode($data,JSON_UNESCAPED_UNICODE);
            }
            exit;
        }   


//Actualiza Sueldo
if($_POST['action'] == 'ActualizasueldoBase')
{
    

        $porc_aumento = $_POST['porc_aumento'];
       
    
        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL procesar_aumentosueldo($porc_aumento, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
     }

//*Almacena Prestamo
if($_POST['action'] == 'AlmacenaPrestamo')
{
    if(empty($_POST['fecha']) || empty($_POST['noempleado']) || empty($_POST['monto']) )
    {
         echo 'error';
    }else {     

        $fecha           = $_POST['fecha'];
        $noempleado      = $_POST['noempleado'];
        $empleado        = $_POST['empleado'];
        $monto           = $_POST['monto'];
        $descripcion     = $_POST['descripcion'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_prestamo('$fecha', $noempleado, '$empleado', $monto, '$descripcion', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

   
    }
    exit;
}

//* Elimina Finiquito **//
if($_POST['action'] == 'BorraPrestamo')
{

        $idf          = $_POST['idf'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

   
       $query_del = mysqli_query($conection,"DELETE FROM prestamos WHERE id = $idf ");
            mysqli_close($conection);
            if($query_del){
                echo 'ok';
            }else{
                echo 'error';
            }
            exit;
      
      
}      

//*Almacena eDICIÓN DE Prestamo
if($_POST['action'] == 'AlmacenaEditPrestamo')
{
    if(empty($_POST['fecha']) || empty($_POST['noempleado']) || empty($_POST['monto']) )
    {
         echo 'error';
    }else {     

        $idprs           = $_POST['idprs'];
        $fecha           = $_POST['fecha'];
        $noempleado      = $_POST['noempleado'];
        $empleado        = $_POST['empleado'];
        $monto           = $_POST['monto'];
        $descripcion     = $_POST['descripcion'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_editprestamo($idprs, '$fecha', $noempleado, '$empleado', $monto, '$descripcion', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

   
    }
    exit;
}

// Autoriza Nomina Quincenal
        if($_POST['action'] == 'AutorizaNominaQuincenal')
                {
                    $quincena = $_POST['quincena'];

                    $token  = md5($_SESSION['idUser']);
        
                    $query_busca = mysqli_query($conection,"SELECT count(*) as numeroreg from quincenas where quincena = '$quincena' and autorizada = 1 ");
                    $result_busca = mysqli_num_rows($query_busca);
                     while ($data = mysqli_fetch_assoc($query_busca)){
                     $revisa = $data['numeroreg'];
                     }   
                
                if($revisa == 0){

        
                    $query_procesarcf = mysqli_query($conection,"CALL autoizar_nominaquincena('$quincena', '$token')");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                } else { 
                    echo "error";
                }    
                }    

// Autoriza Nomina Especial
        if($_POST['action'] == 'AutorizaNominaEspecial')
                {
                    $fcha_especial = $_POST['fcha_especial'];
                    $fechaEsp = strtotime($fcha_especial);
                    $anio = date('Y', $fechaEsp);  // Extraemos el año en PHP
                    $token  = md5($_SESSION['idUser']);
                    $usuario     = $_SESSION['idUser'];
        
                    $query_busca = mysqli_query($conection,"SELECT count(*) as numeroreg FROM nomina_especial WHERE year_especial = '$anio' ");
                    $result_busca = mysqli_num_rows($query_busca);
                     while ($data = mysqli_fetch_assoc($query_busca)){
                     $revisa = $data['numeroreg'];
                     }   
                
                if($revisa == 0){

        
                    $query_procesarcf = mysqli_query($conection,"CALL autoizar_nominaespecial('$fcha_especial', $usuario)");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                } else { 
                    echo "error";
                }    
                } 


 //*Cambia  Nomina Especial de Empleado
if($_POST['action'] == 'ActualizaEditNomEmplespecial')
{
    if(!empty($_POST['noempleado']) )
    {
        
        $no_empleado   = $_POST['noempleado'];
        $name_empleado = $_POST['nameempleado'];
        $date_ingreso  = $_POST['date_ing'];
        $date_pago     = $_POST['date_pago'];
        $days_aguinald = $_POST['dias_aginald'];
        $days_derecho  = $_POST['dias_derecho'];
        $sal_diario    = $_POST['sal_diario'];
        $imp_aguinaldo = $_POST['imp_aginaldo'];
        $imp_fiscal    = $_POST['imp_fiscal'];
        $ded_fiscal    = $_POST['ded_fiscal'];
        $deposito      = $_POST['deposito'];
        $efectivo      = $_POST['efectivo'];
        $pago_total    = $_POST['pago_total'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    
        $query_procesar = mysqli_query($conection,"CALL procesar_editnomempleadoesp($no_empleado, '$name_empleado', '$date_ingreso', '$date_pago', $days_aguinald, $days_derecho, $sal_diario, $imp_aguinaldo, $imp_fiscal, $ded_fiscal, $deposito, $efectivo, $pago_total, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Extrae datos del detalle_Entrada Edicion
        if($_POST['action'] == 'searchForDetalleditEntrada'){
                
                $c_nofolio = $_POST['nofolio'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_entradaalm WHERE folio = $c_nofolio ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $detalleTablaDetTotFor = '';
                $subtotal = 0;
                $total = 0;
                $totalcant = 0;
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                        $subtotal = $data['cantidad'] * $data ['precio'];
                        $total = $total + $subtotal; 
                        $totalcant = $totalcant + $data['cantidad'];
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td style="text-align:right">'.number_format($data['precio'],2).'</td>
                                            <td style="text-align:right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }

                    $detalleTablaDetTotFor .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($total,2).'</td>
                                            </tr>'; 



                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
                $arrayData['totales'] = $detalleTablaDetTotFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }  


 // Elimina refacciones del detalle Entrada (Edición)

        if($_POST['action'] == 'delDetEditEntradaalm'){

            
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $token      = md5($_SESSION['idUser']);

                $query_detalle_temppe = mysqli_query($conection,"CALL del_editdetalle_entrada($id_det, $folio, '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    $totsubtotal = $totsubtotal + $subtotal;
                    $totalcant  = $totalcant + $data['cantidad'];
                    //$totiva = $totiva + $iva;
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                  
               $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
           
        
            exit;
        } 


// Edita Movimiento Cotizacion Compra

if($_POST['action'] == 'ActualizaMovEditentradaalm'){

            
                $id_c       = $_POST['detid'];
                $serie_c    = $_POST['detserie'];
                $folio_c    = $_POST['detfolio'];
                $codigo_c   = $_POST['detcodigo'];
                $descrip_c  = $_POST['detdescripc'];
                $almacen_c  = $_POST['detalmacen'];
                $marca_c    = $_POST['detmarca'];
                $unidadm_c  = $_POST['detumedida'];
                $cantidad_c = $_POST['detcantidad'];
                $precio_c   = $_POST['detprecio'];
                $importe_c  = $_POST['detimporte'];

                $token         = md5($_SESSION['idUser']);

                $query_control = mysqli_query($conection,"CALL edita_edit_detalleentrada($id_c, '$serie_c', $folio_c, '$codigo_c', '$descrip_c', '$almacen_c', '$marca_c', '$unidadm_c', $cantidad_c, $precio_c, $importe_c, '$token')");
                $result = mysqli_num_rows($query_control);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                $arrayData = array();

                if($result > 0){

                while ($data = mysqli_fetch_assoc($query_control)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    //$iva      = ($data['cantidad'] * $data['precio']);
                    $totsubtotal = $totsubtotal + $subtotal;
                    $totalcant  = $totalcant + $data['cantidad'];
                    //$totiva = $totiva + $iva;
                        
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].');"><i class="far fa-trash-alt"></i></a>&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>';
                    }
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE); 
            }else{
                echo 'error';
            }   
            exit;   
            
        }   

//Almacena entrada de Almacen
if($_POST['action'] == 'AlmacenaEditEntradaAlm')
{
    if(empty($_POST['fecha']) || empty($_POST['serie']) || empty($_POST['folio']) )
    {
       echo 'error';
    }else{
        
        $fecha        = $_POST['fecha'];
        $serie        = $_POST['serie'];
        $folio        = $_POST['folio'];
        $notas        = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_edit_entradaalm('$serie', $folio, '$fecha', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
} 


// Cancela Entrada

if($_POST['action'] == 'BajaEntrada')
{

        $idc          = $_POST['idc'];
        $noorden      = $_POST['noorden'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

            $query_procesar = mysqli_query($conection,"CALL baja_entrada($idc, $noorden, $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
    exit;
} 

// Cancela Solicitud de Mantenimiento Preventivo

if($_POST['action'] == 'BajaSolicitudPreventivo')
{

        $idc          = $_POST['idc'];
        $noorden      = $_POST['noorden'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $sql_cancelar_orden_mantto_preventivo = "UPDATE mantenimiento_preventivo SET estatus = 0, edit_id = $usuario WHERE no_orden =  $noorden";

            $query_procesar = mysqli_query($conection,$sql_cancelar_orden_mantto_preventivo);
            $result_detalle = mysqli_affected_rows($conection);
        
           if($result_detalle > 0){
              echo 'success';
           }else{
            echo "error";
           }
    exit;
} 

//Extrae datos del detalle_Entrada Edicion
        if($_POST['action'] == 'searchForDetalleditSalida'){
                
                $c_nofolio = $_POST['nofolio'];
                $token      = md5($_SESSION['idUser']);
                

                $query_editf = mysqli_query($conection,"SELECT * FROM detalle_salidaalm WHERE folio = $c_nofolio ORDER BY id ");
                
                $result_editf = mysqli_num_rows($query_editf);
                $detalleTablaDetFor = '';
                $detalleTablaDetTotFor = '';
                $subtotal = 0;
                $total = 0;
                $totalcant = 0;
                $arrayData = array();

                if($result_editf > 0){

                    while ($data = mysqli_fetch_assoc($query_editf)){
                        $subtotal = $data['cantidad'] * $data ['precio'];
                        $total = $total + $subtotal; 
                        $totalcant = $totalcant + $data['cantidad'];
                
                        $detalleTablaDetFor .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td>'.$data['cantidad'].'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td style="text-align:right">'.number_format($data['precio'],2).'</td>
                                            <td style="text-align:right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].',\''.$data['codigo'].'\');"><i class="far fa-trash-alt"></i></a><!--&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>-->
                                            </td>
                                        </tr>';
                    }

                    $detalleTablaDetTotFor .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="7" align="right"> Total: </td>
                                                <td align="right">'.number_format($total,2).'</td>
                                            </tr>'; 



                    //$impuesto = round($subtotal, 2);
               

                $arrayData['detalle'] = $detalleTablaDetFor;
                $arrayData['totales'] = $detalleTablaDetTotFor;
           

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);



                }else{
                    echo 'error';
                
                }
                mysqli_close($conection);
            
        }  


// Elimina refacciones del detalle Temporal Salida Almacen

        if($_POST['action'] == 'delDetEditSalidaalm'){

            
                $id_det     = $_POST['id_det'];
                $folio      = $_POST['folio_det'];
                $c_codigo   = $_POST['c_codigo'];
                $token      = md5($_SESSION['idUser']);

                $query_detalle_temppe = mysqli_query($conection,"CALL del_detalle_editsalida($id_det, $folio, '$c_codigo', '$token')");
                $result = mysqli_num_rows($query_detalle_temppe);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;

                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_temppe)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva      = $iva + $data['impuesto'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $total = $total + $data['importe'];
                    $totalcant  = $totalcant + $data['cantidad'];
                    
                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].',\''.$data['codigo'].'\');"><i class="far fa-trash-alt"></i></a><!--&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>-->
                                            </td>
                                        </tr>';
                    }
                  
               $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            
                                                <td align="right"> IVA: </td>
                                                <td align="right">'.number_format($iva,2).'</td>
                                            
                                                <td align="right"> Total: </td>
                                                <td align="right">'.number_format($total,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;

                    echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo 'error';
            }   
                  
           
        
            exit;
        }


// Agregar Detalle a la Edición de Salida Almacen
        if($_POST['action'] == 'AddDetalleEditSalidaalm'){
            if(empty($_POST['folio']) || empty($_POST['serie']) )
            {
                echo 'error';
            }else{
                $serie       = $_POST['serie'];
                $nofolio     = $_POST['folio'];
                $codigo      = $_POST['codigo'];
                $descripcion = $_POST['descripcion'];
                $almacen     = $_POST['almacen'];
                $marca       = $_POST['marca'];
                $unidadmed   = $_POST['unidmedida'];
                $cantidad    = $_POST['cantidad'];
                $precio      = $_POST['precio'];
                $impuesto    = $_POST['impuesto'];
                $importe     = $_POST['importe'];
                
                $token       = md5($_SESSION['idUser']);

                $query_detalle_mantto = mysqli_query($conection,"CALL registrar_editsalida_fifo('$codigo', $cantidad, '$serie', $nofolio,  '$descripcion', '$almacen', '$marca', '$unidadmed', $precio, $impuesto, $importe, '$token')");
                $result = mysqli_num_rows($query_detalle_mantto);

                $detalleTablaPe = '';
                $detalleTotalesPe = '';
                $subtotal    = 0;
                $totsubtotal = 0;
                $totalcant   = 0;
                $iva         = 0;
                $totiva      = 0;
                $total       = 0;
                        
                $arrayData = array();

                if($result > 0){     
                while ($data = mysqli_fetch_assoc($query_detalle_mantto)){
                    $subtotal = $data['cantidad'] * $data['precio'];
                    $iva      = $iva + $data['impuesto'];
                    $totsubtotal = $totsubtotal + $subtotal;
                    $total = $total + $data['importe'];
                    $totalcant  = $totalcant + $data['cantidad'];
                    //$totiva = $totiva + $iva;
                    


                        $detalleTablaPe .= '<tr>
                                            <td>'.$data['codigo'].'</td>
                                            <td>'.$data['descripcion'].'</td>
                                            <td>'.$data['almacen'].'</td>
                                            <td>'.$data['marca'].'</td>
                                            <td align="right">'.number_format($data['cantidad'],2).'</td>
                                            <td>'.$data['unidad_medida'].'</td>
                                            <td align="right">'.number_format($data['precio'],2).'</td>
                                            <td align="right">'.number_format($data['importe'],2).'</td>
                                            <td align="center"><a class="link_delete" href="#" onclick="event.preventDefault(); del_detalle_cotizacion('.$data['id'].','.$data['folio'].',\''.$data['codigo'].'\');"><i class="far fa-trash-alt"></i></a><!--&nbsp;&nbsp;&nbsp;
                                            <a id="alumno" 
                                                data-target="#modalEditCotizacion" 
                                                data-toggle="modal" 
                                                data-id="'.$data['id'].'"
                                                data-serie="'.$data['serie'].'"
                                                data-nofol="'.$data['folio'].'" 
                                                data-codig="'.$data['codigo'].'"
                                                data-descrip="'.$data['descripcion'].'"
                                                data-almc="'.$data['almacen'].'"
                                                data-marca="'.$data['marca'].'"
                                                data-umed="'.$data['unidad_medida'].'"
                                                data-cantid="'.$data['cantidad'].'"
                                                data-precio="'.$data['precio'].'"
                                                data-importe="'.$data['importe'].'"
                                                href="#" 
                                                class="sepV_a" 
                                                title="Cambiar Cantidad"><i class="fas fa-edit"></i></a>-->
                                            </td>
                                        </tr>';
                    }
                    $detalleTotalesPe .= '<tr>
                                                <td colspan="7" align="right"> Cantidad: </td>
                                                <td align="right">'.number_format($totalcant,2).'</td>
                                            </tr>
                                            <tr>
                                                <td colspan="3" align="right"> Subtotal: </td>
                                                <td align="right">'.number_format($totsubtotal,2).'</td>
                                            
                                                <td align="right"> IVA: </td>
                                                <td align="right">'.number_format($iva,2).'</td>
                                            
                                                <td align="right"> Total: </td>
                                                <td align="right">'.number_format($total,2).'</td>
                                            </tr>
                                            ';


                   
                  
                $arrayData['detalle'] = $detalleTablaPe;
                $arrayData['totales'] = $detalleTotalesPe;
                   
           
                echo json_encode($arrayData,JSON_UNESCAPED_UNICODE);

                
                mysqli_close($conection);   
            }else{
                echo "error 1";
            }   
        }
            exit;   
        } 

 
//Almacena Edición Salida de Almacen
if($_POST['action'] == 'AlmacenaEditSalidaAlm')
{
    if(empty($_POST['fecha']) || empty($_POST['serie']) || empty($_POST['folio']) )
    {
       echo 'error';
    }else{
        
        $fecha        = $_POST['fecha'];
        $serie        = $_POST['serie'];
        $folio        = $_POST['folio'];
        $notas        = $_POST['notas'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_edit_salidaalm('$serie', $folio, '$fecha', '$notas', $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);
  }
   
    exit;
}  


// Cancela Solicitud de Mantenimiento 

if($_POST['action'] == 'BajaSalida')
{

        $idc          = $_POST['idc'];
        $noserie      = $_POST['noserie'];
        $noorden      = $_POST['noorden'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

            $query_procesar = mysqli_query($conection,"CALL baja_salida($idc, '$noserie', $noorden, $usuario)");
            $result_detalle = mysqli_num_rows($query_procesar);
        
           if($result_detalle > 0){
              $data = mysqli_fetch_assoc($query_procesar);
              echo json_encode($data,JSON_UNESCAPED_UNICODE);
           }else{
            echo "error";
           }
    exit;
} 


//*Cambia  Nomina de Empleado Especial
if($_POST['action'] == 'ActualizaNomEmpleadoEspecial')
{
    if(!empty($_POST['nosemana']) || !empty($_POST['noempleado']) )
    {
        
        $no_semana     = $_POST['nosemana'];
        $no_empleado   = $_POST['noempleado'];
        $name_empleado = $_POST['nameempleado'];
        $sueldo_base   = $_POST['sueldo_base'];
        $dias_derecho  = $_POST['day_derecho'];
        $deduccion_fis = $_POST['dedu_fiscal'];
        $dias_aguinald = $_POST['day_aguinald'];
        $importe_aguin = $_POST['importe_agui'];
        $importe_fis   = $_POST['importe_fisc'];
        $desposito_fis = $_POST['deposito_fis'];
        $pago_efectivo = $_POST['pago_efec'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];
    

        $query_procesar = mysqli_query($conection,"CALL procesar_nomimaempleado_esp('$no_semana', $no_empleado, '$name_empleado', $sueldo_base, $dias_derecho, $deduccion_fis, $dias_aguinald, $importe_aguin, $importe_fis, $desposito_fis, $pago_efectivo, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}


// Borra Empleado de Nomina Especial
        if($_POST['action'] == 'DeleteEmpleadoEspecial')
                {
                    $noempleado = $_POST['noempleado'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL borra_empleadoespecial($noempleado)");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }

//Borra Empleado de Edición de Nomina Especial
        if($_POST['action'] == 'DeleteEmpleadoNomEspcEdit')
                {
                    $nsemana    = $_POST['nsemana'];
                    $noempleado = $_POST['noempleado'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL borra_editempleado_nomespecial('$nsemana', $noempleado)");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }



// Borra Empleado en Nomina Quincenal
        if($_POST['action'] == 'DeleteEmpleadoNomQuincena')
                {
                    $noempleado = $_POST['noempleado'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL borra_empleadonomquin($noempleado)");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }


//*Cambia  Nomina de Empleado
if($_POST['action'] == 'ActualizaNomEmpleadoQuincenaEdit')
{
    if(!empty($_POST['nosemana']) || !empty($_POST['noempleado']) )
    {
        
        $no_semana         = $_POST['nosemana'];
        $no_empleado       = $_POST['noempleado'];
        $name_empleado     = $_POST['nameempleado'];
        $sueldo_base       = $_POST['sueldo_base'];
        $dias_laborados    = $_POST['dias_laborados'];
        $viajes_especiales = $_POST['viajes_specils'];
        $viajes_normales   = $_POST['viajes_normals'];
        $total_especiales  = $_POST['total_specils'];
        $total_normales    = $_POST['total_normals'];
        $adeudos           = $_POST['adeudo'];
        $sueldo_total      = $_POST['sueldo_total'];
        $caja              = $_POST['caja'];
        $bono_categ        = $_POST['bono_categ'];
        $bono_superv       = $_POST['bono_superv'];
        $apoyo_mes         = $_POST['apoyo_mes'];
        $vacaciones        = $_POST['vacaciones'];
        $prima_vacac       = $_POST['prima_vacac'];
        $sueldo_quincen    = $_POST['sueldo_quinc'];
        $pago_fiscal       = $_POST['pago_fiscal'];
        $impuesto_fisc     = $_POST['impuesto_fis'];
        $total_nomina      = $_POST['total_nomina'];
        $total_gral        = $_POST['total_gral'];
        $total_total       = $_POST['total_total'];

        $token       = md5($_SESSION['idUser']);
        $usuario     = $_SESSION['idUser'];

        $query_procesar = mysqli_query($conection,"CALL procesar_nomempleadoquinedit('$no_semana', $no_empleado, '$name_empleado', $sueldo_base, $dias_laborados, $viajes_especiales, $viajes_normales, $total_especiales, $total_normales, $adeudos, $sueldo_total, $caja, $bono_categ, $bono_superv, $apoyo_mes, $vacaciones, $prima_vacac, $sueldo_quincen, $pago_fiscal, $impuesto_fisc, $total_nomina, $total_gral, $total_total, $usuario)");
        $result_detalle = mysqli_num_rows($query_procesar);
        
        if($result_detalle > 0){
            $data = mysqli_fetch_assoc($query_procesar);
            echo json_encode($data,JSON_UNESCAPED_UNICODE);
        }else{
            echo "error";
        }
    
    mysqli_close($conection);

    }else{
        echo 'error';
    }
    exit;
}

//Borra Empleado de  Edicion de Nomina Semanal
        if($_POST['action'] == 'DeleteEmpleadoNomQuinEdit')
                {
                    $nsemana    = $_POST['nsemana'];
                    $noempleado = $_POST['noempleado'];
                    $token  = md5($_SESSION['idUser']);
        
                    $query_procesarcf = mysqli_query($conection,"CALL borra_editempleadonomquin('$nsemana', $noempleado)");
                $result_procesarcf = mysqli_num_rows($query_procesarcf);
                
                if($result_procesarcf > 0){
                    $data = mysqli_fetch_assoc($query_procesarcf);
                    echo json_encode($data,JSON_UNESCAPED_UNICODE);
                }else{
                    echo "error";
                }
                
                }
//*  ***//

?>