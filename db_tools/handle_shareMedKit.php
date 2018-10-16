<?php

	session_start();
	
	require_once 'queryDB.php';
	$email = $_SESSION['email'];
	$emailB = $_POST['emailB'];
	$lvl = $_POST['lvl'];

	// wybierz idkonta lendera
	$query1 = "SELECT users.idkonta as ID
 				FROM users
				 WHERE users.email = '$email'";
	
	$result = queryDB($query1);
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$id1 = $row['ID'];
	
	// wybierz idkonta borrowera
	$query2 = "SELECT users.idkonta as ID
 				FROM users
				 WHERE users.email = '".$emailB."'";
	
	$result = queryDB($query2);
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$id2 = $row['ID'];
	
	if(isset($id1) && ($id2)){
		
		// dodaj udostępnienie
		$query3 = "INSERT INTO `shares` 
				(`borrower`, 
				`lender`, 
				`lvl`, 
				`invitationDate`)
						VALUES (
					'$id2', 
				'$id1', 
				'$lvl', 
				now());";
		
		echo "query=" . $query3;
		
		queryDB($query3);
	}
	
	
	$_SESSION['addedShare'] = "Dodano udostępnienie";
	header("location: ../pages/mymedkit.php");

?>



