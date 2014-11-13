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
				if($this->estaLogeado && ($this->esUsuario() || $this->esAdmin() )){
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
				if($this->estaLogeado && ($this->esUsuario() || $this->esAdmin() )){
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
				if($this->estaLogeado && ($this->esUsuario() || $this->esAdmin() )){
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
				if($this->estaLogeado && ($this->esUsuario() || $this->esAdmin() )){
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
		$vin = validadorCtrl::validarVin($_REQUEST['vin']);
        $marca = validadorCtrl::validarTexto($_REQUEST['marca']);
        $modelo = validadorCtrl::validarTexto($_REQUEST['modelo']);
        $anho = validadorCtrl::validarAnho($_REQUEST['anho']);
        $color = validadorCtrl::validarTexto($_REQUEST['color']);
        $cilindraje = validadorCtrl::validarTexto($_REQUEST['cilindraje']);
        $transmision = validadorCtrl::validarTexto($_REQUEST['transmision']);
        $combustible = validadorCtrl::validarTexto($_REQUEST['combustible']);

        $resultado = $this -> modelo -> insertar($vin,$marca,$modelo,$anho,$color,$cilindraje,$transmision,$combustible);
            
        if($resultado){
            require('view/vehiculoInsertado.php'); #cambiar a html
        }
            
        else{                
           require('view/errorVehiculoInsertado.php'); #cambiar a html
        }
            
	}

	/**
	*A través del modelo se recupera un listado de vehículos.
	*Si existe la lista la muestra, en caso contrario envía error.
	*/
	public function listar(){

		$lista = $this -> modelo -> listar();
		
		if(isset($lista)){
			require('view/vehiculoListado.php');
		}
		else{
			require('view/errorVehiculoListado.php'); #cambiar a html
		}

	}

	/**
	*Se modifica información de un vehículo a través de su VIN.
	*Se valida el VIN y se manda a modificar.
	*/
	public function modificar(){

		require('controller/validadorCtrl.php');
		$vin = validadorCtrl::validarVin($_REQUEST['vin']);
		$resultado = $this -> modelo -> modificar($vin);
            
        if($resultado){
            require('view/vehiculoModificado.php'); #cambiar a html
        }
            
        else{
            require('view/errorVehiculoModificado.php'); #cambiar a html
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
		$vin = validadorCtrl::validarVin($_REQUEST['vin']);
		
		$resultado = $this->modelo->buscar($vin);
		if($resultado){
			require('view/vehiculoBuscar.php');
		}else{
			require('view/errorVehiculoBuscar.php');
		}
	}
}

?>