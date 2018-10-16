// Obsługa usuwania leku

$( function() {

	// Save variables
	//   
	
	
	var dialog, 
	form = $("#formRemoveDrug"),
      f2_drugName = $( "#f2_drugName" ),

      allFields = $( [] ).add( f2_drugName );

   	  f2_drugName_Tips = $( "#f2_drugName_Tips" );

      tips = $( ".validateTips" );    
    
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
 
    dialog = $( "#divRemoveDrug" ).dialog({
      autoOpen: false,
      height: "auto",
      width: "auto",
      modal: true,
      buttons: {
          "Usuń": function(){
  			$('#formRemoveDrug').submit();
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
    
    // Przycisk "remove" na stronie sharedmedkits


    $( "#remove-drug" ).button().on( "click", function() {
        dialog.dialog( "open" );

        var table = $('#example').DataTable();
		
		var id = []; // id opakowania
		
		var drugNames = [];
		
		rows = table.rows('.selected').data();
		
		for (i=0;i<rows.length;i++){
			drugNames.push(rows[i][5]);
			id.push(rows[i][3]);
		}
		
		//$("#textArea").val(drugNames);
		
		for (i=0;i<rows.length;i++){
			$("#textArea").append(rows[i][5]).append(" (pozostało " + rows[i][8] + " tabletek)").append("\n");
		}
		
		if (rows.length>1) $("#labelRemoveDrug").html("Nazwy leków");
		
		 $("#f2_id").val(id);

      });
    
    
    // Przycisk "remove" na stronie mymedkit
    
    $( "#remove-drug2" ).button().on( "click", function() {
        dialog.dialog( "open" );

        var table = $('#example').DataTable();
		
		var id = []; // id opakowania
		
		var drugNames = [];
		
		rows = table.rows('.selected').data();
		
		for (i=0;i<rows.length;i++){
			drugNames.push(rows[i][1]);
			id.push(rows[i][0]);
		}
		
		//$("#textArea").val(drugNames);
		
		for (i=0;i<rows.length;i++){
			$("#textArea").append(rows[i][1]).append(" (pozostało " + rows[i][5] + " tabletek)").append("\n");
		}
		
		if (rows.length>1) $("#labelRemoveDrug").html("Nazwy leków");
		
		 $("#f2_id").val(id);

      });
    
    
  	}
	);