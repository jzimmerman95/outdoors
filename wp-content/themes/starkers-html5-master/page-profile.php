<?php get_template_part("content", "nav");

if ( !is_user_logged_in() ) {
  wp_redirect( home_url());
  exit;
}
$current_user = wp_get_current_user();
?>

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
