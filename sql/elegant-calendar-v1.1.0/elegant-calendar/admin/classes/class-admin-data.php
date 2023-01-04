<?php
/**
 * Elegant_Calendar_Admin_Data Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Admin_Data' ) ) :

    class Elegant_Calendar_Admin_Data {

        public $core = null;

        /**
         * Current Nonce
         *
         * @since 1.0.0
         * @var string
         */
        private $_nonce = '';

        /**
         * Elegant_Calendar_Admin_Data constructor.
         *
         * @since 1.0.0
         */
        public function __construct() {
            $this->generate_nonce();
        }

        /**
         * Generate nonce
         *
         * @since 1.0.0
         */
        public function generate_nonce() {
            $this->_nonce = wp_create_nonce( 'elegant-calendar' );
        }

        /**
         * Get current generated nonce
         *
         * @since 1.0.0
         * @return string
         */
        public function get_nonce() {
            return $this->_nonce;
        }

        /**
         * Combine Data and pass to JS
         *
         * @since 1.0.0
         * @return array
         */
        public function get_options_data() {
            $data           = $this->admin_js_defaults();
            $data           = apply_filters( 'elegant_calendar_data', $data );

            return $data;
        }

        /**
         * Default Admin properties
         *
         * @since 1.0.0
         * @return array
         */
        public function admin_js_defaults() {

            return array(
                'ajaxurl'                        => elegant_calendar_ajax_url(),
                '_ajax_nonce'                    => $this->get_nonce(),
                'wizard_url'                     => admin_url( 'admin.php?page=elegant-calendar-event-wizard' ),
            );
        }

    }

endif;
