<?php 
require_once ('../sistema.class.php');
$app = new Sistema;
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
switch ($accion) {
    case 'login':
        $correo = $_POST['data']['correo'];
        $contraseña = $_POST['data']['contraseña'];
        if($app->login($correo, $contraseña)){
            echo('Bienvenido al Sistema :D/')
        }else{
            echo('Correo o contraseña incorrectos :(');
        }
    default:
    include ('views/login/index.php');
    break;
}
?>