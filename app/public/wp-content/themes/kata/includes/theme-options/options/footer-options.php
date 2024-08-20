<?php
/**
 * Footer Bottom Options.
 *
 * @author  ClimaxThemes
 * @package Kata Plus
 * @since   1.0.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kata_Theme_Options_Footer' ) ) {
	class Kata_Theme_Options_Footer extends Kata_Theme_Options {
		/**
		 * Set Options.
		 *
		 * @since   1.0.0
		 */
		public static function set_options() {
			// Footer panel
			new \Kirki\Panel(
				'kata_footer_panel',
				[
					'title'      => esc_html__( 'Footer', 'kata' ),
					'icon'       => 'ti-layout-accordion-merged',
					'capability' => Kata_Helpers::capability(),
					'priority'   => 4,

				]
			);
			// Footer Top Widgets Area
			new \Kirki\Section(
				'kata_footer_bottom_section',
				[
					'panel'      => 'kata_footer_panel',
					'title'      => esc_html__( 'Layout', 'kata' ),
					'capability' => Kata_Helpers::capability(),
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings'    => 'kata_footer_widget_area',
					'section'     => 'kata_footer_bottom_section',
					'label'       => esc_html__( 'Widget Area', 'kata' ),
					'description' => esc_html__( 'By chooing enable you will abel add widgets to footer widgets are for showing widgets in footer.', 'kata' ),
					'default'     => true,
					'choices'     => [
						'on'  => esc_html__( 'Enable', 'kata' ),
						'off' => esc_html__( 'Disable', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Background(
				[
					'section'     => 'kata_footer_bottom_section',
					'settings'    => 'kata_footer_background_setting',
					'label'       => esc_html__( 'Background', 'kata' ),
					'default'     => [
						'background-color'      => '',
						'background-image'      => '',
						'background-repeat'     => '',
						'background-position'   => '',
						'background-size'       => 'cover',
						'background-attachment' => 'scroll',
					],
					'transport'   => 'auto',
					'active_callback' => [
						[
							'setting'  => 'kata_footer_widget_area',
							'operator' => '==',
							'value'    => 'enabel',
						],
					],
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings'    => 'kata_footer_bottom_area',
					'section'     => 'kata_footer_bottom_section',
					'label'       => esc_html__( 'Footer Buttom', 'kata' ),
					'description' => esc_html__( 'By chooing enable you will abel add widgets to footer widgets are for showing widgets in footer.', 'kata' ),
					'default'     => 'on',
					'choices'     => [
						'on'  => esc_html__( 'Enable', 'kata' ),
						'off' => esc_html__( 'Disable', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Radio_Image(
				[
					'settings'    => 'kata_footer_bottom_layout',
					'section'     => 'kata_footer_bottom_section',
					'label'       => esc_html__( 'Layout', 'kata' ),
					'default'     => 'left',
					'choices'     => [
						'left'		=> Kata::$assets . '/img/left-footer.svg',
						'center'	=> Kata::$assets . '/img/center-footer.svg',
						'right'		=> Kata::$assets . '/img/right-footer.svg',
					],
					'active_callback' => [
						[
							'setting'  => 'kata_footer_bottom_area',
							'operator' => '==',
							'value'    => true,
						],
					],
				]
			);
			new \Kirki\Field\Select(
				[
					'settings'    => 'kata_footer_bottom_left_section',
					'section'     => 'kata_footer_bottom_section',
					'label'       => esc_html__( 'First Section', 'kata' ),
					'default'     => 'custom-text',
					'choices'     => [
						'none' 			=> esc_html__( 'None', 'kata' ),
						'footer-menu' 	=> esc_html__( 'Footer Menu', 'kata' ),
						'custom-text'	=> esc_html__( 'Custom Text', 'kata' ),
					],
					'active_callback' => [
						[
							'setting'  => 'kata_footer_bottom_area',
							'operator' => '==',
							'value'    => true,
						],
					],
				]
			);
			new \Kirki\Field\Textarea(
				[
					'settings'	=> 'kata_footer_bottom_left_custom_text',
					'section'	=> 'kata_footer_bottom_section',
					'label'		=> esc_html__( 'First Custom Text', 'kata' ),
					'description'	=> esc_html__( 'Copyright ©[kata-date] all right reserved.', 'kata' ),
					'active_callback' => [
						[
							'setting'  => 'kata_footer_bottom_left_section',
							'operator' => '==',
							'value'    => 'custom-text',
						],
					],
				]
			);
			new \Kirki\Field\Select(
				[
					'settings'    => 'kata_footer_bottom_right_section',
					'section'     => 'kata_footer_bottom_section',
					'label'       => esc_html__( 'Second Section', 'kata' ),
					'default'     => 'footer-menu',
					'choices'     => [
						'none' 			=> esc_html__( 'None', 'kata' ),
						'footer-menu' 	=> esc_html__( 'Footer Menu', 'kata' ),
						'custom-text'	=> esc_html__( 'Custom Text', 'kata' ),
					],
					'active_callback' => [
						[
							'setting'  => 'kata_footer_bottom_area',
							'operator' => '==',
							'value'    => true,
						],
					],
				]
			);
			new \Kirki\Field\Textarea(
				[
					'settings'	=> 'kata_footer_bottom_right_custom_text',
					'section'	=> 'kata_footer_bottom_section',
					'label'		=> esc_html__( 'Second Custom Text', 'kata' ),
					'description'	=> esc_html__( 'Email: contact@yourwebsite.com', 'kata' ),
					'active_callback' => [
						[
							'setting'  => 'kata_footer_bottom_right_section',
							'operator' => '==',
							'value'    => 'custom-text',
						],
					],
				]
			);
			// Footer Buttom
			new \Kirki\Section(
				'kata_footer_section_style',
				[
					'panel'      => 'kata_footer_panel',
					'title'      => esc_html__( 'Style', 'kata' ),
					'capability' => Kata_Helpers::capability(),
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_background',
					'section'     => 'kata_footer_section_style',
					'label'       => esc_html__('Background Color', 'kata'),
					'description' => esc_html__('Footer Background Color', 'kata'),
					'default'  => '#ffffff',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_menu_color',
					'section'     => 'kata_footer_section_style',
					'label'       => esc_html__('Menu Color', 'kata'),
					'description' => esc_html__('Footer Menu Color', 'kata'),
					'default'  => '#1d2834',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_menu_hover_color',
					'section'     => 'kata_footer_section_style',
					'label'       => esc_html__('Hover Menu Color', 'kata'),
					'description' => esc_html__('Footer Hover Menu Color', 'kata'),
					'default'  => '#837af5',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_text_color',
					'section'     => 'kata_footer_section_style',
					'label'       => esc_html__('Text Color', 'kata'),
					'description' => esc_html__('Footer text color', 'kata'),
					'default'  => '#252627',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Slider(
				[
					'settings'        => 'kata_footer_height',
					'section'         => 'kata_footer_section_style',
					'label'           => esc_html__('Height', 'kata'),
					'description'     => esc_html__('Footer height', 'kata'),
					'default'         => '',
					'choices'         => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_border_color',
					'section'     => 'kata_footer_section_style',
					'label'       => esc_html__('Border Color', 'kata'),
					'description' => esc_html__('Footer border bottom color', 'kata'),
					'default'  => '#f0f1f1',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings'    => 'kata_footer_full_width',
					'section'     => 'kata_footer_section_style',
					'label'       => esc_html__( 'Full Width Footer', 'kata' ),
					'default'     => 'off',
					'choices'     => [
						'on'  	=> esc_html__( 'Enabled', 'kata' ),
						'off'	=> esc_html__( 'Disabled', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Dimensions(
				[
					'settings'    => 'kata_footer_padding',
					'section'     => 'kata_footer_section_style',
					'label'       => esc_html__( 'Padding', 'kata' ),
					'description' => esc_html__( 'Enter the value with unit ex: 15px', 'kata' ),
					'default'     => [
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					],
				]
			);

			// Footer Buttom
			new \Kirki\Section(
				'kata_footer_bottom_section_style',
				[
					'panel'      => 'kata_footer_panel',
					'title'      => esc_html__( 'Footer Bottom Style', 'kata' ),
					'capability' => Kata_Helpers::capability(),
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_bottom_background',
					'section'     => 'kata_footer_bottom_section_style',
					'label'       => esc_html__('Background Color', 'kata'),
					'description' => esc_html__('Footer Background Color', 'kata'),
					'default'  => '#ffffff',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_bottom_menu_color',
					'section'     => 'kata_footer_bottom_section_style',
					'label'       => esc_html__('Menu Color', 'kata'),
					'description' => esc_html__('Footer Menu Color', 'kata'),
					'default'  => '#1d2834',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_bottom_menu_hover_color',
					'section'     => 'kata_footer_bottom_section_style',
					'label'       => esc_html__('Hover Menu Color', 'kata'),
					'description' => esc_html__('Footer Hover Menu Color', 'kata'),
					'default'  => '#837af5',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_bottom_text_color',
					'section'     => 'kata_footer_bottom_section_style',
					'label'       => esc_html__('Text Color', 'kata'),
					'description' => esc_html__('Footer text color', 'kata'),
					'default'  => '#252627',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Slider(
				[
					'settings'        => 'kata_footer_bottom_height',
					'section'         => 'kata_footer_bottom_section_style',
					'label'           => esc_html__('Height', 'kata'),
					'description'     => esc_html__('Footer height', 'kata'),
					'default'         => '',
					'choices'         => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 1,
					],
				]
			);
			new \Kirki\Field\Slider(
				[
					'settings'        => 'kata_footer_bottom_border',
					'section'         => 'kata_footer_bottom_section_style',
					'label'           => esc_html__( 'Footer Bottom Border', 'kata' ),
					'description'     => esc_html__( 'Footer bottom border size', 'kata' ),
					'default'         => 1,
					'choices'         => [
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					],
				]
			);
			new \Kirki\Field\Color(
				[
					'settings'    => 'kata_footer_bottom_border_color',
					'section'     => 'kata_footer_bottom_section_style',
					'label'       => esc_html__('Border Color', 'kata'),
					'description' => esc_html__('Footer border bottom color', 'kata'),
					'default'  => '#f0f1f1',
					'choices'  => [
						'alpha' => true,
					],
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings'    => 'kata_footer_bottom_full_width',
					'section'     => 'kata_footer_bottom_section_style',
					'label'       => esc_html__( 'Full Width Footer', 'kata' ),
					'default'     => 'off',
					'choices'     => [
						'on'  	=> esc_html__( 'Enabled', 'kata' ),
						'off'	=> esc_html__( 'Disabled', 'kata' ),
					],
				]
			);
			new \Kirki\Field\Dimensions(
				[
					'settings'    => 'kata_footer_bottom_padding',
					'section'     => 'kata_footer_bottom_section_style',
					'label'       => esc_html__( 'Padding', 'kata' ),
					'description' => esc_html__( 'Enter the value with unit ex: 15px', 'kata' ),
					'default'     => [
						'top'    => '',
						'right'  => '',
						'bottom' => '',
						'left'   => '',
					],
				]
			);
		}
	} // class

	Kata_Theme_Options_Footer::set_options();
}
