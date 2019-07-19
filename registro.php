<?php 

	include("../connectdb.php");
	 
	date_default_timezone_set('America/Bogota'); 
	$date = date('Y-m-d H:i:s', time());
	  
	$sql="SELECT * FROM cerok WHERE 1";
	 
	if ($result = $connectdb->query($sql)) {
 
    $count = $result->num_rows;
	$count++;
  
	}

	$response="";
	$estado_foto=false;
	$password=password_hash($_POST['clave'],PASSWORD_DEFAULT);
	
	
$sql_existente="SELECT * FROM cerok WHERE usuario='".$_POST['usuario']."' OR correo='".$_POST['correo']."' ";
	 
	if ($result_existente = $connectdb->query($sql_existente)) {
 
    $count_existente = $result_existente->num_rows;
  
	}
	
 	

////////////////////// Aqui se organiza la foto para subirla al directorio del servidor y se genera la url de la misma //////////

if ($count_existente==0){
require 'class.upload.php';
 
$newName = substr(md5(time()), 0, 20);
$target_dir = "img/fotos_usuarios/";
$target_file = $target_dir . basename($_FILES["foto"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$newUrl=$target_dir;
$newUrlData=$target_dir.$newName.".jpg";

$estado_foto=false;

// Check if image file is a actual image or fake image
if($_POST['foto']=="") {
    
	$sql_registro="INSERT INTO cerok (id,usuario,nombre,clave,telefono,edad,correo,fecha_creacion,foto) VALUES ('".$count."','".$_POST['usuario']."','".$_POST['nombre']."','".$password."','".$_POST['telefono']."','".$_POST['edad']."','".$_POST['correo']."','".$date."','img/usuario.png')";

	if ($result_registro = $connectdb->query($sql_registro)) {

		$response="El usuario se ha registrado correctamente";
		
	} 

	else {	
		
		$response="Error";
		
	}	
        
}

else {
	if (file_exists($target_file)) {
	   
		$uploadOk = 0;
	}
	
	if ($_FILES["foto"]["size"] > 16000000) {
		
		$uploadOk = 0;
	} 

	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		
		$uploadOk = 0;
	}

	if ($uploadOk == 0) {	
	   
	
	} else {
	   
		$foo = new upload($_FILES['foto']); 
			
	if ($foo->uploaded) {
	 
	   $foo->file_new_name_body = $newName;
	   $foo->image_resize = true;
	   $foo->image_convert ='jpg';  
	   $foo->image_x = 300;
	   $foo->image_ratio_y = true;
	   $foo->process($newUrl);
		
	   if ($foo->processed) {
			 
			 $estado_foto=true;
			
		 $foo->clean();
	   } else {
		 echo 'error : ' . $foo->error;
	   } 
	}  	
	}	 



/////////////////////// Aqui crea el registro del usuario ///////////////////////////////////////

if ($estado_foto){

	$sql_registro="INSERT INTO cerok (id,usuario,nombre,clave,telefono,edad,correo,fecha_creacion,foto) VALUES ('".$count."','".$_POST['usuario']."','".$_POST['nombre']."','".$password."','".$_POST['telefono']."','".$_POST['edad']."','".$_POST['correo']."','".$date."','".$newUrlData."')";

	if ($result_registro = $connectdb->query($sql_registro)) {

		$response="El usuario se ha registrado correctamente";
		//$result_registro->close();
	} 

	else {	
		
		$response="Error";
		
	}
}

else {
	
	$response="Error al subir la foto";
	
}

}

}

else {
	
	$response="El usuario o correo ya existen";
}
echo $response;

?>