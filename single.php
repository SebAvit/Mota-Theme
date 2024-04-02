<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <main id="main_single_photo_page">
            <!-- Section section_post_photos -->
            <section class="section_post_photos">
                <!-- Col Left Description -->
                <article class="post_photo_desc">
                    <div class="post_photo_desc_content">
                        <h1 class="post_photo_title"><?php the_title(); ?></h1>
                        <!-- Display ACF values for post -->
                        <div  class="post_photo_text">Référence : <span id="ref">bf<?php the_field('reference'); ?></span></div>
                        <div class="post_photo_text"><?php the_terms( $post->ID, 'categoriies', 'Catégorie : ' ); ?></div>
                        <div class="post_photo_text"><?php the_terms( $post->ID, 'formats', 'Format : ' ); ?></div>
                        <div class="post_photo_text"><?php if( get_field('type') ) {
                                echo "<p>Type : Argentique</p>";
                                }
                                else {
                                echo "<p>Type : Numérique</p>";
                                } ?></div>
                        <div class="post_photo_text">Année : <?php the_time('Y'); ?></div>
                    </div>
                </article><!-- post_photo_desc -->
                <!-- Col Right Photo -->
                <article class="post_photo_img">
                    <!-- Post Card -->
                    <?php get_template_part('template-parts/photo_block'); ?>
                </article>
            </section><!-- .section_post_photos -->
            <!-- Affichage section contact -->
            <section class="section_post_contact_nav">
                <div class="post_contact_text">
                    <p>Cette photo vous intéresse ?</p>
                    <a class="post_contact_link" href="#">
                        <span>Contact</span></a>
                </div>
                <!-- Pagination post prev / next -->
                <div class="post_photo_navigation">
                    <?php
                    $next_post = get_next_post();
                    $prev_post = get_previous_post();
                    $current_image = get_the_post_thumbnail_url(get_the_ID());
                    ?>
                    <!-- Img -->
                    <img id="dynamicImage" src="<?php echo $current_image; ?>" alt="Current Post" width="81" height="81" style="transition: opacity 0.5s;" />
                    <!-- Links -->
                    <div class="post_links">
                        <div class="prev_photo_block">
                            <?php if (!empty($prev_post)) :
                                $prev_image = get_the_post_thumbnail_url($prev_post->ID);
                            ?>
                                <a id="prevLink" href="<?php echo get_permalink($prev_post); ?>" rel="prev" data-image="<?php echo $prev_image; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/prev_arrow.png"></a>
                            <?php endif; ?>
                        </div>
                        <div class="next_photo_block">
                            <?php if (!empty($next_post)) :
                                $next_image = get_the_post_thumbnail_url($next_post->ID);
                            ?>
                                <a id="nextLink" href="<?php echo get_permalink($next_post); ?>" rel="next" data-image="<?php echo $next_image; ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/img/next_arrow.png"></a>
                            <?php endif; ?>

                        </div>
                    </div>
                </div><!-- .post_photo_navigation-->
            </section><!-- .section_post_contact -->

            <!-- Contact section display -->
            <section class="section_post_other_imgs">
                <div class="post_other_text">
                    <h3>Vous aimerez aussi</h3>
                </div>
                <article class="post_other_imgs_container">
                <?php
            $categorie = get_the_terms(get_the_ID(), 'categoriies');
            // Post per page
            $post_per_page = 2;
            // Argument definition
            $args = array(
                'orderby' => 'rand',
                'post_type' => 'photos',
                'posts_per_page' => $post_per_page,
                'paged' => 1,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'categoriies',
                        'field' => 'slug',
                        'terms' =>  (!empty($categorie)) ? $categorie[0]->slug : '',
                    ),
                ),
            );
            // Definition / Execution of wp-query
            $query = new WP_Query($args);
            // Execution loop of wp-query
            while ($query->have_posts()) : $query->the_post();
                $post_url = get_permalink();
            ?>
                        <!-- Template Post Card -->
                        <?php get_template_part('template-parts/photo_block'); ?>
                    <?php endwhile;
                    wp_reset_postdata() ?>
                </article>
            </section><!-- .section_post_other_imgs -->
        </main><!-- #main_single_photo_page -->
<?php endwhile;
endif; ?>

<?php get_footer(); ?>