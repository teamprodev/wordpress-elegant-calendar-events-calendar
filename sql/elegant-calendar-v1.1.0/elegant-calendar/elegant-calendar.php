<?php
/**
 * Plugin Name: Elegant Calendar - Wordpress Events Calendar Plugin
 * Plugin URI: https://elegantcalendar.com
 * Description: Elegant Calendar is a flexible plugin that make you easily manage and share events.
 * Version: 1.1.0
 * Author: wphobby
 * Author URI: https://elegantcalendar.com/
 *
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * Set constants
 */
if ( ! defined( 'ELEGANT_CALENDAR_DIR' ) ) {
    define( 'ELEGANT_CALENDAR_DIR', plugin_dir_path(__FILE__) );
}

if ( ! defined( 'ELEGANT_CALENDAR_URL' ) ) {
    define( 'ELEGANT_CALENDAR_URL', plugin_dir_url(__FILE__) );
}

if ( ! defined( 'ELEGANT_CALENDAR_VERSION' ) ) {
    define( 'ELEGANT_CALENDAR_VERSION', '1.1.0' );
}

// Register activation hook
register_activation_hook( __FILE__, array( 'Elegant_Calendar', 'activation_hook' ) );

/**
 * Class Elegant_Calendar
 *
 * Main class. Initialize plugin
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'Elegant_Calendar' ) ) {
    /**
     * Elegant_Calendar
     */
    class Elegant_Calendar {

        const DOMAIN = 'elegant-calendar';

        /**
         * Instance of Elegant_Calendar
         *
         * @since  1.0.0
         * @var (Object) Elegant_Calendar
         */
        private static $_instance = null;

        /**
         * Get instance of Elegant_Calendar
         *
         * @since  1.0.0
         *
         * @return object Class object
         */
        public static function get_instance() {
            if ( ! isset( self::$_instance ) ) {
                self::$_instance = new self;
            }
            return self::$_instance;
        }

        /**
         * Constructor
         *
         * @since  1.0.0
         */
        private function __construct() {
            add_action( 'admin_init', array( $this, 'initialize_admin' ) );

            $this->includes();
            $this->init();
        }

        /**
		 * Called on plugin activation
		 *
		 * @since 1.0.0
		 */
		public static function activation_hook() {
			add_option( 'elegant_calendar_activation_hook', 'activated' );
		}

        /**
		 * Called on admin_init
		 *
		 * Flush rewrite rules are not called directly on activation hook, because CPT are not initialized yet
		 *
		 * @since 1.0.0
		 */
		public function initialize_admin() {
			if ( is_admin() && 'activated' === get_option( 'elegant_calendar_activation_hook' ) ) {
				delete_option( 'elegant_calendar_activation_hook' );
				flush_rewrite_rules();
			}
		}

        /**
         * Load plugin files
         *
         * @since 1.0
         */
        private function includes() {
            // Core files.
            require_once ELEGANT_CALENDAR_DIR . '/includes/class-core.php';
        }


        /**
         * Init the plugin
         *
         * @since 1.0.0
         */
        private function init() {
            // Initialize plugin core
            $this->elegant_calendar = Elegant_Calendar_Core::get_instance();

            /**
             * Triggered when plugin is loaded
             */
            do_action( 'elegant_calendar_loaded' );

        }

    }
}

if ( ! function_exists( 'elegant_calendar' ) ) {
    function elegant_calendar() {
        return Elegant_Calendar::get_instance();
    }

    /**
     * Init the plugin and load the plugin instance
     *
     * @since 1.0.0
     */
    add_action( 'plugins_loaded', 'elegant_calendar' );
}
