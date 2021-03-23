<?php
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{
	
	$fetch = mysqli_query($con,"SELECT * FROM Cartera where strDescripcion like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$intCartera=$row['id_cliente'];
		$row_array['value'] = $row['intCartera'];
		$row_array['intCartera']=$intCartera;
		$row_array['strIngresoEgreso']=$row['strIngresoEgreso'];
		$row_array['strDescripcion']=$row['strDescripcion'];
		$row_array['dblImporte']=$row['dblImporte'];

		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>
