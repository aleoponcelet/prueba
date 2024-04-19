<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

if (empty($_POST['email'])) {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.ionos.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'inbox@seprok.com.mx';                     //SMTP username
    $mail->Password   = 'Xbox13131313$';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('inbox@seprok.com.mx', 'Notificador');
    $mail->addAddress('rh@hunabku.com.mx');     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Mensaje prueba';
    $mail->Body = <<<EOT
    Nombre: {$_POST['name']} <br>
    Email: {$_POST['email_real']} <br>
    Mensaje: {$_POST['message']}
    EOT;
    $mail->AltBody = 'Este es el cuerpo en texto sin formato para clientes de correo que no son HTML';

    $mail->send();
    echo 'El mensaje ha sido enviado';
} else {
    echo "BAD ROBOT!";
}