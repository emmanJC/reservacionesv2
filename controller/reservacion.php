<?php
require '../config.php';

require '../models/conexion.php';
require '../models/configuracion.php';
require '../models/helper.php';
//require '../models/reservar.php';
require '../models/reservacion.php';
require '../models/solicitud.php';
require '../models/usuario.php';

//$R = new Reservar();
$S = new Solicitud();
$Rva = new Reservacion();
$H = new Helper();
$U = new Usuario();
$Conf = new Configuracion();
$configuracion=$Conf->getConfiguracion();

$accion = (isset($_GET['accion']) && $_GET['accion'] != "") ? $_GET['accion'] : "default";
switch ($accion) {
    
    case "add_producto": 
        var_dump($_POST);
        $campos = array(
            "nombre",
            "cantidad",
            "tipo",
            "descripcion",
            "estatus",
            "fecha_registro"
        );

        $valores = array(
            $_POST['nombre'],
            $_POST['cantidad'],
            $_POST['tipo'],
            $_POST['descripcion'],
            1, 
            date("Y-m-d H:i:s")
        );

        // print_r($campos);
        // print_r($valores);

        $R->setTabla("rsv_inventario");
        $inventario=$R->insertar($campos, $valores);
        if ($inventario>0) { 
     

        $carpeta = DIRECTORIO .'/img/inventario/';
            
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0755, true);
        }

     
                if (isset($_FILES['img'])) {
                    
            
                    $archivo = $_FILES['img']['name'];
            
                    if (isset($archivo) && $archivo != "") {
                    $tipo = $_FILES['img']['type'];
                    $size = $_FILES['img']['size'];
                    $temp = $_FILES['img']['tmp_name'];
                    $nameImg = $_FILES['img']['name'];

                        
            
                    $tiposAceptados = array("image/jpeg", "image/jpg", "image/png");
                    if (in_array($tipo, $tiposAceptados)) {
                        $extension = pathinfo($nameImg, PATHINFO_EXTENSION); 
                        // echo $extension;

                        // Asigna un nombre único al archivo para evitar colisiones
                        $newNameImg = 'inventario_' . $inventario . '.' . $extension; 
                        $destino = $carpeta . $newNameImg;

                            if (!move_uploaded_file($_FILES['img']['tmp_name'], $destino)) {
                                $H->crearMensaje("Error al subir la imagen", "error");
                                header("Location: ../?seccion=reservacion&accion=listaInventario");
                                exit;
                            }else{
                                $camposImg = array("img");
                                $valoresImg = array($extension);
                                $Rva->setTabla("rsv_inventario");
                                $condicion=" id>0 and id=".$inventario; 
                                if(!$Rva->actualizar($camposImg, $valoresImg, $condicion)){
                                  
                                    $H->crearMensaje("Ocurrió un error al subir la imagen", "warning");
                                    header("Location: ../?seccion=reservacion&accion=listaInventario");
                                }
                            }

                    }else{
                        $H->crearMensaje("Tipo de imagen no valido.", "error");
                        header("Location: ../?seccion=reservacion&accion=listaInventario");
                        exit;
                    } 
                    }
                }
                
                // echo 'Producto agregado correctamente';
                $H->crearMensaje("Producto agregado correctamente", "success");
                header("Location: ../?seccion=reservacion&accion=listaInventario"); 
                exit;
            }else{
                $H->crearMensaje("Se desconoce la petición", "warning");
                header("Location: ../?seccion=reservacion&accion=listaInventario");
                exit;
            }
    
    break;

    case "edit_producto": 
        $id = $_POST['id'];
        $campos = array(
            "nombre",
            "cantidad",
            "tipo",
            "descripcion",
            "estatus",
            "fecha_update"
        );

        $valores = array(
            $_POST['nombre'],
            $_POST['cantidad'],
            $_POST['tipo'],
            $_POST['descripcion'],
            1, 
            date("Y-m-d H:i:s")
        );

        $Rva->setTabla("rsv_inventario");
        $condicion = "id>0 and id=".$id;



        if($Rva->actualizar($campos, $valores, $condicion)){


            $carpeta = DIRECTORIO .'/img/inventario/';
            
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0755, true);
            }
    
         
                    if (isset($_FILES['img'])) {
                        
                
                        $archivo = $_FILES['img']['name'];
                
                        if (isset($archivo) && $archivo != "") {
                            $tipo = $_FILES['img']['type'];
                            $size = $_FILES['img']['size'];
                            $temp = $_FILES['img']['tmp_name'];
                            $nameImg = $_FILES['img']['name'];
        
                                
                    
                            $tiposAceptados = array("image/jpeg", "image/jpg", "image/png");
                            if (in_array($tipo, $tiposAceptados)) {
                                $extension = pathinfo($nameImg, PATHINFO_EXTENSION); 
                                // echo $extension;
        
                                // Asigna un nombre único al archivo para evitar colisiones
                                $newNameImg = 'inventario_' . $id . '.' . $extension; 
                                $destino = $carpeta . $newNameImg;
        
                                    if (!move_uploaded_file($_FILES['img']['tmp_name'], $destino)) {
                                        $H->crearMensaje("Error al subir la imagen", "error");
                                        header("Location: ../?seccion=reservacion&accion=listaInventario");
                                        exit;
                                    }else{
                                        $camposImg = array("img");
                                        $valoresImg = array($extension);
                                        $Rva->setTabla("rsv_inventario");
                                        $condicion=" id>0 and id=".$id; 
                                        if(!$Rva->actualizar($camposImg, $valoresImg, $condicion)){
                                        
                                            $H->crearMensaje("Ocurrió un error al subir la imagen", "warning");
                                            header("Location: ../?seccion=reservacion&accion=listaInventario");
                                        }
                                    }
        
                            }else{
                                $H->crearMensaje("Tipo de imagen no valido.", "error");
                                header("Location: ../?seccion=reservacion&accion=listaInventario");
                                exit;
                            } 
                        }
                    }
                    
                    // echo 'Producto agregado correctamente';
                    $H->crearMensaje("Producto agregado correctamente", "success");
                    header("Location: ../?seccion=reservacion&accion=listaInventario"); 
                    exit;
        } //actualizar campos
        else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=reservacion&accion=listaInventario");
            exit;
        }

    break;

    case "borrar_producto": 
        $getID = base64_decode($_GET['id']);
        $getEstatus = base64_decode($_GET['estatus']);
        if($getEstatus==1){
            $estatus = 0;
        }
        $campos = array("estatus", "fecha_update");
        $valores = array($estatus, date("Y-m-d H:i:s"));
         
        $Rva->setTabla("rsv_inventario");
        $condicion=" id>0 and id=".$getID;  

        if($Rva->actualizar($campos, $valores, $condicion)){
            $H->crearMensaje("Producto eliminado correctamente", "success");
            header("Location: ../?seccion=reservacion&accion=listaInventario");
            exit;
        }else{
            $H->crearMensaje("No se pudo eliminar el producto", "warning");           
            header("Location: ../?seccion=reservacion&accion=listaInventario");
            exit;
        }
    break;

    case "confirmar_solicitud": 

        if (!isset($_POST['solicitud_id']) || empty($_POST['solicitud_id'])) {
            // Error, rediricionar a info de solicitud
            $H->crearMensaje("ID Faltante", "warning");
            header("Location: ../?seccion=reservacion&accion=listar");
            exit;
        }
        $notYes = 1;
        $getId = $_POST['solicitud_id']; 
        $solicitud = $S->getSolicitudIdXKey($getId);
        $usuario = $U->getUsuarioById($solicitud->id_usuario);
        $servicios = $solicitud->servicio == $notYes ? 'Si' : 'No' ;
        $sala = $S->getXsala($solicitud->sala);
        
        $Rva->setTabla("rsv_solicitud");
        $campos = array(
            "estatus",
            "fecha_actualizacion"
        );
        
        $valores = array(
            2,
            date("Y-m-d H:i:s")
        );

        $condicion = "id>0 and id=".$getId;
                
        if($Rva->actualizar($campos, $valores, $condicion)){
            
            if($H->enviarCorreoConfirmarReservacion($usuario, $solicitud, $sala, $servicio, $configuracion)){
                // echo 'Producto agregado correctamente';
                $H->crearMensaje("Solicitud Confirmado correctamente", "success");
                header("Location: ../?seccion=reservacion&accion=reserva&id=".$getId); 
                exit;
            }
            else{
                echo 'no se envio el correo cancelar solicitud, liberar horario cambiar estatus solicitud';
            }
   
        } //actualizar campos
        else{
            $H->crearMensaje("Error al confirmar solicitud", "warning");
            header("Location: ../?seccion=reservacion&accion=reserva&id=".$getId); 
            exit;
        }

    break;

    default:
       $H->crearMensaje("No se conoce la petición", "warning");
        header("Location: ../reservaciones/");
    break;
}
?>

