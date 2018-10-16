<?php 

	session_start();
	require_once '../db_tools/queryDB.php';


	$dateFrom = $_POST['dateFrom'];
	$dateTo= $_POST['dateTo'];
	$email = $_SESSION['email'];
		
	$query = "SELECT 
				    SUM(noTablets_max) as noTabTime
				FROM
				    package
				        JOIN
				    user_packages ON user_packages.package_id = package.idpackage
				        JOIN
				    users ON user_packages.user_id = users.idkonta
						WHERE
			     users.email LIKE '".$email."%'
			     and dateAssigned < '$dateTo' and dateAssigned > '$dateFrom'
			";
		
	$result = queryDB($query);
	$result->data_seek(0);
	$row = $result->fetch_assoc();
	
	if($row['noTabTime'] == NULL) $row['noTabTime']=0;
	
	$_SESSION['responseType'] = 'noTabTime';
	$_SESSION['responseVal'] = $row['noTabTime'];
	
	$result->free_result();
	header('Location: ../pages/stats.php'); 
	
?>