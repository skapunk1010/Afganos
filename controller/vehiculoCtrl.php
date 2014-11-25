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
					$dropModelos .= "<option value='".$modelo['idModelo']."'>".$modelo['Modelo']."</option>";
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
			if(!empty($_POST)){
				require_once('controller/validadorCtrl.php');
				#Datos del vehículo
				$vin 		= (validadorCtrl::validarVIN($_POST['vin'])) ? $_POST['vin'] : "";
				$modelo 	= (validadorCtrl::validarNumero((int)$_POST['idModelo'])) ? (int)$_POST['idModelo'] : 0;
				$anho 		= (validadorCtrl::validarAnho($_POST['anho'])) ? $_POST['anho'] : "";
				$color 		= (validadorCtrl::validarTexto($_POST['color'])) ? strtoupper($_POST['color']) : "";
				$cilindraje = $_POST['cilindraje'];
				$transmision= (validadorCtrl::validarTexto($_POST['transmision'])) ? strtoupper($_POST['transmision']) : "";
				$nPuertas 	= (validadorCtrl::validarNumero((int)$_POST['numeroPuertas'])) ? (int)$_POST['numeroPuertas'] : 0;
				$idCliente 	= (validadorCtrl::validarNumero((int)$_POST['idCliente'])) ? (int) $_POST['idCliente'] : 0;

				#Checklist
				$placaNumero 		= strtoupper($_POST['placaNumero']);
				$kilometraje		= (validadorCtrl::validarNumero((int) $_POST['kilometraje'])) ? (int)$_POST['kilometraje'] : 0;
				$gasolinaCantidad	= $_POST['gasolinaCantidad'];
				$cantidadCinturones = (validadorCtrl::validarNumero((int)$_POST['cantidadCinturones'])) ? (int) $_POST['cantidadCinturones'] : 0;
				$extintor			= (isset($_POST['extintor'])) ? (($_POST['extintor'] === 'on') ? true : false) : false  ;
				$tableroDetalle		= (validadorCtrl::validarTexto($_POST['tableroDetalle'])) ? $_POST['tableroDetalle'] : "";
				$asientosCantidad	= (validadorCtrl::validarNumero((int)$_POST['asientosCantidad'])) ? (int)$_POST['asientosCantidad'] : 0;
				$asientosDetalle	= (validadorCtrl::validarTexto($_POST['asientosDetalle'])) ? $_POST['asientosDetalle'] : "";

				$espejoIzquierdo	= (isset($_POST['espejoIzquierdo'])) ? (($_POST['espejoIzquierdo'] === 'on') ? true : false) : false  ;
				$espejoRetrovisor	= (isset($_POST['espejoRetrovisor'])) ? (($_POST['espejoRetrovisor'] === 'on') ? true : false) : false  ;
				$espejoDerecho		= (isset($_POST['espejoDerecho'])) ? (($_POST['espejoDerecho'] === 'on') ? true : false) : false  ;
				$faroDelanteroDerecho	= (isset($_POST['faroDelanteroDerecho'])) ? (($_POST['faroDelanteroDerecho'] === 'on') ? true : false) : false  ;
				$faroDelanteroIzquierdo	= (isset($_POST['faroDelanteroIzquierdo'])) ? (($_POST['faroDelanteroIzquierdo'] === 'on') ? true : false) : false  ;
				$faroTraseroDerecho		= (isset($_POST['faroTraseroDerecho'])) ? (($_POST['faroTraseroDerecho'] === 'on') ? true : false) : false  ;
				$faroTraseroIzquierdo	= (isset($_POST['faroTraseroIzquierdo'])) ? (($_POST['faroTraseroIzquierdo'] === 'on') ? true : false) : false  ;
				$farosDetalle		= (validadorCtrl::validarTexto($_POST['farosDetalle'])) ? $_POST['farosDetalle'] : "";

				$direccionalDelanteraDerecha	= (isset($_POST['direccionalDelanteraDerecha'])) ? (($_POST['direccionalDelanteraDerecha'] === 'on') ? true : false) : false  ;
				$direccionalDelanteraIzquierda	= (isset($_POST['direccionalDelanteraIzquierda'])) ? (($_POST['direccionalDelanteraIzquierda'] === 'on') ? true : false) : false  ;
				$direccionalTraseraDerecha		= (isset($_POST['direccionalTraseraDerecha'])) ? (($_POST['direccionalTraseraDerecha'] === 'on') ? true : false) : false  ;
				$direccionalTraseraIzquierda	= (isset($_POST['direccionalTraseraIzquierda'])) ? (($_POST['direccionalTraseraIzquierda'] === 'on') ? true : false) : false  ;
				$direccionalDetalle = (validadorCtrl::validarTexto($_POST['direccionalDetalle'])) ? $_POST['direccionalDetalle'] : "";

				$defensaDelantera	= (isset($_POST['defensaDelantera'])) ? (($_POST['defensaDelantera'] === 'on') ? true : false) : false  ;
				$defensaTrasera		= (isset($_POST['defensaTrasera'])) ? (($_POST['defensaTrasera'] === 'on') ? true : false) : false  ;
				
				$defensaDetalle		= (validadorCtrl::validarTexto($_POST['defensaDetalle'])) ? $_POST['defensaDetalle'] : "";

				$llantaRefaccion	= (isset($_POST['llantaRefaccion'])) ? (($_POST['llantaRefaccion'] === 'on') ? true : false) : false  ;
				$llantasDetalle		= (validadorCtrl::validarTexto($_POST['llantasDetalle'])) ? $_POST['llantasDetalle'] : "";

				$parabrisasDelantero	= (isset($_POST['parabrisasDelantero'])) ? (($_POST['parabrisasDelantero'] === 'on') ? true : false) : false  ;
				$parabrisasTrasero		= (isset($_POST['parabrisasTrasero'])) ? (($_POST['parabrisasTrasero'] === 'on') ? true : false) : false  ;
				$parabrisasDetalle		= (validadorCtrl::validarTexto($_POST['vidriosDetalle'])) ? $_POST['parabrisasDetalle'] : "";

				$placaDelantera		= (isset($_POST['placaDelantera'])) ? (($_POST['placaDelantera'] === 'on') ? true : false) : false  ;
				$placaTrasera		= (isset($_POST['placaTrasera'])) ? (($_POST['placaTrasera'] === 'on') ? true : false) : false  ;

				$puertasDetalle		= (validadorCtrl::validarTexto($_POST['puertasDetalle'])) ? $_POST['puertasDetalle'] : "";
				$cofreDetalle		= (validadorCtrl::validarTexto($_POST['cofreDetalle'])) ? $_POST['cofreDetalle'] : "";
				$cajuelaDetalle		= (validadorCtrl::validarTexto($_POST['cajuelaDetalle'])) ? $_POST['cajuelaDetalle'] : "";
				$techoDetalle		= (validadorCtrl::validarTexto($_POST['techoDetalle'])) ? $_POST['techoDetalle'] : "";
				$vidriosDetalle		= (validadorCtrl::validarTexto($_POST['vidriosDetalle'])) ? $_POST['vidriosDetalle'] : "";

				#Insertamos en el modelo de vehiculo
				$resultado = $this -> modelo -> insertar($vin,
														$modelo,
														$anho,
														$color,
														$cilindraje,
														$transmision,
														$nPuertas,
														$idCliente,
														#Checklist
														$placaNumero,
														$kilometraje,
														$gasolinaCantidad,
														$cantidadCinturones,
														$extintor,
														$tableroDetalle,
														$asientosCantidad,
														$asientosDetalle,

														$espejoIzquierdo,
														$espejoRetrovisor,
														$espejoDerecho,

														$faroDelanteroDerecho,
														$faroDelanteroIzquierdo,
														$faroTraseroDerecho,
														$faroTraseroIzquierdo,
														$farosDetalle,

														$direccionalDelanteraDerecha,
														$direccionalDelanteraIzquierda,
														$direccionalTraseraDerecha,
														$direccionalTraseraIzquierda,
														$direccionalDetalle,

														$defensaDelantera,
														$defensaTrasera,
														$defensaDetalle,

														$llantaRefaccion,
														$llantasDetalle,
														$parabrisasDelantero,
														$parabrisasTrasero,
														$parabrisasDetalle,

														$placaDelantera,
														$placaTrasera,

														$puertasDetalle,
														$cofreDetalle,
														$cajuelaDetalle,
														$techoDetalle,
														$vidriosDetalle
												);
	            
		        if($resultado){
		            #require('view/html/exitos/vehiculoInsertar.html'); #cambiar a html
		            echo 'Insertados';
		        }
		            
		        else{                
		           #require('view/html/errores/errorVehiculoInsertar.html'); #cambiar a html
		        	echo 'Error';
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
		require_once('controller/validadorCtrl.php');
		if( (!isset($_GET['vin']) && empty($_GET['vin'])) || empty($_POST)){
			$header 	= file_get_contents('view/headerLoged.html');
			$contenido 	= file_get_contents('view/vehiculoModificar.html');
			$footer 	= file_get_contents('view/footer.html');
			
			$VIN 		= (validadorCtrl::validarVin($_GET['vin'])) ? $_GET['vin'] : "";
			$resultado 	= $this->modelo->consultar($VIN);
			
			if($resultado){
				$diccionario = array(
				'{VIN}'=>$resultado[0]['VIN'],
				'{transmision}'=>$resultado[0]['transmision'],
				'{marca}'=>$resultado[0]['Marca'],
				'{modelo}'=>$resultado[0]['idModelo'],
				'{Color}'=>$resultado[0]['color'],
				'{cilindraje}'=>$resultado[0]['cilindraje'],
				'{numeroPuertas}'=>$resultado[0]['numeroPuertas'],
				'{anho}'=>$resultado[0]['anho'],
				);
				$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
				$contenido 	= strtr($contenido,$diccionario);

				echo $header.$contenido.$footer;
			}else{
				#Not found
				echo 'Not found';
			}
		}else{
			$vin 		= (validadorCtrl::validarVin($_GET['vin'])) ? $_GET['vin'] : "";
			$modelo 	= (validadorCtrl::validarTexto($_POST['modelo'])) ? $_POST['modelo'] : ""; 
			$color 		= (validadorCtrl::validarTexto($_POST['color'])) ? $_POST['color'] : "";
			$transmision = (validadorCtrl::validarTexto($_POST['transmision'])) ? $_POST['transmision'] : "";
			$cilindraje = (validadorCtrl::validarNumero((int)$_POST['cilindraje'])) ? (int)$_POST['cilindraje'] : "";
			$anho 		= (validadorCtrl::validarAnho($_POST['anho'])) ? $_POST['anho'] : "";
			$numeroPuertas = (validadorCtrl::validarNumero($_POST['numeroPuertas'])) ? $_POST['numeroPuertas'] : "";
			#$cliente 	= (validadorCtrl::validar)$_POST['cliente'];
			
			$resultado = $this -> modelo -> modificar($vin,$modelo,$color,$transmision,$cilindraje,$anho,$numeroPuertas);
			if($resultado){
            	#require('view/vehiculoModificado.php'); #cambiar a html
            	echo 'Exito';
	        }
	            
	        else{
	            require('view/errorVehiculoModificado.php'); #cambiar a html
	        }
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