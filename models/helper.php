<?php
class Helper extends Conexion {
	public function __construct() {
		parent::__construct();
	}

	public function crearMensaje($mensaje, $clase) {
		$_SESSION[AMBIENTE]['mensaje']['texto'] = $mensaje;
		$_SESSION[AMBIENTE]['mensaje']['clase'] = $clase;
	}


	public function enviarCorreoReservacion($usuario, $solicitud, $sala, $servicio, $configuracion) {

		// echo '<br>llegue a enviarCorreoReservacion<br><br>';
        // var_dump($solicitud);
		// echo '<br> <br>';
        // var_dump($usuario);
		$fecha=$this->formatearFecha($solicitud->fecha_solicitud);
		$fecha_evento = $this->formatearFecha($solicitud->fecha_evento);
		$sistema_url = '';
		if($servicio){
			$servicios = 'con servicios';
		}else{
			$servicios = 'sin servicios';
		}
		// echo '<br> <br>'.$solicitud->fecha_solicitud;
		// echo '<br> <br>'.$solicitud->estatus;
		// echo '<br> <br>'.$usuario->email;
		// echo '<br> <br>'.$fecha;

		$asunto = 'Solicitud de reservación de sala o auditorio';
		// $mensaje = 'Solicito de su apoyo con la reserva de una sala el día de y servicios para num personas.';
		$mensaje = '
		Solicito de su apoyo con la reserva de ' .$sala->nombre.' 
		para el evento <strong>"'.$solicitud->nombre.'"</strong> 
		el día '.$fecha_evento.' en un horario de '.$solicitud->hora_inicio.' a '.$solicitud->hora_fin.'
		y '.$servicios. '  para '.$solicitud->asistentes.' personas.';
		$mensaje .= '<br><br><strong>Ingresar a la liga para dar continuidad a la solicitud:<br> <a href="' . $sistema_url . '" >  Ver solicitud </a><br>';
		// echo '<br> <br>'.$fecha;
		// $evento->correo_recordatorio = str_replace("{{FECHA_REGISTRO}}", $fecha, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{FOLIO}}", $participante->folio, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{NOMBRE_PARTICIPANTE}}", $participante->titulo." ".$participante->nombre." ".$participante->apellidop." ".$participante->apellidom, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{EMAIL_PARTICIPANTE}}", $participante->email, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{EMPRESA_PARTICIPANTE}}", $participante->empresa, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{NOMBRE_CONSTANCIA}}", $participante->nombreconstancia, $evento->correo_recordatorio);
		
		// return $this->CrearEmailSB($participante->email, $evento->correo_recordatorio, $evento->asunto_recordatorio, $evento, $configuracion, null,  null, $participante->cont_email);
		return $this->CrearEmailSB($usuario->email, $mensaje, $asunto, $usuario,  $configuracion, null,  null, $solicitud->correo_solicitante);
		// die();
	}

	public function enviarCorreoConfirmarReservacion($usuario, $solicitud, $sala, $servicio, $configuracion) {

		$fecha=$this->formatearFecha($solicitud->fecha_solicitud);
		$fecha_evento = $this->formatearFecha($solicitud->fecha_evento);
		$sistema_url = '';
		if($servicio){
			$servicios = 'con servicios';
		}else{
			$servicios = 'sin servicios';
		}
		$asunto = 'Confirmación de Solicitud de reservación de sala o auditorio';
		// $mensaje = 'Solicito de su apoyo con la reserva de una sala el día de y servicios para num personas.';
		$mensaje = '
		Se confirma la solicitud de ' .$sala->nombre.' 
		para el evento <strong>"'.$solicitud->nombre.'"</strong> 
		el día '.$fecha_evento.' en un horario de '.$solicitud->hora_inicio.' a '.$solicitud->hora_fin.'
		y '.$servicios. '  para '.$solicitud->asistentes.' personas. La solicitud procedera a la siguiente etapa.';
		$mensaje .= '<br><br><strong>Ingresar a la liga para dar continuidad a la solicitud:<br> <a href="' . $sistema_url . '" >  Ver solicitud </a><br>';
		// echo '<br> <br>'.$fecha;
		// $evento->correo_recordatorio = str_replace("{{FECHA_REGISTRO}}", $fecha, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{FOLIO}}", $participante->folio, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{NOMBRE_PARTICIPANTE}}", $participante->titulo." ".$participante->nombre." ".$participante->apellidop." ".$participante->apellidom, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{EMAIL_PARTICIPANTE}}", $participante->email, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{EMPRESA_PARTICIPANTE}}", $participante->empresa, $evento->correo_recordatorio);
		// $evento->correo_recordatorio = str_replace("{{NOMBRE_CONSTANCIA}}", $participante->nombreconstancia, $evento->correo_recordatorio);
		
		// return $this->CrearEmailSB($participante->email, $evento->correo_recordatorio, $evento->asunto_recordatorio, $evento, $configuracion, null,  null, $participante->cont_email);
		return $this->CrearEmailSB($usuario->email, $mensaje, $asunto, $usuario,  $configuracion, null,  null, $solicitud->correo_solicitante);
		// die();
	}


