<?php
require_once ('seccion.class.php');
$app = new Seccion;
$accion = (isset($_GET['accion']) ? $_GET['accion'] : null); 
$id = (isset($_GET['id'])) ? $_GET['id'] : null;
switch ($accion){
    case 'crear':
        include "views/seccion/crear.php";
        $invernadero = $appInvernadero  -> read_All(); 
        break;
    case 'nuevo':
        $data = $_POST['data'];
        $result= $app -> create($data);
        if($result){
            $mensaje = "La seccion ha sido registrada.";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error, no se pudo registar correctamente.";
            $tipo = "danger";
        }
        $secciones = $app -> read_All();
        include "views/seccion/index.php";
        break;
    case 'modificar':
        $secciones = $app -> read_One($id);
        include "views/seccion/crear.php";
        break;
    case 'actualizar':
        $data = $_POST['data'];
        $result= $app->update($id, $data);
        if($result){
            $mensaje = "La sección ha sido actualizada.";
            $tipo = "success";
        } else {
            $mensaje = "Hubo un error, no se pudo actualizar.";
            $tipo = "danger";
        }
        $secciones = $app -> read_All();
        include "views/seccion/index.php";
        break;
    case 'eliminar':
        $id = (isset($_GET['id'])) ? $_GET['id'] : null;
        if(!is_null($id)){
            if(is_numeric($id)){
                $result= $app->delete($id);
                if($result){
                    $mensaje = "La sección se ha eliminado correctamente.";
                    $tipo = "success";
                } else {
                    $mensaje = "Hubo un error, no se pudo borrar la sección.";
                    $tipo = "danger";
                }
            } 
        }
        $secciones = $app -> read_All();
        include "views/seccion/index.php";
        break;
    default:
        $secciones = $app->read_All();
        include "views/seccion/index.php";
}
?>