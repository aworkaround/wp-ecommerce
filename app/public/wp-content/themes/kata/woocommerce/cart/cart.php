<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.9.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>
<div class="kata-cart">
	<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
		<?php do_action( 'woocommerce_before_cart_table' ); ?>

		<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
			<thead>
				<tr>
					<th class="product-name"><?php esc_html_e( 'Item', 'kata' ); ?></th>
					<th class="product-quantity"><?php esc_html_e( 'Qty', 'kata' ); ?></th>
					<th class="product-subtotal"><?php esc_html_e( 'Price', 'kata' ); ?></th>
					<th class="product-remove">&nbsp;</th>
				</tr>
			</thead>
			<tbody>
				<?php do_action( 'woocommerce_before_cart_contents' ); ?>

				<?php
				foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
					$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
					$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

					if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
						$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
						?>
						<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

							<td class="product-name" data-title="<?php esc_attr_e( 'Item', 'kata' ); ?>">
							<?php

							// Thumbnail
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $product_permalink ) {
								echo $thumbnail; // PHPCS: XSS ok.
							} else {
								printf( '<dl class="product-item-wrap"><dt><span class="product-thumbnail"><a href="%s">%s</a></span></dt>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
							}

							/**
							 * Filter the product name.
							 *
							 * @since 2.1.0
							 * @param string $product_name Name of the product in the cart.
							 * @param array $cart_item The product in the cart.
							 * @param string $cart_item_key Key for the product in the cart.
							 */
							if ( ! $product_permalink ) {
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key ) . '&nbsp;';
							} else {
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<dd><a class="product-name" href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_title() ), $cart_item, $cart_item_key );
							}

							do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

							// Meta data.
							echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

							// Backorder notification.
							if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
								echo apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'kata' ) . '</p>', $product_id );
							}
							?>
							</dd>
							</dl>
							</td>

							<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'kata' ); ?>">
							<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input(
									array(
										'input_name'   => "cart[{$cart_item_key}][qty]",
										'input_value'  => $cart_item['quantity'],
										'max_value'    => $_product->get_max_purchase_quantity(),
										'min_value'    => '0',
										'product_name' => $_product->get_name(),
									),
									$_product,
									false
								);
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
							?>
							</td>

							<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'kata' ); ?>">
								<?php
									echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</td>

							<td class="product-remove">
								<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10">
                                                    <path id="Icons_Small_Close" data-name="Icons / Small / Close" d="M9.79.21a.717.717,0,0,1,0,1.014L5.956,5.057,9.674,8.776A.717.717,0,0,1,8.66,9.79L4.942,6.072l-3.6,3.6A.717.717,0,0,1,.326,8.66l3.6-3.6L.21,1.34A.717.717,0,0,1,1.224.326L4.942,4.043,8.776.21A.717.717,0,0,1,9.79.21Z"/>
                                                </svg>
                                            </a>',
											esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
											esc_html__( 'Remove this item', 'kata' ),
											esc_attr( $product_id ),
											esc_attr( $_product->get_sku() )
										),
										$cart_item_key
									);
								?>
							</td>

						</tr>
						<?php
					}
				}
				?>

				<?php do_action( 'woocommerce_cart_contents' ); ?>

				<tr>
					<td colspan="6" class="actions">

						<?php if ( wc_coupons_enabled() ) { ?>
							<div class="coupon">
								<svg class="coupon-icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="13.975" viewBox="0 0 20 13.975">
									<defs>
										<clipPath id="clip-path">
										<rect id="Rectangle_1884" data-name="Rectangle 1884" width="20" height="13.975" transform="translate(104 348)" fill="#b7bec9"/>
										</clipPath>
									</defs>
									<g id="coupon-code" transform="translate(-104 -348)" clip-path="url(#clip-path)">
										<g id="coupon-code-2" data-name="coupon-code" transform="translate(104.21 348.21)">
										<path id="Path_4609" data-name="Path 4609" d="M316.839,178.678a1.839,1.839,0,1,1,1.839-1.839A1.841,1.841,0,0,1,316.839,178.678Zm0-2.452a.613.613,0,1,0,.613.613A.614.614,0,0,0,316.839,176.226Z" transform="translate(-306.419 -172.548)" fill="#b7bec9"/>
										<path id="Path_4610" data-name="Path 4610" d="M421.839,318.678a1.839,1.839,0,1,1,1.839-1.839A1.841,1.841,0,0,1,421.839,318.678Zm0-2.452a.613.613,0,1,0,.613.613A.615.615,0,0,0,421.839,316.226Z" transform="translate(-407.741 -307.644)" fill="#b7bec9"/>
										<path id="Path_4611" data-name="Path 4611" d="M315.616,183.626a.613.613,0,0,1-.471-1.005l6.13-7.356a.613.613,0,1,1,.94.786l-6.13,7.356a.613.613,0,0,1-.47.219Z" transform="translate(-306.421 -172.592)" fill="#b7bec9"/>
										<path id="Path_4616" data-name="Path 4616" d="M88.389,118.485H71.226A1.212,1.212,0,0,1,70,117.259v-3.065a.613.613,0,0,1,.613-.613,1.839,1.839,0,1,0,0-3.678.613.613,0,0,1-.613-.613v-3.065A1.228,1.228,0,0,1,71.226,105H88.389a1.212,1.212,0,0,1,1.226,1.226v11.033A1.212,1.212,0,0,1,88.389,118.485Zm-17.163-3.739v2.513H88.389V106.226H71.226v2.513a3.066,3.066,0,0,1,0,6.007Z" transform="translate(-70 -105)" fill="#b7bec9"/>
										</g>
									</g>
								</svg>
								<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'kata' ); ?>" /> <button type="submit" class="button apply-coupon" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'kata' ); ?>"><?php esc_html_e( 'Apply coupon', 'kata' ); ?></button>
								<?php do_action( 'woocommerce_cart_coupon' ); ?>
							</div>
						<?php } ?>

						<button type="submit" class="button update-cart" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'kata' ); ?>"><?php esc_html_e( 'Update cart', 'kata' ); ?></button>

						<?php do_action( 'woocommerce_cart_actions' ); ?>

						<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
					</td>
				</tr>

				<?php do_action( 'woocommerce_after_cart_contents' ); ?>
			</tbody>
		</table>
		<?php do_action( 'woocommerce_after_cart_table' ); ?>
	</form>

	<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

	<div class="cart-collaterals">
		<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action( 'woocommerce_cart_collaterals' );
		?>
	</div>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
