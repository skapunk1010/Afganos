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
                            header('Location : index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
                    break;

                case 'consultar':
                    if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario())){
                        $this -> consultar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location : index.php?ctrl=login&accion=iniciarSesion');
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
                            header('Location : index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
                    break;
                case 'eliminar':
                    if($this->estaLogeado() && $this->esAdmin()){
                        $this->eliminar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location : index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            #Mostrar error de acceso no permitido
                        }
                    }
                    break;
                case 'listar':
                    if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario())){
                        $this->listar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location : index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            #Mostrar error de acceso no permitido
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
            if(empty($_POST)){
                #Muestra formulario
            }else{
                require('controller/validadorCtrl.php');
                $marca = strtoupper($_POST['marca']);
                if(validadorCtrl::validarTexto($marca)){
                    $resultado = $this -> modelo -> insertar($marca); 
                    if($resultado){
                        require("view/html/exitos/marcaInsertar.html");
                    }   
                    else{
                        require("view/html/errores/errorMarcaInsertar.html");
                    }
                }
                else{
                    die('Cadena de marca inválida');
                }
            }
        }

        /**
         * Hace la consultar de marcas.
         */

        public function consultar(){
            if(empty($_POST)){
                #Muestra formulario
            }else{
                require('controller/validadorCtrl.php');
                $idMarca = $_POST['idMarca'];
                if(validadorCtrl::validarNumero($idMarca)){
                    $resultado = $this -> modelo -> consultar($idMarca); 
                    if($resultado != NULL){
                        var_dump($resultado);
                        require('view/html/exitos/marcaConsultar.html');
                    }
                    else
                        require('view/html/errores/errorMarcaConsultar.html');
                }
                else{
                    die('Cadena de marca inválida');
                }  
            }
        }
        
        /**
         * Modifica algún nombre de marca.
         */
        public function modificar(){
            if(empty($_POST)){
                #Muestra formulario
            }else{
                require('controller/validadorCtrl.php');
                $marca = $_POST['marca'];
                $idMarca = $_POST['idMarca'];
                if(validadorCtrl::validarTexto($marca) && validadorCtrl::validarNumero($idMarca)){
                    $resultado = $this -> modelo -> modificar($idMarca,$marca); 
                    if($resultado)
                        require('view/html/exitos/marcaModificar.html');
                    else
                        require('view/html/errores/errorMarcaModificar.html');
                }
                else{
                    die('Cadena de marca inválida');
                }
            }
        }

        /**
         * Elimina la marca indicada.
         */
        public function eliminar(){
            if(empty($_POST)){
                #Muestra formulario
            }else{
                require('controller/validadorCtrl.php');
                $idMarca = $_POST['idMarca'];
                if(validadorCtrl::validarNumero($idMarca)){
                    $resultado = $this -> modelo -> eliminar($idMarca); 
                    if($resultado)
                        #require('view/marcaModificar.php');
                        echo 'Marca eliminada'; #Va vista aquí
                    else
                        require('view/errorMarcaModificar.php');
                }
                else{
                    die('Cadena de marca inválida');
                }
            }
        }

        /**
         * Muestra todas las marcas almacenadas en la base de datos.
         */
        public function listar(){
            $resultado = $this->modelo->listar();

            if($resultado){
                var_dump($resultado);
                require('view/html/exitos/marcaListar.html');
            }
            else{
                require('view/html/errores/errorMarcaListar.html');
            }
        }
    }

?>