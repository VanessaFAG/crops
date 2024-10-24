<?php
session_start();
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
                    where u.correo = :correo";
            $roles = $this -> con -> prepare($sql);
            $roles -> bindParam(':correo', $correo, PDO::PARAM_STR);
            $roles -> execute();
            $data = $roles -> fetchAll(PDO::FETCH_ASSOC);
            $roles = [];
            foreach($data as $rol){
                array_push($roles, $rol['rol']);
            }
            $data = $roles;
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
                    where u.correo = :correo";
            $privilegios = $this->con->prepare($sql);
            $privilegios->bindParam(':correo', $correo, PDO::PARAM_STR);
            $privilegios->execute();
            $data = $privilegios->fetchAll(PDO::FETCH_ASSOC);
            $permisos = [];
            foreach($data as $permiso){
                array_push($permisos, $permiso['permiso']);
            }
            $data = $permisos;
        }
        return $data;
    }
    function login($correo, $password){
        $password = md5($password);
        $acceso = false;
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $this -> conexion();
            $sql = "select * from usuario 
            where correo = :correo and password = :password";
            $login = $this->con->prepare($sql);
            $login->bindParam(':correo', $correo, PDO::PARAM_STR);
            $login->bindParam(':password', $password, PDO::PARAM_STR);
            $login->execute();
            $resultado = $login->fetchAll(PDO::FETCH_ASSOC);
            if(isset($resultado[0])){
                $acceso = true;
                $_SESSION['correo']=$correo;
                $_SESSION['validado']=$acceso;
                $roles = $this -> getRol($correo);
                $privilegios = $this -> getPrivilegio($correo);
                $_SESSION['roles']=$roles;
                $_SESSION['privilegios']=$privilegios;
                return $acceso;
            }
        }
        $_SESSION['validado'] = false;
        return $acceso;
    }
    function logout(){
        unset($_SESSION);
        session_destroy();
        $mensaje = "Gracias por utilizar el sistema, se ha cerrado la sesión <a href ='login.php'>[presione aquí pars volver a entrar]</a>";
        $tipo = "success";
        require_once('views/header.php');
        $this -> alerta($tipo, $mensaje);
        require_once('views/footer.php');
    }
    function checkRol($rol){
        if(isset($_SESSION['roles'])){
        $roles = $_SESSION['roles'];
        if(!in_array($rol,$roles)){
            $mensaje = "Error, usted no tiene el rol adecuado";
            $tipo ="danger";
            require_once "views/header/alert.php";
            $this -> alerta($tipo, $mensaje);
            die();
        }
    }else {
        $mensaje = "Requiere iniciar sesión. <a href='login.php'>[Presiome aquí para voler al Log In]</a>";
        $tipo ="danger";
         require_once "views/header/alert.php";
         $this -> alerta($tipo, $mensaje);
         die();
    }
    }
}
?>