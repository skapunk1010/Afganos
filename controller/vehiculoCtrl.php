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

			case "buscar":
				if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
                        $this->buscar();
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

		require('controller/validadorCtrl.php');
		if(validadorCtrl::validarVin($_POST['vin']) && validadorCtrl::validarNumero($_POST['idmodelo'])
			&& validadorCtrl::validarAnho($_POST['anho']) && validadorCtrl::validarTexto($_POST['color'])
			&& validadorCtrl::validarNumero($_POST['cilindraje']) && validadorCtrl::validarTexto($_POST['transmision'])
			&& validadorCtrl::validarTexto($_POST['nPuertas'])){

			$vin = $_POST['vin'];
			$modelo = $_POST['idmodelo'];
			$anho = $_POST['anho'];
			$color = $_POST['color'];
			$cilindraje = $_POST['cilindraje'];
			$transmision = $_POST['transmision'];
			$nPuertas = $_POST['nPuertas'];

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

	/**
	*A través del modelo se recupera un listado de vehículos.
	*Si existe la lista la muestra, en caso contrario envía error.
	*/
	public function listar(){

		$lista = $this -> modelo -> listar();
		
		if($lista!=NULL){
			var_dump($lista);
			require('view/html/exitos/vehiculoListar.html');
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
	public function buscar(){
		require('controller/validadorCtrl.php');
		if(validadorCtrl::validarVin($_POST['vin'])){
			$vin = $_POST['vin'];
			$resultado = $this->modelo->buscar($vin);
			if($resultado!=NULL){
				print_r($resultado);
				require('view/vehiculoBuscar.php');
			}else{
				require('view/errorVehiculoBuscar.php');
			}
		}
		else{
			echo "formato de VIn incorrecto para búsqueda";
		}
	}
}

?>