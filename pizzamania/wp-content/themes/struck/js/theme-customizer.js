/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and 
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	var i = 0;

	/**
	 * Create a new stylesheet for Pseudo Styles
	 * @return {html} New stylesheet added for customization previews
	 */
	var sheet = (function() {
		// Create the <style> tag
		var style = document.createElement("style");

		// WebKit hack :(
		style.appendChild(document.createTextNode(""));

		// Add the <style> element to the page
		document.head.appendChild(style);

		return style.sheet;
	})();

	/**
	 * Adds a css rule to the stylesheet for customization previews
	 * @param {html} 	sheet      	Stylesheet
	 * @param {string} 	selector 	CSS Selector to add
	 * @param {string} 	rules    	CSS Rules to add
	 */
	function addCSSRule(sheet, selector, rules) {
		if(sheet.insertRule) {
			sheet.insertRule(selector + " {" + rules + "}", i);
		} else {
			sheet.addRule(selector, rules, i);
		}
		i++;
	}

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			if ( ! $('#logo a img').length ) {
				$( '#logo a' ).html( newval );
			}
		} );
	} );
	
	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );

	//Update site background color...
	wp.customize( 'tw_background_color', function( value ) {
		value.bind( function( newval ) {
			/**
			 * Site Background
			 * @type {string}
			 */
			siteBackground =  
				'#sitecontainer, \
		        .rightside, \
		        .sidebar, \
		        .pagination .pagenumbers';
		    $(siteBackground).css('background', newval );
		} );
	} );

	//Update site highlight color...
	wp.customize( 'highlight_color', function( value ) {
		value.bind( function( newval ) {

			/**
			 * Backgrounds
			 * @type {string}
			 */
			backgrounds = 
				'.badge a, .widget .tagcloud a \
		        .badgesliver.highlight, .sharing a .sharecircle, \
		        .tabswrap ul.tabs li a.active, .tabswrap ul.tabs li a:hover, \
		        .breakdown .line';
			$(backgrounds).css('background', newval );

			/**
			 * Border Colors
			 * @type {string}
			 */
			borderColors = 
		        '.pagetitleloading .pagercontainer #bx-pager a.active,  \
		        .pagetitleloading .pagercontainer #bx-pager a:hover,  \
		        a.more-link, .regular-posts a.more-link,  \
		        .pie, .c100 .bar, .c100.p51 .fill, .c100.p52 .fill,  \
		        .c100.p53 .fill, .c100.p54 .fill, .c100.p55 .fill,  \
		        .c100.p56 .fill, .c100.p57 .fill, .c100.p58 .fill,  \
		        .c100.p59 .fill, .c100.p60 .fill, .c100.p61 .fill,  \
		        .c100.p62 .fill, .c100.p63 .fill, .c100.p64 .fill,  \
		        .c100.p65 .fill, .c100.p66 .fill, .c100.p67 .fill,  \
		        .c100.p68 .fill, .c100.p69 .fill, .c100.p70 .fill,  \
		        .c100.p71 .fill, .c100.p72 .fill, .c100.p73 .fill,  \
		        .c100.p74 .fill, .c100.p75 .fill, .c100.p76 .fill,  \
		        .c100.p77 .fill, .c100.p78 .fill, .c100.p79 .fill,  \
		        .c100.p80 .fill, .c100.p81 .fill, .c100.p82 .fill,  \
		        .c100.p83 .fill, .c100.p84 .fill, .c100.p85 .fill,  \
		        .c100.p86 .fill, .c100.p87 .fill, .c100.p88 .fill,  \
		        .c100.p89 .fill, .c100.p90 .fill, .c100.p91 .fill,  \
		        .c100.p92 .fill, .c100.p93 .fill, .c100.p94 .fill,  \
		        .c100.p95 .fill, .c100.p96 .fill, .c100.p97 .fill,  \
		        .c100.p98 .fill, .c100.p99 .fill, .c100.p100 .fill, \
		        .struck .tw-button, .struck a.tw-button, .struck .tw-postshortcode a.more-link';
			$(borderColors).css('border-color', newval ); 

			/**
			 * Colors
			 * @type {string}
			 */
			colors =
		        'a, a:hover, #share-box span, .thumbintro span a, \
		        .c100:hover > span, a.more-link, \
		        span.highlight, \
		        .score, \
		        .button,  \
		        .tw-button, \
		        a.tw-button, \
		        a.button, \
		        a.more-link, \
		        #submit, \
		        .tw-postshortcode a.more-link, \
		        input[type=submit], \
		        .single .authorinfo.not-full a:hover, \
		        .struck .tw-button, .struck a.tw-button, .struck .tw-postshortcode a.more-link';
			//$(colors).css('color', newval );
			addCSSRule(sheet, colors, "color: " + newval + "");

			/**
			 * Hover Backgrounds Pseudo Styles
			 * @type {string}
			 */
			hoverBackgrounds = 
		        '.tabswrap ul.tabs a:hover, a.more-link:hover, \
		        .regular-posts a.more-link:hover,.button:hover, \
		        .tw-button:hover, \
		        a.tw-button:hover, \
		        a.button:hover, \
		        a.more-link:hover, \
		        #submit:hover, \
		        .tw-postshortcode a.more-link:hover, \
		        input[type=submit]:hover,\
		        .button:active, \
		        .tw-button:active, \
		        a.tw-button:active, \
		        a.button:active, \
		        a.more-link:active, \
		        #submit:active, \
		        .tw-postshortcode a.more-link:active, \
		        input[type=submit]:active';
			addCSSRule(sheet, hoverBackgrounds, "background: " + newval + " !important");

			/**
		     * Border Colors Pseudo Styles
		     * @type {string}
		     */
		    borders = 
		        '.pagetitleloading .pagercontainer .bx-slider-pager a.active, \
		        .pagetitleloading .pagercontainer .bx-slider-pager a:hover, \
		        .button, \
		        .tw-button, \
		        a.tw-button, \
		        a.button, \
		        a.more-link, \
		        #submit, \
		        .tw-postshortcode a.more-link, \
		        input[type=submit], \
		        .top-nav.altnav #menu > ul > li > a:hover, \
		        .top-nav.altnav #menu > ul > li.sfHover > a, \
		        .top-nav.altnav #menu > ul > li.current_page_item > a';
		    addCSSRule(sheet, borders, "border-color: " + newval + "");

			/**
			 * Right Border Colors Pseudo Styles
			 * @type {string}
			 */
			rightBorders =
				'.badge a:before, .badgesliver.highlight:before, .loading-image';
		    addCSSRule(sheet, rightBorders, "border-right-color: " + newval + " !important");

		    /**
		     * Left Border Colors Pseudo Styles
		     * @type {string}
		     */
		    leftBorders = 
		    	'.badge a:after, .badgesliver.highlight:after';
		    addCSSRule(sheet, leftBorders, "border-left-color: " + newval + " !important");	

		    topBorders = '.loading-image'; 
		    addCSSRule(sheet, leftBorders, "border-top-color: " + newval + " !important");	

		} );
	} );
	
} )( jQuery );