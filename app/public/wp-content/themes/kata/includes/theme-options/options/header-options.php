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

if ( ! class_exists( 'Kata_Theme_Options_Header' ) ) {
	class Kata_Theme_Options_Header extends Kata_Theme_Options {
		/**
		 * Set Options.
		 *
		 * @since   1.0.0
		 */
		public static function set_options() {

			// Header Section
			new \Kirki\Panel(
				'kata_header_panel',
				[
					'title'      => esc_html__( 'Header', 'kata' ),
					'icon'       => 'ti-layout-accordion-merged',
					'capability' => Kata_Helpers::capability(),
					'priority'   => 4,

				]
			);
			new \Kirki\Section(
				'kata_header_section_layout',
				[
					'panel'      => 'kata_header_panel',
					'title'      => esc_html__( 'Layout', 'kata' ),
					'capability' => kata_Helpers::capability(),
					'priority'	 => 2,

				]
			);
			new \Kirki\Field\Radio_Image(
				[
					'settings'    => 'kata_header_layout',
					'section'     => 'kata_header_section_layout',
					'label'       => esc_html__( 'Layout', 'kata' ),
					'default'     => 'left',
					'choices'     => [
						'left'   => kata::$assets . '/img/left-header.svg',
						'left2'   => kata::$assets . '/img/left-header-2.svg',
						'right'  => kata::$assets . '/img/right-header.svg',
						'right2'  => kata::$assets . '/img/right-header-2.svg',
						'center' => kata::$assets . '/img/center-header.svg',
						'center' => kata::$assets . '/img/center-header.svg',
						'center' => kata::$assets . '/img/center-header.svg',
					],
				]
			);
			new \Kirki\Field\Radio_Image(
				[
					'settings'    => 'kata_mobile_header_layout',
					'section'     => 'kata_header_section_layout',
					'label'       => esc_html__( 'Mobile Layout', 'kata' ),
					'default'     => 'left',
					'choices'     => [
						'left'   => kata::$assets . '/img/mobile-left-header.svg',
						'right'  => kata::$assets . '/img/mobile-right-header.svg',
					],
				]
			);
			new \Kirki\Section(
				'kata_header_section_style',
				[
					'panel'      => 'kata_header_panel',
					'title'      => esc_html__( 'Style', 'kata' ),
					'capability' => kata_Helpers::capability(),
					'priority'	 => 2,

				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_header_background',
					'section'     => 'kata_header_section_style',
					'label'       => esc_html__('Background Color', 'kata'),
					'description' => esc_html__('Header Background Color', 'kata'),
					'default'  => '#ffffff',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_header_menu_color',
					'section'     => 'kata_header_section_style',
					'label'       => esc_html__('Menu Color', 'kata'),
					'description' => esc_html__('Header Menu Color', 'kata'),
					'default'  => '#1d2834',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_header_menu_hover_color',
					'section'     => 'kata_header_section_style',
					'label'       => esc_html__('Hover Menu & Current Menu Color', 'kata'),
					'description' => esc_html__('Header Hover Menu & Current Menu Color', 'kata'),
					'default'  => '#837af5',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Slider(
				[
					'settings'        => 'kata_header_height',
					'section'         => 'kata_header_section_style',
					'label'           => esc_html__('Height', 'kata'),
					'description'     => esc_html__('Header height', 'kata'),
					'default'         => '',
					'choices'         => [
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					],
				]
			);
			new \Kirki\Field\Slider(
				[
					'settings'        => 'kata_header_border',
					'section'         => 'kata_header_section_style',
					'label'           => esc_html__('Border', 'kata'),
					'description'     => esc_html__('Header border bottom size', 'kata'),
					'default'         => 0,
					'choices'         => [
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'section'     => 'kata_header_section_style',
					'settings'    => 'kata_header_border_color',
					'label'       => esc_html__('Border Color', 'kata'),
					'description' => esc_html__('Header border bottom color', 'kata'),
					'default'  => '#f0f1f1',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings'    => 'kata_full_width_header',
					'section'     => 'kata_header_section_style',
					'label'       => esc_html__( 'Full Width Header', 'kata' ),
					'default'     => 'off',
					'choices'     => [
						'on'  	=> esc_html__( 'Enabled', 'kata' ),
						'off'	=> esc_html__( 'Disabled', 'kata' ),
					],
				]
			);
		}
	} // class

	Kata_Theme_Options_Header::set_options();
}
