<?php 
require_once ('../sistema.class.php');
class Usuario extends Sistema{
    function create ($data){
        $result = [];
        $this->conexion();
        $data  = $data['data'];
        $this -> con -> beginTransaction();
        $sql = "insert into usuario(correo, password)
                values (:correo, md5(:password));";
        $insertar = $this->con->prepare($sql);
        $insertar -> bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $insertar -> bindParam(':password', $data['password'], PDO::PARAM_STR);
        $insertar -> execute();
        $this -> con -> commit() ;
        return $result;
    }
    function update($data, $id){
        $result = [];
        $this->conexion();
        $password = md5($data['password']);
        $sql = "update usuario set correo = :correo, password = :password 
                where id_usuario = :id_usuario;";
        $actualizar = $this->con->prepare($sql);
        $actualizar -> bindParam(':correo', $data['correo'], PDO::PARAM_STR);
        $actualizar -> bindParam(':password', $password, PDO::PARAM_STR);
        $actualizar -> bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $actualizar -> execute();
        $result = $actualizar -> rowCount();
        return $result;
    }
    function delete($id){
        $result = [];
        $this -> conexion();
        if(is_numeric($id)){
            $sql = "delete from usuario where id_usuario = :id_usuario;";
            $eliminar = $this->con->prepare($sql);
            $eliminar -> bindParam(':id_usuario', $id, PDO::PARAM_INT);
            $eliminar -> execute();
            $result = $eliminar -> rowCount();
        }
        return $result;
    }
    function read_One($id){
        $this -> conexion();
        $result = [];
        $sql = "select * from usuario where id_usuario = :id_usuario";
        $sql = $this->con->prepare($sql);
        $sql->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function read_All(){
        $this->conexion();
        $result = [];
        $sql = "select u.*, r.rol from usuario u
        join usuario_rol ur on u.id_usuario = ur.id_usuario
        join rol r on ur.id_rol = r.id_rol;";
        $sql = $this->con->prepare($sql);
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>