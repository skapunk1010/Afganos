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
                            $header     = file_get_contents('view/headerLoged.html');
                            $contenido  = file_get_contents('view/errorAcceso.html');
                            $footer     = file_get_contents('view/footer.html');
                            $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                            echo $header.$contenido.$footer;
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
                            $header     = file_get_contents('view/headerLoged.html');
                            $contenido  = file_get_contents('view/errorAcceso.html');
                            $footer     = file_get_contents('view/footer.html');
                            $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                            echo $header.$contenido.$footer;
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
                            $header     = file_get_contents('view/headerLoged.html');
                            $contenido  = file_get_contents('view/errorAcceso.html');
                            $footer     = file_get_contents('view/footer.html');
                            $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                            echo $header.$contenido.$footer;
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
                            $header     = file_get_contents('view/headerLoged.html');
                            $contenido  = file_get_contents('view/errorAcceso.html');
                            $footer     = file_get_contents('view/footer.html');
                            $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                            echo $header.$contenido.$footer;
                        }
                    }
                    break;

                case 'listarAjax':
                    if($this->estaLogeado() && $this->esAdmin() ){
                        $this -> listarAjax();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            $header     = file_get_contents('view/headerLoged.html');
                            $contenido  = file_get_contents('view/errorAcceso.html');
                            $footer     = file_get_contents('view/footer.html');
                            $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                            echo $header.$contenido.$footer;
                        }
                    }
                    break;
                        
                default: 
                    $header     = file_get_contents('view/headerLoged.html');
                    $contenido  = file_get_contents('view/errorAcceso.html');
                    $footer     = file_get_contents('view/footer.html');
                    $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                    echo $header.$contenido.$footer;
                    break;
            }
        }
        
        /**
         *Inserta un área en la que se trabajará dentro del sistema.
         */
        public function insertar(){
            if(empty($_POST)){
                $header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/areaInsertar.html');
                $footer     = file_get_contents('view/footer.html');

                $header = str_replace('{usuario}', $_SESSION['usuario'], $header);

                echo $header.$contenido.$footer;
            }else{
                require('controller/validadorCtrl.php');    
                if(validadorCtrl::validarTexto($_POST['area']) && 
                    validadorCtrl::validarCodigoEmpleado($_POST['codigoEncargado']) && 
                    validadorCtrl::validarTexto($_POST['descripcion'])){
                    $Area = strtoupper($_POST['area']);
                    $Encargado_Cod  = $_POST['codigoEncargado'];
                    $descripcion = strtoupper($_POST['descripcion']);

                    $resultado = $this -> modelo -> insertar($Encargado_Cod,$Area,$descripcion);
                    if($resultado){
                        $header     = file_get_contents('view/headerLoged.html');
                        $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                        $footer     = file_get_contents('view/footer.html');
                        $contenido  = str_replace('{mensaje}', '¡Area insertada!', $contenido); #Pones el mensaje que quieras
                        $contenido  = str_replace('{url}', 'ctrl=area&accion=listar', $contenido);
                        echo $header.$contenido.$footer;
                    } 
                    else{  
                        $header     = file_get_contents('view/headerLoged.html');
                        $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                        $footer     = file_get_contents('view/footer.html');
                        $contenido  = str_replace('{mensaje}', 'Hubo un error al insertar.Intenta de nuevo', $contenido); #Pones el mensaje que quieras
                        $contenido  = str_replace('{url}', 'ctrl=area&accion=insertar', $contenido);
                        echo $header.$contenido.$footer;
                    } 
                }
                else{
                    $header     = file_get_contents('view/headerLoged.html');
                    $contenido  = file_get_contents('view/mensajeConfirmacion.html');
                    $footer     = file_get_contents('view/footer.html');
                    $contenido  = str_replace('{mensaje}', 'El formato del área no es válido.', $contenido); #Pones el mensaje que quieras
                    $contenido  = str_replace('{url}', 'ctrl=area&accion=insertar', $contenido);
                    echo $header.$contenido.$footer;
                } 
            }
        }


        /**
         * Hace listado de las áreas
         */
        public function listar(){
            $resultado  = $this -> modelo ->listar();

            if($resultado!=NULL){
                #Se guardan archivos en variables
                $header     = file_get_contents('view/headerLoged.html');
                $contenido  = file_get_contents('view/areaListar.html');
                $footer     = file_get_contents('view/footer.html');
                
                $inicio_fila    = strpos($contenido,'{inicioFila}');
                $fin_fila       = strpos($contenido,'{finFila}')+9;
                $filaTabla      = substr($contenido, $inicio_fila,$fin_fila-$inicio_fila);

                $filas = "";
                foreach ($resultado as $area) {
                    $new_fila = $filaTabla;
                    //Reemplazo con un diccionario
                    $diccionario = array('{area}' => $area['area'],'{idArea}' => $area['idArea'],'{inicioFila}'=> '','{finFila}'=>'');
                    $new_fila = strtr($new_fila,$diccionario);
                    $filas .= $new_fila;
                }
                
                $header = str_replace('{usuario}', $_SESSION['usuario'], $header);
                $contenido = str_replace($filaTabla, $filas, $contenido);
                echo $header.$contenido.$footer;
            }
            else{
                require('view/errorAreaConsultar.php'); #cambiar a html
            }   
        }

        /**
         * Hace la consultar de algún área que se desee consultar
         */

        public function consultar(){
            if(isset($_GET['id']) && !empty($_GET['id'])){
                require('controller/validadorCtrl.php');
                if(validadorCtrl::validarNumero($_GET['id'])){
                    $idArea = $_GET['id'];
                    $resultado  = $this -> modelo ->consultar($idArea);
                    if($resultado){
                        $header     = file_get_contents('view/headerLoged.html');
                        $contenido  = file_get_contents('view/areaConsultar.html');
                        $footer     = file_get_contents('view/footer.html');

                        $inicioFila = strpos($contenido, '{inicioFilaUbicacion}');
                        $finFila    = strpos($contenido, '{finFilaUbicacion}')+18;
                        $fila       = substr($contenido, $inicioFila, $finFila-$inicioFila);

                        $filas = "";
                        if(isset($resultado[0]['idUbicacion'])){
                            foreach ($resultado as $ubicacion){
                                $nuevaFila = $fila;
                                $diccionario = array(   '{seccion}'   =>$ubicacion['seccion'],
                                                        '{numero}'      =>$ubicacion['numero'],
                                                        '{idUbicacion}' =>$ubicacion['idUbicacion'],
                                                        '{inicioFilaUbicacion}'  =>'',
                                                        '{finFilaUbicacion}'     =>'');
                                $nuevaFila = strtr($nuevaFila,$diccionario);
                                $filas .= $nuevaFila;
                            }
                        }

                        $nombreCompleto =  $resultado[0]["nombre"]." ".$resultado[0]['apellidoMaterno']." ".$resultado[0]['apellidoPaterno'];
                        $diccionario = array('{idArea}'=> $resultado[0]['idArea'], 
                                            '{area}'=> $resultado[0]['area'],
                                            '{descripcion}'=> $resultado[0]['descripcion'],
                                            '{codigoEncargado}'=> $resultado[0]['Codigo'],
                                            '{nombreEncargado}'=> $nombreCompleto);
                        
                        $header     = str_replace('{usuario}', $_SESSION['usuario'], $header);
                        $contenido  = str_replace($fila, $filas, $contenido);
                        $contenido  = strtr($contenido,$diccionario);

                        echo $header.$contenido.$footer;
                    }else{

                    }
                }
                else{
                    echo "verifique formato de id;";
                }
            }else{
                #Error
            }
        }
        
        /**
         * Modifica el area señalada. Se reciben sus datos actualizados .
         */
        public function modificar(){
            if( (!isset($_GET['id']) && empty($_GET['id'])) || empty($_POST) ){
                require_once('controller/validadorCtrl.php');
                $idArea =  (validadorCtrl::validarNumero($_GET['id'])) ? (int)$_GET['id'] : "" ;
                $resultado  = $this -> modelo -> consultar($idArea);           
                
                if($resultado){
                    $header     = file_get_contents('view/headerLoged.html');
                    $contenido  = file_get_contents('view/areaModificar.html');
                    $footer     = file_get_contents('view/footer.html');

                    $inicioFila = strpos($contenido, '{inicioFilaUbicacion}');
                    $finFila    = strpos($contenido, '{finFilaUbicacion}')+18;
                    $fila       = substr($contenido, $inicioFila, $finFila-$inicioFila);

                    $filas = "";
                    if(isset($resultado[0]['idUbicacion'])){
                        foreach ($resultado as $ubicacion){
                            $nuevaFila = $fila;
                            $diccionario = array(   '{seccion}'   =>$ubicacion['seccion'],
                                                    '{numero}'      =>$ubicacion['numero'],
                                                    '{idUbicacion}' =>$ubicacion['idUbicacion'],
                                                    '{inicioFilaUbicacion}'  =>'',
                                                    '{finFilaUbicacion}'     =>'');
                            $nuevaFila = strtr($nuevaFila,$diccionario);
                            $filas .= $nuevaFila;
                        }
                    }

                    $nombreCompleto = $resultado[0]['nombre']." ".$resultado[0]['apellidoPaterno']." ".$resultado[0]['apellidoMaterno'];
                    $diccionario= array('{usuario}'=>$_SESSION['usuario'],
                                        '{idArea}' => $resultado[0]['idArea'],
                                        '{area}'=>$resultado[0]['area'],
                                        '{descripcion}'=>$resultado[0]['descripcion'],
                                        '{codigoEncargado}' => $resultado[0]['Codigo'],
                                        '{nombreEncargado}' => $nombreCompleto
                                        );
                    $contenido  = strtr($contenido,$diccionario);
                    $header     = strtr($header,$diccionario);
                    $contenido  = str_replace($fila, $filas, $contenido);
                    echo $header.$contenido.$footer;
                }
                else{
                    require('view/errorAreaModificada.php'); #cambiar a html
                }
            }else{
                require_once('controller/validadorCtrl.php');
                $idArea = (validadorCtrl::validarNumero($_GET['id'])) ? (int)$_GET['id'] : "";
                $area   = (validadorCtrl::validarTexto($_POST['area'])) ? strtoupper($_POST['area']) : "";
                $descripcion = (validadorCtrl::validarTexto($_POST['descripcion'])) ? strtoupper($_POST['descripcion']) : "";
                $codigoEncargado = (validadorCtrl::validarCodigoEmpleado($_POST['codigoEncargado'])) ? $_POST['codigoEncargado'] : "";

                $resultado = $this -> modelo -> modificar($idArea,$area, $descripcion, $codigoEncargado);

                if($resultado){
                    echo 'Exito';
                    var_dump($resultado);
                }else{
                    require('view/html/errores/errorMarcaModificar.html');
                }
            }        
        }

        /**
         * Hace listado de las áreas
         */
        public function listarAjax(){
            $resultado  = $this -> modelo ->listarAjax();

            if($resultado!=NULL){
                echo json_encode($resultado);
            }
            else{
            }   
        }
    }

?>