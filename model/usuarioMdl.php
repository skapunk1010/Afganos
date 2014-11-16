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
		public function insertar($codigo, $nombre, $apellido, $telefono, $email){
			#Generar codigoUsuario
			$queryParaUsuario 	= "SELECT COUNT() as total FROM Usuario";
			$resultado			= $this->conexion->query($queryParaUsuario);
			$row				= $resultado->fetch_array();
			$nUsuarios 			= $row[0] + 1;
			$codigo 			= str_pad($nUsuarios, 6, '0', STR_PAD_LEFT);

			$usuario = new Usuario($codigo, $nombre, $apellido, $telefono, $email);
			#simular conexion a la base de datos
			$this -> conexion -> close();
			return TRUE;
		}

		/**
		*@param String $codigo recibe el código del usuario a modificar.
		*@return bool según sea su validez.
		*/
		/*public function modificar($codigo)
		{
			#modificar usuarios a traves de su codigo
			#hacer uso de variables variables como en vehiculoMdl.php para saber los 
			#campo a modificar
			return TRUE;
		}*/

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

		public function habilitar($codigo){
			$query = "UPDATE Usuario SET status = '1' WHERE Codigo = '".$codigo."'";
			$correcto = $this->conexion->query($query);
			$this -> conexion -> close();
			return $correcto;
		}

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

		public function cambiarContrasenha($codigo,$passNew)
		{
	
			$consulta = "UPDATE Usuario SET contrasenha = '".$passNew."' WHERE Codigo = '".$codigo."'";
			$resultado = $this->conexion->query($consulta);
			$this -> conexion -> close();
			return $resultado;
			
		}
	}
?>