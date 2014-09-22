<?php

	class validadorCtrl{
	
		//Valida que sólo sea ingresado texto.
		public static function validarTxt($texto){
			return $texto;
		}
		
		//Valida que sólo contenga números.
		public static function validarNum($num){
			if(is_numeric($num))
				return $num;
			else return 0;
		}
		
		//Valida que tenga la estructura de un correo.
		public static function validarEmail($email){
			return $email; 
		}

		//Valida que tenga la estructura de un VIN
		public static function validarVin($vin){
			return $vin;
		}

		//Valida que sea números y formato de año.
		public static function validarAnho($anho){
			return $anho;
		}

		//Valida que contenga estructura de un usuario.
		public static function validarUsuario($usuario){
			#Validacion con expresión regular
			return $usuario;
		}

		//Valida que tenga estructura de una contraseña.
		public static function validarPassword($password){
			#Validacion con expresión regular
			return $password;
		}

	}
	
?>