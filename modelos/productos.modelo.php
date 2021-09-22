<?php

require_once "conexion.php";

class ModeloProductos{

	/*=============================================
	MOSTRAR PRODUCTOS
	=============================================*/

	static public function mdlMostrarProductos($tabla, $item, $valor, $orden){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY $orden DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}


	static public function mdlMostrarProductosServerSide($tabla, $item, $valor, $orden){

                $limit="LIMIT ".$valor['start']."  ,".$valor['length'];

                $col =array(
		    0   =>  '1',
		    1   =>  '5',
		    2   =>  '3',
                    3   =>  '4',
                    4   =>  '2',
                    5   =>  '6',
                    6   =>  '8',
                    7   =>  '10',
                    8   =>  '1',

			);

		$orderBy=" ORDER BY ".$col[$valor['order'][0]['column']]."   ".$valor['order'][0]['dir'];

        if(isset($valor['search'])){
			$buscar=$valor['search']['value'];
			$busquedaGeneral="and  (
										id
										like '%".$buscar."%'

										or

										descripcion
										like '%".$buscar."%'

										or

										codigo
										like '%".$buscar."%'
							)

									";
		}
		else{
			$busquedaGeneral="";
		}

                $stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla where 1=1 $busquedaGeneral  $orderBy $limit");

                $stmt -> execute();

                return $stmt -> fetchAll();



		$stmt -> close();

		$stmt = null;

	}





    /*=============================================
	MOSTRAR PRODUCTOS NUMERO DE REGISTROS
	=============================================*/

	static public function mdlMostrarNumRegistros($valor){


            $buscar=$valor['search']['value'];

			$stmt = Conexion::conectar()->prepare("SELECT count(id) as totalRenglones FROM productos
                                 where (descripcion like '%$buscar%'
                                        or codigo like '%$buscar%'
                                        or id like '%$buscar%'
                                        )

                                ");

			$stmt -> execute();

			return $stmt -> fetch();



		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR NUMERO DE REGISTROS
	=============================================*/
	static public function mdlIngresarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta) VALUES (:id_categoria, :codigo, :descripcion, :imagen, :stock, :precio_compra, :precio_venta)");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{


			$arr=$stmt->errorInfo();
			return $arr[2];

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	EDITAR PRODUCTO
	=============================================*/
	static public function mdlEditarProducto($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla
													SET id_categoria = :id_categoria
														, descripcion = :descripcion
														, imagen = :imagen
														, stock = :stock
														, precio_compra = :precio_compra
														, precio_venta = :precio_venta
														, codigo = :codigo
														WHERE id = :id");

		$stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datos["imagen"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo", $datos["codigo"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	BORRAR PRODUCTO
	=============================================*/

	static public function mdlEliminarProducto($tabla, $datos){

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
	ACTUALIZAR PRODUCTO
	=============================================*/

	static public function mdlActualizarProducto($tabla, $item1, $valor1, $valor){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}






	}

	/*=============================================
	MOSTRAR SUMA VENTAS
	=============================================*/

	static public function mdlMostrarSumaVentas($tabla){

		$stmt = Conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;
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

				$stmt -> close();

		$stmt = null;


	}


	/*=============================================
	INICIAR ROLLBACK
	=============================================*/

	static public function mdlRollback(){

		$stmt = Conexion::conectar()->prepare("ROLLBACK;");

		$stmt -> execute();

		return $stmt -> fetch();

		$stmt -> close();

		$stmt = null;


	}



}
