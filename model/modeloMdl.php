<?php
	
	class modeloMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Modelo.php');
			require('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
		}
		
		/** 
		*Hace la inserción de un nuevo modelo en la base de datos.
		*@param Int $idMarca, FK a la marca a la q pertenece el modelo
        *@param String $modelo
        *
        *@return bool TRUE si la inserción a la BD fue satisfactoria.
		*/
		public function insertar($idMarca, $modelo){
			
			$nuevoModelo = new Modelo($idMarca, $modelo);
			
			$modeloESC = $this -> conexion -> real_escape_string($modelo);
			
			$query = "INSERT INTO Modelo (Marca_idMarca, Modelo) VALUES (".$idMarca.",'".$modeloESC."')";
			$correcto = $this -> conexion -> query($query);

			if($correcto)
				$nuevoModelo -> setIdModelo($this -> conexion -> insert_id);
			else $nuevoModelo = NULL;
			
			$this -> conexion -> close();
			return $correcto; 
		}

		/**
		 *Consulta a la base de datos del modelo especificado x el IdModelo
		 *@param int $IdModelo, PK del modelo a consultar.
		 *
		 *@return bool TRUE si la consulta fue satisfactoria.
		 */
		public function buscar($modelo){
			
			$query = "SELECT * FROM Modelo WHERE modelo LIKE = '%".$modelo."%'";
			$correcto = $this -> conexion -> query($query);

			$array;
			if($correcto){
				$i = 0;

				while ($fila = $correcto->fetch_assoc()) {
        			$array[$i++] = $fila;
  			  }
			}
			else $array = NULL;

			$this -> conexion -> close();
			return $array; 
		}

		/**
		 * Hace la modificación a la base de datos del modelo indicado.
		 *@param Int $IdModelo
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($IdModelo, $campo){
			
			#Mostrar resultados
			return TRUE; #Retorno temporal
		}
	}
?>