<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header();
?>

<div class="sign-up-bg">
  <div class="membership-dues">Membership Dues</div>
  <form action="/outdoors/payment/" method="POST">
    <select id="value" class="membership_select">
      <option value="" disabled selected>Select Membership</option>
      <option value="3000">5 Months for $30</option>
      <option value="5000">12 Months for $50</option>
    </select>
    <div class="stripe-btn-wrapper">
      <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="pk_test_8RqSpTYU4rKfwfPPuk8GR8UQ"
        data-amount=""
        data-name="Demo Site"
        data-zip-code="true"
        data-description="Widget"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto">
      </script>
    </div>
  </form>

  <?php
  require_once('stripe/init.php');
  if(isset($_POST['stripeToken'])) {
    echo 'stripe token set';
    \stripe\Stripe::setApiKey("sk_test_AV3VKHC0TTidSjgLyD4HcfQx");

    // Token is created using Stripe.js or Checkout!
    // Get the payment token ID submitted by the form:
    $token = $_POST['stripeToken'];

    $customer = \stripe\Customer::create(array(
      "email" => "paying.user@example.com",
      "source" => $token,
    ));

    $charge = \Stripe\Charge::create(array(
      "amount" => 1000,
      "currency" => "usd",
      "customer" => $customer->id
    ));

    if($charge) {
        $user_id = wp_get_current_user()->ID;
        $timestamp = time();
        update_user_meta( $user_id, 'user_paid', $timestamp);
        update_user_meta( $user_id, 'stripe_id', $customer->id);
        $redirect_url = home_url() . '/hellosign';
        wp_redirect($redirect_url);
        exit;
    }
  }
  else {
    $has_paid = get_user_meta($current_user->id, 'user_paid', true);
    // echo json_encode($has_paid);
    if($has_paid) {
      echo 'test paid';
    }
  }
  ?>
</div>

<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<script src="https://unpkg.com/flatpickr"></script>

<?php get_footer(); ?>