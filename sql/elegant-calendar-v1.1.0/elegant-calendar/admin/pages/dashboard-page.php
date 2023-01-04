<?php
/**
 * Elegant_Calendar_Dashboard_Page Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Dashboard_Page' ) ) :

    class Elegant_Calendar_Dashboard_Page extends Elegant_Calendar_Admin_Page {

        /**
         * Add page screen hooks
         *
         * @since 1.0.0
         *
         * @param $hook
         */
        public function enqueue_scripts( $hook ) {
            // Load admin styles
            elegant_calendar_admin_enqueue_styles( ELEGANT_CALENDAR_VERSION );

            $elegant_calendar_data = new Elegant_Calendar_Admin_Data();

            // Load admin dashboard scripts
            elegant_calendar_admin_enqueue_scripts_dashboard(
                ELEGANT_CALENDAR_VERSION,
                $elegant_calendar_data->get_options_data()
            );
        }

    }

endif;
