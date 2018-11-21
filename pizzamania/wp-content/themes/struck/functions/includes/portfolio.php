<?php
/**
 * Portfolio functions
 *
 * @package WordPress
 * @since 1.0
 */

/**
 *  New category walker for isotope filtering
 */
if ( ! class_exists( 'Themewich_Walker_Filter' ) ) :
	class Themewich_Walker_Filter extends Walker_Category {

		/**
		 * Outputs a customized list of category links
		 *
		 * @param  string $output String to output at the end
		 * @param  array $category Stores all category information (slug, id, name, etc.)
		 * @param  integer $depth Depth of categories
		 * @param  array $args Extracts arguments for function
		 *
		 * @return string Outputs customized string
		 */
		function start_el( &$output, $category, $depth = 0, $args = array(), $current_object_id = 0 ) {

			extract( $args );
			$cat_name = esc_attr( $category->name );
			$cat_ID   = $category->term_id;
			$cat_name = apply_filters( 'list_cats', $cat_name, $category );
			$link     = '<a href="#" class="no-ajaxy" data-filter="' . strtolower( preg_replace( '/\s+/', '-', $cat_ID ) ) . '" ';
			$link .= '>';
			$link .= strip_tags( apply_filters( 'the_content', $cat_name ) );
			$link .= '</a>';
			if ( ( ! empty( $feed_image ) ) || ( ! empty( $feed ) ) ) {
				$link .= ' ';
				if ( empty( $feed_image ) ) {
					$link .= '(';
				}
				$link .= '<a href="' . get_category_feed_link( $category->term_id, $feed_type ) . '"';
				if ( empty( $feed ) ) {
					$alt = ' alt="' . sprintf( __( 'Feed for all posts filed under %s', 'framework' ), $cat_name ) . '"';
				} else {
					$title = ' title="' . $feed . '"';
					$alt   = ' alt="' . $feed . '"';
					$name  = $feed;
					$link .= $title;
				}
				$link .= '>';
				if ( empty( $feed_image ) ) {
					$link .= $name;
				} else {
					$link .= "<img src='$feed_image'$alt$title" . ' />';
				}
				$link .= '</a>';
				if ( empty( $feed_image ) ) {
					$link .= ')';
				}
			}
			if ( isset( $show_count ) && $show_count ) {
				$link .= ' (' . intval( $category->count ) . ')';
			}
			if ( isset( $show_date ) && $show_date ) {
				$link .= ' ' . gmdate( 'Y-m-d', $category->last_update_timestamp );
			}
			if ( isset( $current_category ) && $current_category ) {
				$_current_category = get_category( $current_category );
			}
			if ( 'list' == $args['style'] ) {
				$output .= '<li class="segment-2"';
				$class = 'cat-item cat-item-' . $category->term_id;
				if ( isset( $current_category ) && $current_category && ( $category->term_id == $current_category ) ) {
					$class .= ' current-cat';
				} elseif ( isset( $_current_category ) && $_current_category && ( $category->term_id == $_current_category->parent ) ) {
					$class .= ' current-cat-parent';
				}
				$output .= '';
				$output .= ">$link\n";
			} else {
				$output .= "\t$link<br />\n";
			}
		}
	}
endif;