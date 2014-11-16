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
							require('view/errorAcceso.php');
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
							require('view/errorAcceso.php');
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
							require('view/errorAcceso.php');
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
							require('view/errorAcceso.php');
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
							require('view/errorAcceso.php');
						}
					}
					break;
				default:
					require('view/error.php');
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
				$nombre		= $_POST['nombre'];
				$apellidoPat= $_POST['apellidoPat'];
				$apellidoMat= $_POST['apellidoMat'];
				$fechaNac	= $_POST['fechaNac'] ;
				$rfc		= $_POST['rfc'] ;
				$nss		= $_POST['nss'];
				$email		= $_POST['email'] ;
				$status		= $_POST['status'];

				$nombre		= (validadorCtrl::validarNombre($nombre))? $nombre: ""; 
				$apellidoPat= (validadorCtrl::validarNombre($apellidoPat))? $apellidoPat : "";
				$apellidoMat= (validadorCtrl::validarNombre($apellidoMat))? $apellidoMat : ""; 
				$status		=  validadorCtrl::validarTexto($status); 
				$fechaNac	= (validadorCtrl::validarFecha($fechaNac))? $fechaNac : "";
				$rfc		= (validadorCtrl::validarRfc($rfc))? $rfc : "";
				$nss		= (validadorCtrl::validarNss($nss))? $nss : "";
				$email		= (validadorCtrl::validarEmail($email))? $email : "";

				$resultado = $this->modelo->insertar($nombre,
													 $apellidoPat,
													 $apellidoMat,
													 $fechaNac,
													 $rfc,
													 $nss,
													 $email,
													 $status);
				if($resultado){
					require('view/empleadoInsertado.php');
				}else{
					require('view/errorEmpleadoInsertado.php');
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
						'{colonia}'=>$resultado['']['colonia'],
						'{ciudad}'=>$resultado[0]['ciudad'],
						'{estado}'=>$resultado[0]['estado'],
						'{usuario}'=>$resultado[0]['usuario']
						//'{telefono}'=>$resultado['telefono']
						//'{tipoTelefono}'=>$resultado['tipo'],
						);
					$header 	= str_replace('{usuario}', $_SESSION['usuario'], $header);
					$contenido 	= strtr($contenido,$diccionario);
					$contenido	= str_replace($filaTelefono, $filas, $contenido);

					echo $header.$contenido.$footer;
				}else{
					require('view/errorEmpleadoBuscar.php');
				}
			}else{
				#Codigo de empleado no se introdujo.
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
				require('view/errorEmpleado.php');
			}
		}

		public function modificar(){
			if(isset($_GET['codigo']) && !empty($_GET['codigo'])){

			}else{

			}
		}

		public function eliminar(){
			if(isset($_GET['codigo']) && !empty($_GET['codigo'])){

			}else{
				
			}
		}
	}
?>