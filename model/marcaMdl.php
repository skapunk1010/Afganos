<?php
	
	class marcaMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Marca.php');
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstace();
		}
		
		/** 
		*Hace la inserción de una nueva marca en la base de datos.
        *@param String $marca
        *
        *@return bool TRUE si la inserción a la BD fue satisfactoria.
		*/
		public function insertar($marca){
			
			$nuevaMarca = new Marca($marca);
			
			$marcaESC = $this -> conexion -> real_escape_string($marca);
			
			$query = "INSERT INTO Marca (Marca) VALUES ('".$marcaESC."')";
			$correcto = $this -> conexion -> query($query);

			if($correcto)
				$nuevaMarca -> setIdMarca($this -> conexion -> insert_id);
			else $nuevaArea = NULL;
			
			$this -> conexion -> close();
			return $correcto; 
		}

		/**
		 *Consulta a la base de datos de la marca especificada x el IdMarca
		 *@param int $IdMarca, PK de la marca a consultar.
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function buscar($IdMarca){
			#Establecer conexion con BD
			#Hacer consultar a ella.
			#Mostrar resultados
			return TRUE; #Retornno temporal
		}

		/**
		 * Hace la modificación a la base de datos de la marca indicada.
		 *@param Int $IdMarca
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($IdMarca, $campo){
			
			#Mostrar resultados
			return TRUE; #Retorno temporal
		}
	}
?>