<?php

	//$destino = "erick.martinez.cucei@gmail.com";
	$origen = "From: s_e_b_a_s_1010@hotmail.com\r\n";

	//$mensaje = "Estoy probando el mandar mensajes desde PHP";
	$asunto = "Probando, probando, 1...2...3...";

	if(isset($_GET['mandarEmail']) && !empty($_GET['mandarEmail'])){
		if(!isset($_GET['destino'])) {
			echo 'Falta variable destino</br>';;
		}
		$destino = $_GET['destino'];
		if(!isset($_GET['mensaje']))  {
			echo 'Falta variable mensaje</br>';
		}
		$mensaje = $_GET['mensaje'];

		//destino,asunto, mensaje, headers(destinatario)
		mail($destino,$asunto,$mensaje,$origen);
	}else{
		echo 'Falta variable mandarEmail';
	}
?>