<?php

if($_SESSION["ventas"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}


//FECHA ACTUAL
  
$fecha_actual = date("Y/m/d");
//sumo 1 día
$dteFechaVencimiento =date("Y/m/d",strtotime($fecha_actual."+ 30 days")); 
//resto 1 día
$item=null;
$valor=null;

$Empresa= new ControladorEmpresa();
$datosEmpresa= $Empresa->ctrMostrarEmpresas($item,$valor);

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
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
                    $valor = $_GET["idCotizacion"];

                    $venta = ControladorVentas::ctrTraerCotizacion($valor);



                    $itemUsuario = "id";
                    $valorUsuario = $venta["id_vendedor"];

                    $vendedor = ControladorUsuarios::ctrMostrarUsuarios($itemUsuario, $valorUsuario);

                    $itemCliente = "id";
                    $valorCliente = $venta["id_cliente"];

                    $cliente = ControladorClientes::ctrMostrarClientes($itemCliente, $valorCliente);

                    
                    if($venta["neto"]>0){
                        $porcentajeImpuesto = $venta["impuesto"] * 100 / $venta["neto"];
                    }


                ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>" id="idVendedor">

                  </div>

                </div> 

                <!--=====================================
                TIPO VENTA
                ======================================-->
            
                <div class="form-group" hidden>
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 


                    <input type="text" name="TipoVenta" id="TipoVenta" value="VEN">

                  </div>

                </div> 

                <!--=====================================
                ORIGEN COTIZACION
                ======================================-->
            
                <div class="form-group" hidden>
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 


                    <input type="text" name="origenCotizacion" id="origenCotizacion" value="<?php echo $venta["codigo"]; ?>">

                  </div>

                </div> 

               
                <!--=====================================
                FECHA
                ======================================--> 
               <div class="form-group">
               <div class="input-group date" data-provide="datepicker"  data-date-format="yyyy/mm/dd">
                  
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>

                  <input type="text" class="form-control pull-right" id="fecha" name="fecha" value="<?php echo $fecha_actual; ?>"  placeholder="Fecha">

                </div>
                </div>

                <!--=====================================
                ENTRADA DEL CÓDIGO
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <?php

                    $item = null;
                    $valor = null;

                    $ventas = ControladorVentas::ctrMostrarUltimoFolio("VEN");



                      $codigo = $ventas["UltimoFolio"] + 1;

                      echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                  
                    

                    ?>
                    
                    
                  </div>
                
                </div>

                  <!--=====================================
                ORIGEN COTIZACION
                ======================================-->
            
                <div class="form-group" hidden>
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 


                    <input type="text" name="origenCotizacion" id="origenCotizacion" value="<?echo $venta["codigo"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control select2" id="seleccionarCliente" name="seleccionarCliente" required style="width: 100%;">

            

                    <?php

                      if( $cliente["id"]<>0){
                         echo '<option value="'.$cliente["id"].'"> '.$cliente["nombre"].'</option>';
                       }

                      $item = null;
                      $valor = null;

                      $categorias = ControladorClientes::ctrMostrarClientes($item, $valor);

                       foreach ($categorias as $key => $value) {

                         echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                       }

                    ?>

                    </select>
                    
                    
                  
                  </div>
                <span class="input-group-addon"><button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                </div>

                  <!--=====================================
                COTIZAR A
                ======================================-->
            
                <div class="form-group" hidden >
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                    <input type="text" class="form-control pull-right" value="" name="cotizarA" id="cotizarA" placeholder="Cotiza a:" 
                  value=""
                    >

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

                  <input type="text" class="form-control pull-right" name="FechaVencimiento" id="FechaVencimiento" placeholder="Fecha Vencimiento" value="<?php echo $dteFechaVencimiento; ?>" required >


                </div>
                </div>

                <!--=====================================
                OBSERVACIONES
                ======================================-->
            
                <div class="form-group" >
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                    <input type="text" class="form-control pull-right" value="<?php echo $venta["Observaciones"]; ?>" name="Observaciones" placeholder="observaciones" >

                  </div>

                </div> 


               <!--=====================================
               UUID
                ======================================-->

                <?php

                $UUID = ModeloVentas::mdlGeneraUUID();

                $UUID = $UUID["generaUUID"];

                ?>
            
                <div class="form-group" hidden>
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-commenting"></i></span> 

                    <input type="text" class="form-control pull-right" name="UUID" id="UUID" placeholder="UUID" value="<?php echo $UUID; ?>" >

                  </div>

                </div> 


                <!--=====================================
                TIEMPO ESTIMADO DE ENTREGA
                ======================================-->
            
                <div class="form-group" >
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-hourglass-2"></i></span> 

                    <input type="text" class="form-control pull-right" name="plazoEntrega" id="plazoEntrega" placeholder="Tiempo estimado de entrega" value="<?php echo $datosEmpresa[0]["diasEntrega"]; ?>">

                  </div>

                </div> 


                                <div class="row">

                  <!--=====================================
                  ENCABEZADO
                  ======================================-->
                  
                  <div class="col-xs-12 pull-right">
                    
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

                $idCotizacion = $_GET["idCotizacion"];

                if ($idCotizacion>0){
                  foreach ($listaProducto as $key => $value) {

                    $item = "id";
                    $valor = $value["id"];
                    $orden = "id";

                    $respuesta = ControladorProductos::ctrMostrarProductos($item, $valor, $orden);

                    $stockAntiguo = $respuesta["stock"] + $value["cantidad"];
                    
                    echo '<div class="row" style="padding:5px 15px">
                        <div class="'.$value["id"].'" id="renglonProducto">


                          <div class="col-xs-1" style="padding-right:0px">
              
                            <div class="input-group">
  
                              <button   class="btn btn-danger  quitarProducto" idProducto="'.$value["id"].'"><strong>X</strong></button>
                            </div>


                          </div>


                        
                          <div class="col-xs-4" style="padding-right:0px">
              
                            <div class="input-group">
                  
          
                              <input type="text" class="form-control nuevaDescripcionProducto" idProducto="'.$value["id"].'" name="agregarProducto" id="agregarProducto" renglon="'.$value["renglon"].'" value="'.$value["descripcion"].'" required>

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
                }  

                ?>

                

                </div>

                <input type="hidden" id="listaProductos" name="listaProductos">

                <!--=====================================
                BOTÓN PARA AGREGAR PRODUCTO
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg" data-toggle="modal" data-target="#tabladeproductos2">Agregar producto</button>

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

                               <input type="hidden" name="nuevoPrecioImpuesto" id="nuevoPrecioImpuesto" required>

                               <input type="hidden" name="nuevoPrecioNeto" id="nuevoPrecioNeto" value="<?php echo $venta["neto"]; ?>" required>

                             
                        
                            </div>

                             <div class="input-group">
                           
                              <span class="input-group-addon"> <strong>Sub Total:</strong> <i ></i></span>

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



                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="button" class="btn btn-primary pull-left " data-toggle="modal" data-target="#modalAgregarProducto" data-dismiss="modal">Nuevo Producto</button>

            <button type="button" class="btn btn-primary pull-right " data-toggle="modal" data-target="#modalMetodoDePago" data-dismiss="modal"  >Guardar venta</button>
            

          </div>

        </form>

        <?php

          //$guardarVenta = new ControladorVentas();
          //$guardarVenta -> ctrCrearVenta();
          
        ?>

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-xs">
        
        <div class="box box-warning">




          <div class="box-header with-border">
            
                            <!--=====================================
                OBSERVACIONES
                ======================================-->
            
                <div class="form-group" >
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-barcode"></i></span> 

                    <input type="text" class="form-control pull-right" value="" name="CodigoDeBarras" id="CodigoDeBarras" placeholder="Codigo de barras" >

                  </div>

                </div> 



          </div>

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
MODAL AGREGAR PRODUCTO
======================================-->

<div id="modalAgregarProducto" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar producto</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR CATEGORÍA -->

            <div class="form-group" >
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select class="form-control input-lg select2" id="nuevaCategoria" name="nuevaCategoria" required style="width: 100%;">
                  
                  <option value="">Selecionar categoría</option>

                  <?php

                  $item = null;
                  $valor = null;

                  $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                  foreach ($categorias as $key => $value) {
                    
                    echo '<option value="'.$value["id"].'">'.$value["categoria"].'</option>';
                  }

                  ?>
  
                </select>

              </div>

            </div>





            <!-- ENTRADA PARA EL CÓDIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar código" readonly required>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" id="nuevaDescripcion" placeholder="Ingresar descripción" required>

              </div>

            </div>

             <!-- ENTRADA PARA STOCK -->

             <div class="form-group" >
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-check"></i></span> 

                <input type="number" class="form-control input-lg" name="nuevoStock" id="nuevoStock"  value="1" placeholder="Stock">

              </div>

            </div>

             <!-- ENTRADA PARA PRECIO COMPRA -->

             <div class="form-group row">

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" step="any" min="0" placeholder="Precio de compra" required>

                  </div>

                </div>

                <!-- ENTRADA PARA PRECIO VENTA -->

                <div class="col-xs-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" step="any" min="0" placeholder="Precio de venta" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX PARA PORCENTAJE -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- ENTRADA PARA PORCENTAJE -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR IMAGEN</div>

              <input type="file" class="nuevaImagen" name="nuevaImagen" id="nuevaImagen">

              <p class="help-block">Peso máximo de la imagen 2MB</p>

              <img src="vistas/img/productos/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary btnGuardarProductoAjax" data-dismiss="modal">Guardar producto</button>

        </div>

      </form>

        <?php

          //$crearProducto = new ControladorProductos();
          //$crearProducto -> ctrCrearProducto("cotizaciones");

        ?>  

    </div>

  </div>

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
                        <option value="">Seleccione método de pago</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="TC">Tarjeta Crédito</option>
                        <option value="TD">Tarjeta Débito</option>    
                        <option value="CR">Venta a Credito</option>                 
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

          <button type="button" class="btn btn-primary btnGuardarVentaAjax">Guardar Venta</button>

        </div>

         <?php



        ?>  


      </form>

       
    </div>

  </div>

</div>

      <!--=====================================
      LA TABLA DE PRODUCTOS MODAL
      ======================================-->


      <div class="col-lg-2 modal fade" id="tabladeproductos2"  role="dialog" width="50%">

        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas" width="100%">

      
              
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
            <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>




        </div>

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

                <input type="text" class="form-control input-lg" name="nuevoCliente" id="nuevoCliente" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA PERSONA O CONTACTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text"  class="form-control input-lg" name="nuevoDocumentoId" id="nuevoDocumentoId" placeholder="Persona o contacto" >

              </div>

            </div>

            <!-- ENTRADA PARA EL EMAIL -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="email" class="form-control input-lg" name="nuevoEmail" id="nuevoEmail" placeholder="Ingresar email" >

              </div>

            </div>

            <!-- ENTRADA PARA EL TELÉFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTelefono" id="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask >

              </div>

            </div>

            <!-- ENTRADA PARA LA DIRECCIÓN -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDireccion" id="nuevaDireccion" placeholder="Ingresar dirección" >

              </div>

            </div>

             <!-- ENTRADA PARA LA FECHA DE NACIMIENTO -->
            
            <div class="form-group" >
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" id="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask value="1900/01/01">

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          
          <button type="button" class="btn btn-default pull-left " data-dismiss="modal">Salir</button>

          <button type="button" class="btn btn-primary btnGuardarClienteAjax" data-dismiss="modal">Guardar cliente</button>

        </div>

      </form>

      <?php /*

        $crearCliente = new ControladorClientes();
        $crearCliente -> ctrCrearCliente();

        */

      ?>

    </div>

  </div>

</div>

<script type="text/javascript">
  







/*=============================================
GUARDAR EL PRODUCTO AJAX
=============================================*/
$(".modal-footer").on("click", ".btnGuardarProductoAjax", function(){

  var nuevaCategoria= $("#nuevaCategoria").val();
  var nuevoCodigo= $("#nuevoCodigo").val();
  var nuevaDescripcion= $("#nuevaDescripcion").val();
  var nuevoStock= $("#nuevoStock").val();
  var nuevoPrecioCompra= $("#nuevoPrecioCompra").val();
  var nuevoPrecioVenta= $("#nuevoPrecioVenta").val();
 
  var idClienteModal= $("#idClienteModal").val();
  var nuevaImagen= $("#nuevaImagen").val();
  var crearProducto= "crearProducto";

  var datos = new FormData();
  datos.append("nuevoCodigo", nuevoCodigo);
  datos.append("nuevaCategoria", nuevaCategoria);
  datos.append("nuevaDescripcion", nuevaDescripcion);
  datos.append("nuevoStock", "0");
  datos.append("nuevoPrecioCompra", nuevoPrecioCompra);
  datos.append("nuevoPrecioVenta", nuevoPrecioVenta);
  datos.append("nuevaImagen", nuevaImagen);
  datos.append("crearProducto", crearProducto);




$.ajax({

      url:"controladores/productos.controlador.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success:function(respuesta){
          console.log("respuesta",respuesta);
          if (respuesta.match(/correctamente.*/)){
            


            swal({
                type: "success",
                title: "El producto ha sido guardado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    
                  

            
            }
                  )
          }else{
          swal({
              type: "error",
              title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {



              }
            })
            
              
            }

        }

      }

      )

})




/*=============================================
GUARDAR EL CLIENTE AJAX
=============================================*/
$(".modal-footer").on("click", ".btnGuardarClienteAjax", function(){
  var nuevoCliente= $("#nuevoCliente").val();
  var nuevoDocumentoId= $("#nuevoDocumentoId").val();
  var nuevoEmail= $("#nuevoEmail").val();
  var nuevoTelefono= $("#nuevoTelefono").val();
  var nuevaDireccion= $("#nuevaDireccion").val();
  var nuevaFechaNacimiento= $("#nuevaFechaNacimiento").val();
  var guardarAjax= "guardarAjax";

  var ajaxCliente= "ajaxCliente";


  if($("#nuevoTelefono").val()==""){

      swal({
              type: "error",
              title: "¡El cliente no puede ir con los campos vacíos o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {



              }
            })
$("#nuevoTelefono").focus();
    return;
  }


  var datos = new FormData();
  datos.append("nuevoCliente", nuevoCliente);
  datos.append("nuevoDocumentoId", nuevoDocumentoId);
  datos.append("nuevoEmail", nuevoEmail);
  datos.append("nuevoTelefono", nuevoTelefono);
  datos.append("nuevaDireccion", nuevaDireccion);
  datos.append("nuevaFechaNacimiento", nuevaFechaNacimiento);
  datos.append("guardarAjax", guardarAjax);

  var datosLeer = new FormData();



  datosLeer.append("ajaxCliente", ajaxCliente);

  $.ajax({

      url:"controladores/clientes.controlador.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success:function(respuesta){
       

          if (respuesta.match(/correctamente.*/)){
              



            swal({
                type: "success",
                title: "El cliente ha sido guardado correctamente",
                showConfirmButton: true,
                confirmButtonText: "Cerrar"
                }).then(function(result){
                    
              $.ajax({

              url:"controladores/clientes.controlador.php",
                method: "POST",
                data: datosLeer,
                cache: false,
                contentType: false,
                processData: false,
                dataType:"json",
                success:function(respuesta){
                  
                  var resultado=respuesta;
                  $("#seleccionarCliente").select2({ data: resultado });
                }
              })
                  

            
            }
                  )
          }else{
          swal({
              type: "error",
              title: "¡El cliente no puede ir con los campos vacíos o llevar caracteres especiales!",
              showConfirmButton: true,
              confirmButtonText: "Cerrar"
              }).then(function(result){
              if (result.value) {



              }
            })
            
              
            }

        }

      }

      )





})



