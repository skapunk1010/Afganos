<?php

	class validadorCtrl{
	
		public static function validarTxt($texto){
			return $texto;
		}
	
		public static function validarNum($num){
			if(is_numeric($num))
				return $num;
			else return 0;
		}
	
		public static function validarEmail($email){
			return $email; 
		}

		public static function validarVin($vin){
			return $vin;
		}

		public static function validarAnho($anho){
			return $anho;
		}

		public static function validarUsuario($usuario){
			#Validacion con expresión regular
			return $usuario;
		}

		public static function validarPassword($password){
			#Validacion con expresión regular
			return $password;
		}

	}
	
?>