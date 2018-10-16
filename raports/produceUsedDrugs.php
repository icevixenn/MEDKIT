<?php 

require_once '../db_tools/queryDB.php';
require_once '../html_tools/generateTable.php';

	function wyswietlBraneLekiUzytkownika($email)
	{
		
		$query = "SELECT
				drug_intake.dateUsed,				
                leki_specyfikacja.nazwa,
				drug_intake.drugsUsed,
				CONCAT(u2.imie, ' ', u2.nazwisko)	    
			FROM
			    drug_intake
			        JOIN
			    users u1 ON drug_intake.users_idkonta = u1.idkonta
			        JOIN
				package ON drug_intake.package_idpackage = package.idpackage
                    JOIN
			    leki_specyfikacja ON leki_specyfikacja.idleki = package.leki_specyfikacja_idleki
					JOIN
				user_packages ON user_packages.package_id = package.idpackage
					JOIN	
				users u2 ON u2.idkonta = user_packages.user_id
			WHERE
			     u1.email LIKE '".$email."%'
			";
		
		
		$labels = array("Data użycia", "Nazwa leku", "Liczba wziętych leków", "Właściciel leku");
		
		generateTable(
				$labels, 	// Etykiety
				queryDB($query) 			  	// Dane
				);
		
	}

?>