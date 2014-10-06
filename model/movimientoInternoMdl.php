<?php
	
	class movimientoInternoMdl{

		private $conexion;
		/**
		*Constructor
		*/
		function __construct(){
			require('model/MovimientoInterno.php');
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstace();
		}
		
		/** 
		 *Hace la inserción de un nuevo movimiento interno a un vehiculo
         *@param Int $Ubicacion_idUbicacion, ubicacion en dnd se encontrara el vehiculo
         *@param String $Reporte_idReporte, reporte de entrada del vehiculo al q pertenece 
		 *@param String $Usuario_Codigo, empleado q realizo el cambio de ubicacion del vehiculo
		 *
         *@return bool TRUE si la inserción a la BD fue satisfactoria.
		 */
		public function insertar($Ubicacion_idUbicacion, $Reporte_idReporte, $Usuario_Codigo){
			
			$nuevoMovInt = new MovimientoInterno($Ubicacion_idUbicacion, $Reporte_idReporte, $Usuario_Codigo);
			
			$idUbicacionESC = $this -> conexion -> real_escape_string($Ubicacion_idUbicacion);
			$idReporteESC = $this -> conexion -> real_escape_string($Reporte_idReporte);
			$codigoESC = $this -> conexion -> real_escape_string($Usuario_Codigo);

			$query = "INSERT INTO MovimientoInterno (Ubicacion_idUbicacion, Reporte_idReporte, Usuario_Codigo) 
				VALUES ('".$idUbicacionESC."','".$idReporteESC."','".$codigoESC."')";
			$correcto = $this -> conexion -> query($query);

			if($correcto)
				$nuevoMovInt -> setIdMovimiento($this -> conexion -> insert_id);
			else $nuevoMovInt = NULL;
			
			return $correcto; 
		}

		/**
		 *Consulta a la base de datos del movimiento (ubicacion fisica del veh) especificada x su PK
		 *@param int $IdMovimiento
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function consultar($IdMovimiento){
			#Establecer conexion con BD
			#Hacer consultar a ella.
			#Mostrar resultados
			return TRUE; #Retornno temporal
		}

		/**
		 * Hace la modificación a la base de datos del movimiento dado.
		 *@param Int $IdMovimiento
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($IdMovimiento, $campo){
			
			#Mostrar resultados
			return TRUE; #Retorno temporal
		}

		##	NO SE DEBE PERMITIR LA ELIMINACION DE MOV, SOLO ADMIN, ANALIZAR MAS ADELANTE ESA OPCION
		/**
		 * Elimina el movimiento indicado de la BD.
		 *@param Int $IdMovimiento
         *
         *@return bool TRUE si la eliminacion fue satisfactoria.
		 */
		/*public function eliminar($IdMovimiento){
			
			$query = "DELETE FROM MovimientoInterno WHERE IdMovimiento = ".$IdMovimiento;
			$correcto = $this -> conexion -> query($query);
			
			return $correcto; 	
		}*/
	}
?>