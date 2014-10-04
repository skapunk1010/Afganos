<?php
	class Vehiculo{
		private $VIN;
		#private $marca;
		private $IDmodelo;
		private $color;
		private $transmision;
		private $cilindraje;
		private $anho;
		private $numeroPuertas;
		#private $combustible ??

		/**
		*Inicializa los valores de un nuevo vehículo.
		*/
		public function __construct($VIN, $IDmodelo, $transmision, $cilindraje){
			$this -> VIN 		= $VIN;
			$this -> IDmodelo 	= $IDmodelo;
			$this -> transmision= $transmision;
			$this -> cilindraje	= $cilindraje;
		}

		public function getVIN(){
			return $this -> VIN;
		}
		public function getIDmodelo(){
			return $this-> IDmodelo;
		}
		public function getColor(){
			return $this -> color;
		}
		public function getTransmision(){
			return $this -> transmision;
		}
		public function getCilindraje(){
			return $this -> cilindraje;
		}
		public function getAnho(){
			return $this -> anho;
		}
		public function getNumeroPuertas(){
			return $this -> numeroPuertas;
		}
		#public function getCombustible(){
		#	return $this->combustible;
		#}

		public function setVIN($VIN){
			$this -> VIN = $VIN;
		}
		public function setIDmodelo($IDmodelo){
			$this -> IDmodelo = $IDmodelo;
		}
		public function setColor($color){
			$this -> color = $color;
		}
		public function setTransmision($transmision){
			$this -> transmision = $transmision;
		}
		public function setCilindraje($cilindraje){
			$this -> cilindraje = $cilindraje;
		}
		public function setAnho($anho){
			$this -> anho = $anho;
		}
		public function setNumeroPuertos($numeroPuertas){
			$this -> numeroPuertas = $numeroPuertas;
		}
		#public function setCombustible($combustible){
		#	$this->combustible = $combustible;
		#}
	}
?>