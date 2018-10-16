<?php 

	require_once '../db_tools/queryDB.php';

	$drugName = $_POST['drugName'];	
	
	
	$query = "select count(*) as suma from leki_specyfikacja where nazwa = '$drugName'";
	
	$result = queryDB($query);
	
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$suma = $row['suma'][0];
	
	//echo $drugName;
	
	if ($suma>0) echo "1";
	else echo "0";
?>