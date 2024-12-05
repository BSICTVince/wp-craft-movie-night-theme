<?php

/**

 * Title: Front page

 * Slug: front-page

 * Categories: Front -page

 * Description: This is the front page of the website

 * Keywords: banner, header, travel

 */



// Ensure WordPress is loaded

if (!defined('ABSPATH')) {

  exit; // Exit if accessed directly

}

// Include the custom header from parts/header.php
get_template_part('parts/header');

?>


<i title="Go to top" onclick="topFunction()" id="myBtn" class="fa fa-arrow-up" aria-hidden="true"></i>
<div class="container">

  <?php




  get_template_part('patterns/sidebar');

  get_template_part('patterns/search');

  get_template_part('patterns/search-results');




  ?>



</div>

<div class="">

  <?php
  // Include the custom header from parts/header.php
  locate_template('parts/footer.php', true);
  ?>

</div>