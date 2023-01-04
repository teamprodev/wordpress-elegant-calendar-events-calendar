<?php
$global_settings = get_option('elegant_global_settings');
?>
<div id="shortcode" class="elegant-box-tab" >

    <div class="elegant-box-header">
        <h2 class="elegant-box-title"><?php esc_html_e( 'Shortcode', Elegant_Calendar::DOMAIN ); ?></h2>
    </div>

    <div class="elegant-box-body">
        <a href="#shortcode-generator" class="open-shortcode-genenator" data-effect="mfp-zoom-in">
            <button id="elegant-run-button" class="elegant-button elegant-button-blue" accesskey="p">
                <ion-icon name="code-slash-outline" class="elegant-icon-code"></ion-icon>
                <span><?php esc_html_e( 'Shortcode Genertor', Elegant_Calendar::DOMAIN ); ?></span>
            </button>
        </a>
    </div>

    <div id="shortcode-generator" class="white-popup mfp-with-anim mfp-hide">

		<div class="elegant-box-header elegant-block-content-center">
			<h3 class="elegant-box-title type-title"><?php esc_html_e( 'Shortcode Generator', Elegant_Calendar::DOMAIN ); ?></h3>
		</div>

        <div class="elegant-box-body elegant-block-content-center elegant-box-body-slim">
            <p>
                <small>
                    <?php esc_html_e( 'Your shortcode is now ready to be display in a page or template. Simply copy and paste the shortcode below to display it!', Elegant_Calendar::DOMAIN ); ?>
                </small>
            </p>
            <span class="dropdown-el">
                <input type="radio" name="shortcode_type" value="[elegant_calendar]" checked="checked" id="main-calendar">
                <label for="main-calendar"><?php esc_html_e( 'Main Calendar', Elegant_Calendar::DOMAIN ); ?></label>
                <input type="radio" name="shortcode_type" value="[elegant_calendar_single]" id="single-events">
                <label for="single-events"><?php esc_html_e( 'Single Events', Elegant_Calendar::DOMAIN ); ?></label>
                <input type="radio" name="shortcode_type" value="[elegant_calendar_search]" id="search-bar">
                <label for="search-bar"><?php esc_html_e( 'Search Bar', Elegant_Calendar::DOMAIN ); ?></label>
            </span>

            <div class="shortcode-options">
                <div class="shortcode-select main-calendar current">
                    <div class="elegant-shortcode-options-row">
                        <div class="elegant-shortcode-options-col-1">
                            <select name="mail_calendar_layout" class="elegant-calendar-selector elegant-layout-selector">
                                <option value="list">List</option>
                                <option value="grid">Grid</option>
                                <option value="month">Month</option>
                            </select>
                        </div>
                        <div class="elegant-shortcode-options-col-2">
                            <span class="elegant-shortcode-options-label">
                                <?php esc_html_e( 'Select main calendar template view layout', Elegant_Calendar::DOMAIN ); ?>
                            </span>
                        </div>
                    </div>

                    <div class="elegant-shortcode-options-row">
                        <div class="elegant-shortcode-options-col-1">
                            <select name="mail_calendar_design" class="elegant-calendar-selector elegant-design-selector">
                                <option value="classic">Classic</option>
                                <option value="modern">Modern</option>
                                <option value="minimal">Minimal</option>
                            </select>
                        </div>
                        <div class="elegant-shortcode-options-col-2">
                            <span class="elegant-shortcode-options-label">
                                <?php esc_html_e( 'Select main calendar template design style', Elegant_Calendar::DOMAIN ); ?>
                            </span>
                        </div>
                    </div>

                    <div class="elegant-shortcode-options-row">
                        <div class="elegant-shortcode-options-col-1">
                            <label class="switch" for="main_calendar_filter">
                                <input type="checkbox" id="main_calendar_filter" name="main_calendar_filter" value="no">
                                <div class="slider round"></div>
                            </label>
                        </div>
                        <div class="elegant-shortcode-options-col-2">
                            <span class="elegant-shortcode-options-label">
                                <?php esc_html_e( 'Show Event Filter on the top of main calendar', Elegant_Calendar::DOMAIN ); ?>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="shortcode-select single-events">Here's single events shortcode options</div>
                <div class="shortcode-select search-bar">Here's search bar shortcode options</div>
            </div>

            <div id="elegant-form-name-input" class="elegant-form-field">
                <div class="elegant-with-button elegant-with-button-icon">
                    <input type="text" id="elegant-form-shortcode" class="elegant-form-control text-center" value="[elegant_calendar]">
                    <button class="elegant-button-icon elegant-button-copy-icon">
                        <ion-icon class="elegant-icon-document" name="document-text-sharp"></ion-icon>
                        <span class="elegant-screen-reader-text"><?php esc_html_e( 'Copy Shortcode', Elegant_Calendar::DOMAIN ); ?></span>
                    </button>
                </div>
            </div>
        </div>

    </div>

</div>