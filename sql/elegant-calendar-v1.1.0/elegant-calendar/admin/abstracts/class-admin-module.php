<?php
/**
 * Elegant_Calendar_Admin_Module Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Admin_Module' ) ) :

abstract class Elegant_Calendar_Admin_Module {

	/**
	 * @var array
	 */
	public $pages = array();

	/**
	 * @var string
	 */
	public $page = '';

	/**
	 * @var string
	 */
	public $page_edit = '';

	/**
	 * @var string
	 */
	public $page_entries = '';

	/**
	 * Elegant_Calendar_Admin_Module constructor.
	 *
	 * @since 1.0
	 */
	public function __construct() {
		$this->init();
		$this->includes();

		add_action( 'admin_menu', array( $this, 'add_menu_pages' ) );
		add_action( 'admin_head', array( $this, 'hide_menu_pages' ) );

		// admin-menu-editor compat
		add_action( 'admin_menu_editor-menu_replaced', array( $this, 'hide_menu_pages' ) );

		add_filter( 'submenu_file', array( $this, 'admin_submenu_file' ), 10, 2 );
	}

	/**
	 * Init
	 *
	 * @since 1.0
	 */
	public function init() {
		// Call init instead of __construct in modules
	}

	/**
	 * Attach admin pages
	 *
	 * @since 1.0
	 */
	public function add_menu_pages() {}

	/**
	 * Hide pages from menu
	 *
	 * @since 1.0
	 */
	public function hide_menu_pages() {}

	/**
	 * Used to include files
	 *
	 * @since 1.0
	 */
	public function includes() {}

	/**
	 * Is the admin page being viewed in edit mode
	 *
	 * @since 1.0
	 * @return mixed
	 */
	public static function is_edit() {
		return (bool) filter_input( INPUT_GET, 'id', FILTER_VALIDATE_INT );
	}

	/**
	 * Is the module admin dashboard page
	 *
	 * @since 1.0
	 * @return bool
	 */
	public function is_admin_home() {
		global $plugin_page;

		return $this->page === $plugin_page;
	}

	/**
	 * Is the module admin new/edit page
	 *
	 * @since 1.0
	 * @return bool
	 */
	public function is_admin_wizard() {
		global $plugin_page;

		return $this->page_edit === $plugin_page;
	}

	/**
	 * Highlight parent page in sidebar
	 *
	 * @deprecated 1.1 No longer used because this function override prohibited WordPress global of $plugin_page
	 * @since      1.0
	 *
	 * @param $file
	 *
	 * @return mixed
	 */
	public function highlight_admin_parent( $file ) {
		_deprecated_function( __METHOD__, '1.1', null );
		return $file;
	}

	/**
	 * Highlight submenu on admin page
	 *
	 * @since 1.1
	 *
	 * @param $submenu_file
	 * @param $parent_file
	 *
	 * @return string
	 */
	public function admin_submenu_file( $submenu_file, $parent_file ) {
		global $plugin_page;

		if ( 'elegant_calendar' !== $parent_file ) {
			return $submenu_file;
		}

		if ( $this->page_edit === $plugin_page || $this->page_entries === $plugin_page ) {
			$submenu_file = $this->page;
		}

		return $submenu_file;
	}
}

endif;
