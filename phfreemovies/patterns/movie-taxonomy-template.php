<?php
// Get the current term
$term = get_queried_object();
global $wpdb;

// Define the likes table
$likes_table = $wpdb->prefix . 'movie_likes';

// Query to get the top 10 movies with the most likes
$top_movies = $wpdb->get_results("
        SELECT p.ID, p.post_title, COUNT(l.id) AS like_count
        FROM {$wpdb->posts} AS p
        INNER JOIN {$likes_table} AS l ON p.ID = l.movie_id
        WHERE p.post_type = 'movie' AND p.post_status = 'publish'
        GROUP BY p.ID
        ORDER BY  RAND()
        LIMIT 10
    ");
?>



<div class="content">

    <div class="inner-container">
        <div class="titles">
            <h1><?php single_term_title(); ?></h1>
            <h2>movies</h2>
        </div>



        <div class="item-container">

            <?php
            // Query for movies in this category
            $args = array(
                'post_type' => 'movie',  // Custom post type 'movie'
                'tax_query' => array(
                    array(
                        'taxonomy' => 'movie_category',  // Taxonomy name
                        'field' => 'id',
                        'terms' => $term->term_id,  // The current term ID
                    ),
                ),
            );

            $movies_query = new WP_Query($args);

            if ($movies_query->have_posts()):
                while ($movies_query->have_posts()):
                    $movies_query->the_post();
                    // Display each movie
                    ?>
                    <a class="item link movies" href="<?php the_permalink(); ?>">
                        <div class="item-inner">

                            <img class="image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                                width="100%" />
                            <h2 class="item-title"><?php the_title(); ?></h2>
                            <p><?php the_excerpt(); ?></p>
                            <span class="rating"><i class="fa fa-star" aria-hidden="true"></i></span>

                        </div>
                    </a>
                    <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p>No movies found in this category.</p>';
            endif;
            ?>



        </div>

    </div>




    <div class="item-container swiper">
        <div class="titles">
            <h1 id="new">NEW</h1>
            <h2>movies</h2>
        </div>
        <div class="swiper-wrapper">
            <?php
            // Replace 123 with the term ID for the "new-movie" category
            $new_movie_category_slug = "new-movies";
            $args = array(
                'post_type' => 'movie', // Custom post type
                'tax_query' => array(
                    array(
                        'taxonomy' => 'movie_category', // The taxonomy associated with the category
                        'field' => 'slug', // Filter using slug
                        'terms' => $new_movie_category_slug, // The specific slug ID
                    ),
                ),
            );


            $new_movie_query = new WP_Query($args);
            if ($new_movie_query->have_posts()) {

                while ($new_movie_query->have_posts()) {
                    $new_movie_query->the_post();
                    ?>


                    <div class="swiper-slide">
                        <a class="item link movies" href="<?php the_permalink(); ?>">
                            <div class="item-inner">

                                <img class="image" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"
                                    width="100%" />
                                <h2 class="item-title"><?php the_title(); ?></h2>
                                <p><?php the_excerpt(); ?></p>
                                <span class="rating">
                                    <i class="fa fa-star" aria-hidden="true"></i> <?php echo esc_html($movie->like_count); ?>
                                </span>
                            </div>
                        </a>
                    </div>



                    <?php
                }

            } else {
                echo '<p>No movies found for this category.</p>';
            }

            // Reset Post Data
            wp_reset_postdata();
            ?>
        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <!-- If we need scrollbar -->
        <!-- <div class="swiper-scrollbar"></div> -->

    </div>
</div>