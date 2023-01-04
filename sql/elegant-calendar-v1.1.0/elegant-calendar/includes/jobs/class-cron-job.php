<?php
/**
 * Elegant_Calendar_Cron_Job Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Cron_Job' ) ) :

   class Elegant_Calendar_Cron_Job {

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
        * @return Elegant_Calendar_Cron_Job
        */
       public static function get_instance() {
           if ( is_null( self::$instance ) ) {
               self::$instance = new self();
           }

           return self::$instance;
       }

       /**
       * Elegant_Calendar_Cron_Job constructor.
       *
       * @since 1.0.0
       */
       public function __construct() {
           // Add a custom interval
           add_filter( 'cron_schedules', array( $this, 'elegant_calendar_add_cron_interval' ) );
           // Setup Cron Job
           $this->cron_setup();
       }

       /**
        * Add a custom interval
        *
        * @since 1.0.0
        */
       public function elegant_calendar_add_cron_interval( $schedules ) {
           $schedules['once_elegant_calendar_a_minute'] = array(
               'interval' => 60,
               'display'  => esc_html__( 'Once Elegant Calendar Job a Minute', Elegant_Calendar::DOMAIN )
           );
           return $schedules;
       }

       /**
        * Setup Cron Job
        *
        * @since 1.0.0
        */
       public function cron_setup(){

         if ( ! wp_next_scheduled( 'elegant_calendar_cron_hook' ) ) {
            wp_schedule_event( time(), 'once_elegant_calendar_a_minute', 'elegant_calendar_cron_hook' );
         }

         // Add Cron Job Hook Function
         add_action( 'elegant_calendar_cron_hook', array( $this, 'elegant_calendar_cron_exec' )  );

       }

       /**
        * Cron Job Execute
        *
        * @since 1.0.0
        */
       public function elegant_calendar_cron_exec(){
           $global_settings = get_option('elegant_global_settings');

           // Run schedules job here
           $data = Elegant_Calendar_Event_Model::model()->get_all_models();

           foreach ( $data['models'] as $model ) {
                $settings = $model->get_settings();
                $end_time = strtotime($settings['elegant_event_end_date']." ".$settings['elegant_event_end_time']);
                $current_time = current_time('timestamp');

                // Change past event status to draft
               if(isset($global_settings['past_event_trash']) && $global_settings['past_event_trash'] == 'on' && $current_time >= $end_time){
                    if ( $model instanceof Elegant_Calendar_Event_Model ) {
                        $model->status = 'draft';
                        $model->save();
                    }
                }
            }
       }


   }

   /**
   * Kicking this off by calling 'get_instance()' method
   */
   Elegant_Calendar_Cron_Job::get_instance();

endif;
