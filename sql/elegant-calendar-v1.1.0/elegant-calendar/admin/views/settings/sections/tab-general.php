<?php
$global_settings = get_option('elegant_global_settings');
$past_event_trash = isset($global_settings['past_event_trash']) && $global_settings['past_event_trash'] == 'on' ? 'checked' : '';
$event_coments = isset($global_settings['event_coments']) && $global_settings['event_coments'] == 'on' ? 'checked' : '';
?>
<div id="general" class="elegant-box-tab active" >

    <div class="elegant-box-header">
        <h2 class="elegant-box-title"><?php esc_html_e( 'General', Elegant_Calendar::DOMAIN ); ?></h2>
    </div>

    <form class="elegant-settings-form" method="post" action="">

    <div class="elegant-box-body">
        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label">
                    <?php esc_html_e( 'Move events to draft status when event date is past automatically', Elegant_Calendar::DOMAIN ); ?>
                    <div class="tooltip">
                        <ion-icon name="help-circle-outline"></ion-icon>
                        <span class="tooltiptext"><?php esc_html_e( 'This option will move events to draft status when event date is past automatically', Elegant_Calendar::DOMAIN ); ?></span>
                    </div>
                </span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="switch" for="past_event_trash">
                    <input type="checkbox" id="past_event_trash" name='past_event_trash' <?php echo esc_attr($past_event_trash); ?> />
                <div class="slider round"></div>
                </label>
            </div>
        </div>

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label">
                    <?php esc_html_e( 'Disable comments on event pages', Elegant_Calendar::DOMAIN ); ?>
                    <div class="tooltip">
                        <ion-icon name="help-circle-outline"></ion-icon>
                        <span class="tooltiptext"><?php esc_html_e( 'This option will disable comments on event pages', Elegant_Calendar::DOMAIN ); ?></span>
                    </div>
                </span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="switch" for="event_coments">
                    <input type="checkbox" id="event_coments" name='event_coments' <?php echo esc_attr($event_coments); ?> />
                <div class="slider round"></div>
                </label>
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