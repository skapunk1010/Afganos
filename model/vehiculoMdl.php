<?php

	require('model/Vehiculo.php'); 
	class vehiculoMdl {
		private $conexion;

		function __construct(){
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}

		/**
		*Se inserta un nuevo vehículo una vez que se han validado los datos.
		*/
		public function insertar($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmision,$combustible){
		
			$vehiculo = new Vehiculo($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmision,$combustible);
			#simular conexion a la base de datos
			return TRUE;
		}

		/**
		*@return Array con un listado de los vehículos.
		*/
		public function listar()
		{
			#lista todlos los vehículos.
			return array("carro1","carro2","carro3","carro4");
		}

		/**
		*@param String $vin recibe el vin de un auto a modificar
		*@return bool según sea su validez.
		*/
		public function modificar($vin)
		{
			#modificar el auto con ese vin
			#se puede hacer uso de $$var(variables variables) 
			#para saber que campo se va a modificar y x cual valor
			return TRUE;
		}

		/**
		*@param String $vin recibe el vin de un auto a modificar
		*@return bool según sea su validez.
		*/
		public function eliminar($vin)
		{
			#cambiar status del vehículo.
			#vehiculo.status = false;
			#update en BD.
			return TRUE;
		}

	}

?>