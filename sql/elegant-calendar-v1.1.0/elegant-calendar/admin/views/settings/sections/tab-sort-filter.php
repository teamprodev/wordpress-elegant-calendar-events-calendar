<?php
$global_settings = get_option('elegant_global_settings');
$hide_sort = isset($global_settings['hide_sort']) && $global_settings['hide_sort'] == 'on' ? 'checked' : '';
$hide_filter = isset($global_settings['hide_filter']) && $global_settings['hide_filter'] == 'on' ? 'checked' : '';
?>
<div id="sort-filter" class="elegant-box-tab" >

    <div class="elegant-box-header">
        <h2 class="elegant-box-title"><?php esc_html_e( 'Sort and Filter', Elegant_Calendar::DOMAIN ); ?></h2>
    </div>

    <form class="elegant-settings-form" method="post" action="">

    <div class="elegant-box-body">
        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label">
                    <?php esc_html_e( 'Hide sort icons on calendar globally', Elegant_Calendar::DOMAIN ); ?>
                    <div class="tooltip">
                        <ion-icon name="help-circle-outline"></ion-icon>
                        <span class="tooltiptext"><?php esc_html_e( 'This option will override sort attribute via shortcode', Elegant_Calendar::DOMAIN ); ?></span>
                    </div>
                </span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="switch" for="hide_sort">
                    <input type="checkbox" id="hide_sort" name='hide_sort' <?php echo esc_attr($hide_sort); ?> />
                <div class="slider round"></div>
                </label>
            </div>
        </div>

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label">
                    <?php esc_html_e( 'Hide filter icons on calendar globally', Elegant_Calendar::DOMAIN ); ?>
                    <div class="tooltip">
                        <ion-icon name="help-circle-outline"></ion-icon>
                        <span class="tooltiptext"><?php esc_html_e( 'This option will override filter attribute via shortcode', Elegant_Calendar::DOMAIN ); ?></span>
                    </div>
                </span>
            </div>
            <div class="elegant-box-settings-col-2">
                <label class="switch" for="hide_filter">
                    <input type="checkbox" id="hide_filter" name='hide_filter' <?php echo esc_attr($hide_filter); ?> />
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