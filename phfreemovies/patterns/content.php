<?php

?>

<div id="content" class="content">

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