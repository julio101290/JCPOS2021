<?php

require_once "../controladores/bitacora.controlador.php";
require_once "../modelos/bitacora.modelo.php";
          

class TablaBitacora{

 	/*=============================================
 	 MOSTRAR LA TABLA DE BITACORA
  	=============================================*/ 

	public function mostrarTablaBitacora(){

		$item = null;
    	$valor = null;
    	$orden = "id";


    	$request=$_REQUEST;


	   $renglones = ControladorBitacora::ctrMostrarBitacora($request, "s");
    	$totalRenglones=$renglones[0]["contador"];


  		$bitacora = ControladorBitacora::ctrMostrarBitacora($request,"n");	

  		if(count($bitacora) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{

		"draw": '.intval($request["draw"]).',
		"recordsTotal":'.intval($totalRenglones).',
		"recordsFiltered": '.intval($totalRenglones).',
		
		  "data": [';

		  for($i = 0; $i < count($bitacora); $i++){

		  

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 

  			$descripcion=str_replace(chr(10), "", $bitacora[$i]["descripcion"]);
  			$descripcion=str_replace(chr(13), "",$descripcion);
  			$descripcion=str_replace("\n", "",$descripcion);
  			$descripcion=str_replace("\r", "",$descripcion);
  			$descripcion=str_replace("\t", "",$descripcion);
  			$descripcion=str_replace("'", "",$descripcion);
  			$descripcion=str_replace('"', "",$descripcion);

		  	$datosJson .='[
			      "'.$descripcion.'", 
			      "'.$bitacora[$i]["fecha"].'",
			      "'.$bitacora[$i]["usuario"].'"

			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE CLIENTES
=============================================*/ 
$activarBitacora= new TablaBitacora();
$activarBitacora -> mostrarTablaBitacora();

