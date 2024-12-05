<?php
/* Template Name: register-form */
if ($_POST && !empty($_POST['username']) && !empty($_POST['password'])) {
    $userdata = array(
        'user_login' => $_POST['username'],
        'user_pass' => $_POST['password'],
        'user_email' => $_POST['email'],
        'role' => 'subscriber',
    );
    $user_id = wp_insert_user($userdata);

    if (!is_wp_error($user_id)) {
        echo '<p>Registration successful!</p>';
    } else {
        echo '<p>Error: ' . $user_id->get_error_message() . '</p>';
    }
}
get_header();
?>
<style>
    .custom-register-page {
    max-width: 400px;
    margin: 50px auto;
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
}
.custom-register-page form {
    text-align: left;
}

</style>
<div class="custom-register-page">
    <h2>Register</h2>
    <form method="post" action="">
        <p><label for="username">Username:</label>
        <input type="text" name="username" id="username" required></p>

        <p><label for="email">Email:</label>
        <input type="email" name="email" id="email" required></p>

        <p><label for="password">Password:</label>
        <input type="password" name="password" id="password" required></p>

        <p><input type="submit" value="Register"></p>
    </form>
</div>

<?php get_footer(); ?>
