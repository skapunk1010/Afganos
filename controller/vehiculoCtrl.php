<?php

class vehiculoCtrl{

	private $modelo;

	function __construct(){

		require("model/vehiculoMdl.php");
		$this -> modelo = new vehiculoMdl();
	}

	public function run(){

		switch($_REQUEST['accion']){
			
			case "insertar":
				$this -> insertar();
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

	public function listar(){

		$lista = $this -> modelo -> listar();
		
		if(isset($lista)){
			require('view/vehiculoListado.php');
		}
		else{
			require('view/errorVehiculoListado.php'); #cambiar a html
		}

	}

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
}

?>