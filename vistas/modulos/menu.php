<aside class="main-sidebar">

	 <section class="sidebar">

		<ul class="sidebar-menu">

		    <div class="user-panel">
		<div class="pull-left image">
		 
			  <?php

			if($_SESSION["foto"] != ""){

				echo '<img src="'.$_SESSION["foto"].'" class="img-circle" alt="User Image">';

			}else{


				echo '<img src="vistas/img/usuarios/default/anonymous.png" class="img-circle" alt="User Image">';

			}

			?>
			  
			  
		</div>
		<div class="pull-left info">
		  <p><?php  echo $_SESSION["nombre"]; ?></p>
		  <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
		</div>
	      </div>
			 <!-- search form -->
	      <form action="#" method="get" class="sidebar-form">
		<div class="input-group">
		  <input type="text" name="search" id="search" class="form-control search-menu-box" placeholder="Buscar...">
		</div>
	      </form>
		
		<?php

				
		//MENU COTIZACONES
		
		if($_SESSION["menuCotizaciones"] == "on"){
			echo '<li '.strMenuActivo($_GET["ruta"],"crearcotizacion").strMenuActivo($_GET["ruta"],"administrarcotizaciones").' class="treeview">

					<a href="#">

						<i class="fa fa-tty"></i>
						
						<span>Cotizaciones</span>
						
						<span class="pull-right-container">
						
							<i class="fa fa-angle-left pull-right"></i>

						</span>

					</a>
					<ul class="treeview-menu">';


				if($_SESSION["cotizaciones"] == "on"){
					echo '<li>

						<a href="crearcotizacion" accesskey="c">
							
							<i class="fa fa-file"></i>
							<span>Nueva Cotización</span>

						</a>

					</li>';
				}

				if($_SESSION["administrarCotizaciones"] == "on"){
					echo '	<li>

							<a href="administrarcotizaciones" accesskey="x">
								
								<i class="fa fa-check-circle"></i>
								<span>Ver cotizaciones</span>

							</a>

						</li>';
				}

			echo '	
			</ul>
	
	</li>
			';
		}

		if($_SESSION["menuVentas"] == "on" ){

			echo '<li '.strMenuActivo($_GET["ruta"],"ventas").' class="treeview">

				<a href="#">

					<i class="fa fa-list-ul"></i>
					
					<span>Ventas</span>
					
					<span class="pull-right-container">
					
						<i class="fa fa-angle-left pull-right"></i>

					</span>

				</a>

				<ul class="treeview-menu">';
					
				if($_SESSION["administrarVentas"] == "on" ){
					echo	'<li>

							<a href="ventas">
								
								<i class="fa fa-circle-o"></i>
								<span>Administrar ventas</span>

							</a>

						</li>';

				}

					
				if($_SESSION["ventas"] == "on" ){
					echo '<li>

						<a href="crear-venta">
							
							<i class="fa fa-circle-o"></i>
							<span>Crear venta</span>

						</a>
						</li>';
					}
						
				if($_SESSION["facturacionElectronica"] == "on" ){
						echo '<li>
							<a href="facturacionElectronica">
							
							<i class="fa fa-circle-o"></i>
							<span>Facturación Electronica</span>

						</a>

					</li>';
				}


				if("on" == "on" ){
						echo '<li>
							<a href="ventasProductos">
							
							<i class="fa fa-circle-o"></i>
							<span>Rep Ventas por producto</span>

						</a>

					</li>';
				}

					if($_SESSION["reportesVentas"] == "on"){

					echo '<li>

						<a href="reportes">
							
							<i class="fa fa-circle-o"></i>
							<span>Reporte de ventas</span>

						</a>

					</li>';

					}

				

				echo '</ul>

			</li>';
		}
		




		if($_SESSION["categorias"] == "on"){

			echo '<li '.strMenuActivo($_GET["ruta"],"categorias").'>

				<a href="categorias">

					<i class="fa fa-th"></i>
					<span>Categorías</span>

				</a>

			</li>';

		}

		if($_SESSION["productos"] == "on"){

			echo '<li '.strMenuActivo($_GET["ruta"],"productos").'>

				<a href="productos">

					<i class="fa fa-product-hunt"></i>
					<span>Productos</span>

				</a>

			</li>';
		}

	

		if($_SESSION["clientes"] == "on"){

			echo '<li '.strMenuActivo($_GET["ruta"],"clientes").'>

				<a href="clientes">

					<i class="fa fa-users"></i>
					<span>Clientes</span>

				</a>

			</li>';

		}

		if($_SESSION["menuConfiguraciones"] == "on"){
			echo '<li '.strMenuActivo($_GET["ruta"],"datosEmpresa").strMenuActivo($_GET["ruta"],"usuarios").' class="treeview">

					<a href="#">

						<i class="fa fa-cogs"></i> 
						<span>Configuraciones</span>
						
						<span class="pull-right-container">
						
							<i class="fa fa-angle-left pull-right"></i>

						</span>

					</a>

				<ul class="treeview-menu">';

				if($_SESSION["datosEmpresa"] == "on"){
					echo '

						<li '.strMenuActivo($_GET["ruta"],"datosEmpresa").'>

							<a href="datosEmpresa">

								<i class="fa fa-building-o"></i>
								<span>Datos Empresa</span>
							</a>
						
						</li>';
				}



				if($_SESSION["usuarios"] == "on"){
					echo '

					 <li '.strMenuActivo($_GET["ruta"],"usuarios").'>

						<a href="usuarios">

							<i class="fa fa-user"></i>
							<span>Usuarios</span>

						</a>

					</li> ';

				}

				
				if($_SESSION["perfiles"] == "on"){
					echo '
					

					<li '.strMenuActivo($_GET["ruta"],"perfiles").'>

							<a href="perfiles">

								<i class="fa fa-users"></i>
								<span>Perfiles</span>

							</a>

						</li>';
				}


				if($_SESSION["configuracionCorreo"] == "on"){
					echo '
					 <li '.strMenuActivo($_GET["ruta"],"configurarCorreo").'>

						<a href="configurarCorreo">

							<i class="fa fa-envelope-square"></i>
							<span>Configurar Correo</span>

						</a>

					</li>';
				}

			if($_SESSION["bitacora"] == "on"){	
				echo '
					 <li '.strMenuActivo($_GET["ruta"],"bitacora").'>

						<a href="bitacora">

							<i class="fa fa-navicon"></i>
							<span>Bitacora</span>

						</a>

					</li>';
				}

				echo '
				</ul>' ;

		
		}



		?>

		</ul>

	 </section>

</aside>

<script> 


	$(document).ready(function () {


	$("#search").on("keyup", function () {
	if (this.value.length > 0) {   
	  $(".sidebar-menu li").hide().filter(function () {
	    return $(this).text().toLowerCase().indexOf($("#search").val().toLowerCase()) != -1;
	  }).show(); 
	}  
	else { 
	  $(".sidebar-menu li").show();
	}
	}); 

	});

</script> 


