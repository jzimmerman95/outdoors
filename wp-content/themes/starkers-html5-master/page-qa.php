<?php get_template_part("content", "nav"); 
if ( !is_user_logged_in() || !(current_user_can('administrator') || current_user_can('author'))) {
	wp_redirect( home_url());
	exit;
}
$id = get_query_var("adventure");

$questions = $wpdb->get_results("SELECT c_uid, c_text FROM m_question WHERE c_adventure='" . $id . "'");
$attendees = $wpdb->get_results("SELECT c_uid, c_member, c_deleted FROM m_attendee WHERE c_adventure='" . $id . "'");
$q_ids = array();
?>

<div class="qa-bg">
	<h1>Q&A Results</h1>
</div>

<div class="qa-table-container">
	<table class="qa-table">
		<tr>
			<th>Attendee</th>
			<?php for($i = 0; $i < sizeof($questions); $i++):
				$question = $questions[$i]->c_text;
				$q_ids[] = $questions[$i]->c_uid;
			?>
				<th><?php echo $question; ?></th>
			<?php endfor; ?>
		</tr>

		<?php foreach($attendees as $key=>$value):?>
		<tr>
		<?php
			$a_id = $attendees[$key]->c_uid;
			$attendee_id = $attendees[$key]->c_member;
			$deleted = $attendees[$key]->c_deleted;

			if ($deleted) continue;

			$user = get_user_by( 'id', $attendee_id );
			$name = $user->first_name . ' ' . $user->last_name; ?>

			<td><?php echo $name; ?></td>

			<?php 
				$answers = $wpdb->get_results("SELECT c_question, c_answer_text FROM m_answer WHERE c_attendee='" . $a_id . "'");
				
				foreach ($answers as $key=>$value):
					$c_question = $answers[$key]->c_question;
					if (in_array($c_question, $q_ids)): 
						$ans = $answers[$key]->c_answer_text;
					?>
						<td><?php echo $ans; ?></td>
					<?php endif; ?>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</table>
</div>

<?php get_footer(); ?>