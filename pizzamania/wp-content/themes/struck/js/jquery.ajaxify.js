/*-----------------------------------------------------------------------------------*/
/* Theme Ajax   */
/*-----------------------------------------------------------------------------------*/

// Ajaxify
// v1.0.1 - 30 September, 2012
// https://github.com/browserstate/ajaxify
//Version 1.5.1


(function(window,undefined){

	// Prepare our Variables
	var
		History = window.History,
		$ = window.jQuery,
		document = window.document;

	// Check to see if History.js is enabled for our Browser
	if ( !History.enabled ) {
		return false;  //abort
	}

	// Disable if modernizr doesn't detect history management
	if (!Modernizr.history) {
	    return false;  //abort
	}

    // if it hasn't loaded yet
    if ( !window.ajaxifyLoaded ) {
        window.ajaxifyLoaded = true;

        // Wait for Document
        $(function () {
            // Prepare Variables
            var
            /* Application Specific Variables */
            contentSelector = '#sitecontainer',
            $content = $(contentSelector).filter(':first'),
            contentNode = $content.get(0),
            $menu = $('#menu,#nav,nav:first,.nav:first').filter(':first'),
            activeClass = 'active selected current youarehere',
            activeSelector = '.active,.selected,.current,.youarehere',
            menuChildrenSelector = '> li,> ul > li',
            completedEventName = 'statechangecomplete',

            /* Application Generic Variables */
            $window = $(window),
            $body = $(document.body),
            $htmlBody = $('html, body'),
            rootUrl = History.getRootUrl();

            // Ensure Content
            if ($content.length === 0) $content = $body;

            // Internal Helper
            $.expr[':'].internal = function (obj, index, meta, stack) {
                // Prepare
                var
                    $this = $(obj),
                    url = $this.attr('href') || '',
                    isInternalLink;

                // Check link
                isInternalLink = url.substring(0, rootUrl.length) === rootUrl || url.indexOf(':') === -1;

                // Ignore or Keep
                return isInternalLink;
            };

            // HTML Helper
            var documentHtml = function (html) {
                // Prepare
                // replaces doctype, html head body tags with div
                var result = String(html).replace(/<\!DOCTYPE[^>]*>/i, '')
                    .replace(/<(html|head|body|title|script)([\s\>])/gi, '<div id="document-$1"$2')
                    .replace(/<\/(html|head|body|title|script)\>/gi, '</div>');
                // Return
                return result;
            };

            // Ajaxify Helper
            $.fn.ajaxify = function () {
                // Prepare
                var $this = $(this);

                // Ajaxify
                $this.find('a:internal:not(.no-ajaxy, .themewich-lightbox, .tw-lightbox, .more-posts a, .bx-prev, .bx-next, a[href^="#"], a[href*="wp-login"], a[href*="wp-admin"])').click(function (event) {
                    // Prepare
                    var
                        $this = $(this),
                        url = $this.attr('href'),
                        title = $this.attr('title') || null,
                        section = false,
                        slide = false;

                    // If it's a comment link continue as normal
                    if (url.toLowerCase().indexOf('#comment') >= 0) {
                        return true;
                    }

                    // Continue as normal for cmd clicks etc
                    if (event.which == 2 || event.metaKey) return true;

                    if (history.state) {
                        section = history.state.section;
                        slide = history.state.slide;
                    }

                    // add back button history on link
                    window.history.replaceState({goToSection: section, goToSlide: slide}, null, '');

                    // Ajaxify this link
                    History.pushState(null, title, url);
                    event.preventDefault();
                    return false;
                });
                // Chain
                return $this;
            };

            // Ajaxify our Internal Links
            $body.ajaxify();

            /**
             * If we're using anchor links
             * need normal back functionality since
             * history doesn't work with hash tags
             */
            $(window).bind('anchorchange', function (event) {

                var state = History.getState().hash,
                    states = History.savedStates,
                    prevUrlIndex = states.length - 2,
                    prevUrl = typeof(states[prevUrlIndex]) != "undefined" ? states[prevUrlIndex].hash : false,
                    hasHash = state.indexOf('#');

                if (prevUrl != false && prevUrl != window.location.pathname) {
                    window.location.reload();
                }
            });

            // Hook into State Changes
            $(window).bind('statechange', function () {
                // Prepare Variables
                var
                    State = History.getState(),
                    stateHash = History.getState().hash,
                    url = State.url,
                    relativeUrl = url.replace(rootUrl, '');
                windowHeight = $window.height() / 2 + 'px',
                    panelWidth = $('.tw-slide-panel').outerWidth();

                // reset navigation for white loading background
                $body.removeClass('dark-section');
                $('html').addClass('ajax-loading');

                $('#slide-menu').navBurger('closeMenu');
                // scroll menu container to top
                $('.tw-slide-panel').animate({ scrollTop: 0 }, 100);

                // scroll to top
                $htmlBody.animate({scrollTop: 0}, 800, "easeOutQuint", function () {
                    // make height 100% and overflow hidden
                    $htmlBody.addClass('overflow-hidden');
                })
                    .bind("scroll mousedown DOMMouseScroll mousewheel keyup", function (e) {
                        if (e.which > 0 || e.type === "mousedown" || e.type === "mousewheel") {
                            $htmlBody.stop()
                                // This identifies the scroll as a user action, stops the animation, then unbinds the event straight after
                                .unbind('scroll mousedown DOMMouseScroll mousewheel keyup');
                        }
                    });

                TweenMax.to('.tw-slide-panel', 0.8, {
                    autoAlpha:  0,
                    x:          panelWidth,
                    ease:       Power4.easeOut,
                    onComplete: afterOut
                });

                // Fadeout
                TweenMax.to($content.add('#fp-nav'), 0.8, {
                    autoAlpha:  0,
                    ease:       Power4.easeOut,
                    onComplete: afterOut
                });

                // After Fadeout Callback
                function afterOut() {

                    // Fade in loading image
                    TweenMax.fromTo('.ajax-loader', 0.8, {
                        autoAlpha: 0,
                        y:         60
                    }, {
                        autoAlpha: 1,
                        y:         0,
                        ease:      Power4.easeOut
                    });
                }

                // Ajax Request the Traditional Page
                Pace.track(function () {
                    $.ajax({
                        url:     url,
                        success: function (data, textStatus, jqXHR) {
                            // Prepare
                            var
                                $data = $(documentHtml(data)),
                                $dataBody = $data.find('#document-body:first ' + contentSelector),
                                bodyClasses = $data.find('#document-body:first').attr('class'),
                                adminBar = $data.find('#document-body').find('#wpadminbar'),
                                currentAdmin = $('body').find('#wpadminbar'),
                                contentHtml,
                                $scripts;

                            // Redo Superfish before adding
                            var $menu_list = $data.find('ul.sf-menu').superfish({cssArrows: true});
                            var $slidePanel = $data.find('.tw-slide-panel ').hide();
                            var $panelMenu = $slidePanel.find('nav');
                            //var $menu_mobile_list = $data.find('.mobilenavcontainer');

                            //Add classes to body
                            $('body').attr('class', bodyClasses);

                            // update admin bar
                            if (adminBar.length > 0 && currentAdmin.length > 0) {
                                currentAdmin.html(adminBar.html());
                            }

                            // Fetch the scripts in the body only
                            $scripts = $data.find('#document-body:first #document-script');
                            if ($scripts.length) $scripts.detach();

                            // Fetch the content
                            contentHtml = $dataBody.html() || $data.html();

                            if (!contentHtml) {
                                document.location.href = url;
                                return false;
                            }

                            //Append new menu HTML to provided classs
                            // For current menu item
                            $('.sf-menu').html($menu_list.html());
                            $('.sf-menu').ajaxify();

                            $('.tw-slide-panel').hide().html($slidePanel.html());

                            // Destroy fullpage instance
                            $('#fullpage').themewichFullPage('destroyFullPage');

                            // Update the content
                            $content.stop(true, true);
                            $content.css('opacity', 0).html(contentHtml);

                            $content
                                .ajaxify()
                                .css('text-align', '');

                            // Fade out loading animation
                            TweenMax.fromTo('.ajax-loader', 0.8, {
                                autoAlpha: 1,
                                y:         0
                            }, {
                                autoAlpha: 0,
                                y:         -60,
                                ease:      Power4.easeOut
                            });

                            // Adding cool fadein animation
                            TweenMax.to($content, 0.8, {
                                autoAlpha:  1,
                                ease:       Power4.easeOut,
                                onComplete: function () {

                                    // lets me double redundant here
                                    $('html').removeClass('ajax-loading').removeClass('overflow-hidden');
                                    $('body').removeClass('overflow-hidden');
                                }
                            });

                            TweenMax.to('.tw-slide-panel', 0.8, {
                                autoAlpha: 1,
                                ease:      Power4.easeOut
                            });


                            $htmlBody.removeClass('overflow-hidden');

                            // Update the title
                            document.title = $data.find('#document-title:first').text();
                            try {
                                document.getElementsByTagName('title')[0].innerHTML = document.title.replace('<', '&lt;').replace('>', '&gt;').replace(' & ', ' &amp; ');
                            }
                            catch (Exception) {
                            }

                            // Add the body scripts
                            $scripts.each(function () {

                                var $script = $(this), scriptText = $script.text(), scriptNode = document.createElement('script');

                                if ($script.attr('src')) {
                                    if (!$script[0].async) {
                                        scriptNode.async = false;
                                    }
                                    scriptNode.src = $script.attr('src');
                                }
                                try {
                                    // doesn't work on ie...
                                    scriptNode.appendChild(document.createTextNode(scriptText));
                                    contentNode.appendChild(scriptNode);
                                } catch (e) {
                                    // IE has funky script nodes
                                    scriptNode.text = scriptText;
                                    contentNode.appendChild(scriptNode);
                                }

                            });

                            // Inform Google Analytics of the change
                            if (typeof window.pageTracker !== 'undefined') window.pageTracker._trackPageview(relativeUrl);

                            // Inform Google Analytics of the change
                            if (typeof window._gaq !== 'undefined') {
                                window._gaq.push(['_trackPageview', relativeUrl]);
                            }

                            // Inform ReInvigorate of a state change
                            if (typeof window.reinvigorate !== 'undefined' && typeof window.reinvigorate.ajax_track !== 'undefined')
                                reinvigorate.ajax_track(url);// ^ we use the full url here as that is what reinvigorate supports
                        },
                        error:   function (jqXHR, textStatus, errorThrown) {
                            document.location.href = url;
                            return false;
                        }

                    }); // end ajax
                });

            }); // end onStateChange

        }); // end onDomLoad

    }
})(window); // end closure