	/* verficar que nos funciona */
	public function enviarPassword($email, $password, $nombre) {
		$asunto = "Recuperación de contraseña";
		$mensaje = '
		<tr>
		<td  align="justify" style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		Estimado(a) ' . $nombre . '
		<br>
		<br>A continuación se muestran sus datos de acceso para ingresar al sistema:<br>
		</td>
		</tr>
		<tr>
		<td height="15"></td>
		</tr>
		<tr>
		<td  style="color: #a4a4a4; line-height: 25px; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		<strong>Correo: </strong>' . $email . '<br>
		<strong>Contraseña: </strong>' . $password . '<br>
		</td>
		</tr>
		<tr>
		<td  style="color: #a4a4a4; line-height: 25px; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		<strong>Sistema: <a href="' . sistema_url . '" >' . sistema_url . '</a><br>
		</td>
		</tr>
		';
		return $this->enviarMail($email, $mensaje, $asunto);
	}
	public function correoSolicitudFinalizada($conficuraciones) {
		$asunto = "Hay una nueva solicitud completa";
		$mensaje = '
		<tr>
		<td  align="justify" style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		Un laboratorio ya termino su registro y subio su solicitud  
		</tr>
		';
		return $this->CrearEmailSimple("contacto@canifarma.org.mx", $mensaje, $asunto,$conficuraciones,null,null);
	}


	public function correoDinamico($participante,$configuraciones,$correo) {

		$correo[0]->plantilla = str_replace("{{RAZON_SOCIAL}}", $participante->razon_social, $correo[0]->plantilla);
		$correo[0]->plantilla = str_replace("{{EMAIL}}", $participante->email, $correo[0]->plantilla);
		$correo[0]->plantilla = str_replace("{{TOKEN}}", $participante->token, $correo[0]->plantilla);
		$correo[0]->plantilla = str_replace("{{NUM_AFILIACION}}", $participante->numAfiliacion, $correo[0]->plantilla);
		return $this->CrearEmailSimple($participante->email, $correo[0]->plantilla, $correo[0]->asunto, $configuraciones, null,$participante->correo);

	}
	




	public function newPay($conficuraciones,$data) {
		
		$asunto = "Se realizo un nuevo pago";
		$mensaje = '
		<tr>
		<td  align="justify" style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		<b>'.$data["usuario"].'</b> realizo un nuevo pago <br/><br/>
		Concepto :<b></b> '.$data["concepto"].'</b><br/>
		</tr>
		';
		return $this->CrearEmailSimple("jesus@jc-innovation.com", $mensaje, $asunto,$conficuraciones,null,null);
	}










	public function enviarFactura($factura, $email, $nombre, $pdf, $xml,$configuracion, $evento) {
		$asunto = "Factura numero " . $factura;
		$mensaje = '
		<tr>
		<td  align="justify" style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		Estimado Cliente  ' . $nombre . '
		<br>
		<br>Por este medio le hacemos llegar su Factura numero ' . $factura . '<br>
		</td>
		</tr>
		<tr>
		<td height="15"></td>
		</tr>
		<tr>
		<td  style="color: #a4a4a4; line-height: 25px; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		<p>Adjunto a este correo electronico, le estamos enviando un archivo con
		extension XML el cual es su factura electronica conforme a la normatividad
		del SAT.</p>
		<p>Adicionalmente, le estamos enviando un archivo con extension PDF el cual es
		una version legible del archivo XML. Dicho archivo lo puede ud. imprimir
		cuantas veces lo requiera.</p>
		<p>Necesita tener instalado Adobe Acrobat Reader en su computadora para ver los
		documentos en formato PDF. Puede descargarlo <a href="http://get.adobe.com/es/reader/">aqui</a>.<p>
		<p>Para mayor informacion sobre facturacion electronica, consultar en la Pagina
		del <a href="http://www.sat.gob.mx">SAT</a>.</p>
		<p>
		</td>
		</tr>
		';
		return $this->enviarMailFactura($email, $mensaje, $asunto, $pdf, $xml,$configuracion, $evento);
	}

    //se agrego para configurar el correo para enviar la constancia por usuario
    
    public function enviarConstancia($asunto_constancia, $email_receptor, $nombre, $archivo_adjunto,  $configuracion, $evento) {
    	$asunto = $asunto_constancia;
    	$evento->cons_correo_constancia = str_replace("{{NOMBRE_ASISTENTE}}", $nombre, $evento->cons_correo_constancia);
    	$contenido_html = $evento->cons_correo_constancia;
    	$nombre_archivo = basename($archivo_adjunto);
    	
    	return $this->CrearEmailSB($email_receptor, $contenido_html, $asunto, $evento, $configuracion, $archivo_adjunto, $nombre_archivo, null);
    }

