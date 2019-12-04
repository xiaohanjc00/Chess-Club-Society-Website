<?php
  require_once('../../private/initialise.php');
  require_login();
  $id = $_GET['id'] ?? '1';
  $user = find_user_by_id($id);
  $first_name = h($user['first_name']);
  $last_name = h($user['last_name']);
  $rating = h($user['rating']);
  $dob = h($user['dob']);
  $gender = h($user['gender']);
  $phone = h($user['phone']);
  $address = h($user['address']);
  $email = h($user['email']);
?>

<?php $page_title = 'Profile'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<?php include(SHARED_PATH . '/navigation.php'); ?>

<?php echo display_session_message(); ?>
<div>
  <div>
      <dl><dt>First name: </dt><dd><?php echo $first_name ?></dd></dl>
      <dl><dt>Last name: </dt><dd><?php echo $last_name ?></dd></dl>
      <dl><dt>Chess rating: </dt><dd><?php echo $rating ?></dd></dl>
      <dl><dt>Date of birth: </dt><dd><?php echo $dob ?></dd></dl>
      <dl><dt>Gender: </dt><dd><?php echo $gender ?></dd></dl>
      <dl><dt>Phone number: </dt><dd><?php echo $phone ?></dd></dl>
      <dl><dt>Mailing address: </dt><dd><?php echo $address ?></dd></dl>
      <dl><dt>Email: </dt><dd><?php echo $email ?></dd></dl>
  </div>
  <div>
    <p>
      <a href="<?php echo url_for('pages/edit_profile.php?id=' . h(u($user['id']))); ?>">Edit Profile</a></br>
      <a href="<?php echo url_for('pages/delete_profile.php?id=' . h(u($user['id']))); ?>">Cancel membership</a></br>
    </p>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
