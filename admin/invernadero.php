<?php
include ('invernadero.class.php');
$app = new Invernadero;
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
$id = (isset($_GET['id'])) ? $_GET['id'] : null;

switch ($accion){
    case 'crear':
        include "views/invernadero/crear.php";
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $result= $app -> create($data);
        if($result){
            $mensaje = "El invernadero ha sido registrado";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error";
            $tipo = "danger";
        }
        $invernaderos = $app -> read_All();
        include "views/invernadero/index.php";
        break;
    case 'modificar':
        $invernaderos = $app -> read_One($id);
        include "views/invernadero/crear.php";
        break;
    case 'actualizar':
        $data = $_POST['data'];
        $result= $app->update($id, $data);
        if($result){
            $mensaje = "El invernadero ha sido actualizado";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error, no se pudo actualizar";
            $tipo = "danger";
        }
        $invernaderos = $app -> read_All();
        include "views/invernadero/index.php";
        break;
    case 'eliminar':
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        if(!is_null($id)){
            if(is_numeric($id)){
                $result= $app->delete($id);
                if($result){
                    $mensaje = "El invernadero se ha eliminado corecctamente";
                    $tipo = "success";
                } else {
                    $mensaje = "Hubo un error";
                    $tipo = "danger";
                }
            } 
        }
        $invernaderos = $app -> read_All();
        include "views/invernadero/index.php";
        break;
    default:
        $invernaderos = $app->read_All();
        include "views/invernadero/index.php";
}
?>