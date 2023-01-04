<?php
$current_time_stamp = current_time('timestamp');

$start_date = isset($settings['elegant_event_start_date']) ? $settings['elegant_event_start_date'] : wp_date( "F j, Y", $current_time_stamp, wp_timezone() );;
$end_date = isset($settings['elegant_event_end_date']) ? $settings['elegant_event_end_date'] : wp_date( "F j, Y", $current_time_stamp, wp_timezone() );;

$start_time = isset($settings['elegant_event_start_time']) ? $settings['elegant_event_start_time'] : wp_date( "H:i", $current_time_stamp, wp_timezone() );;
$end_time = isset($settings['elegant_event_end_time']) ? $settings['elegant_event_end_time'] : wp_date( "H:i", $current_time_stamp, wp_timezone() );;
?>
<div id="date" class="elegant-box-tab">

	<div class="elegant-box-header">
		<h2 class="elegant-box-title"><?php esc_html_e( 'Date & Time', Elegant_Calendar::DOMAIN ); ?></h2>
	</div>

    <div class="elegant-box-body">

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Start Date', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
                    <input
                        type="text"
                        name="elegant_event_start_date"
                        placeholder="<?php esc_html_e( 'Enter your event start date here', Elegant_Calendar::DOMAIN ); ?>"
                        value="<?php echo esc_attr($start_date); ?>"
                        id="elegant_event_start_date"
                        class="elegant-form-control"
                        aria-labelledby="elegant_event_start_date"
                    />
                    <input
                        type="time"
                        name="elegant_event_start_time"
                        placeholder="<?php esc_html_e( 'Enter your event start time here', Elegant_Calendar::DOMAIN ); ?>"
                        value="<?php echo esc_attr($start_time); ?>"
                        id="elegant_event_start_time"
                        class="elegant-form-control"
                        aria-labelledby="elegant_event_start_time"
                    />
            </div>
        </div>

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'End Date', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
                    <input
                        type="text"
                        name="elegant_event_end_date"
                        placeholder="<?php esc_html_e( 'Enter your event end date here', Elegant_Calendar::DOMAIN ); ?>"
                        value="<?php echo esc_attr($end_date); ?>"
                        id="elegant_event_end_date"
                        class="elegant-form-control"
                        aria-labelledby="elegant_event_end_date"
                    />
                    <input
                        type="time"
                        name="elegant_event_end_time"
                        placeholder="<?php esc_html_e( 'Enter your event end time here', Elegant_Calendar::DOMAIN ); ?>"
                        value="<?php echo esc_attr($end_time); ?>"
                        id="elegant_event_end_time"
                        class="elegant-form-control"
                        aria-labelledby="elegant_event_end_time"
                    />
            </div>
        </div>

    </div>

</div>
