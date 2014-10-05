<?php
	
	class MovimientoInterno{

		private $idMovimiento;
		private $Ubicacion_idUbicacion;
		private $descripcion;
		private $Reporte_idReporte;
		private $Usuario_Codigo;

		/**
		*Constructor
		*/
		function __construct($idMovimiento, $Ubicacion_idUbicacion, $Reporte_idReporte, $Usuario_Codigo){

			$this -> idMovimiento = $idMovimiento;
			$this -> Ubicacion_idUbicacion = $Ubicacion_idUbicacion;
			$this -> Reporte_idReporte = $Reporte_idReporte;
			$this -> Usuario_Codigo = $Usuario_Codigo;
		}


		/**
		*@return String Regresa id de movimiento
		*/
		public function getIdMovimiento(){
			return $this -> idMovimiento;
		}

		/**
		*@return String Regresa id de ubicación
		*/
		public function getIdUbicacion(){
			return $this -> Ubicacion_idUbicacion;
		}

		/**
		*@return String Regresa descripción de movimiento
		*/
		public function getDescripcion(){
			return $this -> descripción;
		}


		/**
		*@return String Regresa id de reporte
		*/
		public function getIdReporte(){
			return $this -> Reporte_idReporte;
		}

		/**
		*@return String Regresa código de usuario
		*/
		public function getUsuarioCodigo(){
			return $this -> Usuario_Codigo;
		}

		/**
		*@param String $idMovimiento recibe el id de movimiento
		*/
		public function setIdMovimiento($idMovimiento){
			return $this -> idMovimiento = $idMovimiento;
		}

		/**
		*@param String $Ubicacion_idUbicacion recibe id de ubicación
		*/
		public function setUbicacionId($Ubicacion_idUbicacion){
			return $this -> Ubicacion_idUbicacion = $Ubicacion_idUbicacion;
		}

		/**
		*@param String $descripcion recibe descrición de movimiento
		*/
		public function setDescripcion($descripcion){
			return $this -> descripcion = $descripcion;
		}

		/**
		*@param String $Reporte_numeroReporte recibe el número de reporte 
		*/
		public function setNumeroReporte($Reporte_numeroReporte){
			return $this -> Reporte_numeroReporte = $Reporte_numeroReporte;
		}

		/**
		*@param String $Usuario_Codigo recibe el código de un usuario
		*/
		public function setCodigoUsuario($Usuario_Codigo){
			return $this -> Usuario_Codigo = $Usuario_Codigo;
		}
	}


?>
