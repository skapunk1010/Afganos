<?php

	require('model/Usuario.php'); 
	class usuarioMdl{
		
		//inserta un nuevo usuario en la base de datos 
		//retorna verdadero son fue exitoso el movimiento
		public function insertar($codigo, $nombre, $apellido, $telefono, $email){
		
			$usuario = new Usuario($codigo, $nombre, $apellido, $telefono, $email);
			#simular conexion a la base de datos
			return TRUE;
		}

		//Modifica información de un usuario por medio del código
		//retorna verdadero en caso de un movimiento exitoso.
		public function modificar($codigo)
		{
			#modificar usuarios a traves de su codigo
			#hacer uso de variables variables como en vehiculoMdl.php para saber los 
			#campo a modificar
			return TRUE;
		}
	}
?>