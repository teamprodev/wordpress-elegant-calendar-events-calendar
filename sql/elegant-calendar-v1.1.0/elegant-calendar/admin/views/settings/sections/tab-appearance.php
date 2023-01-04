<?php
$global_settings = get_option('elegant_global_settings');
$predefined_color = isset($global_settings['predefined_color']) ? $global_settings['predefined_color'] : '#f4f4f4';
?>
<div id="appearance" class="elegant-box-tab" >

    <div class="elegant-box-header">
        <h2 class="elegant-box-title"><?php esc_html_e( 'Appearance', Elegant_Calendar::DOMAIN ); ?></h2>
    </div>

    <form class="elegant-settings-form" method="post" action="">

    <div class="elegant-box-body">
        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Predefined Color', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="elegant-settings-label"><?php esc_html_e( 'Predefined Color', Elegant_Calendar::DOMAIN ); ?></label>
                <span class="elegant-description"><?php esc_html_e( 'Choose your predefined color that will show on the calendar.', Elegant_Calendar::DOMAIN ); ?></span>
                <input type="text" class="color-picker" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" name="predefined_color" value="<?php echo esc_attr( $predefined_color ); ?>" />
            </div>
        </div>
    </div>

    <div class="elegant-box-footer">

        <div class="elegant-actions-right">

            <button class="elegant-button elegant-button-blue elegant-global-settings-button" type="button">
                <span class="elegant-loading-text"><?php esc_html_e( 'Save Settings', Elegant_Calendar::DOMAIN ); ?></span>
            </button>

        </div>

    </div>

    </form>



</div>