<?php

/**

 * Title: Front page

 * Slug: front-page

 * Categories: Front -page

 * Description: This is the front page of the website

 * Keywords: banner, header, travel

 */




// Check if the user is logged in and has the 'subscriber' role or higher
if (!is_user_logged_in()) {
    // Redirect to the login page
    wp_redirect(wp_login_url(get_permalink()));
    exit;
} elseif (!current_user_can('read')) {
    // Show an error message if the user lacks the required role
    wp_die('You do not have permission to view this content. You must login to continue');
}

if (!current_user_can('edit_posts')) {
    wp_send_json_error(array('message' => 'Permission denied no edit access.'));
}

// Include the custom header from parts/header.php
get_template_part('parts/header');

?>

<style>
    .movie-custom-field iframe {
        border: none;
        /* Removes the default border */
        outline: none;
        /* Removes any focus outline */
    }

    .c-video_iframe {
        width: 1024px;
        height: 500px;

    }
</style>
<i title="Go to top" onclick="topFunction()" id="myBtn" class="fa fa-arrow-up" aria-hidden="true"></i>
<div class="container">

    <?php

    get_template_part('patterns/sidebar');

    get_template_part('patterns/search');

    ?>

    <div class="content">
        <div class="inner-container">

            <div class="video-container">
                <?php
                // Start the loop
                if (have_posts()):
                    while (have_posts()):
                        the_post();
                        $movie_id = get_the_ID();
                        $user_id = get_current_user_id();
                        $movie_id = get_the_ID();

                        // Fetch total likes and check if the current user has liked this movie
                        global $wpdb;
                        $table_name = $wpdb->prefix . 'movie_likes';
                        $like_count = $wpdb->get_var($wpdb->prepare(
                            "SELECT COUNT(*) FROM $table_name WHERE movie_id = %d",
                            $movie_id
                        ));

                        $already_liked = $wpdb->get_var($wpdb->prepare(
                            "SELECT COUNT(*) FROM $table_name WHERE movie_id = %d AND user_id = %d",
                            $movie_id,
                            $user_id
                        ));
                        ?>
                        <div class="c-container">

                            <h1 class="movie-title"><?php the_title(); ?></h1>
                            <div class="movie-meta">
                                <span class="movie-author"><?php the_author(); ?></span>
                                <span class="movie-date"><?php echo get_the_date(); ?></span>
                            </div>
                            <div class="movie-custom-field">
                                <?php
                                $embed_code = get_post_meta(get_the_ID(), '_movie_embed_code', true);
                                if ($embed_code) {
                                    echo '<div class="movie-embed">';
                                    echo '<iframe class="c-video_iframe" src="' . esc_url($embed_code) . '" frameborder="0" allow="autoplay; fullscreen; picture-in-picture; clipboard-write" title="Movie Embed"></iframe>';
                                    echo '</div>';
                                }
                                ?>
                            </div>
                            <div class="like-section">
                                <span class="like-count"><?php echo $like_count; ?> </span>
                                <span class="like-button fa fa-thumbs-up" data-movie-id="<?php echo esc_attr($movie_id); ?>"
                                    <?php if ($already_liked)
                                        echo 'disabled'; ?>>
                                    <?php echo $already_liked ? 'Liked' : 'Like'; ?>
                                </span>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else:
                    ?>
                    <p>No movies found.</p>
                    <?php
                endif;
                ?>
            </div>
        </div>




        <div class="inner-container">
            <div class="titles">
                <h1 id="most-rated">YOU MAY ALSO LIKE</h1>
                <h2>movies</h2>
            </div>
            <div class="item-container swiper">
                <div class="swiper-wrapper">
                    <?php
                    echo do_shortcode('[fmvph_ymal]');
                    ?>
                </div>
                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>

        <div class="inner-container">
        <div class="titles">
            <h1 id="top-10">NEW</h1>
            <h2>movies</h2>
        </div>
        <div class="item-container swiper-static">
            <div class="swiper-wrapper">
                <?php
                echo do_shortcode('[fmvph_new_movies]');
                ?>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <div class="inner-container">
        <div class="titles">
            <h1 id="top-10">TOP 10</h1>
            <h2>movies</h2>
        </div>
        <div class="item-container swiper-static">
            <div class="swiper-wrapper">
                <?php
                echo do_shortcode('[top_10]');
                ?>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>

    <div class="inner-container">
        <div class="titles">
            <h1 id="most-rated">TOP RATED</h1>
            <h2>movies</h2>
        </div>
        <div class="item-container swiper">
            <div class="swiper-wrapper">
                <?php
                echo do_shortcode('[top_movies_rated]');
                ?>
            </div>
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>




    </div>

    <div class="">

        <?php
        // Include the custom header from parts/header.php
        locate_template('parts/footer.php', true);
        ?>

    </div>