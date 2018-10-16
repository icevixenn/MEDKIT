<?php 
	
	
	require_once '../db_tools/queryDB.php';
	
	
	$term = trim(strip_tags($_GET['term']));

	$query = "SELECT nazwa as value FROM leki_specyfikacja WHERE nazwa LIKE '%" .$term. "%'";
	$result = queryDB($query);
	$noRows = $result->num_rows;
	
	
	echo "[";
	
	for ($j=0; $j < $noRows; ++$j){
		
		$result->data_seek($j);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		echo '"'	.	$row['value']	.	'"';
		if ($j != ($noRows-1)) echo ', ';
		
	}
	
	echo "]";
	
	
	
?>

