<?php
/**
 * Elegant_Calendar_Admin Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Admin' ) ) :

    class Elegant_Calendar_Admin {

        /**
         * @var array
         */
        public $pages = array();

        /**
         * Elegant_Calendar_Admin constructor.
         */
        public function __construct() {
            $this->includes();

            // Init admin pages
            add_action( 'admin_menu', array( $this, 'add_dashboard_page' ) );

            // Init Admin AJAX class
            new Elegant_Calendar_Admin_AJAX();

            /**
             * Triggered when Admin is loaded
             */
            do_action( 'elegant_admin_loaded' );
        }

        /**
         * Include required files
         *
         * @since 1.0.0
         */
        private function includes() {
            // Admin Pages
            require_once ELEGANT_CALENDAR_DIR . '/admin/pages/dashboard-page.php';
            require_once ELEGANT_CALENDAR_DIR . '/admin/pages/settings-page.php';

            // Admin AJAX
            require_once ELEGANT_CALENDAR_DIR . '/admin/classes/class-admin-ajax.php';

            // Admin Data
            require_once ELEGANT_CALENDAR_DIR . '/admin/classes/class-admin-data.php';
        }


        /**
         * Initialize Dashboard page
         *
         * @since 1.0.0
         */
        public function add_dashboard_page() {
            $title = esc_html__( 'Calendar', Elegant_Calendar::DOMAIN );

            $this->pages['elegant_calendar']           = new Elegant_Calendar_Dashboard_Page( 'elegant-calendar', 'dashboard', $title, $title, false, false );
            $this->pages['elegant_calendar-dashboard'] = new Elegant_Calendar_Dashboard_Page( 'elegant-calendar', 'dashboard', esc_html__( 'Elegant Calendar Dashboard', Elegant_Calendar::DOMAIN ), esc_html__( 'Dashboard', Elegant_Calendar::DOMAIN ), 'elegant-calendar' );
        }

        /**
         * Add settings page
         *
         * @since 1.0.0
         */
        public function add_settings_page() {
            add_action( 'admin_menu', array( $this, 'init_settings_page' ) );
        }

        /**
         * Initialize Logs page
         *
         * @since 1.0.0
         */
        public function init_settings_page() {
            $this->pages['elegant-calendar_settings'] = new Elegant_Calendar_Settings_Page(
                'elegant-calendar-settings',
                'settings',
                esc_html__( 'Settings', 'elegant-calendar' ),
                esc_html__( 'Settings', 'elegant-calendar' ),
                'elegant-calendar'
            );
        }

    }

endif;
