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
                $header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/marcaInsertar.html');
                $footer     = file_get_contents('view/footer.html');
                $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                echo $header.$contenido.$footer;
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
            if(!isset($_GET['marca']) && empty($_GET['marca']) || (!isset($_GET['idMarca']) && empty($_GET['idMarca']))){
                header('Location: index.php?ctrl=marca&accion=listar');
            }else{
                require('controller/validadorCtrl.php');
                $marca = $_GET['marca'];
                if(validadorCtrl::validarTexto($marca)){
                    //$resultado = $this -> modelo -> consultar($marca); 
                    require_once('model/modeloMdl.php');
                    $header     = file_get_contents('view/headerLoged.html');
                    $contenido   = file_get_contents('view/marcaConsultar.html');
                    $footer     = file_get_contents('view/footer.html');

                    $inicioFila = strpos($contenido, '{inicioFila}');
                    $finFila    = strpos($contenido, '{finFila}')+13;
                    $filaModelo = substr($contenido, $inicioFila, $finFila-$inicioFila);

                    $filas ="";

                    $modeloMdl = new modeloMdl();
                    $resultadoModelos = $modeloMdl->buscarPorMarca($marca);
                    if($resultadoModelos != NULL  ){
                        foreach ($resultadoModelos as $modelo) {
                            $nuevaFila = $filaModelo;
                            $diccionario = array('{nombreModelo}'=>$modelo['Modelo'],'{idModelo}'=>$modelo['idModelo'],'{inicioFila}'=>'','{finFila}'=>'');
                            $nuevaFila = strtr($nuevaFila,$diccionario);
                            $filas .= $nuevaFila;
                        }
                    }
                    //var_dump($resultadoModelos);
                    $diccionario = array('{nombreMarca}'=>$_GET['nombre'],'{idMarca}'=>$_GET['idMarca']);
                    $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                    $contenido  = strtr($contenido,$diccionario);
                    $contenido  = str_replace($filaModelo, $filas, $contenido);
                    echo $header.$contenido.$footer;
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
            if(!isset($_GET['marca']) && empty($_GET) || empty($_POST)){
                $header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/marcaModificar.html');
                $footer     = file_get_contents('view/footer.html');
                $diccionario= array('{usuario}'=>$_SESSION['usuario'],'{nombreMarca}'=>$_GET['nombre'],'{idMarca}'=>$_GET['marca']);
                $contenido  = strtr($contenido,$diccionario);
                echo $header.$contenido.$footer;
            }else{
                require('controller/validadorCtrl.php');
                $idMarca = (validadorCtrl::validarNumero($_GET['marca']))? (int)$_GET['marca'] : '';
                $nombre  = (validadorCtrl::validarTexto($_POST['marca']))? $_POST['marca']: '';
                $resultado = $this -> modelo -> modificar($idMarca,$nombre); 
                if($resultado){
                    echo 'Exito';
                    var_dump($resultado);
                }else{
                    require('view/html/errores/errorMarcaModificar.html');
                }
            }
        }

        /**
         * Elimina la marca indicada.
         */
        public function eliminar(){
            if(!isset($_GET['marca']) && empty($_GET['marca'])){
                header('Location: index.php?ctrl=marca&accion=listar');
            }else{
                require('controller/validadorCtrl.php');
                $idMarca = (int)$_GET['marca'];

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
                $header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/marcaListar.html');
                $footer     = file_get_contents('view/footer.html');

                $inicio_fila    = strpos($contenido,'{inicioFila}');
                $fin_fila       = strpos($contenido,'{finFila}')+9;
                $filaTabla      = substr($contenido, $inicio_fila,$fin_fila-$inicio_fila);

                $filas = "";
                foreach ($resultado as $marca) {
                    $new_fila = $filaTabla;
                    $diccionario = array('{idMarca}' => $marca['idMarca'], '{nombreMarca}' => $marca['Marca'],'{inicioFila}'=>'','{finFila}'=>'');
                    $new_fila = strtr($new_fila,$diccionario);
                    $filas .= $new_fila;
                }

                $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                $contenido  = str_replace($filaTabla, $filas, $contenido);
                echo $header.$contenido.$footer;
                //require('view/html/exitos/marcaListar.html');
            }
            else{
                require('view/html/errores/errorMarcaListar.html');
            }
        }
    }

?>