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
                if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario() )){
                    $this->insertar();
                }
                else{
                    if(!$this->estaLogeado()){
                        header('Location: index.php?ctrl=login&accion=iniciarSesion');
                    }
                    else{
                        require('view/errorAcceso.php');
                    }
                }
                break;

                case 'consultar':
                if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario() )){
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
                    if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario() )){
                        $this -> buscarpormarca();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
                    break;
                case 'eliminar':
                    if($this->estaLogeado() && ($this->esAdmin() || $this->esUsuario() )){
                        $this -> eliminar();
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
            //if( (!isset($_GET['idMarca']) && empty($_GET['idMarca'])) || (empty($_POST)) ){
            if(empty($_POST)){
                $header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/modeloInsertar.html');
                $footer     = file_get_contents('view/footer.html');
                $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                $contenido  = str_replace('{idMarca}', $_GET['idMarca'], $contenido);
                echo $header.$contenido.$footer;

            }else{
                require('controller/validadorCtrl.php');
                $idMarca = $_GET['idMarca'];
                $modelo = strtoupper($_POST['modelo']);

                if(validadorCtrl::validarNumero($idMarca) && validadorCtrl::validarTexto($modelo)) {
                    $resultado = $this -> modelo -> insertar($idMarca,$modelo);
                    var_dump($resultado);
                    if($resultado){
                        require('view/html/exitos/modeloInsertar.html');
                    } 
                    else{  
                        require('view/html/errores/errorModeloInsertar.html');
                    }     
                }else{
                    die('Formato de idMarca inválido.');
                }
            }
        }

        /**
         * Hace la consultar de algún modelo en particular.
         */

        public function consultar(){

            $idModelo = $_POST['idModelo'];
            $resultado = $this -> modelo -> consultar($idModelo);

            if(count($resultado)>0){
                var_dump($resultado);
                #Se agregará su html para mostrar resultado.
                require("view/html/exitos/modeloConsultar.html");
            }
            else{
                require('view/html/errores/errorModeloConsultar.html');
            }
        }

        /*
        *Hace la consulta de modelos basándose en la marca
        */
         public function buscarpormarca(){

            $idMarca = $_POST['idMarca'];
            $resultado = $this -> modelo -> buscarPorMarca($idMarca);

            if(count($resultado)>0){
                var_dump($resultado);
                require('view/html/exitos/modeloConsultar.html');
            }
            else{
                require('view/html/errores/errorModeloConsultar.html');
            }
        }
        
        /**
         * Modifica el modelo mencionado.
         */
        public function modificar(){
            if(empty($_POST)){
                $header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/modeloModificar.html');
                $footer     = file_get_contents('view/footer.html');
                $diccionario= array('{usuario}'=>$_SESSION['usuario'],'{idModelo}'=>$_GET['modelo'],'{nombreModelo}'=>$_GET['nombre']);
                $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                $contenido  = strtr($contenido,$diccionario);
                echo $header.$contenido.$footer;
            }else{
                require('controller/validadorCtrl.php');
                $nuevoModelo = strtoupper($_POST['modelo']);
                $idModelo = $_GET['idModelo'];
                if( validadorCtrl::validarTexto($nuevoModelo) & validadorCtrl::validarNumero($idModelo)){
                    $resultado = $this -> modelo -> modificar($idModelo,$nuevoModelo);
                    if($resultado){
                        require('view/html/exitos/modeloModificar.html');
                    } else {
                        require('view/html/errores/errorModeloModificar.html');
                    }
                }else{

                }
            }
        }

        /**
         * Eliminación de modelo.
         */
        public function eliminar(){
            if(!isset($_GET['modelo']) && empty($_GET['modelo'])){
                //header('Location: index.php?ctrl=');
            }else{
                require('controller/validadorCtrl.php');
                $idModelo = (int)$_GET['modelo'];
                if(validadorCtrl::validarNumero($idModelo)){
                    $resultado = $this -> modelo -> eliminar($idModelo); 
                    if($resultado)
                        echo 'Modelo eliminado'; #Va vista aquí
                    else
                        require('view/error.php');
                }
                else{
                    die('Cadena de modelo inválida');
                }
            }
        }
    }

?>  
