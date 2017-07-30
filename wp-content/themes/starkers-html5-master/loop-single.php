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

<<<<<<< HEAD
		<nav>
			<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'starkers' ) . ' %title' ); ?>
			<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'starkers' ) . '' ); ?>
		</nav>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<header>
				<h1><?php the_title(); ?></h1>

				<?php starkers_posted_on(); ?>
			</header>

			<?php the_content(); ?>
					
			<?php wp_link_pages( array( 'before' => '<nav>' . __( 'Pages:', 'starkers' ), 'after' => '</nav>' ) ); ?>
		
			<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
				<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'starkers_author_bio_avatar_size', 60 ) ); ?>
				<h2><?php printf( esc_attr__( 'About %s', 'starkers' ), get_the_author() ); ?></h2>
				<?php the_author_meta( 'description' ); ?>
					<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
						<?php printf( __( 'View all posts by %s &rarr;', 'starkers' ), get_the_author() ); ?>
					</a>
			<?php endif; ?>
			
			<footer>
				<?php starkers_posted_in(); ?>
				<?php edit_post_link( __( 'Edit', 'starkers' ), '', '' ); ?>
			</footer>
				
		</article>

		<nav>
			<?php previous_post_link( '%link', '' . _x( '&larr;', 'Previous post link', 'starkers' ) . ' %title' ); ?>
			<?php next_post_link( '%link', '%title ' . _x( '&rarr;', 'Next post link', 'starkers' ) . '' ); ?>
		</nav>

		<?php comments_template( '', true ); ?>

=======
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="trip-bg">
				<h1 class="faq-title"><?php echo types_render_field( "trip-title", array()); ?></h1>
			</div>
			
			<div class="trip-container">
				<div class="trip-col-container">
					<div class="trip-left-col">
						<div class="join-trip">+ Join Trip</div>
						<div class="trip-details">
							<div class="trip-detail-title">Details</div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Where: </span><?php echo types_render_field( "trip-location", array()); ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Depart From: </span><?php echo types_render_field( "depart-from", array()); ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Start: </span><?php echo types_render_field( "start-date", array()); ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">End: </span><?php echo types_render_field( "end-date", array()); ?></div>
							<div class="trip-detail"><span style="font-family: GothamBold;">Sign-up By: </span><?php echo types_render_field( "sign-up-by", array()); ?></div>
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

>>>>>>> a8f942f211898a50cb3660e39caa7057dec37f5f
<?php endwhile; // end of the loop. ?>