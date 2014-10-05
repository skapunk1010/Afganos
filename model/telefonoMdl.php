<?php
	
	class telefonoMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Telefono.php');
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstace();
		}
		
		/** 
		 *Hace la inserción de un nuevo telefono para un empleado
         *@param String $Empleado_Codigo
         *@param String $telefono
		 *@param String $tipo
		 *
         *@return bool TRUE si la inserción a la BD fue satisfactoria.
		 */
		public function insertar($Empleado_Codigo, $telefono, $tipo){
			
			$nuevoTelef = new Telefono($Empleado_Codigo, $telefono, $tipo);
			
			$telefonoESC = $this -> conexion -> real_escape_string($telefono);
			$tipoESC = $this -> conexion -> real_escape_string($tipoExt);

			$query = "INSERT INTO Telefono (Empleado_Codigo, telefono, tipo) 
				VALUES ('".$Empleado_Codigo."','".$telefonoESC."','".$tipoESC."')";
			$correcto = $this -> conexion -> query($query);

			if($correcto)
				$nuevoTelef -> setIdTelefono($this -> conexion -> insert_id);
			else $nuevoTelef = NULL;
			
			return $correcto; 
		}

		/**
		 *Consulta a la base de datos del telefono especificada x su PK
		 *@param int $IdTelefono
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function consultar($IdTelefono){
			#Establecer conexion con BD
			#Hacer consultar a ella.
			#Mostrar resultados
			return TRUE; #Retornno temporal
		}

		/**
		 * Hace la modificación a la base de datos del telefono indicado.
		 *@param Int $IdTelefono
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($IdDireccion, $campo){
			
			#Mostrar resultados
			return TRUE; #Retorno temporal
		}

		/**
		 * Elimina el telefono indicado de la BD.
		 *@param Int $IdTelefono
         *
         *@return bool TRUE si la eliminacion fue satisfactoria.
		 */
		public function eliminar($IdTelefono){
			
			$query = "DELETE FROM Telefono WHERE IdTelefono = ".$IdTelefono;
			$correcto = $this -> conexion -> query($query);
			
			return $correcto; 	
		}
	}
?>