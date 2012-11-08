<?php
require("class.phpmailer.php");
//Correo de destino; al cuál se enviará el correo.
$correoDestino = "adrianojosemartin@gmail.com";

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

//Formateo el asunto del correo
$asunto = "Contacto WEB: $nombre $apellidos de $empresa";	


//Creo un nuevo objeto PHPMailer con sus propiedades   
$mail = new PHPMailer();
$mail->From = $correo;
$mail->FromName = "Formulario web";
$mail->Subject = $asunto;
$mail->AddAddress($correoDestino);
$mail->AddCC($correo);
$mail->AddReplyTo=$correo;

//Analizo el archivo a adjuntar
$varname = $_FILES['fichero']['name'];
$vartemp = $_FILES['fichero']['tmp_name'];
if ($varname != "") {
	$mail->AddAttachment($vartemp, $varname);
}

//Formateo el cuerpo del correo
$cuerpo = "<b>Enviado por: </b> " . $nombre . " " . $apellidos . " el " . $fechaFormateada . "<br />";
$cuerpo .= "<b>Empresa: </b> " . $empresa . " <b>Cargo/departamento: </b> " . $cargo . "<br />";
$cuerpo .= "<b>Teléfono de contacto: </b>" . $telefono . "<br />";
$cuerpo .= "<b>E-mail: </b> " . $correo . "<br />";
$cuerpo .= "<b>Comentario: </b> " . $comentario;

//Compongo el mail y lo envío
$mail->Body = $cuerpo;
$mail->IsHTML(true);
$mail->Send();

?>
