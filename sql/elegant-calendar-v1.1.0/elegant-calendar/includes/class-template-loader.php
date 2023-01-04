<?php
/**
 * Elegant_Calendar_Template_Loader Class
 *
 * Plugin Template_Loader Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Template_Loader' ) ) :

    class Elegant_Calendar_Template_Loader {

        /**
         * Plugin instance
         *
         * @var null
         */
        private static $instance = null;

        /**
         * Return the plugin instance
         *
         * @since 1.0.0
         * @return Elegant_Calendar_Template_Loader
         */
        public static function get_instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        /**
         * Elegant_Calendar_Template_Loader constructor.
         *
         * @since 1.0
         */
        public function __construct() {
            add_filter( 'template_include', array( $this, 'template_loader' ) , 99);
            add_filter( 'wp_insert_post_data', array( $this, 'default_comments_on' ) , 99 );
        }

        /**
         * template loader.
         *
         * @since 1.0
         */
        public function template_loader( $template ) {
            // single and archive events page
            if( is_single() && get_post_type() == 'elegant_event' ) {
                $paths[] 	= ELEGANT_CALENDAR_DIR . '/templates/';
                $file 	= 'single-event-content.php';
                $file = apply_filters('elegant_template_loader_file', $file);
                $template = ELEGANT_CALENDAR_DIR . 'templates/' . $file;
            }
            return $template;
        }

        public function default_comments_on( $data ) {
            if( $data['post_type'] == 'elegant_event' ) {
                $data['comment_status'] = 'open';
            }
            return $data;
        }

    }

    /**
	 * Kicking this off by calling 'get_instance()' method
	 */
	Elegant_Calendar_Template_Loader::get_instance();

endif;
