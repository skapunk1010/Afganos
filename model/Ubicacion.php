<?php
	
	class Ubicacion{

		private $idUbicacion;
		private $Area_idArea;
		private $seccion;
		private $numero;
		private $status;

		/**
		*Constructor
		*/
		function __construct($Area_idArea, $seccion, $numero, $status){

			$this -> Area_idArea = $Area_idArea;
			$this -> seccion = $seccion;
			$this -> numero = $numero;
			$this -> status = $status;
		}


		/**
		*@return String Regresa id de ubicación
		*/
		public function getIdUbicacion(){
			return $this -> idUbicacion;
		}

		/**
		*@return String Regresa id de área
		*/
		public function getAreaId(){
			return $this -> Area_idArea;
		}

		/**
		*@return String Regresa sección
		*/
		public function getSeccion(){
			return $this -> sección;
		}


		/**
		*@return String Regresa número
		*/
		public function getNumero(){
			return $this -> numero;
		}

		/**
		*@return String Regresa status
		*/
		public function getStatus(){
			return $this -> status;
		}

		/**
		*@param String $idUbicacion recibe el id ubicación
		*/
		public function setIdUbicacion($idUbicacion){
			return $this -> idUbicacion = $idUbicacion;
		}

		/**
		*@param String $Area_idArea recibe id de área
		*/
		public function setIdArea($Area_idArea){
			return $this -> Area_idArea = $Area_idArea;
		}

		/**
		*@param String $seccion recibe sección dentro de área
		*/
		public function setSeccion($seccion){
			return $this -> seccion = $seccion;
		}


		/**
		*@param String $numero recibe número 
		*/
		public function setNumero($numero){
			return $this -> numero = $numero;
		}

		/**
		*@param String $status recibe status de ubicación
		*/
		public function setStatus($status){
			return $this -> status = $status;
		}
	}


?>
