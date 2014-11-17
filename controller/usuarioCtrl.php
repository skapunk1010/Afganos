<?php
    require('controller/CtrlEstandar.php');
    class usuarioCtrl extends CtrlEstandar{

        private $modelo;
        private $conexion;
        
        /**
        *Al momento de crear el controlador usuario 
        *se inicia el modelo de usuario.
        */
        function __construct(){

            require('model/usuarioMdl.php');
            $this -> modelo = new usuarioMdl();
        }
        
        /**
        *Recibe la acción que se desea con el usuario 
        *y manda al método correspondiente.
        */
        public function run(){

            switch($_REQUEST['accion']){
                
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
                case 'deshabilitar':
                   if( $this->estaLogeado() && $this->esAdmin() ){
                        $this -> deshabilitar();
                    }else{
                        if(!$this->estaLogeado()){
                            header('Location: index.php?ctrl=login&accion=iniciarSesion');
                        }else{
                            require('view/errorAcceso.php');
                        }
                    }
                    break;

                case 'habilitar':
                   if( $this->estaLogeado() && $this->esAdmin() ){
                        $this -> habilitar();
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
        *valida que la información recibida sea correcta.
        */
        public function insertar()
        {
            require('controller/validadorCtrl.php');
            if(validadorCtrl::validarTexto($_POST['usuario']) &&
                validadorCtrl::validarContrasenha($_POST['password']) &&
                validadorCtrl::validarTexto($_POST['privilegios']) &&
                        validadorCtrl::validarNumero($_POST['codigo']))
            {

                $usuario = $_POST['usuario'];
                $password = $_POST['password'];   
                $privilegios = $_POST['privilegios'];
                $codigo = $_POST['codigo'];

                #if($this->existeEmpleado($codigo) != NULL){ 
                    $resultado = $this -> modelo -> insertar($codigo, $usuario, $password, $privilegios);
                        
                    if($resultado != NULL){
                       echo "si";
                            #require('view/html/exitos/usuarioInsertar.html');
                    } 
                    else{  
                        echo "no";
                            #require('view/html/errores/errorUsuarioInsertar.html'); #cambiar a html
                    }  
                #}
                #else{echo "No existe el usuario.";}    
            }
            else{
                echo "formato inválido";
            }
        }
        
        /**
        *Modifica contraseña del usuario.
        */
        public function modificar(){
        
            require('controller/validadorCtrl.php');
            $passAct = $_POST['passAct'];
            $passNew = $_POST['passNew'];
            $codigo = $_POST['codigo'];

            if(validadorCtrl::validarContrasenha($passAct) && validadorCtrl::validarContrasenha($passNew) && validadorCtrl::validarNumero($codigo))
            {
                if($this -> modelo -> existeUsuario($codigo,$passAct) != NULL)
                {
                    if($this -> modelo -> cambiarContrasenha($codigo,$passNew))
                    {
                        echo "<br>contraseña cambiada.";
                    }
                    else
                    {
                        echo "error al cambiar contraseña";
                    }
                }
                else
                {
                    echo "usuario no existe.";
                }
            }

            else{
                echo "error formato contraseñas";
            }            
        }

        /**
        *Cambia status del usuario a deshabilitado.
        */
        public function deshabilitar(){
            require('controller/validadorCtrl.php');
            if(validadorCtrl::validarNumero($_POST['codigo']))
            {
                $codigo = $_POST['codigo'];
                $resultado = $this -> modelo -> deshabilitar($codigo);
                
                if($resultado){
                    require('view/html/exitos/usuarioDeshabilitar.html');
                }
                
                else{
                    require('view/html/errores/errorUsuarioDeshabilitar.html');
                }
            }
            else{
                die("formato de codigo mal!");
            } 
        }
        
        /**
        *Cambia status del usuario a habilitado.
        */
        public function habilitar(){
            require('controller/validadorCtrl.php');
            if(validadorCtrl::validarNumero($_POST['codigo']))
            {
                $codigo = $_POST['codigo'];
                $resultado = $this -> modelo -> habilitar($codigo);
                
                if($resultado){
                    require('view/html/exitos/usuarioHabilitar.html');
                }
                
                else{
                    require('view/html/error/errorUsuarioHabilitar.html');
                }
            }
            else{
                die("formato de codigo mal!");
            } 
        }



        public function consultar(){
            $resultado = $this->modelo->consultar();
            if($resultado!=NULL){
                var_dump($resultado);
            }
            else{
                echo "#error al mostrar todos.";
            }
        }
    }

?>