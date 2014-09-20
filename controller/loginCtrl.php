<?php
	class loginCtrl{
		private $modelo;

		function __construct(){
			require('model/loginMdl.php');
			$this->modelo = new loginMdl();
		}

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

        function signin(){
        	require('controller/validadorCtrl.php');
                        
            $usuario = validadorCtrl::validarUsuario($_REQUEST['usuario']);
            $password = validadorCtrl::validarPassword($_REQUEST['password']);
            
            $resultado = $this -> modelo -> signin($usuario,$password);
            
            if($resultado){
                require('view/index.php'); #cambiar a html
            } 
            else{  
                require('view/error.php'); #cambiar a html
            }
        }

        function iniciarSesion(){
        	require('controller/validadorCtrl.php');
                        
            $usuario 	= validadorCtrl::validarUsuario($_REQUEST['usuario']);
            $password	= validadorCtrl::validarPassword($_REQUEST['password']);
            
            $resultado = $this->modelo->iniciarSesion($usuario,$password);
            
            if($resultado){
                require('view/index.php'); #cambiar a html
            } 
            else{  
                require('view/error.php'); #cambiar a html
            }
        }

        function cerrarSesion(){
        	#Destruye la variable de sesión
        	echo 'Sesión terminada!';
            #CAMBIAR ECHO A VISTA 
        	#Redirecciona al view inicial
        }

	}
?>