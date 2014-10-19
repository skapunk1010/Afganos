<?php

	class loginMdl{
		private $conexion;

		function __construct(){
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/**
		*Función encargada del inicio de sesión de un usuario.
		*@param String $usuario recibe una cadena de usuario
		*@param String $password recibe una cadena de contraseña
		*@return bool dependiendo de su validez. 
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
		*@return bool dependiendo de su validez. 
		*/
		public function signin($usuario,$password){
			#Establecer conexion con BD
			#Insertar usuario y password a BD
			#Crear variables de sesion
			#Redireccionar a view index
			return TRUE;
		}

		/**
		 * Cierra la sesión que actualmente ha sido iniciada.
		 */
		public function cerrarSesion(){
			session_unset();
			session_destroy();		
			setcookie(session_name(), '', time()-3600);
		}

	}
?>