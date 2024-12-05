<?php

/*

/*

Theme Name:phfreemovies

Author: Vince Dazo

Author URI: http://vincedazo.epizy.com/

Theme URI: http://vincedazo.epizy.com/

Description: phfreemovies is a wordpress theme develop for business offering tour packages.

Tags: blog, one-column, two-columns, left-sidebar, right-sidebar, block-patterns, custom-background, custom-logo, custom-menu, featured-images, footer-widgets, full-site-editing,  threaded-comments, block-styles, wide-blocks, translation-ready

Text Domain: Dj travel

Requires at least: 6.0

Requires PHP: 7.4

Tested up to: 6.5

Version: 1.0.2



License: GNU General Public License v2 or later

License URI: 



/**

 * Functions and definitions

 *

 * @link

 *

 * @package DJtravel

 * @since 1.0.0

 */

 function fmvph_check_theme_update() {
    $theme = wp_get_theme();
    $current_version = $theme->get('Version');

    // URL to your GitHub repository's "releases/latest" API
    $remote_version_url = 'https://api.github.com/repos/yourusername/your-theme/releases/latest';
    $response = wp_remote_get($remote_version_url);

    if (is_wp_error($response)) {
        return; // Handle errors
    }

    $data = json_decode(wp_remote_retrieve_body($response), true);
    $latest_version = $data['tag_name']; // Adjust based on API response structure

    if (version_compare($current_version, $latest_version, '<')) {
        // Notify admin of a new update
        add_action('admin_notices', function () use ($latest_version) {
            echo '<div class="notice notice-info"><p>New theme version available: ' . esc_html($latest_version) . '</p></div>';
        });
    }
}
add_action('admin_init', 'fmvph_check_theme_update');


//Dynamic functions for meta tags


if (!function_exists('djtravelandtour_theme_metaTags')) {

    /**

     * Enqueue custom block stylesheets

     *

     * @since djtravelandtour theme 1.0

     * @return void

     */



    function phfreemovies_theme_metaTags()
    {

        //add dynamic title tag support

        add_theme_support('title-tag');

        add_theme_support('custom-logo');

        add_theme_support('post-thumbnails');

    }

    add_action('after_setup_theme', 'phfreemovies_theme_metaTags');

}



if (!function_exists('phfreemovies_themes')) {

    // Register style sheet and js scripts including Google font-style scripts
    function enqueue_theme_styles()
    {
        // Get CSS version dynamically
        $version = wp_get_theme()->get('Version');

        // Registering CSS style
        wp_enqueue_style('phfreemovies-theme', get_template_directory_uri() . "/css/theme.css", [], $version, 'all');
        wp_enqueue_style('phfreemovies-style', get_template_directory_uri() . "/css/style.css", [], $version, 'all');
        wp_enqueue_style('googleapis-style', "https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700");
        wp_enqueue_style('bootstrapcdn-style', "https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css");
        
        // Registering CSS style for swiper
        wp_enqueue_style('swiper-style', "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css");
        wp_enqueue_style('swiper_override-style', get_template_directory_uri() . "/css/swiper.css", [], $version, 'all');
        wp_enqueue_style('swiper_static-style', get_template_directory_uri() . "/css/swiper-static.css", [], $version, 'all');



    }

    add_action('wp_enqueue_scripts', 'enqueue_theme_styles');




    function enqueue_theme_scripts()
    {
        // Enqueue scripts for swiper
        wp_enqueue_script('phfreemovies', "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js",'swiper-scripts', true);

        wp_enqueue_script('swiper-scripts', get_template_directory_uri() . "/js/swiper.js",[] ,null, true);

        wp_enqueue_script('like-button-script', get_template_directory_uri() . '/js/like-button.js', array('jquery'), null, true);
        
        wp_localize_script('like-button-script', 'ajaxurl', admin_url('admin-ajax.php'));

    }
    add_action('wp_enqueue_scripts', 'enqueue_theme_scripts');

}


function create_movie_post_type()
{
    $args = array(
        'labels' => array(
            'name' => 'Movies',
            'singular_name' => 'Movie',
            'add_new' => 'Add New',
            'add_new_item' => 'Add New Movie',
            'edit_item' => 'Edit Movie',
            'new_item' => 'New Movie',
            'view_item' => 'View Movie',
            'search_items' => 'Search Movies',
            'not_found' => 'No movies found',
            'not_found_in_trash' => 'No movies found in Trash',
            'all_items' => 'All Movies',
            'menu_name' => 'Movies',
            'name_admin_bar' => 'Movie',
        ),
        'public' => true,
        'has_archive' => true,
        'show_in_rest' => false, // Enable Gutenberg support
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields', 'excerpt', 'comments'),
        'menu_icon' => 'dashicons-format-video', // Icon for the Movies menu
        'rewrite' => array('slug' => 'movies'),
    );

    register_post_type('movie', $args);
}

