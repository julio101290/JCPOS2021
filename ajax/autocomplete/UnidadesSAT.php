<?php
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{
	
	$fetch = mysqli_query($con,"SELECT A.strDescripcionUnidadSAT 
                                       ,A.strClaveunidadSat
                                      

                                FROM UnidadesSAT A
                                where A.strDescripcionUnidadSAT like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$strDescripcionUnidadSAT=$row['strDescripcionUnidadSAT'];
		$row_array['value'] = $row['strDescripcionUnidadSAT'];
       // $row_array['value'] = $row['strDescripcionSAT'];
		$row_array['strClave']=$row['strClaveunidadSat'];
        $row_array['strClaveunidadSat']=$row['strClaveunidadSat'];
  

		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>
