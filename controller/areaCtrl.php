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
                    if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
                        $this -> insertar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
                    break;

                case 'listar':
                    if($this->estaLogeado() && $this->esAdmin() ){
                        $this -> listar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');   
                        }
                    }
                    break;

                case 'consultar':
                    if($this->estaLogeado() && ($this->esUsuario() || $this->esAdmin() )){
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
                    if($this->estaLogeado() && $this->esAdmin() ){
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
                     
            if(validadorCtrl::validarTexto($_POST['area']) && 
                validadorCtrl::validarNumero($_POST['encargado']) && 
                validadorCtrl::validarTexto($_POST['descripcion'])){
                $Area = strtoupper($_POST['area']);
                $Encargado_Cod  = $_POST['encargado'];
                $descripcion = strtoupper($_POST['descripcion']);

                $resultado = $this -> modelo -> insertar($Encargado_Cod,$Area,$descripcion);
                if($resultado){
                    require('view/areaInsertada.php'); #cambiar a html
                } 
                else{  
                    require('view/errorAreaInsertada.php'); #cambiar a html
                } 

            }
            else{
                echo "formato de área inválido";
            } 
        }


        /**
         * Hace listado de las áreas
         */
        public function listar(){
            $resultado  = $this -> modelo ->listar();

            if($resultado!=NULL){
                var_dump($resultado);
                require('view/areaConsultar.php'); #cambiar a html
            }
            else{
                require('view/errorAreaConsultar.php'); #cambiar a html
            }   
        }

        /**
         * Hace la consultar de algún área que se desee consultar
         */

        public function consultar(){
            require('controller/validadorCtrl.php');
            if(validadorCtrl::validarNumero($_POST['idArea'])){
                $idArea = $_POST['idArea'];
                $resultado  = $this -> modelo ->consultar($idArea);
                 if($resultado){
                    var_dump($resultado);
                    require('view/areaConsultar.php'); #cambiar a html
                }
                else{
                    require('view/errorAreaConsultar.php'); #cambiar a html
                } 
            }
            else{
                echo "verifique formato de id;";
            }
        }
        
        /**
         * Modifica el area señalada. Se reciben sus datos actualizados .
         */
        public function modificar(){
            require('controller/validadorCtrl.php');
            
            $idArea = $_POST['idArea'];
            $codigoEmpleado = $_POST['codigo'];
            $area = strtoupper($_POST['area']);
            $descripcion = strtoupper($_POST['descripcion']);

            if(validadorCtrl::validarCodigoEmpleado($codigoEmpleado)){
                $resultado = $this -> modelo -> modificar($idArea,$codigoEmpleado,$area,$descripcion);
                if($resultado){
                    require('view/areaModificada.php'); #cambiar a html
                }
                else{
                    require('view/errorAreaModificada.php'); #cambiar a html
                }
            }
            else
            {
                echo "error en el formato de código de empleado."
            }            
        }
    }

?>