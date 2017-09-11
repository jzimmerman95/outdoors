<?php
  require_once('../../../wp-config.php');

  global $wpdb;

  $wpdb->show_errors();
  $current_time = date("Y-m-d h:i:sa");
  $current_user = wp_get_current_user()->ID;

  if ( isset( $_POST ) ){
    $value = sanitize_text_field($_POST['value']);
  }
?>

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
      "amount" => $value,
      "currency" => "usd",
      "customer" => $customer->id
    ));

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
  else {
    $has_paid = get_user_meta($current_user->id, 'user_paid', true);
    echo json_encode($has_paid);
    if($has_paid) {
      echo 'test paid';
    }
  }
  ?>
</div>

<?php get_footer(); ?>


