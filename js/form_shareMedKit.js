// Obsługa dodawania udostępnienia

$( function() {


	
	var dialog, 
      form = $("#formshareMedKit"),
      emailB = $( "#emailB" ),
      lvl = $( "#lvl" ),

      allFields = $( [] ).add( emailB, lvl );
    
 
    dialog = $( "#divformshareMedKit" ).dialog({
      autoOpen: false,
      height: 550,
      width: 550,
      modal: true,
      buttons: {
          "Udostępnij apteczkę": function(){
  			$('#formshareMedKit').submit();
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


    $( "#share-medkit" ).button().on( "click", function() {
        dialog.dialog( "open" );


      });
  	}
	);