<?php

/*
Plugin Name: Rebellious Digital Events
Plugin URI: https://rebelliousdigital.co.uk
Description: A plugin to display events.
Version: 1.0
Author: Rebellious Digital
Author URI: https://rebelliousdigital.co.uk
*/

// Create class to initialize the plugin
class RebelliousDigitalEvents {
    public function __construct() {
        $this->includes();
        add_shortcode( 'rd-events', array( $this, 'rebellious_digital_events_shortcode' ) );
        add_shortcode( 'rd-past-events', array( $this, 'rebellious_digital_past_events_shortcode' ) );
        add_action( 'pre_get_posts', array( $this, 'rebellious_digital_events_remove_past_events' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend_styles' ) );
        register_activation_hook( __FILE__, array( $this, 'rebellious_digital_events_plugin_activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'rebellious_digital_events_plugin_deactivate' ) );
    }

    /**
     * Enqueue frontend styles
     * 
     * @return void
     */

    public function enqueue_frontend_styles() {
        wp_enqueue_style('rebellious-digital-events-style', plugin_dir_url(__FILE__) . 'assets/css/style.min.css');
    }

    /**
     * Events shortcode
     * 
     * @return void
     */

    public function rebellious_digital_events_shortcode() {
        include( plugin_dir_path( __FILE__ ) . 'templates/rd-events-list.php' );
    }

    /**
     * Past events shortcode
     * 
     * @return void
     */

    public function rebellious_digital_past_events_shortcode() {
        include( plugin_dir_path( __FILE__ ) . 'templates/rd-past-events-list.php' );
    }

    /**
     * Include plugin files
     * 
     * @return void
     */
    public function includes() {
        include( plugin_dir_path( __FILE__ ) . 'includes/rd-post-type.php' );
        include( plugin_dir_path( __FILE__ ) . 'includes/rd-post-meta.php' );
    }

    /**
     * Remove past events from query
     * 
     * @param WP_Query $query
     * @return void
     */

    public static function rebellious_digital_events_remove_past_events($query) {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        if (is_post_type_archive('events')) {
            $meta_query = array(
                array(
                    'key' => 'finish_datetime',
                    'value' => date('Y-m-d H:i:s'),
                    'compare' => '>=',
                    'type' => 'DATETIME'
                )
            );

            $query->set('meta_query', $meta_query);
            $query->set('orderby', 'meta_value');
            $query->set('order', 'ASC');
        }

    }

    /**
     * Get latest events
     * 
     * @param int $limit
     * @return WP_Query
     */

    public static function get_latest_events($limit = -1) {
        $args = array(
            'post_type' => 'events',
            'posts_per_page' => $limit,
            'meta_key' => 'start_datetime',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'relation' => 'AND',
                    array(
                        'key' => 'finish_datetime',
                        'value' => date('Y-m-d H:i:s'),
                        'compare' => '>=',
                        'type' => 'DATETIME'
                    ),
                    array(
                        'key' => 'start_datetime',
                        'compare' => 'EXISTS'
                    )
                ),
                array(
                    'key' => 'start_datetime',
                    'value' => date('Y-m-d H:i:s'),
                    'compare' => '>=',
                    'type' => 'DATETIME'
                )
            )
        );
    
        return new WP_Query($args);
    }

    /**
     * Get past events
     * 
     * @param int $limit
     * @return WP_Query
     */

    public static function get_past_events($limit = -1) {
        $args = array(
            'post_type' => 'events',
            'posts_per_page' => $limit,
            'meta_key' => 'start_datetime',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'meta_query' => array(
                'relation' => 'OR',
                array(
                    'relation' => 'AND',
                    array(
                        'key' => 'finish_datetime',
                        'value' => date('Y-m-d H:i:s'),
                        'compare' => '<',
                        'type' => 'DATETIME'
                    ),
                    array(
                        'key' => 'start_datetime',
                        'compare' => 'EXISTS'
                    )
                ),
                array(
                    'key' => 'start_datetime',
                    'value' => date('Y-m-d H:i:s'),
                    'compare' => '<',
                    'type' => 'DATETIME'
                )
            )
        );

        return new WP_Query($args);
    }

    /**
     * Get event start date
     * 
     * @param string $post_id
     * @return string
     */

    public static function get_event_start_date($post_id) {
        return get_post_meta($post_id, 'start_datetime', true);
    }

    /**
     * Get event finish date
     * 
     * @param string $post_id
     * @return string
     */

    public static function get_event_finish_date($post_id) {
        return get_post_meta($post_id, 'finish_datetime', true);
    }

    /**
     * Format date and time
     * 
     * @param string $post_id
     * @param string $startDate
     * @param string $finishDate
     */

    public static function format_event_date_time($post_id) {
        // Format start date and time
        $startDate = RebelliousDigitalEvents::get_event_start_date($post_id);
        $finishDate = RebelliousDigitalEvents::get_event_finish_date($post_id);

        // Format start date and time
        $startDateTime = strtotime($startDate);
        $startFormatted = date('l g:ia', $startDateTime);

        // Initialize endFormatted
        $endFormatted = '';

        // Format finish date and time if available
        if (!empty($finishDate)) {
            $finishDateTime = strtotime($finishDate);

            // Check if start and finish are on the same day
            if (date('l', $startDateTime) == date('l', $finishDateTime)) {
                // Only show the finish time without the day
                $endFormatted = ' - ' . date('g:ia', $finishDateTime);
            } else {
                // Show the full finish date and time with the day
                $endFormatted = ' - ' . date('l g:ia', $finishDateTime);
            }
        }

        return esc_html($startFormatted . $endFormatted);

    }

    /**
     * Event card
     * 
     * @param WP_Post $post
     * @return void
     */

    public static function event_card($post_id) {
        $start_date = RebelliousDigitalEvents::get_event_start_date($post_id);
        $title = get_the_title($post_id);
        $excerpt = get_the_excerpt($post_id);
        $permalink = get_permalink($post_id);

        $content = '<article class="rd-latest-events">';
            $content .= '<aside class="rd-latest-events__date">';
                $content .= '<span class="rd-latest-events__date-day">' . date('j', strtotime($start_date)) . '</span>';
                $content .= '<span class="rd-latest-events__date-month">' . date('M', strtotime($start_date)) . '</span>';
                $content .= '<span class="rd-latest-events__date-year">' . date('Y', strtotime($start_date)) . '</span>';
            $content .= '</aside>';
            $content .= '<div class="rd-latest-events__content">';
                $content .= '<h3 class="rd-latest-events__content-title"><a href="' . esc_url($permalink) . '">' . esc_html($title) . '</a></h3>';
                $content .= '<time class="rd-latest-events__content-time">' . RebelliousDigitalEvents::format_event_date_time($post_id) . '</time>';
                $content .= '<p class="rd-latest-events__content-excerpt">' . esc_html($excerpt) . '</p>';
            $content .= '</div>';
        $content .= '</article>';

        echo $content;
    }

    public function rebellious_digital_events_plugin_activate() {
        flush_rewrite_rules();
    }

    public function rebellious_digital_events_plugin_deactivate() {
        flush_rewrite_rules();
    }

}

new RebelliousDigitalEvents();