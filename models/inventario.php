<?php
class Inventario extends Conexion {
    public function __construct() {
        parent::__construct();
        $this->setTabla("rsv_inventario");
    }
 
    public function getTipoProducto() {
        $sql = "SELECT * FROM rsv_inventario_tipo order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }  
    public function getInventario(){
        $sql = "SELECT i.*, ti.nombre as tipos FROM rsv_inventario AS i 
        INNER JOIN rsv_inventario_tipo AS ti 
        ON i.tipo = ti.id WHERE i.estatus = 1";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getInventarioXid($id){
        $sql = "SELECT i.*, ti.nombre as tipos FROM rsv_inventario AS i 
        INNER JOIN rsv_inventario_tipo AS ti 
        ON i.tipo = ti.id WHERE i.id=$id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }
}

?>