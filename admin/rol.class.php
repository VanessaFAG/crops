<?php 
require_once ('../sistema.class.php');
class Rol extends Sistema {
    function create ($data){
        $result = [];
        $this -> conexion();
        /*try {
            $this -> con -> beginTransaction();
            $sql = "select id_rol from rol where rol =:rol"
            $insertar = $this -> con -> prepare($sql);
            $insertar -> bindParam(':rol', $data['rol'], PDO::PARAM_STR);
            $insertar -> execute();
            $result =  $insertar -> fetch(PDO::FETCH_ASSOC);
            if($result){
                $mensaje = "El rol ya existe";
                $tipo = "danger";
                $this -> alert($mensaje, $tipo);
                $this -> con -> rollBack(); 
                return false;
            }
            $sql = "insert into rol(rol) values (:rol);";
            $insertar = $this->con->prepare($sql);
            $insertar -> bindParam(':rol', $data['rol'], PDO::PARAM_STR);
            $insertar -> execute();
            if(isset($data['permiso'])&&is_array($datos['permiso'])){
                foreach($data['permiso'] as $id_rol){
                $sql = "insert into rol_permiso(id_rol,id_permiso) 
                values (:id_rol, :id_permiso);";
                $insertarPermiso = $this->con->prepare($sql);
                $insertarPermiso -> bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
                $insertarPermiso -> bindParam(':id_permiso', $id, PDO::PARAM_INT);
                $insertarPermiso -> execute();
                }
            }
            $this -> con -> commit();
            return true;
        } catch (PDOException $e) {
            $this -> con -> rollBack();
            return false;
        }*/
    }
    function update($data, $id){
        $result = [];
        $this -> conexion();
        $sql = "update rol set rol = :rol where id_rol = :id_rol;";
        $actualizar = $this->con->prepare($sql);
        $actualizar -> bindParam(':id_rol', $id, PDO::PARAM_INT);
        $actualizar -> bindParam(':rol', $data['rol'], PDO::PARAM_STR);
        $actualizar -> execute();
        $result = $actualizar -> rowCount();
        return $result;
    }
    function delete($id){
        $result = [];
        $this -> conexion();
        $sql = "delete from rol where id_rol = :id_rol;";
        $eliminar = $this->con->prepare($sql);
        $eliminar -> bindParam(':id_rol', $id, PDO::PARAM_INT);
        $eliminar -> execute();
        $result = $eliminar -> rowCount();
        return $result;
    }
    function read_One($id){
        $this -> conexion();
        $result = [];
        $consulta = "select * from rol where id_rol = :id_rol";
        $consulta = $this->con->prepare($consulta);
        $consulta -> bindParam(':id_rol', $id, PDO::PARAM_INT);
        $consulta -> execute();
        $result = $consulta -> fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    function read_All(){
        $this -> conexion();
        $result = [];
        $consulta = "select r.*, p.permiso from rol r 
        join rol_permiso rp on r.id_rol = rp.id_rol 
        join permiso p on rp.id_permiso = p.id_permiso;";
        $consulta = $this->con->prepare($consulta);
        $consulta -> execute();
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function read_permisos($id_rol):string{
        $this -> conexion();
        $result = [];
        $consulta = "select p.* from rol_permiso rp 
        join permiso p on rp.id_permiso = p.id_permiso 
        join rol r on rp.id_rol = r.id_rol
        where r.id_rol = :id_rol;";
        $consulta = $this->con->prepare($consulta);
        $consulta -> bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $consulta -> execute();
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        $privilegio = "";
        foreach($result as $key => $row){
            $privilegio.= $row['permiso'];
            if($key<count($result)-1){
                $privilegio.= ", ";
            }
        }
        return $privilegio;
    }
    function get_All(){
        $this -> conexion();
        $result = [];
        $consulta = "select * from rol";
        $consulta = $this->con->prepare($consulta);
        $consulta -> execute();
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    function get_Permiso_Rol($id_rol){
        $this -> conexion();
        $result = [];
        $consulta = "select p.* from rol_permiso rp 
        join permiso p on rp.id_permiso = p.id_permiso 
        join rol r on rp.id_rol = r.id_rol
        where r.id_rol = :id_rol;";
        $consulta = $this->con->prepare($consulta);
        $consulta -> bindParam(':id_rol', $id_rol, PDO::PARAM_INT);
        $consulta -> execute();
        $result = $consulta -> fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
?>