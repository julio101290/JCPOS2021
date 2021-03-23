<?php
if (isset($_GET['term'])){
include("../../config/db.php");
include("../../config/conexion.php");
$return_arr = array();
/* If connection to database, run sql statement. */
if ($con)
{
	
	$fetch = mysqli_query($con,"SELECT A.lngIdProductoSAT 
                                       ,A.strDescripcionSAT
                                       ,A.strClave
                                       ,A.strClaveunidadSat
                                       ,(select B.strDescripcionUnidadSAT FROM UnidadesSAT B where B.strClaveUnidadSAT=A.strClaveunidadSat ) as strDescripcionUnidadSAT

                                FROM ProductosSAT A
                                where A.strDescripcionSAT like '%" . mysqli_real_escape_string($con,($_GET['term'])) . "%' LIMIT 0 ,50"); 
	
	/* Retrieve and store in array the results of the query.*/
	while ($row = mysqli_fetch_array($fetch)) {
		$strDescripcionSAT=$row['strDescripcionSAT'];
		$row_array['value'] = $row['strDescripcionSAT'];
       // $row_array['value'] = $row['strDescripcionSAT'];
		$row_array['strClave']=$row['strClave'];
        $row_array['strClaveunidadSat']=$row['strClaveunidadSat'];
        $row_array['strDescripcionUnidadSAT']=$row['strDescripcionUnidadSAT'];

		array_push($return_arr,$row_array);
    }
	
}

/* Free connection resources. */
mysqli_close($con);

/* Toss back results as json encoded array. */
echo json_encode($return_arr);

}
?>
