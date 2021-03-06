<?php
	
	class Marca{

		private $idMarca;
		private $marca;

		/**
		*Constructor
		* @param marcar Nombre de la marca
		*/
		function __construct($marca){

			$this -> marca = $marca;
		}
		/**
		*@return String Regresa id de marca
		*/
		public function getIdMarca(){
			return $this -> idMarca;
		}
		/**
		*@return String Regresa nombre de marca
		*/
		public function getMarca(){
			return $this -> marca;
		}
		/**
		*@param String $idMarca recibe el id de marca
		*/
		public function setIdMarca($idMarca){
			return $this -> idMarca = $idMarca;
		}
		/**
		*@param String $marca recibe el nombre de una marca
		*/
		public function setMarca($marca){
			return $this -> marca = $marca;
		}
	}


?>