 //se agrego para configurar el correo para enviar la invitacion para descargar constancia por usuario
    
//  public function enviarInvitacionConstancia($asunto_constancia, $email_receptor, $nombre,  $configuracion, $evento) {
// 	$asunto = $asunto_constancia;
// 	$evento->cons_correo_invitacion = str_replace("{{NOMBRE_ASISTENTE}}", $nombre, $evento->cons_correo_invitacion);
// 	$contenido_html = $evento->cons_correo_invitacion;
// 	$nombre_archivo = basename($archivo_adjunto);
	
// 	return $this->CrearEmailSB($email_receptor, $contenido_html, $asunto, $evento, $configuracion, null, null, null);
// }

public function enviarInvitacionConstancia($constancia, $evento, $configuracion) {
	$asunto = $evento->cons_asunto_invitacion;
	$evento->cons_correo_invitacion = str_replace("{{NOMBRE_ASISTENTE}}", $constancia->nombre, $evento->cons_correo_invitacion);
	$contenido_html = $evento->cons_correo_invitacion;
	// $nombre_archivo = basename($archivo_adjunto);

	return $this->CrearEmailSB($constancia->email, $contenido_html, $asunto, $evento, $configuracion, null, null, null);

}

public function enviarConstancias($participante, $evento, $configuracion) {

	$asunto = $evento->cons_correo_constancia;
	$evento->cons_correo_constancia = str_replace("{{NOMBRE_ASISTENTE}}", $nombre, $evento->cons_correo_constancia);
    $contenido_html = $evento->cons_correo_constancia;
	
	return $this->CrearEmailSB($email_receptor, $contenido_html, $asunto, $evento, $configuracion, null, null, null);
	// return $this->CrearEmailSB($participante->email, $evento->correo_aceptacion, $evento->asunto_aceptacion, $evento, $configuracion, null,  null, $participante->cont_email);

}
// /////
	public function enviarCorreoRegistro($participante, $evento, $configuracion) {

		$evento->correo_confirmacion = str_replace("{{FOLIO}}", $participante->folio, $evento->correo_confirmacion);
		$evento->correo_confirmacion = str_replace("{{NOMBRE_PARTICIPANTE}}", $participante->titulo." ".$participante->nombre." ".$participante->apellidop." ".$participante->apellidom, $evento->correo_confirmacion);
		$evento->correo_confirmacion = str_replace("{{EMAIL_PARTICIPANTE}}", $participante->email, $evento->correo_confirmacion);
		$evento->correo_confirmacion = str_replace("{{EMPRESA_PARTICIPANTE}}", $participante->empresa, $evento->correo_confirmacion);
		$evento->correo_confirmacion = str_replace("{{NOMBRE_CONSTANCIA}}", $participante->nombreconstancia, $evento->correo_confirmacion);

		return $this->CrearEmailSB($participante->email, $evento->correo_confirmacion, $evento->asunto_registro, $evento, $configuracion, null,  null, $participante->cont_email);

	}


	public function enviarCorreoAceptacion($participante, $evento, $configuracion) {

		$evento->correo_aceptacion = str_replace("{{FOLIO}}", $participante->folio, $evento->correo_aceptacion);
		$evento->correo_aceptacion = str_replace("{{NOMBRE_PARTICIPANTE}}", $participante->titulo." ".$participante->nombre." ".$participante->apellidop." ".$participante->apellidom, $evento->correo_aceptacion);
		$evento->correo_aceptacion = str_replace("{{EMAIL_PARTICIPANTE}}", $participante->email, $evento->correo_aceptacion);
		$evento->correo_aceptacion = str_replace("{{EMPRESA_PARTICIPANTE}}", $participante->empresa, $evento->correo_aceptacion);
		$evento->correo_aceptacion = str_replace("{{NOMBRE_CONSTANCIA}}", $participante->nombreconstancia, $evento->correo_aceptacion);
		$codigo_de_barras = '<img src="https://socmexcirped.org/socios/crearCodigoDeBarras.php?folio='.$participante->folio.'" alt="Si no puedes ver este código QR da click en Cargar contenido remoto">';
		$evento->correo_aceptacion = str_replace("{{CODIGO_DE_BARRAS}}", $codigo_de_barras, $evento->correo_aceptacion);

		return $this->CrearEmailSB($participante->email, $evento->correo_aceptacion, $evento->asunto_aceptacion, $evento, $configuracion, null,  null, $participante->cont_email);

	}

	public function enviarCorreoRecordatorio($participante, $evento, $configuracion) {

		$fecha=$this->formatearFecha($participante->fecha_registro);

	
		$evento->correo_recordatorio = str_replace("{{FECHA_REGISTRO}}", $fecha, $evento->correo_recordatorio);
		$evento->correo_recordatorio = str_replace("{{FOLIO}}", $participante->folio, $evento->correo_recordatorio);
		$evento->correo_recordatorio = str_replace("{{NOMBRE_PARTICIPANTE}}", $participante->titulo." ".$participante->nombre." ".$participante->apellidop." ".$participante->apellidom, $evento->correo_recordatorio);
		$evento->correo_recordatorio = str_replace("{{EMAIL_PARTICIPANTE}}", $participante->email, $evento->correo_recordatorio);
		$evento->correo_recordatorio = str_replace("{{EMPRESA_PARTICIPANTE}}", $participante->empresa, $evento->correo_recordatorio);
		$evento->correo_recordatorio = str_replace("{{NOMBRE_CONSTANCIA}}", $participante->nombreconstancia, $evento->correo_recordatorio);
		
		return $this->CrearEmailSB($participante->email, $evento->correo_recordatorio, $evento->asunto_recordatorio, $evento, $configuracion, null,  null, $participante->cont_email);
		// die();
	}



	public function enviarAvisoNuevoComprobante($participante, $evento, $configuracion) {

		$asunto = "Se ha cargado un nuevo comprobante de pago para: ".$evento->nombre_evento;
		$mensaje = '
		<tr>
		<td  align="justify" style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		Estimado(a): ' . $configuracion->cliente .'
		<br>
		<br>Le informamos que el participante:'.$participante->nombre.' '.$participante->apellidop.' '.$participante->apellidom .' ha cargado un nuevo comprobante de pago para el evento: '.$evento->nombre_evento.'<br>
		<br><br>Acceda a la plataforma: <a href="' . $configuracion->plataforma_admin . '">'.$configuracion->plataforma_admin .'</a> para revisar este documento.<br>
		
		<tr>
		<td height="15"></td>
		</tr>

		';

		
//$evento->email_contacto
		return $this->CrearEmailSB($evento->email_contacto, $mensaje, $asunto, $evento, $configuracion, null,  null, null);

	}


