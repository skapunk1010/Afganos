<?php
	
	class direccionMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			//require('model/Direccion.php');
			require_once('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/** 
		 *Hace la inserción de una nueva direccion para un empleado
         *@param String $Empleado_Codigo, codigo de empleado al q se agrega la direccion
         *@param String $calle Nombre de la calle del domicilio del empleado.
		 *@param String $numeroExt Número exterior del domicilio del empleado.
		 *@param String $numeroInt Número interior del domicilio del empleado.
		 *@param String $colonia Colonia del domicilio del empleado.
		 *@param String $ciudad Ciudad del domicilio del empleado.
		 *@param String $estado Estado del domicilio del empleado.
		 *
         *@return bool TRUE si la inserción a la BD fue satisfactoria.
		 */
		
		public function insertar($Empleado_Codigo, $calle, $numeroExt,$numeroInt, $colonia, $codigoPostal, $ciudad, $estado){
			$calleESC 	= $this -> conexion -> real_escape_string($calle);
			$numExtESC 	= $this -> conexion -> real_escape_string($numeroExt);
			$numIntEsc	= $this -> conexion -> real_escape_string($numeroInt);
			$coloniaESC = $this -> conexion -> real_escape_string($colonia);
			$codigoPostalESC = $this -> conexion -> real_escape_string($codigoPostal);
			$ciudadESC 	= $this -> conexion -> real_escape_string($ciudad);
			$estadoESC 	= $this -> conexion -> real_escape_string($estado);

			$query = "INSERT INTO Direccion (Empleado_Codigo, calle, numeroExt,numeroInt,codigoPostal, colonia, ciudad, estado) 
				VALUES ('".$Empleado_Codigo."','".$calleESC."','".$numExtESC."','".$numIntEsc."','".$codigoPostalESC."','".$coloniaESC."','".$ciudadESC."','".$estadoESC."')";
			$correcto = $this -> conexion -> query($query);

			if($correcto){
				#$this -> conexion -> close();
				return $this->conexion->insert_id;
			}
			else {
				$this -> conexion -> close();
				return -1;
			}
		}

		/**
		 *Consulta a la base de datos de la direcc especificada x su PK
		 *@param int $IdDireccion
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function buscar($idEmpleado){

			$query = "SELECT * FROM Direccion WHERE Empleado_Codigo = '".$idEmpleado."'";
			$correcto = $this -> conexion -> query($query);

			$array;
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
		 * Hace la modificación a la base de datos de la direccion del empleado indicado.
		 *@param String $codigoEmpleado Código del empleado del que se modificará la dirección.
         *@param String $calle Calle de la dirección del empleado con un nuevo valor asignado.
         *@param int $numeroExt Número exterior de la dirección del empleado con un nuevo valor asignado.
         *@param String $numeroInt Número interior de la dirección del empleado con un nuevo valor asignado.
         *@param String $codigoPostal Código Postal de la dirección del empleado con un nuevo valor asignado.
         *@param String $colonia Colonia de la dirección del empleado con un nuevo valor asignado.
         *@param String $ciudad Ciudad de la dirección del empleado con un nuevo valor asignado.
         *@param String $estado Estado de la dirección del empleado con un nuevo valor asignado.
         *@return bool TRUE si la modificación fue satisfactoria. FALSE en caso contrario.
		 */
		public function modificar($codigoEmpleado, $calle, $numeroExt, $numeroInt, $codigoPostal, $colonia, $ciudad, $estado){
			$codigoEmpleado	= $this -> conexion -> real_escape_string($codigoEmpleado);
			$calle			= $this -> conexion -> real_escape_string($calle);
			$numeroExt		= $this -> conexion -> real_escape_string($numeroExt);
			$numeroInt		= $this -> conexion -> real_escape_string($numeroInt);
			$codigoPostal	= $this -> conexion -> real_escape_string($codigoPostal);
			$colonia		= $this -> conexion -> real_escape_string($colonia);
			$ciudad			= $this -> conexion -> real_escape_string($ciudad);
			$estado			= $this -> conexion -> real_escape_string($estado);
			
			$query =  "UPDATE Direccion SET calle = '".$calle."',
											numeroExterior = '".$numeroExt."',
											numeroInterior = '".$numeroInt."',
											codigoPostal = '".$codigoPostal."',
											colonia = '".$colonia."',
											ciudad = '".$ciudad."',
											estado = '"$estado"'
							WHERE Empleado_Codigo = '".$codigoEmpleado."'";
			$resultado = $this -> conexion -> query($query);
			$this -> conexion -> close();
			#Mostrar resultados
			return $resultado;
		}

		/**
		 * Elimina la direccion indicada de la BD.
		 *@param Int $IdDireccion
         *
         *@return bool TRUE si la eliminacion fue satisfactoria.
		 */
		public function eliminar($IdDireccion){
			#Primero se hace una consulta previa y se señala cuál es la dirección a borrar.
			$query = "DELETE FROM Direccion WHERE IdDireccion = ".$IdDireccion;
			$correcto = $this -> conexion -> query($query);
			
			return $correcto; 	
		}

	}
?>