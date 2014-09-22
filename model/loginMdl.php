<?php

	class loginMdl{
		
		/**
		*Función encargada del inicio de sesión de un usuario.
		*@param String $usuario recibe una cadena de usuario
		*@param String $password recibe una cadena de contraseña
		*@return boolean dependiendo de su validez. 
		*/
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

		/**
		*Función para registrar a un usuario.
		*@param String $usuario recibe una cadena de usuario
		*@param String $password recibe una cadena de contraseña
		*@return boolean dependiendo de su validez. 
		*/
		public function signin($usuario,$password){
			#Establecer conexion con BD
			#Insertar usuario y password a BD
			#Crear variables de sesion
			#Redireccionar a view index
			return TRUE;
		}

	}
?>