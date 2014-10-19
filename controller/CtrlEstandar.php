<?php

	abstract class CtrlEstandar{
		/**
		 * Verifica si el usuario ha iniciado sesión.
		 * @return bool Regresa True si ha iniciado sesión. False, en caso contrario.
		 */
		protected function estaLogeado(){
			if( isset($_SESSION['usuario']) )
				return true;
			return false;
		}

		/**
		 * Verifica que el usuario que ha iniciado sesión sea un administrador.
		 * @return bool Regresa True si el usuario que ha iniciado sesión es de tipo administrador.
		 * False, en caso de que no lo sea.
		 */
		protected function esAdmin(){
			if( isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == 'administrador' )
				return true;
			return false;
		}

		/**
		 * Verifica que el usuario que ha iniciado sesión sea un usuario común.
		 * @return bool Regresa True si el usuario que ha iniciado sesión es de tipo usuario.
		 * False, en caso de que no lo sea.
		 */
		protected function esUsuario(){
			if( isset($_SESSION['tipoUsuario']) && $_SESSION['tipoUsuario'] == 'usuario' )
				return true;
			return false;
		}
	}
?>