<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

/**
 * Return needed cap for admin pages
 *
 * @since 1.0.0
 * @return string
 */
function elegant_calendar_get_admin_cap() {
    $cap = 'manage_options';

    if ( is_multisite() && is_network_admin() ) {
        $cap = 'manage_network';
    }

    return apply_filters( 'elegant_calendar_admin_cap', $cap );
}

/**
 * Enqueue front styles
 *
 * @since 1.0.0
 *
 * @param $version
 */
function elegant_calendar_front_enqueue_styles( $version ) {
    wp_enqueue_style( 'elegant-grid-style', ELEGANT_CALENDAR_URL . 'assets/css/grid.css', array(), $version, false );
    wp_enqueue_style( 'elegant-front-style', ELEGANT_CALENDAR_URL . 'assets/css/front.css', array(), $version, false );
    wp_enqueue_style( 'bootstrap3-block', ELEGANT_CALENDAR_URL . 'assets/css/library/bootstrap3-block-grid.min.css', array(), $version, false );
    wp_enqueue_style( 'bootstrap4-block', ELEGANT_CALENDAR_URL . 'assets/css/library/bootstrap4-block-grid.min.css', array(), $version, false );
    wp_enqueue_style( 'tui-date-picker', ELEGANT_CALENDAR_URL . 'assets/css/tui-calendar/tui-date-picker.css', array(), $version, false );
    wp_enqueue_style( 'tui-calendar', ELEGANT_CALENDAR_URL . 'assets/css/tui-calendar/tui-calendar.css', array(), $version, false );
    wp_enqueue_style( 'tui-default', ELEGANT_CALENDAR_URL . 'assets/css/tui-calendar/default.css', array(), $version, false );
    wp_enqueue_style( 'tui-icons', ELEGANT_CALENDAR_URL . 'assets/css/tui-calendar/icons.css', array(), $version, false );
}

/**
 * Enqueue front scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_front_enqueue_scripts( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'ionicons-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js', array(), $version, false );
    wp_enqueue_script( 'ionicons-no-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js', array(), $version, false );

    wp_enqueue_script( 'bootstrap', ELEGANT_CALENDAR_URL . 'assets/js/library/bootstrap.min.js', array('jquery'), $version, false );
    wp_enqueue_script( 'tui-code-snippet', ELEGANT_CALENDAR_URL . 'assets/js/tui-calendar/tui-code-snippet.min.js', array(), $version, false );
    wp_enqueue_script( 'tui-time-picker', ELEGANT_CALENDAR_URL . 'assets/js/tui-calendar/tui-time-picker.min.js', array(), $version, false );
    wp_enqueue_script( 'tui-date-picker', ELEGANT_CALENDAR_URL . 'assets/js/tui-calendar/tui-date-picker.min.js', array(), $version, false );
    wp_enqueue_script( 'moment', ELEGANT_CALENDAR_URL . 'assets/js/tui-calendar/moment.min.js', array(), $version, false );
    wp_enqueue_script( 'chance', ELEGANT_CALENDAR_URL . 'assets/js/tui-calendar/chance.min.js', array(), $version, false );
    wp_enqueue_script( 'tui-calendar', ELEGANT_CALENDAR_URL . 'assets/js/tui-calendar/tui-calendar.js', array(), $version, false );
    wp_enqueue_script( 'elegant-calendar-default', ELEGANT_CALENDAR_URL . 'assets/js/default.js', array('jquery'), $version, true );



    wp_register_script(
        'elegant-calendar-front',
        ELEGANT_CALENDAR_URL . 'assets/js/calendar-front.js',
        array('jquery'),
        $version,
        false
    );

    wp_enqueue_script( 'elegant-calendar-front' );

    $data = array(
        'ajaxurl' => elegant_calendar_ajax_url(),
    );

    wp_localize_script( 'elegant-calendar-front', 'Elegant_Front_Data', $data );

    $event_data = elegant_calendar_front_event_data();

    wp_localize_script( 'elegant-calendar-default', 'Elegant_Event_Data', $event_data );

}

/**
 * Enqueue admin styles
 *
 * @since 1.0.0
 *
 * @param $version
 */
