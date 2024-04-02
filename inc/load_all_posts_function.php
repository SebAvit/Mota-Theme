<?php

/**
 * Document Include Function Load ALL imgs -> Single-page
 */
function load_all_imgs()
{
    check_ajax_referer('load_more_posts', 'security');
    $args = array(
        'post_type' => 'photos',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'paged' => $_POST['page'],
        'post__not_in' => explode(',', $_POST['exclude']),
    );
    $query_all_imgs = new WP_Query($args);
?>
    <?php if ($query_all_imgs->have_posts()) : ?>
        <?php while ($query_all_imgs->have_posts()) : $query_all_imgs->the_post();
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
add_action('wp_ajax_load_single_posts_by_ajax', 'load_all_imgs');
add_action('wp_ajax_nopriv_load_single_posts_by_ajax', 'load_all_imgs');
