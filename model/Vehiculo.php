<?php
	class Vehiculo{
		private $vin;
		private $marca;
		private $modelo;
		private $anho;
		private $color;
		private $cilindraje;
		private $transmision;
		private $combustible;

		private $status;

		public function __construct($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmision,$combustible){
			$this->vin 		= $vin;
			$this->marca 	= $marca;
			$this->modelo 	= $modelo;
			$this->anho 	= $anho;
			$this->color 	= $color;
			$this->cilindraje = $cilindraje;
			$this->transmision = $transmision;
			$this->combustible = $combustible;
			$this->status = TRUE;
		}

		public function getVin(){
			return $this->vin;
		}

		public function getMarca(){
			return $this->marca;
		}

		public function getModelo(){
			return $this->modelo;
		}

		public function getColor(){
			return $this->color;
		}

		public function getCilindraje(){
			return $this->cilindraje;
		}

		public function getTransmision(){
			return $this->transmision;
		}

		public function getCombustible(){
			return $this->combustible;
		}

		public function getStatus(){
			return $this->status;
		}

		public function setMarca($marca){
			$this->marca = $marca;
		}

		public function setModelo($modelo){
			$this->modelo = $modelo;
		}

		public function setColor($color){
			$this->color = $color;
		}

		public function setCilindraje($cilindraje){
			$this->cilindraje = $cilindraje;
		}

		public function setTransmision($transmision){
			$this->transmision = $transmision;
		}

		public function setCombustible($combustible){
			$this->combustible = $combustible;
		}

		public function setStatus($status){
			$this->status = $status;
		}
	}
?>