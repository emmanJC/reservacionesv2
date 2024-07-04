<?php
require '../config.php';
if (!isset($_SESSION[AMBIENTE]['usuario'])) {
	if (  !(isset($_GET['accion']) && ($_GET['accion'] == "registropublico" || $_GET['accion'] == "login") ) ) {
		header("Location: ../signin.php");
		exit;
	}
}

require '../model/conexion.php';
require '../model/helper.php';
require '../model/usuario.php';

$U = new Usuario();
$H = new Helper();


$accion = (isset($_GET['accion']) && $_GET['accion'] != "") ? $_GET['accion'] : "default";
switch ($accion) {
	case "alta":
	if (!isset($_POST['activo'])) {
		$_POST['activo']=0;
	}
	if (!isset($_POST['super'])) {
		$_POST['super']=0;
	}
	$campos = array("nombre","apellidop","apellidom","email","password","fecha_inicio","fecha_fin","puesto_id","activo","registro","fecha_registro","superusuario");
	$valores = array($_POST['nombre'],$_POST['apellidop'],$_POST['apellidom'],$_POST['email'], $_POST['password'], $_POST['fecha_inicio'], $_POST['fecha_final'], $_POST['puesto'], $_POST['activo'], $_SESSION[AMBIENTE]['usuario']['id'], date("Y-m-d H:i:s"),$_POST['super']);
	$U->setTabla("usuarios");
	$usuario_id=$U->insertar($campos, $valores);
	if ($usuario_id>0) {
		$H->crearMensaje("Usuario registrado correctamente", "success");
		header("Location: ../?seccion=usuarios&accion=listar");
	}else{
		$H->crearMensaje("Se desconoce la petición", "warning");
		header("Location: ../?seccion=usuarios&accion=alta");
	}

	break;


	case "editar":
	if (!isset($_POST['activo'])) {
		$_POST['activo']=0;
	}
	if (!isset($_POST['super'])) {
		$_POST['super']=0;
	}
	$campos = array("nombre","apellidop","apellidom","email","password","fecha_inicio","fecha_fin","puesto_id","activo","registro","fecha_registro","superusuario");
	$valores = array($_POST['nombre'],$_POST['apellidop'],$_POST['apellidom'],$_POST['email'], $_POST['password'], $_POST['fecha_inicio'], $_POST['fecha_final'], $_POST['puesto'], $_POST['activo'], $_SESSION[AMBIENTE]['usuario']['id'], date("Y-m-d H:i:s"), $_POST['super']);
	$U->setTabla("usuarios");
	$condicion=" id>0 and id=".$_POST['usuario_id'];
	$usuario_id=$U->actualizar($campos, $valores, $condicion);
	if ($usuario_id>0) {
		$H->crearMensaje("Usuario actualizado correctamente", "success");
		header("Location: ../?seccion=usuarios&accion=editar&id=".$_POST['usuario_id']);
	}else{
		$H->crearMensaje("Se no se guardaron los cambios", "warning");
		header("Location: ../?seccion=usuarios&accion=editar&id=".$_POST['usuario_id']);
	}

	break;




	default:
	echo 'DEFAULT';
	break;
}
?>