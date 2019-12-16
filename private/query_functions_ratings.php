<?php 

	// functions for updating ratings after tournaments:

    function update_ratings($t_id) {
        // check that tournament is complete and its results not already used to update ratings
        if (tournament_ended($t_id) && !tournament_ratings_updated($t_id)) {
            $matches_set = find_all_tournamentMatches($t_id);
            while($match = mysqli_fetch_assoc($matches_set)) {
                // update ratings of match participants
                update_ratings_from_match($match['roundWinner'], $match['roundLoser']);
                insert_new_rating($match);
            }
        mysqli_free_result($matches_set);
        set_tournament_ratings_updated($t_id);
            return true;
        }
        return false;
    }
    
    function tournament_ratings_updated($id) {
        global $db;
        $sql = "SELECT * FROM tournament ";
        $sql .= "WHERE tournamentID = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $tournament = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $tournament['ratingsUpdated'] == 1;
    }

    function set_tournament_ratings_updated($id) {
        global $db;
        $sql = "UPDATE tournament SET ";
        $sql .= "ratingsUpdated = 1 ";
        $sql .= "WHERE tournamentID = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }

    function update_ratings_from_match($winner_id, $loser_id) {
        // updates each player's rating from the match result
        $winner_rating = get_rating_by_id($winner_id);
        $loser_rating = get_rating_by_id($loser_id);
        update_rating($winner_id, $loser_id, 1);
        if($loser_rating <= 100){
            update_to_minimum($loser_id);
        } else{
            update_rating($loser_id, $winner_id, 0);
        }       
    }

    function update_rating($user_id, $opponent_id, $score) {
        global $db;

        $num_match = get_match_number($user_id);
        $user = find_user_by_id($user_id);
        $opponent = find_user_by_id($opponent_id);

        $Kfactor;
        if($num_match < 30){
            $Kfactor = 40;
        }else if($num_match >= 30 AND $user['rating'] < 2400 ){
            $Kfactor = 20;
        }else if($num_match >= 30 AND $user['rating'] > 2400){
            $Kfactor = 10;
        }else{
            $Kfactor = 40;
        }
        $expected_score = 1/ (1 + pow(10,($opponent['rating'] - $user['rating'])/400) );
        $new_rating = $user['rating'] + $Kfactor * ($score - $expected_score);

        if($new_rating <= 100){
            update_to_minimum($user_id);
        } else{
            $sql = "UPDATE users SET ";
            $sql .= "rating = '" . db_escape($db, $new_rating) . "' ";
            $sql .= "WHERE id = '" . db_escape($db, $user_id) . "' ";
            $sql .= "LIMIT 1";
            $result = mysqli_query($db, $sql);
            if($result) {
                return true;
            } else {
                echo mysqli_error($db);
                db_disconnect($db);
                exit;
            }
        }

        
    }

    function update_to_minimum($user_id) {
        global $db;

        $sql = "UPDATE users SET ";
        $sql .= "rating = 100"; 
        $sql .= " WHERE id = '" . db_escape($db, $user_id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        if($result) {
            return true;
        } else {
            echo mysqli_error($db);
            db_disconnect($db);
            exit;
        }
    }


    function get_match_number($id){
        global $db;
        $sql = "SELECT firstparticipantID, count(*) ";
        $sql .= "FROM tournamentmatches";
        $sql .= " WHERE firstparticipantID = '" . $id . "' ";
        $sql .= "GROUP BY firstparticipantID;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $match1 = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $sql = "SELECT secondparticipantID, count(*) ";
        $sql .= "FROM tournamentmatches";
        $sql .= " WHERE secondparticipantID = '" . $id . "' ";
        $sql .= "GROUP BY secondparticipantID;";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $match2 = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $match1["count(*)"] + $match2["count(*)"];
    }

    function get_rating_by_id($id) {
        global $db;
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE id = '" . db_escape($db, $id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $user = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $user['rating'];
    }

    function tournament_ended($t_id) {
        global $db;
        $sql = "SELECT * FROM tournament ";
        $sql .= "WHERE tournamentID = '" . db_escape($db, $t_id) . "' ";
        $sql .= "LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $tournament = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if (is_null($tournament['winnerID'])) {
            // tournament data not yet entered
            return false;
        }
        // tournament complete: all match data has been entered
        return true;
    }    

    function get_elo($user_id, $tournament_id){
        global $db;

        $sql = "SELECT firstparticipantID, firstparticipantoldelo, firstparticipantnewelo, roundNumber FROM tournamentMatches ";
        $sql .= "WHERE firstparticipantID = '" . db_escape($db, $user_id) . "' AND ";
        $sql .= "tournamentID = '" . db_escape($db, $tournament_id) . "' ";
        $sql .= "ORDER BY roundNumber DESC LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $firstparticipant = mysqli_fetch_assoc($result);

        $sql = "SELECT secondparticipantID, secondparticipantoldelo, secondparticipantnewelo, roundNumber FROM tournamentMatches ";
        $sql .= "WHERE secondparticipantID = '" . db_escape($db, $user_id) . "' AND ";
        $sql .= "tournamentID = " . db_escape($db, $tournament_id) . "' ";
        $sql .= "ORDER BY roundNumber DESC LIMIT 1";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $secondparticipant = mysqli_fetch_assoc($result);
        
        if($firstparticipant['roundNumber'] < $secondparticipant['roundNumber']){
            $rating['before'] = $secondparticipant['secondparticipantoldelo'];
            $rating['after'] = $secondparticipant['secondparticipantnewelo'];
            
            return $rating;
        } else {
            $rating['before'] = $firstparticipant['firstparticipantoldelo'];
            $rating['after'] = $firstparticipant['firstparticipantnewelo'];
            
            return $rating;
        }
        
    }

?>