<?php

    class telefonoCtrl{

        private $modelo;
        
        /**
         *Crea la instancia de un objeto de la clase telefonoCtrl. 
         */
        function __construct(){

            require('model/telefonoMdl.php');
            $this -> modelo = new telefonoMdl();
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
                default: 
                    require('view/error.php');
            }
        }
        
        /**
         *Inserta un nuevo número de teléfono de empleado
         */
        public function insertar(){
        
            require('controller/validadorCtrl.php');
            if(isset($_REQUEST['idEmpleado']) && isset($_REQUEST['telefono']) && isset($_REQUEST['tipo'])){

                $idEmpleado = $_REQUEST['idEmpleado'];
                $telefono = $_REQUEST['telefono'];
                $tipo = $_REQUEST['tipo'];

                validadorCtrl::validarTexto($idEmpleado)? die("ID de empleado inválido.");
                validadorCtrl::validarTelefono($telefono)? die("Formato de teléfono inválido.");
                validadorCtrl::validarTexto($tipo)? die("Tipo de teléfono inválido.");

                $resultado = $this -> modelo -> insertar($idEmpleado, $telefono, $tipo);
                if($resultado){
                    require('view/telefonoInsertado.php');
                }
                else{
                    require('view/errorTelefonoInsertar.php');
                }

            }
            else{
                require('view/faltanDatosInsertarTelefono.php');
            }  
        }

        /**
         * Hace la consultar teléfono de empleado.
         */

        public function consultar(){
            require('controller/validadorCtrl.php');

            validadorCtrl::validarTexto($idEmpleado)? die("ID de empleado inválido.");
            $idEmpleado = $_REQUEST['idEmpleado'];
            $resultado  = $this -> modelo ->consultar($idEmpleado);

            if($resultado){
                #regresará array con datos de teléfonos de determinado empleado.
            }
            else{
                require('view/errorTelefonoConsultar.php'); #cambiar a html
            }   
        }
        
        /**
         * Modifica datos de teléfono.
         */
        public function modificar(){
        }

        public function eliminar(){
            #primero se obtiene el idTeléfono a eliminar

            $idTelefono = $_REQUEST['idTelefono'];
            $resultado = $this -> modelo -> eliminar($idTelefono);
            if($resultado){
                require('view/telefonoEliminado.php');
            }
            else{
                require('view/errorTelefonoEliminar.php');
            }
        }


    }

?>