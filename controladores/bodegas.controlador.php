<?php

class ControladorBodegas{

	/*=============================================
	REGISTRO DE COBRADOR
	=============================================*/

	static public function ctrCrearBodega(){


		if(isset($_POST["nuevaDescripcion"]) && $_POST["nuevaDescripcion"]|=""){


				$tabla = "bodegas";

				$datos = array("descripcion" => $_POST["nuevaDescripcion"]);


				$respuesta = ModeloBodegas::mdlIngresarBodega($tabla, $datos);
				
				

				if($respuesta == "ok"){
				
				//REGISTRO EN BITACORA

				$datosBitacora["descripcion"]="SE GUARDO LA BODEGA: : ". $_POST["nuevaDescripcion"];
				$datosBitacora["usuario"]=$_SESSION["usuario"];


				$respuestaBitacora = ModeloBitacora::mdlIngresarBitacora("bitacora", $datosBitacora);

				echo '<script>

					swal({

						type: "success",
						title: "¡El bodega ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "bodegas";

						}

					});
				

					</script>';


				}	else{

				echo '<script>

					swal({

						type: "error",
						title: "'.$respuesta.'",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){
						
							window.location = "bodegas";

						}

					});
				

				</script>';

			}



			}

		}


	/*=============================================
	MOSTRAR BODEGAS
	=============================================*/

	static public function ctrMostrarBodegas($item, $valor){

		$tabla = "bodegas";

		$respuesta = ModeloBodegas::mdlMostrarBodegas($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	MOSTRAR BODEGAS DEL USUARIO
	=============================================*/

	static public function ctrMostrarBodegasUsuarios($valor){

		$tabla = "bodegas";

		$respuesta = ModeloBodegas::mdlMostrarBodegasUsuario($valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR USUARIO
	=============================================*/

	static public function ctrEditarBodega(){

		if(isset($_POST["editarDescripcion"])){



				$tabla = "bodegas";

			

				$datos = array("descripcion" => $_POST["editarDescripcion"]
							   ,"id"=>$_POST["editarID"]
							   );

				$respuesta = ModeloBodegas::mdlEditarBodega($tabla, $datos);

				if($respuesta == "ok"){

									//REGISTRO EN BITACORA

				$datosBitacora["descripcion"]="SE EDITO LA BODEGA: : ".$_POST["editarDescripcion"]." CON EL NOMBRE NUEVO:". $_POST["editarDescripcion"];
				$datosBitacora["usuario"]=$_SESSION["usuario"];


				$respuestaBitacora = ModeloBitacora::mdlIngresarBitacora("bitacora", $datosBitacora);

					echo'<script>

					swal({
						  type: "success",
						  title: "El bodega ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "bodegas";

									}
								})

					</script>';

				}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "'.$respuesta.'",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "bodegas";

							}
						})

			  	</script>';


			}

		}

	}

	/*=============================================
	BORRAR VENDEDOR
	=============================================*/

	static public function ctrBorrarBodega(){

		if(isset($_GET["idBodega"]) && $_GET["accion"]="eliminar"){

			$tabla ="bodegas";
			$datos = $_GET["idBodega"];

			

			$respuesta = ModeloBodegas::mdlBorrarBodega($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El bodega ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "bodegas";

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
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "bodegas";

								}
							})

				</script>';

			}		

		}

	}


}
	


if(isset($_POST["traerAlmacenes"])){
	include "../modelos/conexion.php";
	include "../modelos/bodegas.modelo.php";
	$bodegas = ModeloBodegas::mdlMostrarBodegas("bodegas", null, null);


	$valores='<option value="">Seleccione Bodega</option>';

	foreach ($bodegas as $key => $value) {
		
		$valores .= "<option value='".$value["id"]."'>".$value["descripcion"]."</option>";
	}

	echo $valores;
}
