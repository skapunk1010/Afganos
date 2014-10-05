<?php
	
	class Reporte{

		private $numeroReporte;
		private $Vehiculo_VIN;
		private $fechaEntrada;
		private $fechaSalida;
		private $status;
		private $detalle;

		/**
		*Constructor
		*/
		function __construct($numeroReporte, $Vehiculo_VIN, $fechaEntrada, $status){

			$this -> numeroReporte = $numeroReporte;
			$this -> Vehiculo_VIN = $Vehiculo_VIN;
			$this -> fechaEntrada = $fechaEntrada;
			$this -> status = $status;
		}

		/**
		*@return String Regresa número de reporte
		*/
		public function getNumeroReporte(){
			return $this -> numeroReporte;
		}

		/**
		*@return String Regresa el VIN de vehículo
		*/
		public function getVIN(){
			return $this -> Vehiculo_VIN;
		}

		/**
		*@return String Regresa fecha de entrada
		*/
		public function getFechaEntrada(){
			return $this -> fechaEntrada;
		}


		/**
		*@return String Regresa fecha de salida
		*/
		public function getFechaSalida(){
			return $this -> fechaSalida;
		}

		/**
		*@return String Regresa status
		*/
		public function getStatus(){
			return $this -> status;
		}

		/**
		*@return String Regresa detalle de reporte
		*/
		public function getDetalle(){
			return $this -> detalle;
		}

		/**
		*@param String $numeroReporte recibe el número de reporte
		*/
		public function setNumeroReporte($numeroReporte){
			return $this -> numeroReporte = $numeroReporte;
		}

		/**
		*@param String $Vehiculo_VIN recibe VIN de vehículo
		*/
		public function setVIN($Vehiculo_VIN){
			return $this -> Vehiculo_VIN = $Vehiculo_VIN;
		}

		/**
		*@param String $fechaEntrada recibe fecha de entrada de vehículo
		*/
		public function setFechaEntrada($fechaEntrada){
			return $this -> fechaEntrada = $fechaEntrada;
		}

		/**
		*@param String $fechaSalida fecha de salida de vehículo
		*/
		public function setFechaSalida($fechaSalida){
			return $this -> fechaSalida = $fechaSalida;
		}

		/**
		*@param String $status recibe el status de un vehículo al momento del reporte
		*/
		public function setStatus($status){
			return $this -> status = $status;
		}

		/**
		*@param String $detalle recibe el detalle
		*/
		public function setDetalle($detalle){
			return $this -> detalle = $detalle;
		}
	}


?>
