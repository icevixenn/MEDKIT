<?php 

	session_start();

	require_once 'generateTable.php';
	require_once '../db_tools/queryDB.php';

	$email = $_SESSION['email'];
	
	// wybierz idkonta
	$query0 = "
	SELECT users.idkonta as ID FROM users WHERE users.email = '$email' ";
	
	$result = queryDB($query0);
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$idborrower = $row['ID'];

	$query1 = "

		SELECT count(*) as sum
		FROM shares
		WHERE `borrower` = $idborrower AND lvl<0

	";
	
	$result = queryDB($query1);
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$count = $row['sum'];
	
	if ($count>0) echo "open";
?>