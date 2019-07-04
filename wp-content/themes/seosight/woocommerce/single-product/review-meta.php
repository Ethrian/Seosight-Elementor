<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

	<header class="comment-meta comments__header-review"><em class="woocommerce-review__awaiting-approval"><?php esc_attr_e( 'Your review is awaiting approval', 'seosight' ); ?></em></header>

<?php } else { ?>

	<header class="comment-meta comments__header-review">
		<cite class="fn url comments__author-review"  itemprop="author">
			<?php comment_author(); ?>
			<?php
			if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
				echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'seosight' ) . ')</em> ';
			} ?>
		</cite>
		<a class="comments__time-review">
			<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>
		</a>
	</header>

<?php }
