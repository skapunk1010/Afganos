<?php

	class validadorCtrl{
		private const REGEXP_EMAIL 		= "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
		private const REGEXP_TEXTO		= "/^(\w|\W)+$/";
		private const REGEXP_TELEFONO	= "/^[\d]{8,16}$/";
		private const REGEXP_USUARIO 	= "/^[a-z0-9_-]{5,20}$/";
		private const REGEXP_CONTRASENHA= "/^(?=.*\d)(?=.*\W)(?=.*[a-z])(?=.*[A-Z]).{5,20}$/";
		private const REGEXP_VIN		= "/^[a-zA-Z\d]{16}$/";
		private const REGEXP_ANHO		= "/^[\d]{4}$/";
		private const REGEXP_NOMBRE		= "/^[a-zA-Z]+$/";
		private const REGEXP_CODIGO_POSTAL = "/^[\d]{3,10}$/"; 

		/**
		*Valida que tenga la estructura de un email.
		*@param string $email Dirección de email.
		*@return boolean Regresa TRUE si el email tiene el formato correcto.FALSE, en caso contrario.
		*/
		public static function validarEmail($email){
			if(preg_match(REGEXP_EMAIL, $email)){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		/**
		*Valida que sólo sea ingresado texto. 
		*@param string $texto recibe una cadena de texto a validar
		*@return boolean Regresa TRUE si el texto validado es correcto.
		*				FALSE, en caso contrario.
		*/
		public static function validarTexto($texto){
			if(preg_match(REGEXP_TEXTO, $texto)){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		/**
		 * Validación de un número telefónico.
		 * @param string $telefono Cadena con el número telefónico.
		 * @return boolean Regresa TRUE si el número telefónico es válido. FALSE, en caso contrario.
		 */
		public static function validarTelefono($telefono){
			if(preg_match(REGEXP_TELEFONO, $telefono)){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		 *Valida que contenga estructura de un usuario.
		 *El usuario sólo debe contener:
		 *<ul>
		 *	<li>Letras minúsculas.</li>
		 *	<li>Números</li>
		 *	<li>Guión bajo y guión medio.</li>
		 *	<li>Longitud mínima de 5 caracteres y máxima de 20</li>
		 *</ul>
		 *@param string $usuario Recibe una cadena de usuario.
		 *@return boolean Regresa TRUE si el usuario tiene el formato válido. FALSE, en caso contrario.
		 */
		public static function validarUsuario($usuario){
			if(preg_match(REGEXP_USUARIO, $usuario)){
				return TRUE;
			}else{
				return FALSE;
			}
		}


		/**
		*Valida que sólo contenga números.
		*@param integer $numero Numero a validar,
		*@return boolean Regresa TRUE si el dato introducido es un número. FALSE, en caso contrario.
		*/
		public static function validarNumero($numero){
			if(is_numeric($numero)){
				return TRUE;
			}else{
				return FALSE;
			}
		}
		
		/**
		*Valida que tenga estructura de una contraseña.
		*<ul>
		 *	<li>Una letra minúscula.</li>
		 *	<li>Una letra mayúscula.</li>
		 *	<li>Un número.</li>
		 *	<li>Un caracter especial (*, . , #, @, ?, ¿, !, ¡,etc)</li>
		 *	<li>Longitud mínima de 5 caracteres y máxima de 20.</li>
		 *</ul>
		*@param string $password Recibe una cadena de contraseña
		*@return boolean Regresa TRUE si la tiene un formatio válido. FALSE en caso contrario.
		*/
		public static function validarContrasenha($contrasenha){
			if(preg_match(REGEXP_CONTRASENHA, $contrasenha)){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		/**
		*Valida que tenga la estructura de un VIN
		*@param string $vin Recibe una cadena en formato de VIN.
		* El vin debe de tener una longitud de 16 caracteres, entre letras y números.
		*@return boolean Regresa TRUE si el vin tiene un fomato correcto.
		*FALSE en caso contrario.
		*/
		public static function validarVin($vin){
			if(preg_match(REGEXP_VIN, $vin)){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		/**
		*Valida que sea números y formato de año. Debe de tener un formato de 4 dígitos.
		*@param string $anho recibe una cadena en formato de año
		*@return boolean Regresa TRUE si la cadena tiene un formato válido para el año.
		*FALSE, en caso contrario.
		*/
		public static function validarAnho($anho){
			if(preg_match(REGEXP_ANHO, $anho)){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		/**
		 * Valida que el nombre sea válido. Solo debe contener letras mayúsculas o minúsculas.
		 *@param string $nombre Cadena con el nombre a validar.
		 *@return boolean Regresa TRUE si la cadena tiene un formato válido para el nombre.
		 *FALSE en caso contrario.
		 */
		public static function validarNombre($nombre){
			if(preg_match(REGEXP_NOMBRE, $nombre)){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		public static function validarCodigoPostal($codigoPostal){
			if(preg_match(REGEXP_CODIGO_POSTAL, $codigoPostal)){
				return TRUE;
			}else{
				return FALSE;
			}
		}
	}
	
?>