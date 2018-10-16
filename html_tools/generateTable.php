<?php 

/*
 * stworzTabelke()
 *
 * Funkcja generuje kod HTML tabelki na podstawie danych wejsciowych.
 *
 * @param array $labels - Nazwy kolumn.
 * @param Object $result - Dane do wyswietlenia w tabeli.
 * @param int $wyglad - Reguluje wygląd tabelki:
 * 							1-tabelka niebieska
 * 							2-tabelka czerwona
 */

function generateTable($labels, $result){
	

	
	// Drukuj znaczkik table razem z parametrami (deprecated much)
	print "<table id=\"example\" class=\"display\" cellspacing=\"0\" width=\"100%\">";
	
	// Generuj kod HTML dla tytułów kolumn w tabelce.
	print "<thead>";
	print " <tr> ";
	foreach($labels as $columnName){
		print " <th>$columnName</th> ";
	}
	print " </tr> ";
	print "</thead>";
	print "<tbody>";
	// Drukuj tresc
	
	
	$rowcount=mysqli_num_rows($result);

	
	
	for ($i=0;$i<$rowcount;$i++){
		
		
		$row = $result->fetch_row();

		
		for ($j=0; $j<sizeof($row);$j++){
			print " <td>$row[$j]</td> ";
		}
		
		print " </tr>";
		
		
	}

	print "</tbody>";
	print "</table>";
}

?>