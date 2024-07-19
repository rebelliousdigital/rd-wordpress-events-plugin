<?php

/**
 * Events post meta.
 *
 * @package RebelliousDigitalEvents
 */

class RebelliousDigitalEventsMeta {

    /**
     * Constructor
     * 
     * @return void
     */
    public function __construct() {
        add_action('add_meta_boxes', array($this, 'add_events_meta_box'));
        add_action('save_post', array($this, 'save_events_meta_box'));
    }

    /**
     * Add events meta box
     * 
     * @return void
     */
    public function add_events_meta_box() {
        add_meta_box(
            'events_details',
            'Event Details',
            array($this, 'events_details_callback'),
            'events',
            'normal',
            'high'
        );
    }

    /**
     * Events details callback
     * 
     * @param WP_Post $post
     * @return void
     */
    public function events_details_callback($post) {
        wp_nonce_field('events_details_data', 'events_details_nonce');
        
        // Retrieve existing meta values
        $start_datetime = get_post_meta($post->ID, 'start_datetime', true);
        $finish_datetime = get_post_meta($post->ID, 'finish_datetime', true);

        ?>
        <p>
            <label for="start_datetime">Start Date/Time:</label>
            <input type="datetime-local" id="start_datetime" name="start_datetime" value="<?php echo esc_attr($start_datetime); ?>">
        </p>
        <p>
            <label for="finish_datetime">Finish Date/Time:</label>
            <input type="datetime-local" id="finish_datetime" name="finish_datetime" value="<?php echo esc_attr($finish_datetime); ?>">
        </p>
        <?php
    }

    /**
     * Save events meta box
     * 
     * @param int $post_id
     * @return void
     */
    public function save_events_meta_box($post_id) {
        // Check nonce
        if (!isset($_POST['events_details_nonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['events_details_nonce'], 'events_details_data')) {
            return;
        }

        // Check autosave
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Check permissions
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        // Save start_datetime
        if (isset($_POST['start_datetime'])) {
            update_post_meta($post_id, 'start_datetime', sanitize_text_field($_POST['start_datetime']));
        }

        // Save finish_datetime
        if (isset($_POST['finish_datetime'])) {
            update_post_meta($post_id, 'finish_datetime', sanitize_text_field($_POST['finish_datetime']));
        }
    }
}

new RebelliousDigitalEventsMeta();