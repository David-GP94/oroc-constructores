<?php
    session_start();
    class Conectar{
        protected $dbh;
        protected function Conexion () {
            try {
               $conectar = $this->dbh = new PDO('mysql:host=localhost;dbname=u216531_nomina', 'root', '');
                return $conectar;
            
            } catch (PDOException $e) {
                print "¡Error BD! :" . $e->getMessage() . "<br/>";
                die();
                //throw $th;
            }
        }
        public function set_names(){
            return $this->dbh->query("SET NAMES 'utf8'");
        }
        public function ruta () {
            return "http://localhost/oroc-constructores/";
        }
    }


?>