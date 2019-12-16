<?php

    function find_all_matches($member_id){
        global $db;

        $sql = "SELECT tournament.tournamentID, roundNumber,  tournamentName, tournamentDate, roundWinner ";
        $sql .= "FROM (tournamentMatches JOIN tournament ON tournamentMatches.tournamentID = tournament.tournamentID) ";
        $sql .= "WHERE firstparticipantID = '" . $member_id . "' OR secondparticipantID = '" . $member_id . "';";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

    function get_member_name($member_id){
        global $db;

        $sql = "SELECT first_name ";
        $sql .= "FROM users ";
        $sql .= "WHERE id = '".$member_id. "'; ";

        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }

?>
