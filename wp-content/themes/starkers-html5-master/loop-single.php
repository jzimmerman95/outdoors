<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="trip-bg">
				<h1 class="faq-title"><?php echo types_render_field( "trip-title", array()); ?></h1>
			</div>

			<?php $start_date = date("h:ia", types_render_field( "start-date", array('output' => 'raw')));
			$end_date = date("h:ia", types_render_field( "end-date", array('output' => 'raw')));
			$signupby = date("h:ia", types_render_field( "sign-up-by", array('output' => 'raw')));?>
			
			<div class="trip-container">
				<div class="trip-col-container">
					<div class="trip-left-col">
						<div class="join-trip">+ Join Trip</div>
						<div class="trip-details">
							<div class="trip-detail-title">Details</div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Where: </span><?php echo types_render_field( "trip-location", array()); ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Depart From: </span><?php echo types_render_field( "depart-from", array()); ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Start: </span><?php echo types_render_field( "start-date", array()) . ' at ' . $start_date; ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">End: </span><?php echo types_render_field( "end-date", array()) . ' at ' . $end_date; ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Sign-up By: </span><?php echo types_render_field( "sign-up-by", array()) . ' at ' . $signupby; ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Fee: </span>$<?php echo types_render_field( "fee", array()); ?></div>
						</div>
						<div class="trip-leader">
							<div class="trip-detail-title">Trip Leader</div>
						</div>
					</div><div class="trip-right-col">
						<div class="trip-detail-title-main">Trip Overview</div>
						<div class="trip-overview"><?php echo types_render_field( "trip-overview", array()); ?></div>
					</div>
				</div>
				<div class="trip-attendees">
					<div class="trip-detail-title-main">Trip Attendees</div>
					<table style="width:100%">
					  <tr>
					    <th>Name</th>
					    <th>Email</th> 
					    <th>Phone</th>
					    <th>Status</th>
					  </tr>
					  <tr>
					    <td>Jessica Zimmerman</td>
					    <td>jkz3km@virginia.edu</td> 
					    <td>239.961.3399</td>
					    <td>Joined</td>
					  </tr>
					  <tr>
					    <td>Jessica Zimmerman</td>
					    <td>jkz3km@virginia.edu</td> 
					    <td>239.961.3399</td>
					    <td>Joined</td>
					  </tr>
					</table>
				</div>
			</div>

		</article>

<?php endwhile; // end of the loop. ?>