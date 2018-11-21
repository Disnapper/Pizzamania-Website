<?php // Do not delete these lines
	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename
		( $_SERVER['SCRIPT_FILENAME'] )
	) {
		die ( 'Please do not load this page directly. Thanks!' );
	}
?>

<div class="commentwrapper">
    <div class="container">
        <div class="col-md-8 col-md-offset-2">

        <?php if ( post_password_required() ) { ?>
				<p class="nocomments">
					<?php esc_html_e( 'This post is password protected. Enter the password to view comments.', 'themewich' ); ?>
				</p>

	    </div>
    </div>
</div>
				<?php
				return;
			}
		?>

            <!-- You can start editing here. -->
	        <?php if ( have_comments() ) : ?>
		        <div class="commentsheader" id="comments">
			        <h3>
				        <span><?php esc_html_e( 'Comments', 'themewich' ); ?></span>
                        <span class="badges">
                            <a href="#respond">
	                            <?php echo (int) get_comments_number(); ?>
                            </a>
                        </span>
			        </h3>
                    <span class="align-right respond-link">
                        <a href="#respond">
	                        <i class="fa fa-pencil"></i>
                        </a>
                    </span>
		        </div>
		        <ol class="listcomments">
			        <?php wp_list_comments( 'type=comment&callback=themewich_comment' ); ?>
		        </ol>
		        <div class="navigation-comments">
			        <div class="alignleft">
				        <p>
					        <?php previous_comments_link() ?>
				        </p>
			        </div>
			        <div class="alignright">
				        <p>
					        <?php next_comments_link() ?>
				        </p>
			        </div>
		        </div>
		        <div class="clear"></div>
	        <?php else : // this is displayed if there are no comments so far ?>
		        <?php if ( 'open' == $post->comment_status ) : ?>
		        <?php else : // comments are closed ?>
			        <h4 class="nocomments">
			        	<?php esc_html_e( 'Comments are closed.', 'themewich' ); ?>
			        </h4>
		        <?php endif; ?>
	        <?php endif; ?>

	        <?php
		        /*-----------------------------------------------------------------------------------*/
		        /*	Comment Form
				/*-----------------------------------------------------------------------------------*/

		        if ( comments_open() ) : ?>
			        <!-- Submit Comment Form -->
			        <div class="commentsform">
				        <h3 class="section-title">
					        <?php esc_html_e( 'Submit a Comment', 'themewich' ); ?>
				        </h3>
				        <?php
					        $comments_args = array(
						        'fields'	=> apply_filters( 'comment_form_default_fields',
							        array(
								        'author' => '<div>
	                                             		<label for="author">' . esc_html__( 'Name', 'themewich' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
	                                                    <input type="text" name="author"  id="author" value="' . esc_attr( $comment_author ) . '" size="22" tabindex="1" ' . ( $req ? 'class="required"' : '' ) . '/>
	                                                </div>',
								        'email'  => '<div>
	                                             		<label for="email">' . esc_html__( 'Mail', 'themewich' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label>
	                                                    <input type="text" name="email"  id="email" value="' . esc_attr( $comment_author_email ) . '" size="22" tabindex="2" ' . ( $req ? 'class="required email"' : '' ) . '/>
	                                                </div>',
								        'url'    => '<label for="url">' . esc_html__( 'Website', 'themewich' ) . '</label>
								                    <input type="text" name="url" id="url" value="' . esc_attr( $comment_author_url ) . '" size="44" tabindex="3" />',

							        ) ),
						        'comment_field'        => '<label for="comment">' . esc_html__( 'Message', 'themewich' ) . '<span>*</span></label>' .
						                                  '<textarea name="comment" id="comment" cols="58" rows="8" tabindex="4" ' . ( $req ? 'class="required"' : '' ) . '></textarea>',
						        'must_log_in'          => '',
						        'logged_in_as'         => '<p>' . esc_html__( "Logged in as", "framework" ) . ' <a href="' . esc_url( get_option( 'siteurl' ) ) . '/wp-admin/profile.php">' . $user_identity . '</a>. <a href="' . esc_url( get_option( 'siteurl' ) . '/wp-login.php?action=logout' ) . '" title="Log out of this account">' . esc_html__( "Logout", "framework" ) . ' &raquo;</a></p>',
						        'id_form'              => 'commentsubmit',
						        'comment_notes_before' => '',
						        'comment_notes_after'  => '',
						        'id_submit'            => 'submit',
						        'title_reply'          => '',
						        'title_reply_to'       => '',
						        'cancel_reply_link'    => '<i class="fa fa-times"></i>',
						        'label_submit'         => esc_html__( 'Post Comment', 'themewich' )
					        );
					        comment_form( $comments_args ); ?>
			        </div>
		        <?php endif; // If registration required and not logged in ?>
        </div>
    </div>
</div>