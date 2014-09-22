<?php

	require('model/Usuario.php'); 
	class usuarioMdl{
			
		public function insertar($codigo, $nombre, $apellido, $telefono, $email){
		
			$usuario = new Usuario($codigo, $nombre, $apellido, $telefono, $email);
			#simular conexion a la base de datos
			return TRUE;
		}

		public function modificar($codigo)
		{
			#modificar usuarios a traves de su codigo
			#hacer uso de variables variables como en vehiculoMdl.php para saber los 
			#campo a modificar
			return TRUE;
		}
	}
?>