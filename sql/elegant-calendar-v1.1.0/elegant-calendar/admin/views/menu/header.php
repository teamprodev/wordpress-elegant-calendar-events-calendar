<div class="fsp-container">
    <div class="fsp-header">
        <div class="fsp-nav">
            <a class="fsp-nav-link" href="<?php echo admin_url( 'admin.php?page=elegant-calendar' ); ?>"><?php esc_html_e( 'Dashboard', Elegant_Calendar::DOMAIN ); ?></a>
            <a class="fsp-nav-link" href="<?php echo admin_url( 'admin.php?page=elegant-calendar-event' ); ?>"><?php esc_html_e( 'Events', Elegant_Calendar::DOMAIN ); ?></a>
            <a class="fsp-nav-link" href="<?php echo admin_url( 'edit-tags.php?taxonomy=elegant_event_location&post_type=elegant_event' ); ?>"><?php esc_html_e( 'Locations', Elegant_Calendar::DOMAIN ); ?></a>
            <a class="fsp-nav-link" href="<?php echo admin_url( 'edit-tags.php?taxonomy=elegant_event_organizer&post_type=elegant_event' ); ?>"><?php esc_html_e( 'Organizers', Elegant_Calendar::DOMAIN ); ?></a>
            <a class="fsp-nav-link" href="<?php echo admin_url( 'edit-tags.php?taxonomy=elegant_event_type&post_type=elegant_event' ); ?>"><?php esc_html_e( 'Type', Elegant_Calendar::DOMAIN ); ?></a>
            <a class="fsp-nav-link" href="<?php echo admin_url( 'admin.php?page=elegant-calendar-settings' ); ?>"><?php esc_html_e( 'Settings', Elegant_Calendar::DOMAIN ); ?></a>
        </div>
    </div>
</div>

<div class="clear"></div>