<?php

function find_all_matches($member_id){
    global $db;

    $sql = "SELECT tournament.tournamentID, roundNumber,  tournamentName, tournamentDate, roundWinner ";
    $sql .= "FROM (tournamentmatches JOIN tournament ON tournamentmatches.tournamentID = tournament.tournamentID) ";
    $sql .= "WHERE firstparticipantID = '" . $member_id . "' OR secondparticipantID = '" . $member_id . "';";

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
}

function find_all_matches2(){
    global $db;

    $sql = "SELECT tournament.tournamentID, roundNumber,  tournamentName, tournamentDate, roundWinner ";
    $sql .= "FROM (tournamentmatches JOIN tournament ON tournamentmatches.tournamentID = tournament.tournamentID) ";
    $sql .= "WHERE firstparticipantID = '1' OR secondparticipantID = '1';";

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
