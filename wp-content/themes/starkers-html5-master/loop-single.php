<?php
/**
 * The loop that displays a single post.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.2
 */

global $wp;

if ( !is_user_logged_in() ) {
	wp_redirect( home_url());
	exit;
}
?>

<nav class="menu-internal-menu-container">
	<ul id="menu-internal-menu" class="menu">
		<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-140"><a href="/outdoors/" class="menu-image-title-hide menu-image-not-hovered"><span class="menu-image-title">Home</span><img width="300" height="236" src="/outdoors/wp-content/uploads/greenodclogo-300x236.png" class="menu-image menu-image-title-hide" alt="" srcset="/outdoors/wp-content/uploads/greenodclogo-300x236.png 300w, /outdoors/wp-content/uploads/greenodclogo-768x605.png 768w, /outdoors/wp-content/uploads/greenodclogo-1024x806.png 1024w, /outdoors/wp-content/uploads/greenodclogo-24x19.png 24w, /outdoors/wp-content/uploads/greenodclogo-36x28.png 36w, /outdoors/wp-content/uploads/greenodclogo-48x38.png 48w, /outdoors/wp-content/uploads/greenodclogo.png 1529w" sizes="(max-width: 300px) 100vw, 300px"></a></li>
		<li id="menu-item-160" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-160"><a href="https://docs.google.com/spreadsheets/d/1Nzo6CtUZ9BhCNoYK61mex-eC4d5pXhmLTUdLJHdozpg/edit?usp=sharing" class="menu-image-title-after"><span class="menu-image-title">Gear Room</span></a></li>
		<li id="menu-item-159" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-159"><a href="/outdoors/reports/" class="menu-image-title-after"><span class="menu-image-title">Reports</span></a></li>
		<li id="menu-item-158" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-158"><a href="/outdoors/member-resources/" class="menu-image-title-after"><span class="menu-image-title">Member Resources</span></a></li>
		<li id="menu-item-157" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-157"><a href="/outdoors/upcoming-trips/" class="menu-image-title-after"><span class="menu-image-title">Upcoming Trips</span></a></li>
		<li id="menu-item-139" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-137 current_page_item menu-item-139"><a href="/outdoors/create-a-trip/" class="menu-image-title-after"><span class="menu-image-title">Create a Trip</span></a></li>
		<li id="menu-item-263" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-263"><a href="/outdoors/profile/" class="menu-image-title-after"><span class="menu-image-title">Profile</span></a></li>
	</ul>
</nav>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 
	
	$post_date = get_the_date("Y-m-d h:i:sa");
	$user_id = wp_get_current_user()->ID;

	$adventure_id = $wpdb->get_results("SELECT c_uid FROM m_adventure WHERE c_created_date='" . $post_date . "'")[0]->c_uid;

	$count = $wpdb->get_results("SELECT count(*) as count FROM m_attendee WHERE c_adventure='" . $adventure_id . "' AND c_member='" . $user_id . "' AND c_deleted=0")[0]->count;

	$row_exists = $wpdb->get_results("SELECT count(*) as count FROM m_attendee WHERE c_adventure='" . $adventure_id . "' AND c_member='" . $user_id . "'")[0]->count;

	$questions = $wpdb->get_results("SELECT c_uid, c_text FROM m_question WHERE c_adventure='" . $adventure_id . "'");
?>

<div id="modal">
	<div class="join-trip-questions">Please answer the following questions to join the trip:</div>
	<form class="join-trip-form" name="join-trip" method="post" action="/outdoors/wp-content/themes/starkers-html5-master/submit-join-trip-form.php">
		<input type="text" style="display: none;" value="<?php echo $adventure_id; ?>" name="adventure_id">
		<input type="text" style="display: none;" value="<?php echo $max_attendees; ?>" name="max_attendees">
		<input type="text" style="display: none;" value="<?php echo types_render_field( "trip-title", array()); ?>" name="post_title">
		<input type="text" style="display: none;" value="<?php echo $row_exists; ?>" name="row_exists">
		<?php for ($x = 0; $x < sizeof($questions); $x++): 
			$id = $questions[$x]->c_uid;
			$question = $questions[$x]->c_text; ?>
			<div class="input-title"><?php echo $question; ?></div>
			<input type="text" name="answer[<?php echo $c_uid; ?>]" class="join-trip-answer" required />
		<?php endfor; ?>
		<input class="join" type="submit" value="+ Join Trip">
	</form>
</div>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="trip-bg">
		<h1 class="faq-title"><?php echo types_render_field( "trip-title", array()); ?></h1>
	</div>

	<?php 
		$start_date = date("h:ia", types_render_field("start-date", array('output' => 'raw')));
		$end_date = date("h:ia", types_render_field("end-date", array('output' => 'raw')));
		$signupby = date("h:ia", types_render_field("sign-up-by", array('output' => 'raw')));
		$max_attendees = types_render_field('max-attendees', array());
	?>
	
	<div class="trip-container">
		<div class="trip-col-container">
			<div class="trip-left-col">

				<?php if ($count == 0): ?>
					<div class="join-trip trigger">+ Join Trip</div> 


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
					<div class="trip-detail"><span style="font-family: GothamBold;">Max Attendees: </span><?php echo types_render_field( "max-attendees", array()); ?></div>
				</div>
				<?php 
					$name = get_the_author_meta('display_name');
					$name = str_replace(' ', '<br />', $name);
				?>

				<div class="trip-leader">
					<div class="trip-detail-title">Trip Leader</div>
					<div class="trip-detail"><span class="leader-img"><?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?></span><span class="trip-leader-name" style="font-family: GothamBold;"><?php echo $name; ?></span></div>
					<span class="leader-email"><span style="font-family: GothamBold;">Email:</span> <?php echo get_the_author_meta('email'); ?></span>
				</div>
			</div><div class="trip-right-col">
				<div class="trip-detail-title-main">Trip Description</div>
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

					if ($deleted) continue;

					$user = get_user_by( 'id', $attendee_id );

					$name = $user->first_name . ' ' . $user->last_name;
					$email = $user->email;
					$phone = $user->phone_number;

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

<script>
$("#modal").iziModal();
$(document).on('click', '.trigger', function (event) {
    event.preventDefault();
    $('#modal').iziModal('open');
});
</script>


