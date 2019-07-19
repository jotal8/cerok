<?php
   
	include("../connectdb.php");
	  
	date_default_timezone_set('America/Bogota'); 
	$date = date('Y-m-d H:i:s', time());
	 
	 
$sql="SELECT * FROM sms WHERE 1";

if ($result = $connectdb->query($sql)) {

    $count = $result->num_rows;
	$count++;

}

$sql_crear_mensaje="INSERT INTO sms (idSMS,de,para,mensaje,creado,estado) VALUES ('".$count."','".$_POST['de']."','".$_POST['para']."','".$_POST['mensaje']."','".$date."','0')";

	if ($result_crear_mensaje= $connectdb->query($sql_crear_mensaje)) {

		$respuesta="El mensaje se ha enviado correctamente";
	} 

	else {	
		
		$respuesta="Error, no se pudo enviar el mensaje";
		
	}
	
	echo $respuesta;

?>