<?php require_once('../../../private/initialise.php'); ?>
<?php
  require_login();

  if(!isset($_GET['id'])) {
    redirect_to(url_for('/index.php'));
  }
  $id = $_GET['id'];

  if (is_post_request()) {
    log_out_user();
    $result = delete_user($id);
    if($result === true) {
      $_SESSION['message'] = 'Your profile data was deleted.';
      redirect_to(url_for('/index.php'));
    }
  }
?>

<?php $page_title = 'Cancel Membership and Delete Profile?'; ?>
<?php include(SHARED_PATH . '/header.php'); ?>

  <div>
    <a href="<?php echo url_for('pages/profile/index.php'); ?>">&laquo; Back to Profile</a>
    <div>
      <h2>Delete Profile</h2>
      <p>Deleting your profile will cancel your membership and remove all of your data.</p>
      <form action="<?php echo url_for('pages/profile/delete.php?id=' . h(u($id))); ?>" method="post">
        <input type="submit" value="Delete my profile">
      </form>
    </div>
  </div>

<?php include(SHARED_PATH . '/footer.php'); ?>
