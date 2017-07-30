<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header();

$childargs = array(
  'post_type' => 'contact-us-page',
);
$loop = new WP_Query($childargs);
while ($loop->have_posts()) : $loop->the_post();?>

<div class="contact-bg">
  <h1>Contact Us</h1>
</div>

<div class="contact-form-wrapper">
  <img class="contact-logo" src="/outdoors/wp-content/uploads/contactlogo.png" />
  <h1><?php echo types_render_field("contact-form-title", array( )); ?></h1>
  <div class="green-rectangle" style="margin: 0; margin-top: 30px; margin-bottom: 50px;"></div>
  <div class="contact-left">
    <img class="contact-form-logo" src="/outdoors/wp-content/uploads/emaillogo.png" />
    <div class="contact-email"><?php echo types_render_field("contact-email", array( )); ?></div>
    <br>
    <img class="contact-form-logo" src="/outdoors/wp-content/uploads/locationlogo.png" style="margin-top: 20px; padding-bottom: 55px;" />
    <div class="contact-address"><?php echo types_render_field("contact-address", array( )); ?></div>
  </div>
  <div class="contact-right">
    <form class="contact-form">
      <div class="name">Name</div>
      <input type="text" name="name"><br>
      <div class="contact_section">
        <div class="email">Email</div>
        <input class="first_input" type="text" name="email"><br>
      </div><div class="contact_section">
        <div class="phone">Phone</div>
        <input type="text" name="phone"><br>
      </div>
      <div class="message">Message</div>
      <textarea name="message"></textarea><br>
      <input type="submit" value="Send">
    </form>
  </div>
</div>

<div class="officers">
  <img class="officers-bg" src="/outdoors/wp-content/uploads/leaders-mtn.png" />
  <h1><?php echo types_render_field("contact-officers-title", array( )); ?></h1>
</div>

<?php endwhile; 

$childargs = array(
  'post_type' => 'officer',
  'order' => 'ASC',
);
$loop = new WP_Query($childargs);
$count = 0;?>

<div class="officers-container">

<?php while ($loop->have_posts()) : $loop->the_post();
  $count+= 1;?>
  <div class="officer-holder">
    <div class="officer" id="officer-<?php echo $count ?>"
      style="background: url(<?php echo types_render_field("headshot", array('output' => 'raw')); ?>) no-repeat center center; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;"></div>
    <h1 class="officer-name"><?php echo types_render_field("name", array()); ?></h1>
    <div class="officer-title"><?php echo types_render_field("title", array()); ?></div>
    <div class="officer-email"><span style="font-family: GothamBold;">Email: </span><?php echo types_render_field("email", array()); ?></div>
    <div class="officer-bio"><?php echo types_render_field("bio", array()); ?></div>
  </div>
<?php endwhile; ?>

</div>
<?php get_footer(); ?>
