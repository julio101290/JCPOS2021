<?php

require_once "conexion.php";

class ModeloPerfiles{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarPerfiles($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT perfil
                                                                        ,descripcion

                                                                         ,(case when menuConfiguraciones='on' then 'on'
                                                                                       else 'off'
                                                                                       end) as menuConfiguraciones

                                                                         ,(case when datosEmpresa='on' then 'on'
                                                                                       else 'off'
                                                                                       end ) as datosEmpresa

                                                                         ,(case when usuarios='on' then 'on'
                                                                               else 'off'
                                                                               end) as usuarios

                                                                         ,(case when perfiles='on' then 'on'
                                                                                        else 'off'
                                                                                        end) as perfiles

                                                                         ,(case when configuracionCorreo='on' then 'on' else 'off'
                                                                                       end )as configuracionCorreo




                                                                         ,(case when clientes='on' then 'on' else 'off'
                                                                                       end )as clientes

                                                                         ,(case when productos='on' then 'on' else 'off'
                                                                                        end )as productos

                                                                         ,(case when categorias='on' then 'on' else 'off'
                                                                                         end )as categorias


                                                                       ,(case when menuCotizaciones='on' then 'on' else 'off'
                                                                                       end )as menuCotizaciones

                                                                         ,(case when cotizaciones='on' then 'on' else 'off'
                                                                                       end )as cotizaciones

                                                                         ,(case when administrarCotizaciones='on' then 'on' else 'off'
                                                                                        end )as administrarCotizaciones

                                                                         ,(case when modificarCotizaciones='on' then 'on' else 'off'
                                                                                         end )as modificarCotizaciones

                                                                         ,(case when eliminarCotizaciones='on' then 'on' else 'off'
                                                                                         end )as eliminarCotizaciones






                                                                       ,(case when menuVentas='on' then 'on' else 'off'
                                                                                        end )as menuVentas

                                                                       ,(case when ventas='on' then 'on' else 'off'
                                                                                         end )as ventas


                                                                       ,(case when administrarVentas='on' then 'on' else 'off'
                                                                                       end )as administrarVentas

                                                                         ,(case when modificarVentas='on' then 'on' else 'off'
                                                                                       end )as modificarVentas

                                                                         ,(case when eliminarVentas='on' then 'on' else 'off'
                                                                                        end )as eliminarVentas

                                                                         ,(case when facturacionElectronica='on' then 'on' else 'off'
                                                                                         end )as facturacionElectronica

                                                                         ,(case when reportesVentas='on' then 'on' else 'off'
                                                                                         end )as reportesVentas




                                                                         ,(case when cajasSuperiores='on' then 'on' else 'off'
                                                                                       end )as cajasSuperiores

                                                                         ,(case when graficoGanancias='on' then 'on' else 'off'
                                                                                        end )as graficoGanancias

                                                                         ,(case when productosMasVendidos='on' then 'on' else 'off'
                                                                                         end )as productosMasVendidos

                                                                         ,(case when productosAgregadosRecientemente='on' then 'on' else 'off'
                                                                                         end )as productosAgregadosRecientemente



                                                                         ,(case when bitacora='on' then 'on' else 'off'
                                                                                         end )as bitacora


                                                                         ,(case when pagos='on' then 'on' else 'off'
                                                                                        end )as pagos

                                                                         ,(case when historicoPagos='on' then 'on' else 'off'
                                                                                         end )as historicoPagos

                                                                         ,(case when imprimirPagos='on' then 'on' else 'off'
                                                                                         end )as imprimirPagos



                                                                         ,(case when eliminarPagos='on' then 'on' else 'off'
                                                                                         end )as eliminarPagos


                                                                         ,(case when costoProductos='on' then 'on' else 'off'
                                                                                         end )as costoProductos

                                                                         ,(case when stock='on' then 'on' else 'off'
                                                                                         end )as stock


                                                                        ,(case when actualizar='on' then 'on' else 'off'
                                                                                         end ) as actualizar

																																				,(case when cajas='on' then 'on' else 'off'
	                                                                                        end ) as cajas



                                                               FROM $tabla

                                                               WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT perfil
                                                                    ,descripcion

                                                                    ,(case when menuConfiguraciones='on' then 'on'
                                                                                  else 'off'
                                                                                  end) as menuConfiguraciones

                                                                    ,(case when datosEmpresa='on' then 'on'
                                                                                  else 'off'
                                                                                  end ) as datosEmpresa

                                                                    ,(case when usuarios='on' then 'on'
                                                                          else 'off'
                                                                          end) as usuarios

                                                                    ,(case when perfiles='on' then 'on'
                                                                                   else 'off'
                                                                                   end) as perfiles

                                                                    ,(case when configuracionCorreo='on' then 'on' else 'off'
                                                                                  end )as configuracionCorreo



                                                                    ,(case when clientes='on' then 'on' else 'off'
                                                                                  end )as clientes

                                                                    ,(case when productos='on' then 'on' else 'off'
                                                                                   end )as productos

                                                                    ,(case when categorias='on' then 'on' else 'off'
                                                                                    end )as categorias


                                                                  ,(case when menuCotizaciones='on' then 'on' else 'off'
                                                                                  end )as menuCotizaciones

                                                                    ,(case when cotizaciones='on' then 'on' else 'off'
                                                                                  end )as cotizaciones

                                                                    ,(case when administrarCotizaciones='on' then 'on' else 'off'
                                                                                   end )as administrarCotizaciones

                                                                    ,(case when modificarCotizaciones='on' then 'on' else 'off'
                                                                                    end )as modificarCotizaciones

                                                                    ,(case when eliminarCotizaciones='on' then 'on' else 'off'
                                                                                    end )as eliminarCotizaciones




                                                                  ,(case when menuVentas='on' then 'on' else 'off'
                                                                                   end )as menuVentas

                                                                  ,(case when ventas='on' then 'on' else 'off'
                                                                                    end )as ventas


                                                                  ,(case when administrarVentas='on' then 'on' else 'off'
                                                                                  end )as administrarVentas

                                                                    ,(case when modificarVentas='on' then 'on' else 'off'
                                                                                  end )as modificarVentas

                                                                    ,(case when eliminarVentas='on' then 'on' else 'off'
                                                                                   end )as eliminarVentas

                                                                    ,(case when facturacionElectronica='on' then 'on' else 'off'
                                                                                    end )as facturacionElectronica

                                                                    ,(case when reportesVentas='on' then 'on' else 'off'
                                                                                    end )as reportesVentas



                                                                    ,(case when cajasSuperiores='on' then 'on' else 'off'
                                                                                  end )as cajasSuperiores

                                                                    ,(case when graficoGanancias='on' then 'on' else 'off'
                                                                                   end )as graficoGanancias

                                                                    ,(case when productosMasVendidos='on' then 'on' else 'off'
                                                                                    end )as productosMasVendidos

                                                                    ,(case when productosAgregadosRecientemente='on' then 'on' else 'off'
                                                                                    end )as productosAgregadosRecientemente

                                                                    ,(case when bitacora='on' then 'on' else 'off'
                                                                                    end )as bitacora


                                                                    ,(case when bitacora='on' then 'on' else 'off'
                                                                                    end )as bitacora


                                                                    ,(case when pagos='on' then 'on' else 'off'
                                                                                   end )as pagos

                                                                    ,(case when historicoPagos='on' then 'on' else 'off'
                                                                                    end )as historicoPagos

                                                                    ,(case when imprimirPagos='on' then 'on' else 'off'
                                                                                    end )as imprimirPagos



                                                                    ,(case when eliminarPagos='on' then 'on' else 'off'
                                                                                    end )as eliminarPagos


                                                                    ,(case when costoProductos='on' then 'on' else 'off'
                                                                                    end )as costoProductos

                                                                    ,(case when stock='on' then 'on' else 'off'
                                                                                    end )as stock

                                                                    ,(case when actualizar='on' then 'on' else 'off'
                                                                                         end ) as actualizar

																																	 ,(case when cajas='on' then 'on' else 'off'
																																											end ) as cajas

                                                     FROM
                                                     $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE PERFIL
	=============================================*/

	static public function mdlIngresarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(descripcion

                                                                        ,menuConfiguraciones
                                                                        ,datosEmpresa
                                                                        ,usuarios
                                                                        ,perfiles
                                                                        ,configuracionCorreo

                                                                        ,clientes
                                                                        ,productos
                                                                        ,categorias

                                                                        ,menuCotizaciones
                                                                        ,cotizaciones
                                                                        ,administrarCotizaciones
                                                                        ,modificarCotizaciones
                                                                        ,eliminarCotizaciones


                                                                        ,menuVentas
                                                                        ,ventas
                                                                        ,administrarVentas
                                                                        ,modificarVentas
                                                                        ,eliminarVentas
                                                                        ,facturacionElectronica
                                                                        ,reportesVentas

                                                                        ,cajasSuperiores
                                                                        ,graficoGanancias
                                                                        ,productosMasVendidos
                                                                        ,productosAgregadosRecientemente
                                                                        ,bitacora

                                                                        ,pagos
                                                                        ,historicoPagos
                                                                        ,imprimirPagos
                                                                        ,eliminarPagos
                                                                        ,costoProductos
                                                                        ,stock
                                                                        ,actualizar
																																				,cajas

                                                                        )
                                                        VALUES (:descripcion

                                                                        ,:menuConfiguraciones
                                                                        ,:datosEmpresa
                                                                        ,:usuarios
                                                                        ,:perfiles
                                                                        ,:configuracionCorreo

                                                                        ,:clientes
                                                                        ,:productos
                                                                        ,:categorias

                                                                        ,:menuCotizaciones
                                                                        ,:cotizaciones
                                                                        ,:administrarCotizaciones
                                                                        ,:modificarCotizaciones
                                                                        ,:eliminarCotizaciones

                                                                        ,:menuVentas
                                                                        ,:ventas
                                                                        ,:administrarVentas
                                                                        ,:modificarVentas
                                                                        ,:eliminarVentas
                                                                        ,:facturacionElectronica
                                                                        ,:reportesVentas

                                                                        ,:cajasSuperiores
                                                                        ,:graficoGanancias
                                                                        ,:productosMasVendidos
                                                                        ,:productosAgregadosRecientemente
                                                                        ,:bitacora

                                                                        ,:pagos
                                                                        ,:historicoPagos
                                                                        ,:imprimirPagos
                                                                        ,:eliminarPagos
                                                                        ,:costoProductos
                                                                        ,:stock
                                                                        ,:actualizar
																																				,:cajas
                                                                )");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);

		$stmt->bindParam(":menuConfiguraciones", $datos["menuConfiguraciones"], PDO::PARAM_STR);
		$stmt->bindParam(":datosEmpresa", $datos["datosEmpresa"], PDO::PARAM_STR);
		$stmt->bindParam(":usuarios", $datos["usuarios"], PDO::PARAM_STR);
		$stmt->bindParam(":perfiles", $datos["perfiles"], PDO::PARAM_STR);
		$stmt->bindParam(":configuracionCorreo", $datos["configuracionCorreo"], PDO::PARAM_STR);

		$stmt->bindParam(":clientes", $datos["clientes"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":categorias", $datos["categorias"], PDO::PARAM_STR);

		$stmt->bindParam(":menuCotizaciones", $datos["menuCotizaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":cotizaciones", $datos["cotizaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":administrarCotizaciones", $datos["administrarCotizaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":modificarCotizaciones", $datos["modificarCotizaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":eliminarCotizaciones", $datos["eliminarCotizaciones"], PDO::PARAM_STR);

		$stmt->bindParam(":menuVentas", $datos["menuVentas"], PDO::PARAM_STR);
		$stmt->bindParam(":ventas", $datos["ventas"], PDO::PARAM_STR);
		$stmt->bindParam(":administrarVentas", $datos["administrarVentas"], PDO::PARAM_STR);
		$stmt->bindParam(":modificarVentas", $datos["modificarVentas"], PDO::PARAM_STR);
		$stmt->bindParam(":eliminarVentas", $datos["eliminarVentas"], PDO::PARAM_STR);
		$stmt->bindParam(":facturacionElectronica", $datos["facturacionElectronica"], PDO::PARAM_STR);
		$stmt->bindParam(":reportesVentas", $datos["reportesVentas"], PDO::PARAM_STR);

		$stmt->bindParam(":cajasSuperiores", $datos["cajasSuperiores"], PDO::PARAM_STR);
		$stmt->bindParam(":graficoGanancias", $datos["graficoGanancias"], PDO::PARAM_STR);
		$stmt->bindParam(":productosMasVendidos", $datos["productosMasVendidos"], PDO::PARAM_STR);
		$stmt->bindParam(":productosAgregadosRecientemente", $datos["productosAgregadosRecientemente"], PDO::PARAM_STR);
		$stmt->bindParam(":bitacora", $datos["bitacora"], PDO::PARAM_STR);


		$stmt->bindParam(":pagos", $datos["pagos"], PDO::PARAM_STR);
		$stmt->bindParam(":historicoPagos", $datos["historicoPagos"], PDO::PARAM_STR);
		$stmt->bindParam(":imprimirPagos", $datos["imprimirPagos"], PDO::PARAM_STR);
		$stmt->bindParam(":eliminarPagos", $datos["eliminarPagos"], PDO::PARAM_STR);
		$stmt->bindParam(":costoProductos", $datos["costoProductos"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
    $stmt->bindParam(":actualizar", $datos["actualizar"], PDO::PARAM_STR);
		$stmt->bindParam(":cajas", $datos["cajas"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();

		$stmt = null;

	}

	/*=============================================
	EDITAR PERFIL
	=============================================*/

	static public function mdlEditarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla
                                                            SET descripcion = :descripcion

                                                                    ,menuConfiguraciones = :menuConfiguraciones
                                                                    ,datosEmpresa = :datosEmpresa
                                                                    ,usuarios = :usuarios
                                                                    ,perfiles = :perfiles
                                                                    ,configuracionCorreo = :configuracionCorreo

                                                                    ,clientes= :clientes
                                                                    ,productos= :productos
                                                                    ,categorias= :categorias

                                                                    ,menuCotizaciones= :menuCotizaciones
                                                                    ,cotizaciones= :cotizaciones
                                                                    ,administrarCotizaciones= :administrarCotizaciones
                                                                    ,modificarCotizaciones= :modificarCotizaciones
                                                                    ,eliminarCotizaciones= :eliminarCotizaciones

                                                                    ,menuVentas= :menuVentas
                                                                    ,ventas= :ventas
                                                                    ,administrarVentas= :administrarVentas
                                                                    ,modificarVentas= :modificarVentas
                                                                    ,eliminarVentas= :eliminarVentas
                                                                    ,facturacionElectronica= :facturacionElectronica
                                                                    ,reportesVentas= :reportesVentas

                                                                    ,cajasSuperiores= :cajasSuperiores
                                                                    ,graficoGanancias= :graficoGanancias
                                                                    ,productosMasVendidos= :productosMasVendidos
                                                                    ,productosAgregadosRecientemente= :productosAgregadosRecientemente
                                                                    ,bitacora= :bitacora


                                                                    ,pagos= :pagos
                                                                    ,historicoPagos= :historicoPagos
                                                                    ,imprimirPagos= :imprimirPagos
                                                                    ,eliminarPagos= :eliminarPagos

                                                                    ,costoProductos= :costoProductos
                                                                    ,stock= :stock
                                                                    ,actualizar= :actualizar
																																		,cajas= :cajas
                                                            WHERE perfil = :perfil"
                                                            );


		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt->bindParam(":menuConfiguraciones", $datos["menuConfiguraciones"], PDO::PARAM_STR);
		$stmt->bindParam(":datosEmpresa", $datos["datosEmpresa"], PDO::PARAM_STR);
		$stmt->bindParam(":usuarios", $datos["usuarios"], PDO::PARAM_STR);
		$stmt->bindParam(":perfiles", $datos["perfiles"], PDO::PARAM_STR);
		$stmt->bindParam(":configuracionCorreo", $datos["configuracionCorreo"], PDO::PARAM_STR);

		$stmt->bindParam(":clientes", $datos["clientes"], PDO::PARAM_STR);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":categorias", $datos["categorias"], PDO::PARAM_STR);


		$stmt->bindParam(":menuCotizaciones", $datos["menuCotizaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":cotizaciones", $datos["cotizaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":administrarCotizaciones", $datos["administrarCotizaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":modificarCotizaciones", $datos["modificarCotizaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":eliminarCotizaciones", $datos["eliminarCotizaciones"], PDO::PARAM_STR);

		$stmt->bindParam(":menuVentas", $datos["menuVentas"], PDO::PARAM_STR);
		$stmt->bindParam(":ventas", $datos["ventas"], PDO::PARAM_STR);
		$stmt->bindParam(":administrarVentas", $datos["administrarVentas"], PDO::PARAM_STR);
		$stmt->bindParam(":modificarVentas", $datos["modificarVentas"], PDO::PARAM_STR);
		$stmt->bindParam(":eliminarVentas", $datos["eliminarVentas"], PDO::PARAM_STR);
		$stmt->bindParam(":facturacionElectronica", $datos["facturacionElectronica"], PDO::PARAM_STR);
		$stmt->bindParam(":reportesVentas", $datos["reportesVentas"], PDO::PARAM_STR);

		$stmt->bindParam(":cajasSuperiores", $datos["cajasSuperiores"], PDO::PARAM_STR);
		$stmt->bindParam(":graficoGanancias", $datos["graficoGanancias"], PDO::PARAM_STR);
		$stmt->bindParam(":productosMasVendidos", $datos["productosMasVendidos"], PDO::PARAM_STR);
		$stmt->bindParam(":productosAgregadosRecientemente", $datos["productosAgregadosRecientemente"], PDO::PARAM_STR);
		$stmt->bindParam(":bitacora", $datos["bitacora"], PDO::PARAM_STR);

		$stmt->bindParam(":pagos", $datos["pagos"], PDO::PARAM_STR);
		$stmt->bindParam(":historicoPagos", $datos["historicoPagos"], PDO::PARAM_STR);
		$stmt->bindParam(":imprimirPagos", $datos["imprimirPagos"], PDO::PARAM_STR);
		$stmt->bindParam(":eliminarPagos", $datos["eliminarPagos"], PDO::PARAM_STR);
		$stmt->bindParam(":costoProductos", $datos["costoProductos"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
    $stmt->bindParam(":actualizar", $datos["actualizar"], PDO::PARAM_STR);
		$stmt->bindParam(":cajas", $datos["cajas"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	BORRAR PERFIL
	=============================================*/

	static public function mdlBorrarPerfil($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE perfil = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;


	}

}
