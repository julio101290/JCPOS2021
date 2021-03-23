<?php


class ControladorPagos{
	


	/*=============================================
	LEER PAGOS
	=============================================*/

	static public function ctrLeerPagos($idVenta){
		if($idVenta>0){
			$datos = array("idVenta"=>$idVenta
						  );

			$respuesta = ModeloPagos::mdlMostrarPagos("pagos", $datos);

			return $respuesta;

		}

	}


	/*=============================================
	LEER PAGO
	=============================================*/

	static public function ctrLeerPago($idPago){
		if($idPago>0){
			$datos = array("idPago"=>$idPago
						  );

			$respuesta = ModeloPagos::mdlMostrarPago("pagos", $datos);

			return $respuesta;

		}

	}


	/*=============================================
	PAGOS PENDIENTES
	=============================================*/

	static public function ctrPagosPendientes(){


			$respuesta = ModeloPagos::mdlPagosPendientes("pagos");

			return $respuesta;


	}





	/*=============================================
	CREAR PAGO
	=============================================*/

	static public function ctrCrearPago(){


	if(isset($_POST["codigoVenta"]) ){
			

		




			/*=============================================
			GUARDAR EL PAGO
			=============================================*/	


			//ASIGNAMOS EL VALOR A LA VARIABLES
			$importePagado=$_POST["nuevoValorEfectivo"];
			$importeDevuelto=$_POST["nuevoCambioEfectivo"];
			$importePendiente=$_POST["nuevoTotalVenta"];
			$fechaPago=$_POST["nuevoFechaPago"];
			$nuevoTipoPago=$_POST["nuevoTipoPago"];


			//LE ASIGNAMOS EL IMPORTE DEVUELTO SI ES QUE LO QUE PAGO EL CLIENTE ES MAYOR AL IMPORTE DE LA VENTA
			if($importeDevuelto<0){
				$importeDevuelto =0;
			}


			//VALIDAMOS QUE LO PAGADO NO SEA MAYOR A LA VENTA
			if(($importePagado-$importeDevuelto)>$importePendiente){
						echo'<script>

						swal({
							  type: "error",
							  title: "No se puede pagar mas del importe total de la venta",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "ventas";

										}
									})

						</script>';

				return;
			}


			$datosPagos = array("idVenta"=>$_POST["codigoVenta"],
						   "importePagado"=>$importePagado,
						   "importeDevuelto"=>$importeDevuelto,
						   "fechaPago"=>$fechaPago,
						   "tipoPago"=>$nuevoTipoPago


						  );

			$respuestaPago = ModeloPagos::mdlIngresarPago("pagos", $datosPagos);

			if ($respuestaPago=="ok"){

					echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "El pago ha sido guardado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "ventas";

								}
							})

				</script>';

			}





			}


		}


	/*=============================================
	ELIMINAR PAGO
	=============================================*/


	static public function ctrEliminarPago(){
		
		if(isset($_GET["idPagoEliminar"])){
			
			$idPago=$_GET["idPagoEliminar"];

			if($idPago>0){
				$datos = array("idPago"=>$idPago
							  );

				$respuesta = ModeloPagos::mdlEliminarPago("pagos", $datos);

				
				if($respuesta=="ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El pago ha sido borrado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "ventas";

									}
								})

					</script>';
				}

			}
	}

	}



	}

if(isset($_POST["codigoVenta"])){
	
	require_once "../modelos/pagos.modelo.php";


	$guardarPago= new ControladorPagos();
	$guardarPago -> ctrCrearPago();
	

}


