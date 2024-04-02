<div class="photo_block" data-post-id="<?php echo get_the_ID(); ?>">
    <?php $post_url = get_permalink(); ?>
    <!-- Overlay Img -->
    <div class="photo_block_overlay">
        <a data-href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>" class="pic">
            <?php the_post_thumbnail(); ?>
        <div class="text_category"><?php the_terms( $post->ID, 'categoriies'); ?></div>
        <div class="text_reference"><?php the_field('reference'); ?></div>
        <div class="icon_eye">
            <a href="<?php echo $post_url; ?>" class="lightbox_trigger">
                <img src="<?php echo get_template_directory_uri() . '/assets/img/icon-eye.svg' ?>">  
            </a>
        </div>
        <?php $n1 = get_the_terms( $post->ID, 'categoriies');
        ?>
        <div class="icon_fullscreen" 
            data-title="<?php the_title(); ?>"
            data-image="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>"
            data-reference="<?php the_field('reference'); ?>"
            data-categoriies="<?php echo $n1[0]->name;?>">
            <img src="<?php echo get_template_directory_uri() . '/assets/img/Icon_fullscreen.png' ?>">
        </div>
        </a>
    </div>
</div>