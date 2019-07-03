$(function(){
	$('[role=dialog]')
	    .on('show.bs.modal', function(e) {
		    $(this)
		        .find('[role=document]')
		            .removeClass()
		            .addClass('modal-dialog-centered ' + $(e.relatedTarget).data('ui-class'))
	})
})
    
   