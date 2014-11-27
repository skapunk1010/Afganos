<?php
	
	class marcaMdl{

		private $conexion;

		/**
		*Constructor
		*/
		function __construct(){
			require('model/Marca.php');
			require_once('controller/ConexionBaseDeDatos.php');
			$this->conexion = ConexionBaseDeDatos::getInstance();
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
			$this -> conexion -> close();
			return $correcto; 
		}

		/**
		 *Consulta a la base de datos de la marca especificada x el IdMarca
		 *@param int $IdMarca, PK de la marca a consultar.
		 *
		 *@return Marca Regresa un objeto de la clase Marca.
		 * Si la marca no existe en la base de datos, regresa NULL.
		 */
		public function consultar($marca){
			$marcaESC = $this -> conexion -> real_escape_string($marca);
			$query = "SELECT * FROM Marca WHERE idMarca = '".$marcaESC."'";
			$correcto = $this -> conexion -> query($query);
			$array = array();
			
			if($correcto){
				$i = 0;
				while($fila = $correcto->fetch_assoc()){
					$array[$i++] = $fila;
				}
			}
			else $array = NULL;
			$this -> conexion -> close();
			return $array;
		}

		/**
		 * Hace la modificación a la base de datos de la marca indicada.
		 *@param Int $IdMarca
         *@param campo, variable variable, en su 1 valor campo a modificar, en su 2 valor: el nuevo valor
         *
         *@return bool TRUE si la modificación fue satisfactoria.
		 */
		public function modificar($IdMarca, $marca){
			$query = "UPDATE Marca SET marca = '".$marca."' WHERE idMarca = '".$IdMarca."'";
			$correcto = $this -> conexion -> query($query);
			$this -> conexion -> close();
			return $correcto;
		}

		/**
		 * Elimina la marca que se indica en el id.
		 * @param int $idMarca Marca de la marca que se desea eliminar
		 * @return bool TRUE en caso de que la eliminación sea correcta.
		 * False en caso contrario.
		 */
		public function eliminar($idMarca){
			$idMarca = $this -> conexion -> real_escape_string($idMarca);
			$query = "UPDATE Marca SET status = 'false' WHERE idMarca = '".$idMarca."'";
			
			$resultado = $this -> conexion -> query($query);
			
			if($resultado){
				return TRUE;
			}else{
				return FALSE;
			}
		}

		/**
		 * Muestra todas las marcas almacenadas en la base de datos.
		 */
		public function listar(){
			$query = "SELECT * FROM Marca WHERE status=1 ORDER BY Marca";
			$resultado = $this -> conexion -> query($query);
			#$this -> conexion -> close();

			if($resultado->num_rows > 0){
				$marcas = array();
				$i = 0;
				while(($fila = $resultado->fetch_assoc())){
					$marcas[$i++] = $fila;
				}
				return $marcas;
			}
			else{
				return NULL;
			}
		}

		/**
		 * Muestra todas las marcas almacenadas en la base de datos.
		 */
		public function listarAjax(){
			$query = "SELECT * FROM Marca WHERE status=1 ORDER BY Marca";
			$resultado = $this -> conexion -> query($query);
			#$this -> conexion -> close();

			if($resultado->num_rows > 0){
				$marcas = array();
				while(($fila = $resultado->fetch_assoc())){
					$marcas[] = $fila;
				}
				return $marcas;
			}
			else{
				return NULL;
			}
		}
	}
?>