	$(document).ready(function() {
	    var table = $('#example').DataTable();
	 
	    $('#example tbody').on( 'click', 'tr', function () {
	        $(this).toggleClass('selected');
	       // $('#button').disable = true;
	    } );

	    $('#button').click( function () {
	        alert( table.rows('.selected').data().length +' row(s) selected' );
	    } );
	} );