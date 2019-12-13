<?php require_once('../../private/initialise.php'); ?>

<html>
  <style type="text/css">
  
  h1 {
    color: #37474f;
    text-decoration: underline;
    text-align: center;
  }

  p{
    color: #37474f;
    font-size: 25px;
    text-indent: -25px;
  }
  
  .sidenav {
  height: 100%;
  width: 250px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #37474f;
  overflow-x: hidden;
  padding-top: 20px;
  border-right: 3px solid black;
}

.sidenav a {
  padding: 12px 16px 20px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #b4c3cb;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 300px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

input[type=text], select {
  width: 100%;
  color: #37474f;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #37474f;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=password]{
  width: 100%;
  color: #37474f;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #37474f;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #37474f;
  color: #f1f1f1;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #b4c3cb;
}

.error {color: #FF0000;}  /* span class error */
    
</style>
</html>

<?php
  if(is_post_request()) {
    $user = [];
    $user['first_name'] = $_POST['first_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['dob'] = $_POST['dob'] ?? '';
    $user['gender'] = $_POST['gender'] ?? '';
    $user['phone'] = $_POST['phone'] ?? '';
    $user['address'] = $_POST['address'] ?? '';
    $user['email'] = $_POST['email'] ?? '';
    $user['username'] = $_POST['username'] ?? '';
    $user['password'] = $_POST['password'] ?? '';
    $user['confirm_password'] = $_POST['confirm_password'] ?? '';
    $user['skill'] = $_POST['skill'] ?? '';

    
    $result = insert_user($user);
    if($result === true) {
      $_SESSION['message'] = 'New account successfully created!';
      redirect_to(url_for('pages/log_in.php'));
    } else {
      $errors = $result;
    }
  } else {
    $user = [];
    $user['first_name'] = '';
    $user['last_name'] = '';
    $user['dob'] = '';
    $user['gender'] = '';
    $user['phone'] = '';
    $user['address'] = '';
    $user['email'] = '';
    $user['username'] = '';
    $user['password'] = '';
    $user['confirm_password'] = '';
    $user['skill'] = '';
  }
?>

<?php $page_title = 'Create Profile'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div class="main">
  <h2>Join the Chess Society now!</h2>
  <p>Please enter your details:</p>
  <?php echo display_errors($errors); ?>
    <form width="800px" margin="auto" action="<?php echo url_for('pages/sign_up.php?'); ?>" method="post">
      
      <dl>
        <dt>First name:</dt>
        <dd> <span class="error">* <?php echo $FNameErr;?></span> <input type="text" name="first_name" value="<?php echo h($user['first_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Last name:</dt>
        <dd> <span class="error">* <?php echo $LNameErr;?></span> <input type="text" name="last_name" value="<?php echo h($user['last_name']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Date of birth:</dt>
        <dd> <span class="error">* <?php echo $DobErr;?></span> <input type="text" name="dob" value="<?php echo h($user['dob']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Gender:</dt>
        <dd>
          <input type="radio" name="gender" <?php if(isset($gender) && $gender=="male") echo "checked";?> value="<?php echo h($user['gender']); ?>" /> Male 
          <input type="radio" name="gender" <?php if(isset($gender) && $gender=="female") echo "checked";?> value="<?php echo h($user['gender']); ?>" /> Female
          <input type="radio" name="gender" <?php if(isset($gender) && $gender=="other") echo "checked";?> value="<?php echo h($user['gender']); ?>" /> Other
          <span class="error">* <?php echo $genderErr;?></span>
        </dd>
      </dl>

      <dl>
        <dt>Phone Number:</dt>
        <dd> <span class="error">* <?php echo $PhoneErr;?></span><input type="text" name="phone" value="<?php echo h($user['phone']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Address:</dt>
        <dd> <input type="text" name="address" value="<?php echo h($user['address']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Email:</dt>
        <dd> <input type="text" name="email" value="<?php echo h($user['email']); ?>" /><br /></dd>
      </dl>

      <dl>
        <dt>Username:</dt>
        <dd> <span class="error">* <?php echo $UsernameErr;?></span><input type="text" name="username" value="<?php echo h($user['username']); ?>" /></dd>
      </dl>

      <dl>
        <dt>Password:</dt>
        <dd> <span class="error">* <?php echo $PasswordErr;?></span><input type="password" name="password" value="" /></dd>
      </dl>

      <dl>
        <dt>Confirm Password:</dt>
        <dd> <span class="error">* <?php echo $PasswordErr;?></span><input type="password" name="confirm_password" value="" /></dd>
      </dl>

      <dl>
        <dt>Ever played chess before ?</dt>
        <dd>
          <input type="radio" name="skill" value="<?php echo h($user['skill']); ?>"> <?php if (isset($skill) && $skill=="never") echo "checked";?> Never
          <input type="radio" name="skill" value="<?php echo h($user['skill']); ?>"><?php if (isset($skill) && $skill=="yes") echo "checked";?> Yes, few times
          <input type="radio" name="skill" value="<?php echo h($user['skill']); ?>"><?php if (isset($skill) && $skill=="pro") echo "checked";?> I'm a pro
      </dd>
      </dl>

      <p>
        Password must be at least 12 characters, with at least one uppercase letter, lowercase letter, number and symbol.
      </p>
      <br/>
      <div>
        <input type="submit" value="Sign up" />
      </div>
    </form>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
