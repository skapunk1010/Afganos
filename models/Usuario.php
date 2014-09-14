<?php
	
	class Usuario{
	
		private $nombre;
		private $apellido;
		private $telefono;
		private $email;
		
#		public function __construct($nombre){
#		
#			$this -> nombre = nombre;
#		}
		public function __construct($nombre, $apellido, $telefono, $email){
		
			$this -> nombre = nombre;
			$this -> apellido = apellido;
			$this -> telefono = telefono;
			$this -> email = email;
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