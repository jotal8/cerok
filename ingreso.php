<?php
   
	include("../connectdb.php");
	  
	date_default_timezone_set('America/Bogota'); 
	$date = date('Y-m-d H:i:s', time());
	 
	 $texto="";
	 $id=0;
	 $usuario="";
	 $nombre="";
	 $telefono="";
	 $edad="";
	 $correo="";
	 $foto="";
	 
	 
$sql="SELECT * FROM cerok WHERE usuario = '".$_POST["usuario_ingresar"]."' OR correo='".$_POST["usuario_ingresar"]."'";

if ($result = $connectdb->query($sql)) {

    /* determinar el número de filas del resultado */
    $count = $result->num_rows;
	$row=mysqli_fetch_assoc($result);
    /* cerrar el resultset */

	if ($count==1){ 
		
		if (password_verify($_POST['clave_ingresar'],$row['clave'])){
				$texto="Inicio de sesión correcto";
				$id=$row['id'];
				$usuario=$row['usuario'];
				$nombre=$row['nombre'];
				$telefono=$row['telefono'];
				$edad=$row['edad'];
				$correo=$row['correo'];
				$foto=$row['foto'];
			}
	 
		else {
				$texto="<i style='color:red;'>La contraseña es incorrecta</i><br><label class='btn_basic' id='recuperar_clave' onMouseDown='recuperar_clave(".$row['id'].")' >Recuperar Contraseña</label>";
			}
 
	}

	if($count==0){
			$texto="<i style='color:red;'>El usuario no existe</i>";
			}

    $result->close(); 

}

 $respuesta=['texto'=>$texto,'id'=>$id,'usuario'=>$usuario,'nombre'=>$nombre,'telefono'=>$telefono,'edad'=>$edad,'correo'=>$correo,'foto'=>$foto];

echo json_encode($respuesta);

?>