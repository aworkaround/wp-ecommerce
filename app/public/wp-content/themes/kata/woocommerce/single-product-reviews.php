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
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

?>
<div id="reviews" class="woocommerce-Reviews">
	<div class="kata-review-summery">
		<?php
		$count   = $product->get_rating_count();
		$average = $product->get_average_rating();

		$rating_1 = $product->get_rating_count( 1 );
		$rating_2 = $product->get_rating_count( 2 );
		$rating_3 = $product->get_rating_count( 3 );
		$rating_4 = $product->get_rating_count( 4 );
		$rating_5 = $product->get_rating_count( 5 );

		$html = '<div class="star-rating" role="img"><span style="width: 15px;"></span>' . $average . '</div>';

		?>
		<div class="overall-rating-wrap">
			<div class="average-rating">
				<?php
					echo wp_kses_post( number_format_i18n( $average, 1 ) );
				?>
			</div>
			<div class="average-rating-stars">
				<?php
					echo wp_kses_post( wc_get_rating_html( $average ) );
				?>
			</div>
			<div class="reviews-count">
				<?php
					echo sprintf( wp_kses_post( '%s review', '%s reviews', $count, 'kata' ), wp_kses_post( number_format_i18n( $count ) ) );
				?>
			</div>
			<div class="write-a-review">
				<a href="#reply-title" class="button"><?php esc_html_e( 'Write a Review', 'kata' ); ?></a>
			</div>
		</div>

		<div class="rating-summary-wrap">

			<div class="item">
				<div class="star-rating" role="img">
					<span style="width: 100%;"></span>
				</div>
				<div class="rate-count">
					<?php echo esc_html( $rating_5 ); ?>
				</div>
			</div>

			<div class="item">
				<div class="star-rating" role="img">
					<span style="width: 80%;"></span>
				</div>
				<div class="rate-count">
					<?php echo esc_html( $rating_4 ); ?>
				</div>
			</div>

			<div class="item">
				<div class="star-rating" role="img">
					<span style="width: 60%;"></span>
				</div>
				<div class="rate-count">
					<?php echo esc_html( $rating_3 ); ?>
				</div>
			</div>

			<div class="item">
				<div class="star-rating" role="img">
					<span style="width: 40%;"></span>
				</div>
				<div class="rate-count">
					<?php echo esc_html( $rating_2 ); ?>
				</div>
			</div>

			<div class="item">
				<div class="star-rating" role="img">
					<span style="width: 20%;"></span>
				</div>
				<div class="rate-count">
					<?php echo esc_html( $rating_1 ); ?>
				</div>
			</div>

		</div>

	</div>
	<div id="comments">
		<h2 class="woocommerce-Reviews-title">
			<?php
			$count = $product->get_review_count();
			if ( $count && wc_review_ratings_enabled() ) {
				/* translators: 1: reviews count 2: product name */
				$reviews_title = sprintf( esc_html( _n( '%1$s review for %2$s', '%1$s reviews for %2$s', $count, 'kata' ) ), esc_html( $count ), '<span>' . get_the_title() . '</span>' );
				echo apply_filters( 'woocommerce_reviews_title', $reviews_title, $count, $product ); // phpcs:ignore WordPress.Security.EscapeOutput
			} else {
				esc_html_e( 'Reviews', 'kata' );
			}
			?>
		</h2>

		<?php if ( have_comments() ) : ?>
		<ol class="commentlist">
			<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments' ) ) ); ?>
		</ol>

			<?php
			if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				echo '<nav class="woocommerce-pagination">';
				paginate_comments_links(
					apply_filters(
						'woocommerce_comment_pagination_args',
						array(
							'prev_text' => is_rtl() ? '&rarr;' : '&larr;',
							'next_text' => is_rtl() ? '&larr;' : '&rarr;',
							'type'      => 'list',
						)
					)
				);
				echo '</nav>';
			endif;
			?>
		<?php else : ?>
		<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'kata' ); ?></p>
		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>
	<div id="review_form_wrapper">
		<div id="review_form">
			<?php
				$commenter    = wp_get_current_commenter();
				$comment_form = array(
					/* translators: %s is product title */
					'title_reply'         => have_comments() ? esc_html__( 'Add a review', 'kata' ) : sprintf( esc_html__( 'Be the first to review &ldquo;%s&rdquo;', 'kata' ), get_the_title() ),
					/* translators: %s is product title */
					'title_reply_to'      => esc_html__( 'Leave a Reply to %s', 'kata' ),
					'title_reply_before'  => '<span id="reply-title" class="comment-reply-title">',
					'title_reply_after'   => '</span>',
					'comment_notes_after' => '',
					'label_submit'        => esc_html__( 'Submit', 'kata' ),
					'logged_in_as'        => '',
					'comment_field'       => '',
				);

				$name_email_required = (bool) get_option( 'require_name_email', 1 );
				$fields              = array(
					'author' => array(
						'label'    		=> __( 'Name', 'kata' ),
						'type'     		=> 'text',
						'value'    		=> $commenter['comment_author'],
						'placeholder' 	=> 'Name',
						'required' 		=> $name_email_required,
					),
					'email'  => array(
						'label'    		=> __( 'Email', 'kata' ),
						'type'     		=> 'email',
						'value'    		=> $commenter['comment_author_email'],
						'placeholder' 	=> 'Email',
						'required' 		=> $name_email_required,
					),
				);

				$comment_form['fields'] = array();

				foreach ( $fields as $key => $field ) {
					$field_html  = '<p class="comment-form-' . esc_attr( $key ) . '">';

					$field_html .= '<input id="' . esc_attr( $key ) . '" name="' . esc_attr( $key ) . '" type="' . esc_attr( $field['type'] ) . '" value="' . esc_attr( $field['value'] ) . '" placeholder="' . esc_attr( $field['placeholder']) . ($field['required'] ? '*' : '' ) . '" size="30" ' . ( $field['required'] ? 'required' : '' ) . ' /></p>';

					$comment_form['fields'][ $key ] = $field_html;
				}

				$account_page_url = wc_get_page_permalink( 'myaccount' );
				if ( $account_page_url ) {
					/* translators: %s opening and closing link tags respectively */
					$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %1$slogged in%2$s to post a review.', 'kata' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
				}

				if ( wc_review_ratings_enabled() ) {
					$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'kata' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</label><select name="rating" id="rating" required>
						<option value="">' . esc_html__( 'Rate&hellip;', 'kata' ) . '</option>
						<option value="5">' . esc_html__( 'Perfect', 'kata' ) . '</option>
						<option value="4">' . esc_html__( 'Good', 'kata' ) . '</option>
						<option value="3">' . esc_html__( 'Average', 'kata' ) . '</option>
						<option value="2">' . esc_html__( 'Not that bad', 'kata' ) . '</option>
						<option value="1">' . esc_html__( 'Very poor', 'kata' ) . '</option>
					</select></div>';
				}

				$comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="Your review *" required></textarea></p>';

				comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
		</div>
	</div>
	<?php else : ?>
	<p class="woocommerce-verification-required">
		<?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'kata' ); ?>
	</p>
	<?php endif; ?>

	<div class="clear"></div>
</div>
