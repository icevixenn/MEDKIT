<?php 
session_start();

if (!isset($_SESSION['zalogowany']))
{
	header('Location: ../index.php');
	exit();
}

require_once '../conf/conf.php';
require_once "../lang/$lang";
require_once '../html_tools/produceLends.php';
require_once "nagl.php";
require_once "menu.php";
?>

<!-- Skrypt obsługujący akceptowanie udostępnienia apteczki -->
<script>
	$( function(){
	
		function strcmp(a, b) {
		    if (a.toString() < b.toString()) return -1;
		    if (a.toString() > b.toString()) return 1;
		    return 0;
		}
	
		request = $.ajax({
	        url: "../html_tools/checkPendingShares.php",
	        type: "post",
	        data: {
	        	mode: "accept"
	        }
	    });
	
		request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console
	 
	        if (response.trim()=="open"){
	        	$("#divBorrowMedkit").dialog('open');
	        }
	    });
	});
</script>

<div class="jumbotron">
      <div class="container">
        <h1 class="display-3"></h1>
        <p></p>
        <p><a class="btn btn-primary btn-lg" href="./mymedkit.php" role="button">Przejdź do swojej apteczki &raquo;</a></p>
      </div>
</div>


<div class="col-md-2">

</div>


<div class="col-md-6 text-center">
	<section>
	      <div class="container">
	        <div class="row align-items-center">
	          <div class="col-lg-6 order-lg-2">
	            <div class="p-5">
	              <img class="ratio img-responsive" src="../img/drugs.png" alt="">
	            </div>
	          </div>
	          <div class="col-lg-6 order-lg-1">
	            <div class="p-5">
	              <h2 class="display-4">Korzystaj i dziel się z innymi</h2>
	              <p>Po pomyślnym zalogowaniu masz możliwość dodawania nowych leków do apteczki z uwzględnieniem ich liczby, daty ważności oraz ceny, zażywania leków oraz ich usuwania.
	              Po upłynięciu terminu ważności leku dostaniesz specjalne powiadomienie!
	              Dodatkowo możesz swoją apteczkę udostępniać innym użytkownikom i vice versa.</p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </section>
	
	<section>
	      <div class="container">
	        <div class="row align-items-center">
	          <div class="col-lg-6 order-lg-2">
	            <div class="p-5">
	              <img class="ratio img-responsive" src="../img/file_search.jpg" alt="">
	            </div>
	          </div>
	          <div class="col-lg-6 order-lg-1">
	            <div class="p-5">
	              <h2 class="display-4">Wyszukaj lek</h2>
	              <p>Gdy zapomnisz nazwy danego leku, możesz go wyszukać w zakładce "Wyszukaj lek". Masz możliwość podania całego, bądź części kodu EAN, wybranej substancji czynnej leku,
	              bądź jego nazwy. Pasujące wyniki pokażą się następnie w tabeli, z której możesz wybrać szukany lek.</p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </section>
	
	    <section>
	      <div class="container">
	        <div class="row align-items-center">
	          <div class="col-lg-6">
	            <div class="p-5">
	              <img class="ratio img-responsive" src="../img/statistics.jpg" alt="">
	            </div>
	          </div>
	          <div class="col-lg-6">
	            <div class="p-5">
	              <h2 class="display-4">Przeglądaj statystyki</h2>
	              <p>Cała twoja działalność w aplikacji jest zapisywana w bazie danych. Klikając w zakładkę "Statystyka" możesz przeglądnąć historię użytkowania aplikacji:
	              jak dużo leków wyrzucasz z powodu przeterminowania, ile w danym czasie wydałeś na lekarstwa etc.</p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </section>
	
	    <section>
	      <div class="container">
	        <div class="row align-items-center">
	          <div class="col-lg-6 order-lg-2">
	            <div class="p-5">
	              <img class="ratio img-responsive" src="../img/doc.png" alt="">
	            </div>
	          </div>
	          <div class="col-lg-6 order-lg-1">
	            <div class="p-5">
	              <h2 class="display-4">Dokumentacja</h2>
	              <p>W zakładce "Dokumentacja" znajdziesz informacje na temat powstania aplikacji. Widoczny jest diagram UML działalności użytkowników, stworzona struktura bazy danych
	              oraz opis przypadków użycia z uwzględnieniem celu, scenariusza działania, wyniku działania oraz przewidzianymi błędami.</p>
	            </div>
	          </div>
	        </div>
	      </div>
	    </section>


<br><br>
<br><br>
<br><br>

<?php require_once './forms/borrowMedkit.php';?>

</div>


<?php require_once 'stopka.php';?>