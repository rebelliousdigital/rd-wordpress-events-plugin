<?php

/**
 * Template for displaying latest events in a carousel.
 *
 * @package RebelliousDigitalEvents
 */

$latest_events = RebelliousDigitalEvents::get_latest_events();

if ( $latest_events->have_posts() ) {
    echo '<div class="rd-events-carousel embla">';
        echo '<div class="embla__viewport">';
            echo '<div class="embla__container">';
                while ( $latest_events->have_posts() ) {
                    $latest_events->the_post();
                    RebelliousDigitalEvents::event_carousel_slide(get_the_ID());
                }
            echo '</div>';
        echo '</div>';
        echo '<div class="embala__buttons">';
            echo '<button class="embla__prev" aria-label="Previous slide" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-left" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/></svg></button>';
            echo '<button class="embla__next" aria-label="Next slide" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/></svg></button>';
        echo '</div>';
    echo '</div>';

    wp_reset_postdata();

} else {
    echo '<p>No events found.</p>';
}