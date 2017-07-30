<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header() ?>
<div class="sign-up-bg">
 <div class="sign-up-header-wrapper">
    <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" /><div class="sign-up-header">Join Outdoors</div><img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" /><br></br>

Welcome to Outdoors Club, <?php echo $_POST['first_name']; ?><br>
You are now signed up.

  </div>
  </div>


<?php


	$userdata = array(
	    'user_login'  =>  $_POST['email'],
	    'user_email'  =>  $_POST['email'],
	    'user_pass'   =>  $_POST['password'],
	    'first_name' => $_POST['first_name'],
	    'last_name' => $_POST['last_name'],
	    'description' => $_POST['phone']
);

		$user_id = wp_insert_user( $userdata ) ;

  		/**$email = $_POST['email'];
  		$password = $_POST['password'];
  		wp_create_user($email, $password, $email);
  		*/

get_footer(); ?>