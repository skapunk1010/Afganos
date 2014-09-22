<?php

	class validadorCtrl{
	
		/**
		*Valida que sólo sea ingresado texto.
		*@param String $texto recibe una cadena de texto a validar
		*@return boolean dependiendo de su validez. 
		*/
		public static function validarTxt($texto){
			return $texto; #cambiar a boolean
		}
		
		/**
		*Valida que sólo contenga números.
		*@param $num
		*@return boolean dependiendo de su validez. 
		*/
		public static function validarNum($num){
			if(is_numeric($num))
				return $num;
			else return 0; #cambiar a boolean
		}
		
		/**
		*Valida que tenga la estructura de un correo.
		*@param $email recibe una cadena en formato de correo
		*@return boolean dependiendo de su validez.
		*/
		public static function validarEmail($email){
			return $email; #cambiar a boolean
		}

		/**
		*Valida que tenga la estructura de un VIN
		*@param $vin recibe una cadena en formato de VIN
		*@return boolean dependiendo de su validez.
		*/
		public static function validarVin($vin){
			return $vin; #cambiar a boolean
		}

		/**
		*Valida que sea números y formato de año.
		*@param $anho recibe una cadena en formato de año
		*@return boolean dependiendo de su validez.
		*/
		public static function validarAnho($anho){
			return $anho; #cambiar a boolean
		}

		/**
		*Valida que contenga estructura de un usuario.
		*@param $usuario recibe una cadena de usuario
		*@return boolean dependiendo de su validez.
		*/
		public static function validarUsuario($usuario){
			#Validacion con expresión regular
			return $usuario; #cambiar a boolean
		}

		/**
		*Valida que tenga estructura de una contraseña.
		*@param $password recibe una cadena de contraseña
		*@return boolean dependiendo de su validez.
		*/
		public static function validarPassword($password){
			#Validacion con expresión regular
			return $password; #cambiar a boolean
		}

	}
	
?>