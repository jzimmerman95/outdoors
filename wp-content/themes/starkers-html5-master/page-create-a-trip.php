<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header(); ?>

<nav class="menu-internal-menu-container">
	<ul id="menu-internal-menu" class="menu">
		<li id="menu-item-140" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-140"><a href="http://localhost/outdoors/" class="menu-image-title-hide menu-image-not-hovered"><span class="menu-image-title">Home</span><img width="300" height="236" src="http://localhost/outdoors/wp-content/uploads/greenodclogo-300x236.png" class="menu-image menu-image-title-hide" alt="" srcset="http://localhost/outdoors/wp-content/uploads/greenodclogo-300x236.png 300w, http://localhost/outdoors/wp-content/uploads/greenodclogo-768x605.png 768w, http://localhost/outdoors/wp-content/uploads/greenodclogo-1024x806.png 1024w, http://localhost/outdoors/wp-content/uploads/greenodclogo-24x19.png 24w, http://localhost/outdoors/wp-content/uploads/greenodclogo-36x28.png 36w, http://localhost/outdoors/wp-content/uploads/greenodclogo-48x38.png 48w, http://localhost/outdoors/wp-content/uploads/greenodclogo.png 1529w" sizes="(max-width: 300px) 100vw, 300px"></a></li>
		<li id="menu-item-160" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-160"><a href="https://docs.google.com/spreadsheets/d/1Nzo6CtUZ9BhCNoYK61mex-eC4d5pXhmLTUdLJHdozpg/edit?usp=sharing" class="menu-image-title-after"><span class="menu-image-title">Gear Room</span></a></li>
		<li id="menu-item-159" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-159"><a href="http://localhost/outdoors/reports/" class="menu-image-title-after"><span class="menu-image-title">Reports</span></a></li>
		<li id="menu-item-158" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-158"><a href="http://localhost/outdoors/member-resources/" class="menu-image-title-after"><span class="menu-image-title">Member Resources</span></a></li>
		<li id="menu-item-157" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-157"><a href="http://localhost/outdoors/upcoming-trips/" class="menu-image-title-after"><span class="menu-image-title">Upcoming Trips</span></a></li>
		<li id="menu-item-139" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-137 current_page_item menu-item-139"><a href="http://localhost/outdoors/create-a-trip/" class="menu-image-title-after"><span class="menu-image-title">Create a Trip</span></a></li>
		<li id="menu-item-263" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-263"><a href="http://localhost/outdoors/profile/" class="menu-image-title-after"><span class="menu-image-title">Profile</span></a></li>
	</ul>
</nav>

<div class="create-trip-bg">
  <h1>Create a Trip</h1>
</div>

<img class="form-logo" src="/outdoors/wp-content/uploads/formlogo.png" />

<div class="form-wrapper">
  <form class="create-a-trip-form" method="post" action="/outdoors/wp-content/themes/starkers-html5-master/submit-create-trip-form.php">
	<div class="two_input_section">
	  <div class="input-title">Trip Title</div>
	  <input class="first_input" type="text" name="title" required><br>
	</div><div class="two_input_section">
	  <div class="input-title">Trip Category</div>
	  <select class="input-title" type="text" name="trip_category" required>
		<option value="rock_climbing">Rock Climbing</option>
		<option value="watersports">Water Sports</option>
		<option value="hiking">Hiking / Backpacking</option>
		<option value="caving">Caving</option>
		<option value="volunteering">Volunteering</option>
		<option value="horseback_riding">Horseback Riding</option>
		<option value="snowsports">Snow Sports</option>
		<option value="biking">Biking</option>
		<option value="other">Other</option>
	  </select>
	</div>

	<div class="two_input_section">
	  <div class="input-title">Trip Destination</div>
	  <input class="first_input" type="text" name="destination" required><br>
	</div><div class="two_input_section">
	  <div class="input-title">Depart From</div>
	  <input type="text" name="depart_from" required><br>
	</div>

	<div class="two_input_section">
	  <div class="input-title">Start Date</div>
	  <input class="first_input" type="text" id="date" name="start_date" required><br>
	</div><div class="two_input_section">
	  <div class="input-title">Start Time</div>
	  <input type="text" id="time" name="start_time" required><br>
	</div>

	<div class="two_input_section">
	  <div class="input-title">End Date</div>
	  <input class="first_input" type="text" id="date" name="end_date" required><br>
	</div><div class="two_input_section">
	  <div class="input-title">End Time</div>
	  <input type="text" id="time" name="end_time" required><br>
	</div>

	<div class="two_input_section">
	  <div class="input-title">Sign Up By Date</div>
	  <input class="first_input" type="text" id="date" name="sign_up_by_date" required><br>
	</div><div class="two_input_section">
	  <div class="input-title">Sign Up By Time</div>
	  <input type="text" id="time" name="sign_up_by_time" required><br>
	</div>

	<div class="two_input_section">
	  <div class="input-title">Fee</div>
	  <input class="first_input" type="text" name="fee" required><br>
	</div><div class="two_input_section">
	  <div class="input-title">Max # Attendees</div>
	  <input type="text" name="max_attendees" required><br>
	</div>

	<div class="trip_overview">Trip Overview</div>
	<textarea name="trip_overview" required></textarea><br>
	<input type="submit" value="Create Trip">
  </form>
</div>

<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<script src="https://unpkg.com/flatpickr"></script>

<script>
  flatpickr("#date", {altInput: true});
  flatpickr("#time", {
	enableTime: true,
	noCalendar: true,
	altInput: true,
	// initial values for time. don't use these to preload a date
	defaultHour: 12,
	defaultMinute: 0
  });
</script>
<?php get_footer(); ?>