		public function enviarCorreoAvisoFacturar($participante, $evento, $configuracion) {

		
		$evento->correo_facturar = str_replace("{{FOLIO}}", $participante->folio, $evento->correo_facturar);
		$evento->correo_facturar = str_replace("{{NOMBRE_PARTICIPANTE}}", $participante->titulo." ".$participante->nombre." ".$participante->apellidop." ".$participante->apellidom, $evento->correo_facturar);
		$evento->correo_facturar = str_replace("{{EMAIL_PARTICIPANTE}}", $participante->email, $evento->correo_facturar);
		$evento->correo_facturar = str_replace("{{EMPRESA_PARTICIPANTE}}", $participante->empresa, $evento->correo_facturar);
		$evento->correo_facturar = str_replace("{{NOMBRE_CONSTANCIA}}", $participante->nombreconstancia, $evento->correo_facturar);
		
		return $this->CrearEmailSB($participante->cont_email, $evento->correo_facturar, $evento->asunto_facturar, $evento, $configuracion, null,  null, null);



	}

	public function enviarContrasenia($socio) {

		$asunto = "Instrucciones para continuar su registro";
		$mensaje = '
		<tr>
		<td  align="justify" style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		Estimado(a): ' . $socio->prefijo . ' ' . $socio->nombre . ' ' . $socio->apellidop . ' ' . $socio->apellidom . '
		<br>
		<br>Le informamos que puede continuar con su registro, siga las siguientes instrucciones:<br>
		<b>1.</b> Ingrese al sistema en línea  <a href="' . sistema_url . '" >' . sistema_url . '</a> con tu correo y contraseña que se le asignó.<br>
		<b>2.</b> Tendrá que completar toda la información que se solicite en el sistema, no podrá continuar con el siguiente paso si no rellena toda la informacion necesaria en el paso que se encuentre.<br>
		<b>3.</b> Subir la documentación que se solicita en el sistema.<br>
		<b>4.</b> Una vez cargada toda la información y la documentación podrá enviar una petición para que su solicitud sea revisada.<br>
		<br>
		<br>
		Su correo de acceso es: <b>' . $socio->email . '</b><br>
		Su contraseña de acceso es: <b>' . $socio->password . '</b><br>
		NOTA:<b>Le recomendamos cambiar su contraseña por una que le sea fácil de recordar.</b>
		<br>
		<br>
		<br>
		</td>
		</tr>
		<tr>
		<td height="15"></td>
		</tr>

		';
		return $this->CrearEmailSB($socio->email, $mensaje, $asunto, null, null);
	}
	
	public function enviarCalendario($titulo, $usuario,$organizador, $descripcion,  $adjunto,$nombre,$inicio,$fin) {
		$asunto = $titulo;
		$mensaje = '
		<tr>
		<td  align="justify" style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
		Estimado(a) Usuario,
		<br>
		<br> El motivo del correo es para enviarle la invitación a ' . $titulo . ', organizado por '.$organizador->email.'<br>
		Descripción: '.$descripcion.' <br>
		Fecha y hora: '.$inicio .' a '. $fin.'
		</td>
		</tr>
		<tr>
		<td height="15"></td>
		</tr>
		<tr>
		<td  style="color: #a4a4a4; line-height: 25px; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">

		</td>
		</tr>
		';
		if($adjunto){
            $adjunto = DIRECTORIO . DIRECTORY_SEPARATOR ."calendarios/$adjunto";
        }
		return $this->CrearEmailSB($usuario->email, $mensaje, $asunto, $configuracion, $adjunto,$nombre);
	}
	public function CrearEmailSB($email_receptor, $contenido_html, $asunto, $evento, $configuracion, $archivo_adjunto,  $nombre_archivo, $copia=null) {
		$html = "";

		$plantilla = DIRECTORIO . DIRECTORY_SEPARATOR . '/views/template_correos.tpl';
		$logo = $configuracion->logo;

		if (file_exists(DIRECTORIO . DIRECTORY_SEPARATOR."img/eventos/logo_".$evento->id.".png")) {
            $logo=$configuracion->url_sistema."/img/eventos/logo_".$evento->id.".png?".time(); 
        }


		$variables = array(
			'ASUNTO' => $asunto,
			'DIRECCION' => $configuracion->direccion,
			'TELEFONO' => 'XXXX-XXXX',
			'SOCIEDAD' => $configuracion->cliente,
			'LOGO' => $logo,
			'EMAIL_CONTACTO' => $evento->email,
			'ANIO' => date("Y"),
			'PREFIJO' => $configuracion->prefijo,
			'COLOR' => $configuracion->color,
			'CUERPO' => $contenido_html
		);
		if ($html = @file_get_contents($plantilla)) {
			foreach ($variables as $name => $value) {
				$html = str_replace("{" . $name . "}", $value, $html);
			}
		}
		// $configuracion->email_envio = 'karenalexia15@hotmail.com';
		$evento->email_notificaciones = 'karenalexia20@hotmail.com';
		// echo '<br><br> llegue a CrearEmailSB';
		

		$url = "https://api.sendinblue.com/v3/smtp/email";
		$to = array($email = [
			'email' => $email_receptor,
			
		]);
		$sender = [
			'name' => $configuracion->nombre_remitente,
			'email' => $configuracion->email_envio,
		];
		$ccp = array(
			$email_ccp = [
				'email' => "karenalexia16@gmail.com",
				'name'=>"EVENTOS CANIFARMA"
			]
		);
		$email_copia=array();
		if ($copia) {
			$email_copia = array(
				'email' => $copia
			);
			array_push($ccp, $email_copia);
		}


	
		$correos_copias = explode(",", $evento->email_notificaciones);
		foreach ($correos_copias as $correo) {
					$email_cpp = array(
						'email' => $correo
					);
					array_push($ccp, $email_cpp);
		}





		$adjunto=null;
		if($archivo_adjunto){
            $content = chunk_split(base64_encode(file_get_contents($archivo_adjunto)));
			$archivo_adjunto_b64 = chunk_split(base64_encode($archivo_adjunto));
			$adjunto = array([
				'name' => $nombre_archivo,
				'content' => $content
			]);
		}
		$datos = [
			'sender' => $sender,
			'to' => $to,
			'subject' => $asunto,
			'attachment' => $adjunto,
			'bcc' => $ccp,
			'htmlContent' => $html
		];



		$metodo = "POST";
		$datos = json_encode($datos);

		// echo '<br><br> '. $configuracion->email_envio;

		// var_dump($datos);
		// exit;
		return $this->enviarMailSB($url, $metodo, $datos);
	}
	public function CrearEmailSimple($email_receptor, $contenido_html, $asunto, $configuracion,$copia=null,$emailContacto=null) {
		$html = "";

		$plantilla = DIRECTORIO . DIRECTORY_SEPARATOR . 'administracion/views/template_correos.tpl';
		$logo = $configuracion->logo;


		$variables = array(
			'ASUNTO' => $asunto,
			'DIRECCION' => $configuracion->direccion,
			'TELEFONO' => "55 56 88 94 77",
			'SOCIEDAD' => $configuracion->cliente,
			'LOGO' => $logo,
			'EMAIL_CONTACTO' => $emailContacto,
			'ANIO' => date("Y"),
			'PREFIJO' =>"CANIFARMA",
			'COLOR' => $configuracion->color,
			'CUERPO' => $contenido_html
		);
		if ($html = @file_get_contents($plantilla)) {
			foreach ($variables as $name => $value) {
				$html = str_replace("{" . $name . "}", $value, $html);
			}
		}


		
		$url = "https://api.sendinblue.com/v3/smtp/email";
		$to = array($email = [
			'email' => $email_receptor,
			
		]);
		$sender = [
			'name' => "CANIFARMA AFILIACIONES",
			'email' => $configuracion->email_envio,
		];
		$ccp = array(
			$email_ccp = [
				'email' => "jcinnovation2019@gmail.com",
				'name'=>"CANIFARMA"
			]
		);
		$email_copia=array();
		if ($copia) {
			$email_copia = array(
				'email' => $copia
			);
			array_push($ccp, $email_copia);
		}

		$adjunto=null;
		
		$datos = [
			'sender' => $sender,
			'to' => $to,
			'subject' => $asunto,
			'attachment' => $adjunto,
			'bcc' => $ccp,
			'htmlContent' => $html
		];



		$metodo = "POST";
		$datos = json_encode($datos);
		return $this->enviarMailSB($url, $metodo, $datos);
	}

