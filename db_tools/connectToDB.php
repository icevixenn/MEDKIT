<?php 

	require_once '../conf/conf.php';

	/* connectToDB()
	 *
	 * Funkcja łącząca się z bazą danych
	 * @return Obiekt $baza - Obiekt bazy danych.
	 */
	
	function connectToDB(){
		global $dbServer, $dbLogin, $dbHaslo, $dbBaza;
		$baza = @new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);
		if($baza->connect_error) die($baza->connect_error);
		$baza->set_charset("utf8");
		// Przygotowanie zapytania
		return $baza;
	}

?>