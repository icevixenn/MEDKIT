<?php 
	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: ../index.php');
		exit();
	}
	require_once '../html_tools/produceSharedMedkits.php';
	require_once '../conf/conf.php';
	require_once "../lang/$lang";
	require_once "nagl.php";
	require_once "menu.php";
	$_SESSION['site'] = 1;
?>

<!-- Validatory -->
<script src = "../js/validation.js"></script> 
  
<!-- Skrypt obsługujący formularz usuwania leku -->
<script src = "../js/form_removeDrug.js"></script>
  
<!-- Autouzupełnianie -->
<script src = "../js/autocomplete.js"></script>

<!-- Obsługa DataTables z jquery -->
<script>

$(document).ready(function() {
	
	
	var table = $('#example').DataTable();
	// ukrywa pierwszą wybraną kolumne (idpackage)
	table.column( 0 ).visible( false );
	table.column( 2 ).visible( false );
	table.column( 3 ).visible( false );
	 
    $('#example tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');

		/*
		 * Przelaczanie przycisków menu
		 	1) Zażywanie leku: włącz gdy wybrany jest jeden rząd i poziom powyżej 1
		 	2) Usuwanie leku: włącz gdy wybrany jest ponad jeden rząd i poziom równy 3
		 */
		
		var shareLevel=0;
		var selectedData = table.rows('.selected').data();
		var noSelectedRows = selectedData.length;
		if (noSelectedRows>0) shareLevel = table.rows('.selected').data()[0][2];
		
        if ( noSelectedRows == 1 && shareLevel > 1) {
	        $("#use-drug").attr("disabled", false);
        } else $("#use-drug").attr("disabled", true);

		// Przełączanie przycisku Usuń lek
		
		var allowMultipleDelete = true; // OBSŁUGA KASOWANIA WIELU POZYCJI NA RAZ


		var minLevelInSelection = 3;

		for (i=0;i<noSelectedRows;i++){
			if (selectedData[i][2] < minLevelInSelection) {
    			minLevelInSelection = selectedData[i][2];
    		}
		}
		
        if (noSelectedRows > 0 && minLevelInSelection==3) {
	        $("#remove-drug").attr("disabled", false);
			if (table.rows('.selected').data().length > 1){
				$("#remove-drug").html("Usuń leki");
			} else $("#remove-drug").html("Usuń lek");
	        
        } else $("#remove-drug").attr("disabled", true);
		
    } );
   

	var dialog, 
    form,
    f1_drugName = $( "#f1_drugName" ),
    f1_noTabletsUsed = $( "#f1_noTabletsUsed" ),
    f1_dateUsed = $( "#f1_dateUsed" );

    allFields = $( [] ).add( f1_drugName ).add( f1_noTabletsUsed ).add( f1_dateUsed );

 	  f1_drugName_Tips = $( "#f1_drugName_Tips" );
 	  f1_noTabletsUsed_Tips = $( "#f1_noTabletsUsed_Tips" );
    f1_dateUsed_Tips = $( "#f1_dateUsed_Tips" );

    tips = $( ".validateTips" );

    noTabletsUsed_valid = false;
	  dateUsed_valid = false;

	  allValidCheckers = $( [] ).add( noTabletsUsed_valid ).add( dateUsed_valid );
    
  
  function updateTips( t ) {
    tips
      .text( t )
      .addClass( "ui-state-highlight" );
    setTimeout(function() {
      tips.removeClass( "ui-state-highlight", 1500 );
    }, 500 );
  }

  function checkRegexp( o, regexp, n ) {
    if ( !( regexp.test( o.val() ) ) ) {
      o.addClass( "ui-state-error" );
      updateTips( n );
      return false;
    } else {
      return true;
    }
  }

  dialog = $( "#formTakeDrug" ).dialog({
    autoOpen: false,
    height: 500,
    width: 350,
    modal: true,
    buttons: {
        "Zarejestruj": function(){

			v = validateAll_takeDrug(); 

        	 console.log("VALIDATE: " + v);

			if (v){
				$('#formTakeDrugf').submit();
				}
        	 
            
            }
        ,
        "Cofnij": function() {
          dialog.dialog( "close" );
        }
      }	,

    close: function() {
      form[ 0 ].reset();
      allFields.removeClass( "ui-state-error" );
      allFields.removeClass( "ui-state-warning" );
      allFields.removeClass( "ui-state-checked" );
    }
  });
  
  $( "#use-drug" ).button().on( "click", function() {
      dialog.dialog( "open" );

      var table = $('#example').DataTable();
		d = table.rows('.selected').data()[0][5];
		id = table.rows('.selected').data()[0][3];
		tabCurrent = table.rows('.selected').data()[0][8];
		tabMax = table.rows('.selected').data()[0][9];

      //Ustawienie wartosci pola nazwy leku
		f1_drugName.val(d);
		f1_drugName.attr("disabled", true);

		 $("#f1_id").val(id);
		 $("#f1_tabCurrent").val(tabCurrent);
		 $("#f1_tabMax").val(tabMax);

		//TODO: Ustawienie domyslnej daty uzycia leku
			
		var d = new Date();
		var date = new Date().toLocaleDateString();
		var time = new Date().toLocaleTimeString();
		f1_dateUsed.val(d.toLocaleString());	

    });

    $('#use-drug').attr('disabled', true);
	$('#remove-drug').attr('disabled', true);
} );	

</script> 

<div class="jumbotron">
      <div class="container">
        <h1 class="display-3"></h1>
      </div>
</div>

	<div class="container-fluid text-center">    
	  <div class="row content">
	    <div class="col-sm-2 sidenav">
		    <div class="btn-group-vertical">
		    <button type="button" id="use-drug" class="btn btn-success btn-block">Zażyj lek</button>
			<button type="button" id="remove-drug" class="btn btn-success btn-block">Usuń lek &nbsp; </button>
		    </div>
	    </div>
	

<div class="col-sm-8 text-center"> 				

<?php 
	$_SESSION['referer'] = 'sharedMedKits';
?>

<?php 
	wyswietUdostepnioneLekiUzytkownika($_SESSION['email']);	
	?>

</div>
</div>


	<!-- Okno formularza zażywania nowego leku -->
<?php require_once './forms/takeDrug.php';?>

	<!-- Okno formularza usuwania leku -->
<?php require_once './forms/removeDrug.php'; ?>

<?php require_once 'stopka.php';?>


