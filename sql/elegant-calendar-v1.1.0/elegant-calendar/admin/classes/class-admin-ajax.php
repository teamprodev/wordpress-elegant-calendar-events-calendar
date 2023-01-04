<?php
/**
 * Elegant_Calendar_Admin_AJAX Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Admin_AJAX' ) ) :

    class Elegant_Calendar_Admin_AJAX {

        /**
         * Elegant_Calendar_Admin_AJAX constructor.
         *
         * @since 1.0
         */
        public function __construct() {
            // WP Ajax Actions.
            add_action( 'wp_ajax_elegant_calendar_save_event', array( $this, 'save_event' ) );
            add_action( 'wp_ajax_elegant_save_glabal_settings', array( $this, 'save_glabal_settings' ) );
        }

        /**
         * Save Event
         *
         * @since 1.0.0
         */
        public function save_event() {

            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            if ( ! wp_verify_nonce($_POST['_ajax_nonce'], 'elegant-calendar') ) {
                wp_send_json_error( esc_html__( 'You are not allowed to perform this action', Elegant_Calendar::DOMAIN ) );
            }

            if ( isset( $_POST['fields_data'] ) ) {
                $fields  = elegant_calendar_sanitize_field($_POST['fields_data']);
                $id      = isset( $fields['event_id'] ) ? $fields['event_id'] : null;
                $id      = intval( $id );
                $status  = isset( $fields['event_status'] ) ? $fields['event_status'] : '';

                if ( is_null( $id ) || $id <= 0 ) {
                    $form_model = new Elegant_Calendar_Event_Model();
                    $action     = 'create';

                    if ( empty( $status ) ) {
                        $status = Elegant_Calendar_Event_Model::STATUS_DRAFT;
                    }
                }else{
                    $form_model = Elegant_Calendar_Event_Model::model()->load( $id );
                    $action     = 'update';
                }

                // Set Settings to model
                $form_model->settings = $fields;

                // status
                $form_model->status = $status;

                // Save data
                $id = $form_model->save();

                if (!$id) {
                    wp_send_json_error( $id );
                }else{
                    wp_send_json_success( $id );
                }

                wp_send_json_success( esc_html__( 'Event saved successfully!', Elegant_Calendar::DOMAIN ) );
            } else {
                wp_send_json_error( esc_html__( 'User submit data are empty!', Elegant_Calendar::DOMAIN ) );
            }

        }

        /**
         * Save Global Settings
         *
         * @since 1.0.0
         */
        public function save_glabal_settings() {

            if ( ! current_user_can( 'manage_options' ) ) {
                return;
            }

            if ( ! wp_verify_nonce($_POST['_ajax_nonce'], 'elegant-calendar') ) {
                wp_send_json_error( esc_html__( 'You are not allowed to perform this action', Elegant_Calendar::DOMAIN ) );
            }

            if ( isset( $_POST['fields_data'] ) ) {
                update_option( 'elegant_global_settings', elegant_calendar_sanitize_field($_POST['fields_data']) );
                wp_send_json_success( esc_html__( 'Global Settings has been connected successfully.', Elegant_Calendar::DOMAIN ) );
            } else {
                wp_send_json_error( esc_html__( 'User submit data are empty!', Elegant_Calendar::DOMAIN ) );
            }

        }
    }

endif;
