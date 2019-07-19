<?php
   
include("../connectdb.php");
	  
date_default_timezone_set('America/Bogota'); 
$date = date('Y-m-d H:i:s', time());

	 
$sql="SELECT * FROM sms WHERE de=".$_POST['id_sesion'];

if ($result = $connectdb->query($sql)) {

    $count = $result->num_rows;
 
}

echo $count;

?>