<?php

/**
 * Template for displaying latest events.
 *
 * @package RebelliousDigitalEvents
 */

$latest_events = RebelliousDigitalEvents::get_latest_events();

if ( $latest_events->have_posts() ) {

    while ( $latest_events->have_posts() ) {
        $latest_events->the_post();
        RebelliousDigitalEvents::event_card(get_the_ID());
    }

    wp_reset_postdata();

} else {
    echo '<p>No events found.</p>';
}