function elegant_calendar_admin_enqueue_styles( $version ) {
    wp_enqueue_style( 'jquery-ui', ELEGANT_CALENDAR_URL . 'assets/css/admin/jquery-ui.min.css' );
    wp_enqueue_style( 'magnific-popup', ELEGANT_CALENDAR_URL . 'assets/css/admin/magnific-popup.css', array(), $version, false );
    wp_enqueue_style( 'elegant-calendar-select2-style', ELEGANT_CALENDAR_URL . 'assets/css/admin/select2.min.css', array(), $version, false );
    wp_enqueue_style( 'elegant-calendar-main-style', ELEGANT_CALENDAR_URL . 'assets/css/admin/main.css', array(), $version, false );
    wp_enqueue_style( 'wp-color-picker' );
}

/**
 * Enqueue admin scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts( $version, $data = array(), $l10n = array() ) {

    if ( function_exists( 'wp_enqueue_editor' ) ) {
        wp_enqueue_editor();
    }
    if ( function_exists( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }

    wp_enqueue_script( 'elegant-ionicons', ELEGANT_CALENDAR_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );

    wp_enqueue_script( 'jquery-magnific-popup', ELEGANT_CALENDAR_URL . 'assets/js/library/jquery.magnific-popup.min.js', array( 'jquery' ), $version, false );
}

/**
 * Enqueue admin backups scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts_event_edit( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'ionicons-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js', array(), $version, false );
    wp_enqueue_script( 'ionicons-no-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js', array(), $version, false );    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'elegant-calendar-select2', ELEGANT_CALENDAR_URL . '/assets/js/library/select2.min.js', array( 'jquery' ), $version, false );
    wp_enqueue_script( 'wp-color-picker' );

    wp_register_script(
        'elegant-event-edit',
        ELEGANT_CALENDAR_URL . 'assets/js/admin/event-edit.js',
        array('jquery'),
        $version,
        false
    );

    wp_enqueue_script( 'elegant-event-edit' );

    wp_localize_script( 'elegant-event-edit', 'Elegant_Calendar_Data', $data );
}

/**
 * Enqueue admin backups scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts_event_list( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'ionicons-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js', array(), $version, false );
    wp_enqueue_script( 'ionicons-no-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js', array(), $version, false );
    wp_register_script(
        'elegant-calendar-event-list',
        ELEGANT_CALENDAR_URL . 'assets/js/admin/event-list.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'elegant-calendar-event-list' );

    wp_localize_script( 'elegant-calendar-event-list', 'Elegant_Calendar_Data', $data );
}

/**
 * Enqueue admin dashboard scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts_dashboard( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'ionicons-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js', array(), $version, false );
    wp_enqueue_script( 'ionicons-no-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js', array(), $version, false );
    wp_register_script(
        'elegant-calendar-dashboard',
        ELEGANT_CALENDAR_URL . 'assets/js/admin/dashboard.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'elegant-calendar-dashboard' );

    wp_localize_script( 'elegant-calendar-dashboard', 'Elegant_Calendar_Data', $data );
}
/**
 * Enqueue admin help scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts_help( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'elegant-ionicons', ELEGANT_CALENDAR_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );
}
/**
 * Enqueue admin leads scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts_leads( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'elegant-ionicons', ELEGANT_CALENDAR_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'elegant-calendar-leads',
        ELEGANT_CALENDAR_URL . 'assets/js/leads.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'elegant-calendar-leads' );

    wp_localize_script( 'elegant-calendar-leads', 'Elegant_Calendar_Data', $data );

}

/**
 * Enqueue admin leads scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts_integrations( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'elegant-ionicons', ELEGANT_CALENDAR_URL . '/assets/js/library/ionicons.js', array( 'jquery' ), $version, false );
    wp_enqueue_script( 'jquery-magnific-popup', ELEGANT_CALENDAR_URL . 'assets/js/library/jquery.magnific-popup.min.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'elegant-calendar-integrations',
        ELEGANT_CALENDAR_URL . 'assets/js/integrations.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'elegant-calendar-integrations' );

    wp_localize_script( 'elegant-calendar-integrations', 'Elegant_Calendar_Data', $data );

}

/**
 * Enqueue admin settings scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts_settings( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'ionicons-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js', array(), $version, false );
    wp_enqueue_script( 'ionicons-no-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js', array(), $version, false );    wp_enqueue_script( 'elegant-calendar-select2', ELEGANT_CALENDAR_URL . '/assets/js/library/select2.min.js', array( 'jquery' ), $version, false );
    wp_enqueue_script( 'jquery-magnific-popup', ELEGANT_CALENDAR_URL . 'assets/js/library/jquery.magnific-popup.min.js', array( 'jquery' ), $version, false );
    wp_enqueue_script( 'wp-color-picker' );

    wp_register_script(
        'elegant-calendar-settings',
        ELEGANT_CALENDAR_URL . 'assets/js/admin/settings.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'elegant-calendar-settings' );

    wp_localize_script( 'elegant-calendar-settings', 'Elegant_Calendar_Data', $data );
}

/**
 * Enqueue admin settings scripts
 *
 * @since 1.0.0
 *
 * @param       $version
 * @param array $data
 * @param array $l10n
 */
