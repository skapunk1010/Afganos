<?php
	require('controller/CtrlEstandar.php');
	class empleadoCtrl extends CtrlEstandar{
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
				
				case 'listar':
					$this->listar();

				default:
					require('view/error.php');
					break;
			}
		}

		/**
		 *Ejecuta la acción insertar empleado.
		 */
		public function insertar(){
				require('controller/validadorCtrl.php');
				$nombre		= $_REQUEST['nombre'];
				$apellidoPat= $_REQUEST['apellidoPat'];
				$apellidoMat= $_REQUEST['apellidoMat'];
				$fechaNac	= $_REQUEST['fechaNac'] ;
				$rfc		= $_REQUEST['rfc'] ;
				$nss		= $_REQUEST['nss'];
				$email		= $_REQUEST['email'] ;
				$status		= $_REQUEST['status'];

				$nombre		= (validadorCtrl::validarNombre($nombre))? $nombre: die('Nombre no válido'); 
				$apellidoPat= (validadorCtrl::validarNombre($apellidoPat))? $apellidoPat : die('Apellido paterno no valido');
				$apellidoMat= (validadorCtrl::validarNombre($apellidoMat))? $apellidoMat : die('Apellido materno no valido'); 
				$status		=  validadorCtrl::validarTexto($status); 
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

		/**
		 * Lista todos los elempleados registrados.
		 *
		 */
		public function listar(){
			$resultado = $this->modelo->listar();

			if($resultado){
				require('view/empleadoListar.php');
				var_dump($registrados);
			}else{
				require('view/errorEmpleado.php');
			}
		}
	}
?>