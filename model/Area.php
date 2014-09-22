<?php
	
	class Area{

		private $area;
		private $ubicacion;
		private $encargado;

		//Regresa el área
		public function getArea(){
			return $this -> area;
		}
		//Regresa la ubicación
		public function getUbicacion(){
			return $this -> ubicacion;
		}
		//Regresa al encargado
		public function getEncargado(){
			return $this -> encargado;
		}

		//Asigna nueva área
		public function setArea($area){
			$this -> area = $area;
		}
		//Asigna nueva ubicación
		public function setUbicacion($ubicacion){
			$this -> ubicacion = $ubicacion;
		}
		//Asigna nuevo encargado.
		public function setEncargado($encargado){
			$this -> encargado = $encargado;
		}
	}


?>
