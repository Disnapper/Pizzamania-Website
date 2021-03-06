/* Super Simple Fancy Checkbox Plugin @Dave Macaulay, 2013 http://davemacaulay.com/jquery-simple-checkbox-replacement-jquery-simplecheckbox-js/ */
(function( $ ) {
	$.fn.simpleCheckbox = function(options) {
		var defaults = {
			newElementClass: 'tog',
			activeElementClass: 'on'
          };
		var options = $.extend(defaults, options);
		this.each(function() {
			//Assign the current checkbox to obj
			var obj = $(this);
			//Create new element to be styled
			var newObj = $('<div/>', {
			    'id': '#' + obj.attr('id'),
			    'class': options.newElementClass,
			    'style': 'display: block;'
			}).insertAfter(this);
			//Make sure pre-checked boxes are rendered as checked
			if(obj.is(':checked')) {
				newObj.addClass(options.activeElementClass);
			}
			obj.hide(); //Hide original checkbox
			//Labels can be painful, let's fix that
			if($('[for=' + obj.attr('id') + ']').length) {

				var label = $('[for=' + obj.attr('id') + ']');
				label.click(function() {
					newObj.trigger('click'); //Force the label to fire our element
					return false;
				});
			}
			//Attach a click handler
			newObj.click(function() {
				//Assign current clicked object
				var obj = $(this);
				//Check the current state of the checkbox
				if(obj.hasClass(options.activeElementClass)) {
					obj.removeClass(options.activeElementClass);
					$(obj.attr('id')).attr('checked',false);
				} else {
					obj.addClass(options.activeElementClass);
					$(obj.attr('id')).attr('checked',true);
				}
				//Kill the click function
				return false; 
			});
		});
	};
})(jQuery);

/*!
 * Author: Yakir Sitbon.
 * Project Url: https://github.com/KingYes/jquery-radio-image-select
 * Author Website: http://www.yakirs.net/
 * Version: 1.0.1
 **/
(function($) {
	// Register jQuery plugin.
	$.fn.radioImageSelect = function( options ) {
		// Default var for options.
		var defaults = {
				// Img class.
				imgItemClass: 'radio-select-img-item',
				// Img Checked class.
				imgItemCheckedClass: 'item-checked',
				// Is need hide label connected?
				hideLabel: false
			},

			/**
			 * Method firing when need to update classes.
			 */
			syncClassChecked = function( img ) {
				var radioName = img.prev('input[type="radio"]').attr('name');

				$('input[name="' + radioName + '"]').each(function() {
					// Define img by radio name.
					var myImg = $(this).next('img');

					// Add / Remove Checked class.
					if ( $(this).prop('checked') ) {
						myImg.addClass(options.imgItemCheckedClass);
					} else {
						myImg.removeClass(options.imgItemCheckedClass);
					}
				});
			};

		// Parse args.. 
		options = $.extend( defaults, options );

		// Start jQuery loop on elements..
		return this.each(function() {
			$(this)
				// First all we are need to hide the radio input.
				.hide();
				// And add new img element by data-image source.
				//.after('<img src="' + $(this).data('image') + '" alt="radio image" />');

			// Define the new img element.
			var img = $(this).next('img');
			// Add item class.
			img.addClass(options.imgItemClass);

			// Check if need to hide label connected.
			if ( options.hideLabel ) {
				$('label[for=' + $(this).attr('id') + ']').hide();
			}

			// When we are created the img and radio get checked, we need add checked class.
			if ( $(this).prop('checked') ) {
				img.addClass(options.imgItemCheckedClass);
			}

			// Create click event on img element.
			img.on('click', function(e) {
				$(this)
					// Prev to current radio input.
					.prev('input[type="radio"]')
					// Set checked attr.
					.prop('checked', true)
					// Run change event for radio element.
					.trigger('change');

				// Firing the sync classes.
				syncClassChecked($(this));
			} );
		});
	}
}) (jQuery);

(function($){

	/**
	 * Hook into acf ready and append events
	 */
	acf.add_action('ready append', function( $el ){

		// search $el for fields of type 'true_false'
		acf.get_fields({ type : 'true_false'}, $el).each(function(){
			
			// run the simplecheckbox function on each found field 
			$(this).find('input[type="checkbox"]').simpleCheckbox(); 
		
		});

		// search $el for fields of type 'radio'
		acf.get_fields({ type : 'radio'}, $el).each(function(){
			var $this = $(this),
				$name = $this.data('name');

			// run the radioimageselect function on select fields
			if ( 'text_layout' == $name || 'vertical_alignment' == $name ) {
				$this.find('input[type="radio"]').radioImageSelect();
			}
		});

	});

})(jQuery);