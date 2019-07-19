////////////////// vista previa de la foto de perfil en el registro ////////////////////////////

$('#seleccionar_foto').change(function(){	
			readImgUrlAndPreview(this);
			function readImgUrlAndPreview(input){
				 if (input.files && input.files[0]) {
			            var reader = new FileReader();
			            reader.onload = function (e) {			            	
			                $('#vista_previa').attr('src', e.target.result);
							$('#vista_previa').css('visibility','visible');
							}
			          }; 
			          reader.readAsDataURL(input.files[0]);
			     }	
});

 
 
 /////////////////////// validacion de formulario de registro ///////////////////////////

function validar_formulario() {
  
  var respuesta=true;
  
  if (($("input[name='correo']").val() == "")||(($("input[name='correo']").val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null))) {
     $("#texto_registrar").html("<i style='color:red'>Por favor ingrese el correo correctamente</i>");
    respuesta=false; 
  }
  
  if ($("input[name='usuario']").val() == "") {
     $("#texto_registrar").html("<i style='color:red'>Por favor ingrese el usuario</i>");
    respuesta=false; 
  }
  
  if ($("input[name='clave']").val() == "") {
     $("#texto_registrar").html("<i style='color:red'>Por favor ingrese la contraseña</i>");
    respuesta=false; 
  }
  
  if ($("input[name='nombre']").val() == "") {
     $("#texto_registrar").html("<i style='color:red'>Por favor ingrese el nombre</i>");
    respuesta=false; 
  }
  
  if ($("input[name='usuario']").val() == "") {
     $("#texto_registrar").html("<i style='color:red'>Por favor ingrese el usuario</i>");
    respuesta=false; 
  }
  
   if (isNaN($("input[name='edad']").val())) {
     $("#texto_registrar").html("<i style='color:red'>La edad debe de ser un número</i>");
    respuesta=false; 
  }
  
  return respuesta;
}
 
 
 
 function validar_formulario_cambios() {
  
  var respuesta=true;
  
   if (($("input[name='correo_cambio']").val() == "")||(($("input[name='correo_cambio']").val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null))) {
     $("#texto_guardar_cambios").html("<i style='color:red'>Por favor ingrese el correo correctamente</i>");
    respuesta=false; 
  }
   
  if ($("input[name='usuario_cambio']").val() == "") {
     $("#texto_guardar_cambios").html("<i style='color:red'>Por favor ingrese el usuario</i>");
    respuesta=false; 
  }
   
 
  if (isNaN($("input[name='edad_cambio']").val())) {
     $("#texto_guardar_cambios").html("<i style='color:red'>La edad debe de ser un número</i>");
    respuesta=false; 
  }
  
  return respuesta;
}
 
 
 
 
 
//////////////////////////  La accion de registrar un usuario nuevo //////////////////////////////
  

$( "#registrarse" ).click(function(event) {
 
	if (validar_formulario()){
		var form = $('#formulario_datos_registrar')[0];
		var formData = new FormData(form);
		
		$.ajax({
			url: "registro.php",
			data: formData,
			processData: false,
			contentType: false,
			type: 'POST',
			beforeSend: function () {
				$("#texto_registrar").html("Registrando, Un momento por favor...");
			},
			success: function (respuesta) {
				$("#texto_ingresar").html(respuesta);
				$("input[name='usuario']").val("");
				$("input[name='nombre']").val("");
				$("input[name='clave']").val("");
				$("input[name='telefono']").val("");
				$("input[name='edad']").val("");
				$("input[name='correo']").val("");
				$("input[name='foto']").val("");
				$("#vista_previa").attr("src","");
				$("#vista_previa").css("visibility","hidden");
				$("#texto_registrar").html("");
				mostrar_ingresar();
			}, 
			error: function () {
				$("#texto_registrar").html("Error");
			}
		});
	}
 
});


//////////////////////////  La accion de Inicio de sesión  //////////////////////////////
 
