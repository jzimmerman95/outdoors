<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header();?>

<div class="sign-up-bg">
  <div class="sign-up-header-wrapper">
<<<<<<< HEAD
    <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" /><div class="sign-up-header">Join Outdoors</div><img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" />
  </div>
  <div class="form-holder"><?php echo do_shortcode("[RM_Form id='3']"); ?></div>
</div>




<script>
  var select = document.getElementsByName("Select_21")[0]
=======
    <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" /><div class="sign-up-header">Join Outdoors</div><img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" /><br></br>
  </div>
  <!--<div class="form-holder"><?php echo do_shortcode("[RM_Form id='3']"); ?></div>-->

<div class="form-wrapper">
<form class="sign-up-form" method="post" action="http://localhost/outdoors/index.php/submit-sign-up">
<div class="two_input_section">
      <div class="input-title">First Name</div>
      <input class="first_input" type="text" name="first_name" required><br>
    </div><div class="two_input_section">
      <div class="input-title">Last Name</div>
      <input type="text" name="last_name" required><br>
    </div>

<div class="two_input_section">
      <div class="input-title">Email</div>
      <input class="first_input" type="text" name="email" required><br>
    </div><div class="two_input_section">
      <div class="input-title">Phone</div>
      <input type="text" name="phone" required><br>
    </div>

 <div class="two_input_section">
      <div class="input-title">Birthday</div>
      <input class="first_input" type="text" id="date" name="birthday" required><br>
      </div><div class="two_input_section">
      <div class="input-title">Gender</div>
      <select name="gender" required>
        <option value="volvo">Female</option>
  		<option value="saab">Male</option></select><br>
    </div>

<!--
Figure out drop down menu for Gender
-->

<div class="two_input_section">
      <div class="input-title">Password</div>
      <input class="first_input" type="text" name="password" required><br>
    </div><div class="two_input_section">
      <div class="input-title">Confirm Password</div>
      <input type="text" name="confirm_password" required><br>
    </div>
   <input type="submit" value="Submit">
</form>
</div>

<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<script src="https://unpkg.com/flatpickr"></script>


<script>
  flatpickr("#date", {altInput: true});

  <?php

  ?>

  /**var select = document.getElementsByName("Select_21")[0]
>>>>>>> a8f942f211898a50cb3660e39caa7057dec37f5f
  select.firstChild.innerHTML = "Gender";
  select.firstChild.disabled = true;
  document.getElementsByName("password")[0].placeholder = "Password";
  document.getElementsByName("password_confirmation")[0].placeholder = "Confirm Password";
<<<<<<< HEAD
=======
  */
>>>>>>> a8f942f211898a50cb3660e39caa7057dec37f5f
</script>

<?php get_footer(); ?>