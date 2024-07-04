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
    
    case "rsv_sala":
        
        $campos= array(
            "hora_inicio",
            "hora_final",
            "id_sala",
            "fecha_reservada",
            "estatus",
            "fecha_registro"
        );

        $valores = array(
            $_POST['hora_inicio'],
            $_POST['hora_final'],
            $_POST['id_sala'],
            $_POST['fecha_reservada'],
            1,
            date("Y-m-d H:i:s")
        );
        // var_dump($_POST);
        // echo '<br>';echo '<br>';
        // var_dump($campos);
        // echo '<br>';
        // echo '<br>';
        // var_dump($valores);
        
        // header("Location: ../?seccion=solicitud&accion=solicitud&id=6");


        $S->setTabla("rsv_salas_reservadas");
        $sala_id=$S->insertar($campos, $valores);
        if ($sala_id>0) {
            $H->crearMensaje("Sala y horario reservado por 15 minutos, Por favor, finalice la solicitud", "success");
            // header("Location: ../reservaciones/?seccion=eventos&accion=editar&id=".$evento_id);
            header("Location: ../?seccion=solicitud&accion=alta&id=".$sala_id);
            // var_dump($sala_id);
        }else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=solicitud&accion=consultar&fecha=".$_POST['fecha_reservada']);
        }

    
    break;

    case "buscarSalas":
        echo gettype($_POST['fecha_evento']);
        var_dump($_POST);
        $fechaConsulta = $_POST['fecha_evento'];
        $todasSalas = $S->getSalasXdia($fechaConsulta);

        // // $evento=$E->getEventoById(base64_decode($_GET['evento']));
        // echo json_encode($todasSalas);
        // echo $todasSalas;
            echo '<br>';
        var_dump($todasSalas);
    break;

    case "consultarFecha":
        var_dump($_POST);
        // header("Location: ../reservaciones/?seccion=solicitud&accion=consultar&fecha=".$_POST['fecha_evento']);

    break;

    case "alta_solicitud":
       
        // var_dump($_POST);

        // break;
        // exit;
        // header("Location: ../reservaciones/?seccion=solicitud&accion=consultar&fecha=".$_POST['fecha_evento']);
        if (isset($_POST['equipo'])) {
            $_POST["equipo"]=1;
        }else{
            $_POST["equipo"]=0;
        }

        $servicios= array();
        $tipoServiciosPES = array();
        $tipoServiciosPro = array();
        $tipoServiciosOtro = array();

        if (isset($_POST['servicio_1'])) {
            $_POST["servicio_1"]=1;
            $servicios[]=  $_POST["servicio_1"];
            $tipoServiciosPES[] = 1;
        }
        if (isset($_POST['servicio_2'])) {
            $_POST["servicio_2"]=2;
            $servicios[]=  $_POST["servicio_2"];
            $tipoServiciosPES[] = 1;
        }
        if (isset($_POST['servicio_3'])) {
            $_POST["servicio_3"]=3;
            $servicios[]=  $_POST["servicio_3"];
            $tipoServiciosPES[] = 1;
        }
        if (isset($_POST['servicio_4'])) {
            $_POST["servicio_4"]=4;
            $servicios[]=  $_POST["servicio_4"];
            $tipoServiciosPES[] = 1;
        }
        if (isset($_POST['servicio_5'])) {
            $_POST["servicio_5"]=5;
            $servicios[]=  $_POST["servicio_5"];
            $tipoServiciosPro[] = 2;
        }
        if (isset($_POST['servicio_6'])) {
            $_POST["servicio_6"]=6;
            $servicios[]=  $_POST["servicio_6"];
            $tipoServiciosPro[] = 2;
        }
        if (isset($_POST['servicio_7'])) {
            $_POST["servicio_7"]=7;
            $servicios[]=  $_POST["servicio_7"];
            $tipoServiciosPro[] = 2;
        }
        if (isset($_POST['servicio_8']) && isset($_POST['servicio_id8']) ) {
            // $_POST["servicio_8"]=$_POST['servicio_id8'];
            $_POST["servicio_8"]=8;
            $servicios[]=  $_POST["servicio_8"];
            $tipoServiciosOtro[] = 3;
        }

        $servicio = 0;
        $tipoServicio = 0;

        if(!empty($servicios)){
            $servicio = 1;
            // var_dump($tipoServiciosPES);
            // echo '<br>';
            // var_dump($tipoServiciosPro);
            // echo '<br>';
            // var_dump($tipoServiciosOtro);

            if(!empty($tipoServiciosPES) && empty($tipoServiciosPro) && empty($tipoServiciosOtro)){
                $tipoServicio = 1;
            }
            else if(empty($tipoServiciosPES) && !empty($tipoServiciosPro) && empty($tipoServiciosOtro)){
                $tipoServicio = 2;

            } else if(empty($tipoServiciosPES) && empty($tipoServiciosPro) && !empty($tipoServiciosOtro)){
                $tipoServicio = 3;

            }else{
                $tipoServicio = 3;

            } 
            
        }

        
        $campos= array(
            "nombre",
            "sala",
            "fecha_evento",
            "hora_inicio",
            "hora_fin",
            "asistentes",
            // "area",
            "correo_solicitante",
            "id_usuario",
            "equipo",
            "servicio",
            "servicio_tipo",
            "start",
            "end",
            "color",
            "textColor",
            "id_reserva_sala",
            "fecha_solicitud",
            "estatus"
        );

        $valores = array(
            $_POST['nombre'],
            $_POST['sala'],
            $_POST['fecha_evento'],
            $_POST['hora_inicio'],
            $_POST['hora_fin'],
            $_POST['asistentes'],
            // $_POST['area'],
            $_POST['correo_solicitante'],
            $_POST['id_usuario'],
            $_POST['equipo'],
            $servicio,
            $tipoServicio,
            $_POST['start'],
            $_POST['end'],
            '#ff4242',
            '#FFFFFF',
            $_POST['id_reserva_sala'],
            date("Y-m-d H:i:s"),
            "1"
        );

        // echo count($servicios);
        // exit;
        // print_r($campos);
        //     echo '<br>';

        // print_r($valores);
        // exit;

        // //prueba correo
        
        // $usuario = $U->getUsuarioById($_POST['id_usuario']);
        // // var_dump($usuario);
        // $participante=1;
        // $solicitud = $S->getSolicitudXid(7);

        // $sala = $S->getXsala($_POST['sala']);
        
        
        // $H->enviarCorreoReservacion($usuario, $solicitud, $sala, $configuracion);
        // echo '<br>';echo '<br>';
        // var_dump($campos);
        // echo '<br>';
        // echo '<br>';
        // var_dump($valores);
 

       
        //// guardar datos

        //if servicios esta vacio solo insertar solicitud y enviar correo
        // si servicios no esta vacio, inserta solicitud y servicios, posterior enviar correo

        $S->setTabla("rsv_solicitud");

            if($sala_id=$S->insertar($campos, $valores)){
                //insertar si hay servicios
                $id_solicitud=$sala_id;
                if(!empty($servicios)){
                    echo 'CON SERVICIOS <br>';
        
                        $camposServicios = array (
                            "id_servicio",
                            "id_solicitud",
                            "descripcion",
                            "estatus",
                            "fecha_solicitud"
                        );
        
                    
                        
                        $descripcion="";
                        $i=0;
                        foreach($servicios as $id_servicio){
                            if($id_servicio == 8){
                                $descripcion= $_POST['servicio_id8'];
                            }
                            $valoresServicios = array(
                                $id_servicio,
                                $id_solicitud,
                                $descripcion,
                                0,
                                date("Y-m-d H:i:s")
                            );
        
                            $S->setTabla("rsv_solicitud_servicios");
                            $eachServicio=$S->insertar($camposServicios, $valoresServicios);
                            if(!$eachServicio){
                                $campos = array(
                                    'estatus'
                                );
                                $valores = array(
                                    0
                                );
                                $S->setTabla("rsv_salas_reservadas");
                                $condicion=" id>0 and id=".$_POST['id_reserva_sala'];
                                if($S->actualizar($campos, $valores, $condicion)){
                                    $H->crearMensaje("Ocurrió un error con la solicitud, se libero el horario", "warning");
                                    header("Location: ../?seccion=solicitud&accion=consultar");
                                    exit;
                                }
                                exit;
                            }
                        }   
                        echo 'enviar correo con servicios insertados correcto'; 
                        echo '<br>' .$servicio;
                        $usuario = $U->getUsuarioById($_POST['id_usuario']);
                        // var_dump($usuario); 
                        $solicitud = $S->getSolicitudXid($id_solicitud);

                        $sala = $S->getXsala($_POST['sala']);

                        if($H->enviarCorreoReservacion($usuario, $solicitud, $sala, $servicio, $configuracion)){
                            $H->crearMensaje("Solicitud enviada correctamente", "success");
                            header("Location: ../?seccion=solicitud&accion=listar");
                        }else{
                            echo 'no se envio el correo cancelar solicitud, liberar horario cambiar estatus solicitud';
                        }

                    }  
                    else{

                        echo '<br>se inserto solicitud y enviar solicitud sin servicios';
                        echo '<br>' .$servicio;
                        $usuario = $U->getUsuarioById($_POST['id_usuario']);
                        // var_dump($usuario); 
                        $solicitud = $S->getSolicitudXid($id_solicitud);

                        $sala = $S->getXsala($_POST['sala']);

                        if($H->enviarCorreoReservacion($usuario, $solicitud, $sala, $servicio, $configuracion)){
                            $H->crearMensaje("Solicitud enviada correctamente", "success");
                            header("Location: ../?seccion=solicitud&accion=listar");
                        }else{
                            echo 'no se envio el correo cancelar solicitud, liberar horario cambiar estatus solicitud';
                        }

                        
                    }
                     

            }else{
                //liberar horario
                echo 'error al insertar solicitud - liberar horario';
                $campos = array(
                    'estatus'
                );
                $valores = array(
                    0
                );
                $S->setTabla("rsv_salas_reservadas");
                $condicion=" id>0 and id=".$_POST['id_reserva_sala'];
                if($S->actualizar($campos, $valores, $condicion)){
                    $H->crearMensaje("Ocurrió un error con la solicitud, se libero el horario", "warning");
                    header("Location: ../?seccion=solicitud&accion=consultar");
                    exit;
                }
                else{
                    $H->crearMensaje("Se desconoce la petición", "warning");
                    header("Location: ../?seccion=solicitud&accion=consultar");
                }
            }


        exit;

        $S->setTabla("rsv_solicitud");

        if($sala_id=$S->insertar($campos, $valores)){

        
        

            if(!empty($servicios)){
            echo 'CON SERVICIOS <br>';

                $camposServicios = array (
                    "id_servicio",
                    "id_solicitud",
                    "descripcion",
                    "estatus",
                    "fecha_solicitud"
                );

            
                $id_solicitud=$sala_id;
                $descripcion="";
                foreach($servicios as $id_servicio){
                    if($id_servicio == 8){
                        $descripcion= $_POST['servicio_id8'];
                    }
                    $valoresServicios = array(
                        $id_servicio,
                        $id_solicitud,
                        $descripcion,
                        0,
                        date("Y-m-d H:i:s")
                    );

                    $S->setTabla("rsv_solicitud_servicios");
                    $eachServicio=$S->insertar($camposServicios, $valoresServicios);
                }

                if ($eachServicio>0) {
    //prueba correo
            
                $usuario = $U->getUsuarioById($_POST['id_usuario']);
                // var_dump($usuario);
                $participante=1;
                $solicitud = $S->getSolicitudXid($id_solicitud);

                $sala = $S->getXsala($_POST['sala']);

                $H->enviarCorreoReservacion($usuario, $solicitud, $sala, $configuracion);

                $H->crearMensaje("Solicitud enviada correctamente", "success");
                header("Location: ../?seccion=solicitud&accion=listar");
                }else{
                    $H->crearMensaje("Ocurrió un error al agregar servicios", "warning");
                    header("Location: ../?seccion=solicitud&accion=consultar&fecha=".$_POST['fecha_reservada']);
                }
            } else{
                 echo 'enviar solicitud sin servicios';
            }
        }
        else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=solicitud&accion=consultar&fecha=".$_POST['fecha_reservada']);
        }
        

 
    break;

    
    case "liberarHorarioSala":
        var_dump($_GET);
        echo 'liberar';

        $campos = array(
            'estatus'
        );
        $valores = array(
            0
        );
        $S->setTabla("rsv_salas_reservadas");
        $condicion=" id>0 and id=".$_GET['id'];
        echo $condicion;
        if($S->actualizar($campos, $valores, $condicion)){
            $H->crearMensaje("Solicitud cancelada correctamente", "success");
            header("Location: ../?seccion=solicitud&accion=consultar");
        }
        else{
            $H->crearMensaje("Ocurrió un error al cancelar la solicitud", "warning");
            header("Location: ../?seccion=solicitud&accion=consultar");
        }
    break;

    case "getEventosCalendario":
        // header('Content-Type: application/json');
        $eventos = $S->getEventosCalendario();
        echo $eventos;
        // var_dump($eventos);
    break;

    case "posiciones":
        // var_dump($_POST);
        // header("Location: ../reservaciones/?seccion=solicitud&accion=consultar&fecha=".$_POST['fecha_evento']);
        $posiciones = $S->getPosiciones();
        echo $posiciones;
    break;
    default:
       $H->crearMensaje("No se conoce la petición", "warning");
        header("Location: ../reservaciones/");
    break;
    }
?>