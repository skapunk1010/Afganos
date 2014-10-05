<?php

class vehiculoCtrl{

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
				$this -> insertar();
				break;

			case "buscar":
				$this->buscar();
				break;

			case "listar":
				$this -> listar();
				break;

			case "modificar":
				$this -> modificar();
				break;

			case "eliminar":
				$this -> eliminar();
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
        $marca = validadorCtrl::validarTxt($_REQUEST['marca']);
        $modelo = validadorCtrl::validarTxt($_REQUEST['modelo']);
        $anho = validadorCtrl::validarAnho($_REQUEST['anho']);
        $color = validadorCtrl::validarTxt($_REQUEST['color']);
        $cilindraje = validadorCtrl::validarTxt($_REQUEST['cilindraje']);
        $transmision = validadorCtrl::validarTxt($_REQUEST['transmision']);
        $combustible = validadorCtrl::validarTxt($_REQUEST['combustible']);

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
		
		$resultado = $this->modelo->eliminar();
		
		if($resultado){
			require();
		}else{
			require();
		}
	}
}

?>