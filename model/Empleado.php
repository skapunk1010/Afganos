<?php
	
	class Empleado{
	
		private $codigo;
		private $nombre;
		private $apellidoMat;
		private $apellidoPat;
		private $fechaNac;
		private $RFC;
		private $NSS;
		private $email;
		private $status;
		
		/**
		*Inicializa los datos de un usuario.
		*@param String $codigo Código del cliente.
		*@param String $nombre Nombre del cliente.
		*@param String $apellidoPat Apellido paterno del cliente.
		*@param String $apellidoMat Apellido materno del cliente.
		*@param String $status Status del cliente.
		*/
		public function __construct($codigo, $nombre, $apellidoPat, $apellidoMat, $status){
		
			$this -> codigo = $codigo;
			$this -> nombre = $nombre;
			$this -> apellidoPat = $apellidoPat;
			$this -> apellidoMat = $apellidoMat;
			$this -> status = $status;
		}
		
		/**
		 * Obtiene el código del cliente.
		 *@return String Codigo del cliente.
		 */
		public function getCodigo(){
			return $this -> codigo;
		}

		/**
		 *Obtiene el nombre del código.
		 *@return String Nombre del cliente.
		 */
		public function getNombre(){
			return $this -> nombre;
		}

		/**
		 *Obtiene el apellido paterno del cliente.
		 *@return String Apellido paterno del cliente.
		 */
		public function getApellidoPaterno(){
			return $this -> apellidoPat;
		}

		/**
		 *Obtiene el apellido materno del cliente.
		 *@return String Apellido materno del cliente.
		 */
		public function getApellidoMaterno(){
			return $this -> apellidoMat;
		}

		/**
		 *Obtiene el nombre completo del cliente. Concatena el nombre y sus apellidos.
		 *@param String Nombre completo del cliente.
		 */
		public function getNombreCompleto(){
			return $this -> nombre." ". $this -> apellidoPat." ".$this-> apellidoMat;
		}

		/**
		 * Obtiene la fecha de nacimiento del cliente.
		 *@return String Fecha de nacimiento del cliente en formato DD-MM-AAAAA
		 */
		public function getFechaNacimiento(){
			return $this -> fechaNac;
		}

		/**
		 * Obtiene el RFC del cliente.
		 *@return String Registro Federal del Contribuyente (RFC) del cliente.
		 */
		public function getRFC(){
			return $this -> RFC;
		}

		/**
		 * Obtiene el NSS del cliente.
		 *@return String Número de seguridad social (NSS) del cliente.
		 */
		public function getNSS(){
			return $this -> NSS;
		}

		/**
		 * Obtiene el Email del cliente.
		 *@return String Correo electrónico (Email) del cliente.
		 */
		public function getEmail(){
			return $this -> email;
		}

		/**
		 * Obtiene el status del cliente.
		 *@return String Status del cliente.
		 */
		public function getStatus(){
			return $this -> status;
		}
		
		/**
		 *Asigna el código del cliente.
		 *@param String $codigo Código del cliente.
		 */
		public function setCodigo($codigo){
			$this -> codgo = $codigo;
		}

		/**
		 *Asigna el nombre del cliente.
		 *@param String $nombre Nombre del cliente.
		 */
		public function setNombre($nombre){
			$this -> nombre = $nombre;
		}

		/**
		 *Asigna el apellido paterno del cliente.
		 *@param String $apellidoPat Apellido paterno del cliente.
		 */
		public function setApellidoPaterno($apellidoPat){
			$this -> apellidoPat = $apellidoPat;
		}

		/**
		 * Asigna el apellido materno del cliente.
		 *@param String $apellidoMat Apellido materno del cliente.
		 */
		public function setApellidoMaterno($apellidoMat){
			$this -> apellidoMat = $apellidoMat;
		}

		/**
		 * Asigna la fecha de nacimiento del cliente.
		 *@param String $fechaNac Fecha de nacimiento del cliente en formato DD-MM-AAAA.
		 */
		public function setFechaNacimiento($fechaNac){
			$this -> fechaNac = $fechaNac;
		}

		/**
		 *Asigna el Registro Federal del Contribuyente(RFC) del cliente.
		 *@param String $RFC Registro federal del contribuyente del cliente.
		 */
		public function setRFC($RFC){
			$this -> RFC = $RFC;
		}

		/**
		 * Asignación del número de seguridad social del cliente.
		 *@param String $NSS Número de seguridad social del client.
		 */
		public function setNSS($NSS){
			$this -> NSS = $NSS;
		}

		/**
		 *Asignacion de correo electrónico(Email) del cliente.
		 *@param String $email Correo electrónico del cliente.
		 */
		public function setEmail($email){
			$this -> email = $email;
		}

		/**
		 *Asignación del status del cliente.
		 *@param String $status Status del cliente.
		 */
		public function setStatus($status){
			$this -> status = $status;
		}
	}

?>