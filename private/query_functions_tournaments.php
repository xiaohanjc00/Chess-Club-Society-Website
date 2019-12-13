<?php 
    // functions for accessing and updating tournaments:

  function validate_tournament($tournament, $options=[]) {
    $errors = [];
    
    if(is_blank($tournament['organizer'])) {
        $errors[] = "Please enter the ID of the organizer.";
    } 
    if(is_blank($tournament['name'])) {
        $errors[] = "Please enter the tournament name.";
    } elseif (!has_length($tournament['name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Please enter a valid name.";
    }
    if(is_blank($tournament['date'])) {
        $errors[] = "Please enter the date of the tournament.";
    }
    if(is_blank($tournament['deadline'])) {
        $errors[] = "Please enter the deadline for registering.";
    }

    date_default_timezone_get();
    $currentDateTime = date('Y-m-d');
    $currentdatetime1 =  date_create($currentDateTime);
    $tournamentDate =  date_create(date('Y-m-d',strtotime($tournament['date'])));
    $tournamentDeadline =  date_create(date('Y-m-d',strtotime($tournament['deadline'])));

    if($currentdatetime1 > $tournamentDeadline){
      $errors[] = "Please enter a valid deadline date. Its value cannot come before todays date";
    }
    if($currentdatetime1 > $tournamentDate){
      $errors[] = "Please enter a valid tournament date. Its value cannot come before todays date";
    }
    if($tournamentDate < $tournamentDeadline){
      $errors[] = "The deadline registration date cannot come after the date of the tournament";
    }

    return $errors;
  }

  function validate_tournament_update($tournament, $options=[]) {
    $errors = [];
    
    if (!is_blank($tournament['name']) && !has_length($tournament['name'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Please enter a valid name.";
    }


    $currentournament = find_tournament_by_id($tournament['tournamentID']);

    if(is_blank($tournament['deadline'])){
      $tournament['deadline'] = $currentournament['deadline'];
    }
    if(is_blank($tournament['date'])){
      $tournament['date'] = $currentournament['tournamentDate'];
    }

    date_default_timezone_get();
    $currentDateTime = date('Y-m-d');
    $currentdatetime1 =  date_create($currentDateTime);
    $tournamentDate =  date_create(date('Y-m-d',strtotime($tournament['date'])));
    $tournamentDeadline =  date_create(date('Y-m-d',strtotime($tournament['deadline'])));

    
    if($currentdatetime1 > $tournamentDeadline){
      $errors[] = "Please enter a valid deadline date. Its value cannot come before todays date";
    }
    if($currentdatetime1 > $tournamentDate){
      $errors[] = "Please enter a valid tournament date. Its value cannot come before todays date";
    }
    if($tournamentDate < $tournamentDeadline){
      $errors[] = "The deadline registration date cannot come after the date of the tournament";
    }

    return $errors;
  }

  function insert_tournament($tournament) {
    global $db;

    $errors = validate_tournament($tournament);
    if (!empty($errors)) {
        return $errors;
    }
    $sql = "INSERT INTO tournament";
    $sql .= "(tournamentOrganizer, tournamentName, tournamentDate, deadline)";
    $sql .= " VALUES (";
    $sql .= "'" . db_escape($db, $tournament['organizer']) . "', ";
    $sql .= "'" . db_escape($db, $tournament['name']) . "', ";
    $sql .= "'" . db_escape($db, $tournament['date']) . "', ";
    $sql .= "'" . db_escape($db, $tournament['deadline']) . "'" ;
    $sql .= ");";
    $result = mysqli_query($db, $sql);
    if($result) {
        return true;
    } else {
        // failed to insert tournament
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
  }

  function find_all_tournaments() {
    global $db;

    $sql = "SELECT * FROM tournament ORDER BY tournamentDate DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_tournament_by_id($id) {
    global $db;
    $sql = "SELECT * FROM tournament ";
    $sql .= "WHERE tournamentID='" . db_escape($db, $id) . "' ";
    $sql .= "LIMIT 1";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $tournament = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $tournament;
  }

  function delete_tournament($id) {
    global $db;

    $sql = 'DELETE FROM tournament WHERE tournamentID =' . $id;
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_tournament($tournament, $id) {
    global $db;

    $tournament['tournamentID'] = $id;
    $errors = validate_tournament_update($tournament);
    if (!empty($errors)) {
        return $errors;
    }
    $sql ="";
    if(!is_blank($tournament['name'])) $sql .= 'UPDATE tournament set tournamentName= "'.  db_escape($db, $tournament['name']) . '" WHERE tournamentID =' .$id.'; ';
    if(!is_blank($tournament['organizer'])) $sql .= 'UPDATE tournament set tournamentOrganizer= "'.  db_escape($db, $tournament['organizer']) . '" WHERE tournamentID =' .$id.'; ';
    if(!is_blank($tournament['date'])) $sql .=  'UPDATE tournament set tournamentDate= "'.  db_escape($db, $tournament['date']) . '" WHERE tournamentID =' .$id.'; ';
    if(!is_blank($tournament['deadline'])) $sql .= 'UPDATE tournament set deadline= "'.  db_escape($db, $tournament['deadline']) . '" WHERE tournamentID =' .$id.';';
    
    if(!is_blank($sql)){
      $result = mysqli_multi_query($db, $sql);
      if($result) {
        return true;
      } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }
  }

  function insert_tournament_organizer($tournament) {
    global $db;

    if($tournament['coorganizer'] != "None"){
      $sql = "INSERT INTO tournamentCoOrganizers";
      $sql .= "(organizerID, tournamentID)";
      $sql .= " VALUES (";
      $sql .= db_escape($db, $tournament['coorganizer']) . ",  ";
      $sql .= db_escape($db, $tournament['tournamentID']);
      $sql .= ");";
      $result = mysqli_query($db, $sql);
      if($result) {
          return true;
      } else {
          // failed to insert tournament
          echo mysqli_error($db);
          db_disconnect($db);
          exit;
      }
    }
  }

  function find_all_tournamentOrganizers() {
    global $db;

    $sql = "SELECT * FROM tournamentCoOrganizers ORDER BY tournamentID DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_organizers_by_tournament_id($id) {
    global $db;
    global $db;
    $sql = "SELECT id, first_name, last_name FROM users, tournamentcoorganizers WHERE tournamentID = ". $id." AND ";
    $sql .= "id =  organizerID;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_tournament_by_organizer_id($id) {
    global $db;

    $sql = "SELECT * FROM tournamentCoOrganizers WHERE organizerID= ". $id. ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function delete_tournament_organizer($tournament) {
    global $db;

    $sql = 'DELETE FROM tournamentCoOrganizers WHERE organizerID =' . $tournament["coorganizer"] . ' AND tournamentID= '. $tournament["tournamentID"]. ';';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_tournament_participant($participantID, $tournamentID) {
    global $db;

    $sql = 'INSERT INTO tournamentParticipant(participantID, tournamentID) values ';
    $sql .= '("' . $participantID . '","' . $tournamentID .'");';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_tournament_matches($matches) {
    global $db;
    
    $firstparticipant = find_user_by_id($matches['firstparticipantID']);
    $secondparticipant = find_user_by_id($matches['secondparticipantID']);
    
    $sql = 'INSERT INTO `tournamentMatches`(firstparticipantID, secondparticipantID, tournamentID, roundNumber, firstparticipantoldelo, secondparticipantoldelo)';
    $sql .= 'VALUES';
    $sql .= '("' . $matches['firstparticipantID'] . '","' . $matches['secondparticipantID']  .'","' . $matches['tournamentID'] .'","' . $matches['roundNumber'] .'", ';
    $sql .= $firstparticipant["rating"] . ', ' . $secondparticipant["rating"] . ');';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // INSERT failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function insert_new_rating($matches) {
    global $db;
    
    $firstparticipant = find_user_by_id($matches['firstparticipantID']);
    $secondparticipant = find_user_by_id($matches['secondparticipantID']);
    
    $sql = 'UPDATE `tournamentMatches` set firstparticipantnewelo =' . $firstparticipant['rating'] . ', secondparticipantnewelo =' . $secondparticipant['rating'] ;
    $sql .=' WHERE firstparticipantID = ' . $matches['firstparticipantID'] . ' AND secondparticipantID = ' . $matches['secondparticipantID'] ;
    $sql .= ' AND tournamentID = ' . $matches['tournamentID'] . ' AND roundNumber =' . $matches['roundNumber'] . ';';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }
  function find_matches($tournamentID, $round) {
    global $db;

    $sql = 'SELECT * FROM tournamentMatches WHERE tournamentID =' . $tournamentID . ' AND roundNumber ='. $round . ';';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_previous_round_winners($tournamentID, $round) {
    global $db;

    $sql = 'SELECT roundWinner FROM tournamentMatches WHERE tournamentID =' . $tournamentID . ' AND roundNumber ='. $round . ';';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    while($row = mysqli_fetch_assoc($result)){
      if(is_null($row['roundWinner'])){
        return true;
      }
    }
    return false;
  }

  function find_all_tournament_winners($tournamentID) {
    global $db;
    $sql = 'SELECT roundWinner FROM tournamentMatches WHERE tournamentID = ' . $tournamentID . ';';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    while($row = mysqli_fetch_assoc($result)){
      if(is_null($row['roundWinner'])){
        return true;
      }
    }
    return false;
  }

  function find_all_tournamentParticipants($id) {
    global $db;

    $sql = "SELECT * FROM tournamentParticipant, users WHERE id = participantID AND tournamentID = " .$id .";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_all_tournamentMatches($id) {
    global $db;

    $sql = "SELECT * FROM tournamentMatches WHERE tournamentID = " .$id ."  ORDER BY roundNumber;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_user_tournamentMatches($id) {
    global $db;

    $sql = "SELECT * FROM tournamentMatches WHERE firstparticipantID = " .$id ." OR  secondparticipantID = ".$id . "ORDER BY roundNumber;";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function set_winner($matchResult){
    global $db;

    $sql = 'UPDATE tournamentMatches set roundWinner= '.  db_escape($db, $matchResult['winner']) ;
    $sql .= ' WHERE roundNumber = ' . db_escape($db, $matchResult['matchID']) .' AND tournamentID =' .  db_escape($db, $matchResult['tournamentID']).' AND firstparticipantID = ' .  db_escape($db, $matchResult['firstparticipantID']) . ' AND secondparticipantID = ' .  db_escape($db, $matchResult['secondparticipantID']) . '; ';
    $sql .= ' UPDATE tournamentMatches set roundLoser =  '.  db_escape($db, $matchResult['loser']) ;
    $sql .= ' WHERE  roundNumber = ' . db_escape($db, $matchResult['matchID']) . ' AND tournamentID =' .  db_escape($db, $matchResult['tournamentID']).' AND firstparticipantID = ' .  db_escape($db, $matchResult['firstparticipantID']) . ' AND secondparticipantID = ' .  db_escape($db, $matchResult['secondparticipantID']) . ';';
     
    if(!is_blank($sql)){
      $result = mysqli_multi_query($db, $sql);
      if($result) {
        return true;
      } else {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
      }
    }
  }

  function set_tournament_winner($tournamentID){
    global $db;
    
      $sql = "SELECT roundWinner, count(*) FROM tournamentMatches ";
      $sql .= "WHERE tournamentID=" . db_escape($db, $tournamentID) . " ";
      $sql .= "GROUP BY roundWInner ";
      $sql .= "ORDER BY count(*) ";
      $sql .= "LIMIT 2; ";
      
      $result = mysqli_query($db, $sql);
      $num = 0;
      while($row = mysqli_fetch_assoc($result)){
        if($num == 0){
          $sql = "UPDATE tournament SET winnerID = " . $row["roundWinner"];
          $sql .= " WHERE tournamentID=" . db_escape($db, $tournamentID) . " ;";
        
          $update = mysqli_query($db, $sql);
          $num ++;
        }
        else{
          $sql = "UPDATE tournament SET firstRunnerUpID = " . $row["roundWinner"];
          $sql .= " WHERE tournamentID=" . db_escape($db, $tournamentID) . " ;";
        
          $update = mysqli_query($db, $sql);
        }
      
    }
    return false;
		
  }

  function find_participants_by_tournament_id($id) {
    global $db;

    $sql = "SELECT * FROM tournamentParticipant WHERE tournamentID= ". $id. ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_tournament_and_participant($id, $tournamentID) {
    global $db;

    $sql = "SELECT participantID FROM tournamentParticipant WHERE participantID= ". $id. " AND tournamentID = ". $tournamentID . ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_all_coorganizer($tournamentID) {
    global $db;

    $sql = "SELECT tournamentOrganizer FROM tournament WHERE tournamentID = ". $tournamentID . ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_tournament_organizer($id, $tournamentID) {
    global $db;

    $sql = "SELECT tournamentOrganizer FROM tournament WHERE tournamentOrganizer= ". $id. " AND tournamentID = ". $tournamentID . ";";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function delete_tournament_participant($participantID, $tournamentID) {
    global $db;

    $sql = 'DELETE FROM tournamentParticipant WHERE organizerID =' . $participantID . ' AND tournamentID= '. $tournamentID. ';';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      // DELETE failed
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function find_admins($id) {
    global $db;
    $sql = "SELECT id, first_name FROM users WHERE admin = 1 AND ";
    $sql .= "id NOT IN ";
    $sql .= "(SELECT organizerID 
      FROM tournamentcoorganizers WHERE tournamentID = ". $id . ")";
    $sql .= "AND id NOT IN ";
    $sql .= "(SELECT tournamentOrganizer FROM tournament WHERE tournamentID = ". $id.");";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function get_tournament_winner($tournamentID){
    global $db;

    $sql = "SELECT winnerID FROM tournament WHERE tournamentID = ".$tournamentID. ";" ;

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $winner = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $winner['winnerID'];
  }

  function get_tournament_runner_up($tournamentID){
    global $db;

    $sql = "SELECT firstRunnerUpID FROM tournament WHERE tournamentID = ".$tournamentID. ";" ;

    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    $winner = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $winner['firstRunnerUpID'];
  }



?>