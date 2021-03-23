<?php

if($_SESSION["administrarVentas"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}



?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Reporte ventas por producto
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Reporte ventas por producto</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  


         <button type="button" class="btn btn-default pull-right" id="daterange-btn">
           
            <span>
              <i class="fa fa-calendar"></i> 

              <?php

                if(isset($_GET["fechaInicial"])){

                  echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];
                
                }else{
                 
                  echo 'Rango de fecha';

                }

              ?>
            </span>

            <i class="fa fa-caret-down"></i>

         </button>

      </div>
     
      <div hidden>
        <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000"  hidden>

        <input type="text" class="form-control input-lg" id="codigoVenta" name="codigoVenta" placeholder="00000"  hidden>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%" id="tablaVentas" name="tablaVentas" style="font-size: 10px">
         
        <thead>
         
         <tr>
           
          
           <th  width="15px">Código factura</th>
           <th  width="15px">Cliente</th>
           <th>Vendedor</th>
           <th>Forma de pago</th>
           <th>Producto</th>
           <th>Cant</th>
           <th>Precio Unitario</th>
           <th>Neto</th>
           <th>Total</th> 

           <th>Fecha</th>

         </tr> 

        </thead>

        <tbody>

        <?php


          if(isset($_GET["pendientePorCobrar"])){
            $pendientePorCobrar = $_GET["pendientePorCobrar"];
          }else{
            $pendientePorCobrar ="n";
          }
          
          if(isset($_GET["soloCobrado"])){

            $soloCobrado = $_GET["soloCobrado"];
          }else{
            $soloCobrado = "n";
          }


          if(isset($_GET["cliente"])){
            $cliente = $_GET["cliente"];
          }else{
            $cliente ="n";
          }


          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta = ControladorVentas::ctrRangoFechasVentasProducto($fechaInicial
                                                             , $fechaFinal
                                                             ,"VEN"
                                                             ,$pendientePorCobrar
                                                             ,$soloCobrado
                                                             ,$cliente );

          foreach ($respuesta as $key => $value) {
           $importeImpuesto=0;
           echo '<tr>



                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>';

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  
                  $importeImpuesto=(($value["totalProducto"]/$value["neto"])*$value["impuesto"])+$value["totalProducto"];

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  <td>'.$value["metodo_pago"].'</td>

                  <td>'.$value["descripcionProducto"].'</td>

                  <td>'.number_format($value["cantidadProducto"],2).'</td>

                  <td>'.number_format($value["precioProducto"],2).'</td>

                  <td>$ '.number_format($value["totalProducto"],2).'</td>

                  <td>$ '.( $importeImpuesto).'</td>

                  <td>'.$value["fecha"].'</td>

                

                </tr>';
            }

        ?>
               
        </tbody>
         <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th align="right"></th>
            <th align="right"></th>
            <th align="right"></th>
             <th align="right"></th>

          </tr>
         </tfoot>
       </table>

       <?php

      $eliminarVenta = new ControladorVentas();
      $eliminarVenta -> ctrEliminarVenta();

      ?>
       

      </div>

    </div>

  </section>

</div>




<!--=====================================
MODAL METODO DE PAGO
======================================-->

<div id="modalMetodoDePago" class="modal fade metodoPago"  role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Forma de Pago</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->
        <?php

          //FECHA ACTUAL
          $fechaActual =date("yy/m/d");

        ?>
        <div class="modal-body">

          <div class="box-body">

            <!--=====================================
                FECHA
                ======================================--> 
               <div class="form-group">
               <div class="input-group date" data-provide="datepicker"  data-date-format="yyyy/mm/dd">
                  
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" id="fechaPago" name="fechaPago" value="<?php echo $fechaActual; ?>"  placeholder="Fecha">

                </div>
                </div>


                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-4" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        
                        <option value="Efectivo">Efectivo</option>
                        <option value="Tarjeta De Credito">Tarjeta Crédito</option>
                        <option value="Tarjeta De Debito">Tarjeta Débito</option>    
                        <option value="Venta a Credito">Venta a Crédito</option>                 
                      </select>    

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary btnGuardarPagoAjax">Guardar Pago</button>

        </div>

        <?php

          $guardarPago = new ControladorPagos();
          $guardarPago-> ctrCrearPago();
          
        ?>


      </form>

       
    </div>

  </div>

</div>





<!--=====================================
MODAL HISTORICO DE PAGOS
======================================-->

