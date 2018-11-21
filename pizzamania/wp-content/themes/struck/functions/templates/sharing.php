<?php
/**
 * This file shows the sharing bar
 */

global $tw_options;

if ( $tw_options['sharing'] ) : ?>
	<?php global $post; ?>

	<?php define('QUICK_CACHE_ALLOWED', FALSE); // Turn off quickcache for post loves and shares ?>

	<!-- Sharing Section -->
	<div class="sharing badges">

		<?php echo getPostLikeLink($post->ID); // Love Link ?>

		<?php echo getPostShareLink($post->ID); // Share link ?>

		<div id="share-box" class="zoom-anim-dialog mfp-hide">
			<span class="share-subtitle tiny-details">
				<?php _e('Share', 'themewich'); ?>
			</span>
			<div class="title">
				<h2><?php the_title(); ?></h2>
			</div>

			<?php
				$imageID = get_post_meta($post->ID,'_thumbnail_id',false);
				if ( isset($imageID[0]) ) {
					$sourceimage  = wp_get_attachment_image_src($imageID[0], 'fullslideshownc', false);  // URL of Featured Full Image
				} else {
					$sourceimage = false;
				}
			?>

			<!-- Share on Facebook -->
			<script type="text/javascript">
				function share_window(width, height, network) {
					var leftPosition, topPosition;
					//Allow for borders.
					leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
					//Allow for title and status bars.
					topPosition = (window.screen.height / 2) - ((height / 2) + 50);
					var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
					u=location.href;
					t=document.title;

					switch(network) {
						case 'facebook':
							window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer', windowFeatures);
							return false;
						break;
						case 'twitter':
							window.open('http://twitter.com/home?status=<?php echo urlencode(html_entity_decode(get_the_title())); ?>%20-%20<?php the_permalink(); ?>','sharer', windowFeatures);
							return false;
					  	break;
						case 'linkedin':
							window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>&title=<?php the_title(); ?>&source=<?php echo get_bloginfo ( "name" ); ?>','sharer', windowFeatures);
							return false;
						break;
						case 'pinterest':
							window.open('http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php echo esc_url( $sourceimage[0] ); ?>&description=<?php echo rawurlencode(get_the_title()); ?>','sharer', windowFeatures);
							return false;
						break;
						case 'google':
							window.open('http://plus.google.com/share?url=<?php the_permalink(); ?>','sharer', windowFeatures);
							return false;
						break;
						default:
							console.error('Error: network was not defined.');
						break;
				  }
			  }
			</script>

			<!-- Share on Facebook -->
			<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" onClick="return share_window(500, 300, 'facebook')" target="_blank" class="hint--bottom facebook-icon" data-hint="<?php _e('Share on Facebook', 'themewich'); ?>">
			  <i class="fa fa-facebook-square"></i>
			</a>

			<!-- Share on Twitter -->
			<a href="http://twitter.com/home?status=<?php echo rawurlencode(htmlspecialchars(strip_tags(get_the_title()))); ?>%20-%20<?php the_permalink(); ?>" onClick="return share_window(500, 300, 'twitter')" target="_blank" class="hint--bottom twitter-icon" data-hint="<?php _e('Share on Twitter', 'themewich'); ?>">
			  <i class="fa fa-twitter-square"></i>
			</a>

			<!-- Share on LinkedIn -->
			<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php echo rawurlencode(htmlspecialchars(strip_tags(get_the_title()))); ?>&amp;source=<?php echo get_bloginfo ( 'name' ); ?>" onClick="return share_window(500, 300, 'linkedin')" class="hint--bottom linkedin-icon" data-hint="<?php _e('Share on LinkedIn', 'themewich'); ?>">
			  <i class="fa fa-linkedin-square"></i>
			</a>

			<!-- Share on Pinterest -->
			<a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo esc_attr( $sourceimage[0] ); ?>&amp;description=<?php echo rawurlencode(get_the_title()); ?>" onClick="return share_window(750, 300, 'pinterest')" class="hint--bottom pinterest-icon" data-hint="<?php _e('Share on Pinterest', 'themewich'); ?>">
			  <i class="fa fa-pinterest"></i>
			</a>

			<!-- Share on Google Plus -->
			<a href="http://plus.google.com/share?url=<?php the_permalink(); ?>" class="hint--bottom googleplus-icon" onClick="return share_window(500, 475, 'google')" data-hint="<?php _e('Share on Google+', 'themewich'); ?>">
			  <i class="fa fa-google-plus-square"></i>
			</a>

		</div>
	</div>
	<!-- End Sharing Section -->

<?php endif; ?>