<?php
/**
 * Elegant_Calendar_Event_Admin Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Event_Admin' ) ) :
	
class Elegant_Calendar_Event_Admin extends Elegant_Calendar_Admin_Module {

	/**
	 * Init module admin
	 *
	 * @since 1.0
	 */
	public function init() {
		$this->module       = Elegant_Calendar_Event::get_instance();
		$this->page         = 'elegant-calendar-event';
		$this->page_edit    = 'elegant-calendar-event-wizard';
	}

	/**
	 * Include required files
	 *
	 * @since 1.0
	 */
	public function includes() {
		include_once dirname( __FILE__ ) . '/admin-page-new.php';
		include_once dirname( __FILE__ ) . '/admin-page-view.php';
	}

	/**
	 * Add module pages to Admin
	 *
	 * @since 1.0
	 */
	public function add_menu_pages() {
		new Elegant_Calendar_Event_Page( $this->page, 'event/list', esc_html__( 'Events', Elegant_Calendar::DOMAIN ), esc_html__( 'Events', Elegant_Calendar::DOMAIN ), 'elegant-calendar' );
		new Elegant_Calendar_Event_New_Page( $this->page_edit, 'event/wizard', esc_html__( 'Edit Event', Elegant_Calendar::DOMAIN ), esc_html__( 'New Event', Elegant_Calendar::DOMAIN ), 'elegant-calendar' );
	}

	/**
	 * Remove necessary pages from menu
	 *
	 * @since 1.0
	 */
	public function hide_menu_pages() {
		remove_submenu_page( 'elegant-calendar', $this->page_edit );
	}

	/**
	 * Return template
	 *
	 * @since 1.0
	 * @return Elegant_Calendar_Template|false
	 */
	private function get_template() {
		if( isset( $_GET['template'] ) )  {
			$id = trim( sanitize_text_field( $_GET['template'] ) );
		} else {
			$id = 'blank';
		}

		foreach ( $this->module->templates as $key => $template ) {
			if ( $template->options['id'] === $id ) {
				return $template;
			}
		}

		return false;
	}
}

endif;
