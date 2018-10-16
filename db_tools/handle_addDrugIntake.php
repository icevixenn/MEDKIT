<?php

	session_start();
	
	require_once 'queryDB.php';
	$drugName = $_POST['"f1_drugName"'];
	$noTablets = $_POST['f1_noTabletsUsed'];
	$dateUsed = $_POST['dateUsed'];
	$packageId = $_POST['f1_id'];
	$tabCurrent = $_POST['f1_tabCurrent'];
	$email = $_SESSION['email'];
	
	// wybierz idkonta
	$query0 = "SELECT users.idkonta as ID FROM users WHERE users.email = '$email'";
	
	$result = queryDB($query0);
	
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$id = $row['ID'];
	
	echo "notablets = " . $noTablets;
	// wstaw zazycie leku
	$query2 = "INSERT INTO `drug_intake` 
		(`dateUsed`, `users_idkonta`, `package_idpackage`, `drugsUsed`) 
		VALUES (
			'$dateUsed', 
			$id, 
			$packageId, 
			$noTablets)";
	
	echo $query2;
	
	queryDB($query2);
	
	$newCurrent = $tabCurrent-$noTablets;
	
	// uaktualnij liczbe tabletek w opakowaniu
	$query3 = "UPDATE `package` SET `noTablets_current`='$newCurrent' WHERE `idpackage`=$packageId";
	queryDB($query3);
	$_SESSION['uzytyLek'] = "Pomyślnie zażyto lek";
	

	echo $query3;
	
	$site= $_SESSION['site'];
	if($site==0)
	{
		header("location: ../pages/mymedkit.php");
	}
	else if($site==1)
	{
		header("location: ../pages/sharedMedKits.php");
	}

?>