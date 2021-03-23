<?php

require_once "../controladores/pagos.controlador.php";
require_once "../modelos/pagos.modelo.php";
session_start();

class TablaPagos{

 	/*=============================================
 	 MOSTRAR LA TABLA DE PAGOS
  	=============================================*/ 

	public function mostrarTablaPagos(){

    	$valor =$this->idVenta ;


  		$pagos = ControladorPagos::ctrLeerPagos($valor);
 		
  		if(count($pagos) == 0){

  			echo '{"data": []}';

		  	return;
  		}	
		
  		$datosJson = '{
		  "data": [';

		  for($i = 0; $i < count($pagos); $i++){

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
  		

  			$botones =  "";

		  	if($_SESSION["imprimirPagos"] == "on"){
	  			$botones =  "<div class='btn-group'><button type='button' class='btn btn-info btnImprimirPago ' idVenta=".$pagos[$i]["idVenta"]." idPago='".$pagos[$i]["id"]."'><i class='fa fa-print'></i></button></div>"; 
		  	}

		  	if($_SESSION["eliminarPagos"] == "on"){
		  		$botones .=  "<div class='btn-group'><button type='button' class='btn btn-danger btnEliminarPago ' idPago='".$pagos[$i]["id"]."'><i class='fa fa-times'></button></div>"; 
		   }








		  	$datosJson .='[
			      "'.$pagos[$i]["id"].'",
			      "'.$pagos[$i]["fechaPago"].'",
			      "'.$pagos[$i]["tipoPago"].'",
			      "'.$pagos[$i]["importePagado"].'",
			      "'.$pagos[$i]["importeDevuelto"].'",
			      "'.$botones.'"
			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

if(isset($_POST["codigo"])){
	/*=============================================
	ACTIVAR TABLA DE HISTORICO DE PAGOS
	=============================================*/ 
	$activarPagos = new TablaPagos();
	$activarPagos -> idVenta=$_POST["codigo"]; //$_POST["idVenta1"];
	$activarPagos -> mostrarTablaPagos();
}

