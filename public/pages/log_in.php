<?php require_once('../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<?php include(SHARED_PATH . '/navigation.php'); ?>

<div>

  <form width="800px" margin="auto" style="color: #37474f font-size:25px" align="left" action="TODO" method="post">
      Username:
      <input type="text" name="Username"><br>
      Password:
      <input type="text" name="Password"><br>    
      <input type="submit">
  </form>

</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
