<?php
$color = isset($settings['elegant_event_color']) ? $settings['elegant_event_color'] : '#f4f4f4';
?>
<div id="color" class="elegant-box-tab">

	<div class="elegant-box-header">
		<h2 class="elegant-box-title"><?php esc_html_e( 'Color', Elegant_Calendar::DOMAIN ); ?></h2>
	</div>

    <div class="elegant-box-body">

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Event Color', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="elegant-settings-label"><?php esc_html_e( 'Event Color', Elegant_Calendar::DOMAIN ); ?></label>
                <span class="elegant-description"><?php esc_html_e( 'Choose your event color that will show on the calendar.', Elegant_Calendar::DOMAIN ); ?></span>
                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" name="elegant_event_color" value="<?php echo esc_url( $color ); ?>" />
            </div>
        </div>

    </div>

</div>