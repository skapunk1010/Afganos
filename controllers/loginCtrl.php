<?php
	class loginCtrl{
		private $modelo;

		function __construct(){
			require('model/loginMdl.php');
			$this->modelo = new loginMdl();
		}

		function run(){
            switch($_REQUEST['action']){
                
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

        function signin(){
        	require('controllers/validadorCtrl.php');
                        
            $usuario 	= validadorCtrl::validarUsuario($_REQUEST['usuario']);
            $password	= validadorCtrl::validarPassword($_REQUEST['password']);
            
            $resultado 	= $this->modelo->signin($usuario,$password);
            
            if($resultado){
                require('views/index.php'); #cambiar a html
            } else{  
                require('views/error.php'); #cambiar a html
            }
        }

        function iniciarSesion(){
        	require('controllers/validadorCtrl.php');
                        
            $usuario 	= validadorCtrl::validarUsuario($_REQUEST['usuario']);
            $password	= validadorCtrl::validarPassword($_REQUEST['password']);
            
            $resultado = $this->modelo->autentificar($usuario,$password);
            
            if($resultado){
                require('views/index.php'); #cambiar a html
            } else{  
                require('views/error.php'); #cambiar a html
            }
        }

        function cerrarSesion(){
        	#Destruye la variable de sesión
        	echo 'Sesión terminada!';
        	#Redirecciona al view inicial
        }

	}
?>