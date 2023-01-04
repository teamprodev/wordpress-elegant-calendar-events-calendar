<?php
$global_settings = get_option('elegant_global_settings');
$enable_search = isset($global_settings['enable_search']) && $global_settings['enable_search'] == 'on' ? 'checked' : '';
?>
<div id="search" class="elegant-box-tab" >

    <div class="elegant-box-header">
        <h2 class="elegant-box-title"><?php esc_html_e( 'Search', Elegant_Calendar::DOMAIN ); ?></h2>
    </div>

    <form class="elegant-settings-form" method="post" action="">

    <div class="elegant-box-body">
        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label">
                    <?php esc_html_e( 'Enable search icons on calendar globally', Elegant_Calendar::DOMAIN ); ?>
                    <div class="tooltip">
                        <ion-icon name="help-circle-outline"></ion-icon>
                        <span class="tooltiptext"><?php esc_html_e( 'This option will override search attribute via shortcode', Elegant_Calendar::DOMAIN ); ?></span>
                    </div>
                </span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="switch" for="enable_search">
                    <input type="checkbox" id="enable_search" name='enable_search' <?php echo esc_attr($enable_search); ?> />
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