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
            switch($_REQUEST['accion']){

                case 'signin':
                    if(!$this->estaLogeado()){
                        $this -> signin();
                    }
                    break;

                case 'iniciarSesion':
                    if(!$this->estaLogeado()){
                        $this -> iniciarSesion();
                    }
                    break;

                case 'cerrarSesion':
                    if($this->estaLogeado()){
                        $this->cerrarSesion();
                    }
                	break;

                default: #accion incorrecta
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
                
            }else{
                require('controller/validadorCtrl.php');            
                $usuario    = (validadorCtrl::validarUsuario($_POST['usuario']))? $_POST['usuario'] : "";
                $password   = (validadorCtrl::validarContrasenha($_POST['password']))? $_POST['password'] : "";
                $codigoEmpleado     = (validadorCtrl::validarCodigoEmpleado($_POST['codigoEmpleado']))? $_POST['codigoEmpleado'] : "";
                $privilegio = (validadorCtrl::validarPrivilegio($_POST['privilegios']))? $_POST['privilegios'] : "";
                
                $resultado = $this -> modelo -> signin($codigoEmpleado,$usuario,$password,$privilegio);
                
                if($resultado){
                    require('view/loginSignin.php'); #cambiar a html
                } 
                else{  
                    require('view/error.php'); #cambiar a html
                }
            }
        }

        /**
        *Valida el usuario y contraseña ortorgados para el inicio de sesión.
        *Manda llamar el iniciar sesión a través del modelo.
        *Si el inicio fue correcto mostrará el index.
        */
        function iniciarSesion(){
            echo 'Entra';
        	if(empty($_POST)){
                #Mostrar formulario donde ingresa los datos del login

            }else{
                require('controller/validadorCtrl.php');
                    
                $usuario    = (validadorCtrl::validarUsuario($_POST['usuario']))?$_POST['usuario'] : "";
                $password   = (validadorCtrl::validarContrasenha($_POST['password']))? $_POST['password'] : "";
                
                $resultado = $this->modelo->iniciarSesion($usuario,$password);
                
                if($resultado != null){
                    $_SESSION['usuario'] = $resultado->getUsuario();
                    $_SESSION['tipoUsuario'] = $resultado->getPrivilegios();
                    var_dump($_SESSION);
                    //header('Location: index.php');
                } 
                else{  
                    require('view/error.php'); #cambiar a html
                }
            }
        }

        /**
        *Destruirá información de la sesión.
        */
        function cerrarSesion(){
        	$this->modelo->cerrarSesion();
        }

	}
?>