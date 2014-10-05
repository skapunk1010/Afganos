<?php
	
	class Usuario{

		private $Codigo;
		private $contrasenha;
		private $status;
		private $fechaRegistro;

		/**
		*Constructor
		*/
		function __construct($Codigo, $Contrasenha, $status, $fechaRegistro){

			$this -> Codigo = $Codigo;
			$this -> contrasenha = $contrasenha;
			$this -> status = $status;
			$this -> fechaRegistro = $fechaRegistro;
		}


		/**
		*@return String Regresa código
		*/
		public function getCodigo(){
			return $this -> Codigo;
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
		*@param String $Codigo recibe el código
		*/
		public function setCodigo($Codigo){
			return $this -> Codigo = $Codigo;
		}

		/**
		*@param String $contrasenha recibe una contraseña
		*/
		public function setContrasenha($contrasenha){
			return $this -> contrasenha = $contrasenha;
		}

		/**
		*@param String $status recibe el status de un usuario 
		*/
		public function setStatus($status){
			return $this -> status = $status;
		}


		/**
		*@param String $fechaRegistro recibe la fecha de registro
		*/
		public function setFechaRegistro($fechaRegistro){
			return $this -> fechaRegistro = $fechaRegistro;
		}
	}


?>
