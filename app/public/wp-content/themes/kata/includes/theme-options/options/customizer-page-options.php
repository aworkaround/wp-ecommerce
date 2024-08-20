<?php
/**
 * Page Options.
 *
 * @author  ClimaxThemes
 * @package Kata Plus
 * @since   1.0.0
 */

// Don't load directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Kata_Theme_Options_Page' ) ) {
	class Kata_Theme_Options_Page extends Kata_Theme_Options {
		/**
		 * Set Options.
		 *
		 * @since   1.0.0
		 */
		public static function set_options() {
			// Page panel
			new \Kirki\Panel(
				'kata_page_panel',
				[
					'title'      => esc_html__( 'Pages', 'kata' ),
					'icon'       => 'ti-write',
					'capability' => kata_Helpers::capability(),
					'priority'   => 4,
				]
			);

			// Page Title section
			new \Kirki\Section(
				'kata_page_title_section',
				[
					'panel'      => 'kata_page_panel',
					'title'      => esc_html__( 'Page Title', 'kata' ),
					'capability' => kata_Helpers::capability(),
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings' => 'kata_show_page_title',
					'section'  => 'kata_page_title_section',
					'label'    => esc_html__( 'Show Page Title', 'kata' ),
					'default'  => '1',
					'choices'  => [
						'off' => esc_html__( 'Hide', 'kata' ),
						'on'  => esc_html__( 'Show', 'kata' ),
					],
				]
			);

			// Blog Title section
			new \Kirki\Section(
				'kata_blog_title_section',
				[
					'panel'      => 'kata_page_panel',
					'title'      => esc_html__( 'Blog Title', 'kata' ),
					'capability' => kata_Helpers::capability(),
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings' => 'kata_show_blog_title',
					'section'  => 'kata_blog_title_section',
					'label'    => esc_html__( 'Show Blog Title', 'kata' ),
					'default'  => '1',
					'choices'  => [
						'off' => esc_html__( 'Hide', 'kata' ),
						'on'  => esc_html__( 'Show', 'kata' ),
					],
				]
			);

			// Archive Title section
			new \Kirki\Section(
				'kata_archive_title_section',
				[
					'panel'      => 'kata_page_panel',
					'title'      => esc_html__( 'Archive Title', 'kata' ),
					'capability' => kata_Helpers::capability(),
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings' => 'kata_show_archive_title',
					'section'  => 'kata_archive_title_section',
					'label'    => esc_html__( 'Show Archive Title', 'kata' ),
					'default'  => '1',
					'choices'  => [
						'off' => esc_html__( 'Hide', 'kata' ),
						'on'  => esc_html__( 'Show', 'kata' ),
					],
				]
			);

			// Search Title section
			new \Kirki\Section(
				'kata_search_title_section',
				[
					'panel'      => 'kata_page_panel',
					'title'      => esc_html__( 'Search Title', 'kata' ),
					'capability' => kata_Helpers::capability(),
				]
			);
			new \Kirki\Field\Checkbox_Switch(
				[
					'settings' => 'kata_show_search_title',
					'section'  => 'kata_search_title_section',
					'label'    => esc_html__( 'Show Search Title', 'kata' ),
					'default'  => '1',
					'choices'  => [
						'off' => esc_html__( 'Hide', 'kata' ),
						'on'  => esc_html__( 'Show', 'kata' ),
					],
				]
			);

			// -> Sidebar section
			new \Kirki\Section(
				'kata_page_sidebar_section',
				[
					'panel'      => 'kata_page_panel',
					'title'      => esc_html__( 'Sidebar', 'kata' ),
					'capability' => kata_Helpers::capability(),
				]
			);
			new \Kirki\Field\Radio_Buttonset(
				[
					'settings' => 'kata_page_sidebar_position',
					'section'  => 'kata_page_sidebar_section',
					'label'    => esc_html__( 'Sidebar Position', 'kata' ),
					'default'  => 'none',
					'choices'  => [
						'none'  => esc_html__( 'None', 'kata' ),
						'left'  => esc_html__( 'Left', 'kata' ),
						'right' => esc_html__( 'Right', 'kata' ),
						'both'  => esc_html__( 'Both', 'kata' ),
					],
				]
			);
		}
	} // class

	Kata_Theme_Options_Page::set_options();
}
