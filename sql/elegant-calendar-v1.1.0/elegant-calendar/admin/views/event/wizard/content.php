<?php
$id = isset( $_GET['id'] ) ? sanitize_text_field( $_GET['id'] ) : '';
$status = isset( $_GET['status'] ) ? sanitize_text_field( $_GET['status'] ) : '';

// Campaign Settings
$settings = array();
if(!empty($id)){
    $model    = $this->get_event_model( $id, $status );
    $settings = $model->settings;
    $settings['status'] = $model->status;
}
?>
<div class="elegant-row-with-sidenav">

    <div class="elegant-sidenav">

        <div class="elegant-mobile-select">
            <span class="elegant-select-content"><?php esc_html_e( 'General', Elegant_Calendar::DOMAIN ); ?></span>
            <ion-icon name="chevron-down" class="elegant-icon-down"></ion-icon>
        </div>

        <ul class="elegant-vertical-tabs elegant-sidenav-hide-md">

            <li class="elegant-vertical-tab current">
                <a href="#" data-nav="general">
                    <ion-icon name="pencil" class="elegant-icon-pencil"></ion-icon>
                    <?php esc_html_e( 'General', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="date">
                    <ion-icon name="time-outline" class="elegant-icon-time"></ion-icon>
                    <?php esc_html_e( 'Date & Time', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="location">
                    <ion-icon name="location-outline" class="elegant-icon-location"></ion-icon>
                    <?php esc_html_e( 'Location & Venue', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="organizer">
                    <ion-icon name="mic-outline" class="elegant-icon-mic"></ion-icon>
                    <?php esc_html_e( 'Organizer', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="type">
                    <ion-icon name="bookmarks-outline" class="elegant-icon-bookmarks"></ion-icon>
                    <?php esc_html_e( 'Event Type', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="color">
                    <ion-icon name="color-palette-outline" class="elegant-icon-bookmarks"></ion-icon>
                    <?php esc_html_e( 'Event Color', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="image">
                    <ion-icon name="image-outline" class="elegant-icon-bookmarks"></ion-icon>
                    <?php esc_html_e( 'Image', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

        </ul>

    </div>

    <form class="elegant-event-form" method="post" name="elegant-event-form" action="">

        <div class="elegant-box-tabs">
            <?php $this->template( 'event/wizard/sections/tab-save',  $settings); ?>
            <?php $this->template( 'event/wizard/sections/tab-general', $settings); ?>
            <?php $this->template( 'event/wizard/sections/tab-date', $settings); ?>
            <?php $this->template( 'event/wizard/sections/tab-location', $settings); ?>
            <?php $this->template( 'event/wizard/sections/tab-organizer', $settings); ?>
            <?php $this->template( 'event/wizard/sections/tab-type', $settings); ?>
            <?php $this->template( 'event/wizard/sections/tab-color', $settings); ?>
            <?php $this->template( 'event/wizard/sections/tab-image', $settings); ?>
        </div>
        <input type="hidden" name="event_id" value="<?php echo esc_html($id); ?>">

    </form>
</div>