function elegant_calendar_admin_enqueue_scripts_licenses( $version, $data = array(), $l10n = array() ) {
    wp_enqueue_script( 'ionicons-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.esm.js', array(), $version, false );
    wp_enqueue_script( 'ionicons-no-module', 'https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js', array(), $version, false );    wp_enqueue_script( 'elegant-calendar-select2', ELEGANT_CALENDAR_URL . '/assets/js/library/select2.min.js', array( 'jquery' ), $version, false );

    wp_register_script(
        'elegant-calendar-licenses',
        ELEGANT_CALENDAR_URL . 'assets/js/admin/licenses.js',
        array(
            'jquery'
        ),
        $version,
        true
    );

    wp_enqueue_script( 'elegant-calendar-licenses' );

    wp_localize_script( 'elegant-calendar-licenses', 'Elegant_Calendar_Data', $data );
}

/**
 * Load admin scripts
 *
 * @since 1.0.0
 */
function elegant_calendar_admin_jquery_ui_init() {
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-widget' );
    wp_enqueue_script( 'jquery-ui-mouse' );
    wp_enqueue_script( 'jquery-ui-tabs' );
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'jquery-ui-draggable' );
    wp_enqueue_script( 'jquery-ui-droppable' );
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_script( 'jquery-ui-resize' );
    wp_enqueue_style( 'wp-color-picker' );
}

/**
 * Return AJAX url
 *
 * @since 1.0.0
 * @return mixed
 */
function elegant_calendar_ajax_url() {
    return admin_url( 'admin-ajax.php', is_ssl() ? 'https' : 'http' );
}

/**
 * Handle all pagination
 *
 * @since 1.0
 *
 * @param int $total - the total records
 * @param string $type - The type of page (listings or entries)
 *
 * @return string
 */
