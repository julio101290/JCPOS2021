
/*=============================================
EDITAR EMPRESA
=============================================*/
$(".tablas").on("click", ".btnEditarCorreo", function(){

  console.log("prueba");

	var datos = new FormData();
  datos.append("idCorreo", "idCorreo");

    $.ajax({

      url:"ajax/correo.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){


      	 
         $("#editarCorreoSaliente").val(respuesta[0]["correoSaliente"]);
	       $("#editarHost").val(respuesta[0]["host"]);
	       $("#editarSMTPDebug").val(respuesta[0]["SMTPDebug"]);
	       $("#editarSMTPAuth").val(respuesta[0]["SMTPAuth"]);
	       $("#editarPuerto").val(respuesta[0]["Puerto"]);
         $("#nuevoPassword").val(respuesta[0]["clave"]);
         $("#editarSMTPSeguridad").val(respuesta[0]["SMTPSeguridad"]);

         console.log(respuesta);
         
	  }

  	})

})

