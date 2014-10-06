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
		public function insertar($Vehiculo_VIN,$fechaEntrada,$status,$detalle);
			#Generar numero de Reporte
			$queryParaNum 	= "SELECT COUNT() as total FROM Reporte";
			$resultado		= $this->conexion->query($queryParaNum);
			$row			= $resultado->fetch_array();
			$nReportes	 	= $row[0] + 1;
			$codigo 		= str_pad($nReportes, 6, '0', STR_PAD_LEFT);

			$Vehiculo_VIN	= $this->conexion->real_escape_string($Vehiculo_VIN);
			$fechaEntrada	= $this->conexion->real_escape_string($fechaEntrada);
			$status 		= $this->conexion->real_escape_string($status);
			$detalle 		= $this->conexion->real_escape_string($detalle);

			$query = "INSERT INTO Reporte 
						VALUES ('".$numeroReporte."','".$Vehiculo_VIN."','".$fechaEntrada."','".$status."')");
			
			$resultado = $this->conexion->query($query);

			if($this->conexion->error){
				require('view/errorReporteInsertado.php');
				echo $this->conexion->error;
				$this->conexion->close();
				return FALSE;
			}else{
				$this->conexion->close();
				return TRUE;
			}
		}
		/**
		 *Consulta de reporte en la base de datos.
		 *@param string $numeroReporte Número de reporte del se quiere buscar.
		 *@return Array Regresa el reporte encontrado en un arreglo asociativo.
		 */
		public function buscar($numeroReporte){
			$numeroReporte	= $this->conexion->real_escape_string($numeroReporte);

			$query = "SELECT * FROM Reporte WHERE numeroReporte = '".$numeroReporte."'");
			
			$resultado = $this->conexion->query($query);

			if($this->conexion->error){
				require('view/errorReporteBuscar.php');
				echo $this->conexion->error;
				$this->conexion->close();
				return null;
			}else{
				$this->conexion->close();
				return $resultado->fetch_assoc();
			}
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
			
			$query = "UPDATE Reporte SET status = FALSE WHERE numeroReporte = '".$numeroReporte."'");
			
			$resultado = $this->conexion->query($query);

			if($this->conexion->error){
				require('view/errorReporteEliminar.php');
				echo $this->conexion->error;
				$this->conexion->close();
				return FALSE;
			}else{
				$this->conexion->close();
				return TRUE;
			}
		}
	}
?>