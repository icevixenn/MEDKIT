
<?php 
	session_start();
	
	require_once "../conf/conf.php";
	require_once "../lang/$lang";
	require_once '../raports/produceDiscardedDrugs.php';
	require_once '../raports/produceUsedDrugs.php';
	require_once '../raports/produceSharingHistory.php';
	require_once '../raports/costSum.php';
	require_once '../raports/costSumCurrent.php';
	require_once '../raports/noTabCurrent.php';
	require_once '../raports/noTabSum.php';
	
	if(!isset($_SESSION['zalogowany']))
		header("Location: ../index.php");
	
	require_once "nagl.php";
	require_once "menu.php";

?>
 <script src = "../js/DataTable.js"></script>

<!-- Obsługa przycisków zawężania kryterium wyszukiwania wg daty -->

<script type="text/javascript">

$(function() {

	
	var oTable = $('#example').DataTable();

	  $("#datepicker_from").datepicker({
	    showOn: "button",
	    buttonImage: "../doc/calendar-icon.png",
	    buttonImageOnly: true,
	    "onSelect": function(date) {
	      minDateFilter = new Date(date).getTime();      
	      oTable.draw();
	    }
	  }).keyup(function() {
	    minDateFilter = new Date(this.value).getTime();
	    oTable.draw();
	  });

	  $("#datepicker_to").datepicker({
	    showOn: "button",
	    buttonImage: "../doc/calendar-icon.png",
	    buttonImageOnly: true,
	    "onSelect": function(date) {
	      maxDateFilter = new Date(date).getTime();
	      oTable.draw();
	    }
	  }).keyup(function() {
	    maxDateFilter = new Date(this.value).getTime();
	    oTable.draw();
	  });

	});

//Date range filter
minDateFilter = "";
maxDateFilter = "";
dateColumn = 0;

$.fn.dataTableExt.afnFiltering.push(
		
		  function(oSettings, aData, iDataIndex) {
		    if (typeof aData._date == 'undefined') {
		      aData._date = new Date(aData[dateColumn]).getTime();
		    }

		    if (minDateFilter && !isNaN(minDateFilter)) {
		      if (aData._date < minDateFilter) {
		        return false;
		      }
		    }

		    if (maxDateFilter && !isNaN(maxDateFilter)) {
		      if (aData._date > maxDateFilter) {
		        return false;
		      }
		    }

		    return true;
		  }
		);

</script>

<div class="col-sm-2 sidenav" style="padding: 50px">
<div class="row">	
<div class="container-fluid text-center">
	<div class="row content">
	    <div class="col-sm-2 sidenav">
			<div id="tresc">
				<form action="stats.php" method="POST" role="form" style="display: block;">
					<div class="btn-group-vertical">
						<button type="submit" name="selection" value="raport_usunieteLeki" class="btn btn-success">Historia usuniętych leków</button>
						<button type="submit" name="selection" value="raport_braneLeki" class="btn btn-success">Historia zażytych leków</button>
						<button type="submit" name="selection" value="raport_udostepnienia" class="btn btn-success">Historia udostępnień</button>
						
						<button type="submit" name="selection" value="kupno" class="btn btn-success">Cena apteczki</button>
						<button type="submit" name="selection" value="liczbaTab" class="btn btn-success">Liczba leków</button>
						
						<button type="submit" name="selection" value="raport_kupno" class="btn btn-success">Koszt zakupionych leków</button>
						<button type="submit" name="selection" value="raport_usuniete" class="btn btn-success">Koszt usuniętych leków</button>
						
						<button type="submit" name="selection" value="raport_liczbaTab" class="btn btn-success">Liczba zakupionych leków</button>
						<button type="submit" name="selection" value="raport_opak" class="btn btn-success">Liczba zakupionych opakowań</button>
						<button type="submit" name="selection" value="raport_TabUsuniete" class="btn btn-success">Liczba usuniętych leków</button>
						<button type="submit" name="selection" value="raport_TabUzyte" class="btn btn-success">Liczba zażytych leków</button>
					</div> 
				</form>
			</div>
		</div>
	</div>
</div>
</div>
</div>
	 
<div class="col-sm-8 text-center">
<?php 

