<?php
    require('controller/CtrlEstandar.php');
    class modeloCtrl extends CtrlEstandar{

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
                    if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario())) {
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
                    if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario())) {
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

                case 'buscarpormarca':
                    if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario())) {
                        $this -> buscarpormarca();
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

        /*
        *Hace la consulta de modelos basándose en la marca
        */
         public function buscarpormarca(){

            $idMarca = $_REQUEST['idMarca'];
            $resultado = $this -> modelo -> buscarPorMarca($idMarca);

            if(count($resultado)>0){
                var_dump($resultado);
                #Se agregará su html para mostrar resultado.
            }
            else{
                #No se hallaron coincidencias.             
            }
        }
        
        /**
         * Modifica el modelo mencionado.
         */
        public function modificar(){
            
            $nuevaCadena = $_REQUEST['modelo'];
            $resultado = $this -> modelo -> modificar($idModelo,$nuevaCadena);

            if($resultado){
               require('view/modeloModificado.php'); #cambiar a html
            }
            else
{                require('view/errorModeloModificado.php'); #cambiar a html
            }

        }
    }

?>