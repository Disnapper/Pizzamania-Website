/*
 *  jQuery Navburger Popout Navigation
 *  Powered by the Greensock Animation Platform
 *
 *  Copyright (c) 2014 Andre Gagnon
 *  http://themewich.com
 *
 *  Licensed under MIT
 */

/*! Tappy! - a lightweight normalized tap event. Copyright 2013 @scottjehl, Filament Group, Inc. Licensed MIT */
(function( w, $, undefined ){

	// handling flag is true when an event sequence is in progress (thx androood)
	w.tapHandling = false;
	w.tappy = true;

	var tap = function( $els ){
		return $els.each(function(){

			var $el = $( this ),
				resetTimer,
				startY,
				startX,
				cancel,
				scrollTolerance = 10;

			function trigger( e ){
				$( e.target ).trigger( "tap", [ e, $( e.target ).attr( "href" ) ] );
			}

			function getCoords( e ){
				var ev = e.originalEvent || e,
					touches = ev.touches || ev.targetTouches;

				if( touches ){
					return [ touches[ 0 ].pageX, touches[ 0 ].pageY ];
				}
				else {
					return null;
				}
			}

			function start( e ){
				if( e.touches && e.touches.length > 1 || e.targetTouches && e.targetTouches.length > 1 ){
					return false;
				}

				var coords = getCoords( e );
				startX = coords[ 0 ];
				startY = coords[ 1 ];
			}

			// any touchscroll that results in > tolerance should cancel the tap
			function move( e ){
				if( !cancel ){
					var coords = getCoords( e );
					if( coords && ( Math.abs( startY - coords[ 1 ] ) > scrollTolerance || Math.abs( startX - coords[ 0 ] ) > scrollTolerance ) ){
						cancel = true;
					}
				}
			}

			function end( e ){
				clearTimeout( resetTimer );
				resetTimer = setTimeout( function(){
					w.tapHandling = false;
					cancel = false;
				}, 1000 );

				// make sure no modifiers are present. thx http://www.jacklmoore.com/notes/click-events/
				if( ( e.which && e.which > 1 ) || e.shiftKey || e.altKey || e.metaKey || e.ctrlKey ){
					return;
				}

				e.preventDefault();

				// this part prevents a double callback from touch and mouse on the same tap

				// if a scroll happened between touchstart and touchend
				if( cancel || w.tapHandling && w.tapHandling !== e.type ){
					cancel = false;
					return;
				}

				w.tapHandling = e.type;
				trigger( e );
			}

			$el
				.bind( "touchstart.tappy MSPointerDown.tappy", start )
				.bind( "touchmove.tappy MSPointerMove.tappy", move )
				.bind( "touchend.tappy MSPointerUp.tappy", end )
				.bind( "click.tappy", end );
		});
	};

	var untap = function( $els ){
		return $els.unbind( ".tappy" );
	};

	// use special events api
	if( $.event && $.event.special ){
		$.event.special.tap = {
			add: function( handleObj ) {
				tap( $( this ) );
			},
			remove: function( handleObj ) {
				untap( $( this ) );
			}
		};
	}
	else{
		// monkeybind
		var oldBind = $.fn.bind,
			oldUnbind = $.fn.unbind;
		$.fn.bind = function( evt ){
			if( /(^| )tap( |$)/.test( evt ) ){
				tap( this );
			}
			return oldBind.apply( this, arguments );
		};
		$.fn.unbind = function( evt ){
			if( /(^| )tap( |$)/.test( evt ) ){
				untap( this );
			}
			return oldUnbind.apply( this, arguments );
		};
	}

}( this, jQuery ));


