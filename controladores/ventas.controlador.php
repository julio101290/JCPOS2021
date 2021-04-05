<?php

class ControladorVentas {
    /* =============================================
      MOSTRAR ULTIMO FOLIO
      ============================================= */

    static public function ctrMostrarUltimoFolio($tipoVenta) {

        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlMostrarUltimoFolio($tipoVenta);

        return $respuesta;
    }

    /* =============================================
      TRAE COTIZACIÓN
      ============================================= */

    static public function ctrTraerCotizacion($cotizacion) {


        $respuesta = ModeloVentas::mdlMostrarCotizacion($cotizacion);

        return $respuesta;
    }

    /* =============================================
      MOSTRAR VENTAS
      ============================================= */

    static public function ctrMostrarVentas($item, $valor) {

        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

        return $respuesta;
    }

    /* =============================================
      CREAR VENTA
      ============================================= */

    static public function ctrCrearVenta() {


        $contadorProducto = 0;

        if (isset($_POST["nuevaVenta"])) {




            /* =============================================
              ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
              ============================================= */

            if ($_POST["listaProductos"] == "") {

                echo'<script>

				swal({
					  type: "error",
					  title: "La venta no se ha ejecuta si no hay productos",
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




            $listaProductos = json_decode($_POST["listaProductos"], true);

            $totalProductosComprados = array();


            foreach ($listaProductos as $key => $value) {


                $contadorProducto = $contadorProducto + 1;
                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                //ACTUALIZA STOCK
                $item1b = "stock";
                $valor1b = $traerProducto["stock"] - $value["cantidad"];


                //VALIDA CUANDO VALOR1B SEA 0 Y EL TIPO DE VENTA SEA B
                if ($valor1b < 0 && $_POST["TipoVenta"] == "VEN") {
                    echo'<script>

						swal({
							  type: "error",
							  title: "La cantidad que se quiere vender es superior al stock",
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
            }

            if ($contadorProducto == 0) {

                echo'<script>

				swal({
					  type: "error",
					  title: "La venta no se ha ejecuta si no hay productos",
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


            foreach ($listaProductos as $key => $value) {


                if ($_POST["TipoVenta"] == "VEN") {
                    array_push($totalProductosComprados, $value["cantidad"]);

                    $tablaProductos = "productos";

                    $item = "id";
                    $valor = $value["id"];
                    $orden = "id";

                    $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                    $item1a = "ventas";
                    $valor1a = $value["cantidad"] + $traerProducto["ventas"];

                    //ACTUALIZA LAS VENTAS
                    $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);


                    //ACTUALIZA STOCK
                    $item1b = "stock";
                    $valor1b = $traerProducto["stock"] - $value["cantidad"];


                    if ($valor1b < 0) {
                        echo'<script>

							swal({
								  type: "error",
								  title: "La cantidad que se quiere vender es superior al stock",
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

                    $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
                }
            }

            $tablaClientes = "clientes";

            $item = "id";
            $valor = $_POST["seleccionarCliente"];

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

            $item1a = "compras";

            $valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valor);

            $item1b = "ultima_compra";



            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $valor1b = $fecha . ' ' . $hora;

            $fechaCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1b, $valor1b, $valor);

            /* =============================================
              GUARDAR LA COMPRA
              ============================================= */

            $tabla = "ventas";

            $datos = array("id_vendedor" => $_POST["idVendedor"],
                "id_cliente" => $_POST["seleccionarCliente"],
                "codigo" => $_POST["nuevaVenta"],
                "productos" => $_POST["listaProductos"],
                "impuesto" => $_POST["nuevoPrecioImpuesto"],
                "fecha" => $_POST["fecha"],
                "neto" => $_POST["nuevoPrecioNeto"],
                "total" => $_POST["totalVenta"],
                "tipoVenta" => $_POST["TipoVenta"],
                "FechaVencimiento" => ($_POST["FechaVencimiento"]),
                "fecha" => ($_POST["fecha"]),
                "Observaciones" => $_POST["Observaciones"],
                "CotizarA" => $_POST["cotizarA"],
                "plazoEntrega" => $_POST["plazoEntrega"],
                "codigoVenta" => esCero($_POST["origenCotizacion"]),
                "UUID" => $_POST["UUID"],
                "metodo_pago" => $_POST["listaMetodoPago"]);

            $respuesta = ModeloVentas::mdlIngresarVenta($tabla, $datos);

            //REGISTRO EN BITACORA

            $datosBitacora["descripcion"] = "SE GUARDO LA VENTA: " . $_POST["nuevaVenta"];
            $datosBitacora["usuario"] = $_SESSION["usuario"];


            $respuestaBitacora = ModeloBitacora::mdlIngresarBitacora("bitacora", $datosBitacora);

            if ($respuesta == "ok") {


                // HACEMOS EL REGISTRO DE LO QUE PAGO EL CLIENTE
                $tabla = "pagos";



                //ASIGNAMOS EL VALOR A LA VARIABLES
                $importePagado = $_POST["nuevoValorEfectivo"];
                $importeTotalVenta = $_POST["totalVenta"];

                $fechaPago = $_POST["fechaPago"];
                $metodoPago = $_POST["nuevoMetodoPago"];


                //LE ASIGNAMOS EL IMPORTE DEVUELTO SI ES QUE LO QUE PAGO EL CLIENTE ES MAYOR AL IMPORTE DE LA VENTA
                if ($importePagado > $importeTotalVenta) {
                    $importeDevuelto = $importePagado - $importeTotalVenta;
                } else {
                    $importeDevuelto = 0;
                }



                $datosPagos = array("idVenta" => $_POST["nuevaVenta"],
                    "importePagado" => $importePagado,
                    "importeDevuelto" => $importeDevuelto,
                    "fechaPago" => $fechaPago,
                    "tipoPago" => $metodoPago,
                );

                $respuestaPago = ModeloPagos::mdlIngresarPago("pagos", $datosPagos);


                //REGISTRO EN BITACORA

                $datosBitacora["descripcion"] = "SE GUARDO EL PAGO CON VENTA: " . $_POST["nuevaVenta"] .
                        " IMPORTE PAGADO:" . $importePagado .
                        " ImporteDevuelto" . $importeDevuelto .
                        " Tipo de Pago" . $metodoPago
                ;

                $datosBitacora["usuario"] = $_SESSION["usuario"];


                $respuestaBitacora = ModeloBitacora::mdlIngresarBitacora("bitacora", $datosBitacora);

                // $impresora = "epson20";
                // $conector = new WindowsPrintConnector($impresora);
                // $imprimir = new Printer($conector);
                // $imprimir -> text("Hola Mundo"."\n");
                // $imprimir -> cut();
                // $imprimir -> close();
                /*
                  $impresora = "epson20";

                  $conector = new WindowsPrintConnector($impresora);

                  $printer = new Printer($conector);

                  $printer -> setJustification(Printer::JUSTIFY_CENTER);

                  $printer -> text(date("Y-m-d H:i:s")."\n");//Fecha de la factura

                  $printer -> feed(1); //Alimentamos el papel 1 vez

                  $printer -> text("Inventory System"."\n");//Nombre de la empresa

                  $printer -> text("NIT: 71.759.963-9"."\n");//Nit de la empresa

                  $printer -> text("Dirección: Calle 44B 92-11"."\n");//Dirección de la empresa

                  $printer -> text("Teléfono: 300 786 52 49"."\n");//Teléfono de la empresa

                  $printer -> text("FACTURA N.".$_POST["nuevaVenta"]."\n");//Número de factura

                  $printer -> feed(1); //Alimentamos el papel 1 vez

                  $printer -> text("Cliente: ".$traerCliente["nombre"]."\n");//Nombre del cliente

                  $tablaVendedor = "usuarios";
                  $item = "id";
                  $valor = $_POST["idVendedor"];

                  $traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

                  $printer -> text("Vendedor: ".$traerVendedor["nombre"]."\n");//Nombre del vendedor

                  $printer -> feed(1); //Alimentamos el papel 1 vez

                  foreach ($listaProductos as $key => $value) {

                  $printer->setJustification(Printer::JUSTIFY_LEFT);

                  $printer->text($value["descripcion"]."\n");//Nombre del producto

                  $printer->setJustification(Printer::JUSTIFY_RIGHT);

                  $printer->text("$ ".number_format($value["precio"],2)." Und x ".$value["cantidad"]." = $ ".number_format($value["total"],2)."\n");

                  }

                  $printer -> feed(1); //Alimentamos el papel 1 vez

                  $printer->text("NETO: $ ".number_format($_POST["nuevoPrecioNeto"],2)."\n"); //ahora va el neto

                  $printer->text("IMPUESTO: $ ".number_format($_POST["nuevoPrecioImpuesto"],2)."\n"); //ahora va el impuesto

                  $printer->text("--------\n");

                  $printer->text("TOTAL: $ ".number_format($_POST["totalVenta"],2)."\n"); //ahora va el total

                  $printer -> feed(1); //Alimentamos el papel 1 vez*

                  $printer->text("Muchas gracias por su compra"); //Podemos poner también un pie de página

                  $printer -> feed(3); //Alimentamos el papel 3 veces*

                  $printer -> cut(); //Cortamos el papel, si la impresora tiene la opción

                  $printer -> pulse(); //Por medio de la impresora mandamos un pulso, es útil cuando hay cajón moneder

                  $printer -> close();

                 */

                if ($_POST["TipoVenta"] == "COT") {
                    $tipoVenta = "administrarcotizaciones";
                    $strMensaje = "La cotizacion ha sido guardada correctamente";
                    $strReporte = "cotizacion";
                    $strReporte = '"extensiones/tcpdf/pdf/cotizacion.php"';
                    $strReporte2 = '"extensiones/tcpdf/pdf/cotizacion.php?codigo=' . $_POST["nuevaVenta"] . '" , "_blank"';
                }

                if ($_POST["TipoVenta"] == "VEN") {
                    $tipoVenta = "ventas";
                    $strMensaje = "La venta ha sido guardada correctamente";
                    $strReporte = '"extensiones/tcpdf/pdf/factura.php"';
                    $strReporte2 = '"extensiones/tcpdf/pdf/factura.php?codigo=' . $_POST["nuevaVenta"] . '" , "_blank"';
                }

                echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "' . $strMensaje . '",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "' . $tipoVenta . '";

								}
							})

				</script>';
            } else {

                echo'<script>

				localStorage.removeItem("rango");

				swal({
					  type: "error",
					  title: "' . $respuesta . '",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {

								window.location = "' . $tipoVenta . '";

								}
							})

				</script>';
            }
        }
    }

    /* =============================================
      EDITAR VENTA
      ============================================= */

    static public function ctrEditarVenta() {

        if (isset($_POST["editarVenta"])) {

            /* =============================================
              FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
              ============================================= */
            $tabla = "ventas";

            $item = "codigo";
            $valor = $_POST["editarVenta"];

            $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

            /* =============================================
              REVISAR SI VIENE PRODUCTOS EDITADOS
              ============================================= */

            if ($_POST["listaProductos"] == "") {

                $listaProductos = $traerVenta["productos"];
                $cambioProducto = false;
            } else {

                $listaProductos = $_POST["listaProductos"];
                $cambioProducto = true;
            }

            if ($cambioProducto) {

                $productos = json_decode($traerVenta["productos"], true);

                $totalProductosComprados = array();

                if ($_POST["TipoVenta"] == "VEN") {

                    foreach ($productos as $key => $value) {

                        array_push($totalProductosComprados, $value["cantidad"]);

                        $tablaProductos = "productos";

                        $item = "id";
                        $valor = $value["id"];
                        $orden = "id";

                        $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                        $item1a = "ventas";
                        $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                        $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                        $item1b = "stock";
                        $valor1b = $value["cantidad"] + $traerProducto["stock"];

                        $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
                    }



                    $tablaClientes = "clientes";

                    $itemCliente = "id";
                    $valorCliente = $_POST["seleccionarCliente"];

                    $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

                    $item1a = "compras";
                    $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

                    /* =============================================
                      ACTUALIZAR LAS COMPRAS DEL CLIENTE Y REDUCIR EL STOCK Y AUMENTAR LAS VENTAS DE LOS PRODUCTOS
                      ============================================= */

                    $listaProductos_2 = json_decode($listaProductos, true);

                    $totalProductosComprados_2 = array();

                    foreach ($listaProductos_2 as $key => $value) {

                        array_push($totalProductosComprados_2, $value["cantidad"]);

                        $tablaProductos_2 = "productos";

                        $item_2 = "id";
                        $valor_2 = $value["id"];
                        $orden = "id";

                        $traerProducto_2 = ModeloProductos::mdlMostrarProductos($tablaProductos_2, $item_2, $valor_2, $orden);

                        $item1a_2 = "ventas";
                        $valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];

                        $nuevasVentas_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);

                        $item1b_2 = "stock";
                        $valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

                        $nuevoStock_2 = ModeloProductos::mdlActualizarProducto($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);
                    }

                    $tablaClientes_2 = "clientes";

                    $item_2 = "id";
                    $valor_2 = $_POST["seleccionarCliente"];

                    $traerCliente_2 = ModeloClientes::mdlMostrarClientes($tablaClientes_2, $item_2, $valor_2);

                    $item1a_2 = "compras";

                    $valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];

                    $comprasCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2);

                    $item1b_2 = "ultima_compra";

                    date_default_timezone_set('America/Bogota');

                    $fecha = date('Y-m-d');
                    $hora = date('H:i:s');
                    $valor1b_2 = $fecha . ' ' . $hora;

                    $fechaCliente_2 = ModeloClientes::mdlActualizarCliente($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2);
                }
            }

            /* =============================================
              GUARDAR CAMBIOS DE LA COMPRA
              ============================================= */

            $datos = array("id_vendedor" => $_POST["idVendedor"],
                "id_cliente" => $_POST["seleccionarCliente"],
                "codigo" => $_POST["editarVenta"],
                "productos" => $listaProductos,
                "impuesto" => $_POST["nuevoPrecioImpuesto"],
                "neto" => $_POST["nuevoPrecioNeto"],
                "total" => $_POST["totalVenta"],
                "FechaVencimiento" => ($_POST["FechaVencimiento"]),
                "tipoVenta" => $_POST["TipoVenta"],
                "Observaciones" => $_POST["Observaciones"],
                "CotizarA" => $_POST["cotizarA"],
                "id" => $_POST["idVenta"],
                "plazoEntrega" => $_POST["plazoEntrega"],
                "metodo_pago" => $_POST["listaMetodoPago"]);


            $respuesta = ModeloVentas::mdlEditarVenta($tabla, $datos);

            if ($respuesta == "ok") {

                //REGISTRO EN BITACORA

                $datosBitacora["descripcion"] = "SE EDITO LA VENTA: " . $_POST["editarVenta"];

                $datosBitacora["usuario"] = $_SESSION["usuario"];
                $respuestaBitacora = ModeloBitacora::mdlIngresarBitacora("bitacora", $datosBitacora);

                if ($_POST["TipoVenta"] == "COT") {
                    $tipoVenta = "administrarcotizaciones";
                    $strMensaje = "La cotizacion ha sido guardada correctamente";
                }

                if ($_POST["TipoVenta"] == "VEN") {
                    $tipoVenta = "ventas";
                    $strMensaje = "La venta ha sido guardada correctamente";
                }


                echo'<script>


				localStorage.removeItem("rango");

				swal({
					  type: "success",
					  title: "' . $strMensaje . '",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
								
								window.location = "' . $tipoVenta . '";

								}
							})

				</script>';
            } else {

                echo'<script>


			

				swal({
					  type: "error",
					  title: "' . $respuesta . '",
					  showConfirmButton: true,
					  confirmButtonText: "Cerrar"
					  }).then(function(result){
								if (result.value) {
								
								window.location = "' . $tipoVenta . '";

								}
							})

				</script>';
            }
        }
    }

    /* =============================================
      ELIMINAR VENTA
      ============================================= */

    static public function ctrEliminarVenta() {

        if (isset($_GET["idVenta"])) {

            $tabla = "ventas";

            $item = "id";
            $valor = $_GET["idVenta"];

            $traerVenta = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);


            /* =============================================
              TRAER LOS PAGOS DE ESA VENTA
              ============================================= */
            $idVenta["idVenta"] = $traerVenta["codigo"];
            $traerPago = ModeloPagos::mdlMostrarPagos("pagos", $idVenta);

            if($traerVenta["tipo_venta"]=="VEN"){
                foreach ($traerPago as $key => $value) {

                    echo'<script>

                                            swal({
                                                      type: "error",
                                                      title: "No se puede borrar la venta ya que tiene pagos abonados",
                                                      showConfirmButton: true,
                                                      confirmButtonText: "Cerrar"
                                                      }).then(function(result){
                                                                            if (result.value) {

                                                                            window.location = "ventas";

                                                                            }
                                                                    })

                                            </script>';
                    return 0;
                }

            }
            /* =============================================
              ACTUALIZAR FECHA ÚLTIMA COMPRA
              ============================================= */

            $tablaClientes = "clientes";

            $itemVentas = null;
            $valorVentas = null;

            $traerVentas = ModeloVentas::mdlMostrarVentas($tabla, $itemVentas, $valorVentas);

            $guardarFechas = array();

            foreach ($traerVentas as $key => $value) {

                if ($value["id_cliente"] == $traerVenta["id_cliente"]) {

                    array_push($guardarFechas, $value["fecha"]);
                }
            }

            if (count($guardarFechas) > 1) {

                if ($traerVenta["fecha"] > $guardarFechas[count($guardarFechas) - 2]) {

                    $item = "ultima_compra";
                    $valor = $guardarFechas[count($guardarFechas) - 2];
                    $valorIdCliente = $traerVenta["id_cliente"];

                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
                } else {

                    $item = "ultima_compra";
                    $valor = $guardarFechas[count($guardarFechas) - 1];
                    $valorIdCliente = $traerVenta["id_cliente"];

                    $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
                }
            } else {

                $item = "ultima_compra";
                $valor = "0000-00-00 00:00:00";
                $valorIdCliente = $traerVenta["id_cliente"];

                $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item, $valor, $valorIdCliente);
            }

            /* =============================================
              FORMATEAR TABLA DE PRODUCTOS Y LA DE CLIENTES
              ============================================= */

            $productos = json_decode($traerVenta["productos"], true);

            $totalProductosComprados = array();

            foreach ($productos as $key => $value) {

                array_push($totalProductosComprados, $value["cantidad"]);

                $tablaProductos = "productos";

                $item = "id";
                $valor = $value["id"];
                $orden = "id";

                $traerProducto = ModeloProductos::mdlMostrarProductos($tablaProductos, $item, $valor, $orden);

                $item1a = "ventas";
                $valor1a = $traerProducto["ventas"] - $value["cantidad"];

                $nuevasVentas = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1a, $valor1a, $valor);

                $item1b = "stock";
                $valor1b = $value["cantidad"] + $traerProducto["stock"];

                $nuevoStock = ModeloProductos::mdlActualizarProducto($tablaProductos, $item1b, $valor1b, $valor);
            }

