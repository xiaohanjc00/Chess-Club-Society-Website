<?php require_once('../../../private/initialise.php'); ?>
<?php include(SHARED_PATH . '/header.php'); ?>
<?php

if($_GET["show"] == "match"){
    $match = find_all_tournamentMatches($_GET["id"]);
    $round = 1;

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
    if (mysqli_num_rows($match) > 0) {
        while($row = mysqli_fetch_assoc($match)){
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
            echo "<tr>";
            echo "<th scope='col'>". $row["firstparticipantID"]. "</th>";
            echo "<th scope='col'>". $row["secondparticipantID"]. "</th>";
            echo $row["roundWinner"];
            if(is_null($row["roundWinner"])){
                echo "<th scope='col'> Winner not announced </th>";
            }else{
                echo "<th scope='col'>". $row["roundWinner"]. "</th>";
            }

            echo "</tr>";
            
            $round = $row["roundNumber"];
         }
    }
    echo '</tbody>';
    echo '</table>';
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


?>
<?php include(SHARED_PATH . '/footer.php'); ?>