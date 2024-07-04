<?php
require '../config.php';

require '../models/conexion.php';
require '../models/configuracion.php';
require '../models/helper.php'; 
require '../models/solicitud.php';
require '../models/usuario.php';


$S = new Solicitud();  
$H = new Helper();
$U = new Usuario();
$Conf = new Configuracion();
$configuracion=$Conf->getConfiguracion();

$accion = (isset($_GET['accion']) && $_GET['accion'] != "") ? $_GET['accion'] : "default";
switch ($accion) {
    
     
 
    case "editar":  
        var_dump($_POST);
        exit;
        $campos= array(
            "nombre",
            "puntaje",
            "orden",
            "estatus",
            "usuario_update",
            "fecha_update"
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
        $condicion=" id>0 and id=".$_POST['id'];  

        if($E->actualizar($campos, $valores, $condicion)){
            $H->crearMensaje("Evaluación actualizada correctamente.", "success");
            header("Location: ../?seccion=evaluacion&accion=listar");
            exit;
        }else{
            $H->crearMensaje("Ocurrió un error, la evaluación no fue actualizada.", "warning");           
            header("Location: ../?seccion=evaluacion&accion=listar");
            exit;
        }

    
    break;
    
    case "alta_pregunta": 
        $campos= array(
            "nombre", 
            "orden",
            "estatus",
            "evaluacion",
            "usuario_registro",
            "fecha_registro"
        );

        $valores = array(
            $_POST['nombre'],   
            $_POST['orden'], 
            1,
            $_POST['evaluacion'],
            $_POST['usuario'],
            date("Y-m-d H:i:s")
        );  

        $E->setTabla("rsv_evaluacion_preguntas");
        $id=$E->insertar($campos, $valores);
        if ($id>0) {
            $H->crearMensaje("Pregunta agregada correctamente", "success");
            // header("Location: ../reservaciones/?seccion=eventos&accion=editar&id=".$evento_id);
            header("Location: ../?seccion=evaluacion&accion=listarPreguntas&evaluacion=".$_POST['evaluacion']);
        }else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=evaluacion&accion=listarPreguntas&evaluacion=".$_POST['evaluacion']);
        }

    
    break;

    case "editar_pregunta": 
        $campos= array(
            "nombre", 
            "orden", 
            "usuario_update",
            "fecha_update"
        );

        $valores = array(
            $_POST['nombre'],  
            $_POST['orden'],  
            $_POST['usuario'],
            date("Y-m-d H:i:s")
        );  

        $E->setTabla("rsv_evaluacion_preguntas");
        $condicion=" id>0 and id=".$_POST['id'];  

        if($E->actualizar($campos, $valores, $condicion)){
            $H->crearMensaje("Pregunta actualizada correctamente", "success");
            header("Location: ../?seccion=evaluacion&accion=listarPreguntas&evaluacion=".$_POST['evaluacion']);
            exit;
        }else{
            $H->crearMensaje("Ocurrió un error, la pregunta no fue actualizada.", "warning");                   
            header("Location: ../?seccion=evaluacion&accion=listarPreguntas&evaluacion=".$_POST['evaluacion']);
            exit;
        }

    
    break;

    default:
       $H->crearMensaje("No se conoce la petición", "warning");
        header("Location: ../reservaciones/");
    break;
}
?>