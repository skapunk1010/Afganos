<?php
	
	class Area{

		private $area;
		private $ubicacion;
		private $encargado;

		public function getArea(){
			return $this -> area;
		}
		public function getUbicacion(){
			return $this -> ubicacion;
		}
		public function getEncargado(){
			return $this -> encargado;
		}

		public function setArea($area){
			$this -> area = $area;
		}
		public function setUbicacion($ubicacion){
			$this -> ubicacion = $ubicacion;
		}
		public function setEncargado($encargado){
			$this -> encargado = $encargado;
		}
	}


?>
