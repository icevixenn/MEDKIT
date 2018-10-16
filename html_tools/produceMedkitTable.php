<?php 

	require_once 'generateTable.php';
	require_once '../db_tools/queryDB.php';

	function wyswietlWszystkieLekiUzytkownika($email)
	{
		
		$query = "SELECT
				package.idpackage,
			    nazwa,
			    dateAssigned,
			    dateExpiry,
				price,
			    noTablets_current,
			    noTablets_max,
				CASE
					WHEN DATEDIFF(NOW(), dateExpiry) > 0 THEN (DATEDIFF(NOW(), dateExpiry))
					ELSE ''
				END as 'ile po terminie',
	            CASE
					WHEN noTablets_current = 0 THEN 'Puste opakowanie'
			        WHEN DATEDIFF(NOW(), dateExpiry) > 0 THEN 'Przeterminowany!'
			        ELSE ''
			    END as 'UWAGI'
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
				AND dateDiscarded IS NULL
			ORDER BY UWAGI desc, nazwa asc
			";
		
		$etykiety = array("idpackage", "Nazwa leku", "Data dodania", "Termin ważnosci", "Cena", "Bieżąca liczba tabletek", "Liczba tabletek w opakowaniu", "Ilosc dni po terminie", 'UWAGI');
		
		generateTable(
				//TODO
				$etykiety, 	// Etykiety
				queryDB($query) 			  	// Dane
				);
		
	}

?>