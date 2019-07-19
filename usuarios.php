<?php
   
	include("../connectdb.php");
	  
	date_default_timezone_set('America/Bogota'); 
	$date = date('Y-m-d H:i:s', time());
	 
	 $id=0;
	 $nombre="";
	 $correo="";
	 
$sql="SELECT * FROM cerok ORDER BY nombre";

if ($result = $connectdb->query($sql)) {

    /* determinar el número de filas del resultado */
    $count = $result->num_rows;

	if ($count>0){ 
		
		while($row = mysqli_fetch_array($result)){
			$id = $row['id'];
			$nombre = $row['nombre'];
			$correo = $row['correo'];

			$respuesta[] = array("id" => $id,
							"nombre" => $nombre,
							"correo" => $correo);
		}
	}
	
	else {
		
		$respuesta[]="";
		
	}

}
echo json_encode($respuesta);

?>