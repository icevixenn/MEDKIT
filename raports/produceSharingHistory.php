<?php 

require_once '../db_tools/queryDB.php';
require_once '../html_tools/generateTable.php';

	function wyswietlHistorieUdostepniania($email)
	{
		
		$query = "SELECT
                CONCAT(u2.imie, ' ', u2.nazwisko) AS lender,
                CONCAT(u1.imie, ' ', u1.nazwisko) AS borrower,
				CASE
							WHEN u1.email LIKE '".$email."%' THEN '<'
							WHEN u2.email LIKE '".$email."%' THEN '>'
						END as 'kierunek',
				CASE
							WHEN lvl = 1 THEN 'widoczność'
		                    WHEN lvl = 2 THEN 'możliwość zażywania leków'
		                    WHEN lvl = 3 THEN 'możliwość zażywania i usuwania leków'
						END as 'Poziom udostępniania',
                CASE
						WHEN startDate IS NULL and endDate IS NULL THEN 'czeka na potwierdzenie'
                        WHEN startDate IS NULL and endDate IS NOT NULL THEN 'odrzucono'
                        WHEN startDate IS NOT NULL and endDate IS NULL THEN 'obecnie udostępniana'
                        WHEN startDate IS NOT NULL and endDate IS NOT NULL THEN 'zakończono udostępnianie'
					END as 'status',
				CASE
						WHEN startDate IS NULL and endDate IS NULL THEN invitationDate
                        WHEN startDate IS NULL and endDate IS NOT NULL THEN endDate
                        WHEN startDate IS NOT NULL and endDate IS NULL THEN startDate
                        WHEN startDate IS NOT NULL and endDate IS NOT NULL THEN endDate
					END as 'ostatnia aktualizacja statusu'

			FROM
				shares
					JOIN
				users u1 ON u1.idkonta = shares.borrower
					JOIN	
				users u2 ON u2.idkonta = shares.lender	
			WHERE
			     u1.email LIKE '".$email."%' OR u2.email LIKE '".$email."%'
			";
		
		
		$labels = array("Właściciel apteczki", "Pożyczający", "Kierunek", "Poziom Udostępniania", "Status", "Ostatnia aktualizacja statusu");
		
		generateTable(
				
				$labels, 	// Etykiety
				queryDB($query) 			  	// Dane
				);
		
	}

?>