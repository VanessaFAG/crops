<?php
require_once 'rol.class.php';
require_once 'privilegio.class.php';
$app = new Rol;
$appPrivilegio = new Privilegio;
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        $privilegios = $appPrivilegio -> read_All();
        include 'views/rol/form.php';
        break;
    case 'nuevo':
        $data = $_POST;
        $result = $app -> create($data);
        if($result){
            $mensaje = "El rol ha sido registrado corectamente.";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al registrar el rol.";
            $tipo = "error";
        }
        $roles = $app -> read_All();
        include 'views/rol/index.php';
        break;
    case 'modificar':
        $roles = $app -> read_One($id);
        $privilegios = $appPrivilegio -> read_All();
        include 'views/rol/form.php';
        break;
    case 'actualizar':
        $data = $_POST['data'];
        $result = $app -> update($id, $data);
        if($result){
            $mensaje = "El rol ha sido actualizado.";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error, no se pudo actualizar.";
            $tipo = "danger";
        }
        $roles = $app -> read_All();
        include 'views/rol/index.php';
        break;
    case 'eliminar':
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        if(!is_null($id)){
            if(is_numeric($id)){
                $result = $app -> delete($id);
                if($result){
                    $mensaje = "El rol ha sido eliminado.";
                    $tipo = "success";
                } else {
                    $mensaje = "Hubo un error, no se pudo eliminar.";
                    $tipo = "danger";
                }
            }
        }
        $roles = $app -> read_All();
        include 'views/rol/index.php';
        break;
    default:
    $roles = $app -> get_All();
    include 'views/rol/index.php';
}
require_once 'views/footer.php';
?>