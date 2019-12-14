<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>

<?php
    if($_GET["delete"] == "tournament"){
        try {
            $article = find_tournament_by_id($_GET['id']);
            delete_tournament($article['tournamentID']) ;
         
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
    }
    else if($_GET["delete"] == "organizer"){

        if(is_post_request()) {
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $tournament = [];
            $tournament['coorganizer'] = $_POST['coorganizer'] ?? '';
            $tournament['tournamentID'] = $id ;

            $result = delete_tournament_organizer($tournament);
            if($result === true) {
                $_SESSION['message'] = 'Co-organizer successfully removed!';
                echo $_SESSION['message'];
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            } else {
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            }
        } else {
            $tournament = [];
            $tournament['coorganizer'] = '';
            $tournament['tournamentID'] = '';
        }

        echo '<form width="800px" margin="auto"  action="delete.php?delete='. $_GET['delete'] .'&&id='. $_GET['id'] . '" method="post">';
            
        $admins = find_organizers_by_tournament_id($_GET['id']);

        echo "<select name='coorganizer'>";
        if (mysqli_num_rows($admins) > 0) {
            while($row = mysqli_fetch_assoc($admins)){
                echo "<option value= " . $row["id"] .  "> ".  $row["first_name"] ." ". $row["last_name"] . "</option>";
            }
        }
        else{
            echo "<option value='None'> No user found </option>";
            echo "here";
        }
        echo "</select>";
        echo '<div> <input type="submit" value="Remove CoOrganizer from this tournament" /> </div>';
        echo '</form>';
        echo '</div>';
    }
?>
  
<?php include(SHARED_PATH . '/footer.php'); ?>