$( "#ingresar" ).click(function(event) {
 
	if (validar_login()){
		var form = $('#formulario_datos_ingresar')[0];
		var formData = new FormData(form);
		
		$.ajax({
			url: "ingreso.php",
			data: formData,
			processData: false,
			contentType: false, 
			type: 'POST',
			dataType: 'JSON',
			beforeSend: function () {
				$("#texto_ingresar").html("Ingresando, Un momento por favor...");
			},
			success: function (respuesta) {	 
					$("#texto_ingresar").html(respuesta.texto);
					if (respuesta.id!=0){
						iniciarSesion(respuesta.id,respuesta.usuario,respuesta.nombre,respuesta.telefono,respuesta.edad,respuesta.correo,respuesta.foto);
					}
			},
			error: function () {
				$("#texto_ingresar").html("Error Ajax");
			}
		});
	}
 
});



//////////////////////////////////////// Funciones para la parte visual, ocultar y mostrar las sesiones de inicio ////////////


function inicializar (){
	
	mostrar_ingresar();

}

function mostrar_registarse(){
	
	$("#contenido_ingresar").hide();
	$("#contenido_registrarse").show();
	$("#opcion_ingresar").show();
	$("#opcion_registrarse").hide();
	
}

function mostrar_ingresar(){
	
	$("#contenido_registrarse").hide();
	$("#contenido_ingresar").show();
	$("#opcion_registrarse").show();
	$("#opcion_ingresar").hide();
	
}

$("#opcion_registrarse").click(function() {
	
	mostrar_registarse();
	
});

$("#opcion_ingresar").click(function () {
	
	mostrar_ingresar();
	
});


inicializar();


///////////////////////////////////////////////////////////////////////////////////////////////////////////



//////////////////////// Funciones luego de iniciar sesion ///////////////////////////////////////////////
 

function iniciarSesion(id,usuario,nombre,telefono,edad,correo,foto){
	
	
	$("#index").css('display','none');
	$("#sesion").css('display','block');	
	
	$("#id_sesion").val(id);
	$("#texto_bienvenida").html('Hola <b>'+nombre+'</b> bienvenido!!');
	$("#texto_nombre").val(nombre);
	$("#texto_usuario").val(usuario);
	$("#texto_telefono").val(telefono);
	$("#texto_edad").val(edad);
	$("#texto_correo").val(correo);
	$("#foto_usuario").attr('src',foto);
	
	crearListadoUsuariosSMS();
	obtener_recibidos();
	obtener_enviados();
}


function crearListadoUsuariosSMS(){
	
	$.ajax({
        url: 'usuarios.php',
        type: 'post',
        dataType: 'JSON',
        success: function(respuesta){
            var len = respuesta.length;
            for(var i=0; i<len; i++){
                var id = respuesta[i].id;
                var nombre = respuesta[i].nombre;
                var correo = respuesta[i].correo;

                var usuarios ="<option value='"+id+"'>" + nombre +" - ("+ correo +")</option>";
 
                $("#usuarios_para").append(usuarios);
            }

        }
    });
	
}

function obtener_recibidos(){
	
	$.ajax({
        url: 'obtener_recibidos.php',
        type: 'post',
		data:{'id_sesion':$('#id_sesion').val()},
        success: function(respuesta){
			$("#numero_recibidos").html(respuesta);
        }
    });
	
}

function poner_en_visto(){
	
	$.ajax({
        url: 'poner_en_visto.php',
        type: 'post',
		data:{'id_sesion':$('#id_sesion').val()},
        success: function(respuesta){
			//
			var a="ok";
        }
    });
	
}


function obtener_mensajes_recibidos(){
	
	$("#recibidos").empty();
	
	$.ajax({
        url: 'obtener_mensajes_recibidos.php',
        type: 'post',
		data:{'id_sesion':$('#id_sesion').val()},
		dataType: 'JSON',
        success: function(respuesta){
			if (respuesta!=null){
				var len = respuesta.length;
				for(var i=0; i<len; i++){
					var nombre= respuesta[i].nombre;
					var correo= respuesta[i].correo;
					var mensaje= respuesta[i].mensaje;
					
					var composicion='<h3>'+(i+1)+'</h3><div> DE: '+nombre+' - <b>('+correo+')</b></div><br><div>"'+mensaje+'"</div><hr/>';
					  
					$("#recibidos").append(composicion); 
				}
			}
			else {
				$("#recibidos").append("No hay mensajes recibidos"); 
			}
        }
    });
	
}

