<?php
    session_start();
    $ctrl = NULL;
    
    /**
    *Recibe la petición y carga el controlador necesario.
    */
    switch($_GET['ctrl']){
        
        case 'direccion':
            require('controller/direccionCtrl.php');
            $ctrl = new direccionCtrl();
            break;

        case 'empleado':
            require('controller/empleadoCtrl.php');
            $ctrl = new empleadoCtrl();
            break;

        case 'marca':
            require('controller/marcaCtrl.php');
            $ctrl = new marcaCtrl();
            break;

        case 'reporte':
            require('controller/reporteCtrl.php');
            $ctrl = new reporteCtrl();
            break;

        case 'telefono':
            require('controller/telefonoCtrl.php');
            $ctrl = new telefonoCtrl();
            break;

        case 'ubicacion':
            require('controller/ubicacionCtrl.php');
            $ctrl = new ubicacionCtrl();
            break;

        case 'usuario':
            require('controller/usuarioCtrl.php');
            $ctrl = new usuarioCtrl();
            break;
        
		case 'vehiculo':
			require('controller/vehiculoCtrl.php');
			$ctrl = new vehiculoCtrl();
			break;

        case 'login':
            require('controller/loginCtrl.php');
            $ctrl = new loginCtrl();
            break;

        case 'area':
            require('controller/areaCtrl.php');
            $ctrl = new areaCtrl();
            break;

        case 'modelo':
            require('controller/modeloCtrl.php');
            $ctrl = new modeloCtrl();
            break;

        case 'cliente':
            require('controller/clienteCtrl.php');
            $ctrl = new clienteCtrl();
            break;

        default:
            //$ctrL = NULL;
            if(!empty($_SESSION)){
                $header = file_get_contents('view/headerLoged.html');
                $array = array('{usuario}'=>$_SESSION['usuario']);
                $header = strtr($header,$array);
                $content = file_get_contents('view/index.html');
                $footer = file_get_contents('view/footer.html');
            }else{
                $header = file_get_contents('view/headerIndex.html');
                $content = file_get_contents('view/index.html');
                $footer = file_get_contents('view/footer.html');
            }
            echo $header.$content.$footer;
            break;
                #no se encontro parametros
    }
    
    /**
    *ejecuta el método del controlador
    *encargado de recibir la acción a realizar.
    */
    if($ctrl !== NULL){
        $ctrl -> run();
        $ctrl = NULL;
    }

?>