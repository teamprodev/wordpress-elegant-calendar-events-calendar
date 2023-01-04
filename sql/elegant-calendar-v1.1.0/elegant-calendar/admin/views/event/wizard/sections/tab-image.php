<?php
$image_url = isset($settings['elegant_event_image_url']) ? $settings['elegant_event_image_url'] : ELEGANT_CALENDAR_URL.'/assets/images/elegant.png';
?>
<div id="image" class="elegant-box-tab">

	<div class="elegant-box-header">
		<h2 class="elegant-box-title"><?php esc_html_e( 'Image', Elegant_Calendar::DOMAIN ); ?></h2>
	</div>

    <div class="elegant-box-body">

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Event Image', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
            <label class="elegant-settings-label"><?php esc_html_e( 'Event Image', Elegant_Calendar::DOMAIN ); ?></label>
                <span class="elegant-description"><?php esc_html_e( 'Choose your event image that will show on the calendar.', Elegant_Calendar::DOMAIN ); ?></span>
                <img class="elegant-thumbnail-preview" src="<?php echo esc_url( $image_url ); ?>" />
                <input type="hidden" name="elegant_event_image_url" id="elegant_image_url_input" value="<?php echo esc_url( $image_url ); ?>" />
		        <button class="elegant-button elegant-button-blue elegant-image-uploader-browse" data-target="elegant_image_url_input">
			        <?php esc_html_e( 'Upload image', Elegant_Calendar::DOMAIN ); ?>
		        </button>
            </div>
        </div>

    </div>

</div>