;(function ( $, window, document, undefined ) {

	// Create the defaults once
    var pluginName = 'navBurger',
        defaults = {
			menuLink: '.nb-menu-link', // default menu link selector
			pageWrap: '#nb-menu-page', // default page wrap class
			wrapInside: 'body',
			menuWidth: 260, // default menu width
			clone: false, // default clone option
			customDiv: false, // default custom div option
			customDivMenuLocation: false, // custom menu location
			menuTime: 0.5, // default menu animation time
			subMenuTime: 0.5, // default submenu animation time
			delay: 0, // add a delay so the menu opens and closes later than the content
			backText: 'Back', // default back text
			closeOnClick: true, // Closes the menu when an item is clicked (good for ajax)
			position: 'right',
			fixedElements: '#fp-nav'
        };

    // The actual plugin constructor
    function Plugin( element, options ) {
        this.element = element;
        this.$elem = $(element);

        // extend defaults with user options
        this.options = $.extend( {}, defaults, options) ;

        this._defaults = defaults;
        this._name = pluginName;

        this.init();
    }

	// Avoid Plugin.prototype conflicts
	$.extend(Plugin.prototype, {

		init : function () {
            var base = this;

            base.loadMenu();
        },

        loadMenu : function () {
        	var base = this;

        /**
         * GLOBAL VARIABLES
         * base.$body  	- body
         * base.$w 		- window
         * base.$html	- html
         *
         * MENU VARIABLES
         * base.options.$menu 		- slide out menu
         * base.options.menuLink 	- clickable link to open menu
         * base.options.menuContainer 	- first menu ul
         * base.options.menuItems 		- all menu list items
         * base.options.backButton 		- menu back buttons
         * base.options.arrow 			- menu arrows
         *
         * OTHER VARIABLES
         * base.pageWrap 			- wrapper over page to slide content left
         * base.options.menuBlocker 	- blocks clicks on page when menu is open
         */
        	base.setVars(); 	// set plugin variables
        	base.wrapItems(); 	// add necessary html elements

        	base.pushMenu(); 	// set up push menu
        	base.menuClick(); 	// menu click events
        	base.menuItemClick(); // menu item click events
        	base.resizeFunctions(); // resize functions
        },

        setVars : function () {
        	var base = this;

			base.$body 			= $( 'body' ).css({ 'overflowX' :  'hidden' }); // Store body selector
			base.$w 			= $( window ); // store window
			base.$html 			= $( 'html' ); // store html

			base.options.$menu 			= base.$elem; // store menu
			base.options.menuLink 		= base.options.menuLink && $( base.options.menuLink ); // add menu link to dom
			base.$middleLine 			= base.options.menuLink.find('span');
			base.$topLine				= base.options.menuLink.find('span:before');
			base.$bottomLine 			= base.options.menuLink.find('span:after');
			base.$menuLinkPosition  	= base.options.menuLink.css('position');
			base.$additions 			= base.options.fixedElements && $( base.options.fixedElements ).addClass('nb-fixed'); // add fixed class to fixed items

        },

        wrapItems : function () {

        	var base = this;

        	/* Check if already running, wrap pagewrap if it doesn't exist */
			if ( base.options.pageWrap && $(base.options.pageWrap).length == 0 ) {
				$(base.options.wrapInside).wrap( "<div id='" + base.options.pageWrap.replace('#','')  + "'></div>"); // wrap body in pagewrap ID
				base.options.pageWrap = $( base.options.pageWrap ).css({ 'position' : 'relative', 'z-index' : 3 }); // add page wrap to dom
			} else {
				base.options.pageWrap = $(base.options.pageWrap);
			}

			// Clone or reposition menu
			base.options.menuList = $(base.options.$menu);

			base.cloneMenu();

			base.options.$menu.css({ 'display' : 'none' }); // Hide menu
			base.options.menuContainer = base.options.menuList.children( 'ul' ).addClass( 'nb-menu-items-container' ); // add class to first menu ul
			base.options.menuItems = base.options.menuContainer.find( 'li' );

			// add blocker if it doesn't exist
			if ( $('#nb-menu-blocker').length == 0 ) {
				base.$body.append( $( "<div id='nb-menu-blocker' class='nb-fixed'></div>" ) );
			}
			base.options.menuBlocker = $('#nb-menu-blocker');

			// add submenu divs
			base.options.menuLevels = base.options.menuItems.find( 'ul' )
				.wrap( "<div class='nb-menu-level'></div>" )
				.prepend( "<span class='nb-back'>" + base.options.backText + "</span>" );

			base.options.backButton = $('span.nb-back'); // add to DOM
			base.options.menuItems.has( 'ul' ).find( 'a' ).wrap( "<span class='nb-menu-item-container'></span>" ); // wrap item container

			$('.nb-menu-level').not('.nb-menu-level.nb-menu-items-container').css({'display': 'none'}); // hide all submenus for now

			// add submenu class
			base.options.menuItems.has( 'ul' ).addClass( 'nb-with-ul' ).children('.nb-menu-item-container').append( "<span class='arrow'></span>" );
			base.options.arrow = $('.nb-menu-items-container .arrow');

			base.setBackText(); // set back text
        },

        cloneMenu : function() {
        	var base = this,
        		$menu = $( base.options.$menu );

	        	if ( base.options.clone == true ) {
	        		base.options.menuList = $( base.options.$menu ).clone(); // clone element

	        		base.options.menuList.attr('id', '').addClass('tw-' + base.options.position).children('ul').removeClass();

	        		base.customDiv(base.options.menuList);

	        	} else {
	        		base.options.menuList = base.options.$menu.attr('id', '');
	        		base.customDiv( base.options.menuList );
	        	}

        	// store menu items
        	base.$menuItems = base.options.$menu.find('a');
        },

        customDiv: function(menu) {
        	var base = this
        		customDiv = $( base.options.customDiv );

        	// check if already created
        	if ( ! customDiv.hasClass('nb-menu-level') ) {
	        	// if we have a custom div and custom menu location
	        	if ( base.options.customDiv && base.options.customDivMenuLocation ) {
	        		menu.prependTo( base.options.customDivMenuLocation );
	        		base.options.$menu = customDiv.prependTo( "body" ).addClass('nb-menu-level').attr('id', 'nb-popoutmenu').addClass('tw-' + base.options.position).width( base.options.menuWidth );
	        	} else {
	        		base.options.$menu = menu.prependTo( "body" ).addClass('nb-menu-level').attr('id', 'nb-popoutmenu').width( base.options.menuWidth );
	        	}
        	} else {
        		base.options.$menu = customDiv;
        	}

        },

        setBackText : function () {
        	var base = this;

        	base.options.menuLevels.each(function(){
        		var $menu = $(this),
        			backText = $menu.closest('li').find('a').html(),
        			backLink = $menu.find('.nb-back');

        		backLink.html(backText); // set back text
        	});
        },

 		addOpenClasses : function () {
 			var base = this;

 			if (base.options.open) {
				base.options.pageWrap.addClass( 'nb-menu-open' );
				base.$html.addClass( 'nb-menu-open-wrapper' );
			} else {
				base.options.pageWrap.removeClass( 'nb-menu-open' );
				base.$html.removeClass( 'nb-menu-open-wrapper' );
			}
 		},

 		sizePageWrap : function (sizeBool) {
 			var base = this;

 			if (sizeBool) {
	 			base.options.pageWrap.css({
	 				'height' : base.$w.outerHeight() + 'px',
	 				'overflow' : 'hidden'
	 			})
	 			.addClass('nb-nav-opened');
 			} else {
 				base.options.pageWrap.css({
	 				'height' : '',
	 				'overflow' : 'auto'
 				})
 				.removeClass('nb-nav-opened');
 			}
 		},

 		changeMenuIcon : function(state) {
 			var base = this;

 			if (state && state == 'opened') {
 				setTimeout(function(){
			    	base.options.menuLink.addClass('closeout');
				}, base.options.menuTime*100 + 75);
 			} else {
 				setTimeout(function(){
			    	base.options.menuLink.removeClass('closeout');
				}, base.options.menuTime*100 + 75);
 			}
 		},

 		openMenu : function () {
 			var base = this,
 				addition = addition = $('.nb-fixed');

 			// before open callback
 			base.options.$menu.css({
 				'display' : 'block'
 			});

 			// change icon
 			base.changeMenuIcon('opened');

 			// before open callback
			beforeOpenCallBack();

			// open menu animation
			if (base.options.position == 'right') {
				TweenMax.set(base.options.$menu, {x:base.options.menuWidth});
				TweenMax.to(base.options.pageWrap.add(addition),
					base.options.menuTime, {
						x: -base.options.menuWidth,
						ease: Expo.easeOut,
						delay: base.options.delay,
						onComplete: openedCallBack
					}
				);
			} else {
				TweenMax.set(base.options.$menu, {x:-base.options.menuWidth});
				TweenMax.to(base.options.pageWrap.add(addition),
					base.options.menuTime, {
						x: base.options.menuWidth,
						ease: Expo.easeOut,
						delay: base.options.delay,
						onComplete: openedCallBack
					}
				);
			}
			TweenMax.to(base.options.$menu,
				base.options.menuTime, {
					x:0,
					ease: Expo.easeOut,
				}
			);

			// callbacks
			function openedCallBack() { base.menuOpened(); }
			function beforeOpenCallBack() { base.menuBeforeOpen(); }

 		},

 		closeMenu : function () {
 			var base = this,
 				addition = $('.nb-fixed');

 			// change icon
 			base.changeMenuIcon('closed');

 			// before close callback
			beforeCloseCallBack();

			// close menu animation
			TweenMax.to(base.options.pageWrap.add(addition),
				base.options.menuTime, {
					x: 0,
					ease: Expo.easeOut,
					onComplete: closedCallBack
				}
			);

			// slide panel out of view
			if (base.options.position == 'right') {
				TweenMax.to(base.options.$menu,
					base.options.menuTime, {
						x: base.options.menuWidth,
						ease: Expo.easeOut,
						delay: base.options.delay
					}
				);
			} else {
				TweenMax.to(base.options.$menu,
					base.options.menuTime, {
						x: -base.options.menuWidth,
						ease: Expo.easeOut,
						delay: base.options.delay
					}
				);
			}

			// callbacks
			function closedCallBack() { base.menuClosed(); }
			function beforeCloseCallBack() { base.menuBeforeClose(); }
 		},

 		openSubMenu : function (subMenu) {
 			var base = this;

 			// set out of view
 			TweenMax.set(subMenu, {
 				'right' : -base.options.menuWidth,
 				'display' : 'block',
 				'z-index' : 2,
 				'opacity' : 0
 			});

 			// Open submenu
			TweenMax.to(subMenu,
				base.options.subMenuTime, {
					'right' : 0,
 					'opacity': 1,
					ease: Expo.easeOut
				}
			);

			// animate height
			TweenMax.to(base.options.menuContainer,
				base.options.subMenuTime, {
					'height' : subMenu.find('ul').height() + 'px',
					ease: Expo.easeOut
				}
			);

 			// add opened class
			subMenu.addClass('nb-opened');

 		},

 		closeSubMenu : function (subMenu) {
 			var base 		= this,
 				parentMenu 	= subMenu.parent().closest('ul'),
 				newHeight 	= parentMenu.height();

 			if ( parentMenu.hasClass('nb-menu-items-container') ) {
 				// we've reached the top, remove height
	 			TweenMax.to(base.options.menuContainer,
 					base.options.subMenuTime, {
 						'height' : 'auto',
 						ease: Expo.easeOut
 					}
 				);
 			} else {
 				TweenMax.to(base.options.menuContainer,
 					base.options.subMenuTime, {
 						'height' : subMenu.parent().closest('ul').height() + 'px',
 						ease: Expo.easeOut
 					}
 				);
 			}

 			// close submenu
 			TweenMax.to(subMenu,
 				base.options.subMenuTime, {
 					'right' : -base.options.menuWidth,
 					'opacity' : 0,
 					ease: Expo.easeOut
 				}
 			);

 			// close submenu
 			subMenu.removeClass('nb-opened');

 		},

 		backToTopMenu : function () {
			var base = this,
				subMenus = $('.nb-opened');

			TweenMax.to(subMenus, 1, {
 					'right' : -base.options.menuWidth,
 					'opacity' : 0,
 					ease: Expo.easeOut
 				}
 			);
 		},

 		menuClick : function () {
 			var base = this;

 			// Menu Click
 			base.options.menuLink.off('click tap');
			base.options.menuLink.on('click tap', function(e){
				base.openMenu();
				e.preventDefault(); // prevent default link action
			});

			// Blocker Click
			base.options.menuBlocker.off('click tap');
			base.options.menuBlocker.on('click tap', function(e){
				base.closeMenu();
				e.preventDefault(); // prevent default link action
			});
 		},

 		menuItemClick : function () {
 			var base = this;

 			if ( base.options.closeOnClick ) {
				base.$menuItems.click(function(e){
                    if ( $(this).attr('href') != '#' ) {
                        base.closeMenu();
                    } else {
                        e.preventDefault();
                        $(this).next('span.arrow').click();
                    }
				});
 			}

 		},

 		pushMenu : function () {
 			var base = this;

 			// Submenu Open
			base.options.arrow.click(function(e) {
				var subMenu = $(this).closest('.nb-menu-item-container').next('.nb-menu-level');

				base.openSubMenu(subMenu);
			});

			// Back Button
 			base.options.backButton.click(function() {
				var subMenu 	= $(this).closest('.nb-menu-level');

				base.closeSubMenu(subMenu);
 			});
 		},

 		/**
 		 * Callback Functions
 		 */
 		menuBeforeOpen : function () {
 			var base = this;

 			// display blocker
 			base.options.menuBlocker.css('display', 'block');
 		},

 		menuBeforeClose : function () {},

 		menuOpened : function () {
 			var base = this;
 			base.options.open = true;
 			base.addOpenClasses();
 		},

 		menuClosed : function () {
 			var base = this;

 			base.options.open = false;
 			base.addOpenClasses();

 			// remove blocker
 			base.options.menuBlocker.css('display', 'none');
 			base.options.pageWrap.css('transform', '');
 		},

 		resizeFunctions : function() {
 			var base = this;

 			$(window).resize(function(){
	 			if ( base.options.pageWrap.hasClass('nb-nav-opened') ) {
	 				base.sizePageWrap(true);
	 			}
 			});
 		}

	});

	// A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations and allowing any
    // public function (ie. a function whose name doesn't start
    // with an underscore) to be called via the jQuery plugin,
    // e.g. $(element).navBurger('functionName', arg1, arg2)
    $.fn[pluginName] = function ( options ) {
        var args = arguments;

        if ( typeof TweenMax !== 'function' ) {
        	console.log('The navBurger plugin requires TweenMax.js to function. Please load TweenMax.js before navBurger.');
        	return false;
        }
        if (options === undefined || typeof options === 'object') {
            return this.each(function () {
                if (!$.data(this, 'plugin_' + pluginName)) {
                    $.data(this, 'plugin_' + pluginName, new Plugin( this, options ));
                }
            });
        } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
            var returns;

            this.each(function () {
                var instance = $.data(this, 'plugin_' + pluginName);

                if (instance && typeof instance[options] === 'function') {
                    returns = instance[options].apply( instance, Array.prototype.slice.call( args, 1 ) );
                }
                if (options === 'destroy') {
                  $.data(this, 'plugin_' + pluginName, null);
                }
            });
            return returns !== undefined ? returns : this;
        }
    };
})( jQuery, window, document );