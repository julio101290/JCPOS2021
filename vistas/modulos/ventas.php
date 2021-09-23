<?php

if($_SESSION["administrarVentas"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$xml = ControladorVentas::ctrDescargarXML();

if($xml){

  rename("xml/".$_GET["xml"].".xml", "xml/".$_GET["xml"].".xml");

  echo '<a class="btn btn-block btn-success abrirXML" archivo="xml/'.$_GET["xml"].'.xml" href="ventas">Se ha creado correctamente el archivo XML <span class="fa fa-times pull-right"></span></a>';

}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar ventas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar ventas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <a href="crear-venta">

          <button class="btn btn-primary">

            Agregar venta

          </button>

        </a>

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

       <table class="table table-bordered table-striped dt-responsive AdministrarVentas" width="100%" id="tablaVentas" name="tablaVentas" style="font-size: 10px">

        <thead>

         <tr>


           <th  width="15px">ID</th>
           <th  width="15px">Codigo Factura</th>
           <th  width="15px">Cliente</th>
           <th>Vendedor</th>
           <th>Forma de pago</th>
           <th>Neto</th>
           <th>Total</th>
           <th>Total Pagado</th>
           <th>Saldo</th>
           <th>Fecha</th>
           <th>Acciones</th>

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


        ?>

        </tbody>
         <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th align="right"></th>
            <th align="right"></th>
            <th align="right"></th>
             <th align="right"></th>
             <th></th>
            <th></th>
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
          $fechaActual =date("Y/m/d");

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

          //$guardarPago = new ControladorPagos();
          //$guardarPago-> ctrCrearPago();

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

$(".AdministrarVentas").on("click", ".btnAbonar", function(){

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

$(".AdministrarVentas").on("click", ".btnMostrarPagos", function(){

  var idVenta = $(this).attr("idCodigo");
  console.log("idVenta",idVenta)
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




    var parts = window.location.search.substr(1).split("&");
    var $_GET = {};

    for (var i = 0; i < parts.length; i++) {
        var temp = parts[i].split("=");
        $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
    }

     console.log( $_GET["fechaInicial"]);
   $('.AdministrarVentas').DataTable().destroy();

  if(isset($_GET["pendientePorCobrar"])){
    var pendientePorCobrar = $_GET["pendientePorCobrar"];
  }else{
    var pendientePorCobrar ="n";
  }

  if(isset($_GET["soloCobrado"])){

    var soloCobrado = $_GET["soloCobrado"];
  }else{
    var soloCobrado = "n";
  }




  if(isset($_GET["pendientes"])){
    var pendientes = $_GET["pendientes"];
  }else{
    var pendientes ="n";
  }

  if(isset($_GET["cliente"])){
    var cliente = $_GET["cliente"];
  }else{
    var cliente ="n";
  }

  if(isset($_GET["fechaInicial"])){

    var fechaInicial = $_GET["fechaInicial"];
    var fechaFinal = $_GET["fechaFinal"];

  }else{

    var fechaInicial = null;
    var fechaFinal = null;

  }




console.log(fechaInicial);
tablaAdministrarVentas   (fechaInicial
                        , fechaFinal
                        ,"VEN"
                        , pendientePorCobrar
                        , soloCobrado
                        ,cliente
                         );

    })
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

    window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

  localStorage.removeItem("capturarRango");
  localStorage.clear();
  window.location = "ventas";
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

      window.location = "index.php?ruta=ventas&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

})

</script>

<style type="text/css">


  thead input {
        width: 100%;
    }
</style>


<?php
