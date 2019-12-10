<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<link rel="stylesheet" href="../stylesheets/newsStyle.css">

<div class="header">
  <h2>Tournament</h2>
</div>

<div class="row">
  <div id = "main" class="right">
  <?php
    try {
        $article = find_all_tournaments();
        if (mysqli_num_rows($article) > 0) {
            while($row = mysqli_fetch_assoc($article)){
                echo '<div class="card">';
                    
                    if(user_is_admin()){
                      $organizer = find_tournament_organizer($_SESSION['user_id'], $row['tournamentID']);
                      if (mysqli_num_rows($organizer) > 0) {
                        echo '<div class="dropdown">';
                        echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> </i>';
                        echo '<span class="caret"></span></button>';
                        echo '<div class="dropdown-content ">';
                        echo  '<a href="new.php?add=coorganizer&&id='.$row['tournamentID'].'">Add CoOrganizer</a>';
                        echo  '<a href="edit.php?id='.$row['tournamentID'].'">Edit</a>';
                        echo '<a href="delete.php?id='.$row['tournamentID'].'">Delete</a>';
                        echo '</div>';  
                      }
                    }
                    echo '<p> Name of the tournament :'. $row['tournamentName'].'</p>'; 
                    echo '<p> Date of the tournament :' . $row['tournamentDate'].'</p>';
                    echo '<p> Registration deadline: ' . $row['deadline'].'</p>';
                    
                    if(user_is_member() ){
                      $participant = find_tournament_and_participant($_SESSION['user_id'], $row['tournamentID']);
                      if (mysqli_num_rows($participant) > 0) {
                        echo "<p> You are already a participant !";
                      }
                      else{
                        echo "<a href='new.php?add=participant&&id=".$row['tournamentID']."&&userid=". $_SESSION['user_id']."'> Join tournament </a>";
                      }
                    }

                    echo '</div>';              
                    echo '</div>';
            }
        }
        else{
            echo '<div class="card">';
                    echo '<p> No tournaments could be found.</p>';         
                echo '</div>'; 
        }

    } catch(PDOException $e) {
        echo $e->getMessage();
    }
    ?>
  </div>
  <div class ="">
    
    <?php
        if(user_is_admin()){
          echo "<div class='card'>";
          echo "<a href='new.php?add=tournament&&id=". $_SESSION['user_id']. "'> Create new tournament </a>";
          echo "</div>";
        }
    ?>
    
    
  </div>
</div>

    
<?php include(SHARED_PATH . '/footer.php'); ?>
 