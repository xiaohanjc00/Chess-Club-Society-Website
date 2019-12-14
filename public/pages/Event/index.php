<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>


<link rel="stylesheet" media="all" href="<?php echo url_for('pages/stylesheets/eventsStyle.css'); ?>"/>

    <div class="main">
        <div class="header">
            <h2 class="header_title">Opening Events</h2>
        </div>

        <div class="row">

            <div id = "main" class="leftcolumn">
          
            <?php

                function get_words($sentence, $count = 35) {
                    preg_match("/(?:\w+(?:\W+|$)){0,$count}/", $sentence, $matches);
                    return $matches[0];
                }
            
                try {
                    $event = find_all_events();

                    if (mysqli_num_rows($event) > 0) {

                        while($row = mysqli_fetch_assoc($event)){
                            date_default_timezone_get();
                            $currentDateTime = date('Y-m-d');
                            $currentdatetime1 =  date_create($currentDateTime);
                            $eventdatetime2 =  date_create(date('Y-m-d',strtotime($row['eventExpiry'])));

                            if($currentdatetime1 == $eventdatetime2 ){
                                delete_event($row['eventID']); 
                            }
                            else{
                                echo '<div class="card">';

                                if(is_logged_in() && user_is_admin()){
                                    echo '<div class="dropdown">';
                                    echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"></i>';
                                    echo '<span class="caret"></span></button>';
                                    echo '<div class="dropdown-content ">';
                                    echo  '<a href="edit.php?id='.$row['eventID'].'">Edit</a>';
                                    echo '<a href="delete.php?id='.$row['eventID'].'">Delete</a>';
                                    echo '</div>';   
                                    echo '</div>';
                                }

                                echo '<h1>'. $row['eventTitle'] .'</h1>';
                                echo '<p>Posted on '.date('jS M Y H:i:s', strtotime($row['eventDate'])).'</p>';
                                echo '<img class="fakeimg" src="' .$row['eventImage'] .'"">';
                                echo '<p>'. get_words($row['eventDesc']).'</p>';           
                                echo '</div>';
                            }
                        }
                    }

                    else{
                        echo '<div class="card">';
                        echo '<p> No events could be found.</p>';         
                        echo '</div>'; 
                    }
                  
                }

                 catch(PDOException $e) {
                    echo $e->getMessage();
                }

            ?>

            </div>
                <div class="rightcolumn">

                <?php 

                  if(is_logged_in() && user_is_admin()){
                      echo "<div class='card'>";
                      echo "<form action='new.php'>";
                      echo "<input type='submit' value='Create new event' />";
                      echo "</form>";
                  }

                ?>

            </div>
        </div>
    </div>
    </div>


<?php include(SHARED_PATH . '/footer.php'); ?>
