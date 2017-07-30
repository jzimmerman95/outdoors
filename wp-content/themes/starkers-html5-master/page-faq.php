<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header();

$childargs = array(
  'post_type' => 'faq-field',
);
$loop = new WP_Query($childargs);?>

<div class="faq-bg">
  <h1 class="faq-title">Frequently Asked<br>Questions</h1>
</div>

<?php while ($loop->have_posts()) : $loop->the_post();
  $header1 = types_render_field("first-section-header", array());
  $header2 = types_render_field("second-section-header", array());
  $header3 = types_render_field("third-section-header", array());
  $cta1 = types_render_field("cta-1", array());
  $cta2 = types_render_field("cta-2", array());
  $cta1text = types_render_field("cta-1-text", array());
  $cta2text = types_render_field("cta-2-text", array());
?>

<?php endwhile; ?>

<div class="faq-section-container">

  <div class="faq-header"><?php echo $header1; ?></div>
  <div class="green-rectangle" style="margin: 0; margin-bottom: 30px;"></div>

<?php
$childargs = array(
  'post_type' => 'faqs',
  'order'     => 'ASC',
);
$loop = new WP_Query($childargs);
$aboutqs = array();
$memberqs = array();
$activityqs = array();

while ($loop->have_posts()) : $loop->the_post();
  $section = types_render_field("faq-section", array());

  if ($section == "About"):
    $aboutqs[types_render_field("question", array())] = types_render_field("answer", array());
  elseif ($section == "Membership"):
    $memberqs[types_render_field("question", array())] = types_render_field("answer", array());
  elseif ($section == "Activities"):
    $activityqs[types_render_field("question", array())] = types_render_field("answer", array());
  endif; 

endwhile;

foreach ($aboutqs as $q => $a): ?>
  <div class="question"><?php echo $q ?></div>
  <div class="answer"><?php echo $a ?></div>
<?php endforeach; ?>

</div>
<img class="faq-mtn" src="/outdoors/wp-content/uploads/faq-mtn.png" />
<div class="faq-section-container">
  <div class="faq-header"><?php echo $header2; ?></div>
  <div class="green-rectangle" style="margin: 0; margin-bottom: 30px;"></div>

<?php foreach ($memberqs as $q => $a): ?>
  <div class="question"><?php echo $q ?></div>
  <div class="answer"><?php echo $a ?></div>
<?php endforeach; ?>

</div>
<img class="faq-mtn" src="/outdoors/wp-content/uploads/faq-mtn-2.png" />

<div class="faq-section-container">
  <div class="faq-header"><?php echo $header3; ?></div>
  <div class="green-rectangle" style="margin: 0; margin-bottom: 30px;"></div>

<?php foreach ($activityqs as $q => $a): ?>
  <div class="question"><?php echo $q ?></div>
  <div class="answer"><?php echo $a ?></div>
<?php endforeach; ?>

</div>

<div class="cta-holder">
  <div class="cta-left">
    <img class="cta-email" src="/outdoors/wp-content/uploads/email.png" />
    <div class="cta-header"><?php echo $cta1; ?></div>
    <div class="cta-text"><?php echo $cta1text; ?></div>
    <div class="cta-btn">Contact Us</div>
  </div><div class="cta-right">
      <img class="cta-email" src="/outdoors/wp-content/uploads/joinlogo.png" />
      <div class="cta-header"><?php echo $cta2; ?></div>
      <div class="cta-text"><?php echo $cta2text; ?></div>
      <div class="cta-btn">Sign Up</div>
  </div>
</div>

<?php get_footer(); ?>

