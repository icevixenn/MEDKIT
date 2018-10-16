// Autouzupełnianie

$( function() {
	

	    function log( message ) {
	        $( "<div>" ).text( message ).prependTo( "#log" );
	        $( "#log" ).scrollTop( 0 );
	      }
	    
	    $( "#drugName" ).autocomplete({
	        source: "autocomplete.php",
	        minLength: 3,
	        select: function (e, ui){
	        	
	        	
	        	label = document.getElementById("drugName_Tips");
	    		field = document.getElementById("drugName");
	    	    // setup some local variables
	    	    var form = $("#field");

	    	    
	    		request = $.ajax({
	    	        url: "../html_tools/checkDrugName.php",
	    	        type: "post",
	    	        data: {
	    	        	drugName: ui.item.value
	    	        }
	    	    });

	    		request.done(function (response, textStatus, jqXHR){
	    	        // Log a message to the console

	    			console.log(response);
	    			
	    	        if (response==1){
	    	        	field.classList.remove("ui-state-error");
	    	        	field.classList.add("ui-state-checked");
	    	        	label.innerHTML ="&nbsp";
	    				return 1;
	    	        }
	    	        
	    	        else if (response==0) {
	    	        	field.classList.add("ui-state-error");
	    	        	field.classList.remove("ui-state-checked");
	    	        	
	    				label.innerHTML = "Nazwa nie występuje w bazie danych.";
	    				return 0;
	    	        } 
	    	    });

	    		
	    		
	        }
 
      	});

	});