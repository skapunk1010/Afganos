<?php
    require('controller/CtrlEstandar.php');
	class loginCtrl extends CtrlEstandar{
		private $modelo;

        /**
        *Constructor de login
        *Carga modelo del mismo
        */
		function __construct(){
			require('model/loginMdl.php');
			$this->modelo = new loginMdl();
		}

        /**
        *Recibe acción que se desea: 
        *registrarse, iniciar o cerrar sesión.
        */
		function run(){
            switch($_GET['accion']){

                case 'signin':
                    if(!$this->estaLogeado()){
                        $this -> signin();
                    }else{
                        header('Location: index.php');
                    }
                    break;

                case 'iniciarSesion':
                    if(!$this->estaLogeado()){
                        $this -> iniciarSesion();
                    }else{
                        header('Location: index.php');
                    }
                    break;

                case 'cerrarSesion':
                    if($this->estaLogeado()){
                        $this->cerrarSesion();
                    }else{
                        header('Location: index.php');
                    }
                	break;

                default:
                    $header     = file_get_contents('view/headerLoged.html');
                    $contenido  = file_get_contents('view/errorAcceso.html');
                    $footer     = file_get_contents('view/footer.html');
                    $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                    echo $header.$contenido.$footer;
                    break;
            }
        }

        /**
        *Valida el usuario y contraseña otorgados antes de realizar el registro.
        *Si el registro fue exitoso mostrará el index.
        */
        function signin(){
            #Si no hay datos, muestra de nuevo formulario.
            if(empty($_POST)){
                //Cargo la vista del formulario
                $header = file_get_contents('view/headerIndex.html');
                $contenido = file_get_contents('view/loginSignin.html');
                $footer = file_get_contents('view/footer.html');
                echo $header.$contenido.$footer;
            }else{
                require('controller/validadorCtrl.php');            
                $usuario    = (validadorCtrl::validarUsuario($_POST['usuario']))? $_POST['usuario'] : "";
                $password   = (validadorCtrl::validarContrasenha($_POST['password']))? $_POST['password'] : "";
                $codigoEmpleado     = (validadorCtrl::validarCodigoEmpleado($_POST['codigoEmpleado']))? $_POST['codigoEmpleado'] : "";
                $privilegio = 'usuario';#$privilegio = (validadorCtrl::validarPrivilegio($_POST['privilegios']))? $_POST['privilegios'] : "";
                
                $resultado = $this -> modelo -> signin($codigoEmpleado,$usuario,$password,$privilegio);
                
                if($resultado){
                    header('Location: index.php');
                }
                else{  
                  header('Location: index.php?ctrl=login&accion=iniciarSesion'); #Dejar redireccionamiento a iniciarSesion
                }
            }
        }

        /**
        *Valida el usuario y contraseña ortorgados para el inicio de sesión.
        *Manda llamar el iniciar sesión a través del modelo.
        *Si el inicio fue correcto mostrará el index.
        */
        function iniciarSesion(){
            
        	if(empty($_POST)){
                #Mostrar formulario donde ingresa los datos del login
                $header = file_get_contents('view/headerIndex.html');
                $contenido = file_get_contents('view/loginIniciarSesion.html');
                $footer = file_get_contents('view/footer.html');
                echo $header.$contenido.$footer;

            }else{
                require('controller/validadorCtrl.php');
                    
                $usuario    = (validadorCtrl::validarUsuario($_POST['usuario']))?$_POST['usuario'] : "";
                $password   = (validadorCtrl::validarContrasenha($_POST['password']))? $_POST['password'] : "";
                
                $resultado = $this->modelo->iniciarSesion($usuario,$password);
                
                if($resultado != null){
                    $_SESSION['usuario'] = $resultado->getUsuario();
                    $_SESSION['tipoUsuario'] = $resultado->getPrivilegios();
                    $header     = file_get_contents('view/headerLoged.html');
                    $contenido  = file_get_contents('view/index.html');
                    $footer     = file_get_contents('view/footer.html');

                    $diccionario = array('{usuario}' => $resultado->getUsuario());

                    $header = strtr($header,$diccionario);

                    echo $header.$contenido.$footer;
                    #header('Location: index.php');
                } 
                else{  
                    header('Location: index.php?ctrl=login&accion=iniciarSesion');
                }
            }
        }

        /**
        *Destruirá información de la sesión.
        */
        function cerrarSesion(){
        	$this->modelo->cerrarSesion();
            header('Location: index.php');
        }

	}
?>