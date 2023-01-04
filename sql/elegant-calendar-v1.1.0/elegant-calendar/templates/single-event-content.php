<?php
/*
 *	The template for displaying single event
 *
 *
 *  @since  1.0.0
 *  @package Elegant Calendar
 */
$event_id = get_the_ID();
$global_settings = get_option('elegant_global_settings');
$single_event_logged_only = isset($global_settings['single_event_logged_only']) && $global_settings['single_event_logged_only'] == 'on' ? 'checked' : '';

get_header();
?>

<div class="elegant-single-event-wrapper">
	<?php if ( $single_event_logged_only == 'checked' && !is_user_logged_in() ) { ?>
		<p><?php esc_html_e( 'Only logged-in users can see this event', Elegant_Calendar::DOMAIN ); ?></p>
	<?php } else { ?>
    <div class="elegant-single-event-content">

	    <?php the_title( '<h1 class="elegant-single-event-title">', '</h1>' ); ?>

	    <div class="elegant-single-event-schedule elegant-clearfix">
            <h2><?php echo elegant_single_event_schedule_details( $event_id ); ?></h2>
	    </div>

	    <?php while ( have_posts() ) :  the_post(); ?>
		    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			    <!-- Event content -->
			    <?php do_action( 'elegant_single_event_before_the_content' ) ?>
			    <div class="elegant-single-event-description">
				    <?php the_content(); ?>
			    </div>
			    <!-- .elegant-single-event-single-event-description -->
			    <?php do_action( 'elegant_single_event_after_the_content' ) ?>

			    <!-- Event meta -->
			    <?php do_action( 'elegant_single_event_before_the_meta' ) ?>
                <?php include( dirname( __FILE__ ) . '/single-event-meta.php' ); ?>
			    <?php do_action( 'elegant_single_event_after_the_meta' ) ?>

				<?php
					if( isset($global_settings['single_event_enable_comments']) && $global_settings['single_event_enable_comments'] == 'on' ){
						comments_template( '', true );
					}
	 			?>
		    </div> <!-- #post-x -->
	    <?php endwhile; ?>

	    <!-- Event footer -->
	    <div id="elegant-single-event-footer">
	    </div>
	    <!-- #elegant-single-event-footer -->

    </div><!-- #elegant-single-event-content -->
	<?php } ?>
</div><!-- #elegant-single-event-wrapper -->
<?php
get_footer();
?>