/*=============================================
GUARDAR VENTA AJAX
=============================================*/
$(".modal-footer").on("click", ".btnGuardarVentaAjax", function(){
  
  //VARIABLES PARTA EL CONSECUTIVO
  var datosConsecutivo = new FormData();
  datosConsecutivo.append("ConsecutivoVenta", "ConsecutivoVenta");
  //ACTUALIZAMOS EL CONSECUTIVO
   $.ajax({

              url:"controladores/ventas.controlador.php",
              method: "POST",
              data: datosConsecutivo,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(consecutivo){
                console.log("consecutivo",consecutivo);
                $("#nuevaVenta").val(consecutivo["UltimoFolio"]+1);
              }

          })


  //MANDAMOS LOS DATOS A GUARDAR
  var nuevaVenta= $("#nuevaVenta").val();
  var listaProductos= $("#listaProductos").val();
  var TipoVenta= "VEN";
  var seleccionarCliente= $("#seleccionarCliente").val();
  var idVendedor= $("#idVendedor").val();
  var nuevoPrecioImpuesto= $("#nuevoPrecioImpuesto").val();
  var nuevoPrecioNeto= $("#nuevoPrecioNeto").val();
  var totalVenta= $("#totalVenta").val();
  var FechaVencimiento= $("#FechaVencimiento").val();
  var Observaciones= $("#Observaciones").val();
  var cotizarA= $("#cotizarA").val();
  var plazoEntrega= $("#plazoEntrega").val();
  var origenCotizacion= $("#origenCotizacion").val();
  var listaMetodoPago= $("#listaMetodoPago").val();
  var nuevoValorEfectivo= $("#nuevoValorEfectivo").val();
  var fecha= $("#fecha").val();
  
  var fechaPago= $("#fechaPago").val();
  var nuevoMetodoPago= $("#nuevoMetodoPago").val();
  var UUID= $("#UUID").val();


  var datos = new FormData();
  datos.append("nuevaVenta", nuevaVenta);
  datos.append("listaProductos", listaProductos);
  datos.append("TipoVenta", TipoVenta);
  datos.append("idVendedor", idVendedor);
  datos.append("seleccionarCliente", seleccionarCliente);
  datos.append("nuevoPrecioImpuesto", nuevoPrecioImpuesto);
  datos.append("nuevoPrecioNeto", nuevoPrecioNeto);

  datos.append("totalVenta", totalVenta);
  datos.append("FechaVencimiento", FechaVencimiento);
  datos.append("fecha", fecha);
  datos.append("Observaciones", Observaciones);
  datos.append("cotizarA", cotizarA);
  datos.append("plazoEntrega", plazoEntrega);
  datos.append("origenCotizacion", origenCotizacion);
  datos.append("nuevoValorEfectivo", nuevoValorEfectivo);

  datos.append("listaMetodoPago", listaMetodoPago);

  datos.append("fechaPago", fechaPago);
  datos.append("nuevoMetodoPago", nuevoMetodoPago);
  datos.append("UUID", UUID);
  

  $.ajax({

      url:"controladores/ventas.controlador.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        //dataType:"json",
        success:function(respuesta){
       




          if (respuesta.match(/correctamente.*/)){
              

            //DATOS PARA VER QUE ID LE CORRESPONDE A LA VENTA CREADA
            var datosNuevaVenta = new FormData();

            datosNuevaVenta.append("leerLlave", "leerLlave");
            datosNuevaVenta.append("tipo_venta", TipoVenta);
            datosNuevaVenta.append("codigo", nuevaVenta);
            //IMPRIME EL DOCUMENTO
            $.ajax({

              url:"controladores/ventas.controlador.php",
              method: "POST",
              data: datosNuevaVenta,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
                console.log("respuesta Venta",respuesta);

                var codigoVenta = respuesta["id"];
                window.open("extensiones/tcpdf/pdf/factura.php?codigo="+codigoVenta, "_blank");
                window.open("extensiones/impresionTicket/impresionTicket.php?UUID="+UUID, "_blank");
              }

            })


            
            swal({
                type: "success",
                title: "La venta ha sido guardada correctamente",
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
              title: "¡Error al guardar la venta!",
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



$(document).ready(function(){
  $("#CodigoDeBarras").keydown(function(event){

    var term = $(this).val();
    

    if(event.which==13){
      

      agregarProductoCodigoBarras($("#CodigoDeBarras").val());

    } 
  }); 
});


</script>


<?php