	public function enviarMailSB($url, $metodo, $datos) {
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => $metodo,
			CURLOPT_POSTFIELDS => $datos,
			CURLOPT_HTTPHEADER => array(
				"accept: */*",
				"accept-languaje: en-US,en;q=0.8",
				"Content-type: application/json",
				"api-key: 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",
			),
		));

		$response = curl_exec($curl);
		

		$err = curl_error($curl);
		curl_close($curl);
		if ($err == "") {
			return true;
		} else {
			return false;
		}
	}
	public function enviarMailFactura($email, $contenido_html, $asunto, $pdf, $xml,$configuracion, $evento) {
		$html = "";
		



		$plantilla = DIRECTORIO . DIRECTORY_SEPARATOR . 'administracion/views/template_correos.tpl';
		$logo = $configuracion->logo;
		$variables = array(
			'ASUNTO' => $asunto,
			'DIRECCION' => $configuracion->direccion,
			'TELEFONO' => $evento->telefono_contacto,
			'SOCIEDAD' => $configuracion->cliente,
			'LOGO' => $logo,
			'EMAIL_CONTACTO' => $evento->email_contacto,
			'ANIO' => date("Y"),
			'PREFIJO' => $configuracion->prefijo,
			'COLOR' => $configuracion->color,
			'CUERPO' => $contenido_html
		);
		if ($html = @file_get_contents($plantilla)) {
			foreach ($variables as $name => $value) {
				$html = str_replace("{" . $name . "}", $value, $html);
			}
		}


		
		$url = "https://api.sendinblue.com/v3/smtp/email";
		$to = array($email = [
			'email' => $email,
			
		]);
		$sender = [
			'name' => $configuracion->cliente,
			'email' => $evento->email_envio,
		];
		$ccp = array(
			$email_ccp = [
				'email' => "jcinnovation2019@gmail.com",
				'name'=>"EVENTOS CANIFARMA"
			]
		);
		// $email_copia=array();
		// if ($copia) {
		// 	$email_copia = array(
		// 		'email' => $copia
		// 	);
		// 	array_push($ccp, $email_copia);
		// }


	
		// $correos_copias = explode(",", $evento->email_notificaciones);
		// foreach ($correos_copias as $correo) {
		// 			$email_cpp = array(
		// 				'email' => $correo
		// 			);
		// 			array_push($ccp, $email_cpp);
		// }


		$files = array();
		if($pdf){
            $content = chunk_split(base64_encode(file_get_contents($pdf)));
			$name = basename($pdf);
			array_push($files,['name' => $name,'content' => $content]);

		}
		if($xml){
            $content = chunk_split(base64_encode(file_get_contents($xml)));
			$name = basename($xml);
			array_push($files,['name' => $name,'content' => $content]);
		}
		$adjunto=null;
		if($files){
			$adjunto = $files;
		}
		$datos = [
			'sender' => $sender,
			'to' => $to,
			'subject' => $asunto,
			'attachment' => $adjunto,
			'bcc' => $ccp,
			'htmlContent' => $html
		];



		$metodo = "POST";
		$datos = json_encode($datos);
		return $this->enviarMailSB($url, $metodo, $datos);

	}

	public function enviarMail($email, $mensaje, $asunto, $adjunto = null, $logo_evento = null) {
		$html = "";
		$plantilla = DIRECTORIO . DIRECTORY_SEPARATOR . 'view/template_correos.tpl';
		if ($logo_evento == "") {
			$logo = "sociedad_logo";
		} else {
			$logo = $logo_evento;
		}
		$variables = array(
			'ASUNTO' => $asunto,
			'DIRECCION' => sociedad_direccion,
			'TELEFONO' => sociedad_telefono,
			'SOCIEDAD' => sociedad,
			'LOGO' => $logo,
			'EMAIL_CONTACTO' => sociedad_email_contacto,
			'ANIO' => date("Y"),
			'PREFIJO' => sociedad_prefijo,
			'COLOR' => sociedad_email_color,
			'CUERPO' => $mensaje,
		);
		if ($html = @file_get_contents($plantilla)) {
			foreach ($variables as $name => $value) {
				$html = str_replace("{" . $name . "}", $value, $html);
			}
		}

		require_once DIRECTORIO . DIRECTORY_SEPARATOR . 'PHPMailer/src/Exception.php';
		require_once DIRECTORIO . DIRECTORY_SEPARATOR . 'PHPMailer/src/PHPMailer.php';
		require_once DIRECTORIO . DIRECTORY_SEPARATOR . 'PHPMailer/src/SMTP.php';

		$mail = new PHPMailer\PHPMailer\PHPMailer(true);
		try {

			$mail->Mailer = "smtp";
			$mail->Host = "mail." . sociedad_dominio;
			$mail->SMTPAuth = 1;
			$mail->IsSendMail();
			$mail->Username = sociedad_email_usuario;
			$mail->Password = sociedad_email_password;
			$mail->Port = "2525";
			$mail->CharSet = 'UTF-8';

			$mail->From = sociedad_email_envio;
			$mail->FromName = sociedad;
			$mail->Timeout = 15;
			//$email = "jesus@brb.com.mx";
			$mail->AddAddress($email);
			$mail->addReplyTo(sociedad_email_respuesta);
			//$mail->AddBCC(sociedad_email_copia);
			// $mail->AddBCC("registrobrb@gmail.com");
			$mail->AddBCC("jcinnovation2019@gmail.com");

			$mail->IsHTML(true);
			if ($adjunto != "") {
				$mail->addAttachment($adjunto);
			}
			$mail->Subject = $asunto;
			$mail->Body = $html;
			if ($mail->Send()) {
				return true;
			} else {
				return false;
			}
		} catch (Exception $e) {
			echo 'Message could not be sent.<br>';
			echo 'Mailer Error: ' . $mail->ErrorInfo;
			exit;
			return false;
		}

	}

	public function crearSesionSinRol($usuario_id) {
		unset($_SESSION[AMBIENTE]['usuario']);
		$this->destruirSession($usuario_id);
		session_regenerate_id();
		$id_sessionx = session_id();
		$_SESSION[AMBIENTE]['usuario']['id'] = $usuario_id;
		$_SESSION[AMBIENTE]['usuario']['id_sesion'] = $id_sessionx;
		return $id_sessionx;
	}
	// si
	public function crearSesion($usuario_id, $usuario_rol) {
		unset($_SESSION[AMBIENTE]['usuario']);
		$this->destruirSession($usuario_id);
		session_regenerate_id();
		$id_sessionx = session_id();
		$_SESSION[AMBIENTE]['usuario']['id'] = $usuario_id;
		$_SESSION[AMBIENTE]['usuario']['rol'] = $usuario_rol;
		$_SESSION[AMBIENTE]['usuario']['id_sesion'] = $id_sessionx;
		return $id_sessionx;
	}




