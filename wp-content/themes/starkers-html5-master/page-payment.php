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
    <div class="sign-up-header-wrapper">
    </div>

<?php
  require_once('stripe/init.php');
  $current_user = wp_get_current_user();
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
        $user_id = $current_user->id;
        $timestamp = time();
        update_user_meta( $user_id, 'user_paid', $timestamp);
        update_user_meta( $user_id, 'stripe_id', $customer->id);
    }
  }
  else {
    $has_paid = get_user_meta($current_user->id, 'user_paid', true);
    echo json_encode($has_paid);
    if($has_paid) {
      echo 'test paid';
    }else {
      echo "<form action='/outdoors/index.php/sign-up/payment/' method='POST'>
        <script
          src='https://checkout.stripe.com/checkout.js' class='stripe-button'
          data-key='pk_test_8RqSpTYU4rKfwfPPuk8GR8UQ'
          data-amount='999'
          data-name='Demo Site'
          data-zip-code='true'
          data-description='Widget'
          data-image='https://stripe.com/img/documentation/checkout/marketplace.png'
          data-locale='auto'>
        </script>
      </form>";
    }
  }
  ?>
</div>

<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<script src="https://unpkg.com/flatpickr"></script>

<?php get_footer(); ?>