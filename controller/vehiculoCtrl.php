<?php
require('controller/CtrlEstandar.php');
class vehiculoCtrl extends CtrlEstandar{

	private $modelo;

	/**
	*Método constructor donde carga el modelo del vehículo.
	*/
	function __construct(){

		require("model/vehiculoMdl.php");
		$this -> modelo = new vehiculoMdl();
	}

	/**
	*Método run encargado de actuar conforme a 
	*la acción deseada del usuario.
	*/
	public function run(){

		switch($_REQUEST['accion']){
			
			case "insertar":
				if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
                        $this -> insertar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
				break;

			case "consultar":
				if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
                        $this->consultar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
				break;

			case "listar":
				if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
                        $this -> listar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
				break;

			case "modificar":
				if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
                        $this -> modificar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
				break;

			case "eliminar":
				if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
                        $this -> eliminar();
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
		}
	}

	/**
	*Se reciben los datos necesarios para un nuevo vehículo
	*y se validan las cadenas.
	*Si se insertan correctamente envía mensaje.
	*/
	public function insertar(){
		if(empty($_POST)){
			require_once('model/marcaMdl.php');
			require_once('model/modeloMdl.php');
			$marcaMdl 	= new marcaMdl();
			$modeloMdl 	= new modeloMdl();

			$marcas = $marcaMdl->listar();
			$dropMarcas = "";
			$dropModelos = "";
			foreach($marcas as $marca){
				$dropMarcas .= "<option value='".$marca['idMarca']."'>".$marca['Marca']."</option>";
				$modelos = $modeloMdl->buscarPorMarca($marca['idMarca']);
				foreach ($modelos as $modelo) {
					$dropModelos .= "<option value='".$marca['idMarca']."-".$modelo['idModelo']."'>".$modelo['Modelo']."</option>";
				}
			}

			$header = file_get_contents('view/headerLoged.html');
            $contenido = file_get_contents('view/vehiculoInsertar.html');
            $footer = file_get_contents('view/footer.html');
            $header = str_replace('{usuario}', $_SESSION['usuario'], $header);
            $contenido = str_replace('{marcas}', $dropMarcas, $contenido);
            $contenido = str_replace('{modelos}', $dropModelos, $contenido);
            echo $header.$contenido.$footer;
		}else{
			require('controller/validadorCtrl.php');
			if(validadorCtrl::validarVin($_POST['vin']) && validadorCtrl::validarNumero($_POST['idmodelo'])
				&& validadorCtrl::validarAnho($_POST['anho']) && validadorCtrl::validarTexto($_POST['color'])
				&& validadorCtrl::validarNumero($_POST['cilindraje']) && validadorCtrl::validarTexto($_POST['transmision'])
				&& validadorCtrl::validarTexto($_POST['nPuertas'])){

				$vin 		= $_POST['vin'];
				$modelo 	= $_POST['idmodelo'];
				$anho 		= $_POST['anho'];
				$color 		= $_POST['color'];
				$cilindraje = $_POST['cilindraje'];
				$transmision= $_POST['transmision'];
				$nPuertas 	= $_POST['nPuertas'];

				$resultado = $this -> modelo -> insertar($vin,$modelo,$anho,$color,$cilindraje,$transmision,$nPuertas);
	            
		        if($resultado){
		            require('view/html/exitos/vehiculoInsertar.html'); #cambiar a html
		        }
		            
		        else{                
		           require('view/html/errores/errorVehiculoInsertar.html'); #cambiar a html
		        }
			}
			else{
				echo "formato de insercion de vehiculo incorrecto";
			}
		}
	}

	/**
	*A través del modelo se recupera un listado de vehículos.
	*Si existe la lista la muestra, en caso contrario envía error.
	*/
	public function listar(){
		$lista = $this -> modelo -> listar();
		
		if($lista!=NULL){
			#Se guardan archivos en variables
			$header 	= file_get_contents('view/headerLoged.html');
			$contenido	= file_get_contents('view/vehiculoListar.html');
			$footer		= file_get_contents('view/footer.html');
			
			$inicio_fila 	= strpos($contenido,'{inicioFila}');
			$fin_fila		= strpos($contenido,'{finFila}')+9;
			$filaTabla		= substr($contenido, $inicio_fila,$fin_fila-$inicio_fila);

			$filas = "";

			foreach ($lista as $vehiculo) {
				$nuevaFila = $filaTabla;
				//var_dump($vehiculo);
				$diccionario = array('{VIN}'=> $vehiculo['VIN'], 
									'{Marca}'=> $vehiculo['Marca'],
									'{Modelo}'=> $vehiculo['Modelo'],
									'{Anho}'=> $vehiculo['anho'],
									'{Color}'=> $vehiculo['color'],
									'{inicioFila}'=> '',
									'{finFila}'=>'');
				
				$nuevaFila = strtr($nuevaFila,$diccionario);
				$filas .= $nuevaFila;
			}
			
			$header = str_replace('{usuario}', $_SESSION['usuario'], $header);
			$contenido = str_replace($filaTabla, $filas, $contenido);
			echo $header.$contenido.$footer;
		}
		else{
			require('view/html/errores/errorVehiculoListar.html');
		}

	}

