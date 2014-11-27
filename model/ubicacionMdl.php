<?php

	class ubicacionMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require_once('model/Ubicacion.php');
			require_once('controller/ConexionBaseDeDatos.php');
			$this -> conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/** 
		 *Hace la inserción de una nueva ubicación
		 *@param String $Area_idArea
         *@param String $idUbicacion
         *@return bool TRUE si la inserción a la BD fue exitosa.
		 */
		public function insertar($Area_idArea, $idUbicacion){
			$Area_idArea = $this -> conexion -> real_escape_string($Area_idArea);
			$idUbicacion = $this -> conexion -> real_escape_string($idUbicacion);

			$query = "INSERT INTO Ubicacion (Area_idArea, seccion, numero, status) VALUES ('".$Area_idArea."','".$seccion."','".$numero."','".$status."')";
			$query = "UPDATE Ubicacion SET Area_idArea = '".$Area_idArea."' WHERE idUbicacion = '".$idUbicacion."'";

			$resultado = $this -> conexion -> query($query);

			return $resultado;
		}

		/**
		 *Consulta a la base de datos ubicaciones disponibles de determinada área
		 *@param String $secccion Sección de la cual se buscarán los campos.
		 *@return Array de resultados si la consulta fue satisfactoria.
		 */
		public function buscar($seccion){
			$seccion 	 = $this -> conexion -> real_escape_string($seccion);
			$query = "SELECT idUbicacion, numero FROM Ubicacion WHERE seccion = '".$seccion."' AND Area_idArea IS NULL  AND status = false";
			$resultado = $this -> conexion -> query($query);
			if($this -> conexion -> error){
				return NULL;
			}
			else{
				$ubicaciones = array();
				while ($row = $resultado->fetch_assoc()) {
					$ubicaciones[] = $row;
				}
				return $ubicaciones;
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