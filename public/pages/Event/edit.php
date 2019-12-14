<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
    if(is_post_request()) {
        $event = [];
        $event['event_title'] = $_POST['event_title'] ?? '';
        $event['event_description'] = $_POST['event_description'] ?? '';
        $event['image_link'] = $_POST['image_link'] ?? '';
        $event['expiry_date'] = $_POST['expiry_date'] ?? '';
        $id = isset($_GET['id']) ? $_GET['id'] : '';
        $result = update_event($event, $id);

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

<?php
    echo '<div >' ;
    echo '<h4>Edit a Chess News event now!</h4>';
    echo '<p>Please fill in the forms:</p>';  

    echo display_errors($errors); 

    echo '<form width="800px" margin="auto"  action="edit.php?id='. $_GET['id'] .'" method="post">';
    echo '<dl> <dt>event Title:</dt><dd><input type="text" name="event_title" value="'.$event['event_title'] . '" /></dd> </dl>' ;
    echo '<dl> <dt>event Description:</dt><dd><input type="text" name="event_description" value="'.$event['event_description'] . '" /></dd> </dl>' ;
    echo '<dl> <dt>Image Link:</dt><dd><input type="text" name="image_link" value="'.$event['image_link'] . '" /></dd> </dl>' ;
    echo '<dl> <dt>Expiry date:</dt><dd><input type="date" name="expiry_date" value="'.$event['expiry_date'] . '" /></dd> </dl>' ;

    echo '<div> <input type="submit" value="Edit event" /> </div>';
    echo '</form>';
    echo '</div>';
?>

<?php include(SHARED_PATH . '/footer.php'); ?>