// no
	public function crearSesionParticipante($participante_id) {
		unset($_SESSION[AMBIENTE]['participante']);
		$this->destruirSession($participante_id);
		session_regenerate_id();
		$id_sessionx = session_id();
		$_SESSION[AMBIENTE]['participante']['id'] = $participante_id;
		$_SESSION[AMBIENTE]['participante']['id_sesion'] = $id_sessionx;
		return $id_sessionx;
	}

	// *
	public function destruirSession($usuario_id) {
		$campos = array("id_sesion", "hash");
		$valores = array("","");
		$condicion = " usuario_id=" . $usuario_id;
		$this->setTabla("rsv_logeos");
		$this->actualizar($campos, $valores, $condicion);
	}

// no
	public function destruirSessionParticipante($participante_id) {
		$campos = array("id_sesion", "hash");
		$valores = array("","");
		$condicion = " participante_id=" . $participante_id;
		$this->setTabla("logeos_participantes");
		$this->actualizar($campos, $valores, $condicion);
	}


	// si
	public function validaSession($id_sesion) {
		$sql = "SELECT count(*) as valida FROM rsv_logeos WHERE id_sesion='" . $id_sesion . "'";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$sesion = $sentencia->fetch(PDO::FETCH_OBJ);
		if (!$sesion->valida) {
			unset($_SESSION[AMBIENTE]['usuario']);
			session_start();
			$this->crearMensaje("Session cerrada, solo puedes tener una sesion abierta", "info");
			header("Location: signin.php");
			exit;
		}
	}

	// no

		public function validaSessionParticipante($id_sesion) {
		$sql = "SELECT count(*) as valida FROM logeos_participantes WHERE id_sesion='" . $id_sesion . "'";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$sesion = $sentencia->fetch(PDO::FETCH_OBJ);
		if (!$sesion->valida) {
			unset($_SESSION[AMBIENTE]['participante']);
			session_start();
			$this->crearMensaje("Session cerrada, solo puedes tener una sesion abierta", "info");
			header("Location: signin.php");
			exit;
		}
	}
	// si 
	public function validarCookie($cookie) {
		$sql = "SELECT count(*) as valida, usuario_id, id_rol FROM rsv_logeos WHERE hash='" . md5($cookie) . "' and expired>".time();
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
		if ($resultado->valida) {
			$_SESSION[AMBIENTE]['usuario']['id'] = $resultado->usuario_id;
			$_SESSION[AMBIENTE]['usuario']['rol'] = $resultado->id_rol;
			$_SESSION[AMBIENTE]['usuario']['id_sesion'] = $cookie;
			return true;
		}else{
			return false;
		}
	}

