<?php
$selected_organizer_name = isset($settings['elegant_event_organizer']) ? $settings['elegant_event_organizer'] : 'none';
// Get all organizers
$organizers = get_terms('elegant_event_organizer', array('hide_empty'=>false) );
?>
<div id="organizer" class="elegant-box-tab">

	<div class="elegant-box-header">
		<h2 class="elegant-box-title"><?php esc_html_e( 'Organizer', Elegant_Calendar::DOMAIN ); ?></h2>
	</div>

    <div class="elegant-box-body">

        <div class="elegant-box-settings-row">
            <div class="elegant-box-settings-col-1">
                <span class="elegant-settings-label"><?php esc_html_e( 'Event Organizer', Elegant_Calendar::DOMAIN ); ?></span>
            </div>
            <div class="elegant-box-settings-col-2">
            <label class="elegant-settings-label"><?php esc_html_e( 'Event Organizer', Elegant_Calendar::DOMAIN ); ?></label>
                <span class="elegant-description"><?php esc_html_e( 'Choose your event organizer that will show on the calendar.', Elegant_Calendar::DOMAIN ); ?></span>
                <div class="organizer-select-container">
                    <span class="organizer-dropdown-handle" aria-hidden="true">
                        <ion-icon name="chevron-down" class="elegant-icon-down"></ion-icon>
                    </span>
                    <div class="organizer-select-list-container">
                        <button type="button" class="organizer-list-value" id="elegant-event-organizer" value="<?php echo esc_attr( $selected_organizer_name ); ?>">
                            <?php
                            if(isset($settings['elegant_event_organizer'])){
                                $term = get_term($settings['elegant_event_organizer']);
                                $term_name = $term->name;
                            ?>
                                <a class="dd-option">
                                    <input class="dd-option-value" type="hidden" value="<?php echo esc_attr( $settings['elegant_event_organizer'] ); ?>">
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
                        <ul tabindex="-1" role="listbox" class="organizer-list-results elegant-sidenav-hide-md" >
                            <?php foreach ( $organizers as $organizer => $term ) { ?>
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