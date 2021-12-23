<?php

if($_SESSION["cajas"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

$fecha_actual = date("Y/m/d");
?>



<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Cajas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Cajas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAbrirCaja">

          Abrir Caja
        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablaCajas" width="100%">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Fecha Apertura</th>
           <th>Fecha Cierre</th>
           <th>Importe Apertura</th>
           <th>Total</th>
           <th>Diferencia</th>
           <th>Observaciones</th>
           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>



        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL ABRIR CAJA
======================================-->

<div id="modalAbrirCaja" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Abrir Caja</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA IMPORTE APERTURA -->

            <div class="form-group">
              Importe de Apertura:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg" name="importeApertura" placeholder="Importe de Apertura" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->



            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control select2" id="idVendedor" name="idVendedor" required style="width: 100%;">



                <?php



                  $item = null;
                  $valor = null;

                  $usuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

                   foreach ($usuarios as $key => $value) {

                     echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                   }

                ?>

                </select>



              </div>

            </div>


             <!-- ENTRADA PARA LA FECHA DE APERTURA -->

            <div class="form-group" >
              Fecha Apertura:
               <div class="input-group date" data-provide="datepicker" data-date-format="yyyy/mm/dd" >

                  <div class="input-group-addon" style="">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" id="fechaApertura" name="fechaApertura" value="<?php echo $fecha_actual ?>" placeholder="Fecha" id="fechaApertura1">

                </div>
            </div>




          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="summit" class="btn btn-primary"  >Abrir Caja</button>

        </div>

      </form>

  <?php

  $abrirCaja= new ControladorCaja();
    $abrirCaja -> ctrAbrirCaja();

  ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL INGRESAR DINERO CAJA
======================================-->

<div id="modalIngresarDinero" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ingresar Dinero</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA IMPORTE APERTURA -->

            <div class="form-group">
              Monto a ingresar:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg" name="montoIngreso" placeholder="Monto a ingresar" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

           <div class="form-group">
                Usuario:
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="usuario"  value="<?php echo $_SESSION["nombre"]; ?>" readonly="">

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>" id="idVendedor">

                  </div>

            </div>

            <!-- ENTRADA PARA OBSERVACIONES -->
            Observaciones:
            <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span>

                    <input type="text" class="form-control pull-right"  name="editarObservaciones" id="editarObservaciones" placeholder="observaciones">

                  </div>

            </div>
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="summit" class="btn btn-primary"  >Ingresar Dinero</button>

        </div>

      </form>

  <?php

    // $abrirCaja= new ControladorCaja();
  //  $abrirCaja -> ctrAbrirCaja();

  ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL RETIRAR DINERO CAJA
======================================-->

<div id="modalRetirarDinero" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Retiro de dinero</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA IMPORTE APERTURA -->

            <div class="form-group">
              Importe a Retirar:
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg" name="importeRetiro" placeholder="Importe a retirar" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

           <div class="form-group">
                Usuario:
                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="usuario"  value="<?php echo $_SESSION["nombre"]; ?>" readonly="">

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>" id="idVendedor">

                  </div>

                </div>

            <!-- ENTRADA PARA OBSERVACIONES -->
            Observaciones:
            <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span>

                    <input type="text" class="form-control pull-right"  name="editarObservaciones" id="editarObservaciones" placeholder="observaciones">

                  </div>

            </div>







          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="summit" class="btn btn-primary"  >Retirar Dinero</button>

        </div>

      </form>

  <?php

  //  $abrirCaja= new ControladorCaja();
  //  $abrirCaja -> ctrAbrirCaja();

  ?>

    </div>

  </div>

</div>


<!--=====================================
MODAL CERRAR CAJA
======================================-->

<div id="modalCerrarCaja" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" id="cerrarCaja">


        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Cerrar Caja</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group" hidden>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg" name="EditarIdCaja" id="EditarIdCaja" readonly  required>

              </div>

            </div>



        <!-- ENTRADA PARA IMPORTE APERTURA -->
            Importe de Apertura:
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg" name="editarImporteApertura" id="editarImporteApertura"  placeholder="Importe de Apertura" readonly>

              </div>

            </div>
          <!-- ENTRADA PARA TOTAL DE VENTAS -->
            Total Ventas:
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="text"  class="form-control input-lg" name="EditarTotalVentas" id="EditarTotalVentas" value="0.00" readonly placeholder="Total de Ventas"   >

              </div>

            </div>
          <!-- ENTRADA PARA RECUENTO -->
            Recuento Efectivo:
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="number" class="form-control input-lg" name="recuentoEfectivo" id="recuentoEfectivo" placeholder="Recuento Efectivo" required  onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;">

              </div>
            </div>
            <!-- ENTRADA PARA RECUENTO -->
            Diferencia:
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-dollar"></i></span>

                <input type="text" class="form-control input-lg" name="diferencia" id="diferencia" placeholder="Diferencia" >

              </div>
            </div>
            <!-- ENTRADA PARA EL USUARIO -->

            Usuario:
           <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="editarUsuarios" name="editarUsuarios"  readonly>
                    <input type="hidden" class="form-control" id="editarUsuariosID" name="editarUsuariosID"  readonly>


                  </div>

                </div>


             <!-- ENTRADA PARA LA FECHA DE APERTURA -->
            Fecha de Apuertura:
            <div class="form-group">
               <div class="input-group date" data-provide="datepicker" data-date-format="yyyy/mm/dd">

                  <div class="input-group-addon" style="">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" id="editarFechaApertura" name="editarFechaApertura" readonly placeholder="Fecha">

                </div>
            </div>
            <!-- ENTRADA PARA LA FECHA DE CIERRE -->
            Fecha de Cierre:
            <div class="form-group">
               <div class="input-group date" data-provide="datepicker" data-date-format="yyyy/mm/dd">

                  <div class="input-group-addon" style="">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" id="editarFechaCierre" name="editarFechaCierre"  value="<?php echo $fecha_actual ?>" placeholder="Fecha">

                </div>
            </div>
             <!-- ENTRADA PARA OBSERVACIONES -->
            Observaciones:
            <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span>

                    <input type="text" class="form-control pull-right"  name="editarObservaciones" id="editarObservaciones" placeholder="observaciones">

                  </div>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="summit"  class="btn btn-primary" >Cerrar Caja</button>

        </div>

      </form>

        <?php
        $cerrarCaja= new ControladorCaja();
        $cerrarCaja -> ctrCerrarCaja();


      ?>




    </div>

  </div>

</div>



<script type="text/javascript">

$(".tablaCajas").on("click", ".btnCerrarCaja", function(){

  idCaja = $(this).attr("idCaja");

  $("#EditarIdCaja").val(idCaja);

  var datos = new FormData();

  datos.append("idCaja", idCaja);

  $.ajax({

      url:"controladores/caja.controlador.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){


        console.log("Respuesta:",respuesta )

        $("#editarImporteApertura").val(respuesta["importe_apertura"]);
      //  $("#EditarTotalVentas").val(respuesta["total_ventas"]);
        $("#editarFechaApertura").val(respuesta["fecha_apertura"]);
        $("#editarObservaciones").val(respuesta["observaciones"]);
        $("#editarUsuarios").val(respuesta["nombreUsuario"]);
        $("#editarUsuariosID").val(respuesta["idUsuario"]);



    }

    })

    var pagos = new FormData();
    pagos.append("idCajaBuscar", idCaja);

    $.ajax({

      url:"controladores/pagos.controlador.php",
      method: "POST",
      data: pagos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
        console.log(respuesta);
        $("#EditarTotalVentas").val(respuesta["totalVentaCaja"]);

    }

    })


})


/*=============================================
HACE LA CUENTA POR DIFERENCIA
=============================================*/

$("#recuentoEfectivo").keyup (function(){

  var importeApertura = parseFloat($("#editarImporteApertura").val());

  var totalVentas = parseFloat($("#EditarTotalVentas").val());

  var recuentoEfectivo = parseFloat($("#recuentoEfectivo").val());

  console.log(importeApertura);
  console.log("Total ventas:",totalVentas);
  console.log("recuento Efectivo:",recuentoEfectivo);

  $("#diferencia").val((importeApertura+totalVentas)-recuentoEfectivo);

// $("#diferencia").val(0);


})


</script>
