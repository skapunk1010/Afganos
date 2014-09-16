<?php

class vehiculoCtrl
{
	private $modelo;

	function __construct()
	{
		require("controllers/vehiculoMdl.php");
		$this -> modelo = new vehiculoMdl();
	}

	function run()
	{
		switch($_REQUEST['accion'])
		{
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
				#vista de error.
				break;

		}
	}

	function insertar()
	{
		require('controllers/validadorCtrl.php');
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
                
                require('views/vehiculoInsertado.php'); #cambiar a html
            }
            
            else{
                
                require('views/error.php'); #cambiar a html
            }
            
	}

	function listar()
	{
		#imprimir lo que modelo regrese.
		$lista = $this -> modelo -> listar();
	}

	function modificar()
	{
		#el/los datos a eliminar
		$resultado = $this -> modelo -> modificar();
            
        	if($resultado){
                require('views/vehiculoModificado.php'); #cambiar a html
            }
            
            else{
                require('views/error.php'); #cambiar a html
            }
	}

	function eliminar()
	{
		#vin del vehículo a cambiar status
		$resultado = $this -> modelo -> eliminar($vin);
            
        	if($resultado){    
                require('views/vehiculoEliminado.php'); #cambiar a html
            }
            
            else{     
                require('views/error.php'); #cambiar a html
            }
	}
}

?>