function obtener_mensajes_enviados(){
	
	$("#enviados").empty();
	
	$.ajax({
        url: 'obtener_mensajes_enviados.php',
        type: 'post',
		data:{'id_sesion':$('#id_sesion').val()},
		dataType: 'JSON',
        success: function(respuesta){
			if (respuesta!=null){
				var len = respuesta.length;
				for(var i=0; i<len; i++){
					var nombre= respuesta[i].nombre;
					var correo= respuesta[i].correo;
					var mensaje= respuesta[i].mensaje;
					var estado=respuesta[i].estado;
					
					var composicion='';
					if (estado==0){
						composicion='<h3>'+(i+1)+'</h3><div> PARA: '+nombre+' - <b>('+correo+')</b></div><br><div>"'+mensaje+'"</div><hr/>';
					} 
					if (estado==1) {
						composicion='<h3>'+(i+1)+'</h3><div> PARA: '+nombre+' - <b>('+correo+')</b></div><br><div>"'+mensaje+'"</div><img title="El mensaje ya ha sido leido" class="ok" src="img/ok.png" width="24" /><hr/>';
					
					}  
					$("#enviados").append(composicion); 
				} 
			}	
			
			else {
				$("#enviados").append("No hay mensajes enviados");
			}
			
        }
    });
	
} 


function obtener_enviados(){
	
	$.ajax({
        url: 'obtener_enviados.php',
        type: 'post',
		data:{'id_sesion':$('#id_sesion').val()},
        success: function(respuesta){
			$("#numero_enviados").html(respuesta);
        }
    });
	
}

$("#boton_redactar").click(function (){
	
	$("#redactar").css('display','block');
	$("#recibidos").css('display','none');
	$("#enviados").css('display','none');
	$("#boton_recibidos").removeClass('active');
	$("#boton_enviados").removeClass('active');
	$("#boton_redactar").addClass('active');
});

$("#salir").click(function (){
	
	$("#redactar").css('display','block');
	$("#recibidos").css('display','none');
	$("#enviados").css('display','none');
	$("#boton_recibidos").removeClass('active');
	$("#boton_enviados").removeClass('active');
	$("#boton_redactar").addClass('active');
	$("#id_sesion").val(0);
	$("#sesion").css('display','none');
	$("#index").css('display','block');
	$("#texto_ingresar").html("");
	$("input[name='usuario_ingresar']").val("");
	$("input[name='clave_ingresar']").val("");
	$("#texto_guardar_cambios").html("");
	$("#usuarios_para").empty();
	$("#texto_enviar_mensaje").html("");
	 
});


$("#salir_recuperar_clave").click(function (){
	
	$(this).hide();
	$("#contenedor_recuperar_clave").hide();
	$("#contenedor_app").show();
	 
});

$("#boton_recibidos").click(function (){
	
	$("#redactar").css('display','none');
	$("#recibidos").css('display','block');
	$("#enviados").css('display','none');
	$("#boton_redactar").removeClass('active');
	$("#boton_recibidos").addClass('active');
	$("#boton_enviados").removeClass('active');
	obtener_mensajes_recibidos();
});

$("#boton_enviados").click(function (){
	
	$("#redactar").css('display','none');
	$("#enviados").css('display','block');
	$("#recibidos").css('display','none');
	$("#boton_redactar").removeClass('active');
	$("#boton_enviados").addClass('active');
	$("#boton_recibidos").removeClass('active');
	obtener_mensajes_enviados();
});


///////////////////  Funcion de envio de mensaje ///////////////////////////


$("#enviar_mensaje").click(function (){
	
	if (validar_mensaje()){
		$.ajax({
			url: "crear_mensaje.php",
			data: {'de':$("#id_sesion").val(),
					'para':$("#usuarios_para").val(),
					'mensaje':$("#nuevo_sms").val()
			},
			type: 'POST', 
			beforeSend: function () {
				$("#texto_enviar_mensaje").html("Enviando mensaje, Un momento por favor...");
			},
			success: function (respuesta) { 
				$("#texto_enviar_mensaje").html(respuesta);
				$("#nuevo_sms").val('').empty();
				$("#usuarios_para").val(0);
				obtener_recibidos(); 
				obtener_enviados();
			},
			error: function () {
				$("#texto_enviar_mensaje").html("Error, No se pudo enviar el mensaje");
			}
		});
	}
});



/////////////// Validacion de mensaje //////////////////


