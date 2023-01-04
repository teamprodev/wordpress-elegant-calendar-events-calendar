<?php
$meta =elegant_single_event_meta_data($event_id);
?>
<div class="elegant-single-event-meta-wrapper">
                    <div class="elegant-single-event-meta-row elegant-two-column">
					    <div class="elegant-b1">
                            <span class="elegant-single-event-meta-icons">
                                <ion-icon name="time" class="elegant-icon"></ion-icon>
                            </span>
						    <div class="elegant-single-event-meta-cell">
						        <h3><?php esc_html_e( 'Details', Elegant_Calendar::DOMAIN ); ?></h3>

						        <div class="elegant-single-event-meta-data">
                                    <p class="elegant-single-event-meta-data-name">
							        <span class="elegant-single-event-meta-data-name-t">
                                        <?php if(isset($meta['details'])){echo esc_attr($meta['details']);} ?>
                                    </span>
							        </p>
                                </div>
                                <div class="clear"></div>
						    </div>
                        </div>
                        <div class="elegant-b2">
                            <span class="elegant-single-event-meta-icons">
                                <ion-icon name="location" class="elegant-icon"></ion-icon>
                            </span>
						    <div class="elegant-single-event-meta-cell">
						        <h3><?php esc_html_e( 'Location', Elegant_Calendar::DOMAIN ); ?></h3>

						        <div class="elegant-single-event-meta-data">
                                    <p class="elegant-single-event-meta-data-name">
							        <span class="elegant-single-event-meta-data-name-t">
                                        <?php if(isset($meta['location'])){echo esc_attr($meta['location']);} ?>
                                    </span>
							        </p>
                                </div>
                                <div class="clear"></div>
						    </div>
                        </div>
					</div>

                    <div class="elegant-single-event-meta-row">
						<span class="elegant-single-event-meta-icons">
                            <ion-icon name="mic" class="elegant-icon"></ion-icon>
                        </span>
						<div class="elegant-single-event-meta-cell">
						    <h3><?php esc_html_e( 'Organizer', Elegant_Calendar::DOMAIN ); ?></h3>

						    <div class="elegant-single-event-meta-data">
                                <p class="elegant-single-event-meta-data-name">
							    <span class="elegant-single-event-meta-data-name-t">
                                    <?php if(isset($meta['organizer'])){echo esc_attr($meta['organizer']);} ?>
                                </span>
							    </p>
                            </div>
                            <div class="clear"></div>
						</div>
					</div>
                </div><!-- #elegant-single-event-meta-wrapper -->