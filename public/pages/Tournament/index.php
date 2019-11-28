<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>

<?php include(SHARED_PATH . '/header.php'); ?>

<link rel="stylesheet" href="/lab/stylesheets/newsStyle.css">

        <?php include(SHARED_PATH . '/navigation.php'); ?>
<div class="header">
  <h2>Tournament</h2>
</div>

<div class="row">
  <div id = "main" class="leftcolumn">
  <?php
    try {
        $article = find_all_tournaments();
        if (mysqli_num_rows($article) > 0) {
            while($row = mysqli_fetch_assoc($article)){
                echo '<div class="card">';
                    echo '<div class="dropdown">';
                    echo '<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"> </i>';
                    echo '<span class="caret"></span></button>';
                    echo '<div class="dropdown-content ">';
                    echo  '<a href="edit.php?id='.$row['tournamentID'].'">Edit</a>';
                    echo '<a href="delete.php?id='.$row['tournamentID'].'">Delete</a>';
                    echo '</div>';   
                    echo '<p>'. $row['tournamentName'].'</p>';  
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
  <div class="rightcolumn">
  
    <div class="card">
     <form action="new.php">
        <input type="submit" value="Create new tournament" />
    </form>
    
    </div>
  </div>
</div>

    
<?php include(SHARED_PATH . '/footer.php'); ?>
