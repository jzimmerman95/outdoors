<?php get_template_part("content", "nav"); 
if ( !is_user_logged_in() || !(current_user_can('administrator') || current_user_can('author'))) {
	wp_redirect( home_url());
	exit;
}
?>

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

		<div class="trip_overview">Trip Description</div>
		<textarea name="trip_overview" required></textarea><br>

		<div class="trip-questions">Questions for Attendees</div>
		<div class="common-qs">
			<p class="common-qs-header">Most Popular Questions:</p>
			<p>Please note all medical conditions (this is confidential)</p>
			<p>The club pays for gas if you can drive. How many people total can your car fit?</p>
			<p>Please enter any comments here.</p>
			<p>Do you need shoes (what size?), harness, or chalkbag?</p>
			<p>Do you have any food/dietary restrictions or suggestions?</p>
			<p>Do you know how to belay?</p>
			<p>Have you passed the belay test at Peak?</p>
			<p>Do you have any questions/comments about this adventure?</p>
			<p>Do you need a sleeping bag or a sleeping pad?</p>
			<p>Do you have a tent? How many people does it fit?</p>
			<p>Do you have your own boat and gear?</p>
			<p>How tall are you?</p>
			<p>How many skis or snowboards can your car carry?</p>
			<p>Can you roll?</p>
			<p>What level (5.xx) can you climb? Put 5.0 if you have never climbed.</p>
		</div>

		<div class="questions-holder" id="questions-holder"></div>

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

	var index = 1;
	var lastIndex = 1;

	$('.questions-holder').append('<span id="question-' + index + '"><div class="input-title">Question</div><input type="text" name="question[]" class="trip-question" required><div class="plus-btn" id="plus-btn-' + index + '" onclick="addQuestionField(index++)"> +</div></span>');

	index++;

	function addQuestionField(index){

		lastIndex = index-1;
		document.getElementById('plus-btn-' + lastIndex + '').style.display = 'none';

		$('.questions-holder').append('<div class="minus-btn" id="minus-btn-' + lastIndex + '" onclick="removeQuestionField(lastIndex)"> -</div>');
		$('.questions-holder').append('<span id="question-' + index + '"><div class="input-title">Question</div><input type="text" name="question[]" class="trip-question" required><div class="plus-btn" id="plus-btn-' + index + '" onclick="addQuestionField(index++)"> +</div></span>');
	}

	function removeQuestionField(index){

		$('#question-' + index).remove();
		$('#minus-btn-' + index).remove();

		lastIndex--;
	}
</script>
<?php get_footer(); ?>
