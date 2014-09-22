<?php

    $ctrl;
    
    //Recibe la petición y carga el controlador necesario.
    switch($_REQUEST['ctrl']){
        
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
        default:
                #no se encontro parametros
    }
    
    //ejecuta el método del controlador 
    //encargado de recibir la acción a realizar.
    $ctrl -> run();

?>