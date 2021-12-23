$('.modal-dialog').draggable({
	 handle: ".modal-header"
 });

/*=============================================
SideBar Menu
=============================================*/

$('.sidebar-menu').tree()

/*=============================================
Inicializar Select2
=============================================*/
$('.select2').select2()

//Funcionamiento de Select2 para modal
$.fn.modal.Constructor.prototype.enforceFocus = function() {};


/*=============================================
Data Table
=============================================*/

$(".tablas").DataTable({

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

});

/*=============================================
 //iCheck for checkbox and radio inputs
=============================================*/

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-blue',
  radioClass   : 'iradio_minimal-blue'
})

/*=============================================
 //input Mask
=============================================*/

$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })

//MASCARA DATAPICKER
$.fn.datepicker.defaults.format = "yyyy/mm/dd"

//Money Euro
$('[data-mask]').inputmask()


//Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

$(document).ready(function(){
     $.fn.datepicker.defaults.language = 'es';
});

//PARA CERRARLO AUTOMATICAMENTE
$.fn.datepicker.defaults.autoclose = true;

/*=============================================
CORRECCIÓN BOTONERAS OCULTAS BACKEND
=============================================*/


$(document).ready(function(){
     $.fn.datepicker.defaults.language = 'es';
});

//PARA CERRARLO AUTOMATICAMENTE
$.fn.datepicker.defaults.autoclose = true;

if(window.matchMedia("(max-width:767px)").matches){

	$("body").removeClass('sidebar-collapse');

}else{

	$("body").addClass('sidebar-collapse');
}
