<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

require("phpmailer/PHPMailerAutoload.php");

$email = $_REQUEST['email'] ;

$mail = new PHPMailer(true);
try {    
    //$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Host de conexión SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'sonrisafeliz.centro@gmail.com';                 // Usuario SMTP
    $mail->Password = 'sonrisafeliz';                           // Password SMTP
    
    //$mail->addAttachment("uploads/".$file_name);    //AGREGADO
    $mail->setFrom ($email);
    $mail->addAddress('sonrisafeliz.centro@gmail.com');
    $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
    $mail->Port = 587;                                    // Puerto SMTP

    #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
    #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
    #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)

    //$mail->setFrom('sonrisafeliz.centro@gmail.com');		// Mail del remitente
    //$mail->addAddress($_POST['email']);     // Mail del destinatario


    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];  // Asunto del mensaje
    $mail->Body    = "<br>Paciente: " . $_POST['name'] . "<br>Mail: " . $_POST['email'] . "<br><br>Urgencia/Consulta: <br>" . $_POST['message'];    // Contenido del mensaje (acepta HTML)
    $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
    // $mail->AddAttachment("imagenes/imagen.jpg", "imagen.jpg");

    $mail->send();
    echo 'Su mensaje ha sido enviado. Estaremos comunicándonos con usted. Gracias!';
} catch (Exception $e) {
    echo 'El mensaje no se ha podido enviar, Error: ', $mail->ErrorInfo;
}
