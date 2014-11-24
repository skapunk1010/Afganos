<?php
    require('controller/CtrlEstandar.php');
    class clienteCtrl extends CtrlEstandar
    {

        private $modelo;
        private $conexion;
        
        /**
        *Al momento de crear el controlador cliente 
        *se inicia el modelo de cliente.
        */
        function __construct(){
            require('model/clienteMdl.php');
            $this -> modelo = new clienteMdl();
        }
        
        /**
        *Recibe la acción que se desea con el cliente 
        *y manda al método correspondiente.
        */
        public function run(){

            switch($_GET['accion']){
                
                case 'insertar':
                var_dump($_SESSION);
                    if($this->estaLogeado() && $this->esAdmin() ){
                        $this -> insertar();
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
                case 'eliminar':
                   if( $this->estaLogeado() && $this->esAdmin() ){
                        $this -> eliminar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
                    break;

                case 'listar':
                   if( $this->estaLogeado() && $this->esAdmin() ){
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
                   if( $this->estaLogeado() && $this->esAdmin() ){
                        $this -> consultar();
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
        *Función para insertar un nuevo cliente
        */
        public function insertar()
        {
            if(empty($_POST)){
                #muestra formulario
            }
            else
            {
                require('controller/validadorCtrl.php');
                $nombre = (validadorCtrl::validarNombre($_POST['nombre']))? $_POST['nombre'] : "";
                $apellidoPaterno = (validadorCtrl::validarNombre($_POST['apellidoPaterno']))? $_POST['apellidoPaterno'] : "";
                $apellidoMaterno = (validadorCtrl::validarNombre($_POST['apellidoMaterno']))? $_POST['apellidoMaterno'] : "";
                $email = (validadorCtrl::validarNombre($_POST['email']))? $_POST['email'] : "";

                $resultado = $this -> modelo -> insertar($nombre,$apellidoPaterno,$apellidoMaterno,$email);
                if($resultado){
                    echo "Se insertó un nuevo cliente";
                }
                else
                {
                    echo "Error al insertar un cliente";
                }
            }
        }
        
        /**
        *Modifica datos de cliente
        */
        public function modificar(){

            require('controller/validadorCtrl.php');
            if( (!isset($_GET['id']) && empty($_GET['id'])) || empty($_POST)){
                #regresa
            }
            else
            {
                $idCliente = $_GET['id'];
                $nombre = $_POST['nombre'];
                $apellidoPaterno = $_POST['apellidoPaterno'];
                $apellidoMaterno = $_POST['apellidoMaterno'];
                $email = $_POST['email'];

                if(validadorCtrl::validarNombre($nombre) && validadorCtrl::validarNombre($apellidoPaterno) && validadorCtrl::validarNombre($apellidoMaterno)
                    && validadorCtrl::validarEmail($email) && validadorCtrl::validarNumero($idCliente))
                {
                    $resultado = $this -> modelo -> modificar($idCliente,$nombre,$apellidoPaterno,$apellidoMaterno,$email);
                    if($resultado){
                        echo "Cliente insertado.";
                    }
                    else{
                        echo "Error cliente insertado.";
                    }
                }
            }  
        }

        /**
        *Cambia status del cliente
        */
        public function eliminar(){
            require('controller/validadorCtrl.php');
            if( (!isset($_GET['id']) && empty($_GET['id'])) || empty($_POST)){
                #regresa
            }
            else
            {
                $idCliente = $_GET['id'];
                $resultado = $this -> modelo -> eliminar($idCliente);

                if($resultado){
                    echo "Cliente eliminado";
                }
                else{
                    echo "Error al eliminar un cliente";
                }
            }
        }
        
        /**
        *lista los datos de los clientes
        */
        public function listar()
        {
            $resultado = $this -> modelo -> listar();
            if($resultado!=NULL){
                var_dump($resultado)
            }
            else
            {
                echo "Error al listar los clientes";
            }
        }

        /*
        *Consultar un cliente en específico
        */
        public function consultar(){
            require('controller/validadorCtrl.php');
            if( ( !isset($_GET['id']) && empty($_GET['id']) ) || empty($_POST) ){
                #regresa
            }
            else
            {
                $idCliente = $_GET['id'];
                if(validadorCtrl::validarNumero($idCliente)){
                    $resultado = $this -> modelo -> consultar($idCliente);
                    if($resultado!=NULL){
                        var_dump($resultado);
                    }
                    else{
                        echo "error al consultar un cliente";
                    }
                }
                else{
                    echo "error en el formato de idCliente.";
                }
            }
        }
    }

?>