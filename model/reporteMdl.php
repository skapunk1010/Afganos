<?php
	class reporteMdl{
		private $conexion;

		/**
		 *Constructor.
		 */
		function __construct(){
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		/**
		 *@param string $Vehiculo_VIN VIN del vehículo relacionado con el reporte.
		 *@param string $fechaEntrada Fecha en la que se crea el registro.
		 *@param boolean $status Status del reporte.
		 *@param string $detalle Detalle del reporte.
		 */
		public function insertar($Vehiculo_VIN,$fechaEntrada,$status,$detalle){
			
			$Vehiculo_VIN	= $this->conexion->real_escape_string($Vehiculo_VIN);
			$fechaEntrada	= $this->conexion->real_escape_string($fechaEntrada);
			$status 		= $this->conexion->real_escape_string($status);
			$detalle 		= $this->conexion->real_escape_string($detalle);

			$query = "INSERT INTO Reporte (Vehiculo_VIN, fechaEntrada, status, detalle) 
			VALUES ('".$Vehiculo_VIN."','".$fechaEntrada."','".$status."','".$detalle."')";
			$resultado = $this -> conexion -> query($query);
			$index = $this -> conexion -> insert_id;

			if(!$resultado){
				$index = FALSE;
			}
		}

		/**
		 *Consulta de reporte en la base de datos.
		 *@param string $numeroReporte Número de reporte del se quiere buscar.
		 *@return Reporte Regresa un objeto de la clase Reporte con el reporte encontrado. Regresa NULL en caso de que
		 *no se encontró el reporte.
		 */
		public function buscar($numeroReporte){

			$query = "SELECT * FROM Reporte WHERE numeroReporte = '".$numeroReporte."'";
			$resultado = $this->conexion->query($query);
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
		 *Cambia el status a FALSE del reporte que se indica. 
		 *De esta forma el reporte no se elimina, solamente permanece inactivo.
		 *@param string $numeroReporte Número de reporte del que se desea 'eliminar'.
		 *@return boolean Regresa TRUE si el cambio del status fue satisfactorio.
		 *Regresa FALSE en caso contrario.
		 */
		public function eliminar($numeroReporte){
			$numeroReporte	= $this->conexion->real_escape_string($numeroReporte);	
			$query = "UPDATE Reporte SET status = '0' WHERE numeroReporte = '".$numeroReporte."'";	
			$resultado = $this->conexion->query($query);
			$this->conexion->close();
			return $resultado;
		}


		/**
		 *lista los reportes existentes, todos.
		 *@return boolean Regresa FALSE si hubo error, array si tiene reportes que mostrar
		 */
		public function listar(){
			$query = "SELECT * FROM Reporte";
			$resultado = $this->conexion->query($query);
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
	}
?>