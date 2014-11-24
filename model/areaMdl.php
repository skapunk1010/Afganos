<?php
	
	class areaMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Area.php');
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/** 
		 *Hace la inserción de una nueva área en la base de datos.
         *@param String $Encargado_Codigo, codigo de empleado encargado del area
         *@param String $area, nombre del area.
		 *@param String $descripcion, breve descripcion de la ocpacion del area
         *@return bool TRUE si la inserción a la BD fue satisfactoria.
		 */
		public function insertar($Encargado_Cod, $Area, $descripcion){
			$areaESC = $this -> conexion -> real_escape_string($Area);
			$descripcionESC = $this -> conexion -> real_escape_string($descripcion);
			$query = "INSERT INTO Area (Encargado_Codigo, area, descripcion) 
			VALUES ('".$Encargado_Cod."','".$areaESC."','".$descripcionESC."')";
			
			$correcto = $this -> conexion -> query($query);
			$this -> conexion -> close();
			return $correcto; 
		}

		/**
		 *Consulta a la base de datos del área especificada x el IdArea
		 *@return array con listado de áreas o NULL si no hay áreas que mostrar.
		 */
		public function listar(){
			
			$query = "SELECT idArea, area FROM Area";
			$correcto = $this -> conexion -> query($query);
			$array = array();
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
		 * Hace la consulta específica de un área
		 *@param Int $idArea
         *@return array con los datos del área consultada. NULL en caso de no existir.
		 */
		public function consultar($idArea){
			$query = "SELECT a.area, a.descripcion, e.nombre as encargado 
			FROM Area AS a, Empleado AS e WHERE e.Codigo = a.Encargado_Codigo AND idArea = '".$idArea."'";
			$resultado = $this -> conexion -> query($query);
			$array = array();
			if($resultado){
				$i = 0;

				while ($fila = $resultado->fetch_assoc()) {
        			$array[$i++] = $fila;
  			  }
			}
			else $array = NULL;
			$this -> conexion -> close();
			return $array; 
		}



		/**
		 * Hace la modificación a la base de datos del área indicada.
		 *@param Int $idArea
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($idArea, $codigo, $area, $descripcion){
			$query = "UPDATE Area SET Encargado_Codigo = '".$codigo."', 
			area = '".$area."', descripcion = '".$descripcion."' WHERE idArea = '".$idArea."'";
			$resultado = $this -> conexion ->query($query);
			return $resultado;
		}
	}
?>