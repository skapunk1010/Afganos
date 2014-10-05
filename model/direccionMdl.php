<?php
	
	class direccionMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Direccion.php');
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstace();
		}
		
		/** 
		 *Hace la inserción de una nueva direccion para un empleado
         *@param String $Encargado_Codigo, codigo de empleado al q se agrega la direccion
         *@param String $calle
		 *@param String $numeroExt
		 *@param String $colonia
		 *@param String $ciudad
		 *@param String $estado
		 *
         *@return bool TRUE si la inserción a la BD fue satisfactoria.
		 */
		public function insertar($Empleado_Codigo, $calle, $numeroExt, $colonia, $ciudad, $estado){
			
			$nuevaDireccion = new Direccion($Empleado_Codigo, $calle, $numeroExt, $colonia, $ciudad, $estado);
			
			$calleESC = $this -> conexion -> real_escape_string($calle);
			$numExtESC = $this -> conexion -> real_escape_string($numeroExt);
			$coloniaESC = $this -> conexion -> real_escape_string($colonia);
			$ciudadESC = $this -> conexion -> real_escape_string($ciudad);
			$estadoESC = $this -> conexion -> real_escape_string($estado);

			$query = "INSERT INTO Direccion (Empleado_Codigo, calle, numeroExt, colonia, ciudad, estado) 
				VALUES ('".$Empleado_Codigo."','".$calleESC."','".$numExtESC."','".$coloniaESC."','".$ciudadESC."','".$estadoESC."')";
			$correcto = $this -> conexion -> query($query);

			if($correcto)
				$nuevaDireccion -> setIdDireccion($this -> conexion -> insert_id);
			else $nuevaDireccion = NULL;
			
			return $correcto; 
		}

		/**
		 *Consulta a la base de datos de la direcc especificada x su PK
		 *@param int $IdDireccion
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function consultar($IdDireccion){
			#Establecer conexion con BD
			#Hacer consultar a ella.
			#Mostrar resultados
			return TRUE; #Retornno temporal
		}

		/**
		 * Hace la modificación a la base de datos de la direccion indicada.
		 *@param Int $IdDireccion
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($IdDireccion, $campo){
			
			#Mostrar resultados
			return TRUE; #Retorno temporal
		}

		/**
		 * Elimina la direccion indicada de la BD.
		 *@param Int $IdDireccion
         *
         *@return bool TRUE si la eliminacion fue satisfactoria.
		 */
		public function eliminar($IdDireccion){
			
			$query = "DELETE FROM Direccion WHERE IdDireccion = ".$IdDireccion;
			$correcto = $this -> conexion -> query($query);
			
			return $correcto; 	
		}

	}
?>