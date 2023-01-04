<h1 class="elegant-header-title"><?php esc_html_e( 'Events', Elegant_Calendar::DOMAIN ); ?></h1>
<div class="elegant-actions-left">
    <a href="<?php echo admin_url( 'admin.php?page=elegant-calendar-event-wizard' ); ?>" class="open-popup-link" data-effect="mfp-zoom-in">
        <button class="elegant-button elegant-button-blue">
            <?php esc_html_e( 'Create', Elegant_Calendar::DOMAIN ); ?>
        </button>
    </a>
</div>
<div class="elegant-actions-right">
		<a href="https://elegantcalendar.com/document/" target="_blank" class="elegant-button elegant-button-ghost">
			<ion-icon class="elegant-icon-document" name="document-text-sharp"></ion-icon>
			<?php esc_html_e( 'View Documentation', Elegant_Calendar::DOMAIN ); ?>
		</a>
</div>
