<?php
	
	class Usuario{
	
		private $codigo;
		private $contrasenha;
		private $status;
		private $fechaRegistro;
		
		/**
		*Inicializa los datos de un usuario.
		*/
		public function __construct($codigo, $contrasenha, $status, $fechaRegistro){
		
			$this -> codigo = $codigo;
			$this -> contrasenha = $contrasenha;
			$this -> status = $status;
			$this -> fechaRegistro = $fechaRegistro;
		}
	
		public function getCodigo(){
			return $this -> codigo;
		}
		public function getContrasenha(){
		
			return $this -> contrasenha;
		}
		public function getStatus(){
		
			return $this -> status;
		}
		public function getFechaRegistro(){
		
			return $this -> fechaRegistro;
		}
	
		public function setCodigo($codigo){
			$this -> codigo = $codigo;
		}
		public function setContrasenha($contrasenha){
		
			$this -> contrasenha = $contrasenha;
		}
		public function setStatus($status){
		
			$this -> status = $status;
		}
		public function setFechaRegistro($fechaRegistro){
		
			$this -> fechaRegistro = $fechaRegistro;
		}
	
	}

?>