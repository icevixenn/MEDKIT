<?php
session_start();


// brak maila lub hasla


if ((!isset($_POST['email'])) || (!isset($_POST['password'])))
{
	header('location: ../index.php');
	exit();
}

require_once "../conf/conf.php";

// Połączenie z Bazą
$baza = @new mysqli($dbServer, $dbLogin, $dbHaslo, $dbBaza);
$baza->set_charset("utf8");

// Sprawdzanie czy się udało

if ($baza->connect_errno!=0)
{
	echo "Error: ".$baza->connect_errno;
}
else
{
	$email = $_POST['email'];
	$password = $_POST['password'];

	$email = htmlentities($email, ENT_QUOTES, "UTF-8"); // zamienia na ciag znakow

	if($rezultat = @$baza->query(
			sprintf("SELECT * FROM users WHERE email='%s'",
					mysqli_real_escape_string($baza,$email)))) // zabezpiecza od wstrzykiwania sqla

	{
		$ilu_userow = $rezultat->num_rows;
		if($ilu_userow>0)
		{
			$wiersz = $rezultat->fetch_assoc(); // pobranie tablicy asocjacyjnej z bazy
			if(password_verify($password, $wiersz['haslo'])) // sprawdza czy haslo z bazy sie zgadza z podanym
			{
				// Password_default - algorytm hasujacy bazy danych obecnie uzywany
				$_SESSION['zalogowany'] = true;
				$_SESSION['email'] = $wiersz['email'];
				$_SESSION['imie'] = $wiersz['imie'];
				$_SESSION['nazwisko'] = $wiersz['nazwisko'];
				$_SESSION['idkonta'] = $wiersz['idkonta'];
					
				unset($_SESSION['blad']);
				$rezultat->free_result();
				header('Location: ../pages/start.php');  // przekierowanie do innej strony!!
			}
			else
			{	
			$_SESSION['blad'] = 'Nieprawidłowe hasło lub e-mail!';
			// $_SESSION['haslo'] = $wiersz['haslo'];
			// $_SESSION['haslo1'] = $password;
			header('Location: ../index.php');
			}				
	
		}
		else {
			$_SESSION['blad'] = 'Nieprawidłowe hasło lub e-mail!';
			header('Location: ../index.php');

		}
	}

	$baza->close();
}

?>