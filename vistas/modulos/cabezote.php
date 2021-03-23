 <header class="main-header">
 	
	<!--=====================================
	LOGOTIPO
	======================================-->
	<a href="inicio" class="logo">
		
		<!-- logo mini -->
		<span class="logo-mini">
			
			<img src="vistas/img/plantilla/icono-blanco.png" class="img-responsive" style="padding:10px">

		</span>

		<!-- logo normal -->

		<span class="logo-lg">
			
			<img src="vistas/img/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding:10px 0px">

		</span>

	</a>

	<!--=====================================
	BARRA DE NAVEGACIÓN
	======================================-->
	<nav class="navbar navbar-static-top" role="navigation">
		
		<!-- Botón de navegación -->

	 	<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        	
        	<span class="sr-only">Toggle navigation</span>
      	
      	</a>

      	  <ul class="nav navbar-nav">
            
          	<?php

          	if($_SESSION["administrarVentas"] == "on" ){
            	echo '<li><a href="ventas">Administrar Ventas <span class="sr-only">(current)</span></a></li>';
        	}
            
            ?>



            
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Catálogos <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                
              	<?php
	               if($_SESSION["categorias"] == "on"){
	                	echo '<li><a href="categorias">Categorias</a></li>';
	            	}
	                
                	if($_SESSION["productos"] == "on"){
	                	echo '<li><a href="productos">Productos</a></li>';
	                }
	                
	                if($_SESSION["clientes"] == "on"){
	                	echo '<li><a href="clientes">Clientes</a></li>';
	            	}
                ?>
               <!-- <li class="divider"></li>-->
               <!-- <li><a href="#">Separated link</a></li>-->
               <!-- <li class="divider"></li>-->
               <!-- <li><a href="#">One more separated link</a></li>-->
              </ul>
            </li>
          </ul>

		<!-- perfil de usuario -->

		<div class="navbar-custom-menu">
				
			<ul class="nav navbar-nav">


				
				<li class="dropdown user user-menu">
					
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">

					<?php

					if($_SESSION["foto"] != ""){

						echo '<img src="'.$_SESSION["foto"].'" class="user-image">';

					}else{


						echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';

					}
					?>
						
						<span class="hidden-xs"><?php  echo $_SESSION["nombre"]; ?></span>

					</a>

					<!-- Dropdown-toggle -->

					<ul class="dropdown-menu">
						
						<li class="user-header">
							<!--<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
								<?php

								if($_SESSION["foto"] != ""){

									echo '<img src="'.$_SESSION["foto"].'" class="img-circle" alt="User Image">';

								}else{


									echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle" alt="User Image">';

								}
								?>

							<p>
							 <?php  echo $_SESSION["nombre"]."-".$_SESSION["descripcionPerfil"]; ?>
							  <!--<small>Ultimo Login  <?php  //echo $_SESSION["ultimoLogin"]; ?></small> -->
							</p>
						</li>
						<li class="user-body">
							
							<div class="pull-right">
								
								<a href="salir" class="btn btn-default btn-flat">Salir</a>

							</div>

						</li>

					</ul>

				</li>

			</ul>

		</div>

	</nav>

 </header>