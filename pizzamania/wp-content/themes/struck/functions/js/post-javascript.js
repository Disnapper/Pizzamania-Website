jQuery(document).ready(function($){

	/**
	 * Score Sliders
	 */
	$.fn.createScoreSlider = function () {
		$(this).addClass('sliderloaded');
		$(this).each(function(){
	        var $this       = $(this),
	            scoreWrap   = $this.closest(".scorewrapper"),
	            score       = scoreWrap.find(".score"),
	            scoreSlider = scoreWrap.find(".scoreslider"),
	            scoreVal    = (score.val()) ? score.val() : '0';
		        
		        $this.slider({
		            value: scoreVal,
		            min: 0,
		            max: 10,
		            step: 0.5,
		            create: function( event, ui ) {
		                console.log('created');
		            },
		            slide: function( event, ui ) {
		                score.val(ui.value );
		            }
		        });

	        score.val(scoreSlider.slider( "value" ) );

	    });
	}

	$('.scoreslider').not('.scoreslider.sliderloaded').createScoreSlider();

	jQuery('.repeatable-add').click(function() {  
		field = jQuery(this).closest('td').find('.custom_repeatable li:last').clone(true, true);  
		fieldLocation = jQuery(this).closest('td').find('.custom_repeatable li:last');  
		jQuery('input, textarea', field).val('').attr('name', function(index, name) {  
			return name.replace(/(\d+)/, function(fullMatch, n) {  
				return Number(n) + 1;  
			});  
		});
		newSliderID = jQuery('.scoreslider').attr('id');
		console.log(newSliderID);

		jQuery('.scoreslider', field).remove();
		jQuery('.score', field).after('<div id="' + newSliderID + '" class="scoreslider"></div>'); 

		jQuery('.scoreslider, .score, input', field).val('').attr('id', function(index, id) {
			return id.replace(/(\d+)/, function(fullMatch, n) {  
				return Number(n) + 1;  
			});  
		}); 

		// Create slider for field content
		$('.scoreslider', field).createScoreSlider();
		field.insertAfter(fieldLocation, jQuery(this).closest('td'));
		return false;  
	}); 
	jQuery('.repeatable-remove').click(function(){
		var r = confirm("Are you sure?");
		if (r == true) {
		  	jQuery(this).closest('li').find('option[value="Select a Section:"]').val('selected');
			jQuery(this).parent().remove();
		}
		return false;
	});

	/*-----------------------------------------------------------------------------------*/
/* Accordion
/*-----------------------------------------------------------------------------------*/
if (jQuery.isFunction(jQuery.fn.sortable)) {
	jQuery('.custom_repeatable').sortable({
		opacity: 0.6,
		revert: true,
		cursor: 'move',
		handle: '.sort',
		update:function(event,ui){
			console.log('updated');	
		}
	});
}

/*Radio Show */
	
	jQuery('.radioshow input').click(function() {
		hidden = jQuery(this).closest('.radioshow').attr('data-url');
		
		console.log(hidden);
		if (jQuery(this).attr('value') == 'Yes') {
			jQuery(hidden).fadeIn(400);
		} else {
			jQuery(hidden).fadeOut(400);
		}
  		
	});
	
	jQuery('.radioshow input:checked').each(function() {
		if (jQuery(this).attr('value') == 'Yes') {
			hidden = jQuery(this).closest('.radioshow').attr('data-url');
			jQuery(hidden).show();
		}
	});
	
/* Upload Button */

	jQuery('.custom_upload_image_button').click(function() {
		formfield = jQuery(this).siblings('.custom_upload_image');
		preview = jQuery(this).siblings('.custom_preview_image');
		tb_show('', 'media-upload.php?type=image&TB_iframe=true');
		//Change "insert into post" to "Use this Button"
		tbframe_interval = setInterval(function() {jQuery('#TB_iframeContent').contents().find('.savesend .button').val('Use This Image');}, 2000);
		
		window.send_to_editor = function(html) {
			var o = jQuery(html);
			if (o.is('a')){
			o = o.find('img');
			}
			imgurl = o.attr('src');
			classes = o.attr('class');
			id = classes.replace(/(.*?)wp-image-/, '');
			formfield.val(id);
			preview.attr('src', imgurl);
			tb_remove();
		}
		return false;
	});
	jQuery('.custom_clear_image_button').click(function() {
		var defaultImage = jQuery(this).parent().siblings('.custom_default_image').text();
		jQuery(this).parent().siblings('.custom_upload_image').val('');
		jQuery(this).parent().siblings('.custom_preview_image').attr('src', defaultImage);
		return false;
	});
	
	
/* Help Button */	
	jQuery('a.helpbutton').click(function(e) {
		e.preventDefault();
		sectionButton = jQuery(this).attr('rel');
		console.log(jQuery(sectionButton + ' a'));
		if (!(jQuery('#contextual-help-wrap').is(':visible'))) {
			jQuery('#contextual-help-link').click();
		} else {
			window.scrollTo(0,0);	
		}
		
		jQuery(sectionButton + ' a').click();
	});
});