function elegant_calendar_list_pagination( $total, $type = 'events' ) {
    $pagenum     = isset( $_REQUEST['paged'] ) ? absint( $_REQUEST['paged'] ) : 0; // phpcs:ignore
    $page_number = max( 1, $pagenum );
    $global_settings = get_option('elegant_global_settings');
    $per_page = isset($global_settings['elegant_events_per_page']) ? $global_settings['elegant_events_per_page'] : 10;
    if($type == 'events'){
        $per_page = isset($global_settings['elegant_events_per_page']) ? $global_settings['elegant_events_per_page'] : 10;
    }
    if ( $total > $per_page ) {
        $removable_query_args = wp_removable_query_args();

        $current_url   = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
        $current_url   = remove_query_arg( $removable_query_args, $current_url );
        $current       = $page_number + 1;
        $total_pages   = ceil( $total / $per_page );
        $total_pages   = absint( $total_pages );
        $disable_first = false;
        $disable_last  = false;
        $disable_prev  = false;
        $disable_next  = false;
        $mid_size      = 2;
        $end_size      = 1;
        $show_skip     = false;

        if ( $total_pages > 10 ) {
            $show_skip = true;
        }

        if ( $total_pages >= 4 ) {
            $disable_prev = true;
            $disable_next = true;
        }

        if ( 1 === $page_number ) {
            $disable_first = true;
        }

        if ( $page_number === $total_pages ) {
            $disable_last = true;

        }

        ?>
        <ul class="elegant-pagination">

            <?php if ( ! $disable_first ) : ?>
                <?php
                $prev_url  = esc_url( add_query_arg( 'paged', min( $total_pages, $page_number - 1 ), $current_url ) );
                $first_url = esc_url( add_query_arg( 'paged', min( 1, $total_pages ), $current_url ) );
                ?>
                <?php if ( $show_skip ) : ?>
                    <li class="elegant-pagination--prev">
                        <a href="<?php echo esc_attr( $first_url ); ?>"><i class="elegant-icon-arrow-skip-start" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
                <?php if ( $disable_prev ) : ?>
                    <li class="elegant-pagination--prev">
                        <a href="<?php echo esc_attr( $prev_url ); ?>"><i class="elegant-icon-chevron-left" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
            <?php
            $dots = false;
            for ( $i = 1; $i <= $total_pages; $i ++ ) :
                $class = ( $page_number === $i ) ? 'elegant-active' : '';
                $url   = esc_url( add_query_arg( 'paged', ( $i ), $current_url ) );
                if ( ( $i <= $end_size || ( $current && $i >= $current - $mid_size && $i <= $current + $mid_size ) || $i > $total_pages - $end_size ) ) {
                    ?>
                    <li class="<?php echo esc_attr( $class ); ?>"><a href="<?php echo esc_attr( $url ); ?>" class="<?php echo esc_attr( $class ); ?>"><?php echo esc_html( $i ); ?></a></li>
                    <?php
                    $dots = true;
                } elseif ( $dots ) {
                    ?>
                    <li class="elegant-pagination-dots"><span><?php esc_html_e( '&hellip;' ); ?></span></li>
                    <?php
                    $dots = false;
                }

                ?>

            <?php endfor; ?>

            <?php if ( ! $disable_last ) : ?>
                <?php
                $next_url = esc_url( add_query_arg( 'paged', min( $total_pages, $page_number + 1 ), $current_url ) );
                $last_url = esc_url( add_query_arg( 'paged', max( $total_pages, $page_number - 1 ), $current_url ) );
                ?>
                <?php if ( $disable_next ) : ?>
                    <li class="elegant-pagination--next">
                        <a href="<?php echo esc_attr( $next_url ); ?>"><i class="elegant-icon-chevron-right" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
                <?php if ( $show_skip ) : ?>
                    <li class="elegant-pagination--next">
                        <a href="<?php echo esc_attr( $last_url ); ?>"><i class="elegant-icon-arrow-skip-end" aria-hidden="true"></i></a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <?php
    }
}

/**
 * Get event name by id
 *
 * @since 1.0.0
 * @return string
 */
function elegant_calendar_get_event_name($id) {
    $model = Elegant_Calendar_Event_Model::model()->load( $id );

	$settings = $model->settings;

    // Return Event Name
	if ( ! empty( $settings['elegant_event_name'] ) ) {
		return $settings['elegant_event_name'];
	}
}

/**
 * Get event next run time by id
 *
 * @since 1.0.0
 * @return string
 */
function elegant_calendar_get_next_run_time($id) {
    $model = Elegant_Calendar_Event_Model::model()->load( $id );

	$settings = $model->settings;

    // Return event next run time
	if ( ! empty( $settings['next_run_time'] ) ) {
        return wp_date( "M j G:i:s Y", $settings['next_run_time'], wp_timezone() );
	}
}

/**
 * Central per page for form view
 *
 * @since 1.0.0
 * @return int
 */
function elegant_calendar_view_per_page( $type = 'listings' ) {

    $global_settings = get_option('elegant_global_settings');
    $per_page = isset($global_settings['elegant_events_per_page']) ? $global_settings['elegant_events_per_page'] : 10;

	// force at least 1 data per page
	if ( $per_page < 1 ) {
		$per_page = 1;
	}
	return apply_filters( 'elegant_calendar_per_page', $per_page, $type );
}

