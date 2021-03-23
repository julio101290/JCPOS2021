<?php

if($_SESSION["administrarCotizaciones"] == "off"){

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
      
      Administrar Cotizaciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar Cotizaciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <a href="crearcotizacion">

          <button class="btn btn-primary">
            
            Agregar Cotizacion

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

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive administrarCotizaciones" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Folio Cotización</th>
           <th>Atencion A</th>
           <th>Contacto</th>
           <th>Vendedor</th>
           <th>Sub Total</th>
           <th>Total</th> 
           <th>Fecha</th>
           <th>Fecha Vencimiento</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
           
        <?php
/*
          if(isset($_GET["fechaInicial"])){

            $fechaInicial = $_GET["fechaInicial"];
            $fechaFinal = $_GET["fechaFinal"];

          }else{

            $fechaInicial = null;
            $fechaFinal = null;

          }

          $respuesta ="";// ControladorVentas::ctrRangoFechasVentas($fechaInicial, $fechaFinal,"COT");
          
          foreach ($respuesta as $key => $value) {
           
           echo '<tr>

                  <td>'.($key+1).'</td>

                  <td>'.$value["codigo"].'</td>';

                  $itemCliente = "id";
                  $valorCliente = $value["id_cliente"];

                  $respuestaCliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                  echo '<td>'.$respuestaCliente["nombre"].'</td>

                      <td>'.$value["cotizarA"].'</td>'
                  ;

                  $itemUsuario = "id";
                  $valorUsuario = $value["id_vendedor"];

                  $respuestaUsuario = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                  echo '<td>'.$respuestaUsuario["nombre"].'</td>

                  

                  <td>$ '.number_format($value["neto"],2).'</td>

                  <td>$ '.number_format($value["total"],2).'</td>

                  <td>'.$value["fecha"].'</td>

                  <td>'.$value["FechaVencimiento"].'</td>

                  <td>

                    <div class="btn-group">

                      
                        
                      <button class="btn btn-info btnImprimirCotizacion" 
                          required data-toggle="tooltip" data-placement="top" title="Imprimir Cotizaciones"
                        codigoVenta="'.$value["id"].'">

                        <i class="fa fa-print"></i>

                      </button>
                      <button class="btn btn-success btnEnviarCorreo" 

                       
                      codigoVenta="'.$value["id"].'"
                      data-toggle="modal" data-target="#enviarCorreo" data-dismiss="modal"
                       tipoVenta="COT" nombreCliente="'.$value["cotizarA"]
                       .'" correoCliente="'.$respuestaCliente["email"].'"
                        required data-toggle="tooltip" data-placement="top" title="Enviar Correo"

                      >

                        <i class="fa fa-send"></i>

                      </button>'



                      ;

                    if($_SESSION["modificarCotizaciones"] == "on"){

                         echo '<button class="btn btn-warning btnEditarCotizacion" 
                                required data-toggle="tooltip" data-placement="top" title="Editar Cotización"
                                idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';
                    }

                      
                    if($_SESSION["eliminarCotizaciones"] == "on"){
                      echo '<button class="btn btn-danger btnEliminarCotizacion" 
                              required data-toggle="tooltip" data-placement="top" title="Eliminar Cotización"
                            idVenta="'.$value["id"].'"><i class="fa fa-times"></i></button>
                      ';
                    }
                      
                      if(date("Y-m-d")>$value["FechaVencimiento"]){
                           echo '<button class="btn bg-navy " disabled="true" idVenta="'.$value["id"].'"><STRONG>COTIZACION VENCIDA</STRONG></i></button>';
                        }
                        else{
                          if (is_numeric($value["codigoVenta1"])){

                              echo '<button class="btn bg-navy " disabled="true" idVenta="'.$value["id"].'"><STRONG>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; VENTA '.$value["codigoVenta1"].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</STRONG></i></button>';
                          }
                          else{

                              echo '<button class="btn bg-navy btnCrearVentaCotizacion" idVenta="'.$value["id"].'"><STRONG>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$value["codigoVenta1"].'&nbsp;&nbsp;&nbsp;</STRONG></i></button>';
                          }

                        }
                      
                      echo '


                      <button class="btn bg-navy btnCopiarCotizacion" idCotizacion="'.$value["id"].'"><STRONG>COPIAR</STRONG></i></button>
                      
                      ';

                    }

                    echo '</div>  

                  </td>

                </tr>';
            
*/
        ?>
               
        </tbody>

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
MODAL AGREGAR PRODUCTO
======================================-->

<div id="enviarCorreo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Correo Electronico Cotización</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

                    <!-- ENTRADA NOMBRE CONTACTO-->
            
            <div class="form-group" >
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="idContactoCorreo" name="idContactoCorreo" placeholder="Nombre Contacto"  value="">

              </div>

            </div>

           
            <!-- ENTRADA PARA EL CORREO ELECTRONICO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span> 

                <input type="text" class="form-control input-lg" name="correoElectronico" id="correoElectronico" placeholder="Correo electronico" required>

              </div>

            </div>

                        <!-- ENTRADA PARA EL MENSAJE-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span> 

                <input type="text" class="form-control input-lg" value="<?php echo $_SESSION["mensajeCorreo"]; ?>" name="mensajeCorreo" id="mensajeCorreo" placeholder="Mensaje" required>

              </div>

            </div>

                          <!-- FOLIO DOCUMENTO-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span> 

                <input type="text" class="form-control input-lg" value="1" name="codigoCotizacion" id="codigoCotizacion" placeholder="CodigoCotizacion" required>

              </div>

            </div>




                
          </div>
 



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" id="cerrarModal" name="cerrarModal" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary btnEnviarCorreo2" data-dismiss="modal">Enviar Cotización</button>

        </div>

      </form>



    </div>

  </div>

</div>


<script type="text/javascript">
  


/*=============================================
BOTON TRAER INFORMACION DEL CORREO
=============================================*/
$(".administrarCotizaciones").on("click", ".btnEnviarCorreo", function(){

  var idVenta = $(this).attr("codigoVenta");
  var nombreCliente = $(this).attr("nombreCliente");
  var correoCliente = $(this).attr("correoCliente");

  //var correoCliente = $(this).attr("mensajeCorreo");
console.log(idVenta);

$("#idContactoCorreo").val(nombreCliente);
$("#correoElectronico").val(correoCliente);
$("#codigoCotizacion").val(idVenta);




})


/*=============================================
GENERAR ARCHIVO Y ENVIAR CORREO
=============================================*/
$(".modal-footer").on("click", ".btnEnviarCorreo2", function(){

  var codigo= $("#codigoCotizacion").val();
  var correoCliente= $("#correoElectronico").val();
  var firmaCorreo= $("#mensajeCorreo").val();

  var datos = new FormData();
  datos.append("codigo", codigo);

  var datosCorreo = new FormData();
  datosCorreo.append("codigo", codigo);
  datosCorreo.append("correoCliente", correoCliente);
  datosCorreo.append("firmaCorreo", firmaCorreo);



  window.open("extensiones/tcpdf/pdf/cotizacion.php?codigo="+codigo, "_blank");

$.ajax({

      url:"extensiones/tcpdf/pdf/cotizacion.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",

      }
      )

            $.ajax({

                  url:"ajax/enviarCorreoCotizacion.php",
                    method: "POST",
                    data: datosCorreo,
                    cache: false,
                    contentType: false,
                    processData: false,
                    //dataType:"json",
                    success:function(respuesta){
                      console.log("respuesta",respuesta);


                      if (respuesta.match(/Message has been sent*/)){


                              swal({
                                  type: "success",
                                  title: "La cotizacion ha sido enviada correctamente",
                                  showConfirmButton: true,
                                  confirmButtonText: "Cerrar"
                                  }).then(function(result){
                                      if (result.value) {

                                    

                                      }
                                    })

                        }
                      else{

                              swal({
                                  type: "error",
                                  title: ""+respuesta+"",
                                  showConfirmButton: true,
                                  confirmButtonText: "Cerrar"
                                  }).then(function(result){
                                      if (result.value) {

                                    

                                      }
                                    })

                      }
                    $('.cerrarModal').click ();
                    

                  }
              })

})

/*=============================================
BOTON CREA VENTA DESDE COTIZACION
=============================================*/
$(".administrarCotizaciones").on("click", ".btnCrearVentaCotizacion", function(){

  var idCotizacion = $(this).attr("idVenta");



  window.location = "index.php?ruta=crear-venta&idCotizacion="+idCotizacion;


})


/*=============================================
BOTON PARA COPIAR LA COTIZACION
=============================================*/
$(".administrarCotizaciones").on("click", ".btnCopiarCotizacion", function(){

  var idCotizacion = $(this).attr("idCotizacion");



  window.location = "index.php?ruta=crearcotizacion&idCotizacion="+idCotizacion;


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

    window.location = "index.php?ruta=administrarcotizaciones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

)

/*=============================================
CANCELAR RANGO DE FECHAS
=============================================*/

$(".daterangepicker.opensleft .range_inputs .cancelBtn").on("click", function(){

  localStorage.removeItem("capturarRango");
  localStorage.clear();
  window.location = "administrarcotizaciones";
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

      window.location = "index.php?ruta=administrarcotizaciones&fechaInicial="+fechaInicial+"&fechaFinal="+fechaFinal;

  }

})



$(document).ready(function() {



    // OBTENER LAS VARIABLES EN LA URL Y LAS GUARDA EN UN ARREGLO
    var parts = window.location.search.substr(1).split("&");
    var $_GET = {};
    
    for (var i = 0; i < parts.length; i++) {
        var temp = parts[i].split("=");
        $_GET[decodeURIComponent(temp[0])] = decodeURIComponent(temp[1]);
    }
    
     console.log( $(this).val());
   $('.administrarCotizaciones').DataTable().destroy();

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
tablaAdministrarCotizaciones   (fechaInicial
                        , fechaFinal
                        ,"VEN"
                        , pendientePorCobrar
                        , soloCobrado
                        ,cliente
                         );

    })

</script>

