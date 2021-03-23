<?php

class ControladorEmpresa{

	/*=============================================
	MOSTRAR EMPRESA
	=============================================*/

	static public function ctrMostrarEmpresas($item, $valor){

		$tabla = "datosempresa";
		$item = null;
		$valor=null;
		$respuesta = ModeloEmpresas::mdlMostrarEmpresa($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR EMPRESA 
	=============================================*/

	static public function ctrEditarEmpresa(){

		if(isset($_POST["editarNombreEmpresa"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombreEmpresa"])){

				$tabla = "datosempresa";

				$datos = array("nombreEmpresa" => $_POST["editarNombreEmpresa"],
							   "DireccionEmpresa" => $_POST["editarDireccionEmpresa"],
							   "RFC" => $_POST["editarRFC"],
							   "telefonoEmpresa" => $_POST["editarTelefonoEmpresa"],
							   "diasEntrega" => $_POST["editarDiasEntrega"],
							   "correoElectronicoEmpresa" => $_POST["editarCorreoElectronicoEmpresa"]);

				$respuesta = ModeloEmpresas::mdlEditarEmpresa($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La empresa ha sido editada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "datosEmpresa";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
							if (result.value) {

							window.location = "usuarios";

							}
						})

			  	</script>';

			}

		}

	}
}
	


