<?php
	require_once('model/empleadoMdl.php');
	if(!empty($_POST)){
		require_once('controller/validadorCtrl.php');
		echo 'carga validador';
		if(isset($_POST['codigoEmpleado']) && !empty($_POST['codigoEmpleado']) && validadorCtrl::validarCodigoEmpleado($_POST['codigoEmpleado'])){
			$codigoEmpleado = $_POST['codigoEmpleado'];
			$modelo = new empleadoMdl();
			$resultado = $modelo -> consultar($codigoEmpleado);

			if($resultado){
				echo json_encode($resultado);
			}
		}
	}
?>