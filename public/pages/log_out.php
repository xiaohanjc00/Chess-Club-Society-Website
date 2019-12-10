<?php require_once('../../private/initialise.php'); ?>

<?php 
    log_out_user();
    redirect_to(url_for('index.php'));
?>