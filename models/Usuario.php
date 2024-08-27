<?php
class Usuario extends Conectar {
    public function login(){
        $conectar = parent::Conexion();
        parent::set_names();
        if (isset($_POST["enviar"])) {
            $correo = $_POST["user_username"];
            $pass = $_POST["user_password"];
            $rol = $_POST["user_role"];
            if (empty($correo) and empty($pass)) {
                header("location:".conectar::ruta()."index.php?m=2");
                exit();
            }else{
                $sql = "SELECT * FROM users WHERE user_username =? AND user_password =? AND user_role=? AND user_status=1";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo);
                $stmt->bindValue(2, $pass);
                $stmt->bindValue(3, $rol);
                $stmt->execute();
                $resultado = $stmt->fetch();
                if (is_array($resultado) and count($resultado) > 0) {
                    $_SESSION["user_id"] = $resultado["user_id"];
                    $_SESSION["user_names"] = $resultado["user_names"];
                    $_SESSION["user_last_name"] = $resultado["user_last_name"];
                    $_SESSION["user_second_last_name"] = $resultado["user_second_last_name"];
                    $_SESSION["user_role"] = $resultado["user_role"];
                    header("location:".Conectar::ruta()."view/RegistroNomina/");
                    exit();

                } else {
                    header("location:".Conectar::ruta()."index.php?m=1");
                    exit();
                }
                
            }
        }
    }

    public function insert_usuario ($user_names,$user_last_name,$usu_correo,$usu_pass,$user_role) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO users (user_names,user_last_name,usu_correo,usu_pass,fech_crea,est,user_role) VALUES (?,?,?,?,GETDATE(),1,?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user_names);
        $sql->bindValue(2, $user_last_name);
        $sql->bindValue(3, $usu_correo);
        $sql->bindValue(4, $usu_pass);
        $sql->bindValue(5, $user_role);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function update_usuario($user_id,$user_names,$user_last_name,$usu_correo,$usu_pass,$user_role) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE users set
        user_names =?,
        user_last_name =?,
        usu_correo =?,
        usu_pass =?,
        user_role =?,
        fecha_modi = GETDATE()
        WHERE
        user_id =?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user_names);
        $sql->bindValue(2, $user_last_name);
        $sql->bindValue(3, $usu_correo);
        $sql->bindValue(4, $usu_pass);
        $sql->bindValue(5, $user_role);
        $sql->bindValue(6, $user_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function delete_usuario ($user_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE users SET est = 0,fecha_elim = GETDATE() where user_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario () {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM users where est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_x_id ($user_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM users where user_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_total_x_id ($user_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) as TOTAL from ticket where user_id =?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_total_abiertos_x_id ($user_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "  select COUNT(*) as TOTAL from ticket where user_id =? and ticket_estado ='Abierto'";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_total_cerrados_x_id ($user_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "  select COUNT(*) as TOTAL from ticket where user_id =? and ticket_estado ='Cerrado'";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_x_rol_soporte () {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM users where est = 1 AND user_role=2";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

}