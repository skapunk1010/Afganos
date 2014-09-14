<?php

    class usuarioCtrl{

        private $mdl;
        
        function __construct(){
            require('models/usuarioMdl.php');
            $this -> mdl = new usuarioMdl();
        }
        
        function run(){
            switch($_REQUEST['act']){
                
                case 'insertarUsuario': 
                        $this -> insertarUsuario();
                        break;
                        
                case 'modificarUsuario':
                        $this -> modificarUsuario();
                        break;
                        
                default: #accion incorrecta
            }
        }
        
        function insertarUsuario(){
        
            require('controllers/validadorCtrl.php');
                        
            $nombre = validadorCtrl::validarTxt($_REQUEST['nombre']);
            $apellido = validadorCtrl::validarTxt($_REQUEST['apellido']);
            $telefono = validadorCtrl::validarNum($_REQUEST['telef']);
            $email = validadorCtrl::validarEmail($_REQUEST['email']);
            
            $resultado = $this -> mdl -> insertarUsuario($nombre, $apellido, $telefono, $email);
            
            if($resultado){
                
                require('views/usuarioInsertado.php'); #cambiar a html
            }
            
            else{
                
                require('views/error.php'); #cambiar a html
            }
        
        }
    
        function modificarUsuario(){
            
            
        
        }
    
    }
    

?>