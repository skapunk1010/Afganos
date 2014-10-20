<?php
    require('controller/CtrlEstandar.php');
    class marcaCtrl extends CtrlEstandar{

        private $modelo;
        
        /**
         *Crea la instancia de un objeto de la clase marcaMdl. 
         */
        function __construct(){
            require('model/marcaMdl.php');
            $this -> modelo = new marcaMdl();
        }
        

        /**
        *Se recibe la acción a realizar con el modelo.
         */
        public function run(){

            switch($_REQUEST['accion']){

                case 'insertar': 
                    if($this->estaLogeado() && $this->esAdmin()){
                        $this -> insertar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
                    break;

                case 'consultar':
                    if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario()){
                        $this -> consultar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');   
                        }
                    }
                    break;

                case 'modificar':
                    if($this->estaLogeado() && $this->esAdmin()){
                        $this -> modificar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
                    break;
                        
                default: 
                    require('view/error.php');
            }
        }
        
        /**
         *Inserta una nueva marca de auto.
         */
        public function insertar(){
        
            require('controller/validadorCtrl.php');
            $marca = $_REQUEST['marca'];
            if(validadorCtrl::validarTexto($marca)){
                $resultado = $this -> modelo -> insertar($marca); 
                if($resultado)
                    require('view/marcaInsertar.php');
                else
                    require('view/errorMarcaInsertar.php');
            }
            else{
                die('Cadena de marca inválida');
            }
        }

        /**
         * Hace la consultar de marcas.
         */

        public function consultar(){
            require('controller/validadorCtrl.php');
            $idMarca = $_REQUEST['idmarca'];
            if(validadorCtrl::validarNumero($idMarca)){
                $resultado = $this -> modelo -> consultar($idMarca); 
                if($resultado != NULL){
                    var_dump($resultado);
                }
                else
                    require('view/errorMarcaConsulta.php');
            }
            else{
                die('Cadena de marca inválida');
            }  
        }
        
        /**
         * Modifica algún nombre de marca.
         */
        public function modificar(){
            require('controller/validadorCtrl.php');
            $marca = $_REQUEST['marca'];
            $idMarca = $_REQUEST['idMarca'];
            if(validadorCtrl::validarTexto($marca) && validadorCtrl::validarNumero($idMarca)){
                $resultado = $this -> modelo -> modificar($idMarca,$marca); 
                if($resultado)
                    require('view/marcaModificar.php');
                else
                    require('view/errorMarcaModificar.php');
            }
            else{
                die('Cadena de marca inválida');
            }
        }
    }

?>