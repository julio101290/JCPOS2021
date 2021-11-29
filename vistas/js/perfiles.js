/*=============================================
EDITAR PERFIL
=============================================*/
$(".tablas").on("click", ".btnEditarPerfil", function(){

	var idPerfil= $(this).attr("idPerfil");



	var datos = new FormData();
	datos.append("idPerfil", idPerfil);

	console.log(idPerfil);

	$.ajax({

		url:"ajax/perfiles.ajax.php",
		method: "POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		dataType: "json",
		success: function(respuesta){


			$("#editarDescripcion").val(respuesta["descripcion"]);
			$("#idPerfil").val(respuesta["perfil"]);

			$('#editarmConfiguraciones').bootstrapToggle(respuesta["menuConfiguraciones"]);
			$('#editarsmDatosEmpresa').bootstrapToggle(respuesta["datosEmpresa"]);
			$('#editarsmUsuarios').bootstrapToggle(respuesta["usuarios"]);
			$('#editarsmPerfiles').bootstrapToggle(respuesta["perfiles"]);
			$('#editarsmConfiguracionCorreo').bootstrapToggle(respuesta["configuracionCorreo"]);
			$('#editarsmBitacora').bootstrapToggle(respuesta["bitacora"]);

			$('#editarsmClientes').bootstrapToggle(respuesta["clientes"]);
			$('#editarsmProductos').bootstrapToggle(respuesta["productos"]);
			$('#editarsmCategorias').bootstrapToggle(respuesta["categorias"]);

			$('#editarmCotizaciones').bootstrapToggle(respuesta["menuCotizaciones"]);
			$('#editarsmCotizaciones').bootstrapToggle(respuesta["cotizaciones"]);
			$('#editarsmAdministraCotizaciones').bootstrapToggle(respuesta["administrarCotizaciones"]);
			$('#editarsmModificarCotizaciones').bootstrapToggle(respuesta["modificarCotizaciones"]);
			$('#editarsmEliminarCotizaciones').bootstrapToggle(respuesta["eliminarCotizaciones"]);

			$('#editarmVentas').bootstrapToggle(respuesta["menuVentas"]);
			$('#editarsmVentas').bootstrapToggle(respuesta["ventas"]);
			$('#editarsmAdministraVentas').bootstrapToggle(respuesta["administrarVentas"]);
			$('#editarsmModificarVentas').bootstrapToggle(respuesta["modificarVentas"]);
			$('#editarsmEliminarVentas').bootstrapToggle(respuesta["eliminarVentas"]);
			$('#editarsFacturacionElectronica').bootstrapToggle(respuesta["facturacionElectronica"]);
			$('#editarsmReportesVentas').bootstrapToggle(respuesta["reportesVentas"]);

			$('#smEditarPagos').bootstrapToggle(respuesta["pagos"]);
			$('#smEditarHistoricoPagos').bootstrapToggle(respuesta["historicoPagos"]);
			$('#smEditarImprimirPagos').bootstrapToggle(respuesta["imprimirPagos"]);
			$('#smEditarEliminarPagos').bootstrapToggle(respuesta["eliminarPagos"]);

			$('#editarCajasSuperiores').bootstrapToggle(respuesta["cajasSuperiores"]);
			$('#editarGraficoGanancias').bootstrapToggle(respuesta["graficoGanancias"]);
			$('#editarProductosMasVendidos').bootstrapToggle(respuesta["productosMasVendidos"]);
			$('#editarroductosAgregadosRecienteMente').bootstrapToggle(respuesta["productosAgregadosRecientemente"]);

			$('#editarsmCostoProductos').bootstrapToggle(respuesta["costoProductos"]);

			$('#editarStock').bootstrapToggle(respuesta["stock"]);
      $('#editarActualizar').bootstrapToggle(respuesta["actualizar"]);
		  $('#editarCajas').bootstrapToggle(respuesta["cajas"]);



		}

	});

})



/*=============================================
ELIMINAR PERFIL
=============================================*/
$(".tablas").on("click", ".btnEliminarPerfil", function(){

  var idPerfil = $(this).attr("idPerfil");

  swal({
    title: '¿Está seguro de borrar el Perfil?',
    text: "¡Si no lo está puede cancelar la accíón!",
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, borrar perfil!'
  }).then(function(result){

    if(result.value){

      window.location = "index.php?ruta=perfiles&idPerfil="+idPerfil+"&eliminar=si";

    }

  })

})
