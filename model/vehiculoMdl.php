<?php

	require('model/Vehiculo.php'); 
	class vehiculoMdl
	{
		//Se inserta un nuevo vehículo una vez que se han validado los datos.
		public function insertar($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmision,$combustible){
		
			$vehiculo = new Vehiculo($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmision,$combustible);
			#simular conexion a la base de datos
			return TRUE;
		}

		//Regresa una lista de los carros obtenidos de la base de datos.
		public function listar()
		{
			#lista todlos los vehículos.
			return array("carro1","carro2","carro3","carro4");
		}

		//Se modifica información del vehículo por medio del VIN.
		//Regresa verdadero de ser acción exitosa.
		public function modificar($vin)
		{
			#modificar el auto con ese vin
			#se puede hacer uso de $$var(variables variables) 
			#para saber que campo se va a modificar y x cual valor
			return TRUE;
		}

		//Se modifica el status del vehículo a través del VIN.
		//De ser acción exitosa regresará verdadero.
		public function eliminar($vin)
		{
			#cambiar status del vehículo.
			#vehiculo.status = false;
			#update en BD.
			return TRUE;
		}

	}

?>