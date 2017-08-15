<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Starkers
 * @since Starkers HTML5 3.0
 */
 
get_header();?>

<?php
if ( ! is_user_logged_in() ) { // Display WordPress login form:
    $user_id = wp_get_current_user()->ID;
    $user_paid = get_user_meta( 'user_paid', $user_id );
    $redirect_url = home_url() . '/upcoming-trips';
    if(!$user_paid) {
        $redirect_url = home_url() . '/payment';
    }

    $args = array(
        'redirect' => $redirect_url, 
        'form_id' => 'loginform-custom',
        'label_username' => __( 'Username custom text' ),
        'label_password' => __( 'Password custom text' ),
        'label_remember' => __( 'Remember Me custom text' ),
        'label_log_in' => __( 'Sign in' ),
        'remember' => true
    );
    // wp_login_form( $args );
} else { // If logged in:
    wp_loginout( home_url() ); // Display "Log Out" link.
    echo " | ";
    wp_register('', ''); // Display "Site Admin" link.
}
?>

<div class="sign-in-bg">
  <div class="sign-up-header-wrapper">
    <img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-left.png" /><div class="sign-up-header">Welcome Back</div><img class="home-arrows" src="/outdoors/wp-content/uploads/arrow-right.png" />
  </div>
  <div class="form-holder"><?php echo wp_login_form( $args ); ?></div>
</div>

<?php get_footer(); ?>