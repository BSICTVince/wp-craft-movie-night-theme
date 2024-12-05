<?php
?>
<style>
  .sidebar {
    position: sticky;
    top: 0;
    /* Adjust as per your layout needs */
    height: fit-content;
    /* Ensure sidebar doesn't expand unnecessarily */
    padding: 10px;
    /* Optional: Add some padding for better styling */
    background-color: #f9f9f9;
    /* Optional: Give it a background */
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    /* Optional: Add a shadow for aesthetics */
  }


  /* style.css */
  /* The switch container */
  body .dark-mode{
    color: #ffffff !important;
  }
  .dark-mode{
  background-color: #121212;
  color:#ffffff !important;

}
.dark-mode-sidebar .dark-mode div a{

  background-color: #121212;
  color:#ffffff !important;

}
  .dark-mode-sidebar {
    background-color: #000000;
    color: #ffffff !important;
  }

  .switch {
    position: relative;
    display: inline-block;
    width: 50px;
    height: 25px;
  }

  /* Hide the default checkbox */
  .switch input {
    opacity: 0;
    width: 0;
    height: 0;
  }

  /* The slider */
  .slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 25px;
  }

  .slider:before {
    position: absolute;
    content: "";
    height: 19px;
    width: 19px;
    left: 3px;
    bottom: 3px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
  }

  /* When checked, change the slider */
  input:checked+.slider {
    background-color: #4caf50;
  }

  input:checked+.slider:before {
    transform: translateX(24px);
  }

.nsl-button-label-container {
    font-size: 13px !important;

}

  /* For better compatibility on smaller devices */
  @media (max-width: 768px) {
    .sidebar {
      position: static;
      /* Remove sticky behavior on small screens */
    }
  }
</style>
<div id="sidebar" class="sidebar">
  <div class="sidebar-container">
    <a class="logo-link" href="<?php echo home_url(); ?>">
      <img src="<?php echo get_template_directory_uri() . '/assets/logo.png'; ?>" class="logo-image" />

    </a>

    <div class="theme-toggle">
      <label class="switch">
        <input type="checkbox" id="dark-mode-toggle">
        <span class="slider round"></span>
      </label>
    </div>

    <h2 class="title-genre">Discover</h2>
    <a class="category-link " href="#new">
      <div class="genre">NEW</div>
    </a>
    <a class="category-link" href="#top-10">
      <div class="genre">TOP 10</div>
    </a>
    <a class="category-link" href="#most-rated">
      <div class="genre">MOST RATED</div>
    </a>

    <a class="category-link" href="/vivamax">
      <div class="genre">VIVAMAX</div>
    </a>

    <a class="category-link" href="/netflix">
      <div class="genre">NETFLIX</div>
    </a>
    <a class="category-link" href="<?php echo home_url(); ?>/disney">
      <div class="genre">DESNIY</div>
    </a>
    <h2 class="title-genre">ALL GENRE</h2>

    <?php
    // Get terms from the movie_category taxonomy
    $terms = get_terms(array(
      'taxonomy' => 'movie_category', // Your custom taxonomy
      'orderby' => 'name',            // Order terms alphabetically (you can change this)
      'order' => 'ASC',               // Order in ascending order
      'hide_empty' => false           // Show even empty terms
    ));

    // Define an array of slugs to exclude
    $excluded_slugs = array('top-10', 'new', 'most-rated', 'vivamax', 'neflix', 'disney'); // Example: exclude categories with these slugs
    
    // Check if there are any terms
    if (!empty($terms) && !is_wp_error($terms)) {
      foreach ($terms as $term) {
        // Skip excluded terms by slug
        if (in_array($term->slug, $excluded_slugs)) {
          continue;
        }

        // Check if this term is the active one
        $is_active = isset($current_term) && $current_term->term_id === $term->term_id;

        // Add the "current" class if this is the active term
        $class = $is_active ? 'category-link current' : 'category-link';

        // Display each term as a link
        echo '<a class="' . esc_attr($class) . '" href="' . esc_url(get_term_link($term)) . '">';
        echo '<div class="genre">' . esc_html($term->name) . '</div>';
        echo '</a>';
      }
    } else {
      echo '<p>No genres available.</p>';
    }
    ?>

    <?php if (is_user_logged_in()): ?>

      <a class="category-link" href="<?php esc_url(admin_url('profile.php')) ?>">
        <div class="genre">Profile</div>
      </a>

      <a class="category-link" href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
        <div class="genre">Sign Out</div>
      </a>

      

    <?php endif; ?>
    <?php echo do_shortcode('[nextend_social_login]');?>

    <a target="_blank" rel="noopener noreferrer" href="#" onclick="window.open('https://ko-fi.com/vincenzopiromalli')"
      class="coffee">
      <img src="https://imgur.com/Hnxhk0P.png" alt="Help me by donating" width="20" />
      <span style="margin-left: 5px">Donate Now</span>
    </a>






  </div>

</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const body = document.body; // Ensure body is defined
    const sidebar = document.getElementById('sidebar'); // Ensure sidebar exists in your HTML
    const content = document.getElementById('content'); // Ensure content exists in your HTML

    // Check local storage for user preference
    if (localStorage.getItem('dark-mode') === 'enabled') {
      body.classList.add('dark-mode');
      sidebar.classList.add('dark-mode-sidebar'); // Add dark mode class to sidebar
      content.classList.add('dark-mode'); // Add dark mode class to content
      toggleButton.checked = true; // Ensure the toggle reflects the dark mode state
    }

    toggleButton.addEventListener('change', function () {
      if (toggleButton.checked) {
        body.classList.add('dark-mode');
        sidebar.classList.add('dark-mode-sidebar'); // Add dark mode to sidebar
        content.classList.add('dark-mode'); // Add dark mode to content
        localStorage.setItem('dark-mode', 'enabled'); // Save user preference
      } else {
        body.classList.remove('dark-mode');
        sidebar.classList.remove('dark-mode-sidebar'); // Remove dark mode from sidebar
        content.classList.remove('dark-mode'); // Remove dark mode from content
        localStorage.setItem('dark-mode', 'disabled'); // Save user preference
      }
    });
  });
</script>