<div id="modalHistoricoDePagos" class="modal fade historicoPagos"  role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Historico de pagos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">
          <!--=====================================
          CONTROLES
          ======================================-->

         <table class="table table-bordered table-striped dt-responsive tablaPagos" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">ID Pago</th>
           <th>Fecha de pago </th>
           <th>Metodo de Pago </th>
           <th>Importe Pagado</th>
           <th>Importe Devuelto</th>

           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <tr>
            <td>1</td>
            <td>9000</td>
            <td>1000</td>
            <td>1000</td>
            <td>1000</td>
            <td>

              <div class="btn-group">
                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>  

            </td>

          </tr>

          

        </tbody>

       </table>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary btnGuardarPagoAjax">Guardar Venta</button>

        </div>

        <?php

          $guardarPago = new ControladorPagos();
          $guardarPago-> ctrCrearPago();
          
        ?>


      </form>


      <?php

        $eliminarPago = new ControladorPagos();
        $eliminarPago -> ctrEliminarPago();

      ?>
       
    </div>

  </div>

</div>


<script type="text/javascript">
  
var restante=0;
var idVenta=0;
  /*=============================================
ABONAR PAGO
=============================================*/

$(".tablas").on("click", ".btnAbonar", function(){

  dblAbonado = $(this).attr("restante");
  idCodigo= $(this).attr("idCodigo");

  $('#nuevoTotalVenta').val(dblAbonado);
  $('#codigoVenta').val(idCodigo);
  $("#nuevoMetodoPago").trigger("change");


})



/*=============================================
GUARDAR PAGO AJAX
=============================================*/
$(".modal-footer").on("click", ".btnGuardarPagoAjax", function(){
  
  //MANDAMOS LOS DATOS A GUARDAR
  var codigoVenta= $("#codigoVenta").val();
  var nuevoValorEfectivo= $("#nuevoValorEfectivo").val();
  var nuevoCambioEfectivo= $("#nuevoCambioEfectivo").val();
  var nuevoTotalVenta= $("#nuevoTotalVenta").val();
  var nuevoFechaPago= $("#fechaPago").val();
  var nuevoTipoPago = $("#nuevoMetodoPago").val();



  console.log("nuevoCambioEfectivo:",nuevoCambioEfectivo);
  var datos = new FormData();

  datos.append("codigoVenta", codigoVenta);
  datos.append("nuevoValorEfectivo", nuevoValorEfectivo);
  datos.append("nuevoCambioEfectivo", nuevoCambioEfectivo);
  datos.append("nuevoTotalVenta", nuevoTotalVenta);
  datos.append("nuevoFechaPago", nuevoFechaPago);
  datos.append("nuevoTipoPago", nuevoTipoPago);


  $.ajax({

      url:"controladores/pagos.controlador.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success:function(respuesta){
       
          console.log(respuesta);
          if (respuesta.match(/correctamente.*/)){
              



            swal({
                type: "success",
                title: "El pago ha sido guardada correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                if (result.value) {

                  window.location = "ventas";

                }
            })
                  
          }else{
          swal({
              type: "error",
              title: "¡Error al guardar el pago!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {

                window.location = "ventas";

              }
            })
            
              
            }

        }

      }

      )





})


/*=============================================
 Manda LLamar Los historicos de venta
=============================================*/

$(".tablas").on("click", ".btnMostrarPagos", function(){

  var idVenta = $(this).attr("idCodigo");
  $('.tablaPagos').DataTable().destroy();
  cargaHistoricos(idVenta);

})


function cargaHistoricos(idVenta = '0',)
  {
   
   console.log("idVenta",idVenta);




   var dataTable = $('.tablaPagos').DataTable({


    "processing" : true,
    //"serverSide" : true,
    "deferRender": true,
    "retrieve": true,
    "pageLength": 25,
    "lengthMenu": [10 ,25 ,50, 100, 150, 200],

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

  },
    "ajax" : {
     url:"ajax/datatable-pagos.ajax.php",
     type:"POST",

     data:{
      codigo:idVenta
     }


    }

   });
  
 

  }

/*=============================================
IMPRIMIR PAGOS
=============================================*/

$(".tablaPagos").on("click", ".btnImprimirPago", function(){

  var idPago = $(this).attr("idPago");
  var codigo = $(this).attr("idVenta");

  console.log("IMPRIMIR PAGO:",idPago);

  window.open("extensiones/tcpdf/pdf/pago.php?idPago="+idPago+"&codigo="+codigo, "_blank");

})


