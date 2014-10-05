<?php
	
	class Telefono{

		private $idTelefono;
		private $Empleado_Codigo;
		private $telefono;
		private $tipo;

		/**
		*Constructor
		*/
		function __construct($Empleado_Codigo, $telefono, $tipo){

			$this -> Empleado_Codigo = $Empleado_Codigo;
			$this -> telefono = $telefono;
			$this -> tipo = $tipo;
		}


		/**
		*@return String Regresa id de teléfono
		*/
		public function getIdTelefono(){
			return $this -> idTelefono;
		}
		/**
		*@return String Regresa código de empleado
		*/
		public function getEmpleadoCodigo(){
			return $this -> Empleado_Codigo;
		}
		/**
		*@return String Regresa teléfono
		*/
		public function getTelefono(){
			return $this -> telefono;
		}
		/**
		*@return String Regresa tipo de teléfono
		*/
		public function getTipo(){
			return $this -> tipo;
		}

		/**
		*@param String $idTelefono recibe el id teléfono
		*/
		public function setIdTelefono($idTelefono){
			return $this -> idTelefono = $idTelefono;
		}
		/**
		*@param String $Empleado_Codigo recibe un código de empleado
		*/
		public function setEmpleadoCodigo($Empleado_Codigo){
			return $this -> Empleado_Codigo = $Empleado_Codigo;
		}
		/**
		*@param String $telefono recibe el teléfono
		*/
		public function setStatus($telefono){
			return $this -> telefono = $telefono;
		}
		/**
		*@param String $tipo recibe el tipo
		*/
		public function setFechaRegistro($tipo){
			return $this -> tipo = $tipo;
		}
	}


?>
