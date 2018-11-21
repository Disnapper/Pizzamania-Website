jQuery(document).ready(function($) {
	//Variable sortnonce is declared globally
	var postList = $('#post-list');
	var max_levels = 6;
	if ( reorder_posts.hierarchical == 'false' ) {
		max_levels = 1;
	}
	postList.nestedSortable( {
		forcePlaceholderSize: true,
		handle: 'div',
		helper:	'clone',
		items: 'li',
		maxLevels: max_levels,
		opacity: .6,
		placeholder: 'placeholder',
		revert: 250,
		tabSize: 25,
		tolerance: 'pointer',
		toleranceElement: '> div',
		listType: 'ul',
		update: function( event, ui ) {
			var order = $('ul#post-list').nestedSortable( 'toHierarchy',{ listType: 'ul'});
			var type  = ($('ul#post-list').hasClass('custom_page')) ? true : false;

			order = JSON.stringify( order , null, 2);
            //console.log( order );
            //return;

            $.ajax({
                type:       'POST',
                url:        ajaxurl,
                data:       {
                    'action':    'post_sort_new',
                    'postorder': order,
                    'nonce':     reorder_posts.sortnonce,
                    'typeorder': type,
                    'cache':     false
                },
                beforeSend: function () {
                    console.log('sending');
                },
                success:    function (data, textStatus, XMLHttpRequest) {

                    console.log(data);
                    console.log(textStatus);
                    console.log(XMLHttpRequest);

                },
                error:      function (MLHttpRequest, textStatus, errorThrown) {
                    console.log(errorThrown);
                    console.log(MLHttpRequest);
                },
                complete:   function (XMLHttpRequest, textStatus) {
                    console.log(textStatus);
                },
                dataType:   'json'
            });

		}
	});
	$( "#post-list a" ).toggle( function() {
		$( this ).html( reorder_posts.collapse );
		$( this ).parent().next( '.children' ).slideDown( "slow" );
		return false;
	}, function() {
		$( this ).html( reorder_posts.expand );
		$( this ).parent().next( '.children' ).slideUp( "slow" );
		return false;
	} );
});