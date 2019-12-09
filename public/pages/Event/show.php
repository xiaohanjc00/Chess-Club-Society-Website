<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>


<link rel="stylesheet" href=".../.../newsStyle.css">
<div class="header">
  <h2>Opening Events</h2>
</div>

<div class="row">
  <div id = "main" class="centercolumn">
  <?php
        $dbhost = 'localhost';
        $dbuser = 'root';
        $dbpass = '';
        $dbname = 'chess_society';
    
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
      
    try {
        //echo "a";
        $event = find_event_by_id($_GET['id']);
        if (mysqli_num_rows($event) > 0) {
            while($row = mysqli_fetch_assoc($event)){
                date_default_timezone_get();
                $currentDateTime = date('Y-m-d');
                $currentdatetime1 =  date_create($currentDateTime);
                $eventdatetime2 =  date_create(date('Y-m-d',strtotime($row['eventDate'])));
                $dDiff = $eventdatetime2 ->diff($currentdatetime1);
                if($dDiff->format('%r%a') > 7){
                    mysqli_query($connection, 'DELETE FROM opening_event WHERE eventID='.$row['eventID'] );
                }
                else{
                    echo '<div class="card">';
                        echo '<h1>'.$row['eventTitle'].'</h1>';
                        echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['eventDate'])).'</p>';
                        echo '<img class="fakeimg" src="' .$row['eventImage'] .'"">';
                        echo '<p>'.$row['eventDesc'].'</p>';                            
                    echo '</div>';
                }
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
?>
    
    
  </div>
  
<a href="#" onclick="history.go(-1)">Go Back</a>
    
  </div>
</div>