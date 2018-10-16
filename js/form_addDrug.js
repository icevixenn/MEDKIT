// Skrypt obsługujący formularz dodawania nowego leku

$( function() {

	// Save variables

	var dialog, 
      form = $("#formAddPackage"),
      drugName = $( "#drugName" ),
      noTablets_max = $( "#noTablets_max" ),
      dateExpiry = $( "#dateExpiry" ),
      price = $( "#price"),
      allFields = $( [] ).add( drugName ).add( noTablets_max ).add( dateExpiry ).add( price ),

   	  drugName_Tips = $( "#drugName_Tips" );
 	  noTablets_max_Tips = $( "#noTablets_max_Tips" );
 	  dateExpiry_Tips = $( "#dateExpiry_Tips" );
 	  price_Tips = $( "#price_Tips" );
 	  allFieldTips = $( [] ).add( drugName_Tips ).add( noTablets_max_Tips ).add( dateExpiry_Tips ).add( price_Tips )
 	  
      tips = $( ".validateTips" );

      
	  drugName_valid = false;
	  noTablets_max_valid = false;
	  dateExpiry_valid = false;
	  price_valid = false;
	  allValidCheckers = $( [] ).add( drugName_valid ).add( noTablets_max_valid ).add( dateExpiry_valid ).add( price_valid ),
      
    
    function updateTips( t ) {
      tips
        .text( t )
        .addClass( "ui-state-highlight" );
      setTimeout(function() {
        tips.removeClass( "ui-state-highlight", 1500 );
      }, 500 );
    }
 
    function checkLength( object, name, min, max ) {
      if ( object.val().length > max || object.val().length < min ) {
    	  object.addClass( "ui-state-error" );
        updateTips( "Length of " + n + " must be between " +
          min + " and " + name + "." );
        return false;
      } else {
        return true;
      }
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
 
    

	
 
    dialog = $( "#divAddPackage" ).dialog({
      autoOpen: false,
      height: 570,
      width: 400,
      modal: true,
      buttons: {
        "Dodaj lek": function(){

			v = validateAll_addPackage(); 

        	 console.log("VALIDATE: " + v);

			if (v){
				$('#formAddPackage').submit();
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
 

 
    $( "#add-drug" ).button().on( "click", function() {
      dialog.dialog( "open" );
    });





  } );