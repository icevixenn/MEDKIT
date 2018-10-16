


<?php 
	
	require_once 'queryDB.php';

	$term = trim(strip_tags($_GET['term']));
	
	$qstring = "SELECT nazwa as value FROM leki_specyfikacja WHERE nazwa LIKE 'Ade%'";
	
	
	$result = queryDB($qstring);//query the database for entries containing the term
	
	while ($row = mysql_fetch_array($result,MYSQL_ASSOC))//loop through the retrieved values
	{
		$row['value']=htmlentities(stripslashes($row['value']));
		$row_set[] = $row;//build an array
	}
	

	echo json_encode($row_set);//format the array into json data

?>
