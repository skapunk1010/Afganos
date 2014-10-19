<?php

    class modeloCtrl{

        private $modelo;
        
        /**
         *Crea la instancia de un objeto de la clase modeloCtrl. 
         */
        function __construct(){

            require('model/modeloMdl.php');
            $this -> modelo = new modeloMdl();
        }
        

        /**
         * Recibe la acción a realizar en variable 
         *de nombre 'accion' por medio del método GET
         */
        public function run(){

            switch($_REQUEST['accion']){
                
                case 'insertar': 
                    $this -> insertar();
                    break;

                case 'consultar':
                    $this -> consultar();
                    break;

                case 'modificar':
                    $this -> modificar();
                    break;
                        
                default: 
                    require('view/error.php');
            }
        }
        
        /**
         *Inserta un nuevo ejemplar de modelo.
         */
        public function insertar(){
        
            require('controller/validadorCtrl.php');
            
            $idMarca = $_REQUEST['idMarca'];
            $modelo = $_REQUEST['modelo'];

            if(!validadorCtrl::validarNumero($idMarca)) {
                die('Formato de idMarca inválido.');
            }

            $resultado = $this -> modelo -> insertar($idMarca,$modelo);
            
            if($resultado){
                require('view/areaInsertada.php'); #cambiar a html
            } 
            else{  
                require('view/errorAreaInsertada.php'); #cambiar a html
            }  
        }

        /**
         * Hace la consultar de algún modelo en particular.
         */

        public function consultar(){

            $modelo = $_REQUEST['modelo'];
            $resultado = $this -> modelo -> buscar($modelo);

            if(count($resultado)>0){
                var_dump($resultado);
                #Se agregará su html para mostrar resultado.
            }
            else{
                require('view/noResultadoBuscarModelo.php'); #cambiar a html
            }
        }
        
        /**
         * Modifica el modelo mencionado.
         */
        public function modificar(){
            require('controller/validadorCtrl.php');          
        }
    }

?>