<?php

    $ctrl;
    
    /**
    *Recibe la petición y carga el controlador necesario.
    */
    switch($_REQUEST['ctrl']){
        
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
        default:
            break;
                #no se encontro parametros
    }
    
    /**
    *ejecuta el método del controlador
    *encargado de recibir la acción a realizar.
    */
    $ctrl -> run();

?>