<?php
	require('model/Area.php');
	class areaMdl{
		
		/** 
		 *Hace la inserción de una nueva área en la base de datos.
		 *@param String $area Nombre del área.
         *@param String $ubicacion Ubicación del area.
         *@param String $encargado Encargado responsable de esta área.
		 *
         *@return bool TRUE si la inserción fue satisfactoria.
		 */
		public function insertar($area,$ubicacion,$encargado){
			$nuevaArea = new Area($area,$ubicacion,$encargado);
			#Simular conexión a base de datos e inserción de registro.
			return TRUE; #Retorno temporal
		}

		/**
		 *Crea consultar a la base de datos del área especificada
		 *en el parámetro.
		 *@param String $area Nombre el area que se desea consultar.
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function consultar($area){
			#Establecer conexion con BD
			#Hacer consultar a ella.
			#Mostrar resultados
			return TRUE; #Retornno temporal
		}

		/**
		 * Hace la modificación a la base de datos del área indicada.
		 *@param String $area Nombre de área que se desea modificar.
         *@param String $ubicacion Nombre actualizado del área.
         *@param String $encargado Encargado responsable del área actualizado.
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($area,$ubicacion,$encargado){
			#Establecer conexion con BD
			#Hacer consultar a ella.
			#Mostrar resultados
			return TRUE; #Retorno temporal
		}
	}
?>