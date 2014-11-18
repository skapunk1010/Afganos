<?php
	
	class modeloMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Modelo.php');
			require_once('controller/ConexionBaseDeDatos.php');
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
			//idMarca   = $this -> conexion -> real_escape_string($idMarca);
			$modeloESC = $this -> conexion -> real_escape_string($modelo);
			
			$query = "INSERT INTO Modelo (Marca_idMarca, Modelo) VALUES (".$idMarca.",'".$modeloESC."')";
			$correcto = $this -> conexion -> query($query);

			$this -> conexion -> close();

			return $correcto;
		}

		/**
		 *Consulta a la base de datos del modelo especificado x el IdModelo
		 *@param int $modelo, modelo a consultar.
		 *
		 *@return Array con los resultados.
		 */
		public function consultar($idModelo){
			
			$query = "SELECT * FROM Modelo WHERE idModelo = '".$idModelo."'";
			$correcto = $this -> conexion -> query($query);
			$array = array();
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
		 *Consulta a la base de datos de modelos por marca
		 *@param int $modelo, modelo a consultar.
		 *
		 *@return Array con los resultados.
		 */
		public function buscarPorMarca($idMarca){
			
			 $query = "SELECT idMarca,idModelo,Modelo FROM Modelo AS O,Marca AS M WHERE Marca_idMarca = '".$idMarca."' 
			 			AND M.idMarca = O.Marca_idMarca AND O.status = true";
			$correcto = $this -> conexion -> query($query);

			$array = array();
			if($correcto){
				$i = 0;

				while (($fila = $correcto->fetch_assoc())) {
        			$array[] = $fila;
  			  }
			}
			else $array = NULL;
			#$this -> conexion -> close();
			return $array; 
		}

		/**
		 * Hace la modificación a la base de datos del modelo indicado.
		 *@param Int $IdModelo
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($idModelo, $campo){
			$query = "UPDATE Modelo SET Modelo = '".$campo."' WHERE idModelo = '".$idModelo."'";
			$correcto = $this -> conexion -> query($query);
			$this -> conexion -> close();
			return $correcto;
		}
		
		/**
		 * Elimina el modelo indicado.
		 *@param int Id del modelo que se desea eliminar.
		 *@return bool TRUE si la eliminación fue exitosa. FALSE en caso contrario.
		 */
		public function eliminar($idModelo){
			$idModelo = $this->conexion->real_escape_string($idModelo);
			$query = "UPDATE Modelo SET status = false WHERE idModelo = '".$idModelo."'";
			$resultado = $this->conexion->query($query);
			$this -> conexion -> close();
			return $resultado;
		}

	}
?>