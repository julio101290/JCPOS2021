<?php

if($_SESSION["modificarCotizaciones"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}


?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Editar Cotización
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->
      
      <div class="col-lg-7 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <?php

                    $item = "id";
                    $valor = $_GET["idVenta"];

                    $venta = ControladorVentas::ctrMostrarVentas($item, $valor);

                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];

                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];


                ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $vendedor["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $vendedor["id"]; ?>">

                  </div>

                </div> 

                 <!--=====================================
                TIPO VENTA
                ======================================-->
            
                <div class="form-group" hidden>
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 


                    <input type="text" name="TipoVenta" id="TipoVenta" value="COT">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                   <input type="text" class="form-control" id="nuevaVenta" name="editarVenta" value="<?php echo $venta["codigo"]; ?>" readonly>
               
                  </div>
                
                </div>

                 <!--=====================================
                ENTRADA DEL ID
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                   <input type="text" class="form-control" id="idVenta" name="idVenta" value="<?php echo $venta["id"]; ?>" readonly>
               
                  </div>
                
                </div>

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control select2" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="<?php echo $cliente["id"]; ?>"><?php echo $cliente["nombre"]; ?></option>

                    <?php

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>

                
                </div>

                  <!--=====================================
                COTIZAR A
                ======================================-->
            
                <div class="form-group" >
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                    <input type="text" class="form-control pull-right" value="<?php echo $venta["cotizarA"]; ?>" name="cotizarA" id="cotizarA" placeholder="Cotiza a:" >

                  </div>

                </div> 


                <!--=====================================
                FECHA VENCIMIENTO
                ======================================--> 
               <div class="form-group">
               <div class="input-group date" data-provide="datepicker" data-date-format="yyyy/mm/dd" required>
                  
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" name="FechaVencimiento" id="FechaVencimiento" placeholder="Fecha Vencimiento" value="<?php echo $venta["FechaVencimiento"]; ?>" required >


                </div>
                </div>

                <!--=====================================
                OBSERVACIONES
                ======================================-->
            
                <div class="form-group" >
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                    <input type="text" value="<?php echo $venta["Observaciones"]; ?>" class="form-control pull-right" name="Observaciones" placeholder="observaciones" >

                  </div>

                </div> 

                <!--=====================================
                TIEMPO ESTIMADO DE ENTREGA
                ======================================-->
            
                <div class="form-group" >
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-hourglass-2"></i></span> 

                    <input type="text" class="form-control pull-right" name="plazoEntrega" id="plazoEntrega" placeholder="Tiempo estimado de entrega" value="<?php echo $venta["cotizarA"]; ?>">

                  </div>

                </div> 


                <div class="row">

                  <!--=====================================
                  ENCABEZADO
                  ======================================-->
                  
                  <div class="col-xs-12 pull-right" >
                    
                    <table class="table">

                      <thead>
                        <th style="width: 16.66666667%"></th>  
                          <th style="width: 25%">Descripcion</th>      
                          <th style="width: 16.66666667%">Cantidad</th>    
                          <th style="width: 16.66666667%">Precio</th>    
                          <th style="width: 16.66666667%">Total</th> 
                        </tr>

                      </thead>

                     
                    </table>

                  </div>

                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR PRODUCTO
                ======================================--> 

                <div class="form-group row nuevoProducto">



                <?php

                $listaProducto = json_decode($venta["productos"], true);

                $renglon=0;
                foreach ($listaProducto as $key => $value) {

                  $item = "id";
                  $valor = $value["id"];
                  $orden = "id";
                  
                  $renglon=$renglon+1;


                  $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                  $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                  
                  echo '<div class="row" style="padding:5px 15px">
                        <div class="'.$renglon.'" id="renglonProducto">


                          <div class="col-xs-1" style="padding-right:0px">
              
                            <div class="input-group">
  
                              <button   class="btn btn-danger  quitarProducto" idProducto="'.$value["id"].'"><strong>X</strong></button>
                            </div>


                          </div>


                        
                          <div class="col-xs-4" style="padding-right:0px">
              
                            <div class="input-group">
                  
          
                              <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" id="agregarProducto" renglon="'.$renglon.'" value="'.$value["descripcion"].'" required>

                            </div>

                          </div>

                          <div class="col-xs-2">
                
                            <input type="number" step="any" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" id="nuevaCantidadProducto" min="1" value="'.$value["cantidad"].'" stock="'.$stockAntiguo.'" nuevoStock="'.$value["stock"].'" required>

                          </div>

                                       <!-- Precio unitario -->


                          <div class="col-xs-2">

                          

                           <input type="text" class="form-control nuevoPrecioUnitarioProducto" name="nuevoPrecioUnitarioProducto"  value="'.$value["precio"].'" required>
                                 
              
                             
                          </div>

                          <div class="col-xs-2 ingresoPrecio" style="padding-left:0px">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                     
                              <input type="text" class="form-control nuevoPrecioProducto" precioReal="'.$respuesta["precio_venta"].'" name="nuevoPrecioProducto" value="'.$value["total"].'" readonly required>
     
                            </div>
                 
                         </div>


                         
                         
                          </div>


                        </div>

                        '

                        ;
                }


                ?>

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar producto</button>

                <hr>

                <div class="row">

               
                  <!--=====================================
                  ENTRADA IMPUESTOS Y TOTAL
                  ======================================-->
                  
                  <div class="col-xs-12 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th></th>
                          <th></th>
                          <th></th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 30%">
                            


                          </td>


                           <td style="width: 30%">
                            
                           

                          </td>



                           <td style="width: 40%">

                            <div class="input-group">
                            <span class="input-group-addon"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;IVA:&nbsp;</strong><i class="fa fa-percent"></i></span>
                              <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" value="16" placeholder="0" required>

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" value="<?php echo $venta["impuesto"]; ?>" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>

                             
                        
                            </div>

                             <div class="input-group">
                           
                              <span class="input-group-addon"> <strong>Sub Total:</strong> <i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoSubTotalVenta" name="nuevoSubTotalVenta" total="" placeholder="00000" value="<?php echo $venta["neto"]; ?>" readonly required>

                              <input type="hidden" name="subTotalVenta" id="subTotalVenta" value="<?php echo $venta["neto"]; ?>">
                              
                        
                            </div>
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total: </strong>       <i class="ion ion-social-usd"></i></span>

                              <input type="text" class="form-control input-lg" id="nuevoTotalVenta" name="nuevoTotalVenta" total="<?php echo $venta["total"]; ?>" value="<?php echo $venta["total"]; ?>" placeholder="00000" readonly required>

                              <input type="hidden" name="totalVenta" id="totalVenta" value="<?php echo $venta["total"]; ?>">
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>


                <hr>

                <!--=====================================
                ENTRADA MÉTODO DE PAGO
                ======================================-->

                <div class="form-group row" hidden>
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago">
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>                  
                      </select>    

                    </div>

                  </div>

                  <div class="cajasMetodoPago"></div>

                  <input type="hidden" id="listaMetodoPago" name="listaMetodoPago">

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>

          </div>

        </form>

        <?php

          $editarVenta = new ControladorVentas();
          $editarVenta -> ctrEditarVenta();
          
        ?>

        </div>
            
      </div>

        <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>
<!--=====================================
MODAL AGREGAR CLIENTE
======================================-->

<div id="modalAgregarCliente" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar cliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingresar documento" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar dirección" required>

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cliente</button>

        </div>

      </form>

      <?php

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

      ?>

    </div>

  </div>

</div>

<script type="text/javascript">
  //VARIABLES
window.onload=function() {    
  listarProductos();
  $('#nuevaCantidadProducto').trigger("change"); 

}

//SEGUIMIENTO DEL STOCK EN LA VENTA POR LINEA
var totalP= new Array();

//SEGUIMIENTO DEL STOCK EN LA VENTA POR PRODUCTO
var stockP= new Array();

//RENGLON DE LA VENTA
var lngContador=0;


  
</script>