/**
 * Display selected user roles
 */

function elegant_calendar_display_roles($role, $name, $selected_roles){

	echo  '<option class="create_events_roles" ';
    if(is_array($selected_roles)){
		if (in_array($role, $selected_roles)) {
			echo ' selected="selected" ';
		}
	}
    echo  ' value="'.$role.'">'.$name.'</option>';

}

/**
* Encode request data
*
* @param $data
*
* @return string
*/
function elegant_encode_request_data( $data ) {
	return rtrim( base64_encode( json_encode( $data ) ), '=' );
}

/**
* Decode request data
*
* @param $data
*
* @return array
*/
function elegant_decode_request_data( $data ) {
	$data = json_decode( base64_decode( $data ), true );
	if ( ! is_array( $data ) ) {
		$data = array();
	}

	return $data;
}

/**
 * Get event data list for front
 *
 * @since 1.0.0
 *
 * @return array|string
 */
function elegant_calendar_front_event_data() {
    $event_data = array();

    $data = Elegant_Calendar_Event_Model::model()->get_all_models();

    foreach ( $data['models'] as $model ) {
        $settings = $model->get_settings();

        // Translate event date spanish to english
        $start_date = $settings['elegant_event_start_date'];
        if (strpos($start_date, 'enero') !== false) {
            $start_date = str_replace('enero', 'January', $start_date);
        }
        if (strpos($start_date, 'febrero') !== false) {
            $start_date = str_replace('febrero', 'February', $start_date);
        }
        if (strpos($start_date, 'marzo') !== false) {
            $start_date = str_replace('marzo', 'March', $start_date);
        }
        if (strpos($start_date, 'abril') !== false) {
            $start_date = str_replace('abril', 'April', $start_date);
        }
        if (strpos($start_date, 'mayo') !== false) {
            $start_date = str_replace('mayo', 'May', $start_date);
        }
        if (strpos($start_date, 'junio') !== false) {
            $start_date = str_replace('junio', 'June', $start_date);
        }
        if (strpos($start_date, 'julio') !== false) {
            $start_date = str_replace('julio', 'July', $start_date);
        }
        if (strpos($start_date, 'agosto') !== false) {
            $start_date = str_replace('agosto', 'August', $start_date);
        }
        if (strpos($start_date, 'septiembre') !== false) {
            $start_date = str_replace('septiembre', 'September', $start_date);
        }
        if (strpos($start_date, 'octubre') !== false) {
            $start_date = str_replace('octubre', 'October', $start_date);
        }
        if (strpos($start_date, 'noviembre') !== false) {
            $start_date = str_replace('noviembre', 'November', $start_date);
        }
        if (strpos($start_date, 'diciembre') !== false) {
            $start_date = str_replace('diciembre', 'December', $start_date);
        }

        $end_date = $settings['elegant_event_end_date'];
        if (strpos($end_date, 'enero') !== false) {
            $end_date = str_replace('enero', 'January', $end_date);
        }
        if (strpos($end_date, 'febrero') !== false) {
            $end_date = str_replace('febrero', 'February', $end_date);
        }
        if (strpos($end_date, 'marzo') !== false) {
            $end_date = str_replace('marzo', 'March', $end_date);
        }
        if (strpos($end_date, 'abril') !== false) {
            $end_date = str_replace('abril', 'April', $end_date);
        }
        if (strpos($end_date, 'mayo') !== false) {
            $end_date = str_replace('mayo', 'May', $end_date);
        }
        if (strpos($end_date, 'junio') !== false) {
            $end_date = str_replace('junio', 'June', $end_date);
        }
        if (strpos($end_date, 'julio') !== false) {
            $end_date = str_replace('julio', 'July', $end_date);
        }
        if (strpos($end_date, 'agosto') !== false) {
            $end_date = str_replace('agosto', 'August', $end_date);
        }
        if (strpos($end_date, 'septiembre') !== false) {
            $end_date = str_replace('septiembre', 'September', $end_date);
        }
        if (strpos($end_date, 'octubre') !== false) {
            $end_date = str_replace('octubre', 'October', $end_date);
        }
        if (strpos($end_date, 'noviembre') !== false) {
            $end_date = str_replace('noviembre', 'November', $end_date);
        }
        if (strpos($end_date, 'diciembre') !== false) {
            $end_date = str_replace('diciembre', 'December', $end_date);
        }

        $start = date('Y-m-d', strtotime($start_date)) . 'T' .$settings['elegant_event_start_time'] . ':00+08:00';
        $end = date('Y-m-d', strtotime($end_date)) . 'T' .$settings['elegant_event_end_time'] . ':00+08:00';

        $event_data[] = array(
            "id"              => $model->id,
            "calendarId"      => 1,
            "title"           => $settings['elegant_event_name'],
            "body"            => $settings['elegant_event_content'],
            "location"        => $settings['elegant_event_location'],
            "organizer"       => $settings['elegant_event_organizer'],
            "type"            => isset($settings['elegant_event_type']) ? $settings['elegant_event_type'] : 0,
            "color"           => isset($settings['elegant_event_color']) ? $settings['elegant_event_color'] : '#f4f4f4',
            'permalink'       => get_post_permalink($model->id),
            "category"        => 'time',
            "dueDateClass"    => '',
            "start"           => $start,
            "end"             => $end,
            "isReadOnly"      => true
        );
    }

    return $event_data;

}

