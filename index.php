<?php 
$alert = '';

session_set_cookie_params(0); 
session_start();
if (!empty($_SESSION['active'])) {
    header('location: sistema/');
    exit();
} else {  
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['password'])) {
            $alert = 'Ingrese sus datos de acceso';
        } else {
            require_once "conexion.php";

            $user = mysqli_real_escape_string($conection, $_POST['usuario']);
            $pass = md5(mysqli_real_escape_string($conection, $_POST['password']));

            $query = mysqli_query($conection, "SELECT u.idusuario, u.nombre, u.correo, u.usuario, r.idrol, r.rol 
                                               FROM usuario u 
                                               INNER JOIN rol r 
                                               ON u.rol = r.idrol 
                                               WHERE u.usuario = '$user'
                                               AND u.clave = '$pass' 
                                               AND u.estatus = 1");

            if (!$query) {
                die("Error en la consulta: " . mysqli_error($conection));
            }

            if (mysqli_num_rows($query) > 0) {
                $data = mysqli_fetch_array($query);
                session_regenerate_id(true);
                $_SESSION['active'] = true;
                $_SESSION['idUser'] = $data['idusuario'];
                $_SESSION['nombre'] = $data['nombre'];
                $_SESSION['email']  = $data['correo'];
                $_SESSION['user']   = $data['usuario'];
                $_SESSION['rol']    = $data['idrol'];
                $_SESSION['rol_name'] = $data['rol'];

                // Redirecciones basadas en rol
                $rolRedirects = [
                    "Administrador" => "sistema/index.php",
                    "Conductor" => "sistema/index_conductor.php",
                    "Supervisor" => "sistema/index_supervisor.php",
                    "Recursos Humanos" => "sistema/index_rhumanos.php",
                    "Operaciones" => "sistema/index_operaciones.php",
                    "Operador" => "sistema/index_operador.php",
                    "Mantenimiento" => "sistema/index_mantto.php",
                    "Jefe Operaciones" => "sistema/index_jefeoperaciones.php",
                    "Gerencia" => "sistema/index_gerencia.php",
                    "Almacen" => "sistema/index_almacen.php",
                    "Calidad" => "sistema/index_calidad.php",
                    "Monitorista" => "sistema/index_monitorista.php",
                    "Compras" => "sistema/index_compras.php",
                ];

                if (isset($rolRedirects[$_SESSION['rol_name']])) {
                    header('location: ' . $rolRedirects[$_SESSION['rol_name']]);
                } else {
                    header('location: sistema/');
                }
                exit();
            } else {
                $alert = 'El Usuario o la Contraseña son incorrectos';
                session_destroy();
            }
            mysqli_close($conection);
        }
    } 
}

?>


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Tranvive ERP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/estyle.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="title-bar">
                    Transvive ERP Business
                </div>
                <div class="card login-card">
                    <div class="row no-gutters">
                        <div class="col-md-6">
                            <img src="images/02.jpg" class="card-img" alt="Imagen ProdLine">
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h3 class="card-title text-center"><img src="images/transvive_erp.png" alt="PRODLINE ERP" class="img-fluid mb-4" style="width: 280px;"></h3>
                                <form action='' method='post'>
                                    <div class="form-group">
                                        <label for="username">Usuario</label>
                                        <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Ingresa tu usuario" required>
                                    </div>
                                    <div class="form-group position-relative">
                                        <label for="password">Contraseña</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña" required>
                                        <i class="fas fa-eye toggle-password" id="togglePassword"></i>
                                    </div>
                                    <button type="submit" id="submit" class="btn btn-primary btn-block">Login</button>
                                    
                                </form>
                               
                            </div>
                            <div class="card-footer text-center">
                                <small><a href="" ><img src="./sistema/img/logoRM/logo.png" alt="PRODLINE ERP" class="img-fluid mb-4" style="width: 250px; height: 50px;"></a></small>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="script.js"></script>
</body>
</html>
