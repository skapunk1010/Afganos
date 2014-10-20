<?php
	class empleadoMdl{
		private $conexion;

		function __construct(){
			require('controller/ConexionBaseDeDatos.php');
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
		 */
		public function insertar($nombre,$apellidoPat,$apellidoMat,$fechaNac,$rfc,$nss,$email,$status){
			#Generar codigo
			$queryParaCodigo = "SELECT COUNT() as total FROM Empleado";
			$resultado	= $this->conexion->query($queryParaCodigo);
			$row		= $resultado->fetch_array;
			$nEmpleados = $row[0] + 1;
			$codigo 		= str_pad($nReportes, 5, '0', STR_PAD_LEFT);
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
				return FALSE;
			}else{
				$this->conexion->close();
				return TRUE;
			}
		}
		/**
		 *Consulta un empleado en la base de datos.
		 *@param string $codigo Código del empleado a buscar.
		 *@return Array Regresa el empleado en un arreglo asociativo. 
		 */
		public function buscar($codigo){
			$codigo = $this->conexion->real_escape_string($codigo);

			$query = "SELECT * FROM Empleado WHERE Codigo = '".$Codigo."'";

			$resultado = $this->conexion->query($query);
			if($resultado){
				echo $this->conexion->error;
				$this->conexion->close();
				return FALSE;
			}else{
				$this->conexion->close();
				return TRUE;
			}
		}
		/**
		 * Lista todos los empleados registrados.
		 *@return array Arreglo con todos los empleados y todos sus datos.
		 * En caso de que no encontrara nada o hubiera algún error, regresa NULL.
		 */
		public function listar(){
			$query = "SELECT * FROM Empleado";

			$resultado = $this->conexion->query($query);
			$empleados = array();
			
			if($resultado){
				require('model/Empleado.php');
				while(($fila = $resultado->fetch_assoc())) {
					$empleado = new Empleado($fila['codigo'],$fila['nombre'],$fila['apellidoPaterno'], $fila['apellidoMaterno'], $fila['status']);
					$empleado -> setEmail($fila['email']);
					$empleado -> setRfc($fila['rfc']);
					$empleado -> setNss($fila['nss']);
					$empleados[] = $empleado;
				}
				$this->conexion();
				return $empleados;
			}else{
				$this->conexion();
				return NULL;
			}
		}
	}
?>