<?php

if($_SESSION["configuracionCorreo"] == "off"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Configuración de Correo Electronico 
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Configuración de Correo Electronico  </li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Correo Electronico</th>
           <th>Host</th>
           <th>SMTPDebug</th>
           <th>SMTPAuth</th>
           <th>Puerto</th>

           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
		
		  <?php

        $item = null;
        $valor = null;

       $correo= ControladorCorreo::ctrMostrarCorreo();
       
       foreach ($correo as $key => $value){
         
          echo ' <tr>
                  <td>'.($key+1).'</td>
                  <td>'.$value["correoSaliente"].'</td>
                  <td>'.$value["host"].'</td>
				  <td>'.$value["SMTPDebug"].'</td>
				  <td>'.$value["SMTPAuth"].'</td>
				  <td>'.$value["Puerto"].'</td>
         '


          ;

				 

                       
                  echo '
                  <td>

                    <div class="btn-group">
                        
                      <button class="btn btn-warning btnEditarCorreo" data-toggle="modal" data-target="#modalEditarCorreo"><i class="fa fa-pencil"></i></button>

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
MODAL EDITAR DATOS CORREO
======================================-->

<div id="modalEditarCorreo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Correo Electronico Saliente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CORREO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i>@</i></span> 

                <input type="text" class="form-control input-lg" id="editarCorreoSaliente" name="editarCorreoSaliente" value="" required placeholder="Ingresar Correo">

              </div>

            </div>
			
	           

             <!-- ENTRADA PARA EL HOST -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-server"></i></i></span> 

                <input type="text" class="form-control input-lg" id="editarHost" name="editarHost" value="" required placeholder="Ingresar host">

              </div>

            </div>
			       






          <!-- ENTRADA SMTP Debug -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa  fa-gear"></i></span> 

                <select class="form-control input-lg" name="editarSMTPDebug" id="editarSMTPDebug">
                  
                  <option value="" id="editarSMTPDebug"></option>

                  <option value="0">DEBUG_OFF</option>

                  <option value="1">DEBUG_CLIENT</option>

                  <option value="2">DEBUG_SERVER</option>

                </select>

              </div>

            </div>


            <!-- ENTRADA SMTP Auth -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa  fa-gear"></i></span> 

                <select class="form-control input-lg" name="editarSMTPAuth" id="editarSMTPAuth">
                  
                  <option value="" id="editarSMTPAuth"></option>

                  <option value="0">Sin autentificación</option>

                  <option value="1">Con autentificación</option>


                </select>

              </div>

            </div>


            <!-- ENTRADA SMTP Secure -->
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa  fa-gear"></i></span> 

                <select class="form-control input-lg" name="editarSMTPSeguridad" id="editarSMTPSeguridad">
                  
                  <option value="" id="editarSMTPSeguridad"></option>

                  <option value="">Sin Seguridad</option>
                  <option value="ssl">Seguridad SSL</option>
                  <option value="tls">Seguridad TLS</option>


                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL PUERTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa  fa-gear"></i></span> 

                <input type="text" class="form-control input-lg" id="editarPuerto" name="editarPuerto" value=""  placeholder="Ingrese el numero puerto">

              </div>

            </div>


            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" id="nuevoPassword"  placeholder="Ingresar contraseña" required>

              </div>

            </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar Correo</button>

        </div>
  </form>
     <?php

          $editarCorreo = new ControladorCorreo();
          $editarCorreo -> ctrEditarCorreo();

        ?> 

    

    </div>

  </div>

</div>

</div>
</div>
