<?php

	class loginMdl{
		private $conexion;

		function __construct(){
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/**
		*Función encargada del inicio de sesión de un usuario.
		*@param String $usuario recibe una cadena de usuario
		*@param String $password recibe una cadena de contraseña
		*@return Usuario Regresa el usuario que se ha autentificado.
		* Si no existe el usuario o hubo algún error, regresa NULL.
		*/
		public function iniciarSesion($usuario,$password){
			#Establecer conexión con BD
			$usuario 	= $this->conexion-> real_escape_string($usuario);
			$password 	= $this->conexion-> real_escape_string($password);

			$query = "SELECT * FROM Usuario WHERE usuario = '".$usuario."' AND contrasenha = '".$password."'";
			$resultado = $this->conexion->query($query);
			
			$this->conexion->close();
			if($resultado->num_rows > 0){
				require('model/Usuario.php');
				$fila = $resultado -> fetch_assoc();
				$usuario = new Usuario($fila['usuario'], $fila['contrasenha'], $fila['status'], $fila['fechaRegistro'],$fila['privilegios']);
				return $usuario;
			}else{
				return NULL;
			}
		}

		/**
		*Función para registrar a un usuario.
		*@param String $codigo Código del empleado al que se le asignará el nuevo usuario.
		*@param String $usuario recibe una cadena de usuario
		*@param String $password recibe una cadena de contraseña
		*@return bool dependiendo de su validez. 
		*/
		public function signin($codigo,$usuario,$password,$privilegio){
			$fechaRegistro = date("d")."-".date("m")."-".date("Y");
			$codigo 	= $this->conexion-> real_escape_string($codigo);
			$usuario 	= $this->conexion-> real_escape_string($usuario);
			$password 	= $this->conexion-> real_escape_string($password);
			$privilegio = $this->conexion-> real_escape_string($privilegio);

			$query = "SELECT * FROM Empleado WHERE Codigo = '".$codigo."'";
			$resultadoEmpleado = $this->conexion->query($query);
			if($resultadoEmpleado->num_rows > 0){
					$empleado = $resultadoEmpleado -> fetch_assoc();
					$query = "INSERT INTO Usuario
							  VALUES ('".$codigo."','".$usuario."', '".$password."', 1,now(),'".$privilegio."')";

					$resultado = $this->conexion->query($query);
					$this->conexion->close();
					//echo $query;
					//var_dump($empleado);
					if($resultado){
						#Mandar mail de confirmación.
						$destino = $empleado['email'];
						$origen  = "From : afganosweb@gmail.com\r\n";
						$asunto  = "!Registro exitoso!";
						$mensaje = "Buen día, '".$empleado['nombre']."'!\n".
									"Te queremos informar que tu registro en nuestra página ha sido exitoso.".
									"Ya puedes navegar en nuestro sitio.\n\n".
									"Te deseamos un excelente día.";
						mail($destino,$asunto,$mensaje,$origen);
						return TRUE;
					}else{
						return FALSE;
					}
			}else{
				#No existe el empleado con el código $codigo.
				$this->conexion->close();
				return FALSE;
			}
		}

		/**
		 * Cierra la sesión que actualmente ha sido iniciada.
		 */
		public function cerrarSesion(){
			session_unset();
			session_destroy();		
			setcookie(session_name(), '', time()-3600);
		}

	}
?>