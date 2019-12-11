<?php

  require_once('../../private/initialise.php');

  if(!isset($_GET['id'])) {
    redirect_to(url_for('index.php'));
  }
  $id = $_GET['id'];

  if (is_post_request()) {
    $user = find_user_by_id($id);
    $result = delete_user($user);
    if($result === true) {
      $_SESSION['message'] = 'Your profile was successfully deleted!';
      redirect_to(url_for('/pages/index.php'));
    } else {
      $errors = $result;
    }
  } else {
    $user = find_user_by_id($id);
  }
?>

<?php $page_title = 'Delete Profile'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<div>
  <a href="<?php echo url_for('pages/profile.php'); ?>">&laquo; Back to Profile</a>
  <div>
    <h2>Delete Profile</h2>
    <?php echo display_errors($errors); ?>
     <form width=" 800px;" margin="auto;" style="font-size:17px; color: #37474f;" align="left" action="<php delete_user(); ?>"><input type="submit" value="Delete Chess Society Account" onclick="return confirm('You are about to withdraw as a member of the Chess Society and have all your data removed. Do you want to continue ?')"></form>
    </div>
  </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
