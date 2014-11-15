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
					if($this->estaLogeado() && $this->esAdmin() ) {
						$this->insertar();
					}else{
						if(!$this->estaLogeado()){
							header('Location : index.php?ctrl=login&accion=iniciarSesion');
						}else{
							require('view/errorAcceso.php');
						}
					}
					break;
				
				case 'consultar':
					if($this->estaLogeado() && $this->esAdmin() ) {
						$this->consultar();
					}else{
						if(!$this->estaLogeado()){
							header('Location : index.php?ctrl=login&accion=iniciarSesion');
						}else{
							require('view/errorAcceso.php');
						}
					}
					break;
				
				case 'listar':
					if($this->estaLogeado() && $this->esAdmin() ) {
						$this->listar();
					}else{
						if(!$this->estaLogeado()){
							header('Location : index.php?ctrl=login&accion=iniciarSesion');
						}else{
							require('view/errorAcceso.php');
						}
					}

				default:
					require('view/error.php');
					break;
			}
		}

		/**
		 *Ejecuta la acción insertar empleado.
		 */
		public function insertar(){
			if(empty($_POST)){
				#Mostrar nuevamente el formulario
			}else{
				require('controller/validadorCtrl.php');
				$nombre		= $_POST['nombre'];
				$apellidoPat= $_POST['apellidoPat'];
				$apellidoMat= $_POST['apellidoMat'];
				$fechaNac	= $_POST['fechaNac'] ;
				$rfc		= $_POST['rfc'] ;
				$nss		= $_POST['nss'];
				$email		= $_POST['email'] ;
				$status		= $_POST['status'];

				$nombre		= (validadorCtrl::validarNombre($nombre))? $nombre: ""; 
				$apellidoPat= (validadorCtrl::validarNombre($apellidoPat))? $apellidoPat : "";
				$apellidoMat= (validadorCtrl::validarNombre($apellidoMat))? $apellidoMat : ""; 
				$status		=  validadorCtrl::validarTexto($status); 
				$fechaNac	= (validadorCtrl::validarFecha($fechaNac))? $fechaNac : "";
				$rfc		= (validadorCtrl::validarRfc($rfc))? $rfc : "";
				$nss		= (validadorCtrl::validarNss($nss))? $nss : "";
				$email		= (validadorCtrl::validarEmail($email))? $email : "";

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
		}

		/**
		 *Ejecuta la acción buscar empleado.
		 */
		public function consultar(){
			if(isset($_POST['codigo']) && !empty($_POST['codigo'])){
				$codigo = $_POST['codigo'];

				$resultado = $this->modelo->buscar($codigo);

				if($resultado != NULL){
					require('view/empleadoBuscar.php');
				}else{
					require('view/errorEmpleadoBuscar.php');
				}
			}else{
				#Codigo de empleado no se introdujo.
			}
		}

		/**
		 * Lista todos los empleados registrados.
		 *
		 */
		public function listar(){
			$resultado = $this->modelo->listar();

			if($resultado){
				//require('view/empleadoListar.php');
				var_dump($resultado);
			}else{
				require('view/errorEmpleado.php');
			}
		}
	}
?>