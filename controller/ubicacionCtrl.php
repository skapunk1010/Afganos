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
					$this -> insertar();
					break;
				case 'buscar':
					$this -> buscar();
					break;
				case 'obtenerDisponible':
					$this -> disponible();
					break;
				default: break;
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
			if( isset($_REQUEST['idUbicacion'])){
				$idUbicacion = $_REQUEST['idUbicacion'];
				$resultado = $this -> modelo -> buscar($idUbicacion);
				if($resultado){
					var_dump($resultado);
				}
				else{
					require('view/errorConsultarUbicacion.php');
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