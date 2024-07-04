<?php
require '../config.php';
if (!isset($_SESSION[AMBIENTE]['usuario']) && !isset($_SESSION[AMBIENTE]['participante'])) {
    header("Location: ../");
    exit;
}

require './models/conexion.php';
require './models/factura.php';
require './models/participante.php';
require './models/comprobante.php';
require './models/helper.php';
require './models/configuracion.php';
require './models/evento.php';

if (isset($_GET['accion'])) {
    $E = new Evento();
    $F = new Factura();
    $H = new Helper();
    $P = new Participante();
    $C = new Comprobante();
    $Con = new Configuracion();
    $configuracion=$Con->getConfiguracion();


    if ($_GET['accion'] == "guardar" && isset($_POST['participante'])) {


        if (!$_POST['total_conceptos'] > 0) {
            $H->crearMensaje("Por favor agrega por lo menos un concepto", "danger");
            header("Location: ../administracion/?seccion=facturas&accion=nuevo&comprobante=".$_POST["comprobante"]."&evento=".$_POST["evento"]."&participante=".$_POST["participante"]);
            exit;
        }

        if (!isset($_POST['forma_pago']) || $_POST['forma_pago'] == "") {
            $H->crearMensaje("Por favor selecciona una forma de pago", "danger");
            header("Location: ../administracion/?seccion=facturas&accion=nuevo&comprobante=".$_POST["comprobante"]."&evento=".$_POST["evento"]."&participante=".$_POST["participante"]);
            exit;
        }
        if (!isset($_POST['metodo_pago']) || $_POST['metodo_pago'] == "") {
            $H->crearMensaje("Por favor selecciona un metodo de pago", "danger");
             header("Location: ../administracion/?seccion=facturas&accion=nuevo&comprobante=".$_POST["comprobante"]."&evento=".$_POST["evento"]."&participante=".$_POST["participante"]);
            exit;
        }

        if (!isset($_POST['total']) || $_POST['total'] < 0.01) {
            $H->crearMensaje("No puedes generar facturas con costo 0", "danger");
             header("Location: ../administracion/?seccion=facturas&accion=nuevo&comprobante=".$_POST["comprobante"]."&evento=".$_POST["evento"]."&participante=".$_POST["participante"]);
            exit;
        }

        $fecha = date("Y-m-d H:i:s");
        $nuevafecha = strtotime('-5 minute', strtotime($fecha));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        if ($F->existeReciente($_POST['participante'], $_SESSION[AMBIENTE]['usuario']['id'], $nuevafecha)->existe) {
            $H->crearMensaje("Factura duplicada, verifica en ultimas facturas o espera 5 minutos para poder generar una nueva factura", "info");
            header("Location: ../administracion/?seccion=facturas&accion=nuevo&comprobante=".$_POST["comprobante"]."&evento=".$_POST["evento"]."&participante=".$_POST["participante"]);

            exit;
        }


        $campos = array("serie", "participante_id", "fecha_hora", "estatus", "uso_cfdi", "metodo_pago", "forma_pago", "subtotal", "moneda", "total", "iva", "descuento", "usuario_id");

        $valores = array($configuracion->serie, $_POST['participante'], date("Y-m-d H:i:s"), 1, $_POST['uso_cfdi'], $_POST['metodo_pago'], $_POST['forma_pago'], $_POST['subtotal'], "MXN", $_POST['total'], $_POST['iva'], $_POST['descuento'], $_SESSION[AMBIENTE]['usuario']['id']);

        $nunmFactura = $F->insertar($campos, $valores);
        if (is_numeric($nunmFactura) && $nunmFactura > 0) {
            $F->setTabla("detalles_factura");

            for ($i = 1; $i <= $_POST['maximo_conceptos']; $i++) {
                if (isset($_POST['producto_' . $i])) {

                    $campos = array("factura_id", "descripcion", "clvunidad", "clvprodserv", "cantidad", "unidad", "valorunitario", "importe", "descuento", "iva", "producto_id","obj_impuesto");

                    $valores = array($nunmFactura, $_POST['descripcion_' . $i], $_POST['clvunidad_' . $i], $_POST['clvprodserv_' . $i], $_POST['cantidad_' . $i], $_POST['unidad_' . $i], $_POST['precio_' . $i], $_POST['importe_' . $i], $_POST['descuento_' . $i], $_POST['iva_' . $i], $_POST['producto_' . $i],  $_POST['obj_impuesto_' . $i]);
                    $F->insertar($campos, $valores);
                }
            }
        }

        if (is_numeric($nunmFactura)) {

           

            $valores = array(
            "estatus",
            "autorizo",
            "fecha_autorizado",
            "factura"
            );

            $campos = array(
            "Autorizado",
            $_SESSION[AMBIENTE]['usuario']['id'],
            date("Y-m-d H:i:s"),
            $nunmFactura
            );
            $condicion=" id>0 and id=".$_POST['comprobante'];
            $C->setTabla("comprobantes");
            $C->actualizar($valores, $campos, $condicion);

            $evento=$E->getEventoById($_POST['evento']);
            $participante = $P->getParticipanteById($_POST["participante"]);

            if (isset($_POST["liberar_registro"]) && $_POST["liberar_registro"]==1) {
              
                $valores = array(
                "estatus",
                "autorizo",
                "fecha_liberado",
                "factura"
                );

                $campos = array(
                "ACEPTADO",
                $_SESSION[AMBIENTE]['usuario']['id'],
                date("Y-m-d H:i:s"),
                $nunmFactura
                );
                $condicion=" id>0 and id=".$_POST["participante"];
                $P->setTabla("participantes");
                $P->actualizar($valores, $campos, $condicion);
                $H->enviarCorreoAceptacion($participante, $evento, $configuracion);
            }   

            $H->enviarCorreoAvisoFacturar($participante, $evento, $configuracion);

            $H->crearMensaje("Comprobante validado, se ha enviado correo al participante para generar su factura", "success");
            header("Location: ../administracion/?seccion=comprobantes&accion=listar&evento=".$_POST["evento"]."&participante=".$_POST["participante"]);
            exit;
        } else {
            header("Location: ../administracion/?seccion=facturas&accion=nuevo&comprobante=".$_POST["comprobante"]."&evento=".$_POST["evento"]."&participante=".$_POST["participante"]);
            exit;
        }

    } elseif ($_GET['accion'] == "download" && isset($_GET['archivo']) && isset($_GET['id'])) {
        $nombrearchivo = $configuracion->rfc . $configuracion->serie . str_pad($_GET['id'], 5, "0", STR_PAD_LEFT) . "." . $_GET['archivo'];
        $fullPath = "../cfd/" . $_GET['archivo'] . "/" . $nombrearchivo;

        if ($fd = fopen($fullPath, "r")) {
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            header("Content-type: application/" . $_GET['archivo']);
            header('Content-Disposition: attachment; filename="' . $nombrearchivo . '"');
            header("Content-length: " . $fsize);
            header("Cache-control: private");
            while (!feof($fd)) {
                $buffer = fread($fd, 2048);
                echo $buffer;
            }
        } else {
            echo "El archivo " . $_GET['archivo'] . " aun no se ha generado";
        }
        fclose($fd);
        exit;
    } elseif ($_GET['accion'] == "enviar" && isset($_GET['id'])) {
        $archivo_xml = "../cfd/xml/" . $configuracion->rfc . $configuracion->serie . str_pad($_GET['id'], 5, "0", STR_PAD_LEFT) . "." . "xml";
        $archivo_pdf = "../cfd/pdf/" . $configuracion->rfc . $configuracion->serie . str_pad($_GET['id'], 5, "0", STR_PAD_LEFT) . "." . "pdf";
        $participante = $P->load($_GET['participante']);
        $evento=$E->getEventoById($participante->evento_id);
        $H->enviarFactura($configuracion->serie . str_pad($_GET['id'], 5, "0", STR_PAD_LEFT), $participante->cont_email, $participante->fact_razon_social, $archivo_pdf, $archivo_xml,$configuracion, $evento);
        if (isset($_GET['exit'])) {
            echo '<br><br>';
            echo '<center><h3>Factura enviada por correo correctamente</h3></center>';
            exit;
        }
        $H->crearMensaje("Factura enviada por correo correctamente", "success");
        if($_GET['redirec']=='admin'){
			header("Location: ../administracion/?seccion=facturas&accion=detalles&id=" . $_GET['id']);
		}else{
			header("Location: ../?evento=" . $_GET['redirec']."&generarfactura&id=".base64_encode($_GET['id']));
		}
        exit;
    } else {
        $H->crearMensaje("No se guardaron los cambios", "danger");
        header("Location: ../?seccion=lab_facturas&accion=consultar");
        exit;
    }
}

?>