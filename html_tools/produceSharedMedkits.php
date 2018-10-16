<?php 



	require_once 'generateTable.php';
	require_once '../db_tools/queryDB.php';

	function wyswietUdostepnioneLekiUzytkownika($email)
	{
		
		$query = "


		SELECT 
			len.idkonta,
		    CONCAT(len.imie, ' ', len.nazwisko) AS lender,
			lvl,
			idpackage,
		    CASE
							WHEN lvl = 1 THEN 'widzisz'
		                    WHEN lvl = 2 THEN 'możesz używać'
		                    WHEN lvl = 3 THEN 'możesz używać i usuwać'
						END as 'Poziom udostępniania',
		    leki_specyfikacja.nazwa,
		    dateAssigned,
					    dateExpiry,
					    noTablets_current,
					    noTablets_max,
						CASE
							WHEN DATEDIFF(NOW(), dateExpiry) > 0 THEN (DATEDIFF(NOW(), dateExpiry))
							ELSE ''
						END as 'ile po terminie',
			            CASE
					        WHEN DATEDIFF(NOW(), dateExpiry) > 0 THEN 'Przeterminowany!'
					        ELSE ''
					    END as 'UWAGI'
		FROM
		    shares
		        JOIN
		    users bor ON shares.borrower = bor.idkonta
		        JOIN
		    users len ON shares.lender = len.idkonta
				JOIN
			user_packages ON user_id=len.idkonta
				JOIN
			package ON package_id = idpackage 
				JOIN
			leki_specyfikacja ON leki_specyfikacja_idleki = idleki
				WHERE bor.email LIKE '".$email."%' and lvl > 0 and dateDiscarded is null
			
		";
		
		$etykiety = array(
				"idkonta",
				"Pożyczający",
				"lvl",
				"idpackage",
				"Poziom udostępnienia",
				"Nazwa leku",
				"Data przypisania",
				"Data ważności",
				"Obecna liczba tabletek",
				"Maksymalna liczba tabletek",
				"Liczba dni po terminie",
				"UWAGI"
				
		);
		
		$result = queryDB($query);
		
		//print_r($result);
		
		
		generateTable(
				$etykiety, 	// Etykiety
				queryDB($query) 			  	// Dane
				);
		
	}

?>