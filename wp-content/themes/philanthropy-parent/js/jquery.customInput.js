/**
 * --------------------------------------------------------------------
 * jQuery customInput plugin
 * Author: Maggie Costello Wachs maggie@filamentgroup.com, Scott Jehl, scott@filamentgroup.com
 * Copyright (c) 2009 Filament Group 
 * licensed under MIT (filamentgroup.com/examples/mit-license.txt)
 * --------------------------------------------------------------------
 */
jQuery.fn.customInput = function(){
	return jQuery(this).each(function(){	
		if(jQuery(this).is('[type=checkbox],[type=radio]')){
			var input = jQuery(this);
			
			// get the associated label using the input's id
			var label = jQuery('label[for='+input.attr('id')+']');
			
			// wrap the input + label in a div 
			input.add(label).wrapAll('<div class="custom-'+ input.attr('type') +'"></div>');
			
			// necessary for browsers that don't support the :hover pseudo class on labels
			label.hover(
				function(){ jQuery(this).addClass('hover'); },
				function(){ jQuery(this).removeClass('hover'); }
			);
			
			//bind custom event, trigger it, bind click,focus,blur events					
			input.bind('updateState', function(){	
				input.is(':checked') ? label.addClass('checked') : label.removeClass('checked checkedHover checkedFocus'); 
			})
			.trigger('updateState')
			.click(function(){ 
				jQuery('input[name='+ jQuery(this).attr('name') +']').trigger('updateState'); 
			})
			.focus(function(){ 
				label.addClass('focus'); 
				if(input.is(':checked')){  jQuery(this).addClass('checkedFocus'); } 
			})
			.blur(function(){ label.removeClass('focus checkedFocus'); });
		}
	});
};


	
	
