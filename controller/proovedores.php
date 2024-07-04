<?php
require '../config.php';

require '../models/conexion.php';
require '../models/configuracion.php';
require '../models/helper.php';
require '../models/reservar.php';
require '../models/reservacion.php';
require '../models/proovedores.php';
require '../models/usuario.php';


$R = new Reservar();
$Rva = new Reservacion();
$Pro = new Proovedores();
$H = new Helper();
$U = new Usuario();
$Conf = new Configuracion();
$configuracion=$Conf->getConfiguracion();

$accion = (isset($_GET['accion']) && $_GET['accion'] != "") ? $_GET['accion'] : "default";
switch ($accion) {
    
    case "alta": 
        var_dump($_POST);
        $campos = array(
            "nombre",
            "contacto_nombre",
            "contacto_correo",
            "contacto_telefono",
            "contacto_direccion", 
            "fecha_registro"
        );

        $valores = array(
            $_POST['nombre'],
            $_POST['contacto_nombre'],
            $_POST['contacto_correo'],
            $_POST['contacto_telefono'],
            $_POST['contacto_direccion'], 
            date("Y-m-d H:i:s")
        );

        // print_r($campos);
        // print_r($valores);

        $R->setTabla("rsv_proovedores");
        $id=$R->insertar($campos, $valores);
        if ($id>0) { 
     

            $carpeta = DIRECTORIO .'/img/proovedores/';
            
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

                        
                        $newNameImg = 'proovedor_logo_' . $id . '.' . $extension; 
                        $destino = $carpeta . $newNameImg;

                            if (!move_uploaded_file($_FILES['img']['tmp_name'], $destino)) {
                                $H->crearMensaje("Error al subir la imagen", "error");
                                header("Location: ../?seccion=proovedores&accion=listar");
                                exit;
                            }else{
                                $camposImg = array("img");
                                $valoresImg = array($extension);
                                $Rva->setTabla("rsv_proovedores");
                                $condicion=" id>0 and id=".$id; 
                                if(!$Rva->actualizar($camposImg, $valoresImg, $condicion)){
                                  
                                    $H->crearMensaje("Ocurrió un error al subir la imagen", "warning");
                                    header("Location: ../?seccion=proovedores&accion=listar");
                                }
                            }

                    }else{
                        $H->crearMensaje("Tipo de imagen no valido.", "error");
                        header("Location: ../?seccion=proovedores&accion=listar");
                        exit;
                    } 
                    }
                }
                
                // echo 'Producto agregado correctamente';
                $H->crearMensaje("Producto agregado correctamente", "success");
                header("Location: ../?seccion=proovedores&accion=listar");
 
                exit;
            }else{
                $H->crearMensaje("Se desconoce la petición", "warning");
                header("Location: ../?seccion=proovedores&accion=listar");
                exit;
            }
    
    break;

    case "editar": 
         
        $id = $_POST['id'];
        $campos = array(
            "nombre",
            "contacto_nombre",
            "contacto_correo",
            "contacto_telefono",
            "contacto_direccion", 
            "fecha_update"
        );

        $valores = array(
            $_POST['nombre'],
            $_POST['contacto_nombre'],
            $_POST['contacto_correo'],
            $_POST['contacto_telefono'],
            $_POST['contacto_direccion'], 
            date("Y-m-d H:i:s")
        );

        $Pro->setTabla("rsv_proovedores");
        $condicion = "id>0 and id=".$id;



        if($Pro->actualizar($campos, $valores, $condicion)){


            $carpeta = DIRECTORIO .'/img/proovedores/';
            
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
        
                                $newNameImg = 'proovedor_logo_' . $id . '.' . $extension; 
                                $destino = $carpeta . $newNameImg;
        
                                    if (!move_uploaded_file($_FILES['img']['tmp_name'], $destino)) {
                                        $H->crearMensaje("Error al subir la imagen", "error");
                                        header("Location: ../?seccion=proovedores&accion=listar");
                                        exit;
                                    }else{
                                        $camposImg = array("img");
                                        $valoresImg = array($extension);
                                        $Pro->setTabla("rsv_proovedores");
                                        $condicion=" id>0 and id=".$id; 
                                        if(!$Pro->actualizar($camposImg, $valoresImg, $condicion)){
                                        
                                            $H->crearMensaje("Ocurrió un error al subir la imagen", "warning");
                                            header("Location: ../?seccion=proovedores&accion=listar");
                                            exit;
                                        }
                                    }
        
                            }else{
                                $H->crearMensaje("Tipo de imágen no válido.", "error");
                                header("Location: ../?seccion=proovedores&accion=listar");
                                exit;
                            } 
                        }
                    }
                     
                    $H->crearMensaje("Proovedor actualizado correctamente", "success");
                    header("Location: ../?seccion=proovedores&accion=listar");
                    exit;
        } //actualizar campos
        else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=proovedores&accion=listar");
            exit;
        }

    break;
  

    // proovedores

    case "alta_menu":
        var_dump($_POST);
        $campos = array(
            "nombre",
            "tipo",
            "costo",
            "descripcion",
            "proovedor",
            "fecha_registro"
        );

        $valores = array(
            $_POST['nombre'],
            $_POST['tipo'],
            $_POST['costo'],
            $_POST['descripcion'],
            $_POST['proovedor'],
            date("Y-m-d H:i:s")
        );

        $Pro->setTabla("rsv_menu");
        if($Pro->insertar($campos, $valores)){

            $H->crearMensaje("Menú agregado correctamente", "success");
            header("Location: ../?seccion=proovedores&accion=listarMenu&proovedor=".$_POST['proovedor']);
            exit;
        }else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=proovedores&accion=listarMenu&proovedor=".$_POST['proovedor']);
            exit;
        }
    break;

    case "editar_menu":
        var_dump($_POST); 
        $campos = array(
            "nombre",
            "tipo",
            "costo",
            "descripcion",
            "proovedor" 
        );

        $valores = array(
            $_POST['nombre'],
            $_POST['tipo'],
            $_POST['costo'],
            $_POST['descripcion'],
            $_POST['proovedor']
        );

        $Pro->setTabla("rsv_menu");
        $condicion ='id>0 AND id='.$_POST['menu'];
        if($Pro->actualizar($campos, $valores, $condicion)){

            $H->crearMensaje("Menú actualizado correctamente", "success");
            // header("Location: ../?seccion=proovedores&accion=editarMenu&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']);
            header("Location: ../?seccion=proovedores&accion=listarMenu&proovedor=".$_POST['proovedor']);
            exit;
        }else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=proovedores&accion=editarMenu&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']);
            exit;
        }
    break;

    case "alta_platillo": 
        // var_dump($_POST);
        $campos = array(
            "nombre",  
            "descripcion",  
            "menu",
            "proovedor" 
        );

        $valores = array(
            $_POST['nombre'], 
            $_POST['descripcion'], 
            $_POST['menu'], 
            $_POST['proovedor'] 
        );

        // print_r($campos);
        // print_r($valores);
        // exit;

        $Pro->setTabla("rsv_menu_platillos");
        $id=$Pro->insertar($campos, $valores);
        if ($id>0) { 
     

        $carpeta = DIRECTORIO .'/img/menu/proovedor_'.$_POST["proovedor"].'/';
            
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

                        $newNameImg = 'platillo_' . $id . '.' . $extension; //asignar nuevo nombre
                        $destino = $carpeta . $newNameImg;

                            if (!move_uploaded_file($_FILES['img']['tmp_name'], $destino)) {
                                $H->crearMensaje("Error al subir la imagen", "error");
                                header("Location: ../?seccion=proovedores&accion=listar");
                                exit;
                            }else{
                                $camposImg = array("img");
                                $valoresImg = array($extension);
                                $Rva->setTabla("rsv_menu_platillos");
                                $condicion=" id>0 and id=".$id; 
                                if(!$Rva->actualizar($camposImg, $valoresImg, $condicion)){
                                  
                                    $H->crearMensaje("Ocurrió un error al subir la imagen", "warning");
                                    header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']);
                                }
                            }

                    }else{
                        $H->crearMensaje("Tipo de imagen no valido.", "error");
                        header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']);
                        exit;
                    } 
                    }
                }
                
                // echo 'Producto agregado correctamente';
                $H->crearMensaje("Producto agregado correctamente", "success");
                header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']);
                exit;
            }else{
                $H->crearMensaje("Se desconoce la petición", "warning");                                   
                header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']);
                exit;
            }
    
    break;

    case "editar_platillo": 
 
        $id = $_POST['platillo'];
        $campos = array(
            "nombre",  
            "descripcion",  
        );

        $valores = array(
            $_POST['nombre'], 
            $_POST['descripcion']
        );

        $Pro->setTabla("rsv_menu_platillos");
        $condicion = "id>0 and id=".$id;



        if($Pro->actualizar($campos, $valores, $condicion)){


            $carpeta = DIRECTORIO .'/img/menu/proovedor_'.$_POST["proovedor"].'/';
            
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
         
                                $newNameImg = 'platillo_' . $id . '.' . $extension; //asignar nuevo nombre

                                $destino = $carpeta . $newNameImg;
        
                                    if (!move_uploaded_file($_FILES['img']['tmp_name'], $destino)) {
                                        $H->crearMensaje("Error al subir la imagen", "error");
                                        header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']); 
                                        exit;
                                    }else{
                                        $camposImg = array("img");
                                        $valoresImg = array($extension);
                                        $Pro->setTabla("rsv_menu_platillos");
                                        $condicion=" id>0 and id=".$id; 
                                        if(!$Pro->actualizar($camposImg, $valoresImg, $condicion)){
                                        
                                            $H->crearMensaje("Ocurrió un error al subir la imagen", "warning");
                                            header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']); 
                                        }
                                    }
        
                            }else{
                                $H->crearMensaje("Tipo de imágen no válido.", "error");
                                header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']); 
                                exit;
                            } 
                        }
                    } 
                    $H->crearMensaje("Platillo actualizado correctamente", "success");
                    header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_POST['proovedor']."&menu=".$_POST['menu']); 
                    exit;
        } //actualizar campos
        else{
            $H->crearMensaje("Se desconoce la petición", "warning");
            header("Location: ../?seccion=reservacion&accion=listaInventario");
            exit;
        }

    break;
    
    case "borrar_platillo":

        if (isset($_GET['platillo'])  && is_numeric($_GET['platillo'])) {
            // var_dump($_GET); 

            //     exit;
                $Pro->setTabla("rsv_menu_platillos");
                $condicion ='id>0 AND id='.$_GET['platillo'];
                if ($Pro->eliminar($condicion)) {
                    $H->crearMensaje("Platillo eliminado correctamente", "success");
                    header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_GET['proovedor']."&menu=".$_GET['menu']);
                    exit;
                }else{
                    $H->crearMensaje("No se pudo eliminar", "warning");
                    header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_GET['proovedor']."&menu=".$_GET['menu']);
                    exit;
                }
        } else{
            $H->crearMensaje("No se pudo eliminar", "warning");
            header("Location: ../?seccion=proovedores&accion=menuPlatillos&proovedor=".$_GET['proovedor']."&menu=".$_GET['menu']);
            exit;
        }
    break;

    default:
       $H->crearMensaje("No se conoce la petición", "warning");
        header("Location: ../reservaciones/");
    break;
}




    
?>

