<?php

/**
 * Load more post Ajax Front page
 */
function load_more_imgs()
{
    
    check_ajax_referer('load_more_posts', 'security');
    // Post per page
    $post_per_page = -1;
    $args = array(
        'post_type' => 'photos',
        'post_status' => 'publish',
        'posts_per_page' => $post_per_page,
        'paged' => get_query_var('paged') ? get_query_var('paged') : 1,
        'post__not_in' => explode(',', $_POST['exclude']),
    );
    $query_more_imgs = new WP_Query($args);
?>
    <?php if ($query_more_imgs->have_posts()) : ?>
        <?php while ($query_more_imgs->have_posts()) : $query_more_imgs->the_post();
            $post_url = get_permalink();
        ?>
            <!-- Template Post Card -->
            <?php get_template_part('template-parts/photo_block'); ?>
            
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php endif; ?>
<?php
    wp_die();
}


add_action('wp_ajax_load_front_posts_by_ajax', 'load_more_imgs');
add_action('wp_ajax_nopriv_load_front_posts_by_ajax', 'load_more_imgs');
