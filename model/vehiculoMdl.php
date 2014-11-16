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
		public function insertar($VIN,$idModelo,$anho,$color,$cilindraje,$transmision,$nPuertas){
			$query = "INSERT INTO Vehiculo (VIN, Modelo_idModelo, color, transmision, cilindraje, anho, numeroPuertas) 
			VALUES ('".$VIN."','".$idModelo."','".$color."','".$transmision."','".$cilindraje."','".$anho."','".$nPuertas."')";
			$resultado = $this -> conexion -> query($query);
			return $resultado;
		}

		/**
		*@return Array con un listado de los vehículos.
		*/
		public function listar()
		{
			$query = "SELECT * FROM Vehiculo";
			$correcto = $this -> conexion -> query($query);
			$array;
			if($correcto){
				$i = 0;
				while ($fila = $correcto->fetch_assoc()) {
        			$array[$i++] = $fila;
  			  }
			}
			else $array = NULL;
			$this -> conexion -> close();
			return $array; 
		}

		/**
		*@param String $vin recibe el vin de un auto a modificar
		*@param String $campo recibe el campo a modificar
		*@param String $nuevoCampo recibe el nuevo campor a modificar
		*@return bool según sea su validez.
		*/
		public function modificar($vin,$campo,$nuevoCampo)
		{
			$query = "UPDATE Vehiculo SET ".$campo." = '".$nuevoCampo."' WHERE VIN = '".$vin."'";
			$correcto = $this -> conexion -> query($query);
			return $correcto;
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
			$query = "SELECT * FROM Vehiculo WHERE VIN = '".$vin."'";
			$correcto = $this -> conexion -> query($query);
			$array;
			if($correcto){
				$i = 0;
				while ($fila = $correcto->fetch_assoc()) {
        			$array[$i++] = $fila;
  			  }
			}
			else $array = NULL;
			$this -> conexion -> close();
			return $array; 
		}
	}

?>