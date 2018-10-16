<script>
//Skrypt obsługujący formularz akceptacji zaproszenia dzielenia leku


$( function() {


	function checkPending(){
		request = $.ajax({
	        url: "../html_tools/checkPendingShares.php",
	        type: "post",
	        data: {
	        	mode: "accept"
	        }
	    });

		request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console

	return false;
	           
	        if (response==1){
	        	console.log("Hooray, it worked! " + response);
	        	return false;
	        }
	        
	        else if (response==0) {
	        	return false;
	        } 
	    });
	}
	

	var acceptTxt = "Akceptuj zaznaczone";
	var rejectTxt = "Odrzuć niezaznaczone";

	
	function generateButtonName(name,number){
		return name + " (" + number + ")";
	}

	function refreshButtons(){

		
		var noShares = table.rows().data().length;
    	var noSelected = table.rows('.selected').data().length;

    	buttonAccept = $('#dialog-accept');
    	buttonReject = $('#dialog-reject');

    	if (noSelected==0) buttonAccept.button("disable") 
    		else {
        		buttonAccept.button("enable")
        	}

    	if (noShares-noSelected==0) buttonReject.button("disable") 
		else {
    		buttonReject.button("enable")
    	}


    	var acceptName = generateButtonName(acceptTxt, noSelected);
    	var rejectName = generateButtonName(rejectTxt, noShares-noSelected);
        
        

        $('#dialog-accept').text(acceptName);
        $('#dialog-reject').text(rejectName);
       // $('.my-dialog .ui-button-text:contains(O)').text(rejectName);
	}
	
	var table = $('#example').DataTable({

		searching: false,
	    ordering:  false,
		paging: false,
		createdRow: function( row, data, dataIndex ) {

            // Add a class to the row
            $(row).addClass('selected');
            
        }
		
		
	});


    $('#example tbody').on( 'click', 'tr', function () {

    	$(this).toggleClass('selected');
    	$(this).toggleClass('unselected');
     

    	refreshButtons();
        
    } );


	
	var noShares = table.rows().data().length;
	var noSelected = table.rows('.selected').data().length;

	var acceptName = generateButtonName(acceptTxt, noSelected);
	var rejectName = generateButtonName(rejectTxt, noShares-noSelected);
	
	
	okno = $("#divBorrowMedkit").dialog({
		resizable: false,
		dialogClass: 'my-dialog',
		autoOpen: false,
		height: 400,
        width: 800,
        modal: true,
         my: "center",
         at: "center",
         of: window,


         
		
         buttons: [{
             text: acceptName,
             "id": "btnOk",
             click: function () {

				data = table.rows(".selected").data();

				ids = [];
				
				for (i=0; i<data.length; i++){
					ids.push(data[i][0]);
					
				};

				// Process ajax

				
				request = $.ajax({
			        url: "../html_tools/acceptShare.php",
			        type: "post",
			        data: {
			        	idlist: ids,
			        	mode: "accept"
			        }
			    });
		
				request.done(function (response, textStatus, jqXHR){
			        // Log a message to the console

			        $("#debug").html(response);
			           
			        if (response==1){
			        	$("#debug").html("działa");
			        }
			        
			        else if (response==0) {
			        	$("#debug").html("nie działa");
			        } 
			    });
				
				
				
				// 

				
				table.rows(".selected").remove().draw();
				
				refreshButtons();

            	if (table.rows().data().length==0) $(this).dialog('close');
                    	
             },

         }, {
             text: rejectName,
             click: function () {
                 //cancelCallback();

            	data = table.rows(".unselected").data();

 				ids = [];
 				
 				for (i=0; i<data.length; i++){
 					ids.push(data[i][0]);
 					
 				};

 				// Process ajax

 				
 				request = $.ajax({
 			        url: "../html_tools/acceptShare.php",
 			        type: "post",
 			        data: {
 			        	idlist: ids,
 			        	mode: "reject"
 			        }
 			    });
 		
 				request.done(function (response, textStatus, jqXHR){
 			        // Log a message to the console
 			        console.log("Hooray, it worked!");

 			        $("#debug").html(response);
 			           
 			        if (response==1){
 			        	$("#debug").html("działa");
 			        }
 			        
 			        else if (response==0) {
 			        	$("#debug").html("nie działa");
 			        } 
 			    });
 				
 				
 				
 				// 

 				
 				table.rows(".unselected").remove().draw();	
 				
 				refreshButtons();
 				if (table.rows().data().length==0) $(this).dialog('close');

                 
             },
         }],
         
         close: function () {
             //do something
         }

		
		
	})

	$('.ui-dialog-buttonpane button:contains(Akceptuj)').attr("id", "dialog-accept");
	$('.ui-dialog-buttonpane button:contains(Odrzuć)').attr("id", "dialog-reject").button("disable");
	
	
	
});

</script>



<?php 

	require_once '../html_tools/generateTable.php';
	require_once '../db_tools/queryDB.php';

	function wyswietlPozyczanieApteczek($email)
	{
		// TODO ZMIEN JAKOŚ JOINY ŻEBY DODAĆ BORROWER DO IDKONTA TEŻ
		$query = "SELECT
				u1.idkonta,
                u1.email AS 'lender', 
                shares.lvl,
                CASE
					WHEN shares.lvl = 1 THEN 'widzi'
                    WHEN shares.lvl = 2 THEN 'może używać'
                    WHEN shares.lvl = 3 THEN 'może używać i usuwać'
                    WHEN shares.lvl = -1 THEN 'czeka na potwierdzenie: widzi'
                    WHEN shares.lvl = -2 THEN 'czeka na potwierdzenie: może używać'
                    WHEN shares.lvl = -3 THEN 'czeka na potwierdzenie: może używać i usuwać'
				END as 'Poziom udostępniania'
			FROM
			    shares
			        JOIN
				users u1 ON shares.lender = u1.idkonta
					JOIN
				users u2 ON shares.borrower = u2.idkonta
			WHERE
			     u2.email LIKE '".$email."%' AND lvl<0
			";
		
		$array = array("idl", "email wypożyczającego", "Poziom udostępnienia", "Opis udostępnienia");
		
		generateTable(
				//TODO
				$array, 	// Etykiety
				queryDB($query) 			  	// Dane
				);
		
	}

?>

	<!-- Okno formularza dodawania nowego leku -->
  
  
  
<div id="divBorrowMedkit" title="Posiadasz nowe zaproszenia do dzielenia apteczek.">


	<?php wyswietlPozyczanieApteczek($_SESSION['email']);?>
	<div id="debug">Tekst</div>
</div>