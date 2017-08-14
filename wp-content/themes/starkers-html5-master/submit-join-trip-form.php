<?php
	require_once('../../../wp-config.php');
	global $wpdb;

	$wpdb->show_errors();

	if ( isset( $_POST ) ){
		$user_id = wp_get_current_user()->ID;
		$trip_id = sanitize_text_field($_POST['post_id']);
		$max_attendees = sanitize_text_field($_POST['max_attendees']);
		$current_time = date("Y-m-d h:i:sa");
		$adventure_id = sanitize_text_field($_POST['adventure_id']);
		$post_title = strtolower(preg_replace("/[\s_]/", "-",sanitize_text_field($_POST['post_title'])));

		$attendees = $wpdb->get_results("SELECT count(*) as count FROM m_attendee WHERE c_adventure='" . $adventure_id . "'")[0]->count;

		$table_name = 'm_attendee';

		if (sanitize_text_field($_POST['row_exists']) == 1){
			$wpdb->update( $table_name, array(
				'c_deleted'	=> 0,
			), array('c_adventure' => $adventure_id, 'c_member' => $user_id), array(), array('%d', '%d'));
		} elseif ($attendees >= $max_attendees) {
			$wpdb->insert($table_name, array(
				'c_owner' => $user_id,
				'c_creator' => $user_id,
				'c_created_date' => $current_time,
				'c_last_modified' => $current_time,
				'c_adventure' => $adventure_id,
				'c_member' => $user_id,
				'c_status' => 8,
				'c_joined_date' => $current_time,
			), array( '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s'));
		} else {
			$wpdb->insert($table_name, array(
				'c_owner' => $user_id,
				'c_creator' => $user_id,
				'c_created_date' => $current_time,
				'c_last_modified' => $current_time,
				'c_adventure' => $adventure_id,
				'c_member' => $user_id,
				'c_joined_date' => $current_time,
			), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s'));
		}

		wp_redirect( home_url() . "/index.php/trip/" . $post_title );
		exit;
	}

?>
