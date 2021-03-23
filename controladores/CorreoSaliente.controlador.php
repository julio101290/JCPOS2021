<?php

class ControladorCorreo{

	/*=============================================
	MOSTRAR DATOS CORREO
	=============================================*/

	static public function ctrMostrarCorreo(){


		$respuesta = ModeloCorreo::mdlMostrarCorreo();

		return $respuesta;
	}

	/*=============================================
	EDITAR CORREO EMPRESA 
	=============================================*/

	static public function ctrEditarCorreo(){

				

		if(isset($_POST["editarCorreoSaliente"])){
				$datos = array("correoSaliente" => $_POST["editarCorreoSaliente"],
							   "host" => $_POST["editarHost"],
							   "SMTPDebug" => $_POST["editarSMTPDebug"],
							   "SMTPAuth" => $_POST["editarSMTPAuth"],
							   "Puerto" => $_POST["editarPuerto"],
							   "SMTPSeguridad" => $_POST["editarSMTPSeguridad"],
							   "clave" => $_POST["nuevoPassword"]);

				$respuesta = ModeloCorreo::mdlEditarCorreo( $datos);


				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "Los datos han sido modicados correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "configurarCorreo";

									}
								})

					</script>';

				}


		

	}
	}
}
	


