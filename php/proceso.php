<?php
/* 
Script que gestiona el envío del formulario por correo electrónico a la cuenta del personal
y del usuario que se pone en contacto con overseas.
*/

//Correo de destino; al cuál se enviará el correo.
$correoDestino = "adrianojosemartin@gmail.com";

//Texto emisor; sÃ³lo lo leerÃ¡ quien reciba el contenido.
$cabecera = "MIME-VERSION: 1.0\r\n";
$cabecera .= "Content-type: text/html; charset=UTF-8\r\n";
$cabecera .= "From: Formulario web";

/*
Recopilamos los datos vía POST, suprimiendo etiquetas HTML y php
*/
$nombre = strip_tags($_POST['nombre_contacto']);
$apellidos = strip_tags($_POST['apellidos_contacto']);
$empresa = strip_tags($_POST['empresa']);
$cargo = strip_tags($_POST['cargo']);
$correo = strip_tags($_POST['email']);
$telefono = strip_tags($_POST['telefono']);
$comentario = strip_tags($_POST['AreaTexto']);
$fecha = time();
$fechaFormateada = date("j/n/Y", $fecha);

$adjunto = strip_tags($_POST['fichero']);

//Formateo el asunto del correo
$asunto = "Contacto WEB: $nombre $apellidos de $empresa";

//Formateo el cuerpo del correo
$cuerpo = "<b>Enviado por: </b> " . $nombre . " " . $apellidos . " el " . $fechaFormateada . "<br />";
$cuerpo .= "<b>Empresa: </b> " . $empresa . " <b>Cargo/departamento: </b> " . $cargo . "<br />";
$cuerpo .= "<b>Teléfono de contacto: </b>" . $telefono . "<br />";
$cuerpo .= "<b>E-mail: </b> " . $correo . "<br />";
$cuerpo .= "<b>Comentario: </b> " . $comentario;

// Archivo a adjuntar
/*$archivo= $adjunto;
$buf_type= obtener_extencion_stream_archivo($adjunto); //obtenemos tipo archivo
 
$fp= fopen( "uploads/".$archivo, "r" ); //abrimos archivo
$buf= fread( $fp, filesize("uploads/".$archivo) ); //leemos archivo completamente
fclose($fp); //cerramos apuntador;

$cuerpo .= "--". $boundary. "\r\n";
$cuerpo .= "Content-Type: ". $buf_type. "; name=\"". $archivo. "\"\r\n"; //envio directo de datos
$cuerpo .= "Content-Transfer-Encoding: base64\r\n";
$cuerpo .= "Content-Disposition: attachment; filename=\"". $archivo. "\"\r\n\r\n";
$cuerpo .= base64_encode($buf). "\r\n\r\n";*/

// Envi­o el mensaje
mail($correoDestino, $asunto, $cuerpo, $cabecera);
?>
