<?php
class Usuario extends Conexion {
	public function __construct() {
		parent::__construct();
		$this->setTabla("usuarios");
	}

	public function loginSinRol($email, $password) {
		$sql = "SELECT count(id) as registrado, nombre, apellidop, apellidom, id FROM usuarios WHERE email=:email AND password=:password AND activo=1 ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->bindParam(':email', $email);
		$sentencia->bindParam(':password', $password);
		$sentencia->execute();
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}
// roles de usuario
	public function login($email, $password) {
		$sql = "SELECT count(id) as registrado, nombre, apellidop, apellidom, id, rsv_rol FROM usuarios WHERE email=:email AND password=:password AND activo=1 ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->bindParam(':email', $email);
		$sentencia->bindParam(':password', $password);
		$sentencia->execute();
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}
	// si para cargar datos de usuario
	public function load($usuario, $rol=null) {
		 $sql = "SELECT   u.id, u.nombre, u.apellidop, u.apellidom, u.email, u.password, u.fecha_inicio, u.fecha_fin, u.activo,  u.registro, u.fecha_registro, u.actualizado, p.puesto,p.className, u.puesto_id, u.superusuario, u.rsv_rol
		FROM usuarios as u 
		INNER JOIN puestos as p on p.id=u.puesto_id
		WHERE u.id=".$usuario." limit 1
		";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
		return $resultado;

	}




	public function getUsuarios() {
		$sql = "SELECT   u.id, u.nombre, u.apellidop, u.apellidom, u.email, u.password, u.fecha_inicio, u.fecha_fin, u.activo,  u.registro, u.fecha_registro, u.actualizado, p.puesto
		FROM usuarios as u 
		INNER JOIN puestos as p on p.id=u.puesto_id 
		ORDER BY u.nombre asc, u.apellidop asc, u.apellidom asc
		";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}
	public function getUsuarioById($id) {
		$sql = "SELECT   u.id, u.nombre, u.apellidop, u.apellidom, u.email, u.password, u.fecha_inicio, u.fecha_fin, u.activo,  u.registro, u.fecha_registro, u.actualizado, p.puesto, u.puesto_id, u.superusuario
		FROM usuarios as u 
		INNER JOIN puestos as p on p.id=u.puesto_id
		WHERE u.id=".$id." limit 1
		";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getSuperAdminUsuarioByID($id_usuario) {
		$sql = "SELECT count(r.id) as permisoSuperAdmin, u_rol.rol_id, u_rol.usuario_id, r.rol FROM usuarios as u LEFT JOIN usuario_rol as u_rol ON u.id = u_rol.usuario_id INNER JOIN roles as r ON r.id = u_rol.rol_id WHERE u.id = ".$id_usuario." AND r.id = 1";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getRolUsuarioByID($id_usuario) {
		$sql = "SELECT u_rol.rol_id, u_rol.usuario_id, r.rol FROM usuarios as u LEFT JOIN usuario_rol as u_rol ON u.id = u_rol.usuario_id INNER JOIN roles as r ON r.id = u_rol.rol_id WHERE u.id = ".$id_usuario." AND r.id != 1";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getSeccionesRolByID($id_rol) {
		$sql = "SELECT sec.seccion FROM roles as r INNER JOIN seccion_rol as sec_rol ON sec_rol.rol_id = r.id INNER JOIN secciones as sec ON sec.id = sec_rol.seccion_id WHERE r.id = ".$id_rol;
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}
	public function getUsuariosActivosAll($id) {
		$sql = "SELECT * FROM usuarios WHERE activo=1 and id != $id order by email";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}



}

?>