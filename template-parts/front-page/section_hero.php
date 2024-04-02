<section class="hero_section">

<?php
            // Post per page
            $post_per_page = 1;
            // Argument definition
            $args = array(
                'orderby' => 'rand',
                'post_type' => 'photos',
                'posts_per_page' => $post_per_page,
                'paged' => 1,
            );
            // Definition / Execution of wp-query
            $query = new WP_Query($args);
            // Execution loop of wp-query
            while ($query->have_posts()) : $query->the_post();
                $post_url = get_permalink();
            ?>
                        <!-- Template Post Card -->
                        <div class="hero_img">
            <?php get_template_part('template-parts/photo_img'); ?>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata() ?>

    <h1 class="hero_section_title">
        <svg viewbox="0 0 10 2">
            <text x="5" y="1" text-anchor="middle" font-size="0.7" fill="none" stroke-width=".02" stroke="#fff" font-family="space mono" font-style="italic" font-weight=900 text-transform="uppercase">PHOTOGRAPHE
                EVENT
            </text>
        </svg>
    </h1>
</section><!-- .hero_section-->