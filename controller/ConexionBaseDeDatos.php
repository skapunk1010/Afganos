<?php
	class ConexionBaseDeDatos{
		private static $conexion;

		public static function getInstance(){
			if(self::$conexion === null){
				require('config_bd.inc');
				self::$conexion = new mysqli(HOST,USUARIO,CONTRASENHA,NOMBRE_BD);
				if(self::$conexion->connect_error){
					//Vista de error en la conexión a la base de datos
					 die('Fallo la base de datos');
				}
			}
			return self::$conexion;
		}
	}
?>