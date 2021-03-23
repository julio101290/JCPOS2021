<?php

require_once "conexion.php";

class ModeloEmpresas{

	/*=============================================
	MOSTRAR EMPRESA
	=============================================*/

	static public function mdlMostrarEmpresa($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM datosempresa ");

			//$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetchAll();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM datosempresa");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Empresa
	=============================================*/

	static public function mdlEditarEmpresa($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
												SET NombreEmpresa = :NombreEmpresa
												, DireccionEmpresa = :DireccionEmpresa
												, RFC = :RFC
												, Telefono = :Telefono
												, correoElectronico=:correoElectronico
												, diasEntrega=:diasEntrega


												"

											);

		$stmt -> bindParam(":NombreEmpresa", $datos["nombreEmpresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":DireccionEmpresa", $datos["DireccionEmpresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":RFC", $datos["RFC"], PDO::PARAM_STR);
		$stmt -> bindParam(":Telefono", $datos["telefonoEmpresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":correoElectronico", $datos["correoElectronicoEmpresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":diasEntrega", $datos["diasEntrega"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR EMPRESA
	=============================================*/

	static public function mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		$stmt -> close();

		$stmt = null;

	}

}
