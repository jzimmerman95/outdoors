<?php get_template_part("content", "nav");

if ( !is_user_logged_in() || !current_user_can('administrator')) {
  wp_redirect( home_url());
  exit;
}
?>

<div class="reports-bg">
  <h1 class="faq-title">Reports</h1>
</div>

<div class="reports-container">
  <div class="question">Trips Led By Member</div>
  <div class="reports-subtext">A list of members ranked by how many trips they've led since:</div>
  <form class="trips-led-by-member-form" method="post" action="/outdoors/wp-content/themes/starkers-html5-master/submit-create-trip-form.php">
    <input class="report_input" type="text" id="date" name="sign_up_by_date" required>
    <input type="submit" value="Generate">
  </form>
  <br>
  <br>
  <div class="question">How Many Trips Members Have Attended</div>
  <div class="reports-subtext">A list of how many members have attended 1 trip, 2 trips, and so on, since:</div>
  <form class="trips-led-by-member-form" method="post" action="/outdoors/wp-content/themes/starkers-html5-master/submit-create-trip-form.php">
    <input class="report_input" type="text" id="date" name="sign_up_by_date" required>
    <input type="submit" value="Generate">
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