(function($) {
	$(function() {
		var $radio = $('#acf-section_type .acf-radio-list input[type="radio"]'),
			$label = $('#acf-section_type .acf-radio-list label');

	    $radio.addClass('js');
	    $label.addClass('js');

	    $radio.each(function(){
	    	var $this = $(this);

	    	if ($this.attr('checked') == 'checked') {
	    		$this.closest('label').addClass('active');
	    	}
	    });
	    
	    $label.on('click', function() {
	        $label.removeClass('active');
	        $(this).addClass('active');
	    });

	});
})(jQuery);