<?php 

	session_start();
	
	require_once 'queryDB.php';
	$drugName = $_POST['drugName'];
	$noTablets = $_POST['noTablets_max'];
	$dateExpiry = $_POST['dateExpiry'];
	$price2 = $_POST['price'];
	$email = $_SESSION['email'];
	
	//$price = number_format($price2, 2, '.', '');
	$price = str_replace(',','.',$price2);
	//echo "price2=" + $price2;
	//echo "price=" + $price;
	// wybierz idkonta
	$query0 = "SELECT users.idkonta as ID
	FROM users WHERE users.email = '$email'";
	
	$result = queryDB($query0);
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$id = $row['ID'];
	
	// wybierz nazwe leku
	$query1 = "SELECT 
				    idleki
				FROM
				    leki_specyfikacja
				WHERE
				    leki_specyfikacja.nazwa = '".$drugName."' LIMIT 1";
	
	$result = queryDB($query1);
	
	$result->data_seek(0);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	$idleku = $row['idleki'];
		
	// wstaw opakowanie
	$query2 = "INSERT INTO `package` (`noTablets_current`, `noTablets_max`, `dateExpiry`, `price`, `leki_specyfikacja_idleki`) 
			VALUES ($noTablets, 
			$noTablets, 
			'$dateExpiry', 
			'$price', 
			$idleku)";
	
	//echo $query2;
			
	queryDB($query2);
					
	// wybierz wstawione opakowanie
	$query3 = "SELECT idpackage from package order by idpackage desc limit 1";

			
	$result3 = queryDB($query3);
	$result3->data_seek(0);
	$row3 = $result3->fetch_array(MYSQLI_ASSOC);
	$idpackage = $row3['idpackage'];

	// przypisz opakowanie do osoby
	$query4 =  "INSERT INTO user_packages (user_id, package_id, dateAssigned) VALUES ($id, $idpackage, now())";
	queryDB($query4);
	$_SESSION['dodaneOpak'] = "Dodano nowe opakowanie";
	header("location: ../pages/mymedkit.php");
	
?>