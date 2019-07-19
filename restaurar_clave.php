<?php
   
include("../connectdb.php");
	  
date_default_timezone_set('America/Bogota'); 
$date = date('Y-m-d H:i:s', time());

$respuesta="inicializando";
	 
$nueva_clave=password_hash($_POST['clave1'],PASSWORD_DEFAULT);
	 
$sql_clave="UPDATE cerok SET clave='".$nueva_clave."' WHERE id=".$_POST['id_rc'];
 
if ($result_clave = $connectdb->query($sql_clave)) {
	
	$respuesta=1;
	
}


else { $respuesta=0;}


echo $respuesta;

?>
