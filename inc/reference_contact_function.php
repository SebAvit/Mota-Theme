<?php
/**
 * Get Reference Contact Form 
 */
add_filter('wpcf7_form_tag', function ($tag) {
    $name = is_object($tag) ? $tag->name : $tag['name'];

    if ('reference' === $name) {
        global $post;
        $reference_value = get_post_meta($post->ID, 'reference', true); 

        if ($reference_value) {
            if (is_object($tag)) {
                $tag->values = array($reference_value);
            } elseif (is_array($tag)) {
                $tag['values'] = array($reference_value);
            }
        }
    }
    return $tag;
});
?>