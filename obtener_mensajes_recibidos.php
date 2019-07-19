<?php
   
include("../connectdb.php");
	  
date_default_timezone_set('America/Bogota'); 
$date = date('Y-m-d H:i:s', time());

$sql="SELECT * FROM sms WHERE para=".$_POST['id_sesion']." ORDER by creado DESC";

if ($result = $connectdb->query($sql)) {

    $count = $result->num_rows;

} 
 

while($row = mysqli_fetch_array($result)){
  
  $sql_visto="UPDATE sms SET estado=1 WHERE idSMS=".$row['idSMS'];
	 
    if ($result_visto = $connectdb->query($sql_visto)) {
			$sql_usuario="SELECT * FROM cerok WHERE id=".$row['de'];

			if ($result_usuario = $connectdb->query($sql_usuario)) {
				$row_usuario=mysqli_fetch_assoc($result_usuario);
				$nombre = $row_usuario['nombre'];
				$correo = $row_usuario['correo'];
			} 
			$mensaje = $row['mensaje'];
		  
			$respuesta[] = array("nombre" => $nombre,
							"correo" => $correo,
							"mensaje" => $mensaje
							); 
		}
	}
	
echo json_encode($respuesta);

?>