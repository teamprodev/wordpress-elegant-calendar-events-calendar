<?php
$global_settings = get_option('elegant_global_settings');
$single_event_logged_only = isset($global_settings['single_event_logged_only']) && $global_settings['single_event_logged_only'] == 'on' ? 'checked' : '';
$single_event_enable_comments = isset($global_settings['single_event_enable_comments']) && $global_settings['single_event_enable_comments'] == 'on' ? 'checked' : '';
?>
<div id="single" class="elegant-box-tab" >

    <div class="elegant-box-header">
        <h2 class="elegant-box-title"><?php esc_html_e( 'Single Events', Elegant_Calendar::DOMAIN ); ?></h2>
    </div>

    <form class="elegant-settings-form" method="post" action="">

    <div class="elegant-box-body">
        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label">
                    <?php esc_html_e( 'Only show single event pages to logged-in users', Elegant_Calendar::DOMAIN ); ?>
                    <div class="tooltip">
                        <ion-icon name="help-circle-outline"></ion-icon>
                        <span class="tooltiptext"><?php esc_html_e( 'This option will only show single event pages to logged-in users', Elegant_Calendar::DOMAIN ); ?></span>
                    </div>
                </span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="switch" for="single_event_logged_only">
                    <input type="checkbox" id="single_event_logged_only" name='single_event_logged_only' <?php echo esc_attr($single_event_logged_only); ?> />
                <div class="slider round"></div>
                </label>
            </div>
        </div>

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label">
                    <?php esc_html_e( 'Enable comments on single event pages', Elegant_Calendar::DOMAIN ); ?>
                    <div class="tooltip">
                        <ion-icon name="help-circle-outline"></ion-icon>
                        <span class="tooltiptext"><?php esc_html_e( 'This option will disable comments on single event pages', Elegant_Calendar::DOMAIN ); ?></span>
                    </div>
                </span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="switch" for="single_event_enable_comments">
                    <input type="checkbox" id="single_event_enable_comments" name='single_event_enable_comments' <?php echo esc_attr($single_event_enable_comments); ?> />
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