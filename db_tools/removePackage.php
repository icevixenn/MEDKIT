<?php 

	require_once 'queryDB.php';

	$dateDiscarded = $_GET['dateDiscarded'];
	$packID = $_GET['packID'];
	
	$query = "UPDATE `package` SET `dateDiscarded`=$dateDiscarded WHERE `idpackage`=$packID";
	queryDB($query);

	echo "Wykonuje query :".$query;

?>