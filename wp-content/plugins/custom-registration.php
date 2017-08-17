<?php

/*
  Plugin Name: Custom Registration
  Description: Updates user rating based on number of posts.
  Version: 1.2
  Author: Tristan Slater w/ Agbonghama Collins
  Author URI: http://kanso.ca
 */

/////////////////
// PLUGIN CORE //
/////////////////

function cr(&$fields, &$errors) {
  
  // Check args and replace if necessary
  if (!is_array($fields))     $fields = array();
  if (!is_wp_error($errors))  $errors = new WP_Error;
  
  // Check for form submit
  if (isset($_POST['submit'])) {
    
    // Get fields from submitted form
    $fields = cr_get_fields();

    // Validate fields and produce errors
    if (cr_validate($fields, $errors)) {

      // If successful, register user
      $user_id = wp_insert_user($fields);

      insert_user_meta($user_id, $fields);

      wp_redirect(home_url() . "/sign-in/");
      exit;
      
      // Clear field data
      $fields = array(); 
    }
  }
  
  // Santitize fields
  cr_sanitize($fields);

  // Generate form
  cr_display_form($fields, $errors);
}

function cr_sanitize(&$fields) {
  $fields['user_pass']    =  isset($fields['user_pass'])   ? esc_attr($fields['user_pass']) : '';
  $fields['user_email']   =   isset($fields['user_email'])  ? sanitize_email($fields['user_email']) : '';
  $fields['user_login']   = $fields['user_email'];
  $fields['user_url']     =  isset($fields['user_url'])    ? esc_url($fields['user_url']) : '';
  $fields['first_name']   =  isset($fields['first_name'])  ? sanitize_text_field($fields['first_name']) : '';
  $fields['last_name']    =  isset($fields['last_name'])   ? sanitize_text_field($fields['last_name']) : '';
  $fields['gender']       =   isset($fields['gender'])   ? sanitize_text_field($fields['gender']) : '';
  $fields['birthday']     =   isset($fields['birthday'])   ? sanitize_text_field($fields['birthday']) : '';
  $fields['phone_number']     =   isset($fields['phone_number'])   ? sanitize_text_field($fields['phone_number']) : '';
}

function insert_user_meta($user_id, $fields) {
  update_user_meta( $user_id, 'first_name', $fields['first_name'] );
  update_user_meta( $user_id, 'last_name', $fields['last_name'] );
  update_user_meta( $user_id, 'gender', $fields['gender'] );
  update_user_meta( $user_id, 'birthday', $fields['birthday'] );
  update_user_meta( $user_id, 'phone_number', $fields['phone_number'] );
  update_user_meta( $user_id, 'user_paid', '0');
  update_user_meta( $user_id, 'waiver_signed', '0');
  update_user_meta( $user_id, 'email', $fields['user_email']);
}

function cr_display_form($fields = array(), $errors = null) {
  
  // Check for wp error obj and see if it has any errors  
  if (is_wp_error($errors) && count($errors->get_error_messages()) > 0) {
    
    // Display errors
    ?>
    <div class="form-holder">
      <form class="sign-up-form" method="post" action="<?php $_SERVER['REQUEST_URI'] ?>">
    <div class="sign-up-errors"><ul><?php
    foreach ($errors->get_error_messages() as $key => $val) {
      ?><li>
        <?php echo $val; ?>
      </li><?php
    }
    ?></ul></div><?php
  }
  
  // Disaply form
  
  ?>

    
        <div class="two_input_section">
          <input class="cr_input" type="text" placeholder="First Name" name="first_name" value="<?php echo (isset($fields['first_name']) ? $fields['first_name'] : '') ?>" required><br>
        </div><div class="two_input_section">
          <input class="cr_input" type="text" name="last_name" placeholder="Last Name" value="<?php echo (isset($fields['last_name']) ? $fields['last_name'] : '') ?>" required><br>
        </div>
        <div class="two_input_section">
          <input class="cr_input" type="text" placeholder="Email" name="user_email" value="<?php echo (isset($fields['user_email']) ? $fields['user_email'] : '') ?>" required><br>
        </div><div class="two_input_section">
          <input class="cr_input" type="text" name="phone_number" placeholder="Phone" value="<?php echo (isset($fields['phone_number']) ? $fields['phone_number'] : '') ?>" required><br>
        </div>
        <div class="two_input_section">
          <input class="cr_input" type="text" placeholder="Birthday" id="date" name="birthday" required><br>
        </div><div class="two_input_section">
          <select class="cr_input_select" name="gender" required>
            <option value="" disabled selected>Gender</option>
            <option value="female">Female</option>
            <option value="male">Male</option>
            <option value="other">Prefer not to say</option>
          </select><br>
        </div>
        <div class="two_input_section">
          <input class="cr_input" type="password" name="user_pass" required placeholder="Password"><br>
        </div><div class="two_input_section">
          <input class="cr_input" type="password" name="confirm_password" required placeholder="Confirm Password"><br>
        </div>
        <input class="sign-up-submit" type="submit" name="submit" value="Sign Up">
      </form>
    </div>

    <?php
}

function cr_get_fields() {
  $user_email = isset($_POST['user_email'])   ?  $_POST['user_email']        :  '';
  return array(
    'user_pass'    =>  isset($_POST['user_pass'])    ?  $_POST['user_pass']    :  '',
    'user_email'   =>  $user_email,
    'user_login'   => $user_email,
    'user_url'     =>  isset($_POST['user_url'])     ?  $_POST['user_url']     :  '',
    'first_name'   =>  isset($_POST['first_name'])   ?  $_POST['first_name']        :  '',
    'last_name'    =>  isset($_POST['last_name'])    ?  $_POST['last_name']        :  '',
    'gender'       => isset($_POST['gender']) ? $_POST['gender'] : '',
    'birthday'       => isset($_POST['birthday']) ? $_POST['birthday'] : '',
    'phone_number'    =>  isset($_POST['phone_number'])    ?  $_POST['phone_number']        :  '',
  );
}

function cr_validate(&$fields, &$errors) {
  
  // Make sure there is a proper wp error obj
  // If not, make one
  if (!is_wp_error($errors))  $errors = new WP_Error;
  
  // Validate form data
  
  if (empty($fields['user_pass']) || empty($fields['user_email'])) {
    $errors->add('field', 'Required form field is missing');
  }

  if (strlen($fields['user_pass']) < 5) {
    $errors->add('user_pass', 'Password length must be greater than 5');
  }

  if (!is_email($fields['user_email'])) {
    $errors->add('email_invalid', 'Email is not valid');
  }

  if (email_exists($fields['user_email'])) {
    $errors->add('email', 'Email Already in use');
  }
  
  // If errors were produced, fail
  if (count($errors->get_error_messages()) > 0) {
    return false;
  }
  
  // Else, success!
  return true;
}



///////////////
// SHORTCODE //
///////////////

// The callback function for the [cr] shortcode
function cr_cb() {
  $fields = array();
  $errors = new WP_Error();
  
  // Buffer output
  ob_start();
  
  // Custom registration, go!
  cr($fields, $errors);
  
  // Return buffer
  return ob_get_clean();
}
add_shortcode('cr', 'cr_cb');