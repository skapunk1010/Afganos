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

		public function getIDCheckList(){
			return $this -> IDCheckList;
		}
		public function getNumeroReporte(){
			return $this -> numeroReporte;
		}
		public function getFecha(){
			return $this -> fecha;
		}
		public function getCinturonCantidad(){
			return $this -> cinturonCantidad;
		}
		public function getCinturonDetalle(){
			return $this -> cinturonDetalle;
		}
		public function getEspejoRetrovisor(){
			return $this -> espejoRetrovisor;
		}
		public function getEspejoDerecho(){
			return $this -> espejoDerecho;
		}
		public function getEspejoIzquierdo(){
			return $this -> espejoIzquierdo;
		}
		public function getEspejoDetalle(){
			return $this -> espejoDetalle;
		}
		public function getFaroDelanteroDerecho(){
			return $this -> faroDelanteroDerecho;
		}
		public function getFaroDelanteroIzquierdo(){
			return $this -> faroDelanteroIzquierdo;
		}
		public function getFaroTraseroDerecho(){
			return $this -> faroTraseroDerecho;
		}
		public function getFaroTraseroIzquierdo(){
			return $this -> faroTraseroIzquierdo;
		}
		public function getFaroDetalle(){
			return $this -> faroDetalle;	
		}
		public function getDireccionalDelanteraDerecha(){
			return $this -> direccionalDelanteraDerecha;
		}
		public function getDireccionalDelanteraIzquierda(){
			return $this -> direccionalDelanteraIzquierda;
		}
		public function getDireccionalTraseraDerecha(){
			return $this -> direccionalTraseraDerecha;
		}
		public function getDireccionalTraseraIzquierda(){
			return $this -> direccionalTraseraIzquierda;
		}
		public function getDireccionalDetalle(){
			return $this -> direccionalDetalle;
		}
		public function getDefensaDelantera(){
			return $this -> defensaDelantera;
		}
		public function getDefensaTrasera(){
			return $this -> defensaTrasera;
		}
		public function getDefensaDetalle(){
			return $this -> defensaDetalle;
		}
		public function getTableroDetalle(){
			return $this -> tableroDetalle;
		}
		public function getLlantaRefaccion(){
			return $this -> llantaRefaccion;
		}
		public function getLlantasDetalle(){
			return $this -> llantasDetalle;
		}
		public function getParabrisaDelantero(){
			return $this -> parabrisaDelantero;
		}
		public function getParabrisaTrasero(){
			return $this -> parabrisaTrasero;
		}
		public function getParabrisasDetalle(){
			return $this -> parabrisasDetalle;
		}
		public function getVidriosDetalle(){
			return $this -> vidriosDetalle;
		}
		public function getExtintor(){
			return $this -> extintor;
		}
		public function getPlacaDelantera(){
			return $this -> placaDelantera;
		}
		public function getPlacaTrasera(){
			return $this -> placaTrasera;
		}
		public function getPlacaNumero(){
			return $this -> placaNumero;
		}
		public function getGasolinaCantidad(){
			return $this -> gasolinaCantidad;
		}
		public function getAsientosCantidad(){
			return $this -> asientosCantidad;
		}
		public function getAsientosDetalle(){
			return $this -> asientosDetalle;
		}
		public function getPinturaDetalle(){
			return $this -> pinturaDetalle;
		}
		public function getPuertasDetalle(){
			return $this -> puertasDetalle;
		}
		public function getCofreDetalle(){
			return $this -> cofreDetalle;
		}
		public function getCajuelaDetalle(){
			return $this -> cajuelaDetalle;
		}
		public function getTechoDetalle(){
			return $this -> techoDetalle;
		}
		public function getKilometraje(){
			return $this -> kilometraje;
		}

		public function setIDCheckList($IDCheckList){
			$this -> IDCheckList = $IDCheckList;
		}
		public function setNumeroReporte($numeroReporte){
			$this -> numeroReporte = $numeroReporte;
		}
		public function setFecha($fecha){
			$this -> fecha = $fecha;
		}
		public function setCinturonCantidad($cinturonCantidad){
			$this -> cinturonCantidad = $cinturonCantidad;
		}
		public function setCinturonDetalle($cinturonDetalle){
			$this -> cinturonDetalle = $cinturonDetalle;
		}
		public function setEspejoRetrovisor($espejoRetrovisor){
			$this -> espejoRetrovisor = $espejoRetrovisor;
		}
		public function setEspejoDerecho($espejoDerecho){
			$this -> espejoDerecho = $espejoDerecho;
		}
		public function setEspejoIzquierdo($espejoIzquierdo){
			$this -> espejoIzquierdo = $espejoIzquierdo;
		}
		public function setEspejoDetalle($espejoDetalle){
			$this -> espejoDetalle = $espejoDetalle;
		}
		public function setFaroDelanteroDerecho($faroDelanteroDerecho){
			$this -> faroDelanteroDerecho = $faroDelanteroDerecho;
		}
		public function setFaroDelanteroIzquierdo($faroDelanteroIzquierdo){
			$this -> faroDelanteroIzquierdo = $faroDelanteroIzquierdo;
		}
		public function setFaroTraseroDerecho($faroTraseroDerecho){
			$this -> faroTraseroDerecho = $faroTraseroDerecho;
		}
		public function setFaroTraseroIzquierdo($faroTraseroIzquierdo){
			$this -> faroTraseroIzquierdo = $faroTraseroIzquierdo;
		}
		public function setFaroDetalle($faroDetalle){
			$this -> faroDetalle = $faroDetalle;	
		}
		public function setDireccionalDelanteraDerecha($direccionalDelanteraDerecha){
			$this -> direccionalDelanteraDerecha = $direccionalDelanteraDerecha;
		}
		public function setDireccionalDelanteraIzquierda($direccionalDelanteraIzquierda){
			$this -> direccionalDelanteraIzquierda = $direccionalDelanteraIzquierda;
		}
		public function setDireccionalTraseraDerecha($direccionalTraseraDerecha){
			$this -> direccionalTraseraDerecha = $direccionalTraseraDerecha;
		}
		public function setDireccionalTraseraIzquierda($direccionalTraseraIzquierda){
			$this -> direccionalTraseraIzquierda = $direccionalTraseraIzquierda;
		}
		public function setDireccionalDetalle($direccionalDetalle){
			$this -> direccionalDetalle = $direccionalDetalle;
		}
		public function setDefensaDelantera($defensaDelantera){
			$this -> defensaDelantera = $defensaDelantera;
		}
		public function setDefensaTrasera($defensaTrasera){
			$this -> defensaTrasera = $defensaTrasera;
		}
		public function setDefensaDetalle($defensaDetalle){
			$this -> defensaDetalle = $defensaDetalle;
		}
		public function setTableroDetalle($tableroDetalle){
			$this -> tableroDetalle = $tableroDetalle;
		}
		public function setLlantaRefaccion($llantaRefaccion){
			$this -> llantaRefaccion = $llantaRefaccion;
		}
		public function setLlantasDetalle($llantasDetalle){
			this -> llantasDetalle = $llantasDetalle;
		}
		public function setParabrisaDelantero($parabrisaDelantero){
			$this -> parabrisaDelantero = $parabrisaDelantero;
		}
		public function setParabrisaTrasero($parabrisaTrasero){
			$this -> parabrisaTrasero = $parabrisaTrasero;
		}
		public function setParabrisasDetalle($parabrisasDetalle){
			$this -> parabrisasDetalle = $parabrisasDetalle;
		}
		public function setVidriosDetalle($vidriosDetalle){
			$this -> vidriosDetalle = $vidriosDetalle;
		}
		public function setExtintor($extintor){
			$this -> extintor = $extintor;
		}
		public function setPlacaDelantera($placaDelantera){
			$this -> placaDelantera = $placaDelantera;
		}
		public function setPlacaTrasera($placaTrasera){
			$this -> placaTrasera = $placaTrasera;
		}
		public function setPlacaNumero($placaNumero){
			$this -> placaNumero = $placaNumero;
		}
		public function setGasolinaCantidad($gasolinaCantidad){
			$this -> gasolinaCantidad = $gasolinaCantidad;
		}
		public function setAsientosCantidad($asientosCantidad){
			$this -> asientosCantidad = $asientosCantidad;
		}
		public function setAsientosDetalle($asientosDetalle){
			$this -> asientosDetalle = $asientosDetalle;
		}
		public function setPinturaDetalle($pinturaDetalle){
			$this -> pinturaDetalle = $pinturaDetalle;
		}
		public function setPuertasDetalle($puertasDetalle){
			$this -> puertasDetalle = $puertasDetalle;
		}
		public function setCofreDetalle($cofreDetalle){
			$this -> cofreDetalle = $cofreDetalle;
		}
		public function setCajuelaDetalle($cajuelaDetalle){
			$this -> cajuelaDetalle = $cajuelaDetalle;
		}
		public function setTechoDetalle($techoDetalle){
			$this -> techoDetalle = $techoDetalle;
		}
		public function setKilometraje($kilometraje){
			$this -> kilometraje = $kilometraje;
		}	
	}
?>