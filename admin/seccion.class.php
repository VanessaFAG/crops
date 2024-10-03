<?php 
require_once ('../sistema.class.php');
class Seccion extends Sistema {
    function create ($data){
        $result = [];
        $this->conexion();
        $sql = "insert into seccion(seccion, area, id_invernadero) 
                values (:seccion, :area, :id_invernaderon);";
        $insertar = $this->con->prepare($sql);
        $insertar -> bindParam(':seccion', $data['seccion'], PDO::PARAM_STR);
        $insertar -> bindParam(':area', $data['area'], PDO::PARAM_INT);
        $insertar -> bindParam(':id_invernadero', $data['id_invernadero'], PDO::PARAM_INT);
        $insertar -> execute();
        $result = $insertar -> rowCount();
        return $result;
    }
    function update($id, $data){
        $this -> conexion();
        $result = [];
        $sql = "update seccion set
        seccion = :seccion,
        area = :area,
        id_invernadero = :id_invernadero,
        where id_seccion = :id_seccion;";
        $actualizar = $this->con->prepare($sql);
        $actualizar -> bindParam(':id_seccion', $id, PDO::PARAM_INT);
        $actualizar -> bindParam(':seccion', $data['seccion'], PDO::PARAM_INT);
        $actualizar -> bindParam(':area', $data['area'], PDO::PARAM_INT);
        $actualizar -> bindParam(':id_invernadero', $data['id_invernadero'], PDO::PARAM_INT);
        $actualizar -> execute();
        $result = $actualizar -> rowCount();
        return $result;
    }
    function delete($id){
        $result = [];
        $this -> conexion();
        $sql = "delete from seccion where id_seccion = :id_seccion;";
        $eliminar = $this->con->prepare($sql);
        $eliminar -> bindParam(':id_seccion', $id, PDO::PARAM_INT);
        $eliminar -> execute();
        $result = $eliminar -> rowCount();
        return $result;
    }
    function read_One($id){
        $this -> conexion();
        $result = [];
        $consulta = 'select * from seccion where id_seccion = :id_seccion';
        $sql = $this -> con -> prepare($consulta);
        $sql->bindParam(':id_seccion', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function read_All(){
        $this->conexion();
        $result = [];
        $consulta = 'select * from seccion';
        $sql = $this -> con -> prepare($consulta);
        $sql->execute();
        $result = $sql-> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>