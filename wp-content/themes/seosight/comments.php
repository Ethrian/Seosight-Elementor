<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Seosight
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments comments-area">
	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
        <div class="heading">
            <div class="h3"><?php printf( // WPCS: XSS OK.
					esc_html( _nx( 'One comment', '%1$s Comments', get_comments_number(), 'comments title', 'seosight' ) ),
					number_format_i18n( get_comments_number() )
				);
				?></div>
            <div class="heading-line">
                <span class="short-line"></span>
                <span class="long-line"></span>
            </div>
        </div>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

            <nav id="comment-nav-above" class="navigation comment-navigation pagination-arrow" role="navigation">
                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'seosight' ); ?></h2>
				<?php
				$prev_commnts_link_markup = '<span class="btn-content">
					<span class="btn-content-title">' . esc_html__( 'Older Comments', 'seosight' ) . '</span>
				</span>
				<svg class="btn-next">
					<use xlink:href="#arrow-right"></use>
				</svg>';
				$next_commnts_link_markup = '
				<svg class="btn-prev">
					<use xlink:href="#arrow-left"></use>
				</svg><span class="btn-content">
					<span class="btn-content-title">' . esc_html__( 'Newer Comments', 'seosight' ) . '</span>
				</span>'; ?>

				<?php previous_comments_link( $next_commnts_link_markup ); ?>
				<?php next_comments_link( $prev_commnts_link_markup ); ?>

            </nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

        <ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'      => 'ol',
				'short_ping' => true,
				'callback'   => 'seosight_comments'
			) );
			?>
        </ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
            <nav id="comment-nav-below" class="navigation comment-navigation  pagination-arrow" role="navigation">

                <h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'seosight' ); ?></h2>

				<?php previous_comments_link( $next_commnts_link_markup ); ?>
				<?php next_comments_link( $prev_commnts_link_markup ); ?>

            </nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation.
	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <div class="h6 no-comments"><?php esc_html_e( 'Comments are closed.', 'seosight' ); ?></div>
	<?php endif; ?>
    <div class="leave-reply">
		<?php
        $consent           = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		$fields        = array(
			'author' => '<div class="row"><div class="col-lg-6">
				<input class="email input-standard-grey" name="author" id="author" placeholder="' . esc_attr__( 'Your Full Name', 'seosight' ) . '" value="' . esc_attr( $commenter['comment_author'] ) . '" type="text" required>		
					</div>',
			'email'  => '<div class="col-lg-6">
		<input class="email input-standard-grey" name="email" id="email" placeholder="' . esc_html__( 'Email', 'seosight' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" type="email" required>
		</div></div>',
			'url'    => '',
            'cookies' => '<div class="col-lg-12 mb30 remember-wrap"><div class="checkbox">
                            <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
                            '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.', 'seosight' ) . '</label>
                         </div></div>',
		);
		$comments_args = array(
			'id_form'              => 'commentform',
			'class_submit'         => 'hide',
			'name_submit'          => 'submit',
			'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
			'title_reply'          => esc_html__( 'Leave a Reply', 'seosight' ),
			'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'seosight' ),
			'cancel_reply_link'    => esc_html__( 'Cancel Reply', 'seosight' ),
			'label_submit'         => esc_html__( 'Post Comment', 'seosight' ),
			'title_reply_before'   => '<div class="heading"><h4 class="heading-title">',
			'title_reply_after'    => '</h4><div class="heading-line"><span class="short-line"></span><span class="long-line"></span></div></div>',
			'comment_notes_after'  => '<div class="submit-block display-flex">
									<div class="col-lg-4">
										<button class="btn btn-small btn--primary">
											<span class="text">' . esc_html__( 'Submit', 'seosight' ) . '</span>
										</button>
									</div>
									<div class="col-lg-8">
										<div class="submit-block-text">
										' . esc_html__( 'You may use these HTML tags and attributes', 'seosight' ) . ': 
									<span> &lt;a href=""&gt; &lt;abbr&gt; &lt;acronym&gt;
											&lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt;
											&lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt; 
											</span>
										</div>
									</div>
								</div>',
			'comment_notes_before' => '<p class="comment-notes  mb30">' . esc_html__( 'Your email address will not be published.', 'seosight' ) . '</p>',
			'comment_field'        => '<div class="row"><div class="col-sm-12">
		<textarea class="input-text input-standard-grey" id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="' . esc_html__( 'Comment', 'seosight' ) . '"></textarea>
		</div></div>',
		);
		if ( comments_open() ) {
			comment_form( $comments_args );
		} ?>
    </div>
</div><!-- #comments -->


