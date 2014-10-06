<?php

	class ubicacionMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Ubicacion.php');
			require('controller/ConexionBaseDeDatos.php');
			$this -> conexion = ConexionBaseDeDatos::getInstace();
		}
		
		/** 
		 *Hace la inserción de una nueva ubicación
         *@param String $idUbicacion
         *@param String $Area_idArea
		 *@param String $seccion
		 *@param String $numero
		 *@param String $status
		 *
         *@return bool TRUE si la inserción a la BD fue exitosa.
		 */
		public function insertar($Area_idArea, $seccion, $numero, $status){

			$ubicacion = new Ubicacion($Area_idArea, $seccion, $numero, $status);
			$query = "INSERT INTO Ubicacion (Area_idArea, seccion, numero, status) VALUES ('".$Area_idArea."','".$seccion."','".$numero."','".$status."')";
			
			$resultado = $this -> conexion -> query($query);
			if($resultado){
				$ubicacion -> setIdUbicacion($this -> conexion -> insert_id);
			}
			else{
				$bicacion = NULL;
			}
			return $resultado;
		}

		/**
		 *Consulta a la base de datos ubicaciones disponibles de determinada área
		 *@param int $Area_idArea
		 *
		 *@return Array de resultados si la consulta fue satisfactoria.
		 */
		public function buscar($Area_idArea){

			$query = "SELECT idUbicacion, numero, seccion FROM Ubicacion WHERE Area_idArea = '".$Area_idArea."' AND status = TRUE";
			
			$resultado = $this -> conexion -> query($query);
			if($this -> conexion -> error){
				return FALSE;
			}
			else{
				return $resultado -> fetch_assoc();
			}
		}

		/**
		 *Consulta a la base de datos primer ubicación disponible de cierta área
		 *@param int $Area_idArea
		 *
		 *@return int de idUbicacion disponible
		 */
		public function obtenerDisponible($Area_idArea){

			$query = "SELECT idUbicacion FROM Ubicacion WHERE Area_idArea = '".$Area_idArea."' AND status = TRUE LIMIT 1";
			
			$resultado = $this -> conexion -> query($query);

			if(!$resultado || $this -> manejador -> error){
				return 0;
			}
			
			return $resultado;
		}
	}
?>