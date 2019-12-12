<?php 

	// functions for updating ratings after tournaments:

    function update_ratings($t_id) {
        // check that tournament is complete and its results not already used to update ratings
        if (tournament_ended($t_id) && !tournament_ratings_updated($t_id)) {
            $matches_set = find_all_tournamentMatches($t_id);
            while($match = mysqli_fetch_assoc($matches_set)) {
                // update rankings of match participants
                update_ratings_from_match($match['roundWinner'], $match['roundLoser']);
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
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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
        $sql .= "ratingsUpdated='1' ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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
        if ($winner_rating > $loser_rating) {
            update_rating($winner_id, $winner_rating + ($winner_rating - $loser_rating));
            update_rating($loser_id, $loser_rating - ($winner_rating - $loser_rating));
        } else if ($winner_rating < $loser_rating) {
            update_rating($winner_id, $winner_rating + $loser_rating + 100);
            update_rating($loser_id, $loser_rating - $winner_rating - 100);
        } else {
            update_rating($winner_id, $winner_rating + 400);
            update_rating($loser_id, $loser_rating - 400);
        }
    }

    function update_rating($user_id, $new_rating) {
        global $db;
        $sql = "UPDATE users SET ";
        $sql .= "rating='" . db_escape($db, $new_rating) . "' ";
        $sql .= "WHERE id='" . db_escape($db, $user_id) . "' ";
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

    function get_rating_by_id($id) {
        global $db;
        $sql = "SELECT * FROM users ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
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
        $sql .= "WHERE id='" . db_escape($db, $t_id) . "' ";
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

?>