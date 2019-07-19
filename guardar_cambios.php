<?php
   
include("../connectdb.php");
	  
date_default_timezone_set('America/Bogota'); 
$date = date('Y-m-d H:i:s', time());

$respuesta="inicializando";
	 	 
$sql_guardar_cambios="UPDATE cerok SET usuario='".$_POST['usuario']."',nombre='".$_POST['nombre']."',telefono='".$_POST['telefono']."',correo='".$_POST['correo']."',edad='".$_POST['edad']."' WHERE id=".$_POST['id_sesion'];
 
if ($result_guardar_cambios = $connectdb->query($sql_guardar_cambios)) {
	
	$respuesta=1;
	
}


else { $respuesta=0;}


echo $respuesta;

?>
