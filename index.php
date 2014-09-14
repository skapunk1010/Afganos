<?php

    $ctrl;
    
    switch($_REQUEST['ctrl']){
        
        case 'usuario':
                require('controllers/usuarioCtrl.php');
                $ctrl = new usuarioCtrl();
                break;
                
        default:
                #no se encontro parametros
    }
    
    $ctrl -> run();

?>