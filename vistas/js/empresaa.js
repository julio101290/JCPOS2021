
/*=============================================
EDITAR EMPRESA
=============================================*/
$(".tablas").on("click", ".btnEditarEmpresa", function(){

	var idEmpresa = $(this).attr("idEmpresa");

  console.log("idEmpresa",idEmpresa);

	var datos = new FormData();
    datos.append("idEmpresa", idEmpresa);

    $.ajax({

      url:"ajax/empresa.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){


      	 
         $("#editarNombreEmpresa").val(respuesta[0]["NombreEmpresa"]);
	       $("#editarDireccionEmpresa").val(respuesta[0]["DireccionEmpresa"]);
	       $("#editarRFC").val(respuesta[0]["RFC"]);
	       $("#editarTelefonoEmpresa").val(respuesta[0]["Telefono"]);
	       $("#editarCorreoElectronicoEmpresa").val(respuesta[0]["correoElectronico"]);
         $("#editarDiasEntrega").val(respuesta[0]["diasEntrega"]);
         
	  }

  	})

})

