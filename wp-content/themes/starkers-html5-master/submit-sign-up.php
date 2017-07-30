<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header() ?>

 <div class="sign-up-header-wrapper">
    <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" /><div class="sign-up-header">Join Outdoors</div><img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" /><br></br>
  </div>

Welcome to Outdoors Club, <?php echo $_POST['first_name']; ?><br>
You are now signed up.
<?php
  		$email = $_POST['email'];
  		$password = $_POST['password'];
  		wp_create_user($email, $password, $email);

get_footer(); ?>