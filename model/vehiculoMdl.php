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
		*@param String $VIN
		*/
		public function insertar($VIN,
								$idModelo,
								$anho,
								$color,
								$cilindraje,
								$transmision,
								$numeroPuertas,
								$idCliente,
								
								$placaNumero,
								$kilometraje,
								$gasolinaCantidad,
								$cantidadCinturones,
								$extintor,
								$tableroDetalle,
								$asientosCantidad,
								$asientosDetalle,

								$espejoIzquierdo,
								$espejoRetrovisor,
								$espejoDerecho,
								
								$faroDelanteroDerecho,
								$faroDelanteroIzquierdo,
								$faroTraseroDerecho,
								$faroTraseroIzquierdo,
								$farosDetalle,

								$direccionalDelanteraDerecha,
								$direccionalDelanteraIzquierda,
								$direccionalTraseraDerecha,
								$direccionalTraseraIzquierda,
								$direccionalDetalle,

								$defensaDelantera,
								$defensaTrasera,
								$defensaDetalle,

								$llantaRefaccion,
								$llantasDetalle,
								$parabrisasDelantero,
								$parabrisasTrasero,
								$parabrisasDetalle,

								$placaDelantera,
								$placaTrasera,

								$puertasDetalle,
								$cofreDetalle,
								$cajuelaDetalle,
								$techoDetalle,
								$vidriosDetalle
						){

			$VIN 			= $this -> conexion -> real_escape_string($VIN);
			$idModelo 		= $this -> conexion -> real_escape_string($idModelo);
			$anho			= $this -> conexion -> real_escape_string($anho);
			$color 			= $this -> conexion -> real_escape_string($color);
			$cilindraje		= $this -> conexion -> real_escape_string($cilindraje);
			$transmision	= $this -> conexion -> real_escape_string($transmision);
			$numeroPuertas	= $this -> conexion -> real_escape_string($numeroPuertas);
			$idCliente		= $this -> conexion -> real_escape_string($idCliente);
			$placaNumero	= $this -> conexion -> real_escape_string($placaNumero);
			$$kilometraje	= $this -> conexion -> real_escape_string($kilometraje);
			$gasolinaCantidad	= $this -> conexion -> real_escape_string($gasolinaCantidad);
			$cantidadCinturones	= $this -> conexion -> real_escape_string($cantidadCinturones);
			$extintor		= $this -> conexion -> real_escape_string($extintor);
			$tableroDetalle	= $this -> conexion -> real_escape_string($tableroDetalle);
			$asientosCantidad	= $this -> conexion -> real_escape_string($asientosCantidad);
			$asientosDetalle	= $this -> conexion -> real_escape_string($asientosDetalle);
			$espejoIzquierdo	= $this -> conexion -> real_escape_string($espejoIzquierdo);
			$espejoRetrovisor	= $this -> conexion -> real_escape_string($espejoRetrovisor);
			$espejoDerecho		= $this -> conexion -> real_escape_string($espejoDerecho);
			$faroDelanteroDerecho 	= $this -> conexion -> real_escape_string($faroDelanteroDerecho);
			$faroDelanteroIzquierdo	= $this -> conexion -> real_escape_string($faroDelanteroIzquierdo);
			$faroTraseroDerecho		= $this -> conexion -> real_escape_string($faroTraseroDerecho);
			$faroTraseroIzquierdo	= $this -> conexion -> real_escape_string($faroTraseroIzquierdo);
			$farosDetalle 			= $this -> conexion -> real_escape_string($farosDetalle);
			$direccionalDelanteraDerecha	= $this -> conexion -> real_escape_string($direccionalDelanteraDerecha);
			$direccionalDelanteraIzquierda	= $this -> conexion -> real_escape_string($direccionalDelanteraIzquierda);
			$direccionalTraseraDerecha		= $this -> conexion -> real_escape_string($direccionalTraseraDerecha);
			$direccionalTraseraIzquierda	= $this -> conexion -> real_escape_string($direccionalTraseraIzquierda);
			$direccionalDetalle 			= $this -> conexion -> real_escape_string($direccionalDetalle);
			$defensaDelantera 	= $this -> conexion -> real_escape_string($defensaDelantera);
			$defensaTrasera 	= $this -> conexion -> real_escape_string($defensaTrasera);
			$defensaDetalle 	= $this -> conexion -> real_escape_string($defensaDetalle);
			$llantaRefaccion	= $this -> conexion -> real_escape_string($llantaRefaccion);
			$llantasDetalle		= $this -> conexion -> real_escape_string($llantasDetalle);
			$parabrisasDelantero	= $this -> conexion -> real_escape_string($parabrisasDelantero);
			$parabrisasTrasero		= $this -> conexion -> real_escape_string($parabrisasTrasero);
			$parabrisasDetalle 			= $this -> conexion -> real_escape_string($parabrisasDetalle);
			$placaDelantera		= $this -> conexion -> real_escape_string($placaDelantera);
			$placaTrasera		= $this -> conexion -> real_escape_string($placaTrasera);
			$puertasDetalle		= $this -> conexion -> real_escape_string($puertasDetalle);
			$cofreDetalle		= $this -> conexion -> real_escape_string($cofreDetalle);
			$cajuelaDetalle		= $this -> conexion -> real_escape_string($cajuelaDetalle);
			$techoDetalle		= $this -> conexion -> real_escape_string($techoDetalle);
			$vidriosDetalle		= $this -> conexion -> real_escape_string($vidriosDetalle);

			$query = "CALL InsertarVehiculo(
						'".$VIN."',
						".$idModelo.", 
						".$anho.", 
						'".$color."', 
						".$cilindraje." , 
						'".$transmision."',
						".$numeroPuertas.", 
						".$idCliente.", 

						'".$placaNumero."',
						'".$gasolinaCantidad."', 
						".$kilometraje.",
						".$cantidadCinturones.", 
						".$extintor.", 
						'".$tableroDetalle."', 
						".$asientosCantidad.", 
						'".$asientosDetalle."',

						".$espejoIzquierdo.", 
						".$espejoRetrovisor.", 
						".$espejoDerecho.", 

						".$faroDelanteroDerecho.",
						".$faroDelanteroIzquierdo.", 
						".$faroTraseroDerecho.", 
						".$faroTraseroIzquierdo.", 
						'".$farosDetalle."',

						".$direccionalDelanteraDerecha.",
						".$direccionalDelanteraIzquierda.", 
						".$direccionalTraseraDerecha.", 
						".$direccionalTraseraIzquierda.", 
						'".$direccionalDetalle."',

						".$defensaDelantera.", 
						".$defensaTrasera.", 
						'".$defensaDetalle."', 

						".$llantaRefaccion." , 
						'".$llantasDetalle."',
						".$parabrisasDelantero.", 
						".$parabrisasTrasero.", 
						'".$parabrisasDetalle."', 

						".$placaDelantera.", 
						".$placaTrasera.",

						'".$puertasDetalle."', 
						'".$cofreDetalle."', 
						'".$cajuelaDetalle."', 
						'".$techoDetalle."', 
						'".$vidriosDetalle."' )";

			$resultado = $this -> conexion -> query($query);
			echo '<br><br>'.$query.'<br><br>';
			echo $this -> conexion -> error;
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
			anho = '".$anho."', numeroPuertas = '".$numeroPuertas."', Cliente_idCliente = '".$cliente."' WHERE VIN = '".$vin."'";
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