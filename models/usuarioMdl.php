<?php

	require('models/Usuario.php'); 
	class usuarioMdl{
	
		private $usuario;
		
		public function insertarUsuario($nombre, $apellido, $telefono, $email){
		
			$usuario = new Usuario($nombre, $apellido, $telefono, $email);
			#simular conexion a la base de datos
			return TRUE;
		}
	}
?>