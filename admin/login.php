<?php 
require_once ('../sistema.class.php');
$app = new Sistema;
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
switch ($accion) {
    case 'login':
        $correo = $_POST['data']['correo'];
        $contraseña = $_POST['data']['password'];
        if($app->login($correo, $contraseña)){
            echo('Bienvenido al Sistema :D/');
        }else{
            echo('Correo o contraseña incorrectos :(');
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