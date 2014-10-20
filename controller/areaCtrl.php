<?php
    require('controller/CtrlEstandar.php');
    class areaCtrl extends CtrlEstandar{

        private $modelo;
        
        /**
         *Crea la instancia de un objeto de la clase areaCtrl. 
         */
        function __construct(){

            require('model/areaMdl.php');
            $this -> modelo = new areaMdl();
        }
        

        /**
         * Recibe la acción a realizar en variable 
         *de nombre 'accion' por medio del método GET
         */
        public function run(){

            switch($_REQUEST['accion']){
                
                case 'insertar': 
                    if($this->estaLogeado && ($this->esUsuario() || $this->esAdmin() )){
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
                    if($this->estaLogeado && ($this->esUsuario() || $this->esAdmin() )){
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
                    if($this->estaLogeado && $this->esAdmin() ){
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
         *Inserta un área en la que se trabajará dentro del sistema.
         */
        public function insertar(){
        
            require('controller/validadorCtrl.php');
            $Area           = validadorCtrl::validarTexto($_REQUEST['area']);   
            $Encargado_Cod  = validadorCtrl::validarTexto($_REQUEST['encargado']);
            $descripcion    = validadorCtrl::validarTexto($_REQUEST['descripcion']);
            
            $resultado = $this -> modelo -> insertar($Encargado_Cod,$Area,$descripcion);
            
            if($resultado){
                require('view/areaInsertada.php'); #cambiar a html
            } 
            else{  
                require('view/errorAreaInsertada.php'); #cambiar a html
            }  
        }

        /**
         * Hace la consultar de algún área que se desee consultar
         */

        public function consultar(){
            require('controller/validadorCtrl.php');
            $area       = validadorCtrl::validarTxt($_REQUEST['area']);
            $resultado  = $this -> modelo ->consultar($area);

            if($resultado){
                require('view/areaConsultar.php'); #cambiar a html
            }
            else{
                require('view/errorAreaConsultar.php'); #cambiar a html
            }   
        }
        
        /**
         * Modifica el area señalada. Se reciben sus datos actualizados .
         */
        public function modificar(){
            require('controller/validadorCtrl.php');
            $area       = validadorCtrl::validarTxt($_REQUEST['area']);
            $ubicacion  = validadorCtrl::validarTxt($_REQUEST['ubicacion']);
            $encargado  = validadorCtrl::validarTxt($_REQUEST['encargado']);
            $resultado  = $this -> modelo -> modificar($area,$ubicacion,$encargado);
            
            if($resultado){
                require('view/areaModificada.php'); #cambiar a html
            }
            else{
                require('view/errorAreaModificada.php'); #cambiar a html
            }
        }
    }

?>