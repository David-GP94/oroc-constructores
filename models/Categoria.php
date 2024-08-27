<?php
class Categoria extends Conectar{
    public function get_categoria($selectCat) {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM category WHERE est = 1 AND dep_cat =".$selectCat;
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
} 
?>