<?php
	class CheckList{
		private $IDCheckList;
		private $numeroReporte;
		private $fecha;
		private $cinturonCantidad;
		private $cinturonDetalle;
		private $espejoRetrovisor;
		private $espejoDerecho;
		private $espejoIzquierdo;
		private $espejoDetalle;
		private $faroDelanteroDerecho;
		private $faroDelanteroIzquierdo;
		private $faroTraseroDerecho;
		private $faroTraseroIzquierdo;
		private $faroDetalle;
		private $direccionalDelanteraDerecha;
		private $direccionalDelanteraIzquierda;
		private $direccionalTraseraDerecha;
		private $direccionalTraseraIzquierda;
		private $direccionalDetalle;
		private $defensaDelantera;
		private $defensaTrasera;
		private $defensaDetalle;
		private $tableroDetalle;
		private $llantaRefaccion;
		private $llantasDetalle;
		private $parabrisaDelantero;
		private $parabrisaTrasero;
		private $parabrisasDetalle;
		private $vidriosDetalle;
		private $extintor;
		private $placaDelantera;
		private $placaTrasera;
		private $placaNumero;
		private $gasolinaCantidad;
		private $asientosCantidad;
		private $asientosDetalle;
		private $pinturaDetalle;
		private $puertasDetalle;
		private $cofreDetalle;
		private $cajuelaDetalle;
		private $techoDetalle;
		private $kilometraje;

		/**
		*@return String Regresa id del checklist
		*/
		public function getIDCheckList(){
			return $this -> IDCheckList;
		}

		/**
		*@return String Regresa el id del reporte en que se realizó
		*el checklist
		*/
		public function getNumeroReporte(){
			return $this -> numeroReporte;
		}

		/**
		*@return DateTime Regresa fecha del checklist
		*/
		public function getFecha(){
			return $this -> fecha;
		}

		/**
		*@return int Regresa cantidad de cinturones de
		*seguridad
		*/
		public function getCinturonCantidad(){
			return $this -> cinturonCantidad;
		}

		/**
		*@return String Regresa el detalle o descripción de los cinturones
		*/
		public function getCinturonDetalle(){
			return $this -> cinturonDetalle;
		}

		/**
		*@return bool Regresa status del espejo retrovisor
		*/
		public function getEspejoRetrovisor(){
			return $this -> espejoRetrovisor;
		}

		/**
		*@return bool Regresa status del espejo derecho
		*/
		public function getEspejoDerecho(){
			return $this -> espejoDerecho;
		}

		/**
		*@return bool Regresa status del espejo izquierdo
		*/
		public function getEspejoIzquierdo(){
			return $this -> espejoIzquierdo;
		}

		/**
		*@return String Regresa detalle de los espejos
		*/
		public function getEspejoDetalle(){
			return $this -> espejoDetalle;
		}

		/**
		*@return bool Regresa status del faro delantero derecho
		*/
		public function getFaroDelanteroDerecho(){
			return $this -> faroDelanteroDerecho;
		}

		/**
		*@return bool Regresa status del faro delantero izquierdo
		*/
		public function getFaroDelanteroIzquierdo(){
			return $this -> faroDelanteroIzquierdo;
		}

		/**
		*@return bool Regresa status del faro trasero derecho
		*/
		public function getFaroTraseroDerecho(){
			return $this -> faroTraseroDerecho;
		}

		/**
		*@return bool Regresa status del faro trasero derecho
		*/
		public function getFaroTraseroIzquierdo(){
			return $this -> faroTraseroIzquierdo;
		}

		/**
		*@return String Regresa detalle de los faros
		*/
		public function getFaroDetalle(){
			return $this -> faroDetalle;	
		}

		/**
		*@return bool Regresa status de la direccional delantera derecha
		*/
		public function getDireccionalDelanteraDerecha(){
			return $this -> direccionalDelanteraDerecha;
		}

		/**
		*@return bool Regresa status de la direccional delantera izquierda
		*/
		public function getDireccionalDelanteraIzquierda(){
			return $this -> direccionalDelanteraIzquierda;
		}

		/**
		*@return bool Regresa status de la direccional trasera derecha
		*/
		public function getDireccionalTraseraDerecha(){
			return $this -> direccionalTraseraDerecha;
		}

		/**
		*@return bool Regresa status de la direccional trasera izquierda
		*/
		public function getDireccionalTraseraIzquierda(){
			return $this -> direccionalTraseraIzquierda;
		}

		/**String Regresa detalle de las direccionales
		*/
		public function getDireccionalDetalle(){
			return $this -> direccionalDetalle;
		}

		/**
		*@return bool Regresa status de la defensa delantera
		*/
		public function getDefensaDelantera(){
			return $this -> defensaDelantera;
		}

		/**
		*@return bool Regresa status de la defensa trasera
		*/
		public function getDefensaTrasera(){
			return $this -> defensaTrasera;
		}

		/**
		*@return String Regresa detalle de las defensas
		*/
		public function getDefensaDetalle(){
			return $this -> defensaDetalle;
		}

		/**
		*@return String Regresa detalle del tablero
		*/
		public function getTableroDetalle(){
			return $this -> tableroDetalle;
		}

		/**
		*@return bool Regresa status de la llanta de refacción
		*/
		public function getLlantaRefaccion(){
			return $this -> llantaRefaccion;
		}

		/**
		*@return String Regresa detalle de las llantas
		*/
		public function getLlantasDetalle(){
			return $this -> llantasDetalle;
		}

		/**
		*@return bool Regresa status del parabrisas delantero
		*/
		public function getParabrisaDelantero(){
			return $this -> parabrisaDelantero;
		}

		/**
		*@return bool Regresa status del parabrisas trasero
		*/
		public function getParabrisaTrasero(){
			return $this -> parabrisaTrasero;
		}

		/**
		*@return String Regresa detalle del parabrisas
		*/
		public function getParabrisasDetalle(){
			return $this -> parabrisasDetalle;
		}

		/**
		*@return String Regresa detalle de los vidrios
		*/
		public function getVidriosDetalle(){
			return $this -> vidriosDetalle;
		}

		/**
		*@return bool Regresa si cuenta con extintor
		*/
		public function getExtintor(){
			return $this -> extintor;
		}

		/**
		*@return bool Regresa status de la placa delantera
		*/
		public function getPlacaDelantera(){
			return $this -> placaDelantera;
		}

		/**
		*@return bool Regresa status de la placa trasera
		*/
		public function getPlacaTrasera(){
			return $this -> placaTrasera;
		}

		/**
		*@return String Regresa número de placas
		*/
		public function getPlacaNumero(){
			return $this -> placaNumero;
		}

		/**
		*@return bool Regresa status del parabrisas delantero
		*/
		public function getGasolinaCantidad(){
			return $this -> gasolinaCantidad;
		}

		/**
		*@return int Regresa cantidad de asientos
		*/
		public function getAsientosCantidad(){
			return $this -> asientosCantidad;
		}

		/**
		*@return String Regresa el detalle del estado de los asientos
		*/
		public function getAsientosDetalle(){
			return $this -> asientosDetalle;
		}

		/**
		*@return String Regresa el detalle de la pintura
		*/
		public function getPinturaDetalle(){
			return $this -> pinturaDetalle;
		}

		/**
		*@return String Regresa el detalle de las puertas
		*/
		public function getPuertasDetalle(){
			return $this -> puertasDetalle;
		}

		/**
		*@return String Regresa el detalle del cofre
		*/
		public function getCofreDetalle(){
			return $this -> cofreDetalle;
		}

		/**
		*@return String Regresa el detalle de la cajuela
		*/
		public function getCajuelaDetalle(){
			return $this -> cajuelaDetalle;
		}

		/**
		*@return String Regresa el detalle del techo
		*/
		public function getTechoDetalle(){
			return $this -> techoDetalle;
		}

		/**
		*@return String Regresa el kilometraje
		*/
		public function getKilometraje(){
			return $this -> kilometraje;
		}



		#SETS
		/**
		*@param String $IDCheckList recibe el id de checklist
		*/
		public function setIDCheckList($IDCheckList){
			$this -> IDCheckList = $IDCheckList;
		}

		/**
		*@param int $numeroReporte recibe el id de reporte
		*/
		public function setNumeroReporte($numeroReporte){
			$this -> numeroReporte = $numeroReporte;
		}

		/**
		*@param date $fecha recibe la fecha del checklist
		*/
		public function setFecha($fecha){
			$this -> fecha = $fecha;
		}

		/**
		*@param int $cinturonCantidad recibe cantidad de cinturones
		*/
		public function setCinturonCantidad($cinturonCantidad){
			$this -> cinturonCantidad = $cinturonCantidad;
		}

		/**
		*@param int $cinturonCantidad recibe cantidad de cinturones
		*/
		public function setCinturonDetalle($cinturonDetalle){
			$this -> cinturonDetalle = $cinturonDetalle;
		}

		/**
		*@param bool $espejoRetrovisor recibe estado del espejo retrovisor
		*/
		public function setEspejoRetrovisor($espejoRetrovisor){
			$this -> espejoRetrovisor = $espejoRetrovisor;
		}

		/**
		*@param bool $espejoDerecho recibe estado del espejo derecho
		*/
		public function setEspejoDerecho($espejoDerecho){
			$this -> espejoDerecho = $espejoDerecho;
		}

		/**
		*@param bool $espejoIzuierdo recibe estado del espejo izquierdo
		*/
		public function setEspejoIzquierdo($espejoIzquierdo){
			$this -> espejoIzquierdo = $espejoIzquierdo;
		}

		/**
		*@param bool $espejoDetalle recibe descripción de los espejos
		*/
		public function setEspejoDetalle($espejoDetalle){
			$this -> espejoDetalle = $espejoDetalle;
		}

		/**
		*@param bool $faroDelanteroDerecho recibe estado del faro delantero derecho
		*/
		public function setFaroDelanteroDerecho($faroDelanteroDerecho){
			$this -> faroDelanteroDerecho = $faroDelanteroDerecho;
		}

		/**
		*@param bool $faroDelanteroIzquierdo recibe estado del faro delantero izquierdo
		*/
		public function setFaroDelanteroIzquierdo($faroDelanteroIzquierdo){
			$this -> faroDelanteroIzquierdo = $faroDelanteroIzquierdo;
		}

		/**
		*@param bool $faroTraseroDerecho recibe estado del faro trasero derecho
		*/
		public function setFaroTraseroDerecho($faroTraseroDerecho){
			$this -> faroTraseroDerecho = $faroTraseroDerecho;
		}

		/**
		*@param bool $faroTraseroIzquierdo recibe estado del faro trasero izquierdo
		*/
		public function setFaroTraseroIzquierdo($faroTraseroIzquierdo){
			$this -> faroTraseroIzquierdo = $faroTraseroIzquierdo;
		}

		/**
		*@param String $faroDetalle recibe descripción de los faros
		*/
		public function setFaroDetalle($faroDetalle){
			$this -> faroDetalle = $faroDetalle;	
		}

		/**
		*@param bool $direccionalDelanteraDerecha recibe estado de direccional delantera derecha
		*/
		public function setDireccionalDelanteraDerecha($direccionalDelanteraDerecha){
			$this -> direccionalDelanteraDerecha = $direccionalDelanteraDerecha;
		}

		/**
		*@param bool $direccionalDelanteraIzquierda recibe estado de direccional delantera izquierda
		*/
		public function setDireccionalDelanteraIzquierda($direccionalDelanteraIzquierda){
			$this -> direccionalDelanteraIzquierda = $direccionalDelanteraIzquierda;
		}

		/**
		*@param bool $direccionalTraseraDerecha recibe estado de direccional trasera derecha
		*/
		public function setDireccionalTraseraDerecha($direccionalTraseraDerecha){
			$this -> direccionalTraseraDerecha = $direccionalTraseraDerecha;
		}

		/**
		*@param bool $direccionalTraseraIzquierda recibe estado de direccional trasera izquierda
		*/
		public function setDireccionalTraseraIzquierda($direccionalTraseraIzquierda){
			$this -> direccionalTraseraIzquierda = $direccionalTraseraIzquierda;
		}

		/**
		*@param String $direccionalDetalle recibe descripción de direccionales
		*/
		public function setDireccionalDetalle($direccionalDetalle){
			$this -> direccionalDetalle = $direccionalDetalle;
		}

		/**
		*@param bool $defensaDelantera recibe estado de defensa delantera
		*/
		public function setDefensaDelantera($defensaDelantera){
			$this -> defensaDelantera = $defensaDelantera;
		}

		/**
		*@param bool $defensaTrasera recibe estado de defensa trasera
		*/
		public function setDefensaTrasera($defensaTrasera){
			$this -> defensaTrasera = $defensaTrasera;
		}

		/**
		*@param String $defensaDetalle recibe descripción de defensa
		*/
		public function setDefensaDetalle($defensaDetalle){
			$this -> defensaDetalle = $defensaDetalle;
		}

		/**
		*@param String $tableroDetalle recibe descripción de tablero
		*/
		public function setTableroDetalle($tableroDetalle){
			$this -> tableroDetalle = $tableroDetalle;
		}

		/**
		*@param bool $llantaRefaccion recibe estado de llanta refacción
		*/
		public function setLlantaRefaccion($llantaRefaccion){
			$this -> llantaRefaccion = $llantaRefaccion;
		}

		/**
		*@param String $llantasDetalle recibe descripción de llantas
		*/
		public function setLlantasDetalle($llantasDetalle){
			this -> llantasDetalle = $llantasDetalle;
		}

		/**
		*@param bool $parabrisaDelantero recibe estado de parabrisas delantero
		*/
		public function setParabrisaDelantero($parabrisaDelantero){
			$this -> parabrisaDelantero = $parabrisaDelantero;
		}

		/**
		*@param bool $parabrisaTrasero recibe estado de parabrisas trasero
		*/
		public function setParabrisaTrasero($parabrisaTrasero){
			$this -> parabrisaTrasero = $parabrisaTrasero;
		}

		/**
		*@param String $parabrisasDetalle recibe descripción de parabrisas
		*/
		public function setParabrisasDetalle($parabrisasDetalle){
			$this -> parabrisasDetalle = $parabrisasDetalle;
		}

		/**
		*@param String $vidriosDetalle recibe descripción de vidrios
		*/
		public function setVidriosDetalle($vidriosDetalle){
			$this -> vidriosDetalle = $vidriosDetalle;
		}

		/**
		*@param bool $extintor recibe si cuenta con extintor
		*/
		public function setExtintor($extintor){
			$this -> extintor = $extintor;
		}

		/**
		*@param bool $placaDelantera recibe estado de placa delantera
		*/
		public function setPlacaDelantera($placaDelantera){
			$this -> placaDelantera = $placaDelantera;
		}

		/**
		*@param bool $placaTrasera recibe estado de placa trasera
		*/
		public function setPlacaTrasera($placaTrasera){
			$this -> placaTrasera = $placaTrasera;
		}

		/**
		*@param String $placaNumero recibe número de la placa
		*/
		public function setPlacaNumero($placaNumero){
			$this -> placaNumero = $placaNumero;
		}

		/**
		*@param String $gasolinaCantidad recibe cantidad de gasolina
		*/
		public function setGasolinaCantidad($gasolinaCantidad){
			$this -> gasolinaCantidad = $gasolinaCantidad;
		}

		/**
		*@param int $asientosCantidad recibe cantidad de asientos
		*/
		public function setAsientosCantidad($asientosCantidad){
			$this -> asientosCantidad = $asientosCantidad;
		}

		/**
		*@param String $asientosDetalle recibe descripción de asientos
		*/
		public function setAsientosDetalle($asientosDetalle){
			$this -> asientosDetalle = $asientosDetalle;
		}

		/**
		*@param String $pinturaDetalle recibe descripción de pintura
		*/
		public function setPinturaDetalle($pinturaDetalle){
			$this -> pinturaDetalle = $pinturaDetalle;
		}

		/**
		*@param String $puertasDetalle recibe descripción de puertas
		*/
		public function setPuertasDetalle($puertasDetalle){
			$this -> puertasDetalle = $puertasDetalle;
		}

		/**
		*@param String $cofreDetalle recibe descripción de cofre
		*/
		public function setCofreDetalle($cofreDetalle){
			$this -> cofreDetalle = $cofreDetalle;
		}

		/**
		*@param String $cajuelaDetalle recibe descripción de cajuela
		*/
		public function setCajuelaDetalle($cajuelaDetalle){
			$this -> cajuelaDetalle = $cajuelaDetalle;
		}

		/**
		*@param String $techoDetalle recibe descripción de techo
		*/
		public function setTechoDetalle($techoDetalle){
			$this -> techoDetalle = $techoDetalle;
		}

		/**
		*@param int $kilometraje recibe kilometra de vehículo
		*/
		public function setKilometraje($kilometraje){
			$this -> kilometraje = $kilometraje;
		}	
	}
?>