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
			
			$nuevaArea = new Area($Encargado_Cod, $Area);
			
			$areaESC = $this -> conexion -> real_escape_string($Area);
			$descripcionESC = $this -> conexion -> real_escape_string($descripcion);

			$query = "INSERT INTO Area (Encargado_Codigo, area, descripcion) 
				VALUES ('".$Encargado_Cod."','".$areaESC."','".$descripcionESC."')";
			$correcto = $this -> conexion -> query($query);

			if($correcto)
				$nuevaArea -> setIdArea($this -> conexion -> insert_id);
			else $nuevaArea = NULL;
			
			$this -> conexion -> close();
			return $correcto; 
		}

		/**
		 *Consulta a la base de datos del área especificada x el IdArea
		 *@param int $Idarea, PK del area a consultar.
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function buscar($IdArea){
			
			$query = "SELECT * FROM Area WHERE IdArea = ".$IdArea;
			
			$correcto = $this -> conexion -> query($query);

			if($correcto != FALSE){
				
				### se encontro el area 
			}

			$this -> conexion -> close();
			return $correcto; 
		}

		/**
		 * Hace la modificación a la base de datos del área indicada.
		 *@param Int $IdArea
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($IdArea, $campo){
			
			#Mostrar resultados
			return TRUE; #Retorno temporal
		}
	}
?>