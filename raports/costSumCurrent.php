<?php 

	require_once '../db_tools/queryDB.php';
	require_once '../html_tools/generateTable.php';

	function wyswietlObecnaCeneApteczki($email)
	{
		
		$query = "SELECT 
				    SUM(price) as price
				FROM
				    package
				        JOIN
				    user_packages ON user_packages.package_id = package.idpackage
				        JOIN
				    users ON user_packages.user_id = users.idkonta
						WHERE
			     users.email LIKE '".$email."%' and dateDiscarded IS NULL
			";
		
		$result = queryDB($query);
		$result->data_seek(0);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$price = $row['price'];
		echo $price;		
	}

?>


