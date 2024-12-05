<!DOCTYPE html>

<html lang="en-Ph">

<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="name" content="">

    <meta name="description" content="">

    <meta name="keywords" content="">

    <script src="https://apis.google.com/js/platform.js" async defer></script>

    <meta name="google-signin-client_id" content="457627350537-ppmu19lp8ruh3ogsbsnk6t8cfe1rqlkq.apps.googleusercontent.com">


    <?php
    
// Ensure WordPress is loaded

if (!defined(constant_name: 'ABSPATH')) {

    exit; // Exit if accessed directly

}
    wp_head();

    ?>
</head>

<style>
    body {
        height: 1200px;
        /* Make the body tall enough to allow scrolling */

    }

    .swiper {
        width: 100%;
        height: auto;
    }
    .swiper-slide{
        width: 18% !important;

    }
    .carousel-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 100%;
    }

    .carousel-card:hover {
        transform: scale(1.5);
        /* Slightly expand the card */
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        /* Add shadow effect */
        width: 150%;
        z-index: 3;
    }

    .swiper-wrapper {
        overflow: visible;
        justify-content: space-evenly;
        /* Allow expansion beyond the default card size */
    }

    .navigation ul li:hover {
        background-color: rgb(243 244 246);
    }

    .bg-color-f3f2f0 {
        background-color: rgb(243, 242, 240);
    }
</style>
