<?php
require_once ('privilegio.class.php');
$app = new Privilegio;
$app -> checkRol('Administrador');
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion) {
    case 'crear':
        include 'views/privilegio/form.php';
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $resultado = $app -> create($data);
        if($resultado){
            $mensaje = "El privilegio ha sido registrado corectamente.";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error al registar el privilegio";
            $tipo = "danger";
        }
        $privilegios = $app -> read_All();
        include "views/privilegio/index.php";
        break;
    case 'modificar':
        $privilegios = $app -> read_One($id);
        include "views/privilegio/form.php";
        break;
    case 'actualizar':
        $data = $_POST['data'];
        $resultado = $app -> update($id,$data);
        if($resultado){
            $mensaje = "El privilegio ha sido actualizado.";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error, no se pudo actualizar.";
            $tipo = "danger";
        }
        $privilegios = $app -> read_All();
        include "views/privilegio/index.php";
        break;
    case 'eliminar':
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        if(!is_null($id)){
            if(is_numeric($id)){
                $result= $app->delete($id);
                if($result){
                    $mensaje = "El privilegio se ha eliminado correctamente.";
                    $tipo = "success";
                } else {
                    $mensaje = "Hubo un error al elimar el privilegio.";
                    $tipo = "danger";
                }
            } 
        }
        $privilegios = $app -> read_All();
        include "views/privilegio/index.php";
        break;
    default:
        $privilegios = $app -> read_All();
        include "views/privilegio/index.php";
}
require_once 'views/footer.php';
?>