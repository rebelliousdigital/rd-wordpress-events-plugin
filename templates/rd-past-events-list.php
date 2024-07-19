<?php

/**
 * Template for displaying past events.
 *
 * @package RebelliousDigitalEvents
 */

$past_events = RebelliousDigitalEvents::get_past_events();

if ( $past_events->have_posts() ) {

    while ( $past_events->have_posts() ) {
        $past_events->the_post();
        RebelliousDigitalEvents::event_card(get_the_ID());
    }

    wp_reset_postdata();

} else {
    echo '<p>No events found.</p>';
}