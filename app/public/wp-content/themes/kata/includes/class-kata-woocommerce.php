<?php
/**
 * Kata WooCommerce.
 *
 * @package Kata
 */

defined( 'ABSPATH' ) || exit;

class Kata_WooCommerce {
	/**
	 * Instance of this class.
	 *
	 * @since   1.3.0
	 */
	public static $instance;

	/**
	 * Provides access to a single instance of a module using the singleton pattern.
	 *
	 * @since   1.3.0
	 *
	 * @return  object
	 */
	public static function get_instance() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 *
	 * @since 1.3.0
	 */
	private function __construct() {

		if ( ! class_exists( 'WooCommerce') ) {
			return;
		}

		$this->hooks();
		$this->register_styling_options();
	}

	/**
	 * Hooks.
	 *
	 * @since 1.3.0
	 */
	private function hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 99 );
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ), 99 );
	}

	/**
	 * Register Styling Options For WooCommerce.
	 *
	 * @since 1.3.0
	 */
	private function register_styling_options() {
		$opt_name = 'Kata_theme_options';

		new \Kirki\Section(
			'kata_woocommerce_styling_option',
			[
				'panel'      => 'woocommerce',
				'title'      => esc_html__( 'Styling Options', 'kata' ),
				'capability' => kata_Helpers::capability(),
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-primary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Primary', 'kata' ),
				'default'  => '#837af5',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-secondary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Secondary', 'kata' ),
				'default'  => '#1d2834',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-button-primary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Button Primary', 'kata' ),
				'default'  => '#f7f6ff',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-button-secondary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Button Secondary', 'kata' ),
				'default'  => '#2acf6c',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-border-button-primary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Border Button Primary', 'kata' ),
				'default'  => '#e0deff',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-text-primary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Text Primary', 'kata' ),
				'default'  => '#737d8b',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-text-secondary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Text Secondary', 'kata' ),
				'default'  => '#959ca7',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-text-tertiary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Text Tertiary', 'kata' ),
				'default'  => '#b7bec9',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-heading-primary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Heading Primary', 'kata' ),
				'default'  => '#4c5765',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-heading-secondary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Heading Secondary', 'kata' ),
				'default'  => '#202122',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-onsale-primary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Onsale Primary', 'kata' ),
				'default'  => '#f37f9b',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-border-primary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Border Primary', 'kata' ),
				'default'  => '#e3e5e7',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-border-secondary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Border Secondary', 'kata' ),
				'default'  => '#f0f3f6',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-border-tertiary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Border Tertiary', 'kata' ),
				'default'  => '#cbc7fb',
				'choices'  => [
					'alpha' => true,
				],
			]
		);
		new \Kirki\Field\Color(
			[
				'settings' => 'kata-color-pagetitle-bg-primary',
				'section'  => 'kata_woocommerce_styling_option',
				'label'    => esc_html__( 'Color Pagetitle BG Primary', 'kata' ),
				'default'  => '#f6f7f8',
				'choices'  => [
					'alpha' => true,
				],
			]
		);

		new \Kirki\Field\Number(
			array(
				'settings'        => 'kata-border-radius-primary',
				'section'         => 'kata_woocommerce_styling_option',
				'label'           => esc_html__( 'Border Radius Primary', 'kata' ),
				'description'     => esc_html__( 'The value is in px', 'kata' ),
				'default'         => 7,
				'choices'         => array(
					'min'  => 0,
					'max'  => 3840,
					'step' => 1,
				),
			)
		);
		new \Kirki\Field\Number(
			array(
				'settings'        => 'kata-border-radius-secondary',
				'section'         => 'kata_woocommerce_styling_option',
				'label'           => esc_html__( 'Border Radius Secondary', 'kata' ),
				'description'     => esc_html__( 'The value is in px', 'kata' ),
				'default'         => 14,
				'choices'         => array(
					'min'  => 0,
					'max'  => 3840,
					'step' => 1,
				),
			)
		);
		new \Kirki\Field\Number(
			array(
				'settings'        => 'kata-font-size-primary',
				'section'         => 'kata_woocommerce_styling_option',
				'label'           => esc_html__( 'Font Size Primary', 'kata' ),
				'description'     => esc_html__( 'The value is in px', 'kata' ),
				'default'         => 15,
				'choices'         => array(
					'min'  => 0,
					'max'  => 3840,
					'step' => 1,
				),
			)
		);
		new \Kirki\Field\Number(
			array(
				'settings'        => 'kata-font-size-secondary',
				'section'         => 'kata_woocommerce_styling_option',
				'label'           => esc_html__( 'Font Size Secondary', 'kata' ),
				'description'     => esc_html__( 'The value is in px', 'kata' ),
				'default'         => 17,
				'choices'         => array(
					'min'  => 0,
					'max'  => 3840,
					'step' => 1,
				),
			)
		);
		new \Kirki\Field\Number(
			array(
				'settings'        => 'kata-font-size-tertiary',
				'section'         => 'kata_woocommerce_styling_option',
				'label'           => esc_html__( 'Font Size Tertiary', 'kata' ),
				'description'     => esc_html__( 'The value is in px', 'kata' ),
				'default'         => 18,
				'choices'         => array(
					'min'  => 0,
					'max'  => 3840,
					'step' => 1,
				),
			)
		);
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 1.3.0
	 */
	public function enqueue() {
		$assets = kata::$assets . 'css/dist/';

		if ( is_product() || is_page() || is_shop() ) {
			wp_enqueue_style( 'kata-woo-single', $assets . 'single-product.css', array(), kata::$version );
		}

		if ( is_cart() ) {
			wp_enqueue_style( 'kata-woo-cart', $assets . 'cart.css', array(), kata::$version );
		}

		if ( is_checkout() ) {
			wp_enqueue_style( 'kata-woo-checkout', $assets . 'checkout.css', array(), kata::$version );
		}

		if ( is_account_page() ) {
			wp_enqueue_style( 'kata-woo-my-account', $assets . 'my-account.css', array(), kata::$version );
		}

		if ( is_shop() || is_archive() || is_product_category() || is_page() || is_product_tag() ) {
			wp_enqueue_style( 'kata-woo-shop', $assets . 'shop.css', array(), kata::$version );
		}
	}

	/**
	 * After setup theme.
	 *
	 * @since 1.3.0
	 */
	public function setup_theme() {
		// Add gallery zoom support
		add_theme_support( 'wc-product-gallery-zoom' );

		// Add gallery lightbox support
		add_theme_support( 'wc-product-gallery-lightbox' );

		// Add gallery slider support
		add_theme_support( 'wc-product-gallery-slider' );

		// Single
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_breadcrumb', 3 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 7 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 15 );
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_show_product_sale_flash', 6 );

		// Cart
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
		add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );

		add_filter( 'woocommerce_cross_sells_columns', 'change_cross_sells_columns' );
		function change_cross_sells_columns( $columns ) {
			return 4;
		}

		// Checkout
		remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 );
		add_action( 'woocommerce_order_review', 'woocommerce_order_review', 10 );
		add_action( 'woocommerce_checkout_payment', 'woocommerce_checkout_payment', 20 );
	}

	/**
	 * After setup theme.
	 *
	 * @since 1.3.0
	 */
	public static function woocommerce_content() {

		if ( is_singular( 'product' ) ) {

			while ( have_posts() ) :
				the_post();
				wc_get_template_part( 'content', 'single-product' );
			endwhile;

		} else {
			?>

			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

				<div id="kata-page-title" class="kata-page-title">
					<div class="container">
						<div class="col-sm-12">
							<h1 class="kata-archive-page-title">
								<span class="kt-tax-name">
									<?php woocommerce_page_title(); ?>
								</span>
							</h1>
						</div>
					</div>
				</div>

			<?php endif; ?>

			<?php do_action( 'woocommerce_archive_description' ); ?>

			<?php if ( woocommerce_product_loop() ) : ?>

				<?php do_action( 'woocommerce_before_shop_loop' ); ?>

				<?php woocommerce_product_loop_start(); ?>

				<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
					<?php while ( have_posts() ) : ?>
						<?php the_post(); ?>
						<?php wc_get_template_part( 'content', 'product' ); ?>
					<?php endwhile; ?>
				<?php endif; ?>

				<?php woocommerce_product_loop_end(); ?>

				<?php do_action( 'woocommerce_after_shop_loop' ); ?>

				<?php
			else :
				do_action( 'woocommerce_no_products_found' );
			endif;
		}
	}

	/**
	 * After setup theme.
	 *
	 * @since 1.3.0
	 */
	public static function my_account_menu_icons( $endpoint ) {
		switch ( $endpoint ) {
			case 'dashboard':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=dashboard-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(291 191)"width=18 /></clipPath></defs><g clip-path=url(#dashboard-clip-path) id=sp-my-account-dashboard-i transform="translate(-291 -191)"><path d=M-7161.2-6714.5a2.8,2.8,0,0,1-2.8-2.8v-10.4a2.8,2.8,0,0,1,2.8-2.8h10.4a2.8,2.8,0,0,1,2.8,2.8v10.4a2.8,2.8,0,0,1-2.8,2.8Zm-2-13.2v10.4a2,2,0,0,0,2,2h10.4a2,2,0,0,0,2-2v-10.4a2,2,0,0,0-2-2h-10.4A2,2,0,0,0-7163.2-6727.7Zm10.4,10.4v-8a.4.4,0,0,1,.4-.4.4.4,0,0,1,.4.4v8a.4.4,0,0,1-.4.4A.4.4,0,0,1-7152.8-6717.3Zm-3.8,0v-5.2a.4.4,0,0,1,.4-.4.4.4,0,0,1,.4.4v5.2a.4.4,0,0,1-.4.4A.4.4,0,0,1-7156.6-6717.3Zm-3.4,0v-6.4a.4.4,0,0,1,.4-.4.4.4,0,0,1,.4.4v6.4a.4.4,0,0,1-.4.4A.4.4,0,0,1-7160-6717.3Zm2.2-10a.4.4,0,0,1-.4-.4.4.4,0,0,1,.4-.4h.8a.4.4,0,0,1,.4.4.4.4,0,0,1-.4.4Zm-3.4,0a.4.4,0,0,1-.4-.4.4.4,0,0,1,.4-.4h.8a.4.4,0,0,1,.4.4.4.4,0,0,1-.4.4Z data-name=sp-my-account-dashboard-i id=sp-my-account-dashboard-i-2 transform="translate(7455.999 6922.499)"/></g></svg>';
			break;
			case 'orders':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=orders-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(292 114)"width=18 /></clipPath></defs><g clip-path=url(#orders-clip-path) id=sp-my-account-orders-i transform="translate(-292 -114)"><path d=M-7233.2-6659.5a2.8,2.8,0,0,1-2.8-2.8v-10.4a2.8,2.8,0,0,1,2.8-2.8h8a.4.4,0,0,1,.283.118l3.2,3.2a.407.407,0,0,1,.117.284v9.6a2.8,2.8,0,0,1-2.8,2.8Zm-2-13.2v10.4a2,2,0,0,0,2,2h8.8a2,2,0,0,0,2-2v-9.435l-2.965-2.965h-7.833A2,2,0,0,0-7235.2-6672.7Zm2.8,9.2a.4.4,0,0,1-.4-.4.4.4,0,0,1,.4-.4h4a.4.4,0,0,1,.4.4.4.4,0,0,1-.4.4Zm0-3.2a.4.4,0,0,1-.4-.4.4.4,0,0,1,.4-.4h7.2a.4.4,0,0,1,.4.4.4.4,0,0,1-.4.4Zm0-3.2a.4.4,0,0,1-.4-.4.4.4,0,0,1,.4-.4h7.2a.4.4,0,0,1,.4.4.4.4,0,0,1-.4.4Z id=sp-my-account-orders transform="translate(7530 6790.5)"/></g></svg>';
			break;
			case 'downloads':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=downloads-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(293 156)"width=18 /></clipPath></defs><g clip-path=url(#downloads-clip-path) id=sp-my-account-downloads-i transform="translate(-293 -156)"><path d=M-6703.2-6485a2.8,2.8,0,0,1-2.8-2.8v-10.4a2.8,2.8,0,0,1,2.8-2.8h8a.4.4,0,0,1,.283.118l3.2,3.2a.412.412,0,0,1,.116.284v9.6a2.8,2.8,0,0,1-2.8,2.8Zm-2-13.2v10.4a2,2,0,0,0,2,2h8.8a2,2,0,0,0,2-2v-9.435l-2.965-2.965h-7.833A2,2,0,0,0-6705.2-6498.2Zm5.933,9.584-2.6-2.423a.432.432,0,0,1-.022-.611.435.435,0,0,1,.613-.021l2.04,1.907v-7.3a.433.433,0,0,1,.432-.433.431.431,0,0,1,.433.4l0,.029v7.137l1.868-1.743a.432.432,0,0,1,.589,0l.022.021a.432.432,0,0,1,0,.589l-.022.022-2.6,2.421a.251.251,0,0,1-.023.021.013.013,0,0,1-.007.007.075.075,0,0,0-.015.012.063.063,0,0,1-.012.006l-.01.009a.025.025,0,0,0-.012.007l-.018.008-.007,0-.015.008-.012,0-.015.005-.012,0-.012,0-.015,0a.34.34,0,0,1-.043.008l-.012,0-.027,0h-.03a.427.427,0,0,1-.065-.005l-.02,0a.437.437,0,0,1-.087.009A.432.432,0,0,1-6699.267-6488.616Z id=sp-my-account-downloads transform="translate(7001 6657.999)"/></g></svg>';
			break;
			case 'edit-address':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=address-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(295 217)"width=18 /></clipPath></defs><g clip-path=url(#address-clip-path) id=sp-my-account-addresses-i transform="translate(-295 -217)"><path d=M177.249,152.048a.375.375,0,0,0-.374.377v.367c-.008.139.061,8.383.181,8.456a.375.375,0,0,0,.388,0c.119-.072.189-8.316.181-8.456v.007h8.117v8.994H182.48a1.9,1.9,0,0,0-3.742,0h-1.491a.375.375,0,0,0,0,.749h1.493a1.9,1.9,0,0,0,3.738,0h4.96a1.9,1.9,0,0,0,3.74,0H192.5a.375.375,0,0,0,.374-.377v-3.677a.376.376,0,0,0-.055-.2l-2.03-3.263a.375.375,0,0,0-.318-.178h-3.979v-2.427a.375.375,0,0,0-.374-.377Zm9.245,3.551h3.767l1.863,2.994v3.2h-.941a1.9,1.9,0,0,0-3.747,0h-.944Zm-5.917,5.37h.029a1.14,1.14,0,1,1-.029,0Zm8.7,0h.03a1.142,1.142,0,1,1-.03,0Z fill-rule=evenodd id=sp-my-account-addresses transform="translate(119.126 67.953)"/></g></svg>';
			break;
			case 'edit-account':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=account-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(149 68)"width=18 /></clipPath></defs><g clip-path=url(#account-clip-path) id=sp-my-account-details-i transform="translate(-149 -68)"><path d=M7.93.019A4.356,4.356,0,0,0,6.116.567,4.4,4.4,0,0,0,4.37,2.435,4.287,4.287,0,0,0,5.18,7.3a4.267,4.267,0,0,0,4.37,1.084,4.086,4.086,0,0,0,1.686-1.025,4.267,4.267,0,0,0,.829-4.991A4.327,4.327,0,0,0,9.675.254,4.385,4.385,0,0,0,7.93.019m.907.822a3.723,3.723,0,0,1,1.371.554,4.19,4.19,0,0,1,.841.807,3.705,3.705,0,0,1,.65,1.547,4.472,4.472,0,0,1-.032,1.281,3.566,3.566,0,0,1-1.6,2.259,3.743,3.743,0,0,1-1.167.454,4.4,4.4,0,0,1-1.346,0A3.576,3.576,0,0,1,5.177,6a3.525,3.525,0,0,1-.17-3.06A3.474,3.474,0,0,1,7.45.884,2.443,2.443,0,0,1,8.217.8a3.731,3.731,0,0,1,.619.039M7,10.488a10.691,10.691,0,0,0-4.151.931,5.55,5.55,0,0,0-1.666,1.192,4.046,4.046,0,0,0-1.169,2.5l-.018.31h16.5v-.063a3.677,3.677,0,0,0-.666-1.951,6.892,6.892,0,0,0-4.3-2.563A16.87,16.87,0,0,0,9.3,10.526C8.937,10.5,7.291,10.471,7,10.488m2.583.846c2.552.269,4.218.936,5.29,2.121a3.87,3.87,0,0,1,.7,1.161l.02.062H8.233c-6.461,0-7.354,0-7.354-.04a3.591,3.591,0,0,1,.252-.628c.651-1.292,2.166-2.2,4.256-2.559a12.077,12.077,0,0,1,2.652-.167c.779.006,1.255.022,1.539.052 fill-rule=evenodd id=sp-my-account-details transform="translate(149.759 69.493)"/></g></svg>';
			break;
			case 'my-wishlist':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=wishlist-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(270 71)"width=18 /></clipPath></defs><g clip-path=url(#wishlist-clip-path) id=sp-my-account-wishlist-i transform="translate(-270 -71)"><path d=M10.749,22.5a.36.36,0,0,1-.255-.106L3.851,15.75a4.624,4.624,0,0,1,6.54-6.538l.359.359.36-.359a4.623,4.623,0,0,1,6.538,6.539h0l-.616.614L11,22.391A.361.361,0,0,1,10.749,22.5ZM7.12,8.58a3.9,3.9,0,0,0-2.758,6.659l6.388,6.386,6.388-6.386a3.9,3.9,0,0,0-5.517-5.517L11,10.337a.362.362,0,0,1-.511,0L9.88,9.722A3.877,3.877,0,0,0,7.12,8.58Zm10.273,6.914h0Z id=sp-my-account-wishlist transform="translate(268.25 64.642)"/></g></svg>';
			break;
			case 'notifications':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=notifications-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(295 293)"width=18 /></clipPath></defs><g clip-path=url(#notifications-clip-path) id=sp-my-account-notification-i transform="translate(-295 -293)"><path d=M34.112,35.876a2.407,2.407,0,0,1-4.781,0H25.209a.707.707,0,0,1-.709-.707v-.85a1.559,1.559,0,0,1,1.558-1.558.142.142,0,0,0,.141-.142v-3.4a5.524,5.524,0,0,1,3.823-5.256V23.7a1.7,1.7,0,1,1,3.4,0v.266a5.524,5.524,0,0,1,3.823,5.256v3.4a.14.14,0,0,0,.141.142,1.559,1.559,0,0,1,1.558,1.558v.85a.709.709,0,0,1-.709.707Zm-.859,0H30.189a1.558,1.558,0,0,0,3.064,0Zm4.84-1.558a.71.71,0,0,0-.709-.708.99.99,0,0,1-.991-.992v-3.4a4.674,4.674,0,0,0-3.5-4.525l-.319-.082V23.7a.85.85,0,1,0-1.7,0v.914l-.319.082a4.673,4.673,0,0,0-3.5,4.525v3.4a.992.992,0,0,1-.991.992.709.709,0,0,0-.709.708v.708H38.093Z id=sp-my-account-notification transform="translate(272.5 272)"/></g></svg>';
			break;
			case 'customer-logout':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=logout-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(295 297)"width=18 /></clipPath></defs><g clip-path=url(#logout-clip-path) id=sp-my-account-logout-i transform="translate(-295 -297)"><path d=M-7268.83-6620.171a1.174,1.174,0,0,1-1.171-1.171v-12.488a1.174,1.174,0,0,1,1.171-1.171h8.156a1.174,1.174,0,0,1,1.17,1.171v1.561a.392.392,0,0,1-.39.391.392.392,0,0,1-.39-.391v-1.561a.392.392,0,0,0-.39-.39h-8.156a.392.392,0,0,0-.39.39v12.488a.391.391,0,0,0,.39.39h8.156a.391.391,0,0,0,.39-.39v-1.561a.391.391,0,0,1,.39-.391.392.392,0,0,1,.39.391v1.561a1.174,1.174,0,0,1-1.17,1.171Zm11.219-3.863a.376.376,0,0,1-.273-.137.385.385,0,0,1-.1-.293.341.341,0,0,1,.137-.273l2.5-2.458h-8.722a.392.392,0,0,1-.39-.391.391.391,0,0,1,.39-.39h8.722l-2.517-2.478a.414.414,0,0,1-.02-.526.412.412,0,0,1,.273-.137.483.483,0,0,1,.293.1l3.2,3.161a.383.383,0,0,1,.117.273.649.649,0,0,1-.1.273l-3.18,3.142c0,.02-.02.02-.039.039a.411.411,0,0,1-.254.1Z id=sp-my-account-logout transform="translate(7566.001 6934)"/></g></svg>';
			break;
			case 'payment-methods':
				echo '<svg height=18 viewBox="0 0 18 18"width=18 xmlns=http://www.w3.org/2000/svg xmlns:xlink=http://www.w3.org/1999/xlink><defs><clipPath id=payment-clip-path><rect fill=#fff height=18 id=rectangle transform="translate(294 293)"width=18 /></clipPath></defs><g clip-path=url(#payment-clip-path) id=sp-my-account-payments-i transform="translate(-294 -293)"><path d=M-7286.2-6710.7a2.8,2.8,0,0,1-2.8-2.8v-7.2a2.8,2.8,0,0,1,2.8-2.8h10.4a2.8,2.8,0,0,1,2.8,2.8v7.2a2.8,2.8,0,0,1-2.8,2.8Zm-2-2.8a2,2,0,0,0,2,2h10.4a2,2,0,0,0,2-2v-6h-14.4Zm0-7.2v.4h14.4v-.4a2,2,0,0,0-2-2h-10.4A2,2,0,0,0-7288.2-6720.7Zm3.6,7.6a.4.4,0,0,1-.4-.4.4.4,0,0,1,.4-.4h.8a.4.4,0,0,1,.4.4.4.4,0,0,1-.4.4Zm-2.4,0a.4.4,0,0,1-.4-.4.4.4,0,0,1,.4-.4h.8a.4.4,0,0,1,.4.4.4.4,0,0,1-.4.4Zm7.2-1.6a.4.4,0,0,1-.4-.4.4.4,0,0,1,.4-.4h4.8a.4.4,0,0,1,.4.4.4.4,0,0,1-.4.4Z id=sp-my-account-payments transform="translate(7584 7019.5)"/></g></svg>';
			break;
		}
		echo '</i>';
	}

}

Kata_WooCommerce::get_instance();
