

<?php 
	
	require_once 'connectToDB.php';
	require_once '../conf/conf.php';

	/* queryDB($query)
	 *
	 * Funkcja przesyłająca zapytanie do bazy danych.
	 * @param string $query - Zapytanie do bazy danych.
	 * @return Object $wynik - obiekt będący odpowiedzią bazy
	 */

	
	
	function queryDB($query){
		
		global $db_EnableSelect;
		global $db_EnableInsert;
		global $db_EnableDelete;
		global $db_EnableUpdate;
		
		//Filtrowanie query
		
		
		if ($db_EnableSelect == false && strpos($query, 'SELECT') !== false){
			return null;
		}
		
		if ($db_EnableInsert== false &&  strpos($query, 'INSERT') !== false){
			return null;
		}
		
		if ($db_EnableDelete== false &&  strpos($query, 'DELETE') !== false){
			return null;
		}
		
		if ($db_EnableUpdate== false && strpos($query, 'UPDATE') !== false){
			return null;
		}
				
		$baza = connectToDB();
		
		$wynik = $baza->query($query);
		if(!$wynik) die($baza->error);
		
		
		
		return $wynik;
	}
?>
