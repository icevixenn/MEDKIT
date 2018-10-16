<?php 

	require_once '../db_tools/queryDB.php';
	require_once '../html_tools/generateTable.php';

	function wyswietlLiczbeLekow($email)
	{
		
		$query = "SELECT 
				    SUM(noTablets_max) as noTablets
				FROM
				    package
				        JOIN
				    user_packages ON user_packages.package_id = package.idpackage
				        JOIN
				    users ON user_packages.user_id = users.idkonta
						WHERE
			     users.email LIKE '".$email."%'
			";
		
		$result = queryDB($query);
		$result->data_seek(0);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$noTabs = $row['noTablets'];
		echo $noTabs;		
	}

?>


