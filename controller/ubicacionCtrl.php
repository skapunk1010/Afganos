<?php
	require('controller/CtrlEstandar.php');
	class ubicacionCtrl extends CtrlEstandar{

		private $modelo;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/ubicacionMdl.php');
			$this -> modelo = new ubicacionMdl();
		}
		
		function run(){
			switch ($_REQUEST['accion']) {
				case 'insertar':
					if($this->estaLogeado && ($this->esUsuario() || $this->esAdmin() )){
                        $this -> insertar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            $header 	= file_get_contents('view/headerLoged.html');
							$contenido 	= file_get_contents('view/errorAcceso.html');
							$footer 	= file_get_contents('view/footer.html');
							$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
							echo $header.$contenido.$footer;
                        }
                    }
					break;
				case 'buscar':
					if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
                        $this -> buscar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            $header 	= file_get_contents('view/headerLoged.html');
							$contenido 	= file_get_contents('view/errorAcceso.html');
							$footer 	= file_get_contents('view/footer.html');
							$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
							echo $header.$contenido.$footer;
                        }
                    }
					break;
				case 'obtenerDisponible':
					if($this->estaLogeado && ($this->esUsuario() || $this->esAdmin() )){
                        $this -> disponible();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            $header 	= file_get_contents('view/headerLoged.html');
							$contenido 	= file_get_contents('view/errorAcceso.html');
							$footer 	= file_get_contents('view/footer.html');
							$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
							echo $header.$contenido.$footer;
                        }
                    }
					break;
				case 'eliminar':
					if( $this->estaLogeado() && $this->esAdmin() ){
						$this->eliminar();
					}else{
						if(!$this->estaLogeado()){
							header('Location: index.php?ctrl=login&accion=iniciarSesion');
						}else{
							$header 	= file_get_contents('view/headerLoged.html');
							$contenido 	= file_get_contents('view/errorAcceso.html');
							$footer 	= file_get_contents('view/footer.html');
							$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
							echo $header.$contenido.$footer;
						}
					}
					break;
				default: 
					$header 	= file_get_contents('view/headerLoged.html');
					$contenido 	= file_get_contents('view/errorAcceso.html');
					$footer 	= file_get_contents('view/footer.html');
					$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
					echo $header.$contenido.$footer;
					break;
			}
		}
		/**
		*Ejecuta la accióon de insertar ubicación
		*/
		public function insertar(){

			if( isset($_REQUEST['Area_idArea']) && isset($_REQUEST['seccion']) && isset($_REQUEST['numero']) && isset($_REQUEST['status']) ){
				
				require('controller/validadorCtrl.php');
				$Area_idArea = $_REQUEST['Area_idArea'];
				$seccion = $_REQUEST['seccion'];
				$numero = $_REQUEST['numero'];
				$status = $_REQUEST['status'];

				$Area_idArea = (validadorCtrl::validarNumero($Area_idArea))? $Area_idArea: die('Número de área no válido');
				$seccion = (validadorCtrl::validarCaracter($seccion))? $seccion: die('sección de área no válido');
				$numero = (validadorCtrl::validarNumero($numero))? $numero: die('Número de área no válido');
				$status = (validadorCtrl::validarStatus($status))? $status: die('status de área no válido');

				$resultado = $this -> modelo -> insertar($Area_idArea, $seccion, $numero, $status);
				if($resultado){
					require('view/ubicacionInsertada.php');
				}
				else{
					require('view/errorUbicacionInsertada.php');
				}

			}
			else {
				#vista de faltaron fatos.
			}
		}

		public function buscar(){
			if( !empty($_POST)){
				require_once('controller/validadorCtrl.php');
				$seccion = (validadorCtrl::validarTexto($_POST['seccion']))?$_POST['seccion'] : "";
				//$idArea  = (validadorCtrl::validarNumero($_POST['idArea']))? (int)$_POST['idArea'] : "";
				$resultado = $this -> modelo -> buscar($seccion);
				if($resultado){
					echo json_encode($resultado);
				}
				else{
					echo 'aqui';#require('view/errorConsultarUbicacion.php');
				}
			}
			else{
				#no se encontró datos para buscar
			}

		}

		public function obtenerDisponible(){
			if( isset($_REQUEST['idUbicacion'])){
				$idUbicacion = $_REQUEST['idUbicacion'];
				$resultado = $this -> modelo -> obtenerDisponible($idUbicacion);
				if($resultado){
					echo ($resultado);
				}
				else{
					require('view/errorConsultarUbicacion.php');
				}
			}
			else{
				#no se encontró datos para buscar
			}

		}
	}
?>