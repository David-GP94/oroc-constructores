<?php
class Ticket extends Conectar{
    public function insert_ticket($usu_id,$cat_id,$ticket_titulo,$ticket_desc) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO ticket (usu_id,cat_id,ticket_titulo,ticket_desc,ticket_estatus,fecha_creacion,ticket_estado) VALUES (?,?,?,?,1,GETDATE(),'Abierto')";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $cat_id);
        $sql->bindValue(3, $ticket_titulo);
        $sql->bindValue(4, $ticket_desc);
        $sql->execute();
        //Obtener id insertado
        $getId = "SELECT @@IDENTITY as ticket_id";
        $getId = $conectar->prepare($getId);
        $getId->execute();
        return $resultado = $getId->fetchAll(pdo::FETCH_ASSOC);

    }
    public function test_insert ($nombre, $apellido) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO test_insert (nombre,apellido) VALUES ('david','garcia')";
        $stmt = $conectar->prepare($sql);
        $stmt->execute();
    }
    public function listar_ticket_x_usu($usu_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
            ticket.ticket_id,
            ticket.usu_id,
            ticket.cat_id,
            ticket.ticket_titulo,
            ticket.ticket_desc,
            ticket.ticket_estado,
            ticket.fecha_creacion,
            ticket.usu_asig,
            ticket.fecha_asig,
            users.usu_nom,
            users.usu_ape
            FROM
            ticket
            INNER join users on ticket.usu_id = users.usu_id
            WHERE
            ticket.ticket_estatus = 1
            AND users.usu_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
            
    }
    public function listar_ticket(){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
            ticket.ticket_id,
            ticket.usu_id,
            ticket.cat_id,
            ticket.ticket_titulo,
            ticket.ticket_desc,
            ticket.ticket_estado,
            ticket.fecha_creacion,
            ticket.usu_asig,
            ticket.fecha_asig,
            users.usu_nom,
            users.usu_ape
            FROM
            ticket
            INNER join users on ticket.usu_id = users.usu_id
            WHERE ticket.ticket_estatus = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
            
    }
    public function listar_ticketdetalle_x_ticket($ticket_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "  SELECT ticket_detalle.dticket_id,
        ticket_detalle.ticket_desc,
        ticket_detalle.fecha_creacion,
        users.usu_nom,
        users.usu_ape,
        users.rol_id
        FROM ticket_detalle 
        INNER join users on ticket_detalle.usu_id = users.usu_id 
        WHERE ticket_id =? ORDER BY ticket_detalle.fecha_creacion";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ticket_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
            
    }
    public function listar_ticket_x_id($ticket_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="SELECT 
            ticket.ticket_id,
            ticket.usu_id,
            ticket.ticket_titulo,
            ticket.ticket_desc,
            ticket.ticket_estado,
            ticket.fecha_creacion,
            users.usu_nom,
            users.usu_ape,
            users.usu_correo
            FROM 
            ticket
            INNER join users on ticket.usu_id = users.usu_id
            WHERE
            ticket.ticket_estatus = 1
            AND ticket.ticket_id = ?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $ticket_id);
        $sql->execute();
        return $resultado=$sql->fetchAll();
    }
    public function insert_ticket_detalle($ticket_id,$usu_id,$ticket_desc){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO ticket_detalle (ticket_id,usu_id,ticket_desc,fecha_creacion,estatus) VALUES (?,?,?,GETDATE(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ticket_id);
        $sql->bindValue(2, $usu_id);
        $sql->bindValue(3, $ticket_desc);
        $sql->execute();
    }
    public function insert_ticket_detalle_cerrado($ticket_id,$usu_id){
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO ticket_detalle (ticket_id,usu_id,ticket_desc,fecha_creacion,estatus) VALUES (?,?,'Ticket Cerrado',GETDATE(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ticket_id);
        $sql->bindValue(2, $usu_id);
        $sql->execute();
    }
    public function update_estado_ticket($ticket_id){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE ticket set ticket_estado = 'Cerrado'
        WHERE ticket_id=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $ticket_id);
        $sql->execute();
    }
    public function get_usuario_total () {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) as TOTAL from ticket ";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_total_abiertos () {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "  select COUNT(*) as TOTAL from ticket where ticket_estado ='Abierto'";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_usuario_total_cerrados () {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "  select COUNT(*) as TOTAL from ticket where ticket_estado ='Cerrado'";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_ticket_grafico () {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "  select COUNT(*) as TOTAL from ticket where ticket_estado ='Cerrado'";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function update_asignacion_ticket($ticket_id,$usu_asig){
        $conectar= parent::conexion();
        parent::set_names();
        $sql="UPDATE ticket set usu_asig =?,
        fecha_asig = GETDATE()
        WHERE ticket_id=?";
        $sql=$conectar->prepare($sql);
        $sql->bindValue(1, $usu_asig);
        $sql->bindValue(2, $ticket_id);
        $sql->execute();
    }
} 
?>