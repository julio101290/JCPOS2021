<?php

require_once "conexion.php";
session_start();
class ModeloBodegas{

	/*=============================================
	MOSTRAR BODEGAS
	=============================================*/

	static public function mdlMostrarBodegas($tabla, $item, $valor,$todos="N"){
            
                if($todos=="S"){
                    $bodegasUsuario = "";
                }else{
                    $bodegas= $_SESSION["bodegasUsuario"];
                    $bodegasUsuario = "and id in(".$bodegas.")"  ;
                }

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * 
                                                            FROM bodegas a WHERE $item = :$item
                                                           $bodegasUsuario


                                "
                                
                                );

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * 

                                                                FROM bodegas a
                                                                where 1=1
                                                                $bodegasUsuario
                                                                ");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt -> close();

		$stmt = null;

	}

	//MOSTRAR BODEGAS POR USUARIO
	static public function mdlMostrarBodegasUsuario($valor){

			$query="SELECT 	 b.id
							,b.descripcion

							from puntosDeVentas a
							,bodegas b

							where b.id=a.bodega
							and a.id in(".$valor.")";

			$stmt = Conexion::conectar()->prepare($query);

			$stmt -> execute();

			return $stmt -> fetchAll();

		
		

		$stmt -> close();

		$stmt = null;

	}


	/*=============================================
	REGISTRO DE BODEGA
	=============================================*/

	static public function mdlIngresarBodega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO bodegas
												(descripcion
												)
												VALUES (:descripcion
												
												)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);


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
	EDITAR BODEGA
	=============================================*/

	static public function mdlEditarBodega($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE bodegas
												SET descripcion = :descripcion
												


												WHERE id = :id");

		$stmt -> bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
	

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

	

	/*=============================================
	BORRAR BODEGA
	=============================================*/

	static public function mdlBorrarBodega($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM bodegas WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			$arr = $stmt ->errorInfo();
			$arr[3]="ERROR";

			if ($arr[1]==1451){
				$arr[2]="No se puede borrar el bodega ya que se han hecho pagos con el";
			}
			return $arr[2];

		}

		$stmt -> close();

		$stmt = null;


	}

}