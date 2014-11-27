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
					if($this->estaLogeado &&  $this->esAdmin() ){
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

			if( isset($_POST['idArea']) && isset($_POST['idUbicacion'])){
				require('controller/validadorCtrl.php');
				$Area_idArea = $_POST['idArea'];
				$idUbicacion = $_POST['idUbicacion'];

				$Area_idArea = (validadorCtrl::validarNumero($Area_idArea))? (int)$Area_idArea : 0; 
				$idUbicacion = (validadorCtrl::validarNumero($idUbicacion))? (int)$idUbicacion : 0;

				$resultado = $this -> modelo -> insertar($Area_idArea, $idUbicacion);
				if($resultado){
					//require('view/ubicacionInsertada.php');
					echo json_encode('ubicacion asignada');
				}else{
					echo json_encode('aqui');
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