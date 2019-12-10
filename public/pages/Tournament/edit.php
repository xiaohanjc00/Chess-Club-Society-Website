<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

    <?php
        if(is_post_request()) {
            $tournament = [];
            $tournament['organizer'] = $_POST['organizer'] ?? '';
            $tournament['name'] = $_POST['name'] ?? '';
            $tournament['date'] = $_POST['date'] ?? '';
            $tournament['deadline'] = $_POST['deadline'] ?? '';
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $result = update_tournament($tournament, $id);
            if($result === true) {
                $_SESSION['message'] = 'New tournament successfully created!';
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            } else {
                $errors = $result;
            }
        } else {
            $tournament = [];
            $tournament['organizer'] = '';
            $tournament['name'] = '';
            $tournament['date'] = '';
            $tournament['deadline'] = '';
        }
    ?>

    <?php
        echo '<div >' ;
        echo '<h4>Edit a tournament now!</h4>';
        echo '<p>Please fill in the forms:</p>';  

        echo ' <?php echo display_errors($errors); ?>';

        echo '<form width="800px" margin="auto"  action="edit.php?id='. $_GET['id'] .'" method="post">';
        echo '<dl> <dt>Tournament organizer:</dt><dd><input type="text" name="organizer" value="'.$tournament['organizer'] . '" /></dd> </dl>' ;
        echo '<dl> <dt>Tournament Name:</dt><dd><input type="text" name="name" value="'.$tournament['name'] . '" /></dd> </dl>' ;
        echo '<dl> <dt>Tournament date:</dt><dd><input type="text" name="date" value="'.$tournament['date'] . '" /></dd> </dl>' ;
        echo '<dl> <dt>Registration deadline:</dt><dd><input type="datetime-local" name="deadline" value="'.$tournament['deadline'] . '" /></dd> </dl>' ;

        echo '<div> <input type="submit" value="Post new tournament" /> </div>';
        echo '</form>';
        echo '</div>';
    ?>
