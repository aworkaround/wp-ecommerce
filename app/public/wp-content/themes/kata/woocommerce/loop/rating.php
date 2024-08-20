<?php

/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

$rating       = sprintf( '%.1f', $product->get_average_rating() );
$rating_count = $product->get_rating_count();

if ( ! wc_review_ratings_enabled() ) {
	return;
}

$html = '';

if ( 0 < $rating ) {
	$html = '<div class="star-rating kata-loop-rating" role="img"><span style="width: 15px;"></span>' . $rating . '</div>';
}

$output = apply_filters( 'woocommerce_product_get_rating_html', $html, $rating, $rating_count );

echo wp_kses_post( $output );
