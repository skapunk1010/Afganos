<?php
	
	class Direccion{

		private $idDireccion;
		private $Empleado_Codigo;
		private $calle;
		private $numeroExt;
		private $numeroInt;
		private $codigoPostal;
		private $colonia;
		private $ciudad;
		private $estado;

		/**
		*Constructor
		*/
		function __construct($Empleado_Codigo, $calle, $numeroExt, $colonia, $ciudad, $estado){

			$this -> Empleado_Codigo = $Empleado_Codigo;
			$this -> calle = $calle;
			$this -> numeroExt = $numeroExt;
			$this -> colonia = $colonia;
			$this -> ciudad = $ciudad;
			$this -> estado = $estado;
		}


		/**
		*@return String Regresa id de dirección de empleado
		*/
		public function getIdDireccion(){
			return $this -> idDireccion;
		}
		/**
		*@return String Regresa código de empleado
		*/
		public function getCodigoEmpleado(){
			return $this -> Empleado_Codigo;
		}
		/**
		*@return String Regresa calle
		*/
		public function getCalle(){
			return $this -> calle;
		}
		/**
		*@return String Regresa número exterior
		*/
		public function getNumeroExterior(){
			return $this -> numeroExt;
		}
		/**
		*@return String Regresa número interior
		*/
		public function getNumeroInterior(){
			return $this -> numeroInt;
		}
		/**
		*@return String Regresa código postal
		*/
		public function getCodigoPostal(){
			return $this -> codigoPostal;
		}
		/**
		*@return String Regresa colonia
		*/
		public function getColonia(){
			return $this -> colonia;
		}
		/**
		*@return String Regresa ciudad
		*/
		public function getCiudad(){
			return $this -> ciudad;
		}
		/**
		*@return String Regresa estado
		*/
		public function getEstado(){
			return $this -> estado;
		}

		/**
		*@param String $idDireccion recibe el id de dirección
		*/
		public function setIdDireccion($idDireccion){
			return $this -> idDireccion = $idDireccion;
		}
		/**
		*@param String $Empleado_Codigo recibe código de un empleado
		*/
		public function setCodigoEmpleado($Empleado_Codigo){
			return $this -> Empleado_Codigo = $Empleado_Codigo;
		}
		/**
		*@param String $calle recibe nombre de calle
		*/
		public function setCalle($calle){
			return $this -> calle = $calle;
		}
		/**
		*@param String $numeroExt recibe el número exterior
		*/
		public function setNumeroExterior($numeroExt){
			return $this -> numeroExt = $numeroExt;
		}
		/**
		*@param String $codigoPostal recibe el código postal
		*/
		public function setCodigoPostal($codigoPostal){
			return $this -> codigoPostal = $codigoPostal;
		}
		/**
		*@param String $colonia recibe el nombre de colonia
		*/
		public function setColonia($colonia){
			return $this -> colonia = $colonia;
		}
		/**
		*@param String $ciudad recibe el nombre de ciudad
		*/
		public function setCiudad($ciudad){
			return $this -> ciudad = $ciudad;
		}
		/**
		*@param String $numeroInt recibe el número interior
		*/
		public function setNumeroInterior($numeroInt){
			return $this -> numeroInt = $numeroInt;
		}
		/**
		*@param String $estado recibe el nombre de estado
		*/
		public function setEstado($estado){
			return $this -> estado = $estado;
		}
	}
?>
