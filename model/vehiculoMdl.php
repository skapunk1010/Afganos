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
		public function listar(){
			$query = "SELECT * FROM Vehiculo AS V, Modelo AS M, Marca As A WHERE V.Modelo_idModelo = M.idModelo AND M.Marca_idMarca = A.idMarca";
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
		*@param String $modelo recibe el modelo de un auto a modificar
		*@param String $color recibe el color de un auto a modificar
		*@param String $transmision recibe transmision de un auto a modificar
		*@param String $cilindraje recibe el cilindraje de un auto a modificar
		*@param String $anho recibe el año de un auto a modificar
		*@param String $numeroPuertas recibe el número de puertas de un auto a modificar
		*@param String $cliente recibe el cliente de un auto a modificar
		*@return bool según sea su validez.
		*/
		public function modificar($vin,$modelo,$color,$transmision,$cilindraje,$anho,$numeroPuertas,$cliente)
		{
			$query = "UPDATE Vehiculo SET Modelo_idModelo = '".$modelo."', color = '".$color."', transmision = '".$transmision."', cilindraje = '".$cilindraje."',
			anho = '".$anho."', numeroPuertas = '".$numeroPuertas."', Cliente_idCliente = '".$cliente."' WHERE VIN = '"$vin"'";
			$correcto = $this -> conexion -> query($query);
			return $correcto;
		}

		/**
		 * Busca el vehiculo en la base de datos.
		 * @param String $vin Vin del vehiculo que se va a consular
		 * @return Array $resultado Registro del vehiculo consultado.
		 * en caso de no encontrarse, regresa null.
		 */
		public function consultar($vin){
			
			$query = "SELECT * FROM Vehiculo AS v, Cliente AS c WHERE v.Cliente_idCliente = c.idCliente AND v.VIN = '".$vin."'";
			$correcto = $this -> conexion -> query($query);
			$array = array();
			if($correcto){
				while ($fila = $correcto->fetch_assoc()) {
        			$array[] = $fila;
  			  	}
			}
			else $array = NULL;
			$this -> conexion -> close();
			return $array; 
		}
	}

?>