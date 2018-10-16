

  
	$(document).ready(function() {
		// ukrywa pierwszą wybraną kolumne (idpackage)
		var table = $('#example').DataTable();
		table.column( 0 ).visible( false );
		
		var noRowsSelected=0;
		
	    var table = $('#example').DataTable();
	 
	    $('#example tbody').on( 'click', 'tr', function () {
	        $(this).toggleClass('selected');

			//Przelaczanie przycisku Zażyj lek

	        if (table.rows('.selected').data().length == 1) {
		        $("#use-drug").attr("disabled", false);
	        } else $("#use-drug").attr("disabled", true);

			// Przełączanie przycisku Usuń lek

	        if (table.rows('.selected').data().length == 1) {
	        	
	        	
	        	$("#remove-drug2").attr("disabled", false);
				if (table.rows('.selected').data().length > 1){
					$("#remove-drug2").html("Usuń leki");
				} else $("#remove-drug2").html("Usuń lek");
	        	
		        $("#remove-drug").attr("disabled", false);
				if (table.rows('.selected').data().length > 1){
					$("#remove-drug").html("Usuń leki");
				} else $("#remove-drug").html("Usuń lek");
		        
	        } else {
	        	$("#remove-drug").attr("disabled", true);
	        	$("#remove-drug2").attr("disabled", true);
	        }
			

	        
	    } );

	    $('#button').click( function () {
	        alert( table.rows('.selected').data().length +' row(s) selected' );
	    } );


	    $('#delete').click( function () {
	    	       	
	    		//document.getElementById("debug").innerHTML = "3";

				//Usun z bazy danych
				$row = table.rows('.selected').data();
				$id = $row[0][0];

				

				//document.getElementById("debug").innerHTML = ;

				//Usun z tabeli w warstie prezentacji    	
    			//table.row('.selected').remove().draw( false );
	    			//document.getElementById("delete").innerHTML = "2";
	    			var xhttp = new XMLHttpRequest();
    			  xhttp.onreadystatechange = function() {
    			    if (this.readyState == 4 && this.status == 200) {
    			     document.getElementById("delete").innerHTML = this.responseText;
    			    }
    			  };
    			  xhttp.open("GET", "../db_tools/removePackage.php?dateDiscarded="+"2017-05-30"+"&packID="+$id, true);
    			  xhttp.send();
	    	    	
	    	    } );

	    $('#use-drug').attr('disabled', true);
		$('#remove-drug').attr('disabled', true);
		$('#remove-drug2').attr('disabled', true);
	} );	

	
