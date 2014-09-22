<?php
	
	class Area{

		private $area;
		private $ubicacion;
		private $encargado;

		/**
		*@return String Regresa nueva área
		*/
		public function getArea(){
			return $this -> area;
		}

		/**
		*@return String Regresa nueva ubicación
		*/
		public function getUbicacion(){
			return $this -> ubicacion;
		}

		/**
		*@return String Regresa al encargado
		*/
		public function getEncargado(){
			return $this -> encargado;
		}

		/**
		*Asigna nueva área
		*@param String $area recibe el nombre de un área
		*/
		public function setArea($area){
			$this -> area = $area;
		}

		/**
		*Asigna nueva ubicación
		*@param String $ubicación recibe el nombre de una ubicación
		*/
		public function setUbicacion($ubicacion){
			$this -> ubicacion = $ubicacion;
		}

		/**
		*Asigna nuevo encargado.
		*@param String $encargado recibe el valor de un nuevo encargado
		*/
		public function setEncargado($encargado){
			$this -> encargado = $encargado;
		}
	}


?>
