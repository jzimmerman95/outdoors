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
      wp_insert_user($fields);
      
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
  $fields['user_login']   =  isset($fields['user_login'])  ? sanitize_user($fields['user_login']) : '';
  $fields['user_pass']    =  isset($fields['user_pass'])   ? esc_attr($fields['user_pass']) : '';
  $fields['user_email']   =  isset($fields['user_email'])  ? sanitize_email($fields['user_email']) : '';
  $fields['user_url']     =  isset($fields['user_url'])    ? esc_url($fields['user_url']) : '';
  $fields['first_name']   =  isset($fields['first_name'])  ? sanitize_text_field($fields['first_name']) : '';
  $fields['last_name']    =  isset($fields['last_name'])   ? sanitize_text_field($fields['last_name']) : '';
  $fields['nickname']     =  isset($fields['nickname'])    ? sanitize_text_field($fields['nickname']) : '';
  $fields['description']  =  isset($fields['description']) ? esc_textarea($fields['description']) : '';
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
      <label for="user_login">Username <strong>*</strong></label>
      <input type="text" name="user_login" value="<?php echo (isset($fields['user_login']) ? $fields['user_login'] : '') ?>">
    </div>
    
    <div>
      <label for="user_pass">Password <strong>*</strong></label>
      <input type="password" name="user_pass">
    </div>
    
    <div>
      <label for="email">Email <strong>*</strong></label>
      <input type="text" name="user_email" value="<?php echo (isset($fields['user_email']) ? $fields['user_email'] : '') ?>">
    </div>
    
    <div>
      <label for="website">Website</label>
      <input type="text" name="user_url" value="<?php echo (isset($fields['user_url']) ? $fields['user_url'] : '') ?>">
    </div>
    
    <div>
      <label for="firstname">First Name</label>
      <input type="text" name="first_name" value="<?php echo (isset($fields['first_name']) ? $fields['first_name'] : '') ?>">
    </div>
    
    <div>
      <label for="website">Last Name</label>
      <input type="text" name="last_name" value="<?php echo (isset($fields['last_name']) ? $fields['last_name'] : '') ?>">
    </div>
    
    <div>
      <label for="nickname">Nickname</label>
      <input type="text" name="nickname" value="<?php echo (isset($fields['nickname']) ? $fields['nickname'] : '') ?>">
    </div>
    
    <div>
      <label for="bio">About / Bio</label>
      <textarea name="description"><?php echo (isset($fields['description']) ? $fields['description'] : '') ?></textarea>
    </div>
    
    <input type="submit" name="submit" value="Register">
    </form><?php
}

function cr_get_fields() {
  return array(
    'user_login'   =>  isset($_POST['user_login'])   ?  $_POST['user_login']   :  '',
    'user_pass'    =>  isset($_POST['user_pass'])    ?  $_POST['user_pass']    :  '',
    'user_email'   =>  isset($_POST['user_email'])   ?  $_POST['user_email']        :  '',
    'user_url'     =>  isset($_POST['user_url'])     ?  $_POST['user_url']     :  '',
    'first_name'   =>  isset($_POST['first_name'])   ?  $_POST['first_name']        :  '',
    'last_name'    =>  isset($_POST['last_name'])    ?  $_POST['last_name']        :  '',
    'nickname'     =>  isset($_POST['nickname'])     ?  $_POST['nickname']     :  '',
    'description'  =>  isset($_POST['description'])  ?  $_POST['description']  :  ''
  );
}

function cr_validate(&$fields, &$errors) {
  
  // Make sure there is a proper wp error obj
  // If not, make one
  if (!is_wp_error($errors))  $errors = new WP_Error;
  
  // Validate form data
  
  if (empty($fields['user_login']) || empty($fields['user_pass']) || empty($fields['user_email'])) {
    $errors->add('field', 'Required form field is missing');
  }

  if (strlen($fields['user_login']) < 4) {
    $errors->add('username_length', 'Username too short. At least 4 characters is required');
  }

  if (username_exists($fields['user_login']))
    $errors->add('user_name', 'Sorry, that username already exists!');

  if (!validate_username($fields['user_login'])) {
    $errors->add('username_invalid', 'Sorry, the username you entered is not valid');
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
  
  if (!empty($fields['user_url'])) {
    if (!filter_var($fields['user_url'], FILTER_VALIDATE_URL)) {
      $errors->add('user_url', 'Website is not a valid URL');
    }
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