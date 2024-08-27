<?php
class Documento extends Conectar {
    public function insert_document($ticket_id, $document_name) {
        $conectar = parent::conexion();
        $sql = "INSERT INTO documents (ticket_id,document_name,creation_date,estatus) VALUES (?,?,GETDATE(),1)";
        $sql = $conectar->prepare($sql);
        $sql->bindParam(1,$ticket_id);
        $sql->bindParam(2, $document_name);
        $sql->execute();
    }
    public function get_document_x_ticket ($ticket_id) {
        $conectar = parent::conexion();
        $sql = "SELECT * FROM documents WHERE ticket_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindParam(1, $ticket_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
?>