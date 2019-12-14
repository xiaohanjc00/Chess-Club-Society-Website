<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>

<?php
      
    try {
        $event = find_event_by_id($_GET['id']);
        if (mysqli_num_rows($event) > 0) {
            while($row = mysqli_fetch_assoc($event)){
                delete_event($row['eventID']) ;
            } 
        }
        else{
            echo '<div class="card">';
            echo '<p> No events could be found.</p>';         
            echo '</div>'; 
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }

    echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
?>
  
 