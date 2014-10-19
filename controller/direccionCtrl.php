<?php

    class direccionCtrl{

        private $modelo;
        
        /**
         *Crea la instancia de un objeto de la clase direccionCtrl. 
         */
        function __construct(){

            require('model/direccionMdl.php');
            $this -> modelo = new direccionMdl();
        }
        

        /**
         * Recibe la acción a realizar
         */
        public function run(){

            switch($_REQUEST['accion']){
                
                case 'insertar': 
                    $this -> insertar();
                    break;

                case 'consultar':
                    $this -> consultar();
                    break;

                case 'modificar':
                    $this -> modificar();
                    break;
                case 'eliminar':
                    $this -> eliminar();
                    break;
                default: 
                    require('view/error.php');
            }
        }
        
        /**
         *Inserta una nueva dirección de empleado.
         */
        public function insertar(){
        
            require('controller/validadorCtrl.php');

            if( isset($_REQUEST['idEmpleado']) && isset($_REQUEST['calle']) && isset($_REQUEST['numeroExt']) && isset($_REQUEST['colonia']) && isset($_REQUEST['ciudad']) && isset($_REQUEST['estado'])){

                $idEmpleado = $_REQUEST['idEmpleado'];
                $calle = $_REQUEST['calle'];
                $numeroExt = $_REQUEST['numeroExt'];
                $colonia = $_REQUEST['colonia'];
                $ciudad = $_REQUEST['ciudad'];
                $estado = $_REQUEST['estado'];

                if(!validadorCtrl::validarNumero($idEmpleado)){
                    die("Formato de número de empleado incorrecto.");
                }
                if(!validadorCtrl::validarTexto($calle)){
                  die("Formato de calle incorrecto.");  
                }
                if(!validadorCtrl::validarTexto($numeroExt)) {
                    die("Formato de número exterior incorrecto.");
                }
                if(!validadorCtrl::validarTexto($colonia)){
                  die("Formato de colonia incorrecto.");  
                } 
                if(!validadorCtrl::validarTexto($ciudad)){
                  die("Formato de ciudad incorrecto.");  
                } 
                if(!validadorCtrl::validarTexto($estado)){
                  die("Formato de estado incorrecto.");  
                } 

                $resultado = $this -> modelo -> insertar($idEmpleado, $calle, $numeroExt, $colonia, $ciudad, $estado);
                if($resultado){
                    require('view/direccionInsertada.php');
                }
                else{
                    require('view/errorDireccionInsertada.php');
                }
            }

            else{
                #faltaron datos para hacer la inserción de dirección.
            }
        }

        /**
         * Hace la consultar de alguna dirección de usuario.
         */

        public function consultar(){
            require('controller/validadorCtrl.php');
            $idEmpleado  = validadorCtrl::validarTexto($_REQUEST['idEmpleado']);
            $resultado  = $this -> modelo ->consultar($idEmpleado);

            if(count($resultado) > 0){
                var_dump($resultado); 
            }
            else{
                require('view/errorDireccionConsultar.php'); #cambiar a html
            }   
        }
        
        /**
         * Modifica el dirección de empleado
         */
        public function modificar(){
            #modificaciones
        }


        public function eliminar(){
            #primero hace una consulta para saber el id de dirección que se
            #desea eliminar.

            $idDireccion = $_REQUEST['idDireccion'];
            $resultado = $this -> modelo -> eliminar();
            if($resultado){
                require('view/direccionEliminada.php');
            }
            else{
                require('view/errorDireccionEliminar.php');
            }
        }
    }

?>