	/**
	*Se modifica información de un vehículo a través de su VIN.
	*Se valida el VIN y se manda a modificar.
	*/
	public function modificar(){

		require('controller/validadorCtrl.php');
		if(validadorCtrl::validarVin($_POST['vin'])){
			$vin = $_POST['vin'];
			$campoModificar = $_POST['aModificar'];
			$nuevoCampo = $_POST['nuevo'];
			switch ($campoModificar) {
				case 'modelo':
					$campoModificar = "Modelo_idModelo";
					if(!validadorCtrl::validarNumero($nuevoCampo)){
						echo "Error idModelo-Modificar";
					}
					break;
				case 'color':
					if(!validadorCtrl::validarTexto($nuevoCampo)){
						echo "Error color-Modificar";
					}
					break;
				case 'cilindraje':
					if(!validadorCtrl::validarNumero($nuevoCampo)){
						echo "Error cilindraje-Modificar";
					}
					break;
				case 'transmision':
					if(!validadorCtrl::validarTexto($nuevoCampo)){
						echo "Error transmision-Modificar";
					}
					break;
				case 'anho':
					if(!validadorCtrl::validarNumero($nuevoCampo)){
						echo "Error anho-Modificar";
					}
					break;
				case 'numeroPuertas':
					if(!validadorCtrl::validarNumero($nuevoCampo)){
						echo "Error nPuertas-Modificar";
					}
					break;
				default:break;
			}
			$resultado = $this -> modelo -> modificar($vin,$campoModificar,$nuevoCampo);
			if($resultado){
            	require('view/vehiculoModificado.php'); #cambiar a html
	        }
	            
	        else{
	            require('view/errorVehiculoModificado.php'); #cambiar a html
	        }
		}

		else{
			echo "formato de VIn incorrecto para modificar";
		}
	}

	/**
	*A través del modelo y del VIN se cambia status del vehículo.
	*/
	public function eliminar(){

		require('controller/validadorCtrl.php');
		$vin = validadorCtrl::validarVin($_REQUEST['vin']);
		$resultado = $this -> modelo -> eliminar($vin);
            
        if($resultado){    
            require('view/vehiculoEliminado.php'); #cambiar a html
        }
            
        else{     
            require('view/errorVehiculoEliminado.php'); #cambiar a html
        }
	}

	/**
	 * Consulta de vehiculo almacenado.
	 */
	public function consultar(){
		if(!isset($_GET['vin']) && empty($_GET['vin'])){
			header('Location: index.php?ctrl=vehiculo&accion=listar');
		}else{
			require('controller/validadorCtrl.php');
			if(validadorCtrl::validarVin($_GET['vin'])){
				$vin = $_GET['vin'];
				$resultado = $this->modelo->consultar($vin);
				if($resultado!=NULL){
					$header 	= file_get_contents('view/headerLoged.html');
					$contenido 	= file_get_contents('view/vehiculoConsultar.html');
					$footer 	= file_get_contents('view/footer.html');
					
					$diccionario = array(
						'{VIN}'=>$resultado[0]['VIN'],
						'{transmision}'=>$resultado[0]['transmision'],
						'{marca}'=>$resultado[0]['Marca'],
						'{modelo}'=>$resultado[0]['Modelo'],
						'{Color}'=>$resultado[0]['color'],
						'{cilindraje}'=>$resultado[0]['cilindraje'],
						'{numeroPuertas}'=>$resultado[0]['numeroPuertas']
						);
					$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
					$contenido 	= strtr($contenido,$diccionario);

					echo $header.$contenido.$footer;
				}else{
					//require('view/errorVehiculoBuscar.php');
					echo 'aqui';
				}
			}
			else{
				echo "formato de VIn incorrecto para búsqueda";
			}
		}
	}
}

?>