if (isset($_POST['selection']))
{
	if($_POST['selection'] == "raport_usunieteLeki")
	{

		echo "<p> Tabela wyrzuconych leków przez użytkownika " . $_SESSION['imie'] . " " .  $_SESSION['nazwisko'] . ":<p><br>" ;
		
		echo'<div class="container">';
		echo'<div class="col-md-6 col-md-offset-2">';
		echo'<div class="panel panel-default">';
		echo'<div class="panel-body">';
		echo'<p>Wybierz przedział czasowy: </p><br>';
		echo '<t id="date_filter">';
		
		echo '<div class="row">';
		echo '<div class="col-md-6">';
		
		echo '<div class="well">Data początkowa: <div id="datepicker_from"></div></div>';
		
		echo '</div>';
		

		
		echo '<div class="col-md-6">';
		echo '<div class="well">Data początkowa: <div id="datepicker_to"></div></div>';
		echo '</div>';
		echo '</div>';
		
		echo '</t>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		
		wyswietlUsunieteLekiUzytkownika($_SESSION['email']);	
	}
	else if($_POST['selection'] == "raport_braneLeki")
	{
		echo "<p> Tabela leków branych przez użytkownika " . $_SESSION['imie'] . " " .  $_SESSION['nazwisko'] . ":<p><br><br>" ;
		
		echo'<div class="container">';
		echo'<div class="col-md-6 col-md-offset-2">';
		echo'<div class="panel panel-default">';
		echo'<div class="panel-body">';
		echo'<p>Wybierz przedział czasowy: </p><br>';
		echo '<t id="date_filter">';
		
		echo '<div class="row">';
		echo '<div class="col-md-6">';
		
		echo '<div class="well">Data początkowa: <div id="datepicker_from"></div></div>';
		
		echo '</div>';
		
		
		
		echo '<div class="col-md-6">';
		echo '<div class="well">Data początkowa: <div id="datepicker_to"></div></div>';
		echo '</div>';
		echo '</div>';
		
		echo '</t>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
		
		wyswietlBraneLekiUzytkownika($_SESSION['email']);
	}
	else if($_POST['selection'] == "raport_udostepnienia")
	{
		echo "<p> Tabela udostępnień apteczek użytkownika " . $_SESSION['imie'] . " " .  $_SESSION['nazwisko'] . ":<p><br><br>" ;

		wyswietlHistorieUdostepniania($_SESSION['email']);
	}
	else if($_POST['selection'] == "kupno")
	{

		echo "<p> W sumie na leki wydano: <p>" ;
		wyswietlCeneApteczki($_SESSION['email']);
		echo " zł";
		echo "<p> Obecna wartość apteczki: <p>" ;
		wyswietlObecnaCeneApteczki($_SESSION['email']);
		echo " zł<br>";
	}
	else if($_POST['selection'] == "raport_kupno")
	{
		echo'<div class="container">';
		echo'<div class="row">';
		echo'<div class="col-md-4 col-md-offset-4">';
		echo'<div class="panel panel-default">';
		echo'<div class="panel-body">';
		echo "<form action=\"../raports/costSumTimeDepend.php\" method=\"POST\" role=\"form\" style=\"display: block;\">";
		echo "<p>Wybierz przedział czasowy: </p><br>";
		echo "<input type=\"date\" name=\"dateFrom\">";
		echo "<br><input type=\"date\" name=\"dateTo\">";
		echo "<br><br><input type=\"submit\" value=\"Podaj cenę apteczki\" class=\"btn btn-success\">";
		echo "</form>";
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
	}
	else if($_POST['selection'] == "raport_usuniete")
	{
		echo'<div class="container">';
		echo'<div class="row">';
		echo'<div class="col-md-4 col-md-offset-4">';
		echo'<div class="panel panel-default">';
		echo'<div class="panel-body">';
		echo "<form action=\"../raports/costSumTimeDependDiscardedDrugs.php\" method=\"POST\" role=\"form\" style=\"display: block;\">";
		echo "<p>Wybierz przedział czasowy: </p><br>";
		echo "<input type=\"date\" name=\"dateFrom\">";
		echo "<br><input type=\"date\" name=\"dateTo\">";
		echo "<br><br><input type=\"submit\" value=\"Podaj cenę usuniętych leków\" class=\"btn btn-success\">";
		echo "</form>";
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
	}
	else if($_POST['selection'] == "liczbaTab")
	{
		
		echo "<p> W sumie kupiono: <p>" ;
		wyswietlLiczbeLekow($_SESSION['email']);
		echo " tabletek";
		echo "<p> Obecnie w apteczce znajduje się: <p>" ;
		wyswietlObecnaLiczbeLekow($_SESSION['email']);
		echo " tabletek<br>";
	}
	else if($_POST['selection'] == "raport_liczbaTab")
	{
		echo'<div class="container">';
		echo'<div class="row">';
		echo'<div class="col-md-4 col-md-offset-4">';
		echo'<div class="panel panel-default">';
		echo'<div class="panel-body">';
		echo "<form action=\"../raports/noTabTimeDepend.php\" method=\"POST\" role=\"form\" style=\"display: block;\">";
		echo "<p>Wybierz przedział czasowy: </p><br>";
		echo "<input type=\"date\" name=\"dateFrom\">";
		echo "<br><input type=\"date\" name=\"dateTo\">";
		echo "<br><br><input type=\"submit\" value=\"Podaj liczbę zakupionych tabletek\" class=\"btn btn-success\">";
		echo "</form>";
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
	}
	else if($_POST['selection'] == "raport_opak")
	{
		echo'<div class="container">';
		echo'<div class="row">';
		echo'<div class="col-md-4 col-md-offset-4">';
		echo'<div class="panel panel-default">';
		echo'<div class="panel-body">';
		echo "<form action=\"../raports/noPackageTimeDepend.php\" method=\"POST\" role=\"form\" style=\"display: block;\">";
		echo "<p>Wybierz przedział czasowy: </p><br>";
		echo "<input type=\"date\" name=\"dateFrom\">";
		echo "<br><input type=\"date\" name=\"dateTo\">";
		echo "<br><br><input type=\"submit\" value=\"Podaj liczbę zakupionych opakowań\" class=\"btn btn-success\">";
		echo "</form>";
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
	}
	else if($_POST['selection'] == "raport_TabUsuniete")
	{
		echo'<div class="container">';
		echo'<div class="row">';
		echo'<div class="col-md-4 col-md-offset-4">';
		echo'<div class="panel panel-default">';
		echo'<div class="panel-body">';
		echo "<form action=\"../raports/noTabTimeDependDiscarded.php\" method=\"POST\" role=\"form\" style=\"display: block;\">";
		echo "<p>Wybierz przedział czasowy: </p><br>";
		echo "<input type=\"date\" name=\"dateFrom\">";
		echo "<br><input type=\"date\" name=\"dateTo\">";
		echo "<br><br><input type=\"submit\" value=\"Podaj liczbę usuniętych tabletek\" class=\"btn btn-success\">";
		echo "</form>";
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
	}
	else if($_POST['selection'] == "raport_TabUzyte")
	{
		echo'<div class="container">';
		echo'<div class="row">';
		echo'<div class="col-md-4 col-md-offset-4">';
		echo'<div class="panel panel-default">';
		echo'<div class="panel-body">';
		echo "<form action=\"../raports/noTabTimeDependUsed.php\" method=\"POST\" role=\"form\" style=\"display: block;\">";
		echo "<p>Wybierz przedział czasowy: </p><br>";
		echo "<input type=\"date\" name=\"dateFrom\">";
		echo "<br><input type=\"date\" name=\"dateTo\">";
		echo "<br><br><input type=\"submit\" value=\"Podaj liczbę zażytych tabletek\" class=\"btn btn-success\">";
		echo "</form>";
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
		echo'</div>';
	}
}

