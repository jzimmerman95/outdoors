<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header();?>

<div class="sign-in-bg">
  <div class="sign-up-header-wrapper">
    <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" /><div class="sign-up-header">Welcome Back</div><img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" />
  </div>
  <div class="form-holder"><?php echo do_shortcode("[RM_Login]"); ?></div>
</div>



<?php get_footer(); ?>