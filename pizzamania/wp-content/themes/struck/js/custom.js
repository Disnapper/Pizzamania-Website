/**
 * Custom Javascript for Struck
 *
 * @package WordPress
 * @subpackage Struck
 * @since Struck 1.0
 */

// Set jQuery to NoConflict Mode
jQuery.noConflict();

// Prepare our Variables
var History = window.History,
    browserHistory = true,
    $ = window.jQuery,
    document = window.document;

// Check to see if History.js is enabled for our Browser
if ( !History.enabled ) {
    browserHistory = false;
}

// Disable if modernizr doesn't detect history management
if (!Modernizr.history) {
    browserHistory = false;
}

(function($){
    window.mobilecheck = function() {
        var check = false;
        (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|android|ipad|playbook|silk|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4)))check = true})(navigator.userAgent||navigator.vendor||window.opera);
        return check;
    }
})(jQuery);


/*! jQuery Mousewheel
 *
 * Copyright (c) 2013 Brandon Aaron (http://brandon.aaron.sh)
 * Licensed under the MIT License (LICENSE.txt).
 *
 * Version: 3.1.12
 *
 * Requires: jQuery 1.2.2+
 */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):"object"==typeof exports?module.exports=a:a(jQuery)}(function(a){function b(b){var g=b||window.event,h=i.call(arguments,1),j=0,l=0,m=0,n=0,o=0,p=0;if(b=a.event.fix(g),b.type="mousewheel","detail"in g&&(m=-1*g.detail),"wheelDelta"in g&&(m=g.wheelDelta),"wheelDeltaY"in g&&(m=g.wheelDeltaY),"wheelDeltaX"in g&&(l=-1*g.wheelDeltaX),"axis"in g&&g.axis===g.HORIZONTAL_AXIS&&(l=-1*m,m=0),j=0===m?l:m,"deltaY"in g&&(m=-1*g.deltaY,j=m),"deltaX"in g&&(l=g.deltaX,0===m&&(j=-1*l)),0!==m||0!==l){if(1===g.deltaMode){var q=a.data(this,"mousewheel-line-height");j*=q,m*=q,l*=q}else if(2===g.deltaMode){var r=a.data(this,"mousewheel-page-height");j*=r,m*=r,l*=r}if(n=Math.max(Math.abs(m),Math.abs(l)),(!f||f>n)&&(f=n,d(g,n)&&(f/=40)),d(g,n)&&(j/=40,l/=40,m/=40),j=Math[j>=1?"floor":"ceil"](j/f),l=Math[l>=1?"floor":"ceil"](l/f),m=Math[m>=1?"floor":"ceil"](m/f),k.settings.normalizeOffset&&this.getBoundingClientRect){var s=this.getBoundingClientRect();o=b.clientX-s.left,p=b.clientY-s.top}return b.deltaX=l,b.deltaY=m,b.deltaFactor=f,b.offsetX=o,b.offsetY=p,b.deltaMode=0,h.unshift(b,j,l,m),e&&clearTimeout(e),e=setTimeout(c,200),(a.event.dispatch||a.event.handle).apply(this,h)}}function c(){f=null}function d(a,b){return k.settings.adjustOldDeltas&&"mousewheel"===a.type&&b%120===0}var e,f,g=["wheel","mousewheel","DOMMouseScroll","MozMousePixelScroll"],h="onwheel"in document||document.documentMode>=9?["wheel"]:["mousewheel","DomMouseScroll","MozMousePixelScroll"],i=Array.prototype.slice;if(a.event.fixHooks)for(var j=g.length;j;)a.event.fixHooks[g[--j]]=a.event.mouseHooks;var k=a.event.special.mousewheel={version:"3.1.12",setup:function(){if(this.addEventListener)for(var c=h.length;c;)this.addEventListener(h[--c],b,!1);else this.onmousewheel=b;a.data(this,"mousewheel-line-height",k.getLineHeight(this)),a.data(this,"mousewheel-page-height",k.getPageHeight(this))},teardown:function(){if(this.removeEventListener)for(var c=h.length;c;)this.removeEventListener(h[--c],b,!1);else this.onmousewheel=null;a.removeData(this,"mousewheel-line-height"),a.removeData(this,"mousewheel-page-height")},getLineHeight:function(b){var c=a(b),d=c["offsetParent"in a.fn?"offsetParent":"parent"]();return d.length||(d=a("body")),parseInt(d.css("fontSize"),10)||parseInt(c.css("fontSize"),10)||16},getPageHeight:function(b){return a(b).height()},settings:{adjustOldDeltas:!0,normalizeOffset:!0}};a.fn.extend({mousewheel:function(a){return a?this.bind("mousewheel",a):this.trigger("mousewheel")},unmousewheel:function(a){return this.unbind("mousewheel",a)}})});

(function ($) {
    $.detectSwipe = {
        version: '2.1.1',
        enabled: 'ontouchstart' in document.documentElement,
        preventDefault: false,
        threshold: 20
    };

    var startX,
        startY,
        isMoving = false;

    function onTouchEnd() {
        this.removeEventListener('touchmove', onTouchMove);
        this.removeEventListener('touchend', onTouchEnd);
        isMoving = false;
    }

    function onTouchMove(e) {
        if ($.detectSwipe.preventDefault) {
            e.preventDefault();
        }
        if (isMoving) {
            var x = e.touches[0].pageX;
            var y = e.touches[0].pageY;
            var dx = startX - x;
            var dy = startY - y;
            var dir;
            if (Math.abs(dx) >= $.detectSwipe.threshold) {
                dir = dx > 0 ? 'left' : 'right'
            }
            else if (Math.abs(dy) >= $.detectSwipe.threshold) {
                dir = dy > 0 ? 'down' : 'up'
            }
            if (dir) {
                onTouchEnd.call(this);
                $(this).trigger('swipe', dir).trigger('swipe' + dir);
            }
        }
    }

    function onTouchStart(e) {
        if (e.touches.length == 1) {
            startX = e.touches[0].pageX;
            startY = e.touches[0].pageY;
            isMoving = true;
            this.addEventListener('touchmove', onTouchMove, false);
            this.addEventListener('touchend', onTouchEnd, false);
        }
    }

    function setup() {
        this.addEventListener && this.addEventListener('touchstart', onTouchStart, false);
    }

    function teardown() {
        this.removeEventListener('touchstart', onTouchStart);
    }

    $.event.special.swipe = {setup: setup};

    $.each(['left', 'up', 'down', 'right'], function () {
        $.event.special['swipe' + this] = {
            setup: function () {
                $(this).on('swipe', $.noop);
            }
        };
    });
})(jQuery);

/*
	--------------------------------
	Infinite Scroll Behavior
	Manual / Twitter-style
	--------------------------------
	+ https://github.com/paulirish/infinitescroll/
	+ version 2.0b2.110617
	+ Copyright 2011 Paul Irish & Luke Shumard
	+ Licensed under the MIT license

	+ Documentation: http://infinite-scroll.com/

*/

(function ($, undefined) {
    $.extend($.infinitescroll.prototype, {

        _setup_twitter: function infscr_setup_twitter() {
            var opts = this.options,
                instance = this;

            // Bind nextSelector link to retrieve
            $(opts.nextSelector).click(function (e) {
                if (e.which == 1 && !e.metaKey && !e.shiftKey) {
                    e.preventDefault();
                    instance.retrieve();
                }
            });

            // Define loadingStart to never hide pager
            instance.options.loading.start = function (opts) {
                opts.loading.msg
                    .appendTo(opts.loading.selector)
                    .show(opts.loading.speed, function () {
                        instance.beginAjax(opts);
                    });
            }
        },
        _showdonemsg_twitter: function infscr_showdonemsg_twitter() {
            var opts = this.options,
                instance = this;

            //Do all the usual stuff
            opts.loading.msg
                .find('img')
                .hide()
                .parent()
                .find('div').html(opts.loading.finishedMsg).animate({opacity: 1}, 2000, function () {
                    $(this).parent().fadeOut('normal');
                });

            //And also hide the navSelector
            $(opts.navSelector).fadeOut('normal');

            // user provided callback when done
            opts.errorCallback.call($(opts.contentSelector)[0], 'done');

        }

    });
})(jQuery);


/*
 *  FullPage Functionality
 *
 *  A wrapper for the fullpage.js function to include
 *  animations, content slideup and public methods for ajax.
 *
 *  By Andre Gagnon
 */
