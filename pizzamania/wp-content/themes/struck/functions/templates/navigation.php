<?php
/**
 * Get the theme options
 */
global $tw_options; ?>

<div class="top-nav nb-fixed <?php echo esc_attr( tw_issetor( $header_layout ) ); ?>">
	<div class="container top-nav-inner">
		<div class="table">
			<div class="tr">

				<!-- Logo -->
		  		<div class="td verticalmiddle" id="logo">
					<?php echo is_front_page() ? '<h1>' : '<h2>'; ?>

				        <?php do_action('tw_before_logo'); ?>

			  			<a href="<?php echo trailingslashit( home_url() ); ?>">
			  				<?php if ( tw_issetor($tw_options['logo']['url']) || tw_issetor($tw_options['logo_light']['url'])) :

			  					// dark logo
								$height = tw_issetor($tw_options['logo']['height']) ? $tw_options['logo']['height'] : '';
								$width  = tw_issetor($tw_options['logo']['width']) ? $tw_options['logo']['width'] : '';

								// light logo
								$heightl = tw_issetor($tw_options['logo_light']['height']) ? $tw_options['logo_light']['height'] : '';
								$widthl  = tw_issetor($tw_options['logo_light']['width']) ? $tw_options['logo_light']['width'] : '';

								if ( tw_issetor($tw_options['retina-logo']) ) {
									$width = round( $width / 2 );
									$height = round( $height / 2 );
									$widthl = round( $widthl / 2 );
									$heightl = round( $heightl / 2 );
								} ?>

								<img src="<?php echo esc_url( $tw_options['logo']['url'] ); ?>" class="dark-logo" alt="<?php bloginfo( 'name' ); ?>" width="<?php echo esc_attr( $width );?>" height="<?php echo esc_attr( $height );?>"/>
								<img src="<?php echo esc_url( $tw_options['logo_light']['url'] ); ?>" class="light-logo" alt="<?php bloginfo( 'name' ); ?>" width="<?php echo esc_attr( $widthl );?>" height="<?php echo esc_attr( $heightl );?>"/>

							<?php else :
								bloginfo( 'name' );
							endif; ?>
						</a>

				     <?php do_action('tw_after_logo'); ?>

					<?php echo is_front_page() ? '</h1>' : '</h2>'; ?>
				</div>
				<!-- END Logo -->

				<!-- Menu -->
				<div class="td verticalmiddle">
					<div class="navcontainer">

						<?php if ( has_nav_menu( 'top_bar' ) ) { ?>
							<!-- Top Bar Menu -->
							<nav id="top-menu">

								<?php wp_nav_menu( array(
									'menu' 				=> 'Top Nav Bar',
									'theme_location' 	=> 'top_bar',
									'menu_class'      	=> 'sf-menu show-desktop'
								)); ?>

								<div class="clear"></div>
							</nav>
							<!-- END Top Bar Menu -->
						<?php } ?>

						<?php do_action('tw_before_nav_icon'); ?>

						<!-- Side Panel Link -->
						<a href="#" class="tw-menu-icon nb-menu-link" id="nb-menu-link">
							<span>
								<?php _e('Menu', 'themewich'); ?>
							</span>
						</a>
						<!-- END Side Panel Link -->

						<?php do_action('tw_after_nav_icon'); ?>

						<!-- Slide Out Panel -->
						<div class="tw-slide-panel dark">

							<div class="above-nav">
								<?php dynamic_sidebar('Above Slideout Navigation'); ?>
							</div>

							<nav id="slide-menu">
								<ul class="nb-menu-items-container">

									<?php
										// add top bar menu and hide so we can display on mobile
										if ( has_nav_menu( 'top_bar' ) ) {
											wp_nav_menu( array(
												'menu' 				=> 'Top Nav Bar',
												'theme_location' 	=> 'top_bar',
												'items_wrap' 		=> '%3$s', // remove items wrap to combine
												'walker'   			=> new Themewich_Walker_Nav_Menu()
											));
										}

										// if slideout menu is set, use that. Otherwise list pages
										if ( has_nav_menu( 'slideout_panel' ) ) {
											wp_nav_menu( array(
												'menu'           => 'Slideout Panel',
												'theme_location' => 'slideout_panel',
												'items_wrap'     => '%3$s' // remove items wrap to combine
											) );
										} else { ?>
											<ul>
												<?php wp_list_pages( array(
													'title_li'    => '',
													'items_wrap'     => '%3$s', // remove items wrap to combine
													'sort_column' => 'menu_order'
												) ); ?>
											</ul>
										<?php }
									?>

								</ul>
							</nav>

							<div class="below-nav">
								<?php dynamic_sidebar('Below Slideout Navigation'); ?>
							</div>

							<?php wp_reset_query(); // safeguard against plugin loops ?>

						</div>
						<!-- End slide out panel -->

						<div class="clear"></div>

					</div><!-- End Navcontainer -->
				</div><!-- td verticalmiddle -->
			</div><!-- tr -->
		</div><!-- table -->
	</div><!-- top-nav-inner -->
</div><!-- top-nav-->