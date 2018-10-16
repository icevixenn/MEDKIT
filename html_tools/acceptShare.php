<?php 

	session_start();

	require_once 'generateTable.php';
	require_once '../db_tools/queryDB.php';

	$input = $_POST['idlist'];
	
	$email = $_SESSION['email'];
	
	// wybierz idkonta
	$query0 = "
		SELECT users.idkonta as ID FROM users WHERE users.email = '$email'
	";
	
	$result = queryDB($query0);
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$idborrower = $row['ID'];
	
	
	$counter=0;

	if ($_POST['mode']=="accept"){
		foreach($input as $idlender){
			
			$query1 = "
			UPDATE `shares`
			SET
			`lvl` = abs(lvl),
			`startDate` = now()
			WHERE
			`borrower` = '$idborrower' AND `lender` = '$idlender' AND `endDate` IS NULL;
			";
			queryDB($query1);
		};
	} else if ($_POST['mode']=="reject"){
		foreach($input as $idlender){
			
			$query1 = "
			UPDATE `shares`
			SET
			`lvl` = 0,
			`endDate` = now()
			WHERE
			`borrower` = '$idborrower' AND `lender` = '$idlender' AND `endDate` IS NULL;
			";
			queryDB($query1);
		};
	}
	
	

?>