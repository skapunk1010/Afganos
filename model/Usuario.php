<?php
	
	class Usuario{

		private $Codigo;
		private $usuario;
		private $contrasenha;
		private $status;
		private $fechaRegistro;
		private $privilegios;

		/**
		*Constructor
		*/
		function __construct($usuario, $Contrasenha, $status, $fechaRegistro,$privilegios){

			$this -> usuario = $usuario;
			$this -> contrasenha = $Contrasenha;
			$this -> status = $status;
			$this -> fechaRegistro = $fechaRegistro;
			$this -> privilegios = $privilegios;
		}


		/**
		*@return String Regresa código
		*/
		public function getCodigo(){
			return $this -> Codigo;
		}

		/**
		 *@return String Nickname del usuario.
		 */
		public function getUsuario(){
			return $this -> usuario;
		}

		/**
		*@return String Regresa contraseña
		*/
		public function getContrasenha(){
			return $this -> contrasenha;
		}

		/**
		*@return String Regresa status
		*/
		public function getStatus(){
			return $this -> status;
		}


		/**
		*@return String Regresa fecha de registro
		*/
		public function getFechaRegistro(){
			return $this -> fechaRegistro;
		}

		/**
		 *@return String Regresa los privilegios que tiene el usuario.
		 */
		public function getPrivilegios(){
			return $this -> privilegios;
		}

		/**
		*@param String $Codigo recibe el código
		*/
		public function setCodigo($Codigo){
			$this -> Codigo = $Codigo;
		}

		/**
		 *@param String $usuario Nickname del usuario.
		 */
		public function setUsuario($usuario){
			$this->usuario = $usuario;
		}

		/**
		*@param String $contrasenha recibe una contraseña
		*/
		public function setContrasenha($contrasenha){
			$this -> contrasenha = $contrasenha;
		}

		/**
		*@param String $status recibe el status de un usuario 
		*/
		public function setStatus($status){
			$this -> status = $status;
		}


		/**
		*@param String $fechaRegistro recibe la fecha de registro
		*/
		public function setFechaRegistro($fechaRegistro){
			$this -> fechaRegistro = $fechaRegistro;
		}

		/**
		 *@param String $privilegios Recibe el nombre de los privilegios que tiene el usuario.
		 */
		public function setPrivilegios($privilegios){
			$this -> privilegios = $privilegios;
		}
	}


?>
