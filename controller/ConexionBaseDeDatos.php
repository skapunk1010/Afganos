<?php
	class ConexionBaseDeDatos{
		private static $conexion;

		public static function getInstance(){
			if(self::$conexion === null){
				require('config_bd.inc');
				self::$conexion = new mysqli(HOST,USUARIO,CONTRASENHA,NOMBRE_BD);
			}
			return self::$conexion;
		}
	}
?>