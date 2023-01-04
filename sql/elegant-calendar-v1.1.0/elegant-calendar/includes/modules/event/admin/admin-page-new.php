<?php
/**
 * Elegant_Calendar_Event_New_Page Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Event_New_Page' ) ) :

class Elegant_Calendar_Event_New_Page extends Elegant_Calendar_Admin_Page {


    /**
     * Get wizard title
     *
     * @since 1.0
     * @return mixed
     */
    public function getWizardTitle() {
        if ( isset( $_REQUEST['id'] ) ) { // WPCS: CSRF OK
            return esc_html__( "Edit Calendar", Elegant_Calendar::DOMAIN );
        } else {
            return esc_html__( "New Calendar", Elegant_Calendar::DOMAIN );
        }
    }

    /**
     * Add page screen hooks
     *
     * @since 1.0.0
     * @param $hook
     */
    public function enqueue_scripts( $hook ) {
        // Load admin styles
        elegant_calendar_admin_enqueue_styles( ELEGANT_CALENDAR_VERSION );

        $elegant_calendar_data = new Elegant_Calendar_Admin_Data();

        // Load admin event edit scripts
        elegant_calendar_admin_enqueue_scripts_event_edit(
            ELEGANT_CALENDAR_VERSION,
            $elegant_calendar_data->get_options_data()
        );

    }

    /**
     * Render page header
     *
     * @since 1.0
     */
    protected function render_header() { ?>
        <?php
        if ( $this->template_exists( $this->folder . '/header' ) ) {
            $this->template( $this->folder . '/header' );
        } else {
            ?>
            <h1 class="elegant-header-title"><?php echo esc_html( get_admin_page_title() ); ?></h1>
        <?php } ?>
        <?php
    }

    /**
     * Return event model
     *
     * @since 1.0.0
     *
     * @param int $id
     *
     * @return array
     */
    public function get_event_model( $id, $status ) {
        $data = Elegant_Calendar_Event_Model::model()->get_event_model( $id, $status );

        return $data;
    }



}

endif;
