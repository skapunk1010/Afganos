<?php

class vehiculoCtrl
{
	private $modelo;

	function __construct()
	{
		require("model/vehiculoMdl.php");
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
           require('view/error.php'); #cambiar a html, errorInsertar.php
        }
            
	}

	function listar()
	{
		$lista = $this -> modelo -> listar();
		
		if($lista){
			require('view/vehiculoLista.php');
		}
		else{
			require('view/error.php'); #cambiar a vista individual
		}

	}

	function modificar()
	{
		$resultado = $this -> modelo -> modificar();
            
        if($resultado){
            require('view/vehiculoModificado.php'); #cambiar a html
        }
            
        else{
            require('view/error.php'); #cambiar a html
        }
	}

	function eliminar()
	{
		require('controller/validadorCtrl.php');
		$vin = validadorCtrl::validarVin($_REQUEST['vin']);
		$resultado = $this -> modelo -> eliminar($vin);
            
        if($resultado){    
            require('view/vehiculoEliminado.php'); #cambiar a html
        }
            
        else{     
            require('view/error.php'); #cambiar a html
        }
	}
}

?>