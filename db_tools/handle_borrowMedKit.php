<?php

	session_start();
	
	require_once 'queryDB.php';
	$email = $_SESSION['email'];
	$emailL = $_POST['emailLend'];
	$lvl = $_POST['lvl'];
	
	$lvl = $lvl*(-1); // pozwolenie na udostępnienie
	
	// wybierz idkonta pożyczającego apteczkę
	$query0 = "SELECT users.idkonta as ID1 FROM users WHERE users.email = '$email'";
	
	$result = queryDB($query0);
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$idBor = $row['ID1'];
	
	// wybierz idkonta udostępniającego apteczkę
	$query1 = "SELECT users.idkonta as ID2
				FROM users
				WHERE users.email = '$emailL'";
	
	$result = queryDB($query1);
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$idLen = $row['ID2'];
	
	// dodaj udostępnienie
	
	$query2 = "UPDATE `shares` SET `lvl` = '$lvl' WHERE `borrower` = '$idBor' AND `lender` = '$idLen' AND `endDate` IS NULL;";
	
	echo "query2=".$query2;
	
	queryDB($query2);
	
	//$_SESSION['addedMedKit'] = "Dodano apteczkę";
	//header("location: ../pages/start.php");

?>