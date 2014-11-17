<?php
	class empleadoMdl{
		private $conexion;

		function __construct(){
			require_once('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}

		/**
		 *Inserta un nuevo empleado en la base de datos.
		 *@param string $nombre Nombre del empleado.
		 *@param string $apellidoPat Apellido paterno del empleado.
		 *@param string $apellidoMat Apellido materno del empleado.
		 *@param string $fechaNac Fecha de nacimiento del empleado.
		 *@param string $rfc RFC del empleado.
		 *@param string $nss Número de seguro social del empleado.
		 *@param string $email Email del empleado.
		 *@param boolean $status Status del empleado.
		 *@return int ID del último registro insertado. Regresa -1 si el hubo errores al insertarse.
		 */
		public function insertar($nombre,$apellidoPat,$apellidoMat,$fechaNac,$rfc,$nss,$email,$status){
			#Generar codigo
			$queryParaCodigo = "SELECT COUNT(*) as total FROM Empleado";
			$resultado	= $this->conexion->query($queryParaCodigo);
			$row		= $resultado->fetch_assoc();
			
			$nEmpleados = $row['total'] + 1;
			$codigo 		= str_pad($nEmpleados, 5, '0', STR_PAD_LEFT);
			$codigo			= "1".$codigo;

			$nombre		= $this->conexion->real_escape_string($nombre);
			$apellidoPat= $this->conexion->real_escape_string($apellidoPat);
			$apellidoMat= $this->conexion->real_escape_string($apellidoMat);
			$fechaNac	= $this->conexion->real_escape_string($fechaNac);
			$rfc		= $this->conexion->real_escape_string($rfc);
			$nss		= $this->conexion->real_escape_string($nss);
			$email		= $this->conexion->real_escape_string($email);
			$status		= $this->conexion->real_escape_string($status);

			#Query
			$query = "INSERT INTO Empleado (Codigo, nombre, apellidoMaterno, apellidoPaterno, fechaNacimiento, RFC, NSS, email, status) 
					VALUES ('".$codigo."','".$nombre."','".$apellidoMat."','".$apellidoPat."','".$fechaNac."','".$rfc."','".$nss."','".$email."','".$status."')";

			$resultado = $this->conexion->query($query);

			if($this->conexion->error){
				echo $this->conexion->error;
				$this->conexion->close();
				return -1;
			}else{
				$ultimoEmpleado = $this->conexion->query("SELECT MAX(Codigo) AS CodigoEmpleado FROM Empleado");
				#$this->conexion->close();
				return $ultimoEmpleado->fetch_assoc();
			}
		}
		/**
		 *Consulta un empleado en la base de datos.
		 *@param string $codigo Código del empleado a buscar.
		 *@return Array Regresa el empleado en un arreglo asociativo. 
		 *Regresa NULL en caso contrario.
		 */
		public function consultar($Codigo){
			$codigo = $this->conexion->real_escape_string($Codigo);

			//$query = "SELECT * FROM Empleado WHERE Codigo = '".$Codigo."'";

			$query = "SELECT * 
					FROM Empleado AS E,Telefono AS T, Direccion AS D
					WHERE 	E.codigo = T.Empleado_Codigo AND 
							T.Empleado_Codigo = D.Empleado_Codigo AND 
							
							E.Codigo = '".$Codigo."' AND E.status = true";////E.codigo = U.codigo AND
			//echo $query;

			$resultado = $this->conexion->query($query);
			
			if($resultado){
				$empleado = array();
				while(($fila = $resultado->fetch_assoc())){
					$empleado[] = $fila;
				}
				$this->conexion->close();
				return $empleado;
			}else{
				$this->conexion->close();
				return NULL;
			}
		}
		/**
		 * Lista todos los empleados registrados.
		 *@return array Arreglo con todos los empleados y todos sus datos.
		 * En caso de que no encontrara nada o hubiera algún error, regresa NULL.
		 */
		public function listar(){
			$query = "SELECT * FROM Empleado WHERE status = true";

			$resultado = $this->conexion->query($query);
			$empleados = array();
			$this->conexion->close();
			if($resultado){
				while(($fila = $resultado->fetch_assoc())){
					$empleados[] = $fila;
				}
				
				return $empleados;
			}else{
				return NULL;
			}
		}
		/**
		 * Modifica empleado.
		 *@param String $codigoEmpleado Código del empleado que se va a modificar.
		 *@param String $nombre Nombre del empleado con el nuevo valor asigado a empleado.
		 *@param String $apellidoPaterno Apellido Paterno del empleado con el nuevo valor asignado
		 *@param String $apellidoMaterno Apellido Materno del empleado con el nuevo valor asignado.
		 *@param String $fechaNacimiento Fecha de nacimiento del empleado con el nuevo valor asignado
		 *@param String $rfc R.F.C. del empleado con el nuevo valor asignado.
		 *@param String $nss N.S.S. del empleado con el nuevo valor asignado.
		 *@param String $email Email del empleado con el nuevo valor asignado.
		 *@param String $status Status de empleado.
		 *@return 
		 */
		public function modificar($codigoEmpleado,$nombre, $apellidoPaterno, $apellidoMaterno, $fechaNacimiento, $rfc, $nss, $email){
			$codigoEmpleado 	= $this -> conexion -> real_escape_string($codigoEmpleado);
			$nombre 			= $this -> conexion -> real_escape_string($nombre);
			$apellidoPaterno 	= $this -> conexion -> real_escape_string($apellidoPaterno);
			$apellidoMaterno 	= $this -> conexion -> real_escape_string($apellidoMaterno);
			$fechaNacimiento 	= $this -> conexion -> real_escape_string($fechaNacimiento);
			$rfc 				= $this -> conexion -> real_escape_string($rfc);
			$nss 				= $this -> conexion -> real_escape_string($nss);
			$email 				= $this -> conexion -> real_escape_string($email);

			$query = "UPDATE Empleado SET nombre='".$nombre."',
										  apellidoPaterno = '".$apellidoPaterno."',
										  apellidoMaterno = '".$apellidoMaterno."',
										  fechaNacimiento = '".$fechaNacimiento."',
										  RFC = '".$rfc."',
										  NSS = '".$nss."',
										  email = '".$email."' WHERE Codigo = '".$codigoEmpleado."'";
			$resultado = $this -> conexion -> query($query);
			return $resultado;
		}

		/**
		 * Elimina empleado.
		 *@param String $codigoEmpleado Código de empleado del que se desea eliminar.
		 *@return bool TRUE si la eliminacion fue correcta. FALSE en caso contrario.
		 */
		public function eliminar($codigoEmpleado){
			$codigoEmpleado = $this->conexion->real_escape_string($codigoEmpleado);
			$query = "UPDATE Empleado SET status ='INACTIVO' WHERE Codigo = '".$codigoEmpleado."'";
			$resultado = $this->conexion->query($query);
			$this->conexion->close();
			return $resultado;
		}

		public function getConexion(){
			return $this->conexion;
		}
	}
?>