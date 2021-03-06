<?php
	require('controller/CtrlEstandar.php');
	class empleadoCtrl extends CtrlEstandar{
		private $modelo;

		/**
		 *Constructor de la clase empleadoCtrl.
		 *Al invocarse, se instancia el modelo de empleado.
		 */
		function __construct(){
			require('model/empleadoMdl.php');
			$this->modelo = new empleadoMdl();
		}

		/**
		 *Ejecuta la acción que se desea realizar.
		 */
		function run(){
			switch ($_REQUEST['accion']) {
				case 'insertar':
					if($this->estaLogeado() && $this->esAdmin() ) {
						$this->insertar();
					}else{
						if(!$this->estaLogeado()){
							header('Location : index.php?ctrl=login&accion=iniciarSesion');
						}else{
							$header 	= file_get_contents('view/headerLoged.html');
							$contenido 	= file_get_contents('view/errorAcceso.html');
							$footer 	= file_get_contents('view/footer.html');
							$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
							echo $header.$contenido.$footer;
						}
					}
					break;
				
				case 'consultar':
					if($this->estaLogeado() && $this->esAdmin() ) {
						$this->consultar();
					}else{
						if(!$this->estaLogeado()){
							header('Location : index.php?ctrl=login&accion=iniciarSesion');
						}else{
							$header 	= file_get_contents('view/headerLoged.html');
							$contenido 	= file_get_contents('view/errorAcceso.html');
							$footer 	= file_get_contents('view/footer.html');
							$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
							echo $header.$contenido.$footer;
						}
					}
					break;
				
				case 'listar':
					if($this->estaLogeado() && $this->esAdmin() ) {
						$this->listar();
					}else{
						if(!$this->estaLogeado()){
							header('Location : index.php?ctrl=login&accion=iniciarSesion');
						}else{
							$header 	= file_get_contents('view/headerLoged.html');
							$contenido 	= file_get_contents('view/errorAcceso.html');
							$footer 	= file_get_contents('view/footer.html');
							$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
							echo $header.$contenido.$footer;
						}
					}
					break;

				case 'modificar':
					if($this->estaLogeado() && $this->esAdmin()){
						$this->modificar();
					}else{
						if(!$this->estaLogeado()){
							header('Location : index.php?ctrl=login&accion=iniciarSesion');
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
					if($this->estaLogeado() && $this->esAdmin()){
						$this->eliminar();
					}else{
						if(!$this->estaLogeado()){
							header('Location : index.php?ctrl=login&accion=iniciarSesion');
						}else{
							$header 	= file_get_contents('view/headerLoged.html');
							$contenido 	= file_get_contents('view/errorAcceso.html');
							$footer 	= file_get_contents('view/footer.html');
							$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
							echo $header.$contenido.$footer;
						}
					}
					break;

				case 'consultarAjax':
                    if( $this->estaLogeado() && $this->esAdmin() ){
                        $this -> consultarAjax();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            $header     = file_get_contents('view/headerLoged.html');
                            $contenido  = file_get_contents('view/errorAcceso.html');
                            $footer     = file_get_contents('view/footer.html');
                            $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
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
		 *Ejecuta la acción insertar empleado.
		 */
		public function insertar(){
			if(empty($_POST)){
				$header 	= file_get_contents('view/headerLoged.html');
				$contenido 	= file_get_contents('view/empleadoInsertar.html');
				$footer 	= file_get_contents('view/footer.html');
				$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
				echo $header.$contenido.$footer;
			}else{
				require('controller/validadorCtrl.php');
				require_once('model/direccionMdl.php');
				require_once('model/telefonoMdl.php');

				$nombre		= $_POST['nombre'];
				$apellidoPat= $_POST['apellidoPat'];
				$apellidoMat= $_POST['apellidoMat'];
				$fechaNac	= $_POST['fechaNac'] ;
				$rfc		= $_POST['rfc'] ;
				$nss		= $_POST['nss'];
				$email		= $_POST['email'] ;
				$status		= 'ACTIVO';
				$nombre		= (validadorCtrl::validarNombre($nombre)) ? $nombre: ""; 
				$apellidoPat= (validadorCtrl::validarNombre($apellidoPat))? $apellidoPat : "";
				$apellidoMat= (validadorCtrl::validarNombre($apellidoMat))? $apellidoMat : ""; 
				$status		=  validadorCtrl::validarTexto($status); 
				$fechaNac	= (validadorCtrl::validarFecha($fechaNac))? $fechaNac : "";
				$rfc		= (validadorCtrl::validarRfc($rfc))? $rfc : "";
				$nss		= (validadorCtrl::validarNss($nss))? $nss : "";
				$email		= (validadorCtrl::validarEmail($email))? $email : "";

				$resultadoEmpleado = $this->modelo->insertar($nombre,
													 $apellidoPat,
													 $apellidoMat,
													 $fechaNac,
													 $rfc,
													 $nss,
													 $email,
													 $status);

				if($resultadoEmpleado != -1){
					$calle		= (validadorCtrl::validarTexto($_POST['calle']))? $_POST['calle'] : '';
					$numeroExt 	= (validadorCtrl::validarNumero((int)$_POST['numeroExterior'])) ? $_POST['numeroExterior'] : '';
					$numeroInt 	= (validadorCtrl::validarTexto($_POST['numeroInterior']))? $_POST['numeroInterior'] : '';
					$codigoPostal = (validadorCtrl::validarCodigoPostal($_POST['codigoPostal']))?$_POST['codigoPostal'] : '';
					$colonia 	= (validadorCtrl::validarTexto($_POST['colonia'])) ? $_POST['colonia'] : '';
					$ciudad 	= (validadorCtrl::validarTexto($_POST['ciudad']))? $_POST['ciudad'] : '';
					$estado 	= (validadorCtrl::validarTexto($_POST['estado'])) ? $_POST['estado'] : '';

					$modeloDireccion = new direccionMdl();
					$resultadoDireccion = $modeloDireccion -> insertar($resultadoEmpleado['CodigoEmpleado'],$calle,$numeroExt, $numeroInt,$colonia,$codigoPostal, $ciudad, $estado);

					if($resultadoDireccion > 0){
						$telefono 	= (validadorCtrl::validarTelefono($_POST['telefono']))? $_POST['telefono'] : '';
						$tipoTelefono = (validadorCtrl::validarTexto($_POST['tipoTelefono']))? $_POST['tipoTelefono'] : '';

						$modeloTelefono = new telefonoMdl();

						$resultadoTelefono = $modeloTelefono->insertar($resultadoEmpleado['CodigoEmpleado'],$telefono, $tipoTelefono);
						//echo 'resultadoTelefono:'.var_dump($resultadoTelefono).'<br>';
						if($resultadoTelefono > 0){
							$header     = file_get_contents('view/headerLoged.html');
	                        $contenido  = file_get_contents('view/mensajeConfirmacion.html');
	                        $footer     = file_get_contents('view/footer.html');
	                        $contenido  = str_replace('{mensaje}', '¡Empleado registrado con éxito!', $contenido); 
	                        $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);
	                        echo $header.$contenido.$footer;
						}else{
							$header     = file_get_contents('view/headerLoged.html');
	                        $contenido  = file_get_contents('view/mensajeConfirmacion.html');
	                        $footer     = file_get_contents('view/footer.html');
	                        $contenido  = str_replace('{mensaje}', '¡Error al insertar teléfono de empleado!', $contenido); 
	                        $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);
	                        echo $header.$contenido.$footer;
						}
					}else{	
						$header     = file_get_contents('view/headerLoged.html');
                        $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                        $footer     = file_get_contents('view/footer.html');
                        $contenido  = str_replace('{mensaje}', '¡Error al insertar dirección de empleado!', $contenido); 
                        $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);
                        echo $header.$contenido.$footer;
					}
				}else{
					$header     = file_get_contents('view/headerLoged.html');
                    $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                    $footer     = file_get_contents('view/footer.html');
                    $contenido  = str_replace('{mensaje}', '¡Error al insertar empleado!', $contenido);
                    $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);
                    echo $header.$contenido.$footer;
				}
			}
		}

		/**
		 *Ejecuta la acción buscar empleado.
		 */
		public function consultar(){
			if(isset($_GET['codigo']) && !empty($_GET['codigo'])){
				$codigo = $_GET['codigo'];

				$resultado = $this->modelo->consultar($codigo);

				if($resultado != NULL){
					$header 	= file_get_contents('view/headerLoged.html');
					$contenido 	= file_get_contents('view/empleadoConsultar.html');
					$footer 	= file_get_contents('view/footer.html');

					$inicioTelefono = strpos($contenido, '{inicioTelefono}');
					$finTelefono	= strpos($contenido, '{finTelefono}')+13;
					$filaTelefono	= substr($contenido, $inicioTelefono, $finTelefono-$inicioTelefono);

					$filas ="";

					foreach ($resultado as $telefono) {
						//var_dump($telefono);echo '<br>';
						
						$nuevaFila = $filaTelefono;
						$diccionario = array('{tipoTelefono}'=>$telefono['tipo'],'{telefono}'=>$telefono['telefono'],'{inicioTelefono}'=>'','{finTelefono}'=>'');
						$nuevaFila = strtr($nuevaFila,$diccionario);
						$filas .= $nuevaFila;
					}

					$diccionario = array(
						'{nombre}'=>$resultado[0]['nombre'],
						'{apellidoPaterno}'=>$resultado[0]['apellidoPaterno'],
						'{apellidoMaterno}'=>$resultado[0]['apellidoMaterno'],
						'{fechaNacimiento}'=>$resultado[0]['fechaNacimiento'],
						'{rfc}'=>$resultado[0]['RFC'],
						'{nss}'=>$resultado[0]['NSS'],
						'{email}'=>$resultado[0]['email'],
						'{calle}'=>$resultado[0]['calle'],
						'{numeroExt}'=>$resultado[0]['numeroExt'],
						'{numeroInt}'=>$resultado[0]['numeroInt'],
						'{codigoPostal}'=>$resultado[0]['codigoPostal'],
						'{colonia}'=>$resultado[0]['colonia'],
						'{ciudad}'=>$resultado[0]['ciudad'],
						'{estado}'=>$resultado[0]['estado'],
						'{usuario}'=>$resultado[0]['usuario']
						//'{telefono}'=>$resultado['telefono']
						//'{tipoTelefono}'=>$resultado['tipo'],
						);
					$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
					$contenido 	= strtr($contenido,$diccionario);
					$contenido	= str_replace($filaTelefono, $filas, $contenido);
					echo json_encode($resultado);
					echo $header.$contenido.$footer;
				}else{
					$header     = file_get_contents('view/headerLoged.html');
	                $contenido  = file_get_contents('view/mensajeConfirmacion.html');
	                $footer     = file_get_contents('view/footer.html');
	                $header  = str_replace('{usuario}', $_SESSION['usuario'], $header);
	                $contenido  = str_replace('{mensaje}', 'No hubo resultados.', $contenido); 
	                $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);
	                echo $header.$contenido.$footer;
				}
			}else{
				$header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                $footer     = file_get_contents('view/footer.html');
                $header  = str_replace('{usuario}', $_SESSION['usuario'], $header);
                $contenido  = str_replace('{mensaje}', 'Favor de introducir el código del empleado', $contenido); 
                $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);
                echo $header.$contenido.$footer;
			}
		}

		/**
		 * Lista todos los empleados registrados.
		 *
		 */
		public function listar(){
			$resultado = $this->modelo->listar();

			if($resultado){
				#Se guardan archivos en variables
				$header 	= file_get_contents('view/headerLoged.html');
				$contenido	= file_get_contents('view/empleadoListar.html');
				$footer		= file_get_contents('view/footer.html');
				
				$inicio_fila 	= strpos($contenido,'{inicioFila}');
				$fin_fila		= strpos($contenido,'{finFila}')+9;
				$filaTabla		= substr($contenido, $inicio_fila,$fin_fila-$inicio_fila);

				$filas = "";
				foreach ($resultado as $empleado) {
					$new_fila = $filaTabla;
					//Reemplazo con un diccionario
					$nombreCompleto	= $empleado['nombre'].' '.$empleado['apellidoMaterno'].' '.$empleado['apellidoPaterno'];
					$diccionario = array('{codigoEmpleado}' => $empleado['Codigo'], '{nombreEmpleado}' => $nombreCompleto,'{inicioFila}'=>'','{finFila}'=>'');
					$new_fila = strtr($new_fila,$diccionario);
					$filas .= $new_fila;
				}
				
				$header = str_replace('{usuario}', $_SESSION['usuario'], $header);
				$contenido = str_replace($filaTabla, $filas, $contenido);
				echo $header.$contenido.$footer;
				
			}else{
				$header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                $footer     = file_get_contents('view/footer.html');
                $header  = str_replace('{usuario}', $_SESSION['usuario'], $header);
                $contenido  = str_replace('{mensaje}', 'Error al listar empleados.', $contenido); 
                $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);
                echo $header.$contenido.$footer;
			}
		}

		/**
		 * Modificación de los datos correspondientes a empleado.
		 */
		public function modificar(){
			
			if( (isset($_GET['codigo']) && !empty($_GET['codigo'])) && !empty($_POST) ) {
				$header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                $footer     = file_get_contents('view/footer.html');
                $header  = str_replace('{usuario}', $_SESSION['usuario'], $header);
                $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);
                
				require_once('controller/validadorCtrl.php');
				$codigoEmpleado = $_GET['codigo'];
				$nombre			= $_POST['nombre'];
				$apellidoPaterno= $_POST['apellidoPaterno'];
				$apellidoMaterno= $_POST['apellidoMaterno'];
				$fechaNac		= $_POST['fechaNacimiento'] ;
				$rfc			= $_POST['rfc'] ;
				$nss			= $_POST['nss'];
				$email			= $_POST['email'] ;
				//$status			= $_POST['status'];

				$nombre		= (validadorCtrl::validarNombre($nombre))? $nombre: ""; 
				$apellidoPaterno= (validadorCtrl::validarNombre($apellidoPaterno))? $apellidoPaterno : "";
				$apellidoMaterno= (validadorCtrl::validarNombre($apellidoMaterno))? $apellidoMaterno : ""; 
				$fechaNac	= (validadorCtrl::validarFecha($fechaNac))? $fechaNac : "";
				$rfc		= (validadorCtrl::validarRfc($rfc))? $rfc : "";
				$nss		= (validadorCtrl::validarNss($nss))? $nss : "";
				$email		= (validadorCtrl::validarEmail($email))? $email : "";

				$resultadoEmpleado = $this->modelo->modificar($codigoEmpleado, $nombre, $apellidoPaterno, $apellidoMaterno, $fechaNac, $rfc, $nss, $email);

				if($resultadoEmpleado){
					require_once('model/direccionMdl.php');
					$calle		= (validadorCtrl::validarTexto($_POST['calle'])) ? $_POST['calle']: '';
					$numeroExt	= (validadorCtrl::validarNumero((int)$_POST['numeroExterior'])) ? (int)$_POST['numeroExterior'] : '';
					$numeroInt	= (validadorCtrl::validarTexto($_POST['numeroInterior'])) ? $_POST['numeroInterior'] : '';
					$codigoPostal = (validadorCtrl::validarTexto($_POST['codigoPostal'])) ? $_POST['codigoPostal'] : '';
					$colonia 	= (validadorCtrl::validarTexto($_POST['colonia'])) ? $_POST['colonia'] : '';
					$ciudad 	= (validadorCtrl::validarTexto($_POST['ciudad'])) ? $_POST['ciudad'] : '';
					$estado 	= (validadorCtrl::validarTexto($_POST['estado'])) ? $_POST['estado'] : '';

					$modeloDireccion = new direccionMdl();
					$resultadoDireccion = $modeloDireccion -> modificar($codigoEmpleado, $calle, $numeroExt, $numeroInt, $codigoPostal, $colonia, $ciudad, $estado);
					if($resultadoDireccion){
						require_once('model/telefonoMdl.php');
						$telefono 	= (validadorCtrl::validarTelefono($_POST['telefono'])) ? $_POST['telefono'] : '';
						$tipoTelefono = (validadorCtrl::validarTexto($_POST['tipoTelefono'])) ? $_POST['tipoTelefono'] : '';

						$modeloTelefono = new telefonoMdl();
						$resultadoTelefono = $modeloTelefono -> modificar($codigoEmpleado,$telefono,$tipoTelefono);

						if($resultadoTelefono){
							$contenido  = str_replace('{mensaje}', 'Empleado modificado con éxito.', $contenido); 

						}else{
							$contenido  = str_replace('{mensaje}', 'Error al insertar el teléfono.', $contenido); 
						}
					}else{
						$contenido  = str_replace('{mensaje}', 'Error al insertar la dirección', $contenido); 
					}
				}else{
					$contenido  = str_replace('{mensaje}', 'Error al insertar el empleado.', $contenido); 
				}
				echo $header.$contenido.$footer;
			}else{
				$codigo = $_GET['codigo'];

				$resultado = $this->modelo->consultar($codigo);

				if($resultado != NULL){
					$header 	= file_get_contents('view/headerLoged.html');
					$contenido 	= file_get_contents('view/empleadoModificar.html');
					$footer 	= file_get_contents('view/footer.html');

					$inicioFila = strpos($contenido, '{inicioFila}');
					$finFila	= strpos($contenido, '{finFila}')+9;
					$fila		= substr($contenido, $inicioFila, $finFila-$inicioFila);

					$filas ="";

					foreach ($resultado as $telefono) {
						$nuevaFila = $fila;
						$diccionario = array('{tipoTelefono}'=>$telefono['tipo'],'{telefono}'=>$telefono['telefono'],'{inicioFila}'=>'','{finFila}'=>'');
						$nuevaFila = strtr($nuevaFila,$diccionario);
						$filas .= $nuevaFila;
					}

					$diccionario = array(
						'{codigoEmpleado}'=>$codigo,
						'{nombreEmpleado}'=>$resultado[0]['nombre'],
						'{apellidoPaterno}'=>$resultado[0]['apellidoPaterno'],
						'{apellidoMaterno}'=>$resultado[0]['apellidoMaterno'],
						'{fechaNacimiento}'=>$resultado[0]['fechaNacimiento'],
						'{rfc}'=>$resultado[0]['RFC'],
						'{nss}'=>$resultado[0]['NSS'],
						'{email}'=>$resultado[0]['email'],
						'{status}'=>($resultado[0]['status'] == 1)?'ACTIVO' : 'INACTIVO',
						'{calle}'=>$resultado[0]['calle'],
						'{numeroExt}'=>$resultado[0]['numeroExt'],
						'{numeroInt}'=>$resultado[0]['numeroInt'],
						'{codigoPostal}'=>$resultado[0]['codigoPostal'],
						'{colonia}'=>$resultado[0]['colonia'],
						'{ciudad}'=>$resultado[0]['ciudad'],
						'{estado}'=>$resultado[0]['estado']
						);
					$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
					$contenido 	= strtr($contenido,$diccionario);
					$contenido	= str_replace($fila, $filas, $contenido);

					echo $header.$contenido.$footer;
				}else{

				}
			}
		}

		/**
		 * Eliminación de empleado
		 */
		public function eliminar(){
			if(!isset($_GET['codigo']) && empty($_GET['codigo'])){
				header('Location: index.php?ctrl=empleado&accion=listar');
			}else{
				require('controller/validadorCtrl.php');
				$header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                $footer     = file_get_contents('view/footer.html');
                $header  = str_replace('{usuario}', $_SESSION['usuario'], $header);
                $contenido  = str_replace('{url}', 'ctrl=empleado&accion=listar', $contenido);

				$codigoEmpleado = $_GET['codigo'];
				if(validadorCtrl::validarCodigoEmpleado($codigoEmpleado)){
					$resultado = $this->modelo->eliminar($codigoEmpleado);
					if($resultado){
						$contenido  = str_replace('{mensaje}', '¡Empleado eliminado con éxito!.', $contenido); 
					}else{
						$contenido  = str_replace('{mensaje}', 'Error al eliminar empleado.', $contenido); 
					}
				}else{
					$contenido  = str_replace('{mensaje}', 'Formato del código del empleado no valido.', $contenido); 
				}
				echo $header.$contenido.$footer;
			}
		}


        public function consultarAjax(){
            if(!empty($_POST)){
            	//echo 'primer if ';
                if(isset($_POST['codigoEmpleado']) & !empty($_POST['codigoEmpleado'])){
                	//echo 'segundo if ';
                    $codigoEmpleado = $_POST['codigoEmpleado'];
                    $resultado = $this -> modelo -> consultar($codigoEmpleado);
                    if($resultado){
                        echo json_encode($resultado);
                    }
                }
            }
        }
	}
?>