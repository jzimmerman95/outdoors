<?php get_template_part("content", "nav");

if ( !is_user_logged_in() ) {
	wp_redirect( home_url());
	exit;
}

?>

<div class="upcoming-trips-bg">
	<h1 class="faq-title">Upcoming Trips</h1>
</div>

<?php 
	$childargs = array(
		'post_type' => 'trip',
		'meta_key'  => 'wpcf-start-date',
		'orderby'   => 'meta_value',
		'order' 	=> 'ASC',
		'meta_query'=> array(
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
			"Rock Climbing"			=> "/outdoors/wp-content/uploads/rockclimbing.jpg",
			"Water Sports"			=> "/outdoors/wp-content/uploads/kayaking.jpg",
			"Hiking / Backpacking"	=> "/outdoors/wp-content/uploads/hiking.jpg",
			"Caving" 				=> "/outdoors/wp-content/uploads/caving.jpg",
			"Volunteering" 			=> "/outdoors/wp-content/uploads/volunteering.jpg",
			"Horseback Riding" 		=> "/outdoors/wp-content/uploads/horsebackriding.jpg",
			"Snow Sports" 			=> "/outdoors/wp-content/uploads/snowboarding.jpg",
			"Biking" 				=> "/outdoors/wp-content/uploads/biking.jpg",
			"Other" 				=> "/outdoors/wp-content/uploads/skydiving.jpg",
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

	<?php if (!$loop->have_posts()): ?>
		<div class="trips-container">
			<h1 class="past-trips-h1" style="text-align: center;">There are No Upcoming Trips at This Time</h1>
		</div>
	<?php endif; ?>


	<?php 
		$childargs = array(
			'post_type'		=> 'trip',
			'meta_key'		=> 'wpcf-start-date',
			'orderby'		=> 'meta_value',
			'order' 		=> 'DESC',
			'posts_per_page' => 10,
			'meta_query'	=> array(
				array(
				'key'		=> 'wpcf-start-date',
				'compare'	=> '<',
				'value'		=> intval(strtotime(date('Y-m-d'))),
				'type'		=> 'numeric'
				)
			),
		);
		$loop = new WP_Query($childargs);
		$count = 0;
	?>

	<div class="trips-container">
		<h1 class="past-trips-h1">Past Trips</h1>
		<div class="green-rectangle" style="margin-left: 30px; margin-bottom: 30px; margin-top: 0;"></div>
		<table class="past-trips" style="width:100%">
			<tr>
				<th>Trip Title</th>
				<th>Location</th> 
				<th>Date</th>
			</tr>
			<?php while ($loop->have_posts()) : $loop->the_post();
				$trip_title = types_render_field("trip-title", array());
				$redirect_to = home_url() . "/index.php/trip/" . strtolower(preg_replace("/[\s_]/", "-", $trip_title));
			?>
				<tr>
					<td><a href="<?php echo $redirect_to; ?>"><?php echo $trip_title; ?></a></td>
					<td><?php echo types_render_field("trip-location", array());?></td> 
					<td><?php echo types_render_field("start-date", array()); ?></td>
				</tr>
			<?php endwhile; ?>
		</table>
		<a href="/outdoors/past-trips"><div class="view-past-trips">View All Past Trips</div></a>
	</div>

<?php get_footer(); ?>


