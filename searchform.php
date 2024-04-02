<form class="form_search" action="<?php echo home_url('/'); ?>" method="get">
    <label for="search">Rechercher :</label>
    <input type="text" name="search" id="search" value="<?php the_search_query(); ?>" placeholder="rechercher..." />
    <input type="image" alt="Search" src="<?php bloginfo('template_url'); ?>/img/search.png" />
</form>