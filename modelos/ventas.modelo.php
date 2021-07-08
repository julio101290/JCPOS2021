<?php

require_once "conexion.php";

class ModeloVentas{

	/*=============================================
	MOSTRAR VENTAS
	=============================================*/

	static public function mdlMostrarVentas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * 
													   ,(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where b.codigo=p.idVenta)	as importePagado
													FROM $tabla b
													WHERE $item = :$item 
													ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * 
														,(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where b.codigo=p.idVenta)	as importePagado
													FROM $tabla b
													ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	GENERA UUID
	=============================================*/

	static public function mdlGeneraUUID(){

		$stmt = Conexion::conectar()->prepare("select uuid() as generaUUID");

		$stmt -> execute();

		return $stmt -> fetch();



		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR VENTAS LLAVE COMPLETA
	=============================================*/

	static public function mdlMostrarVentasLlave($tabla, $datos){

		if($datos != null){

			$stmt = Conexion::conectar()->prepare("SELECT id
														,codigo
														,id_cliente
														,id_vendedor
														,productos
														,impuesto
														,neto
														,total
														,metodo_pago
														,fecha
														,tipo_venta
														,FechaVencimiento
														,codigoVenta
														,cotizarA
														,plazoEntrega

													  
													FROM $tabla b
													WHERE codigo = :codigo
													and tipo_venta = :tipo_venta
													ORDER BY id ASC");

			$stmt -> bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
			$stmt -> bindParam(":tipo_venta", $datos["tipo_venta"], PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}

		
		
		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	MOSTRAR COTIZACIÓN
	=============================================*/

	static public function mdlMostrarCotizacion($cotizacion){

		if($cotizacion != null){

			$stmt = Conexion::conectar()->prepare("SELECT * 
													FROM ventas 
													WHERE UUID = :UUID
			
													");

			$stmt -> bindParam(":UUID", $cotizacion, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

	
		}

	}

		/*=============================================
	MOSTRAR ULTIMO FOLIO
	=============================================*/


		static public function mdlMostrarUltimoFolio($tipoVenta){


			$stmt = Conexion::conectar()->prepare("SELECT ifnull(max(codigo),0) as UltimoFolio 
													FROM ventas 
													where Tipo_Venta=:$tipoVenta
													ORDER BY id asc");

			$stmt -> bindParam(":$tipoVenta", $tipoVenta, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	REGISTRO DE VENTA
	=============================================*/

	static public function mdlIngresarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
			codigo
			, id_cliente
			, id_vendedor
			, productos
			, impuesto
			, neto
			, total
			, metodo_pago
			, tipo_venta
			, FechaVencimiento

			, cotizarA
			, plazoEntrega
			, codigoVenta
			, Observaciones
			, fecha
			, UUID


			) 
			VALUES (:codigo
			, :id_cliente
			, :id_vendedor
			, :productos
			, :impuesto
			, :neto
			, :total
			, :metodo_pago
			, :tipo_venta
			, :FechaVencimiento

			, :CotizarA
			, :plazoEntrega
			, :codigoVenta
			, :Observaciones
			, :fecha
			, :UUID

		)");

		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_venta", $datos["tipoVenta"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":FechaVencimiento", $datos["FechaVencimiento"], PDO::PARAM_STR);

		$stmt->bindParam(":plazoEntrega", $datos["plazoEntrega"], PDO::PARAM_STR);
		$stmt->bindParam(":CotizarA", $datos["CotizarA"], PDO::PARAM_STR);
		$stmt->bindParam(":codigoVenta", esCero($datos["codigoVenta"]), PDO::PARAM_STR);
		$stmt->bindParam(":Observaciones", ($datos["Observaciones"]), PDO::PARAM_STR);
		$stmt->bindParam(":fecha", ($datos["fecha"]), PDO::PARAM_STR);
		$stmt->bindParam(":UUID", ($datos["UUID"]), PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			$arr = $stmt ->errorInfo();
			$arr[3]="ERROR";
			return $arr[2];
		
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR VENTA
	=============================================*/

	static public function mdlEditarVenta($tabla, $datos){

		
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
												SET  id_cliente = :id_cliente
												, id_vendedor = :id_vendedor
												, productos = :productos
												, impuesto = :impuesto
												, neto = :neto
												, total= :total
												, metodo_pago = :metodo_pago 

												, Tipo_Venta = :tipo_venta 
												, FechaVencimiento =:FechaVencimiento 
												, cotizarA = :CotizarA
												, Observaciones = :Observaciones  
												, plazoEntrega = :plazoEntrega 
												, fecha = :fecha 
												WHERE id = :id");




		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_cliente", $datos["id_cliente"], PDO::PARAM_INT);
		$stmt->bindParam(":id_vendedor", $datos["id_vendedor"], PDO::PARAM_INT);
		$stmt->bindParam(":productos", $datos["productos"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":neto", $datos["neto"], PDO::PARAM_STR);
		$stmt->bindParam(":total", $datos["total"], PDO::PARAM_STR);
		$stmt->bindParam(":metodo_pago", $datos["metodo_pago"], PDO::PARAM_STR);
		
		$stmt->bindParam(":tipo_venta", $datos["tipoVenta"], PDO::PARAM_STR);
		$stmt->bindParam(":FechaVencimiento", $datos["FechaVencimiento"], PDO::PARAM_STR);
		$stmt->bindParam(":Observaciones", $datos["Observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":plazoEntrega", $datos["plazoEntrega"], PDO::PARAM_STR);
		$stmt->bindParam(":CotizarA", $datos["CotizarA"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha", $datos["fecha"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{
			$arr = $stmt ->errorInfo();
			$arr[3]="ERROR";
			return $arr[2];
		
		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	ELIMINAR VENTA
	=============================================*/

	static public function mdlEliminarVenta($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	
	/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentas($tabla
                                                    , $fechaInicial
                                                    , $fechaFinal
                                                    , $tipoDocumento ="VEN"
                                                    , $soloPendientePorCobrar = "s"
                                                    , $soloCobrado = "s"
                                                    , $cliente = "n"
                                                    ,$filtros="n"
                                                    ,$busqueda=""
    ){
            
                
                // LIMITANTES
                if(isset($filtros['start'])){
			$limit="LIMIT ".$filtros['start']."  ,".$filtros['length'];
		}
		else{
			$limit="";
		}
                //PARA ORDENAR
                $col =array(
		    0   =>  '1',
		    1   =>  '2',
		    2   =>  '4',
		    3   =>  '9',
		    4   =>  '13',
		    5   =>  '8',
		    6   =>  '17',
		    7   =>  '17',
		    8   =>  '1',
		    9   =>  '1',
		    10   =>  '1',

			);
                
                
                
                if(isset($filtros['order'][0]['column'])){
                    $orderBy=" ORDER BY ".$col[$filtros['order'][0]['column']]."   ".$filtros['order'][0]['dir'];
                }else{
                    $orderBy="";
                }
                
                //FILTROS
                if(isset($busqueda['search'])){
			$buscar=$busqueda['search']['value'];
			$busquedaGeneral="and  ( 
										(select b.nombre from clientes b where b.id=a.id_cliente) 
										like '%".$buscar."%'

										or

										(select b.documento from clientes b where b.id=a.id_cliente) 
										like '%".$buscar."%'

										or 

										a.codigo like '%".$buscar."%'

										
									)

								

									";
		}
		else{
			$busquedaGeneral="";
		}

		if($fechaInicial == null){



			$stmt = Conexion::conectar()->prepare("SELECT * 
                                                                    ,(

                                                                                    case when a.Tipo_Venta='COT' then
                                                                                            case when (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.codigo)>0 then
                                                                                                             (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.codigo)
                                                                                                            else
                                                                                                            'GENERAR VENTA'
                                                                                            end

                                                                                    end	
                                                                                            ) as codigoVenta1

                                                                       ,(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                                                    from pagos p where a.codigo=p.idVenta)	as importePagado

                                                                    FROM $tabla a
                                                                    where Tipo_Venta='".$tipoDocumento."'


                                                                            and ('".$soloPendientePorCobrar."'='n' or  
                                                                            a.total-0.01>
                                                                    (select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                                                    from pagos p where a.codigo=p.idVenta)

                                                                    )

                                                                    and ('".$soloCobrado."'='n' or  

                                                                            (select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                                                    from pagos p where a.codigo=p.idVenta)>0.1

                                                                    )



                                                                    and ('".$cliente."'='n' or ifnull(a.id_cliente,0)='".$cliente."'

                                                                    )

                                                                    $busquedaGeneral
                                                                    $orderBy
                                                                    $limit
                                                                    " );

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){


			$fechaFinal = new DateTime($fechaFinal);
			$fechaFinal = $fechaFinal->format("Y-m-d");
			$stmt = Conexion::conectar()->prepare("SELECT * 
                                                            ,(

                                                            case when a.Tipo_Venta='COT' then
                                                                    case when (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.id)>1 then
                                                                                     (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.id)
                                                                                    else
                                                                                    'GENERAR VENTA'
                                                                    end

                                                            end	
                                                            ) as codigoVenta1

                                                       ,(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                                    from pagos p where a.codigo=p.idVenta)	as importePagado

                                                    FROM $tabla a
                                                    WHERE fecha like '%".$fechaFinal."%' and Tipo_Venta='$tipoDocumento'


                                                    and ('".$soloPendientePorCobrar."'='n' or  
                                                    a.total-0.01>
                                            (select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                            from pagos p where a.codigo=p.idVenta)

                                            )

                                            and ('".$soloCobrado."'='n' or  

                                                    (select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                            from pagos p where a.codigo=p.idVenta)>0

                                            )



                                            and ('".$cliente."'='n' or ifnull(a.id_cliente,0)='".$cliente."'

                                            )
                                              $busquedaGeneral
                                            $orderBy
                                            $limit
                                            ");

			//$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * 
                                                                            ,(

                                                                            case when a.Tipo_Venta='COT' then
                                                                                    case when (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.id)>1 then
                                                                                                     (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.id)
                                                                                                    else
                                                                                                    'GENERAR VENTA'
                                                                                    end

                                                                            end	
                                                                            ) as codigoVenta1
                                                                    FROM $tabla  a
                                                                    WHERE a.fecha 
                                                                    BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' 
                                                                    and a.Tipo_Venta='$tipoDocumento'

                                                                            and ('".$soloPendientePorCobrar."'='n' or  
                                                                    a.total-0.01>
                                                            (select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                                            from pagos p where a.codigo=p.idVenta)

                                                            )

                                                            and ('".$soloCobrado."'='n' or  

                                                                    (select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                                            from pagos p where a.codigo=p.idVenta)>0

                                                            )



                                                            and ('".$cliente."'='n' or ifnull(a.id_cliente,0)='".$cliente."'

                                                            )
                                                            $busquedaGeneral
                                                            $orderBy      
                                                            $limit

                                                            ");

			}else{


                            $stmt = Conexion::conectar()->prepare("SELECT * 

                                                                FROM $tabla a 
                                                                WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' 
                                                                and Tipo_Venta='$tipoDocumento'
                                                                and ('".$soloPendientePorCobrar."'='n' or a.total-0.01>
                                                                    (select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                                                    from pagos p where a.codigo=p.idVenta)

                                                                    )

                                                                    and ('".$soloCobrado."'='n' or  

                                                                            (select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
                                                                    from pagos p where a.codigo=p.idVenta)>0

                                                                    )
                                                                    and ('".$cliente."'='n' 
                                                                            or ifnull(a.id_cliente,0)='".$cliente."'

                                                                    $busquedaGeneral
                                                                    $orderBy
                                                                    $limit                                                        )

					");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}




	/*=============================================
	RANGO FECHAS PRODUCTO
	=============================================*/	

	static public function mdlRangoFechasVentasProducto($tabla
													, $fechaInicial
													, $fechaFinal
													,$tipoDocumento="VEN"
													,$soloPendientePorCobrar="s"
													,$soloCobrado="s"
													,$cliente="n"

												){

		if($fechaInicial == null){



			$stmt = Conexion::conectar()->prepare("SELECT * 
													,(

															case when a.Tipo_Venta='COT' then
																case when (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.codigo)>0 then
																		 (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.codigo)
																		else
																		'GENERAR VENTA'
																end
																
															end	
																) as codigoVenta1

													   ,(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)	as importePagado

													FROM $tabla a
													where Tipo_Venta='".$tipoDocumento."'


														and ('".$soloPendientePorCobrar."'='n' or  
														a.total-0.01>
													(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)

													)

													and ('".$soloCobrado."'='n' or  
														
														(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)>0.1

													)

									

													and ('".$cliente."'='n' or ifnull(a.id_cliente,0)='".$cliente."'

													)
													ORDER BY id desc");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){


			$fechaFinal = new DateTime($fechaFinal);
			$fechaFinal = $fechaFinal->format("Y-m-d");
			$stmt = Conexion::conectar()->prepare("SELECT * 
															,(

															case when a.Tipo_Venta='COT' then
																case when (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.id)>1 then
																		 (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.id)
																		else
																		'GENERAR VENTA'
																end
																
															end	
															) as codigoVenta1

														   ,(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         													from pagos p where a.codigo=p.idVenta)	as importePagado

														FROM $tabla a
														WHERE fecha like '%".$fechaFinal."%' and Tipo_Venta='$tipoDocumento'


														and ('".$soloPendientePorCobrar."'='n' or  
														a.total-0.01>
													(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)

													)

													and ('".$soloCobrado."'='n' or  
														
														(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)>0

													)

									

													and ('".$cliente."'='n' or ifnull(a.id_cliente,0)='".$cliente."'

													)
													");

			//$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * 
															,(

															case when a.Tipo_Venta='COT' then
																case when (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.id)>1 then
																		 (select b.codigo from ventas b where b.Tipo_Venta='VEN' and b.codigoVenta=a.id)
																		else
																		'GENERAR VENTA'
																end
																
															end	
															) as codigoVenta1
														FROM $tabla  a
														WHERE a.fecha 
														BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' 
														and a.Tipo_Venta='$tipoDocumento'

															and ('".$soloPendientePorCobrar."'='n' or  
														a.total-0.01>
													(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)

													)

													and ('".$soloCobrado."'='n' or  
														
														(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)>0

													)

									

													and ('".$cliente."'='n' or ifnull(a.id_cliente,0)='".$cliente."'

													)


														");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * 


					FROM $tabla a WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' and Tipo_Venta='$tipoDocumento'


						and ('".$soloPendientePorCobrar."'='n' or  
														a.total-0.01>
													(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)

													)

													and ('".$soloCobrado."'='n' or  
														
														(select ifnull(sum(importePagado-ifnull(importeDevuelto,0)),0) 
         												from pagos p where a.codigo=p.idVenta)>0

													)

									

													and ('".$cliente."'='n' or ifnull(a.id_cliente,0)='".$cliente."'

													)

					");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}


		/*=============================================
	RANGO FECHAS
	=============================================*/	

	static public function mdlRangoFechasVentasCotizaciones($tabla, $fechaInicial, $fechaFinal,$filtros, $limitar="S"){

		
             // LIMITANTES
                if(isset($filtros['start'])){
                    if($limitar=="S"){
                        $limit="LIMIT ".$filtros['start']."  ,".$filtros['length'];
                    }else{
                        $limit="";
                    }
		}
		else{
			$limit="";
		}
                
            // BUSQUEDA
                
            //FILTROS
                if(isset($filtros['search'])){
			$buscar=$filtros['search']['value'];
			$busquedaGeneral="and  ( 
										(select b.nombre from clientes b where b.id=a.id_cliente) 
										like '%".$buscar."%'

										or

										(select b.documento from clientes b where b.id=a.id_cliente) 
										like '%".$buscar."%'

										or 

										a.codigo like '%".$buscar."%'

										
									)

								

									";
		}
		else{
			$busquedaGeneral="";
		}

            //PARA ORDENAR
        $col =array(
		    0   =>  '1',
		    1   =>  '2',
		    2   =>  '3',
		    3   =>  '3',
		    4   =>  '4',
		    5   =>  '7',
		    6   =>  '8',
		    7   =>  '10',
		    8   =>  '12',
		    9   =>  '1',
			);
                
                
                

		$orderBy=" order by  ".$col[$filtros['order'][0]['column']]."   ".$filtros['order'][0]['dir'];
                
                
        if($fechaInicial == null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla a where tipo_venta='COT' $busquedaGeneral  $orderBy  $limit  ");

			$stmt -> execute();

			return $stmt -> fetchAll();	


		}else if($fechaInicial == $fechaFinal){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla 
				WHERE fecha like '%$fechaFinal%' and tipo_venta='COT' $busquedaGeneral 
				$SorderBy
				$limit");

			$stmt -> bindParam(":fecha", $fechaFinal, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$fechaActual = new DateTime();
			$fechaActual ->add(new DateInterval("P1D"));
			$fechaActualMasUno = $fechaActual->format("Y-m-d");

			$fechaFinal2 = new DateTime($fechaFinal);
			$fechaFinal2 ->add(new DateInterval("P1D"));
			$fechaFinalMasUno = $fechaFinal2->format("Y-m-d");

			if($fechaFinalMasUno == $fechaActualMasUno){

				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinalMasUno' $busquedaGeneral $orderBy $limit");

			}else{


				$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal' $busquedaGeneral $orderBy $limit");

			}
		
			$stmt -> execute();

			return $stmt -> fetchAll();

		}

	}

	/*=============================================
	SUMAR EL TOTAL DE VENTAS
	=============================================*/

	static public function mdlSumaTotalVentas($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla where tipo_venta='VEN' ");

		$stmt -> execute();

		return $stmt -> fetch();


	}


	/*=============================================
	SUMAR EL TOTAL DE PAGOS
	=============================================*/

	static public function mdlSumaTotalPagos($tabla){	

		$stmt = Conexion::conectar()->prepare("SELECT sum(importePagado-importeDevuelto) as totalPagado FROM pagos");

		$stmt -> execute();

		return $stmt -> fetch();


	}



	/*=============================================
	INICIAR TRANSACCION
	=============================================*/

	static public function mdlTransaccion(){	

		$stmt = Conexion::conectar()->prepare("START TRANSACTION;;");

		$stmt -> execute();

		return $stmt -> fetch();


	}

	/*=============================================
	 COMMIT
	=============================================*/

	static public function mdlCommit(){	

		$stmt = Conexion::conectar()->prepare("COMMIT;");

		$stmt -> execute();

		return $stmt -> fetch();


	}


	/*=============================================
	INICIAR ROLLBACK
	=============================================*/

	static public function mdlRollback(){	

		$stmt = Conexion::conectar()->prepare("ROLLBACK;");

		$stmt -> execute();

		return $stmt -> fetch();


	}

	
}