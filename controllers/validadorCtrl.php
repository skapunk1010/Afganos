<?php

	class validadorCtrl{
	
		public static function validarTxt($texto){
			return $texto;
		}
	
		public static function validarNum($num){
			if(is_numeric($num))
				return $num;
			
			else return 0;
		}
	
		public static function validarEmail($email){
			return email; 
		}
	}
	
?>