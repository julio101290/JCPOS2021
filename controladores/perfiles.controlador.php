<?php

class ControladorPerfiles{


	/*=============================================
	REGISTRO DE PERFILES
	=============================================*/

	static public function ctrCrearPerfil(){
		echo $_POST["nuevoDescripcionPerfil"];
		if(isset($_POST["nuevoDescripcionPerfil"])){




			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoDescripcionPerfil"])
			   ){

				$tabla = "perfiles";




				$datos = array("descripcion" => $_POST["nuevoDescripcionPerfil"]


							   ,"menuConfiguraciones" => $_POST["mConfiguraciones"]
							   ,"datosEmpresa" => $_POST["smDatosEmpresa"]
							   ,"usuarios" => $_POST["smUsuarios"]
							   ,"perfiles" => $_POST["smPerfiles"]
							   ,"configuracionCorreo" => $_POST["smConfiguracionCorreo"]

							   ,"clientes" => $_POST["smClientes"]
							   ,"productos" => $_POST["smProductos"]
							   ,"categorias" => $_POST["smCategorias"]

   							   ,"menuCotizaciones" => $_POST["mCotizaciones"]
   							   ,"cotizaciones" => $_POST["smCotizaciones"]
							   ,"administrarCotizaciones" => $_POST["smAdministraCotizaciones"]
							   ,"modificarCotizaciones" => $_POST["smModificarCotizaciones"]
							   ,"eliminarCotizaciones" => $_POST["smEliminarCotizaciones"]

  							   ,"menuVentas" => $_POST["mVentas"]
   							   ,"ventas" => $_POST["smVentas"]
							   ,"administrarVentas" => $_POST["smAdministraVentas"]
							   ,"modificarVentas" => $_POST["smModificarVentas"]
							   ,"eliminarVentas" => $_POST["smEliminarVentas"]
   							   ,"facturacionElectronica" => $_POST["smFacturacionElectronica"]
							   ,"reportesVentas" => $_POST["smReportesVentas"]

   							   ,"cajasSuperiores" => $_POST["CajasSuperiores"]
							   ,"graficoGanancias" => $_POST["GraficoGanancias"]
   							   ,"productosMasVendidos" => $_POST["ProductosMasVendidos"]
   							   ,"bitacora" => $_POST["smBitacora"]
							   ,"productosAgregadosRecientemente" => $_POST["ProductosAgregadosRecienteMente"]


   							   ,"pagos" => $_POST["smPagos"]
							   ,"historicoPagos" => $_POST["smHistoricoPagos"]
   							   ,"imprimirPagos" => $_POST["smImprimirPagos"]
							   ,"eliminarPagos" => $_POST["smEliminarPagos"]

							   ,"costoProductos" => $_POST["smCostoProductos"]
							   ,"stock" => $_POST["stock"]
                 ,"actualizar" => $_POST["actualizar"]
								 ,"cajas" => $_POST["cajas"]
							);



				$respuesta = ModeloPerfiles::mdlIngresarPerfil($tabla, $datos);

				if($respuesta == "ok"){

					echo '<script>

					swal({

						type: "success",
						title: "¡El perfil ha sido guardado correctamente!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "perfiles";

						}

					});


					</script>';


				}


			}else{

				echo '<script>

					swal({

						type: "error",
						title: "¡La discrición del perfil no puede ir vacío o llevar caracteres especiales!",
						showConfirmButton: true,
						confirmButtonText: "Cerrar"

					}).then(function(result){

						if(result.value){

							window.location = "perfiles";

						}

					});


				</script>';

			}


		}


	}

	/*=============================================
	MOSTRAR PERFILES
	=============================================*/

	static public function ctrMostrarPerfiles($item, $valor){

		$tabla = "perfiles";

		$respuesta = ModeloPerfiles::mdlMostrarPerfiles($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function ctrEditarPerfil(){

		if(isset($_POST["idPerfil"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["idPerfil"])){


				$tabla = "perfiles";

				$datos = array("perfil" => $_POST["idPerfil"]
							   ,"descripcion" => $_POST["editarDescripcion"]

							   ,"menuConfiguraciones" => $_POST["editarmConfiguraciones"]
							   ,"datosEmpresa" => $_POST["editarsmDatosEmpresa"]
							   ,"usuarios" => $_POST["editarsmUsuarios"]
							   ,"perfiles" => $_POST["editarsmPerfiles"]
							   ,"configuracionCorreo" => $_POST["editarsmConfiguracionCorreo"]

   							   ,"clientes" => $_POST["editarsmClientes"]
							   ,"productos" => $_POST["editarsmProductos"]
							   ,"categorias" => $_POST["editarsmCategorias"]

							   ,"menuCotizaciones" => $_POST["editarmCotizaciones"]
  							   ,"cotizaciones" => $_POST["editarsmCotizaciones"]
							   ,"administrarCotizaciones" => $_POST["editarsmAdministraCotizaciones"]
							   ,"modificarCotizaciones" => $_POST["editarsmModificarCotizaciones"]
							   ,"eliminarCotizaciones" => $_POST["editarsmEliminarCotizaciones"]



  							   ,"menuVentas" => $_POST["editarmVentas"]
   							   ,"ventas" => $_POST["editarsmVentas"]
							   ,"administrarVentas" => $_POST["editarsmAdministraVentas"]
							   ,"modificarVentas" => $_POST["editarsmModificarVentas"]
							   ,"eliminarVentas" => $_POST["editarsmEliminarVentas"]
   							   ,"facturacionElectronica" => $_POST["editarsFacturacionElectronica"]
							   ,"reportesVentas" => $_POST["editarsmReportesVentas"]

							   ,"cajasSuperiores" => $_POST["editarCajasSuperiores"]
							   ,"graficoGanancias" => $_POST["editarGraficoGanancias"]
   							   ,"productosMasVendidos" => $_POST["editarProductosMasVendidos"]
							   ,"productosAgregadosRecientemente" => $_POST["editarroductosAgregadosRecienteMente"]
							   ,"bitacora" => $_POST["editarsmBitacora"]

  							   ,"pagos" => $_POST["smEditarPagos"]
							   ,"historicoPagos" => $_POST["smEditarHistoricoPagos"]
   							   ,"imprimirPagos" => $_POST["smEditarImprimirPagos"]
							   ,"eliminarPagos" => $_POST["smEditarEliminarPagos"]

							   ,"costoProductos" => $_POST["editarsmCostoProductos"]
							   ,"stock" => $_POST["editarStock"]
                 ,"actualizar" => $_POST["editarActualizar"]
								 ,"cajas" => $_POST["editarCajas"]


								);

				$respuesta = ModeloPerfiles::mdlEditarPerfil($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "El perfil ha sido editado correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result) {
									if (result.value) {

									window.location = "perfiles";

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

							window.location = "perfiles";

							}
						})

			  	</script>';

			}

		}

	}

	/*=============================================
	BORRAR PERFIL
	=============================================*/

	static public function ctrBorrarPerfil(){

		if(isset($_GET["idPerfil"]) && isset($_GET["eliminar"])){

			$tabla ="perfiles";
			$datos = $_GET["idPerfil"];



			$respuesta = ModeloPerfiles::mdlBorrarPerfil($tabla, $datos);

			if($respuesta == "ok"){

				echo'<script>

				swal({
					  type: "success",
					  title: "El Perfil ha sido borrado correctamente",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar",
					  closeOnConfirm: false
					  }).then(function(result) {
								if (result.value) {

								window.location = "perfiles";

								}
							})

				</script>';

			}

		}

	}


}