/*=============================================
 ELIMINAR PAGOS
=============================================*/

$(".tablaPagos").on("click", ".btnEliminarPago", function(){

  var idPagoEliminar = $(this).attr("idPago");

  console.log("ELIMINAR PAGO:",idPagoEliminar);

   swal({
        title: '¿Está seguro de borrar el pago?',
        text: "¡Si no lo está puede cancelar la accíón!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, borrar el pago!'
      }).then(function(result){
        if (result.value) {
          
            window.location = "index.php?ruta=ventas&idPagoEliminar="+idPagoEliminar;
        }

  })

})




$(document).ready(function() {




    
    $('#tablaVentas thead tr').clone(true).appendTo( '#tablaVentas thead' );
   
    $('#tablaVentas thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).removeClass('sorting')
         $(this).removeClass('sorting_asc')


        if(title=="Acciones" || title=="Entregado"  ) {
          $(this).html( '<input type="hidden" placeholder="Buscar por '+title+'" />' );
        }else{
          $(this).html( '<input type="text" placeholder="Buscar por '+title+'" />' );
        }


    
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    
              
                   
                   .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var table = $('#tablaVentas').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        retrieve: true,
        paging: false,



    } );
    } );


$.fn.dataTable.ext.errMode = 'none';

 $('#tablaVentas').DataTable( {        
    language: 
            {
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
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
            },


        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total Ventas
            total = api
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                       // NETO
            pageNeto = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

     
 
            // Total over this page
            pageTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );



            // Total Producto
            totalProducto = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );




 
            // Update footer

            $( api.column( 4 ).footer() ).html(
                '<strong> TOTALES:</strong>'
            );

            $( api.column( 7 ).footer() ).html(
                '<strong> '+pageNeto.toFixed(2)+'</strong>'
            );


            $( api.column( 6 ).footer() ).html(
                '<strong> '+totalProducto.toFixed(2)+'</strong>'
            );



        }

    } );



/*=============================================
RANGO DE FECHAS
=============================================*/

$('#daterange-btn').daterangepicker(
  {
    ranges   : {
      'Hoy'       : [moment(), moment()],
      'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Últimos 7 días' : [moment().subtract(6, 'days'), moment()],
      'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
      'Este mes'  : [moment().startOf('month'), moment().endOf('month')],
      'Último mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    },
    startDate: moment(),
    endDate  : moment()
  },
  function (start, end) {
    $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));

    var fechaInicial = start.format('YYYY-MM-DD');

    var fechaFinal = end.format('YYYY-MM-DD');

    var capturarRango = $("#daterange-btn span").html();
   
    localStorage.setItem("capturarRango", capturarRango);

    window.location = "index.php?ruta=ventasProductos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

  localStorage.removeItem("capturarRango");
  localStorage.clear();
  window.location = "ventasProductos";
})

/*=============================================
CAPTURAR HOY
=============================================*/

$(".daterangepicker.opensleft .ranges li").on("click", function(){

  var textoHoy = $(this).attr("data-range-key");

  if(textoHoy == "Hoy"){

    var d = new Date();
    
    var dia = d.getDate();
    var mes = d.getMonth()+1;
    var año = d.getFullYear();

    // if(mes < 10){

    //  var fechaInicial = año+"-0"+mes+"-"+dia;
    //  var fechaFinal = año+"-0"+mes+"-"+dia;

    // }else if(dia < 10){

    //  var fechaInicial = año+"-"+mes+"-0"+dia;
    //  var fechaFinal = año+"-"+mes+"-0"+dia;

    // }else if(mes < 10 && dia < 10){

    //  var fechaInicial = año+"-0"+mes+"-0"+dia;
    //  var fechaFinal = año+"-0"+mes+"-0"+dia;

    // }else{

    //  var fechaInicial = año+"-"+mes+"-"+dia;
   //     var fechaFinal = año+"-"+mes+"-"+dia;

    // }

    dia = ("0"+dia).slice(-2);
    mes = ("0"+mes).slice(-2);

    var fechaInicial = año+"-"+mes+"-"+dia;
    var fechaFinal = año+"-"+mes+"-"+dia; 

      localStorage.setItem("capturarRango", "Hoy");

      window.location = "index.php?ruta=ventasProductos&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

})

</script>

<style type="text/css">
  

  thead input {
        width: 100%;
    }
</style>


<?php