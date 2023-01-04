<div class="elegant-row-with-sidenav">

    <div class="elegant-sidenav">
        <div class="elegant-mobile-select">
            <span class="elegant-select-content"><?php esc_html_e( 'Global Settings', Elegant_Calendar::DOMAIN ); ?></span>
            <ion-icon name="chevron-down" class="elegant-icon-down"></ion-icon>
        </div>

        <ul class="elegant-vertical-tabs elegant-sidenav-hide-md">

            <li class="elegant-vertical-tab current">
                <a href="#" data-nav="general">
                    <ion-icon name="build-outline" class="elegant-icon-build"></ion-icon>
                    <?php esc_html_e( 'General', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="shortcode">
                    <ion-icon name="barcode-outline" class="elegant-icon-code"></ion-icon>
                    <?php esc_html_e( 'Shortcode', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="appearance">
                    <ion-icon name="grid-outline" class="elegant-icon-grid"></ion-icon>
                    <?php esc_html_e( 'Appearance', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="sort-filter">
                    <ion-icon name="funnel-outline" class="elegant-icon-filter"></ion-icon>
                    <?php esc_html_e( 'Sort and Filter', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="search">
                    <ion-icon name="search-outline" class="elegant-icon-search"></ion-icon>
                    <?php esc_html_e( 'Events Search', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

            <li class="elegant-vertical-tab">
                <a href="#" data-nav="single">
                    <ion-icon name="bookmark-outline" class="elegant-icon-single"></ion-icon>
                    <?php esc_html_e( 'Single Events', Elegant_Calendar::DOMAIN ); ?>
                </a>
            </li>

        </ul>

    </div>

    <div class="elegant-box-tabs">
         <?php $this->template( 'settings/sections/tab-general' ); ?>
         <?php $this->template( 'settings/sections/tab-shortcode' ); ?>
         <?php $this->template( 'settings/sections/tab-appearance' ); ?>
         <?php $this->template( 'settings/sections/tab-sort-filter' ); ?>
         <?php $this->template( 'settings/sections/tab-search' ); ?>
         <?php $this->template( 'settings/sections/tab-single' ); ?>
    </div>
</div>