<?php

	require('models/Vehiculo.php'); 
	class vehiculoMdl
	{
		private $vehiculo;
		
		public function insertar($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmision,$combustible){
		
			$vehiculo = new Vehiculo($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmision,$combustible);
			#simular conexion a la base de datos
			return TRUE;
		}

		public function listar()
		{
			#lista todlos los vehículos.
			return array("carro1","carro2","carro3","carro4");
		}

		public function modificar()
		{
			#hace un update de la BD.
			return TRUE;
		}

		public function eliminar($vin)
		{
			#cambiar status del vehículo.
			#vin.status = false;
			#update en BD.
			return TRUE;
		}

	}

?>