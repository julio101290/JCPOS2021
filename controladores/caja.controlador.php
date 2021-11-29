<?php

class ControladorCaja{


	/*=============================================
	MOSTRAR CAJAS
	=============================================*/

	static public function ctrMostrarCajas($item, $valor){

		$tabla = "caja";
		$item = null;
		$valor=null;

		$respuesta = ModeloCaja::mdlMostrarCajas($tabla, $item, $valor);

		return $respuesta;

	}

	/*=============================================
	ABRIR CAJA
	=============================================*/

	static public function ctrAbrirCaja(){


		if(isset($_POST["idVendedor"])){
			$tabla = "caja";


			$time = time();

			$time = date("h:i:s",$time);

			$fechaApertura=$_POST["fechaApertura"]." ".$time;

			$datos = array("importe_apertura"=>$_POST["importeApertura"],
						   "usuario"=>$_POST["idVendedor"],
						   "fecha_apertura"=>$fechaApertura);

			$respuesta = ModeloCaja::mdlAbrirCaja($tabla, $datos);

			if($respuesta=="ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "La caja se abrio correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "cajadiaria";

										}
									})

						</script>';

				}


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "'.$respuesta.'",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cajadiaria";

							}
						})

			  	</script>';

			}

		}
	}


		/*=============================================
	CERRAR CAJA
	=============================================*/

	static public function ctrCerrarCaja(){


		if(isset($_POST["EditarIdCaja"])){



			$time = time();

			$time = date("h:i:s",$time);

			$fechaCierre=$_POST["editarFechaCierre"];

			$datos = array("diferencia"=>$_POST["diferencia"],
						   "total_ventas"=>esCero($_POST["EditarTotalVentas"]),
						   "id"=>$_POST["EditarIdCaja"],
						   "observaciones"=>$_POST["editarObservaciones"],
						   "fecha_cierre"=>$fechaCierre);

			$respuesta = ModeloCaja::mdlCerrarCaja($datos);

			if($respuesta=="ok"){

					echo'<script>

						swal({
							  type: "success",
							  title: "La caja se cerro correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "cajadiaria";

										}
									})

						</script>';

				}


			else{

				echo'<script>

					swal({
						  type: "error",
						  title: "'.$respuesta.'",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "cajadiaria";

							}
						})

			  	</script>';

			}

		}
	}


}

//BUSCA DATOS DE LA CAJA

if(isset($_POST["idCaja"])){
	require_once "../modelos/caja.modelo.php";
	$item="id";
	$valor=$_POST["idCaja"];

	$respuesta = ModeloCaja::mdlMostrarCajas("caja", $item, $valor);

	echo json_encode($respuesta);
}
