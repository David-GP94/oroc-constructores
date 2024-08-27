<?php
require_once("../config/conexion.php");
require_once("../models/Documento.php");
$documento = new Documento();

switch ($_GET["op"]) {
    case 'listar':
        $datos = $documento->get_document_x_ticket($_POST["ticket_id"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $su_array = '<a href="../public/documents/'.$_POST["ticket_id"].'/'.$row["document_name"].'" target="_blank">'.$row["document_name"].'</a>';
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data);
        echo json_encode($results);
        break;

}
?>