$('.private-link').click(function(){
	
	var ajax_data = {
		ajax: '1',
	};
	
	$.ajax({
		url: $(this).attr('href'),
		type: "POST",
		data: ajax_data,
		success: function(msg) {
			$("#modal_replace").html(msg);
			$('#modal-link').modal('toggle');
		}
	});
	
	return false;
});