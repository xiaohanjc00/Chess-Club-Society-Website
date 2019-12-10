<?php require_once('../../private/initialise.php'); ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<?php
  $errors = [];
  $username = '';
  $password = '';
  if(is_post_request()) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if(is_blank($username)) {
      $errors[] = "Please enter your username";
    }
    if(is_blank($password)) {
      $errors[] = "Please enter your password";
    }
    if(empty($errors)) {
      $login_fail_msg = "Log in failed";
      $user = find_user_by_username($username);
      if($user) {
        if(password_verify($password, $user['hashed_password'])) {
          log_in_user($user);
          redirect_to(url_for('pages/profile/index.php'));
        } else {
          $errors[] = $login_fail_msg;
        }
      } else {
        $errors[] = $login_fail_msg;
      }
    }
  }
?>


<div>
  <h2>Log in</h1>
  <?php echo display_errors($errors); ?>
  <form width="800px" margin="auto" style="color: #37474f font-size:25px" align="left" action="log_in.php" method="post">
      Username:
      <input type="text" name="username" value="<?php echo h($username); ?>"><br>
      Password:
      <input type="password" name="password" value="" >  
      <input type="submit" name="submit" value="Submit" />
  </form>
  <a href="<?php echo url_for('pages/sign_up.php'); ?>">Sign up</a>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
