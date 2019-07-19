<?php
   
include("../connectdb.php");
	  
date_default_timezone_set('America/Bogota'); 
$date = date('Y-m-d H:i:s', time());

$respuesta="inicializando";
	 
$sql_usuario="SELECT * FROM cerok WHERE id=".$_POST['id'];
 
if ($result_usuario = $connectdb->query($sql_usuario)) {

$row_usuario=mysqli_fetch_assoc($result_usuario);
$correo = $row_usuario['correo'];

}

$keyAzsrk= substr(md5(time()), 0, 32);
$salt1=substr(md5(time()), 0, 32);
$salt2=substr(md5(time()), 0, 32);
$drk= substr(md5(time()), 0, 32);
$salt3=substr(md5(time()), 0, 32);

require 'phpmailer/vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer; 


$mail = new PHPMailer();
$mail->IsSMTP();                       // telling the class to use SMTP
$mail->SMTPDebug = 0;                  
// 0 = no output, 1 = errors and messages, 2 = messages only.
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,  
        'verify_peer_name' => false,
        'allow_self_signed' => true
    ) 
);     
$mail->SMTPAuth = true;                // enable SMTP authentication 
$mail->SMTPSecure = "ssl";              // sets the prefix to the servier
$mail->Host = "jotalvaro.com";        // sets Gmail as the SMTP server
$mail->Port = 465;                     // set the SMTP port for the GMAIL 
$mail->Username = "info@jotalvaro.com";  // Gmail username
$mail->Password = "holamundo";      // Gmail password
$mail->SetFrom ('info@jotalvaro.com','Jotalvaro'); 
$mail->Subject = "Recuperar la contraseña!! ";
$mail->ContentType = 'text/html';
$mail->IsHTML(true);  
$mail -> CharSet = "UTF-8";
$Body ="
<!DOCTYPE html>
<html>
<head>
<title>Recuperacion de contraseña</title> 
</head>
<body>
<div style='width:100%;'> Para recuperar su contraseña <a style='color:red' href='https://jotalvaro.com/cerok?keyAzsrk=".$keyAzsrk.$salt1.$salt2.$salt3.$keyAzsrk."&rc=".$_POST['id']."&drk=".$drk."'> Haz clic aqui</a></div></body> 
</html>";  
// you may also use $mail->Body = file_get_contents('your_mail_template.html');
$mail->Body =  html_entity_decode($Body);
$mail->AddAddress ($correo);   
// you may also use this format $mail->AddAddress ($recipient);
if(!$mail->Send()) 
{
    $respuesta="<i style='color:red'>Error, No se pudo enviar el corrreo</i>";
} else 
{

	$respuesta="Se ha enviado el correo de recuperación a <b>(".$correo.")</b>";
	
}


echo $respuesta;

?>
