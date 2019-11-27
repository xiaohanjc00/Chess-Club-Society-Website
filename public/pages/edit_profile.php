<?php

  require_once('../../private/initialise.php');

  if(!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
  }
  $id = $_GET['id'];

  if (is_post_request()) {
    // new user details were just submitted
    $user = []
    $user['id'] = $id;
    $user['first_name'] = $_POST['first_name'] ?? '';
    $user['last_name'] = $_POST['last_name'] ?? '';
    $user['dob'] = $_POST['dob'] ?? '';
    $user['gender'] = $_POST['gender'] ?? '';
    $user['phone'] = $_POST['phone'] ?? '';
    $user['address'] = $_POST['address'] ?? '';
    $user['email'] = $_POST['email'] ?? '';

    $result = update_user($user);
    if($result === true) {
      // $_SESSION['message'] = 'User profile updated';
      redirect_to(url_for('/pages/profile.php?id=' . $id));
    } else {
      $errors = $result;
    }
  } else {
    $user = find_user_by_id($id);
  }

?>

<?php $page_title = 'Edit Profile'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div>
  <a href="<?php echo url_for('/profile.php'); ?>">&laquo; Back to Profile</a>
  <div>
    <h2>Edit Profile</h2>
    <?php echo display_errors($errors); ?>
    <form action="<?php echo url_for('/edit_profile.php?id=' . h(u($id))); ?>" method="post">
      <dl>
        <dt>First name</dt><dd><input type="text" name="first_name" value="<?php echo h($user['first_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Last name</dt><dd><input type="text" name="last_name" value="<?php echo h($user['last_name']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Date of birth</dt><dd><input type="text" name="dob" value="<?php echo h($user['dob']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Gender</dt><dd><input type="text" name="gender" value="<?php echo h($user['gender']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Phone</dt><dd><input type="text" name="phone" value="<?php echo h($user['phone']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Address</dt><dd><input type="text" name="address" value="<?php echo h($user['address']); ?>" /></dd>
      </dl>
      <dl>
        <dt>Email</dt><dd><input type="text" name="email" value="<?php echo h($user['email']); ?>" /><br /></dd>
      </dl>
      <br />
      <div>
        <input type="submit" value="Update Profile" />
      </div>
      </form>
    </div>
  </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
