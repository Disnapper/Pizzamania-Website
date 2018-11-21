/**
 * jQuery FullScreen Background Youtube Plugin
 * By: Andre Gagnon
 *
 * Based on the jQuery Tubluar Plugin by Sean McCambridge
 * http://www.seanmccambridge.com/tubular
 *
 * licensed under the MIT License
 */
;
(function($, window) {
    // test for feature support and return if failure
    // defaults
    var pluginName = 'ytBackground',
        defaults = {
            ratio: 16 / 9, // usually either 4/3 or 16/9 -- tweak as needed
            videoId: 'ZCAnLxRvNNc', // toy robot in space is a good default, no?
            mute: true,
            repeat: true,
            width: $(window).width(),
            wrapperZIndex: 99,
            playButtonClass: 'tubular-play',
            pauseButtonClass: 'tubular-pause',
            muteButtonClass: 'tubular-mute',
            volumeUpClass: 'tubular-volume-up',
            volumeDownClass: 'tubular-volume-down',
            increaseVolumeBy: 10,
            start: 0
        };
    // The actual plugin constructor
    function Plugin(element, options) {
        this.element = element;
        this.$el = $(element);
        // extend defaults with user options
        this.options = $.extend({}, defaults, options);
        this._defaults = defaults;
        this._name = pluginName;
        this.init();
    }
    // Avoid Plugin.prototype conflicts
    $.extend(Plugin.prototype, {
        /**
         * Initialize plugin
         */
        init: function() {

            var base = this; // store base
            base.$el.css({
                position: 'relative',
                'z-index': base.options.wrapperZIndex
            });
            // set up iframe player, use global scope so YT api can talk
            window.player = {};
            // need this to test if it's an ajax call or page load
            // if YT if not defined, wait for player ready for page load
            if (typeof(YT) == 'undefined' || typeof(YT.Player) == 'undefined') {
                window.onYouTubeIframeAPIReady = function() {
                    base.loadYT();
                }
                // otherwise load directly
            } else {
                base.loadYT();
            }
            // resize event
            $(window).on('resize.tubular', function() {
                base.resizeYT();
            })
            // player click events
            base.playerClickEvents();
            // finally load the YT iframe on page load
            base.loadYTIframe();
        },
        /**
         * After player is ready
         */
        onPlayerReady: function(e, base) {
            var pID = $(e.target.c).attr('id'),
                $pID = $('#' + pID),
                regVids = $('.section').find('video.hosted-video');

            base.resizeYT();

            if (base.options.mute) { e.target.mute(); }

            e.target.seekTo(base.options.start);

            // initial play on load
            var sectionVid  = $pID.closest('.section').attr('id') == 'section-1' || $pID.closest('.section').hasClass('active'), // || hasclass('active')
                slideVid    = sectionVid && ( $pID.closest('.slide').attr('id') == 'slide-0' || $pID.closest('.slide').hasClass('active') ) ; // doesn't have slide

            // play youtube video
            if (sectionVid || slideVid) {
                e.target.playVideo();
            } else {
                e.target.pauseVideo();
            }

            // fix bug that causes html5 videos to pause
            if (regVids.closest('.section').attr('id') == 'section-1' || regVids.closest('.section').hasClass('active')) {
                regVids.get(0) && regVids.get(0).play();
            }
            $('.tubular-player').animate({
                'opacity': 1
            });
        },
        /**
         * Repeats video if repeat is set
         */
        onPlayerStateChange: function(state, base) {
            base.$el.each(function() {
                var $ID = $(this).find('.tubular-player'),
                    ID = $ID.attr('ID');
                if (player[ID] && player[ID].getPlayerState() == 0 && base.options.repeat) { // video ended and repeat option is set true
                    player[ID].seekTo(base.options.start); // restart
                }
            });
        },
        /**
         * Click events to stop video if body is clicked
         */
        playerClickEvents: function() {
            var base = this;
            $('body').on('click', '.' + base.options.playButtonClass, function(e) { // play button
                e.preventDefault();
                player.playVideo();
            }).on('click', '.' + base.options.pauseButtonClass, function(e) { // pause button
                e.preventDefault();
                player.pauseVideo();
            }).on('click', '.' + base.options.muteButtonClass, function(e) { // mute button
                e.preventDefault();
                (player.isMuted()) ? player.unMute() : player.mute();
            }).on('click', '.' + base.options.volumeDownClass, function(e) { // volume down button
                e.preventDefault();
                var currentVolume = player.getVolume();
                if (currentVolume < base.options.increaseVolumeBy) currentVolume = base.options.increaseVolumeBy;
                player.setVolume(currentVolume - base.options.increaseVolumeBy);
            }).on('click', '.' + base.options.volumeUpClass, function(e) { // volume up button
                e.preventDefault();
                if (player.isMuted()) player.unMute(); // if mute is on, unmute
                var currentVolume = player.getVolume();
                if (currentVolume > 100 - base.options.increaseVolumeBy) currentVolume = 100 - base.options.increaseVolumeBy;
                player.setVolume(currentVolume + base.options.increaseVolumeBy);
            });
        },
        /**
         * Keep video fullscreen
         */
        resizeYT: function() {
            var base = this;

            base.$el.each(function(){
	            var el = $(this),
	                width = el.length > 0 ? el.width() : $(window).width(),
	                pWidth, // player width, to be defined
	                height = el.length > 0 ? el.height() : $(window).height(),
	                pHeight, // player height, tbd
	                $tubularPlayer = el.find('.tubular-player');

	            // when screen aspect ratio differs from video, video must center and underlay one dimension
	            if (width / base.options.ratio < height) { // if new video height < window height (gap underneath)
	                pWidth = Math.ceil(height * base.options.ratio); // get new player width
	                $tubularPlayer.width(pWidth).height(height).css({
	                    left: (width - pWidth) / 2,
	                    top: 0
	                }); // player width is greater, offset left; reset top
	            } else { // new video width < window width (gap to right)
	                pHeight = Math.ceil(width / base.options.ratio); // get new player height
	                $tubularPlayer.width(width).height(pHeight).css({
	                    left: 0,
	                    top: (height - pHeight) / 2
	                }); // player height is greater, offset top; reset left
	            }

            });
        },
        /**
         * Create YT load script
         */
        loadYTIframe: function() {
            // load yt iframe js api
            var tag = document.createElement('script');
            tag.src = "//www.youtube.com/iframe_api";
            var firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        },
        /**
         * Load each video
         */
        loadYT: function() {
            var base = this;
            base.$el.each(function() {
                var $this = $(this),
                    vID = $this.attr('data-yt-video'),
                    $ID = $this.find('.tubular-player'),
                    ID = $ID.attr('ID');
                player[ID] = new YT.Player(ID, {
                    width: base.options.width,
                    height: Math.ceil(base.options.width / base.options.ratio),
                    videoId: vID,
                    playerVars: {
                        version: 3,
                        autoplay: 0,
                        controls: 0,
                        showinfo: 0,
                        modestbranding: 1,
                        wmode: 'transparent',
                        rel: 0,
                        loop: 1
                    },
                    events: {
                        'onReady': onPlayerReady,
                        'onStateChange': onPlayerStateChange
                    }
                });
            });
            // callback on player ready
            function onPlayerReady(e) {
                base.onPlayerReady(e, base);
            }
            // callback on player state change
            function onPlayerStateChange(state) {
                base.onPlayerStateChange(state, base);
            }
        }
    });
    // A really lightweight plugin wrapper around the constructor,
    // preventing against multiple instantiations and allowing any
    // public function (ie. a function whose name doesn't start
    // with an underscore) to be called via the jQuery plugin,
    // e.g. $(element).tubular('functionName', arg1, arg2)
    $.fn[pluginName] = function(options) {
        var args = arguments;
        if (options === undefined || typeof options === 'object') {
            if (!$.data(this, 'plugin_' + pluginName)) {
                $.data(this, 'plugin_' + pluginName, new Plugin(this, options));
            }
        } else if (typeof options === 'string' && options[0] !== '_' && options !== 'init') {
            var returns;
            this.each(function() {
                var instance = $.data(this, 'plugin_' + pluginName);
                if (instance instanceof Plugin && typeof instance[options] === 'function') {
                    returns = instance[options].apply(instance, Array.prototype.slice.call(args, 1));
                }
                if (options === 'destroy') {
                    $.data(this, 'plugin_' + pluginName, null);
                }
            });
            return returns !== undefined ? returns : this;
        }
    };
})(jQuery, window);