<?php
require_once 'usuario.class.php';
include 'rol.class.php';
$app = new Usuario;
$appRol = new Rol;
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        $roles = $appRol -> read_All();
        include 'views/usuario/form.php';
        break;
    case 'nuevo':
        $data = $_POST;
        $result = $app -> create($data);
        if($result){
            $mensaje = "El usuario ha sido registrado correctamente.";
            $tipo = "success";
        } else {
            $mensaje = "Error al registrar el usuario.";
            $tipo = "danger";
        }
        $usuarios = $app -> read_All();
        include 'views/usuario/index.php';
        break;
    case 'modificar':
        $usuarios = $app -> read_One($id);
        $roles = $app -> read_All();
        include 'views/usuario/form.php';
    case 'actualizar':
        $data = $_POST['data'];
        $result= $app -> update($id, $data);
        if($result){
            $mensaje = "El usuario ha sido actualizado correctamente.";
            $tipo = "success";
        } else {
            $mensaje = "Error al actualizar el usuario.";
            $tipo = "danger";
        }
        $usuarios = $app -> read_All();
        include 'views/usuario/index.php';
        break;
    case 'eliminar':
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        if(!is_null($id)){
            if(is_numeric($id)){
                $result = $app->delete($id);
                if($result){
                    $mensaje = "El rol se ha eliminado correctamente.";
                    $tipo = "success";
                } else {
                    $mensaje = "Hubo un error, no se pudo borrar el rol.";
                    $tipo = "danger";
                }
            } 
        }
        $usuarios = $app -> read_All();
        include "views/usuario/index.php";
        break;
    default:
    $usuarios = $app -> read_All();
    include 'views/usuario/index.php';
}
require_once 'views/footer.php';
?>