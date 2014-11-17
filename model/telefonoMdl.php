<?php
	
	class telefonoMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Telefono.php');
			require_once('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/** 
		 *Hace la inserción de un nuevo telefono para un empleado
         *@param String $Empleado_Codigo
         *@param String $telefono
		 *@param String $tipo
		 *
         *@return int Regresa el id del teléfono que fue insertado. Si hubo problemas al insertar, regresa -1.
		 */
		public function insertar($Empleado_Codigo, $telefono, $tipo){

			//$nuevoTelef = new Telefono($Empleado_Codigo, $telefono, $tipo);
			
			$telefonoESC 	= $this -> conexion -> real_escape_string($telefono);
			$tipoESC 		= $this -> conexion -> real_escape_string($tipo);

			$query = "INSERT INTO Telefono (Empleado_Codigo, telefono, tipo) 
				VALUES ('".$Empleado_Codigo."','".$telefonoESC."','".$tipoESC."')";
			$correcto = $this -> conexion -> query($query);
			#$this->conexion->close();
			if($correcto){
				#$nuevoTelef -> setIdTelefono($this -> conexion -> insert_id);
				return $this->conexion->insert_id;
			}else {
				return -1;
			}
		}

		/**
		 *Consulta a la base de datos del telefono especificada x su PK
		 *@param int $IdTelefono
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function buscar($IdTelefono){
			#Establecer conexion con BD
			#Hacer consultar a ella.
			#Mostrar resultados
			return TRUE; #Retornno temporal
		}

		/**
		 * Hace la modificación a la base de datos del telefono indicado.
		 *@param String $codigoEmpleado Código del empleado del que se va modificar el teléfono.
		 *@param String $telefono Téléfono con su nuevo valor.
         *@param String $tipo Tipo del teléfono del que se va actualizar.
         *@return bool TRUE si la modificación fue satisfactoria. FALSE en caso contrario.
		 */
		public function modificar($codigoEmpleado,$telefono,$tipo){
			$codigoEmpleado		= $this->conexion->real_escape_string($codigoEmpleado);
			$telefono 			= $this->conexion->real_escape_string($telefono);
			$tipo 				= $this->conexion->real_escape_string($tipo);

			$query = "UPDATE Telefono SET telefono = '".$telefono."' WHERE Empleado_Codigo = '".$codigoEmpleado."' AND tipo = '".$tipo."'";
			$resultado = $this->conexion->query($query);
			$this->conexion->close();
			return $resultado;
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