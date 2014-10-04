<?php
	
	class Empleado{
	
		private $codigo;
		private $nombre;
		private $apellidoMat;
		private $apellidoPat;
		private $fechaNac;
		private $RFC;
		private $NSS;
		private $email;
		private $status;
		
		/**
		*Inicializa los datos de un usuario.
		*/
		public function __construct($codigo, $nombre, $apellidoPat, $apellidoMat, $status){
		
			$this -> codigo = $codigo;
			$this -> nombre = $nombre;
			$this -> apellidoPat = $apellidoPat;
			$this -> apellidoMat = $apellidoMat;
			$this -> status = $status;
		}
	
		public function getCodigo(){
			return $this -> codigo;
		}
		public function getNombre(){
		
			return $this -> nombre;
		}
		public function getApellidoPaterno(){
		
			return $this -> apellidoPat;
		}
		public function getApellidoMaterno(){
		
			return $this -> apellidoMat;
		}
		public function getFechaNacimiento(){
		
			return $this -> fechaNac;
		}
		public function getRFC(){
		
			return $this -> RFC;
		}
		public function getNSS(){
		
			return $this -> NSS;
		}		
		public function getEmail(){
		
			return $this -> email;
		}
		public function getStatus(){
		
			return $this -> status;
		}
	
		public function setCodigo($codigo){
			$this -> codgo = $codigo;
		}
		public function setNombre($nombre){
		
			$this -> nombre = $nombre;
		}
		public function setApellidoPaterno($apellidoPat){
		
			$this -> apellidoPat = $apellidoPat;
		}
		public function setApellidoMaterno($apellidoMat){
		
			$this -> apellidoMat = $apellidoMat;
		}
		public function setFechaNacimiento($fechaNac){
		
			$this -> fechaNac = $fechaNac;
		}
		public function setRFC($RFC){
		
			$this -> RFC = $RFC;
		}		
		public function setNSS($NSS){
		
			$this -> NSS = $NSS;
		}
		public function setEmail($email){
		
			$this -> email = $email;
		}
		public function setStatus($status){
		
			$this -> status = $status;
		}
	}

?>