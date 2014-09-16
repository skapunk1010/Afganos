<?php

	class loginMdl{
		
		public function iniciarSesion($usuario,$password){
			#Establecer conexión con BD
			#if(Validar si usuario está registrado en BD){
			#  iniciar variables de sesión
			#  redireccionar al view index
			#  return TRUE;
			#}else {
			#  marcar error de login
			#  redireccionar a view login
			#  return FALSE;
			#}
			return TRUE;
		}

		public function signin($usuario,$password){
			#Establecer conexion con BD
			#Insertar usuario y password a BD
			#Crear variables de sesion
			#Redireccionar a view index
			return TRUE;
		}

	}
?>