<?php 
include ('../sistema.class.php');
//include "../sistema.class.php";

class Invernadero extends Sistema {
    function create ($data){
        $result = [];
        $this->conexion();
        $sql = "insert into invernadero(invernadero, latitud, longitud, area, fecha_creacion) 
                values (:invernadero, :latitud, :longitud, :area, :fecha_creacion);";
        $insertar = $this->con->prepare($sql);
        $insertar -> bindParam(':invernadero', $data['invernadero'], PDO::PARAM_STR);
        $insertar -> bindParam(':latitud',$data['latitud'], PDO::PARAM_STR);
        $insertar -> bindParam(':longitud',$data['longitud'], PDO::PARAM_STR);
        $insertar -> bindParam(':area',$data['area'], PDO::PARAM_STR);
        $insertar -> bindParam(':fecha_creacion',$data['fecha_creacion'], PDO::PARAM_STR);
        $insertar -> execute();
        $result = $insertar -> rowCount();
        return $result;
    }
    function update($id, $data){
        $this -> conexion();
        $result = [];
        $sql = "update invernadero set
        invernadero = :invernadero,
        latitud = :latitud,
        longitud = :longitud,
        area = :area,
        fecha_creacion = :fecha_creacion
        where id_invernadero = :id_invernadero;";
        $actualizar = $this->con->prepare($sql);
        $actualizar -> bindParam(':id_invernadero', $id, PDO::PARAM_INT);
        $actualizar -> bindParam(':invernadero', $data['invernadero'], PDO::PARAM_STR);
        $actualizar -> bindParam(':latitud',$data['latitud'], PDO::PARAM_STR);
        $actualizar -> bindParam(':longitud',$data['longitud'], PDO::PARAM_STR);
        $actualizar -> bindParam(':area',$data['area'], PDO::PARAM_STR);
        $actualizar -> bindParam(':fecha_creacion',$data['fecha_creacion'], PDO::PARAM_STR);
        $actualizar -> execute();
        $result = $actualizar -> rowCount();
        return $result;
    }
    function delete($id){
        $result = [];
        $this -> conexion();
        $sql = "delete from invernadero where id_invernadero = :id_invernadero;";
        $eliminar = $this->con->prepare($sql);
        $eliminar -> bindParam(':id_invernadero', $id, PDO::PARAM_INT);
        $eliminar -> execute();
        $result = $eliminar -> rowCount();
        return $result;
    }
    function read_One($id){
        $this -> conexion();
        $result = [];
        $consulta = 'select * from invernadero where id_invernadero = :id_invernadero';
        $sql = $this -> con -> prepare($consulta);
        $sql->bindParam(':id_invernadero', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function read_All(){
        $this->conexion();
        $result = [];
        $consulta = 'select * from invernadero';
        $sql = $this -> con -> prepare($consulta);
        $sql->execute();
        $result = $sql-> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>