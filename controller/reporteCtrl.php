<?php
	require('controller/CtrlEstandar.php');
	class reporteCtrl extends CtrlEstandar{
		private $modelo;
		private $conexion;

		/**
		 *Constructor
		 */
		function __construct(){
			require('model/reporteMdl.php');
			$this->modelo = new reporteMdl();
		}
		/**
		 *Recibe la acción que se desea ejecutar con respecto
		 *al reporte y ejecuta el método correspondiente.
		 *En caso de que la acción no sea correcta se muestra un error.
		 */
		public function run(){
			switch($_REQUEST['accion']){
				case 'insertar':
					if( $this->estaLogeado() && ( $this->esAdmin() || $this->esUsuario() )){
						$this->insertar();
					}
					else{
						if(!$this->estaLogeado()){
							header('Location: index.php?ctrl=login&accion=iniciarSesion');
						}else{
							require('view/errorAcceso.php');
						}
					}
					break;

				case 'buscar':
					if( $this->estaLogeado() && ( $this->esAdmin() || $this->esUsuario() )){
						$this->buscar();
					}else{
						if(!$this->estaLogeado()){
							header('Location: index.php?ctrl=login&accion=iniciarSesion');
						}else{
							require('view/errorAcceso.php');	
						}
					}
					break;

				case 'eliminar':
					if( $this->estaLogeado() && ( $this->esAdmin() || $this->esUsuario() )){
						$this->eliminar();
					}else{
						if(!$this->estaLogeado()){
							header('Location: index.php?ctrl=login&accion=iniciarSesion');
						}else{
							require('view/errorAcceso.php');
						}
					}
					break;

				case 'listar':
					if( $this->estaLogeado() && ( $this->esAdmin() || $this->esUsuario() )){
						$this->listar();
					}else{
						if(!$this->estaLogeado()){
							header('Location: index.php?ctrl=login&accion=iniciarSesion');
						}else{
							require('view/errorAcceso.php');
						}
					}
					break;

				default:
					require('view/error.php');
					break;
			}
		}

		/**
		 *Ejecuta la acción insertar un nuevo reporte.
		 */
		public function insertar()
		{
			if( (isset($_POST['vin']) && !empty($_POST['vin'])) &&
				(isset($_POST['status']) && !empty($_POST['status'])) )
			{
				require('controller/validadorCtrl.php');
				$detalle = "";
				$fechaSalida = "";

				$Vehiculo_VIN	= $_POST['vin'];
				$status			= $_POST['status'];
				$detalle = (empty($_POST['detalle'])) ? "" : $_POST['detalle'];
				$fechaEntrada = date('Y-m-d H:i:s');

				if(validadorCtrl::validarVin($Vehiculo_VIN) && validadorCtrl::validarStatus($status))
				{
					$resultado = $this->modelo->insertar($Vehiculo_VIN,$fechaEntrada,$status,$detalle);
					
					if($resultado!=FALSE){
						require('view/reporteInsertado.php');
					}
					else{
						require('view/errorReporteInsertado.php');
					}
				}

				else{
					echo "error insertar reporte";
				}
			}
			else{
				echo "faltan datos";
			}
		}

		/**
		 *Ejecuta la acción buscar un reporte existente.
		 */
		public function buscar(){
			if(isset($_POST['numeroReporte']) && !empty($_POST['numeroReporte']))
			{
				$numeroReporte	= $_POST['numeroReporte'];
				$resultado = $this->modelo->buscar($numeroReporte);

				if($resultado!=NULL){
					var_dump($resultado);
					require('view/reporteBuscar.php');
				}else{
					require('view/errorReporteBuscar.php');
				}
			}else{
				#Número de reporte no se introdujo.
			}
		}
		/**
		 *Ejecuta la acción eliminar un reporte existente.
		 */
		public function eliminar(){
			if(isset($_POST['numeroReporte']) && !empty($_POST['numeroReporte'])){
				$numeroReporte	= $_POST['numeroReporte'];
				$resultado = $this->modelo->eliminar($numeroReporte);
				if($resultado){
					require('view/reporteEliminar.php');
				}
				else{
					require('view/errorReporteEliminar.php');
				}
			}
			else{
				echo "inserte numero de reporte a eliminar";
			}
		}
		/**
		*Ejecuta la acción de listar los reportes, todos.
		*/
		public function listar(){

			$resultado = $this -> modelo -> listar();
			if($resultado!=NULL){
				var_dump($resultado);
			}
			else{
				echo "error al listar reportes";
			}
		}
	}
?>