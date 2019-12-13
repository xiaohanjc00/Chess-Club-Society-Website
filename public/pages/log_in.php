<?php require_once('../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<html>
<style type="text/css">
.join a {
    color: #37474f;
    text-decoration: underline;
  }

  .join a:hover{
    color: #45a049;
    text-decoration: overline;
  }

  p{
    color: #37474f;
    text-indent: 25px;
    font-size: 20px;
  }
</style>
</html>

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
 
<form width=" 800px;" margin="auto;" style="color: #37474f; font-size:25px;" align="left" action="log_in.php" method="post">
    Username : 
    <input type="text" name="Username" value="<?php echo h($username); ?>"><br>
    
    Password : 
    <input type="text" name="Password" value=""><br>
      
      <p style="text-decoration: underline;">Forgot password ?</p>
    
    <input type="submit" name="submit" value="Submit" />
</form>
  <br>
  <h2 style="font-size: 25px;">Why you should join us ?</h2>
  <p>Whether you’re the next Magnus Carlsen or a complete beginner just hoping to learn the rules of chess, the chess society has something for you. In our relaxed weekly sessions beginners will be able to learn the rules and basic strategies of the game, while more experienced players can test their skills against worthy opposition.
  </p>
  <br>

  <div class="join">
    <a href="<?php echo url_for('pages/sign_up.php'); ?>">Join the Chess Society now !</a>
  </div>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
