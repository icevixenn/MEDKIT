<?php

	session_start();
	
	require_once 'queryDB.php';
	$packageId = $_POST['f2_id'];
	
	$array = explode(',', $packageId);
	
	foreach ($array as $id ){
		$query2 = "UPDATE `package` SET `dateDiscarded`=now() WHERE `idpackage`= '$id';";
		
		queryDB($query2);
	}
		
	print_r($packageId);
	
	if ($_SESSION['referer'] == 'myMedKit') header("location: ../pages/mymedkit.php");
	else if ($_SESSION['referer'] == 'sharedMedKits') header("location: ../pages/sharedMedKits.php");

?>
