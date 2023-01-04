<?php
$settings['elegant_event_type'] = isset($settings['elegant_event_type']) ? $settings['elegant_event_type'] : array();
// Get all types
$types = get_terms('elegant_event_type', array('hide_empty'=>false) );
?>
<div id="type" class="elegant-box-tab">

	<div class="elegant-box-header">
		<h2 class="elegant-box-title"><?php esc_html_e( 'Type', Elegant_Calendar::DOMAIN ); ?></h2>
	</div>

    <div class="elegant-box-body">

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Event Type', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
            <label class="elegant-settings-label"><?php esc_html_e( 'Event Type', Elegant_Calendar::DOMAIN ); ?></label>
                <span class="elegant-description"><?php esc_html_e( 'Choose your event type that will show on the calendar.', Elegant_Calendar::DOMAIN ); ?></span>
                <select class="elegant-type-multi-select" multiple="true">
                    <?php
                    foreach ( $types as $type => $term ) {
                        elegant_display_event_type( $term, $settings['elegant_event_type']);
                    }
                    ?>
                </select>
            </div>
        </div>

    </div>

</div>