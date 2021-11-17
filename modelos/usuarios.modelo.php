<?php

require_once "conexion.php";

class ModeloUsuarios{

	/*=============================================
	MOSTRAR USUARIOS
	=============================================*/

	static public function mdlMostrarUsuarios($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT id
                                                                    ,nombre
                                                                    ,usuario
                                                                    ,password
                                                                    ,perfil
                                                                    ,foto
                                                                    ,estado
                                                                    ,ultimo_login
                                                                    ,fecha
                                                                    ,intentos
                                                                    ,(to_base64(archivoFoto)) as archivoFoto

													,(select b.descripcion
														from perfiles b
														where b.perfil=a.perfil

													) as nombrePerfil
													FROM $tabla a WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT *

													,(select b.descripcion
														from perfiles b
														where b.perfil=a.perfil

													) as nombrePerfil

													FROM $tabla a");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}


		$stmt -> close();

		$stmt = null;

	}

	/*=============================================
	REGISTRO DE USUARIO
	=============================================*/

	static public function mdlIngresarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre
																															, usuario
																															, password
																															, perfil
																															, foto
																															, archivoFoto
																														)
																															VALUES (:nombre
																																, :usuario
																																, :password
																																, :perfil
																																, :foto
																																, :archivoFoto

																															)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt->bindParam(":perfil", $datos["perfil"], PDO::PARAM_INT);
		$stmt->bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt->bindParam(":archivoFoto", $datos["archivoFoto"], PDO::PARAM_LOB);

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
	EDITAR USUARIO
	=============================================*/

	static public function mdlEditarUsuario($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla
																						SET nombre = :nombre
																						, password = :password
																						, perfil = :perfil
																						, foto = :foto
																						, archivoFoto = :archivoFoto
																						WHERE usuario = :usuario

																						");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":archivoFoto", $datos["archivoFoto"], PDO::PARAM_LOB);

		try {

			$stmt -> execute();
			return "ok";
			
		} catch(Exception $e){

			return $e->getMessage();

		}

		$stmt -> close();

		$stmt = null;

	}


        	/*=============================================
	EDITAR CONTRA
	=============================================*/

	static public function mdlEditarContra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET
                                                                         password = :password

                                                                        , foto = :foto
                                                                        WHERE usuario = :usuario");


		$stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";

		}else{

			return "error";

		}

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	ACTUALIZAR USUARIO
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

	/*=============================================
	BORRAR USUARIO
	=============================================*/

	static public function mdlBorrarUsuario($tabla, $datos){

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

}
