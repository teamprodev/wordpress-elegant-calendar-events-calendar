<?php
/**
 * Elegant_Calendar_Event_Page Class
 *
 * @since  1.0.0
 * @package Elegant Calendar
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! class_exists( 'Elegant_Calendar_Event_Page' ) ) :

class Elegant_Calendar_Event_Page extends Elegant_Calendar_Admin_Page {

    /**
     * Page number
     *
     * @var int
     */
    protected $page_number = 1;

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

        // Load admin backups scripts
        elegant_calendar_admin_enqueue_scripts_event_list(
            ELEGANT_CALENDAR_VERSION,
            $elegant_calendar_data->get_options_data()
        );
    }

    /**
     * Initialize
     *
     * @since 1.0.0
     */
    public function init() {
        $pagenum           = isset( $_REQUEST['paged'] ) ? absint( $_REQUEST['paged'] ) : 0; // WPCS: CSRF OK
        $this->page_number = max( 1, $pagenum );
        $this->processRequest();
    }

    /**
     * Process request
     *
     * @since 1.0.0
     */
    public function processRequest() {

        if ( ! isset( $_POST['elegant_calendar_nonce'] ) ) {
            return;
        }

        $nonce = $_POST['elegant_calendar_nonce'];
        if ( ! wp_verify_nonce( $nonce, 'elegant-calendar-event-request' ) ) {
            return;
        }

        $is_redirect = true;
        $action = "";
        if(isset($_POST['elegant_calendar_bulk_action'])){
            $action = sanitize_text_field($_POST['elegant_calendar_bulk_action']);
            $ids = isset( $_POST['ids'] ) ? sanitize_text_field( $_POST['ids'] ) : '';
        }else if(isset($_POST['elegant_calendar_single_action'])){
            $action = sanitize_text_field($_POST['elegant_calendar_single_action']);
            $id = isset( $_POST['id'] ) ? sanitize_text_field( $_POST['id'] ) : '';

        }
        switch ( $action ) {
            case 'delete':
                if ( isset( $id ) && !empty( $id ) ) {
                    $this->delete_module( $id );
                }
                break;

            case 'update-status':
                if ( isset( $id ) && !empty( $id ) ) {
                    $this->update_module_status( $id, sanitize_text_field($_POST['status']) );
                }
                break;


            case 'delete-events' :
                if ( isset( $ids ) && !empty( $ids ) ) {
                    $form_ids = explode( ',', $ids );
                    if ( is_array( $form_ids ) && count( $form_ids ) > 0 ) {
                        foreach ( $form_ids as $id ) {
                            $this->delete_module( $id );
                        }
                    }
                }
                break;

            case 'publish-events' :
                if ( isset( $ids ) && !empty( $ids ) ) {
                    $form_ids = explode( ',', $ids );
                    if ( is_array( $form_ids ) && count( $form_ids ) > 0 ) {
                        foreach ( $form_ids as $form_id ) {
                            $this->update_module_status( $form_id, 'publish' );
                        }
                    }
                }
                break;

            case 'draft-events' :
                if ( isset( $ids ) && !empty( $ids ) ) {
                    $form_ids = explode( ',', $ids );
                    if ( is_array( $form_ids ) && count( $form_ids ) > 0 ) {
                        foreach ( $form_ids as $form_id ) {
                            $this->update_module_status( $form_id, 'draft' );
                        }
                    }
                }
                break;

            default:
                break;
        }

        if ( $is_redirect ) {
            $fallback_redirect = admin_url( 'admin.php' );
            $fallback_redirect = add_query_arg(
                array(
                    'page' => $this->get_admin_page(),
                ),
                $fallback_redirect
            );
            $this->maybe_redirect_to_referer( $fallback_redirect );
        }

        exit;
    }

	/**
	 * Count modules
	 *
	 * @since 1.0.0
	 * @return int
	 */
	public function countModules( $status = '' ) {
		return Elegant_Calendar_Event_Model::model()->count_all( $status );
	}

	/**
	 * Return modules
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function getModules() {
		$modules = array();
		$limit   = null;
		if ( defined( 'ELEGANT_CALENDAR_FORMS_LIST_LIMIT' ) && ELEGANT_CALENDAR_FORMS_LIST_LIMIT ) {
			$limit = ELEGANT_CALENDAR_FORMS_LIST_LIMIT;
		}
		$data      = $this->get_models( $limit );

		// Fallback
		if ( ! isset( $data['models'] ) || empty( $data['models'] ) ) {
			return $modules;
		}

		foreach ( $data['models'] as $model ) {
            $settings = $model->get_settings();

            $modules[] = array(
				"id"              => $model->id,
				"date"            => date( get_option( 'date_format' ), strtotime( $model->raw->post_date ) ),
				"status"          => $model->status,
            );
		}

		return $modules;
	}

    /**
     * Return models
     *
     * @since 1.0.0
     *
     * @param int $limit
     *
     * @return array
     */
    public function get_models( $limit = null ) {
        $data = Elegant_Calendar_Event_Model::model()->get_all_paged( $this->page_number, $limit );

        return $data;
    }

    /**
     * Delete module
     *
     * @since 1.0.0
     *
     * @param $id
     */
    public function delete_module( $id ) {
        //check if this id is valid and the record is exists
        $model = Elegant_Calendar_Event_Model::model()->load( $id );
        if ( is_object( $model ) ) {
            wp_delete_post( $id );
        }
    }

    /**
     * Bulk actions
     *
     * @since 1.0
     * @return array
     */
    public function bulk_actions() {
        return apply_filters(
            'elegant_event_bulk_actions',
            array(
                'publish-events'    => esc_html__( "Publish", Elegant_Calendar::DOMAIN ),
                'draft-events'      => esc_html__( "Unpublish", Elegant_Calendar::DOMAIN ),
                'delete-events'     => esc_html__( "Delete", Elegant_Calendar::DOMAIN ),
            ) );
    }

    /**
     * Update Module Status
     *
     * @since 1.0.0
     *
     * @param $id
     * @param $status
     */
    public function update_module_status( $id, $status ) {
        // only publish and draft status avail
        if ( in_array( $status, array( 'publish', 'draft' ), true ) ) {
            $model = Elegant_Calendar_Event_Model::model()->load( $id );
            if ( $model instanceof Elegant_Calendar_Event_Model ) {
                $model->status = $status;
                $model->save();
            }
        }
    }

    /**
     * Pagination
     *
     * @since 1.0
     */
    public function pagination() {
        $count = $this->countModules();
        elegant_calendar_list_pagination( $count, 'events' );
    }


}

endif;
