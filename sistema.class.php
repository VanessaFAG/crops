<?php
require_once "config.class.php";
class Sistema{
    var $con; 
    function conexion(){
    $this -> con = new PDO(SGBD.':host='.DBHOST.';dbname='.DBNAME.';port='.DBPORT, DBUSER, DBPASSWORD);
    }
    function alerta($tipo, $mensaje){
        include('views/alert.php');
    }
    function getRol($correo){
        $this -> conexion();
        $data = [];
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $sql = "select r.rol from rol r 
                join usuario_rol ur on r.id_rol = ur.id_rol
                join usuario u on ur.id_usuario = u.id_usuario
            where u.correo =:correo";
            $roles = $this -> con -> prerare($sql);
            $roles -> bindParam(':correo', $correo, PDO::PARAM_STR);
            $roles -> execute();
            $data = $sql -> fetchAll(PDO::FETCH_ASSOC); 
        }
        return $data;
    }
    function getPrivilegio($correo){
        $this -> conexion();
        $data = [];
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $sql = "select u.correo, p.permiso from usuario u
                        join usuario_rol ur on u.id_usuario = ur.id_usuario
                        join rol r on ur.id_rol = r.id_rol
                        join rol_permiso rp on r.id_rol = rp.id_rol
                        join permiso p on rp.id_permiso = p.id_permiso
                    where correo = :correo";
            $privilegios = $this->con->prepare($sql);
            $privilegios->bindParam(':correo', $correo, PDO::PARAM_STR);
            $privilegios->execute();
            $data = $privilegios->fetchAll(PDO::FETCH_ASSOC);
        }
        return $data;
    }
}
?>