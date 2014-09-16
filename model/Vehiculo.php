<?php
	class Vehiculo{
		private $vin;
		private $marca;
		private $modelo;
		private $anho;
		private $color;
		private $cilindraje;
		private $transmicion;
		private $combustible;

		public function __construct($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmicion,$combustible){
			$this->vin 		= $vin;
			$this->marca 	= $marca;
			$this->modelo 	= $modelo;
			$this->anho 	= $anho;
			$this->color 	= $color;
			$this->cilindraje = $cilindraje;
			$this->transmicion = $transmicion;
			$this->combustible = $combustible;
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

		public function getTransmicion(){
			return $this->transmicion;
		}

		public function getCombustible(){
			return $this->combustible;
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

		public function setTransmicion($transmicion){
			$this->transmicion = $transmicion;
		}

		public function setCombustible($combustible){
			$this->combustible = $combustible;
		}
	}
?>