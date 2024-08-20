<?php
/**
 * Payment methods
 *
 * Shows customer payment methods on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/payment-methods.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.9.0
 */

defined( 'ABSPATH' ) || exit;

$saved_methods = wc_get_customer_saved_methods_list( get_current_user_id() );
$has_methods   = (bool) $saved_methods;
$types         = wc_get_account_payment_methods_types();

do_action( 'woocommerce_before_account_payment_methods', $has_methods ); ?>

<?php if ( $has_methods ) : ?>

	<div class="woocommerce-MyAccount-paymentMethods shop_table shop_table_responsive account-payment-methods-table">
		<ul id="kata-payment-cards" class="kata-payment-cards">
			<?php foreach ( $saved_methods as $type => $methods ) : // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited ?>
				<?php foreach ( $methods as $method ) : ?>
					<li class="payment-method<?php echo ! empty( $method['is_default'] ) ? ' default-payment-method' : ''; ?>">
						<div class="kata-card-brand">
							<?php echo esc_html( wc_get_credit_card_type_label( $method['method']['brand'] ) ); ?>
						</div>

						<div class="kata-card-number">
							<?php echo '****&nbsp;&nbsp;****&nbsp;&nbsp;****&nbsp;&nbsp;' . esc_html( $method['method']['last4'] ); ?>
						</div>

						<div class="kata-card-expires">
							<label> <?php echo esc_html__( 'Expiry Date', 'kata' ); ?></label>
							<?php echo esc_html( $method['expires'] ); ?>
						</div>

						<div class="kata-card-brand-img <?php echo str_replace( " ", "-" , strtolower( wc_get_credit_card_type_label( $method['method']['brand'] ) ) ); ?>"></div>

						<div class="kata-actions-dropdown">
							<span class="dropdown-icon">
								<img alt="" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjE4IiB2aWV3Qm94PSIwIDAgNCAxOCI+DQogIDxwYXRoIGlkPSJJY29uc19TbWFsbF9NZW51XzIiIGRhdGEtbmFtZT0iSWNvbnMgLyBTbWFsbCAvIE1lbnUgMiIgZD0iTTIsMThhMiwyLDAsMSwxLDItMkEyLDIsMCwwLDEsMiwxOFptMC03QTIsMiwwLDEsMSw0LDksMiwyLDAsMCwxLDIsMTFaTTIsNEEyLDIsMCwxLDEsNCwyLDIsMiwwLDAsMSwyLDRaIiBmaWxsPSIjYjdiZWM5Ii8+DQo8L3N2Zz4NCg==" />
							</span>
							<div class="dropdown-content">
								<ul>
									<?php
									foreach ( $method['actions'] as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
										echo '<li class="' . sanitize_html_class( $key ) . '"><a href="' . esc_url( $action['url'] ) . '" class="' . sanitize_html_class( $key ) . '">' . esc_html( $action['name'] ) . '</a></li>';
									}
									?>
								</ul>
							</div>
						</div>
					</li>
				<?php endforeach; ?>

				<?php if ( WC()->payment_gateways->get_available_payment_gateways() ) : ?>
					<a class="payment-method kata-add-payment-method" href="<?php echo esc_url( wc_get_endpoint_url( 'add-payment-method' ) ); ?>">
						<?php esc_html_e( 'Add New Card', 'kata' ); ?>
					</a>
				<?php endif; ?>

			<?php endforeach; ?>
		</ul>
	</div>

<?php else : ?>

	<p class="woocommerce-Message woocommerce-Message--info woocommerce-info"><?php esc_html_e( 'No saved methods found.', 'kata' ); ?></p>
	<div class="woocommerce-MyAccount-paymentMethods shop_table shop_table_responsive account-payment-methods-table">
		<ul id="kata-payment-cards" class="kata-payment-cards">
			<?php if ( WC()->payment_gateways->get_available_payment_gateways() ) : ?>
				<a class="payment-method kata-add-payment-method" href="<?php echo esc_url( wc_get_endpoint_url( 'add-payment-method' ) ); ?>">
					<?php esc_html_e( 'Add New Card', 'kata' ); ?>
				</a>
			<?php endif; ?>
		</ul>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_after_account_payment_methods', $has_methods ); ?>

