<?php 

	session_start();

	
	require_once "../conf/conf.php";
	require_once "../lang/$lang";
	require_once '../html_tools/produceMedkitTable.php';
	
	if(!isset($_SESSION['zalogowany']))
		header("Location: ../index.php");
	
	require_once "nagl.php";
	require_once "menu.php";

?>
<div class="col-sm-2 text-center">
</div>

<div class="col-sm-8" align="center">
	<h3>Diagram UML</h3>
	<img src="../doc/MedKit.png" width="80%" height="80%">
	<br>
	<h3>Struktura bazy danych</h3>
	<img src="../doc/Diagram.JPG" width="80%" height="80%">

<br><br><br>
<h3>Domowa Apteczka – Przypadki użycia</h3>
<pre>
1. Logowanie

Cel:
- Uzyskanie dostępu do systemu.
Warunek początkowy:
- Użytkownik nie jest zalogowany.
- Osoba logująca się jest zarejestrowanym użytkownikiem systemu.
Scenariusz działania:
- Wyświetlenie okna logowania.
- Wpisanie e-mail użytkownika i hasła.
- Program weryfikuje poprawność wprowadzonych danych.
Wynik działania:
- Uzyskanie dostępu do funkcji programu.
Błędy:
Użytkownik podał błędne dane.
- Wyświetlenie komunikatu.
- Powrót do okna logowania. 


2. Wylogowanie

Cel:
- Zakończenie pracy z programem.
Warunek początkowy:
- Użytkownik musi być zalogowany.
Scenariusz działania:
- Wylogowanie się.
Wynik działania:
- Wylogowanie użytkownika.
- Wyświetlenie okna logowania (z możliwością zamknięcia programu). 


3. Użycie leku

Cel
-Użycie wybranego ze swojej bądź udostępnionej apteczki leku
Warunek początkowy:
-Użytkownik jest zalogowany / posiada uprawnienia do korzystania z apteczki
Scenariusz działania:
- Zaznaczenie z apteczki leku i kliknięcie „zażyj lek”
- Wyświetlenie okna do zażycia leku
- Wpisanie liczby tabletek oraz daty użycia
- Program weryfikuje poprawność wprowadzonych danych.
Wynik działania:
- baza danych apteczki zostaje uaktualniona o zadaną ilość leków
Błędy:
Użytkownik podał błędne dane.
Walidacja danych za pomocą JS podczas wpisywania


4. Usunięcie leku

Cel
-Usunięcie wybranego ze swojej bądź udostępnionej apteczki leku
Warunek początkowy:
-Użytkownik jest zalogowany / posiada uprawnienia do korzystania z apteczki
Scenariusz działania:
- Zaznaczenie z apteczki leku i kliknięcie „usuń lek”
- Wyświetlenie okna do usunięcia leku
Wynik działania:
- baza danych apteczki zostaje uaktualniona o usunięte leki


5. Dodanie nowego opakowania

Cel
-Dodanie nowego opakowania do swojej apteczki
Warunek początkowy:
-Użytkownik jest zalogowany
Scenariusz działania:
- Kliknięcie „dodaj nowy lek”
- Wyświetlenie okna do dodania nowego leku
- Wpisanie nazwy leku (autouzupełnianie z bazy nazw), liczby tabletek w opakowaniu, daty ważności opakowania oraz ceny za opakowanie
- Program weryfikuje poprawność wprowadzonych danych.
Wynik działania:
- baza danych apteczki zostaje uaktualniona o nowe opakowanie leku
Błędy:
Użytkownik podał błędne dane.
Walidacja danych za pomocą JS podczas wpisywania


6. Udostępnienie apteczki innym użytkownikom

Cel
-Dodanie uprawnień innym użytkownikom do swojej apteczki
Warunek początkowy:
-Użytkownik jest zalogowany
Scenariusz działania:
- Kliknięcie „Udostępnij apteczkę” 
- Wyświetlenie okna do dodania uprawnień
- Wpisanie e-maila osoby, której chce się udostępnić apteczkę oraz uprawnień jakie chce się jej nadać (1 – widzi, 2 – użytkuje, 3 – użytkuje i usuwa)
Wynik działania:
- jeśli podany e-mail istnieje, zostaje przesłana informacja do użytkownika o zadanym e-mailu i przy jego następnym logowaniu 
Błędy:
Użytkownik podał błędne dane.
Walidacja danych za pomocą JS podczas wpisywania


</pre>
<br><br>
<br><br>
<br><br>
</div>


<?php require_once 'stopka.php'; ?>