<?php

	function strMenuActivo($strMenu1, $strMenu2){	
		if ($strMenu1==$strMenu2){
			$respuesta= 'class="active"';
		}
		else{
			$respuesta="";
		}
		return $respuesta;
	}



//SI LA VARIABLE ESTA VACIA O NO SETA DECLARADA MANDARA CERO SIEMPRE, ES COMO EL VAL DE VISUAL BASIC 6.0

    function esCero($value) {
  
	 if (empty($value)){
	  return "0"; 
	}
	 else{
	 	return $value;
	 }

	}
