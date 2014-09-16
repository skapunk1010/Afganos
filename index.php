<?php

    $ctrl;
    
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
        default:
                #no se encontro parametros
    }
    
    $ctrl -> run();

?>