add_action('init', 'create_movie_post_type');

function create_movie_taxonomy()
{
    $args = array(
        'hierarchical' => true, // Set to true for categories-like behavior
        'labels' => array(
            'name' => 'Categories',
            'singular_name' => 'Category',
            'search_items' => 'Search Categories',
            'all_items' => 'All Categories',
            'parent_item' => 'Parent Category',
            'parent_item_colon' => 'Parent Category:',
            'edit_item' => 'Edit Category',
            'update_item' => 'Update Category',
            'add_new_item' => 'Add New Category',
            'new_item_name' => 'New Category Name',
            'menu_name' => 'Categories',
        ),
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'categories'),
        'show_in_rest' => true, // Enable Gutenberg support for taxonomy
    );

    // Register the custom taxonomy for the 'movie' post type
    register_taxonomy('movie_category', array('movie'), $args);
}

add_action('init', 'create_movie_taxonomy');


// 1. Register a Custom Meta Box
function add_movie_embed_meta_box()
{
    add_meta_box(
        'movie_embed_meta_box',            // Unique ID
        'Movie Embed Code',                // Title
        'render_movie_embed_meta_box',     // Callback function to display the field
        'movie',                           // Post type
        'normal',                          // Context (normal, side, or advanced)
        'high'                             // Priority
    );
}
add_action('add_meta_boxes', 'add_movie_embed_meta_box');


// 2. Render the Field in the Meta Box
function render_movie_embed_meta_box($post)
{
    // Add a nonce field for verification
    wp_nonce_field('save_movie_embed_code_nonce', 'movie_embed_nonce');

    // Retrieve existing value
    $movie_embed_code = get_post_meta($post->ID, '_movie_embed_code', true);

    // Output the input field
    echo '<label for="movie_embed_code">Paste your embed code for mega drive:</label>';
    echo '<input type="text" name="movie_embed_code" id="movie_embed_code" value="' . esc_attr($movie_embed_code) . '" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" style="position:absolute;top:0;left:0;width:100%;height:100%;">';
}




// 3. Save the Custom Field Value
function save_movie_embed_code($post_id)
{
    // Check if the nonce is set
    if (!isset($_POST['movie_embed_nonce'])) {
        return;
    }

    // Verify the nonce
    if (!wp_verify_nonce($_POST['movie_embed_nonce'], 'save_movie_embed_code_nonce')) {
        return;
    }

    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save the field value
    if (isset($_POST['movie_embed_code'])) {
        $embed_code = sanitize_textarea_field($_POST['movie_embed_code']);
        update_post_meta($post_id, '_movie_embed_code', $embed_code);
    }
}
add_action('save_post', 'save_movie_embed_code');





// To ensure the correct template is being loaded and to be use only by single-movie.php
add_filter('template_include', function ($template) {
    if (is_singular('movie')) {
        $custom_template = locate_template('single-movie.php');
        if ($custom_template) {
            return $custom_template;
        }
    }
    return $template;
});


// Customize the login logo
function custom_login_styles()
{
    wp_enqueue_style('wp_override-style', get_stylesheet_directory_uri() . "/css/wp_override.css");

    echo '<style type="text/css">
        #login h1 a {
            background-image: url(' . get_template_directory_uri() . '/assets/logo.png); 
            background-size: contain; 
            width: 100%; 
            height: 80px;
        }
        
    </style>';
}
add_action('login_head', 'custom_login_styles');

// Change the login logo URL
function custom_login_logo_url()
{
    return home_url();
}
add_filter('login_headerurl', 'custom_login_logo_url');

// Change the login logo title
function custom_login_logo_url_title()
{
    return 'Welcome to My Custom Site!';
}
add_filter('login_headertitle', 'custom_login_logo_url_title');


// disable the WordPress admin bar for subscribers
function disable_admin_bar_for_subscribers()
{
    if (is_user_logged_in() && current_user_can('subscriber')) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'disable_admin_bar_for_subscribers');

// Replace 'profile' with the slug of your profile page
$profile_url = get_permalink(get_page_by_path('profile'));



