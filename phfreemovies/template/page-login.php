<?php
/* Template Name: login-form */
get_header();
?>
<style>
   .custom-login-page {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}
.custom-login-page h2 {
    margin-bottom: 20px;
}
 
</style>

<div class="custom-login-page">
    <h2>Login</h2>
    <?php
    // Display the login form
    wp_login_form(array(
        'redirect' => home_url(), // Redirect after login
        'label_username' => 'Your Username',
        'label_password' => 'Your Password',
        'label_remember' => 'Stay Signed In',
        'label_log_in' => 'Sign In',
    ));
    ?>
</div>

<?php get_footer(); ?>

