<?php 
require_once("../config/conexion.php");
require_once("../models/Ticket.php");
$ticket = new Ticket();
require_once("../models/Usuario.php");
$usuario = new Usuario();
require_once("../models/Documento.php");
$documento = new Documento();
switch ($_GET["op"]) {
    case 'insert':
        
        if (isset($_POST["cat_id_4"])) {
            $categorias = $_POST["cat_id"].",".$_POST["cat_id_2"].",".$_POST["cat_id_3"].",".$_POST["cat_id_4"];
        } else if (isset($_POST["cat_id_3"])) {
            $categorias = $_POST["cat_id"].",".$_POST["cat_id_2"].",".$_POST["cat_id_3"];
        } else if (isset($_POST["cat_id_2"])) {
            $categorias = $_POST["cat_id"].",".$_POST["cat_id_2"];
        } else {
            $categorias = ""; 
        }
        $infoTicket = $ticket->insert_ticket($_POST["usu_id"],$categorias,$_POST["ticket_titulo"],$_POST["ticket_desc"]);
        if (is_array($infoTicket) == true and count($infoTicket) > 0) {
            foreach ($infoTicket as $row) {
                $output["ticket_id"] = $row["ticket_id"];
                if ($_FILES['files']['name'] != 0) {
                    $countFiles = count($_FILES['files']['name']);
                    $ruta = "../public/documents/".$output["ticket_id"]."/";
                    $files_arr = array();
                    if (!file_exists($ruta)) {
                        mkdir($ruta, 0777, true);
                    }
                    for ($i=0; $i < $countFiles; $i++) { 
                       $fileNom = $_FILES['files']['tmp_name'][$i];
                       $fileRoute = $ruta.$_FILES['files']['name'][$i];
                       $documento->insert_document($output["ticket_id"],$_FILES['files']['name'][$i]);
                       move_uploaded_file($fileNom,$fileRoute);
                    }
                }
                    
    
            }
        }
        echo json_encode($infoTicket);
    break;
    case 'insertnomina':
        $nombre = $_GET["nombre"];
        $apellido = $_GET["apellido"];
        $ticket->test_insert($nombre, $apellido);
        break;
    case 'listar_x_usu':
        $datos = $ticket->listar_ticket_x_usu($_POST["usu_id"]);
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["ticket_id"];
            $sub_array[] = $row["ticket_titulo"];
            if ($row["ticket_estado"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            }else {
                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_creacion"]));
            if ($row["fecha_asig"] == null) {
                $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';

            }else {
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_asig"]));
            }
            if ($row["usu_asig"] == null) {
                $sub_array[] = '<span class="label label-pill label-warning">Sin Asignar</span>';

            }else {
                $datosUsuario = $usuario->get_usuario_x_id($row["usu_asig"]);
                foreach ($datosUsuario as $rowUsuario) {
                $sub_array[] = '<span class="label label-pill label-success">'.$rowUsuario["usu_nom"]." ".$rowUsuario["usu_ape"].'</span>';  
                }
            }
            $sub_array[] = '<button type="button" onClick="ver('.$row["ticket_id"].');" id="'.$row["ticket_id"].'" class="btn_consult btn-outline-primary btn-icon"><div><i class="fa fa-eye"></i></div></button>';
            $data [] = $sub_array; 
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data);
        echo json_encode($results);
        
    break;

    case 'listar':
        $datos = $ticket->listar_ticket();
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["ticket_id"];
            $sub_array[] = $row["ticket_titulo"];
            if ($row["ticket_estado"] == "Abierto") {
                $sub_array[] = '<span class="label label-pill label-success">Abierto</span>';
            }else {
                $sub_array[] = '<span class="label label-pill label-danger">Cerrado</span>';
            }
            $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_creacion"]));
            if ($row["fecha_asig"] == null) {
                $sub_array[] = '<span class="label label-pill label-default">Sin Asignar</span>';

            }else {
                $sub_array[] = date("d/m/Y H:i:s", strtotime($row["fecha_asig"]));
            }
            if ($row["usu_asig"] == null) {
                $sub_array[] = '<a onClick="asignar('.$row["ticket_id"].');"><span class="label label-pill label-warning">Sin Asignar</span></a>';

            }else {
                $datosUsuario = $usuario->get_usuario_x_id($row["usu_asig"]);
                foreach ($datosUsuario as $rowUsuario) {
                $sub_array[] = '<span class="label label-pill label-success">'.$rowUsuario["usu_nom"]." ".$rowUsuario["usu_ape"].'</span>';  
                }
            }
            $sub_array[] = '<button type="button" onClick="ver('.$row["ticket_id"].');" id="'.$row["ticket_id"].'" class="btn_consult btn-outline-primary btn-icon"><div><i class="fa fa-eye"></i></div></button>';
            $data [] = $sub_array; 
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data);
        echo json_encode($results);
        
    break;

    case 'listardetalle':
        $datos = $ticket->listar_ticketdetalle_x_ticket($_POST["ticket_id"]);
        foreach ($datos as $row) {
            ?>
            <article class="activity-line-item box-typical">
                <div class="activity-line-date">
                    <?php echo date("d/m/Y", strtotime($row["fecha_creacion"])); ?>
                </div>
                <header class="activity-line-item-header">
                    <div class="activity-line-item-user">
                        <div class="activity-line-item-user-photo">
                            <a href="#">
                                <img src="../../public/img/<?php echo $row["rol_id"] ?>.png" alt="">
                            </a>
                        </div>
                        <div class="activity-line-item-user-name"><?php echo $row["usu_nom"]." ".$row["usu_ape"] ?></div>
                        <div class="activity-line-item-user-status">
                            <?php
                            if ($row["rol_id"] == 1) {
                                echo "Usuario";
                            }else{
                                echo "Soporte";
                            }
                            ?>
                        </div>
                    </div>
                </header>
                <div class="activity-line-action-list">
                    <section class="activity-line-action">
                        <div class="time"> <?php echo date("H:i:s", strtotime($row["fecha_creacion"])) ?></div>
                        <div class="cont">
                            <div class="cont-in">
                                <p>
                                    <?php echo $row["ticket_desc"] ?>
                                </p>
                            </div>
                        </div>
                    </section><!--.activity-line-action-->
                </div><!--.activity-line-action-list-->
            </article>
            <?php
            
        }
        ?>
        <?php
    break;

    case "mostrar";
            $datos=$ticket->listar_ticket_x_id($_POST["ticket_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["ticke_id"] = $row["ticket_id"];
                    $output["usu_id"] = $row["usu_id"];
                    $output["ticket_titulo"] = $row["ticket_titulo"];
                    $output["ticket_desc"] = $row["ticket_desc"];
                    if ($row["ticket_estado"]=="Abierto"){
                        $output["ticket_estado"] = '<span class="label label-pill label-success">Abierto</span>';
                    }else{
                        $output["ticket_estado"] = '<span class="label label-pill label-danger">Cerrado</span>';
                    }
                    $output["ticket_estado_texto"] = $row["ticket_estado"];
                    $output["fecha_creacion"] = date("d/m/Y H:i:s", strtotime($row["fecha_creacion"]));
                    $output["usu_nom"] = $row["usu_nom"];
                    $output["usu_ape"] = $row["usu_ape"];
                }
                echo json_encode($output);
            }
    break;
    case "insert_ticket_detalle":
        $ticket->insert_ticket_detalle($_POST["ticket_id"],$_POST["usu_id"],$_POST["ticket_desc"]);
    break;
    case "update_estado_ticket":
        $ticket->update_estado_ticket($_POST["ticket_id"]);
        $ticket->insert_ticket_detalle_cerrado($_POST["ticket_id"], $_POST["usu_id"]);
    break;
    case "total";
        $datos=$ticket->get_usuario_total();
            echo json_encode($datos);
    break;
    case "totalabiertos";
        $datos=$ticket->get_usuario_total_abiertos();
            echo json_encode($datos);
    break;
    case "totalcerrados";
        $datos=$ticket->get_usuario_total_cerrados();
            echo json_encode($datos);
    break;
    case "update_asignacion_agente":
        $ticket->update_asignacion_ticket($_POST["ticket_id"],$_POST["usu_asig"]);
    break;
}
?>