<?php require_once(realpath(dirname(__FILE__) . '/../../..'). '/private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<?php

    if($_GET["add"] == "tournament"){
        if(is_post_request()) {
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $tournament = [];
            $tournament['organizer'] = $id;
            $tournament['name'] = $_POST['name'] ?? '';
            $tournament['deadline'] = $_POST['deadline'] ?? '';
            $tournament['date'] = $_POST['date'] ?? '';

            $result = insert_tournament($tournament);

            if($result === true) {
                $_SESSION['message'] = 'New tournament successfully created!';
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            } 
            else {
                $errors = $result;
            }
        } 
        else {
            $tournament = [];
            $tournament['organizer'] = '';
            $tournament['name'] = '';
            $tournament['deadline'] = '';
            $tournament['date'] = '';
        }


        echo "<link rel='stylesheet' href='../stylesheets/newsStyle.css'>";

        echo '<div class="main">' ;
        echo '<h4>Create a new tournament!<h4>';
        echo '<p>Please fill in the forms:</p>';  

        echo display_errors($errors);

        echo '<form width="800px" margin="auto"  action="new.php?add='. $_GET['add'] .'&&id='. $_GET['id'] . '" method="post">';
        echo '<dl> <dt>Tournament Name:</dt><dd><input type="text" name="name" value="'. $tournament['name'] . '" /></dd> </dl>' ;
        echo '<dl> <dt>Tournament date:</dt><dd><input type="date" name="date" value="'. $tournament['date'] . '" /></dd> </dl>' ;
        echo '<dl> <dt>Registration deadline:</dt><dd><input type="date" name="deadline" value="'. $tournament['deadline'] . '" /></dd> </dl>' ;

        echo '<div> <input type="submit" value="Post new tournament" /> </div>';
        echo '</form>';
        echo '</div>';
    }

    else if($_GET["add"] == "coorganizer"){
        if(is_post_request()) {
            $id = isset($_GET['id']) ? $_GET['id'] : '';
            $tournament = [];
            $tournament['coorganizer'] = $_POST['coorganizer'] ?? '';
            $tournament['tournamentID'] = $id ;

            $result = insert_tournament_organizer($tournament);

            if($result === true) {
                $_SESSION['message'] = 'New co-organizer successfully added!';
                echo $_SESSION['message'];
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            } 
            else {
                $_SESSION['Error'] = "All admins have been assigned to this tournament !";

                if (isset($_SESSION["Error"])){ 
                    echo  $_SESSION["Error"] ; 
                    unset($_SESSION["Error"]); 
                }
                echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            }
        } 
        else {
            $tournament = [];
            $tournament['coorganizer'] = '';
            $tournament['tournamentID'] = '';
        }
        
        echo "<link rel='stylesheet' href='../stylesheets/newsStyle.css'>" ;

        echo "<div class='header'>";
        echo "<h2>Tournament</h2>";
        echo "</div>";

        echo '<div >' ;
        echo '<h4>Create a new tournament!<h4>';
        echo '<p>Please fill in the forms:</p>';  

        echo display_errors($errors); 
        echo '<form width="800px" margin="auto"  action="new.php?add='. $_GET['add'] .'&&id='. $_GET['id'] . '" method="post">';
            
        $admins = find_admins($_GET['id']);

        echo "<select name='coorganizer'>";

        if (mysqli_num_rows($admins) > 0) {
            while($row = mysqli_fetch_assoc($admins)){
                echo "<option value=" . $row["id"] .  ">".  $row["first_name"] ." ". $row["last_name"] . "</option>";
            }
        }
        else{
            echo "<option value='None'> No user found </option>";
        }
        echo "</select>";
        echo '<div> <input type="submit" value="Add CoOrganizer to this tournament" /> </div>';
        echo '</form>';
        echo '</div>';
    }

    else if($_GET["add"] == "participant"){
        insert_tournament_participant($_GET["userid"], $_GET["id"]);
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';     
    }

    else if($_GET["add"] == "match"){

        function scheduler($teams){
            $round = [];

            if (count($teams)%2 != 0){
                array_push($teams,"not playing");
            }

            $away = array_splice($teams,(count($teams)/2));
            $home = $teams;

            for ($i=0; $i < count($home)+count($away)-1; $i++){
                for ($j=0; $j<count($home); $j++){
                    $round[$i][$j]["Home"]=$home[$j];
                    $round[$i][$j]["Away"]=$away[$j];
                }

                if(count($home)+count($away)-1 > 2){
                    $splice = array_splice($home,1,1);
                    array_unshift($away, array_shift($splice));
                    array_push($home,array_pop($away));
                }
            }
            return $round;
        }

        function get_match($schedule, $count){
            if($count < sizeof($schedule)){
                $games = $schedule[$count];
                $count = $count + 1;
                $members = [];
                $matches = [];
                foreach($games AS $play){  
                    if($play["Home"] != "not playing" && $play["Away"] != "not playing" ){
                        $matches['firstparticipantID'] = $play["Home"]["id"];
                        $matches['secondparticipantID'] = $play["Away"]["id"];
                        $matches['tournamentID'] = $_GET["id"];
                        $matches['roundNumber'] = $count;
                        insert_tournament_matches($matches);
                    }
                }
                get_match($schedule, $count);
            }
        }

        function generate_schedule(){
            $participant = find_all_tournamentParticipants($_GET["id"]); 
            $members = [];
            if (mysqli_num_rows($participant) > 0) {
                while($row = mysqli_fetch_assoc($participant)){
                    array_push($members, $row );
                }
            }
            $schedule = scheduler($members);
            get_match($schedule, 0);
        }

        generate_schedule();
        echo '<meta http-equiv="refresh" content="0;URL=index.php"/>';
            
    }

?>
  
<?php include(SHARED_PATH . '/footer.php'); ?>
