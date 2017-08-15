<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header(); 
$current_user = wp_get_current_user();
?>

<nav class="menu-internal-menu-container">
  <ul id="menu-internal-menu" class="menu">
    <li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-140"><a href="http://localhost/outdoors/" class="menu-image-title-hide menu-image-not-hovered"><span class="menu-image-title">Home</span><img width="300" height="236" src="http://localhost/outdoors/wp-content/uploads/greenodclogo-300x236.png" class="menu-image menu-image-title-hide" alt="" srcset="http://localhost/outdoors/wp-content/uploads/greenodclogo-300x236.png 300w, http://localhost/outdoors/wp-content/uploads/greenodclogo-768x605.png 768w, http://localhost/outdoors/wp-content/uploads/greenodclogo-1024x806.png 1024w, http://localhost/outdoors/wp-content/uploads/greenodclogo-24x19.png 24w, http://localhost/outdoors/wp-content/uploads/greenodclogo-36x28.png 36w, http://localhost/outdoors/wp-content/uploads/greenodclogo-48x38.png 48w, http://localhost/outdoors/wp-content/uploads/greenodclogo.png 1529w" sizes="(max-width: 300px) 100vw, 300px"></a></li>
    <li id="menu-item-160" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-160"><a href="https://docs.google.com/spreadsheets/d/1Nzo6CtUZ9BhCNoYK61mex-eC4d5pXhmLTUdLJHdozpg/edit?usp=sharing" class="menu-image-title-after"><span class="menu-image-title">Gear Room</span></a></li>
    <li id="menu-item-159" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-159"><a href="http://localhost/outdoors/reports/" class="menu-image-title-after"><span class="menu-image-title">Reports</span></a></li>
    <li id="menu-item-158" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-158"><a href="http://localhost/outdoors/member-resources/" class="menu-image-title-after"><span class="menu-image-title">Member Resources</span></a></li>
    <li id="menu-item-157" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-157"><a href="http://localhost/outdoors/upcoming-trips/" class="menu-image-title-after"><span class="menu-image-title">Upcoming Trips</span></a></li>
    <li id="menu-item-139" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-137 current_page_item menu-item-139"><a href="http://localhost/outdoors/create-a-trip/" class="menu-image-title-after"><span class="menu-image-title">Create a Trip</span></a></li>
    <li id="menu-item-263" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-263"><a href="http://localhost/outdoors/profile/" class="menu-image-title-after"><span class="menu-image-title">Profile</span></a></li>
  </ul>
</nav>

<div class="profile-bg">
  <div class="prof-img">
    <img class="circle-img" src="<?php echo get_avatar_url(wp_get_current_user()->ID); ?>">
  </div>
  <h1><?php echo $current_user->user_firstname;?></h1>
  <h1><?php echo $current_user->user_lastname;?></h1>
</div>



<div class="trips-container">
  <h1 class="past-trips-h1">Upcoming Trips</h1>
</div>

<?php 
  $childargs = array(
    'post_type' => 'trip',
    'meta_key'  => 'wpcf-start-date',
    'orderby'   => 'meta_value',
    'order'   => 'ASC',
    'meta_query'=> array(
          array(
                'key'       => 'wpcf-start-date',
                'compare'   => '>=',
                'value'     => intval(strtotime(date('Y-m-d'))),
                'type'      => 'numeric'
          ),
          array(
                'key'       => 'wpcf-start-date',
                'compare'   => '>=',
                'value'     => intval(strtotime(date('Y-m-d'))),
                'type'      => 'numeric'
          )
      ),
  );
  $loop = new WP_Query($childargs);
  $count = 0;?>

  <div class="trips-container">

  <?php while ($loop->have_posts()) : $loop->the_post();
    $count+= 1;
    $start = date("h:ia", types_render_field("start-date", array('output' => 'raw'))); 
    $trip_title = types_render_field("trip-title", array());
    $redirect_to = home_url() . "?post_type=trip&p=" . get_the_ID();
    $trip_cat = types_render_field("trip-category", array());
    $pics = array(
      "Rock Climbing"     => "/outdoors/wp-content/uploads/rockclimbing.jpg",
      "Water Sports"      => "/outdoors/wp-content/uploads/kayaking.jpg",
      "Hiking / Backpacking"  => "/outdoors/wp-content/uploads/hiking.jpg",
      "Caving"        => "/outdoors/wp-content/uploads/caving.jpg",
      "Volunteering"      => "/outdoors/wp-content/uploads/volunteering.jpg",
      "Horseback Riding"    => "/outdoors/wp-content/uploads/horsebackriding.jpg",
      "Snow Sports"       => "/outdoors/wp-content/uploads/snowboarding.jpg",
      "Biking"        => "/outdoors/wp-content/uploads/biking.jpg",
      "Other"         => "/outdoors/wp-content/uploads/skydiving.jpg",
    ); ?>

    <div class="trip-wrapper">
      <a href="<?php echo $redirect_to; ?>"><div class="trip-img-holder" id="trip-<?php echo $count ?>"
      style="background: url(<?php echo $pics[$trip_cat]; ?>) no-repeat center center; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;">
      <h1><?php echo $trip_title; ?></h1>
      <h2><img class="location-logo" src="/outdoors/wp-content/uploads/location-white.png"/><?php echo types_render_field("trip-location", array());?></h2>
      <h3><?php echo types_render_field("start-date", array()) . ' at ' . $start; ?></h3>
      </div></a>
    </div>

    <?php if($count % 3 == 0) : ?>
      <div class="activity-desc" id="activity-desc-<?php echo ($count/3) ?>"></div>
      <span></span>
      <span></span>
    <?php endif; ?>

  <?php endwhile; ?>
  </div>







<?php get_footer(); ?>
