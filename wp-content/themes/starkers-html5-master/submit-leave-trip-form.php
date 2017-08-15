<?php
	require_once('../../../wp-config.php');
	global $wpdb;

	$wpdb->show_errors();

	if ( isset( $_POST ) ){
		$user_id = wp_get_current_user()->ID;
		$adventure_id = sanitize_text_field($_POST['adventure_id']);
		$current_time = date("Y-m-d h:i:sa");
		$post_title = strtolower(preg_replace("/[\s_]/", "-", sanitize_text_field($_POST['post_title'])));

		$table_name = 'm_attendee';

		$wpdb->update( $table_name, array(
			'c_deleted'	=> 1,
		), array('c_adventure' => $adventure_id, 'c_member' => $user_id), array(), array('%d', '%d'));

		wp_redirect( home_url() . "/index.php/trip/" . $post_title );
		exit;
	}

?>
