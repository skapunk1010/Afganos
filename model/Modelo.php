<?php
	
	class Modelo{

		private $idModelo;
		private $idMarca;
		private $modelo;

		/**
		*Constructor
		*/
		function __construct($idMarca, $modelo){

			$this -> idMarca = $idMarca;
			$this -> modelo = $modelo;
		}
		/**
		*@return String Regresa id de modelo
		*/
		public function getIdModelo(){
			return $this -> idModelo;
		}
		/**
		*@return String Regresa id de marca
		*/
		public function getIdMarca(){
			return $this -> idMarca;
		}
		/**
		*@return String Regresa nombre de modelo
		*/
		public function getModelo(){
			return $this -> modelo;
		}
		/**
		*@param String $idModelo recibe el id de modelo
		*/
		public function setIdModelo($idModelo){
			return $this -> idModelo = $idModelo;
		}
		/**
		*@param String $idMarca recibe el id de marca
		*/
		public function setIdMarca($idMarca){
			return $this -> idMarca = $idMarca;
		}
		/**
		*@param String $modelo recibe el nombre de un modelo
		*/
		public function setModelo($modelo){
			return $this -> modelo = $modelo;
		}
	}
?>