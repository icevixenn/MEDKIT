<?php 

	require_once 'generateTable.php';
	require_once '../db_tools/queryDB.php';

	function wyswietlDzielenieApteczek($email)
	{
		// TODO ZMIEN JAKOŚ JOINY ŻEBY DODAĆ BORROWER DO IDKONTA TEŻ
		$query = "SELECT   
				u2.email AS 'borrower1',
               
                CASE
					WHEN lvl = 1 THEN 'widzi'
                    WHEN lvl = 2 THEN 'może używać'
                    WHEN lvl = 3 THEN 'może używać i usuwać'
                    WHEN lvl <0 THEN 'czeka na potwierdzenie'
				END as 'Poziom udostępniania'
				FROM
			    shares
			        JOIN
    			users u1 ON lender = u1.idkonta
					JOIN
				users u2 ON borrower = u2.idkonta
			WHERE
			     u1.email LIKE '".$email."%' AND lvl != 0
			";
		
		$labels = array("email pożyczającego", "Poziom udostępnienia");
		
		generateTable(
				
				$labels, 	// Etykiety
				queryDB($query) 			  	// Dane
				);
		
	}

?>