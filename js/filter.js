// Filter portfolio by type
//
// This script is a part of Blur Studio template
// Author Emil Nikov - enstyled

$('#portfolio_filter a').click(function() {
	
	if(!($(this).parent().hasClass('active'))) {
		
		$(this).parents('ul').find('.active').removeClass('active');
		$(this).parent().addClass('active');
	
		var i;
		var type = $(this).attr('class');
		
		if(type == 'all') {
			$('#portfolio .project_small').fadeIn();
			
			i = 0;
			
			$('#portfolio .project_small').each(function() {
			
				$(this).removeClass('middle');
				
				if((typeof(i) == 'undefined') || i == 3) {
					i = 0;
				} else {
					if(i == 1) { $(this).addClass('middle'); }
				}	
				i++;
				
			});
			
		} else {
			$('#portfolio .project_small').each(function() {
				
				$(this).hide();
				
				if(($(this).hasClass(type))) {
				
					$(this).fadeIn();
					$(this).removeClass('middle');
								
					if((typeof(i) == 'undefined') || i == 3) {
						i = 0;
					} else {
						if(i == 1) { $(this).addClass('middle'); }
					}	
					i++;
					
				} else {
					$(this).hide();
				}
			});
		}
	}
	
	return false;
});