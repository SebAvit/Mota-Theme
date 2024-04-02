<?php

/**
 * Enqueue Child Scripts.
 */
function child_enqueue_script()
{
    wp_enqueue_style('child-style', get_stylesheet_directory_uri() . '/sass/style.css', array(), 100);
    wp_enqueue_script('child-script', get_stylesheet_directory_uri() . '/js/main.js', array(), '0.0.1', true);
    wp_enqueue_script('post-navigation-script', get_stylesheet_directory_uri() . '/js/post-navigation.js', array(), '0.0.1', true);
    wp_enqueue_script('ajax-script', get_stylesheet_directory_uri() . '/js/ajax.js', array('jquery'), '1.0', true);
    wp_localize_script('ajax-script', 'my_ajax_object', array( 'ajaxurl' => admin_url('admin-ajax.php') ));

}
add_action('wp_enqueue_scripts', 'child_enqueue_script');

// Ajout des 2 menus
register_nav_menus(array(
    'main' => 'Menu Principal',
    'footer' => 'Bas de page',
));

// changement du HEADER et du menu CONTACT 
add_filter('wp_nav_menu_items', 'add_header_link', 10, 2);
function add_header_link($items, $args)
{
    if ($args->theme_location === 'main') {
        $new_item       = array('<li class="menu-item menu-item-23"><a href="#">CONTACT</a></li>');
        $items          = preg_replace('/<\/li>\s<li/', '</li>,<li',  $items);


        $array_items    = explode(
            ',',
            $items
        );
        array_splice($array_items, 2, 0, $new_item);
        $items          = implode(
            '',
            $array_items
        );
    }
    return $items;
}

/*
* La fonction pour créer notre custom post type 'Photos'
*/

function wpm_custom_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Photos', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Photos', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Photos'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Toutes les photos'),
		'view_item'           => __( 'Voir les photos'),
		'add_new_item'        => __( 'Ajouter une nouvelle photos'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer la photo'),
		'update_item'         => __( 'Modifier la photo'),
		'search_items'        => __( 'Rechercher une photo'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'photos'),
		'description'         => __( 'Tous sur les photos'),
		'labels'              => $labels,
        'menu_icon'      => 'dashicons-images-alt',
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
		'rewrite'			  => array( 'slug' => 'photos'),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "photos" et ses arguments
	register_post_type( 'photos', $args );

}

add_action( 'init', 'wpm_custom_post_type', 0 );

add_action( 'init', 'wpm_add_taxonomies', 0 );

//On crée 2 taxonomies personnalisées: Format et Catégorie.

function wpm_add_taxonomies() {
	
	// Taxonomie Format

	// On déclare ici les différentes dénominations de notre taxonomie qui seront affichées et utilisées dans l'administration de WordPress
	$labels_format = array(
		'name'              			=> _x( 'Formats', 'taxonomy general name'),
		'singular_name'     			=> _x( 'Format', 'taxonomy singular name'),
		'search_items'      			=> __( 'Chercher un format'),
		'all_items'        				=> __( 'Tous les formats'),
		'edit_item'         			=> __( 'Editer le format'),
		'update_item'       			=> __( 'Mettre à jour le format'),
		'add_new_item'     				=> __( 'Ajouter un nouveau format'),
		'new_item_name'     			=> __( 'Valeur du nouveau format'),
		'separate_items_with_commas'	=> __( 'Séparer les formats avec une virgule'),
		'menu_name'         => __( 'Format'),
	);

	$args_format = array(
	// Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une étiquette standard
		'hierarchical'      => true,
		'labels'            => $labels_format,
		'show_ui'           => true,
		'show_in_rest'      => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'formats' ),
	);

	register_taxonomy( 'formats', 'photos', $args_format );
	
	// Taxonomie Catégorie

	$labels_categorie = array(
		'name'                       => _x( 'Catégories', 'taxonomy general name'),
		'singular_name'              => _x( 'Catégories', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher une catégorie'),
		'popular_items'              => __( 'Catégories populaires'),
		'all_items'                  => __( 'Toutes les catégories'),
		'edit_item'                  => __( 'Editer une catégorie'),
		'update_item'                => __( 'Mettre à jour une catégorie'),
		'add_new_item'               => __( 'Ajouter une nouvelle catégorie'),
		'new_item_name'              => __( 'Nom de la nouvelle catégorie'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer une catégorie'),
		'choose_from_most_used'      => __( 'Choisir parmi les catégories les plus utilisées'),
		'not_found'                  => __( 'Pas de catégories trouvées'),
		'menu_name'                  => __( 'Catégories'),
	);

	$args_categorie = array(
	// Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
		'hierarchical'          => true,
		'labels'                => $labels_categorie,
		'show_ui'               => true,
		'show_in_rest'			=> true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'categoriies' ),
	);

	register_taxonomy( 'categoriies', 'photos', $args_categorie );
}

// Ajouter la prise en charge des images mises en avant
add_theme_support('post-thumbnails');

// Ajouter automatiquement le titre du site dans le header
add_theme_support('title-tag');

//
require_once get_template_directory() . '/inc/load_jquery_function.php';
require_once get_template_directory() . '/inc/load_ajax_function.php';
require_once get_template_directory() . '/inc/load_all_posts_function.php';
require_once get_template_directory() . '/inc/load_more_posts_function.php';
require_once get_template_directory() . '/inc/filtered_function.php';
require_once get_template_directory() . '/inc/reference_contact_function.php';


// Fonction pour filtrer les photos en fonction des catégories, formats et dates sélectionnés
add_action('wp_ajax_filter_photos', 'filter_photos');
add_action('wp_ajax_nopriv_filter_photos', 'filter_photos');

function filter_photos() {
    $categorie = isset($_POST['categorie']) ? $_POST['categorie'] : '';
    $format = isset($_POST['format']) ? $_POST['format'] : '';
    $date_order = isset($_POST['date']) ? $_POST['date'] : '';

    // Arguments pour la requête WP_Query
    $args = array(
        'post_type' => 'photos',
        'posts_per_page' => 8,
        'orderby' => ($date_order == '1') ? 'date' : 'date',
        'order' => ($date_order == '1') ? 'DESC' : 'ASC',
        'tax_query' => array(
            'relation' => 'AND', // Les conditions doivent être croisées
        ),
    );

    // Ajouter la taxonomie 'categoriies' si une catégorie est sélectionnée
    if (!empty($categorie)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'categoriies',
            'field'    => 'slug',
            'terms'    => $categorie,
        );
    }

    // Ajouter la taxonomie 'formats' si un format est sélectionné
    if (!empty($format)) {
        $args['tax_query'][] = array(
            'taxonomy' => 'formats',
            'field'    => 'slug',
            'terms'    => $format,
        );
    }

    // Exécution de la requête WP_Query
    $query = new WP_Query($args);

    // Boucle pour afficher les résultats
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();
            get_template_part('template-parts/photo_block');
        endwhile;
        wp_reset_postdata();
    } else {
        echo 'Aucune photo trouvée.';
    }

    die(); // Arrêter l'exécution pour éviter d'afficher le reste de la page
}
