  	/*
	 *	Validate name
	 */

	function validateDrugName(field, label){
		

		label = document.getElementById(label);
		field = document.getElementById(field);
	    // setup some local variables
	    var form = $("#field");


		request = $.ajax({
	        url: "../html_tools/checkDrugName.php",
	        type: "post",
	        data: {
	        	drugName: field.value
	        }
	    });

		request.done(function (response, textStatus, jqXHR){
	        // Log a message to the console

	        
	        if (response==1){
	        	field.classList.remove("ui-state-error");
	        	field.classList.add("ui-state-checked");
	        	label.innerHTML ="&nbsp";
	        	//alert("response 1");
				return 1;
	        }
	        
	        else if (response==0) {
	        	field.classList.add("ui-state-error");
	        	field.classList.remove("ui-state-checked");
				label.innerHTML = "Nazwa nie występuje w bazie danych.";
				//alert("response 0");
				return 0;
	        } 
	    });

		
		
		
		
	}


  	/*
	 *	Validate price
	 */

	function validatePrice(field, label, mode){


		price = document.getElementById(field);
		price_val = price.value; 

		label = document.getElementById(label);
		

		if (/^\d+([.,]\d{1,2})?$/.test(price_val)){
			price.classList.remove("ui-state-error");
			price.classList.add("ui-state-checked");
			label.innerHTML = "&nbsp";
			return 0;
		} else {
			
			price.classList.remove("ui-state-checked");
			price.classList.add("ui-state-error"); 
			label.innerHTML = "Cena w formacie: [2], [2,2], [2,22], [2.22] itd.";
			return 1;

		}
	}


	/*
	 *	Validate number of tablets
	 */

	 function validateNoTablets(field, label, mode){
		 noTablets = document.getElementById(field);
		 noTablets_val = noTablets.value;
		 
		 noTablets_val = noTablets_val.replace(".",",");

		 
		 iCurrentTablets = new Number($("#f1_tabCurrent").val());
		 iMaxTablets = new Number($("#f1_tabMax").val());
		 


		 label = document.getElementById(label);
		 
		

		console.log("Validating no tablets...")

		 if (mode ==1 && noTablets_val > 0 ) {
			 noTablets.classList.remove("ui-state-error");
			 noTablets.classList.add("ui-state-checked");
			 
			 console.log("... mode 1 and no tablets > 0 --> OK.");
			 label.innerHTML ="&nbsp";
			 return 0;
		} 
		 
		 if (mode ==2 && noTablets_val > 0 && noTablets_val <= iCurrentTablets) {
			 noTablets.classList.remove("ui-state-error");
			 noTablets.classList.add("ui-state-checked");
			 
			 console.log("... mode 2 and no tablets between 0 and current --> OK.");
			 label.innerHTML ="&nbsp";
			 return 0;
		} 
		 
		 if (noTablets_val <= 0){
			noTablets.classList.add("ui-state-error");
			 noTablets.classList.remove("ui-state-checked");
			 label.innerHTML ="Liczba tabletek musi być większa od 0.";
			 console.log("... no tablets <= 0 --> ERROR.");
			 return 1;
		} 
		 
		
		 
		 if (noTablets_val==="") {
			 	noTablets.classList.remove("ui-state-checked");
			 	noTablets.classList.add("ui-state-error");
			 	label.innerHTML ="Pole nie może być puste.";
			 	console.log("... no tablets is empty --> ERROR.");
				return 1;
		 }
		 
		 if (mode == 2){
			 if (noTablets_val > iCurrentTablets){
					noTablets.classList.add("ui-state-error");
					 noTablets.classList.remove("ui-state-checked");
					 label.innerHTML ="Nie ma wystarczającej ilości tabletek w opakowaniu (pozostało "+iCurrentTablets+").";
					 console.log("... mode 2 and no tablets > current --> ERROR.");
				} 
		 }
		 
		 if (!isNumeric(noTablets_val)){
			 noTablets.classList.add("ui-state-error");
			 noTablets.classList.remove("ui-state-checked");
			 label.innerHTML ="Liczba tabletek musi być wartością całkowitą (1,2,3...)";
			 console.log("...  no tablets is not numeric --> ERROR.");
		 }
		 
	}
	 
	 /*
	  * Funkcja sprawdzająca czy n jest całkowite.
	  */
	 
	 function isNumeric(n) {
		   return !isNaN(parseFloat(n)) && isFinite(n);
		 }
  	
	/*
	 *	Validate expiry date
	 *
	 *	mode = 1 - dodawanie opakowania
	 *	mode = 2 - zażywanie leku
	 */

	 function validateDate(field, label, mode){
		 date = document.getElementById(field);
		 date_val = date.value;
		 date_ms = new Date(date_val);
		  
		 date_now = Date.now();

		 label = document.getElementById(label);

  		console.log("date value=" + date_val);
			
  		
  		if (date_val=="") {
		 	date.classList.remove("ui-state-checked");
		 	date.classList.remove("ui-state-warning");
		 	date.classList.add("ui-state-error");
		 	label.innerHTML ="Pole nie może być puste.";
		 
			return 1;
  		} else {
  			
  			date.classList.remove("ui-state-error");
			 	date.classList.remove("ui-state-warning");
			 	date.classList.add("ui-state-checked");
			 	label.innerHTML ="&nbsp";
			 	
			 	
  		}
  		
  		if (mode == 1){
  			
  	  		if (date_ms < date_now) {
  				// TODO przy dacie zażywania tez sie pojawia
  				date.classList.remove("ui-state-error");
  				date.classList.remove("ui-state-checked");
  				date.classList.add("ui-state-warning");	
  				label.innerHTML = "Dodawany lek jest przeterminowany.";
  				
  			}
  		}
  		return 0;
  		


	}

	function validateAll_addPackage(){
		
		t1 = 1;
		
		f = $("#drugName").hasClass("ui-state-checked");
		
		if (f) t1=0;
		
		
		
		t2 = validateNoTablets('noTablets_max', 'noTablets_max_Tips','1'); 
		t3 = validateDate('dateExpiry', 'dateExpiry_Tips');
		t4 = validatePrice('price', 'price_Tips');

		
		
		console.log("t1="+t1+" t2="+t2+" t3="+t3 + " t4="+t4);
		
		
		var sum = t1+t2+t3+t4;
		
		
		if (sum==0)
			return true;
		else {
			return false;
		}
	}
		
	function validateAll_takeDrug(){
			
			// TODO
		
			t1 = validateNoTablets('f1_noTabletsUsed', 'f1_noTabletsUsed_Tips','2');
			t2 = validateDate('f1_dateUsed', 'f1_dateUsed_Tips', 2);
			
			console.log("Validating entire form; noTablets="+t1+" date="+t2);
			
			var sum = t1+t2;
			
			
			if (sum==0)
				return true;
			else {
				return false;
			}
		
	}
