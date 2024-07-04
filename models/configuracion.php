<?php
class Configuracion extends Conexion {
    public function __construct() {
        parent::__construct();
        $this->setTabla("configuracion");
    }

     public function getConfiguracion() {
        $sql = "SELECT  *
        FROM configuracion 
        WHERE id=2 limit 1
        ";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }

}

?>