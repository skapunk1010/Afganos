<?php

    class usuarioCtrl{

        private $modelo;
        
        /**
        *Al momento de crear el controlador usuario 
        *se inicia el modelo de usuario.
        */
        function __construct(){

            require('model/usuarioMdl.php');
            $this -> modelo = new usuarioMdl();
        }
        
        /**
        *Recibe la acción que se desea con el usuario 
        *y manda al método correspondiente.
        */
        function run(){

            switch($_REQUEST['accion']){
                
                case 'insertar': 
                    $this -> insertar();
                    break;
                        
                case 'modificar':
                    $this -> modificar();
                    break;
                        
                default: 
                    require('view/error.php');
            }
        }
        
        /**
        *valida que la información recibida sea correcta.
        */
        function insertar(){
        
            require('controller/validadorCtrl.php');                     
            $codigo     = validadorCtrl::validarNum($_REQUEST['codigo']);   
            $nombre     = validadorCtrl::validarTxt($_REQUEST['nombre']);
            $apellido   = validadorCtrl::validarTxt($_REQUEST['apellido']);
            $telefono   = validadorCtrl::validarNum($_REQUEST['telef']);
            $email      = validadorCtrl::validarEmail($_REQUEST['email']);
            
            $resultado = $this -> modelo -> insertar($codigo, $nombre, $apellido, $telefono, $email);
            
            if($resultado){
                require('view/usuarioInsertado.php'); #cambiar a html
            } 
            else{  
                require('view/errorUsuarioInsertado.php'); #cambiar a html
            }  
        }
        
        /**
        *Modifica información a través del código.
        */
        function modificar(){
        
            require('controller/validadorCtrl.php');
            $codigo = validadorCtrl::validarNum($_REQUEST['codigo']);
            $resultado = $this -> modelo -> modificar($codigo);
            
            if($resultado){
                require('view/usuarioModificado.php'); #cambiar a html
            }
            
            else{
                require('view/errorUsuarioModificado.php'); #cambiar a html
            }
        }
    }

?>