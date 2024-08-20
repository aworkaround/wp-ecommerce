<?php
/**
 * Layout Options.
 *
 * @author  ClimaxThemes
 * @package Kata Plus
 * @since   1.0.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kata_Theme_Options_Layout' ) ) {
	class Kata_Theme_Options_Layout extends Kata_Theme_Options {
		/**
		 * Set Options.
		 *
		 * @since   1.0.0
		 */
		public static function set_options() {
			new \Kirki\Field\Radio_Buttonset(
				[
					'settings'    => 'kata_layout',
					'section'     => 'title_tagline',
					'label'       => esc_html__( 'Layout', 'kata' ),
					'description' => esc_html__( 'Controls the site layout.', 'kata' ),
					'default'     => 'kata-wide',
					'choices'     => [
						'kata-wide'  => esc_html__( 'Wide', 'kata' ),
						'kata-boxed' => esc_html__( 'Boxed', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings'    => 'kata_responsive',
					'section'     => 'title_tagline',
					'label'       => esc_html__( 'Responsive', 'kata' ),
					'description' => esc_html__( 'Disable this option in case you don\'t need a responsive website.', 'kata' ),
					'default'     => '1',
					'choices'     => [
						'on'  => esc_html__( 'Enabled', 'kata' ),
						'off' => esc_html__( 'Disabled', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings'    => 'kata_responsive_scalable',
					'section'     => 'title_tagline',
					'label'       => esc_html__( 'Scalable webpage', 'kata' ),
					'description' => esc_html__( 'It allows the user to scale the webpage.', 'kata' ),
					'default'     => 'on',
					'choices'     => [
						'on'  => esc_html__( 'Enabled', 'kata' ),
						'off' => esc_html__( 'Disabled', 'kata' ),
					],
				]
			);
		}
	} // class

	Kata_Theme_Options_Layout::set_options();
}
