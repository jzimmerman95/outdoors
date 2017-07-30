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
  'post_type' => 'homepage-field',
);
$loop = new WP_Query($childargs);
while ($loop->have_posts()) : $loop->the_post();

$image = types_render_field("background-image", array('output' => 'raw' ));
$video = types_render_field("background-video", array('output' => 'raw')); ?>

<div class="home-img">
  <video playsinline autoplay muted poster="<?php echo $image ?>" id="bgvid" onended="loopMainVideo()">
<!--     <source src="polina.webm" type="video/webm">
 -->    <source src="<?php echo $video?>" type="video/mp4">
  </video>
  <img src="/outdoors/wp-content/uploads/mute.png" class="mute" id="mute" onclick="toggleMute()" />
  <div class="home-text" id="home-text">
    <div class="get-outside">
      <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" />
      <p><?php echo types_render_field("first-little-header", array()); ?></p>
      <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" />
    </div>
    <h1><?php echo types_render_field("main-header", array( )); ?></h1>
    <div class="at-uva"><?php echo types_render_field("second-little-header", array()); ?></div>
  </div>
  <img class="about-mtn" id="about-mtn" src="/outdoors/wp-content/uploads/mtnrange.svg" />
</div>

<div class="about">
  <img class="about-logo" src="/outdoors/wp-content/uploads/mtn-logo-e1493605403938.png" />
  <h1><?php echo types_render_field("about-header", array( )); ?></h1>
  <div class="green-rectangle"></div>
  <div class="about-text"><?php echo types_render_field("about-us-text", array()); ?></div>
</div>

<div class="mission">
  <img class="mission-bg" src="/outdoors/wp-content/uploads/mission-bg-2-e1493654417841.png" />
  <img class="mission-logo" src="/outdoors/wp-content/uploads/compass.png" />
  <h1><?php echo types_render_field("mission-header", array( )); ?></h1>
  <div class="mission-text"><?php echo types_render_field("mission-text", array( )); ?></div>
</div>

<div class="how-it-works">
  <h1><?php echo types_render_field("how-the-club-works", array( )); ?></h1>
  <div class="green-rectangle" style="margin-top: 20px; margin-left: 0;"></div>

  <div class="how-it-works-row">
    <div class="join-left">
      <div class="how-it-works-smallH"><?php echo types_render_field("join-the-club", array( )); ?></div>
      <div class="how-text"><?php echo types_render_field("join-the-club-text", array( )); ?></div>
    </div>
    <div class="join-right">
      <img class="how-logo" src="/outdoors/wp-content/uploads/join.png" />
    </div>
  </div>

  <div class="how-it-works-row">
    <div class="participate-left">
        <img class="how-logo" src="/outdoors/wp-content/uploads/participate.png" />
    </div>
    <div class="participate-right">
      <div class="how-it-works-smallH right-align"><?php echo types_render_field("participate", array( )); ?></div>
      <div class="how-text right-align"><?php echo types_render_field("participate-text", array( )); ?></div>
    </div>
  </div>

  <div class="how-it-works-row">
    <div class="join-left">
      <div class="how-it-works-smallH"><?php echo types_render_field("lead-adventures", array( )); ?></div>
      <div class="how-text"><?php echo types_render_field("lead-adventures-text", array( )); ?></div>
    </div>
    <div class="join-right">
      <img class="how-logo" src="/outdoors/wp-content/uploads/lead.png" />
    </div>
  </div>

</div>

<div class="activities">
  <img class="mission-bg" src="/outdoors/wp-content/uploads/activities-e1493654850286.png" />
  <img class="activities-logo" src="/outdoors/wp-content/uploads/activities-logo.png" />
  <h1><?php echo types_render_field("activities-title", array( )); ?></h1>
</div>

<?php 

$joinTitle = types_render_field("join-title", array());
$joinText = types_render_field("join-text", array());

endwhile; ?>

<?php 
  $childargs = array(
    'post_type' => 'activity',
    'order' => 'ASC',
  );
  $loop = new WP_Query($childargs);
  $count = 0;?>

  <div class="activities-container">

    <?php while ($loop->have_posts()) : $loop->the_post(); 
      $count+= 1;
      $desc = types_render_field("activity-description", array( )); ?>

      <div id="activity-text-<?php echo $count ?>" style="display: none;"><?php echo $desc ?></div>

      <div class="activity-wrapper">
        <div class="img-holder" id="activity-<?php echo $count ?>" onclick="showActivityDesc(event)"
        style="background: url(<?php echo types_render_field("activity-image", array('output' => 'raw')); ?>) no-repeat center center; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;">
          <h1><?php echo types_render_field("activity-title", array()); ?></h1>
        </div>
      </div>

      <?php if($count % 3 == 0) : ?>
        <div class="activity-desc" id="activity-desc-<?php echo ($count/3) ?>"></div>
        <span></span>
        <span></span>
      <?php endif; ?>

    <?php endwhile; ?>
  </div>

  <div class="join">
    <img class="join-bg" src="/outdoors/wp-content/uploads/green-mtn-e1494529613974.png" />
    <img class="join-logo" src="/outdoors/wp-content/uploads/clipboard.png" />
    <h1><?php echo $joinTitle ?></h1>
    <div class="black-rectangle"></div>
    <div class="join-text"><?php echo $joinText ?></div>
    <a href="/outdoors/index.php/sign-up/"><div class="join-btn">SIGN UP</div></a>
    <img class="join-trees" src="/outdoors/wp-content/uploads/white-trees.png" />
  </div>










<?php get_footer(); ?>
