<?php
/**
 * Share and Like Functionality
 * Adapted from Tutsplus: "How to Create a Simple Post Rating System With WordPress and jQuery"
 * http://wp.tutsplus.com/tutorials/how-to-create-a-simple-post-rating-system-with-wordpress-and-jquery/
 *
 * @since Struck 1.0
 */

/**
 * Post like function
 * @since Struck 1.0
 */
if ( ! function_exists( 'post_like' ) ) :

	$timebeforerevote = 43829; // Global variable in minutes before voting again is allowed set to 1 month

	function post_like() {
		$nonce = $_POST['nonce'];

		// Verify Nonce
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			die ();
		}

		if ( isset( $_POST['post_like'] ) ) {
			$ip      = $_SERVER['REMOTE_ADDR'];
			$post_id = $_POST['post_id'];

			$meta_IP = get_post_meta( $post_id, "voted_IP" );
			if ( isset( $meta_IP[0] ) ) {
				$voted_IP = $meta_IP[0];
			}
			if ( isset( $voted_IP ) ) {
				if ( ! is_array( $voted_IP ) ) {
					$voted_IP = array();
				}
			} else {
				$voted_IP = array();
			}

			$meta_count = get_post_meta( $post_id, "votes_count", true );
			if ( ! hasAlreadyVoted( $post_id ) ) {
				$voted_IP[ $ip ] = time();
				update_post_meta( $post_id, "voted_IP", $voted_IP );
				update_post_meta( $post_id, "votes_count", ++ $meta_count );

				echo esc_attr( $meta_count );
			} else {
				echo "already";
			}
		}
		exit;
	}

	// Add our own handlers for the ajax request
	add_action( 'wp_ajax_nopriv_post-like', 'post_like' );
	add_action( 'wp_ajax_post-like', 'post_like' );
endif;

/**
 * Checks to see if the user has already voted
 * @since Struck 1.0
 */
if ( ! function_exists( 'hasAlreadyVoted' ) ) :
	function hasAlreadyVoted( $post_id ) {
		global $timebeforerevote;
		$meta_IP = get_post_meta( $post_id, "voted_IP" );
		if ( isset( $meta_IP[0] ) ) {
			$voted_IP = $meta_IP[0];
		}
		if ( isset( $voted_IP ) ) {
			if ( ! is_array( $voted_IP ) ) {
				$voted_IP = array();
			}
		} else if ( ! isset( $voted_IP ) ) {
			$voted_IP = array();
		}

		$ip = $_SERVER['REMOTE_ADDR'];

		if ( in_array( $ip, array_keys( $voted_IP ) ) ) {
			$time = $voted_IP[ $ip ];
			$now  = time();

			if ( round( ( $now - $time ) / 60 ) > $timebeforerevote ) {
				return false;
			}

			return true;
		}

		return false;
	}
endif;

if ( ! function_exists( 'themewich_vote_style' ) ) :
	function themewich_vote_style( $input ) {
		$input       = number_format( $input );
		$input_count = substr_count( $input, ',' );
		if ( $input_count != '0' ) {
			if ( $input_count == '1' ) {
				return substr( $input, 0, - 4 ) . 'k'; // thousand
			} else if ( $input_count == '2' ) {
				return substr( $input, 0, - 8 ) . 'm'; // million
			} else if ( $input_count == '3' ) {
				return substr( $input, 0, - 12 ) . 'b'; // billion
			} else {
				return;
			}
		} else {
			return $input;
		}
	}
endif;

/**
 * Displays love icon
 * @since Struck 1.0
 */
if ( ! function_exists( 'getPostLikeLink' ) ) :

	function getPostLikeLink( $post_id ) {

		$themename  = "struck";
		$vote_count = get_post_meta( $post_id, "votes_count", true );
		$has_voted  = hasAlreadyVoted( $post_id );

		if ( ! $vote_count ) {
			$vote_count = 0;
		}

		if ( $has_voted ) {
			$output = '<span class="post-link love voted disabled">';
		} else {
			$output = '<a href="#" class="post-like love" data-post_id="' . esc_attr( $post_id ) . '">';
		}

		$vote_count = themewich_vote_style( $vote_count );
		$output 	.= '<i class="fa fa-heart"></i><span class="sharetitle" data-clicked="' . esc_html__( 'Liked', 'themewich' ) . '">';

		if ( $has_voted ) {
			$output .= esc_html__( 'Liked', 'themewich' );
		} else {
			$output .= esc_html__( 'Like', 'themewich' );
		}

		$output .= '</span>';
		$output .= '<div class="sharecircle count">' . esc_html( $vote_count ) . '</div>';

		if ( $has_voted ) {
			$output .= '</span>';
		} else {
			$output .= '</a>';
		}

		return $output;
	}
endif;

/**
 * Share Count Functionality
 * Adapted from Tutsplus: "How to Create a Simple Post Rating System With WordPress and jQuery"
 * http://wp.tutsplus.com/tutorials/how-to-create-a-simple-post-rating-system-with-wordpress-and-jquery/
 *
 * @since Struck 1.0
 */
if ( ! function_exists( 'post_share' ) ) :
	/**
	 * Displays share icon
	 * @since  Struck 1.0
	 */
	function post_share() {
		$nonce = $_POST['nonce'];

		// Verify Nonce
		if ( ! wp_verify_nonce( $nonce, 'ajax-nonce' ) ) {
			die ( 'Reload Page' );
		}

		if ( isset( $_POST['post_share'] ) ) {
			$post_id = $_POST['post_id'];

			$meta_shares_count = get_post_meta( $post_id, "shares_count", true );
			update_post_meta( $post_id, "shares_count", ++ $meta_shares_count );

			echo esc_attr( $meta_shares_count );
		}
		exit;
	}

	// Add our own handlers for the ajax request
	add_action( 'wp_ajax_nopriv_post-share', 'post_share' );
	add_action( 'wp_ajax_post-share', 'post_share' );
endif;

/**
 * Displays share icon
 * @since  Struck 1.0
 */
if ( ! function_exists( 'getPostShareLink' ) ) :
	function getPostShareLink( $post_id ) {

		$themename    = "struck";
		$shares_count = get_post_meta( $post_id, "shares_count", true );

		if ( ! $shares_count ) {
			$shares_count = 0;
		}

		$shares_count = themewich_vote_style( $shares_count );

		// prepare output
		$output  = '<a href="#share-box" class="open-popup-link post-share share popup-with-move-anim';
		$output .= '" data-post_id="' . esc_attr( $post_id ) . '">';
		$output .= '<i class="fa fa-share"></i>';
		$output .= '<span class="sharetitle" data-clicked="' . esc_html__( 'Shared', 'themewich' ) . '">' 
			. esc_html__( 'Share', 'themewich' ) 
			. '</span><div class="sharecircle count">' 
				. esc_html( $shares_count ) 
			. '</div></a>';

		return $output;
	}
endif;