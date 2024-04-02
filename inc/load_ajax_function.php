<?php

/**
 * Load Ajax -> MORE and ALL Imgs
 */
function ajax_scripts()
{
    // Register the script
    wp_enqueue_script('jquery-script', get_stylesheet_directory_uri() . '/js/load-posts.js', array('jquery'), false, true);
    wp_enqueue_script('lightbox-script', get_stylesheet_directory_uri() . '/js/lightbox.js', array('jquery'), '0.0.1', true);

    // Localize the script with new data
    $script_data_array = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('load_more_posts'),
    );
    wp_localize_script('jquery-script', 'photo', $script_data_array);

    // Enqueued script with localized data.
    wp_enqueue_script('jquery-script');
}

//
add_action('wp_enqueue_scripts', 'ajax_scripts');
