$(document).ready(function() {
	
	$('.confirm').click(function() {
		
		var answer = confirm( 'Etes-vous sûr ?' );		
        return answer; // answer is a boolean
    }); 
    
    
    
    $('.edit').click(function(){
    	
    	var ajax_data = {
    		ajax: '1',
    	};
    	
    	$.ajax({
    		url: $(this).attr('href'),
    		type: "POST",
    		data: ajax_data,
    		success: function(msg) {
    			//$("#modaledit .modal-header").after(msg);
    			$("#modal_replace").html(msg);
    			$('#modaledit').modal('toggle');
    		}
    	});
    	
    	return false;
    });
    
    

}); 