<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<link rel="stylesheet" href="../stylesheets/newsStyle.css">

<div class="header">
  <h2>Tournament</h2>
</div>

<div class="row">
  <div id = "main" class="center">
  <?php
    try {
        $article = find_all_tournaments();
        if (mysqli_num_rows($article) > 0) {
            while($row = mysqli_fetch_assoc($article)){
              $currentDateTime = date('Y-m-d');
              $currentdatetime1 =  date_create($currentDateTime);
              $tournamentDate =  date_create(date('Y-m-d',strtotime($row['tournamentDate'])));
              $tournamentDeadline =  date_create(date('Y-m-d',strtotime($row['deadline'])));


                echo '<div class="card">';
                    if(is_logged_in() && user_is_admin()){
                      $organizer = find_tournament_organizer($_SESSION['user_id'], $row['tournamentID']);
                      if (mysqli_num_rows($organizer) > 0) {
                        echo '<div class="dropdown">';
                        echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> </i>';
                        echo '<span class="caret"></span></button>';
                        echo '<div class="dropdown-content ">';
                        echo  '<a href="new.php?add=coorganizer&&id='.$row['tournamentID'].'">Add CoOrganizer</a>';
                        echo  '<a href="show.php?show=participant&&id='.$row['tournamentID'].'">Show participants</a>';
                        $match = find_all_tournamentMatches($row['tournamentID']);
                        if ($currentdatetime1 < $tournamentDate && $currentdatetime1 < $tournamentDeadline && mysqli_num_rows($match) == 0){
                          echo '<a href="new.php?add=match&&id='.$row['tournamentID'].'">Generate Match</a>';
                        }
                        echo  '<a href="edit.php?id='.$row['tournamentID'].'">Edit</a>';
                        echo '<a href="delete.php?delete=organizer&&id='.$row['tournamentID'].'">Remove organizer</a>';
                        echo '<a href="delete.php?delete=tournament&&id='.$row['tournamentID'].'">Delete</a>';
                        echo '</div>';  
                        echo '</div>';  
                      }
                    }
                    echo '<p> Name of the tournament :'. $row['tournamentName'].'</p>';
                    echo '<p> Date of the tournament :' . $row['tournamentDate'].'</p>';
                    echo '<p> Registration deadline: ' . $row['deadline'].'</p>';

                    if(is_logged_in() && user_is_member() && $currentdatetime1 < $tournamentDeadline){
                      $participant = find_tournament_and_participant($_SESSION['user_id'], $row['tournamentID']);
                      if (mysqli_num_rows($participant) > 0) {
                        echo "<p> You are already a participant ! </p>";
                      }
                      else{
                        echo "<a href='new.php?add=participant&&id=".$row['tournamentID']."&&userid=". $_SESSION['user_id']."'> Join tournament </a>";
                      }
                    }
                    else if(is_logged_in() && user_is_member()){
                      echo "<p> You can no longer register to this tournament ! </p>";
                    }
                    if(is_logged_in() && (user_is_member() && $currentdatetime1 > $tournamentDate) || ( is_logged_in() && user_is_admin() && $currentdatetime1 > $tournamentDeadline)){
                      echo "<a href='show.php?show=match&&id=". $row['tournamentID']. "'> See matches </a>";
                    }
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
        if(is_logged_in() && user_is_admin()){
          echo "<div class='card'>";
          echo "<a href='new.php?add=tournament&&id=". $_SESSION['user_id']. "'> Create new tournament </a>";
          echo "</div>";
        }
    ?>

  </div>
</div>

<?php include(SHARED_PATH . '/footer.php'); ?>
