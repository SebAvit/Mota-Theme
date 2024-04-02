<?php

/**
 * Document Filtered Imgs Front Page
 */
function enqueue_scripts_js_ajax()
{
    wp_enqueue_script('filters-script', get_stylesheet_directory_uri() . '/js/filters.js', array('jquery'), null, true);

    // Localize ajaxurl
    $translation_array = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    );
    // Localize the script
    wp_localize_script('ajax-script', 'photo', $translation_array);
}
add_action('wp_enqueue_scripts', 'enqueue_scripts_js_ajax');
/**
 * Function Filters Front Page
 */
function filter_results()
{
    $categorie = isset($_POST['categoriies']) ? sanitize_text_field($_POST['categoriies']) : '';
    $format = isset($_POST['formats']) ? sanitize_text_field($_POST['formats']) : '';
    $date = $_POST['date'];
    
    // check if category exists before adding corresponding taxonomy
    if ((isset($categorie)) and ($categorie != "")) {
        $tax_query[] = array(
            'taxonomy' => 'categoriies',
            'field' => 'slug',
            'terms' => $categorie,
        );
    }

    // check if format exists before adding corresponding taxonomy
    if ((isset($format)) and ($format != "")) {
        $tax_query[] = array(
            'taxonomy' => 'formats',
            'field' => 'slug',
            'terms' => $format,
        );
    }

    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => -1,
        'order' => $date,
        'tax_query' => $tax_query,
    );

    $filtered_query = new WP_Query($args);

    if ($filtered_query->have_posts()) {
        while ($filtered_query->have_posts()) {
            $filtered_query->the_post();
            $post_url = get_permalink();
?>
            <!-- Template Post Card -->
            <?php get_template_part('template-parts/photo_block'); ?>
<?php
        }
        wp_reset_postdata();
    } else {
        echo '<div class="nothing_result">';
        echo '<p>Aucun résultat trouvé </p>';
        echo '<p>Pour la catégorie <span>' . $categorie . '</span></p>';
        echo '<p>Au format <span>' . $format . '</span></p>';
        echo '<p>Pour <span>' . $date . '</span></p>';
        echo '</div>';
    }

    die();
}
add_action('wp_ajax_filter_results', 'filter_results');
add_action('wp_ajax_nopriv_filter_results', 'filter_results');
