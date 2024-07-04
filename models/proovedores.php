<?php
class Proovedores extends Conexion {
    public function __construct() {
        parent::__construct();
        $this->setTabla("rsv_inventario");
    }

    public function getProovedores() {
        $sql = "SELECT * FROM rsv_proovedores order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }  
    public function getProovedorXid($id) {
        $sql = "SELECT * FROM rsv_proovedores WHERE id = $id order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }  
     
    public function getTiposMenu() {
        $sql = "SELECT * FROM rsv_menu_tipo order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }  
    public function getMenuXid($id) {
        $sql = "SELECT * FROM rsv_menu WHERE id=$id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }  
    public function getCountMenuXproovedor($id) {
        $sql = "SELECT COUNT(id) as cantidad FROM rsv_menu WHERE proovedor=$id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    } 
    public function getListMenu($id){
        $sql = "SELECT m.*, ti.nombre as tipos FROM rsv_menu m 
            INNER JOIN rsv_menu_tipo ti ON m.tipo = ti.id 
            WHERE proovedor = $id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
    public function getPlatilloXmenu($id, $menu) {
        $sql = "SELECT * FROM rsv_menu_platillos WHERE proovedor = $id AND menu = $menu order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    } 
    public function getPlatilloXid($id) {
        $sql = "SELECT * FROM rsv_menu_platillos WHERE id=$id";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }  
    public function getCantidadPlatillos($proovedor, $menu) {
        $sql = "SELECT COUNT(id) as cantidad FROM rsv_menu_platillos WHERE proovedor=$proovedor AND menu = $menu";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetch(PDO::FETCH_OBJ);
        return $resultado;
    }  
}

?>