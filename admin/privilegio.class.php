<?php 
require_once ('../sistema.class.php');
class Privilegio extends Sistema{
    function create ($data){
        $resultado = [];
        $this -> conexion();
        $query = "insert into permiso(permiso) values(:permiso);";
        $crear = $this -> con -> prepare($query);
        $crear -> bindParam(':permiso',$data['permiso'], PDO::PARAM_STR);
        $crear -> execute();
        $resultado = $crear -> rowCount();
        return $resultado; 
    }
    function update($id,$data){
        $resultado = [];
        $this -> conexion();
        $query = "update permiso set permiso = :permiso
        where id_permiso = :id_permiso;";
        $actualizar = $this -> con -> prepare($query);
        $actualizar -> bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $actualizar -> bindParam(':permiso', $data['permiso'], PDO::PARAM_STR);
        $actualizar -> execute();
        $resultado = $actualizar -> rowCount();
        return $resultado;
    }
    function delete($id){
        $resultado = [];
        $this -> conexion();
        $query = "delete from permiso where id_permiso = :id_permiso;";
        $eliminar = $this-> con -> prepare($query);
        $eliminar -> bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $eliminar -> execute();
        $resultado = $eliminar -> rowCount();
        return $resultado;
    }
    function read_One($id){
        $this -> conexion();
        $resultado = [];
        $query = "select * from permiso where id_permiso = :id_permiso;";
        $leer = $this -> con -> prepare($query);
        $leer->bindParam(':id_permiso', $id, PDO::PARAM_INT);
        $leer->execute();
        $resultado = $leer -> fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }
    function read_All(){
        $this -> conexion();
        $resultado = [];
        $query = "select * from permiso;";
        $leer = $this -> con -> prepare($query);
        $leer -> execute();
        $resultado = $leer -> fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
?>