<?php 

	require_once 'generateTable.php';
	require_once '../db_tools/queryDB.php';
	
	function wyswietlPrzeterminowaneLeki($email)
	{
		
		$query = "SELECT
		    nazwa, dateAssigned, dateExpiry, noTablets_current, noTablets_max, DATEDIFF(NOW(),dateExpiry) AS DiffDate
		FROM
		    user_packages
		        JOIN
		    users ON user_packages.user_id = users.idkonta
		        JOIN
		    package ON user_packages.package_id = package.idpackage
		        JOIN
		    leki_specyfikacja ON leki_specyfikacja.idleki = package.leki_specyfikacja_idleki
		WHERE
		    users.email LIKE '".$email."%' AND dateExpiry < now()";
		
		
		generateTable(
				//TODO
				["Nazwa leku", "Data dodania", "Termin ważnosci", "Bieżąca liczba tabletek", "Liczba tabletek w opakowaniu", "Ilosc dni po terminie"], 	// Etykiety
				queryDB($query) 			  	// Dane
				);
	}
	
	
?>