<?php
/**
 * API Class
 *
 * @author  ClimaxThemes
 * @package Kata Plus
 * @since   1.0.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kata_Plus_API' ) ) {
	class Kata_Plus_API {

		/**
		 * The directory of this path
		 *
		 * @access  public
		 * @var     string
		 */
		public static $dir;

		/**
		 * The Demo Key
		 *
		 * @access  public
		 * @var     string
		 */
		public static $key;

		/**
		 * The URL protocol
		 *
		 * @access  public
		 * @var     string
		 */
		public static $protocol;

		/**
		 * The API URL
		 *
		 * @access  public
		 * @var     string
		 */
		public static $url;

		/**
		 * The Second Server API URL
		 *
		 * @access  public
		 * @var     string
		 */
		public static $second_url;

		/**
		 * The API Token
		 *
		 * @access  public
		 * @var     string
		 */
		public static $token;

		/**
		 * Instance of this class.
		 *
		 * @since   1.0.0
		 * @access  public
		 * @var     Kata_Plus_API
		 */
		public static $instance;

		/**
		 * Provides access to a single instance of a module using the singleton pattern.
		 *
		 * @since   1.0.0
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
		 * @since   1.0.0
		 */
		public function __construct() {
			$this->definitions();
		}

		/**
		 * Global definitions.
		 *
		 * @since   1.0.0
		 */
		public function definitions() {
			self::$protocol   = Kata_Plus_Helpers::ssl_url();
			self::$url        = 'https://katademosbackup.katademos.com/WebService';
			self::$second_url = 'https://katademos.climaxthemes.org/WebService';
			self::$dir        = Kata_Plus::$dir . 'includes/importer/core/includes/';
			self::$token      = get_option( 'kata_plus_api_token' );
			self::$key        = '';
		}

		/**
		 * Authenticate the website for using kata-plus importer features
		 *
		 * @since   1.0.0
		 */
		public function authenticate( $key ) {
			static::$key = $key;
			$licence     = true;
			$website     = 'climaxthemes.com';
			$email       = 'no-reply@climaxthemes.com';
			$wp_version  = get_bloginfo( 'version' );
			$data        = array(
				'licence'    => $licence,
				'website'    => $website,
				'email'      => $email,
				'key'        => $key,
				'version'    => Kata_Plus::$version,
				'wp_version' => $wp_version,
			);

			$response = $this->get( 'Authentication', $data );

			if ( ! $response ) {
				return false;
			}

			if ( isset( $response->message ) ) {
				return $response;
			}

			static::$token = $response->token;
			update_option( 'kata_plus_api_token', static::$token );

			return true;
		}

		/**
		 * Authenticate the website for using kata-plus importer features
		 *
		 * @since   1.0.0
		 */
		public function ImportDone( $key ) {
			static::$key = $key;
			$data        = array(
				'key'   => $key,
				'token' => static::$token,
			);

			$response = $this->get( 'Done', $data );

			if ( ! $response ) {
				return false;
			}

			if ( isset( $response->message ) ) {
				return $response;
			}

			return true;
		}

		/**
		 * Get Demo Data From API.
		 *
		 * @since   1.0.0
		 */
		public function demo( $action, $key = false ) {

			static::$key = $key;
			$data        = false;
			switch ( $action ) {
				case 'List':
					$data = $this->get( $action );
					$data = isset( $data->list ) ? $data->list : $data;
					break;
				case 'Contents':
					$data = $this->get( $action );
					break;
				case 'Information':
					$data = $this->get( $action );
					break;
				case 'Plugins':
					$data = $this->get( $action );
					break;
				case 'Images':
					$data = $this->get( $action );
					break;
				case 'Categories':
					$data = $this->get( $action );
					break;
			}

			return $data;
		}

		/**
		 * Send request to WebService and return received data
		 *
		 * @param string $action
		 * @param array  $data
		 * @return object
		 */
		private function get( $action, $data = array() ) {

			$data['token'] = static::$token ?? null;

			try {
				$url = $this->generate_url( $action );

				$headers = array(
					'apikey'     => 'trusted',
					'accept'     => 'application/json',
					'user-agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/106.0.0.0 Safari/537.36',
				);

				$request = wp_remote_post(
					$url,
					array(
						'headers' => $headers,
						'body'    => $data,
					)
				);

				if ( is_wp_error( $request ) ) {
					throw new Exception( $request->get_error_message() );
				}

				if ( $request['response']['code'] === 200 ) {
					return json_decode($request['body']);
				}

			} catch ( Exception $e ) {
				try {
					$url = $this->generate_second_url( $action );

					$request = wp_remote_post(
						$url,
						array(
							'headers' => $headers,
							'body'    => $data,
						)
					);

					if ( is_wp_error( $request ) ) {
						throw new Exception( $request->get_error_message() );
					}

					if ($request['response']['code'] === 200) {
						return json_decode( $request['body'] );
					}
				} catch (Exception $e) {
					$error_message = __( 'Connection closed!', 'kata-plus' ) . '
						<p style="line-height: 2;">
							' . __( 'Your WebHost configuration is not enough for Kata Theme', 'kata-plus' ) . ' <br/>
							' . __( 'To improve your WebHost configuration please contact your host provider.', 'kata-plus' ) . '<br/>
							' . 'Error: ' . $e->getMessage() . '<br/>
							' . __( 'For more informations please see: ', 'kata-plus' ) . '<span><a href="' . admin_url( 'admin.php?page=kata-plus-help' ) . '">' . __( 'kata requirements' ) . '</a></span><br/>
						</p>';

					return '<span class="kata-plus-importer-error-message">' . $error_message . '</span>';
				}
			}

		}

		/**
		 * Send request to WebService and return received data
		 *
		 * @param string $action
		 * @param array  $data
		 * @return URL
		 */
		private function generate_url( $action ) {
			$url = false;
			switch ( $action ) {
				case 'Authentication':
					$url = static::$url . '/' . $action . '/';
					break;
				case 'List':
					$url = static::$url . '/Demo/' . $action . '/';
					break;
				case 'Contents':
					$url = static::$url . '/Demo/' . $action . '/' . static::$key . '/' . static::$token;
					break;
				case 'Information':
					$url = static::$url . '/Demo/' . $action . '/' . static::$key . '/' . static::$token;
					break;
				case 'Plugins':
					$url = static::$url . '/Demo/' . $action . '/' . static::$key . '/' . static::$token;
					break;
				case 'Images':
					$url = static::$url . '/Demo/' . $action . '/' . static::$key . '/' . static::$token;
					break;
				case 'Done':
					$url = static::$url . '/Import/Done/' . static::$key . '/' . static::$token;
					break;
			}

			return $url;
		}

		/**
		 * Send request to WebService and return received data
		 *
		 * @param string $action
		 * @param array  $data
		 * @return URL
		 */
		private function generate_second_url( $action ) {
			$url = false;
			switch ( $action ) {
				case 'Authentication':
					$url = static::$second_url . '/' . $action . '/';
					break;
				case 'List':
					$url = static::$second_url . '/Demo/' . $action . '/';
					break;
				case 'Contents':
					$url = static::$second_url . '/Demo/' . $action . '/' . static::$key . '/' . static::$token;
					break;
				case 'Information':
					$url = static::$second_url . '/Demo/' . $action . '/' . static::$key . '/' . static::$token;
					break;
				case 'Plugins':
					$url = static::$second_url . '/Demo/' . $action . '/' . static::$key . '/' . static::$token;
					break;
				case 'Images':
					$url = static::$second_url . '/Demo/' . $action . '/' . static::$key . '/' . static::$token;
					break;
				case 'Done':
					$url = static::$second_url . '/Import/Done/' . static::$key . '/' . static::$token;
					break;
			}

			return $url;
		}
	}

	Kata_Plus_API::get_instance();
}
