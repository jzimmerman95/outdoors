<?php get_template_part("content", "nav"); ?>

	<div class="upcoming-trips-bg">
		<h1 class="faq-title">Past Trips</h1>
	</div>
	
	<?php
		$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
		$childargs = array(
			'post_type'		=> 'trip',
			'meta_key'		=> 'wpcf-start-date',
			'orderby'		=> 'meta_value',
			'order'			=> 'DESC',
			'posts_per_page'	=> 5,
			'paged'			=> $paged,
			'meta_query'		=> array(
				array(
					'key'		=> 'wpcf-start-date',
					'compare'	=> '<',
					'value'		=> intval(strtotime(date('Y-m-d'))),
					'type'		=> 'numeric'
				)
			),
		);
		$the_query = new WP_Query($childargs);
		$count = 0;

		$pagination_args = array(
			'base'            => get_pagenum_link(1) . '%_%',
			'format'          => 'page/%#%',
			'total'           => $numpages,
			'current'         => $paged,
			'show_all'        => False,
			'end_size'        => 1,
			'mid_size'        => $pagerange,
			'prev_next'       => True,
			'prev_text'       => __('&laquo;'),
			'next_text'       => __('&raquo;'),
			'type'            => 'plain',
			'add_args'        => false,
			'add_fragment'    => ''
		);
		$paginate_links = paginate_links($pagination_args);
	?>

	  <div class="past-trips-container">
		<h1 class="past-trips-h1">Past Trips</h1>
		<div class="green-rectangle" style="margin-left: 30px; margin-bottom: 30px; margin-top: 0;"></div>
		<table class="past-trips" style="width:100%">
		  <tr>
			<th>Trip Title</th>
			<th>Location</th> 
			<th>Date</th>
		  </tr>
		  <?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post();
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
		<?php
			if (function_exists(custom_pagination)) {
				custom_pagination($the_query->max_num_pages,"",$paged);
			}

			wp_reset_postdata();

			endif;
		?>
	  </div>

	<?php get_footer(); ?>

