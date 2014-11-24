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
				$ubicacion = NULL;
			}
			$this -> conexion -> close();
			return $resultado;
		}

		/**
		 *Consulta a la base de datos ubicaciones disponibles de determinada área
		 *@param int $Area_idArea ID del área a la que pertenece la ubicación
		 *@param String $secccion Sección de la cual se buscarán los campos.
		 *@return Array de resultados si la consulta fue satisfactoria.
		 */
		public function buscar($Area_idArea, $seccion){
			$Area_idArea = $this -> conexion -> real_escape_string($Area_idArea);
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