function validar_mensaje() {
  
  var respuesta=true;
  
  if ($("textarea[name='nuevo_sms']").val() == "") {
     $("#texto_enviar_mensaje").html("<i style='color:red'>Por favor no envie el mensaje vacio</i>");
    respuesta=false; 
  }
  
   if ($("select[name='to']").val() == 0) {
     $("#texto_enviar_mensaje").html("<i style='color:red'>Por favor seleccione al destinatario</i>");
    respuesta=false; 
  }
  
  return respuesta;
}



///////////////////// Validando Login ////////////////////////////////////

function validar_login() {
  
  var respuesta=true;
  
  if ($("input[name='clave_ingresar']").val() == "") {
     $("#texto_ingresar").html("<i style='color:red'>Por favor ingrese su contraseña</i>");
    respuesta=false; 
  }
  
  if ($("input[name='usuario_ingresar']").val() == "") {
     $("#texto_ingresar").html("<i style='color:red'>Por favor ingrese su usuario o su correo</i>");
    respuesta=false; 
  }
  
  return respuesta;
}


///////////////////// Validar la nueva contraseña  ////////////////////////////////////

function validar_claves() {
  
  var respuesta=true;
  
  if ($("input[name='clave1']").val()=="" || $("input[name='clave2']").val()=="" ) {
     $("#texto_recuperar_clave").html("<i style='color:red'>Por favor escriba la nueva clave 2 veces</i>");
    respuesta=false; 
  }
  
  if ($("input[name='clave1']").val() != $("input[name='clave2']").val() ) {
     $("#texto_recuperar_clave").html("<i style='color:red'>Las contraseñas son diferentes</i>");
    respuesta=false; 
  }
  
  return respuesta;
}

/////////////////////////////// Recuperacion de contraseña ////////////////////////////////////////////////


function recuperar_clave(id){
	
	
	$.ajax({
        url: 'recuperar_clave.php',
        type: 'post',
		data:{'id':id},
		beforeSend: function () {
				$("#texto_ingresar").html("Enviando el correo de recuperación<br>Un momento por favor...");
				$("#recuperar_clave").hide();
			},
        success: function(respuesta){
			$("#texto_ingresar").html(respuesta);
        }
    });
	
}



$("#boton_recuperar_clave").click(function (){
	
	if (validar_claves()){
		
		$.ajax({
        url: 'restaurar_clave.php',
        type: 'post',
		data:{'id_rc':id_rc,
			'clave1':$("input[name='clave1']").val()},
		beforeSend: function () {
				$("#texto_recuperar_clave").html("Procesando<br>Un momento por favor...");
			},
        success: function(respuesta){
			$("#texto_recuperar_clave").html(respuesta);
			if (respuesta==0){
				
				$("input[name='clave1']").val("");
				$("input[name='clave2']").val(""); 
			}

			if (respuesta==1){
				
				$("#contenedor_recuperar_clave").hide();
				$("#contenedor_app").show();
				$("#salir_recuperar_clave").hide();
				$("#texto_ingresar").html("La contraseña se ha restaurado correctamente");
			}
        }
    });
		
	}
});


///////////////////////////////////  Funcion guardar cambios de datos personales /////////////////////////////////////////


$("#boton_guardar_cambios").click(function (){
	 
	if (validar_formulario_cambios()){ 
		$.ajax({
			url: "guardar_cambios.php",
			data: { 
					'id_sesion':$("#id_sesion").val(),
				    'usuario':$("input[name='usuario_cambio']").val(),
					'nombre':$("input[name='nombre_cambio']").val(),
					'telefono':$("input[name='telefono_cambio']").val(),
					'edad':$("input[name='edad_cambio']").val(),
					'correo':$("input[name='correo_cambio']").val(),
			},
			type: 'POST', 
			beforeSend: function () {
				$("#texto_guardar_cambios").html("Guardando los cambios, Un momento por favor...");
			},
			success: function (respuesta) { 
				if (respuesta==1){
					$("#texto_guardar_cambios").html("Los cambios se realizaron correctamente");
				}
				
				else {
					$("#texto_guardar_cambios").html("<i style='color:red;'> Error, No se realizaron los cambios.</i>");
				}
			}, 
			error: function () {
				$("#texto_guardar_cambios").html("Error, No se modificó los datos");
			}
		});
	}
});