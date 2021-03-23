<?php

require_once "conexion.php";

class ModeloBitacora{

	/*=============================================
	MOSTRAR BITACORA
	=============================================*/

	static public function mdlMostrarBitacora($tabla, $valor,$noLimit){
		if(isset($valor['start']) ){
			
			if($noLimit=="n"){
				$limit="LIMIT ".$valor['start']."  ,".$valor['length'];
			}
			
			else{
				$limit="";
			}

		}
		else{
			$limit="";
		}


	


		if(isset($valor['search'])){
			$buscar=$valor['search']['value'];
			$busquedaGeneral="and  ( 
										id
										like '%".$buscar."%'

										or

										descripcion
										like '%".$buscar."%'

										or 

										fecha
										like '%".$buscar."%'

										or 
										usuario
										like '%".$buscar."%'

									
										
									)

									";
		}
		else{
			$busquedaGeneral="";
		}


		$col =array(
		    0   =>  '1',
		    1   =>  '2',
		    2   =>  '3',

			);

		$orderBy=" ORDER BY ".$col[$valor['order'][0]['column']]."   ".$valor['order'][0]['dir'];



		if($noLimit=="s"){
			$stmt = Conexion::conectar()->prepare("select count(id) as contador

														from bitacora 
														where 'a'='a' $busquedaGeneral
														"
													);
		}
		else{
			$stmt = Conexion::conectar()->prepare("select id
														,descripcion
														,fecha
														,usuario 

														from bitacora 
														where 1=1
														".$busquedaGeneral."  ".$limit
													);
		}

	
		if($stmt->execute()){
			return $stmt -> fetchAll();
			$stmt -> close();

			$stmt = null;

		}
		else{
			$arr = $stmt ->errorInfo();
			$arr[3]="ERROR";
			return $arr[2];
		}

	}

	/*=============================================
	REGISTRO DE BITACORA
	=============================================*/

	static public function mdlIngresarBitacora($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
			 descripcion
			, usuario
			) 
			VALUES (:descripcion
			, :usuario
		)");

		$stmt->bindParam(":descripcion", $datos["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);

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

	
	
}