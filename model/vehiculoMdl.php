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
		public function insertar($VIN, $IDmodelo, $transmision, $cilindraje){
			
			$vehiculo = new Vehiculo($VIN, $IDmodelo, $transmision, $cilindraje);
			$query = "INSERT INTO Vehiculo (VIN, Modelo_idModelo, color, transmision, cilindraje, anho, numeroPuertas) 
			VALUES ('".$VIN."','".$Modelo_idModelo."','".$color."','".$transmision."','".$cilindraje."','".$anho."','".$numeroPuertas."')";

			$resultado = $this -> conexion -> query($query);
			if(!$resultado)
				$vehiculo = NULL;
			return $resultado;
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
		/**
		 * Busca el vehiculo en la base de datos.
		 * @param String $vin Vin del vehiculo que se va a consular
		 * @return Array $resutaldo Registro del vehiculo consultado.
		 * en caso de no encontrarse, regresa null.
		 */
		public function buscar($vin){
			#Buscar vehiculo
			return TRUE;
		}
	}

?>