// no
	public function validarCookieParticipante($cookie) {
		$sql = "SELECT count(*) as valida, participante_id FROM logeos_participantes WHERE hash='" . md5($cookie) . "' and expired>".time();
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetch(PDO::FETCH_OBJ);
		if ($resultado->valida) {
			$_SESSION[AMBIENTE]['participante']['id'] = $resultado->participante_id;
			$_SESSION[AMBIENTE]['participante']['id_sesion'] = $cookie;
			return true;
		}else{
			return false;
		}
	}

// si dejar de aqui en adelante
	public function verMensaje() {
		$mensaje = array("mensaje" => null, "clase" => null);
		if (isset($_SESSION[AMBIENTE]['mensaje'])) {
			$mensaje = array("texto" => $_SESSION[AMBIENTE]['mensaje']['texto'], "clase" => $_SESSION[AMBIENTE]['mensaje']['clase']);
			unset($_SESSION[AMBIENTE]['mensaje']);
		}
		return $mensaje;
	}

	public function getEstados() {
		$sql = "SELECT * FROM estado order by estado asc";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}




	public function getCategorias() {
		$sql = "SELECT * FROM categorias ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getPaises() {
		$sql = "SELECT * FROM paises ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getPuestos() {
		$sql = "SELECT * FROM puestos ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}


	public function getServicios() {
		$sql = "SELECT * FROM cat_servicios ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getEstatus() {
		$sql = "SELECT * FROM cat_estatus ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getTipos() {
		$sql = "SELECT * FROM cat_tipos ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getNacionalidades() {
		$sql = "SELECT * FROM nacionalidad order by nombre_nacionalidad asc ";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function getDocumentacion($categoria = null) {
		$sqld = "";
		if ($categoria) {
			$sqld = " and  FIND_IN_SET(" . $categoria . ", d.categorias) or d.categorias=''";
		}
		$sql = "SELECT  d.id, d.documento, d.activo, d.obligatorio, d.carpeta, d.descripcion, d.categorias FROM documentos as d WHERE d.activo=1  " . $sqld . " order by d.orden asc";
		$sentencia = $this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado = $sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}


	public function esMobil() {
		//buscar si esta abriendo desde la apliacion de android
		$buscar = 'mobile';
		$cadena = $_SERVER['HTTP_USER_AGENT'];
		$es_mobil = stripos($cadena, $buscar);
		if (($es_mobil !== false)) {
			return true;
		} else {
			return false;
		}
	}






	public function valida_rfc($valor) {
		$valor = str_replace("-", "", $valor);
		$cuartoValor = substr($valor, 3, 1);
		//RFC sin homoclave
		if (strlen($valor) == 10) {
			$letras = substr($valor, 0, 4);
			$numeros = substr($valor, 4, 6);
			if (ctype_alpha($letras) && ctype_digit($numeros)) {
				return true;
			}
			return false;
		}
		// Sólo la homoclave
		else if (strlen($valor) == 3) {
			$homoclave = $valor;
			if (ctype_alnum($homoclave)) {
				return true;
			}
			return false;
		}
		//RFC Persona Moral.
		else if (ctype_digit($cuartoValor) && strlen($valor) == 12) {
			$letras = substr($valor, 0, 3);
			$numeros = substr($valor, 3, 6);
			$homoclave = substr($valor, 9, 3);
			if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
				return true;
			}
			return false;
			//RFC Persona Física.
		} else if (ctype_alpha($cuartoValor) && strlen($valor) == 13) {
			$letras = substr($valor, 0, 4);
			$numeros = substr($valor, 4, 6);
			$homoclave = substr($valor, 10, 3);
			if (ctype_alpha($letras) && ctype_digit($numeros) && ctype_alnum($homoclave)) {
				return true;
			}
			return false;
		} else {
			return false;
		}
	}

	function validate_curp($valor) {
		if (strlen($valor) == 18) {
			$letras = substr($valor, 0, 4);
			$numeros = substr($valor, 4, 6);
			$sexo = substr($valor, 10, 1);
			$mxState = substr($valor, 11, 2);
			$letras2 = substr($valor, 13, 3);
			$homoclave = substr($valor, 16, 2);
			if (ctype_alpha($letras) && ctype_alpha($letras2) && ctype_digit($numeros) && ctype_digit($homoclave) && $this->is_mx_state($mxState) && $this->is_sexo_curp($sexo)) {
				return true;
			}
			return false;
		} else {
			return false;
		}
	}
	public function get_real_ip() {

		if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			return $_SERVER["HTTP_CLIENT_IP"];
		} elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			return $_SERVER["HTTP_X_FORWARDED_FOR"];
		} elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
			return $_SERVER["HTTP_X_FORWARDED"];
		} elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
			return $_SERVER["HTTP_FORWARDED_FOR"];
		} elseif (isset($_SERVER["HTTP_FORWARDED"])) {
			return $_SERVER["HTTP_FORWARDED"];
		} else {
			return $_SERVER["REMOTE_ADDR"];
		}

	}
	function is_mx_state($state) {
		$mxStates = [
			'AS', 'BS', 'CL', 'CS', 'DF', 'GT',
			'HG', 'MC', 'MS', 'NL', 'PL', 'QR',
			'SL', 'TC', 'TL', 'YN', 'NE', 'BC',
			'CC', 'CM', 'CH', 'DG', 'GR', 'JC',
			'MN', 'NT', 'OC', 'QT', 'SP', 'SR',
			'TS', 'VZ', 'ZS',
		];
		if (in_array(strtoupper($state), $mxStates)) {
			return true;
		}
		return false;
	}

	function is_sexo_curp($sexo) {
		$sexoCurp = ['H', 'M'];
		if (in_array(strtoupper($sexo), $sexoCurp)) {
			return true;
		}
		return false;
	}

	function urlAmigable($nombre){
      return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($nombre, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
  	}


  		public function getRegimenes(){
		$sql="SELECT * FROM e_regimenesfiscales";
		$sentencia=$this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado=$sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}
    public function getCFDIid($id){
        $sql="SELECT * FROM e_cfdi WHERE ids_regimenes LIKE '%$id%'";   
		$sentencia=$this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado=$sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}

	    public function getRegimenByid($id){
        $sql="SELECT * FROM e_regimenesfiscales WHERE id_regimen = ".$id;   
		$sentencia=$this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado=$sentencia->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

    public function getCFDI(){
        $sql="SELECT * FROM e_cfdi";
		$sentencia=$this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado=$sentencia->fetchAll(PDO::FETCH_OBJ);
		return $resultado;
	}


    public function getUsoCFDIBy($id){
        $sql="SELECT * FROM e_cfdi WHERE id_cfdi like '".$id."'";
		$sentencia=$this->conexion_db->prepare($sql);
		$sentencia->execute(array());
		$resultado=$sentencia->fetch(PDO::FETCH_OBJ);
		return $resultado;
	}

	public function formatearFecha($fecha){
		// $formato2 = new IntlDateFormatter(
		//     'es-ES',
		//     IntlDateFormatter::FULL,
		//     IntlDateFormatter::FULL,
		//     'America/Mexico_City',
		//     IntlDateFormatter::GREGORIAN,
		//     "eeee d 'de' LLLL 'de' yyyy"
		// );
// $fecha = new DateTime($fecha);
		// $fecha_formateada=$formato2->format($fecha);

		$fechaFortat = new DateTime($fecha);
		$arrayMeses=array(
			"Ene.","Feb.","Mar.","Abr.","May.","Jun.","Jul.","Agos.","Sep.","Oct.","Nov.","Dec."
		);
		
		$anio = $fechaFortat->format('Y');
		$dia = $fechaFortat->format('d');
		$mes = $fechaFortat->format('m');
		
		$fechaFinal=$arrayMeses[$mes-1]." ".$dia." del ".$anio;
	
		return $fechaFinal;
	}

	

}
if ( ! function_exists( 'money_format' ) ) {
    function money_format($format, $number){
        $regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
                '(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
        if (setlocale(LC_MONETARY, 0) == 'C') {
            setlocale(LC_MONETARY, '');
        }
        $locale = localeconv();
        preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
        foreach ($matches as $fmatch) {
            $value = floatval($number);
            $flags = array(
                'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
                            $match[1] : ' ',
                'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
                'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
                            $match[0] : '+',
                'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
                'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
            );
            $width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
            $left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
            $right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
            $conversion = $fmatch[5];
            $positive = true;
            if ($value < 0) {
                $positive = false;
                $value  *= -1;
            }
            $letter = $positive ? 'p' : 'n';
            $prefix = $suffix = $cprefix = $csuffix = $signal = '';
            $signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
            switch (true) {
                case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
                    $prefix = $signal;
                break;
                case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
                    $suffix = $signal;
                break;
                case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
                    $cprefix = $signal;
                break;
                case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
                    $csuffix = $signal;
                break;
                case $flags['usesignal'] == '(':
                case $locale["{$letter}_sign_posn"] == 0:
                    $prefix = '(';
                    $suffix = ')';
                break;
            }
            if (!$flags['nosimbol']) {
                $currency = $cprefix .
                            ($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
                            $csuffix;
            } else {
                $currency = '';
            }
            $space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';

            $value = number_format($value, $right, $locale['mon_decimal_point'],
                    $flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
            $value = @explode($locale['mon_decimal_point'], $value);

            $n = strlen($prefix) + strlen($currency) + strlen($value[0]);
            if ($left > 0 && $left > $n) {
                $value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
            }
            $value = implode($locale['mon_decimal_point'], $value);
            if ($locale["{$letter}_cs_precedes"]) {
                $value = $prefix . $currency . $space . $value . $suffix;
            } else {
                $value = $prefix . $value . $space . $currency . $suffix;
            }
            if ($width > 0) {
                $value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
                        STR_PAD_RIGHT : STR_PAD_LEFT);
            }
            $format = str_replace($fmatch[0], $value, $format);
        }
        return $format;
    }
}
?>