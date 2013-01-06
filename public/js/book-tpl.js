$(document).ready(function() {
	
	
function adjust() {
	
	// on ajuste la taille du viewport
	$('html').css({"height":$(window).height()});
	
	// on ajuste la hauteur des commentaires à celle de la topbar
	topbar_height = $('#topbar').height();
	$('.carousel').css({"margin-top":topbar_height});
	
	// on ajuste la taille des photos en fonction de la taille de la fenêtre
	$('.carousel_pic').css({"height":$(window).height() - topbar_height});	
}
	

$('.book-social-comment').tooltip()
$('.book-social-share').tooltip()
//$('.book-social-fav').tooltip()

/* ancienne fonction popup du partage
 $('.book-social-share').click(function(){
	
	pic_id = $(this).attr('data-pic_id');
	
	$('#share-modal-'+pic_id).modal('show');
	
	return false; 
	
});*/


/*$('.book-social-fav').click(function(){
	
	if($(this).attr('data-logged_in') == 'false') {	
		// l'utilisateur n'est pas connecté		
		$('#connect-modal').modal('show'); 
		
	} else {
		// l'utilisateur est connecté
		
		var ajax_data = {
			ajax: '1',
			book_id: $(this).attr('data-book_id'),
		}
	          
		$.ajax({ 
			url: $(this).attr('data-action'),
			type: "POST",
			cache: false,
			data: ajax_data, 	
			success: function(msg) {			
				
				alert(msg); 
				
				$('.book-social').append(this);
				
				if($('.book-social-fav').children().hasClass('icon-white')) {
					$('.book-social-fav').children().removeClass('icon-white');
					$('.book-social-fav').children().addClass('icon-color');
				} 
			}
		});
		
		return false;		
		
	}
	
});*/

 

$('.book-social-comment').click(function(){
	
	pic_id = $(this).attr('data-pic_id');

	$('#black-panel'+pic_id).toggle();

	return false;
});


$('.comment-form').live("submit", function(){

	pic_id = $(this).attr('data-pic_id');	
	
	var ajax_data = {
		ajax: '1',
		comment: $('#comment-input'+pic_id).val(),
	}
	
    $('.ajaxLoader').show();	
          
	$.ajax({
		url: $(this).attr('action'),
		type: "POST",
		cache: false,
		data: ajax_data, 	
		success: function(msg) {			

     		$('.ajaxLoader').hide();
			$('#commentaires'+pic_id).html(msg);	
			
		}
	});
	
	return false;
});

$(window).resize(function(e){
	adjust();
});

adjust();

}); 