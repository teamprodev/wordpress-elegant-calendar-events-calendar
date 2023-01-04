<?php
$selected_location = isset($settings['elegant_event_location']) ? $settings['elegant_event_location'] : 'none';
// Get all locations
$locations = get_terms('elegant_event_location', array('hide_empty'=>false) );
?>
<div id="location" class="elegant-box-tab">

	<div class="elegant-box-header">
		<h2 class="elegant-box-title"><?php esc_html_e( 'Location', Elegant_Calendar::DOMAIN ); ?></h2>
	</div>

    <div class="elegant-box-body">

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Event Location', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
            <label class="elegant-settings-label"><?php esc_html_e( 'Event Location', Elegant_Calendar::DOMAIN ); ?></label>
                <span class="elegant-description"><?php esc_html_e( 'Choose your event location that will show on the calendar.', Elegant_Calendar::DOMAIN ); ?></span>
                <div class="location-select-container">
                    <span class="location-dropdown-handle" aria-hidden="true">
                        <ion-icon name="chevron-down" class="elegant-icon-down"></ion-icon>
                    </span>
                    <div class="location-select-list-container">
                        <button type="button" class="location-list-value" id="elegant-event-location" value="<?php echo esc_attr( $selected_location ); ?>">
                            <?php
                            if(isset($settings['elegant_event_location'])){
                                $term_name = get_term( $settings['elegant_event_location'] )->name;
                            ?>
                                <a class="dd-option">
                                    <input class="dd-option-value" type="hidden" value="<?php echo esc_attr( $settings['elegant_event_location'] ); ?>">
                                    <label class="dd-option-text"><?php echo esc_html( $term_name ); ?></label>
                                </a>
                            <?php

                            }else{
                            ?>
                                <a class="dd-option">
                                        <input class="dd-option-value" type="hidden" value="none">
                                        <label class="dd-option-text">None</label>
                                </a>
                            <?php
                            }
                            ?>
                        </button>
                        <ul tabindex="-1" role="listbox" class="location-list-results elegant-sidenav-hide-md" >
                            <?php foreach ( $locations as $location => $term ) { ?>
                                <li>
                                    <a class="dd-option">
                                        <input class="dd-option-value" type="hidden" value="<?php echo esc_attr( $term->term_id ); ?>">
                                        <label class="dd-option-text"><?php echo esc_html( $term->name ); ?></label>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
