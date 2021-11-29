<?php

if($_SESSION["perfiles"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Perfiles

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Perfiles</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar Perfil

        </button>

      </div>

      <div class="box-body">

       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

        <thead>

         <tr>

           <th style="width:10px">#</th>
           <th>Descripcion</th>

           <th>Acciones</th>

         </tr>

        </thead>

        <tbody>

        <?php

        $item = null;
        $valor = null;

        $usuarios = ControladorPerfiles::ctrMostrarPerfiles($item, $valor);

       foreach ($usuarios as $key => $value){

          echo ' <tr>
                  <td>'.$value["perfil"].'</td>
                  <td>'.$value["descripcion"].'</td>';

            echo '
                  <td>

                    <div class="btn-group">

                      <button class="btn btn-warning btnEditarPerfil" idPerfil="'.$value["perfil"].'" data-toggle="modal" data-target="#modalEditarPerfil"><i class="fa fa-pencil"></i></button>

                      <button class="btn btn-danger btnEliminarPerfil" idPerfil="'.$value["perfil"].'" ><i class="fa fa-times"></i></button>

                    </div>

                  </td>

                </tr>';
        }


        ?>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR PERFIL
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar perfil</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA DESCRIPCION DEL PERFIL -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" name="nuevoDescripcionPerfil" placeholder="Ingresar descripcion perfil" required>

              </div>

            </div>




 <!-- EMPEZAMMOS CON LAS PESTAÑAS -->
<ul class="nav nav-tabs">

  <li class="active"><a data-toggle="tab" href="#configuraciones">Configuraciones</a></li>

  <li><a data-toggle="tab" href="#Catalogos">Catalogos</a></li>

  <li><a data-toggle="tab" href="#Cotizaciones">Cotizaciones</a></li>

  <li><a data-toggle="tab" href="#Ventas">Ventas</a></li>

  <li><a data-toggle="tab" href="#Reportes">Reportes</a></li>

</ul>



 <!-- CONTENIDO DE LAS PESTAÑAS -->
<div class="tab-content">

  <div id="configuraciones" class="tab-pane fade in active">

    <h3>Configuraciones</h3>

    <p>

   <!-- Check Configuraciones -->

    <div class="form-group">

      <div class="input-group">
        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="mConfiguraciones" data-on="Si" data-off="No">

            Menu Configuraciones

          </label>

        </div>
      </div>
    </div>

       <!-- Check datos empresa -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smDatosEmpresa" data-on="Si" data-off="No">

            Datos Empresa

          </label>

        </div>

      </div>

    </div>

   <!-- Check Usuarios -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smUsuarios" data-on="Si" data-off="No">

            Usuarios

          </label>

        </div>

      </div>

    </div>

       <!-- Check Perfiles -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smPerfiles" data-on="Si" data-off="No">

            Perfiles

          </label>

        </div>

      </div>

    </div>

   <!-- Configuracion de correo -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smConfiguracionCorreo" data-on="Si" data-off="No">

            Configuracion de Correo

          </label>

        </div>

      </div>

    </div>

     <!-- Bitacora -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smBitacora" data-on="Si" data-off="No">

            Bitacora

          </label>

        </div>

      </div>

    </div>



          <!-- Actualizar -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="actualizar" data-on="Si" data-off="No">

            Actualizar

          </label>

        </div>

      </div>

    </div>


    </p>
  </div>



  <!-- CATALOGOS -->
  <div id="Catalogos" class="tab-pane fade">

    <h3>Catalogos</h3>

    <p>


   <!-- Catalogo de clientes -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smClientes" data-on="Si" data-off="No">

            Catalogo de clientes

          </label>

        </div>

      </div>

    </div>


       <!-- Catalogo de productos -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smProductos" data-on="Si" data-off="No">

            Catalogo de Productos

          </label>

        </div>

      </div>

    </div>

      <!-- PERMITE EDITAR STOCK -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="stock" data-on="Si" data-off="No">

            Permite modificar stock

          </label>

        </div>

      </div>

    </div>




       <!-- Permite ver costo del producto-->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smCostoProductos" data-on="Si" data-off="No">

           Permite ver costos de productos

          </label>

        </div>

      </div>

    </div>


       <!-- Catalogo de Categorias -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="smCategorias" data-on="Si" data-off="No">

            Catalogo de Categorias

          </label>

        </div>

      </div>

    </div>

    <!-- Cajas -->

 <div class="form-group">

   <div class="input-group">

     <div class="checkbox">

       <label>

         <input type="checkbox" data-toggle="toggle" name="cajas" data-on="Si" data-off="No">

         Cajas

       </label>

     </div>

   </div>

 </div>

    </p>

  </div>


<!-- Pestaña Cotizaciones -->
  <div id="Cotizaciones" class="tab-pane fade">

    <h3>Cotizaciones </h3>

      <p>


       <!-- Menu de Cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="mCotizaciones" data-on="Si" data-off="No">

                Menu Cotizaciones

              </label>

            </div>

          </div>

        </div>

       <!-- Forma de Cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smCotizaciones" data-on="Si" data-off="No">

                Cotizaciones

              </label>

            </div>

          </div>

        </div>


       <!-- Administrar cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smAdministraCotizaciones" data-on="Si" data-off="No">

                Administrar Cotizaciones

              </label>

            </div>

          </div>
        </div>


        <!-- Modificar Cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smModificarCotizaciones" data-on="Si" data-off="No">

                Modificar Cotizaciones

              </label>

            </div>

          </div>
        </div>

        <!-- Eliminar Cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smEliminarCotizaciones" data-on="Si" data-off="No">

                Eliminar Cotizaciones

              </label>

            </div>

          </div>
        </div>

        </p>

      </div>

  <div id="Ventas" class="tab-pane fade">
    <h3>Ventas</h3>
    <p>

        <!-- Menu de Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="mVentas" data-on="Si" data-off="No">

                Menu Ventas

              </label>

            </div>

          </div>

        </div>




      <!-- Forma de Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smVentas" data-on="Si" data-off="No">

                Ventas

              </label>

            </div>

          </div>

        </div>


       <!-- Administrar Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smAdministraVentas" data-on="Si" data-off="No">

                Administrar Ventas

              </label>

            </div>

          </div>
        </div>


        <!-- Modificar Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smModificarVentas" data-on="Si" data-off="No">

                Modificar Ventas

              </label>

            </div>

          </div>
        </div>

        <!-- Eliminar Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smEliminarVentas" data-on="Si" data-off="No">

                Eliminar Ventas

              </label>

            </div>

          </div>
        </div>


        <!-- BOTON PARA HACER PAGOS -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smPagos" data-on="Si" data-off="No">

               Hacer pago

              </label>

            </div>

          </div>
        </div>




        <!-- HISTORICO DE PAGOS -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smHistoricoPagos" data-on="Si" data-off="No">

               Historico de pagos

              </label>

            </div>

          </div>
        </div>

        <!-- IMPRIMIR PAGO -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smImprimirPagos" data-on="Si" data-off="No">

               Imprimir Pago

              </label>

            </div>

          </div>
        </div>


        <!-- ELIMINAR PAGO -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smEliminarPagos" data-on="Si" data-off="No">

               Eliminar Pago

              </label>

            </div>

          </div>
        </div>



        <!-- Facturación Electronica -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smFacturacionElectronica" data-on="Si" data-off="No">

                Facturación Electronica

              </label>

            </div>

          </div>
        </div>

        <!-- Reportes de Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smReportesVentas" data-on="Si" data-off="No">

                Reportes de Ventas

              </label>

            </div>

          </div>
        </div>
      </p>
  </div>

  <!-- Ventas -->
  <div id="Reportes" class="tab-pane fade">

    <h3>Reportes</h3>

      <p>


      <!--Cajas Superiores -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="CajasSuperiores" data-on="Si" data-off="No">

                Cajas Superiores

              </label>

            </div>

          </div>
        </div>


        <!--Grafico de Ganancias -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="GraficoGanancias" data-on="Si" data-off="No">

                Grafico Ganancias

              </label>

            </div>

          </div>

        </div>

        <!--Productos Mas Vendidos -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="ProductosMasVendidos" data-on="Si" data-off="No">

                Productos Mas Vendidos

              </label>

            </div>

          </div>

        </div>

        <!--Productos Agregados Recientemente-->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="ProductosAgregadosRecienteMente" data-on="Si" data-off="No">

                Productos Agregados Recientemente

              </label>

            </div>

          </div>

        </div>

      </p>

  </div>

  </div>








          </div>

        </div>




        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Perfil</button>

        </div>

        <?php

          $crearPerfil= new ControladorPerfiles();
          $crearPerfil-> ctrCrearPerfil();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR PERFIL
======================================-->

<div id="modalEditarPerfil" class="modal fade" role="dialog">

  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Perfil</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA LA DESCRIPCION -->

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" value="" required>

              </div>

            </div>


              <!-- ENTRADA PARA EL ID DEL PERFIL -->

            <div class="form-group" hidden>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user"></i></span>

                <input type="text" class="form-control input-lg" id="idPerfil" name="idPerfil" value="" required>

              </div>

            </div>





 <!-- EMPEZAMMOS CON LAS PESTAÑAS -->
<ul class="nav nav-tabs">

  <li class="active"><a data-toggle="tab" href="#editarConfiguraciones">Configuraciones</a></li>

  <li><a data-toggle="tab" href="#editarCatalogos">Catalogos</a></li>

  <li><a data-toggle="tab" href="#editarCotizaciones">Cotizaciones</a></li>

  <li><a data-toggle="tab" href="#editarVentas">Ventas</a></li>

  <li><a data-toggle="tab" href="#editarReportes">Reportes</a></li>

</ul>



 <!-- CONTENIDO DE LAS PESTAÑAS -->
<div class="tab-content">

  <div id="editarConfiguraciones" class="tab-pane fade in active">

    <h3>Configuraciones</h3>

    <p>

   <!-- Check Configuraciones -->

    <div class="form-group">

      <div class="input-group">
        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarmConfiguraciones" id="editarmConfiguraciones" data-on="Si" data-off="No">

            Menu Configuraciones

          </label>

        </div>
      </div>
    </div>

       <!-- Check datos empresa -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmDatosEmpresa" id="editarsmDatosEmpresa" data-on="Si" data-off="No">

            Datos Empresa

          </label>

        </div>

      </div>

    </div>

   <!-- Check Usuarios -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmUsuarios" id="editarsmUsuarios" data-on="Si" data-off="No">

            Usuarios

          </label>

        </div>

      </div>

    </div>

       <!-- Check Perfiles -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmPerfiles" id="editarsmPerfiles" data-on="Si" data-off="No">

            Perfiles

          </label>

        </div>

      </div>

    </div>

   <!-- Configuracion de correo -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmConfiguracionCorreo" id="editarsmConfiguracionCorreo"  data-on="Si" data-off="No">

            Configuracion de Correo

          </label>

        </div>

      </div>

    </div>



       <!-- EDITAR DERECHO BITACORA-->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmBitacora" id="editarsmBitacora"  data-on="Si" data-off="No">

            Bitacora

          </label>

        </div>

      </div>

    </div>



    <!-- EDITAR DERECHO ACTUALIZAR-->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarActualizar" id="editarActualizar"  data-on="Si" data-off="No">

            Actualizar

          </label>

        </div>

      </div>

    </div>



    </p>
  </div>



  <!-- CATALOGOS -->
  <div id="editarCatalogos" class="tab-pane fade">

    <h3>Catalogos</h3>

    <p>


   <!-- Catalogo de clientes -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmClientes" id="editarsmClientes" data-on="Si" data-off="No">

            Catalogo de clientes

          </label>

        </div>

      </div>

    </div>


       <!-- Catalogo de productos -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmProductos" id="editarsmProductos" data-on="Si" data-off="No">

            Catalogo de Productos

          </label>

        </div>

      </div>

    </div>

           <!-- Permite Modificar stock -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarStock" id="editarStock" data-on="Si" data-off="No">

            Permite modicar stock

          </label>

        </div>

      </div>

    </div>


       <!-- Permite ver costos de producto -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmCostoProductos" id="editarsmCostoProductos" data-on="Si" data-off="No">

            Permite ver costos de producto

          </label>

        </div>

      </div>

    </div>


       <!-- Catalogo de Categorias -->

    <div class="form-group">

      <div class="input-group">

        <div class="checkbox">

          <label>

            <input type="checkbox" data-toggle="toggle" name="editarsmCategorias" id="editarsmCategorias" data-on="Si" data-off="No">

            Catalogo de Categorias

          </label>

        </div>

      </div>

    </div>


    <!-- Catalogo de Categorias -->

 <div class="form-group">

   <div class="input-group">

     <div class="checkbox">

       <label>

         <input type="checkbox" data-toggle="toggle" name="editarCajas" id="editarCajas" data-on="Si" data-off="No">

         Editar Cajas

       </label>

     </div>

   </div>

 </div>

    </p>

  </div>


<!-- Pestaña Cotizaciones -->
  <div id="editarCotizaciones" class="tab-pane fade">

    <h3>Cotizaciones </h3>

      <p>

       <!-- Menu Cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarmCotizaciones" id="editarmCotizaciones" data-on="Si" data-off="No">

                Menu Cotizaciones

              </label>

            </div>

          </div>

        </div>

       <!-- Forma de Cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmCotizaciones" id="editarsmCotizaciones" data-on="Si" data-off="No">

                Cotizaciones

              </label>

            </div>

          </div>

        </div>


       <!-- Administrar cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmAdministraCotizaciones" id="editarsmAdministraCotizaciones" data-on="Si" data-off="No">

                Administrar Cotizaciones

              </label>

            </div>

          </div>
        </div>


        <!-- Modificar Cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmModificarCotizaciones"  id="editarsmModificarCotizaciones" data-on="Si" data-off="No">

                Modificar Cotizaciones

              </label>

            </div>

          </div>
        </div>

        <!-- Eliminar Cotizaciones -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmEliminarCotizaciones" id="editarsmEliminarCotizaciones" data-on="Si" data-off="No">

                Eliminar Cotizaciones

              </label>

            </div>

          </div>
        </div>

        </p>

      </div>

  <div id="editarVentas" class="tab-pane fade">
    <h3>Ventas</h3>
    <p>

      <!-- Menu de Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarmVentas" id="editarmVentas" data-on="Si" data-off="No">

               Menu Ventas

              </label>

            </div>

          </div>

        </div>

      <!-- Forma de Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmVentas" id="editarsmVentas" data-on="Si" data-off="No">

                Ventas

              </label>

            </div>

          </div>

        </div>


       <!-- Administrar Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmAdministraVentas" id="editarsmAdministraVentas" data-on="Si" data-off="No">

                Administrar Ventas

              </label>

            </div>

          </div>
        </div>


        <!-- Modificar Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmModificarVentas" id="editarsmModificarVentas" data-on="Si" data-off="No">

                Modificar Ventas

              </label>

            </div>

          </div>
        </div>

        <!-- Eliminar Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmEliminarVentas" id="editarsmEliminarVentas" data-on="Si" data-off="No">

                Eliminar Ventas

              </label>

            </div>

          </div>
        </div>




        <!-- BOTON PARA HACER PAGOS -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smEditarPagos"  id="smEditarPagos" data-on="Si" data-off="No">

               Hacer pago

              </label>

            </div>

          </div>
        </div>




        <!-- HISTORICO DE PAGOS -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smEditarHistoricoPagos" id="smEditarHistoricoPagos" data-on="Si" data-off="No">

               Historico de pagos

              </label>

            </div>

          </div>
        </div>

        <!-- IMPRIMIR PAGO -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smEditarImprimirPagos"  id="smEditarImprimirPagos" data-on="Si" data-off="No">

               Imprimir Pago

              </label>

            </div>

          </div>
        </div>


        <!-- ELIMINAR PAGO -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="smEditarEliminarPagos" id="smEditarEliminarPagos" data-on="Si" data-off="No">

               Eliminar Pago

              </label>

            </div>

          </div>
        </div>



        <!-- Facturacion Electronica -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsFacturacionElectronica" id="editarsFacturacionElectronica" data-on="Si" data-off="No">

                Facturación Electronica

              </label>

            </div>

          </div>
        </div>

        <!-- Reportes de Ventas -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarsmReportesVentas" id="editarsmReportesVentas" data-on="Si" data-off="No">

                Reportes de Ventas

              </label>

            </div>

          </div>
        </div>
      </p>
  </div>

  <!-- Ventas -->
  <div id="editarReportes" class="tab-pane fade">

    <h3>Reportes</h3>

      <p>


      <!--Cajas Superiores -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarCajasSuperiores" id="editarCajasSuperiores" data-on="Si" data-off="No">

                Cajas Superiores

              </label>

            </div>

          </div>
        </div>


        <!--Grafico de Ganancias -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarGraficoGanancias" id="editarGraficoGanancias" data-on="Si" data-off="No">

                Grafico Ganancias

              </label>

            </div>

          </div>

        </div>

        <!--Productos Mas Vendidos -->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarProductosMasVendidos" id="editarProductosMasVendidos" data-on="Si" data-off="No">

                Productos Mas Vendidos

              </label>

            </div>

          </div>

        </div>

        <!--Productos Agregados Recientemente-->

        <div class="form-group">

          <div class="input-group">

            <div class="checkbox">

              <label>

                <input type="checkbox" data-toggle="toggle" name="editarroductosAgregadosRecienteMente" id="editarroductosAgregadosRecienteMente" data-on="Si" data-off="No">

                Productos Agregados Recientemente

              </label>

            </div>

          </div>

        </div>

      </p>

  </div>

  </div>










          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Perfil</button>

        </div>

     <?php

          $editarPerfil = new ControladorPerfiles();
          $editarPerfil -> ctrEditarPerfil();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarPerfil = new ControladorPerfiles();
  $borrarPerfil-> ctrBorrarPerfil();

?>
