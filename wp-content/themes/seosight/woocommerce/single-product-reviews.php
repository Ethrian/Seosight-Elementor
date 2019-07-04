<?php
/**
 * Display single product reviews (comments)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product-reviews.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div id="comments-list" class="comments__list-review">
		<h2 class="woocommerce-Reviews-title"><?php
			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' && ( $count = $product->get_review_count() ) ) {
				/* translators: 1: reviews count 2: product name */
				printf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'seosight' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
			} else {
				_e( 'Reviews', 'seosight' );
			}
		?></h2>

		<?php if ( have_comments() ) : ?>

			<ol class="comments commentlist">
				<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '&larr;',
					'next_text' => '&rarr;',
					'type'      => 'list',
				) ) );
				echo '</nav>';
			endif; ?>

		<?php else : ?>

			<h5 class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'seosight' ); ?></h5>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->id ) ) : ?>

		<div id="review_form_wrapper">
			<div id="review_form">
				<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					'id_form'              => 'commentform',
					'class_submit'         => 'visual-hidden',
					'name_submit'          => 'submit',
					'title_reply'          => have_comments() ? esc_html__( 'Add a review', 'seosight' ) : esc_html__( 'Add first review', 'seosight' ),
					'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'seosight' ),
					'title_reply_before'   => '<div class="heading"><h4 class="h1 heading-title">',
					'title_reply_after'    => '</h4><div class="heading-line"><span class="short-line"></span><span class="long-line"></span></div></div>',
					'comment_notes_before' => '<p class="comment-notes  mb30">' . esc_html__( 'Your email address will not be published.', 'seosight' ) . '</p>',
					'comment_notes_after'  => '<div class="submit-block display-flex">
									<div class="col-lg-8">
										<div class="submit-block-text">
										' . esc_html__( 'You may use these HTML tags and attributes', 'seosight' ) . ': 
									<span> &lt;a href=""&gt; &lt;abbr&gt; &lt;acronym&gt;
											&lt;b&gt; &lt;blockquote cite=""&gt; &lt;cite&gt; &lt;code&gt; &lt;del datetime=""&gt;
											&lt;em&gt; &lt;i&gt; &lt;q cite=""&gt; &lt;strike&gt; &lt;strong&gt; 
											</span>
										</div>
									</div>
									<div class="col-lg-4">
										<button class="btn btn-small btn--primary">
											<span class="text">' . esc_html__( 'Submit', 'seosight' ) . '</span>
										</button>
									</div>
								</div>',

					'fields'        => array(

						'author' => '<div class="row"><div class="col-lg-6">
				<input class="email input-standard-grey input-white" name="author" id="author" placeholder="Your Full Name" value="' . esc_attr( $commenter['comment_author'] ) . '" type="text" required>		
					</div>',
						'email'  => '<div class="col-lg-6">
		<input class="email input-standard-grey input-white" name="email" id="email" placeholder="' . esc_html__( 'Email', 'seosight' ) . '" value="' . esc_attr( $commenter['comment_author_email'] ) . '" type="email" required>
		</div></div>',
					),
					'label_submit'  => esc_html__( 'Submit Review', 'seosight' ),
				);

				if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'seosight' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
					$comment_form['comment_field'] = '<div class="row"><div class="comment-form-rating col-lg-6"><select name="rating" id="rating" aria-required="true" required>
							<option value="">' . esc_html__( 'Please select rating for this product', 'seosight' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'seosight' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'seosight' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'seosight' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'seosight' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'seosight' ) . '</option>
						</select></div></div>';
				}
				$comment_form['comment_field'] .= '<div class="row"><div class="col-sm-12">
					<textarea class="input-text input-standard-grey  input-white" id="comment" name="comment" cols="45" rows="8" aria-required="true" required placeholder="' . esc_html__( 'Comment', 'seosight' ) . '"></textarea>
					</div></div>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<h6 class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'seosight' ); ?></h6>

	<?php endif; ?>

	<div class="clear"></div>
</div>