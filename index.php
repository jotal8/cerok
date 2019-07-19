<?php

	if (isset($_GET['rc'])){
		echo "<script>var recuperar_clave=true;</script>";
	}
	else{
		echo "<script>var recuperar_clave=false;</script>";
	}
	
?>

<!DOCTYPE html>
<html>
<head><title>CERO K TEST</title>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<link rel="stylesheet" href="css/estilos.css">
</head> 
<body> 
<div id="contenedor">
    <div class="panel panel-default">
    <div class="panel-heading"><img class="logo" src="img/logocerok.jpg" /></div>
        <div class="panel-body" id="contenedor_app">
			<div id="index">
				<label class="btn btn_basic" id="opcion_ingresar" >  &#60; INGRESAR</label><label class="btn btn_basic" id="opcion_registrarse" > REGISTRARSE  &#62;</label>
				<hr>
				<div id="contenido_ingresar">
				<form id="formulario_datos_ingresar" method="post" accept-charset="utf-8">
				<h4><b>INICIAR SESI&Oacute;N</b></h4>
				<br>
				<br>
				<b>Usuario</b> <br><input type="text" name="usuario_ingresar" placeHolder="Ingrese su usuario o correo"/>
					<hr> 
				<b>Clave</b><br> <input type="password" name="clave_ingresar" placeHolder="Ingrese su contraseña" />
					<hr> 
					<div id="texto_ingresar" ></div>
				<div class="panel-heading"><label class="btn btn_basic large" id="ingresar" > Ingresar</label></div>	
				</form>
				</div>
				<div id="contenido_registrarse">
				<form id="formulario_datos_registrar" onsubmit="return validateForm()" enctype="multipart/form-data" method="post" accept-charset="utf-8">
					<div id="info_personal"class="row">
					<h4><b>REGISTRATE GRATIS!</b></h4>
					<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> 
					<b>Usuario</b><br> <input type="text" name="usuario"/>
					<hr/>   
					<b>Nombre</b><br><input type="text" name="nombre" />
					<hr/>
					<b>Clave</b><br> <input type="password" name="clave" />
					<hr/>
					</div>
					<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> 
					<b>Telefono</b><br> <input type="text" name="telefono" />
					<hr/>
					<b>Edad </b><br><input type="text" name="edad" />  
					<hr/> 
					<b>Correo </b><br><input type="email" name="correo" />
					<hr/> 
					</div> 
					</div>
					<input id="seleccionar_foto" type="file" name="foto" /> <label class="btn btn_basic" for="seleccionar_foto"> Seleccione la foto de perfil</label> 
					<img id="vista_previa" />
					<hr> 
					<div id="texto_registrar" ></div>
					<div class="panel-heading"><label class="btn btn_basic" id="registrarse" > Registrarse</label></div>    
				</form>
				 </div> 
			</div>
			<div id="sesion">
				<form>
				<div id="texto_bienvenida" ></div>
				<br>
				<input id="id_sesion" type="hidden" />
				<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> 				
				<h4>Datos Personales</h4>
					<img id="foto_usuario" width=120 />
				</div>
				<div id="info_personal" class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6"> 
				<br>
					<hr/>
					<b>Nombre</b> &nbsp;<input name="nombre_cambio" type="text" size=14 id="texto_nombre" /><br>
					<b>Usuario</b> &nbsp;<input name="usuario_cambio" type="text" size=14 id="texto_usuario" /><br>
					<b>Telefono</b> &nbsp;<input name="telefono_cambio" type="text" size=14 id="texto_telefono" /><br>
					<b>Edad</b> &nbsp;<input name="edad_cambio" type="text" size=14 id="texto_edad" /><br>
					<b>Correo</b> &nbsp;<input name="correo_cambio" type="email" size=14 id="texto_correo" /><br>
					<hr/> 
					<label class="btn btn_basic" id="boton_guardar_cambios" >Guardar cambios</label> 
					<div id="texto_guardar_cambios" ></div>
					<hr/>
				</div> 
				 
				<div id="sms">
	  		 		  
					<ul class="nav nav-tabs">
						  <li class="active" id="boton_redactar"><a>Redactar </a></li>
						  <li id="boton_recibidos"><a>Recibidos</a><i id="numero_recibidos"></i></li>
						  <li id="boton_enviados"><a>Enviados</a><i id="numero_enviados"></i></li>
					</ul>  
	 				 
					<div id="redactar">
						<select id="usuarios_para" name="to"><option value="0">Seleccione a quien enviar mensaje</option></select>
						<br>
						<textarea name="nuevo_sms" id="nuevo_sms"></textarea>
						<label class="btn btn_basic" id="enviar_mensaje" >Enviar Mensaje</label> 
						<div id="texto_enviar_mensaje" ></div>
					</div>
					
					<div id="recibidos">
						<div class="tmp_height"></div>
					</div>
					
					<div id="enviados">
						<div class="tmp_height"></div>
					</div>
				</div>
				</form>
				<label class="btn btn_basic rojo" id="salir" >Cerrar Sesión</label> 
			</div>
			
		</div>
		
		<div class="panel-body" id="contenedor_recuperar_clave">
		
			<div class="titulo_recuperar_clave" >Recuperar Contraseña</div>
			
			Ingrese la nueva contraseña <br><input type="password" name="clave1" />
			<br>
			Ingrese otra vez la contraseña <br><input type="password" name="clave2" />
			<br>
			<br>
			<label class="btn_basic" id="boton_recuperar_clave">Modificar Contraseña</label>
			<div id="texto_recuperar_clave" ></div>
		</div>
			<label class="btn btn_basic rojo" id="salir_recuperar_clave" >Cancelar</label> 	
    </div> 
	<div class="footer"><b>MiniSaia</b></div>
	
</div> 

<script src="https://code.jquery.com/jquery.js"></script>
<script src="../bootstrap/js/bootstrap.js"></script>
<? 
	
	
	if (isset($_GET['rc'])){
		echo '<script>$("#contenedor_app").hide();
		$("#contenedor_recuperar_clave").show();
	var id_rc='.$_GET['rc'].'
		</script>';
	}
	if (!isset($_GET['rc'])){
		echo '<script>$("#contenedor_recuperar_clave").hide();$("#salir_recuperar_clave").hide();
		$("#contenedor_app").show();</script>';
	}


?>
<script src="js/app.js"></script>
</body>
</html>