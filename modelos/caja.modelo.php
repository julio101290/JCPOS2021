<?php
require_once "conexion.php";

class ModeloCaja{

	/*=============================================
	CREAR CAJA
	=============================================*/

	static public function mdlCrearCaja($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id
																, usuario
																, fecha_apertura
																, fecha_cierre
																, total_ventas
																, diferencia
																, observaciones
																)
																VALUES (:id
																, :usuario
																, :fecha_apertura
																, :fecha_cierre
																, :total_ventas
																, :diferencia
																, observaciones
																)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_apertura", $datos["fecha_apertura"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_cierre", $datos["fecha_cierre"], PDO::PARAM_STR);
		$stmt->bindParam(":total_ventas", $datos["total_ventas"], PDO::PARAM_STR);
		$stmt->bindParam(":diferencia", $datos["diferencia"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

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
	CREAR CAJA
	=============================================*/

	static public function mdlAbrirCaja($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
																idUsuario
																, fecha_apertura
																, importe_apertura
																)
																VALUES ( :usuario
																, :fecha_apertura
																, :importeApertura
																)");

		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_apertura", $datos["fecha_apertura"], PDO::PARAM_STR);
		$stmt->bindParam(":importeApertura", $datos["importe_apertura"], PDO::PARAM_STR);



		 try  {
       $stmt->execute();

			return "ok";
    }

		
    catch(Exception $e){


			return $e->getMessage();

		}

		$stmt->close();
		$stmt = null;

	}

	/*=============================================
	MOSTRAR CAJAS
	=============================================*/

	static public function mdlMostrarCajas($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT *
														,(select b.nombre from usuarios b where a.idUsuario=b.id) as nombreUsuario
														FROM
														$tabla a
														WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *

													,(select b.nombre from usuarios b where a.idUsuario=b.id) as nombreUsuario
													FROM $tabla a");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	VERIFICA SI EXITE CAJA ABIERTA
	=============================================*/

	static public function mdlVerificaCajaUsuario($usuario){

		$stmt = Conexion::conectar()->prepare("SELECT *

													FROM
													caja a
													WHERE idUsuario = ".$usuario."
													and ifnull(fecha_cierre,0)=0"
												);


		$stmt -> execute();

		return $stmt -> fetch();


		$stmt -> close();

		$stmt = null;

	}




	/*=============================================
	ELIMINAR CAJA
	=============================================*/

	static public function mdlEliminarCaja($tabla, $datos){

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
	CERRAR CAJA
	=============================================*/

	static public function mdlCerrarCaja($datos){

		$stmt = Conexion::conectar()->prepare("UPDATE caja SET fecha_cierre = :fecha_cierre
															   , total_ventas = :total_ventas
															   , diferencia = :diferencia
															   , observaciones = :observaciones

															   WHERE id = :id");

		$stmt->bindParam(":fecha_cierre", $datos["fecha_cierre"], PDO::PARAM_STR);
		$stmt->bindParam(":total_ventas", $datos["total_ventas"], PDO::PARAM_STR);
		$stmt->bindParam(":diferencia", $datos["diferencia"], PDO::PARAM_STR);
		$stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);
		$stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";

		}else{

			$arr=$stmt->errorInfo();
			return $arr[2];


		}

		$stmt->close();
		$stmt = null;

	}



}
