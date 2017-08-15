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
    <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" /><div class="sign-up-header">Join Outdoors</div><img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" />
  </div>

  <form action="/outdoors/payment/" method="POST">
    <script
      src="https://checkout.stripe.com/checkout.js" class="stripe-button"
      data-key="pk_test_8RqSpTYU4rKfwfPPuk8GR8UQ"
      data-amount="999"
      data-name="Demo Site"
      data-zip-code="true"
      data-description="Widget"
      data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
      data-locale="auto">
    </script>
  </form>

  <?php
  require_once('stripe/init.php');
  if(isset($_POST['stripeToken'])) {
    \stripe\Stripe::setApiKey('sk_test_AV3VKHC0TTidSjgLyD4HcfQx');
    $token = $_POST['stripeToken'];

    // Create a Customer:
    $customer = \stripe\Customer::create(array(
      "email" => "paying.user@example.com",
      "source" => $token,
    ));

    // Charge the Customer instead of the card:
    $charge = \stripe\Charge::create(array(
      "amount" => 1000,
      "currency" => "usd",
      "customer" => $customer->id
    ));

    # Get Current user
    # Update paid status to current timestamp
    # Paid status should be 0 if they haven't paid
    # Also add stripe customer id into DB

    if($charge) {
        $user_id = wp_get_current_user()->ID;
        $timestamp = time();
        update_user_meta( $user_id, 'user_paid', $timestamp);
        update_user_meta( $user_id, 'stripe_id', $customer->id);
        $redirect_url = home_url() . '/upcoming-trips';
        wp_redirect($redirect_url);
        exit;
    }
  }
  ?>
</div>

<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
<script src="https://unpkg.com/flatpickr"></script>

<?php get_footer(); ?>