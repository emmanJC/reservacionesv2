<?php
require '../config.php';

require '../models/conexion.php';
require '../models/configuracion.php';
require '../models/helper.php';
require '../models/evaluacion.php';
require '../models/solicitud.php';
require '../models/usuario.php';


$S = new Solicitud(); 
$E = new Evaluacion(); 
$H = new Helper();
$U = new Usuario();
$Conf = new Configuracion();
$configuracion=$Conf->getConfiguracion();

$accion = (isset($_GET['accion']) && $_GET['accion'] != "") ? $_GET['accion'] : "default";
switch ($accion) {
    
    case "alta":
        var_dump($_POST);
        $campos= array(
            "nombre",
            "puntaje",
            "orden",
            "estatus",
            "usuario_registro",
            "fecha_registro"
        );

        $valores = array(
            $_POST['nombre'], 
            $_POST['puntaje'], 
            $_POST['orden'], 
            1,
            $_POST['usuario'],
            date("Y-m-d H:i:s")
        );  

        $E->setTabla("rsv_evaluacion");
        $sala_id=$E->insertar($campos, $valores);
        if ($sala_id>0) {
            $H->crearMensaje("Evaluación agregada correctamente", "success");
            // header("Location: ../reservaciones/?seccion=eventos&accion=editar&id=".$evento_id);
            header("Location: ../?seccion=evaluacion&accion=listar");
        }else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=evaluacion&accion=listar");
        }

    
    break;
 
    default:
       $H->crearMensaje("No se conoce la petición", "warning");
        header("Location: ../reservaciones/");
    break;
}
?>