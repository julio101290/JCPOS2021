<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";
session_start();
          
if(!$_SESSION["iniciarSesion"]){
	return;
}
class TablaClientes{

 	/*=============================================
 	 MOSTRAR LA TABLA DE CLIENTE
  	=============================================*/ 

	public function mostrarTablaClientes(){

		$item = null;
    	$valor = null;
    	$orden = "id";


    	$request=$_REQUEST;


	$renglones = ModeloClientes::mdlMostrarNumRegistros($request);
    	$totalRenglones=$renglones["contador"];


    

    	
  		$clientes = ModeloClientes::mdlMostrarClientesDTServerSide($request);	

  		if(count($clientes) == 0){

  			echo '{"data": []}';

		  	return;
  		}
		
  		$datosJson = '{

		"draw": '.intval($request["draw"]).',
		"recordsTotal":'.intval($totalRenglones).',
		"recordsFiltered": '.intval($totalRenglones).',
		
		  "data": [';

		  for($i = 0; $i < count($clientes); $i++){

		  

		  	/*=============================================
 	 		TRAEMOS LAS ACCIONES
  			=============================================*/ 
  			/*
  			$descripcion=str_replace(chr(10), "", $bitacora[$i]["descripcion"]);
  			$descripcion=str_replace(chr(13), "",$descripcion);
  			$descripcion=str_replace("\n", "",$descripcion);
  			$descripcion=str_replace("\r", "",$descripcion);
  			$descripcion=str_replace("\t", "",$descripcion);
  			$descripcion=str_replace("'", "",$descripcion);
  			$descripcion=str_replace('"', "",$descripcion);

  			*/


            
/*
            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["nombre"].'</td>

                    <td>'.$value["documento"].'</td>

                    <td>'.$value["email"].'</td>

                    <td>'.$value["telefono"].'</td>

                    <td>'.$value["direccion"].'</td>

                    <td>'.$value["fecha_nacimiento"].'</td>             

                    <td>'.$value["compras"].'</td>

                    <td>'.$value["ultima_compra"].'</td>

                    <td>'.$value["fecha"].'</td>

                    <td>

                      <div class="btn-group">
                          
                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                      if($_SESSION["perfil"] == "Administrador"){

                          echo '<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';

                      }

                      echo '</div>  

                    </td>

                  </tr>';
          
     */


       

                $botones = "<div class='btn-group'><button class='btn btn-warning btnEditarCliente' idCliente='" . $clientes[$i]["id"] . "' data-toggle='modal' data-target='#modalEditarCliente'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarCliente' idCliente='" . $clientes[$i]["id"] . "'><i class='fa fa-times'></i></button></div>";
          

		  	$datosJson .='[
						"'.$clientes[$i]["id"].'", 
						"'.$clientes[$i]["nombre"].'",
						"'.$clientes[$i]["documento"].'",
						"'.$clientes[$i]["email"].'",
						"'.$clientes[$i]["telefono"].'",
						"'.$clientes[$i]["direccion"].'",
						"'.$clientes[$i]["fecha_nacimiento"].'",
						"'.$clientes[$i]["compras"].'",
						"'.$clientes[$i]["ultima_compra"].'",
						"'.$clientes[$i]["fecha"].'",
						"'.$botones.'"

			    ],';

		  }

		  $datosJson = substr($datosJson, 0, -1);

		 $datosJson .=   '] 

		 }';
		
		echo $datosJson;


	}


}

/*=============================================
ACTIVAR TABLA DE CLIENTES
=============================================*/ 
$activarBitacora= new TablaClientes();
$activarBitacora -> mostrarTablaClientes();

