<?php
	
	class Area{

		private $idArea;
		private $area;
		private $Encargado_Codigo;
		private $descripcion;

		/**
		*Constructor
		*@param String $Encargado_Codigo
		*@param String $area
		*/
		function __construct($Encargado_Codigo, $area){

			$this -> Encargado_Codigo = $Encargado_Codigo;
			$this -> area = $area;
		}


		/**
		*@return String, Regresa nombre área
		*/
		public function getArea(){
			return $this -> area;
		}
		/**
		*@return Int, Regresa idArea
		*/
		public function getIdArea(){
			return $this -> idArea;
		}
		/**
		*@return String, Regresa el codigo del encargado
		*/
		public function getEncargado(){
			return $this -> Encargado_Codigo;
		}
		/**
		*@return String, Regresa una descripcion del area
		*/
		public function getDescripcion(){
			return $this -> descripcion;
		}

		/**
		*@param String $area, recibe el nombre de área
		*/
		public function setArea($area){
			return $this -> area = $area;
		}
		/**
		*@param Int $idArea, recibe el id de área
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
		*@param String $descripcion, recibe una descripcion del area
		*/
		public function setDescripcion($descripcion){
			return $this -> descripcion = $descripcion;
		}
	}
?>
