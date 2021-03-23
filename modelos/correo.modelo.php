<?php

require_once "conexion.php";

class ModeloCorreo{

	/*=============================================
	MOSTRAR EMPRESA
	=============================================*/

	static public function mdlMostrarCorreo(){


		$stmt = Conexion::conectar()->prepare("SELECT correoSaliente 	
													,host 	
													,SMTPDebug 	
													,SMTPAuth 	
													,Puerto
													,clave 
													,SMTPSeguridad 



			FROM configuracioncorreo ");

		//$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

		$stmt -> execute();

		return $stmt -> fetchAll();

		
		

		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	EDITAR Empresa
	=============================================*/

	static public function mdlEditarCorreo($datos){

	
		$stmt = Conexion::conectar()->prepare("UPDATE configuracioncorreo 
												SET correoSaliente = :correoSaliente
												, host = :host
												, SMTPDebug = :SMTPDebug
												, SMTPAuth = :SMTPAuth
												, Puerto=:Puerto
												, clave=:clave
												, SMTPSeguridad=:SMTPSeguridad

												"

											);

		$stmt -> bindParam(":correoSaliente", $datos["correoSaliente"], PDO::PARAM_STR);
		$stmt -> bindParam(":host", $datos["host"], PDO::PARAM_STR);
		$stmt -> bindParam(":SMTPDebug", $datos["SMTPDebug"], PDO::PARAM_STR);
		$stmt -> bindParam(":SMTPAuth", $datos["SMTPAuth"], PDO::PARAM_STR);
		$stmt -> bindParam(":Puerto", $datos["Puerto"], PDO::PARAM_INT);
		$stmt -> bindParam(":clave", $datos["clave"], PDO::PARAM_STR);
		$stmt -> bindParam(":SMTPSeguridad", $datos["SMTPSeguridad"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			$arr = $stmt ->errorInfo();
			$arr[3]="ERROR";
			return $arr[2];

		}

		$stmt -> close();

		$stmt = null;

	}




}
