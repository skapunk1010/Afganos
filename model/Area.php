<?php
	
	class Area{

		private $idArea;
		private $area;
		private $Encargado_Codigo;
		private $descripcion;

		/**
		*Constructor
		*/
		function __construct($idArea, $Encargado_Codigo, $area){

			$this -> idArea = $idArea;
			$this -> Encargado_Codigo = $Encargado_Codigo;
			$this -> area = $area;
		}


		/**
		*@return String Regresa nueva área
		*/
		public function getArea(){
			return $this -> area;
		}

		/**
		*@return String Regresa idArea
		*/
		public function getIdArea(){
			return $this -> idArea;
		}

		/**
		*@return String Regresa al encargado
		*/
		public function getEncargado(){
			return $this -> Encargado_Codigo;
		}


		/**
		*@return String Regresa descripción
		*/
		public function getDescripcion(){
			return $this -> descripcion;
		}

		/**
		*@param String $area recibe el nombre de área
		*/
		public function setArea($area){
			return $this -> area = $area;
		}

		/**
		*@param String $idArea recibe el id de área
		*/
		public function setIdArea($idArea){
			return $this -> idArea = $idArea;
		}

		/**
		*@param String $Encargado_Codigo recibe el codigo de empleado
		*/
		public function setEncargado($Encargado_Codigo){
			return $this -> Encargado_Codigo = $Encargado_Codigo;
		}


		/**
		*@param String $descripcion recibe el nombre de una ubicación
		*/
		public function setDescripcion($descripcion){
			return $this -> descripcion = $descripcion;
		}
	}


?>
