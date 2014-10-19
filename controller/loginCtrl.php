<?php
	class loginCtrl{
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
                    $this -> signin();
                    break;

                case 'iniciarSesion':
                    $this -> iniciarSesion();
                    break;

                case 'cerrarSesion':
                	$this->cerrarSesion();
                	break;

                default: #accion incorrecta
            }
        }

        /**
        *Valida el usuario y contraseña otorgados antes de realizar el registro.
        *Si el registro fue exitoso mostrará el index.
        */
        function signin(){
        	require('controller/validadorCtrl.php');
                        
            $usuario = validadorCtrl::validarUsuario($_REQUEST['usuario']);
            $password = validadorCtrl::validarPassword($_REQUEST['password']);
            
            $resultado = $this -> modelo -> signin($usuario,$password);
            
            if($resultado){
                require('view/loginSignin.php'); #cambiar a html
            } 
            else{  
                require('view/error.php'); #cambiar a html
            }
        }

        /**
        *Valida el usuario y contraseña ortorgados para el inicio de sesión.
        *Manda llamar el iniciar sesión a través del modelo.
        *Si el inicio fue correcto mostrará el index.
        */
        function iniciarSesion(){
        	require('controller/validadorCtrl.php');
                        
            $usuario 	= validadorCtrl::validarUsuario($_REQUEST['usuario']);
            $password	= validadorCtrl::validarPassword($_REQUEST['password']);
            
            $resultado = $this->modelo->iniciarSesion($usuario,$password);
            
            if($resultado){
                require('index.php'); #cambiar a html
            } 
            else{  
                require('view/error.php'); #cambiar a html
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