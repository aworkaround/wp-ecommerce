<?php
/**
 * Kata Single Product Rating view
 *
 * On occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$rating_count = $product->get_rating_count();
$review_count = $product->get_review_count();
$average      = sprintf( '%.1f', $product->get_average_rating() );
$html         = '<div class="star-rating kata-loop-rating" role="img"><span style="width: 15px;"></span>' . $average . '</div>';

if ( $rating_count > 0 ) : ?>
	<div class="woocommerce-product-rating kata-single-rating">
		<?php
		echo wp_kses_post( $html );

		if ( comments_open() ) :
			?>
			<a href="#reviews" class="woocommerce-review-link" rel="nofollow">
				<?php
				//translators: 1 replaced with link
				printf( _n( '%s review', '%s reviews', $review_count, 'kata' ), '<span class="count">' . esc_html( $review_count ) . '</span>' );
				?>
			</a>
		<?php endif ?>
	</div>

<?php endif; ?>
