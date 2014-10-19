<?php
	class empleadoCtrl{
		private $modelo;

		/**
		 *Constructor de la clase empleadoCtrl.
		 *Al invocarse, se instancia el modelo de empleado.
		 */
		function __construct(){
			require('model/empleadoMdl.php');
			$this->modelo = new empleadoMdl();
		}

		/**
		 *Ejecuta la acción que se desea realizar.
		 */
		function run(){
			switch ($_REQUEST['accion']) {
				case 'insertar':
					$this->insertar();
					break;
				
				case 'buscar':
					$this->buscar();
					break;
				
				default:
					require('view/error.php');
					break;
			}
		}

		/**
		 *Ejecuta la acción insertar empleado.
		 */
		public function insertar(){
			if( (isset($_REQUEST['nombre']) 		&& !empty($_REQUEST['nombre'])) && 
				(isset($_REQUEST['apellidoPat']) 	&& !empty($_REQUEST['apellidoPat'])) &&
				(isset($_REQUEST['apellidoMat'])	&& !empty($_REQUEST['apellidoMat'])) &&
				(isset($_REQUEST['status'])			&& !empty($_REQUEST['status']))  )
			{
				require('controller/validadorCtrl.php');
				$nombre		= $_REQUEST['nombre'];
				$apellidoPat= $_REQUEST['apellidoPat'];
				$apellidoMat= $_REQUEST['apellidoMat'];
				$fechaNac	= (isset($_REQUEST['fechaNac'])) ?$_REQUEST['fechaNac'] : null;
				$rfc		= (isset($_REQUEST['rfc'])) ? $_REQUEST['rfc'] : null;
				$nss		= (isset($_REQUEST['nss'])) ?$_REQUEST['nss'] : null;
				$email		= (isset($_REQUEST['email'])) ? $_REQUEST['email'] : null;
				$status		= $_REQUEST['status'];

				$nombre		= (validadorCtrl::validarNombre($nombre))? $nombre: die('Nombre no válido'); //
				$apellidoPat= (validadorCtrl::validarNombre($apellidoPat))? $apellidoPat : die('Apellido paterno no valido');//
				$apellidoMat= (validadorCtrl::validarNombre($apellidoMat))? $apellidoMat : die('Apellido materno no valido'); //
				$status		= (validadorCtrl::validarStatus($status); //
				$fechaNac	= (validadorCtrl::validarFecha($fechaNac))? $fechaNac : die('Formato de fecha no valido');
				$rfc		= (validadorCtrl::validarRfc($rfc))? $rfc : die('Fomarto de RFC no valido');
				$nss		= (validadorCtrl::validarNss($nss))? $nss : die('Formato de NSS no valido');
				$email		= (validadorCtrl::validarEmail($email))? $email : die('Formato de Email no valido');

				$resultado = $this->modelo->insertar($nombre,
													 $apellidoPat,
													 $apellidoMat,
													 $fechaNac,
													 $rfc,
													 $nss,
													 $email,
													 $status);
				if($resultado){
					require('view/empleadoInsertado.php');
				}else{
					require('view/errorEmpleadoInsertado.php');
				}
			}else{
				#Falta algún dato para poder dar de insertar un empleado.
				#Se consideran los datos que son not null para poder hacer la inserción.
				require('view/errorEmpleadoInsertado.php');
			}
		}

		/**
		 *Ejecuta la acción buscar empleado.
		 */
		public function buscar(){
			if(isset($_REQUEST['codigo']) && !empty($_REQUEST['codigo'])){
				$codigo = $_REQUEST['codigo'];

				$resultado = $this->modelo->buscar($codigo);

				if($resultado){
					require('view/empleadoBuscar.php');
				}else{
					require('view/errorEmpleadoBuscar.php');
				}
			}else{
				#Codigo de empleado no se introdujo.
			}
		}
	}
?>