if (isset($_SESSION['responseType']) && isset($_SESSION['responseVal']))
{
	if ($_SESSION['responseType'] == 'costSum')
	{
		echo " <p> Cena zgromadzonych leków w apteczce wynosi: " . $_SESSION['responseVal'] . " zł. </p>";
	}
	else if ($_SESSION['responseType'] == 'costSumDiscard')
	{
		echo " <p> Cena wyrzuconych leków wynosi: " . $_SESSION['responseVal'] . " zł. </p>";
	}
	else if ($_SESSION['responseType'] == 'noPackages')
	{
		echo " <p> Liczba zakupionych opakowań w wybranym okresie czasu wynosi: " . $_SESSION['responseVal'] . ".</p>";
	}
	else if ($_SESSION['responseType'] == 'noTabTime')
	{
		echo " <p> Liczba zakupionych leków w wybranym okresie czasu wynosi: " . $_SESSION['responseVal'] . " sztuk tabletek.</p>";
	}
	else if ($_SESSION['responseType'] == 'drugsUsed')
	{
		echo " <p> Liczba zażytych leków w wybranym okresie czasu wynosi: " . $_SESSION['responseVal'] . " sztuk tabletek.</p>";
	}
	else if ($_SESSION['responseType'] == 'noTabDiscarded')
	{
		echo " <p> Liczba usuniętych leków w wybranym okresie czasu wynosi: " . $_SESSION['responseVal'] . " sztuk tabletek.</p>";
	}
		
}

?>
</div>

<div class="col-sm-2 sidenav" align="center">
<img src="../img/statistics.jpg" width="100%" height="100%" align="middle">
</div>

<?php require_once 'stopka.php'; ?>

































