<?php 
require_once ('../sistema.class.php');
$app = new Sistema;
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
switch ($accion) {
    case 'login':
        $correo = $_POST['data']['correo'];
        $contraseña = $_POST['data']['password'];
        if($app->login($correo, $contraseña)){
            $mensaje = "Bienvenido al Sistema :D/";
            $tipo = "success";
            $app -> checkRol('Administrador');
            require_once 'views/header/header_administrador.php';
            $app -> alerta($tipo,$mensaje);
            //pantalla personalizada
        }else{
            $mensaje = "Correo o contraseña incorrectos :( <a href='login.php'>[Presione aquí para volver al Log In]</a>";
            $tipo = "danger";
            require_once 'views/header.php';
            $app -> alerta($tipo,$mensaje);
        }
    break;
    case 'logout':
        $app->logout();
    break;
    default:
    include ('views/login/index.php');
    break;
}
?>