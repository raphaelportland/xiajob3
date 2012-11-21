$(document).ready(function() {

	$('#add_recomp').click(function() {
	
	
        var num     = $('.clonedRecomp').length; // how many "duplicatable" input fields we currently have
        var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
        var newElem = $('#recompense' + num).clone().attr('id', 'recompense' + newNum);
              
                // insert the new element after the last "duplicatable" input field
        $('#recompense' + num).after(newElem);	
        
        // on donne les nouveaux id et names
        $('#recompense'+newNum+' select:first').attr('id', 'recomp' + newNum).attr('name', 'recomp' + newNum);
        $('#recompense'+newNum+' input:first').attr('id', 'autre_recomp' + newNum).attr('name', 'autre_recomp' + newNum);
        $('#recompense'+newNum+' input:eq(1)').attr('id', 'year_recomp' + newNum).attr('name', 'year_recomp' + newNum);
        
                // enable the "remove" button
        $('#btnDelRecomp').removeAttr('disabled','');
		
	});

            $('#btnDelRecomp').click(function() {
                var num = $('.clonedRecomp').length; // how many "duplicatable" input fields we currently have
                $('#recompense' + num).remove();     // remove the last element
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDelRecomp').attr('disabled','disabled');
            });

			$('#btnDelRecomp').attr('disabled','disabled');




	$('#add_formation').click(function() {
	
	
        var num     = $('.clonedFormation').length; // how many "duplicatable" input fields we currently have
        var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
        var newElem = $('#formation' + num).clone().attr('id', 'formation' + newNum);
              
                // insert the new element after the last "duplicatable" input field
        $('#formation' + num).after(newElem);	
        
        // on donne les nouveaux id et names
        $('#formation'+newNum+' input:first').attr('id', 'year_diplome' + newNum).attr('name', 'year_diplome' + newNum);        	
        $('#formation'+newNum+' select:first').attr('id', 'formation' + newNum).attr('name', 'formation' + newNum);
        $('#formation'+newNum+' select:eq(1)').attr('id', 'diplome' + newNum).attr('name', 'diplome' + newNum);
		$('#formation'+newNum+' input:eq(1)').attr('id', 'custom_formation' + newNum).attr('name', 'custom_formation' + newNum);        
        $('#formation'+newNum+' input:eq(2)').attr('id', 'custom_diplome' + newNum).attr('name', 'custom_diplome' + newNum);
        
                // enable the "remove" button
        $('#btnDelFormation').removeAttr('disabled','');
		
	});


            $('#btnDelFormation').click(function() {
                var num = $('.clonedFormation').length; // how many "duplicatable" input fields we currently have
                $('#formation' + num).remove();     // remove the last element
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDelFormation').attr('disabled','disabled');
            });

			$('#btnDelFormation').attr('disabled','disabled');
			
			
			
			

	$('#add_expe').click(function() {
	
	
        var num     = $('.clonedXp').length; // how many "duplicatable" input fields we currently have
        var newNum  = new Number(num + 1);      // the numeric ID of the new input field being added
 
                // create the new element via clone(), and manipulate it's ID using newNum value
        var newElem = $('#experience' + num).clone().attr('id', 'experience' + newNum);
 
                // insert the new element after the last "duplicatable" input field
        $('#experience' + num).after(newElem);		
        
        // on donne les nouveaux id et names
        $('#experience'+newNum+' input:first').attr('id', 'custom_lieu' + newNum).attr('name', 'custom_lieu' + newNum);        	
        $('#experience'+newNum+' select:first').attr('id', 'poste' + newNum).attr('name', 'poste' + newNum);
        $('#experience'+newNum+' select:eq(1)').attr('id', 'type' + newNum).attr('name', 'type' + newNum);
        $('#experience'+newNum+' select:eq(2)').attr('id', 'month_start' + newNum).attr('name', 'month_start' + newNum);        	
        $('#experience'+newNum+' input:eq(1)').attr('id', 'year_start' + newNum).attr('name', 'year_start' + newNum);
        $('#experience'+newNum+' select:eq(3)').attr('id', 'month_end' + newNum).attr('name', 'month_end' + newNum);
        $('#experience'+newNum+' input:eq(2)').attr('id', 'year_end' + newNum).attr('name', 'year_end' + newNum);        	

        
        
        
        
        
                // enable the "remove" button
        $('#btnDelXp').removeAttr('disabled','');
		
	});

            $('#btnDelXp').click(function() {
                var num = $('.clonedXp').length; // how many "duplicatable" input fields we currently have
                $('#experience' + num).remove();     // remove the last element
 
                // if only one element remains, disable the "remove" button
                if (num-1 == 1)
                    $('#btnDelXp').attr('disabled','disabled');
            });

			$('#btnDelXp').attr('disabled','disabled');
    

}); 