<?php 

	
	require_once '../db_tools/queryDB.php';
	require_once '../html_tools/generateTable.php';
	
	function wyswietlUsunieteLekiUzytkownika($email)
	{
		
		$query = "SELECT
				dateDiscarded,			    
				dateAssigned,
			    dateExpiry,
			    noTablets_current,
			    noTablets_max,
				nazwa
			FROM
			    user_packages
			        JOIN
			    users ON user_packages.user_id = users.idkonta
			        JOIN
			    package ON user_packages.package_id = package.idpackage
			        JOIN
			    leki_specyfikacja ON leki_specyfikacja.idleki = package.leki_specyfikacja_idleki
			WHERE
			     users.email LIKE '".$email."%'
				AND dateUnassigned IS NULL
				AND dateDiscarded IS NOT NULL
			ORDER BY nazwa asc
			";
		
		
		$labels = array("Data wyrzucenia leku", "Data dodania", "Termin ważnosci", "Bieżąca liczba tabletek", "Liczba tabletek w opakowaniu", "Nazwa leku");
		

		
		generateTable(
			
				$labels,
				queryDB($query) 			  	// Dane
				);
		
	}

?>