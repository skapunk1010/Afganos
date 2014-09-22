<?php
	
	class Usuario{
	
		private $codigo;
		private $nombre;
		private $apellido;
		private $telefono;
		private $email;
		
		//Inicializa los datos de un usuario.
		public function __construct($codigo, $nombre, $apellido, $telefono, $email){
		
			$this -> codigo = $codigo;
			$this -> nombre = $nombre;
			$this -> apellido = $apellido;
			$this -> telefono = $telefono;
			$this -> email = $email;
		}
	
		public function getCodigo(){
			return this -> codigo;
		}
		public function getNombre(){
		
			return $this -> nombre;
		}
		public function getApellido(){
		
			return $this -> apellido;
		}
		public function getTelefono(){
		
			return $this -> telefono;
		}
		public function getEmail(){
		
			return $this -> email;
		}
	
		public function setCodigo($codigo){
			$this -> codgo = $codigo;
		}
		public function setNombre($nombre){
		
			$this -> nombre = $nombre;
		}
		public function setApellido($apellido){
		
			$this -> apellido = $apellido;
		}
		public function setTelefono($telefono){
		
			$this -> telefono = $telefono;
		}
		public function setEmail($email){
		
			$this -> email = $email;
		}
	
	}

?>