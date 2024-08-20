<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'kata' ) ) );
	return;
}

$order_button_text = apply_filters( 'woocommerce_order_button_text', __( 'Place order', 'kata' ) );

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout kata-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">

				<!-- Billing Form -->
				<h2 class="checkout-step-title billing-details-title"><?php esc_html_e( 'Billing Details', 'kata' ); ?></h2>
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
				<!-- Billing Form End -->

				<!-- Shipping Form -->
				<h2 class="checkout-step-title shipping-method-title"><?php esc_html_e( 'Shipping Method', 'kata' ); ?></h2>
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
				<!-- Shipping Form End -->

				<!-- Payment -->
				<h2 class="checkout-step-title payment-method-title"><?php esc_html_e( 'Payment Method', 'kata' ); ?></h2>
				<?php do_action( 'woocommerce_checkout_payment' ); ?>
				<!-- Payment End -->

				<!-- Additional Information -->
				<h2 class="checkout-step-title additional-information-title"><?php esc_html_e( 'Additional Information', 'kata' ); ?></h2>
				<div class="woocommerce-additional-fields">
					<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

					<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

						<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

							<h3><?php esc_html_e( 'Additional information', 'kata' ); ?></h3>

						<?php endif; ?>

						<div class="woocommerce-additional-fields__field-wrapper">
							<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
								<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
							<?php endforeach; ?>
						</div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
				</div>
				<!-- Additional Information End -->

			</div>

			<div class="col-2">
				<!-- Order Review  -->
				<div class="kata-order-review">
					<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>

					<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'kata' ); ?></h3>

					<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

					<div id="order_review" class="woocommerce-checkout-review-order">
						<?php do_action( 'woocommerce_checkout_order_review' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
				</div>
				<!-- Order Review End -->
			</div>
		</div>

		<!-- Place Order -->
		<div class="place-order">
				<noscript>
					<?php
					/* translators: $1 and $2 opening and closing emphasis tags respectively */
					printf( esc_html__( 'Since your browser does not support JavaScript, or it is disabled, please ensure you click the %1$sUpdate Totals%2$s button before placing your order. You may be charged more than the amount stated above if you fail to do so.', 'kata' ), '<em>', '</em>' );
					?>
					<br/><button type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="<?php esc_attr_e( 'Update totals', 'kata' ); ?>"><?php esc_html_e( 'Update totals', 'kata' ); ?></button>
				</noscript>

				<?php wc_get_template( 'checkout/terms.php' ); ?>

				<?php do_action( 'woocommerce_review_order_before_submit' ); ?>

				<?php echo apply_filters( 'woocommerce_order_button_html', '<button type="submit" class="button alt" name="woocommerce_checkout_place_order" id="place_order" value=" ' . esc_attr( $order_button_text ) . '" data-value=" ' . esc_attr( $order_button_text ) . '"> ' . esc_html( $order_button_text ) . '</button>' ); // @codingStandardsIgnoreLine ?>

				<?php do_action( 'woocommerce_review_order_after_submit' ); ?>

				<?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
			</div>
			<!-- Place Order End -->

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
