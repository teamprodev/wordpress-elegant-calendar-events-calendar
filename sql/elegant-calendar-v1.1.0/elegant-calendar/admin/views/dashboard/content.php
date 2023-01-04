<?php
$main_demo_link = '<a href="https://elegantcalendar.com/home/list-view-classic/" target="_blank">' . esc_html__( 'calendar live demos', Elegant_Calendar::DOMAIN ) . '</a>';
$demos = array(
	array(
		'href' => 'https://elegantcalendar.com/monthly-view/',
		'demo' => 'Monthly Classic'
	),
	array(
		'href' => 'https://elegantcalendar.com/monthly-view-modern/',
		'demo' => 'Monthly Modern'
	),
	array(
		'href' => 'https://elegantcalendar.com/monthly-view-minimal/',
		'demo' => 'Monthly Minimal'
	),
	array(
		'href' => 'https://elegantcalendar.com/list-view-classic/',
		'demo' => 'List Classic'
	),
	array(
		'href' => 'https://elegantcalendar.com/grid-view-classic/',
		'demo' => 'Grid Classic'
	),
    array(
		'href' => 'https://elegantcalendar.com/weekly-view/',
		'demo' => 'Weekly View'
	),
    array(
		'href' => 'https://elegantcalendar.com/daily-view/',
		'demo' => 'Daily View'
	),
);
$support_url = 'https://codecanyon.net/item/elegant-instagram-wordpress-instagram-feed-gallery/28019140/support';
$document_url = 'https://elegantcalendar.com/document/';
?>
<div class="wrap about-wrap">
	<h1><?php _e( 'Welcome to Elegant Calendar', Elegant_Calendar::DOMAIN ); ?></h1>
	<div class="about-text">
		<?php
              printf(
                  esc_html__( 'Thank you for choosing Elegant Calendar, the most flexible tool that make you can easily create and manage events calendar! - %1$s', Elegant_Calendar::DOMAIN ),
                  '<a href="https://elegantcalendar.com/" target="_blank">Visit Plugin Homepage</a>'
              );
        ?>
	</div>
    <div class="elegant-badge-logo">
			<img src="<?php echo esc_url(ELEGANT_CALENDAR_URL.'/assets/images/elegant.png'); ?>"aria-hidden="true" alt="<?php esc_attr_e( 'Elegant Calendar', Elegant_Calendar::DOMAIN ); ?>">
		</div>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab nav-tab-active" href="#" data-nav="help">
				<?php esc_html_e( 'Getting Started', Elegant_Calendar::DOMAIN ); ?>
			</a>
			<a class="nav-tab" href="#" data-nav="demo">
				<?php esc_html_e( 'Demos', Elegant_Calendar::DOMAIN ); ?>
			</a>
			<a class="nav-tab" href="#" data-nav="support">
				<?php esc_html_e( 'Support', Elegant_Calendar::DOMAIN ); ?>
			</a>
	    </h2>
        <div class="elegant-welcome-tabs">
	        <div id="help" class="active nav-container">
		    <div class="changelog section-getting-started">
			    <div class="feature-section">
				    <h2><?php esc_html_e( 'Create Your First Event', Elegant_Calendar::DOMAIN ); ?></h2>

				    <img src="<?php echo esc_url(ELEGANT_CALENDAR_URL.'/assets/images/elegant-calendar-event-details.png'); ?>" class="elegant-help-screenshot" alt="<?php esc_attr_e( 'Elegant Calendar', Elegant_Calendar::DOMAIN ); ?>">

				    <h4><?php printf( __( '1. <a href="%s" target="_blank">Events &rarr; Add New</a>', Elegant_Calendar::DOMAIN ), esc_url ( admin_url( 'admin.php?page=elegant-calendar-event-wizard' ) ) ); ?></h4>
				    <p><?php _e( 'To create your first calendar event, simply click the Add New button.', Elegant_Calendar::DOMAIN ); ?></p>

				    <h4><?php _e( '2. Save Your Event Details', Elegant_Calendar::DOMAIN );?></h4>
				    <p><?php _e( 'There are some basic event settings you need to provide, include event title, date & time, location, organizer and etc.', Elegant_Calendar::DOMAIN );?></p>

                    <h4><?php _e( '3. Save Your Event Settings', Elegant_Calendar::DOMAIN );?></h4>
				    <p><?php _e( 'There are tons of settings to help you customize the feed gallery to suit your needs.', Elegant_Calendar::DOMAIN );?></p>
			    </div>
		    </div>
		    <div class="changelog section-getting-started">
			    <div class="elegant-tip">
			    <?php printf( esc_html__( 'Not sure which calendar layout template to use? Check out all our different %s.', Elegant_Calendar::DOMAIN ), $main_demo_link ); ?>
			    </div>
		    </div>
		    <div class="changelog section-getting-started">
			    <div class="feature-section">
				    <h2><?php _e( 'Show Off Your Calendar', Elegant_Calendar::DOMAIN ); ?></h2>

				    <img src="<?php echo esc_url(ELEGANT_CALENDAR_URL.'/assets/images/elegant-calendar-shortcode-generator.png'); ?>" class="elegant-help-screenshot" alt="<?php esc_attr_e( 'Elegant Calendar', Elegant_Calendar::DOMAIN ); ?>">

                    <h4><?php printf( __( '<a href="%s" target="_blank">The <em>[elegant_calendar]</em> Shortcode Generator</a>', Elegant_Calendar::DOMAIN ), esc_url ( admin_url( 'admin.php?page=elegant-calendar-settings' ) ) ); ?></h4>

				    <p><?php _e( 'Simply copy the shortcode code from the gallery listing page and paste it into your posts or pages.', Elegant_Calendar::DOMAIN );?></p>

				    <h4><?php _e( 'Copy To Clipboard',Elegant_Calendar::DOMAIN );?></h4>
				    <p><?php _e( 'We make your life easy! Just click the shortcodes generator and they get copied to your clipboard automatically. ', Elegant_Calendar::DOMAIN );?></p>

			    </div>
		    </div>
	        </div>
	    <div id="demo" class="nav-container">
		    <h2><?php _e( 'Demos', Elegant_Calendar::DOMAIN ); ?></h2>
		    <div class="demos_masonry">
		    <?php
			    foreach ( $demos as $demo ) {
		    ?>
				<div class="demo_section">
					<h3><a href="<?php echo esc_url($demo['href']); ?>" target="_blank" title="<?php esc_html__('Open demo in new tab',Elegant_Calendar::DOMAIN); ?>"><?php echo esc_html( $demo['demo'] ); ?></a></h3>
				</div>
		    <?php
			    }
		    ?>
		    </div>
	    </div>

	    <div id="support" class="nav-container">
		    <h2><?php _e( "Need help? We're here for you...", Elegant_Calendar::DOMAIN ); ?></h2>
		    <p class="document-center">
			    <span class="dashicons dashicons-editor-help"></span>
			    <a href="<?php echo esc_url ( $document_url ); ?>" target="_blank">
			    <?php _e('Document',Elegant_Calendar::DOMAIN); ?>
			    - <?php _e('The document articles will help you troubleshoot issues that have previously been solved.', Elegant_Calendar::DOMAIN); ?>
			    </a>
		    </p>
		    <div class="feature-cta">
			    <p><?php _e('Still stuck? Please open a support ticket and we will help:', Elegant_Calendar::DOMAIN); ?></p>
			    <a target="_blank" href="<?php echo esc_url ( $support_url ); ?>"><?php _e('Open a support ticket', Elegant_Calendar::DOMAIN ); ?></a>
		    </div>
	    </div>
	</div>
</div>