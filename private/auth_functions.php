<?php

  function log_in_user($user) {
    session_regenerate_id();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['last_login'] = time();
    $_SESSION['username'] = $user['username'];
    return true;
  }

  function log_out_user() {
    unset($_SESSION['user_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    session_destroy();
    return true;
  }

  // This function should be called at the top of any page that
  // needs to check the user is logged in before showing.
  function require_login() {
    if(!is_logged_in()) {
      redirect_to(url_for('index.php'));
    } else {
      // display page (user is logged in)
    }
  }

  // Function that checks for a logged in admin
  function require_admin_login() {
    if(!user_is_admin()) {
      redirect_to(url_for('index.php'));
    } else {
      // display page to the admin
    }
  }

  // Function that checks for a logged in system admin
  function require_system_admin_login() {
    if(!user_is_system_admin()) {
      redirect_to(url_for('index.php'));
    } else {
      // display page to the admin
    }
  }

  function is_logged_in() {
    return isset($_SESSION['user_id']);
  }

  function user_is_admin() {
    $user = find_user_by_id($_SESSION['user_id']);
    return (is_logged_in() && $user['admin'] == "1");
  }

  function user_is_member() {
    $user = find_user_by_id($_SESSION['user_id']);
    return (is_logged_in() && $user['admin'] == "0");
  }

  function user_is_system_admin() {
    $user = find_user_by_id($_SESSION['user_id']);
    return (is_logged_in() && $user['system_admin'] == "1");
  }

?>
