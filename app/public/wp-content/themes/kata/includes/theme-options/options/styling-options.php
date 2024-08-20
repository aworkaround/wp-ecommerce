<?php

/**
 * Styling & Typography Options.
 *
 * @author  ClimaxThemes
 * @package Kata Plus
 * @since   1.0.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kata_Theme_Options_Styling_Typography' ) ) {
	class Kata_Theme_Options_Styling_Typography extends Kata_Theme_Options {
		/**
		 * Set Options.
		 *
		 * @since   1.0.0
		 */
		public static function set_options() {
			// Page panel
			new \Kirki\Panel(
				'kata_styling_and_typography_panel',
				[
					'title'      => esc_html__( 'Styling', 'kata' ),
					'icon'       => 'ti-palette',
					'capability' => 'manage_options',
					'priority'   => 5,
				]
			);

			// -> Start Theme Typography Section
			new \Kirki\Section(
				'kata_body_typography_section',
				[
					'panel'      => 'kata_styling_and_typography_panel',
					'title'      => esc_html__( 'Basic Typography', 'kata' ),
					'capability' => 'manage_options',
					'priority'   => 8,
				]
			);
			new \Kirki\Field\Radio_Buttonset(
				[
					'settings'    => 'kata_body_typography_status',
					'section'     => 'kata_body_typography_section',
					'label'       => esc_html__( 'Body Typography', 'kata' ),
					'description' => esc_html__( 'Controls the typography of body.', 'kata' ),
					'default'     => 'disable',
					'choices'     => [
						'disable'	=> esc_html__( 'Disable', 'kata' ),
						'enabel'	=> esc_html__( 'Enabel', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Select(
				[
					'settings'	=> 'kata_body_font_family',
					'section'	=> 'kata_body_typography_section',
					'default'	=> 'select-font',
					'label'		=> esc_html__( 'Font Family', 'kata' ),
					'choices'	=> self::added_fonts(),
					'active_callback' => [
						[
							'setting'  => 'kata_body_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);
			new \Kirki\Field\Dimensions(
				[
					'settings'	=> 'kata_body_font_properties',
					'section'	=> 'kata_body_typography_section',
					'label'		=> esc_html__( 'Font Properties', 'kata' ),
					'default'	=> [
						'font-size'			=> '15px',
						'font-weight'		=> '400',
						'letter-spacing'	=> '0px',
						'line-height'		=> '1.5',
					],
					'active_callback' => [
						[
							'setting'  => 'kata_body_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings' => 'kata_body_font_color',
					'section'  => 'kata_body_typography_section',
					'label'    => esc_html__('Color', 'kata'),
					'default'  => '',
					'choices'  => [
						'alpha' => true,
					],
					'active_callback' => [
						[
							'setting'  => 'kata_body_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);

			// -> Start Headings Typography Section
			new \Kirki\Section(
				'kata_headings_typography_section',
				[
					'panel'      => 'kata_styling_and_typography_panel',
					'title'      => esc_html__( 'Headings Typography', 'kata' ),
					'capability' => 'manage_options',
					'priority'   => 9,
				]
			);
			new \Kirki\Field\Radio_Buttonset(
				[
					'settings'    => 'kata_headings_typography_status',
					'section'     => 'kata_headings_typography_section',
					'label'       => esc_html__( 'Headings Typography', 'kata' ),
					'description' => esc_html__( 'Controls the typography of H1-H6.', 'kata' ),
					'default'     => 'disable',
					'choices'     => [
						'disable'	=> esc_html__( 'Disable', 'kata' ),
						'enabel'	=> esc_html__( 'Enabel', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Select(
				[
					'settings'	=> 'kata_headings_font_family',
					'section'	=> 'kata_headings_typography_section',
					'default'	=> 'select-font',
					'label'		=> esc_html__( 'Font Family', 'kata' ),
					'choices'	=> self::added_fonts(),
					'active_callback' => [
						[
							'setting'  => 'kata_headings_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);
			new \Kirki\Field\Dimensions(
				[
					'settings'	=> 'kata_headings_font_properties',
					'section'	=> 'kata_headings_typography_section',
					'label'		=> esc_html__( 'Font Properties', 'kata' ),
					'default'	=> [
						'font-size'			=> '15px',
						'font-weight'		=> '400',
						'letter-spacing'	=> '0px',
						'line-height'		=> '1.5',
					],
					'active_callback' => [
						[
							'setting'  => 'kata_headings_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings' => 'kata_headings_font_color',
					'section'  => 'kata_headings_typography_section',
					'label'    => esc_html__('Color', 'kata'),
					'default'  => '',
					'choices'  => [
						'alpha' => true,
					],
					'active_callback' => [
						[
							'setting'  => 'kata_headings_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);

			// -> Start Nav Menu Typography Section
			new \Kirki\Section(
				'kata_nav_menu_typography_section',
				[
					'panel'      => 'kata_styling_and_typography_panel',
					'title'      => esc_html__( 'Nav Menu Typography', 'kata' ),
					'capability' => 'manage_options',
					'priority'   => 9,
				]
			);
			new \Kirki\Field\Radio_Buttonset(
				[
					'settings'    => 'kata_nav_menu_typography_status',
					'section'     => 'kata_nav_menu_typography_section',
					'label'       => esc_html__( 'Nav Menu Typography', 'kata' ),
					'description' => esc_html__( 'Controls the typography of nav menu items.', 'kata' ),
					'default'     => 'disable',
					'choices'     => [
						'disable'	=> esc_html__( 'Disable', 'kata' ),
						'enabel'	=> esc_html__( 'Enabel', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Select(
				[
					'settings'	=> 'kata_nav_menu_font_family',
					'section'	=> 'kata_nav_menu_typography_section',
					'default'	=> 'select-font',
					'label'		=> esc_html__( 'Font Family', 'kata' ),
					'choices'	=> self::added_fonts(),
					'active_callback' => [
						[
							'setting'  => 'kata_nav_menu_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);
			new \Kirki\Field\Dimensions(
				[
					'settings'	=> 'kata_nav_menu_font_properties',
					'section'	=> 'kata_nav_menu_typography_section',
					'label'		=> esc_html__( 'Font Properties', 'kata' ),
					'default'	=> [
						'font-size'			=> '15px',
						'font-weight'		=> '400',
						'letter-spacing'	=> '0px',
						'line-height'		=> '1.5',
					],
					'active_callback' => [
						[
							'setting'  => 'kata_nav_menu_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings' => 'kata_nav_menu_font_color',
					'section'  => 'kata_nav_menu_typography_section',
					'label'    => esc_html__('Color', 'kata'),
					'default'  => '',
					'choices'  => [
						'alpha' => true,
					],
					'active_callback' => [
						[
							'setting'  => 'kata_nav_menu_typography_status',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);

			// -> Start Styling & Typography section
			new \Kirki\Section(
				'kata_styling_typography_section',
				[
					'title'      => esc_html__('Advanced Styling', 'kata'),
					'panel'      => 'kata_styling_and_typography_panel',
					'capability' => Kata_Helpers::capability(),
					'priority'   => 10,
				]
			);
			new \Kirki\Field\Color(
				[
					'settings' => 'kata_base_color',
					'section'  => 'kata_styling_typography_section',
					'label'    => esc_html__('Primary Color', 'kata'),
					'default'  => '',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			Kirki::add_field(
				self::$opt_name,
				[
					'settings'	=> 'kata_install_kata_plus',
					'section'	=> 'kata_styling_typography_section',
					'type'		=> 'custom',
					'label'		=> esc_html__( 'To more options please install Kata Plus', 'kata' ),
					'default'	=> '
					<a href="' . esc_url( admin_url( 'themes.php?page=tgmpa-install-plugins' ) ) . '" target="_blank" class="button customizer-kata-builder-button button-large">
						<span class="elementor-switch-mode-off">' . esc_html__( 'Plugins Installer', 'kata' ) . '</span>
					</a>',
				]
			);
		}

		/**
		 * Added Fonts
		 *
		 * @since 1.0.0
		 */
		public static function added_fonts() {
			$fonts = get_theme_mod( 'kata_add_google_font_repeater' );
			$added_fonts = [];
			$added_fonts['select-font'] = 'Select Font';
			if ( $fonts ) {
				foreach ($fonts as $key => $font) {
					$added_fonts[$font['fonts']] = $font['fonts'];
				}
			}
			return $added_fonts;
		}

	} // class

	Kata_Theme_Options_Styling_Typography::set_options();
}