function elegant_display_event_type($term, $selected_types){
	echo  '<option class="post_category" ';
    elegant_type_selected($selected_types, $term->term_id);
    echo  ' value="'.$term->term_id.'">'.$term->name.'</option>';
}

function elegant_type_selected($src,$val){
	if(is_array($src)){
		if (in_array($val, $src)) {
			echo ' selected="selected" ';
		}
	}
}

/**
 * Output single event details
 *
 * @since 1.0.0
 */
function elegant_single_event_schedule_details($id){
	$schedule = '';

    $model = Elegant_Calendar_Event_Model::model()->load( $id );

	$single_event = $model->settings;

    $start = date('F j', strtotime($single_event['elegant_event_start_date'])) . ' @ ' .$single_event['elegant_event_start_time'];
    $end = date('F j', strtotime($single_event['elegant_event_end_date'])) . ' @ ' .$single_event['elegant_event_end_time'];

    $schedule  = '<span class="elegant-single-event-date-start">';
    $schedule .= $start;
    $schedule .= '</span>';
    $schedule .= ' - ';
    $schedule .= '<span class="elegant-single-event-date-end">';
    $schedule .= $end;
    $schedule .= '</span>';


	return $schedule;
}

/**
 * Output single event meta data
 *
 * @since 1.0.0
 * @return array
 */
function elegant_single_event_meta_data($id){
	$meta = array();

    $model = Elegant_Calendar_Event_Model::model()->load( $id );

	$single_event = $model->settings;

    $start = date('F j', strtotime($single_event['elegant_event_start_date'])) . ' @ ' .$single_event['elegant_event_start_time'];
    $end = date('F j', strtotime($single_event['elegant_event_end_date'])) . ' @ ' .$single_event['elegant_event_end_time'];

    $meta['details'] = $start . ' - ' . $end;
    $meta['location'] = 'none';
    $meta['organizer'] = 'none';

    if(isset(get_term( $single_event['elegant_event_location'] )->name)){
        $meta['location'] = get_term( $single_event['elegant_event_location'] )->name;
    }
    if(isset(get_term( $single_event['elegant_event_organizer'] )->name)){
        $meta['organizer'] = get_term( $single_event['elegant_event_organizer'] )->name;
    }
	return $meta;
}

/**
 * Sanitize field
 *
 * @since 1.0.0
 *
 * @param $field
 *
 * @return array|string
 */
function elegant_calendar_sanitize_field( $field ) {
	// If array map all fields
	if ( is_array( $field ) ) {
		return array_map( 'elegant_calendar_sanitize_field', $field );
	}
	return sanitize_text_field( $field );
}