            $tablaClientes = "clientes";

            $itemCliente = "id";
            $valorCliente = $traerVenta["id_cliente"];

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $itemCliente, $valorCliente);

            $item1a = "compras";
            $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);

            $comprasCliente = ModeloClientes::mdlActualizarCliente($tablaClientes, $item1a, $valor1a, $valorCliente);

            /* =============================================
              ELIMINAR VENTA
              ============================================= */

            $respuesta = ModeloVentas::mdlEliminarVenta($tabla, $_GET["idVenta"]);

            //DATOS PARA LA BITACORA
            $datosBitacora["descripcion"] = "SE ELIMINO LA VENTA: " . $_GET["idVenta"];
            $datosBitacora["usuario"] = $_SESSION["usuario"];


            $respuestaBitacora = ModeloBitacora::mdlIngresarBitacora("bitacora", $datosBitacora);


            if ($respuesta == "ok") {


                if ($traerVenta["tipo_venta"] == "COT") {

                    echo'<script>

					swal({
						  type: "success",
						  title: "La cotizacion ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "administrarcotizaciones";

									}
								})

					</script>';
                } else {

                    echo'<script>

					swal({
						  type: "success",
						  title: "La venta ha sido borrada correctamente",
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

    /* =============================================
      RANGO FECHAS
      ============================================= */

    static public function ctrRangoFechasVentas($fechaInicial
            , $fechaFinal
            , $tipoDocumento
            , $soloPendientePorCobrar = "s"
            , $soloCobrado = "n"
            , $cliente = "n"
            , $filtros = "n"
            , $busqueda = ""
   
    ) {

        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlRangoFechasVentas($tabla
                        , $fechaInicial
                        , $fechaFinal
                        , $tipoDocumento
                        , $soloPendientePorCobrar
                        , $soloCobrado
                        , $cliente
                        , $filtros
                        , $busqueda 
        );

        return $respuesta;
    }

    /* =============================================
      RANGO FECHAS PRODUCTO
      ============================================= */

    static public function ctrRangoFechasVentasProducto($fechaInicial
            , $fechaFinal
            , $tipoDocumento
            , $soloPendientePorCobrar = "s"
            , $soloCobrado = "n"
            , $cliente = "n"
    ) {

        $tabla = "vw_vista_productos";

        $respuesta = ModeloVentas::mdlRangoFechasVentasProducto($tabla
                        , $fechaInicial
                        , $fechaFinal
                        , $tipoDocumento
                        , $soloPendientePorCobrar
                        , $soloCobrado
                        , $cliente
        );

        return $respuesta;
    }

    /* =============================================
      DESCARGAR EXCEL
      ============================================= */

    public function ctrDescargarReporte() {

        if (isset($_GET["reporte"])) {

            $tabla = "ventas";

            if (isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])) {

                $ventas = ModeloVentas::mdlRangoFechasVentas($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"], "VEN");
            } else {

                $item = null;
                $valor = null;

                $ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);
            }


            /* =============================================
              CREAMOS EL ARCHIVO DE EXCEL
              ============================================= */

            $Name = $_GET["reporte"] . '.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $Name . '"');
            header("Content-Transfer-Encoding: binary");

            echo utf8_decode("<table border='0'> 

					<tr> 
					<td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
					<td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
					<td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
					<td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
					<td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
					<td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
					<td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
					<td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
					<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
					</tr>");

            foreach ($ventas as $row => $item) {

                $cliente = ControladorClientes::ctrMostrarClientes("id", $item["id_cliente"]);
                $vendedor = ControladorUsuarios::ctrMostrarUsuarios("id", $item["id_vendedor"]);

                echo utf8_decode("<tr>
			 			<td style='border:1px solid #eee;'>" . $item["codigo"] . "</td> 
			 			<td style='border:1px solid #eee;'>" . $cliente["nombre"] . "</td>
			 			<td style='border:1px solid #eee;'>" . $vendedor["nombre"] . "</td>
			 			<td style='border:1px solid #eee;'>");

                $productos = json_decode($item["productos"], true);

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["cantidad"] . "<br>");
                }

                echo utf8_decode("</td><td style='border:1px solid #eee;'>");

                foreach ($productos as $key => $valueProductos) {

                    echo utf8_decode($valueProductos["descripcion"] . "<br>");
                }

                echo utf8_decode("</td>
					<td style='border:1px solid #eee;'>$ " . number_format($item["impuesto"], 2) . "</td>
					<td style='border:1px solid #eee;'>$ " . number_format($item["neto"], 2) . "</td>	
					<td style='border:1px solid #eee;'>$ " . number_format($item["total"], 2) . "</td>
					<td style='border:1px solid #eee;'>" . $item["metodo_pago"] . "</td>
					<td style='border:1px solid #eee;'>" . substr($item["fecha"], 0, 10) . "</td>		
		 			</tr>");
            }


            echo "</table>";
        }
    }

    /* =============================================
      SUMA TOTAL VENTAS
      ============================================= */

    static public function ctrSumaTotalVentas() {

        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlSumaTotalVentas($tabla);

        return $respuesta;
    }

    /* =============================================
      SUMA TOTAL PAGOS
      ============================================= */

    public function ctrSumaTotalPagos() {

        $tabla = "ventas";

        $respuesta = ModeloVentas::mdlSumaTotalPagos($tabla);

        return $respuesta;
    }

    /* =============================================
      DESCARGAR XML
      ============================================= */

    static public function ctrDescargarXML() {

        if (isset($_GET["xml"])) {


            $tabla = "ventas";
            $item = "codigo";
            $valor = $_GET["xml"];

            $ventas = ModeloVentas::mdlMostrarVentas($tabla, $item, $valor);

            // PRODUCTOS

            $listaProductos = json_decode($ventas["productos"], true);

            // CLIENTE

            $tablaClientes = "clientes";
            $item = "id";
            $valor = $ventas["id_cliente"];

            $traerCliente = ModeloClientes::mdlMostrarClientes($tablaClientes, $item, $valor);

            // VENDEDOR

            $tablaVendedor = "usuarios";
            $item = "id";
            $valor = $ventas["id_vendedor"];

            $traerVendedor = ModeloUsuarios::mdlMostrarUsuarios($tablaVendedor, $item, $valor);

            //http://php.net/manual/es/book.xmlwriter.php

            $objetoXML = new XMLWriter();

            $objetoXML->openURI("xml/" . $_GET["xml"] . ".xml"); //Creación del archivo XML

            $objetoXML->setIndent(true); //recibe un valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

            $objetoXML->setIndentString("\t"); // carácter \t, que corresponde a una tabulación

            $objetoXML->startDocument('1.0', 'utf-8'); // Inicio del documento
            // $objetoXML->startElement("etiquetaPrincipal");// Inicio del nodo raíz
            // $objetoXML->writeAttribute("atributoEtiquetaPPal", "valor atributo etiqueta PPal"); // Atributo etiqueta principal
            // 	$objetoXML->startElement("etiquetaInterna");// Inicio del nodo hijo
            // 		$objetoXML->writeAttribute("atributoEtiquetaInterna", "valor atributo etiqueta Interna"); // Atributo etiqueta interna
            // 		$objetoXML->text("Texto interno");// Inicio del nodo hijo
            // 	$objetoXML->endElement(); // Final del nodo hijo
            // $objetoXML->endElement(); // Final del nodo raíz


            $objetoXML->writeRaw('<fe:Invoice xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">');

            $objetoXML->writeRaw('<ext:UBLExtensions>');

            foreach ($listaProductos as $key => $value) {

                $objetoXML->text($value["descripcion"] . ", ");
            }



            $objetoXML->writeRaw('</ext:UBLExtensions>');

            $objetoXML->writeRaw('</fe:Invoice>');

            $objetoXML->endDocument(); // Final del documento

            return true;
        }
    }

}

if (isset($_POST["nuevaVenta"]) && $_POST["TipoVenta"] == "VEN") {
    session_start();
    require_once "../modelos/ventas.modelo.php";
    require_once "../modelos/productos.modelo.php";
    require_once "../modelos/clientes.modelo.php";
    require_once "../modelos/pagos.modelo.php";
    require_once "../controladores/utilerias.controlador.php";
    require_once "../modelos/bitacora.modelo.php";


    $guardarVenta = new ControladorVentas();
    $guardarVenta->ctrCrearVenta();
}


if (isset($_POST["leerLlave"])) {
    session_start();
    require_once "../modelos/ventas.modelo.php";

    //DATOS DE LA LLAVE
    $datos["codigo"] = $_POST["codigo"];
    $datos["tipo_venta"] = $_POST["tipo_venta"];

    //CRAR EL OBJETO DE MODELO VENTAS
    $leerLlave = new ModeloVentas();

    // LLAMAMOS LA FUNCION PARA LEER LA VENTA A TRAVEZ DE LA LLAVE
    $datosVenta = $leerLlave->mdlMostrarVentasLlave("ventas", $datos);

    echo json_encode($datosVenta);
}




if (isset($_POST["ConsecutivoVenta"])) {
    session_start();
    require_once "../modelos/ventas.modelo.php";



    // OBTENEMOS EL ULTIMO CONSECUTIVO
    $consecutivo = $traerConsecutivo->ctrMostrarUltimoFolio("VEN");

    echo json_encode($consecutivo);
}