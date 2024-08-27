<?php 
require_once("../config/conexion.php");
require_once("../models/Usuario.php");
$usuario = new Usuario();

switch ($_GET["op"]) {
    case 'guardaryeditar':
        if (empty($_POST["user_id"])) {
            $usuario->insert_usuario($_POST["user_names"],$_POST["user_last_name"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["role_id"]);
        }else {
            $usuario->update_usuario($_POST["user_id"],$_POST["user_names"],$_POST["user_last_name"],$_POST["usu_correo"],$_POST["usu_pass"],$_POST["role_id"]);
        }
    break;
    case 'listarusuario':
        $datos = $usuario->get_usuario();
        $data = Array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["user_names"];
            $sub_array[] = $row["user_last_name"];
            $sub_array[] = $row["usu_correo"];
            $sub_array[] = $row["usu_pass"];
            if ($row["user_role"] == 1) {
                $sub_array[] = '<span class="label label-pill label-primary">Usuario</span>';
            } else {
                $sub_array[] = '<span class="label label-pill label-info">Soporte</span>';
            }
            $sub_array[] = '<button type="button" onClick="editar('.$row["user_id"].');" id="'.$row["user_id"].'" class="btn btn-inline btn-warning btn-sm ladda-ubtton"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar('.$row["user_id"].');" id="'.$row["user_id"].'" class="btn btn-inline btn-danger btn-sm ladda-ubtton"><div><i class="fa fa-trash"></i></div></button>';
            $data [] = $sub_array; 
        }
        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data);
        echo json_encode($results);
        
    break;
    case 'eliminar' :
        $usuario->delete_usuario($_POST["user_id"]);
    break;
    case "mostrarusuario";
            $datos=$usuario->get_usuario_x_id($_POST["user_id"]);
            if(is_array($datos)==true and count($datos)>0){
                foreach($datos as $row)
                {
                    $output["user_id"] = $row["user_id"];
                    $output["user_names"] = $row["user_names"];
                    $output["user_last_name"] = $row["user_last_name"];
                    $output["usu_correo"] = $row["usu_correo"];
                    $output["usu_pass"] = $row["usu_pass"];
                    $output["user_role"] = $row["user_role"];
                }
                echo json_encode($output);
            }
    break;
    case "total";
            $datos=$usuario->get_usuario_total_x_id($_POST["user_id"]);
                echo json_encode($datos);
    break;
    case "totalabiertos";
            $datos=$usuario->get_usuario_total_abiertos_x_id($_POST["user_id"]);
                echo json_encode($datos);
    break;
    case "totalcerrados";
    $datos=$usuario->get_usuario_total_cerrados_x_id($_POST["user_id"]);
        echo json_encode($datos);
    break;
    case 'combo_soporte':
        $datos = $usuario->get_usuario_x_rol_soporte();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "<option label ='Seleccionar'></option>";
            foreach ($datos as $row) {
                $html.= "<option value='".$row['user_id']."'>".$row['user_names']." ".$row['user_last_name']."</option>";
            }
            echo $html;
        }
    break;      
}
?>