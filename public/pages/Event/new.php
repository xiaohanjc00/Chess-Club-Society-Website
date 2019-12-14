<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
    if(is_post_request()) {
        $event = [];
        $event['event_title'] = $_POST['event_title'] ?? '';
        $event['event_description'] = $_POST['event_description'] ?? '';
        $event['image_link'] = $_POST['image_link'] ?? '';
        $event['expiry_date'] = $_POST['expiry_date'] ?? '';

        $result = insert_event($event);

        if($result === true) {
            $_SESSION['message'] = 'New event successfully created!';
            echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
        } 
        else {
            $errors = $result;
        }

    } 
    else {
        $event = [];
        $event['event_title'] = '';
        $event['event_description'] = '';
        $event['image_link'] = '';
        $event['expiry_date'] = '';
    }
?>

    <link rel="stylesheet" href="../stylesheets/newsStyle.css">

    <div class="header">
        <h2>Events</h2>
    </div>


    <div >
        <h4>Post a new event now!</h4>
        <p>Please fill in the forms:</p>

        <?php echo display_errors($errors); ?>

        <form width="800px" margin="auto" action="<?php echo url_for('pages/Event/new.php'); ?>" method="post">
            <dl>
                <dt>Event Title:</dt><dd><input type="text" name="event_title" value="<?php echo h($event['event_title']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Event Description:</dt><dd><input type="text" name="event_description" value="<?php echo h($event['event_description']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Image Link:</dt><dd><input type="text" name="image_link" value="<?php echo h($event['image_link']); ?>" /></dd>
            </dl>

            <dl>
                <dt>Expiry date:</dt><dd><input type="date" name="expiry_date" value="<?php echo h($event['expiry_date']); ?>" /></dd>
            </dl>

            <div>
                <input type="submit" value="Post new event" />
            </div>
        </form>

    </div>

  
<?php include(SHARED_PATH . '/footer.php'); ?>
