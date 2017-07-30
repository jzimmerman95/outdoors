<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header(); ?>

<div class="create-trip-bg">
  <h1>Create a Trip</h1>
</div>

<img class="form-logo" src="/outdoors/wp-content/uploads/formlogo.png" />

<div class="form-wrapper">
  <form class="create-a-trip-form" method="post" action="submit-create-trip-form.php">
    <div class="input-title">Trip Title</div>
    <input class="title-input" type="text" name="title" required><br>

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