<?php 

	session_start();

	require_once "../conf/conf.php";
	require_once "../lang/$lang";
	require_once '../html_tools/produceMedkitTable.php';

	if(!isset($_SESSION['zalogowany']))
		header("Location: ../index.php");
	
	require_once "nagl.php";
	require_once "menu.php";
	$_SESSION['site'] = 0;

?>

<!--  Obsługa zażywania leku -->
<script src = "../js/form_useDrug.js"></script>


<!-- Skrypt obsługujący formularz dodawania nowego leku -->
<script src = "../js/form_addDrug.js"></script>


<!-- Skrypt obsługujący formularz usuwania leku -->
<script src = "../js/form_removeDrug.js"></script>


<!-- Skrypt obsługujący formularz udostępnienia apteczki -->
<script src = "../js/form_shareMedKit.js"></script>
  
  
<!-- Obsługa DataTables z jquery -->
<script src = "../js/handleDataTables.js"></script> 
  

<!-- Validatory -->
<script src = "../js/validation.js"></script> 
  
  
<!-- Autouzupełnianie -->
<script src = "../js/autocomplete.js"></script>
  

<!-- Skrypt do polaczenia z uzyciem AJAXa -->
<script type="text/javascript" src="../db_tools/ajaxrequest.js"></script> 
<script type="text/javascript" src = "../js/function_callAjax.js"></script> 


<div class="jumbotron">
      <div class="container">
        <h1 class="display-3"></h1>
      </div>
</div>

<!-- Menu po lewej stronie -->
	
	<div class="container-fluid text-center">    
	  <div class="row content">
	    <div class="col-sm-2 sidenav">
		    <div class="btn-group-vertical">
		    <button type="button" id="use-drug"  class="btn btn-success btn-block">Zażyj lek</button>
		    <button type="button" id="remove-drug2"  class="btn btn-success btn-block">Usuń lek</button>
		    <button type="button" id="add-drug" class="btn btn-success btn-block">Dodaj nowy lek</button>
		    <button type="button" id="share-medkit" class="btn btn-success btn-block">Udostępnij apteczkę</button>
		    </div>
	    </div>

		<div class="col-sm-8 text-left"> 
	<?php 
	$_SESSION['referer'] = 'myMedKit';
	?>

	<?php 
		wyswietlWszystkieLekiUzytkownika($_SESSION['email']);	
	?>
	
	</div>
	</div>

	<!-- Okno formularza dodawania nowego leku -->
<?php require_once './forms/addDrug.php';?>

	<!-- Okno formularza zażywania nowego leku -->
<?php require_once './forms/takeDrug.php';?>

	<!-- Okno formularza usuwania leku -->
<?php require_once './forms/removeDrug.php'; ?>

	<!-- Okno formularza usuwania leku -->
<?php require_once './forms/shareMedKit.php'; ?>


<?php require_once 'stopka.php';?>
