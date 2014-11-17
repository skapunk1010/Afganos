<?php

	
	class usuarioMdl
	{
		private $conexion;
		function __construct(){
			require('model/Usuario.php'); 
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/**
		*@param String $codigo recibe una cadena de código nuevo
		*@param String $nombre recibe una cadena de nombre nuevo
		*@param String $apellido recibe una cadena de apellido nuevo
		*@param String $teléfono recibe una cadena de teléfono nuevo
		*@param String $email recibe una cadena de email nuevo
		*@return bool dependiendo de su validez.
		*/
		public function insertar($codigo, $usuario, $contrasenha, $privilegios){
			$fecha = date('Y-m-d H:i:s');
			$status = "1";
			
			$queryInsertar = "INSERT INTO Usuario (Codigo, usuario, contrasenha, status, fechaRegistro, privilegios) 
			VALUES ('".$codigo."','".$usuario."','".$contrasenha."','".$status."','".$fecha."','".$privilegios."')";
			$insercion = $this->conexion->query($queryInsertar);
			$this -> conexion -> close();
			return $insercion;
		}

		/**
		*@param String $codigo recibe el código del usuario a deshabilitar.
		*@return bool según sea su validez.
		*/
		public function deshabilitar($codigo){
			$query = "UPDATE Usuario SET status = '0' WHERE Codigo = '".$codigo."'";
			$correcto = $this->conexion->query($query);
			$this -> conexion -> close();
			return $correcto;
		}

		/**
		*@param String $codigo recibe el código del usuario a habilitar.
		*@return bool según sea su validez.
		*/
		public function habilitar($codigo){
			$query = "UPDATE Usuario SET status = '1' WHERE Codigo = '".$codigo."'";
			$correcto = $this->conexion->query($query);
			$this -> conexion -> close();
			return $correcto;
		}

		/**
		*@param String $codigo recibe el código del usuario y $passAct que es la contraseña actual.
		*@return bool según sea su validez.
		*/
		public function existeUsuario($codigo,$passAct){
			$query = "SELECT * FROM Usuario WHERE Codigo = '".$codigo."' AND contrasenha = '".$passAct."'";
			$existe = $this->conexion->query($query);
			$array = array();
	
			if($existe){
				$i = 0;
				while($fila = $existe->fetch_assoc()){
					$array[$i++] = $fila;
				}
			}
			else {
				$array = NULL;
			}
			return $array;
		}

		/**
		*@param String $codigo recibe el código y $passNew para cambiar la contraseña
		*@return bool según sea su validez.
		*/
		public function cambiarContrasenha($codigo,$passNew)
		{
			$consulta = "UPDATE Usuario SET contrasenha = '".$passNew."' WHERE Codigo = '".$codigo."'";
			$resultado = $this->conexion->query($consulta);
			$this -> conexion -> close();
			return $resultado;
		}

		/** Consulta el usuario del empleado indicado.
		 * @param String $codigoEmpleado Código del empleado del que se desea buscar su usuario.
		 * @return array Usuario del empleado indicado. Si el empleado no tiene usuario devuelve NULL.
		 */
		public function consultar($codigoEmpleado){
			$codigoEmpleado = $this->conexion->real_escape_string($codigoEmpleado);

			$query = "SELECT Usuario, status, fechaRegistro, privilegios FROM Usuario WHERE Codigo = '".$codigoEmpleado."'";
			$resultado = $this->conexion->query($query);
			$this->conexion->close();
			if($resultado){
				return $resultado->fetch_assoc();
			}
			else {
				return NULL;
			}
		}
	}
?>