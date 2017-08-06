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

      // And display a message
      echo 'Registration complete. Goto <a href="' . get_site_url() . '/wp-login.php">login page</a>.';
      
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
  update_user_meta( $user_id, 'gender', $fields['gender'] );
  update_user_meta( $user_id, 'birthday', $fields['birthday'] );
  update_user_meta( $user_id, 'phone_number', $fields['phone_number'] );
  update_user_meta( $user_id, 'user_paid', '0');
  update_user_meta( $user_id, 'waiver_signed', '0');
}

function cr_display_form($fields = array(), $errors = null) {
  
  // Check for wp error obj and see if it has any errors  
  if (is_wp_error($errors) && count($errors->get_error_messages()) > 0) {
    
    // Display errors
    ?><ul><?php
    foreach ($errors->get_error_messages() as $key => $val) {
      ?><li>
        <?php echo $val; ?>
      </li><?php
    }
    ?></ul><?php
  }
  
  // Disaply form
  
  ?><form action="<?php $_SERVER['REQUEST_URI'] ?>" method="post">

    <div>
      <label for="email">Email <strong>*</strong></label>
      <input type="text" name="user_email" value="<?php echo (isset($fields['user_email']) ? $fields['user_email'] : '') ?>">
    </div>

    <div>
      <label for="user_pass">Password <strong>*</strong></label>
      <input type="password" name="user_pass">
    </div>
  
    <div>
      <label for="firstname">First Name</label>
      <input type="text" name="first_name" value="<?php echo (isset($fields['first_name']) ? $fields['first_name'] : '') ?>">
    </div>
    
    <div>
      <label for="lastname">Last Name</label>
      <input type="text" name="last_name" value="<?php echo (isset($fields['last_name']) ? $fields['last_name'] : '') ?>">
    </div>

    <div class="two_input_section">
         <div class="input-title">Birthday</div>
         <input class="first_input" type="text" id="date" name="birthday" required><br>
    </div>

    <div class="two_input_section">
      <div class="input-title">Gender</div>
        <select name="gender" required>
          <option value="female">Female</option>
          <option value="male">Male</option>
        </select>
        <br>
    </div>

    <div>
      <label for="lastname">Phone</label>
      <input type="text" name="phone_number" value="<?php echo (isset($fields['phone_number']) ? $fields['phone_number'] : '') ?>">
    </div>
            
    <input type="submit" name="submit" value="Register">
    </form><?php
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