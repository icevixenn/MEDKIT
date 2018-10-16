<?php 

	session_start();
	require_once '../conf/conf.php';
	require_once "../lang/$lang";
	require_once "../db_tools/connectToDB.php";
	
	if(!isset($_SESSION['zalogowany']))
	header("Location: ../index.php");
	
	require_once "nagl.php";
	require_once "menu.php";
?>


<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#example').DataTable();
	 
	    $('#example tbody').on( 'click', 'tr', function () {
	        $(this).toggleClass('selected');
	    } );
	 
	    $('#button').click( function () {
	        alert( table.rows('.selected').data().length +' row(s) selected' );
	    } );
	} );
</script>

<div class="jumbotron">
      <div class="container">
        <h1 class="display-3"></h1>
      </div>
</div>

<style media="screen" type="text/css">
	fieldset {
	  overflow: hidden
	}
	
	.frm {
	  float: left;
	  clear: none;
	}
	
	label {
	  float: left;
	  clear: both;
	  display: block;
	  padding: 2px 1em 0 0;
	}
	
	input[type=radio],
	input.radio {
	  float: left;
	  clear: none;
	  margin: 2px 0 0 2px;
	}
</style>


<div class="container-fluid text-center">    
	  <div class="row content">
	    <div class="col-sm-2 sidenav">
	    	<div class="container-fluid">
	    	<div class="panel panel-default">
	    	<div class="panel-heading">Wyszukaj lek:</div>
			<div class="panel-body">
	    	<form action="z_bazy.php" method="POST" role="form" >
						<fieldset class="frm">
						<label for="ean">EAN</label>
						<input id="ean" type="radio" name="selection" value="ean" >
						
						<label for="name">Nazwa leku </label>
						<input id = "name" type="radio" name="selection" value="nazwa" checked>
						
						<label for="subs">Substancja czynna </label>
						<input id = "subs" type="radio" name="selection" value="subst_czynna">
						
						
						
						
						</fieldset>
						
						<input type="text" name="ask" size="20" maxlength="50"><br>
					<input type="submit" value="Wyslij zapytanie" class="btn btn-success"/>
				</form>
				</div>
				</div>
	    	</div>
		    
	    </div>
	
	<div class="col-sm-8 text-center"> 
	
<?php 

	require_once '../html_tools/generateTable.php';

	if (isset($_POST['ask']))
	{

		$zapyt = $_POST['ask'];
		$selec = $_POST['selection'];
		//przygotowanie zapytania 
		$query = "SELECT * FROM `leki_specyfikacja` WHERE $selec LIKE '%$zapyt%'";
		//wykonanie zapytania i pobieranie wyników
		$baza = connectToDB();
		$wynik = $baza->query($query);
		
		$labels = array("idleki","Nazwa","Substancja czynna","EAN","Opakowanie zbiorcze");
		
		generateTable(
				
				$labels, 	// Etykiety
				$wynik 			  	// Dane
				);
	}
	
?>
</div>
</div>
</div>
<?php
		require_once 'stopka.php';
?>
	
