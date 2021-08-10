/*=============================================
CARGAR LA TABLA DINÁMICA DE VENTAS
=============================================*/

// $.ajax({

// 	url: "ajax/datatable-productos.ajax.php",
// 	success:function(respuesta){
		
// 		console.log("respuesta", respuesta);

// 	}

// })


var perfilOculto = $("#perfilOculto").val();
$('.tablaBodegas').DataTable( {
    "ajax": "ajax/datatable-bodegas.ajax.php",
    "deferRender": true,
	"retrieve": true,
	"processing": true,
	 "language": {

			"sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
			"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0",
			"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
			"sInfoPostFix":    "",
			"sSearch":         "Buscar:",
			"sUrl":            "",
			"sInfoThousands":  ",",
			"sLoadingRecords": "Cargando...",
			"oPaginate": {
			"sFirst":    "Primero",
			"sLast":     "Último",
			"sNext":     "Siguiente",
			"sPrevious": "Anterior"
			},
			"oAria": {
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}

	}

} );

/*=============================================
EDITAR BODEGAS
=============================================*/

$(".tablaBodegas tbody").on("click", "button.btnEditarBodega", function(){

  var idBodega = $(this).attr("idbodega");
  var traerBodegas = "ok";

	console.log(idBodega);
	var datos = new FormData();
  datos.append("idBodega", idBodega);
  datos.append("traerBodega",traerBodegas);

     $.ajax({

      url:"ajax/bodegas.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
            console.log(respuesta);

           $("#editarID").val(respuesta["id"]);
           $("#editarDescripcion").val(respuesta["descripcion"]);



      }

  })

})

/*=============================================
ELIMINAR PRODUCTO
=============================================*/

$(".tablaBodegas tbody").on("click", "button.btnEliminarBodega", function(){

	var idBodega = $(this).attr("idbodega");
	console.log(idBodega);
	
	swal({

		title: '¿Está seguro de borrar el bodega?',
		text: "¡Si no lo está puede cancelar la accíón!",
		type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar producto!'
        }).then(function(result) {
        if (result.value) {

        	window.location = "index.php?ruta=bodegas&idBodega="+idBodega+"&accion=eliminar";

        }


	})

})
	
