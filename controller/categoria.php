<?php 
require_once("../config/conexion.php");
require_once("../models/Categoria.php");
$categoria = new Categoria();
$depCat = null;
$html = "";
switch ($_GET["op"]) {
    case 'combo':
        $selectCat = $_GET["selectCat"];
        $datos = $categoria->get_categoria($selectCat);
        if (is_array($datos) and count($datos) > 0) {
            $html = "<option>Seleccione...</option>";
            foreach ($datos as $row) {
                $html.="<option value= '".$row['cat_id']."'>".$row['cat_nom']."</option>";
            }
            echo $html;
        }
    break;    
}
?>