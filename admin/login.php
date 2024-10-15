<?php 
require_once ('../sistema.class.php');
$app = new Sistema;
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
switch ($accion) {
    case 'login':
        $correo = $_POST['data']['correo'];
        $contraseña = $_POST['data']['contraseña'];
        $app->login($correo, $contraseña);
    default:
    include ('views/login/index.php');
    break;
}
?>