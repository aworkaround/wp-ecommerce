<?php
/**
 * Kata Plus Theme Options Helpers.
 *
 * @since   1.0.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kata_Theme_Options_Functions' ) ) {
	class Kata_Theme_Options_Functions {
		/**
		 * Instance of this class.
		 *
		 * @since   1.0.0
		 * @access  public
		 * @var     Theme_Options_Functions
		 */
		public static $instance;

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since   1.0.0
		 * @return   object
		 */
		public static function get_instance() {
			if (self::$instance === null) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor.
		 *
		 * @since    1.0.0
		 */
		public function __construct() {
			$this->actions();
		}

		/**
		 * Add actions.
		 *
		 * @since    1.0.0
		 */
		public function actions() {
			// Responsive
			add_filter( 'wp_head', [$this, 'option_responsive'], 100 );
			// Option Dynamic Styles
			add_action( 'kata_header_template', [$this, 'header_template'] );
			// Option Dynamic Styles
			add_action( 'wp_enqueue_scripts', [$this, 'option_dynamic_styles'], 999999 );
			// Page Title
			add_action( 'kata_page_before_loop', [$this, 'page_title'], -10 );
			// Sidebars
			add_action( 'kata_page_before_the_content', [$this, 'left_sidebar'], -10 );
			add_action( 'kata_page_before_the_content', [$this, 'start_page'] );
			add_action( 'kata_page_after_the_content', [$this, 'end_page'] );
			add_action( 'kata_page_after_the_content', [$this, 'right_sidebar'] );
			// Body Classes
			// add_filter( 'body_class', [$this, 'body_classes'] );
			// Backup customizer
			// add_action( 'wp_head', [$this, 'backup_customizer'] );
			// add_action( 'wp_head', [$this, 'restore_backup_customizer'] );
			add_action( 'kata_footer_bottom_template', [$this, 'footer_bottom_template'] );
		}

		/**
		 * Option Dynamic Styles.
		 *
		 * @since   1.0.0
		 */
		public function header_template() {
			$kata_header_layout = get_theme_mod( 'kata_header_layout', 'left' );
			$header_menu = has_nav_menu( 'kt-header-menu' );
			$header_toggle_menu = has_nav_menu( 'kt-header-toggle-menu' );
			switch ( $kata_header_layout ) {
				case 'left':
					?>
					<div class="col-md-2 kt-h-logo-wrapper">
						<div class="kata-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
								$logo_id = get_theme_mod( 'custom_logo' ) ? get_theme_mod( 'custom_logo' ) : '';
								$logo    = wp_get_attachment_image_src( $logo_id, 'full' ) ? wp_get_attachment_image_src( $logo_id, 'full' )[0] : '';
								if( $logo ) {
									Kata_Helpers::image_resize_output( $logo_id, array( '163', '60' ) );
								} else {
									?>
									<span class="logo-text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
									<span class="logo-slogan"><?php echo esc_html( get_bloginfo( 'description' ) );?></span>
									<?php
								}
								?>
							</a>
						</div> <!-- end .kata-logo -->
					</div>
					<div class="col-md-9 kt-h-menu-wrapper">
						<?php if ( $header_menu ) { ?>
							<div class="kata-menu-wrap">
								<a href="#" class="kt-h-menu-hamburger" aria-label="hamburger">
									<div class="kt-hm-line"></div>
									<div class="kt-hm-line"></div>
									<div class="kt-hm-line"></div>
								</a>
								<?php
								if ( $header_menu ) {
									wp_nav_menu(
										array(
											'container'      => false,
											'theme_location' => 'kt-header-menu',
											'menu_id'        => 'kata-menu-navigation-' . uniqid(),
											'menu_class'     => 'kata-menu-navigation',
											'depth'          => '5',
											'fallback_cb'    => 'wp_page_menu',
											'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
											'echo'           => true,
										)
									);
								}
								?>
							</div> <!-- end .kata-menu-wrap -->
						<?php } ?>
					</div>
					<div class="col-md-1 kt-h-search-wrapper">
						<div class="kata-header-search-wrap kata-text-right">
							<div class="icon-wrap">
								<a href="#" class="kt-header-search" aria-label="search">
									<i class="kata-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"> <g id="search" transform="translate(60.115 -63.894)"> <path id="search-2" data-name="search" d="M14.607,11.086a5.926,5.926,0,1,0-1.046,1.046l.031.033,3.143,3.143a.741.741,0,0,0,1.048-1.048L14.64,11.118ZM13.069,4.308a4.445,4.445,0,1,1-6.286,0A4.445,4.445,0,0,1,13.069,4.308Z" transform="translate(-64.115 62.369)" fill="#4c5765" fill-rule="evenodd"/> </g> </svg></i>
								</a>
							</div>
							<div class="search-form-wrap">
								<?php get_search_form(); ?>
								<a href="#" class="header-close-search" aria-label="search"><i class="kata-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"> <g> </g> <path d="M10.722 9.969l-0.754 0.754 5.278 5.278-5.253 5.253 0.754 0.754 5.253-5.253 5.253 5.253 0.754-0.754-5.253-5.253 5.278-5.278-0.754-0.754-5.278 5.278z" fill="#000000"></path> </svg></i></a>
							</div>
						</div>
					</div>
					<?php if ( $header_menu ) { ?>
						<div class="kata-mobile-menu-navigation"></div>
					<?php } ?>
					<?php
				break;
				case 'left2':
					?>
					<div class="col-md-3 kt-h-logo-wrapper">
						<div class="kata-logo">
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
								$logo_id = get_theme_mod( 'custom_logo' ) ? get_theme_mod( 'custom_logo' ) : '';
								$logo    = wp_get_attachment_image_src( $logo_id, 'full' ) ? wp_get_attachment_image_src( $logo_id, 'full' )[0] : '';
								if( $logo ) {
									Kata_Helpers::image_resize_output( $logo_id, array( '163', '60' ) );
								} else {
									?>
									<span class="logo-text"><?php echo esc_html( get_bloginfo( 'name' ) ); ?></span>
									<span class="logo-slogan"><?php echo esc_html( get_bloginfo( 'description' ) );?></span>
									<?php
								}
								?>
							</a>
						</div> <!-- end .kata-logo -->
					</div>
					<div class="col-md-9 kt-h-menu-wrapper">
						<?php if ( $header_menu ) { ?>
							<div class="kata-menu-wrap kata-text-right">
								<a href="#" class="kt-h-menu-hamburger" aria-label="hamburger">
									<div class="kt-hm-line"></div>
									<div class="kt-hm-line"></div>
									<div class="kt-hm-line"></div>
								</a>
								<?php
								if ( $header_menu ) {
									wp_nav_menu(
										array(
											'container'      => false,
											'theme_location' => 'kt-header-menu',
											'menu_id'        => 'kata-menu-navigation-' . uniqid(),
											'menu_class'     => 'kata-menu-navigation',
											'depth'          => '5',
											'fallback_cb'    => 'wp_page_menu',
											'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
											'echo'           => true,
										)
									);
								}
								?>
							</div> <!-- end .kata-menu-wrap -->
						<?php } ?>
					</div>
					<?php if ( $header_menu ) { ?>
						<div class="kata-mobile-menu-navigation"></div>
					<?php } ?>
					<?php
				break;
				case 'center':
					?>
					<div class="col-md-12 kata-text-center kt-h-logo-wrapper">
						<div class="kata-logo">
							<a class="kata-default-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
								$logo_id = get_theme_mod( 'custom_logo' ) ? get_theme_mod( 'custom_logo' ) : '';
								$logo    = wp_get_attachment_image_src( $logo_id, 'full' ) ? wp_get_attachment_image_src( $logo_id, 'full' )[0] : '';
								if( $logo ) {
									Kata_Helpers::image_resize_output( $logo_id, array( '163', '60' ) );
								} else {
									?> <h4><strong><?php echo esc_html( get_bloginfo( 'name' ) ); ?></strong></h4>
									<?php
								}
								?>
							</a>
						</div> <!-- end .kata-logo -->
					</div>
					<div class="col-md-12 kata-text-center kt-h-menu-wrapper">
						<div class="kata-menu-wrap">
							<a href="#" class="kt-h-menu-hamburger" aria-label="hamburger">
								<div class="kt-hm-line"></div>
								<div class="kt-hm-line"></div>
								<div class="kt-hm-line"></div>
							</a>
							<?php
							if ( $header_menu ) {
								wp_nav_menu(
									array(
										'container'      => false,
										'theme_location' => 'kt-header-menu',
										'menu_id'        => 'kata-menu-navigation-' . uniqid(),
										'menu_class'     => 'kata-menu-navigation',
										'depth'          => '5',
										'fallback_cb'    => 'wp_page_menu',
										'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
										'echo'           => true,
									)
								);
							}
							?>
						</div> <!-- end .kata-menu-wrap -->
					</div>
					<div class="kata-mobile-menu-navigation"></div>
					<?php
				break;
				case 'right':
					?>
					<div class="col-md-1 kt-h-search-wrapper">
						<div class="kata-header-search-wrap kata-text-left">
							<div class="icon-wrap">
								<a href="#" class="kt-header-search" aria-label="search">
									<i class="kata-icon"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"> <g id="search" transform="translate(60.115 -63.894)"> <path id="search-2" data-name="search" d="M14.607,11.086a5.926,5.926,0,1,0-1.046,1.046l.031.033,3.143,3.143a.741.741,0,0,0,1.048-1.048L14.64,11.118ZM13.069,4.308a4.445,4.445,0,1,1-6.286,0A4.445,4.445,0,0,1,13.069,4.308Z" transform="translate(-64.115 62.369)" fill="#4c5765" fill-rule="evenodd"/> </g> </svg></i>
								</a>
							</div>
							<div class="search-form-wrap">
								<?php get_search_form(); ?>
								<a href="#" class="header-close-search" aria-label="search"><i class="kata-icon"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"> <g> </g> <path d="M10.722 9.969l-0.754 0.754 5.278 5.278-5.253 5.253 0.754 0.754 5.253-5.253 5.253 5.253 0.754-0.754-5.253-5.253 5.278-5.278-0.754-0.754-5.278 5.278z" fill="#000000"></path> </svg></i></a>
							</div>
						</div>
					</div>
					<div class="col-md-9 kata-text-right kt-h-menu-wrapper">
						<div class="kata-menu-wrap">
							<a href="#" class="kt-h-menu-hamburger" aria-label="hamburger">
								<div class="kt-hm-line"></div>
								<div class="kt-hm-line"></div>
								<div class="kt-hm-line"></div>
							</a>
							<?php
							if ( $header_menu ) {
								wp_nav_menu(
									array(
										'container'      => false,
										'theme_location' => 'kt-header-menu',
										'menu_id'        => 'kata-menu-navigation-' . uniqid(),
										'menu_class'     => 'kata-menu-navigation',
										'depth'          => '5',
										'fallback_cb'    => 'wp_page_menu',
										'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
										'echo'           => true,
									)
								);
							}
							?>
						</div> <!-- end .kata-menu-wrap -->
					</div>
					<div class="col-md-2 kt-h-logo-wrapper">
						<div class="kata-logo">
							<a class="kata-default-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
								$logo_id = get_theme_mod( 'custom_logo' ) ? get_theme_mod( 'custom_logo' ) : '';
								$logo    = wp_get_attachment_image_src( $logo_id, 'full' ) ? wp_get_attachment_image_src( $logo_id, 'full' )[0] : '';
								if( $logo ) {
									Kata_Helpers::image_resize_output( $logo_id, array( '163', '60' ) );
								} else {
									?> <h4><strong><?php echo esc_html( get_bloginfo( 'name' ) ); ?></strong></h4>
									<?php
								}
								?>
							</a>
						</div> <!-- end .kata-logo -->
					</div>
					<div class="kata-mobile-menu-navigation"></div>
					<?php
				break;
				case 'right2':
					?>
					<div class="col-md-9 kata-text-left kt-h-menu-wrapper">
						<div class="kata-menu-wrap kata-text-left">
							<a href="#" class="kt-h-menu-hamburger" aria-label="hamburger">
								<div class="kt-hm-line"></div>
								<div class="kt-hm-line"></div>
								<div class="kt-hm-line"></div>
							</a>
							<?php
							if ( $header_menu ) {
								wp_nav_menu(
									array(
										'container'      => false,
										'theme_location' => 'kt-header-menu',
										'menu_id'        => 'kata-menu-navigation-' . uniqid(),
										'menu_class'     => 'kata-menu-navigation',
										'depth'          => '5',
										'fallback_cb'    => 'wp_page_menu',
										'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
										'echo'           => true,
									)
								);
							}
							?>
						</div> <!-- end .kata-menu-wrap -->
					</div>
					<div class="col-md-3 kt-h-logo-wrapper kata-text-right">
						<div class="kata-logo">
							<a class="kata-default-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
								<?php
								$logo_id = get_theme_mod( 'custom_logo' ) ? get_theme_mod( 'custom_logo' ) : '';
								$logo    = wp_get_attachment_image_src( $logo_id, 'full' ) ? wp_get_attachment_image_src( $logo_id, 'full' )[0] : '';
								if( $logo ) {
									Kata_Helpers::image_resize_output( $logo_id, array( '163', '60' ) );
								} else {
									?> <h4><strong><?php echo esc_html( get_bloginfo( 'name' ) ); ?></strong></h4>
									<?php
								}
								?>
							</a>
						</div> <!-- end .kata-logo -->
					</div>
					<div class="kata-mobile-menu-navigation"></div>
					<?php
				break;
			}
		}

		/**
		 * Option Dynamic Styles.
		 *
		 * @since   1.0.0
		 */
		public function footer_bottom_template() {
			$kata_footer_bottom_layout 				= get_theme_mod( 'kata_footer_bottom_layout', 'left' );
			$kata_footer_bottom_left_section		= get_theme_mod( 'kata_footer_bottom_left_section', 'custom-text' );
			$kata_footer_bottom_left_custom_text 	= get_theme_mod( 'kata_footer_bottom_left_custom_text', '' );
			$kata_footer_bottom_right_section 		= get_theme_mod( 'kata_footer_bottom_right_section', 'footer-menu' );
			$kata_footer_bottom_right_custom_text 	= get_theme_mod( 'kata_footer_bottom_right_custom_text', '' );
			switch ( $kata_footer_bottom_layout ) {
				case 'left':
					?>
					<div class="col-md-6 kata-footer-bottom-column-left">
						<?php if ( 'custom-text' === $kata_footer_bottom_left_section ) { ?>
							<p class="copyright"><?php echo esc_html( str_replace( '[kata-date]', date( 'Y' ), $kata_footer_bottom_left_custom_text ) ); ?></p>
						<?php } ?>
						<?php if ( 'footer-menu' === $kata_footer_bottom_left_section ) { ?>
							<?php
								if ( has_nav_menu( 'kt-foot-menu' ) ) {
									wp_nav_menu(
										array(
											'container'      => false,
											'theme_location' => 'kt-foot-menu',
											'menu_id'        => 'kata-menu-navigation-' . uniqid(),
											'menu_class'     => 'kata-menu-navigation kata-footer-menu-navigation',
											'depth'          => '5',
											'fallback_cb'    => 'wp_page_menu',
											'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
											'echo'           => true,
										)
									);
								}
							?>
						<?php } ?>
					</div>
					<div class="col-md-6 kata-footer-bottom-column-right">
						<?php if ( 'custom-text' === $kata_footer_bottom_right_section ) { ?>
							<p class="copyright"><?php echo esc_html( str_replace( '[kata-date]', date( 'Y' ), $kata_footer_bottom_right_custom_text ) ); ?></p>
						<?php } ?>
						<?php if ( 'footer-menu' === $kata_footer_bottom_right_section ) { ?>
							<?php
								if ( has_nav_menu( 'kt-foot-menu' ) ) {
									wp_nav_menu(
										array(
											'container'      => false,
											'theme_location' => 'kt-foot-menu',
											'menu_id'        => 'kata-menu-navigation-' . uniqid(),
											'menu_class'     => 'kata-menu-navigation kata-footer-menu-navigation',
											'depth'          => '5',
											'fallback_cb'    => 'wp_page_menu',
											'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
											'echo'           => true,
										)
									);
								}
							?>
						<?php } ?>
					</div>
					<?php
				break;
				case 'center':
					?>
					<div class="col-md-12">
						<?php if ( 'custom-text' === $kata_footer_bottom_left_section ) { ?>
							<p class="copyright"><?php echo esc_html( str_replace( '[kata-date]', date( 'Y' ), $kata_footer_bottom_left_custom_text ) ); ?></p>
						<?php } ?>
						<?php if ( 'footer-menu' === $kata_footer_bottom_left_section ) { ?>
							<?php
								if ( has_nav_menu( 'kt-foot-menu' ) ) {
									wp_nav_menu(
										array(
											'container'      => false,
											'theme_location' => 'kt-foot-menu',
											'menu_id'        => 'kata-menu-navigation-' . uniqid(),
											'menu_class'     => 'kata-menu-navigation kata-footer-menu-navigation',
											'depth'          => '5',
											'fallback_cb'    => 'wp_page_menu',
											'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
											'echo'           => true,
										)
									);
								}
							?>
						<?php } ?>
						<?php if ( 'widget' === $kata_footer_bottom_left_section ) { ?>
							<?php
								if ( is_active_sidebar( 'kata-footr-bot-left-sidebar' ) ) {
									dynamic_sidebar( 'kata-footr-bot-left-sidebar' );
								}
							?>
						<?php } ?>
						<?php if ( 'footer-menu' === $kata_footer_bottom_right_section ) { ?>
							<?php
								if ( has_nav_menu( 'kt-foot-menu' ) ) {
									wp_nav_menu(
										array(
											'container'      => false,
											'theme_location' => 'kt-foot-menu',
											'menu_id'        => 'kata-menu-navigation-' . uniqid(),
											'menu_class'     => 'kata-menu-navigation kata-footer-menu-navigation',
											'depth'          => '5',
											'fallback_cb'    => 'wp_page_menu',
											'items_wrap'     => '<ul id="%1$s" class="%2$s" >%3$s</ul>',
											'echo'           => true,
										)
									);
								}
							?>
						<?php } ?>
						<?php if ( 'widget' === $kata_footer_bottom_right_section ) { ?>
							<?php
								if ( is_active_sidebar( 'kata-footr-bot-center-sidebar' ) ) {
									dynamic_sidebar( 'kata-footr-bot-center-sidebar' );
								}
							?>
						<?php } ?>
						<?php if ( 'custom-text' === $kata_footer_bottom_right_section ) { ?>
							<p class="copyright"><?php echo esc_html( str_replace( '[kata-date]', date( 'Y' ), $kata_footer_bottom_right_custom_text ) ); ?></p>
						<?php } ?>
					</div>
					<?php
				break;
			}
		}

		/**
		 * Option Dynamic Styles.
		 *
		 * @param $classes return body custom classes added by theme.
		 * @since   1.0.0
		 */
		public function body_classes( $classes ) {
			$colorbase = get_theme_mod('kata_base_color', '');
			if (!empty($colorbase)) {
				$classes[] = 'kata-color-base';
			}

			return $classes;
		}

		/**
		 * Option Dynamic Styles.
		 *
		 * @since   1.0.0
		 */
		public function option_dynamic_styles() {
			$css = '';

			// Body Typography
			$body_typo_status		= get_theme_mod( 'kata_body_typography_status', 'disable' );
			$body_font_family		= get_theme_mod( 'kata_body_font_family', 'select-font' );
			$body_font_properties	= get_theme_mod( 'kata_body_font_properties', ['font-size' => '15px', 'font-weight' => '400', 'letter-spacing' => '0px', 'line-height' => '1.5'] );
			$body_font_color		= get_theme_mod( 'kata_body_font_color' );
			if ( 'enabel' == $body_typo_status ) {
				$css .= 'body{';
				$css .= $body_font_family ? 'font-family:' . $body_font_family . ';' :'';
				$css .= $body_font_properties['font-size'] ? 'font-size:' . $body_font_properties['font-size'] . ';' : '';
				$css .= $body_font_properties['font-weight'] ? 'font-weight:' . $body_font_properties['font-weight'] . ';' : '';
				$css .= $body_font_properties['letter-spacing'] ? 'letter-spacing:' . $body_font_properties['letter-spacing'] . ';' : '';
				$css .= $body_font_properties['line-height'] ? 'line-height:' . $body_font_properties['line-height'] . ';' : '';
				$css .= $body_font_color ? 'color:' . $body_font_color . ';' : '';
				$css .= '}';
			}

			// Heading Typography
			$headings_typo_status		= get_theme_mod( 'kata_headings_typography_status', 'disable' );
			$headings_font_family		= get_theme_mod( 'kata_headings_font_family', 'select-font' );
			$headings_font_properties	= get_theme_mod( 'kata_headings_font_properties', ['font-size' => '15px', 'font-weight' => '400', 'letter-spacing' => '0px', 'line-height' => '1.5'] );
			$headings_font_color		= get_theme_mod( 'kata_headings_font_color' );
			if ( 'enabel' == $headings_typo_status ) {
				$css .= 'h1,h2,h3,h4,h5,h6{';
				$css .= $headings_font_family ? 'font-family:' . $headings_font_family . ';' :'';
				$css .= $headings_font_properties['font-size'] ? 'font-size:' . $headings_font_properties['font-size'] . ';' : '';
				$css .= $headings_font_properties['font-weight'] ? 'font-weight:' . $headings_font_properties['font-weight'] . ';' : '';
				$css .= $headings_font_properties['letter-spacing'] ? 'letter-spacing:' . $headings_font_properties['letter-spacing'] . ';' : '';
				$css .= $headings_font_properties['line-height'] ? 'line-height:' . $headings_font_properties['line-height'] . ';' : '';
				$css .= $headings_font_color ? 'color:' . $headings_font_color . ';' : '';
				$css .= '}';
			}

			// Menu Navigation Typography
			$nav_menu_typo_status		= get_theme_mod( 'kata_nav_menu_typography_status', 'disable' );
			$nav_menu_font_family		= get_theme_mod( 'kata_nav_menu_font_family', 'select-font' );
			$nav_menu_font_properties	= get_theme_mod( 'kata_nav_menu_font_properties', ['font-size' => '15px', 'font-weight' => '400', 'letter-spacing' => '0px', 'line-height' => '1.5'] );
			$nav_menu_font_color		= get_theme_mod( 'kata_nav_menu_font_color' );
			if ( 'enabel' == $nav_menu_typo_status ) {
				$css .= '.kata-menu-navigation li a{';
				$css .= $nav_menu_font_family ? 'font-family:' . $nav_menu_font_family . ';' :'';
				$css .= $nav_menu_font_properties['font-size'] ? 'font-size:' . $nav_menu_font_properties['font-size'] . ';' : '';
				$css .= $nav_menu_font_properties['font-weight'] ? 'font-weight:' . $nav_menu_font_properties['font-weight'] . ';' : '';
				$css .= $nav_menu_font_properties['letter-spacing'] ? 'letter-spacing:' . $nav_menu_font_properties['letter-spacing'] . ';' : '';
				$css .= $nav_menu_font_properties['line-height'] ? 'line-height:' . $nav_menu_font_properties['line-height'] . ';' : '';
				$css .= $nav_menu_font_color ? 'color:' . $nav_menu_font_color . ';' : '';
				$css .= '}';
			}

			// Mobile Header Templates
			$kata_mobile_header_layout = get_theme_mod( 'kata_mobile_header_layout', 'left' );
			if ( 'right' === $kata_mobile_header_layout ) {
				$css .= '@media(max-width:1024px){.kata-header-mobile-template-right .row { flex-direction: row-reverse; }.kt-h-logo-wrapper[class*="col-"] { text-align: right; } .kt-h-menu-wrapper[class*="col-"] { text-align: left; }}';
			}

			// Full width Header
			$kata_full_width_header = get_theme_mod( 'kata_full_width_header', 'off' );
			if ( $kata_full_width_header == 'on' ) {
				$css .= '.kata-header .container { max-width: 100%; }';
			}

			// Full width Header
			if (
				get_theme_mod( 'kata_header_border' ) ||
				get_theme_mod( 'kata_header_border_color' ) ||
				get_theme_mod( 'kata_header_background' ) ||
				get_theme_mod( 'kata_header_height' )
			) {
				$css .= '#kata-header {';
			}
			if ( get_theme_mod( 'kata_header_border' ) ) {
				$css .= 'border-bottom: ' . get_theme_mod( 'kata_header_border' ) . 'px solid';
				if ( get_theme_mod( 'kata_header_border_color' ) ) {
					$css .= ' ' . get_theme_mod( 'kata_header_border_color' ) . ';';
				}
			}

			// Header Background
			if ( get_theme_mod( 'kata_header_background' ) ) {
				$css .= 'background-color:' . get_theme_mod( 'kata_header_background' ) . ';';
			}

			// Header Height
			if ( get_theme_mod( 'kata_header_height' ) > 0 ) {
				$css .= 'height:' . get_theme_mod( 'kata_header_height' ) . 'px;';
			}

			if (
				get_theme_mod( 'kata_header_border' ) ||
				get_theme_mod( 'kata_header_border_color' ) ||
				get_theme_mod( 'kata_header_background' ) ||
				get_theme_mod( 'kata_header_height' )
			) {
				$css .= '}';
			}

			// Header menu color
			if ( get_theme_mod( 'kata_header_menu_color' ) ) {
				$css .= '.kata-menu-navigation li.menu-item a, .kata-menu-navigation ul.sub-menu:not(.mega-menu-content) li.menu-item a { color:' . get_theme_mod( 'kata_header_menu_color' ) . ';}';
			}

			// Header menu hover color
			if ( get_theme_mod( 'kata_header_menu_hover_color' ) ) {
				$css .= '.kata-menu-navigation.kt-header-toggle-menu ul:not(.mega-menu-content) li.current-menu-ancestor > a, .kata-menu-navigation > li.menu-item.current-menu-ancestor > a, .kata-menu-navigation > li.menu-item.current-menu-item > a, .kata-menu-navigation .sub-menu li.menu-item.current-menu-item > a, .kata-menu-navigation ul:not(.mega-menu-content) > li.menu-item.current-menu-parent > a, .kata-menu-navigation ul:not(.mega-menu-content) li.menu-item.current-menu-parent ul > li.current-menu-item a, .kata-menu-navigation ul.sub-menu:not(.mega-menu-content) li.menu-item:hover > a, .kata-menu-navigation li.menu-item:hover > a { color:' . get_theme_mod( 'kata_header_menu_hover_color' ) . ';}';
			}

			// Footer Style
			if (
				get_theme_mod( 'kata_footer_background' ) ||
				get_theme_mod( 'kata_footer_menu_color' ) ||
				get_theme_mod( 'kata_footer_menu_hover_color' ) ||
				get_theme_mod( 'kata_footer_height' ) ||
				get_theme_mod( 'kata_footer_border' ) ||
				get_theme_mod( 'kata_footer_border_color' ) ||
				get_theme_mod( 'kata_footer_full_width' )
			) {
				$css .= '#kata-footer {';
			}

			if ( get_theme_mod( 'kata_footer_background' ) ) {
				$css .= 'background-color:' . get_theme_mod( 'kata_footer_background' ) . ';';
			}

			if ( get_theme_mod( 'kata_footer_padding' ) ) {
				$top = $right = $bottom = $left = '';
				if ( isset( get_theme_mod( 'kata_footer_padding' )['top'] ) && ! empty( get_theme_mod( 'kata_footer_padding' )['top'] ) ) {
					$top = strpos( get_theme_mod( 'kata_footer_padding' )['top'], 'px' ) || strpos( get_theme_mod( 'kata_footer_padding' )['top'], '%' ) || strpos( get_theme_mod( 'kata_footer_padding' )['top'], 'em' ) ? get_theme_mod( 'kata_footer_padding' )['top'] . ' ' : get_theme_mod( 'kata_footer_padding' )['top'] . 'px ';
				}
				if ( isset( get_theme_mod( 'kata_footer_padding' )['right'] ) && ! empty( get_theme_mod( 'kata_footer_padding' )['right'] ) ) {
					$right = strpos( get_theme_mod( 'kata_footer_padding' )['right'], 'px' ) || strpos( get_theme_mod( 'kata_footer_padding' )['right'], '%' ) || strpos( get_theme_mod( 'kata_footer_padding' )['right'], 'em' ) ? get_theme_mod( 'kata_footer_padding' )['right'] . ' ' : get_theme_mod( 'kata_footer_padding' )['right'] . 'px ';
				}
				if ( isset( get_theme_mod( 'kata_footer_padding' )['bottom'] ) && ! empty( get_theme_mod( 'kata_footer_padding' )['bottom'] ) ) {
					$bottom = strpos(get_theme_mod( 'kata_footer_padding' )['bottom'], 'px' ) || strpos( get_theme_mod( 'kata_footer_padding' )['bottom'], '%' ) || strpos( get_theme_mod( 'kata_footer_padding' )['bottom'], 'em' ) ? get_theme_mod( 'kata_footer_padding' )['bottom'] . ' ' : get_theme_mod( 'kata_footer_padding' )['bottom'] . 'px ';
				}
				if ( isset( get_theme_mod( 'kata_footer_padding' )['left'] ) && ! empty( get_theme_mod( 'kata_footer_padding' )['left'] ) ) {
					$left = strpos( get_theme_mod( 'kata_footer_padding' )['left'], 'px' ) || strpos( get_theme_mod( 'kata_footer_padding' )['left'], '%' ) || strpos( get_theme_mod( 'kata_footer_padding' )['left'], 'em' ) ? get_theme_mod( 'kata_footer_padding' )['left'] . ' ' : get_theme_mod( 'kata_footer_padding' )['left'] . 'px ';
				}
				if ( ! empty( $top ) || ! empty( $right ) || ! empty( $bottom ) || ! empty( $left ) ) {
					$css .= 'padding:' . $top . $right . $bottom . $left . ';';
				}
			}

			if ( get_theme_mod( 'kata_footer_height' ) > 0 ) {
				$css .= 'height:' . get_theme_mod( 'kata_footer_height' ) . 'px;';
			}

			if (
				get_theme_mod( 'kata_footer_background' ) ||
				get_theme_mod( 'kata_footer_menu_color' ) ||
				get_theme_mod( 'kata_footer_menu_hover_color' ) ||
				get_theme_mod( 'kata_footer_height' ) ||
				get_theme_mod( 'kata_footer_border' ) ||
				get_theme_mod( 'kata_footer_border_color' ) ||
				get_theme_mod( 'kata_footer_full_width' )
			) {
				$css .= '}';
			}

			if ( get_theme_mod( 'kata_footer_full_width' ) ) {
				$css .= '#kata-footer .container { max-width:100%;}';
			}

			if ( get_theme_mod( 'kata_footer_text_color' ) ) {
				$css .= '#kata-footer p, #kata-footer h1, #kata-footer h2';
				$css .= '#kata-footer h3,  #kata-footer h4, #kata-footer h5 { max-width:100%;}';
				$css .= '#kata-footer h6, #kata-footer span, #kata-footer strong { color:' . get_theme_mod( 'kata_footer_text_color' ) . '}';
			}

			if ( get_theme_mod( 'kata_footer_border' ) ) {
				$css .= '.kata-footer-bot { border-top:' . get_theme_mod( 'kata_footer_border' ) . 'px solid';
				if ( get_theme_mod( 'kata_footer_border_color' ) ) {
					$css .= ' ' . get_theme_mod( 'kata_footer_border_color' ) . ';}';
				}
			}

			if ( get_theme_mod( 'kata_footer_menu_color' ) ) {
				$css .= '#kata-footer ul li a { color:' . get_theme_mod( 'kata_footer_menu_color' ) . '; }';
			}

			if ( get_theme_mod( 'kata_footer_menu_hover_color' ) ) {
				$css .= '#kata-footer ul li:hover a { color:' . get_theme_mod( 'kata_footer_menu_hover_color' ) . '; }';
			}

			// Footer Bottom Style
			if (
				get_theme_mod( 'kata_footer_bottom_background' ) ||
				get_theme_mod( 'kata_footer_bottom_menu_color' ) ||
				get_theme_mod( 'kata_footer_bottom_menu_hover_color' ) ||
				get_theme_mod( 'kata_footer_bottom_height' ) ||
				get_theme_mod( 'kata_footer_bottom_border' ) ||
				get_theme_mod( 'kata_footer_bottom_border_color' ) ||
				get_theme_mod( 'kata_footer_bottom_full_width' )
			) {
				$css .= '#kata-footer #kata-footer-bot {';
			}

			if ( get_theme_mod( 'kata_footer_bottom_background' ) ) {
				$css .= 'background-color:' . get_theme_mod( 'kata_footer_bottom_background' ) . ';';
			}

			if ( get_theme_mod( 'kata_footer_bottom_padding' ) ) {
				$top = $right = $bottom = $left = '';
				if ( isset( get_theme_mod( 'kata_footer_bottom_padding' )['top'] ) && ! empty( get_theme_mod( 'kata_footer_bottom_padding' )['top'] ) ) {
					$top = strpos( get_theme_mod( 'kata_footer_bottom_padding' )['top'], 'px' ) || strpos( get_theme_mod( 'kata_footer_bottom_padding' )['top'], '%' ) || strpos( get_theme_mod( 'kata_footer_bottom_padding' )['top'], 'em' ) ? get_theme_mod( 'kata_footer_bottom_padding' )['top'] . ' ' : get_theme_mod( 'kata_footer_bottom_padding' )['top'] . 'px ';
				}
				if ( isset( get_theme_mod( 'kata_footer_bottom_padding' )['right'] ) && ! empty( get_theme_mod( 'kata_footer_bottom_padding' )['right'] ) ) {
					$right = strpos( get_theme_mod( 'kata_footer_bottom_padding' )['right'], 'px' ) || strpos( get_theme_mod( 'kata_footer_bottom_padding' )['right'], '%' ) || strpos( get_theme_mod( 'kata_footer_bottom_padding' )['right'], 'em' ) ? get_theme_mod( 'kata_footer_bottom_padding' )['right'] . ' ' : get_theme_mod( 'kata_footer_bottom_padding' )['right'] . 'px ';
				}
				if ( isset( get_theme_mod( 'kata_footer_bottom_padding' )['bottom'] ) && ! empty( get_theme_mod( 'kata_footer_bottom_padding' )['bottom'] ) ) {
					$bottom = strpos(get_theme_mod( 'kata_footer_bottom_padding' )['bottom'], 'px' ) || strpos( get_theme_mod( 'kata_footer_bottom_padding' )['bottom'], '%' ) || strpos( get_theme_mod( 'kata_footer_bottom_padding' )['bottom'], 'em' ) ? get_theme_mod( 'kata_footer_bottom_padding' )['bottom'] . ' ' : get_theme_mod( 'kata_footer_bottom_padding' )['bottom'] . 'px ';
				}
				if ( isset( get_theme_mod( 'kata_footer_bottom_padding' )['left'] ) && ! empty( get_theme_mod( 'kata_footer_bottom_padding' )['left'] ) ) {
					$left = strpos( get_theme_mod( 'kata_footer_bottom_padding' )['left'], 'px' ) || strpos( get_theme_mod( 'kata_footer_bottom_padding' )['left'], '%' ) || strpos( get_theme_mod( 'kata_footer_bottom_padding' )['left'], 'em' ) ? get_theme_mod( 'kata_footer_bottom_padding' )['left'] . ' ' : get_theme_mod( 'kata_footer_bottom_padding' )['left'] . 'px ';
				}
				if ( ! empty( $top ) || ! empty( $right ) || ! empty( $bottom ) || ! empty( $left ) ) {
					$css .= 'padding:' . $top . $right . $bottom . $left . ';';
				}
			}

			if ( get_theme_mod( 'kata_footer_bottom_height' ) > 0 ) {
				$css .= 'height:' . get_theme_mod( 'kata_footer_bottom_height' ) . 'px;';
			}

			if (
				get_theme_mod( 'kata_footer_bottom_background' ) ||
				get_theme_mod( 'kata_footer_bottom_menu_color' ) ||
				get_theme_mod( 'kata_footer_bottom_menu_hover_color' ) ||
				get_theme_mod( 'kata_footer_bottom_height' ) ||
				get_theme_mod( 'kata_footer_bottom_border' ) ||
				get_theme_mod( 'kata_footer_bottom_border_color' ) ||
				get_theme_mod( 'kata_footer_bottom_full_width' )
			) {
				$css .= '}';
			}

			if ( get_theme_mod( 'kata_footer_bottom_full_width' ) ) {
				$css .= '#kata-footer #kata-footer-bot .container { max-width:100%;}';
			}

			if ( get_theme_mod( 'kata_footer_bottom_text_color' ) ) {
				$css .= '#kata-footer #kata-footer-bot p, #kata-footer #kata-footer-bot h1, #kata-footer #kata-footer-bot h2';
				$css .= '#kata-footer #kata-footer-bot h3,  #kata-footer #kata-footer-bot h4, #kata-footer #kata-footer-bot h5 { max-width:100%;}';
				$css .= '#kata-footer #kata-footer-bot h6, #kata-footer #kata-footer-bot span, #kata-footer #kata-footer-bot strong { color:' . get_theme_mod( 'kata_footer_bottom_text_color' ) . '}';
			}

			if ( get_theme_mod( 'kata_footer_bottom_border' ) ) {
				$css .= '.kata-footer-bot { border-top:' . get_theme_mod( 'kata_footer_bottom_border' ) . 'px solid';
				if ( get_theme_mod( 'kata_footer_bottom_border_color' ) ) {
					$css .= ' ' . get_theme_mod( 'kata_footer_bottom_border_color' ) . ';}';
				}
			}

			if ( get_theme_mod( 'kata_footer_bottom_menu_color' ) ) {
				$css .= '#kata-footer #kata-footer-bot ul li a { color:' . get_theme_mod( 'kata_footer_bottom_menu_color' ) . '; }';
			}

			if ( get_theme_mod( 'kata_footer_bottom_menu_hover_color' ) ) {
				$css .= '#kata-footer #kata-footer-bot ul li:hover a { color:' . get_theme_mod( 'kata_footer_bottom_menu_hover_color' ) . '; }';
			}

			// Container Size
			$kata_grid_size_desktop         = get_theme_mod( 'kata_grid_size_desktop', '1612' );
			$kata_grid_size_laptop          = get_theme_mod( 'kata_grid_size_laptop', '1248' );
			$kata_grid_size_tabletlandscape = get_theme_mod( 'kata_grid_size_tabletlandscape', '96' );
			$kata_grid_size_tablet          = get_theme_mod( 'kata_grid_size_tablet', '96' );
			$kata_grid_size_mobile          = get_theme_mod( 'kata_grid_size_mobile', '96' );
			$kata_grid_size_small_mobile    = get_theme_mod( 'kata_grid_size_small_mobile', '96' );
			$wide_container = get_theme_mod( 'kata_wide_container', '0' );


			if ( $kata_grid_size_desktop ) {
				$css .= '.container, .elementor-section.elementor-section-boxed>.elementor-container{ max-width: ' . $kata_grid_size_desktop . 'px;}';
				$css .= '.e-con { --container-max-width: ' . $kata_grid_size_desktop . 'px; }';
			}
			if ( $kata_grid_size_laptop ) {
				$css .= '@media(max-width:1366px){';
				$css .= '.container, .elementor-section.elementor-section-boxed>.elementor-container{ max-width: ' . $kata_grid_size_laptop . 'px;}';
				$css .= class_exists( 'WooCommerce') ? '.woocommerce-notices-wrapper { padding: 0 var(--ct-elementor-column-gap); max-width: ' . $kata_grid_size_laptop . 'px;}' : '';
				$css .= '.e-con { --container-max-width: ' . $kata_grid_size_laptop . 'px; }';
				$css .=  '}';
			}
			if ( $kata_grid_size_tabletlandscape ) {
				$css .= '@media(max-width:1024px){';
				$css .= '.container, .elementor-section.elementor-section-boxed>.elementor-container { max-width: ' . $kata_grid_size_tabletlandscape . '% !important;}';
				$css .= class_exists( 'WooCommerce') ? '.woocommerce-notices-wrapper { padding: 0 var(--ct-elementor-column-gap); max-width: ' . $kata_grid_size_tabletlandscape . 'px;}' : '';
				$css .= '.e-con { --container-max-width: ' . $kata_grid_size_tabletlandscape . '% !important; }';
				$css .= '}';
			}
			if ( $kata_grid_size_tablet ) {
				$css .= '@media(max-width:768px){';
				$css .= '.container, .elementor-section.elementor-section-boxed>.elementor-container { max-width: ' . $kata_grid_size_tablet . '% !important; margin-left:auto; margin-right:auto;}';
				$css .= class_exists( 'WooCommerce') ? '.woocommerce-notices-wrapper { padding: 0 var(--ct-elementor-column-gap); max-width: ' . $kata_grid_size_tablet . 'px;}' : '';
				$css .= '.e-con { --container-max-width: ' . $kata_grid_size_tablet . '% !important; }';
				$css .= '}';
			}
			if ( $kata_grid_size_mobile ) {
				$css .= '@media(max-width:480px){';
				$css .= '.container, .elementor-section.elementor-section-boxed>.elementor-container { max-width: ' . $kata_grid_size_mobile . '% !important; margin-left:auto; margin-right:auto;}';
				$css .= class_exists( 'WooCommerce') ? '.woocommerce-notices-wrapper { padding: 0 var(--ct-elementor-column-gap); max-width: ' . $kata_grid_size_mobile . 'px;}' : '';
				$css .= '.e-con { --container-max-width: ' . $kata_grid_size_mobile . '% !important; }';
				$css .= '}';
			}
			if ( $kata_grid_size_small_mobile ) {
				$css .= '@media(max-width:320px){';
				$css .= '.container, .elementor-section.elementor-section-boxed>.elementor-container { max-width: ' . $kata_grid_size_small_mobile . '% !important; margin-left:auto; margin-right:auto;} }';
				$css .= class_exists( 'WooCommerce') ? '.woocommerce-notices-wrapper { padding: 0 var(--ct-elementor-column-gap); max-width: ' . $kata_grid_size_small_mobile . 'px;}' : '';
				$css .= '.e-con { --container-max-width: ' . $kata_grid_size_small_mobile . '% !important; }';
				$css .= '}';
			}

			$css .= '.elementor-section.elementor-section-boxed>.elementor-container .elementor-container, .elementor-section.elementor-section-boxed>.elementor-container .container { max-width: 100% !important; }';
			$css .= '.single .kata-content .container .elementor-container { max-width: 100%; }';

			if ( $wide_container ) {
				$css .= '.container, .elementor-section.elementor-section-boxed>.elementor-container{max-width: 100%;}';
			}


			$kata_footer_bottom_layout = get_theme_mod( 'kata_footer_bottom_layout', 'left' );

			if ( $kata_footer_bottom_layout == 'center' ) {
				$css .= '.kata-footer-bot{text-align:center;}';
			}

			$colorbase = get_theme_mod( 'kata_base_color', '#877ff3' );
			$kata_color_primary = get_theme_mod( 'kata-color-primary', '#837af5' );
			$kata_color_secondary = get_theme_mod( 'kata-color-secondary', '#1d2834' );
			$kata_color_button_primary = get_theme_mod( 'kata-color-button-primary', '#f7f6ff' );
			$kata_color_button_secondary = get_theme_mod( 'kata-color-button-secondary', '#2acf6c' );
			$kata_color_border_button_primary = get_theme_mod( 'kata-color-border-button-primary', '#e0deff' );
			$kata_color_text_primary = get_theme_mod( 'kata-color-text-primary', '#737d8b' );
			$kata_color_text_secondary = get_theme_mod( 'kata-color-text-secondary', '#959ca7' );
			$kata_color_text_tertiary = get_theme_mod( 'kata-color-text-tertiary', '#b7bec9' );
			$kata_color_heading_primary = get_theme_mod( 'kata-color-heading-primary', '#4c5765' );
			$kata_color_heading_secondary = get_theme_mod( 'kata-color-heading-secondary', '#202122' );
			$kata_color_onsale_primary = get_theme_mod( 'kata-color-onsale-primary', '#f37f9b' );
			$kata_color_border_primary = get_theme_mod( 'kata-color-border-primary', '#e3e5e7' );
			$kata_color_border_secondary = get_theme_mod( 'kata-color-border-secondary', '#f0f3f6' );
			$kata_color_border_tertiary = get_theme_mod( 'kata-color-border-tertiary', '#cbc7fb' );
			$kata_color_pagetitle_bg_primary = get_theme_mod( 'kata-color-pagetitle-bg-primary', '#f6f7f8' );
			$kata_border_radius_primary = get_theme_mod( 'kata-border-radius-primary', '7' );
			$kata_border_radius_secondary = get_theme_mod( 'kata-border-radius-secondary', '14' );
			$kata_font_size_primary = get_theme_mod( 'kata-font-size-primary', '15' );
			$kata_font_size_secondary = get_theme_mod( 'kata-font-size-secondary', '17' );
			$kata_font_size_tertiary = get_theme_mod( 'kata-font-size-tertiary', '18' );

			$css .= ':root {';
			$css .= '--ct-base-color: ' . $colorbase . ';';
			$css .= '--ct-color-primary: ' . $kata_color_primary . ';';
			$css .= '--ct-color-secondary: ' . $kata_color_secondary . ';';
			$css .= '--ct-color-button-primary: ' . $kata_color_button_primary . ';';
			$css .= '--ct-color-button-secondary: ' . $kata_color_button_secondary . ';';
			$css .= '--ct-color-border-button-primary: ' . $kata_color_border_button_primary . ';';
			$css .= '--ct-color-text-primary: ' . $kata_color_text_primary . ';';
			$css .= '--ct-color-text-secondary: ' . $kata_color_text_secondary . ';';
			$css .= '--ct-color-text-tertiary: ' . $kata_color_text_tertiary . ';';
			$css .= '--ct-color-heading-primary: ' . $kata_color_heading_primary . ';';
			$css .= '--ct-color-heading-secondary: ' . $kata_color_heading_secondary . ';';
			$css .= '--ct-color-onsale-primary: ' . $kata_color_onsale_primary . ';';
			$css .= '--ct-color-border-primary: ' . $kata_color_border_primary . ';';
			$css .= '--ct-color-border-secondary: ' . $kata_color_border_secondary . ';';
			$css .= '--ct-color-border-tertiary: ' . $kata_color_border_tertiary . ';';
			$css .= '--ct-color-pagetitle-bg-primary: ' . $kata_color_pagetitle_bg_primary . ';';
			$css .= '--ct-border-radius-primary:' . $kata_border_radius_primary . 'px;';
			$css .= '--ct-border-radius-secondary:' . $kata_border_radius_secondary . 'px;';
			$css .= '--ct-font-size-primary:' . $kata_font_size_primary . 'px;';
			$css .= '--ct-font-size-secondary:' . $kata_font_size_secondary . 'px;';
			$css .= '--ct-font-size-tertiary:' . $kata_font_size_tertiary . 'px;';
			$css .= '}';

			wp_add_inline_style( 'kata-dynamic-styles', kata_Helpers::cssminifier( $css ) );
		}

		/**
		 * Left Sidebar.
		 *
		 * @since   1.0.0
		 */
		public function left_sidebar() {
			$sidebar_position_meta = Kata_Helpers::get_meta_box('sidebar_position');
			$sidebar_position      = $sidebar_position_meta != 'inherit_from_customizer' && !empty($sidebar_position_meta) ? $sidebar_position_meta : get_theme_mod('kata_page_sidebar_position', 'none');

			if ($sidebar_position != 'none') {
				echo '<div class="row">';
			}

			// Left sidebar
			if ($sidebar_position == 'left' || $sidebar_position == 'both') {
				echo '<div class="col-md-3 kata-sidebar kata-left-sidebar">';
				if (is_active_sidebar('kata-left-sidebar')) {
					dynamic_sidebar('kata-left-sidebar');
				}
				echo '</div>';
			}
		}

		/**
		 * Start Page with Sidebar.
		 *
		 * @since   1.0.0
		 */
		public function start_page() {
			$sidebar_position_meta = Kata_Helpers::get_meta_box('sidebar_position');
			$sidebar_position      = $sidebar_position_meta != 'inherit_from_customizer' && !empty($sidebar_position_meta) ? $sidebar_position_meta : get_theme_mod('kata_page_sidebar_position', 'none');

			if ($sidebar_position == 'both') {
				echo '<div class="col-md-6 kata-page-content">';
			} elseif ($sidebar_position == 'right' || $sidebar_position == 'left') {
				echo '<div class="col-md-9 kata-page-content">';
			} else {
				echo '<div class="kata-page-content">';
			}
		}

		/**
		 * End Page with Sidebar.
		 *
		 * @since   1.0.0
		 */
		public function end_page() {
			$sidebar_position_meta = Kata_Helpers::get_meta_box('sidebar_position');
			$sidebar_position      = $sidebar_position_meta != 'inherit_from_customizer' && !empty($sidebar_position_meta) ? $sidebar_position_meta : get_theme_mod('kata_page_sidebar_position', 'none');
				echo '<div class="kt-clear"></div>';
				// If comments are open or we have at least one comment, load up the comment template.
				wp_link_pages();
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			echo '</div>';
		}

		/**
		 * Right Sidebar.
		 *
		 * @since   1.0.0
		 */
		public function right_sidebar() {
			$sidebar_position_meta = Kata_Helpers::get_meta_box('sidebar_position');
			$sidebar_position      = $sidebar_position_meta != 'inherit_from_customizer' && !empty($sidebar_position_meta) ? $sidebar_position_meta : get_theme_mod('kata_page_sidebar_position', 'none');

			// Right sidebar
			if ($sidebar_position == 'right' || $sidebar_position == 'both') {
				echo '<div class="col-md-3 kata-sidebar kata-right-sidebar">';
				if (is_active_sidebar('kata-right-sidebar')) {
					dynamic_sidebar('kata-right-sidebar');
				}
				echo '</div>';
			}

			if ($sidebar_position != 'none') {
				echo '</div>';
			}
		}

		/**
		 * Page Title.
		 *
		 * @since   1.0.0
		 */
		public function page_title() {
			$page_title           = get_theme_mod( 'kata_show_page_title', true );
			$page_title_class     = $page_title ? 'on' : 'off';
			if ( 'on' === $page_title_class && ! is_404() ) {
				echo '
				<div id="kata-page-title" class="kata-page-title">
					<div class="container">
						<div class="col-sm-12">
							<h1>' . esc_html( get_the_title() ) . '</h1>
						</div>
					</div>
				</div>';
			}
		}

		/**
		 * Responsive.
		 *
		 * @since   1.0.0
		 */
		public function option_responsive() {
			$kata_grid_size_desktop	= get_theme_mod( 'kata_grid_size_desktop', '1280' );
			$scalable = get_theme_mod( 'kata_responsive_scalable', '1' ) == true ? 'yes': 'no';
			$max_scale = $scalable == 'yes' ? '2' : '1';

			if ( get_theme_mod( 'kata_responsive', '1' ) == '1' ) {
				echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=' . esc_attr( $max_scale ) . ' user-scalable=' . esc_attr( $scalable ) . '">';
			} else {
				echo '<meta name="viewport" content="width=' . esc_attr( $kata_grid_size_desktop ) . ', initial-scale=1, maximum-scale=' . esc_attr( $max_scale ) . ', user-scalable=' . esc_attr( $scalable ) . '">';
			}
		}

		/**
		 * Backup Customizer.
		 *
		 * @since   1.0.0
		 */
		public function backup_customizer() {
			if ( strlen(json_encode(get_option( 'theme_mods_kata' ))) < 86 ) {
				return;
			}
			if ( ! get_option( 'customizer_backup' ) ) {
				add_option( 'customizer_backup', get_option( 'theme_mods_kata' ) );
				add_option( 'customizer_backup_date', date( 'Ymd' ) );
			}
			if ( get_option( 'customizer_backup_date' ) <= date( 'Ymd' ) && '-' !== get_option( 'theme_mods_kata' ) ) {
				update_option( 'customizer_backup', get_option( 'theme_mods_kata' ) );
				update_option( 'customizer_backup_date', date( 'Ymd' ) );
			}
		}

		/**
		 * Restore Backup Customizer.
		 *
		 * @since   1.0.0
		 */
		public function restore_backup_customizer() {
			if ( get_option( 'customizer_backup' ) && get_option( 'customizer_backup_date' ) ) {
				if ( '-' == get_option( 'theme_mods_kata' ) ) {
					$user			= wp_get_current_user();
					$allowed_roles	= ['editor', 'administrator', 'author'];
					if ( array_intersect( $allowed_roles, $user->roles ) ) {
						echo '<div class="kata-plus-customizer-problem"><h3>' . __( 'There is a problem with customizer (theme options) data\'s please refresh the page to resolve the problem', 'kata' ) . '</h3></div>';
					}
					update_option( 'theme_mods_kata', get_option( 'customizer_backup' ) );
				}
			}
		}

	} // Class

	Kata_Theme_Options_Functions::get_instance();
}
