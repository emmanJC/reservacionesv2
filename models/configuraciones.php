<?php
class Configuraciones extends Conexion {
    public function __construct() {
        parent::__construct();
        $this->setTabla("avisos");
    }


    public function getConfiguracion() {
        $sql = "SELECT *
        FROM configuracion_afiliacion as c WHERE c.activo=1
        ";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getPlantillas() {
        $sql = "SELECT p.id,p.asunto,p.tipo_correo
        FROM plantillas_correos as p 
        ";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getPlantillaById($id) {
        $sql = "SELECT *
        FROM plantillas_correos as p WHERE p.id=$id
        ";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

}

?>