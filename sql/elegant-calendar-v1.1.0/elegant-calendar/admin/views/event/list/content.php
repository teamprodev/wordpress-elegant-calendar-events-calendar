<?php
// Count total forms
$count        = $this->countModules();
$count_active = $this->countModules( 'publish' );

// available bulk actions
$bulk_actions = $this->bulk_actions();
?>

<?php if ( $count > 0 ) { ?>
    <!-- START: Bulk actions and pagination -->
    <div class="elegant-listings-pagination">

        <div class="elegant-pagination-mobile elegant-pagination-wrap">
            <span class="elegant-pagination-results">
                            <?php /* translators: ... */ echo esc_html( sprintf( _n( '%s result', '%s results', $count, Elegant_Calendar::DOMAIN ), $count ) ); ?>
                        </span>
            <?php $this->pagination(); ?>
        </div>

        <div class="elegant-pagination-desktop elegant-box">
            <div class="elegant-box-search">
                <form method="post" name="elegant-bulk-action-form" class="elegant-search-left">
                    <input type="hidden" name="elegant_calendar_nonce" value="<?php echo wp_create_nonce( 'elegant-calendar-event-request' );?>">
                    <input type="hidden" name="_wp_http_referer" value="<?php admin_url( 'admin.php?page=auto-elegant-campaign' ); ?>">
                    <input type="hidden" name="ids" id="elegant-select-events-ids" value="">
                    <label for="elegant-check-all-events" class="elegant-checkbox">
                        <input type="checkbox" id="elegant-check-all-events">
                        <span aria-hidden="true"></span>
                        <span class="elegant-screen-reader-text"><?php esc_html_e( 'Select all', Elegant_Calendar::DOMAIN ); ?></span>
                    </label>
                    <div class="elegant-select-wrapper">
                        <select name="elegant_calendar_bulk_action" id="bulk-action-selector-top">
                            <option value=""><?php esc_html_e( 'Bulk Action', Elegant_Calendar::DOMAIN ); ?></option>
                            <?php foreach ( $bulk_actions as $val => $label ) : ?>
                                <option value="<?php echo esc_attr( $val ); ?>"><?php echo esc_html( $label ); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button class="elegant-button elegant-bulk-action-button"><?php esc_html_e( 'Apply', Elegant_Calendar::DOMAIN ); ?></button>
                </form>

                <div class="elegant-search-right">
                    <div class="elegant-pagination-wrap">
                        <span class="elegant-pagination-results">
                            <?php /* translators: ... */ echo esc_html( sprintf( _n( '%s result', '%s results', $count, Elegant_Calendar::DOMAIN ), $count ) ); ?>
                        </span>
                        <?php $this->pagination(); ?>
                    </div>
                </div>
            </div>

            <div class="elegant-filter-fields-wrapper">
                <form method="get">
                    <input type="hidden" name="page" value="hustle_entries">
                    <input type="hidden" name="module_type" value="popup">
                    <input type="hidden" name="module_id" value="1">

                    <div class="elegant-row">
                        <div class="elegant-col-md-6">
                            <div class="elegant-form-field">
                                <label class="elegant-label">Email id has keyword</label>
                                <div class="elegant-control-with-icon">
                                    <input type="text" name="search_email" placeholder="E.g. gmail" class="elegant-form-control" value="">
                                    <span class="elegant-icon-magnifying-glass-search" aria-hidden="true"></span>
                                </div>
                            </div>
                        </div>

                        <div class="elegant-col-md-6">
                            <div class="elegant-form-field">
                                <label class="elegant-label">Sort by</label>
                                <div class="select-container">
                                    <span class="dropdown-handle" aria-hidden="true"><i class="elegant-icon-chevron-down"></i></span>
                                    <select name="order_by" id="hustle-select-order-by-top" aria-hidden="true" hidden="hidden" class="elegant-styled" style="display: none;">
                                                <option value="entries.entry_id">Id</option>
                                                <option value="entries.date_created" selected="selected">Date submitted</option>
                                        </select><div class="select-list-container">
                                            <button type="button" class="list-value" aria-haspopup="listbox" id="hustle-select-order-by-top-button" aria-labelledby="undefined hustle-select-order-by-top-button">Date submitted</button>
                                            <ul tabindex="-1" role="listbox" class="list-results" id="hustle-select-order-by-top-list" aria-activedescendant="hustle-select-order-by-top-option-entries.date_created"><li role="option" id="hustle-select-order-by-top-option-entries.entry_id">Id</li><li role="option" id="hustle-select-order-by-top-option-entries.date_created" class="current" aria-selected="true">Date submitted</li></ul></div></div>
                            </div>
                        </div>
                    </div>

                    <div class="elegant-filter-footer">
                        <button type="button" class="elegant-button elegant-button-ghost hustle-entries-clear-filter" disabled="">
                            Clear Filters
                        </button>
                        <button class="elegant-button">
                            Apply
                        </button>
                    </div>
                </form>
            </div>

        </div>

    </div>
    <!-- END: Bulk actions and pagination -->

    <div class="elegant-accordion elegant-accordion-block" id="elegant-modules-list">

        <?php
        foreach ( $this->getModules() as $module ) {
        ?>
            <div class="elegant-accordion-item">
                <div class="elegant-accordion-item-header">

                    <div class="elegant-accordion-item-title elegant-trim-title">
                        <label for="wpf-module-<?php echo esc_attr( $module['id'] ); ?>" class="elegant-checkbox elegant-accordion-item-action">
                            <input type="checkbox" id="wpf-module-<?php echo esc_attr( $module['id'] ); ?>" class="elegant-check-single-campaign" value="<?php echo esc_html( $module['id'] ); ?>">
                            <span aria-hidden="true"></span>
                            <span class="elegant-screen-reader-text"><?php esc_html_e( 'Select this form', Elegant_Calendar::DOMAIN ); ?></span>
                        </label>
                        <span class="elegant-trim-text">
                            <?php echo elegant_calendar_get_event_name( $module['id'] ); ?>
                        </span>
                        <?php
                        if ( 'publish' === $module['status'] ) {
                            echo '<span class="elegant-tag elegant-tag-blue">' . esc_html__( 'Published', Elegant_Calendar::DOMAIN ) . '</span>';
                        }
                        ?>

                        <?php
                        if ( 'draft' === $module['status'] ) {
                            echo '<span class="elegant-tag">' . esc_html__( 'Draft', Elegant_Calendar::DOMAIN ) . '</span>';
                        }
                        ?>
                    </div>

                    <div class="elegant-accordion-col-auto">

                        <a href="<?php echo admin_url( 'admin.php?page=elegant-calendar-event-wizard&id=' . $module['id'] . '&status=' . $module['status'] ); ?>"
                           class="elegant-button elegant-button-ghost elegant-accordion-item-action elegant-desktop-visible">
                            <ion-icon name="pencil" class="elegant-icon-pencil"></ion-icon>
                            <?php esc_html_e( 'Edit', Elegant_Calendar::DOMAIN ); ?>
                        </a>

                        <div class="elegant-dropdown elegant-accordion-item-action">
                            <button class="elegant-button-icon elegant-dropdown-anchor" data-id=<?php echo esc_attr( $module['id'] ); ?>>
                                <ion-icon name="settings-outline"></ion-icon>
                            </button>
                            <ul class="elegant-dropdown-list" data-id=<?php echo esc_attr( $module['id'] ); ?>>
                                <li>
                                        <a href="<?php echo get_post_permalink($module['id']); ?>">
                                            <ion-icon name="eye" class="elegant-icon-pencil"></ion-icon>
                                            <?php esc_html_e( 'View', Elegant_Calendar::DOMAIN ); ?>
                                        </a>
                                </li>

                                <li>
                                    <form method="post">
                                        <input type="hidden" name="elegant_calendar_nonce" value="<?php echo wp_create_nonce( 'elegant-calendar-event-request' );?>">
                                        <input type="hidden" name="elegant_calendar_single_action" value="update-status">
                                        <input type="hidden" name="id" value="<?php echo esc_attr( $module['id'] ); ?>">
                                        <?php
                                        if ( 'publish' === $module['status'] ) {
                                            ?>
                                            <input type="hidden" name="status" value="draft">
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if ( 'draft' === $module['status'] ) {
                                            ?>
                                            <input type="hidden" name="status" value="publish">
                                            <?php
                                        }
                                        ?>
                                        <button type="submit">
                                            <ion-icon class="elegant-icon-cloud" name="cloud"></ion-icon>
                                            <?php
                                            if ( 'publish' === $module['status'] ) {
                                                echo esc_html__( 'Unpublish', Elegant_Calendar::DOMAIN );
                                            }
                                            ?>

                                            <?php
                                            if ( 'draft' === $module['status'] ) {
                                                echo esc_html__( 'Publish', Elegant_Calendar::DOMAIN );
                                            }
                                            ?>
                                        </button>
                                    </form>
                                </li>

                                <li>
                                    <form method="post">
                                        <input type="hidden" name="elegant_calendar_nonce" value="<?php echo wp_create_nonce( 'elegant-calendar-event-request' );?>">
                                        <input type="hidden" name="elegant_calendar_single_action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo esc_attr( $module['id'] ); ?>">
                                        <button type="submit">
                                            <ion-icon class="elegant-icon-trash" name="trash"></ion-icon>
                                            <?php esc_html_e( 'Delete', Elegant_Calendar::DOMAIN ); ?>
                                        </button>
                                    </form>
                                </li>

                            </ul>
                        </div>

                        <button class="elegant-button-icon elegant-accordion-open-indicator" aria-label="<?php esc_html_e( 'Open item', Elegant_Calendar::DOMAIN ); ?>">
                            <ion-icon name="chevron-down"></ion-icon>
                        </button>


                    </div>

                </div>
            </div>

        <?php

        }

        ?>

    </div>


<?php } else { ?>
<div class="elegant-box elegant-message elegant-message-lg">

    <img src="<?php echo esc_url(ELEGANT_CALENDAR_URL.'/assets/images/elegant.png'); ?>" class="elegant-image elegant-image-center" aria-hidden="true" alt="<?php esc_attr_e( 'Elegant Calendar', Elegant_Calendar::DOMAIN ); ?>">

    <div class="elegant-message-content">

        <p><?php esc_html_e( 'Create event for all your needs with customized settings, include backup, cleanup and optimize.', Elegant_Calendar::DOMAIN ); ?></p>

        <p>
            <a href="<?php echo admin_url( 'admin.php?page=elegant-calendar-event-wizard' ); ?>" class="open-popup-link" data-effect="mfp-zoom-in">
                <button class="elegant-button elegant-button-blue" data-modal="custom_forms">
                    <i class="elegant-icon-plus" aria-hidden="true"></i>
                    <?php esc_html_e( 'Create', Elegant_Calendar::DOMAIN ); ?>
                </button>
            </a>
        </p>

    </div>

</div>

<?php } ?>