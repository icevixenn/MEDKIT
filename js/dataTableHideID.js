	$(document).ready(function() {
	    var table = $('#example').DataTable();
	    
		 // ukrywa pierwszą wybraną kolumne (idpackage)
		var table = $('#example').DataTable();
		table.column( 0 ).visible( false );
	 
	    $('#example tbody').on( 'click', 'tr', function () {
	        $(this).toggleClass('selected');
	       // $('#delete').disable = true;
	    } );

	    $('#button').click( function () {
	        alert( table.rows('.selected').data().length +' row(s) selected' );
	    } );
	} );