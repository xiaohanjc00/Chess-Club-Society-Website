<?php 

  // functions for accessing and updating news:

  function find_all_articles() {
    global $db;

    $sql = "SELECT * FROM posts ORDER BY articleDate DESC";
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function find_article_by_id($id) {
    global $db;

    $sql = "SELECT * FROM posts WHERE articleID =" . $id;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
  }

  function delete_article($id) {
    global $db;

    $sql = "DELETE FROM posts WHERE articleID= ".$id;
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

  function validate_article($article, $options=[]) {
    $errors = [];
    if(is_blank($article['article_title'])) {
        $errors[] = "Please enter the title of the article.";
    } elseif (!has_length($article['article_title'], array('min' => 2, 'max' => 255))) {
        $errors[] = "Please enter a valid title.";
    }
    if(is_blank($article['article_description'])) {
        $errors[] = "Please enter the description of the article.";
    } elseif (!has_length($article['article_description'], array('min' => 15, 'max' => 5000))) {
        $errors[] = "Please enter a valid description.";
    }

    date_default_timezone_get();
    $currentDateTime = date('Y-m-d');
    $currentdatetime1 =  date_create($currentDateTime);
    $expiryDate =  date_create(date('Y-m-d',strtotime($article['expiry_date'])));

    if($currentdatetime1 >= $expiryDate){
      $errors[] = "Please enter a valid expiry date. Its value cannot come before todays date";
    }
    return $errors;
  }

  function insert_article($article) {
    global $db;

    $errors = validate_article($article);
    if (!empty($errors)) {
        return $errors;
    }
    $sql = 'INSERT INTO';
    $sql .=' posts(articleTitle, articleDesc, articleDate ';
    if(!is_blank($article['image_link'])){ $sql.= ', articleImage' ;}
    if(!is_blank($article['expiry_date'])) {$sql .= ', articleExpiry';}
    $sql .= ')values ("' ;
    $sql .= db_escape($db,$article['article_title']) ;
    $sql .= '", "' . db_escape($db, $article['article_description']) ;
    $sql .= '", current_date()';
    if(!is_blank($article['image_link'])) $sql.= ', "' . db_escape($db, $article['image_link']) . '"' ;
    if(!is_blank($article['expiry_date'])) $sql .= ', "' . db_escape($db,$article['expiry_date']) . '"';
    $sql .= ');';
    $result = mysqli_query($db, $sql);
    if($result) {
      return true;
    } else {
      echo mysqli_error($db);
      db_disconnect($db);
      exit;
    }
  }

  function update_article($article, $id) {
    global $db;

    $sql;
    if(!is_blank($article['article_title'])) $sql .= 'UPDATE posts set articleTitle= "'.  db_escape($db, $article['article_title']) . '" WHERE articleID =' .$id.';';
    if(!is_blank($article['image_link'])) $sql .= 'UPDATE posts set articleImage= "'.  db_escape($db, $article['image_link']) . '" WHERE articleID =' .$id.';';
    if(!is_blank($article['expiry_date'])) $sql .=  'UPDATE posts set articleExpiry= "'.  db_escape($db, $article['expiry_date']) . '" WHERE articleID =' .$id.';';
    if(!is_blank($article['article_description'])) $sql .= 'UPDATE posts set articleDesc= "'.  db_escape($db, $article['article_description']) . '" WHERE articleID =' .$id.';';
    
    if(!is_blank($sql)){
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
  }


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

    $sql = "SELECT * FROM tournament WHERE tournamentID =" . $id;
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
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
      $result = mysqli_query($db, $sql);
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

    $sql = "SELECT * FROM tournamentCoOrganizers WHERE tournamentID= ". $id. ";";
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

  function delete_tournament_organizer($organizerID) {
    global $db;

    $sql = 'DELETE FROM tournamentCoOrganizers WHERE organizerID =' . $organizerID . ' AND tournamentID= '. $tournamentID. ';';
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

    $sql = 'INSERT INTO `tournamentMatches`(firstparticipantID, secondparticipantID, tournamentID, roundNumber)';
    $sql .= 'VALUES';
    $sql .= '("' . $matches['firstparticipantID'] . '","' . $matches['secondparticipantID']  .'","' . $matches['tournamentID'] .'","' . $matches['roundNumber'] .'");';
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

  function find_matches($tournamentID, $round) {
    global $db;

    $sql = 'SELECT * FROM tournamentMatches WHERE tournamentID =' . $tournamentID . ' AND roundNumber ='. $round . ';';
    $result = mysqli_query($db, $sql);
    confirm_result_set($result);
    return $result;
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
    $sql = 'UPDATE tournamentMatches set roundWinner= "'.  db_escape($db, $tournament['winner']) . '" AND roundLoser =  "'.  db_escape($db, $tournament['loser']) . '" ';
    $sql .= 'WHERE tournamentID ="' .  db_escape($db, $tournament['tournamentID']).'" AND firstparticipantID = "' .  db_escape($db, $tournament['firstparticipantID']) . '" AND secondparticipantID = "' .  db_escape($db, $tournament['secondparticipantID']) . '";';
    if(!is_blank($sql)){
      $result = mysqli_query($db, $sql);
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

?>
