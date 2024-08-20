<?php
/**
 * Kata Dashboard Page
 *
 * @author  ClimaxThemes
 * @package Kata
 * @since   1.0.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kata_Dashboard' ) ) {
	/**
	 * Kata.
	 *
	 * @author     Climaxthemes
	 * @package     Kata
	 * @since     1.0.0
	 */
	class Kata_Dashboard {

		/**
		 * The directory of the file.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $dir;

		/**
		 * The url of the file.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $url;

		/**
		 * The url of assets file.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $assets;

		/**
		 * The url of assets file.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $version;

		/**
		 * The url of assets file.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $menu_name;

		/**
		 * The theme page appearance.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $theme_page;

		/**
		 * The theme document url.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $document_url;

		/**
		 * The theme facebook url.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $facebook;

		/**
		 * The theme rating.
		 *
		 * @access  public
		 * @var     string
		 */
		public static $rate_us;

		/**
		 * Instance of this class.
		 *
		 * @since   1.0.0
		 * @access  public
		 * @var     Kata_Dashboard
		 */
		public static $instance;

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since   1.0.0
		 * @return  object
		 */
		public static function get_instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Define the core functionality of the theme.
		 *
		 * @since   1.0.0
		 */
		public function __construct() {
			$this->definitions();
			$this->dependencies();
			$this->actions();
		}

		/**
		 * Global definitions.
		 *
		 * @since   1.0.0
		 */
		public function definitions() {
			self::$dir     			= Kata::$dir . 'includes/dashboard/';
			self::$url     			= Kata::$url;
			self::$version     		= Kata::$version;
			self::$assets  			= Kata::$url . 'assets/';
			self::$menu_name		= 'Kata';
			self::$theme_page		= 'appearance_page_kata-dashboard';
			self::$facebook			= 'https://www.facebook.com/climaxthemes/';
			self::$document_url		= 'https://climaxthemes.com/kata/documentation/';
			self::$rate_us			= 'https://wordpress.org/support/theme/kata/reviews/#new-post';
			if ( ! get_theme_mod( 'install-kata-plus' ) ) set_theme_mod( 'install-kata-plus', 'true' );
		}

		/**
		 * Load dependencies.
		 *
		 * @since   1.0.0
		 */
        public function dependencies() {}

		/**
		 * Add actions.
		 *
		 * @since   1.0.0
		 */
		public function actions() {
			add_action( 'admin_menu', array( $this, 'kata_dashboard' ) );
			add_action( 'current_screen', array( $this, 'current_screen' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
			add_action( 'admin_notices', array( $this, 'kata_plus_install_notice' ) );
			add_action( 'wp_ajax_install_activate_plugins', array( $this, 'install_activate_plugins') );
        }

		/**
		 * Add Kata theme page (dashboard).
		 *
		 * @since   1.0.0
		 */
        public function install_activate_plugins() {

			// Check the nonce for security
			check_ajax_referer( 'install_activate_plugins_nonce', 'security' );

			// Include necessary files
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
			require_once ABSPATH . 'wp-admin/includes/file.php';
			require_once ABSPATH . 'wp-admin/includes/misc.php';
			require_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
			require_once ABSPATH . 'wp-admin/includes/plugin-install.php';

			// Plugins to install and activate
			$plugins = [
				[
					'name' => 'Elementor',
					'slug' => 'elementor',
					'url'  => 'https://downloads.wordpress.org/plugin/elementor.latest-stable.zip'
				],
				[
					'name' => 'Kata Plus',
					'slug' => 'kata-plus',
					'url'  => 'https://downloads.wordpress.org/plugin/kata-plus.latest-stable.zip'
				]
			];


			foreach ( $plugins as $plugin ) {
				$plugin_file = WP_PLUGIN_DIR . '/' . $plugin['slug'];

				// is already installed ?
				if ( ! is_dir( $plugin_file ) ) {

					// Download and install the plugin
					$upgrader = new Plugin_Upgrader( new WP_Ajax_Upgrader_Skin() );

					$installed = $upgrader->install( $plugin['url'] );
					if ( ! $installed ) {
						wp_send_json_error( 'Failed to install ' . $plugin['name'] . ' plugin.' );
						continue;
					}
				}

				// Activate the plugin if it is not already active
				$plugin_main_file = $plugin['slug'] . '/' . $plugin['slug'] . '.php';
				if ( ! is_plugin_active( $plugin_main_file ) ) {
					$activated = activate_plugin( $plugin_main_file );
					if ( is_wp_error( $activated ) ) {
						wp_send_json_error('Failed to activate ' . $plugin['name'] . ' plugin: ' . $activated->get_error_message());
					}
				}
			}

			wp_send_json_success( 'Plugins installed and activated successfully.' );

		}

		/**
		 * Add Kata theme page (dashboard).
		 *
		 * @since   1.0.0
		 */
        public function kata_plus_install_notice() {

			$exclude_pages = array( 'plugins.php', 'plugin-install.php', 'plugin-editor.php', 'update.php' );

			global $pagenow;
			if ( in_array( $pagenow, $exclude_pages, true ) ) {
				return;
			}

			if ( class_exists( 'Kata_Plus' ) && class_exists( 'Elementor\Plugin' ) ) {
				return false;
			}
			if ( isset( $_GET['hide_kata_plus'] ) ) {
				set_theme_mod( 'install-kata-plus', sanitize_text_field( wp_unslash( $_GET['hide_kata_plus'] ) ) );
				return false;
			}
			if ( 'false' == get_theme_mod( 'install-kata-plus' ) ) {
				return false;
			}
			?>

			<div class="kata-notice kt-dashboard-box notice notice-success is-dismissible">
				<div class="kata-notice-wrap">
					<p class="kt-notice-username"><?php echo __( 'Hello,', 'kata' ) . ' ' . wp_get_current_user(  )->user_nicename ; ?> 👋🏻</p>
				<h2 class="kt-notice-heading"><?php echo __( 'Kata is now installed and ready to use. ', 'kata' ); ?></h2>
				<p class="kt-notice-description"><?php echo __( 'To take full advantage of all the features in Kata theme and enabling its demo importer, please install the required plugins.
This plugins grants you access to a range of powerful tools like:', 'kata' ) ?></p>
				<ul class="kt-notice-list">
					<li><?php echo __( 'Starter Website Template Demos', 'kata' ); ?></li>
					<li><?php echo __( 'Header & Footer Builder', 'kata' ); ?></li>
					<li><?php echo __( 'Advanced Theme Options', 'kata' ); ?></li>
					<li><?php echo __( 'Practical Elementor Widgets + Styler', 'kata' ); ?></li>
				</ul>
				<p>
					<a href="#" class="kt-notice-button kt-install-plugins"><?php echo __( 'Install Plugins', 'kata' ) ?></a><span class="kt-spiner spinner"></span>
					<a href="<?php echo admin_url( 'themes.php?page=kata-dashboard' ); ?>" class="kt-notice-button kt-empty-btn"><?php echo __( 'Theme Dashboard', 'kata' ) ?></a>
					<a href="https://climaxthemes.com/kata/documentation" class="kt-notice-link"><?php echo __( 'Read full documentation', 'kata' ) ?></a>
				</p>
				</div>
			</div>
			<?php
			if ( isset( $_GET['hide_kata_plus'] ) ) {
				set_theme_mod( 'install-kata-plus', sanitize_text_field( wp_unslash( $_GET['hide_kata_plus'] ) ) );
			}
		}
		/**
		 * Add Kata theme page (dashboard).
		 *
		 * @since   1.0.0
		 */
        public function kata_dashboard() {
            add_theme_page(
				self::$menu_name . ' Theme',
				self::$menu_name . ' Theme',
                'edit_theme_options',
                'kata-dashboard',
               array( $this, 'output' )
            );
        }

		/**
		 * Add Kata theme page styles.
		 *
		 * @since   1.0.0
		 */
        public function enqueue_styles() {
			wp_enqueue_style( 'kata-notice', self::$assets . 'css/notice.css', array(), self::$version );

			if ( self::$theme_page === self::current_screen() ) {
				wp_enqueue_style( 'kata-dashboard', self::$assets . 'css/dashboard.css', array(), self::$version );
				if ( is_super_admin() ) {
					remove_all_actions( 'admin_notices' );
				}
			}

			wp_enqueue_script( 'kata-install-plugins', get_template_directory_uri() . '/assets/js/install-plugins.js', ['jquery'], null, true );

			// Localize the script with the AJAX URL and nonce
			wp_localize_script( 'kata-install-plugins', 'kataInstallPlugins', [
				'ajax_url' => admin_url('admin-ajax.php'),
				'nonce'    => wp_create_nonce('install_activate_plugins_nonce'),
			]);

        }

		/**
		 * Current Screen
		 *
		 * @since   1.0.0
		 */
		public static function current_screen() {
			return get_current_screen()->base;
		}


		/**
		 * Theme page output.
		 *
		 * @since   1.0.0
		 */
        public function output() {
            if ( self::$theme_page === self::current_screen() ) {
				require self::$dir . 'parts/dashboard.header.tpl.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
				require self::$dir . 'parts/dashboard.main.content.tpl.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			}
		}



	} // class

	Kata_Dashboard::get_instance();

}
