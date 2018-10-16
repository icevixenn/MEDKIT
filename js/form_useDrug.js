// Obsługa zażywania leku

$( function() {

	// Save variables
	//   
	

	var dialog, 
      form = $("#formTakeDrugf"),
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
      
	  function ISODateString(d){
		    function pad(n){return n<10 ? '0'+n : n}
		    return d.getUTCFullYear()+'-'
		    + pad(d.getUTCMonth()+1)+'-'
		    + pad(d.getUTCDate())+'T'
		    + pad(d.getUTCHours())+':'
		    + pad(d.getUTCMinutes())+':'
		    + pad(d.getUTCSeconds())+'.00'
		}
	  
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
        
        console.log (dateAndTime);
        var d2 = new Date();
        var dateAndTime = ISODateString(d2);
        console.log (dateAndTime);

        $("#f1_drugName").addClass("ui-state-checked");
        $("#f1_dateUsed").addClass("ui-state-checked");
        
        var table = $('#example').DataTable();
		d = table.rows('.selected').data()[0][1];
		id = table.rows('.selected').data()[0][0];
		tabCurrent = table.rows('.selected').data()[0][5];
		tabMax = table.rows('.selected').data()[0][6];
		


        //Ustawienie wartosci pola nazwy leku
		f1_drugName.val(d);
		f1_drugName.attr("disabled", true);

		 $("#f1_id").val(id);
		 $("#f1_tabCurrent").val(tabCurrent);
		 $("#f1_tabMax").val(tabMax);
		 $( "#f1_dateUsed" ).val(dateAndTime); 

      });
  	}
	);


