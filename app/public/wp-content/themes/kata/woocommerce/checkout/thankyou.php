<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.1.0
 *
 * @var WC_Order $order
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="woocommerce-order kata-thankyou">

	<?php
	if ( $order ) :

		do_action( 'woocommerce_before_thankyou', $order->get_id() );
		?>

		<?php if ( $order->has_status( 'failed' ) ) : ?>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php esc_html_e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'kata' ); ?></p>

			<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php esc_html_e( 'Pay', 'kata' ); ?></a>
				<?php if ( is_user_logged_in() ) : ?>
					<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay"><?php esc_html_e( 'My account', 'kata' ); ?></a>
				<?php endif; ?>
			</p>

		<?php else : ?>
			<div class="kata-thankyou-message">
				<img alt="" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI3MiIgaGVpZ2h0PSI3MiIgdmlld0JveD0iMCAwIDcyIDcyIj4NCiAgPGcgaWQ9Imljb24iIHRyYW5zZm9ybT0idHJhbnNsYXRlKDg3LjAwNCAxOSkiPg0KICAgIDxjaXJjbGUgaWQ9IkVsbGlwc2VfODE0NCIgZGF0YS1uYW1lPSJFbGxpcHNlIDgxNDQiIGN4PSIzNiIgY3k9IjM2IiByPSIzNiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTg3LjAwNCAtMTkpIiBmaWxsPSIjZTlmY2U4Ii8+DQogICAgPHBhdGggaWQ9Im5vdW4tY29uZmlybS0xNjM4MjMzIiBkPSJNODUuOTMzLDMyYTE2LDE2LDAsMSwxLDcuNi0zMC4wNzksNy45NzcsNy45NzcsMCwwLDEsLjc2MS40MzVoMGExLjIwNiwxLjIwNiwwLDEsMS0xLjI2OCwyLjA1M2MtLjIwNS0uMTIxLS40MjMtLjI1NC0uNjQtLjM2MmgwYTEzLjU4NSwxMy41ODUsMCwxLDAsNS44Miw2LjEyMkw4Ni40ODksMjEuODhhMS4yMDgsMS4yMDgsMCwwLDEtMS43MTUsMGwtNC44My00LjgzaDBhMS4yMDgsMS4yMDgsMCwxLDEsMS43MTUtMS43bDMuOTczLDMuOTczLDEyLTEyaDBhMS4yMDgsMS4yMDgsMCwwLDEsMS44ODQuMjE3QTE2LjAxMiwxNi4wMTIsMCwwLDEsODUuOTMzLDMyWiIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTEzNi45MzMgMSkiIGZpbGw9IiM1OWNlODgiLz4NCiAgPC9nPg0KPC9zdmc+DQo=" />
				<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'kata' ), $order ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			</div>

			<?php //wc_get_template( 'checkout/order-received.php', array( 'order' => $order ) ); ?>

			<ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

				<li class="woocommerce-order-overview__order order">
					<?php esc_html_e( 'Order number:', 'kata' ); ?>
					<strong><?php echo $order->get_order_number(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<li class="woocommerce-order-overview__date date">
					<?php esc_html_e( 'Date:', 'kata' ); ?>
					<strong><?php echo wc_format_datetime( $order->get_date_created() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
					<li class="woocommerce-order-overview__email email">
						<?php esc_html_e( 'Email:', 'kata' ); ?>
						<strong><?php echo $order->get_billing_email(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
					</li>
				<?php endif; ?>

				<li class="woocommerce-order-overview__total total">
					<?php esc_html_e( 'Total:', 'kata' ); ?>
					<strong><?php echo $order->get_formatted_order_total(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></strong>
				</li>

				<?php if ( $order->get_payment_method_title() ) : ?>
					<li class="woocommerce-order-overview__payment-method method">
						<?php esc_html_e( 'Payment method:', 'kata' ); ?>
						<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
					</li>
				<?php endif; ?>

			</ul>

			<?php if ( $order->get_payment_method_title() ) : ?>
				<div class="kata-thankyou-payment">
					<img alt="" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIzOCIgaGVpZ2h0PSIzOCIgdmlld0JveD0iMCAwIDM4IDM4Ij4NCiAgPGcgaWQ9Imljb24iIHRyYW5zZm9ybT0idHJhbnNsYXRlKDY1LjAwNCAtMikiPg0KICAgIDxjaXJjbGUgaWQ9IkVsbGlwc2VfODE0NCIgZGF0YS1uYW1lPSJFbGxpcHNlIDgxNDQiIGN4PSIxOSIgY3k9IjE5IiByPSIxOSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTY1LjAwNCAyKSIgZmlsbD0iI2Y2ZjdmOCIvPg0KICAgIDxnIGlkPSJJY29uc19TbWFsbF9PcmRlciIgZGF0YS1uYW1lPSJJY29ucyAvIFNtYWxsIC8gT3JkZXIiIHRyYW5zZm9ybT0idHJhbnNsYXRlKC01NS4wMDQgMTQpIj4NCiAgICAgIDxwYXRoIGlkPSJJY29uc19TbWFsbF9CYW5rX0NhcmQiIGRhdGEtbmFtZT0iSWNvbnMgLyBTbWFsbCAvIEJhbmsgQ2FyZCIgZD0iTTE2LDE0SDJBMi4wMDcsMi4wMDcsMCwwLDEsLjAwNSwxMi4xNDlMMCwxMlYyQTIsMiwwLDAsMSwyLDBIMTZhMiwyLDAsMCwxLDIsMlYxMmEyLjAwNiwyLjAwNiwwLDAsMS0xLjg1LDEuOTk0Wk0xLjUsNXY2LjVhMSwxLDAsMCwwLDEsMWgxM2ExLDEsMCwwLDAsMS0xVjVabTEtMy41YTEsMSwwLDAsMC0uOTk0Ljg4M0wxLjUsMi41djFoMTV2LTFhMSwxLDAsMCwwLTEtMVptMyw3aC0yQS41LjUsMCwwLDEsMyw4VjdhLjUuNSwwLDAsMSwuNS0uNWgyQS41LjUsMCwwLDEsNiw3VjhBLjUuNSwwLDAsMSw1LjUsOC41WiIgZmlsbD0iIzk1OWNhNyIvPg0KICAgIDwvZz4NCiAgPC9nPg0KPC9zdmc+DQo=" />
					<p><?php echo esc_html__( 'Pay with', 'kata' ) . '&nbsp;' . wp_kses_post( $order->get_payment_method_title() ); ?></p>
				</div>
			<?php endif; ?>


		<?php endif; ?>

		<?php //do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

	<?php else : ?>

		<?php wc_get_template( 'checkout/order-received.php', array( 'order' => false ) ); ?>

	<?php endif; ?>

</div>
