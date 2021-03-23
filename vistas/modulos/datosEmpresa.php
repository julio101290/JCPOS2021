<?php
if($_SESSION["datosEmpresa"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">
  <section class="content-header">
    
    <h1>
      
      Datos Empresa 
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Datos Empresa </li>
    
    </ol>

  </section>

  <section class="content">
    
    <div class="box">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre Empresa</th>
           <th>Direccion</th>
           <th>RFC</th>
           <th>Telefono</th>
           <th>Correo Electronico</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
		
		  <?php

        $item = null;
        $valor = null;

       $empresa= ControladorEmpresa::ctrMostrarEmpresas($item, $valor);
       
       foreach ($empresa as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["NombreEmpresa"].'</td>
                  <td>'.$value["DireccionEmpresa"].'</td>
				  <td>'.$value["RFC"].'</td>
				  <td>'.$value["Telefono"].'</td>
				  <td>'.$value["correoElectronico"].'</td>
         '


          ;

				 

                       
                  echo '
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarEmpresa" idEmpresa="'.$value["NombreEmpresa"].'" data-toggle="modal" data-target="#modalEditarEmpresa"><i class="fa fa-pencil"></i></button>

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
MODAL EDITAR EMPRESA
======================================-->

<div id="modalEditarEmpresa" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar empresa</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-institution"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombreEmpresa" name="editarNombreEmpresa" value="" required placeholder="Ingresar Nombre">

              </div>

            </div>
			
			            <!-- ENTRADA PARA LA DIRECCION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-pin"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDireccionEmpresa" name="editarDireccionEmpresa" value="" required placeholder="Ingresar Direccion">

              </div>

            </div>
			
			            <!-- ENTRADA PARA EL RFC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-qrcode"></i></span> 

                <input type="text" class="form-control input-lg" id="editarRFC" name="editarRFC" value="" required placeholder="Ingresar RFC">

              </div>

            </div>
			
			            <!-- ENTRADA PARA EL TELEFONO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-mobile-phone"></i></span> 

                <input type="text" class="form-control input-lg" id="editarTelefonoEmpresa" name="editarTelefonoEmpresa" value="" required placeholder="Ingresar Telefono">

              </div>

            </div>

					<!-- ENTRADA PARA EL CORREO ELECTRONICO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span> 

                <input type="text" class="form-control input-lg" id="editarCorreoElectronicoEmpresa" name="editarCorreoElectronicoEmpresa" value="" required placeholder="Ingresar Correo Electronico">

              </div>

            </div>

                      <!-- ENTRADA PARA DIAS ENTREGA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hourglass-start"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDiasEntrega" name="editarDiasEntrega" value=""  placeholder="Dias de entrega">

              </div>

            </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>
  </form>
     <?php

          $editarEmpresa = new ControladorEmpresa();
          $editarEmpresa -> ctrEditarEmpresa();

        ?> 

    

    </div>

  </div>

</div>

</div>
</div>
