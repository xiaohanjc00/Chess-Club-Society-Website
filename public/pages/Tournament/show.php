<?php require_once('../../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<?php

if($_GET["show"] == "match"){
    if ($_GET["update"] == "ratings") {
        if (update_ratings($_GET["id"])) {
            echo '<div id="message">Ratings successfully updated!</div>';
        } else {
            echo '<div id="message">Ratings update error.</div>';
        }
    }
    $tournamentMatch = find_all_tournamentMatches($_GET["id"]);
    $round = 1;
    $currentTournament = find_tournament_by_id($_GET["id"]);
    $currentDateTime = date('Y-m-d');
    $currentdatetime1 =  date_create($currentDateTime);
    $tournamentDate =  date_create(date('Y-m-d',strtotime($currentTournament['tournamentDate'])));
    $tournamentDeadline =  date_create(date('Y-m-d',strtotime($currentTournament['deadline'])));

    echo "<h3> Round : ". $round ." </h3>";
    echo '<table class="table table-hover table-dark">	<!-- style="width:100%" -->';
    echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">First Participant</th>';
        echo '<th scope="col">Second Participant</th>';			
        echo '<th scope="col"> Winner</th>';
        echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

        while($row = mysqli_fetch_assoc($tournamentMatch)){
            if($row["roundNumber"] != $round){
                echo '</tbody>';
                echo '</table>';
                echo "<h3> Round : ". $row["roundNumber"]. " </h3>";
                echo '<table class="table table-hover table-dark">	<!-- style="width:100%" -->';
                echo '<thead>';
                    echo '<tr>';
                    echo '<th scope="col">First Participant</th>';
                    echo '<th scope="col">Second Participant</th>';			
                    echo '<th scope="col"> Winner</th>';
                    echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
            }
            $first_user = find_user_by_id($row["firstparticipantID"]);

            $second_user = find_user_by_id($row["secondparticipantID"]);
  
            
            echo "<tr>";
            echo "<th scope='col'>". $first_user['first_name'] . " " . $first_user['last_name'] . "</th>";
            echo "<th scope='col'>". $second_user['first_name'] . " " . $second_user['last_name'] . "</th>";
            if(is_null($row["roundWinner"])){
                echo "<th scope='col'> Winner not announced </th>";
                if(is_logged_in() && user_is_admin()){
                    echo '<th scope = "col">'; 
                    if(($row["roundNumber"] != 1 && !find_previous_round_winners($row["tournamentID"],( $row["roundNumber"]-1)) OR $row["roundNumber"] == 1)){
                        echo '<form method="post">';
                            echo '<input type="radio" name="winner" value="'. $row["firstparticipantID"] .'"> First Participant   ';
                            echo '<input type="radio" name="winner" value="'. $row["secondparticipantID"] .'" > Second Participant';
                            echo '<input type="submit"  name="set_winner'.$row["firstparticipantID"]. $row["secondparticipantID"].'" value="Set winner" />';
                        echo '</form>';
                    }
                    echo '</th>';
                }
            }else{
                $match_winner = find_user_by_id($row["roundWinner"]);
                echo "<th scope='col'>". $match_winner["first_name"]. " " .$match_winner["last_name"]. "</th>";
                
            }
            echo "</tr>";
                if(isset($_POST['set_winner'.$row["firstparticipantID"]. $row["secondparticipantID"]])) {
                    $match = [];
                    $match['firstparticipantID'] = $row["firstparticipantID"];
                    $match['secondparticipantID'] = $row["secondparticipantID"];
                    $match['matchID'] = $row["roundNumber"];
                    $match['winner'] = $_POST["winner"] ;
                    $match['tournamentID'] = $row["tournamentID"];
                    if($_POST["winner"]   == $row["secondparticipantID"] ){
                        $match['loser'] = $row["firstparticipantID"];
                    }
                    else{
                        $match['loser'] = $row["secondparticipantID"];
                    }
                    $id = isset($_GET['id']) ? $_GET['id'] : '';
                    $result = set_winner($match, $id);
                    if($result === true) {
                        $secondsWait = 0;
                        echo '<meta http-equiv="refresh" content="'.$secondsWait.'">';
                    } else {
                        $errors = $result;
                    }
                } else {
                    $match = [];
                    $match['firstparticipantID'] = '';
                    $match['secondparticipantID'] = '';
                    $match['matchID'] = '';
                    $match['deadline'] = '';
                    $match['winner'] ='';
                    $match['tournamentID'] = '';
                    $match['loser'] = '';
                }
            
            $round = $row["roundNumber"];
         
    }
    echo '</tbody>';
    echo '</table>';
    
    if(!find_all_tournament_winners($_GET['id']) && !tournament_ratings_updated($_GET['id'])){
        set_tournament_winner($_GET['id'] );
        echo '<form width="800px" margin="auto" action="show.php?update=ratings&&show=match&&id='. $_GET['id'] .'" method="post">';
        echo '<div><input type="submit" value="Update all participant ratings" /></div>';
        echo '</form>';
        //update_ratings($_GET["id"]);
    }
    else{
        $winner = find_user_by_id(get_tournament_winner($_GET["id"]));
        $first_runner_up = find_user_by_id(get_tournament_runner_up($_GET["id"]) );
        echo '<p> The winner of this tournament is :'. $winner['first_name'] . ' ' . $winner['last_name'] . '</p>';
        echo '<p> The first runner up of this tournament is :'. $first_runner_up['first_name'] . ' ' . $first_runner_up['last_name'] . '</p>';
    }
}
else if($_GET["show"] == "participant"){
    $match = find_all_tournamentParticipants($_GET["id"]);
    echo "<h3> Participants : </h3>";
    if (mysqli_num_rows($match) > 0) {
        while($row = mysqli_fetch_assoc($match)){
            echo "<p> " .$row["first_name"] . " ".  $row["last_name"] . "</p>";
        }
    }
    else{
        echo "<p> No one joined this tournament. </p>";
    }
}
else


?>
<?php include(SHARED_PATH . '/footer.php'); ?>