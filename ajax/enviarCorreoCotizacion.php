<?php

function EnviarCorreo()
{ 

if(isset($_POST["codigo"])){
	$CodigoCotizacion = str_pad($_POST["codigo"],5,"0",STR_PAD_LEFT);
}
if(isset($_POST["correoCliente"])){
	$CorreoCliente = $_POST["correoCliente"];
}
if(isset($_POST["firmaCorreo"])){
	$firmaCorreo  = $_POST["firmaCorreo"];
}
require_once '../extensiones/vendor/autoload.php';
require_once "../extensiones/PHPMailer/PHPMailer.php";
require_once "../extensiones/PHPMailer/SMTP.php";
require_once "../extensiones/PHPMailer/Exception.php";

//DATOS EMPRESA

require_once "../controladores/empresa.controlador.php";
require_once "../modelos/empresa.modelo.php";


$DatosEmpresa= ControladorEmpresa::ctrMostrarEmpresas(null, null);

$nombreEmpresa=$DatosEmpresa[0]["NombreEmpresa"];


//DATOS EMPRESA

require_once "../controladores/CorreoSaliente.controlador.php";
require_once "../modelos/correo.modelo.php";


$datosCorreo= ControladorCorreo::ctrMostrarCorreo();



             
$correo=$datosCorreo[0]["correoSaliente"];
$SMTPDebug=$datosCorreo[0]["SMTPDebug"];
$Host=$datosCorreo[0]["host"];

if ($datosCorreo[0]["SMTPAuth"]==1){
    $SMTPAuth=true;
}
else{
    $SMTPAuth=false;
}

$puerto=$datosCorreo[0]["Puerto"];
$clave=$datosCorreo[0]["clave"];

$SMTPSeguridad=$datosCorreo[0]["SMTPSeguridad"];


// Load Composer's autoloader


// Instantiation and passing `true` enables exceptions
$mail = new  PHPMailer\PHPMailer\PHPMailer(true);

try {


    //Server settings
    $mail->SMTPDebug = $SMTPDebug;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       =$Host;                    // Set the SMTP server to send through
    $mail->SMTPAuth   = $SMTPAuth;                                   // Enable SMTP authentication
    $mail->Username   = $correo;                     // SMTP username
    $mail->Password   = $clave;                               // SMTP password
    $mail->SMTPSecure = $SMTPSeguridad;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = $puerto;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom($correo, $nombreEmpresa);
    $mail->addAddress($CorreoCliente, '');     // Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    //mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    $attachment="../extensiones/tcpdf/pdf/PDF/COTIZACION".$CodigoCotizacion.".pdf";
    $mail->addAttachment($attachment);         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $nombreEmpresa." Cotizacion #".$CodigoCotizacion;
    $mail->Body    = $firmaCorreo ;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}
EnviarCorreo();

//str_pad($this->codigo,5,"0",STR_PAD_LEFT);

?>

