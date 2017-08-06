<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
	
	$post_date = get_the_date("Y-m-d h:i:sa");
	$user_id = wp_get_current_user()->ID;

	$adventure_id = $wpdb->get_results("SELECT c_uid FROM m_adventure WHERE c_created_date='" . $post_date . "'")[0]->c_uid;

	$count = $wpdb->get_results("SELECT count(*) as count FROM m_attendee WHERE c_adventure='" . $adventure_id . "' AND c_member='" . $user_id . "' AND c_deleted=0")[0]->count;

	$row_exists = $wpdb->get_results("SELECT count(*) as count FROM m_attendee WHERE c_adventure='" . $adventure_id . "' AND c_member='" . $user_id . "'")[0]->count;
?>

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
				<?php if ($count == 0): ?>
					<form name="join-trip" method="post" action="/outdoors/wp-content/themes/starkers-html5-master/submit-join-trip-form.php">
						<input type="text" style="display: none;" value="<?php echo $adventure_id; ?>" name="adventure_id">
						<input type="text" style="display: none;" value="<?php echo types_render_field( "trip-title", array()); ?>" name="post_title">
						<input type="text" style="display: none;" value="<?php echo $row_exists; ?>" name="row_exists">
						<div class="join-trip" onClick="document.forms['join-trip'].submit();">+ Join Trip</div>
						<input type="submit" style="display: none;">
					</form>
				<?php else: ?>
					<form name="leave-trip" method="post" action="/outdoors/wp-content/themes/starkers-html5-master/submit-leave-trip-form.php">
						<input type="text" style="display: none;" value="<?php echo $adventure_id; ?>" name="adventure_id">
						<input type="text" style="display: none;" value="<?php echo types_render_field( "trip-title", array()); ?>" name="post_title">
						<div class="leave-trip" onClick="document.forms['leave-trip'].submit();">- Leave Trip</div>
						<input type="submit" style="display: none;">
					</form>
				<?php endif; ?>
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

		<?php
			$attendees = $wpdb->get_results("SELECT c_member, c_status, c_deleted FROM m_attendee WHERE c_adventure='" . $adventure_id . "'");

		?>

		<div class="trip-attendees">
			<div class="trip-detail-title-main">Trip Attendees</div>
			<table style="width:100%">
				<tr>
					<th>Name</th>
					<th>Email</th> 
					<th>Phone</th>
					<th>Status</th>
				</tr>
				<?php foreach($attendees as $key=>$value):
					$status = $attendees[$key]->c_status;
					$attendee_id = $attendees[$key]->c_member;
					$deleted = $attendees[$key]->c_deleted;

					if ($deleted){
						continue;
					}

					$user = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE 
						user_id='" . $attendee_id . "' AND (
							meta_key='first_name' OR 
							meta_key='last_name' OR
							meta_key='email' OR
							meta_key='phone_number'
						)");

					$name = $user[0]->meta_value . ' ' . $user[1]->meta_value;
					$email = $user[2]->meta_value;
					$phone = $user[3]->meta_value;

				?>
					<tr>
						<td><?php echo $name;?></td>
						<td><?php echo $email;?></td> 
						<td><?php echo $phone;?></td>
						<?php if ($status == 1):?>
							<td>Joined</td>
						<?php else: ?>
							<td>Waitlist</td>
						<?php endif; ?>
					</tr>
				<?php endforeach; ?>

			</table>
		</div>
	</div>

</article>

<?php endwhile; // end of the loop. ?>