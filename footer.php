<footer id="footer_menu" class="footer_menu">
    <?php get_template_part('template-parts/modale'); ?>
    <?php get_template_part('template-parts/lightbox'); ?>
    <?php wp_nav_menu(
        array(
            'theme_location' => 'footer',
            'container' => 'ul',
            'menu_class' => 'site__footer__menu',
        )
    ); ?>
    <!-- Mention texte -->
    <p class="footer_text">Tous droits réservés</p>
</footer>
<!-- id/class -->
<?php wp_footer(); ?>
</main><!-- classe main -->
</body>

</html>