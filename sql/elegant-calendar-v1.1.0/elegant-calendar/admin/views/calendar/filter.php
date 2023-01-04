<?php
// Get all organizers
$locations = get_terms('elegant_event_location', array('hide_empty'=>false) );
$organizers = get_terms('elegant_event_organizer', array('hide_empty'=>false) );
$types = get_terms('elegant_event_type', array('hide_empty'=>false) );
?>
<div class="events-filter-list">
      <div class="events-filter-select-container events-filter-select-type">
			  <p class="events-filter-select btn">Event Type</p>
				<div class="events-filter-dropdown">
          <p class="filter all" data-filter_val="all">All</p>
          <?php foreach ( $types as $type => $term ) { ?>
            <p class="filter type" data-filter_val="<?php echo esc_attr( $term->term_id ); ?>" data-filter_slug="<?php echo esc_attr( $term->name ); ?>">
                <?php echo esc_html( $term->name ); ?>
            </p>
          <?php } ?>
        </div>
      </div>

      <div class="events-filter-select-container events-filter-select-location">
			  <p class="events-filter-select btn">Event Location</p>
				<div class="events-filter-dropdown">
          <p class="filter location" data-filter_val="all">All</p>
          <?php foreach ( $locations as $location => $term ) { ?>
            <p class="filter location" data-filter_val="<?php echo esc_attr( $term->term_id ); ?>" data-filter_slug="<?php echo esc_attr( $term->name ); ?>">
                <?php echo esc_html( $term->name ); ?>
            </p>
          <?php } ?>
        </div>
      </div>

      <div class="events-filter-select-container events-filter-select-organizer">
			  <p class="events-filter-select btn">Event Organizer</p>
				<div class="events-filter-dropdown">
          <p class="filter organizer" data-filter_val="all">All</p>
          <?php foreach ( $organizers as $organizer => $term ) { ?>
            <p class="filter organizer" data-filter_val="<?php echo esc_attr( $term->term_id ); ?>" data-filter_slug="<?php echo esc_attr( $term->name ); ?>">
                <?php echo esc_html( $term->name ); ?>
            </p>
          <?php } ?>
        </div>
      </div>
</div>