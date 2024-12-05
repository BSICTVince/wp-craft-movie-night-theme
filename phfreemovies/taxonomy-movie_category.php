<?php
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

 get_template_part('patterns/movie-taxonomy-template');




  ?>



</div>

<div class="">

  <?php
  // Include the custom header from parts/header.php
  locate_template('parts/footer.php', true);
  ?>

</div>