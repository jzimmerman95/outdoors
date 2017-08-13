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
    <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" /><div class="sign-up-header">Join Outdoors</div><img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" />
  </div>
  <?php 
    if(is_user_logged_in()) {
      echo 'You are currently logged in. Redirect to upcoming trips';
    }else {
      echo do_shortcode("[cr]");
    }
  ?>
</div>

<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<script src="https://unpkg.com/flatpickr"></script>


<script>
  flatpickr("#date", {altInput: true});
  var select = document.getElementsByName("Select_21")[0]
  select.firstChild.innerHTML = "Gender";
  select.firstChild.disabled = true;
  document.getElementsByName("password")[0].placeholder = "Password";
  document.getElementsByName("password_confirmation")[0].placeholder = "Confirm Password";
</script>

<?php get_footer(); ?>