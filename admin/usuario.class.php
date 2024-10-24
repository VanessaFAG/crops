<?php 
require_once ('../sistema.class.php');
class Usuario extends Sistema{
    function create ($data){
        $result = [];
        $this->conexion();
        $rol = $data['rol'];
        $data = $data['data'];
        $this -> con -> beginTransaction();
        try {
            $sql = "insert into usuario(correo, password)
            values (:correo, md5(:password));";
            $insertar = $this->con->prepare($sql);
            $insertar -> bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $insertar -> bindParam(':password', $data['password'], PDO::PARAM_STR);
            $insertar -> execute();
            $sql = "select id_usuario from usuario where correo = :correo;";
            $consulta = $this -> con -> prepare($sql);
            $consulta -> bindParam(':correo', $data['correo'], PDO::PARAM_STR);
            $consulta -> execute();
            $datos =  $consulta->fetch(PDO::FETCH_ASSOC);
            $id_usuario = isset($datos['id_usuario']) ? $datos['id_usuario'] : null;
            if(!is_null($id_usuario)){
                foreach($rol as $r => $k){
                    $sql = "insert into usuario_rol(id_usuario, id_rol)
                    values(:id_usuario, :id_rol);";
                    $insertarRol = $this -> con -> prepare($sql);
                    $insertarRol -> bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
                    $insertarRol -> bindParam(':id_rol', $k, PDO::PARAM_INT);
                    $insertarRol -> execute();
                }
                $this -> con -> commit();
                return $insertar -> rowCount();
            }
        } catch (Exception $e) {
            $this -> con -> rollBack();
        }
        return false;
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
        $this -> con -> beginTransaction();
        try {
            if(is_numeric($id)){
                $sql = "delete from usuario_rol where id_usuario = :id_usuario;";
                $eliminarRol = $this->con->prepare($sql);
                $eliminarRol -> bindParam(':id_usuario', $id, PDO::PARAM_INT);
                $eliminarRol -> execute();
                $sql = "delete from usuario where id_usuario = :id_usuario;";
                $eliminar = $this->con->prepare($sql);
                $eliminar -> bindParam(':id_usuario', $id, PDO::PARAM_INT);
                $eliminar -> execute();
            }
            $this -> con -> commit();
            return $result = $eliminar -> rowCount();
        } catch (Exception $e) {
            $this -> con -> rollBack();
        }
        return false;
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
    function read_All() {
        $this->conexion();
        $query = "SELECT u.*, GROUP_CONCAT(r.rol SEPARATOR ', ') AS rol
                  FROM usuario u
                  JOIN usuario_rol ur ON u.id_usuario = ur.id_usuario
                  JOIN rol r ON ur.id_rol = r.id_rol
                  GROUP BY u.id_usuario";
        
        $consulta = $this->con->prepare($query);
        $consulta->execute();
        $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    function read_All_Roles($id) {
        $this->conexion();
        $result = [];
        $sql = "select u.*, r.rol from usuario u
        join usuario_rol ur on u.id_usuario = ur.id_usuario
        join rol r on ur.id_rol = r.id_rol
        where id_usuario = :id_usuario;";
        $consulta = $this->con->prepare($sql);
        $consulta->bindParam(':id_usuario', $id, PDO::PARAM_INT);
        $consulta->execute();
        $result = $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>