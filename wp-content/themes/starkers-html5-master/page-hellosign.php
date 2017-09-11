<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header();

$redirect_to = home_url() . '/upcoming-trips';
?>

<div class="sign-up-bg">
  <div class="membership-dues">Outdoors Club Liability Waiver</div>
  <div class="waiver-text">All Outdoors Club members must sign a liability waiver before attending trips. Please go to the following link to sign the waiver electronically (via HelloSign) before clicking done.</div>
  <div class="sign-waiver-btn"><a href="https://www.hellosign.com/s/c101b9bb">Sign Waiver</a></div>
  <div class="sign-waiver-btn"><a href="<?php echo $redirect_to; ?>">Done</a></div>
</div>

<?php get_footer(); ?>