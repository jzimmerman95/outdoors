<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */

get_header();?>
<nav class="menu-internal-menu-container">
	<ul id="menu-internal-menu" class="menu">
		<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-140"><a href="http://localhost/outdoors/" class="menu-image-title-hide menu-image-not-hovered"><span class="menu-image-title">Home</span><img width="300" height="236" src="http://localhost/outdoors/wp-content/uploads/greenodclogo-300x236.png" class="menu-image menu-image-title-hide" alt="" srcset="http://localhost/outdoors/wp-content/uploads/greenodclogo-300x236.png 300w, http://localhost/outdoors/wp-content/uploads/greenodclogo-768x605.png 768w, http://localhost/outdoors/wp-content/uploads/greenodclogo-1024x806.png 1024w, http://localhost/outdoors/wp-content/uploads/greenodclogo-24x19.png 24w, http://localhost/outdoors/wp-content/uploads/greenodclogo-36x28.png 36w, http://localhost/outdoors/wp-content/uploads/greenodclogo-48x38.png 48w, http://localhost/outdoors/wp-content/uploads/greenodclogo.png 1529w" sizes="(max-width: 300px) 100vw, 300px"></a></li>
		<li id="menu-item-160" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-160"><a href="http://google.com" class="menu-image-title-after"><span class="menu-image-title">Gear Room</span></a></li>
		<li id="menu-item-159" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-159"><a href="http://localhost/outdoors/index.php/reports/" class="menu-image-title-after"><span class="menu-image-title">Reports</span></a></li>
		<li id="menu-item-158" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-158"><a href="http://localhost/outdoors/index.php/member-resources/" class="menu-image-title-after"><span class="menu-image-title">Member Resources</span></a></li>
		<li id="menu-item-157" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-157"><a href="http://localhost/outdoors/index.php/upcoming-trips/" class="menu-image-title-after"><span class="menu-image-title">Upcoming Trips</span></a></li>
		<li id="menu-item-139" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-137 current_page_item menu-item-139"><a href="http://localhost/outdoors/index.php/create-a-trip/" class="menu-image-title-after"><span class="menu-image-title">Create a Trip</span></a></li>
	</ul>
</nav>

<div class="upcoming-trips-bg">
	<h1 class="faq-title">Upcoming Trips</h1>
</div>


<?php 
  $childargs = array(
    'post_type' => 'trip',
 //    'orderby'   => 'meta_value_datetime',
	// 'meta_key'  => 'start-date',
  );
  $loop = new WP_Query($childargs);
  $count = 0;?>

  <div class="trips-container">

    <?php while ($loop->have_posts()) : $loop->the_post(); 
      $count+= 1;
	  $start = types_render_field("start-date", array()); ?>

      <div class="activity-wrapper">
        <div class="img-holder" id="trip-<?php echo $count ?>" onclick=""
        style="background: url(/outdoors/wp-content/uploads/13988107_10209049168179441_4985269252835363743_o-2.jpg) no-repeat center center; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;">
          <h1><?php echo types_render_field("trip-title", array()); ?></h1>
        </div>
      </div>

      <?php if($count % 3 == 0) : ?>
        <div class="activity-desc" id="activity-desc-<?php echo ($count/3) ?>"></div>
        <span></span>
        <span></span>
      <?php endif; ?>

    <?php endwhile; ?>
  </div>


<?php get_footer(); ?>

