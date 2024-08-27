<?php
class Usuario extends Conectar {
    public function login(){
        $conectar = parent::Conexion();
        parent::set_names();
        if (isset($_POST["enviar"])) {
            $correo = $_POST["usu_correo"];
            $pass = $_POST["usu_pass"];
            $rol = $_POST["rol_id"];
            if (empty($correo) and empty($pass)) {
                header("location:".conectar::ruta()."index.php?m=2");
                exit();
            }else{
                $sql = "SELECT * FROM users WHERE usu_correo =? AND usu_pass =? AND rol_id=? AND est=1";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo);
                $stmt->bindValue(2, $pass);
                $stmt->bindValue(3, $rol);
                $stmt->execute();
                $resultado = $stmt->fetch();
                if (is_array($resultado) and count($resultado) > 0) {
                    $_SESSION["usu_id"] = $resultado["usu_id"];
                    $_SESSION["usu_nom"] = $resultado["usu_nom"];
                    $_SESSION["usu_ape"] = $resultado["usu_ape"];
                    $_SESSION["rol_id"] = $resultado["rol_id"];
                    header("location:".Conectar::ruta()."view/Home/");
                    exit();

                } else {
                    header("location:".Conectar::ruta()."index.php?m=1");
                    exit();
                }
                
            }
        }
    }

    public function insert_usuario ($usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO users (usu_nom,usu_ape,usu_correo,usu_pass,fech_crea,est,rol_id) VALUES (?,?,?,?,GETDATE(),1,?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_ape);
        $sql->bindValue(3, $usu_correo);
        $sql->bindValue(4, $usu_pass);
        $sql->bindValue(5, $rol_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function update_usuario($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE users set
        usu_nom =?,
        usu_ape =?,
        usu_correo =?,
        usu_pass =?,
        rol_id =?,
        fecha_modi = GETDATE()
        WHERE
        usu_id =?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_ape);
        $sql->bindValue(3, $usu_correo);
        $sql->bindValue(4, $usu_pass);
        $sql->bindValue(5, $rol_id);
        $sql->bindValue(6, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function delete_usuario ($usu_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE users SET est = 0,fecha_elim = GETDATE() where usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
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
    public function get_usuario_x_id ($usu_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM users where usu_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_total_x_id ($usu_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) as TOTAL from ticket where usu_id =?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_total_abiertos_x_id ($usu_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "  select COUNT(*) as TOTAL from ticket where usu_id =? and ticket_estado ='Abierto'";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_total_cerrados_x_id ($usu_id) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "  select COUNT(*) as TOTAL from ticket where usu_id =? and ticket_estado ='Cerrado'";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_x_rol_soporte () {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM users where est = 1 AND rol_id=2";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

}