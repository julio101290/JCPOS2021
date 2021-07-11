<?php
/* 
 * 
 * PARA MAS APOYO SOBRE ESTE CAMBIO VER ESTE VIDEO https://www.youtube.com/watch?v=YfFky-eBh-k
 */
if($_SESSION["iniciarSesion"] != "ok"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;
}

?>

<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Cambiar Contraseña
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Cambiar Contraseña</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


      </div>

<div class="box-body">
<form role="form" method="post" enctype="multipart/form-data">
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input disabled="" type="text" class="form-control input-lg" id="nombre" name="nombre" value="<?php echo $_SESSION["nombre"]; ?>" required="">

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input disabled="" type="text" class="form-control input-lg" id="usuario" name="usuario"  value="<?php echo $_SESSION["usuario"]; ?>" readonly="">

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Escriba la nueva contraseña">
                
                <?php
                
                    $idUsuario =  $_SESSION["id"];
                
                    $usuario = ModeloUsuarios::mdlMostrarUsuarios("usuarios", "id", $idUsuario)
                
                ?>

                <input type="hidden" id="passwordActual" name="passwordActual"  value="<?php echo $usuario["password"]; ?>">
                <input type="hidden" id="cambiarPassword" name="cambiarPassword"  value="cambiarPassword">

              </div>

            </div>


            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="<?php echo $usuario["foto"]; ?>" class="img-thumbnail previsualizarEditar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual" value="">

            </div>
<div class="pull-right">
    
<button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>
</div>
          </div>

    </div>

  </section>

</div>

<?php

$guardarContra = ControladorUsuarios::ctrCambiarContra();
