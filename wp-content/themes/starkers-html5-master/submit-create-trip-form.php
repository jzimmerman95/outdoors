<?php
	require_once('../../../wp-config.php');
	global $wpdb;

	$wpdb->show_errors();
	$current_time = date("Y-m-d h:i:sa");
	$current_user = 1001; // get_current_user_id() // need to hook this up

	if ( isset( $_POST ) ){
		$signup_date = sanitize_text_field($_POST['sign_up_by_date']) . " " . sanitize_text_field($_POST['sign_up_by_time']);
		$start_date = sanitize_text_field($_POST['start_date']) . " " . sanitize_text_field($_POST['start_time']);
		$end_date = sanitize_text_field($_POST['end_date']) . " " . sanitize_text_field($_POST['end_time']);
		$table_name = 'm_adventure';

		$trip_title = sanitize_text_field($_POST['title']);
		$trip_overview = sanitize_text_field($_POST['trip_overview']);
		$max_attendees = sanitize_text_field($_POST['max_attendees']);
		$fee = sanitize_text_field($_POST['fee']);
		$location = sanitize_text_field($_POST['destination']);
		$depart = sanitize_text_field($_POST['depart_from']);

		$wpdb->insert($table_name, array(
			'c_owner' => $current_user,
			'c_creator' => $current_user,
			'c_created_date' => $current_time,
			'c_last_modified' => $current_time,
			'c_fee' => $fee,
			'c_max_attendees' => $max_attendees,
			'c_signup_date' => $signup_date,
			'c_title' => $trip_title,
			'c_description' => $trip_overview,
			'c_start_date' => $start_date,
			'c_end_date' => $end_date,
			'c_destination' => $location,
			'c_departure' => $depart,
		), array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ));

		$wp_posts = 'wp_posts';

		$post_name = strtolower(preg_replace("/[\s_]/", "-", $trip_title));

		$wpdb->insert($wp_posts, array(
			'post_date' => $current_time,
			'post_title' => $trip_title,
			'post_type' => 'trip',
			'post_name' => $post_name,
		), array( '%s', '%s', '%s', '%s' ));
	}

	$results = $wpdb->get_results("SELECT ID FROM wp_posts WHERE post_date='" . $current_time . "'");

	$trip_id = $results[0]->ID;
	$signup = strtotime($signup_date);
	$end = strtotime($end_date);
	$start = strtotime($start_date);
	$trip_cat = sanitize_text_field($_POST['trip_category']);

	$query = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES 
		($trip_id, 'wpcf-trip-overview', '" . $trip_overview . "'),
		($trip_id, 'wpcf-max-attendees', '" . $max_attendees . "'),
		($trip_id, 'wpcf-fee', '" . $fee . "'),
		($trip_id, 'wpcf-sign-up-by', $signup),
		($trip_id, 'wpcf-end-date', $end),
		($trip_id, 'wpcf-start-date', $start),
		($trip_id, 'wpcf-depart-from', '" . $depart . "'),
		($trip_id, 'wpcf-trip-location', '" . $location . "'),
		($trip_id, 'wpcf-trip-title', '" . $trip_title . "'),
		($trip_id, 'wpcf-trip-cateogry', '" . $trip_cat . "')";

	$wpdb->query($query);

	wp_redirect( home_url() . "/index.php/trip/" . $post_name );
	exit;

?>