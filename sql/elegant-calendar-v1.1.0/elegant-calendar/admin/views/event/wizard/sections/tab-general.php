<div id="general" class="elegant-box-tab active">

	<div class="elegant-box-header">
		<h2 class="elegant-box-title"><?php esc_html_e( 'General', Elegant_Calendar::DOMAIN ); ?></h2>
	</div>

    <div class="elegant-box-body">
        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Event Name', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
                <div>
                    <input
                        type="text"
                        name="elegant_event_name"
                        placeholder="<?php esc_html_e( 'Enter your event name here', Elegant_Calendar::DOMAIN ); ?>"
                        value="<?php if(isset($settings['elegant_event_name'])){echo esc_attr($settings['elegant_event_name']);}?>"
                        id="elegant_event_name"
                        class="elegant-form-control"
                        aria-labelledby="elegant_event_name"
                    />
                </div>
            </div>
        </div>

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Event Content', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
                <div class='elegant-form-wp-editor'>
                    <?php 
                        $value = isset($settings['elegant_event_content']) ? $settings['elegant_event_content'] : '<p>Please enter your event content here.</p>';
                        wp_editor( $value, 'elegant_event_content', array(
                            'textarea_name' => 'elegant_event_content',
                            'wpautop' => false,
                            'teeny' => true,
                            'tinymce' => true
                        )); 
                    ?> 
                </div>
            </div>
        </div>

    </div>

</div>
