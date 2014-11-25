<?php

	
	class clienteMdl
	{
		private $conexion;
		function __construct(){
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/**
		*@param String $nombre recibe una cadena de nombre nuevo
		*@param String $apellidoPaterno recibe una cadena de apellido nuevo
		*@param String $apellidoMaterno recibe una cadena de apellido nuevo
		*@param String $email recibe una cadena de email nuevo
		*@return bool dependiendo de su validez.
		*/
		public function insertar($nombre,$apellidoPaterno,$apellidoMaterno,$email){
			$status = "1";
			$query = "INSERT INTO Cliente (nombre, apellidoPaterno, apellidoMaterno, email, status) 
			VALUES ('".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$email."','".$status."')";
			$insercion = $this->conexion->query($query);
			$this -> conexion -> close();
			return $insercion;
		}

		/**
		*@param String $idCliente recibe el código del cliente
		*@param String $nombre recibe el nombre del del cliente
		*@param String $apellidoPaterno apellido paterno del cliente
		*@param String $apellidoMaterno apellido materno del cliente
		*@param String $email recibe el email del cliente
		*@return bool según sea su validez.
		*/
		public function modificar($idCliente,$nombre,$apellidoPaterno,$apellidoMaterno,$email){
			$query = "UPDATE Cliente SET nombre = '".$nombre."', apellidoPaterno = '".$apellidoPaterno."', apellidoMaterno = '".$apellidoMaterno."', email = '".$email."' WHERE idCliente = '".$idCliente."'";
			$correcto = $this->conexion->query($query);
			$this -> conexion -> close();
			return $correcto;
		}

		/**
		*@param String $idCliente recibe el id del cliente que se desea eliminar
		*@return bool según sea su validez.
		*/
		public function eliminar($idCliente){
			$query = "UPDATE Cliente SET status = '0' WHERE idCliente = '".$idCliente."'";
			$correcto = $this->conexion->query($query);
			$this -> conexion -> close();
			return $correcto;
		}

		/**
		*@return array si encontró registros, false en caso contrario.
		*/
		public function listar(){
			$query = "SELECT * FROM Cliente";
			$existe = $this->conexion->query($query);
			$array = array();
			if($existe){
				while($fila = $existe->fetch_assoc()){
					$array[] = $fila;
				}
			}
			else {
				$array = NULL;
			}
			return $array;
		}

		/**
		*Consulta el cliente especificado
		*@param String $idCliente del cliente a consultar
		*@return array con datos especificados, NULL en caso contrario.
		*/
		public function consultar($idCliente)
		{
			$query = "SELECT * FROM Vehiculo WHERE Cliente_idCliente = '".$idCliente."'";
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