(function ($, window, document, undefined) {
    "use strict";

    // Create the defaults
    var pluginName = 'themewichFullPage',
        defaults = {
            animations: 	true,
            scrollingSpeed: 0.85,
            itemDelay: 		0.5,
            animationSpeed: 0.5,
            transition: 	'transition.slideUpIn',
            heightDiff: 	0,
            addScrollDelay: true,
            autoScrolling: 	true,
            responsive: 	767
        };

    // The actual plugin constructor
    function Plugin(element, options) {

        this.element = element;
        this.$el = $(element);

        // extend defaults with user options
        this.options = $.extend({}, defaults, options);

        // store defaults and plugin name
        this._defaults = defaults;
        this._name = pluginName;

        // run init method
        this.init();

    }

	// Avoid Plugin.prototype conflicts
    $.extend(Plugin.prototype, {

        /**
         * Initialize vars and load fullpage plugin
         * @since  1.0
         */
        init: function () {

            this._initVars(); // initialize variables
            this.beforeInit(); // before fullpage call
            this.loadFullPage(); // run plugin
            this.afterInit(); // after fullpage call (not after render)

        },

		/**
		 * Initialize variables
		 */
		_initVars: function() {

			var base = this;

			// cache window, body, HTML
			base.$w 	= $(window);
			base.$html 	= $('html');
			base.$b 	= $('body');

			// store page load url
			base.$url  	= window.location.href;

			// flags
			base.$mobileDevice 		= window.mobilecheck(); // check for user agent string first
            base.$mobileDevice      = base.$mobileDevice == false ? $('#tw-mobile-indicator').css('display') == 'none' : base.$mobileDevice; // then check for browser width
			base.$fullpageHidden 	= false;
			base.$transforms 		= this.$html.hasClass('.csstransforms');
			base.$ajax 				= base.$b.hasClass('ajax-on') ? true : false;

			// store initial variables
			base.$sections 			= $('.section, .page-content-wrapper'); // sections
			base.$lastSection 		= $('#fullpage').find('.section:last-child'); // last section
			base.$vItems 			= base.$el.find('.v-item'); // animation items
			base.$contentSection 	= $('.page-content-wrapper');
			base.$fullpageWrapper 	= $('#fullpage-wrapper');
			base.$section_number 	= base.$sections.length;
			base.$topNav 			= $('.top-nav');

			// set height correctly if auto scrolling is disabled
			! base.options.autoScrolling && base.$fullpageWrapper.css({'height' : 'auto'});

			// prev/next buttons
			base.$nextButtons 		= $('.section .next-section-link');
			base.$prevButtons 		= $('.section .prevbutton');
			base.$nextSlideButtons 	= $('.section .next-slide-link');

			// hide all animation items on load if set
			base.options.animations && TweenMax.set('.v-item', {autoAlpha: 0});

			// current section/slide
			this.$indicator			= 'section';
			base.$currentSection 	= $("[data-section='1']");
			base.$currentSlide 		= base.$currentSection.find('.slide:first-child');
			base.$nextSection 		= $("[data-section='2']");
			base.$nextSlide 		= base.$nextSection.find('.slide:first-child');

			if (base.$currentSlide.length == 1) {
				this.$indicator = 'slide';
				base.$currentSection = base.$currentSlide;
			}
			if (base.$nextSlide.length == 1) {
				base.$nextSection = base.$nextSlide;
			}

			if ( ! base.$ajax ) {
				var $s_count = 1;
				base.$anchors = [];
				base.$sections.each(function(){
					base.$anchors.push($s_count);
					$s_count++;
				});
			} else {
				base.$anchors = false;
			}

			// next section/slide defaults
			base.$nextSection = null;
			base.$nextSlide = null;

			// previous section
			base.$prevSection = null;
			base.$prevSlide = null;

			// set a delay for scrolling
			base.animDelay = (base.options.addScrollDelay && base.options.autoScrolling) ? base.options.itemDelay : 0;
		},

		/**
		 * Update vars after section change
		 */
		_updateVars: function() {
			var base = this;

			if (base.$nextSection && base.$nextSection.length != 0) {
				base.$currentSection = base.$nextSection;
			}

			if (base.$nextSlide && base.$nextSlide.length != 0) {
				base.$currentSection = base.$nextSlide;
			}

			// reset vars
			base.$nextSection 	= false;
			base.$nextSlide 	= false;
		},

		/**
		 * Functions to run before fullpage is loaded
		 * @since  1.0
		 */
		beforeInit: function() {

			// check if current section has dark section
			// then add body class accordingly
			if ( this.$currentSection.hasClass('dark-section') ) {
				this.$b.addClass('dark-section');
			} else {
				this.$b.removeClass('dark-section');
			}

			this.$b.addClass('fullpage-showing');

			this._setImageHeights();
			this._regularScrollEvents();
			this._slideClass(true);
			this._html5Videos();
			this._setNavPadding();

			// set overflow based on autoscrolling
			this.setOverflow( !this.options.autoScrolling );

			this.disablePullRefresh();

		},

		/**
		 * Functions to run before fullpage is initialized
		 */
		afterInit: function() {

			// add additional dot after function is run
			this._additionalHTML();

		},

		/**
		 * Initialize fullpage.js script
		 */
		loadFullPage: function() {

			var base = this; // store this

			if ($.fn.fullpage) {
				base.$el.fullpage({
					anchors:base.$anchors,
					verticalCentered: true,
					resize : false, // we'll do this with css
					css3: true,
				    scrollBar: false, // doesn't work properly with modifications
					easingcss3: 'ease',
					scrollingSpeed: base.options.scrollingSpeed*1000,
					menu: false,
					scrollOverflow: base.options.autoScrolling,
					navigation: base.$section_number > 1,
					autoScrolling: base.options.autoScrolling,
					navigationPosition: 'right',
					navigationTooltips: false,
					slidesNavigation: false,
					slidesNavPosition: 'bottom',
					loopBottom: false,
					loopTop: false,
					loopHorizontal: true,
					paddingTop: '0',
					paddingBottom: '0',
					normalScrollElements: '.tw-slide-panel',
					normalScrollElementTouchThreshold: 5,
					keyboardScrolling: false,
					touchSensitivity: 15,
					continuousVertical: false,
					animateAnchor: false,
					recordHistory: false,
					sectionSelector: '.section',
					slideSelector: '.slide',
					responsive: 0, // well do device detection // base.options.responsive && base.options.autoScrolling ? base.options.responsive : 0,
					onEnd: function(end) { // at the end of the sections
						base.onEnd(end); // separate function to make public
					},
					onLeave: function(index, nextIndex, direction){ // after a section is left
						base.onLeave(index, nextIndex, direction); // separate function to make public
					},
					afterLoad: function(anchorLink, index){ // after section is loaded
						base.afterLoad(anchorLink, index); // separate function to make public
					},
					afterRender: function(){ // load events
						base.afterRender(); // separate function to make public
					},
					afterResize: function(){ // resize events
						base.afterResize();
					},
					afterSlideLoad: function(anchorLink, index, slideAnchor, slideIndex){ // after a slide is loaded
						base.afterSlideLoad(index, slideIndex);
					},
					onSlideLeave: function(anchorLink, index, slideIndex, nextSlideIndex, direction){ // after a slide is left
						base.onSlideLeave(anchorLink, index, slideIndex, nextSlideIndex, direction);
					}
				});
			}

		},

		/**
		 * When we've reached the end of all sections
		 */
		onEnd: function(end) {

			// slide in main content
			if (end == 'bottom' && this.$contentSection.length > 0) {
				this.slideFullPageUp();
			}

		},

		/**
		 * When section is left
		 *
		 * Fades out current section items
		 * Runs section events for new items
		 * Update section indexes
		 * Check for scroll and nav background
		 */
		onLeave: function(index, nextIndex, direction) {

			this.$currentSection 	= $("[data-section='" + index + "']"); 		// get current section
			this.$nextSection 		= $("[data-section='" + nextIndex + "']"); 		// get next section
			this.$nextSlide 		= this.$nextSection.find('.fp-slide.active');   // check for slide
			this.$direction 		= direction; // store direction globally

			// if the next section is a slide, use that
			if ( this.$nextSlide.length != 0 ) {
				this.$nextSection = this.$nextSlide;
			}

			this._navOverlayScroll(true); // check for scroll
			this._runSectionEvents(); // run animations, videos, etc.

			// store that the full page is hidden in history
            browserHistory && window.history.replaceState({ section: nextIndex, slide: 0 }, null, '');

		},

		/**
		 * When section is completely entered
		 */
		afterLoad: function(anchorLink, index) {},

		/**
		 * Runs after fullpage is rendered
		 * Slimscroll events, set image heights, prev/next click event binding
		 * Css to fix ajax bug
		 */
		afterRender: function() {

            if ( this.$mobileDevice == false ) {
                $('.yt-video-section').ytBackground(); // where idOfYourVideo is the YouTube ID.
            }

			if ( history.state && this.$ajax ) {
				if ( 'content' == history.state.goToSection || ( this.$el.hasClass('fullpage-hidden') && isNaN(history.state.goToSection) ) ) {
					this.slideFullPageUp(true);
				}
				if ( ! isNaN(history.state.goToSection) ) {
					$.fn.fullpage.setScrollingSpeed(0);
					$.fn.fullpage.moveTo(history.state.goToSection, history.state.goToSlide);
					$.fn.fullpage.setScrollingSpeed(this.options.scrollingSpeed*1000);
				}
			} else {
				if ( location.hash == '#page-content' ) {
					this.slideFullPageUp(true);
				}
			}

			this.$b.removeClass('hide-overflow-load'); // remove loading overflow class

			this.$currentSection 	= this.$sections.filter($( ".active" ));
			this.$currentSlide 		= this.$currentSection.find('.slide:first-child');

			this._runSectionEvents(false, true); // run events but don't run videos on load (other script runs this)
			this._stupidIEPointerBug(); // fix a stupid IE pointer bug
			this._navOverlayScroll();       // Slimscroll events (add navbar background if scrolling)
			this._setImageHeights(); 		// resize images to fit height
			this._previousNextButtons(); 	// Previous/Next Click Events

		},

		afterResize: function() {

			this._stupidIEPointerBug(); // fix a stupid IE pointer bug
			this._setImageHeights();	// set image heights to prevent overflow
			this.setAllowScrolling();	// check scrollbars

		},

		/**
		 * When slide is completely entered
		 */
		afterSlideLoad: function(index, slideIndex) {

            // store bas
			var base = this;

			if ( base.$currentSection.hasClass('slide') ) {
				$('.slide').not(base.$currentSection).addClass('adjust-height');
			}
		},

		/**
		 * When slide is left for another slide
		 * Updates viewport index and runs section events
		 */
		onSlideLeave: function(anchorLink, index, slideIndex, nextSlideIndex, direction) {

			var base = this, // store base

				// get next section
				currentParent	 		= $(".section[data-section='" + index + "']");
				base.$currentSection 	= currentParent.find("[data-slide='" + slideIndex + "']");
				base.$nextSection 		= currentParent.find("[data-slide='" + nextSlideIndex + "']");

			base._centerSlideshow(); // center slideshow if regular scrolling
			base._animationDelay(true); // turn on animation delay for slideshow no matter what
			base._runSectionEvents(true); // run videos, animations
			base._slideClass(false); // light or dark section
			base._animationDelay(false); // remove delay
			base._navOverlayScroll(true); // check for scroll

			$('.slide').removeClass('adjust-height');

			// store that the full page is hidden in history
            browserHistory && window.history.replaceState({ section: index, slide: nextSlideIndex}, null, '');

		},

		_centerSlideshow: function() {
			if ( ! this.options.autoScrolling ) {
				var $viewport = $('html, body');

                $viewport.animate({ scrollTop: this.$currentSection.offset().top }, 500, "easeOutQuint")
                	.bind("scroll mousedown DOMMouseScroll mousewheel keyup", function (e) {
                        if (e.which > 0 || e.type === "mousedown" || e.type === "mousewheel") {
                            $viewport.stop()
                            // This identifies the scroll as a user action, stops the animation, then unbinds the event straight after
                            .unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
                        }
                	});
				this.$topNav.twNavBackground(false); // remove background
			}
		},

		_animationDelay: function(delay) {

			// store
			var base = this;

			// if delay is turned on
			if (delay) {
				// check for option, add delay option
				base.animDelay = ( base.options.addScrollDelay ) ? base.options.itemDelay : 0;
			} else {
				// make sure to keep on if autoscrolling is on
				base.animDelay = ( base.options.addScrollDelay && base.options.autoScrolling ) ? base.options.itemDelay : 0;
			}

		},

		/**
		 * Destroys fullpage instance and html
		 */
		destroyFullPage: function() {

			// only destroy if it exists
			if ( $('#fullpage').length > 0 ) {
				$.fn.fullpage.setAllowScrolling(false);  // turn off scrolling
				$.fn.fullpage.destroy('all'); // destroy everything
				this.$w.off('mousewheel'); // remove mousewheel events
				this.$w.off('swipeup');	// remove swipeup events
			}

		},

		/**
		 * Checks to see if autoscrolling should be enabled
		 * Run on resize and during fullpage slideup events
		 */
		setAllowScrolling: function() {

			var base = this, // store base
				fullHeight = base.$fullpageWrapper.height(); // get fullpage height

			// if auto scrolling is enabled, disable
			// on resize, if below specific viewport, disable but add scrollbars
			if ( base.options.autoScrolling ) {
				if ( base.$fullpageHidden ) {

					// disable auto scrolling
					$.fn.fullpage.setAllowScrolling(false);
					base.setOverflow(true);

					// if responsive size
					if ( base.$el.hasClass('fp-responsive') ) {
						// show fullpage wrapper again
						base.$fullpageWrapper.css({ 'marginTop' : 0 });
					// if not responsive size
					} else {
						// hide fullpage wrapper again
						base.$fullpageWrapper.css({ 'marginTop' : -fullHeight }) && base.$w.scrollTop();
					}

				// if fullpage is showing again
				} else {
					if ( base.$el.hasClass('fp-responsive') ) {
						$.fn.fullpage.setAllowScrolling(false);
					} else {
						$.fn.fullpage.setAllowScrolling(true);
					}
				}
			}

		},

		/**
		 * Slides full page up to reveal main content
		 */
		slideFullPageUp: function(silent) {

			var base 		= this, // store base
				fullHeight 	= base.$fullpageWrapper.height(),
				silent 		= typeof silent !== 'undefined' ? silent : false,
				scrollspeed = !silent ? base.options.scrollingSpeed : 0.01; // get fullpage height

            // fade out fullpage and set document scroll properties
            function fadeItOut() {

                base.fullPageDisplay(false); // adjust css display properties
                base.$topNav.twNavBackground(false); // remove background from nav
                base.$fullpageHidden = true;  // set flag
                base.setAllowScrolling(false); // disable scrolling

            }

			if ( base.options.autoScrolling ) {

				base.$b.removeClass('fullpage-showing');

				// set correct background
				if ( base.$contentSection.hasClass('dark-section') ) {
					base.$b.addClass('dark-section');
				} else {
					base.$b.removeClass('dark-section');
				}

				// slide up fullpagewrapper
				TweenMax.to(base.$fullpageWrapper, scrollspeed, {marginTop:-fullHeight, ease:Power1.easeOut });
				// slide up navigation dots
				TweenMax.to('#fp-nav', scrollspeed, {y: -fullHeight, ease:Power1.easeOut, onComplete: fadeItOut});

				window.scrollTo(0,0);

			} else {
				// if there's a content section, scroll to content section
				if (base.$contentSection.length > 0) {
					var topOffset = base.$topNav.offset().top - base.$w.scrollTop();
					$('html, body').animate({scrollTop:base.$contentSection.offset().top - (base.$topNav.height() + topOffset)}, scrollspeed*1000, 'easeOutCubic');
				}

			}

		},

		/**
		 * Slides full page back down to hide main content
		 */
		slideDownDetect: function() {
			var base = this;

			// if autoscrolling is enabled
			if ( base.options.autoScrolling ) {
				// cross browser mousewheel events
				base.$w.on('mousewheel', function(event) {
					base.$w.scrollTop() == 0 && event.deltaY == 1 && base.slideFullPageDown();
				});

				base.$w.on('swipeup', function(e){
					if ( base.$w.scrollTop() == 0 ) {
						base.slideFullPageDown();
					}
				});

				// adjust for mac scrolling
				if (base.$b.hasClass('osx')) {
					base.$w.scroll(function(){
						base.$w.scrollTop() == 0 && base.slideFullPageDown();
					});
				}
			}
		},

		/**
		 * Slides fullpage back down into view
		 */
		slideFullPageDown: function() {
			var base = this,
				lastSection = base.$lastSection;

            // re-enable fullpage events function
            function reEnableScroll() {
                base.$fullpageHidden = false;
                var reEnable = setTimeout(function(){
                    base.setAllowScrolling();
                }, 500);
                base.$topNav.themewichBackgroundDetect('.section');
            }

            // if not regular scroll and it's hidden
			if ( base.options.autoScrolling ) {
				if ( base.$fullpageHidden && ! base.$el.hasClass('fp-responsive') ) {

					// remove click events
					base.$w.off('swipeup');
					base.$w.off('mousewheel');

					// Show fullpage again
					base.fullPageDisplay(true);

					// If last section are slides, find last active slide
					if ( base.$lastSection.find('.slide').length > 0 ) {
						lastSection = base.$lastSection.find('.slide.active');
					}

					base.$currentSection = base.$lastSection;
					base.$prevSection = base.$contentSection;
					base._runSectionEvents(true);

					this.$b.addClass('fullpage-showing');

					// slide in
					TweenMax.to(base.$fullpageWrapper, base.options.scrollingSpeed, {marginTop: 0, ease:Power1.easeOut, onComplete : reEnableScroll});
					TweenMax.to('#fp-nav', base.options.scrollingSpeed, {y: 0, ease:Power1.easeOut});
				}
			}
		},

		/**
		 * Adjusts html and body css once fullpage is slid up
		 */
		fullPageDisplay: function(display) {
			var base = this;


			if ( display ) {
				// re-add heights
				base.setOverflow(false);

				// set fullpage hidden flag to false
				base.$fullpageHidden = false;

				if ( base.$ajax ) {
					// store that the full page is hidden in history
                    browserHistory && window.history.replaceState({ section: base.$section_number-1, slide: 0 }, null, '');
				} else {
					// set location hash for non-ajax
					location.hash = base.$section_number-1;
				}

			} else {

				// move to last slide
				$.fn.fullpage.setScrollingSpeed(0);
				$.fn.fullpage.moveTo(base.$section_number-1);
				$.fn.fullpage.setScrollingSpeed(this.options.scrollingSpeed*1000);

				if ( base.$ajax ) {
					// store that the full page is hidden in history
                    browserHistory && window.history.replaceState({ section: "content" }, null, '');
				} else {
					// set location hash for non-ajax
					location.hash = 'page-content';
				}

				// reset animations
				base._runAnimations(true);

				// set section flags
				base.$prevSection 		= base.$lastSection;
				base.$currentSection 	= base.$contentSection;
				base.$fullpageHidden 	= true;

				// run section events
				base._runSectionEvents(true);

				// add scrollbars
				base.setOverflow(true);

				// enable scrolling of full page back down
				base.slideDownDetect();
			}
		},

		setOverflow: function(overflow) {

			// store base
			var base = this;

			// switch on/off
			if (overflow) {
				base.$html
					.removeClass('overflow-hidden')
					.addClass('overflow-auto');
			} else {
				base.$html
					.removeClass('overflow-auto')
					.addClass('overflow-hidden');
			}

		},


		_slideClass: function(load) {
			var base = this;

			if (load) {
				$('.section .slide:first-child').each(function(){
					var slide = $(this),
						slideSection = slide.closest('.section');

					if ( slide.hasClass('dark-section') ) {
						slideSection.addClass('dark-section');
					} else {
						slideSection.removeClass('dark-section');
					}
				});
			} else {
				if ( base.$currentSection.hasClass('dark-section') ) {
					base.$currentSection.closest('.section').addClass('dark-section');
				} else {
					base.$currentSection.closest('.section').removeClass('dark-section');
				}
			}
		},

		/**
		 * Runs animations, videos and body classes
		 */
		_runSectionEvents: function(override, noVideos) {
			var base = this;

			base._specificEvents();
			base._runAnimations();
			base._runVideos(noVideos);
			base._runBodyClasses(override);
		},

		_specificEvents: function() {
			this.sectionOrSlide();

			if ( this.$indicator == 'slide') {
				this.slideEvents();
			} else {
				this.sectionEvents();
			}
		},

		sectionOrSlide: function() {

			// if there's a slide
			if (this.$nextSection) {
				if ( this.$nextSection.hasClass('slide') ) {
					this.$indicator = 'slide';
				} else {
					this.$indicator = 'section';
                }
            } else {
				if ( this.$currentSection.hasClass('slide') ) {
					this.$indicator = 'slide';
				} else {
					this.$indicator = 'section';
                }
            }

		},

		/**
		 * Events run specifically for sections
		 */
		sectionEvents: function() {
			this._navButtonsDisplay('show');
		},

		/**
		 * Events run specifically for slides
		 */
		slideEvents: function() {
			this._navButtonsDisplay('hide');
		},

		_navButtonsDisplay: function(display) {
			if (display == 'hide') {
				this.$b.addClass('has-arrows');
			} else {
				this.$b.removeClass('has-arrows');
			}
		},

		/**
		 * Sets up animations and calls separate functions for in and out
		 */
		_runAnimations: function(reset){
			var	base = this;

			// update variables before animating
			base._updateVars();
			// run animations if option is set
			base.options.animations && base._customAnimations(reset);
		},

		/**
		 * Runs video functions
		 */
		_runVideos: function(noVideos) {
			var base = this;

			base._html5Videos(); // run any html5 videos
			!noVideos && !base.$mobileDevice && base._youTubeVideos(); // run any youtube videos
		},

		/**
		 * Controls HTML5 videos play/pause
		 */
		_html5Videos: function() {
			var base = this,
				video = base.$currentSection.find('video.hosted-video'), // current video
				allVids = base.$sections.find('video.hosted-video'), // all videos
				otherVids = allVids.not(video); // other videos

			if ( ! base.$mobileDevice ) {
				var videoItem = video.get(0),
					otherVideoItems = otherVids.get(0);
				// play current video
				if ( videoItem ) {
					// run on canplay event in case it fires too soon
					videoItem.oncanplay = function() {
						videoItem.play();
					};
					videoItem.play();
				}

				if ( otherVideoItems ) {
					otherVideoItems.pause();
				}
			}
		},

		_setNavPadding: function() {
			var topHeight = $('.top-nav').outerHeight();

            $('.no-title').css({
                'padding-top': topHeight + 'px'
            });
			$('.section-entry').css({
				'padding-top': topHeight + 'px',
				'padding-bottom': topHeight + 'px'
			});

			$('.nextbutton').css({
				'bottom': topHeight/2 + 'px'
			});
		},

		/**
		 * Controls youtube play/pause
		 */
		_youTubeVideos: function() {
			var base = this,
				ytVid = base.$currentSection.find('.tubular-player'), // can't cache these due to ajax
				otherYtVids = $('.section').find('.tubular-player').not(ytVid); // can't cache these due to ajax

			if ( ytVid && ytVid.length > 0 && player[ytVid.attr('ID')]) {
				// if play video function exists, mute and play video
				player[ytVid.attr('ID')].playVideo && player[ytVid.attr('ID')].setVolume(0) && player[ytVid.attr('ID')].playVideo();
			}
			if ( otherYtVids.length > 0 ) {
				otherYtVids.each(function(){
					var playerID = player[$(this).attr('ID')];
					// pause video
					playerID && playerID.pauseVideo && playerID.pauseVideo();
				});
			}
		},

		/**
		 * Run custom animations set here
		 */
		_customAnimations: function(reset) {
			var base = this,
				otherSections = base.$sections.not(base.$currentSection).find('.v-item');

			if (base.options.autoScrolling) {
                if (reset) {
                    // reset other sections
                    TweenMax.set(base.$currentSection.find('.v-item'), {autoAlpha : 0}); // set opacity to 0 on all animation items
                } else {

					otherSections = otherSections.map(function() {
					    if($(this).css('opacity') != '0')
					        return this;
					}).get();

					// hide all other sections that are showing
					base.options.animations && TweenMax.to(otherSections, 1, {autoAlpha: 0});
					base._overlayAnimations(base.$currentSection).play();
				}
			} else {

				/* Ensure we only fade in once on scroll down */
				if ( ! base.$currentSection.hasClass('animated') ) {
					base._overlayAnimations(base.$currentSection).play();
					base.$currentSection.addClass('animated');
				}
			}
		},

		/**
		 * Main animations for text/image sections
		 */
		_overlayAnimations: function(items) {

			var base 		= this,
				itemTL 		= new TimelineMax({paused: true, delay:base.animDelay}), // set up a new timeline
				dWidth 		= items.find('.title-divider').attr('data-width'),
				staggerthing = '0',

				// animation elements
				image 		= items.find('.v-item.image-container'),
				divider 	= items.find('.v-item.title-divider'),
				title 		= items.find('.v-item.title'),
				subtitle 	= items.find('.v-item.subtitle'),
				content 	= items.find('.v-item.content'),
				buttons 	= items.find('.v-item.section-buttons');

				// stagger offset
				function addStagger(){
					staggerthing = '-=0.8';
				}

				/**
				 * Only adds to timeline if it exists,
				 * then adds a stagger for the first element
				 */
				function testAdd(thing, delay, from, to, staggerOverride) {
					var staggerLocal = staggerOverride ? staggerOverride : staggerthing;
					if ( thing.length > 0 ) {
						itemTL.fromTo(thing, delay, from, to, staggerLocal);
						addStagger();
					}
				}

				// Left/right image
				if ( items.find('.image-container').length > 0 && !items.hasClass('layout-center') ) {
					testAdd(image, 1, {autoAlpha: 0, x:-30 }, { autoAlpha:1, x:0, ease:Power4.easeOut });
				}

				// divider first
				testAdd(divider, 1, {autoAlpha: 1, width:0}, {width: dWidth, autoAlpha: 1, ease:Power4.easeOut});

				// title and content at same time if title exists
				// otherwise stagger content regularly
				testAdd(title, 1, {autoAlpha: 0, y:30, scale: 0.97}, {autoAlpha:1, scale:1, y:0, ease:Power4.easeOut});
				testAdd(content, 1, {autoAlpha: 0, y:-30, scale: 0.97}, {autoAlpha:1, scale: 1, y:0, ease:Power4.easeOut},  title.length ? '-=1' : staggerthing);

				// centered image
				if ( items.hasClass('layout-center') ) {
					testAdd(image, 1, {autoAlpha: 0, y:30, scale: 0.97}, {autoAlpha:1, scale:1, y:0, ease:Power4.easeOut});
				}

				// subtitle and buttons at same time if subtitle exists
				// otherwise stagger content regularly
				testAdd(subtitle, 1, {autoAlpha: 0, y:30, scale: 0.97}, {autoAlpha:1, scale:1, y:0, ease:Power4.easeOut});
				testAdd(buttons, 1, {autoAlpha: 0, y:-30, scale: 0.97}, {autoAlpha:1, scale: 1, y:0, ease:Power4.easeOut},  subtitle.length ? '-=1' : staggerthing);

			return itemTL;

		},

		/**
		 * Sets scrolling background for slimscroll events
		 */
		_navOverlayScroll: function(next) {

			var base 		= this, // store base
				section 	= base.$currentSection; // next or current section

			// if we should be getting the next section
			if ( next && base.$nextSection ) {
				section = base.$nextSection;
			}

			// if we should be getting the next slide
			if ( next && !base.$nextSection && base.$nextSlide ) {
				section = $nextSlide;
			}

			var scrollbar 	= section.find('.slimScrollBar'), // scrollbar selector
				sPos 		= parseFloat(scrollbar.css('top')); // scrollbar position;

			// reset old scrolling events
			base._navOverlayReset();

			// first check if scrollbar is not in top position
			// when scrolling up
			if ( base.$direction == 'up' && next && scrollbar.length > 0) {
				if (sPos > 5) {
					base.$topNav.twNavBackground(true);
				} else {
					base.$topNav.twNavBackground(false);
				}
			// if scrolling down eliminate no matter what
			} else {
				if (scrollbar.length > 0) {
					base.$topNav.twNavBackground(false);
				}
			}

			// bind scroll event
			section.bind('slimscrolling', function(e, pos){
				if (pos > 5) {
					base.$topNav.twNavBackground(true);
				} else {
					base.$topNav.twNavBackground(false);
				}
			});

		},

		/**
		 * Resets overlay so next section can start fresh
		 */
		_navOverlayReset: function() {
			var base = this;

			if ( base.options.autoScrolling ) {
				// unbind all sections
				base.$topNav.twNavBackground(false);
				$('.section, .slide').unbind('slimscrolling');
			}

		},

		/**
		 * Changes body class depending if light or dark
		 */
		_runBodyClasses: function(override) {
			var base = this;

			if ( base.options.autoScrolling ) {

				base._updateVars();

				if ( base.$currentSection && base.$currentSection.hasClass('dark-section') ) {
					base.$b.addClass('dark-section');
				} else {
					base.$b.removeClass('dark-section');
				}
			}
		},

		/**
		 * Previous or Next Button Click Events
		 */
		_previousNextButtons: function() {
			var base = this;

			// Next button click events
			base.$nextButtons.each(function(){
				var button = $(this),
					nextSection = button.closest('.section').next().attr('data-section');

				button.click(function(e){
					if ( button.hasClass('last-section') ) {
						base.slideFullPageUp();
					} else {
						base._animationDelay(true);
						$.fn.fullpage.moveTo(nextSection);
						base._animationDelay(false);
					}
					e.preventDefault();
				});
			});

			// Previous button click events
			base.$prevButtons.each(function(){
				var button = $(this),
					prevSection = button.closest('.section').prev().attr('data-section');

				button.click(function(e){
					$.fn.fullpage.moveTo(prevSection);
					e.preventDefault();
				});
			});

			base.$nextSlideButtons.each(function(){
				var button = $(this),
					currentSection = button.closest('.section').data('section'),
					nextSlide = button.closest('.slide').next().attr('data-slide');

				button.click(function(e) {
					if (nextSlide) {
						$.fn.fullpage.moveTo(currentSection, nextSlide);
					} else {
						$.fn.fullpage.moveTo(currentSection, 0);
					}
					e.preventDefault();
				});
			});
		},

		/**
		 * Sets image heights so they don't exceed
		 * height of window
		 */
		_setImageHeights: function() {

			var sideLayout 		= $('.layout-left, .layout-right'),
				sectionHeight 	= sideLayout.innerHeight(),
				paddingDiv 		= sideLayout.find('.section-entry'),
				sectionPadding 	= paddingDiv.css('padding-top') && paddingDiv.css('padding-bottom') ? parseInt(paddingDiv.css('padding-top').replace("px", ""))  + parseInt(paddingDiv.css('padding-bottom').replace("px", "")) : 0,
				sectionHeight 	= sectionHeight - sectionPadding - 100,
				sideImages 		= sideLayout.find('.fit-this-image img');

			this._centerImageResize();

			// if height is too small
			if ( sectionHeight < 300 ) {
				sectionHeight = 300;
			}

			// left and right layouts max height
			sideImages.css({
				'max-height' : sectionHeight + 'px'
			});

			// center transform fallback
			if ( this.$transforms ) {
				this.$sections.find('.text-cell, .image-cell').each(function(){
					var item = $(this),
						halfHeight = item.outerHeight/2;

					item.css({'margin-top': halfHeight + 'px'});
				});
			}

			// if we can't use viewheights
			if ( ! this.$html.hasClass('cssvwunit') && this.options.autoScrolling ) {
				this.$fullpageWrapper.css({
					'height' : $(window).height() + 'px'
				});
			}
		},

		_centerImageResize: function(){

			var centerLayout 	= $('.layout-center');

			centerLayout.each(function(){

				var section 		= $(this),
					sectionHeight 	= section.innerHeight(),
					textHeight 		= section.find('.text-layout-inner').outerHeight(),
					image 			= section.find('.fit-this-image img'),
					imageHeight 	= sectionHeight - textHeight;

				// if height is too small
				if ( imageHeight < 300 ) {
					imageHeight = 300;
				}

				image.css({
					'max-height' : imageHeight + 'px'
				});

			});
		},

		/**
		 * Adds additional nav bullet, click events and classes
		 */
		_additionalHTML: function() {
			var base = this,
				pageContent = $('.page-content-wrapper');

			// if autoscrolling is enabled
			if ( base.options.autoScrolling ) {

				// if there's only one section and page content
				// completely create navigation dots from scratch
				if ( base.$section_number == 1 && pageContent.length > 0 ) {
					base.$b.append('<div id="fp-nav" class="right nb-fixed"><ul><li><a href="#" class="active"><span></span></a></li><li><a href="#" class="go-to-content"><span></span></a></li></ul></div>');
				}

				// if there's a section and page content
				if ( pageContent.length > 0 && base.$currentSection ) {

					// check for existing go to content navigation
					if ( ! $('#fp-nav li a').hasClass('go-to-content') ) {
						var nav = $('#fp-nav');

						// Add navigation dot
						nav.find('ul').append('<li><a href="#" class="go-to-content"><span></span></a></li>');

						// adjust margin to account for new dot
						nav.css({
							'marginTop' : -(nav.outerHeight()/2)
						});
					}

					// Add click event for new dot
					$('a.go-to-content').click(function(){
						base.slideFullPageUp();
					});
				}

				// add class for slide out navigation
				$('#fp-nav').addClass('nb-fixed');

			} else {
				// remove padding from page title
				$('.image-title-bg').addClass('no-top-padding');
				// remove side nav (too glitchy yet)
				$('#fp-nav').remove();
			}
		},

		/**
		 * Detects scroll position and runs animations for
		 * regular content section
		 */
		_regularScrollEvents: function() {
			var base = this,
				contentSection = false;

			// if autoscrolling is disabled
			if ( ! base.options.autoScrolling ) {
				$(window).scroll(function () {
					var scrollTop = (document.documentElement.scrollTop ?
							document.documentElement.scrollTop :
							document.body.scrollTop);

					if (base.$contentSection.length) {
						var top = base.$contentSection.offset().top,
							height = base.$contentSection.outerHeight();

						// if content section is in view
						if (scrollTop > top - height/4 && ! contentSection) {
							base.$prevSection = base.$currentSection;
							base.$currentSection = $('.page-content-wrapper');
							base._runSectionEvents(true);
							contentSection = true;
						}
						// if content section is below viewport
						if (scrollTop < top - height/4 && contentSection) {
							base.$currentSection = base.$prevSection;
							base.$prevSection = $('.page-content-wrapper');
							base._runSectionEvents(true);
							contentSection = false;
						}
					}
				});
			}
		},

		/**
		 * Disables chromes new pull to refresh feature on fullpage pages
		 */
		disablePullRefresh: function() {
			window.addEventListener('load', function() {

				var preventPullToRefresh = true; // turn off pull to refresh
				var preventOverscrollGlow = false; // turn off overscroll glow

				var maybePreventPullToRefresh = false;
				var lastTouchY = 0;

				/**
				 * Touchstart Event
				 */
				var touchstartHandler = function(e) {

					if (e.touches.length != 1) return;
					
					lastTouchY = e.touches[0].clientY;
					    // Pull-to-refresh will only trigger if the scroll begins when the
					    // document's Y offset is zero.
					    maybePreventPullToRefresh =
					        preventPullToRefresh &&
					        window.pageYOffset == 0;
				}

				/**
				 * Touchmove event
				 */
				var touchmoveHandler = function(e) {
	    			var touchY 		= e.touches[0].clientY;
	    			var touchYDelta = touchY - lastTouchY;
	    
	    			lastTouchY = touchY;

	    			// To suppress pull-to-refresh it is sufficient to preventDefault the
				    // first overscrolling touchmove.
				    if (maybePreventPullToRefresh) {
						maybePreventPullToRefresh = false;
						if (touchYDelta > 0) {
							e.preventDefault();
							return;
						}
				    }

				    if (preventOverscrollGlow) {
						if (window.pageYOffset == 0 && touchYDelta > 0) {
							e.preventDefault();
							return;
						}
				    }
	  			}

				document.addEventListener('touchstart', touchstartHandler, false);
				document.addEventListener('touchmove', touchmoveHandler, false);
			});
		},

		/**
		 * Fixes the stupidest IE bug in the world
		 * where a mouse move event is being interpreted as touch
		 */
		_stupidIEPointerBug: function() {

			document.addEventListener("pointermove",handleMove,false);
			document.addEventListener("MSPointerMove",handleMove,false);

			function handleMove(evt) {
				// set timeout to enable co-operative multi-tasking
				setTimeout(function(){
					switch (evt.pointerType) {
						case 'mouse':
							$(document).off('pointerdown');
							$(document).off('pointermove');
						break;
						case 4:
							$(document).off('MSPointerDown');
							$(document).off('MSPointerMove');
						break;
					}
				}, 0);

				// remove event listeners
				document.removeEventListener("pointermove",handleMove,false);
				document.removeEventListener("MSPointerMove",handleMove,false);
			}

		}

	});

	// A really lightweight plugin wrapper around the constructor,
	// preventing against multiple instantiations and allowing any
	// public function (ie. a function whose name doesn't start
	// with an underscore) to be called via the jQuery plugin,
	// e.g. $(element).themewichFullPage('functionName', arg1, arg2)
	$.fn[pluginName] = function ( options ) {
		var args = arguments;

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

				if (instance instanceof Plugin && typeof instance[options] === 'function') {
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

(function ($) {
	"use strict";

	/**
	 * Converts html image to full fixed background
	 * @since 1.0
	 */
	$.fn.parallaxImg = function(){
		$(this).each(function(){
			var $this 		= $(this),
				parallaxsrc = $this.attr('src'),
				captionDiv 	= $this.closest('.wp-caption');

			// If there's a caption set
			if (captionDiv.length) {
				captionDiv.removeClass('wp-caption').addClass('post-break has-caption').css('width', 'auto');
				$this.before('<span class="full-bg-image" style="background-image: url('+parallaxsrc+');"></span>');
			} else {
				$this.before('<span class="post-break"><span class="full-bg-image" style="background-image: url('+parallaxsrc+');"></span></span>');
			}
			$this.remove();

			function setWidth() {
				var postWidth 	= $('.post-break').outerWidth(),
					windowWidth = $(window).width(),
					padding 	= ((windowWidth - postWidth)/2) + 30;

				$('.full-bg-image').css({
					'margin-left': -padding + 'px',
					'margin-right': -padding + 'px',
					'padding-left' : padding + 'px',
					'padding-right' : padding + 'px'
				});
			}

			setWidth();

			$(window).resize(function(){
				setWidth();
			});
		});
	};

    /**
     * Tests scroll position for background nav change
     * @since 1.0
     */
	$.fn.themewichBackgroundDetect = function() {
        var $w 		= $(window),
			$topNav = $('.top-nav');

		function detect() {
			var y_scroll_pos = window.pageYOffset;
			if (y_scroll_pos > 5) {
				$topNav.twNavBackground(true);
			} else {
				$topNav.twNavBackground(false);
			}
		}

		detect();

		// add background during regular scroll
		if ( $('#fullpage').hasClass('scrolling-auto') ) {
			var scrolling = 'scroll';
		} else {
			var scrolling = 'scroll touchmove';
		}

		$w.on(scrolling, function(){
			detect();
		});

	};

	/**
	 * Uses javascript to submit search terms to prevent empty searches
	 * @since 1.0
	 */
	$.fn.searchSubmit = function() {

		$(this).each(function() {
			var $this    	 = $(this),
				searchbox    = $this.find('input'),
				searchForm   = $this.find('form'),
				submitBtn    = $this.find('.searchbutton');

			function validate(){
			  if (searchbox.val().length > 0) {
				searchForm.submit();
			  }
			}

			$this.on('click', function() {
				searchbox.focus();
			});

			submitBtn.click(function(){
			  validate();
			});
		});

	};

	/**
	 * Calls lightbox links
	 * @since 1.0
	 */
	$.fn.themewichLightbox = function() {

		if(this.length == 0) return this; // if nothing supplied

		// create a namespace
		var lightbox 	= {};

		var el = $("a.themewich-lightbox").addClass('no-ajaxy');
		lightbox.el = el;

		lightbox.el.imageselectors = $(lightbox.el.selector + '[href*=".jpg"]')
			.add(lightbox.el.selector + '[href*="jpeg"]')
			.add(lightbox.el.selector + '[href*=".png"]')
			.add(lightbox.el.selector + '[href*=".gif"]');

		lightbox.el.inlineselectors = lightbox.el.not(lightbox.el.imageselectors).not('.open-popup-link');

		$('.open-popup-link').magnificPopup({
			type: 'inline',
			removalDelay: 500, //delay removal by X to allow out-animation
			fixedContentPos: false,
			fixedBgPos: true,
			tLoading: '<div class="loading"></div>',

			overflowY: 'auto',

			closeBtnInside: true,
			preloader: false,
			callbacks: {
				imageLoadComplete: function() {
				  var self = this;
				  setTimeout(function() {
					self.wrap.addClass('mfp-image-loaded');
				  }, 16);
				},
				close: function() {
				  this.wrap.removeClass('mfp-image-loaded');
				}
			},

			midClick: true,
			mainClass: 'mfp-zoom-in'
		});

        $('.popup-with-move-anim').magnificPopup({
            type :            'inline',
            fixedContentPos : false,
            fixedBgPos :      true,
            overflowY :       'auto',
            closeBtnInside :  true,
            preloader :       false,
            midClick :        true,
            removalDelay :    300,
            mainClass :       'my-mfp-slide-bottom'
        });


        lightbox.el.imageselectors.magnificPopup({
            type :           'image',
            closeBtnInside : true,
            tLoading :       '<div class="loading"></div>',
            mainClass :      'mfp-zoom-in',
            removalDelay :   500, //delay removal by X to allow out-animation

            image : {
				tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
				titleSrc: function(item) {
				  return item.el.find('img').attr('title');
				},
				 markup: '<div class="mfp-figure">'+
				'<div class="mfp-close"></div>'+
				'<div class="mfp-img"></div>'+
				'<div class="mfp-bottom-bar">'+
				  '<div class="mfp-title-wrapper"><div class="mfp-title"></div></div>'+
				  '<div class="mfp-counter"></div>'+
				'</div>'+
			  '</div>' // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
			},
			callbacks : {
				imageLoadComplete: function() {
				  var self = this;
				  setTimeout(function() {
					self.wrap.addClass('mfp-image-loaded');
				  }, 16);
				},
				close: function() {
				  this.wrap.removeClass('mfp-image-loaded');
				}
			},
			closeOnContentClick: true,
			midClick: true
		});

		// Inline popups
	    lightbox.el.inlineselectors.magnificPopup({
            disableOn :       700,
            closeBtnInside :  true,
            tLoading :        '<div class="tw-loading"></div>',
            type :            'iframe',
            mainClass :       'mfp-fade',
            removalDelay :    160,
            preloader :       false,
            fixedContentPos : false
	    });

		$('.gallery').each(function() {

			$(this).magnificPopup({
                delegate :       'a.lightbox-gallery:not(.bx-clone a.lightbox-gallery)',
                type :           'image',
                closeBtnInside : true,
                tLoading :       '<div class="loading"></div>',
                mainClass :      'mfp-zoom-in',
                removalDelay :   500, //delay removal by X to allow out-animation
                gallery : {
                    enabled :            true,
                    navigateByImgClick : true,
                    preload :            [0, 1] // Will preload 0 - before current, and 1 after the current image
                },
                image : {
                    tError :   '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    titleSrc : function (item) {
                        return item.el.find('img').attr('alt');
                    },
                    markup :   '<div class="mfp-figure">' +
                               '<div class="mfp-close"></div>' +
                               '<div class="mfp-img"></div>' +
                               '<div class="mfp-bottom-bar">' +
                               '<div class="mfp-title-wrapper"><div class="mfp-title"></div></div>' +
                               '<div class="mfp-counter"></div>' +
                               '</div>' +
                    '</div>' // Popup HTML markup. `.mfp-img` div will be replaced with img tag, `.mfp-close` by close button
                },
                callbacks : {
                    imageLoadComplete : function () {
                        var self = this;
                        setTimeout(function () {
                            self.wrap.addClass('mfp-image-loaded');
                        }, 16);
                    },
                    close :             function () {
                        this.wrap.removeClass('mfp-image-loaded');
                    }
                },
				closeOnContentClick: true,
				midClick: true
			});
		});
	};

    /**
     * Utility function to add background class
     * @param s true/false boolean to add/remove class
     */
    $.fn.twNavBackground = function (s) {
        var $this = $(this);

        if (s) {
            $this.addClass('has-background');
        } else {
            $this.removeClass('has-background');
        }
    };

	/**
	 * Responsive slider object
	 * @type {class}
	 */
	var themewichSlider = {

		createSlider : function(selector, callback) {

			$(selector).each(function(index) {

				// Get Options from HTML
				var $this 			= $(this),
					$info 			= $this.closest('.info'),
					$touch			= ($info.hasClass('postphoto')) ? false : true,
					$window 		= $(window),
					autoPlay 		= $info.hasClass('autoplay') ? true : false,
					pauseDelay 		= 5000,
					custompager 	= $info.attr('data-pager') ? $info.attr('data-pager') : false,
					pauseDelay 		= $info.attr('data-pause') ? parseInt($info.attr('data-pause'), 10) : pauseDelay,
					pauseDelay 		= $info.hasClass('random') ? (Math.floor(Math.random()*10001) + 3000) : pauseDelay,
					speedDelay 		= $info.attr('data-speed') ? parseInt($info.attr('data-speed'), 10) : 500,
					pagerOption 	= $info.attr('data-pager') == 'false' ? false : true,
					pagerOption 	= $info.find('.bxslider li').length > 1 ? pagerOption : false,
					controls		= $info.hasClass('nocontrols') 	? false : true,
					customNext 		= $info.attr('data-next') ? $info.attr('data-next') : null,
					customPrev		= $info.attr('data-prev') ? $info.attr('data-prev') : null,
					carousel 		= $info.hasClass('carousel') ? true : false,
					moveSlides 		= $info.attr('data-moveslides') ? $info.attr('data-moveslides') : 0,
					autoHover 		= $info.hasClass('hovergo') ? false : true,
					homeslideshow 	= $info.hasClass('homeslideshow') ? true : false,
					slideWidth 		= $info.attr('data-width') ? $info.attr('data-width') : 320,
					slideMode		= 'fade',
					infiniteLoop 	= $info.attr('data-loop') ? $info.attr('data-loop') : false,
					slideMode 		= $info.hasClass('horizontal') ? 'horizontal' : slideMode,
					carouselMargin 	= $info.attr('data-space') ? $info.attr('data-space') : 0,
					slideMode 		= $info.hasClass('vertical') ? 'vertical' : slideMode,
					adaptive 		= $info.hasClass('noadapt') ? false : true;

				/**
				 * Carousel Slider
				 * @since v1.0
				 */
				function carouselSlider() {
					var slideMargin 	= 4,
						totalSlideWidth = slideWidth + slideMargin,
						noWide 			= $('body').hasClass('full-width');

					$this.bxSlider({
						//Options
						adaptiveHeight: adaptive,
						minSlides: 		1,
						maxSlides: 		9,
						moveSlides: 	moveSlides,
						auto: 			autoPlay,
						speed: 			speedDelay,
						pause: 			pauseDelay,
						autoHover: 		autoHover,
						infiniteLoop:   infiniteLoop,
						nextSelector: 	customNext,
						prevSelector:   customPrev,
						nextText: 		'<i class="fa fa-angle-right"></i>',
						prevText: 		'<i class="fa fa-angle-left"></i>',
						slideWidth: 	slideWidth,
						slideMargin: 	slideMargin,
						pager: 			pagerOption,
						controls: 		controls,
						autoControls: 	false,
						useCSS: 		false, //Chrome gets buggy with this enabled
						touchEnabled: 	true,
						captions: 		false,
						preloadImages: 	'visible',

						//After Slider Load
						onSliderLoad: function() {

							// Closest info container
							$info = $this.closest('.info');

							// Fade in and add overlay effect
							$this.animate({'opacity': 1}, 500, 'easeOutCubic');

							// Fade In Controls
							$info.find('.bx-controls').animate({'opacity': 1}, 500);

							// Remove min-height and loading image
							$this
								.animate({'opacity': 1}, 500, function() {
									$this.closest('div.info')
										.css({
											'min-height': '100px',
											'background': 'none'
										});
								});

							// Fix popup issue with cloned slides
							var $clones 	= $this.find('.gallery-icon.bx-clone'),
								$noclones 	= $this.find('.gallery-icon').not('.gallery-icon.bx-clone');

								$clones.click(function(e) {
									var $clickedHref = $(this).find('a').attr('href');

									$noclones.each(function() {
										var $link = $(this).find('a');
										if ($link.attr('href') == $clickedHref) {
											$link.click();
										}
									});
									e.preventDefault();
								});

							// Callback Function
							if (callback && typeof(callback) === "function") {
								callback();
							}
						}
					});
				}


				/**
				 * Regular Slider
				 * @since v1.0
				 */
				function regularSlider() {

					$this.bxSlider({
							// Options
							adaptiveHeight: adaptive,
							mode: 			slideMode,
							auto: 			autoPlay,
							speed: 			speedDelay,
							pause: 			pauseDelay,
							pager: 			pagerOption,
							pagerCustom:	custompager,
							touchEnabled: 	$touch,
							autoHover:  	autoHover,
							controls: 		controls,
							captions: 		false,
							responsive: 	true,
							preloadImages: 'visible',
							onSlideBefore: function($slideElement, oldIndex, newIndex){ },
							onSliderLoad: function(currentIndex) {

								// Closest info container
								$info = $this.closest('.info');

								// Fade In Controls
								$info.find('.bx-controls').animate({'opacity': 1}, 500);

								// Remove min-height and loading image
								$this
									.animate({'opacity': 1}, 500, function() {
										$this.closest('div.info')
											.css({
												'min-height': '',
												'background': 'none'
											});
									});

								if (callback && typeof(callback) === "function") {
									callback();
								}
							}
						});

				}


				/**
				 * Centers the slide text vertically
				 * @param  {selector} $info Selector for the slide options
				 * @return {void}
				 */
				function centerTextSlide($info) {
					if ($info.hasClass('titlerotator') && $info.hasClass('noadapt')) {
						var $maxheight = $this.closest('.pagetitle').height();
						$this.children('li').each(function() {
							var $originalHeight = $(this).height();
							$(this).css('padding-top', ($maxheight-$originalHeight)/2);
						});
					}
				}


				/**
				 * Slider initialization
				 */
				if (carousel) {
					carouselSlider();
				} else {
					regularSlider();
				}

			});
		}
	};


	/**
	 * jQuery Isotope Class
	 * @since  v1.0
	 */
	if($.fn.isotope) {

		var themewichIsotope = {

			initVars : function(selector) {
				var base = this;

				base.$selector = $(selector);
			},

			/**
			 * Regular fixed-column isotope
			 * @param  {string}   selector Container selector
			 * @param  {Function} callback Callback function
			 * @since v1.0
			 * (c) Copyright 2013 Andre Gagnon - http://themewich.com
			 */
			loadIsotope : function(selector, callback) {
				var base = this;

				// get vars
				base.initVars(selector);

					var $this 		= base.$selector,
						sizer 		= $this.find('.grid-sizer')[0];

					/**
					 * Run Isotope plugin
					 */
					function runIsotope() {
						$this.isotope({
							itemSelector : '.isobrick',
							layoutMode: 'masonry'
						});
					}

					// Run on load
					runIsotope();

                    var iso             = $this.data('isotope'),
                        itemSelector    = iso.options.itemSelector,
                        gridImages      = imagesLoaded(".isobrick img");

                    // if there are images
                    if ( gridImages.images.length ) {
                        gridImages.on("progress", function (imagesLoadedInstance, image) {

                            var $item = $(image.img).closest(itemSelector);

                            $item.addClass('fade-in');

                            runIsotope();
                        });
                    }

                    $(itemSelector).not(":has(img)").addClass('fade-in');

					// relayout on resize
					$(window).resize(function(){
						runIsotope();
					});

					// add infinitescroll
					base.infiniteScroll($this);

					// add filter functionality
					base.filterClicks();

			},

			/**
			* Filter link when clicked
			* @return false
			*/
			filterClicks : function(){
				var base = this,
					filters = $('#filters a');

                filters.click(function () {
                    var $thisfilter = $(this),
                        $selector = $thisfilter.data('filter');

                    filters.removeClass("active");
                    $thisfilter.addClass("active");

                    if ($selector != '*') {
                        $selector = '.filter-' + $selector;
                    }

                    base.$selector.isotope({filter : $selector});
                    return false;
                });
			},

			/**
			 * Runs infinite scroll
			 * @return {void}
			 */
			infiniteScroll : function($selector) {
				// check if infinite scroll is a function
				if ( ! $.fn.infinitescroll ) {
					return false;
				}

				var base 		= this,
					loadingBG 	= $('.loading.ajax-loader').css('background-image'),
                    infPaginate = $('.infinite-pagination'),
					maxPages	= infPaginate.data('max'),
                    currPage    = infPaginate.data('current'),
					count 		= 1;

				// only do this on first page since infinite scroll 
				// can't handle pagination from page 2 onward
				if ( 1 != currPage ) {
					return false;
				}

				// use theme's loading background if it exists
				if ( loadingBG ) {
					loadingBG = loadingBG.replace('url(','').replace(')','').replace('"','').replace('"','');
				} else {
					loadingBG = agAjax.get_template_directory_uri + '/images/loaders/puff.svg';
				}

				$selector.infinitescroll({
                        navSelector:  '.more-posts',    // selector for the paged navigation
                        nextSelector: '.more-posts a',  // selector for the NEXT link (to page 2)
                        itemSelector: '.struckcontainer .isobrick',     // selector for all items you'll retrieve
                        maxPage:      maxPages,
                        behavior:     "twitter",
                        infid:        0,
                        debug:        false,
                        loading:      {
                            finishedMsg: '',
                            img:         loadingBG,
                            msgText:     ''
                        },
                        state: {
                            isDuringAjax: false,
                            isInvalidPage: false,
                            isDestroyed: false,
                            isDone: false, // For when it goes all the way through the archive.
                            isPaused: false,
                            currPage: currPage
                        }
                    },

					// re-call Isotope as a callback
					function( newElements, opts ) {
						var $newElements = $(newElements).hide(), // hide to begin with
							newFilters = {},
							newFilterString = '';

						// get new filters
						$newElements.each(function(){
							newFilters = $.extend({}, $(this).data( 'filter' ), newFilters)
						});

						$.each( newFilters, function( key, value ) {
							// if filter doesn't already exist, append to the end
							if ($('.filter a[data-filter="' + key + '"]').length == 0) {
								newFilterString +=
									'<li>' +
										'<a href="#" class="no-ajaxy" data-filter="' + key + '">' +
											value +
										'</a>' +
									'<li>';
							}
						});

						// hide before loading
						var $newFilterString = $(newFilterString).hide();
						// append
						$('ul.filter').append($newFilterString);

						// add filter click functionality to new items
						base.filterClicks();

						/**
						 * Append content to isotope container
						 * once the images have loaded
						 */
						$newElements.imagesLoaded(function(){

							$newFilterString.fadeIn(1000); // fade in new filter
							$newElements.show().addClass('fade-in'); // fade in when ready

							$selector.isotope( 'insert', $newElements, function(){
								$.fn.ajaxify && $('body').ajaxify(); // Ajaxify new items
								count++;

                                // fix pesky chrome bug with background images
                                $newElements.find('.full-bg-image').css('outline','1px solid transparent');

								var page = opts.state.currPage + 1,
									href = opts.path[0];

								$('.more-posts a').attr('href', href + page);

								// Fade in more posts button again if there are more pages
								if (count < maxPages) {
									$('.more-posts a').fadeIn(500);
								}
							});
						});
					}
				);


				/**
				 * Gets More Posts
				 */
				$('.more-posts a').click(function(e){

					var current = $(this).closest('.infinite-pagination').data('current');

					// only do this on first page since infinite scroll 
					// can't handle pagination from page 2 onward
					if ( 1 == current ) {
						e.preventDefault();
					
						// hide button when clicked
						$(this).hide();

						// replace browser history state
	                    browserHistory && window.history.replaceState({
	                        section: 'content',
	                        page: $(this).parent().data('next-page')
	                    }, null, $(this).attr("href"));
                    }

				});

			}
		}
	}


	/**
	 * Sets correct body class for page background
	 * on non-fullpage pages
     * @since 1.0
	 */
	$.fn.detectImageBackground = function(){
		var $body = $('body'),
			bgArea = $(this);

		if ( ! bgArea.hasClass('has-sections') ) {
			bgArea.hasClass('dark-section') && $body.addClass('dark-section');
		} else {
			$body.removeClass('dark-section');
		}
	};

    /**
     * Adds top padding to account for nav bar
     * @since 1.0
     */
    $.fn.themewichTopPadding = function () {
        var $this = this;

        function sizeTop() {
            var height = $('.top-nav').outerHeight();

            $this.css({
                'paddingTop' : height
            });
        }

        sizeTop();
        $(window).resize(function () {
            sizeTop();
        });
    };

	/**
	 * Like It Button
	 * @since  v1.0
	 */
    $.fn.themewichLike = function () {

        var postlike = $(this);

        // Prevent default
        postlike.click(function (e) {
            e.preventDefault();
        });

        // Only run once per page load
        postlike.one('click', function (e) {

            e.preventDefault();

            var heart       = $(this),
                post_id     = heart.data("post_id"),
                counter     = heart.find(".count"),
                title       = heart.find('.sharetitle'),
                clicked     = title.attr('data-clicked');

            // Add bouncing animation
            counter.addClass('bounceinfinite');

            $.ajax({
                type :    "post",
                url :     agAjax.ajaxurl,
                data :    "action=post-like&nonce=" + agAjax.nonce + "&post_like=&post_id=" + post_id,
                success : function (count) {
                    if (count != "already") {
                        counter.removeClass('bounceinfinite');
                        title.html(clicked);
                        heart.addClass("voted");
                        counter.text(count);
                    }
                }
            });

            return false;
        });
    };

	/**
	 * Shares Counter
	 * @since  v1.0
	 */
	$.fn.themewichShareCount = function() {

		var shareLink   = $(this),
			shareButton = $('.sharing a.share');

		// Only run once per page load
		shareLink.on('click', function(){

			var post_id 		= shareButton.data("post_id"),
				shareCounter 	= shareButton.find(".count"),
				title 			= shareButton.find('.sharetitle'),
				clicked 		= title.attr('data-clicked');

			// Add bouncing animation
            shareCounter.addClass('bounceinfinite');

            $.ajax({
                type :    "post",
                url :     agAjax.ajaxurl,
                data :    "action=post-share&nonce=" + agAjax.nonce + "&post_share=&post_id=" + post_id,
                success : function (count) {
                    shareCounter.removeClass('bounceinfinite');
                    title.html(clicked);
                    shareButton.addClass("shared");
                    shareCounter.text(count);
                }
            });

		});
	};

	/**
	 * Initialize all scripts here
	 *
	 * Comment out script lines to remove functionality
	 */
	$.fn.themewichScripts = function() {

		// lightbox
		if ($.fn.magnificPopup) {
			$('body').themewichLightbox();
		}

        // responsive videos
		if ($.fn.fitVids) {
			$('body').fitVids();
		}

        // slide out navigation
		$('#slide-menu').navBurger({
			clone: false, // don't clone, but move instead
			wrapInside: '#sitecontainer',  // wrap inside site container
			customDiv: '.tw-slide-panel', // add to custom div for widget areas
			customDivMenuLocation: '.tw-slide-menu' // custom menu location inside div
		});

        // ajaxify body
		if ($.fn.ajaxify) {
			$('body').ajaxify();
		}

        // dropdown navigation
		if ($.fn.superfish) {
			$('ul.sf-menu').superfish({ cssArrows: true });
		}

        // validate contact and comment forms
		if ($.fn.validate) {
			$("#contactform").validate();
			$("#quickform").validate();
			$("#commentsubmit").validate();
		}

        // sliders
		if ($.fn.bxSlider && $('ul.bxslider').length) {
			themewichSlider.createSlider('ul.bxslider');
		}

        // isotope
		if ($.fn.isotope) {
			if ($('.isotopecontainer.struckcontainer').length) {
				themewichIsotope.loadIsotope('.isotopecontainer.struckcontainer');
			}
		}

        // like and share
		$('a.post-like').themewichLike();
		$('#share-box a').themewichShareCount();

		// create any parallax images
		$('.backgroundsize .regular-width img.fullimg, .backgroundsize .full-width img.fullimg').parallaxImg();

        // search form submit via javascript
		$('.search-form').searchSubmit();

        // detect scrolling and add background
		$('.top-nav').themewichBackgroundDetect();

        // detects if nav should be light/dark on page load
		$('.page-content-wrapper').detectImageBackground();

        // run fullpage sections with options
		var fp = $('#fullpage'),
			scrolling = fp.hasClass('scrolling-regular') ? false : true;

        fp.themewichFullPage({
            'animations' : fp.hasClass('animations-off') ? false : true,
            'autoScrolling' : scrolling
        });

        // top padding of title areas to account for fixed navigation height
		$('.image-title-bg').themewichTopPadding();
	};

	$(document).ready(function() {
        // run scripts
		$('body').themewichScripts();
	});

})(jQuery);