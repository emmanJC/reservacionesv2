<?php
class Salas extends Conexion {
    public function __construct() {
        parent::__construct();
        $this->setTabla("rsv_salas");
    }
    public function getSalas() {
        $sql = "SELECT * FROM rsv_salas  order by id ASC";
        $sentencia = $this->conexion_db->prepare($sql);
        $sentencia->execute(array());
        $resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }
	public function getUsuariosxRSVrol() {
		$sql = "SELECT id, nombre, apellidop, apellidom, rsv_rol FROM usuarios WHERE activo=1 and rsv_rol = 1  order by id";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	} 
    public function getUsuarioXsala($id) {
		$sql = "SELECT sala.admin, u.nombre, u.apellidop, u.apellidom
        FROM rsv_salas sala 
        LEFT JOIN usuarios u 
        ON sala.admin = u.id 
        WHERE sala.id=$id";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}
}

?>