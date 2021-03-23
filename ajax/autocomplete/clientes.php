<?php
require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";


public $nombre;




	$return_arr = array();
/* If connection to database, run sql statement. */


	$item = "nombre";
	$valor = this->$_POST['key']; 

	$clientes = ControladorClientes::ctrBuscarClientes($item, $valor);

	foreach ($clientes as $row => $value) {
	/* Retrieve and store in array the results of the query.*/
		$id_cliente=$row['id'];
		$row_array['value'] = $row['nombre_cliente'];
		$row_array['id_cliente']=$row['id'];
		$row_array['nombre_cliente']=$row['nombre'];
		
		array_push($return_arr,$row_array);
		 $html .= '<div><a class="suggest-element" data="'.utf8_encode($row['nombre_cliente']).'" id="product'.$row['id'].'">'.utf8_encode($row['nombre_cliente']).'</a></div>';
    }
	


/* Free connection resources. */
mysqli_close($link);

/* Toss back results as json encoded array. */
echo $html;//json_encode($return_arr);


?>
